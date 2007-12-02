<?php
/**
 * nochex_apc.php payment module class for Nochex APC payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: nochex_apc.php 6807 2007-08-26 05:08:26Z drbyte $
 */

define('MODULE_PAYMENT_NOCHEX_RM', '2');

if (IS_ADMIN_FLAG === true) {
  include_once(DIR_FS_CATALOG_MODULES . 'payment/nochex_apc/nochex_functions.php');
} else {
  include_once(DIR_WS_MODULES . 'payment/nochex_apc/nochex_functions.php');
}
/**
 * Nochex APC payment method class
 *
 */
class nochex_apc extends base {
  /**
   * string repesenting the payment method
   *
   * @var string
   */
  var $code;
  /**
   * $title is the displayed name for this payment method
   *
   * @var string
    */
  var $title;
  /**
   * $description is a soft name for this payment method
   *
   * @var string
    */
  var $description;
  /**
   * $enabled determines whether this module shows or not... in catalog.
   *
   * @var boolean
    */
  var $enabled;
  /**
    * constructor
    *
    * @param int $nochex_apc_id
    * @return nochex
    */
  function nochex_apc($nochex_apc_id = '') {
    global $order, $messageStack;
    $this->code = 'nochex_apc';
    if (IS_ADMIN_FLAG === true) {
      $this->title = MODULE_PAYMENT_NOCHEX_TEXT_ADMIN_TITLE; // Payment Module title in Admin
    } else {
      $this->title = MODULE_PAYMENT_NOCHEX_TEXT_CATALOG_TITLE; // Payment Module title in Catalog
    }
    $this->description = MODULE_PAYMENT_NOCHEX_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_PAYMENT_NOCHEX_SORT_ORDER;
    $this->enabled = ((MODULE_PAYMENT_NOCHEX_STATUS == 'True') ? true : false);
    if ((int)MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID;
    }
    if (is_object($order)) $this->update_status();
    if (MODULE_PAYMENT_NOCHEX_TESTING == 'Harness') {
      if (!file_exists(DIR_WS_CATALOG . 'nochex_apc_test.php')) {
        $messageStack->add('header', 'WARNING: Nochex TEST mode enabled but nochex_apc_test.php files not found', 'caution');
      }
      $this->form_action_url = DIR_WS_CATALOG . 'nochex_apc_test.php';
    } else {
      $this->form_action_url = 'https://secure.nochex.com/';
    }
  }
  /**
   * calculate zone matches and flag settings to determine whether this module should display to customers or not
    *
    */
  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_NOCHEX_ZONE > 0) ) {
      $check_flag = false;
      $check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_NOCHEX_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
      while (!$check_query->EOF) {
        if ($check_query->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
        $check_query->MoveNext();
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }
  /**
   * JS validation which does error-checking of data-entry if this module is selected for use
   * (Number, Owner, and CVV Lengths)
   *
   * @return string
    */
  function javascript_validation() {
    return false;
  }
  /**
   * Displays Credit Card Information Submission Fields on the Checkout Payment Page
   * In the case of Nochex, this only displays the Nochex title
   *
   * @return array
    */
  function selection() {
    return array('id' => $this->code,
                 'module' => $this->title);
  }
  /**
   * Normally evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   * Since Nochex module is not collecting info, it simply skips this step.
   *
   * @return boolean
   */
  function pre_confirmation_check() {
    return false;
  }
  /**
   * Display Credit Card Information on the Checkout Confirmation Page
   * Since none is collected for Nochex before forwarding to payments page, this is skipped
   *
   * @return boolean
    */
  function confirmation() {
    return false;
  }
  /**
   * Build the data and actions to process when the "Submit" button is pressed on the order-confirmation screen.
   * This sends the data to the payment gateway for processing.
   * (These are hidden fields on the checkout confirmation page)
   *
   * @return string
    */
  function process_button() {
    global $db, $order, $currencies, $currency;

    $this->totalsum = $order->info['total'];

    // save the session stuff permanently in case Nochex loses the session
    $db->Execute("delete from " . TABLE_NOCHEX_SESSION . " where session_id = '" . session_id() . "'");

    $sql = "insert into " . TABLE_NOCHEX_SESSION . " (session_id, saved_session, expiry) values (
            '" . session_id() . "',
            '" . base64_encode(serialize($_SESSION)) . "',
            '" . (time() + (1*60*60*24*2)) . "')";

    $db->Execute($sql);


    $my_currency = "GBP";
    $telephone = preg_replace('/\D/', '', $order->customer['telephone']);
	  $billing_address = array();
	  if(strlen($order->customer['street_address'])>0) $billing_address[] = $order->customer['street_address'];
	  if(strlen($order->customer['suburb'])>0) $billing_address[] = $order->customer['suburb'];
	  if(strlen($order->customer['city'])>0) $billing_address[] = $order->customer['city'];
	  if(strlen($order->customer['state'])>0) $billing_address[] = $order->customer['state'];

    $payment_fields = array();
    switch(MODULE_PAYMENT_NOCHEX_ACCOUNT_TYPE) {
      case "Seller":
		    $payment_fields[] = zen_draw_hidden_field('merchant_id', MODULE_PAYMENT_NOCHEX_EMAIL_ADDRESS);
        $payment_fields[] = zen_draw_hidden_field('order_id', $nochex_order_id);
		    $payment_fields[] = zen_draw_hidden_field('description', MODULE_PAYMENT_NOCHEX_PURCHASE_DECRIPTION_TITLE);
        $payment_fields[] = zen_draw_hidden_field('success_url', zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=nochex_apc', 'SSL'));
        $payment_fields[] = zen_draw_hidden_field('cancel_url', zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        $payment_fields[] = zen_draw_hidden_field('callback_url', zen_href_link('nochex_apc_handler.php', '', 'SSL',false,false,true));
        $payment_fields[] = zen_draw_hidden_field('optional_1', zen_session_name() . '=' . zen_session_id() );
		    $payment_fields[] = zen_draw_hidden_field('billing_fullname', $order->customer['firstname']." ".$order->customer['lastname']);
        $payment_fields[] = zen_draw_hidden_field('billing_address', implode("\r\n", $billing_address));
        $payment_fields[] = zen_draw_hidden_field('billing_postcode', $order->customer['postcode']);
        $payment_fields[] = zen_draw_hidden_field('customer_phone_number', $telephone);
        $payment_fields[] = zen_draw_hidden_field('email_address', $order->customer['email_address']);
        $payment_fields[] = zen_draw_hidden_field('amount', number_format(($order->info['total'] - $order->info['shipping_cost']) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)));
        $payment_fields[] = zen_draw_hidden_field('postage', number_format($order->info['shipping_cost'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)));
        if(MODULE_PAYMENT_NOCHEX_TESTING=="Test") {
			    $payment_fields[] = zen_draw_hidden_field('test_transaction', '100');
		    	$payment_fields[] = zen_draw_hidden_field('test_success_url', zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=nochex_apc', 'SSL'));
		    }
        break;
	    case "Merchant":
        if(strlen(MODULE_PAYMENT_NOCHEX_MERCHANT_ID)>0){
          $merchant_id = MODULE_PAYMENT_NOCHEX_MERCHANT_ID;
        }else{
          $merchant_id = MODULE_PAYMENT_NOCHEX_EMAIL_ADDRESS;
        }
        $payment_fields[] = zen_draw_hidden_field('merchant_id', $merchant_id);
        $payment_fields[] = zen_draw_hidden_field('order_id', $nochex_order_id);
        $payment_fields[] = zen_draw_hidden_field('success_url', zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=nochex_apc', 'SSL'));
        $payment_fields[] = zen_draw_hidden_field('test_success_url', zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=nochex_apc', 'SSL'));
        $payment_fields[] = zen_draw_hidden_field('cancel_url', zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        $payment_fields[] = zen_draw_hidden_field('callback_url', zen_href_link('nochex_apc_handler.php', '', 'SSL',false,false,true));
        $payment_fields[] = zen_draw_hidden_field('amount', number_format(($order->info['total'] - $order->info['shipping_cost']) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)));
        $payment_fields[] = zen_draw_hidden_field('postage', number_format($order->info['shipping_cost'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)));
        $payment_fields[] = zen_draw_hidden_field('optional_1', zen_session_name() . '=' . zen_session_id() );
        $payment_fields[] = zen_draw_hidden_field('billing_fullname', $order->customer['firstname']." ".$order->customer['lastname']);
        $payment_fields[] = zen_draw_hidden_field('billing_address', implode("\r\n", $billing_address));
        $payment_fields[] = zen_draw_hidden_field('billing_postcode', $order->customer['postcode']);
        $payment_fields[] = zen_draw_hidden_field('customer_phone_number', $telephone);
        $payment_fields[] = zen_draw_hidden_field('email_address', $order->customer['email_address']);
        if(MODULE_PAYMENT_NOCHEX_TESTING=="Test"){
          $payment_fields[] = zen_draw_hidden_field('test_transaction', '100');
        }
        break;
    }

    return "\r\n".implode("\r\n", $payment_fields)."\r\n";
  }
  /**
   * Store transaction info to the order and process any results that come back from the payment gateway
   *
   */
  function before_process() {
    global $order_total_modules;
    if (isset($_GET['referer']) && $_GET['referer'] == 'nochex_apc') {
      $this->notify('NOTIFY_PAYMENT_NOCHEX_RETURN_TO_STORE');
      if (MODULE_PAYMENT_NOCHEX_TESTING == 'Harness') {
        // simulate call to ipn_handler.php here
        nochex_simulate_apc_handler((int)$_GET['count']);
      }
      $_SESSION['cart']->reset(true);
      unset($_SESSION['sendto']);
      unset($_SESSION['billto']);
      unset($_SESSION['shipping']);
      unset($_SESSION['payment']);
      unset($_SESSION['comments']);
      unset($_SESSION['cot_gv']);
      $order_total_modules->clear_posts();//ICW ADDED FOR CREDIT CLASS SYSTEM
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
    } else {
      $this->notify('NOTIFY_PAYMENT_NOCHEX_CANCELLED_DURING_CHECKOUT');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }
  }
  /**
    * Checks referrer
    *
    * @param string $zf_domain
    * @return boolean
    */
  function check_referrer($zf_domain) {
    return true;
  }
  /**
    * Build admin-page components
    *
    * @param int $zf_order_id
    * @return string
    */
  function admin_notification($zf_order_id) {
    global $db;
    $output = '';
    $sql = "select * from " . TABLE_NOCHEX . " where order_id = '" . (int)$zf_order_id . "' order by nochex_apc_id DESC LIMIT 1";
    $apc = $db->Execute($sql);
    if ($apc->RecordCount() > 0) require(DIR_FS_CATALOG. DIR_WS_MODULES . 'payment/nochex_apc/nochex_apc_admin_notification.php');
    return $output;
  }
  /**
   * Post-processing activities
   *
   * @return boolean
    */
  function after_process() {
    $_SESSION['order_created'] = '';
    return false;
  }
  /**
   * Used to display error message details
   *
   * @return boolean
    */
  function output_error() {
    return false;
  }
  /**
   * Check to see whether module is installed
   *
   * @return boolean
    */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_NOCHEX_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Install the payment module and its configuration settings
    *
    */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Nochex Module', 'MODULE_PAYMENT_NOCHEX_STATUS', 'True', 'Do you want to accept Nochex payments?', '6', '44', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Nochex Email Address', 'MODULE_PAYMENT_NOCHEX_EMAIL_ADDRESS','".STORE_OWNER_EMAIL_ADDRESS."', 'Registered email address for your Nochex account.<br />NOTE: This must match <strong>EXACTLY </strong>the registered email address on your Nochex account.', '6', '44', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Nochex Account Type', 'MODULE_PAYMENT_NOCHEX_ACCOUNT_TYPE', 'Seller', 'Please select the type of Nochex account you are accepting payments with.', '6', '44', 'zen_cfg_select_option(array(\'Seller\',\'Merchant\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_NOCHEX_MERCHANT_ID', '', 'For Nochex Merchant account holders, allows you to accept payments using a different merchant ID. Has no effect on Seller accounts.', '6', '44', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_NOCHEX_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '44', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Pending Notification Status', 'MODULE_PAYMENT_NOCHEX_PROCESSING_STATUS_ID', '" . DEFAULT_ORDERS_STATUS_ID .  "', 'Set the status of orders made with this payment module that are not yet completed to this value<br />(\'Pending\' recommended)', '6', '44', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID', '2', 'Set the status of orders made with this payment module that have completed payment to this value<br />(\'Processing\' recommended)', '6', '44', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_NOCHEX_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '44', now())");

    // Nochex testing options go here
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_NOCHEX_APC_DEBUG', 'Off', 'Enable debug logging? <br />NOTE: This can REALLY clutter your email inbox!<br />Logging goes to the /includes/modules/payment/nochex_apc/logs folder<br />Email goes to the store-owner address.<strong>Leave OFF for normal operation.</strong>', '6', '44', 'zen_cfg_select_option(array(\'Off\',\'Log File\',\'Log and Email\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Status Live/Testing', 'MODULE_PAYMENT_NOCHEX_TESTING', 'Live', 'Set Nochex module to Live or Test. In Test mode no money is transferred.', '6', '44', 'zen_cfg_select_option(array(\'Live\', \'Test\'), ', now())");

    $this->notify('NOTIFY_PAYMENT_NOCHEX_INSTALLED');
  }
  /**
   * Remove the module and all its settings
    *
    */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE 'MODULE\_PAYMENT\_NOCHEX%'");
    $this->notify('NOTIFY_PAYMENT_NOCHEX_UNINSTALLED');
  }
  /**
   * Internal list of configuration keys used for configuration of the module
   *
   * @return array
    */
  function keys() {
    $keys_list = array(
                       'MODULE_PAYMENT_NOCHEX_STATUS',
                       'MODULE_PAYMENT_NOCHEX_EMAIL_ADDRESS',
                       'MODULE_PAYMENT_NOCHEX_ACCOUNT_TYPE',
                       'MODULE_PAYMENT_NOCHEX_MERCHANT_ID',
                       'MODULE_PAYMENT_NOCHEX_ZONE',
                       'MODULE_PAYMENT_NOCHEX_PROCESSING_STATUS_ID',
                       'MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID',
                       'MODULE_PAYMENT_NOCHEX_SORT_ORDER');

    // nochex testing/debug options go here:
    $keys_list[]='MODULE_PAYMENT_NOCHEX_APC_DEBUG';
    $keys_list[]='MODULE_PAYMENT_NOCHEX_TESTING';  /* this is for test tools, for developers only */
    return $keys_list;
  }
}
