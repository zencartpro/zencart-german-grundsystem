<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2003 Jason LeBaron
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: linkpoint_api.php 4775 2006-10-17 06:47:38Z drbyte $
 */
  if (!defined('TABLE_LINKPOINT_API')) define('TABLE_LINKPOINT_API', DB_PREFIX . 'linkpoint_api');
  //define('MODULE_PAYMENT_LINKPOINT_API_CODE_DEBUG' ,'debug');

class linkpoint_api {
  var $code, $title, $description, $enabled;

  // class constructor
  function linkpoint_api() {
    global $order, $messageStack;
    $this->code = 'linkpoint_api';
    if ($_GET['main_page'] != '' && !IS_ADMIN_FLAG === true) {
      $this->title = MODULE_PAYMENT_LINKPOINT_API_TEXT_CATALOG_TITLE; // Payment module title in Catalog
    } else {
      $this->title = MODULE_PAYMENT_LINKPOINT_API_TEXT_ADMIN_TITLE; // Payment module title in Admin
      if (!function_exists('curl_init')) $messageStack->add_session(MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR_CURL_NOT_FOUND, 'error');
    }
    $this->description = MODULE_PAYMENT_LINKPOINT_API_TEXT_DESCRIPTION;  // Descriptive Info about module in Admin
    $this->enabled = ((MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True') ? true : false); // Whether the module is installed or not
    $this->sort_order = MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER; // Sort Order of this payment option on the customer payment page
    $this->form_action_url = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false); // Page to go to upon submitting page info

    if ((int)MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID;
    }
    if (MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE == 'Authorize Only' && (int)MODULE_PAYMENT_LINKPOINT_API_PREAUTH_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_LINKPOINT_API_PREAUTH_ORDER_STATUS_ID;
    }

    if (is_object($order)) $this->update_status();

    $this->code_debug = (MODULE_PAYMENT_LINKPOINT_API_CODE_DEBUG=='debug') ? true : false;

    // set error messages if misconfigured
    if (MODULE_PAYMENT_LINKPOINT_API_STATUS == 'True') {
      if (MODULE_PAYMENT_LINKPOINT_API_LOGIN == 'EnterYourStoreNumber') {
        $this->title .= MODULE_PAYMENT_LINKPOINT_API_TEXT_NOT_CONFIGURED;
      } elseif (MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE != 'LIVE: Production') {
        $this->title .= MODULE_PAYMENT_LINKPOINT_API_TEXT_TEST_MODE;
      }
    }
  }


  // class methods

  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_LINKPOINT_API_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_LINKPOINT_API_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
    // if in code-debug mode and IP address is in the down-for-maint list, enable the module (leaves it invisible to non-testers)
    if (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])) {
      if ($this->code_debug) $this->enabled=true;
    }
  }

  // Validate the credit card information via javascript (Number, Owner, and CVV Lengths)
  function javascript_validation() {
    $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
          '    var cc_owner = document.checkout_payment.linkpoint_api_cc_owner.value;' . "\n" .
          '    var cc_number = document.checkout_payment.linkpoint_api_cc_number.value;' . "\n" .
          '         var cc_cvv = document.checkout_payment.linkpoint_api_cc_cvv.value;' . "\n" .
          '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
          '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_OWNER . '";' . "\n" .
          '      error = 1;' . "\n" .
          '    }' . "\n" .
          '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
          '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_NUMBER . '";' . "\n" .
          '      error = 1;' . "\n" .
          '    }' . "\n" .
          '         if (cc_cvv == "" || cc_cvv.length < "3") {' . "\n".
          '           error_message = error_message + "' . MODULE_PAYMENT_LINKPOINT_API_TEXT_JS_CC_CVV . '";' . "\n" .
          '           error = 1;' . "\n" .
          '         }' . "\n" .
          '  }' . "\n";

    return $js;
  }

  // Display Credit Card Information Submission Fields on the Checkout Payment Page
  function selection() {
    global $order;

    for ($i=1; $i<13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i=$today['year']; $i < $today['year']+10; $i++) {
      $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }
    $selection = array('id' => $this->code,
                       'module' => $this->title,
                       'fields' => array(array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_OWNER,
                                               'field' => zen_draw_input_field('linkpoint_api_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                         array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER,
                                               'field' => zen_draw_input_field('linkpoint_api_cc_number')),
                                         array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES,
                                               'field' => zen_draw_pull_down_menu('linkpoint_api_cc_expires_month', $expires_month) . '&nbsp;' . zen_draw_pull_down_menu('linkpoint_api_cc_expires_year', $expires_year)),
                                         array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CVV . ' ' .'<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . MODULE_PAYMENT_LINKPOINT_API_TEXT_POPUP_CVV_LINK . '</a>',
                                               'field' => zen_draw_input_field('linkpoint_api_cc_cvv', '', 'size="4" maxlength="4"'))));

    return $selection;
  }


  // Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
  function pre_confirmation_check() {
    global $db, $messageStack;

    include(DIR_WS_CLASSES . 'cc_validation.php');

    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($_POST['linkpoint_api_cc_number'], $_POST['linkpoint_api_cc_expires_month'], $_POST['linkpoint_api_cc_expires_year'], $_POST['linkpoint_api_cc_cvv']);
    $error = '';
    switch ($result) {
      case -1:
        $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
        break;
      case -2:
      case -3:
      case -4:
        $error = TEXT_CCVAL_ERROR_INVALID_DATE;
        break;
      case false:
        $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
        break;
    }

// save errors which occur during checkout_payment validation phase but haven't been sent to gateway yet
    if ( ($result == false) || ($result < 1) ) {
      $payment_error_return = 'payment_error=' . $this->code ;
      $error_info2 = '&error=' . urlencode($error) . '&linkpoint_api_cc_owner=' . urlencode($_POST['linkpoint_api_cc_owner']) . '&linkpoint_api_cc_expires_month=' . $_POST['linkpoint_api_cc_expires_month'] . '&linkpoint_api_cc_expires_year=' . $_POST['linkpoint_api_cc_expires_year'];
      $messageStack->add_session('checkout_payment', $error . '<!-- ['.$this->code.'] -->', 'error');

      if (MODULE_PAYMENT_LINKPOINT_API_STORE_DATA == 'True') {
        $cc_type = $cc_validation->cc_type;
        $cc_number_clean = $cc_validation->cc_number;
        $cc_expiry_month = $_POST['linkpoint_api_cc_expires_month'];
        $cc_expiry_year = $_POST['linkpoint_api_cc_expires_year'];
        $error_returned = $payment_error_return . $error_info2;

        $cc_number = (strlen($cc_number_clean) > 8) ? substr($cc_number_clean, 0, 4) . str_repeat('X', (strlen($cc_number_clean) - 8)) . substr($cc_number_clean, -4) : substr($cc_number_clean, 0, 3) . '**short**';
  
        while (strstr($error_returned, '%3A')) $error_returned = str_replace('%3A', ' ', $error_returned);
        while (strstr($error_returned, '%2C')) $error_returned = str_replace('%2C', ' ', $error_returned);
        while (strstr($error_returned, '+')) $error_returned = str_replace('+', ' ', $error_returned);
        $error_returned = str_replace('&', ' &amp;', $error_returned);
        $cust_info =  $error_returned;
  
        $message = addslashes($message);
        $cust_info = addslashes($cust_info);
        $all_response_info = addslashes($all_response_info);


    //  Create array of responses for database storage
        $lp_response_array = array(
              'lp_trans_num' => '',
              'zen_order_id' => 0,
              'approval_code' => 'N/A',
              'transaction_response_time' => 'N/A',
              'r_error' => '**CC Info Failed Validation during pre-processing**',
              'customer_id' => $_SESSION['customer_id'] ,
              'avs_response' => 'FAIL',
              'transaction_result' => '*CUSTOMER ERROR*',
              'message' => $message . ' -- ' . $all_response_info , 
              'transaction_time' => "now()",
              'transaction_reference_number' => '',
              'fraud_score' => 0, // NOTE: This could be set differently .... TBD
              'cc_number' => $cc_number,
              'cust_info' => $cust_info,
              'chargetotal' => 0,
              'cc_expire' => $cc_month . '/' . $cc_year,
              'date_added' => "now()"  );

        zen_db_perform(TABLE_LINKPOINT_API, $lp_response_array );
      }
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
    }

    // if no error, continue with validated data:
    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
    $this->cc_expiry_month = $cc_validation->cc_expiry_month;
    $this->cc_expiry_year = $cc_validation->cc_expiry_year;
  }

  // Display Credit Card Information on the Checkout Confirmation Page
  function confirmation() {
    global $_POST;

    $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                          'fields' => array(array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_OWNER,
                                                  'field' => $_POST['linkpoint_api_cc_owner']),
                                            array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_NUMBER,
                                                  'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                            array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_CREDIT_CARD_EXPIRES,
                                                  'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['linkpoint_api_cc_expires_month'], 1, '20' . $_POST['linkpoint_api_cc_expires_year'])))));

    return $confirmation;
  }

  function process_button() {
    global $_POST;
    // These are hidden fields on the checkout confirmation page
    $process_button_string = zen_draw_hidden_field('cc_owner', $_POST['linkpoint_api_cc_owner']) .
                             zen_draw_hidden_field('cc_expires', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                             zen_draw_hidden_field('cc_expires_month', $this->cc_expiry_month) .
                             zen_draw_hidden_field('cc_expires_year', substr($this->cc_expiry_year, -2)) .
                             zen_draw_hidden_field('cc_type', $this->cc_card_type) .
                             zen_draw_hidden_field('cc_number', $this->cc_card_number) .
                             zen_draw_hidden_field('cc_cvv', $_POST['linkpoint_api_cc_cvv']);
    $process_button_string .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

    return $process_button_string;
  }

// Prepare and submit the authorization to the gateway
  function before_process() {
    global $_POST, $_SERVER, $order, $db, $messageStack, $lp_avs, $lp_trans_num;

    // Create a unique order id
    $oid = zen_create_random_value(16, 'digits'); // Create a UID for the order

    include(DIR_WS_MODULES . 'payment/linkpoint_api/class.linkpoint_api.php');
    $mylphp = new lphp;

    // Build Info to send to Gateway

    if (MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE == 'DevelopersTest') {
      $myorder["host"]     = "staging.linkpt.net";
    } else {
      $myorder["host"]     = "secure.linkpt.net";
    }
    $myorder["port"]       = "1129";
    $myorder["keyfile"]    =(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/linkpoint_api/' . MODULE_PAYMENT_LINKPOINT_API_LOGIN . '.pem');
    $myorder["configfile"] = MODULE_PAYMENT_LINKPOINT_API_LOGIN;        // This is your store number

    $myorder["ordertype"]  = (MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE == 'Authorize Only' ? 'PREAUTH': 'SALE');

    switch (MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE) {
      case "LIVE: Production"   : $myorder["result"] = "LIVE"; break;
      case "TESTING: Successful": $myorder["result"] = "GOOD"; break;
      case "TESTING: Decline"   : $myorder["result"] = "DECLINE"; break;
      case "TESTING: Duplicate" : $myorder["result"] = "DUPLICATE"; break;
    }

    // "transactionorigin" - For credit card retail txns, set to RETAIL, for Mail order/telephone order, set to MOTO, for e-commerce, leave out or set to ECI
    $myorder["transactionorigin"] = "ECI";

    // "terminaltype" - Set terminaltype to POS for an electronic cash register or integrated POS system, STANDALONE for a point-of-sale credit card terminal, UNATTENDED for a self-service station, or UNSPECIFIED for e-commerce or other applications
    $myorder["terminaltype"]      = "UNSPECIFIED";

    // "oid" - Order ID number must be unique. If not set, gateway will assign one.
    $myorder["oid"]               = "";
    $myorder["ip"]                = $_SERVER['REMOTE_ADDR'];

    //  $myorder["ponumber"]    = "";
    //  $myorder["subtotal"]    = $order->info['subtotal'];
    //  $myorder["tax"]         = $order->info['tax'];
    //  $myorder["shipping"]    = $order->info['shipping_cost'];
    $myorder["chargetotal"] = $order->info['total'];

    // CARD INFO
    $myorder["cardnumber"]   = $_POST['cc_number'];
    $myorder["cardexpmonth"] = $_POST['cc_expires_month'];
    $myorder["cardexpyear"]  = $_POST['cc_expires_year'];
    $myorder["cvmindicator"] = "provided";
    $myorder["cvmvalue"]     = $_POST['cc_cvv'];
    //$myorder["track"]     = '';

    // BILLING INFO
    $myorder["name"]     = htmlentities($order->billing['firstname'] . ' ' . $order->billing['lastname']);
    $myorder["company"]  = htmlentities($order->billing['company']);
    $myorder["address1"] = htmlentities($order->billing['street_address']);
    $myorder["address2"] = htmlentities($order->billing['suburb']);
    $myorder["city"]     = $order->billing['city'];
    $myorder["state"]    = $order->billing['state'];
    $myorder["country"]  = $order->billing['country']['iso_code_2'];
    $myorder["phone"]    = $order->customer['telephone'];
    $myorder["email"]    = $order->customer['email_address'];
    $myorder["addrnum"]  = $order->billing['street_address'];   // Required for AVS. If not provided, transactions will downgrade.
    $myorder["zip"]      = $order->billing['postcode']; // Required for AVS. If not provided, transactions will downgrade.

    // SHIPPING INFO
    $myorder["sname"]     = htmlentities($order->delivery['firstname'] . ' ' . $order->delivery['lastname']);
    $myorder["saddress1"] = htmlentities($order->delivery['street_address']);
    $myorder["saddress2"] = htmlentities($order->delivery['suburb']);
    $myorder["scity"]     = $order->delivery['city'];
    $myorder["sstate"]    = $order->delivery['state'];
    $myorder["szip"]      = $order->delivery['postcode'];
    $myorder["scountry"]  = $order->delivery['country']['iso_code_2'];

    // MISC
    //  $myorder["comments"] = "(things like: )Repeat customer. Ship immediately.";


    // debug - for testing communication only
    if (MODULE_PAYMENT_LINKPOINT_API_DEBUG == 'True' && strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])) {
      $myorder["debugging"] = "true";  // for development only - not intended for production use
      $myorder["debug"]     = "true";  // for development only - not intended for production use
      $myorder["webspace"]  = "true";  // for development only - not intended for production use
    }

    // Send transaction, using cURL
    $result = $mylphp->curl_process($myorder);
    if (trim($result) == '<r_approved>FAILURE</r_approved><r_error>Could not connect.</r_error>' || !is_array($result)) {
      $messageStack->add_session('checkout_payment', MODULE_PAYMENT_LINKPOINT_API_TEXT_FAILURE_MESSAGE, 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
    }

// PARSE Results
    $all_response_info = '';
    foreach($result as $key=>$value) {
      $all_response_info .= ' ' .$key . '='.$value;
    }
    if ($this->code_debug) $messageStack->add_session('header', $all_response_info, 'caution');

    $chargetotal = $myorder["chargetotal"];

// prepare transaction info
    $cust_info = '';
    $cc_number = substr($myorder["cardnumber"], 0, 4) . str_repeat('X', (strlen($myorder["cardnumber"]) - 8)) . substr($myorder["cardnumber"], -4);
    foreach($myorder as $key=>$value) {
      if ($key != 'cardnumber') {
        if ($key == 'cardexpmonth') {
          $cc_month = $value;
        }
        if ($key == 'cardexpyear') {
          $cc_year = $value;
        }
        $cust_info .= ' ' .$key . '=' . $value . ';';
      } else {
        $cust_info .= ' ' .$key . '='.$cc_number . ';';
      }
    }

    // store first and last 4 digits of CC number
    $order->info['cc_number'] = substr($myorder["cardnumber"], 0, 4) . str_repeat('X', (strlen($myorder["cardnumber"]) - 8)) . substr($myorder["cardnumber"], -4);
//    // store only last 4 digits of CC number
//    $order->info['cc_number'] = str_pad(substr($_POST['cc_number'], -4), strlen($_POST['cc_number']), "X", STR_PAD_LEFT);
    // only store full number in debug mode:
    if ($this->code_debug) $order->info['cc_number'] = $_POST['cc_number'];

    $order->info['cc_expires'] = $_POST['cc_expires'];
    $order->info['cc_type'] = $_POST['cc_type'];
    $order->info['cc_owner'] = $_POST['cc_owner'];
    $order->info['cc_cvv'] = '***'; // $_POST['cc_cvv'];


    $lp_trans_num = $result['r_ordernum'];
    $transaction_tax = $result['r_tax']; // The calculated tax for the order, when the ordertype is calctax.
    $transaction_shipping = $result['r_shipping']; // The calculated shipping charges for the order, when the ordertype is calcshipping.
    $this->response_codes = $result['r_avs']; // AVS Response for transaction

// these are used to update the order-status-history upon order completion
  $this->transaction_id = $result['r_ordernum'];
  $this->auth_code = $result['r_code']; // The approval code for this transaction.



//  Create arrays of responses for database storage
  $lp_response_array = array(
              'lp_trans_num' => $result['r_ordernum'], // The order number associated with this transaction.
              'zen_order_id' => (int)$order_number,
              'approval_code' => $result['r_code'], // The approval code for this transaction.
              'transaction_response_time' => $result['r_time'], // The time and date of the transaction server response.
              'r_error' => $result['r_error'],
              'customer_id' => $_SESSION['customer_id'] ,
              'avs_response' => $result['r_avs'], // AVS Response for transaction
              'transaction_result' => $result['r_approved'], // The result of the transaction, which may be APPROVED, DECLINED, or FRAUD.
              'message' => $result['r_message'] . ' -- ' . $all_response_info , // Any message returned by the processor; e.g., CALL VOICE CENTER.
              'transaction_time' => $result['r_tdate'], // A server time-date stamp for this transaction.
              'transaction_reference_number' => $result['r_ref'], // The reference number returned by the credit card processor.
              'fraud_score' => (int)$result['r_score'], // LinkShield fraud risk score.
              'cc_number' => $cc_number,
              'cust_info' => $cust_info,
              'chargetotal' => $chargetotal,
              'cc_expire' => $cc_month . '/' . $cc_year,
              'date_added' => "now()"  );
    if (MODULE_PAYMENT_LINKPOINT_API_STORE_DATA == 'True') {
      zen_db_perform(TABLE_LINKPOINT_API, $lp_response_array);
    }


  //  Begin check of specific error conditions
    if ($result["r_approved"] != "APPROVED") {
      if (substr($result['r_error'],0,10) == 'SGS-020005') $messageStack->add_session('checkout_payment', $result['r_error'], 'error');  // Error (Merchant config file is missing, empty or cannot be read)
      if (substr($result['r_error'],0,10) == 'SGS-005000') $messageStack->add_session('checkout_payment', MODULE_PAYMENT_LINKPOINT_API_TEXT_GENERAL_ERROR . '<br />' . $result['r_error'], 'error'); // The server encountered a database error
    }
  //  End specific error conditions

  //  Begin Transaction Status does not equal APPROVED
    if ($result["r_approved"] != "APPROVED") {
      $messageStack->add_session('checkout_payment', MODULE_PAYMENT_LINKPOINT_API_TEXT_DECLINED_MESSAGE, 'caution');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
    }
  //  End Transaction Status does not equal APPROVED

    // Possible Fraud order. Allow transaction to process, but notify shop for owner to take appropriate action on order
    if (($result["r_approved"] == "APPROVED") && (substr($result['r_code'], 17, 2) != "YY")  && MODULE_PAYMENT_LINKPOINT_API_FRAUD_ALERT == 'Yes') {
      //DEBUG: $messageStack->add_session('header', 'possible fraud situation--> ' . $result['r_code'], 'caution');
      $message = 'Potential Fraudulent Order - Action Required' . "\n" .
                 'This alert occurs because the "Approval Code" below does not contain the expected YY response.'. "\n\n" .
                 'Customer Name: ' . $order->customer['firstname'] . ' ' . $order->customer['lastname'] . "\n\n" .
                 'AVS Result: ' . $result['r_avs'] . "\n\n" .
                 'Order Number: ' . $lp_trans_num . "\n\n" .
                 'Error Message: ' . $result['r_error'] . "\n\n" .
                 'Transaction Result: ' . $result['r_approved'] . "\n\n" .
                 'Approval Code: ' . $result['r_code'] . "\n\n" .
                 'Message: ' . $result['r_message'] . "\n\n" .
                 'Transaction Date and Time: ' . $result['r_time'] . "\n\n" .
                 'Reference Number: ' . $result['r_ref'] . "\n\n" .
                 'Fraud Score: ' . $result['r_score'] . "\n\n";
      $html_msg['EMAIL_MESSAGE_HTML'] = nl2br($result['r_message']);
      zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, 'Potential Fraudulent Order - Action Required', $message, STORE_NAME, EMAIL_FROM, $html_msg);
    }
  // end fraud alert
  }

  function after_process() {
    global $insert_id, $db;
    $comments = (MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE == 'Authorize Only' ? ALERT_LINKPOINT_API_PREAUTH_TRANS : '');

    switch (MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE) {
      case "LIVE: Production": $comments .= ''; break;
      case "TESTING: Successful": $comments .= ' ' . ALERT_LINKPOINT_API_TEST_FORCED_SUCCESSFUL; break;
      case "TESTING: Decline": $comments .= ' ' . ALERT_LINKPOINT_API_TEST_FORCED_DECLINED; break;
    }

    $db->Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (comments, orders_id, orders_status_id, date_added) values ('Credit Card payment.  " . $comments . " " . $this->cc_card_type . " AUTH: " . $this->auth_code . ". TransID: " . $this->transaction_id . ".' , '". (int)$insert_id . "','" . $this->order_status . "', now() )");
    return false;
  }

  function after_order_create($zf_order_id) {
    global $db, $lp_avs, $lp_trans_num;
    $db->execute("update "  . TABLE_ORDERS . " set lp_avs ='" . $lp_avs . "' where orders_id = '" . $zf_order_id ."'");
    $db->execute("update "  . TABLE_ORDERS . " set lp_trans_num ='" . $lp_trans_num . "' where orders_id = '" . $zf_order_id ."'");
    $db->execute("update "  . TABLE_LINKPOINT_API . " set zen_order_id ='" . $zf_order_id . "' where lp_trans_num = '" . $lp_trans_num ."'");
  }

   function admin_notification($zf_order_id) {
     global $db;
     if (MODULE_PAYMENT_LINKPOINT_API_STORE_DATA=='False') return '';
     $output = '';
     $sql = "select * from " . TABLE_LINKPOINT_API . " where zen_order_id = '" . $zf_order_id . "'";
     $lp_api = $db->Execute($sql);
     if ($lp_api->RecordCount() > 0) require(DIR_FS_CATALOG. DIR_WS_MODULES . 'payment/linkpoint_api/linkpoint_api_admin_notification.php');
     return $output;
   }

  function get_error() {
    global $_GET;

    $error = array('title' => MODULE_PAYMENT_LINKPOINT_API_TEXT_ERROR,
                   'error' => stripslashes(urldecode($_GET['error'])));

    return $error;
  }

  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_LINKPOINT_API_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }

  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Linkpoint Module', 'MODULE_PAYMENT_LINKPOINT_API_STATUS', 'True', 'Do you want to accept Linkpoint credit card payments?', '6', 121, 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Linkpoint/YourPay Merchant ID', 'MODULE_PAYMENT_LINKPOINT_API_LOGIN', 'EnterYourStoreNumber', 'Please enter your Linkpoint/YourPay Merchant ID.<br />This is the same as the number in the PEM digital certificate filename for your account.', '6', 121, now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('LinkPoint Transaction Mode Response', 'MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE', 'LIVE: Production', '<strong>Production:</strong> Use this for live stores.<br />or, select these options if you wish to test the module:<br /><strong>Successful:</strong> Use to TEST by forcing a Successful transaction<br /><strong>Decline:</strong> Use to TEST forcing a Failed transaction', '6', 121, 'zen_cfg_select_option(array(\'LIVE: Production\', \'TESTING: Successful\', \'TESTING: Decline\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authorization Type', 'MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE', 'Authorize Only', 'Do you want submitted credit card transactions to be authorized only, or immediately charged/captured?<br />In most cases you will want to do an <strong>Immediate Charge</strong> to capture payment immediately. In some situations, you may prefer to simply <strong>Authorize</strong> transactions, and then manually use your Merchant Terminal to formally capture the payments (esp if payment amounts may fluctuate between placing the order and shipping it)', '6', 121, 'zen_cfg_select_option(array(\'Authorize Only\', \'Immediate Charge/Capture\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID', 2, 'Set the status of orders made with this payment module to this value<br />(this affects all Captured / Charged / Approved orders)<br />Recommended: <strong>Processing</strong>', '6', 121, 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('PREAUTH Order Status', 'MODULE_PAYMENT_LINKPOINT_API_PREAUTH_ORDER_STATUS_ID', 1, 'When this module is set to PREAUTH mode (Authorization), which order-status do you want the purchase to be set to?<br />Recommended: <strong>Pending</strong>', '6', 121, 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER', '0', 'Any value greater than zero will cause this payment method to appear in the specified sort order on the checkout-payment page.', '6', 121, now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_LINKPOINT_API_ZONE', '0', 'If you want only customers from a particular zone to be able to use this payment module, select that zone here.', '6', 121, 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Fraud Alerts', 'MODULE_PAYMENT_LINKPOINT_API_FRAUD_ALERT', 'Yes', 'Do you want to be notified by email of suspected fraudulent Credit Card activity?<br />(sends to Store Owner Email Address)', '6', 121, 'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Database Storage', 'MODULE_PAYMENT_LINKPOINT_API_STORE_DATA', 'False', 'If you enable this option, extended details of each transaction will be stored, enabling you to more effectively conduct audits of fraudulent activity or even track/match order information between Zen Cart and your LinkPoint records. You can view this data in Admin->Customers->Linkpoint CC Review.', '6', 121, 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Communications Check Mode', 'MODULE_PAYMENT_LINKPOINT_API_DEBUG', 'False', '<strong>Do not enable this unless asked to by tech support. </strong>This advanced programmer testing mode will display large amounts of communication information on your checkout pages, and will prevent successful checkouts.', '6', 121, 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE', 'Production', 'Transaction mode used for processing orders', '6', 121, 'zen_cfg_select_option(array(\'Production\',\'DevelopersTest\'), ', now())");

    // Now do database-setup:
    global $sniffer;
    if (!$sniffer->table_exists(TABLE_LINKPOINT_API)) {
      $sql = "CREATE TABLE " . TABLE_LINKPOINT_API . " (
                  id int(11) unsigned NOT NULL auto_increment,
                  customer_id varchar(11) NOT NULL default '',
                  lp_trans_num varchar(64) NOT NULL default '',
                  zen_order_id int(11) NOT NULL default '0',
                  avs_response varchar(4) NOT NULL default '',
                  r_error varchar(250) NOT NULL default '',
                  approval_code varchar(254) NOT NULL default '',
                  transaction_result varchar(25) NOT NULL default '',
                  message text NOT NULL,
                  transaction_response_time varchar(25) NOT NULL default '',
                  transaction_time varchar(50) NOT NULL default '',
                  transaction_reference_number varchar(64) NOT NULL default '',
                  fraud_score int(11) NOT NULL default '0',
                  cc_number varchar(20) NOT NULL default '',
                  cc_expire varchar(12) NOT NULL default '',
                  cust_info text NOT NULL,
                  chargetotal decimal(15,4) NOT NULL default '0.0000',
                  date_added datetime NOT NULL default '0001-01-01 00:00:00',
                  PRIMARY KEY  (id),
                  KEY idx_customer_id_zen (customer_id)     )";
      $db->Execute($sql);
    } else {
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'customer_id')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD customer_id varchar(11) NOT NULL default '' after id");
      if ($sniffer->field_exists(TABLE_LINKPOINT_API, 'lp_order_id'))  $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " CHANGE COLUMN lp_order_id lp_trans_num varchar(64) NOT NULL default ''");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'r_error'))     $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD r_error varchar(250) NOT NULL default '' after avs_response");
      if ($sniffer->field_exists(TABLE_LINKPOINT_API, 'approval_code')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " CHANGE COLUMN approval_code approval_code varchar(254) NOT NULL default ''");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'transaction_result')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD transaction_result varchar(25) NOT NULL default '' after approval_code");
      if ($sniffer->field_exists(TABLE_LINKPOINT_API, 'message'))      $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " CHANGE COLUMN message message text NOT NULL");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'transaction_response_time')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD transaction_response_time varchar(25) NOT NULL default '' after message");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'transaction_time')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD transaction_time varchar(50) NOT NULL default '' after transaction_response_time");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'transaction_reference_number')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD transaction_reference_number varchar(64) NOT NULL default '' after transaction_time");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'fraud_score')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD fraud_score int(11) NOT NULL default '0' after transaction_reference_number");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'cc_number'))   $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD cc_number varchar(20) NOT NULL default '' after fraud_score");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'cc_expire'))   $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD cc_expire varchar(12) NOT NULL default '' after cc_number");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'cust_info'))   $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD cust_info text NOT NULL after cc_expire");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'chargetotal')) $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD chargetotal decimal(15,4) NOT NULL default '0.0000' after cust_info");
      if (!$sniffer->field_exists(TABLE_LINKPOINT_API, 'date_added'))  $db->Execute("ALTER TABLE " . TABLE_LINKPOINT_API . " ADD date_added datetime NOT NULL default '0001-01-01 00:00:00' after chargetotal");
    }

    if (!$sniffer->field_exists(TABLE_ORDERS, 'lp_avs')) {
      $sql = "ALTER TABLE " . TABLE_ORDERS . " ADD lp_avs VARCHAR( 25 ) NOT NULL DEFAULT ''";
      $db->Execute($sql);
    }
    if (!$sniffer->field_exists(TABLE_ORDERS, 'lp_trans_num')) {
      $sql = "ALTER TABLE " . TABLE_ORDERS . " ADD lp_trans_num int(11) NOT NULL DEFAULT 0";
      $db->Execute($sql);
    }
  }

  function remove() {
    global $db, $sniffer;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE_PAYMENT_LINKPOINT_API_%'");
    // cleanup database if contains no data
    if ($sniffer->table_exists(TABLE_LINKPOINT_API)) {
      $result = $db->Execute("select count(id) as count from " . TABLE_LINKPOINT_API);
      if ($result->RecordCount() == 0) $db->Execute("DROP TABLE " . TABLE_LINKPOINT_API);
    }
  }

  function keys() {
    $keys_list = array(
      'MODULE_PAYMENT_LINKPOINT_API_STATUS',
      'MODULE_PAYMENT_LINKPOINT_API_LOGIN',
      'MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE_RESPONSE',
      'MODULE_PAYMENT_LINKPOINT_API_AUTHORIZATION_MODE',
      'MODULE_PAYMENT_LINKPOINT_API_ORDER_STATUS_ID',
      'MODULE_PAYMENT_LINKPOINT_API_PREAUTH_ORDER_STATUS_ID',
      'MODULE_PAYMENT_LINKPOINT_API_SORT_ORDER',
      'MODULE_PAYMENT_LINKPOINT_API_ZONE',
      'MODULE_PAYMENT_LINKPOINT_API_FRAUD_ALERT',
      'MODULE_PAYMENT_LINKPOINT_API_STORE_DATA'  );
    if (isset($_GET['debug']) && $_GET['debug']=='on' && IS_ADMIN_FLAG === true) $keys_list[]='MODULE_PAYMENT_LINKPOINT_API_DEBUG';
    if (isset($_GET['debug']) && $_GET['debug']=='on' && IS_ADMIN_FLAG === true && MODULE_PAYMENT_LINKPOINT_API_CODE_DEBUG=='debug') $keys_list[]='MODULE_PAYMENT_LINKPOINT_API_TRANSACTION_MODE';
    return $keys_list;
  }
}
?>