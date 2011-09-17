<?php

include_once 'ipl_xml_request.php';

/**
 * @author jwehrs (jan.wehrs@billpay.de)
 *
 */
class ipl_validation_request extends ipl_xml_request {
	
	private $_customer_details = array();
	private $_shippping_details = array();
	
	public function ipl_validation_request($ipl_request_url) {
		$this->_ipl_request_url = $this->_appendSlash($ipl_request_url) . "validate";
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
	
	protected function _build_xml() {
		$default_params = ipl_xml_request::_build_xml();
		$customer_details = $this->_build_closed_tag("customer_details", $this->_customer_details);
		$shipping_details = $this->_build_closed_tag("shipping_details", $this->_shippping_details);

		$xml = "<data api_version=\"" . self::$_api_version . "\">" . 
			$default_params . $customer_details . $shipping_details . 
			"</data>";
		
		return $this->_create_xml_string($xml);
	}
	
}

?>