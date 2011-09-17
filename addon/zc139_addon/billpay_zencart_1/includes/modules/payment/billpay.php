<?php
/**
 * @package payment - billpay
 * @copyright Copyright 2010 Billpay GmbH
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com  http://edv.langheiter.com
 * zahlungs.....(BillPay-text)
 * 
 * @version $Id: billpay.php 582 2010-06-02 08:24:32Z hugo13 $
 */

require_once(DIR_FS_CATALOG . 'includes/billpay/api/ipl_xml_request.php');           

  class billpay {
    var $code, $title, $description, $enabled, $order, $eula_url, $testmode, $api_url, $_formDob, $_log;
    var $_logPath, $enableLog, $billpayTable, $debugLog;
    var $bp_merchant, $bp_portal, $bp_secure; // TEMP

// class constructor
    function billpay()
    {
      global $order, $db;

      $this->db = $db;
      $this->code = 'billpay';
      $this->billpayTable = 'payment_billpay';
      $this->title = MODULE_PAYMENT_BILLPAY_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_BILLPAY_TEXT_DESCRIPTION;
      $this->api_url = MODULE_PAYMENT_BILLPAY_API_URL_BASE;
      $this->sort_order = MODULE_PAYMENT_BILLPAY_SORT_ORDER;
      $this->min_order = MODULE_PAYMENT_BILLPAY_MIN_AMOUNT;
      $this->_logPath = MODULE_PAYMENT_BILLPAY_LOGGING;
      
      $this->public_title = 'billpay';

      if (empty($this->_logPath)) {
            $this->_logPath = DIR_FS_CATALOG . 'includes/billpay/log/billpay.log';
      }
      else {
          $this->_logPath .= '/billpay.log';
      }
      
      $this->enableLog = ((MODULE_PAYMENT_BILLPAY_LOGGING_ENABLE == 'True') ? true : false);
      
      if ((int) MODULE_PAYMENT_BILLPAY_ORDER_STATUS > 0) {
      $this->order_status = MODULE_PAYMENT_BILLPAY_ORDER_STATUS;    
      }
      
      if (!defined('MODULE_PAYMENT_BILLPAY_TABLE'))
          define('MODULE_PAYMENT_BILLPAY_TABLE', $this->billpayTable);
      else
          $this->billpayTable = MODULE_PAYMENT_BILLPAY_TABLE;

      if (!defined('MODULE_PAYMENT_BILLPAY_DEBUG'))
          $this->debugLog = TRUE;
      else
          $this->debugLog = ((MODULE_PAYMENT_BILLPAY_DEBUG == 'True') ? true : false);

      // init billpay array in $_SESSION
      // if ((empty($_SESSION['billpay'])) && (!is_array($_SESSION['billpay'])))
      //   $_SESSION['billpay'] = array();
          
      // temporary variables for check below
      $_bpMerchant    = (int)MODULE_PAYMENT_BILLPAY_MERCHANT_ID;
      $_bpPortal    = (int)MODULE_PAYMENT_BILLPAY_PORTAL_ID;
      $_bpSecure    = MODULE_PAYMENT_BILLPAY_SECURE;
  
      // deactivate module on missing but needed settings 
      if ((empty($_bpMerchant)) || (empty($_bpPortal)) || (empty($_bpSecure)))
      {
          // force deactivation of  module
          $this->_logError('merchant, portal-id or secure-key not set', 'initial error');
            $_SESSION['billpay_deactivated'] = TRUE;
            $this->enabled = FALSE;
      }
      else
      {
            $this->enabled = ((MODULE_PAYMENT_BILLPAY_STATUS == 'True') ? true : false);
            $_SESSION['billpay_deactivated'] = $this->enabled;    // r.l. ???
          
            $this->bp_merchant    = $_bpMerchant;
          $this->bp_portal    = $_bpPortal;
          $this->bp_secure    = md5($_bpSecure);
      }
      
      // free ressources
      unset($_bpMerchant, $_bpPortal, $_bpSecure);
      
      $this->testmode     = ((MODULE_PAYMENT_BILLPAY_TESTMODE == 'Testmodus') ? true : false);
      $this->shopID        = MODULE_PAYMENT_BILLPAY_ID;
      
      $this->sessionID    = zen_session_id();
      
      $this->eula_url = ipl_xml_request::$terms_and_conditions_url;
      
      if (isset($order) && is_object($order))
      {
          $this->update_status();
      }
    }    
    

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_BILLPAY_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_BILLPAY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
        // BOF country-check
        // hugo13 was here
        if($this->enabled != false){
            $dest_country = $order->billing['country']['iso_code_2'];
            $country_zones = split("[,]", MODULE_PAYMENT_BILLPAY_COUNTRIES);
            if (in_array($dest_country, $country_zones)) {
                $this->enabled = true;
            } else {
                $this->enabled = false;
            }
        }
        // EOF country-check
    }
   
    function javascript_validation()
    {
      // check values
      $js = '   if (payment_value == "' . $this->code . '") {' . "\n" .
              '   if (document.getElementById("checkout_payment").elements["billpay[dob][day]"].value == "00") {' . "\n" .
              '   error_message = error_message + unescape("' . JS_BILLPAY_DOBDAY . '");' . "\n" .
              '   error = 1;'."\n".'    }' . "\n" .
              '   if (document.getElementById("checkout_payment").elements["billpay[dob][month]"].value == "00") {' . "\n" .
              '   error_message = error_message + unescape("' . JS_BILLPAY_DOBMONTH . '");' . "\n" .
              '   error = 1;'."\n".'    }' . "\n" .
            '   if (document.getElementById("checkout_payment").elements["billpay[dob][year]"].value == "00") {' . "\n" .
              '   error_message = error_message + unescape("' . JS_BILLPAY_DOBYEAR . '");' . "\n" .
              '   error = 1;'."\n".'    }' . "\n" .
            '   if (document.getElementById("checkout_payment").elements["billpay_gender"].value == "00") {' . "\n" .
              '   error_message = error_message + unescape("' . JS_BILLPAY_GENDER . '");' . "\n" .
              '   error = 1;'."\n".'    }' . "\n" .      
              '    if (!document.getElementById("checkout_payment").billpay_eula.checked) {' . "\n" .
            '    error_message = error_message + unescape("' . JS_BILLPAY_EULA . '");' . "\n" .
            '    error = 1;' . "\n" .
             '    }'  . "\n" .
              '}' . "\n";
      return $js;
    }

    function selection()
    {
        global $order;

        $hide = $_SESSION['billpay_hide_payment_method'];

        if ($hide === TRUE)
        {
            $_SESSION['billpay_deactivated'] = TRUE;
            return false;
        }
        else if($order->info['total'] < (float)$this->min_order)
        {
            return false;
        }
        else 
        {
            // Check static limit and hide payment method if necessary
            $config = $this->getModuleConfig();            
            if ($config) {
                $staticLimit = $config['static_limit'];
                $orderTotal = $this->_currencyToSmallerUnit($order->info['total']);
                
                if ($orderTotal > $staticLimit) {
                    $_SESSION['billpay_deactivated'] = TRUE;    
                    $this->_logError('Static limit exceeded (' . $total . ' > ' . $staticLimit . ')');
                    return false;
                }
                else 
                {
                    $_SESSION['billpay_deactivated'] = FALSE;
                }
            }
            else {
                $_SESSION['billpay_deactivated'] = TRUE;
                return false;
            }
        }
        
        //if ((!empty($_SESSION['billpay'])) || ($order['info']['total'] <= $this->order_limit) )
        if (empty($_SESSION['billpay_deactivated'])) 
        {
            $_customerDob = $this->_getCustomerDob();
            $_customerGender = $this->_getCustomerGender();
            $title_ext = '';
            if(MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS == 'true')
            {
                $fee = $this->_calculate_billpay_fee();            
            
                if(isset($fee) && $fee['cost'] > 0)
                {
                    $title_ext = ' '.MODULE_PAYMENT_BILLPAY_TEXT_ADD. $fee['formated'];
                }
            }
            $selection = array('id' => $this->code,
                         'module' => $this->title . $title_ext,
                         'description' => "",
                           'fields' => array(array('title' => "",
                                                   'field' => MODULE_PAYMENT_BILLPAY_TEXT_INFO),
                                                 ));
                                                 
            $prolog = '';
            if (empty($_customerDob)) {
                if (empty($_customerGender)) {
                    $prolog = MODULE_PAYMENT_BILLPAY_TEXT_ENTER_BIRTHDATE_AND_GENDER;
                }
                else {
                    $prolog = MODULE_PAYMENT_BILLPAY_TEXT_ENTER_BIRTHDATE;
                }
            }
            else if (empty($_customerGender)) {
                $prolog = MODULE_PAYMENT_BILLPAY_TEXT_ENTER_GENDER;
            }
            
                //$prolog = '<div style=\'margin-top:10px; margin-bottom:5px\'>' . $prolog . '<div/>';

                                                 
              $selection['fields'][] = array('title' => '',
                'field' => '<input type="checkbox" name="billpay_eula" id="billpay_eula" />&nbsp;&nbsp;&nbsp;' . MODULE_PAYMENT_BILLPAY_TEXT_EULA_CHECK . "<br/>". MODULE_PAYMENT_BILLPAY_TEXT_REQ . $prolog);
    
              
            // if we have dob add a hidden field
            if (!empty($_customerDob)) 
            {
                $selection['fields'][] = array('title' => '',
                  'field' => '<input type="hidden" maxlength="10" size="10" name="billpay_dob" value="' . $_customerDob . '" />');
            }
            else
            {
                // if not, show selects
                $selection['fields'][] = array('title' => MODULE_PAYMENT_BILLPAY_TEXT_BIRTHDATE,
                'field' => $this->_getSelectDobDay()
                         . '&nbsp;&nbsp;' . $this->_getSelectDobMonth()
                         . '&nbsp;&nbsp;' . $this->_getSelectDobYear()); 
            }
            
            // if we have dob add a hidden field
            if (!empty($_customerGender)) {
                //$selection['fields'][] = array('title' => MODULE_PAYMENT_BILLPAY_TEXT_GENDER,
                $selection['fields'][] = array('title' => '',
                  'field' => '<input type="hidden" maxlength="10" size="10" name="billpay_gender" value="' . $_customerGender . '" />'
                  );
            }
            else {    // if not, show selects    
                $selection['fields'][] = array('title' => MODULE_PAYMENT_BILLPAY_TEXT_GENDER,
                                                'field' => $this->_genSelectGender()); 
            }
             
            if(isset($fee) && $fee['cost'] > 0 && MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS == 'true')
            {
                $selection['fields'][] = array('title' => "",
                                                'field' => MODULE_PAYMENT_BILLPAY_TEXT_FEE_INFO1 . $fee['formated'] . MODULE_PAYMENT_BILLPAY_TEXT_FEE_INFO2);
            }
            return $selection;
        }
        else
        {
            return false;
        }
    }
    

    function pre_confirmation_check() {
        global $order, $insert_id;
        
        if(isset($_POST['payment']) && $_POST['payment'] == 'billpay')
        {
            $_SESSION['billpay_dob_day'] =  (isset($_POST['billpay']['dob']['day'])) ? $_POST['billpay']['dob']['day'] : NULL;
            $_SESSION['billpay_dob_month'] = (isset($_POST['billpay']['dob']['month'])) ? $_POST['billpay']['dob']['month'] : NULL;
            $_SESSION['billpay_dob_year'] = (isset($_POST['billpay']['dob']['year'])) ? $_POST['billpay']['dob']['year'] : NULL;
            $_SESSION['billpay_gender'] = (isset($_POST['billpay_gender'])) ? $_POST['billpay_gender'] : NULL;
    
            if(!isset($_POST['billpay_eula']))
            {
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                 'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ERROR_EULA)), 'SSL'));
            }
            else if(!isset($_POST['billpay_gender']) || $_POST['billpay_gender']=="00" || $_POST['billpay_gender']=="" || $_POST['billpay_gender']=="0")
            {
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                 'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ENTER_GENDER)), 'SSL'));
            }
            
            $this->_formDob = $this->_checkPaymentSelection();
            $active = FALSE;
            
            if (!empty($this->_formDob))
            {
                $active = TRUE;
            }
            else
            {
                if(!isset($_POST['billpay']['dob']['day']) || $_POST['billpay']['dob']['day']=="00" || $_POST['billpay']['dob']['day']=="" || $_POST['billpay']['dob']['day']=="0")
                {    
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                     'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ENTER_BIRTHDATE)), 'SSL'));
                }
                else if(!isset($_POST['billpay']['dob']['month']) || $_POST['billpay']['dob']['month']=="00" || $_POST['billpay']['dob']['month']=="" || $_POST['billpay']['dob']['month']=="0")
                {
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                     'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ENTER_BIRTHDATE)), 'SSL'));
                }
                else if(!isset($_POST['billpay']['dob']['year']) || $_POST['billpay']['dob']['year']=="00" || $_POST['billpay']['dob']['year']=="" || $_POST['billpay']['dob']['year']=="0")
                {
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                     'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ENTER_BIRTHDATE)), 'SSL'));
                }
                $active = TRUE;
            }
            // check end
            if ($active === TRUE) 
            {
                // include preauthorize lib
                require_once(DIR_WS_INCLUDES . 'billpay/api/ipl_preauthorize_request.php');
            
                $this->_logError($this->api_url, 'preconfirmation check api url');
                // init preauthorize
                $req = new ipl_preauthorize_request($this->api_url);
                $req->set_default_params($this->bp_merchant, $this->bp_portal, $this->bp_secure);
    
                // set customer details
                $req->set_customer_details(
                                utf8_encode($this->_getCustomerId()),
                                /*utf8_encode($this->_getCustomerGroup()),*/utf8_encode('n'), 
                                utf8_encode($this->_getCustomerSalutation($_POST['billpay_gender'])),
                                utf8_encode(''), // title
                                utf8_encode($order->billing['firstname']),
                                utf8_encode($order->billing['lastname']),
                                utf8_encode($order->billing['street_address']),
                                utf8_encode(''), // streetno
                                utf8_encode(''), // address extra
                                utf8_encode($order->billing['postcode']),
                                utf8_encode($order->billing['city']), 
                                utf8_encode($order->billing['country']['iso_code_3']),
                                utf8_encode($order->customer['email_address']),
                                utf8_encode($order->customer['telephone']),
                                utf8_encode(''), // cellphone
                                utf8_encode($this->_formDob),
                                utf8_encode($_SESSION['language_code']),
                                //utf8_encode($this->_getCustomerIp()) 
                                utf8_encode($_SERVER['REMOTE_ADDR'])
                                );
                
                // shipping_details
                $addressCompare = (int)count(array_intersect_assoc($order->billing, $order->delivery));
                                
                // actually this feature is inactive on the other side (2010/03/30)
                // billing and delivery are both have 12 array entries
                if ($addressCompare < 12)
                {
                    // if addresses don't match set shipping address
                    $req->set_shipping_details(FALSE,
                                            utf8_encode($this->_getCustomerSalutation($_POST['billpay_gender'])),
                                            utf8_encode(''), // title
                                            utf8_encode($order->delivery['firstname']),
                                            utf8_encode($order->delivery['lastname']),
                                            utf8_encode($order->delivery['street_address']),
                                            utf8_encode(''), // streetno
                                            utf8_encode(''), // address extra
                                            utf8_encode($order->delivery['postcode']),
                                            utf8_encode($order->delivery['city']), 
                                            utf8_encode($order->delivery['country']['iso_code_3']),
                                            utf8_encode($order->customer['email_address']),
                                            utf8_encode($order->customer['telephone']),
                                            utf8_encode('') // cellphone
                                            );
                    
                }
                else
                {
                    $req->set_shipping_details(TRUE);
                }
                    
                foreach ($order->products as $product)
                {
                    $req->add_article(utf8_encode($product['id']),
                                      utf8_encode($product['qty']),
                                      utf8_encode($product['name']),
                                      utf8_encode(''),
                                      //utf8_encode($this->_getPrice($product['price'], $product['tax'], $_SESSION[customers_status][customers_status_show_price_tax])),
                                      utf8_encode($this->_currencyToSmallerUnit($product['final_price'])),
                                      utf8_encode($this->_getPrice($product['price'], $product['tax'], 1))
                                      );
                }
        
                $carttotal = $this->_calculateCartSum();
                $carttotalgross = $this->_calculateCartSum() + $this->_calculateCartTax();

                //calculate shipping cost and shipping tax
                $billpay_shipping_cost = (isset($order->info['shipping_cost'])) ? $order->info['shipping_cost'] : 0;

                $billpay_shipping = explode("_", $_SESSION['shipping']['id']);
                if(defined('MODULE_SHIPPING_'.strtoupper($billpay_shipping[0]).'_TAX_CLASS'))
                {
                    $tax_class = constant('MODULE_SHIPPING_'.strtoupper($billpay_shipping[0]).'_TAX_CLASS');
                    $shipping_tax = zen_get_tax_rate($tax_class, 
                                                        $order->delivery['country']['id'], 
                                                            $order->delivery['zone_id']);
                    $billpay_shipping_tax = zen_calculate_tax($order->info['shipping_cost'], $shipping_tax);
                }
                else
                {
                    $billpay_shipping_tax = 0;
                }
            
                
                $carttotal += $billpay_shipping_cost;
                $carttotalgross += $billpay_shipping_cost;
                $carttotalgross += $billpay_shipping_tax;
                
                $rebate = 0;
                $rebategross = 0;
                
                if ($_SESSION['customers_status']['customers_status_ot_discount_flag'] == '1' && $_SESSION['customers_status']['customers_status_ot_discount']!='0.00') 
                {
                    $rebate = $this->_calculateCartSum() / 100 * $_SESSION['customers_status']['customers_status_ot_discount'];
                    $rebategross = ($this->_calculateCartSum() + $this->_calculateCartTax()) / 100 * $_SESSION['customers_status']['customers_status_ot_discount'];
                }
                if(defined(MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS) && MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS == "true")
                {
                    $billpay_loworderfee = $this->_calculateLoworderfee($order);
                    
                    $rebate -= $billpay_loworderfee['fee'];
                    $rebategross -= ($billpay_loworderfee['fee'] + $billpay_loworderfee['tax']);
    
                    if((int)MODULE_ORDER_TOTAL_TAX_SORT_ORDER >= (int)MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER)
                    {
                        $carttotal -= $billpay_loworderfee['tax'];
                    }
                }
                
                if (isset($_SESSION['cot_gv']) && $_SESSION['cot_gv'] == true
                    || isset($_POST['cot_gv']) && $_POST['cot_gv'] == "on") 
                {
                    if(class_exists('ot_gv'))
                    {
                        $gv = new ot_gv();
                        $od_amount = $gv->calculate_credit($carttotalgross + $order->info['shipping_cost'] + $billpay_loworderfee['fee'] + $billpay_loworderfee['tax']);
                        
                        if ($gv->calculate_tax != "None")
                        {
                            $tod_amount = $gv->calculate_tax_deduction($order->info['subtotal'], $od_amount, $this->calculate_tax);
                            $od_amount = $gv->calculate_credit($order_total);
                        }
                        $rebate += $od_amount;
                        $rebategross += $od_amount;
                    }
                }
                
                if (isset($_SESSION['gv_redeem_code']) && $_SESSION['gv_redeem_code'] != ""
                    || isset($_POST['gv_redeem_code']) && $_POST['gv_redeem_code'] != "" || 1==1) 
                {
                    if(class_exists('ot_coupon'))  //r.l. ???
                    {
                        $coupon = new ot_coupon();
                        $coupon_amount = $coupon->calculate_deductions($carttotalgross + $order->info['shipping_cost'] + $billpay_loworderfee['fee'] + $billpay_loworderfee['tax']);
                        $rebate += $coupon_amount['total'];
                        $rebategross += $coupon_amount['total'];
                    }
                }
                unset($_SESSION['billpay_fee_cost']);
                unset($_SESSION['billpay_fee_tax']);
                if(MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS == 'true')
                {
                    $fee = $this->_calculate_billpay_fee();
                    if(isset($fee) && $fee['cost'] > 0)
                    {
                        $billpay_fee_cost = $fee['cost']; 
                        $billpay_fee_tax = $fee['tax'];
                        $_SESSION['billpay_fee_cost'] = $billpay_fee_cost;
                        $_SESSION['billpay_fee_tax'] = $billpay_fee_tax;
                    }
                }
                
                // set_total
                $req->set_total(utf8_encode($this->_currencyToSmallerUnit($rebate)),    // rebate
                                utf8_encode($this->_currencyToSmallerUnit($rebategross)),    // rebategross
                                utf8_encode(isset($order->info['shipping_method']) ? $order->info['shipping_method'] : 'not available'),
                                utf8_encode($this->_currencyToSmallerUnit($billpay_shipping_cost + $billpay_fee_cost)),
                                utf8_encode($this->_currencyToSmallerUnit($billpay_shipping_cost + $billpay_shipping_tax + $billpay_fee_cost + $billpay_fee_tax)),
                                utf8_encode($this->_currencyToSmallerUnit($carttotal  + $billpay_fee_cost)),
                                utf8_encode($this->_currencyToSmallerUnit($carttotalgross  + $billpay_fee_cost + $billpay_fee_tax)),
                                utf8_encode($this->_getCurrency()), /* utf8_encode('EUR'), */
                                utf8_encode('')    // reference
                                );
    
                $req->set_terms_accepted(true);
        
                // fetch the order history for customers only (not guests)
                // r.l. why ???
                if ($this->_getCustomerGroup() != 'g')
                {
                    // fetch & add history
                    $_OrderHistory = $this->_getOrderHistory($this->_getCustomerId());
                    // why not merge $this->_order_history_data with $_OrderHistory
                    
                    if (!empty($_OrderHistory))
                    {
                        foreach ($_OrderHistory as $historyPart)
                        {
                          $req->add_order_history($historyPart['hid'],
                                                    $historyPart['hdate'],
                                                  isset($historyPart['hamount']) ? $historyPart['hamount'] : 0,
                                                  $historyPart['hcurrency'],
                                                  $historyPart['hpaymenttype'],
                                                  $historyPart['hstatus']   // todo!
                                                  );
                        }
                    }
                }
                
                $success = TRUE;
                $hidePayment = FALSE;
                $redirMessage = '';
                $logMessage = '';
                try 
                {
                    $req->send();
                    $this->_logError(utf8_decode($req->get_request_xml()), 'XML request Vorauthorisierung');
                    $this->_logError(utf8_decode($req->get_response_xml()), 'XML response Vorauthorisierung');                
                    if(!$req->has_error())
                    {
                        $_SESSION['billpay_transaction_id'] = utf8_decode((string)$req->get_bptid());
                        $success = TRUE;
                          return false;
                    }
                    else
                    {
                        if ($req->get_status() == 'DENIED') 
                        {
                            $_SESSION['billpay_hide_payment_method'] = TRUE;
                        }

                        if ($this->testmode == true) 
                          {
                              $redirMessage = utf8_decode("HAENDLER: " . $req->get_merchant_error_message() . "KUNDE: " . $req->get_customer_error_message() . "ERROR CODE: " . $req->get_error_code());
                          }
                          else
                          {
                              $redirMessage = utf8_decode($req->get_customer_error_message());
                          }
                          $x = zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . htmlentities(htmlspecialchars(substr($redirMessage, 1))), 'SSL');
                          
                          
                          //$y = zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . htmlentities(str_replace('&', 'UND', $redirMessage)), 'SSL');
                          
                          //$y=substr($redirMessage, 0, 10);
                          
                          $this->_logError($x, 'REDIRECT');
                          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . $redirMessage, 'SSL'));
                          //zen_redirect(zen_output_string_protected($x));
                        // zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . $y, 'SSL'));
                    }
                }
                catch(Exception $e) {
                    $this->_logError($e->getMessage(), 'TRY ERROR request send');
                    $success = FALSE;
                    $redirMessage = MODULE_PAYMENT_BILLPAY_TEXT_ERROR_DEFAULT;
                    $logMessage = MODULE_PAYMENT_BILLPAY_TEXT_ERROR_DEFAULT;
                }
    
                if ($success == TRUE) 
                {
                    if ($req->get_status() == 'DENIED') {
                        $hidePayment = TRUE;
                    }
                    
                    if (!$req->has_error()) {
                        $_SESSION['billpay_transaction_id'] = utf8_decode(urlencode((string)$req->get_bptid()));
                      }
                      else 
                      {
                          $success = FALSE;
                          if ($this->testmode == true) 
                          {
                              $redirMessage = utf8_decode(urlencode("HAENDLER: " . $req->get_merchant_error_message() . "KUNDE: " . $req->get_customer_error_message() . "ERROR CODE: " . $req->get_error_code()));
                          }
                          else
                          {
                              $redirMessage = utf8_decode(urlencode($req->get_customer_error_message()));
                          }
                          
                          $logMessage = $this->_errorMessage($req->get_error_code(), $req->get_merchant_error_message(), $req->get_customer_error_message());
                      }
                      return false;
                }
                else {
                    $hidePayment = TRUE;
                }
                
                if ($hidePayment == TRUE) {
                    $_SESSION['billpay_hide_payment_method'] = TRUE;
                }
                
                if ($success == FALSE) {
                    $this->_logError($logMessage, 'QUERY ERROR Vorauthorisierung');
                    // redirect to previous page
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                     'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ERROR_DEFAULT)), 'SSL'));
                }
            } // endif active 
          
    
        } //endif post method billpay
    }
    
    function confirmation()
    {
        return false;
    }
    
    function process_button()
    {
        return false;
    }

    function before_process() {
            global $order;
            
        if ($this->_getTransactionId()) 
        {    
            
            // include capture lib
            require_once(DIR_WS_INCLUDES . 'billpay/api/ipl_capture_request.php');

            // capture order
            $req = new ipl_capture_request($this->api_url);
            $req->set_default_params($this->bp_merchant, $this->bp_portal, $this->bp_secure);
            
            $billpay_shipping_cost = $order->info['shipping_cost'];

            if(isset($_SESSION['billpay_fee_cost']))
                {
                $billpay_fee_cost = $_SESSION['billpay_fee_cost'];
                }
                else
                {
                $billpay_fee_cost = 0;
                }
            if(isset($_SESSION['billpay_fee_tax']))
            {
                $billpay_fee_tax = $_SESSION['billpay_fee_tax'];
            }
            else
            {
                $billpay_fee_tax = 0;
            }
            
            $billpay_shipping = $this->_calculate_shipping_cost();
            $_totalAmount = $this->_currencyToSmallerUnit($this->_calculateCartSum() + $this->_calculateCartTax() + $billpay_shipping['cost'] + $billpay_shipping['tax'] + $billpay_fee_cost + $billpay_fee_tax);

            // This is the transaction ID obtained from the preauthorization response
            $req->set_capture_params(utf8_encode($this->_getTransactionId()),
                                     utf8_encode($_totalAmount),
                                     utf8_encode($this->_getCurrency()),
                                     utf8_encode($this->_getTransactionId()),
                                     utf8_encode($this->_getCustomerId()));

            try 
            {                         
                $req->send();
                
                if($req->has_error()) 
                {                    
                    $_xmlreq = (string)utf8_decode($req->get_request_xml());
                    $_xmlresp = (string)utf8_decode($req->get_response_xml());
                    $this->_logError($_xmlreq, 'before process has error XML request capture');
                    $this->_logError($_xmlresp, 'before process has error XML response capture');
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                     'error_message=' . utf8_decode($req->get_customer_error_message()), 'SSL'));
                    $success = false;
                }
            }
            catch(Exception $e) {
                $_xmlreq = (string)utf8_decode($req->get_request_xml());
                $_xmlresp = (string)utf8_decode($req->get_response_xml());
                $this->_logError($_xmlreq, 'before process exception XML request capture');
                $this->_logError($_xmlresp, 'before process exception XML response capture');                
                $this->_logError($e->getMessage(), 'after process capture Request SEND Exception');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                 'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ERROR_DEFAULT)), 'SSL'));
            }
            
            if (!empty($this->enableLog)) 
            {
                $_xmlreq = (string)utf8_decode($req->get_request_xml());
                $_xmlresp = (string)utf8_decode($req->get_response_xml());
                $this->_logError($_xmlreq, 'XML request capture'. $req->has_error());
                $this->_logError($_xmlresp, 'XML response capture');
            }
            
            if (!$req->has_error()) 
            {
                try 
                {    
                    $this->db->Execute('INSERT INTO billpay_bankdata (tx_id, account_holder, account_number, bank_code, bank_name, invoice_reference, api_reference_id, shipping_class) VALUES '.
                                    '("'.$this->_getTransactionId().'", '.
                                    '"'.$req->get_account_holder().'", '.
                                    '"'.$req->get_account_number().'", '.
                                    '"'.$req->get_bank_code().'", '.
                                    '"'.$req->get_bank_name().'", '.
                                    '"'.$req->get_invoice_reference().'", '.
                                    '"'.$this->_getTransactionId().'", '.    
                                    '"'.$billpay_shipping[0].'")');    
                }
                catch(Exception $e) {
                    $this->_logError($e->getMessage(), 'after process capture Request DATABASE Exception');
                    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                 'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ERROR_DEFAULT)), 'SSL'));
                }
            }
            else 
            {
                if (!empty($this->enableLog)) 
                {
                    $this->_logError($this->_errorMessage($req->get_error_code(),
                                                           $req->get_merchant_error_message(),
                                                           $req->get_customer_error_message()
                                                           )
                                 , 'before process Capture Request has error');
                }                 
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,
                                 'error_message=' . utf8_decode(urlencode(MODULE_PAYMENT_BILLPAY_TEXT_ERROR_BOD)), 'SSL'));
            }
        }
        else 
        {
            $this->_logError('Transaction ID not found in session', 'ERROR in before_process');
        }    
    }
    
    function after_process() {
        global $insert_id;

        if ($this->order_status) 
        {
            $this->db->Execute("UPDATE ".TABLE_ORDERS." SET orders_status='".$this->order_status."' WHERE orders_id='".$insert_id."'");
        }
        
        if ($this->_getTransactionId()) 
        {
            require_once(DIR_WS_INCLUDES . 'billpay/api/ipl_update_order_request.php');
            $req = new ipl_update_order_request($this->api_url);
            $req->set_default_params($this->bp_merchant, $this->bp_portal, $this->bp_secure);
            $req->set_update_params($this->_getTransactionId(), $insert_id);
            $success = TRUE;
            try 
            {
                $req->send();
            }
            catch(Exception $e) 
            {
                $this->_logError($e->getMessage(), 'WARNING: Error sending update order request. Must use tx_id as api reference');
                $success = FALSE;
            }
            $this->_logError($req->get_request_xml(), 'update order request XML');
            $this->_logError($req->get_response_xml(), 'update order response XML');            
            if (!$req->has_error() && $success) 
            {
                // update order id and api reference id
                $this->db->Execute("UPDATE billpay_bankdata SET api_reference_id='" . $insert_id . "', orders_id = " . $insert_id . ", invoice_reference = '" . $insert_id . "' WHERE tx_id='".$this->_getTransactionId()."'");
            }
            else 
            {
                // update only order id (txid will be used as reference for api and as invoice reference)
                $this->db->Execute("UPDATE billpay_bankdata SET orders_id = " . $insert_id . " WHERE tx_id='".$this->_getTransactionId()."'");
                $this->_logError($req->get_error_code(), 'ERROR code returned when sending update order request');
            }
        }
        else 
        {
            $this->_logError('Transaction ID not found in session', 'ERROR in after_process');
        }
        
        // cleanup session data
        if (!empty($_SESSION['billpay'])) 
        {
            unset($_SESSION['billpay']);
        }
    }
    
    function output_error() {
      return false;
    }
