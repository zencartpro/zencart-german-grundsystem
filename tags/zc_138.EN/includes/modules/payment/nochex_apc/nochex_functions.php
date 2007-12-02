<?php
/**
 * functions used by payment module class for Nochex APC payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: nochex_functions.php 6728 2007-08-19 07:39:46Z drbyte $
 */

// counter used for debug purposes:
$nochex_error_counter = 0;
$nochex_instance_id = time();

// Functions for Nochex processing
function apc_debug_email($message, $email_address = MODULE_PAYMENT_NOCHEX_EMAIL_ADDRESS, $always_send = false) {
  if (MODULE_PAYMENT_NOCHEX_APC_DEBUG == 'Log and Email' || $always_send) {
    global $nochex_error_counter, $nochex_instance_id;
    $nochex_error_counter ++;
    mail($email_address,'APC DEBUG message (' . $nochex_instance_id . ') #' . $nochex_error_counter, $message);
  }
  if (MODULE_PAYMENT_NOCHEX_APC_DEBUG == 'Log and Email' || MODULE_PAYMENT_NOCHEX_APC_DEBUG == 'Log File' || MODULE_PAYMENT_NOCHEX_APC_DEBUG == 'Yes') apc_add_error_log($message);
}

function apc_get_stored_session($session_stuff) {
  global $db;
  if (!is_array($session_stuff) || sizeof($session_stuff) == 1) {
    apc_debug_email('APC FATAL ERROR::Could not find custom variable in post, cannot re-create session');
    return false;
  }
  $sql = "SELECT *
          FROM " . TABLE_NOCHEX_SESSION . " 
          WHERE session_id = :sessionID";
  $sql = $db->bindVars($sql, ':sessionID', $session_stuff[1], 'string');
  $stored_session = $db->Execute($sql);
  apc_debug_email('APC Session Query: '.$sql."\n\n\n\$session_stuff = ".print_r($session_stuff, true));
  if ($stored_session->recordCount() < 1) {
    apc_debug_email('APC FATAL ERROR::Could not find stored session in DB, cannot re-create session');
    return false;
  }
  $_SESSION = unserialize(base64_decode($stored_session->fields['saved_session']));
  return true;
}

function apc_create_order_array($new_order_id, $response) {
  $nochex_order = array('order_id' => $new_order_id,
                        'nc_transaction_id' => $_POST['transaction_id'],
                        'nc_transaction_date' => date("Y-m-d H:i:s", strtotime($_POST['transaction_date'])),
                        'nc_status' => $_POST['status'],
                        'nc_to_email' => $_POST['to_email'],
                        'nc_from_email' => $_POST['from_email'],
                        'nc_order_id' => $_POST['order_id'],
                        'nc_custom' => $_POST['custom'],
                        'nc_amount' => $_POST['amount'],
                        'nc_security_key' => $_POST['security_key'],
                        'nochex_response' => $response,
                        'date_added' => 'now()'
  );
  return $nochex_order;
}

function apc_add_error_log($message) {
  global  $nochex_instance_id;
  $fp = @fopen('includes/modules/payment/nochex_apc/logs/apc_' . $nochex_instance_id . '.log', 'a');
  @fwrite($fp, date('D M Y G:i') . ' -- ' . $message . "\n\n");
  @fclose($fp);
}
function nochex_simulate_apc_handler($count) {
  global $db;
  $sql = "select * from " . TABLE_NOCHEX_TESTING . " order by nochex_apc_id desc limit " . (int)$count;
  $nochex_testing = $db->execute($sql);
  while (!$nochex_testing->EOF) {
    $paypal_fields[] = $nochex_testing->fields;
    $nochex_testing->moveNext();
  }
  $nochex_fields = array_reverse($nochex_fields);
  foreach ($nochex_fields as $value) {
    foreach($value as $i=>$v) {
      $postdata .= $i . "=" . urlencode(stripslashes($v)) . "&";
    }
    $address = HTTP_SERVER . DIR_WS_CATALOG . 'nochex_apc_main_handler.php?' . $postdata;
    $response = nochex_fopen($address);
    echo $response;
  }
}
  function nochex_fopen($filename) {
    $response = '';
    $fp = fopen($filename,'rb');
    if ($fp) {
      $response = nochex_getRequestBodyContents($fp);
      @fclose($fp);
    }
    return $response;
  }
  function nochex_getRequestBodyContents(&$handle) {
    if ($handle) {
      while(!feof($handle)) {
        $line .= @fgets($handle, 1024);
      }
      return $line;
    }
    return false;
  }
?>