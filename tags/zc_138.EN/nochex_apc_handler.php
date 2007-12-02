<?php
/**
 * nochex_apc_handler.php callback handler for Nochex APC payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: nochex_apc_handler.php 6754 2007-08-19 18:53:30Z drbyte $
 */
/**
 * Include custom application_top.php
 */
$loaderPrefix = 'nochex_apc';
require('includes/application_top.php');

$callback_url = "https://www.nochex.com/nochex.dll/apc/apc";
$postdata = array();
foreach($_POST as $index => $value) {
  $postdata[] = $index."=".urlencode(stripslashes($value));
}
$query_string = implode("&", $postdata);

$callback_url = parse_url($callback_url);
if($callback_url["scheme"] == "https"){
  $callback_url["port"] = "443";
  $callback_url["ssl"] = "ssl://";
} else {
  $callback_url["port"] = "80";
  $callback_url["ssl"] = "";
}
$fp = @fsockopen($callback_url["ssl"].$callback_url["host"], $callback_url["port"], $errnum, $errstr, 30);
if(!$fp){
  apc_debug_email('APC FATAL ERROR::Could not establish fsockopen. Host Details = '.$callback_url["ssl"].$callback_url['host'].':'.$callback_url['port']);
  die();
}else{
  fputs($fp, "POST {$callback_url["path"]} HTTP/1.1\r\n");
  fputs($fp, "Host: {$callback_url["host"]}\r\n");
  fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
  fputs($fp, "Content-length: ".strlen($query_string)."\r\n");
  fputs($fp, "Connection: close\r\n\r\n");
  fputs($fp, $query_string."\r\n\r\n");
  $response = "";
  while(!feof($fp)) {
    $response.= @fgets($fp, 1024);
  }
  fclose($fp);
  list($headers, $response) = explode("\r\n\r\n", $response);
}

apc_debug_email('APC INFO - POST VARS  ' . "\n" . str_replace('&', " \n&", $query_string));
apc_debug_email('APC INFO - RESPONSE  ' . "\n" . $headers . "\n\n-----------------\n\n" . $response);

if(trim($response)=="AUTHORISED"){
  /**
   * Include shipping class
   */
  require(DIR_WS_CLASSES . 'shipping.php');
  /**
  * Include payment class
   */
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($_SESSION['payment']);
  $shipping_modules = new shipping($_SESSION['shipping']);
  /**
  * Include order class
  */
  require(DIR_WS_CLASSES . 'order.php');
  $order = new order();
  /**
  * Include order_total class
  */
  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total();
  $order_totals = $order_total_modules->process();
  $insert_id = $order->create($order_totals);
  $nochex_order = apc_create_order_array($insert_id, $response);
  zen_db_perform(TABLE_NOCHEX, $nochex_order);
  $nochex_trans_db_id = $db->Insert_ID();
  $new_status = MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID;
  if(!isset($_POST["status"])||strtolower($_POST["status"])=='live'){
    $new_status = MODULE_PAYMENT_NOCHEX_PROCESSING_STATUS_ID;
    $db->Execute("update " . TABLE_ORDERS  . "
                    set orders_status = " . MODULE_PAYMENT_NOCHEX_PROCESSING_STATUS_ID . "
                    where orders_id = '" . $insert_id . "'");
  }
  if(!isset($_POST["status"])||strtolower($_POST["status"])=="live"){
    $comments = 'Nochex payment of '.sprintf("%01.2f", $_POST["amount"]).' received at '.$_POST['transaction_date'].' with transaction ID:'.$_POST['transaction_id'];
  }else{
    $comments = 'TEST PAYMENT of '.sprintf("%01.2f", $_POST["amount"]).' received at '.$_POST['transaction_date'].' with transaction ID:'.$_POST['transaction_id'];
  }
  $sql_data_array = array('orders_id' => $insert_id,
                          'orders_status_id' => $new_status,
                          'date_added' => 'now()',
                          'comments' => $comments,
                          'customer_notified' => false
  );
  zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
  $order->create_add_products($insert_id, 2);
  $order->send_order_email($insert_id, 2);
  $_SESSION['cart']->reset(true);
}
