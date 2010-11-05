<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_module_config_request extends ipl_xml_request {
	
	private $_static_limit;
	
	public function get_static_limit() {
		return $this->_static_limit;
	}
	 	
	public function ipl_module_config_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "moduleConfig";
	}
	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params .  
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
	
	protected function _parse_result($res) {
		$xml = ipl_xml_request::_parse_result($res);
		
		// get config data
		if (!$this->has_error()) {
			$this->_static_limit = (int)$xml->limit->attributes()->static;
		}
		
		return $xml;
	}
}

?>