function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BILLPAY_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }
#######################################

    function _getTransactionId()
    {
        if (!empty($_SESSION['billpay_transaction_id']))
        {
            return $_SESSION['billpay_transaction_id'];
        }
        return ;
    }

    function _setTransactionId($transid = NULL)
    {
        if (!is_null($transid))
        {
            $_SESSION['billpay_transaction_id'] = $transid;

            return $transid;
        }
        return ;
    }

    public function _getCurrency()
    {
        global $order;
        
        // prefer order over session
        if (!empty($order->info['currency']))
        {
            return (string)$order->info['currency'];
        }
        else if (!empty($_SESSION['currency']))
        {
            return (string)$_SESSION['currency'];
        }
        return ;
    }
    
    
    /*
    0: Lastschrift                    |        0: Bezahlt
    1: Kreditkarte                    |        1: Offen
    2: Vorkasse                        |        2: Mahnwesen
    3: Nachnahme                    |        3: Inkasso
    4: Paypal                        |        4: Überbezahlt
    5: Sofortüberweisung/Giropay    |        5: Unterbezahlt
    6: Rechnung                        |        6: Geplatzt
    7: Billpay (Rechnung)
    100: Other
    */
    function _getOrderStatus ($_orderStatus = NULL)
    {
        return 0; // temporary!
        
        if (!is_null($_orderStatus))
        {
            if ($_orderStatus != MODULE_PAYMENT_BILLPAY_ORDER_STATUS)
            {
            }
            else
            {
                return 1;
            }
        }        
    }

    function _getPaymentMethod($_paymentMethod = NULL)
    {
        switch($_paymentMethod)
        {
            case 'moneybookers_elv':
            case 'micropayment_debit':
                return 0;
                break;
            case 'cc':
            case 'moneybookers_cc':
            case 'micropayment_cc':
            case 'worldpay':
                return 1;
                break;
            case 'banktransfer':
            case 'eustandardtransfer':
                    return 2;
                break;
            case 'cod':
                    return 3;
                break;
            case 'paypal':
            case 'paypalexpress':
                    return 4;
                break;
            case 'pn_sofortueberweisung':
            case 'moneybookers_sft':
            case 'moneybookers_giropay':
            case 'giropay':
                    return 5;
                break;
            case 'invoice':
                    return 6;
                break;
            case 'billpay':
                    return 7;
                break;
            default:
                    return 100;
                break;
        }
        
        return 100;
    }
    
    function _currencyToSmallerUnit($price_float = NULL)
    {
        if (!is_null($price_float))
        {
            $_price = $price_float * 100;
            
            return round($_price);
        }
        
        return ;
    }

    function _getPrice($valuePrice, $valueTax, $calculateTax = 1)
    {    
        if($calculateTax == 1)
        {
            if ((!is_null($valuePrice)) && (!is_null($valueTax)))
            {
                $_price = (int)$this->_currencyToSmallerUnit($valuePrice);
                //if(DISPLAY_PRICE_WITH_TAX == true)
                //{
                    $__tax = ((float)$valuePrice / 100) * $valueTax;
                //}
                //else
                //{
                    //$__tax = ((float)$valuePrice / (100 + $valueTax)) * $valueTax;
                //}
                $_tax = $this->_currencyToSmallerUnit($__tax);
                return ($_price + $_tax);
            }
        }
        else
        {
            $_price = (int)$this->_currencyToSmallerUnit($valuePrice);
            return $_price;
        }
        return ;    
    }

    function _getOrderHistory($_customerId = NULL)
    {
        $_return = array();
        
        if (!is_null($_customerId))
        {
            // SQL for order history
            $sqlO = 'SELECT orders_id, date_purchased, payment_method, orders_status, currency 
                            FROM ' . TABLE_ORDERS . ' 
                            WHERE customers_id = ' . $_customerId;
            $_resultOrder = $this->db->Execute($sqlO);
            // SQL for each order total 
            $_sqlTotal = 'SELECT value FROM ' . TABLE_ORDERS_TOTAL . " WHERE class='ot_total' AND orders_id = %s LIMIT 0 , 1";
            
            while (!$_resultOrder->EOF) {
                // fetch order total
                $_queryTotal = $this->db->Execute(sprintf($_sqlTotal, $_resultOrder->fields['orders_id']));
                $_totalAmount = $this->_currencyToSmallerUnit($_queryTotal->fields['value']);

                // assign current order to array
                $_return[] = array(
                'hid' => utf8_encode($_resultOrder->fields['orders_id']),
                'hdate' => utf8_encode($this->_formatDate('Ymd H:i:s', $_resultOrder->fields['date_purchased'])),
                'hamount' => utf8_encode($_totalAmount),
                'hcurrency' => utf8_encode($_resultOrder->fields['currency']),
                'hpaymenttype' => utf8_encode($this->_getPaymentMethod($_resultOrder->fields['payment_method'])),
                'hstatus' => utf8_encode($this->_getOrderStatus($_resultOrder->fields['orders_status']))
                );
                
                // free ressources
                unset($_queryTotal, $_resultTotal, $_totalAmount);
                $_resultOrder->movenext();
            }        
            
        }

        return $_return;
    }

    function _getCustomerIp()
    {
        if (!empty($_SESSION['tracking']['ip']))
        {
            return $_SESSION['tracking']['ip'];
        }
        return ;
    }

    function _getCustomerGender()
    {
        global $order;
        
        if (!empty($_SESSION['customer_gender']))
        {
            return $_SESSION['customer_gender'];
        }
        elseif (!empty($order->customer['gender']))
        {
            return $order->customer['gender'];
        }
        return ;
    }

    function _getCustomerSalutation($customerGender = NULL)
    {
        $_gender = '';
        
        if (!is_null($customerGender))
        {
            $_gender = (string)$customerGender;
        }
        else
        {
            $_gender = $this->_getCustomerGender();
        }

        if (!empty($_gender))
        { 
            switch ($_gender)
            {
                case 'm':
                    return 'Herr';
                    break;
                case 'f':
                    return 'Frau';
                    break;
            }
        }        

        return ;
    }

    function _getCustomerId()
    {
        
        if (!empty($_SESSION['customer_id']))
        {
            return (int)$_SESSION['customer_id'];
        }
        
        return ;
    }

    function _getCustomerGroup()
    {
        if (isset($_SESSION['customers_status']['customers_status_id']))
        {
            // default values
            // 0 = admin, 1 = guest, 2 = new customer, 3 = merchant
            switch($_SESSION['customers_status']['customers_status_id'])
            {
                case '0':
                case '3':
                    return 'e';
                    break;                    
                case '2':
                    return 'n';
                    break;                    
                case '1':
                default: 
                    return 'g';
                    break;                    
            }
        }
        
        return ;
    }
    
    function _getCustomerDob()
    {
        $_custId = $this->_getCustomerId();
        
        if (!empty($_custId))
        {
            $_query = $this->db->Execute('SELECT customers_dob AS dob FROM ' . TABLE_CUSTOMERS . ' WHERE customers_id = ' . $_custId . ' LIMIT 0 , 1');
            $_result = $_query->fields;

            // check if customer have a date of birth
            if ($_result['dob'] != '0000-00-00 00:00:00')
            {
                $_dobCheck = $this->_formatDate('d.m.Y', $_result['dob']);
                
                if (!empty($_dobCheck))
                  {
                      return $_dobCheck;
                  }
            }
        }
        return ;
    }

    function _checkPaymentSelection()
    {
          if ( (!empty($_REQUEST['payment'])) && ($_REQUEST['payment'] === 'billpay'))
          {
              $_return = array();
              
              if ($_REQUEST['billpay_eula'] === 'on')
              {
                  if (!empty($_REQUEST['billpay_dob']))
                  {
                      $_dobCheck = $this->_formatDate('Ymd', $_REQUEST['billpay_dob']);
                      
                      if (!empty($_dobCheck))
                      {
                          return $_dobCheck;
                      }
                  }
                  elseif (!empty($_REQUEST['billpay']['dob']))
                  {
                      if  ( ((int)$_REQUEST['billpay']['dob']['year'] >= $this->_getMinYear())
                          && ((int)$_REQUEST['billpay']['dob']['year'] <= $this->_getMaxYear()) )
                      {
                          $_dobCombined = (int)$_REQUEST['billpay']['dob']['year']
                                          . '-' . (int)$_REQUEST['billpay']['dob']['month']
                                          . '-' . (int)$_REQUEST['billpay']['dob']['day'];
                          
                          $_dobCheck = $this->_formatDate('Ymd', (string)$_dobCombined);

                          if (!empty($_dobCheck))
                          {                              
                              return $_dobCheck;
                          }
                      }
                  }
              }
          }

          return ;
    }

        
    function _formatDate($dateStyle = NULL, $dateString = NULL)
    {
        if ((!is_null($dateStyle)) && (!is_null($dateString)))
        {
            $_checkStamp = strtotime($dateString);
            
            if (($_checkStamp != FALSE) || ($_checkStamp != -1))
            {
                return date($dateStyle, $_checkStamp);            
            }
        }
        
        return ;
    }


    function _getSelectDobDay()
    {
        return $this->_genSelectDob('day', 1, 31, 'asc');
    }
    
    function _getSelectDobMonth()
    {
        return $this->_genSelectDob('month', 1, 12, 'asc');
    }
    
    function _getSelectDobYear()
    {
        return $this->_genSelectDob('year', $this->_getMinYear(), $this->_getMaxYear(), 'desc');
    }

    function _genSelectGender()
    {
        $_selectGender = '<select name="billpay_gender" style="width:90px">';
        if(isset($_SESSION['billpay_gender']) && $_SESSION['billpay_gender'] == "m")
        {
             $_selectGender .= '<option value="m">' . MODULE_PAYMENT_BILLPAY_TEXT_MALE . '</option>';
        }
          else if(isset($_SESSION['billpay_gender']) && $_SESSION['billpay_gender'] == "f")
          {
              $_selectGender .= '<option value="f">' . MODULE_PAYMENT_BILLPAY_TEXT_FEMALE . '</option>';
          }
          $_selectGender .= '<option value="00">---</option>';
        $_selectGender .= '<option value="m">' . MODULE_PAYMENT_BILLPAY_TEXT_MALE . '</option>';
        $_selectGender .= '<option value="f">' . MODULE_PAYMENT_BILLPAY_TEXT_FEMALE . '</option>';
        $_selectGender .= '</select>';
        return $_selectGender;
    }
    
    /*
     *  generate select for birthday
     */
    function _genSelectDob($genName, $genFrom, $genTo, $sortDirection)
    {
        $_selectDob = '<select name="billpay[dob][' . strtolower($genName) . ']" style="width:60px">';
        
           if(isset($_SESSION['billpay_dob_' . $genName]) && $_SESSION['billpay_dob_' . $genName] > 0)
           {
               $_selectDob .= '<option value="'.$_SESSION['billpay_dob_' . $genName].'">'.$_SESSION['billpay_dob_' . $genName].'</option>';
           }
        $_selectDob .= '<option value="00">---</option>';
        
        if ($sortDirection == 'desc') {
            for ($i = $genTo; $i >= $genFrom;) {
                $iMod = sprintf('%02d', (int)$i);
                $_selectDob .= '<option value="' . $iMod . '">&nbsp;&nbsp;' . $iMod . '&nbsp;&nbsp;</option>';
                
                $i--;
            }
        }
        else {
            for ($i = $genFrom; $i <= $genTo;) {
                $iMod = sprintf('%02d', (int)$i);
                $_selectDob .= '<option value="' . $iMod . '">&nbsp;&nbsp;' . $iMod . '&nbsp;&nbsp;</option>';
                
                $i++;
            }
        }
        
        $_selectDob .= '</select>';
        
        return $_selectDob;
    }
    
    
    function _getMinYear()
    {
        return 1910;
    }

    function _getMaxYear()
    {
        return 1993;
    }
    function _calculate_billpay_fee()
    {
        global $order, $currencies;
        $value = 0;
        if(MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE == "fest")
        {
            $value = MODULE_ORDER_TOTAL_BILLPAY_FEE_VALUE;
        }
        else if(MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE == "prozentual")
        {
            $value = round($order->info['total'] / 100 * MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT, 2);
        }
        else if(MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE == "gestaffelt")
        {
            $arr = explode(";", MODULE_ORDER_TOTAL_BILLPAY_FEE_GRADUATE);
            foreach($arr as $val)
            {
                $element = explode("=", $val);
                if($order->info['total'] <= $element[0])
                {
                    $value = $element[1];
                    break;
                }
                $value = $element[1];
            }
        }
        $billpay_fee['cost'] = $value;
        $value = 0;
        $billpay_tax = zen_get_tax_rate(MODULE_ORDER_TOTAL_BILLPAY_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
        $value = zen_calculate_tax($billpay_fee['cost'], $billpay_tax);
        $billpay_fee['tax'] = round($value, 2);
        if(MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE == "prozentual")
        {
            $billpay_fee['formated'] = " ".MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT."% " . MODULE_ORDER_TOTAL_BILLPAY_FEE_FROM_TOTAL;
        }
        else
        {
            $billpay_fee['formated'] =  $currencies->format($billpay_fee['cost'] + $billpay_fee['tax']);
        }
        return $billpay_fee;
    }

    /* calculate low order fee incl. taxes */
    function _calculateLoworderfee($order)
    {
        if (MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE == 'true') 
        {
            switch (MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION) 
            {
                  case 'national':
                    if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
                  case 'international':
                    if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
                  case 'both':
                    $pass = true; break;
                  default:
                    $pass = false; break;
            }

               $billpay = Array();

            if ( ($pass == true) && ( ($order->info['total'] - $order->info['shipping_cost']) < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) 
            {
                $tax = zen_get_tax_rate(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
                
                  $billpay_loworder = array();

                if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 1) 
                {
                      $billpay_loworder['fee'] = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
                      $billpay_loworder['tax'] = zen_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
                      return $billpay_loworder;
                }
                else if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 0 && $_SESSION['customers_status']['customers_status_add_tax_ot'] == 1) 
                {
                      $billpay_loworder['fee'] = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
                      $billpay_loworder['tax'] = zen_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
                      return $billpay_loworder;
                }
                else if(!isset($_SESSION['customers_status']['customers_status_show_price_tax']))
                {
                    $billpay_loworder['fee'] = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
                      $billpay_loworder['tax'] = zen_calculate_tax(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, $tax);
                      return $billpay_loworder;
                }
                else if ($_SESSION['customers_status']['customers_status_show_price_tax'] == 0 && $_SESSION['customers_status']['customers_status_add_tax_ot'] != 1) 
                {
                      $billpay_loworder['fee'] = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
                      $billpay_loworder['tax'] = 0;
                      return $billpay_loworder;
                }

            }
            else
            {
                return false;
            }
        }
    }

    /** calculate tax sum of current shopping cart */
    function _calculateCartTax($products = NULL)
    {
        global $order;
        
        if(!isset($products))
            $products = $order->products;
        
        $tax_sum = 0;
        foreach ($order->products as $product)
        {
            $__tax = (((float)$product['final_price'] / (100)) * $product['tax']) * $product['qty'];
            $tax_sum += $__tax;
            $__tax = 0;
        }
        return $tax_sum;
    }
        
    /** calculate sum of current shopping cart */
    function _calculateCartSum($products = NULL)
    {
        global $order;
        if(!isset($products))
            $products = $order->products;

        $sum = 0;
        foreach ($order->products as $product)
        {
            $sum += ((float)$product['price'] * $product['qty']);
        }
        return $sum;
    }
    
    function _calculate_shipping_cost()
    {
        global $order; 
        if(DISPLAY_PRICE_WITH_TAX == "false")
        {
            $billpay_shipping = explode("_", $_SESSION['shipping']['id']);
                        
            if(defined('MODULE_SHIPPING_'.strtoupper($billpay_shipping[0]).'_TAX_CLASS'))
            {
                $tax_class = constant('MODULE_SHIPPING_'.strtoupper($billpay_shipping[0]).'_TAX_CLASS');
                $shipping_tax = zen_get_tax_rate($tax_class, 
                                                    $order->delivery['country']['id'], 
                                                        $order->delivery['zone_id']);
                $billpay_shipping['cost'] = round(zen_add_tax($order->info['shipping_cost'], $shipping_tax), 2);
                $billpay_shipping['tax'] = zen_calculate_tax($order->info['shipping_cost'], $shipping_tax);
            }
            else
            {
                $billpay_shipping['cost'] = $order->info['shipping_cost'];
                $billpay_shipping['tax'] = 0;
            }
        }
        else
        {
            $billpay_shipping['cost'] = $order->info['shipping_cost'];
            $billpay_shipping['tax'] = 0;
        }
        return $billpay_shipping;    
    }
    
    function _errorMessage($_code, $_msgMerchant, $_msgCustomer)  {
        $_errorTpl  =    'Code: '             . "\t\t" . '%s' . "\n";
        $_errorTpl .=    'Merchant MSG: '     . "\t\t" . '%s' . "\n";
        $_errorTpl .=    'Customer MSG: '     . "\t\t" . '%s'    . "\n";
        
        $_errorMsg = sprintf($_errorTpl,
                             (string)utf8_decode($_code),
                             (string)utf8_decode($_msgMerchant),
                             (string)utf8_decode($_msgCustomer)
                             );

        return $_errorMsg;
    }

    function _logError($logMessage, $logType = NULL)
    {
        $_write = FALSE;
        
        if ((!empty($this->_logPath)) && (is_writable($this->_logPath)) && $this->enableLog)
        {
            $_data = 'LOG BEGINS:' . "\t" . date('r') . "\n\n";
            $_data .= '------------------< '. strtoupper($logType) . ' >------------------';
            $_data .= "\n\n" . $logMessage; 
            $_data .= "\n\n" . '------------------< EOF >------------------' . "\n\n";
            
            if ((function_exists('version_compare')) && (version_compare(PHP_VERSION, '5.0.0', '>=')))
            {
                $_write = file_put_contents($this->_logPath, $_data, FILE_APPEND);
            }
            else // PHP4 workaround
            {
                $handle = fopen($this->_logPath, 'a');

                if (fwrite($handle, $_data) != FALSE) 
                {
                    $_write = TRUE;
                }
                
                fclose($handle);
            }
        }
        return $_write;
    }


#######################################
    function install()
    {
      // make sure we get a clean state
      $this->remove();
      // install new configuration
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Aktiviert', 'MODULE_PAYMENT_BILLPAY_STATUS', 'True', 'M&ouml;chten Sie den Rechnungskauf mit Billpay erlauben?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('    Logging aktiviert', 'MODULE_PAYMENT_BILLPAY_LOGGING_ENABLE', 'True', 'Sollen Anfragen an die Billpay-Zahlungsschnittstelle in die Logdatei geschrieben werden?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaktionsmodus', 'MODULE_PAYMENT_BILLPAY_TESTMODE', 'Testmodus', 'Im Testmodus werden detailierte Fehlermeldungen angezeigt. F&uuml;r den Produktivbetrieb muss der Livemodus aktiviert werden.', '6', '0', 'zen_cfg_select_option(array(\'Testmodus\', \'Livemodus\'), ', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Absoluter Pfad zur Logdatei', 'MODULE_PAYMENT_BILLPAY_LOGGING', '', 'Wenn kein Wert eingestellt ist, wird standardm&auml;ssig in das Verzeichnis includes/billpay/log geschrieben (Schreibrechte m&uuml;ssen verf&uuml;gbar sein).', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Bestellstatus festlegen', 'MODULE_PAYMENT_BILLPAY_ORDER_STATUS', '0', '', '6', '0', 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses( ', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Erlaubte Zonen', 'MODULE_PAYMENT_BILLPAY_ALLOWED', 'all', '',   '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Anzeigereihenfolge', 'MODULE_PAYMENT_BILLPAY_SORT_ORDER', '10', 'Reihenfolge der Anzeige. Kleinste Ziffer wird zuerst angezeigt.', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Verkäufer ID', 'MODULE_PAYMENT_BILLPAY_MERCHANT_ID', '0', 'Diese Daten erhalten Sie von Billpay', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Portal ID', 'MODULE_PAYMENT_BILLPAY_PORTAL_ID', '0', 'Diese Daten erhalten Sie von Billpay', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Security Key', 'MODULE_PAYMENT_BILLPAY_SECURE', '0', 'Diese Daten erhalten Sie von Billpay', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mindestbestellwert', 'MODULE_PAYMENT_BILLPAY_MIN_AMOUNT', '10', 'Ab diesem Bestellwert wird die Zahlungsart eingeblendet.', '6', '0', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API url base', 'MODULE_PAYMENT_BILLPAY_API_URL_BASE', 'https://test-api.billpay.de/xml', 'Diese Daten erhalten Sie von Billpay (Achtung! Die URLs f&uuml; das Test- bzw. das Livesystem unterscheiden sich!)', '6', '0', now())");
      
      
      
      // r.l. nirgendwo verwendet
      //$this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('BILLPAY_ID', 'MODULE_PAYMENT_BILLPAY_ID', 'ShopID', '', '6', '0', now())");
      // r.l. nirgendwo verwendet 
      //$this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('A02 SHIPPING TAX', 'MODULE_PAYMENT_BILLPAY_SHIPPING_TAX', '', '',  '6', '0', now())");
      
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Steuerzone', 'MODULE_PAYMENT_BILLPAY_ZONE', '0', '', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes( ', now())");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('mysql-Zahlungstabelle', 'MODULE_PAYMENT_BILLPAY_TABLE', 'payment_billpay', '', '6', '0', now())");
     // $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('MODULE_PAYMENT_BILLPAY_ORDER_STATUS_CANCELLED', '10001', '6', '0', now())");      

      
      // aktiviert in TABLE_ORDERS_STATUS eintragen
      $res = $this->db->Execute('SELECT max(orders_status_id) + 1 AS nextId FROM ' . TABLE_ORDERS_STATUS);
      $nextId = $res->fields['nextId'];
      $this->db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES (" . $nextId . ", '1', 'Billpay Zahlungsziel aktiviert')");
      $this->db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES ('" . $nextId . "', '43', 'Billpay Zahlungsziel aktiviert')");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('aktiviert', 'MODULE_PAYMENT_BILLPAY_STATUS_ACTIVATED', '" . $nextId . "', '6', '0', now())");
      // storniert in TABLE_ORDERS_STATUS eintragen
      $res = $this->db->Execute('SELECT max(orders_status_id) + 1 AS nextId FROM ' . TABLE_ORDERS_STATUS);
      $nextId = $res->fields['nextId'];
      $this->db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES (" . $nextId . ", '1', 'Billpay Bestellung storniert')");
      $this->db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) VALUES ('" . $nextId . "', '43', 'Billpay Bestellung storniert')");
      $this->db->Execute('INSERT INTO ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) values ('canceled', 'MODULE_PAYMENT_BILLPAY_STATUS_CANCELLED', '" . $nextId . "', '6', '0', now())");
      
      
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Länder', 'MODULE_PAYMENT_BILLPAY_COUNTRIES', 'DE', 'Länderliste, kommagetrennt', '6', '1', now());");      
      // create billpay data table
      $this->db->Execute("CREATE TABLE IF NOT EXISTS `billpay_bankdata` (`api_reference_id` varchar(64) NOT NULL, `account_holder` varchar(100) NOT NULL, `account_number` varchar(50) NOT NULL, `bank_code` varchar(50) NOT NULL, `bank_name` varchar(100) NOT NULL, `invoice_reference` varchar(256) NOT NULL, `invoice_due_date` varchar(9) default NULL, `tx_id` varchar(64) NOT NULL, `orders_id` int(11) unsigned default NULL, `shipping_class` VARCHAR(64) NULL)");
      
     
     // try to initialize logging path and file
      /*if (!file_exists(dirname($this->_logPath)))
      {
          // create path
          $_createPath = mkdir(dirname($this->_logPath, 0777, TRUE));
          
          // on success, init logfile
          if (!empty($_createPath))
          {
              $this->_logError(date('r') . ': LOG INITIATED ON INSTALL' , 'LOG INIT');
          }
      }*/
      
    }

    function remove() {
      $this->db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      $sql = "DELETE FROM " . TABLE_ORDERS_STATUS  . " WHERE orders_status_name LIKE 'billpay%'";
      $this->db->Execute($sql);
    }

    function keys()
    {
        return array(   'MODULE_PAYMENT_BILLPAY_STATUS',
                        'MODULE_PAYMENT_BILLPAY_LOGGING_ENABLE',
                        'MODULE_PAYMENT_BILLPAY_TESTMODE',
                        'MODULE_PAYMENT_BILLPAY_LOGGING',
                        'MODULE_PAYMENT_BILLPAY_ORDER_STATUS',
                        'MODULE_PAYMENT_BILLPAY_ALLOWED',
                        //'MODULE_PAYMENT_BILLPAY_ID',
                        //'MODULE_PAYMENT_BILLPAY_SHIPPING_TAX',
                         'MODULE_PAYMENT_BILLPAY_ZONE',
                         'MODULE_PAYMENT_BILLPAY_TABLE',
                         'MODULE_PAYMENT_BILLPAY_STATUS_ACTIVATED',
                         'MODULE_PAYMENT_BILLPAY_STATUS_CANCELLED',
                        'MODULE_PAYMENT_BILLPAY_SORT_ORDER',
                        'MODULE_PAYMENT_BILLPAY_MERCHANT_ID',
                        'MODULE_PAYMENT_BILLPAY_PORTAL_ID',
                        'MODULE_PAYMENT_BILLPAY_SECURE',
                        'MODULE_PAYMENT_BILLPAY_MIN_AMOUNT',
                        'MODULE_PAYMENT_BILLPAY_API_URL_BASE',
                        'MODULE_PAYMENT_BILLPAY_COUNTRIES'
        );
    }
    
    function getModuleConfig() {
        unset($config);
        unset($_SESSION['billpay_module_config']);
        $config = $_SESSION['billpay_module_config'];
        
        if (isset($config)) {
            if ($config == false) {
                $this->_logError('Fetching module config failed previously. Billpay payment not available.');
                return $config;
            }
            else {
                return $config;
            }    
        }
        else {
            require_once(DIR_WS_INCLUDES . 'billpay/api/ipl_module_config_request.php');
            
            $req = new ipl_module_config_request($this->api_url);
            $req->set_default_params($this->bp_merchant, $this->bp_portal, $this->bp_secure);
            
            try {
                $req->send();

                if ($req->has_error()) {
                    $config = false;
                    
                    $this->_logError($req->get_merchant_error_message() . '(Error code: ' . $req->get_error_code() . ')', 'Error fetching module config');
                }
                else {
                    $config = array();
                    $config['static_limit'] = $req->get_static_limit();
                
                    $this->_logError('Static limit: ' . $config['static_limit'], 'Module configuration received');
                }
            }
            catch (Exception $e) {
                $this->_logError($e->getMessage(), 'Exception occured when sending module config request');
         
                  $config = false;
            }
            
            if ($config) {
                $this->_logError($req->get_request_xml(), 'XML request ModuleConfig');
                $this->_logError($req->get_response_xml(), 'XML response ModuleConfig');
            }
            
            $_SESSION['billpay_module_config'] = $config;
            
            return $config;
        }
    }

} // end billpay ;-)
