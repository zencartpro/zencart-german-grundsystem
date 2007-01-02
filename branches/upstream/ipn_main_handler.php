<?php
/**
 * ipn_main_handler.php callback handler for paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ipn_main_handler.php 5443 2006-12-29 04:17:13Z drbyte $
 */

/**
 * handle Express Checkout processing:
 */
if (isset($_GET['type']) && $_GET['type'] == 'ec') {
  // this is an EC handler request
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'payment.php');
  // See if we were sent a request to clear the session for PayPal.
  if (isset($_GET['clearSess']) || isset($_GET['ec_cancel'])) {
    // Unset the PayPal EC information.
    unset($_SESSION['paypal_ec_temp']);
    unset($_SESSION['paypal_ec_token']);
    unset($_SESSION['paypal_ec_payer_id']);
    unset($_SESSION['paypal_ec_payer_info']);
  }
  // See if the paypalwpp module is enabled.
  if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
    $paypalwpp_module = 'paypalwpp';
    // init the payment object
    $payment_modules = new payment($paypalwpp_module);
    // set the payment, if they're hitting us here then we know
    // the payment method selected right now.
    $_SESSION['payment'] = $paypalwpp_module;
    // check to see if we have a token sent back from PayPal.
    if (!isset($_SESSION['paypal_ec_token']) || empty($_SESSION['paypal_ec_token'])) {
      // We have not gone to PayPal's website yet in order to grab
      // a token at this time.  This will send the user over to PayPal's
      // website to login and return a token
      $$paypalwpp_module->ec_step1();
    } else {
      // This will push on the second step of the paypalwpp payment
      // module, as we already have a PayPal express checkout token
      // at this point.
      $$paypalwpp_module->ec_step2();
    }
  }
?>
<html>
Processing...
</html>
<?php	

/**
 * If we got here, we are an IPN transaction:
 */

} else {
/**
 * require general paypal functions
 */
require('includes/modules/payment/paypal/paypal_functions.php');
/**
 * require custom paypal application_top.php
 */
require('includes/modules/payment/paypal/ipn_application_top.php');
/**
 * require language defines
 */
if (!isset($_SESSION['language'])) $_SESSION['language'] = 'english';
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php')) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php');
} else {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/checkout_process.php');
}
//require('includes/languages/english/checkout_process.php');

/**
 * do confirmation post-back to PayPal and extract the results for subsequent use
 */
$ipnData  = ipn_postback();
$postdata = $ipnData['postdata'];
$info     = $ipnData['info'];
$new_status = 1;
$isECtransaction = ($_POST['txn_type']=='express_checkout' || $_POST['txn_type']=='cart');

ipn_debug_email('Breakpoint: 1');


/**
 * validate transaction -- email address, matching txn record, etc
 */
if (!ipn_validate_transaction($info, $_POST) === true) {
  if (!$isECtransaction && $_POST['txn_type'] != '') {
    ipn_debug_email('IPN FATAL ERROR::Transaction did not validate');
    die();
  }
}
ipn_debug_email('Breakpoint: 2');
/**
 * is this a sandbox transaction?
 */
if (isset($_POST['test_ipn']) && $_POST['test_ipn'] == 1) {
  ipn_debug_email('IPN NOTICE::Processing SANDBOX transaction.');
}
if (isset($_POST['test_internal']) && $_POST['test_internal'] == 1) {
  ipn_debug_email('IPN NOTICE::Processing INTERNAL TESTING transaction.');
}

ipn_debug_email('Breakpoint: 3');
/**
 * Lookup transaction history information in preparation for matching and relevant updates
 */
$lookupData  = ipn_lookup_transaction($_POST);
$ordersID    = $lookupData['zen_order_id'];
$paypalipnID = $lookupData['paypal_ipn_id'];
$txn_type    = $lookupData['txn_type'];

ipn_debug_email('Breakpoint: 4 ' . 'txn_type=' . $txn_type . ' ordersID = '. $ordersID . ' IPN_id=' . $paypalipnID);

