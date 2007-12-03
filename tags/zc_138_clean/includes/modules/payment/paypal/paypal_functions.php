<?php
/**
 * functions used by payment module class for Paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal_functions.php 7195 2007-10-06 14:29:44Z drbyte $
 */

// Functions for paypal processing
  function datetime_to_sql_format($paypalDateTime) {
    //Copyright (c) 2004 DevosC.com
    $months = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05',  'Jun' => '06',  'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12');
    $hour = substr($paypalDateTime, 0, 2);$minute = substr($paypalDateTime, 3, 2);$second = substr($paypalDateTime, 6, 2);
    $month = $months[substr($paypalDateTime, 9, 3)];
    $day = (strlen($day = preg_replace("/,/" , '' , substr($paypalDateTime, 13, 2))) < 2) ? '0'.$day: $day;
    $year = substr($paypalDateTime, -8, 4);
    if (strlen($day)<2) $day = '0'.$day;
    return ($year . "-" . $month . "-" . $day . " " . $hour . ":" . $minute . ":" . $second);
  }

  function ipn_debug_email($message, $email_address = '', $always_send = false, $subjecttext = 'IPN DEBUG message') {
    static $paypal_error_counter;
    static $paypal_instance_id;
    if ($email_address == '') $email_address = (defined('MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS') ? MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS : STORE_OWNER_EMAIL_ADDRESS);
    if(!isset($paypal_error_counter)) $paypal_error_counter = 0;
    if(!isset($paypal_instance_id)) $paypal_instance_id = time() . '_' . zen_create_random_value(4);
    if ((defined('MODULE_PAYMENT_PAYPALWPP_DEBUGGING') && MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email') || (defined('MODULE_PAYMENT_PAYPAL_IPN_DEBUG') && MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log and Email') || $always_send) {
      $paypal_error_counter ++;
      zen_mail(STORE_OWNER, $email_address, $subjecttext . ' (' . $paypal_instance_id . ') #' . $paypal_error_counter, $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>$message), 'debug');
    }
    if ((defined('MODULE_PAYMENT_PAYPAL_IPN_DEBUG') && (MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log and Email' || MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log File' || MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Yes')) || (defined('MODULE_PAYMENT_PAYPALWPP_DEBUGGING') && (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email'))) ipn_add_error_log($message, $paypal_instance_id);
  }

  function ipn_get_stored_session($session_stuff) {
    global $db;
    if (!is_array($session_stuff)) {
      ipn_debug_email('IPN FATAL ERROR :: Could not find custom variable in POST, cannot re-create session as PayPal IPN transaction.');
      return false;
    }
    $sql = "SELECT *
            FROM " . TABLE_PAYPAL_SESSION . "
            WHERE session_id = :sessionID";
    $sql = $db->bindVars($sql, ':sessionID', $session_stuff[1], 'string');
    $stored_session = $db->Execute($sql);
    if ($stored_session->recordCount() < 1) {
      ipn_debug_email('IPN FATAL ERROR :: Could not find stored session in DB, cannot re-create session as PayPal IPN transaction.');
      return false;
    }
    $_SESSION = unserialize(base64_decode($stored_session->fields['saved_session']));
    return true;
  }
