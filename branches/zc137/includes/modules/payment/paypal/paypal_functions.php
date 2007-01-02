<?php
/**
 * functions used by payment module class for Paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal_functions.php 5427 2006-12-28 14:59:24Z drbyte $
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

  function ipn_debug_email($message, $email_address = '', $always_send = false) {
    static $paypal_error_counter;
    static $paypal_instance_id;
    if ($email_address == '') $email_address = (defined('MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS') ? MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS : STORE_OWNER_EMAIL_ADDRESS);
    if(!isset($paypal_error_counter)) $paypal_error_counter = 0;
    if(!isset($paypal_instance_id)) $paypal_instance_id = time() . '_' . zen_create_random_value(4);
    if (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log and Email' || $always_send) {
      $paypal_error_counter ++;
//      mail($email_address,'IPN DEBUG message (' . $paypal_instance_id . ') #' . $paypal_error_counter, $message);
      zen_mail(STORE_OWNER, $email_address, 'IPN DEBUG message (' . $paypal_instance_id . ') #' . $paypal_error_counter, $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }
    if (MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log and Email' || MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Log File' || MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Yes' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING =='Log and Email') ipn_add_error_log($message, $paypal_instance_id);
  }
  function ipn_get_stored_session($session_stuff) {
    global $db;
    if (!is_array($session_stuff)) {
      ipn_debug_email('IPN FATAL ERROR::Could not find custom variable in post, cannot re-create session as PayPal IPN transaction.');
      return false;
    }
    $sql = "SELECT *
            FROM " . TABLE_PAYPAL_SESSION . "
            WHERE session_id = :sessionID";
    $sql = $db->bindVars($sql, ':sessionID', $session_stuff[1], 'string');
    $stored_session = $db->Execute($sql);
    if ($stored_session->recordCount() < 1) {
      ipn_debug_email('IPN FATAL ERROR::Could not find stored session in DB, cannot re-create session as PayPal IPN transaction.');
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

    $sql = "SELECT zen_order_id, paypal_ipn_id, payment_status, txn_type, pending_reason
                FROM " . $useTable . "
                WHERE txn_id = :transactionID
                ORDER BY zen_order_id DESC  ";
    $sql2 = $db->bindVars($sql, ':transactionID', $postArray['txn_id'], 'string');
    if (isset($postArray['parent_txn_id'])) $sql1 = $db->bindVars($sql, ':transactionID', $postArray['parent_txn_id'], 'string');
    if (isset($postArray['parent_txn_id'])) {
      $ipn_id = $db->Execute($sql1);
      if($ipn_id->RecordCount() > 0) {
        ipn_debug_email('IPN NOTICE::This transaction HAS a parent record');
        $transType = 'parent';
        $ordersID = $ipn_id->fields['zen_order_id'];
        $paypalipnID = $ipn_id->fields['paypal_ipn_id'];
      }
    } else {
      $ipn_id = $db->Execute($sql2);
      if ($ipn_id->RecordCount() <= 0) {
        ipn_debug_email('IPN WARNING::Could not find matched txn_id record in DB');
        $transType = 'unique';
        $ordersID = $ipn_id->fields['zen_order_id'];
        $paypalipnID = $ipn_id->fields['paypal_ipn_id'];
      } else {
        while(!$ipn_id->EOF) {
          switch ($ipn_id->fields['pending_reason']) {
            case 'address':
              ipn_debug_email('IPN NOTICE:: Found pending-address record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-address';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-address';
            break;
            case 'multicurrency':
              ipn_debug_email('IPN NOTICE:: Found pending-multicurrency record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-multicurrency';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-multicurrency';
            break;
            case 'echeck':
              ipn_debug_email('IPN NOTICE:: Found pending-echeck record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-echeck';
              if ($postArray['payment_status'] == 'Denied') $transType = 'denied-echeck';
              if ($postArray['payment_status'] == 'Failed') $transType = 'failed-echeck';
            break;
            case 'authorization':
              ipn_debug_email('IPN NOTICE:: Found pending-authorization record in database');
              $transType = 'cleared-authorization';
            break;
            case 'verify':
              ipn_debug_email('IPN NOTICE:: Found pending-verify record in database');
              $transType = 'cleared-verify';
            break;
            case 'intl':
              ipn_debug_email('IPN NOTICE:: Found pending-intl record in database');
              if ($postArray['payment_status'] == 'Completed') $transType = 'cleared-intl';
              if ($postArray['payment_status'] == 'Denied')    $transType = 'denied-intl';
            break;
          }
          if ($transType != 'unknown') {
            $ordersID = $ipn_id->fields['zen_order_id'];
            $paypalipnID = $ipn_id->fields['paypal_ipn_id'];
          }
          $ipn_id->MoveNext();
        }
      }
    }
    return array('zen_order_id' => $ordersID, 'paypal_ipn_id' => $paypalipnID, 'txn_type' => $transType);
  }
/**
 * IPN Validation
 * - match email addresses 
 * - ensure that "VERIFIED" has been returned (otherwise somebody is trying to spoof)
 */
  function ipn_validate_transaction($info, $postArray) {
    if (!eregi("VERIFIED",$info)) {
      ipn_debug_email('IPN WARNING::Transaction was not marked as VERIFIED. Keep this report for potential use in fraud investigations.' . "\n" . 'IPN Info = ' . "\n" . $info);
      return false;
    }
    if (strtolower($postArray['business']) != strtolower(MODULE_PAYMENT_PAYPAL_BUSINESS_ID) && strtolower($postArray['receiver_email']) != strtolower(MODULE_PAYMENT_PAYPAL_BUSINESS_ID)) {
      ipn_debug_email('IPN WARNING::Transaction email address NOT matched.' . "\n" . 'From IPN = ' . $postArray['business'] . ' | ' . $postArray['receiver_email'] . "\n" . 'From CONFIG = ' .  MODULE_PAYMENT_PAYPAL_BUSINESS_ID);
      return false;
    }
    return true;
  }

  function valid_payment($info, $amount, $currency) {
    global $currencies;
    if (MODULE_PAYMENT_PAYPAL_CURRENCY == 'Selected Currency') {
      $my_currency = $_SESSION['currency'];
    } else {
      $my_currency = substr(MODULE_PAYMENT_PAYPAL_CURRENCY, 5);
    }
    $ec_currencies = array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD', 'CHF', 'CZK', 'DKK', 'HKD', 'HUF', 'NOK', 'NZD', 'PLN', 'SEK', 'SGD', 'THB');
    $basic_currencies = array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD');
    $currency_list = ($_POST['txn_type'] == 'express-checkout') ? $ec_currencies : $basic_currencies;
    if (!in_array($my_currency, $currency_list)) {
      $my_currency = 'USD';
    }
    $transaction_amount = number_format(($amount) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
    if ( ($_POST['mc_currency'] != $my_currency) || ($_POST['mc_gross'] != $transaction_amount && $_POST['mc_gross'] != -0.01) && MODULE_PAYMENT_PAYPAL_TESTING != 'Test' ) {
      ipn_debug_email('IPN WARNING::Currency/Amount Mismatch.  Details: ' . "\n" . 'PayPal email address = ' . $_POST['business'] . "\n" . ' | mc_currency = ' . $_POST['mc_currency'] . "\n" . ' | submitted_currency = ' . $my_currency . "\n" . ' | order_currency = ' . $currency . "\n" . ' | mc_gross = ' . $_POST['mc_gross'] . "\n" . ' | converted_amount = ' . $transaction_amount . "\n" . ' | order_amount = ' . $amount );
      return false;
    }
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
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='multi-currency') {
      $txn_type = 'pending-multicurrency';
      return $txn_type;
    }
    if (($postArray['payment_status']=='Pending') && $postArray['pending_reason']=='multi-verify') {
      $txn_type = 'pending-verify';
      return $txn_type;
    }
    return $txn_type;
  }
