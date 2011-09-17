<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_preauthorize_request extends ipl_xml_request {
	
	private $_customer_details = array();
	private $_shippping_details = array();
	private $_totals = array();
	private $_bank_account = array();
	
	private $_article_data = array();
	private $_order_history_data = array();
	
	private $_status;
	private $_bptid;
	private $_payment_type;
	
	private $_corrected_street;
	private $_corrected_street_no;
	private $_corrected_zip;
	private $_corrected_city;
	private $_corrected_country;
	private $_terms_accepted = false;
	private $_expected_days_till_shipping = 0;
	
	public function get_terms_accepted() {
		return $this->_terms_accepted;
	}
	
	public function set_terms_accepted($val) {
		$this->_terms_accepted = $val;
	}
	
	public function set_expected_days_till_shipping($val) {
		$this->_expected_days_till_shipping = $val;
	}
	
	public function get_expected_days_till_shipping() {
		return $this->_expected_days_till_shipping;
	}
	
	public function get_status() {
		return $this->_status;
	}
	
	public function get_bptid() {
		return $this->_bptid;
	}
	
	public function get_corrected_street() {
		return $this->_corrected_street;
	}
	
	public function get_corrected_street_no() {
		return $this->_corrected_street_no;
	}
	
	public function get_corrected_zip() {
		return $this->_corrected_zip;
	}
	
	public function get_corrected_city() {
		return $this->_corrected_city;
	}
	
	public function get_corrected_country() {
		return $this->_corrected_country;
	}
	
	public function get_payment_type() {
		return $this->_payment_type;
	}
	 	
	public function ipl_preauthorize_request($ipl_request_url, $payment_type = 1) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "preauthorize";
		$this->_payment_type = $payment_type;
	}
	
	public function set_customer_details($customer_id, $customer_type, $salutation, $title, 
		$first_name, $last_name, $street, $street_no, $address_addition, $zip,
		$city, $country, $email, $phone, $cell_phone, $birthday, $language, $ip) {

			$this->_customer_details["customerid"] = $customer_id;
			$this->_customer_details["customertype"] = $customer_type;
			$this->_customer_details["salutation"] = $salutation;
			$this->_customer_details["title"] = $title;
			$this->_customer_details["firstName"] = $first_name;
			$this->_customer_details["lastName"] = $last_name;
			$this->_customer_details["street"] = $street;
			$this->_customer_details["streetNo"] = $street_no;
			$this->_customer_details["addressAddition"] = $address_addition;
			$this->_customer_details["zip"] = $zip;
			$this->_customer_details["city"] = $city;
			$this->_customer_details["country"] = $country;
			$this->_customer_details["email"] = $email;
			$this->_customer_details["phone"] = $phone;
			$this->_customer_details["cellPhone"] = $cell_phone;
			$this->_customer_details["birthday"] = $birthday;
			$this->_customer_details["language"] = $language;
			$this->_customer_details["ip"] = $ip;
	}
	
	
	public function set_shipping_details($use_billing_address, $salutation=null, $title=null, $first_name=null, $last_name=null, 
		$street=null, $street_no=null, $address_addition=null, $zip=null, $city=null, $country=null, $phone=null, $cell_phone=null) {
			
			$this->_shippping_details["useBillingAddress"] = $use_billing_address ? "1" : "0";
			$this->_shippping_details["salutation"] = $salutation;
			$this->_shippping_details["title"] = $title;
			$this->_shippping_details["firstName"] = $first_name;
			$this->_shippping_details["lastName"] = $last_name;
			$this->_shippping_details["street"] = $street;
			$this->_shippping_details["streetNo"] = $street_no;
			$this->_shippping_details["addressAddition"] = $address_addition;
			$this->_shippping_details["zip"] = $zip;
			$this->_shippping_details["city"] = $city;
			$this->_shippping_details["country"] = $country;
			$this->_shippping_details["phone"] = $phone;
			$this->_shippping_details["cellPhone"] = $cell_phone;
	}
	
	public function add_article($articleid, $articlequantity, $articlename, $articledescription,
		$article_price, $article_price_gross) {
			
			$article = array();
			$article["articleid"] = $articleid;
			$article["articlequantity"] = $articlequantity;
			$article["articlename"] = $articlename;
			$article["articledescription"] = $articledescription;
			$article["articleprice"] = $article_price;
			$article["articlepricegross"] = $article_price_gross;
			
			$this->_article_data[] = $article;
	}
	
	
	public function add_order_history($horderid, $hdate, $hamount, $hcurrency, $hpaymenttype, $hstatus) {

		$histOrder = array();
		$histOrder["horderid"] = $horderid;
		$histOrder["hdate"] = $hdate;
		$histOrder["hamount"] = $hamount;
		$histOrder["hcurrency"] = $hcurrency;
		$histOrder["hpaymenttype"] = $hpaymenttype;
		$histOrder["hstatus"] = $hstatus;
		
		$this->_order_history_data[] = $histOrder;
	}
	
	
	public function set_total($rebate, $rebategross, $shipping_name, $shipping_price, $shipping_price_gross, $cart_total_price,
			$cart_total_price_gross, $currency, $reference) {

		$this->_totals["rebate"] = $rebate;
		$this->_totals["rebategross"] = $rebategross;
		$this->_totals["shippingname"] = $shipping_name;
		$this->_totals["shippingprice"] = $shipping_price;
		$this->_totals["shippingpricegross"] = $shipping_price_gross;
		$this->_totals["carttotalprice"] = $cart_total_price;
		$this->_totals["carttotalpricegross"] = $cart_total_price_gross;
		$this->_totals["currency"] = $currency;
		$this->_totals["reference"] = $reference;
	}
	
	public function set_bank_account($account_holder, $account_number, $sort_code) {
		$this->_bank_account["accountholder"] = $account_holder;
		$this->_bank_account["accountnumber"] = $account_number;
		$this->_bank_account["sortcode"] = $sort_code;
	}

	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		$customer_details = $this->_build_closed_tag("customer_details", $this->_customer_details);
		$shipping_details = $this->_build_closed_tag("shipping_details", $this->_shippping_details);
		$bank_accout_data = $this->_build_closed_tag("bank_account", $this->_bank_account);
		$total = $this->_build_closed_tag("total", $this->_totals);
		$article_data = $this->_build_list_tag("article_data", "article", $this->_article_data);
		$history_data = $this->_build_list_tag("order_history_data", "order_history", $this->_order_history_data);
		

		$tcaccepted = $this->_terms_accepted ? "1" : "0"; 
		
		$xml = "<data tcaccepted=\"" . $this->_escape($tcaccepted) . 
			"\" api_version=\"" . self::$_api_version . 
			"\" expecteddaystillshipping=\"" . $this->_escape($this->_expected_days_till_shipping) . 
			"\" paymenttype=\"" . $this->_escape($this->_payment_type) . "\">" . 
			$default_params . $customer_details . $shipping_details . $bank_accout_data .
			$total . $article_data . $history_data . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
	
	protected function _parse_result($res) {
		$xml = ipl_xml_request::_parse_result($res);
		
		$this->_status = (string)$xml->attributes()->status;
		$this->_bptid  = (string)$xml->attributes()->bptid;
		
		if ($xml->corrected_address) {
			$this->_corrected_street = (string)$xml->corrected_address->attributes()->street;
			$this->_corrected_street_no = (string)$xml->corrected_address->attributes()->streetNo;
			$this->_corrected_zip = (string)$xml->corrected_address->attributes()->zip;
			$this->_corrected_city = (string)$xml->corrected_address->attributes()->city;
			$this->_corrected_country = (string)$xml->corrected_address->attributes()->country; 
		}
		
		return $xml;
	}
}

?>