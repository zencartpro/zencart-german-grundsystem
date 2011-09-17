<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_cancel_request extends ipl_xml_request {
	
	private $_cancel_params = array();
	
	public function ipl_cancel_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "cancel";
	}
	
	public function set_cancel_params($reference, $cart_total_gross, $currency) {
		$this->_cancel_params["reference"] = $reference;
		$this->_cancel_params["carttotalgross"] = $cart_total_gross;
		$this->_cancel_params["currency"] = $currency;
	}
	
	public function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		$cancel_params = $this->_build_closed_tag("cancel_params", $this->_cancel_params);

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params . $cancel_params . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
}

?>