<?php

/**
 *  @author Jan Wehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_xml_request {
	
	public static $terms_and_conditions_url = "http://www.billpay.de/kunden/agb";
	
	public static $_xml_prolog = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	
	public static $_api_version = "1.1.0";
	
	private static $_http_request_char_set = "UTF-8";
	
	private static $_use_curl = true;
	
	private $_socket_timeout = 5;
	
	private $_error_code = 0;
	private $_customer_error_message;
	private $_merchant_error_message;
	private $request_xml = "";
	private $response_xml = "";
	
	protected $_ipl_request_url;
	protected $_default_params = array();
	
	private $_username;
	private $_password;
	
	public function has_error() {
		return $this->_error_code > 0;
	}
	
	public function get_error_code() {
		return $this->_error_code;
	}
	
	public function get_customer_error_message() {
		return $this->_customer_error_message;
	}
	
	public function get_merchant_error_message() {
		return $this->_merchant_error_message;
	}
	
	public function get_request_xml() {
		return $this->request_xml;
	}
	
	public function get_response_xml() {
		return $this->response_xml;
	}
	
	public function set_default_params($mid, $pid, $bpsecure) {
		$this->_default_params["mid"] = $mid;
		$this->_default_params["pid"] = $pid;
		$this->_default_params["bpsecure"] = $bpsecure;
	}
	
	protected function _build_xml() {
		$tmp = $this->_build_closed_tag("default_params", $this->_default_params);
		return $tmp;
	}
	
	protected function _build_closed_tag($tag_name, $a) {
		$s = $this->_build_attr_string($a);
		
		return "<" . $tag_name . " " . $s . "/>"; 
	}
	
	protected function _appendSlash($s) {
		if (substr($s, strlen($s) - 1) != "/") {
			$s = $s . "/";
		}
		return $s;
	}
	
	protected function _build_list_tag($tag_name, $child_tag_name, $a) {
		$article_string = "<" . $tag_name . ">";
		foreach ($a as $list_item) {
			$s = $this->_build_attr_string($list_item);
			$article_string = $article_string . "<" . $child_tag_name . " " . $s . "/>"; 
		}
		$article_string = $article_string . "</" . $tag_name . ">";
		
		return $article_string; 
	}
	
	protected function _build_attr_string($a) {
		$attr_str = "";
		foreach ($a as $key => $value) {
			$attr_str = $attr_str . $key . "=\"" . $this->_escape($value) . "\" ";
		}
		return $attr_str;
	}
	
	protected function _create_xml_string($xml_str) {
		return self::$_xml_prolog . $xml_str;
	}
	
	protected function _escape($value) {
		$search = array("&", "\"", "<", ">", "'");
		$replace = array("&amp;", "&quot;", "&lt;", "&gt;", "&apos;");
		
		return str_replace($search, $replace, $value);
	}
	
	protected function _parse_result($res) {
		if (!self::$_use_curl) {
			$splitted = explode("\r\n\r\n", $res, 2);
			
			if (count($splitted) < 2) {
				throw new Exception("Invalid HTTP response: " . $res);
			}
			
			$header = $splitted[0];
			$s = explode(" ", $header);
			
			if (count($s) < 2) {
				throw new Exception("Invalid HTTP response: " . $res);	 
			}
			
			$statusCode = $s[1];
	
			if ($statusCode != "200") {
				throw new Exception("HTTP error code received: " . $statusCode);
			}
			
			$this->response_xml = $splitted[1];
		}
		else {
			$this->response_xml = $res;
		}
		
		$xml = simplexml_load_string($this->response_xml); 
		
		$this->_error_code = (int)$xml->attributes()->error_code;
		$this->_customer_error_message = (string)$xml->attributes()->customer_message;
		$this->_merchant_error_message = (string)$xml->attributes()->merchant_message;
		
		return $xml;
	}
	
 	private function decodeChunkedBody($body) {
        $decBody = '';

        while (preg_match("/^([\da-fA-F]+)[^\r\n]*\r\n/sm", trim($body), $m)) {
            $length = hexdec(trim($m[1]));
            $cut = strlen($m[0]);

            $decBody .= substr($body, $cut, $length);
            $body = substr($body, $cut + $length + 2);
        }

        return $decBody;
    }
	
	public function set_basic_auth_params($username, $password) {
		$this->_username = $username;
		$this->_password = $password;
	}
	
	public function send() {
		$this->request_xml = $this->_build_xml();
		
		if (empty($this->_ipl_request_url)) {
			throw new Exception("IPL Request url is not set");
		}
		
		if (self::$_use_curl) {
			$ch = curl_init();
		
			// 	set CURL options
			curl_setopt($ch, CURLOPT_URL, $this->_ipl_request_url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request_xml);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 15);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			
			// This prevents a known issue with CURLOPT_FOLLOWLOCATION
			if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
			}

			// send request
			$result = curl_exec($ch);
			
			if ($result == false) {
				throw new Exception('Connection timeout while connecting billpay server');
			}
			
			$info = curl_getinfo($ch);
			
			curl_close($ch);
			
			$httpCode = $info['http_code'];
			if ($httpCode != 200) {
				throw new Exception('Error connecting to billpay server (Http status code: ' . $httpCode . ')');					
			}
		}
		else {
			try {
				$url = parse_url($this->_ipl_request_url);
				
				$scheme = $url['scheme'];
				$host = $url['host'];
		    	$path = $url['path'];
		    	
		    	if (isset($url['port'])) {
					$port = $url['port'];
		    	}
				
				$protocol = "";
				if ($scheme == "https") {
					if (empty($port)) {
						$port = 443;
					}
					
					$protocol = "ssl://";
				}
				
				if (empty($port)) {
					$port = 80;
				}
			}
			catch (Exception $e) {
				throw new Exception("Invalid request url: " . $this->_ipl_request_url);
			}
			
			$fp = fsockopen($protocol . $host, $port, $errno, $errstr, $this->_socket_timeout);
			
			$result = ''; 
			if ($fp) {
				 // send the request headers
		    	fputs($fp, "POST $path HTTP/1.1\r\n");
		    	fputs($fp, "Host: $host\r\n");
				fputs($fp, "Accept: text/xml\r\n");
		    	fputs($fp, "Content-type: text/xml; charset=" . self::$_http_request_char_set . "\r\n");
		    	fputs($fp, "Content-length: ". strlen($this->request_xml) . "\r\n");
		    	
				if (!empty($this->_username)) {
					$user = $this->_username;
					$pass = $this->_password;
		    		fputs($fp, "Authorization: Basic ".base64_encode("$user:$pass") . "\r\n");
		    	}
		    	
		    	fputs($fp, "Connection: close\r\n\r\n");
		    	fputs($fp, $this->request_xml);
				
			    while(!feof($fp)) {
					$result .= fgets($fp, 128);
				}
				
		    	// close the socket connection
		    	fclose($fp);
			}
			else {
				throw new Exception("Socket error (Code: " . $errno . ", Message: " . $errstr . ")");
			}
		}
		
		// parse the HTTP response
		$this->_parse_result($result);
		
		return $result;
	}

}
?>