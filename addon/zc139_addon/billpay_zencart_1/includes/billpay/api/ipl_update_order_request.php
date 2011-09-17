<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_update_order_request extends ipl_xml_request {
	
	private $_update_params = array();
	
	public function ipl_update_order_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "updateOrder";
	}
	
	public function set_update_params($bptid, $reference) {
		$this->_update_params["bptid"] = $bptid;
		$this->_update_params["reference"] = $reference;
	}
	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		$update_params = $this->_build_closed_tag("update_params", $this->_update_params);

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params . $update_params . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
}

?>