<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_capture_request extends ipl_xml_request {
	
	private $_capture_params = array();
	
	// bank account
	private $_account_holder;
	private $_account_number;
	private $_bank_code;
	private $_bank_name;
	private $_invoice_reference;
	private $_invoice_duedate;
	
	public function get_account_holder() {
		return $this->_account_holder;
	}
	
	public function get_account_number() {
		return $this->_account_number;
	}
	
	public function get_bank_code() {
		return $this->_bank_code;
	}
	
	public function get_bank_name() {
		return $this->_bank_name;
	}
	
	public function get_invoice_reference() {
		return $this->_invoice_reference;
	}
	
	public function get_invoice_duedate() {
		return $this->_invoice_duedate;
	}
	 	
	public function ipl_capture_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "capture";
	}
	
	public function set_capture_params($bptid, $cart_total_gross, $currency, $reference, $customer_id) {
		$this->_capture_params["bptid"] = $bptid;
		$this->_capture_params["carttotalgross"] = $cart_total_gross;
		$this->_capture_params["currency"] = $currency;
		$this->_capture_params["reference"] = $reference;
		$this->_capture_params["customerid"] = $customer_id;
	}
	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		$capture_params = $this->_build_closed_tag("capture_params", $this->_capture_params);

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params . $capture_params . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
	
	protected function _parse_result($res) {
		$xml = ipl_xml_request::_parse_result($res);
		
		// get bank account data
		if (!$this->has_error()) {
			$this->_account_holder = (string)$xml->invoice_bank_account->attributes()->account_holder;
			$this->_account_number = (string)$xml->invoice_bank_account->attributes()->account_number;
			$this->_bank_code = (string)$xml->invoice_bank_account->attributes()->bank_code;
			$this->_bank_name = (string)$xml->invoice_bank_account->attributes()->bank_name;
			$this->_invoice_reference = (string)$xml->invoice_bank_account->attributes()->invoice_reference;
			$this->_invoice_duedate = (string)$xml->invoice_bank_account->attributes()->invoice_duedate;
		}
		
		return $xml;
	}
}

?>