/**
 * look up parent/original transaction record data and return matching order info if found, along with txn_type
 */
  function ipn_lookup_transaction($postArray) {
    global $db;
    // find Zen Cart order number from the transactionID in the IPN
    $useTable = TABLE_PAYPAL;
    if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') $useTable = TABLE_PAYPAL_TESTING;
    $ordersID = 0;
    $paypalipnID = 0;
    $transType = 'unknown';

    $sql = "SELECT order_id, paypal_ipn_id, payment_status, txn_type, pending_reason
                FROM " . $useTable . "
                WHERE txn_id = :transactionID
                ORDER BY order_id DESC  ";
    $sql1 = $db->bindVars($sql, ':transactionID', $postArray['parent_txn_id'], 'string');
    $sql2 = $db->bindVars($sql, ':transactionID', $postArray['txn_id'], 'string');
    if (isset($postArray['parent_txn_id']) && trim($postArray['parent_txn_id']) != '') {
      $ipn_id = $db->Execute($sql1);
      if($ipn_id->RecordCount() > 0) {
        ipn_debug_email('IPN NOTICE :: This transaction HAS a parent record. Thus this is an update of some sort.');
        $transType = 'parent';
        $ordersID = $ipn_id->fields['order_id'];
        $paypalipnID = $ipn_id->fields['paypal_ipn_id'];
      }
    } else {
      $ipn_id = $db->Execute($sql2);
      if ($ipn_id->RecordCount() <= 0) {
        ipn_debug_email('IPN NOTICE :: Could not find matched txn_id record in DB. Therefore is new to us. ');
        $transType = 'unique';
      } else {
        while(!$ipn_id->EOF) {
          switch ($ipn_id->fields['pending_reason']) {
            case 'address':
              ipn_debug_email('IPN NOTICE :: Found pending-address record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-address';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-address';
              if ($postArray['payment_status'] == 'Pending')   $transType = 'pending-address';
            break;
            case 'multi_currency':
              ipn_debug_email('IPN NOTICE :: Found pending-multicurrency record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-multicurrency';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-multicurrency';
              if ($postArray['payment_status'] == 'Pending')   $transType = 'pending-multicurrency';
            break;
            case 'echeck':
              ipn_debug_email('IPN NOTICE :: Found pending-echeck record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-echeck';
              if ($postArray['payment_status'] == 'Completed' && $postArray['txn_type'] == 'web_accept') $transType = 'cleared-echeck';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-echeck';
              if ($postArray['payment_status'] == 'Failed')    $transType = 'failed-echeck';
              if ($postArray['payment_status'] == 'Pending')   $transType = 'pending-echeck';
            break;
            case 'authorization':
              ipn_debug_email('IPN NOTICE :: Found pending-authorization record in database');
              $transType = 'cleared-authorization';
              if ($postArray['payment_status'] == 'Voided') $transType = 'voided';
              if ($postArray['payment_status'] == 'Pending') $transType = 'pending-authorization';
              if ($postArray['payment_status'] == 'Captured') $transType = 'captured';
            break;
            case 'verify':
              ipn_debug_email('IPN NOTICE :: Found pending-verify record in database');
              $transType = 'cleared-verify';
            break;
            case 'intl':
              ipn_debug_email('IPN NOTICE :: Found pending-intl record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-intl';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-intl';
              if ($postArray['payment_status'] == 'Pending')   $transType = 'pending-intl';
            break;
            case 'unilateral':
              ipn_debug_email('IPN NOTICE :: Found record in database.' . "\n" . '*** NOTE: TRANSACTION IS IN *unilateral* STATUS pending creation of a PayPal account for this receiver_email address.' . "\n" . 'Please create the account, or make sure the account is *Verified*.');
              $transType = 'pending-unilateral';
            break;
          }
          if ($transType != 'unknown') {
            $ordersID = $ipn_id->fields['order_id'];
            $paypalipnID = $ipn_id->fields['paypal_ipn_id'];
          }
          $ipn_id->MoveNext();
        }
      }
    }
    return array('order_id' => $ordersID, 'paypal_ipn_id' => $paypalipnID, 'txn_type' => $transType);
  }
/**
 * IPN Validation
 * - match email addresses 
 * - ensure that "VERIFIED" has been returned (otherwise somebody is trying to spoof)
 */
  function ipn_validate_transaction($info, $postArray, $mode='IPN') {
    if ($mode == 'IPN' && !eregi("VERIFIED",$info)) {
      ipn_debug_email('IPN WARNING :: Transaction was not marked as VERIFIED. Keep this report for potential use in fraud investigations.' . "\n" . 'IPN Info = ' . "\n" . $info);
      return false;
    } elseif ($mode == 'PDT' && (!eregi("SUCCESS", $info) || eregi("FAIL", $info))) {
      ipn_debug_email('IPN WARNING :: PDT Transaction was not marked as SUCCESS. Keep this report for potential use in fraud investigations.' . "\n" . 'IPN Info = ' . "\n" . $info);
      return false;
    }
    $ppBusEmail = false;
    $ppRecEmail = false;
    if (defined('MODULE_PAYMENT_PAYPAL_BUSINESS_ID')) {
      if (strtolower(trim($postArray['business'])) == strtolower(trim(MODULE_PAYMENT_PAYPAL_BUSINESS_ID))) $ppBusEmail = true;
      if (strtolower(trim($postArray['receiver_email'])) == strtolower(trim(MODULE_PAYMENT_PAYPAL_BUSINESS_ID))) $ppRecEmail = true;
      if (!$ppBusEmail && !$ppRecEmail) {
        ipn_debug_email('IPN WARNING :: Transaction email address NOT matched.' . "\n" . 'From IPN = ' . $postArray['business'] . ' | ' . $postArray['receiver_email'] . "\n" . 'From CONFIG = ' .  MODULE_PAYMENT_PAYPAL_BUSINESS_ID);
        return false;
      }
      ipn_debug_email('IPN INFO :: Transaction email details.' . "\n" . 'From IPN = ' . $postArray['business'] . ' | ' . $postArray['receiver_email'] . "\n" . 'From CONFIG = ' .  MODULE_PAYMENT_PAYPAL_BUSINESS_ID);
    }
    return true;
  }

  // determine acceptable currencies
  function select_pp_currency() {
    if (MODULE_PAYMENT_PAYPAL_CURRENCY == 'Selected Currency') {
      $my_currency = $_SESSION['currency'];
    } else {
      $my_currency = substr(MODULE_PAYMENT_PAYPAL_CURRENCY, 5);
    }
    $pp_currencies = array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD', 'CHF', 'CZK', 'DKK', 'HKD', 'HUF', 'NOK', 'NZD', 'PLN', 'SEK', 'SGD', 'THB');
    if (!in_array($my_currency, $pp_currencies)) {
      $my_currency = 'USD';
    }
    return $my_currency;
  }

  function valid_payment($amount, $currency, $mode = 'IPN') {
    global $currencies;
    $my_currency = select_pp_currency();
    $exchanged_amount = ($mode == 'IPN' ? ($amount * $currencies->get_value($my_currency)) : $amount);
    $transaction_amount = preg_replace('/[^0-9.]/', '', number_format($exchanged_amount, $currencies->get_decimal_places($my_currency), '.', ''));
    if ( ($_POST['mc_currency'] != $my_currency) || ($_POST['mc_gross'] != $transaction_amount && $_POST['mc_gross'] != -0.01) && MODULE_PAYMENT_PAYPAL_TESTING != 'Test' ) {
      ipn_debug_email('IPN WARNING :: Currency/Amount Mismatch.  Details: ' . "\n" . 'PayPal email address = ' . $_POST['business'] . "\n" . ' | mc_currency = ' . $_POST['mc_currency'] . "\n" . ' | submitted_currency = ' . $my_currency . "\n" . ' | order_currency = ' . $currency . "\n" . ' | mc_gross = ' . $_POST['mc_gross'] . "\n" . ' | converted_amount = ' . $transaction_amount . "\n" . ' | order_amount = ' . $amount );
      return false;
    }
    ipn_debug_email('IPN INFO :: Currency/Amount Details: ' . "\n" . 'PayPal email address = ' . $_POST['business'] . "\n" . ' | mc_currency = ' . $_POST['mc_currency'] . "\n" . ' | submitted_currency = ' . $my_currency . "\n" . ' | order_currency = ' . $currency . "\n" . ' | mc_gross = ' . $_POST['mc_gross'] . "\n" . ' | converted_amount = ' . $transaction_amount . "\n" . ' | order_amount = ' . $amount );
    return true;
  }

/**
 *  is this an existing transaction?
 *    (1) we find a matching record in the "paypal" table
 *    (2) we check for valid txn_types or payment_status such as Denied, Refunded, Partially-Refunded, Reversed, Voided, Expired
 * @TODO -- this section is not complete yet
 */
  function ipn_determine_txn_type($postArray, $txn_type = 'unknown') {
    global $db;
    if (substr($txn_type,0,8) == 'cleared-') return $txn_type;
    if ($postArray['txn_type'] == 'send_money') return $postArray['txn_type'];
    if ($postArray['txn_type'] == 'express_checkout' || $postArray['txn_type'] == 'cart') $txn_type = $postArray['txn_type'];
// if it's not unique or linked to a parent, then:
// 1. could be an e-check denied / cleared
// 2. could be an express-checkout "pending" transaction which has been Accepted in the merchant's PayPal console and needs activation in Zen Cart
    if ($postArray['payment_status']=='Completed' && txn_type=='express_checkout' && $postArray['payment_type']=='echeck') {
      $txn_type = 'express-checkout-cleared';
      return $txn_type;
    }
    if ($postArray['payment_status']=='Completed' && $postArray['payment_type']=='echeck') {
      $txn_type = 'echeck-cleared';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Denied' || $postArray['payment_status']=='Failed') && $postArray['payment_type']=='echeck') {
      $txn_type = 'echeck-denied';
      return $txn_type;
    }
    if ($postArray['payment_status']=='Denied') {
      $txn_type = 'denied';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='echeck') {
      $txn_type = 'pending-echeck';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='address') {
      $txn_type = 'pending-address';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='intl') {
      $txn_type = 'pending-intl';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='multi_currency') {
      $txn_type = 'pending-multicurrency';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='verify') {
      $txn_type = 'pending-verify';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Voided') && $postArray['payment_type']=='instant') {
      $txn_type = 'voided';
      return $txn_type;
    }
    return $txn_type;
  }
/**
 * Create order record from IPN data
 */
  function ipn_create_order_array($new_order_id, $txn_type) {
    $sql_data_array = array('order_id' => $new_order_id,
                          'txn_type' => $txn_type,
                          'module_name' => 'paypal (ipn-handler)',
                          'module_mode' => 'IPN',
                          'reason_code' => $_POST['reason_code'],
                          'payment_type' => $_POST['payment_type'],
                          'payment_status' => $_POST['payment_status'],
                          'pending_reason' => $_POST['pending_reason'],
                          'invoice' => $_POST['invoice'],
                          'mc_currency' => $_POST['mc_currency'],
                          'first_name' => $_POST['first_name'],
                          'last_name' => $_POST['last_name'],
                          'payer_business_name' => $_POST['payer_business_name'],
                          'address_name' => $_POST['address_name'],
                          'address_street' => $_POST['address_street'],
                          'address_city' => $_POST['address_city'],
                          'address_state' => $_POST['address_state'],
                          'address_zip' => $_POST['address_zip'],
                          'address_country' => $_POST['address_country'],
                          'address_status' => $_POST['address_status'],
                          'payer_email' => $_POST['payer_email'],
                          'payer_id' => $_POST['payer_id'],
                          'payer_status' => $_POST['payer_status'],
                          'payment_date' => datetime_to_sql_format($_POST['payment_date']),
                          'business' => $_POST['business'],
                          'receiver_email' => $_POST['receiver_email'],
                          'receiver_id' => $_POST['receiver_id'],
                          'txn_id' => $_POST['txn_id'],
                          'parent_txn_id' => $_POST['parent_txn_id'],
                          'num_cart_items' => $_POST['num_cart_items'],
                          'mc_gross' => $_POST['mc_gross'],
                          'mc_fee' => $_POST['mc_fee'],
                          'settle_amount' => $_POST['settle_amount'],
                          'settle_currency' => $_POST['settle_currency'],
                          'exchange_rate' => $_POST['exchange_rate'],
                          'notify_version' => $_POST['notify_version'],
                          'verify_sign' => $_POST['verify_sign'],
                          'date_added' => 'now()',
                          'memo' => $_POST['memo']
                         );
    return $sql_data_array;
  }
/**
 * Create order-history record from IPN data
 */
  function ipn_create_order_history_array($insert_id) {
    $sql_data_array = array ('paypal_ipn_id' => $insert_id,
                                   'txn_id' => $_POST['txn_id'],
                                   'parent_txn_id' => $_POST['parent_txn_id'],
                                   'payment_status' => $_POST['payment_status'],
                                   'pending_reason' => $_POST['pending_reason'],
                                   'date_added' => 'now()'
                                  );
    return $sql_data_array;
  }
/**
 * Create order-update from IPN data
 */
  function ipn_create_order_update_array($txn_type) {
    $sql_data_array = array('payment_type' => $_POST['payment_type'],
                          'txn_type' => $txn_type,
                          'parent_txn_id' => $_POST['parent_txn_id'],
                          'payment_status' => $_POST['payment_status'],
                          'pending_reason' => $_POST['pending_reason'],
                          'payer_email' => $_POST['payer_email'],
                          'payer_id' => $_POST['payer_id'],
                          'business' => $_POST['business'],
                          'receiver_email' => $_POST['receiver_email'],
                          'receiver_id' => $_POST['receiver_id'],
                          'notify_version' => $_POST['notify_version'],
                          'verify_sign' => $_POST['verify_sign'],
                          'last_modified' => 'now()'
                         );
    if (isset($_POST['payer_business_name']) && $_POST['payer_business_name'] != '') $sql_data_array = array_merge($sql_data_array, 
                    array('payer_business_name' => $_POST['payer_business_name']));
    if (isset($_POST['address_name']) && $_POST['address_name'] != '') $sql_data_array = array_merge($sql_data_array, 
                    array('address_name' => $_POST['address_name'],
                          'address_street' => $_POST['addrss_street'],
                          'address_city' => $_POST['address_city'],
                          'address_state' => $_POST['address_state'],
                          'address_zip' => $_POST['address_zip'],
                          'address_country' => $_POST['address_country']));
    if (isset($_POST['reason_code']) && $_POST['reason_code'] != '') $sql_data_array = array_merge($sql_data_array, array('reason_code' => $_POST['reason_code']));
    if (isset($_POST['invoice']) && $_POST['invoice'] != '') $sql_data_array = array_merge($sql_data_array, array('invoice' => $_POST['invoice']));
    if (isset($_POST['mc_gross']) && $_POST['mc_gross'] > 0) $sql_data_array = array_merge($sql_data_array, array('mc_gross' => $_POST['mc_gross']));
    if (isset($_POST['mc_fee']) && $_POST['mc_fee'] > 0) $sql_data_array = array_merge($sql_data_array, array('mc_fee' => $_POST['mc_fee']));
    if (isset($_POST['settle_amount']) && $_POST['settle_amount'] > 0) $sql_data_array = array_merge($sql_data_array, array('settle_amount' => $_POST['settle_amount']));
    if (isset($_POST['first_name']) && $_POST['first_name'] != '') $sql_data_array = array_merge($sql_data_array, array('first_name' => $_POST['first_name']));
    if (isset($_POST['last_name']) && $_POST['last_name'] != '') $sql_data_array = array_merge($sql_data_array, array('last_name' => $_POST['last_name']));
    if (isset($_POST['mc_currency']) && $_POST['mc_currency'] != '') $sql_data_array = array_merge($sql_data_array, array('mc_currency' => $_POST['mc_currency']));
    if (isset($_POST['settle_currency']) && $_POST['settle_currency'] != '') $sql_data_array = array_merge($sql_data_array, array('settle_currency' => $_POST['settle_currency']));
    if (isset($_POST['num_cart_items']) && $_POST['num_cart_items'] > 0) $sql_data_array = array_merge($sql_data_array, array('num_cart_items' => $_POST['num_cart_items']));
    if (isset($_POST['exchange_rate']) && $_POST['exchange_rate'] > 0) $sql_data_array = array_merge($sql_data_array, array('exchange_rate' => $_POST['exchange_rate']));
    return $sql_data_array;
  }
/**
 * simulator
 */
  function ipn_simulate_ipn_handler($count) {
    global $db;
    $sql = "select * from " . TABLE_PAYPAL_TESTING . " order by paypal_ipn_id desc limit " . (int)$count;
    $paypal_testing = $db->execute($sql);
    while (!$paypal_testing->EOF) {
      $paypal_fields[] = $paypal_testing->fields;
      $paypal_testing->moveNext();
    }
    $paypal_fields = array_reverse($paypal_fields);
    foreach ($paypal_fields as $value) {
      foreach($value as $i=>$v) {
        $postdata .= $i . "=" . urlencode(stripslashes($v)) . "&";
      }
      $address = HTTP_SERVER . DIR_WS_CATALOG . 'ipn_main_handler.php?' . $postdata;
      $response = ipn_fopen($address);
      echo $response;
    }
  }
/**
 * Debug to file
 */
  function ipn_fopen($filename) {
    $response = '';
    $fp = @fopen($filename,'rb');
    if ($fp) {
      $response = getRequestBodyContents($fp);
      fclose($fp);
    }
    return $response;
  }
  function getRequestBodyContents(&$handle) {
    if ($handle) {
      while(!feof($handle)) {
        $line .= @fgets($handle, 1024);
      }
      return $line;
    }
    return false;
  }
/**
 * Verify IPN by sending it back to PayPal for confirmation
 */
  function ipn_postback($mode = 'IPN') {
    $info = '';
    $header = '';
    $scheme = 'http://';
    //if (ENABLE_SSL == 'true') $scheme = 'https://';
    //Parse url
    $web = parse_url($scheme . (defined('MODULE_PAYMENT_PAYPAL_HANDLER') ? MODULE_PAYMENT_PAYPAL_HANDLER : 'www.paypal.com/cgi-bin/webscr'));
    if (isset($_POST['test_ipn']) && $_POST['test_ipn'] == 1) {
      $web = parse_url($scheme . 'www.sandbox.paypal.com/cgi-bin/webscr');
    }
    //build post string
    $postdata = '';
    $postback = '';
    $postback_array = array();
    foreach($_POST as $key=>$value) {
      $postdata .= $key . "=" . urlencode(stripslashes($value)) . "&";
      $postback .= $key . "=" . urlencode(stripslashes($value)) . "&";
      $postback_array[$key] = $value;
    }
    if ($mode == 'PDT') {
      $postback .= "cmd=_notify-synch";
      $postback .= "&tx=" . $_GET['tx'];
      $postback .= "&at=" . MODULE_PAYMENT_PAYPAL_PDTTOKEN;
      $postback_array['cmd'] = "_notify-sync";
      $postback_array['tx'] = $_GET['tx'];
      $postback_array['at'] = substr(MODULE_PAYMENT_PAYPAL_PDTTOKEN, 0, 5) . '**********' . substr(MODULE_PAYMENT_PAYPAL_PDTTOKEN,-5);
    } elseif ($mode == 'IPN') {
      $postback .= "cmd=_notify-validate";
      $postback_array['cmd'] = "_notify-validate";
    }
    if ($postdata == '=&') {
      ipn_debug_email('IPN FATAL ERROR :: No POST data to process -- Bad IPN data');
      return array('info' => $info, 'postdata' => $postdata );
    }
    $postdata_array = $_POST;
    ksort($postdata_array);

    if ($mode == 'IPN') {
      ipn_debug_email('IPN INFO - POST VARS received (sorted):' . "\n" . stripslashes(urldecode(print_r($postdata_array, true))));
      if (sizeof($postdata_array) == 0) die('Nothing to process. Please return to home page.');
    }
    if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
      $info = "VERIFIED";
      ipn_debug_email('IPN INFO - POST VARS sent back for validation: ' . "\n" . 'TEST MODE.' . "\n" . stripslashes(print_r($postback_array, true)));
    } else {
      //Set the port number
      if($web['scheme'] == "https") {
        $web['port']="443";  $ssl = "ssl://";
      } else {
        $web['port']="80";   $ssl = "";
      }
      $proxy = $web;
      if (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '') {
        $proxy = parse_url($scheme . CURL_PROXY_SERVER_DETAILS);
        $ssl = ($ssl == '') ? 'http://' : $ssl;
      }

      //Post Data
      if (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '') {
        $header  = "POST " . $ssl . $web[host] . $web[path] . " HTTP/1.1\r\n";
        $header .= "Host: $proxy[host]\r\n";
      } else {
        $header  = "POST $web[path] HTTP/1.1\r\n";
        $header .= "Host: $web[host]\r\n";
      }
      $header .= "Content-type: application/x-www-form-urlencoded\r\n";
      $header .= "Content-length: " . strlen($postback) . "\r\n";
      $header .= "Connection: close\r\n\r\n";

      ipn_debug_email('IPN INFO - POST VARS to be sent back for validation: ' . "\n" . 'To: ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . "\n" . $header . stripslashes(print_r($postback_array, true)));

      //Create paypal connection
      if (MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Yes') {
        $fp=fsockopen($ssl . $proxy['host'], $proxy['port'], $errnum, $errstr, 30);
      } else {
        $fp=@fsockopen($ssl . $proxy['host'], $proxy['port'], $errnum, $errstr, 30);
      }
      if(!$fp) {
        ipn_debug_email('IPN FATAL ERROR :: Could not establish fsockopen. ' . "\n" . 'Host Details = ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . ' (' . $errnum . ') ' . $errstr . "\n" . (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '' ? "\n" . $ssl . $web[host] . $web[path] : '') . "\n Trying again without SSL ...");
        $ssl = 'http://';
        $proxy['port'] = '80';
        $fp=@fsockopen($ssl . $proxy['host'], $proxy['port'], $errnum, $errstr, 30);
      }
      if(!$fp) {
        ipn_debug_email('IPN FATAL ERROR :: Could not establish fsockopen. ' . "\n" . 'Host Details = ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . ' (' . $errnum . ') ' . $errstr . "\n" . (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '' ? "\n" . $ssl . $web[host] . $web[path] : '') . "\n Trying again without specified protocol ...");
        $ssl = '';
        $fp=@fsockopen($ssl . $proxy['host'], $proxy['port'], $errnum, $errstr, 30);
      }
      if(!$fp) {
        ipn_debug_email('IPN FATAL ERROR :: Could not establish fsockopen. ' . "\n" . 'Host Details = ' . $ssl . $proxy['host'] . ':' . $proxy['port'] . ' (' . $errnum . ') ' . $errstr . "\n" . (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '' ? "\n" . $ssl . $web[host] . $web[path] : ''));
        die();
      }

      fputs($fp, $header . $postback . "\r\n\r\n");
      $header_data = '';
      //loop through the response from the server
      while(!feof($fp)) {
        $line = @fgets($fp, 1024);
        if (strcmp($line, "\r\n") == 0) {
          // this is a header row
          $headerdone = true;
          $header_data .= $line;
        } else if ($headerdone) { 
          // header has been read. now read the contents
          $info[] = $line;
        }
      }
      //close fp - we are done with it
      fclose($fp);
      //break up results into a string
      $info = implode("", $info);
    }
    $status = (strstr($info,'VERIFIED')) ? 'VERIFIED' : (strstr($info,'SUCCESS')) ? 'SUCCESS' : '';

    ipn_debug_email('IPN INFO - Confirmation/Validation response ' . "\n" . ($status != '' ? $status : $header_data . $info));

    return array('info' => $info, 'postdata' => $postdata );
  }

/**
 * Write order-history update to ZC tables denoting the update supplied by the IPN
 */
  function ipn_update_orders_status_and_history($ordersID, $new_status = 1, $txn_type) {
    global $db;
    ipn_debug_email('IPN NOTICE :: Updating order #' . (int)$ordersID . ' to status: ' . (int)$new_status . ' (txn_type: ' . $txn_type . ')');
    $db->Execute("update " . TABLE_ORDERS  . "
                    set orders_status = '" . (int)$new_status . "'
                    where orders_id = '" . (int)$ordersID . "'");

    $sql_data_array = array('orders_id' => (int)$ordersID,
                            'orders_status_id' => (int)$new_status,
                            'date_added' => 'now()',
                            'comments' => 'PayPal status: ' . $_POST['payment_status'] . ' ' . ' @ ' . $_POST['payment_date'] . (($_POST['parent_txn_id'] !='') ? "\n" . ' Parent Trans ID:' . $_POST['parent_txn_id'] : '') . "\n" . ' Trans ID:' . $_POST['txn_id'] . "\n" . ' Amount: ' . $_POST['mc_gross'] . ' ' . $_POST['mc_currency'],
                            'customer_notified' => false
                           );
    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
    ipn_debug_email('IPN NOTICE :: Update complete.');

/** 
 * Activate any downloads associated with an order which has now been cleared
 */
    if ($txn_type=='echeck-cleared' || $txn_type == 'express-checkout-cleared' || substr($txn_type,0,8) == 'cleared-') {
      $check_status = $db->Execute("select date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$ordersID . "'");
      $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + (int)DOWNLOAD_MAX_DAYS;
      ipn_debug_email('IPN NOTICE :: Updating order #' . (int)$ordersID . ' downloads.  New max days: ' . (int)$zc_max_days . ', New count: ' . (int)DOWNLOAD_MAX_COUNT);
      $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . (int)$zc_max_days . "', download_count='" . (int)DOWNLOAD_MAX_COUNT . "' where orders_id='" . (int)$ordersID . "'";
      $db->Execute($update_downloads_query);
    }
  }

  /**
   * Prepare subtotal and line-item detail content to send to PayPal
   */
  function ipn_getLineItemDetails() {
error_reporting(E_ALL);
    global $order, $currencies, $order_totals, $order_total_modules;
    $optionsST = array();
    $optionsLI = array();
    $onetimeSum = 0;
    $onetimeTax = 0;
    $creditsApplied = 0;
    $creditsTax_applied = 0;
    $sumOfLineItems = 0;
    $sumOfLineTax = 0;

    // prepare subtotals
    $optionsST['handling'] = 0;
    for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
      if ($order_totals[$i]['code'] == 'ot_subtotal') $optionsST['subtotal'] = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_tax')      $optionsST['tax_cart'] = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_shipping') $optionsST['shipping'] = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_total')    $optionsST['amount']   = round($order_totals[$i]['value'],2);
      global $$order_totals[$i]['code'];
      if (isset($$order_totals[$i]['code']->credit_class) && $$order_totals[$i]['code']->credit_class == true) $creditsApplied += round($order_totals[$i]['value'],2);
      // treat all other OT's as if they're related to handling fees
      if (!in_array($order_totals[$i]['code'], array('ot_total','ot_subtotal','ot_tax','ot_shipping')) 
          && !(isset($$order_totals[$i]['code']->credit_class) && $$order_totals[$i]['code']->credit_class == true)) {
          $optionsST['handling'] += $order_totals[$i]['value'];
      }
    }

    // Move shipping tax amount from Tax subtotal into Shipping subtotal for submission to PayPal
    $module = substr($_SESSION['shipping']['id'], 0, strpos($_SESSION['shipping']['id'], '_'));
    if (zen_not_null($order->info['shipping_method'])) {
      if ($GLOBALS[$module]->tax_class > 0) {
        $shipping_tax_basis = (!isset($GLOBALS[$module]->tax_basis)) ? STORE_SHIPPING_TAX_BASIS : $GLOBALS[$module]->tax_basis;
        $shippingOnBilling = zen_get_tax_rate($GLOBALS[$module]->tax_class, $order->billing['country']['id'], $order->billing['zone_id']);
        $shippingOnDelivery = zen_get_tax_rate($GLOBALS[$module]->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        if ($shipping_tax_basis == 'Billing') {
          $shipping_tax = $shippingOnBilling;
        } elseif ($shipping_tax_basis == 'Shipping') {
          $shipping_tax = $shippingOnDelivery;
        } else {
          if (STORE_ZONE == $order->billing['zone_id']) {
            $shipping_tax = $shippingOnBilling;
          } elseif (STORE_ZONE == $order->delivery['zone_id']) {
            $shipping_tax = $shippingOnDelivery;
          } else {
            $shipping_tax = 0;
          }
        }
        $taxAdjustmentForShipping = zen_calculate_tax($order->info['shipping_cost'], $shipping_tax);
        $optionsST['shipping'] += $taxAdjustmentForShipping;
        $optionsST['tax_cart'] -= $taxAdjustmentForShipping;
      }
    }
ipn_logging('DEBUG Round 1', 'Subtotal Info:' . "\n" . print_r($optionsST, true));

    // loop thru all products to display quantity and price. Appends *** if out-of-stock.
    for ($i=0, $n=sizeof($order->products), $k=1; $i<$n; $i++, $k++) {
      $optionsLI["item_number_$k"] = $order->products[$i]['model'];
      $optionsLI["quantity_$k"]    = (int)$order->products[$i]['qty'];
      $optionsLI["item_name_$k"]   = $order->products[$i]['name'];
      $optionsLI["item_name_$k"]  .= (zen_get_products_stock($order->products[$i]['id']) - $order->products[$i]['qty'] < 0 ? STOCK_MARK_PRODUCT_OUT_OF_STOCK : '');

      // if there are attributes, loop thru them and add to description
      if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
        for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
          $optionsLI["item_name_$k"] .= "\n " . $order->products[$i]['attributes'][$j]['option'] . 
                                        ': ' . $order->products[$i]['attributes'][$j]['value'];
        } // end loop
      } // endif attribute-info

      $optionsLI["amount_$k"] = $order->products[$i]['final_price'];
      $optionsLI["tax_$k"]    = zen_calculate_tax($order->products[$i]['final_price'], $order->products[$i]['tax']);
      $optionsLI["shipping_$k"] = 0;

      // track one-time charges
      if ($order->products[$i]['onetime_charges'] != 0 ) {
        $onetimeSum += $order->products[$i]['onetime_charges'];
        $onetimeTax += zen_calculate_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']);
      }

      // Replace & and = with * if found. 
      $optionsLI["item_name_$k"] = str_replace(array('&','='), '*', $optionsLI["item_name_$k"]);
      $optionsLI["item_name_$k"] = zen_clean_html($optionsLI["item_name_$k"], 'strong');
      $optionsLI["item_name_$k"] = substr($optionsLI["item_name_$k"], 0, 127);

      // reformat properly
      $optionsLI["item_number_$k"] = substr($optionsLI["item_number_$k"], 0, 127);

    }  // end for loopthru all products

    if ($onetimeSum > 0) {
      $i++; $k++;
      $optionsLI["item_number_$k"] = $k;
      $optionsLI["item_name_$k"]   = 'One-Time Charges';
      $optionsLI["amount_$k"]      = $onetimeSum;
      $optionsLI["tax_$k"]         = $onetimeTax;
      $optionsLI["quantity_$k"]    = 1;
    }
ipn_logging('DEBUG Round 2', 'Line Item Info:' . "\n" . print_r($optionsLI, true));

    // handle discounts such as gift certificates and coupons
    if ($creditsApplied > 0) {
      $optionsST['handling'] -= $creditsApplied;
    }

    // add all one-time charges
    $optionsST['subtotal'] += $onetimeSum;

    //ensure things are not negative and not carrying any bad precision
    $optionsST['handling'] = abs(strval($optionsST['handling']));

    // subtotals have to add up to AMT
    // Thus, if there is a discrepancy, make adjustment to HANDLINGAMT:
    $st = $optionsST['subtotal'] + $optionsST['tax_cart'] + $optionsST['shipping'] + $optionsST['handling'];
    if ($st != $optionsST['amount']) $optionsST['handling'] += ($optionsST['amount'] - $st);



    // Since the PayPal spec cannot handle mathematically mismatched values caused by one-time charges,
    // must drop line-item details if any one-time charges apply to this order:
    // And, if there are any discounts in this order, do NOT supply line-item details
    if ($onetimeSum > 0) $optionsLI = array();


    // Do sanity check -- if any of the line-item subtotal math doesn't add up properly, skip line-item details,
    // so that the order can go through even though PayPal isn't being flexible to handle Zen Cart's diversity
    $optionsLI['num_cart_items'] = 0;
    for ($j=1; $j<$k; $j++) {
      $itemAMT = $optionsLI["amount_$j"];
      $itemTAX = $optionsLI["tax_$j"];
      $itemQTY = $optionsLI["quantity_$j"];
      $sumOfLineItems += ($itemQTY * $itemAMT);
      $sumOfLineTax += round(($itemQTY * $itemTAX),2);
      $optionsLI['num_cart_items']++;
    }

    if ((float)strval($optionsST['subtotal']) != (float)strval($sumOfLineItems)) {
      $optionsLI = array();
      ipn_logging('getLineItemDetails 1: Order Subtotal does not match sum of line-item prices. Line-item-details skipped.' . "\n" . (float)$optionsST['subtotal'] . ' ' . (float)$sumOfLineItems);
      //die('ITEMAMT != $sumOfLineItems ' . $optionsST['ITEMAMT'] . ' ' . $sumOfLineItems);
    }
    if ((float)strval($optionsST['tax_cart']) != (float)strval($sumOfLineTax)) {
      for ($i=0, $n=sizeof($order->products), $k=1; $i<$n; $i++, $k++) {
        $optionsLI["tax_$k"] = 0;
      }
      $optionsLI["tax_1"] = $optionsST["tax_cart"];
      ipn_logging('getLineItemDetails 2: Tax Subtotal did not match sum of taxes for line-items. Line-item taxes skipped.' . "\n" . $optionsST['tax_cart'] . ' ' . $sumOfLineTax);
      //die('TAXAMT != $sumofLineTax ' . $optionsST['TAXAMT'] . ' ' . $sumOfLineTax);
    }

    // ensure all numbers are non-negative
    // tidy up all values so that they comply with proper format (number_format(xxxx,2) for PayPal US use )
    if (is_array($optionsST)) foreach ($optionsST as $key=>$value) {
      $optionsST[$key] = number_format(abs(strval($value)), 2);
    }
    if (is_array($optionsLI)) foreach ($optionsLI as $key=>$value) {
      if (strstr($key, 'amount')) $optionsLI[$key] = number_format(abs(strval($value)), 2);
    }

    ipn_logging('getLineItemDetails 3: IPN LineItemDetails: ' . "\n" . ($creditsApplied ? 'Credits apply to this order, so all line-item details are NOT being submitted. Thus, the following data is REDUNDANT and probably VERY INACCURATE' . "\n" : '') . 'Details:' . print_r(array_merge($optionsST, $optionsLI), true) . "\n\n" . 'DEFAULT_CURRENCY = ' . DEFAULT_CURRENCY  . "\nSESSION['currency'] = " . $_SESSION['currency'] . "\n" . "order->info['currency'] = " . $order->info['currency'] . "\n\$currencies->currencies[\$_SESSION['currency']]['value'] = " . $currencies->currencies[$_SESSION['currency']]['value'] . "\n" . print_r($currencies, true));

    // if not default currency, do not send subtotals or line-item details
    if (DEFAULT_CURRENCY != $order->info['currency']) {
      ipn_logging('getLineItemDetails 4: Not using default currency. Thus, no line-item details can be submitted.');
      return array();
    }
    if ($currencies->currencies[$_SESSION['currency']]['value'] != 1) {
      ipn_logging('getLineItemDetails 5: currency val not equal to 1.0000 - cannot proceed without coping with currency conversions. Aborting line-item details.');
      return array();
    }

    // if there are any discounts in this order, do not supply subtotals or line-item details
    if (strval($creditsApplied) > 0) return array();
    //$this->zcLog('getLineItemDetails 6', 'no credits - okay');

    // if subtotals are not adding up correctly, then skip sending any line-item or subtotal details to PayPal
    $st = round(strval($optionsST['subtotal'] + $optionsST['tax_cart'] + $optionsST['shipping'] + $optionsST['handling']),2);
    $stDiff = strval($optionsST['amount'] - $st);
    $stDiffRounded = strval(abs($st) - abs(round($optionsST['amount'],2)));


    ipn_logging('getLineItemDetails 7: checking subtotals... '. "\nitemamt: " . $optionsST['subtotal'] . "\ntaxamt: " . $optionsST['tax_cart'] . "\nshippingamt: " . $optionsST['shipping'] . "\nhandlingamt: " . $optionsST['handling'] . "\n-------------------\nsubtotal: " . number_format($st, 2) . "\namount: " . $optionsST['amount'] . "\n-------------------\ndifference: " . $stDiff . '  (abs+rounded: ' . $stDiffRounded . ')');

    if ( $stDiffRounded != 0) return array(); //die('bad subtotals'); //return array();
    ipn_logging('getLineItemDetails 8: subtotals balance - okay');

    if (abs($optionsST['handling']) == 0) unset($optionsST['handling']);

    // Send Subtotal and LineItem results back to be submitted to PayPal
    return array_merge($optionsST, $optionsLI);
  }

/**
 * Debug logging
 */
  function ipn_logging($stage, $message = '') {
    ipn_add_error_log($stage . ($message != '' ? ': ' . $message : ''));
  }
  function ipn_add_error_log($message, $paypal_instance_id = '') {
    if ($paypal_instance_id == '') $paypal_instance_id = date('mdYGi');
    $fp = @fopen('includes/modules/payment/paypal/logs/ipn_' . $paypal_instance_id . (substr($message, 0, 3) == 'PDT' ? '_PDT' : '') . '.log', 'a');
    if ($fp) {
      fwrite($fp, date('M d Y G:i') . ' -- ' . $message . "\n\n");
      fclose($fp);
    }
  }

?>