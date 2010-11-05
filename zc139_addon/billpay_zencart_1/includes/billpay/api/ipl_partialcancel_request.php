<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_partialcancel_request extends ipl_xml_request {
	
	private $_cancel_params = array();
	private $_canceled_articles = array();
	
	public function ipl_partialcancel_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "partialcancel";
	}
	
	public function set_cancel_params($reference, $rebatedecrease, $rebatedecreasegross) {
		$this->_cancel_params["reference"] = $reference;
		$this->_cancel_params["rebatedecrease"] = $rebatedecrease;
		$this->_cancel_params["rebatedecreasegross"] = $rebatedecreasegross;
	}
	
	public function add_canceled_article($articleid, $articlequantity) {
		$article = array();
		$article["articleid"] = $articleid;
		$article["articlequantity"] = $articlequantity;
		
		$this->_canceled_articles[] = $article;
	}
	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		
		$cancel_params = $this->_build_closed_tag("cancel_params", $this->_cancel_params);
		$canceled_articles = $this->_build_list_tag("canceled_articles", "article", $this->_canceled_articles);

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params . $cancel_params . $canceled_articles . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
}

?>