/**
 * Create order record from IPN data
 */
  function ipn_create_order_array($new_order_id, $txn_type) {
    $paypal_order = array('zen_order_id' => $new_order_id,
                          'txn_type' => $txn_type,
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
    return $paypal_order;
  }
/**
 * Create order-history record from IPN data
 */
  function ipn_create_order_history_array($insert_id) {
    $paypal_order_history = array ('paypal_ipn_id' => $insert_id,
                                   'txn_id' => $_POST['txn_id'],
                                   'parent_txn_id' => $_POST['parent_txn_id'],
                                   'payment_status' => $_POST['payment_status'],
                                   'pending_reason' => $_POST['pending_reason'],
                                   'date_added' => 'now()'
                                  );
    return $paypal_order_history;
  }
/**
 * Create order-update from IPN data
 */
  function ipn_create_order_update_array($txn_type) {
    $paypal_order = array('reason_code' => $_POST['reason_code'],
                          'payment_type' => $_POST['payment_type'],
                          'txn_type' => $txn_type,
                          'parent_txn_id' => $_POST['parent_txn_id'],
                          'payment_status' => $_POST['payment_status'],
                          'pending_reason' => $_POST['pending_reason'],
                          'invoice' => $_POST['invoice'],
                          'mc_currency' => $_POST['mc_currency'],
                          'first_name' => $_POST['first_name'],
                          'last_name' => $_POST['last_name'],
                          'payer_business_name' => $_POST['payer_business_name'],
                          'address_name' => $_POST['address_name'],
                          'address_street' => $_POST['addrss_street'],
                          'address_city' => $_POST['address_city'],
                          'address_state' => $_POST['address_state'],
                          'address_zip' => $_POST['address_zip'],
                          'address_country' => $_POST['address_country'],
                          'payer_email' => $_POST['payer_email'],
                          'payer_id' => $_POST['payer_id'],
                          'business' => $_POST['business'],
                          'receiver_email' => $_POST['receiver_email'],
                          'receiver_id' => $_POST['receiver_id'],
                          'num_cart_items' => $_POST['num_cart_items'],
                          'mc_gross' => $_POST['mc_gross'],
                          'mc_fee' => $_POST['mc_fee'],
                          'settle_amount' => $_POST['settle_amount'],
                          'settle_currency' => $_POST['settle_currency'],
                          'exchange_rate' => $_POST['exchange_rate'],
                          'notify_version' => $_POST['notify_version'],
                          'verify_sign' => $_POST['verify_sign'],
                          'last_modified' => 'now()'
                         );
    return $paypal_order;
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
 * Debug logging
 */
  function ipn_add_error_log($message, $paypal_instance_id = '') {
    if ($paypal_instance_id == '') $paypal_instance_id = date('mdYGi');
    $fp = @fopen('includes/modules/payment/paypal/logs/ipn_' . $paypal_instance_id . '.log', 'a');
    @fwrite($fp, date('M d Y G:i') . ' -- ' . $message . "\n\n");
    @fclose($fp);
    // if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') echo date('d M Y G:i') . ' -- ' . $message . "\n";
  }
/**
 * Debug to file
 */
  function ipn_fopen($filename) {
    $response = '';
    $fp = fopen($filename,'rb');
    if ($fp) {
      $response = getRequestBodyContents($fp);
      @fclose($fp);
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
  function ipn_postback() {
    $info = '';
    $postdata = '';
    $scheme = 'http://';
    if (ENABLE_SSL == 'true') $scheme = 'http://';
    //Parse url
    $web = parse_url($scheme . (defined('MODULE_PAYMENT_PAYPAL_HANDLER') ? MODULE_PAYMENT_PAYPAL_HANDLER : 'www.paypal.com/cgi-bin/webscr'));
    if (isset($_POST['test_ipn']) && $_POST['test_ipn'] == 1) {
      $web = parse_url($scheme . 'www.sandbox.paypal.com/cgi-bin/webscr');
    }
    //build post string
    $postdata = '';
    foreach($_POST as $i=>$v) {
      $postdata .= $i . "=" . urlencode(stripslashes($v)) . "&";
    }

    if ($postdata == '=&') {
      ipn_debug_email('IPN FATAL ERROR::No POST data to process -- Bad IPN data');
      return array('info' => $info, 'postdata' => $postdata );
    }

    $postdata .= "cmd=_notify-validate";

    if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
      $info = "VERIFIED";
    } else {
      //Set the port number
      if($web['scheme'] == "https") {
        $web['port']="443";  $ssl="ssl://";
      } else {
        $web['port']="80";  $ssl = "";
      }

      //Create paypal connection
      $fp=@fsockopen($ssl . $web['host'],$web['port'],$errnum,$errstr,30);

      if(!$fp) {
        ipn_debug_email('IPN FATAL ERROR::Could not establish fsockopen. Host Details = ' . $ssl . $web['host'] . ':' . $web['port']);
        die();
      }

      //Post Data
      fputs($fp, "POST $web[path] HTTP/1.1\r\n");
      fputs($fp, "Host: $web[host]\r\n");
      fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
      fputs($fp, "Content-length: ".strlen($postdata)."\r\n");
      fputs($fp, "Connection: close\r\n\r\n");
      fputs($fp, $postdata . "\r\n\r\n");

      // for debug+certification purposes:
      $postback  = "POST $web[path] HTTP/1.1\r\n";
      $postback .= "Host: $web[host]\r\n";
      $postback .= "Content-type: application/x-www-form-urlencoded\r\n";
      $postback .= "Content-length: ".strlen($postdata)."\r\n";
      $postback .= "Connection: close\r\n\r\n";
      $postback .= $postdata . "\r\n\r\n";

      //loop through the response from the server
      while(!feof($fp)) {
        $info[]=@fgets($fp, 1024);
      }

      //close fp - we are done with it
      fclose($fp);

      //break up results into a string
      $info = implode(",",$info);
    }

    ipn_debug_email('IPN INFO - POST VARS received: ' . "\n" . str_replace('&', " \n&", urldecode($postdata)));
    ipn_debug_email('IPN INFO - POST VARS sent back: ' . "\n" . str_replace('&', " \n&", urldecode($postback)));
    ipn_debug_email('IPN INFO - CURL INFO confirmation report ' . "\n" . $info);


    if (SEND_PAYPAL_TRANS_DETAILS == 'Yes') ipn_debug_email('IPN INFO::Transaction Details # ' . $info, '', true);

    return array('info' => $info, 'postdata' => $postdata );

  }

/**
 * Write order-history update to ZC tables denoting the update supplied by the IPN
 */
  function ipn_update_orders_status_and_history($ordersID, $new_status = 1, $txn_type) {
    global $db;
    ipn_debug_email('IPN NOTE::Updating order #' . (int)$ordersID . ' to status: ' . (int)$new_status . ' (txn_type: ' . $txn_type . ')');
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

/** 
 * Activate any downloads associated with an order which has now been cleared
 */
    if ($txn_type=='echeck-cleared' || $txn_type == 'express-checkout-cleared') {
      $check_status = $db->Execute("select orders_status,
                                    date_purchased from " . TABLE_ORDERS . "
                                    where orders_id = '" . (int)$ordersID . "'");
      $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + (int)DOWNLOAD_MAX_DAYS;
      $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . (int)$zc_max_days . "', download_count='" . (int)DOWNLOAD_MAX_COUNT . "' where orders_id='" . (int)$ordersID . "'";
      $db->Execute($update_downloads_query);
    }
  }

?>