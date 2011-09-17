<?php
/**
 * @copyright Copyright (c) 2008-9 Philip Clarke
 * @copyright Copyright (c) 2004-2008 duncanad
 * @copyright Copyright (c) 2004 networkdad 
 * @copyright Portions Copyright (c) 2003 Zen Cart
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_BEGIN');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// if the customer is not logged on, redirect them to the time out page
if (!$_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}

// confirm where link came from
if (!strstr($_SERVER['HTTP_REFERER'], FILENAME_CHECKOUT_CONFIRMATION)) {
  //    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT,'','SSL'));
}

// load selected payment module
require(DIR_WS_CLASSES . 'payment.php');
// $payment_modules = new payment($_SESSION['payment']);
$payment_modules = new payment('worldpay');
// load the selected shipping module
require(DIR_WS_CLASSES . 'shipping.php');
$shipping_modules = new shipping($_SESSION['shipping']);

require(DIR_WS_CLASSES . 'order.php');
$order = new order;

// prevent 0-entry orders from being generated/spoofed
if (sizeof($order->products) < 1) {
  zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
}

require(DIR_WS_CLASSES . 'order_total.php');
$order_total_modules = new order_total;




$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_BEFORE_ORDER_TOTALS_PRE_CONFIRMATION_CHECK');

$order_totals = $order_total_modules->pre_confirmation_check();

$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_BEFORE_ORDER_TOTALS_PROCESS');
$order_totals = $order_total_modules->process();
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_TOTALS_PROCESS');

// if no module selected for paying the bill and this is not a credit becuase of a gift vouhcer then dump it.
if (!isset($_SESSION['payment']) && !$credit_covers) {
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
}

// load the before_process function from the payment modules
$payment_modules->before_process();
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_PAYMENT_MODULES_BEFOREPROCESS');
// create the order record
$insert_id = $order->create($order_totals, 2);
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE');
// update order history
$payment_modules->after_order_create($insert_id);

$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_PAYMENT_MODULES_AFTER_ORDER_CREATE');
// store the product info to the order
$order->create_add_products($insert_id);
$_SESSION['order_number_created'] = $insert_id;
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS');
//send email notifications
$order->send_order_email($insert_id, 2);
$zco_notifier->notify('NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL');
/**
 * Calculate order amount for display purposes on checkout-success page as well as adword campaigns etc
 */
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    switch ($order_totals[$i]['code']) {
      case 'ot_subtotal': $order_subtotal = $order_totals[$i]['value']; break;
      case 'ot_coupon':   $coupon_amount = $order_totals[$i]['value'];  break;
      case 'ot_group_pricing': $group_pricing_amount = $order_totals[$i]['value']; break;
    }
    //$order_totals[$i]['sort_order']
  }
  $commissionable_order = ($order_subtotal - $coupon_amount - $group_pricing_amount);
  $commissionable_order_formatted = $currencies->format($commissionable_order);

?>