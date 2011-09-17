<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2004 Zen Cart                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: wpcallback header_php.php,v1.1 2004/09/05 10:00:00 networkdad Exp $
//
//  require(DIR_WS_MODULES . 'require_languages.php');
  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE);

// @ini_set('display_errors', '1');
// error_reporting(E_WARNING);

  //  get values from WorldPay response - see http://support.worldpay.com/kb/customising3/paymentpageeditor.html

	if(isset($_POST['transId'])) {$transId = $_POST[transId];}
	if(isset($_POST['transStatus'])) {$transStatus = $_POST[transStatus];}
	if(isset($_POST['cartId'])) {$cartId = $_POST[cartId];}
	if(isset($_POST['name'])) {$name = $_POST[name];}
	if(isset($_POST['address'])) {$address = $_POST[address];}
	if(isset($_POST['postcode'])) {$postcode = $_POST[postcode];}
	if(isset($_POST['country'])) {$country = $_POST[country];}	
	if(isset($_POST['tel'])) {$tel = $_POST[tel];}
	if(isset($_POST['email'])) {$email = $_POST[email];}
	if(isset($_POST['authAmountString'])) {$authAmountString = $_POST[authAmountString];}
	if(isset($_POST['cardType'])) {$cardType = $_POST[cardType];}
	if(isset($_POST['testMode'])) {$testMode = $_POST[testMode];}
    if(isset($_POST['callbackPW'])) {$callbackPW = $_POST[callbackPW];}
//	if(isset($_POST['transTime'])) {$transTime = $_POST[transTime];}


if(defined('MODULE_PAYMENT_WORLDPAY_DEBUG') && strtolower(MODULE_PAYMENT_WORLDPAY_DEBUG) == 'true'){

$str =  print_r($_POST, true)."\n\n".print_r($_SERVER, true)."\n\n".print_r($_SESSION, true)."\n\n";

}

// Check if payment response comes from WorldPay
if (defined('MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD') && $callbackPW !== MODULE_PAYMENT_WORLDPAY_PAYMENT_RESPONSE_PASSWORD)
	{

		if(defined('MODULE_PAYMENT_WORLDPAY_DEBUG') && strtolower(MODULE_PAYMENT_WORLDPAY_DEBUG) == 'true'){
			foreach(preg_split('/[;,]/',MODULE_PAYMENT_WORLDPAY_DEBUG_LIST) AS $email){
				mail($email, 'WorldPay debug from '.$_SERVER["HTTP_HOST"], "Password Failure:\n\n".$str );
			}
		}
		zen_redirect(zen_href_link(FILENAME_WP_CALLBACK_HACKER_RESPONSE));

	}
else
	{

// check if payment completed successfully by WorldPay

  if($transStatus == "Y")
	  {

		if(defined('MODULE_PAYMENT_WORLDPAY_DEBUG') && strtolower(MODULE_PAYMENT_WORLDPAY_DEBUG) == 'true'){
			foreach(preg_split('/[;,]/',MODULE_PAYMENT_WORLDPAY_DEBUG_LIST) AS $email){
				mail($email, 'WorldPay debug from '.$_SERVER["HTTP_HOST"], "Transaction Status Success:\n\n".$str );
			}
		}

// add data storage here then.

$breadcrumb->add(NAVBAR_TITLE_1);
// if payment completed succesfully complete the checkout process - from includes/modules/pages/ckeckout_process/header_php.php
	
// This should be first line of the script:
 $zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PROCESS');

  require(DIR_WS_MODULES . zen_get_module_directory('wp_checkout_process.php'));


// load the after_process function from the payment modules
  $payment_modules->after_process();

  $_SESSION['cart']->reset(true);

// unregister session variables used during checkout
  unset($_SESSION['sendto']);
  unset($_SESSION['billto']);
  unset($_SESSION['shipping']);
  unset($_SESSION['payment']);
  unset($_SESSION['comments']);
  $order_total_modules->clear_posts();//ICW ADDED FOR CREDIT CLASS SYSTEM

  // This should be before the zen_redirect:
  $zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_PROCESS');
  
//  require(DIR_WS_MODULES . zen_get_module_directory('wp_checkout_success.php'));
  }
  else{

		if(defined('MODULE_PAYMENT_WORLDPAY_DEBUG') && strtolower(MODULE_PAYMENT_WORLDPAY_DEBUG) == 'true'){
			foreach(preg_split('/[;,]/',MODULE_PAYMENT_WORLDPAY_DEBUG_LIST) AS $email){
				mail($email, 'WorldPay debug from '.$_SERVER["HTTP_HOST"], "Transaction Status Failure:\n\n".$str );
			}
		}

// require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// load selected payment module
require(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment($_SESSION['payment']);
// load the selected shipping module
// require(DIR_WS_CLASSES . 'shipping.php');
// $shipping_modules = new shipping($_SESSION['shipping']);
// 
// require(DIR_WS_CLASSES . 'order.php');
// $order = new order;
// 
// require(DIR_WS_CLASSES . 'order_total.php');
// $order_total_modules = new order_total;
// 
// $zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_BEFORE_ORDER_TOTALS_PRE_CONFIRMATION_CHECK');
// 
// $order_totals = $order_total_modules->pre_confirmation_check();
// 
// $zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_BEFORE_ORDER_TOTALS_PROCESS');
// $order_totals = $order_total_modules->process();
// 
// $zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_TOTALS_PROCESS');

$_SESSION['wp_products'] = $_SESSION['cart']->get_products();

// load the before_process function from the payment modules
$payment_modules->before_process();

unset($_SESSION['wp_products']);

  $breadcrumb->add(NAVBAR_TITLE_2);
  }
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
	}
 ?>