/**
 * evaluate what type of transaction we're processing
 */
ipn_debug_email('IPN DEBUG::uniqueness-test.  Relevant data from POST:' . "\n" . 'txn_type = ' . $txn_type . "\n" . 'parent_txn_id = ' . $_POST['parent_txn_id'] . "\n" . 'txn_id = ' . $_POST['txn_id']);
$txn_type = ipn_determine_txn_type($_POST, $txn_type);
ipn_debug_email('IPN NOTICE::Set transaction type = ' . $txn_type . "\n" . 'POST data:' . "\n" . str_replace('&', " \n&", urldecode($postdata)));
ipn_debug_email('Breakpoint: 5 ' . 'txn_type=' . $txn_type);


/**
 * take action based on transaction type and corresponding requirements
 */
switch ($txn_type) {
  case 'pending-address':
  case 'pending-intl':
  case 'pending-multicurrency':
  case 'pending-verify':
    ipn_debug_email('IPN NOTICE:: '.$txn_type.' transaction -- inserting initial record for reference purposes');
    $paypal_order = ipn_create_order_array($ordersID, $txn_type);
    zen_db_perform(TABLE_PAYPAL, $paypal_order);
    $paypal_order_history = ipn_create_order_history_array($paypalipnID);
    zen_db_perform(TABLE_PAYPAL_PAYMENT_STATUS_HISTORY, $paypal_order_history);
    die();
    break;
  case ($_POST['txn_type'] == 'send_money'):
  case ($_POST['txn_type'] == 'merch_payment'):
  case ($_POST['txn_type'] == 'new_case'):
    // these types are irrelevant to ZC transactions
    ipn_debug_email('IPN NOTICE:: Txn_type not relevant to Zen Cart processing. IPN handler aborted.');
    die();
    break;
  case (substr($_POST['txn_type'],0,7) == 'subscr_'):
    // For now we filter out subscription payments
    ipn_debug_email('IPN NOTICE::Subscription payment - Not currently supported by Zen Cart. IPN handler aborted.');
    die();
    break;

  case 'cart':
  case 'express_checkout':
    // This is an express-checkout transaction -- IPN serves no needed purpose
    if ($_POST['payment_status'] == 'Completed') {
      ipn_debug_email('IPN NOTICE::Express Checkout payment notice on completed order -- IPN Ignored');
      die();
    }
    break;

  case 'unique':
    /**
     * require shipping class
     */
    require(DIR_WS_CLASSES . 'shipping.php');
    /**
     * require payment class
     */
    require(DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment($_SESSION['payment']);
    $shipping_modules = new shipping($_SESSION['shipping']);
    /**
     * require order class
     */
    require(DIR_WS_CLASSES . 'order.php');
    $order = new order();
    /**
     * require order_total class
     */
    require(DIR_WS_CLASSES . 'order_total.php');
    $order_total_modules = new order_total();
    $order_totals = $order_total_modules->process();

    if (valid_payment($info, $order->info['total'], $_SESSION['currency']) === false) {
      die();
    }
    if ($ipnFoundSession === false) {
      ipn_debug_email('IPN NOTICE::Unique but no session - Must be a personal payment, rather than an IPN transaction');
      die();
    }
    $insert_id = $order->create($order_totals);
    $paypal_order = ipn_create_order_array($insert_id, $txn_type);
    zen_db_perform(TABLE_PAYPAL, $paypal_order);
    $pp_hist_id = $db->Insert_ID();
    $paypal_order_history = ipn_create_order_history_array($pp_hist_id);
    zen_db_perform(TABLE_PAYPAL_PAYMENT_STATUS_HISTORY, $paypal_order_history);
    $new_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
    if ($_POST['payment_status'] =='Pending') {
      $new_status = MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID;
      $db->Execute("update " . TABLE_ORDERS  . "
                      set orders_status = " . MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID . "
                      where orders_id = '" . $insert_id . "'");
    }
    $sql_data_array = array('orders_id' => $insert_id,
                            'orders_status_id' => $new_status,
                            'date_added' => 'now()',
                            'comments' => 'PayPal status: ' . $_POST['payment_status'] . ' ' . $_POST['pending_reason']. ' @ '.$_POST['payment_date'] . (($_POST['parent_txn_id'] !='') ? "\n" . ' Parent Trans ID:' . $_POST['parent_txn_id'] : '') . "\n" . ' Trans ID:' . $_POST['txn_id'] . "\n" . ' Amount: ' . $_POST['mc_gross'] . ' ' . $_POST['mc_currency'],
                            'customer_notified' => false
                            );
    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
    $order->create_add_products($insert_id, 2);
    $order->send_order_email($insert_id, 2);
    $_SESSION['cart']->reset(true);
    ipn_debug_email('Breakpoint: Completed IPN order add');
  break;

  case 'parent':
  case 'cleared-address':
  case 'cleared-multicurrency':
  case 'cleared-echeck':
  case 'cleared-authorization':
  case 'cleared-verify':
  case 'cleared-intl':
  case 'echeck-denied':
  case 'echeck-cleared':
  case 'denied-address':
  case 'denied-multicurrency':
  case 'denied-echeck':
  case 'failed-echeck':
  case 'denied-intl':
  case 'denied':
  case 'express-checkout-cleared':
    if ($txn_type == 'parent') {
      $paypal_order = ipn_create_order_array($ordersID, $txn_type);
      zen_db_perform(TABLE_PAYPAL, $paypal_order);
    } else {
      $paypal_order = ipn_create_order_update_array($txn_type);
      zen_db_perform(TABLE_PAYPAL, $paypal_order, 'update', "txn_id='" . $_POST['txn_id'] . "'");
    }
    $paypal_order_history = ipn_create_order_history_array($paypalipnID);
    zen_db_perform(TABLE_PAYPAL_PAYMENT_STATUS_HISTORY, $paypal_order_history);

  switch ($txn_type) {
    case ($_POST['payment_status'] == 'Refunded' || $_POST['payment_status'] == 'Reversed'):
      //payment_status=Refunded
      $new_status = MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID;
      if (define('MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID') && (int)MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID > 0 && $isECtransaction) $new_status = MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID;
    break;
    case 'echeck-denied':
    case 'denied-echeck':
    case 'failed-echeck':
      //payment_status=Denied or failed
      $new_status = ($isECtransaction ? MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID : MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID);
    break;
    case 'echeck-cleared':
      //echeck-cleared
      $new_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
    break;
    case ($txn_type=='express-checkout-cleared' || substr($txn_type,0,8) == 'cleared-'):
      //express-checkout-cleared
      $new_status = MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID;
    break;
    case 'pending-auth':
      // pending authorization
      $new_status = ($isECtransaction ? MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID : MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID);
    break;
    case (substr($txn_type,0,7) == 'denied-'):
      // denied for any other reason - treat as pending for now
    case (substr($txn_type,0,8) == 'pending-'):
      // pending anything
      $new_status = ($isECtransaction ? MODULE_PAYMENT_PAYPALWPP_ORDER_PENDING_STATUS_ID : MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID);
    break;
  }
  // update order status history with new information
  ipn_debug_email('IPN NOTICE::Set new status ' . $new_status . " for order id = " .  $ordersID . ', reason_code = ' . $_POST['pending_reason']);
  if (in_array($_POST['payment_status'], array('Refunded', 'Reversed', 'Denied', 'Failed')) 
      || substr($txn_type,0,8) == 'cleared-' || $txn_type=='echeck-cleared' || $txn_type == 'express-checkout-cleared') {
    if ((int)$new_status == 0) $new_status = 1;
    ipn_update_orders_status_and_history($ordersID, $new_status, $txn_type);
  }
  break;

  default:
    // can't understand result found. Thus, logging and aborting.
    ipn_debug_email('IPN WARNING:: Could not establish txn type ' . $txn_type . "\n" . ' postdata=' . str_replace('&', " \n&", urldecode($postdata)));
}
}
?>