<?php
/**
 * paypalwpp.php payment module class for Paypal Express Checkout / Website Payments Pro / Payflow Pro payment methods
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypalwpp.php 7554 2007-11-30 17:18:05Z drbyte $
 */

/**
 * load the communications layer code
 */
require_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/paypal_curl.php');
/**
 * the PayPal payment module with Express Checkout
 *
 * currently supports US-NVP
 *
 */
class paypalwpp extends base {
  /**
   * name of this module
   *
   * @var string
   */
  var $code;
  /**
   * displayed module title
   *
   * @var string
   */
  var $title;
  /**
   * displayed module description
   *
   * @var string
   */
  var $description;
  /**
   * module status - set based on various config and zone criteria
   *
   * @var string
   */
  var $enabled;
  /**
   * the zone to which this module is restricted for use
   *
   * @var string
   */
  var $zone;
  /**
   * array holding accepted DP/gateway card types
   *
   * @var array
   */
  var $cards = array();
  /**
   * JS code used for gateway/DP mode
   *
   * @var string
   */
  var $cc_type_javascript = '';
  /**
   * JS code used for gateway/DP mode
   *
   * @var string
   */
  var $cc_type_check = '';
  /**
   * debugging flag
   *
   * @var boolean
   */
  var $enableDebugging = false;
  /**
   * is DP enabled ?
   *
   * @var boolean
   */
  var $enableDirectPayment = false;
  /**
   * Determines whether payment page is displayed or not
   *
   * @var boolean
   */
  var $showPaymentPage = false;
  var $flagDisablePaymentAddressChange = false;
  /**
   * sort order of display
   *
   * @var int
   */
  var $sort_order = 0;
  /**
   * Button Source / BN code -- enables the module to work for Zen Cart
   *
   * @var string
   */
  var $buttonSourceEC = 'ZenCart-EC_us';
  /**
   * order status setting for pending orders
   *
   * @var int
   */
  var $order_pending_status = 1;
  /**
   * order status setting for completed orders
   *
   * @var int
   */
  var $order_status = DEFAULT_ORDERS_STATUS_ID;
  /**
   * Debug tools
   */
  var $_logDir = 'includes/modules/payment/paypal/logs/';
  var $_logLevel = 0;
  /**
   * class constructor
   */
  function paypalwpp() {
    include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'paypalwpp.php', 'false'));
    global $order;
    $this->code = 'paypalwpp';
    $this->codeTitle = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC;
    $this->codeVersion = '1.3.8a';
    $this->enableDirectPayment = (MODULE_PAYMENT_PAYPALWPP_DIRECT_ENABLED == 'True');
    $this->enabled = (MODULE_PAYMENT_PAYPALWPP_STATUS == 'True');
    // Set the title & description text based on the mode we're in ... EC vs DP vs admin
    if (IS_ADMIN_FLAG === true) {
      $this->description = sprintf(MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_DESCRIPTION, ' (rev' . $this->codeVersion . ')');
      switch (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE) {
        case ('PayPal'):
          if (MODULE_PAYMENT_PAYPALWPP_DIRECT_ENABLED == 'True') {
            $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_WPP;
          } else {
            $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC;
          }
        break;
        case ('Payflow-UK'):
          $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PRO20;
        break;
        case ('Payflow-US'):
          if (defined('MODULE_PAYMENT_PAYPALWPP_PAYFLOW_EC') && MODULE_PAYMENT_PAYPALWPP_PAYFLOW_EC == 'Yes') {
            $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_EC;
          } else {
            $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_GATEWAY;
          }
        break;
        default:
          $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC;
      }
      if ($this->enabled) {
        if ( (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' && (MODULE_PAYMENT_PAYPALWPP_APISIGNATURE == '' || MODULE_PAYMENT_PAYPALWPP_APIUSERNAME == '' || MODULE_PAYMENT_PAYPALWPP_APIPASSWORD == ''))
          || (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' && (MODULE_PAYMENT_PAYPALWPP_PFPARTNER == '' || MODULE_PAYMENT_PAYPALWPP_PFVENDOR == '' || MODULE_PAYMENT_PAYPALWPP_PFUSER == '' || MODULE_PAYMENT_PAYPALWPP_PFPASSWORD == ''))
          ) $this->title .= '<span class="alert"><strong> NOT CONFIGURED YET</strong></span>';
        if (MODULE_PAYMENT_PAYPALWPP_SERVER =='sandbox') $this->title .= '<strong><span class="alert"> (sandbox active)</span></strong>';
        if (MODULE_PAYMENT_PAYPALWPP_DEBUGGING =='Log File' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING =='Log and Email') $this->title .= '<strong> (Debug)</strong>';
        if (!function_exists('curl_init')) $this->title .= '<strong><span class="alert"> CURL NOT FOUND. Cannot Use.</span></strong>';
      }
    } else {
      $this->description = MODULE_PAYMENT_PAYPALWPP_TEXT_DESCRIPTION;
      $this->title = MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TITLE; //pp
      if (!$this->in_special_checkout() && $this->enableDirectPayment == true) {
        $this->title = MODULE_PAYMENT_PAYPALWPP_TEXT_TITLE; //cc
      }
    }

    if ((!defined('PAYPAL_OVERRIDE_CURL_WARNING') || (defined('PAYPAL_OVERRIDE_CURL_WARNING') && PAYPAL_OVERRIDE_CURL_WARNING != 'True')) && !function_exists('curl_init')) $this->enabled = false;

    $this->enableDebugging = (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING =='Log and Email');
    $this->emailAlerts = (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING =='Log and Email' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Alerts Only');
    $this->doDPonly = (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE =='Payflow-US' && !(defined('MODULE_PAYMENT_PAYPALWPP_PAYFLOW_EC') && MODULE_PAYMENT_PAYPALWPP_PAYFLOW_EC == 'Yes'));
    $this->showPaymentPage = (MODULE_PAYMENT_PAYPALWPP_SKIP_PAYMENT_PAGE == 'No') ? true : false;
    $this->sort_order = MODULE_PAYMENT_PAYPALWPP_SORT_ORDER;

    $this->buttonSourceEC = 'ZenCart-EC_us';
    $this->buttonSourceDP = 'ZenCart-DP_us';
    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK') {
      $this->buttonSourceEC = 'ZenCart-EC_uk';
      $this->buttonSourceDP = 'ZenCart-DP_uk';
    }
    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-US') {
      $this->buttonSourceEC = 'ZenCart-ECGW_us';
      $this->buttonSourceDP = 'ZenCart-GW_us';
    }

    $this->order_pending_status = MODULE_PAYMENT_PAYPALWPP_ORDER_PENDING_STATUS_ID;
    if ((int)MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID;
    }
    $this->new_acct_notify = MODULE_PAYMENT_PAYPALWPP_NEW_ACCT_NOTIFY;
    $this->zone = (int)MODULE_PAYMENT_PAYPALWPP_ZONE;
    if (is_object($order)) $this->update_status();

    if (PROJECT_VERSION_MAJOR != '1' && substr(PROJECT_VERSION_MINOR, 0, 3) != '3.8') $this->enabled = false;

    // offer credit card choices for pull-down menu -- only needed for UK version
    $this->cards = array();
    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK') {
      if (CC_ENABLED_VISA=='1')    $this->cards[] = array('id' => 'Visa', 'text' => 'Visa');
      if (CC_ENABLED_MC=='1')      $this->cards[] = array('id' => 'MasterCard', 'text' => 'MasterCard');
      if (CC_ENABLED_MAESTRO=='1') $this->cards[] = array('id' => 'Maestro', 'text' => 'Maestro');
      if (CC_ENABLED_SWITCH=='1')  $this->cards[] = array('id' => 'Switch', 'text' => 'Switch');
      if (CC_ENABLED_SOLO=='1')    $this->cards[] = array('id' => 'Solo', 'text' => 'Solo');
    }
    // if operating in markflow mode, start EC process when submitting order
    if (!$this->in_special_checkout() && $this->enableDirectPayment == false) {
      $this->form_action_url = zen_href_link('ipn_main_handler.php', 'type=ec&markflow=1&clearSess=1&stage=final', 'SSL', true, true, true);
    }

    // debug setup
    if (!@is_writable($this->_logDir)) $this->_logDir = DIR_FS_CATALOG . $this->_logDir;
    if (!@is_writable($this->_logDir)) $this->_logDir = DIR_FS_SQL_CACHE;
    // Regular mode:
    if ($this->enableDebugging) $this->_logLevel = PEAR_LOG_INFO;
    // DEV MODE:
    if (defined('PAYPAL_DEV_MODE') && PAYPAL_DEV_MODE == 'true') $this->_logLevel = PEAR_LOG_DEBUG;

    if (IS_ADMIN_FLAG === true) $this->tableCheckup();

  }
  /**
   *  Sets payment module status based on zone restrictions etc
   */
  function update_status() {
    global $order, $db;
    if ($this->enabled && (int)$this->zone > 0) {
      $check_flag = false;
      $sql = "SELECT zone_id
              FROM " . TABLE_ZONES_TO_GEO_ZONES . "
              WHERE geo_zone_id = :zoneId
              AND zone_country_id = :countryId
              ORDER BY zone_id";
      $sql = $db->bindVars($sql, ':zoneId', $this->zone, 'integer');
      $sql = $db->bindVars($sql, ':countryId', $order->billing['country']['id'], 'integer');
      $check = $db->Execute($sql);
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

      if (!$check_flag) {
        $this->enabled = false;
      }

      // module cannot be used for purchase > $10,000 USD
      $order_amount = $this->calc_order_amount($order->info['total'], 'USD');
      if ($order_amount > 10000) $this->enabled = false;
    }
  }
  /**
   *  Validate the credit card information via javascript (Number, Owner, and CVV Lengths)
   */
  function javascript_validation() {
    if ($this->in_special_checkout() || $this->enableDirectPayment == false) {
      // if we are in express-checkout flow or if DirectPayment is disabled (ie: just mark flow) then no JS validation req'd
      return false;
    }

    return '  if (payment_value == "' . $this->code . '") {' . "\n" .
           '    var cc_firstname = document.checkout_payment.paypalec_cc_firstname.value;' . "\n" .
           '    var cc_lastname = document.checkout_payment.paypalec_cc_lastname.value;' . "\n" .
           '    var cc_number = document.checkout_payment.paypalec_cc_number.value;' . "\n" .
           '    var cc_checkcode = document.checkout_payment.paypalwpp_cc_checkcode.value;' . "\n" .
           '    if (cc_firstname == "" || cc_lastname == "" || eval(cc_firstname.length) + eval(cc_lastname.length) < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
           '      error_message = error_message + "' . MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_OWNER . '";' . "\n" .
           '      error = 1;' . "\n" .
           '    }' . "\n" .
           '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
           '      error_message = error_message + "' . MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_NUMBER . '";' . "\n" .
           '      error = 1;' . "\n" .
           '    }' . "\n" .
           '  }' . "\n";
  }
  /**
   * Display Credit Card Information Submission Fields on the Checkout Payment Page
   */
  function selection() {
    global $order;
    $this->cc_type_check =
            'var value = document.checkout_payment.paypalec_cc_type.value;' .
            'if (value == "Switch" || value == "Solo") {' .
            '    document.checkout_payment.paypalec_cc_issue_month.disabled = false;' .
            '    document.checkout_payment.paypalec_cc_issue_year.disabled = false;' .
            '    document.checkout_payment.paypalec_cc_checkcode.disabled = true;' .
            '    if (document.checkout_payment.paypalec_cc_issuenumber) document.checkout_payment.paypalec_cc_issuenumber.disabled = true;' .
            '} else if (value == "Maestro") {' .
            '    document.checkout_payment.paypalec_cc_issuenumber.disabled = false;' .
            '    if (document.checkout_payment.paypalec_cc_issue_month) document.checkout_payment.paypalec_cc_issue_month.disabled = true;' .
            '    if (document.checkout_payment.paypalec_cc_issue_year) document.checkout_payment.paypalec_cc_issue_year.disabled = true;' .
            '    document.checkout_payment.paypalec_cc_checkcode.disabled = false;' .
            '} else {' .
            '    if (document.checkout_payment.paypalec_cc_issuenumber) document.checkout_payment.paypalec_cc_issuenumber.disabled = true;' .
            '    document.checkout_payment.paypalec_cc_checkcode.disabled = false;' .
            '}';
    if (sizeof($this->cards) == 0 || $this->enableDirectPayment == false) $this->cc_type_check = '';

    /**
     * if we are NOT processing via the gateway, we will only display MarkFlow payment option, and no CC fields
     */
    if ($this->enableDirectPayment == false) {
      return array('id' => $this->code,
                   'module' => '<img src="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT . '" /><span style="font-size:11px; font-family: Arial, Verdana;"> ' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT . '</span>');
    }

    /**
     * if we ARE processing via the gateway, prepare and display both the CC fields and the PP option
     */
    $expires_month = array();
    $expires_year = array();
    $issue_year = array();
    for ($i = 1; $i < 13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B - (%m)',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i = $today['year']; $i < $today['year'] + 10; $i++) {
      $expires_year[] = array('id' => strftime('%y', mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }

    $onFocus = ' onfocus="methodSelect(\'pmt-' . $this->code . '\')"';

    $fieldsArray = array();
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_FIRSTNAME,
                           'field' => zen_draw_input_field('paypalec_cc_firstname', $order->billing['firstname'], 'id="'.$this->code.'-cc-ownerf"'. $onFocus) . 
                           '<script type="text/javascript">function paypalec_cc_type_check() { ' . $this->cc_type_check . ' } </script>',
                           'tag' => $this->code.'-cc-ownerf');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_LASTNAME,
                           'field' => zen_draw_input_field('paypalec_cc_lastname', $order->billing['lastname'], 'id="'.$this->code.'-cc-ownerl"'. $onFocus),
                           'tag' => $this->code.'-cc-ownerl');
    if (sizeof($this->cards)>0) $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_TYPE,
                            'field' => zen_draw_pull_down_menu('paypalec_cc_type', $this->cards, '', 'onchange="paypalec_cc_type_check();" onblur="paypalec_cc_type_check();"' . 'id="'.$this->code.'-cc-type"'. $onFocus),
                           'tag' => $this->code.'-cc-type');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_NUMBER,
                           'field' => zen_draw_input_field('paypalec_cc_number', $ccnum, 'id="'.$this->code.'-cc-number"' . $onFocus),
                           'tag' => $this->code.'-cc-number');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_EXPIRES,
                           'field' => zen_draw_pull_down_menu('paypalec_cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"' . $onFocus) . '&nbsp;' . zen_draw_pull_down_menu('paypalec_cc_expires_year', $expires_year, '', 'id="'.$this->code.'-cc-expires-year"' . $onFocus),
                           'tag' => $this->code.'-cc-expires-month');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER,
                           'field' => zen_draw_input_field('paypalec_cc_checkcode', '', 'size="4" maxlength="4"' . ' id="'.$this->code.'-cc-cvv"' . $onFocus) . '&nbsp;<small>' . MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION . '</small><script type="text/javascript">paypalec_cc_type_check();</script>',
                           'tag' => $this->code.'-cc-cvv');
    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal')  $fieldsArray[] = array('title' => '<br /><img src="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT . '" /><span style="font-size:11px; font-family: Arial, Verdana;"> ' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT . '</span>');

    $selection = array('id' => $this->code,
                       'module' => MODULE_PAYMENT_PAYPALWPP_TEXT_TITLE,
                       'fields' => $fieldsArray);

    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK' && (CC_ENABLED_SOLO=='1' || CC_ENABLED_SWITCH=='1')) {
      // add extra fields for Switch/Solo cards
      for ($i = $today['year'] - 10; $i <= $today['year']; $i++) {
        $issue_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }
      array_splice($selection['fields'], 4, 0,
                   array(array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_ISSUE,
                               'field' => zen_draw_pull_down_menu('paypalec_cc_issue_month', $expires_month, '', 'id="'.$this->code.'-cc-issue-month"' . $onFocus ) . '&nbsp;' . zen_draw_pull_down_menu('paypalec_cc_issue_year', $issue_year, '', 'id="'.$this->code.'-cc-issue-year"' . $onFocus),
                               'tag' => $this->code.'-cc-issue-month')));
    }
/* @TODO -- convert this to handle Issue Number
    if (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK' && CC_ENABLED_MAESTRO=='1') {
      // add extra field for Maestro cards
      array_splice($selection['fields'], 4, 0,
                   array(array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_MAESTRO_ISSUENUMBER,
                               'field' => zen_draw_pull_down_menu('paypalec_cc_issuenumber', $expires_month, '', 'id="'.$this->code.'-cc-issue-month"' . $onFocus ),
                               'tag' => $this->code.'-cc-issue-month')));
    }
*/
    return $selection;
  }
  /**
   * This is the credit card check done between checkout_payment and
   * checkout_confirmation (called from checkout_confirmation).
   * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   */
  function pre_confirmation_check() {
    // If this is an EC checkout, do nothing.
    if ($this->in_special_checkout() || $this->enableDirectPayment == false) {
      return false;
    }

    include(DIR_WS_CLASSES . 'cc_validation.php');
    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($_POST['paypalec_cc_number'],
                                       $_POST['paypalec_cc_expires_month'], $_POST['paypalec_cc_expires_year'],
                                       $_POST['paypalec_cc_issue_month'], $_POST['paypalec_cc_issue_year']);
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

    $_POST['paypalec_cc_checkcode'] = preg_replace('/[^0-9]/i', '', $_POST['paypalec_cc_checkcode']);
    $_POST['paypalec_cc_issuenumber'] = preg_replace('/[^0-9]/i', '', $_POST['paypalec_cc_issuenumber']);

    if (($result === false) || ($result < 1) ) {
      $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_CARD_ERROR . '<br />' . $error, false, FILENAME_CHECKOUT_PAYMENT);
    }

    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
    $this->cc_expiry_month = $cc_validation->cc_expiry_month;
    $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    $this->cc_checkcode = $_POST['paypalec_cc_checkcode'];
  }
  /**
   * Display Credit Card Information for review on the Checkout Confirmation Page
   */
  function confirmation() {
    if ($this->in_special_checkout() || $this->enableDirectPayment == false) {
      $confirmation = array('title' => '', 'fields' => array());
    } else {
      $confirmation = array('title' => '',
                            'fields' => array(array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_FIRSTNAME,
                                                    'field' => $_POST['paypalec_cc_firstname']),
                                              array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_LASTNAME,
                                                    'field' => $_POST['paypalec_cc_lastname']),
                                              array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_TYPE,
                                                    'field' => $this->cc_card_type),
                                              array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($_POST['paypalec_cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['paypalec_cc_number']) - 8)) . substr($_POST['paypalec_cc_number'], -4)),
                                              array('title' => MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['paypalec_cc_expires_month'], 1, '20' . $_POST['paypalec_cc_expires_year'])))));
    }
    return $confirmation;
  }
  /**
   * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
   */
  function process_button() {
    if ($this->in_special_checkout() || $this->enableDirectPayment == false) {
      $process_button_string = '';
    } else {
      $_SESSION['paypal_ec_markflow'] = 1;
      $process_button_string = zen_draw_hidden_field('ec_cc_type', $_POST['paypalec_cc_type']) .
      zen_draw_hidden_field('ec_cc_expdate_month', $_POST['paypalec_cc_expires_month']) .
      zen_draw_hidden_field('ec_cc_expdate_year', $_POST['paypalec_cc_expires_year']) .
      zen_draw_hidden_field('ec_cc_issuedate_month', $_POST['paypalec_cc_issue_month']) .
      zen_draw_hidden_field('ec_cc_issuedate_year', $_POST['paypalec_cc_issue_year']) .
      zen_draw_hidden_field('ec_cc_number', $_POST['paypalec_cc_number']) .
      zen_draw_hidden_field('ec_cc_checkcode', $_POST['paypalec_cc_checkcode']) .
      zen_draw_hidden_field('ec_payer_firstname', $_POST['paypalec_cc_firstname']) .
      zen_draw_hidden_field('ec_payer_lastname', $_POST['paypalec_cc_lastname']);
    }
    return $process_button_string;
  }
  /**
   * Prepare and submit the final authorization to PayPal via the appropriate means as configured
   */
  function before_process() {
    global $order, $doPayPal;
    $options = array();
    $optionsShip = array();
    $optionsNVP = array();

    $options = $this->getLineItemDetails();

    //$this->zcLog('before_process - 1', 'Have line-item details:' . "\n" . print_r($options, true));

    $doPayPal = $this->paypal_init();
    if ($this->in_special_checkout() || $this->enableDirectPayment == false) {
    $this->zcLog('before_process - EC-1', 'Beginning EC mode');
     /****************************************
      * Do EC checkout
      ****************************************/
      // do not allow blank address to be sent to PayPal
      if ($_SESSION['paypal_ec_payer_info']['ship_street_1'] != '' && $_SESSION['paypal_ec_payer_info']['ship_address_status'] != 'None') {
        $options = array_merge($options, 
                 array('SHIPTONAME'   => $_SESSION['paypal_ec_payer_info']['ship_name'],
                       'SHIPTOSTREET' => $_SESSION['paypal_ec_payer_info']['ship_street_1'],
                       'SHIPTOSTREET2'=> $_SESSION['paypal_ec_payer_info']['ship_street_2'],
                       'SHIPTOCITY'   => $_SESSION['paypal_ec_payer_info']['ship_city'],
                       'SHIPTOSTATE'  => $_SESSION['paypal_ec_payer_info']['ship_state'],
                       'SHIPTOZIP'    => $_SESSION['paypal_ec_payer_info']['ship_postal_code'],
                       'SHIPTOCOUNTRYCODE'=> $_SESSION['paypal_ec_payer_info']['ship_country_code'],
                       ));
        $this->zcLog('before_process - EC-2', 'address overrides added:' . "\n" . print_r($options, true));
      }

      $this->zcLog('before_process - EC-3', 'address info added:' . "\n" . print_r($options, true));

      // If the customer has changed their shipping address, 
      // override the shipping address in PayPal with the shipping
      // address that is selected in Zen Cart.
      if ($order->delivery['street_address'] != $_SESSION['paypal_ec_payer_info']['ship_street_1'] && $_SESSION['paypal_ec_payer_info']['ship_street_1'] != '') {
        $_GET['markflow'] = 2;
        if (($address_arr = $this->getOverrideAddress()) !== false) {
          // set the override var
          $options['ADDROVERRIDE'] = 1;
          // set the address info
          $options['SHIPTONAME']    = $address_arr['entry_firstname'] . ' ' . $address_arr['entry_lastname'];
          $options['SHIPTOSTREET']  = $address_arr['entry_street_address'];
          if ($address_arr['entry_suburb'] != '') $options['SHIPTOSTREET2'] = $address_arr['entry_suburb'];
          $options['SHIPTOCITY']    = $address_arr['entry_city'];
          $options['SHIPTOZIP']     = $address_arr['entry_postcode'];
          $options['SHIPTOSTATE']   = $address_arr['zone_code'];
          $options['SHIPTOCOUNTRYCODE'] = $address_arr['countries_iso_code_2'];
        }
      }
      // if these optional parameters are blank, remove them from transaction
      if (isset($options['SHIPTOSTREET2']) && trim($options['SHIPTOSTREET2']) == '') unset($options['SHIPTOSTREET2']);
      if (isset($options['SHIPTOPHONE']) && trim($options['SHIPTOPHONE']) == '') unset($options['SHIPTOPHONE']);

      // if State is not supplied, repeat the city so that it's not blank, otherwise PayPal croaks
      if ((!isset($options['SHIPTOSTATE']) || trim($options['SHIPTOSTATE']) == '') && $options['SHIPTOCITY'] != '') $options['SHIPTOSTATE'] = $options['SHIPTOCITY'];

      $options['BUTTONSOURCE'] = $this->buttonSourceEC;
      $options['CURRENCY'] = $this->selectCurrency($order->info['currency']);
      $order_amount = $this->calc_order_amount($order->info['total'], $options['CURRENCY']);

      // unused at present:
      // $options['CUSTOM'] = '';
      // $options['INVNUM'] = '';
      // $options['DESC'] = '';

      // debug output
      $this->zcLog('before_process - EC-4', 'info being submitted:' . "\n" . $_SESSION['paypal_ec_token'] . ' ' . $_SESSION['paypal_ec_payer_id'] . ' ' . number_format($order_amount, 2) .  "\n" . print_r($options, true));

      $response = $doPayPal->DoExpressCheckoutPayment($_SESSION['paypal_ec_token'],
                                                      $_SESSION['paypal_ec_payer_id'],
                                                      number_format((isset($options['AMT']) ? $options['AMT'] : $order_amount), 2),
                                                      $options);

      $this->zcLog('before_process - EC-5', 'resultset:' . "\n" . urldecode(print_r($response, true)));

      // CHECK RESPONSE -- if error, actions are taken in the errorHandler
      $error = $this->_errorHandler($response, 'DoExpressCheckoutPayment');

      // SUCCESS
      $this->payment_type = MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TYPE;
      $this->responsedata = $response;
      if ($response['PAYMENTTYPE'] != '') $this->payment_type .=  ' (' . urldecode($response['PAYMENTTYPE']) . ')';

      $this->transaction_id = trim($response['PNREF'] . ' ' . $response['TRANSACTIONID']);
      if (empty($response['PENDINGREASON']) || 
          $response['PENDINGREASON'] == 'none' || 
          $response['PENDINGREASON'] == 'completed' || 
          $response['PAYMENTSTATUS'] == 'Completed') {
        $this->payment_status = 'Completed';
        if ($this->order_status > 0) $order->info['order_status'] = $this->order_status;
      } else {
        $this->payment_status = 'Pending (' . $response['PENDINGREASON'] . ')';
        $order->info['order_status'] = $this->order_pending_status;
      }
      $this->avs = 'N/A';
      $this->cvv2 = 'N/A';
      $this->correlationid = $response['CORRELATIONID'];
      $this->transactiontype = $response['TRANSACTIONTYPE'];
      $this->payment_time = urldecode($response['ORDERTIME']);
      $this->feeamt = urldecode($response['FEEAMT']);
      $this->taxamt = urldecode($response['TAXAMT']);
      $this->pendingreason = $response['PENDINGREASON'];
      $this->reasoncode = $response['REASONCODE'];
//      $this->numitems = $_SESSION['cart']->count_contents();
      $this->numitems = sizeof($order->products);
      $this->amt = urldecode($response['AMT'] . ' ' . $response['CURRENCYCODE']);
      $this->auth_code = (isset($this->response['AUTHCODE'])) ? $this->response['AUTHCODE'] : $this->response['TOKEN'];

    } else {
      /****************************************
       * Do DP checkout
       ****************************************/
      $this->zcLog('before_process - DP-1', 'Beginning DP mode');
      // Set state fields depending on what PayPal wants to see for that country
      $this->setStateAndCountry($order->billing);
      if (zen_not_null($order->delivery['street_address'])) {
        $this->setStateAndCountry($order->delivery);
      }

      // Validate credit card data
      include(DIR_WS_CLASSES . 'cc_validation.php');
      $cc_validation = new cc_validation();
      $response = $cc_validation->validate($_POST['ec_cc_number'], $_POST['ec_cc_expdate_month'], $_POST['ec_cc_expdate_year'], 
                                           $_POST['ec_cc_issuedate_month'], $_POST['ec_cc_issuedate_year']);
      $error = '';
      switch ($response) {
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

      $this->zcLog('before_process - DP-2', 'CC validation results: ' . $error . '(' . $response . ')');

      if ($response == false || $response < 1) {
        $this->terminateEC($error, false, FILENAME_CHECKOUT_PAYMENT);
      }
      if (!in_array($cc_validation->cc_type, array('Visa', 'MasterCard', 'Switch', 'Solo', 'Discover', 'American Express', 'Maestro'))) { 
        $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_CARD, false, FILENAME_CHECKOUT_PAYMENT);
      }

      $this->zcLog('before_process - DP-3', 'CC info: ' . $cc_validation->cc_type . ' ' . substr($cc_validation->cc_number, 0, 4) . str_repeat('X', (strlen($cc_validation->cc_number) - 8)) . substr($cc_validation->cc_number, -4));

      // if CC validation passed, continue using the validated data
      $cc_type = $cc_validation->cc_type;
      $cc_number = $cc_validation->cc_number;
      $cc_first_name = $_POST['ec_payer_firstname'];
      $cc_last_name = $_POST['ec_payer_lastname'];
      $cc_checkcode = $_POST['ec_cc_checkcode'];
      $cc_expdate_month = $cc_validation->cc_expiry_month;
      $cc_expdate_year = $cc_validation->cc_expiry_year;
      $cc_issuedate_month = $_POST['ec_cc_issuedate_month'];
      $cc_issuedate_year = $_POST['ec_cc_issuedate_year'];
      $cc_owner_ip = zen_get_ip_address();


      // If they're still here, set some of the order object's variables.
      $order->info['cc_type'] = $cc_type;
      $order->info['cc_number'] = substr($cc_number, 0, 4) . str_repeat('X', (strlen($cc_number) - 8)) . substr($cc_number, -4);
      $order->info['cc_owner'] = $cc_first_name . ' ' . $cc_last_name;
      $order->info['cc_expires'] = $cc_expdate_month . substr($cc_expdate_year, -2);
      $order->info['ip_address'] = $cc_owner_ip;

      // Set currency
      $my_currency = $this->selectCurrency($order->info['currency'], 'DP');
/*
      // if CC is switch or solo, must be GBP
      if (in_array($cc_type, array('Switch', 'Solo', 'Maestro'))) {
        $my_currency = 'GBP';
      }
*/
      $order_amount = $this->calc_order_amount($order->info['total'], $my_currency);

      // Initialize the paypal caller object.
      $doPayPal = $this->paypal_init();
      $optionsAll = array_merge($options, 
                    array('STREET'      => $order->billing['street_address'],
                          'ZIP'         => $order->billing['postcode']));
      $optionsNVP = array('CITY'        => $order->billing['city'],
                          'STATE'       => $order->billing['state'],
                          'COUNTRYCODE' => $order->billing['country']['iso_code_2'],
                          'EXPDATE'     => $cc_expdate_month . $cc_expdate_year );

      $optionsShip = array();
      if (isset($order->delivery) && $order->delivery['street_address'] != '') {
        $optionsShip= array('SHIPTONAME'   => ($order->delivery['name'] == '' ? $order->delivery['firstname'] . ' ' . $order->delivery['lastname'] : $order->delivery['name']),
                            'SHIPTOSTREET' => $order->delivery['street_address'],
                            'SHIPTOSTREET2'=> $order->delivery['suburb'],
                            'SHIPTOCITY'   => $order->delivery['city'],
                            'SHIPTOZIP'    => $order->delivery['postcode'],
                            'SHIPTOSTATE'  => $order->delivery['state'],
                            'SHIPTOCOUNTRYCODE'=> $order->delivery['country']['iso_code_2']);
      }
      // if these optional parameters are blank, remove them from transaction
      if (isset($optionsShip['SHIPTOSTREET2']) && trim($optionsShip['SHIPTOSTREET2']) == '') unset($optionsShip['SHIPTOSTREET2']);
      if (isset($optionsShip['SHIPTOPHONE']) && trim($optionsShip['SHIPTOPHONE']) == '') unset($optionsShip['SHIPTOPHONE']);

      // if State is not supplied, repeat the city so that it's not blank, otherwise PayPal croaks
      if (!isset($optionsShip['SHIPTOSTATE']) || trim($optionsShip['SHIPTOSTATE']) == '') $optionsShip['SHIPTOSTATE'] = $optionsShip['SHIPTOCITY'];

      // Payment Transaction/Authorization Mode
      $optionsNVP['PAYMENTACTION'] = (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Sale';
//      if (in_array($cc_type, array('Switch', 'Solo'))) {
//        $optionsNVP['PAYMENTACTION'] = 'Authorization';
//      }
      $optionsAll['BUTTONSOURCE'] = $this->buttonSourceDP;
      $optionsAll['CURRENCY']     = $my_currency;
      $optionsAll['IPADDRESS']    = $cc_owner_ip;
      if ($cc_issuedate_month && $cc_issuedate_year) {
        $optionsAll['CARDSTART'] = $cc_issuedate_month . substr($cc_issuedate_year, -2);
      }

      // unused at present:
      // $options['CUSTOM'] = '';
      // $options['INVNUM'] = '';
      // $options['DESC'] = '';

      $this->zcLog('before_process - DP-4', 'optionsAll: ' . print_r($optionsAll, true) . "\n" . 'optionsNVP: ' . print_r($optionsNVP, true) . "\n" . 'optionsShip' . print_r($optionsShip, true) . "\n" . 'Rest of data: ' . "\n" . number_format($order_amount, 2) . ' ' . $cc_expdate_month . ' ' . substr($cc_expdate_year, -2) . ' ' . $cc_first_name . ' ' . $cc_last_name . ' ' . $cc_type);

      $response = $doPayPal->DoDirectPayment(number_format($order_amount, 2),
                                           $cc_number,
                                           $cc_checkcode,
                                           $cc_expdate_month . substr($cc_expdate_year, -2),
                                           $cc_first_name, $cc_last_name,
                                           $cc_type,
                                           $optionsAll, array_merge($optionsNVP, $optionsShip));

      $this->zcLog('before_process - DP-5', 'resultset:' . "\n" . print_r($response, true));

      // CHECK RESPONSE
      $error = $this->_errorHandler($response, 'DoDirectPayment');

      $this->feeamt = '';
      $this->taxamt = '';
      $this->pendingreason = '';
      $this->reasoncode = '';
      $this->numitems = sizeof($order->products);
      $this->responsedata = $response;

      if ($response['PNREF']) {
      // PNREF only comes from payflow mode
        $this->payment_type = MODULE_PAYMENT_PAYPALWPP_PF_TEXT_TYPE;
        $this->transaction_id = $response['PNREF'];
        $this->payment_status = (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Completed';
        $this->avs = 'AVSADDR: ' . $response['AVSADDR'] . ', AVSZIP: ' . $response['AVSZIP'] . ', IAVS: ' . $response['IAVS'];
        $this->cvv2 = $response['CVV2MATCH'];
        $this->amt = $order_amount . ' ' . $my_currency;
        $this->payment_time = date('Y-m-d h:i:s');
        $this->responsedata['CURRENCYCODE'] = $my_currency;
        $this->responsedata['EXCHANGERATE'] = $order->info['currency_value'];
        $this->auth_code = $this->response['AUTHCODE'];
      } else {
        // here we're in NVP mode
        $this->transaction_id = $response['TRANSACTIONID'];
        $this->payment_type = MODULE_PAYMENT_PAYPALWPP_DP_TEXT_TYPE;
        $this->payment_status = (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Completed';
        $this->pendingreason = (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Auth Only') ? 'authorization' : '';
        $this->avs = $response['AVSCODE'];
        $this->cvv2 = $response['CVV2MATCH'];
        $this->correlationid = $response['CORRELATIONID'];
        $this->payment_time = urldecode($response['TIMESTAMP']);
        $this->amt = urldecode($response['AMT'] . ' ' . $response['CURRENCYCODE']);
        $this->auth_code = (isset($this->response['AUTHCODE'])) ? $this->response['AUTHCODE'] : $this->response['TOKEN'];
        $this->transactiontype = 'cart';
      }
    }
  }
  /**
   * When the order returns from the processor, this stores the results in order-status-history and logs data for subsequent use
   */
  function after_process() {
    global $insert_id, $db, $order;
    // add a new OSH record for this order's PP details
    $commentString = "Transaction ID: :transID: " . 
                     (isset($this->responsedata['PPREF']) ? "\nPPRef: " . $this->responsedata['PPREF'] : "") . 
                     (isset($this->responsedata['AUTHCODE'])? "\nAuthCode: " . $this->responsedata['AUTHCODE'] : "") . 
                                 "\nPayment Type: :pmtType: " . 
                                 "\nTimestamp: :pmtTime: " . 
                                 "\nPayment Status: :pmtStatus: " . 
                     ($this->avs != 'N/A' ? "\nAVS Code: ".$this->avs."\nCVV2 Code: ".$this->cvv2 : '') .
                                 "\nAmount: :orderAmt: ";
    $commentString = $db->bindVars($commentString, ':transID:', $this->transaction_id, 'noquotestring');
    $commentString = $db->bindVars($commentString, ':pmtType:', $this->payment_type, 'noquotestring');
    $commentString = $db->bindVars($commentString, ':pmtTime:', $this->payment_time, 'noquotestring');
    $commentString = $db->bindVars($commentString, ':pmtStatus:', $this->payment_status, 'noquotestring');
    $commentString = $db->bindVars($commentString, ':orderAmt:', $this->amt, 'noquotestring');

    $sql_data_array= array(array('fieldName'=>'orders_id', 'value'=>$insert_id, 'type'=>'integer'),
                           array('fieldName'=>'orders_status_id', 'value'=>$order->info['order_status'], 'type'=>'integer'),
                           array('fieldName'=>'date_added', 'value'=>'now()', 'type'=>'noquotestring'),
                           array('fieldName'=>'customer_notified', 'value'=>0, 'type'=>'integer'),
                           array('fieldName'=>'comments', 'value'=>$commentString, 'type'=>'string'));
    $db->perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);



    // store the PayPal order meta data -- used for later matching and back-end processing activities
    $paypal_order = array('order_id' => $insert_id,
                          'txn_type' => $this->transactiontype,
                          'module_name' => $this->code,
                          'module_mode' => MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,
                          'reason_code' => $this->reasoncode,
                          'payment_type' => $this->payment_type,
                          'payment_status' => $this->payment_status,
                          'pending_reason' => $this->pendingreason,
                          'invoice' => urldecode($_SESSION['paypal_ec_token'] . $this->responsedata['PPREF']),
                          'first_name' => $_SESSION['paypal_ec_payer_info']['payer_firstname'],
                          'last_name' => $_SESSION['paypal_ec_payer_info']['payer_lastname'],
                          'payer_business_name' => $_SESSION['paypal_ec_payer_info']['payer_business'],
                          'address_name' => $_SESSION['paypal_ec_payer_info']['ship_name'],
                          'address_street' => $_SESSION['paypal_ec_payer_info']['ship_street_1'],
                          'address_city' => $_SESSION['paypal_ec_payer_info']['ship_city'],
                          'address_state' => $_SESSION['paypal_ec_payer_info']['ship_state'],
                          'address_zip' => $_SESSION['paypal_ec_payer_info']['ship_postal_code'],
                          'address_country' => $_SESSION['paypal_ec_payer_info']['ship_country'],
                          'address_status' => $_SESSION['paypal_ec_payer_info']['ship_address_status'],
                          'payer_email' => $_SESSION['paypal_ec_payer_info']['payer_email'],
                          'payer_id' => $_SESSION['paypal_ec_payer_id'],
                          'payer_status' => $_SESSION['paypal_ec_payer_info']['payer_status'],
                          'payment_date' => trim(preg_replace('/[^0-9-:]/', ' ', $this->payment_time)),
                          'business' => '',
                          'receiver_email' => (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' ? MODULE_PAYMENT_PAYPALWPP_PFVENDOR : str_replace('_api1', '', MODULE_PAYMENT_PAYPALWPP_APIUSERNAME)),
                          'receiver_id' => '',
                          'txn_id' => $this->transaction_id,
                          'parent_txn_id' => '',
                          'num_cart_items' => (float)$this->numitems,
                          'mc_gross' => (float)$this->amt,
                          'mc_fee' => (float)urldecode($this->feeamt),
                          'mc_currency' => $this->responsedata['CURRENCYCODE'],
                          'settle_amount' => (float)urldecode($this->responsedata['SETTLEAMT']),
                          'settle_currency' => $this->responsedata['CURRENCYCODE'],
                          'exchange_rate' => (urldecode($this->responsedata['EXCHANGERATE']) > 0 ? urldecode($this->responsedata['EXCHANGERATE']) : 1.0),
                          'notify_version' => '0',
                          'verify_sign' =>'',
                          'date_added' => 'now()',
                          'memo' => '{Record generated by payment module}'
                         );
    zen_db_perform(TABLE_PAYPAL, $paypal_order);

    // Unregister the paypal session variables, making it necessary to start again for another purchase
    unset($_SESSION['paypal_ec_temp']);
    unset($_SESSION['paypal_ec_token']);
    unset($_SESSION['paypal_ec_payer_id']);
    unset($_SESSION['paypal_ec_payer_info']);
    unset($_SESSION['paypal_ec_final']);
    unset($_SESSION['paypal_ec_markflow']);
  }
  /**
    * Build admin-page components
    *
    * @param int $zf_order_id
    * @return string
    */
  function admin_notification($zf_order_id) {
    global $db;
    $module = $this->code;
    $output = '';
    $response = $this->_GetTransactionDetails($zf_order_id);
    //$response = $this->_TransactionSearch('2006-12-01T00:00:00Z', $zf_order_id);
    $sql = "SELECT * from " . TABLE_PAYPAL . " WHERE order_id = :orderID 
            AND parent_txn_id = '' AND order_id > 0 
            ORDER BY paypal_ipn_id DESC LIMIT 1";
    $sql = $db->bindVars($sql, ':orderID', $zf_order_id, 'integer');
    $ipn = $db->Execute($sql);
    if ($ipn->RecordCount() == 0) $ipn->fields = array(); 
    if (file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/paypalwpp_admin_notification.php')) require(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/paypalwpp_admin_notification.php');
    return $output;
  }
  /**
   * Used to read details of an existing transaction.  FOR FUTURE USE.
   */
  function _GetTransactionDetails($oID) {
    global $db, $messageStack, $doPayPal;
    $doPayPal = $this->paypal_init();
    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    /**
     * Read data from PayPal
     */
    $response = $doPayPal->GetTransactionDetails($txnID);

    $error = $this->_errorHandler($response, 'GetTransactionDetails', 10007);
    if ($error === false) {
      return false;
    } else {
      return $response;
    }
  }
  /**
   * Used to read details of existing transactions.  FOR FUTURE USE.
   */
  function _TransactionSearch($startDate = '', $oID = '', $criteria = '') {
    global $db, $messageStack, $doPayPal;
    $doPayPal = $this->paypal_init();
    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    $startDate = $zc_ppHist->fields['payment_date'];
    $timeval = time();
    if ($startDate == '') $startDate = date('Y-m-d', $timeval) . 'T' . date('h:i:s', $timeval) . 'Z';
    /**
     * Read data from PayPal
     */
    $response = $doPayPal->TransactionSearch($startDate, $txnID, $email, $criteria);

    $error = $this->_errorHandler($response, 'TransactionSearch');
    if ($error === false) {
      return false;
    } else {
      return $response;
    }
  }
  /**
   * Display appropriate error message when needed
   */
  function get_error() {
    include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'paypalwpp.php', 'false'));
    $error = array('title' => MODULE_PAYMENT_PAYPALWPP_ERROR_HEADING,
                   'error' => ((isset($_GET['error'])) ? stripslashes(urldecode($_GET['error'])) : MODULE_PAYMENT_PAYPALWPP_TEXT_CARD_ERROR));
    return $error;
  }
  /**
   * Evaluate installation status of this module. Returns true if the status key is found.
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPALWPP_STATUS'");
      $this->_check = !$check_query->EOF;
    }
    return $this->_check;
  }
  /**
   * Installs all the configuration keys for this module
   */
  function install() {
    global $db;

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_PAYPALWPP_STATUS', 'True', 'Do you want to enable this payment module?', '6', '25', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Direct Payment', 'MODULE_PAYMENT_PAYPALWPP_DIRECT_ENABLED', 'False', 'Would you like to enable credit card payments through PayPal DIRECTLY on your website? <br />(<strong>NOTE:</strong> You need to be subscribed to Website Payments Pro or Payflow Pro to use this feature.)', '6', '25', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Live or Sandbox', 'MODULE_PAYMENT_PAYPALWPP_SERVER', 'live', '<strong>Live: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', '6', '25', 'zen_cfg_select_option(array(\'live\', \'sandbox\'), ', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Require Confirmed Address', 'MODULE_PAYMENT_PAYPALWPP_CONFIRMED_ADDRESS', 'No', 'Do you want to require that your customers use a *confirmed* address when choosing their shipping address in PayPal?', '6', '25',  'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Select Cheapest Shipping Automatically', 'MODULE_PAYMENT_PAYPALWPP_AUTOSELECT_CHEAPEST_SHIPPING', 'Yes', 'When customer returns from PayPal, do we want to automatically select the Cheapest shipping method and skip the shipping page? (making it more *express*)<br />Note: enabling this means the customer does *not* have easy access to select an alternate shipping method (without going back to the Checkout-Step-1 page)', '6', '25',  'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Skip Payment Page', 'MODULE_PAYMENT_PAYPALWPP_SKIP_PAYMENT_PAGE', 'Yes', 'If the customer is checking out with Express Checkout, do you want to skip the checkout payment page, making things more *express*? <br /><strong>(NOTE: The Payment Page will auto-display regardless of this setting if you have Coupons or Gift Certificates enabled in your store.)</strong>', '6', '25',  'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Automatic Account Creation', 'MODULE_PAYMENT_PAYPALWPP_NEW_ACCT_NOTIFY', 'Yes', 'If a visitor is not an existing customer, a Zen Cart account is created for them.  Would you like make it a permanent account and send them an email containing their login information?<br />NOTE: Permanent accounts are auto-created if the customer purchases downloads or gift certificates, regardless of this setting.', '6', '25', 'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPALWPP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPALWPP_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '25', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID', '2', 'Set the status of orders paid with this payment module to this value. <br /><strong>Recommended: Processing[2]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Unpaid Order Status', 'MODULE_PAYMENT_PAYPALWPP_ORDER_PENDING_STATUS_ID', '1', 'Set the status of unpaid orders made with this payment module to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID', '1', 'Set the status of refunded orders to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PayPal Page Style', 'MODULE_PAYMENT_PAYPALWPP_PAGE_STYLE', 'Primary', 'The page-layout style you want customers to see when they visit the PayPal site. You can configure your <strong>Custom Page Styles</strong> in your PayPal Profile settings. This value is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment Action', 'MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE', 'Final Sale', 'How do you want to obtain payment?<br /><strong>Default: Final Sale</strong>', '6', '25', 'zen_cfg_select_option(array(\'Auth Only\', \'Final Sale\'), ',  now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Currency', 'MODULE_PAYMENT_PAYPALWPP_CURRENCY', 'Selected Currency', 'Which currency should the order be sent to PayPal as? <br />NOTE: if an unsupported currency is sent to PayPal, it will be auto-converted to USD (or GBP if using UK account)<br /><strong>Default: Selected Currency</strong>', '6', '25', 'zen_cfg_select_option(array(\'Selected Currency\', \'Only USD\', \'Only AUD\', \'Only CAD\', \'Only EUR\', \'Only GBP\', \'Only CHF\', \'Only CZK\', \'Only DKK\', \'Only HKD\', \'Only HUF\', \'Only JPY\', \'Only NOK\', \'Only NZD\', \'Only PLN\', \'Only SEK\', \'Only SGD\', \'Only THB\'), ',  now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Signature -- Username', 'MODULE_PAYMENT_PAYPALWPP_APIUSERNAME', '', 'The API Username from your PayPal API Signature settings under *API Access*. This value typically looks like an email address and is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) values ('API Signature -- Password', 'MODULE_PAYMENT_PAYPALWPP_APIPASSWORD', '', 'The API Password from your PayPal API Signature settings under *API Access*. This value is a 16-character code and is case-sensitive.', '6', '25', now(), 'zen_cfg_password_input(', 'zen_cfg_password_display')");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Signature -- Signature Code', 'MODULE_PAYMENT_PAYPALWPP_APISIGNATURE', '', 'The API Signature from your PayPal API Signature settings under *API Access*. This value is a 56-character code, and is case-sensitive.', '6', '25', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: User', 'MODULE_PAYMENT_PAYPALWPP_PFUSER', '', 'If you set up one or more additional users on the account, this value is the ID of the user authorized to process transactions. Otherwise it should be the same value as VENDOR. This value is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: Partner', 'MODULE_PAYMENT_PAYPALWPP_PFPARTNER', 'ZenCart', 'Your Payflow Partner linked to your Payflow account. This value is case-sensitive.<br />Typical values: <strong>PayPal</strong> or <strong>ZenCart</strong>', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: Vendor', 'MODULE_PAYMENT_PAYPALWPP_PFVENDOR', '', 'Your merchant login ID that you created when you registered for the Payflow Pro account. This value is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) values ('PAYFLOW: Password', 'MODULE_PAYMENT_PAYPALWPP_PFPASSWORD', '', 'The 6- to 32-character password that you defined while registering for the account. This value is case-sensitive.', '6', '25', now(), 'zen_cfg_password_input(', 'zen_cfg_password_display')");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal Mode', 'MODULE_PAYMENT_PAYPALWPP_MODULE_MODE', 'PayPal', 'Which PayPal API system should be used for processing? <br /><u>Choices:</u><br /><font color=green>For choice #1, you need to supply <strong>API Settings</strong> above.</font><br /><strong>1. PayPal</strong> = Express Checkout with a regular PayPal account<br />or<br /><font color=green>for choices 2 &amp; 3 you need to supply <strong>PAYFLOW settings</strong>, below (and a Payflow account)</font><br /><strong>2. Payflow-UK</strong> = Website Payments Pro UK Payflow Edition<br /><strong>3. Payflow-US</strong> = Payflow Pro Gateway only<!--<br /><strong>4. PayflowUS+EC</strong> = Payflow Pro with Express Checkout-->', '6', '25',  'zen_cfg_select_option(array(\'PayPal\', \'Payflow-UK\', \'Payflow-US\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_PAYPALWPP_DEBUGGING', 'Off', 'Would you like to enable debug mode?  A complete detailed log of failed transactions will be emailed to the store owner.', '6', '25', 'zen_cfg_select_option(array(\'Off\', \'Alerts Only\', \'Log File\', \'Log and Email\'), ', now())");

    $this->notify('NOTIFY_PAYMENT_PAYPALWPP_INSTALLED');
  }

  function keys() {
    $keys_list = array('MODULE_PAYMENT_PAYPALWPP_STATUS', /*'MODULE_PAYMENT_PAYPALWPP_DIRECT_ENABLED', */'MODULE_PAYMENT_PAYPALWPP_SORT_ORDER', 'MODULE_PAYMENT_PAYPALWPP_ZONE', 'MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPALWPP_ORDER_PENDING_STATUS_ID', 'MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID', 'MODULE_PAYMENT_PAYPALWPP_CONFIRMED_ADDRESS', 'MODULE_PAYMENT_PAYPALWPP_AUTOSELECT_CHEAPEST_SHIPPING', 'MODULE_PAYMENT_PAYPALWPP_SKIP_PAYMENT_PAGE', 'MODULE_PAYMENT_PAYPALWPP_NEW_ACCT_NOTIFY', 'MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE', 'MODULE_PAYMENT_PAYPALWPP_CURRENCY', 'MODULE_PAYMENT_PAYPALWPP_PAGE_STYLE', 'MODULE_PAYMENT_PAYPALWPP_APIUSERNAME', 'MODULE_PAYMENT_PAYPALWPP_APIPASSWORD', 'MODULE_PAYMENT_PAYPALWPP_APISIGNATURE', /*'MODULE_PAYMENT_PAYPALWPP_MODULE_MODE', */ /*'MODULE_PAYMENT_PAYPALWPP_PFPARTNER', 'MODULE_PAYMENT_PAYPALWPP_PFVENDOR', 'MODULE_PAYMENT_PAYPALWPP_PFUSER', 'MODULE_PAYMENT_PAYPALWPP_PFPASSWORD', */'MODULE_PAYMENT_PAYPALWPP_SERVER', 'MODULE_PAYMENT_PAYPALWPP_DEBUGGING');
    if (IS_ADMIN_FLAG === true && ((isset($_GET['debug']) && $_GET['debug']=='on') || PAYPAL_DEV_MODE == 'true') || strstr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE, 'Payflow')) {
      $keys_list[]='MODULE_PAYMENT_PAYPALWPP_DIRECT_ENABLED';
      $keys_list[]='MODULE_PAYMENT_PAYPALWPP_MODULE_MODE';
      $keys_list = array_merge($keys_list, array('MODULE_PAYMENT_PAYPALWPP_PFPARTNER', 'MODULE_PAYMENT_PAYPALWPP_PFVENDOR', 'MODULE_PAYMENT_PAYPALWPP_PFUSER', 'MODULE_PAYMENT_PAYPALWPP_PFPASSWORD'));
    }
    return $keys_list;
  }
  /**
   * De-install this module
   */
  function remove() {
    global $messageStack;
    // cannot remove EC if DP installed:
    if (defined('MODULE_PAYMENT_PAYPALDP_STATUS')) {
      $messageStack->add_session('<strong>Sorry, you must remove Website Payments Pro (paypaldp) first.</strong> Website Payments Pro requires that you offer Express Checkout to your customers.<br /><a href="' . zen_href_link('modules.php?set=payment&module=paypaldp', '', 'NONSSL') . '">Click here to edit or remove your Website Payments Pro module.</a>' , 'error');
      zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=paypalwpp', 'NONSSL'));
      return 'failed';
    }

    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE 'MODULE\_PAYMENT\_PAYPALWPP\_%'");
    $this->notify('NOTIFY_PAYMENT_PAYPALWPP_UNINSTALLED');
  }
  /**
   * Check settings and conditions to determine whether we are in an Express Checkout phase or not
   */
  function in_special_checkout() {
    if ((defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') &&
             !empty($_SESSION['paypal_ec_token']) &&
             !empty($_SESSION['paypal_ec_payer_id']) &&
             !empty($_SESSION['paypal_ec_payer_info'])) {
      $this->flagDisablePaymentAddressChange = true;
      return true;
    }
  }
  /**
   * Determine whether the shipping-edit button should be displayed or not
   */
  function alterShippingEditButton() {
    return false;
    if ($this->in_special_checkout() && empty($_SESSION['paypal_ec_markflow'])) {
      return zen_href_link('ipn_main_handler.php', 'type=ec&clearSess=1', 'SSL', true,true, true);
    }
  }
  /**
   * Debug Logging support
   */
  function zcLog($stage, $message) {
    static $tokenHash;
    if ($tokenHash == '') $tokenHash = '_' . zen_create_random_value(4);
    if (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log File') {
      $token = (isset($_SESSION['paypal_ec_token'])) ? $_SESSION['paypal_ec_token'] : preg_replace('/[^0-9.A-Z\-]/', '', $_GET['token']);
      $token = ($token == '') ? date('m-d-Y-h-i') : $token; // or time()
      $token .= $tokenHash;
      $file = $this->_logDir . '/' . 'Paypal_Action_' . $token . '.log';
      if (defined('PAYPAL_DEV_MODE') && PAYPAL_DEV_MODE == 'true') $file = $this->_logDir . '/' . $this->code . '_Paypal_Debug_' . $token . '.log';
      $fp = @fopen($file, 'a');
      @fwrite($fp, date('M-d-Y h:i:s') . "\n" . $stage . "\n" . $message . "\n=================================\n\n");
      @fclose($fp);
    }
    $this->_doDebug($stage, $message, false);
  }
  /**
   * Debug Emailing support
   */
  function _doDebug($subject = 'PayPal debug data', $data, $useSession = true) {
    if (MODULE_PAYMENT_PAYPALWPP_DEBUGGING == 'Log and Email') {
      $data =  urldecode($data) . "\n\n";
      if ($useSession) $data .= "\nSession data: " . print_r($_SESSION, true);
      zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $subject, $data, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($this->code . "\n" . $data)), 'debug');
    }
  }
  /**
   * Initialize the PayPal/PayflowPro object for communication to the processing gateways
   */
  function paypal_init() {
    $ec_uses_gateway = (defined('MODULE_PAYMENT_PAYPALWPP_PRO20_EC_METHOD') && MODULE_PAYMENT_PAYPALWPP_PRO20_EC_METHOD == 'Payflow') ? true : false;
    $nvp = (!($ec_uses_gateway) && MODULE_PAYMENT_PAYPALWPP_APIPASSWORD != '' && MODULE_PAYMENT_PAYPALWPP_APISIGNATURE != '') ? true : false;
    $ec = ($nvp && ($this->in_special_checkout() || $_GET['type'] == 'ec')) ? true : false;
    if (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow'/* && !$ec*/) {
      $doPayPal = new paypal_curl(array('mode' => 'payflow',
                                        'user' =>   trim(MODULE_PAYMENT_PAYPALWPP_PFUSER),
                                        'vendor' => trim(MODULE_PAYMENT_PAYPALWPP_PFVENDOR),
                                        'partner'=> trim(MODULE_PAYMENT_PAYPALWPP_PFPARTNER),
                                        'pwd' =>    trim(MODULE_PAYMENT_PAYPALWPP_PFPASSWORD),
                                        'server' => MODULE_PAYMENT_PAYPALWPP_SERVER));
      $doPayPal->_endpoints = array('live'    => 'https://payflowpro.verisign.com/transaction',
                                    'sandbox' => 'https://pilot-payflowpro.verisign.com/transaction');
    } else {
      $doPayPal = new paypal_curl(array('mode' => 'nvp',
                                        'user' => trim(MODULE_PAYMENT_PAYPALWPP_APIUSERNAME),
                                        'pwd' =>  trim(MODULE_PAYMENT_PAYPALWPP_APIPASSWORD),
                                        'signature' => trim(MODULE_PAYMENT_PAYPALWPP_APISIGNATURE),
                                        'version' => '3.2',
                                        'server' => MODULE_PAYMENT_PAYPALWPP_SERVER));
      $doPayPal->_endpoints = array('live'    => 'https://api-3t.paypal.com/nvp',
                                    'sandbox' => 'https://api.sandbox.paypal.com/nvp');
    }

    // set logging options
    $doPayPal->_logDir = $this->_logDir;
//    $doPayPal->_logLevel = $this->_logLevel;

    // set proxy options if configured
    if (CURL_PROXY_REQUIRED == 'True' && CURL_PROXY_SERVER_DETAILS != '') {
      $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
      $doPayPal->setCurlOption(CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
      $doPayPal->setCurlOption(CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
      $doPayPal->setCurlOption(CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
    }

    // transaction processing mode
    $doPayPal->_trxtype = (in_array(MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE, array('Auth Only', 'Order'))) ? 'A' : 'S';
//    $this->zcLog('comm details', 'Comm Details: ' . "\n" . print_r($doPayPal, true) . "\n\n" . 'MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE = ' . MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE  . "\ndoPayPal->_trxtype = " . $doPayPal->_trxtype . "\n");

    return $doPayPal;
  }
  /**
   * Determine which PayPal URL to direct the customer's browser to when needed
   */
  function getPayPalLoginServer() {
    if (MODULE_PAYMENT_PAYPALWPP_SERVER == 'live') {
      // live url
      $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
    } else {
      // sandbox url
      $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
       // for UK sandbox -- NOTE: this system is intermittently flakey ... and if it's down, odd redirects occur.
      if (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow') {
      //  $paypal_url = 'https://test-expresscheckout.paypal.com/cgi-bin/webscr';
      }
    }
    return $paypal_url;
  }
  /**
   * Used to submit a refund for a given transaction.  FOR FUTURE USE.
   */
  function _doRefund($oID, $amount = 'Full', $note = '') {
    global $db, $doPayPal, $messageStack;
    $new_order_status = MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID;
    $orig_order_amount = 0;
    $doPayPal = $this->paypal_init();
    $proceedToRefund = false;
    $refundNote = strip_tags(zen_db_input($_POST['refnote']));
    if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL) {
      $refundAmt = 'Full';
      if (isset($_POST['reffullconfirm']) && $_POST['reffullconfirm'] == 'on') {
        $proceedToRefund = true;
      } else {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_ERROR, 'error');
      }
    }
    if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
      $refundAmt = (float)$_POST['refamt'];
      $new_order_status = MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID;
      $proceedToRefund = true;
      if ($refundAmt == 0) {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_REFUND_AMOUNT, 'error');
        $proceedToRefund = false;
      }
    }

    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    $PFamt = $zc_ppHist->fields['mc_gross'];
    if ($doPayPal->_mode == 'payflow' && $refundAmt == 'Full') $refundAmt = $PFamt;

    /**
     * Submit refund request to PayPal
     */
    if ($proceedToRefund) {
      $response = $doPayPal->RefundTransaction($oID, $txnID, $refundAmt, $refundNote);
      $error = $this->_errorHandler($response, 'DoRefund');
      if (!$error) {
        if (!isset($response['GROSSREFUNDAMT'])) $response['GROSSREFUNDAMT'] = $refundAmt;
        // Success, so save the results
        $sql_data_array = array('orders_id' => $oID,
                                'orders_status_id' => (int)$new_order_status,
                                'date_added' => 'now()',
                                'comments' => 'REFUND INITIATED. Trans ID:' . $response['REFUNDTRANSACTIONID'] . $response['PNREF']. "\n" . /*' Net Refund Amt:' . urldecode($response['NETREFUNDAMT']) . "\n" . ' Fee Refund Amt: ' . urldecode($response['FEEREFUNDAMT']) . "\n" . */' Gross Refund Amt: ' . urldecode($response['GROSSREFUNDAMT']) . (isset($response['PPREF']) ? "\nPPRef: " . $response['PPREF'] : '') . "\n" . $refundNote,
                                'customer_notified' => 0
                             );
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        $db->Execute("update " . TABLE_ORDERS  . "
                      set orders_status = '" . (int)$new_order_status . "'
                      where orders_id = '" . (int)$oID . "'");
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_INITIATED, urldecode($response['GROSSREFUNDAMT']), urldecode($response['REFUNDTRANSACTIONID']). $response['PNREF']), 'success');
        return true;
      }
    }
  }

  /**
   * Used to authorize part of a given previously-initiated transaction.  FOR FUTURE USE.
   */
  function _doAuth($oID, $amt, $currency = 'USD') {
    global $db, $doPayPal, $messageStack;
    $doPayPal = $this->paypal_init();
    $authAmt = $amt;
    $new_order_status = MODULE_PAYMENT_PAYPALWPP_ORDER_PENDING_STATUS_ID;

    if (isset($_POST['orderauth']) && $_POST['orderauth'] == MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL) {
      $authAmt = (float)$_POST['authamt'];
      $new_order_status = MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID;
      if (isset($_POST['authconfirm']) && $_POST['authconfirm'] == 'on') {
        $proceedToAuth = true;
      } else {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_CONFIRM_ERROR, 'error');
        $proceedToAuth = false;
      }
      if ($authAmt == 0) {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_AUTH_AMOUNT, 'error');
        $proceedToAuth = false;
      }
    }
    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    /**
     * Submit auth request to PayPal
     */
    if ($proceedToAuth) {
      $response = $doPayPal->DoAuthorization($txnID, $authAmt, $currency);
      $error = $this->_errorHandler($response, 'DoAuthorization');
      if (!$error) {
        // Success, so save the results
        $sql_data_array = array('orders_id' => (int)$oID,
                                'orders_status_id' => (int)$new_order_status,
                                'date_added' => 'now()',
                                'comments' => 'AUTHORIZATION ADDED. Trans ID: ' . urldecode($response['TRANSACTIONID']) . "\n" . ' Amount:' . urldecode($response['AMT']) . ' ' . $currency,
                                'customer_notified' => 0
                               );
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        $db->Execute("update " . TABLE_ORDERS  . "
                      set orders_status = '" . (int)$new_order_status . "'
                      where orders_id = '" . (int)$oID . "'");
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_INITIATED, urldecode($response['AMT'])), 'success');
        return true;
      }
    }
  }
  /**
   * Used to capture part or all of a given previously-authorized transaction.  FOR FUTURE USE.
   */
  function _doCapt($oID, $captureType = 'Complete', $amt = 0, $currency = 'USD', $note = '') {
    global $db, $doPayPal, $messageStack;
    $doPayPal = $this->paypal_init();

    // alt value for $captureType = 'NotComplete';

    //@TODO: Read current order status and determine best status to set this to
    $new_order_status = MODULE_PAYMENT_PAYPALWPP_ORDER_STATUS_ID;


    $orig_order_amount = 0;
    $doPayPal = $this->paypal_init();
    $proceedToCapture = false;
    $captureNote = strip_tags(zen_db_input($_POST['captnote']));
    if (isset($_POST['captfullconfirm']) && $_POST['captfullconfirm'] == 'on') {
      $proceedToCapture = true;
    } else {
      $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_ERROR, 'error');
    }
    if (isset($_POST['captfinal']) && $_POST['captfinal'] == 'on') {
      $captureType = 'Complete';
    } else {
      $captureType = 'NotComplete';
    }
    if (isset($_POST['btndocapture']) && $_POST['btndocapture'] == MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL) {
      $captureAmt = (float)$_POST['captamt'];
      if ($captureAmt == 0) {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_CAPTURE_AMOUNT, 'error');
        $proceedToCapture = false;
      }
    }
    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    /**
     * Submit capture request to PayPal
     */
    if ($proceedToCapture) {
      $response = $doPayPal->DoCapture($txnID, $captureAmt, $currency, $captureType, '', $captureNote);
      $error = $this->_errorHandler($response, 'DoCapture');
      if (!$error) {
        if (isset($response['PNREF'])) {
          if (!isset($response['AMT'])) $response['AMT'] = $captureAmt;
          if (!isset($response['ORDERTIME'])) $response['ORDERTIME'] = date("M-d-Y h:i:s");
        }
        // Success, so save the results
        $sql_data_array = array('orders_id' => (int)$oID,
                                'orders_status_id' => (int)$new_order_status,
                                'date_added' => 'now()',
                                'comments' => 'FUNDS COLLECTED. Trans ID: ' . urldecode($response['TRANSACTIONID']) . $response['PNREF']. "\n" . ' Amount: ' . urldecode($response['AMT']) . ' ' . $currency . "\n" . 'Time: ' . urldecode($response['ORDERTIME']) . "\n" . (isset($response['RECEIPTID']) ? 'Receipt ID: ' . urldecode($response['RECEIPTID']) : 'Auth Code: ' . $response['AUTHCODE']) . (isset($response['PPREF']) ? "\nPPRef: " . $response['PPREF'] : '') . "\n" . $captureNote,
                                'customer_notified' => 0
                             );
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        $db->Execute("update " . TABLE_ORDERS  . "
                      set orders_status = '" . (int)$new_order_status . "'
                      where orders_id = '" . (int)$oID . "'");
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_INITIATED, urldecode($response['AMT']), urldecode($response['RECEIPTID'] . $response['AUTHCODE']). $response['PNREF']), 'success');
        return true;
      }
    }
  }
  /**
   * Used to void a given previously-authorized transaction.  FOR FUTURE USE.
   */
  function _doVoid($oID, $note = '') {
    global $db, $doPayPal, $messageStack;
    $new_order_status = MODULE_PAYMENT_PAYPALWPP_REFUNDED_STATUS_ID;
    $doPayPal = $this->paypal_init();
    $voidNote = strip_tags(zen_db_input($_POST['voidnote']));
    $voidAuthID = trim(strip_tags(zen_db_input($_POST['voidauthid'])));
    if (isset($_POST['ordervoid']) && $_POST['ordervoid'] == MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL) {
      if (isset($_POST['voidconfirm']) && $_POST['voidconfirm'] == 'on') {
        $proceedToVoid = true;
      } else {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_ERROR, 'error');
      }
    }
    // look up history on this order from PayPal table
    $sql = "select * from " . TABLE_PAYPAL . " where order_id = :orderID  AND parent_txn_id = '' ";
    $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
    $sql = $db->bindVars($sql, ':transID', $voidAuthID, 'string');
    $zc_ppHist = $db->Execute($sql);
    if ($zc_ppHist->RecordCount() == 0) return false;
    $txnID = $zc_ppHist->fields['txn_id'];
    /**
     * Submit void request to PayPal
     */
    if ($proceedToVoid) {
      $response = $doPayPal->DoVoid($voidAuthID, $voidNote);
      $error = $this->_errorHandler($response, 'DoVoid');
      if (!$error) {
        // Success, so save the results
        $sql_data_array = array('orders_id' => (int)$oID,
                                'orders_status_id' => (int)$new_order_status,
                                'date_added' => 'now()',
                                'comments' => 'VOIDED. Trans ID: ' . urldecode($response['AUTHORIZATIONID']). $response['PNREF'] . (isset($response['PPREF']) ? "\nPPRef: " . $response['PPREF'] : '') . "\n" . $voidNote,
                                'customer_notified' => 0
                             );
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        $db->Execute("update " . TABLE_ORDERS  . "
                      set orders_status = '" . (int)$new_order_status . "'
                      where orders_id = '" . (int)$oID . "'");
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_INITIATED, urldecode($response['AUTHORIZATIONID']) . $response['PNREF']), 'success');
        return true;
      }
    }
  }

  /**
   * Determine the language to use when visiting the PayPal site
   */
  function getLanguageCode() {
    $lang_code = '';
    $storeISO = zen_get_countries(STORE_COUNTRY, true);
    if (in_array(strtoupper($storeISO['countries_iso_code_2']), array('US', 'AU', 'DE', 'FR', 'IT', 'GB', 'ES'))) {
      $lang_code = strtoupper($storeISO['countries_iso_code_2']);
    } elseif (in_array(strtoupper($_SESSION['languages_code']), array('EN', 'US', 'AU', 'DE', 'FR', 'IT', 'GB', 'ES'))) {
      $lang_code = $_SESSION['languages_code'];
      if (strtoupper($lang_code) == 'EN') $lang_code = 'US';
    }
    return strtoupper($lang_code);
  }
  /**
   * Set the currency code -- use defaults if active currency is not a currency accepted by PayPal
   */
  function selectCurrency($val = '', $subset = 'EC') {
    $ec_currencies = array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD', 'CHF', 'CZK', 'DKK', 'HKD', 'HUF', 'NOK', 'NZD', 'PLN', 'SEK', 'SGD', 'THB');
    $dp_currencies = array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD');
    $paypalSupportedCurrencies = ($subset == 'EC') ? $ec_currencies : $dp_currencies;

    // if using Pro 2.0 (UK), only the 6 currencies are supported.
    $paypalSupportedCurrencies = (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK') ? $dp_currencies : $paypalSupportedCurrencies;

    $my_currency = substr(MODULE_PAYMENT_PAYPALWPP_CURRENCY, 5);
    if (MODULE_PAYMENT_PAYPALWPP_CURRENCY == 'Selected Currency') {
      $my_currency = ($val == '') ? $_SESSION['currency'] : $val;
    }

    if (!in_array($my_currency, $paypalSupportedCurrencies)) {
      $my_currency = (MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'Payflow-UK') ? 'GBP' : 'USD';
    }
    return $my_currency;
  }
  /**
   * Calculate the amount based on acceptable currencies
   */
  function calc_order_amount($amount, $paypalCurrency, $applyFormatting = false) {
    global $currencies;
    $amount = ($amount) * $currencies->get_value($paypalCurrency);
    return ($applyFormatting ? number_format($amount, $currencies->get_decimal_places($paypalCurrency)) : $amount);
  }
  /**
   * Set the state field depending on what PayPal requires for that country.
   */
  function setStateAndCountry(&$info) {
    global $db;
    switch ($info['country']['iso_code_2']) {
      case 'AU':
      case 'US':
      case 'CA':
      // Paypal only accepts two character state/province codes for some countries.
      if (strlen($info['state']) > 2) {
        $sql = "SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = :zoneName";
        $sql = $db->bindVars($sql, ':zoneName', $info['state'], 'string');
        $state = $db->Execute($sql);
        if (!$state->EOF) {
          $info['state'] = $state->fields['zone_code'];
        } else {
          $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_STATE_ERROR);
        }
      }
      break;
      case 'AT':
      case 'BE':
      case 'FR':
      case 'DE':
      case 'CH':
      $info['state'] = '';
      break;
      default:
      $info['state'] = '';
    }
  }
  /**
   * Prepare subtotal and line-item detail content to send to PayPal
   */
  function getLineItemDetails() {
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
    for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
      if ($order_totals[$i]['code'] == 'ot_subtotal') $optionsST['ITEMAMT']     = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_tax')      $optionsST['TAXAMT']      = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_shipping') $optionsST['SHIPPINGAMT'] = round($order_totals[$i]['value'],2);
      if ($order_totals[$i]['code'] == 'ot_total')    $optionsST['AMT']         = round($order_totals[$i]['value'],2);
      $optionsST['HANDLINGAMT'] = 0;
      global $$order_totals[$i]['code'];
      if (isset($$order_totals[$i]['code']->credit_class) && $$order_totals[$i]['code']->credit_class == true) $creditsApplied += round($order_totals[$i]['value'],2);
      // treat all other OT's as if they're related to handling fees
      if (!in_array($order_totals[$i]['code'], array('ot_total','ot_subtotal','ot_tax','ot_shipping')) 
          && !(isset($$order_totals[$i]['code']->credit_class) && $$order_totals[$i]['code']->credit_class == true)) {
          $optionsST['HANDLINGAMT'] += $order_totals[$i]['value'];
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
        $optionsST['SHIPPINGAMT'] += $taxAdjustmentForShipping;
        $optionsST['TAXAMT'] -= $taxAdjustmentForShipping;
      }
    }

    // loop thru all products to display quantity and price. Appends *** if out-of-stock.
    for ($i=0, $n=sizeof($order->products), $k=0; $i<$n; $i++, $k++) {
      $optionsLI["L_NUMBER$k"] = $order->products[$i]['model'];
      $optionsLI["L_QTY$k"]    = (int)$order->products[$i]['qty'];
      $optionsLI["L_NAME$k"]   = $order->products[$i]['name'];
      $optionsLI["L_NAME$k"]  .= (zen_get_products_stock($order->products[$i]['id']) - $order->products[$i]['qty'] < 0 ? STOCK_MARK_PRODUCT_OUT_OF_STOCK : '');

      // if there are attributes, loop thru them and add to description
      if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
        for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
          $optionsLI["L_NAME$k"] .= "\n " . $order->products[$i]['attributes'][$j]['option'] . 
                                        ': ' . $order->products[$i]['attributes'][$j]['value'];
        } // end loop
      } // endif attribute-info

      $optionsLI["L_AMT$k"] = $order->products[$i]['final_price'];
      $optionsLI["L_TAXAMT$k"] = zen_calculate_tax($order->products[$i]['final_price'], $order->products[$i]['tax']);

      // track one-time charges
      if ($order->products[$i]['onetime_charges'] != 0 ) {
        $onetimeSum += $order->products[$i]['onetime_charges'];
        $onetimeTax += zen_calculate_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']);
      }

      // Replace & and = with * if found. 
      $optionsLI["L_NAME$k"] = str_replace(array('&','='), '*', $optionsLI["L_NAME$k"]);
      $optionsLI["L_NAME$k"] = zen_clean_html($optionsLI["L_NAME$k"], 'strong');

      // reformat properly
      $optionsLI["L_NUMBER$k"] = substr($optionsLI["L_NUMBER$k"], 0, 127);
      $optionsLI["L_NAME$k"]   = substr($optionsLI["L_NAME$k"], 0, 127);
      $optionsLI["L_AMT$k"]    = $optionsLI["L_AMT$k"];
      $optionsLI["L_TAXAMT$k"] = round($optionsLI["L_TAXAMT$k"],2);

    }  // end for loopthru all products

    if ($onetimeSum > 0) {
      $i++; $k++;
      $optionsLI["L_NUMBER$k"] = $k;
      $optionsLI["L_NAME$k"]   = 'One-Time Charges';
      $optionsLI["L_AMT$k"]    = $onetimeSum;
      $optionsLI["L_TAXAMT$k"] = $onetimeTax;
      $optionsLI["L_QTY$k"]    = 1;
    }

    // handle discounts such as gift certificates and coupons
    if ($creditsApplied > 0) {
      $optionsST['HANDLINGAMT'] -= $creditsApplied;
    }

    // add all one-time charges
    $optionsST['ITEMAMT'] += $onetimeSum;

    //ensure things are not negative
    $optionsST['HANDLINGAMT'] = abs(strval($optionsST['HANDLINGAMT']));

    // ensure all numbers are non-negative
    if (is_array($optionsST)) foreach ($optionsST as $key=>$value) {
      $optionsST[$key] = abs(strval($value));
    }
    if (is_array($optionsLI)) foreach ($optionsLI as $key=>$value) {
      if (strstr($key, 'AMT')) $optionsLI[$key] = abs(strval($value));
    }

    // subtotals have to add up to AMT
    // Thus, if there is a discrepancy, make adjustment to HANDLINGAMT:
    $st = $optionsST['ITEMAMT'] + $optionsST['TAXAMT'] + $optionsST['SHIPPINGAMT'] + $optionsST['HANDLINGAMT'];
    if ($st != $optionsST['AMT']) $optionsST['HANDLINGAMT'] += strval($optionsST['AMT'] - $st);


/*  //PayPal API spec contradicts itself ... and apparently neither of these "requirements" are enforced. 
    //Thus skipping this section for now:

    // according to API specs, these cannot be set if they contain zero values, so unset if they are zero:
    if ($optionsST['TAXAMT'] == 0)      unset($optionsST['TAXAMT']);
    if ($optionsST['SHIPPINGAMT'] == 0) unset($optionsST['SHIPPINGAMT']);
    if ($optionsST['HANDLINGAMT'] == 0) unset($optionsST['HANDLINGAMT']);
    // set missing subtotals if they are zero values, since all must be submitted
    if (!isset($optionsST['TAXAMT']))      $optionsST['TAXAMT'] = 0;
    if (!isset($optionsST['SHIPPINGAMT'])) $optionsST['SHIPPINGAMT'] = 0;
    if (!isset($optionsST['HANDLINGAMT'])) $optionsST['HANDLINGAMT'] = 0;
*/

    // Since the PayPal spec cannot handle mathematically mismatched values caused by one-time charges,
    // must drop line-item details if any one-time charges apply to this order:
    // if there are any discounts in this order, do NOT supply line-item details
    if ($onetimeSum > 0) $optionsLI = array();

    // Do sanity check -- if any of the line-item subtotal math doesn't add up properly, skip line-item details,
    // so that the order can go through even though PayPal isn't being flexible to handle Zen Cart's diversity
    for ($j=0; $j<$k; $j++) {
      $itemAMT = $optionsLI["L_AMT$j"];
      $itemTAX = $optionsLI["L_TAXAMT$j"];
      $itemQTY = $optionsLI["L_QTY$j"];
      $sumOfLineItems += ($itemQTY * $itemAMT);
      $sumOfLineTax += round(($itemQTY * $itemTAX),2);
    }

    if ((float)$optionsST['ITEMAMT'] != (float)strval($sumOfLineItems)) {
      $optionsLI = array();
      $this->zcLog('getLineItemDetails 1', 'Order Subtotal does not match sum of line-item prices. Line-item-details skipped.' . "\n" . (float)$optionsST['ITEMAMT'] . ' ' . (float)$sumOfLineItems);
      //die('ITEMAMT != $sumOfLineItems ' . $optionsST['ITEMAMT'] . ' ' . $sumOfLineItems);
    }
    if ((float)$optionsST['TAXAMT']  != (float)strval($sumOfLineTax)) {
      $optionsLI = array();
      $this->zcLog('getLineItemDetails 2', 'Tax Subtotal does not match sum of taxes for line-items. Line-item-details skipped.' . "\n" . $optionsST['TAXAMT'] . ' ' . $sumOfLineTax);
      //die('TAXAMT != $sumofLineTax ' . $optionsST['TAXAMT'] . ' ' . $sumOfLineTax);
    }

    $this->zcLog('getLineItemDetails 3', 'LineItemDetails: ' . "\n" . ($creditsApplied ? 'Credits apply to this order, so all line-item details are NOT being submitted. Thus, the following data is REDUNDANT' . "\n" : '') . 'Details:' . print_r(array_merge($optionsST, $optionsLI), true) . "\n\n" . 'DEFAULT_CURRENCY = ' . DEFAULT_CURRENCY  . "\nSESSION['currency'] = " . $_SESSION['currency'] . "\n" . "order->info['currency'] = " . $order->info['currency'] . "\n\$currencies->currencies[\$_SESSION['currency']]['value'] = " . $currencies->currencies[$_SESSION['currency']]['value'] . "\n" . print_r($currencies, true));

    // if not default currency, do not send subtotals or line-item details
    if (DEFAULT_CURRENCY != $order->info['currency']) {
      $this->zcLog('getLineItemDetails 4', 'Not using default currency. Thus, no line-item details can be submitted.');
      return array();
    }
    if ($currencies->currencies[$_SESSION['currency']]['value'] != 1) {
      $this->zcLog('getLineItemDetails 5', 'currency val not equal to 1.0000 - cannot proceed without coping with currency conversions. Aborting line-item details.');
      return array();
    }

    // if there are any discounts in this order, do not supply subtotals or line-item details
    if (strval($creditsApplied) > 0) return array();
    //$this->zcLog('getLineItemDetails 6', 'no credits - okay');

    // if subtotals are not adding up correctly, then skip sending any line-item or subtotal details to PayPal
    $st = round(strval($optionsST['ITEMAMT'] + $optionsST['TAXAMT'] + $optionsST['SHIPPINGAMT'] + $optionsST['HANDLINGAMT']),2);
    $stDiff = strval($optionsST['AMT'] - $st);
    $stDiffRounded = strval(abs($st) - abs(round($optionsST['AMT'],2)));

    // tidy up all values so that they comply with proper format (number_format(xxxx,2) for PayPal US use )
    if (!defined('PAYPALWPP_SKIP_LINE_ITEM_DETAIL_FORMATTING') || PAYPALWPP_SKIP_LINE_ITEM_DETAIL_FORMATTING != 'true') {
      if (is_array($optionsST)) foreach ($optionsST as $key=>$value) {
        $optionsST[$key] = number_format(abs($value), 2);
      }
      if (is_array($optionsLI)) foreach ($optionsLI as $key=>$value) {
        if (strstr($key, 'AMT')) $optionsLI[$key] = number_format(abs($value), 2);
      }
    }

    $this->zcLog('getLineItemDetails 7', 'checking subtotals... '. "\nitemamt: " . $optionsST['ITEMAMT'] . "\ntaxamt: " . $optionsST['TAXAMT'] . "\nshippingamt: " . $optionsST['SHIPPINGAMT'] . "\nhandlingamt: " . $optionsST['HANDLINGAMT'] . "\n-------------------\nsubtotal: " . number_format($st, 2) . "\nAMT: " . $optionsST['AMT'] . "\n-------------------\ndifference: " . $stDiff . '  (abs+rounded: ' . $stDiffRounded . ')');

    if ( $stDiffRounded != 0) return array(); //die('bad subtotals'); //return array();
    $this->zcLog('getLineItemDetails 8', 'subtotals balance - okay');

    if (abs($optionsST['HANDLINGAMT']) == 0) unset($optionsST['HANDLINGAMT']);

    // Send Subtotal and LineItem results back to be submitted to PayPal
    return array_merge($optionsST, $optionsLI);
  }


  /**
   * This method sends the user to PayPal's site
   * There, they will log in to their account, choose a funding source and shipping method
   * and then return to our site with an EC token
   */
  function ec_step1() {
    global $order, $db, $doPayPal;

    // if cart is empty due to timeout on login or shopping cart page, go to timeout screen
    if ($_SESSION['cart']->count_contents() == 0) {
      zen_redirect(zen_href_link(FILENAME_TIME_OUT, '', 'SSL'));
    }

    // init new order object
    require(DIR_WS_CLASSES . 'order.php');
    $order = new order;

    // load the selected shipping module so that shipping taxes can be assessed
    require(DIR_WS_CLASSES . 'shipping.php');
    $shipping_modules = new shipping($_SESSION['shipping']);

    // load OT modules so that discounts and taxes can be assessed
    require(DIR_WS_CLASSES . 'order_total.php');
    $order_total_modules = new order_total;
    $order_totals = $order_total_modules->pre_confirmation_check();
    $order_totals = $order_total_modules->process();

    $doPayPal = $this->paypal_init();
    $options = array();

    // unused at present:
    // $options['CUSTOM'] = '';
    // $options['INVNUM'] = '';

    // Determine the language to use when visiting the PP site
    $lc_code = $this->getLanguageCode();
    if ($lc_code != '') $options['LOCALECODE'] = $lc_code;

    // Set currency and amount
    $options['CURRENCY'] = $this->selectCurrency();
    $order_amount = $this->calc_order_amount($order->info['total'], $options['CURRENCY']);

    // Payment Transaction/Authorization Mode
    $options['PAYMENTACTION'] = (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Sale';
    // for future:
    if (MODULE_PAYMENT_PAYPALWPP_TRANSACTION_MODE == 'Order') $options['PAYMENTACTION'] = 'Order';

    // Set the return URL if they click "Submit" on PayPal site
    $return_url = zen_href_link('ipn_main_handler.php', 'type=ec', 'SSL', true, true, true);
    // Select the return URL if they click "cancel" on PayPal site or click to return without making payment or login
    $cancel_url = zen_href_link(($_SESSION['customer_first_name'] != '' && $_SESSION['customer_id'] != '' ? FILENAME_CHECKOUT_SHIPPING :FILENAME_LOGIN), 'ec_cancel=1', 'SSL');

    // debug
    $this->zcLog('ec_step1 - 1', 'Checking to see if we are in markflow' . "\n" . 'cart contents: ' . $_SESSION['cart']->get_content_type() . "\n\nNOTE: " . '$this->showPaymentPage = ' . (int)$this->showPaymentPage . "\nCustomer ID: " . (int)$_SESSION['customer_id'] . "\nSession Data: " . print_r($_SESSION, true));

    /**
     * Check whether shipping is required on this order or not.
     * If not, tell PayPal to skip all shipping options
     * ie: don't ask for any shipping info if cart content is strictly virtual and customer is already logged-in
     * (if not logged in, we need address information only to build the customer record)
     */
    if ($_SESSION['cart']->get_content_type() == 'virtual' && isset($_SESSION['customer_id']) && $_SESSION['customer_id'] > 0) {
      $this->zcLog('ec-step1-addr_check', "cart contents is virtual and customer is logged in ... therefore options['NOSHIPPING']=1");
      $options['NOSHIPPING'] = 1;
    } else {
      $this->zcLog('ec-step1-addr_check', "cart contents is not all virtual or customer is not logged in ... therefore will be submitting address details");
      // If we are in a "mark" flow and the customer has a usable address, set the addressoverride variable to 1. This will
      // override the shipping address in PayPal with the shipping address that is selected in Zen Cart.

      if (($address_arr = $this->getOverrideAddress()) !== false) {
        $address_error = false;
        foreach(array('entry_firstname','entry_lastname','entry_street_address','entry_city','entry_postcode','zone_code','countries_iso_code_2') as $key) {
          if ($address_arr[$key] == '') $address_error = true;
          if ($address_error == true) $this->zcLog('ec-step1-addr_check2', '$address_error = true because ' .$key . ' is blank.');
        }
        if ($address_error == false) {
          // set the override var
          $options['ADDROVERRIDE'] = 1;

          // set the address info
          $options['SHIPTONAME']    = $address_arr['entry_firstname'] . ' ' . $address_arr['entry_lastname'];
          $options['SHIPTOSTREET']  = $address_arr['entry_street_address'];
          if ($address_arr['entry_suburb'] != '') $options['SHIPTOSTREET2'] = $address_arr['entry_suburb'];
          $options['SHIPTOCITY']    = $address_arr['entry_city'];
          $options['SHIPTOZIP']     = $address_arr['entry_postcode'];
          $options['SHIPTOSTATE']   = $address_arr['zone_code'];
          $options['SHIPTOCOUNTRYCODE'] = $address_arr['countries_iso_code_2'];
        }
      }

      $this->zcLog('ec-step1-addr_check3', 'address details from override check:'.print_r($address_arr, true));
     // Do we require a "confirmed" shipping address ?
      if (MODULE_PAYMENT_PAYPALWPP_CONFIRMED_ADDRESS == 'Yes') {
        $options['REQCONFIRMSHIPPING'] = 1;
      }
    }
    // if we know customer's email address, supply it, so as to pre-fill the signup box at PayPal (for new PayPal accounts only)
    if (!empty($_SESSION['customer_first_name']) && !empty($_SESSION['customer_id'])) {
      $sql = "select * from " . TABLE_CUSTOMERS . " where customers_id = :custID ";
      $sql = $db->bindVars($sql, ':custID', $_SESSION['customer_id'], 'integer');
      $zc_getemail = $db->Execute($sql);
      if ($zc_getemail->RecordCount() > 0 && $zc_getemail->fields['customers_email_address'] != '') {
        $options['EMAIL'] = $zc_getemail->fields['customers_email_address'];
      }
      if ($zc_getemail->RecordCount() > 0 && $zc_getemail->fields['customers_telephone'] != '') {
        $options['PHONENUM'] = $zc_getemail->fields['customers_telephone'];
      }
    }

    // alter PayPal login page:
    $options['SOLUTIONTYPE'] = 'SOLE';     

    // debug
    $this->zcLog('ec_step1 - 2 -submit', print_r(array_merge(array('AMT' => number_format($order_amount, 2), 'RETURNURL' => $return_url, 'CANCELURL' => $cancel_url), $options), true));

    /**
     * Ask PayPal for the token with which to initiate communications
     */
    $response = $doPayPal->SetExpressCheckout(number_format($order_amount, 2), $return_url, $cancel_url, $options);

    /**
     * Determine result of request for token -- if error occurred, the errorHandler will redirect accordingly
     */
    $error = $this->_errorHandler($response, 'SetExpressCheckout');

    // Success, so read the EC token
    $_SESSION['paypal_ec_token'] = preg_replace('/[^0-9.A-Z\-]/', '', urldecode($response['TOKEN']));

    // prepare to redirect to PayPal so the customer can log in and make their selections
    $paypal_url = $this->getPayPalLoginServer();

    // Set the name of the displayed "continue" button on the PayPal site.
    // 'commit' = "Pay Now"  ||  'continue' = "Review Payment"
    $orderReview = true;
    if ($_SESSION['paypal_ec_markflow'] == 1) $orderReview = false;
    $userActionKey = "&useraction=" . ((int)$orderReview == false ? 'commit' : 'continue');

    // This is where we actually redirect the customer's browser to PayPal. Upon return, they go to ec_step2
    header("HTTP/1.1 302 Object Moved");
    zen_redirect($paypal_url . "?cmd=_express-checkout&token=" . $_SESSION['paypal_ec_token'] . $userActionKey);
  }
  /**
     * This method is for step 2 of the express checkout option.  This
     * retrieves from PayPal the data set by step one and sets the Zen Cart
     * data accordingly depending on admin settings.
     */
  function ec_step2() {
    // Visitor just came back from PayPal and so we collect all
    // the info returned, create an account if necessary, then log
    // them in, and then send them to the appropriate page.
    if (empty($_SESSION['paypal_ec_token'])) {
      // see if the token is set -- if not, we cannot continue -- ideally the token should match the session token
      if (isset($_GET['token'])) {
        // we have a token, so we will proceed
        $_SESSION['paypal_ec_token'] = $_GET['token'];
        // sanitize this
        $_SESSION['paypal_ec_token'] = preg_replace('/[^0-9.A-Z\-]/', '', $_GET['token']);

      } else {
        // no token -- not ready for this step -- send them back to checkout page with error
        $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE, true);
      }
    }

    // debug
    $this->zcLog('PayPal test Log - ec_step2 $_REQUEST data', "In function: ec_step2()\r\nData in \$_REQUEST = \r\n" . print_r($_REQUEST, true));

    // Initialize the paypal caller object.
    global $doPayPal;
    $doPayPal = $this->paypal_init();

    // with the token we retrieve the data about this user
    $response = $doPayPal->GetExpressCheckoutDetails($_SESSION['paypal_ec_token']);

    /**
     * Determine result of request for data -- if error occurred, the errorHandler will redirect accordingly
     */
    $error = $this->_errorHandler($response, 'GetExpressCheckoutDetails');

    // Alert customer that they've selected an unconfirmed address at PayPal, and must go back and choose a Confirmed one
    if (MODULE_PAYMENT_PAYPALWPP_CONFIRMED_ADDRESS == 'Yes' && $response['ADDRESSSTATUS'] != 'Confirmed') {
      $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_CONFIRMEDADDR_ERROR, true, FILENAME_CHECKOUT_SHIPPING);
    }

    // will we be creating an account for this customer?  We must if the cart contents are virtual, so can login to download etc.
    if ($_SESSION['cart']->get_content_type('true') > 0 || in_array($_SESSION['cart']->content_type, array('mixed', 'virtual'))) $this->new_acct_notify = 'Yes';

    // get the payer_id from the customer's info as returned from PayPal
    $_SESSION['paypal_ec_payer_id'] = $response['PAYERID'];

    $gender = '';
    if (urldecode($response['SALUTATION'] == 'Mr')) $gender = 'm';
    if (in_array(urldecode($response['SALUTATION']), array('Ms', 'Mrs'))) $gender = 'f';

    // prepare the information to pass to the ec_step2_finish() function, which does the account creation, address build, etc
    $step2_payerinfo = array('payer_id'        => $response['PAYERID'],
                             'payer_email'     => urldecode($response['EMAIL']),
                             'payer_salutation'=> urldecode($response['SALUTATION']),
                             'payer_gender'    => $gender,
                             'payer_firstname' => urldecode($response['FIRSTNAME']),
                             'payer_lastname'  => urldecode($response['LASTNAME']),
                             'payer_business'  => urldecode($response['BUSINESS']),
                             'payer_status'    => $response['PAYERSTATUS'],
                             'ship_country_code'   => urldecode($response['COUNTRYCODE']),
                             'ship_address_status' => urldecode($response['ADDRESSSTATUS']),
                             'ship_phone'      => urldecode($response['PHONENUM']));

    if ($response['ADDRESSSTATUS'] == 'None') {
      $step2_shipto = array();
    } else {
      // accomodate PayPal bug which repeats 1st line of address for 2nd line if 2nd line is empty. 
      if ($response['SHIPTOSTREET2'] == $response['SHIPTOSTREET1']) $response['SHIPTOSTREET2'] = '';

      // accomodate PayPal bug which incorrectly treats 'Yukon Territory' as YK instead of ISO standard of YT.
      if ($response['SHIPTOSTATE'] == 'YK') $response['SHIPTOSTATE'] = 'YT';
      // same with Newfoundland
      if ($response['SHIPTOSTATE'] == 'NF') $response['SHIPTOSTATE'] = 'NL';

      // process address details supplied
      $step2_shipto = array('ship_name'     => urldecode($response['SHIPTONAME']),
                            'ship_street_1' => urldecode($response['SHIPTOSTREET']),
                            'ship_street_2' => urldecode($response['SHIPTOSTREET2']),
                            'ship_city'     => urldecode($response['SHIPTOCITY']),
                            'ship_state'    => (isset($response['SHIPTOSTATE']) && $response['SHIPTOSTATE'] !='' ? urldecode($response['SHIPTOSTATE']) : urldecode($response['SHIPTOCITY'])),
                            'ship_postal_code' => urldecode($response['SHIPTOZIP']),
                            'ship_country_code'  => urldecode($response['SHIPTOCOUNTRYCODE']),
                            'ship_country_name'  => urldecode($response['SHIPTOCOUNTRYNAME']));
    }

    // reset all previously-selected shipping choices, because cart contents may have been changed
    if (!(isset($_SESSION['paypal_ec_markflow']) && $_SESSION['paypal_ec_markflow'] == 1)) unset($_SESSION['shipping']);

    // send data off to build account, log in, set addresses, place order
    $this->ec_step2_finish(array_merge($step2_payerinfo, $step2_shipto), $this->new_acct_notify);
  }

  /**
   * Complete the step2 phase by creating accounts if needed, linking data, placing order, etc.
   */
  function ec_step2_finish($paypal_ec_payer_info, $new_acct_notify) {
    global $db, $order;

    // register the payer_info in the session
    $_SESSION['paypal_ec_payer_info'] = $paypal_ec_payer_info;

    // debug
    $this->zcLog('ec_step2_finish - 1', 'START: paypal_ec_payer_info= ' . print_r($_SESSION['paypal_ec_payer_info'], true));

    /**
     * Building customer zone/address from returned data
     */
    // set some defaults, which will be updated later:
    $country_id = '223';
    $address_format_id = 2;
    $state_id = 0;
    $acct_exists = false;
    // store default address id for later use/reference
    $original_default_address_id = $_SESSION['customer_default_address_id'];

    // Get the customer's country ID based on name or ISO code
    $sql = "SELECT countries_id, address_format_id, countries_iso_code_2, countries_iso_code_3
                FROM " . TABLE_COUNTRIES . "
                WHERE countries_iso_code_2 = :countryId
                   OR countries_name = :countryId
                LIMIT 1";
    $sql1 = $db->bindVars($sql, ':countryId', $paypal_ec_payer_info['ship_country_name'], 'string');
    $country1 = $db->Execute($sql1);
    $sql2 = $db->bindVars($sql, ':countryId', $paypal_ec_payer_info['ship_country_code'], 'string');
    $country2 = $db->Execute($sql2);

    // see if we found a record, if yes, then use it instead of default American format
    if ($country1->RecordCount() > 0) {
      $country_id = $country1->fields['countries_id'];
      if (!isset($paypal_ec_payer_info['ship_country_code']) || $paypal_ec_payer_info['ship_country_code'] == '') $paypal_ec_payer_info['ship_country_code'] = $country1->fields['countries_iso_code_2'];
      $country_code3 = $country1->fields['countries_iso_code_3'];
      $address_format_id = (int)$country1->fields['address_format_id'];
    } elseif ($country2->RecordCount() > 0) {
      // if didn't find it based on name, check using ISO code (ie: in case of no-shipping-address required/supplied)
      $country_id = $country2->fields['countries_id'];
      $country_code3 = $country2->fields['countries_iso_code_3'];
      $address_format_id = (int)$country2->fields['address_format_id'];
    }
    // Need to determine zone, based on zone name first, and then zone code if name fails check. Otherwise uses 0.
    $sql = "SELECT zone_id
                  FROM " . TABLE_ZONES . "
                  WHERE zone_country_id = :zCountry
                  AND zone_code = :zoneCode
                   OR zone_name = :zoneCode
                  LIMIT 1";
    $sql = $db->bindVars($sql, ':zCountry', $country_id, 'integer');
    $sql = $db->bindVars($sql, ':zoneCode', $paypal_ec_payer_info['ship_state'], 'string');
    $states = $db->Execute($sql);
    if ($states->RecordCount() > 0) {
      $state_id = $states->fields['zone_id'];
    }
    /**
     * Using the supplied data from PayPal, set the data into the order record
     */
    // customer
    $order->customer['name']            = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
    $order->customer['company']         = $paypal_ec_payer_info['payer_business'];
    $order->customer['street_address']  = $paypal_ec_payer_info['ship_street_1'];
    $order->customer['suburb']          = $paypal_ec_payer_info['ship_street_2'];
    $order->customer['city']            = $paypal_ec_payer_info['ship_city'];
    $order->customer['postcode']        = $paypal_ec_payer_info['ship_postal_code'];
    $order->customer['state']           = $paypal_ec_payer_info['ship_state'];
    $order->customer['country']         = array('id' => $country_id, 'title' => $paypal_ec_payer_info['ship_country_name'], 'iso_code_2' => $paypal_ec_payer_info['ship_country_code'], 'iso_code_3' => $country_code3);
    $order->customer['country']['id']   = $country_id;
    $order->customer['country']['iso_code_2'] = $paypal_ec_payer_info['ship_country_code'];
    $order->customer['format_id']       = $address_format_id;
    $order->customer['email_address']   = $paypal_ec_payer_info['payer_email'];
    $order->customer['telephone']       = $paypal_ec_payer_info['ship_phone'];
    $order->customer['zone_id']         = $state_id;

    // billing
    $order->billing['name']             = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
    $order->billing['company']          = $paypal_ec_payer_info['payer_business'];
    $order->billing['street_address']   = $paypal_ec_payer_info['ship_street_1'];
    $order->billing['suburb']           = $paypal_ec_payer_info['ship_street_2'];
    $order->billing['city']             = $paypal_ec_payer_info['ship_city'];
    $order->billing['postcode']         = $paypal_ec_payer_info['ship_postal_code'];
    $order->billing['state']            = $paypal_ec_payer_info['ship_state'];
    $order->billing['country']          = array('id' => $country_id, 'title' => $paypal_ec_payer_info['ship_country_name'], 'iso_code_2' => $paypal_ec_payer_info['ship_country_code'], 'iso_code_3' => $country_code3);
    $order->billing['country']['id']    = $country_id;
    $order->billing['country']['iso_code_2'] = $paypal_ec_payer_info['ship_country_code'];
    $order->billing['format_id']        = $address_format_id;
    $order->billing['zone_id']          = $state_id;

    // delivery
    if ($_SESSION['paypal_ec_payer_info']['ship_address_status'] != 'None') {
      $order->delivery['name']          = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
      $order->delivery['company']       = $paypal_ec_payer_info['payer_business'];
      $order->delivery['street_address']= $paypal_ec_payer_info['ship_street_1'];
      $order->delivery['suburb']        = $paypal_ec_payer_info['ship_street_2'];
      $order->delivery['city']          = $paypal_ec_payer_info['ship_city'];
      $order->delivery['postcode']      = $paypal_ec_payer_info['ship_postal_code'];
      $order->delivery['state']         = $paypal_ec_payer_info['ship_state'];
      $order->delivery['country']       = array('id' => $country_id, 'title' => $paypal_ec_payer_info['ship_country_name'], 'iso_code_2' => $paypal_ec_payer_info['ship_country_code'], 'iso_code_3' => $country_code3);
      $order->delivery['country_id']    = $country_id;
      $order->delivery['format_id']     = $address_format_id;
      $order->delivery['zone_id']       = $state_id;
    }
    // debug
    $this->zcLog('ec_step2_finish - 2', 
'country_id = ' . $country_id . ' ' . $paypal_ec_payer_info['ship_country_name'] . ' ' . $paypal_ec_payer_info['ship_country_code'] ."\naddress_format_id = " . $address_format_id . "\nstate_id = " . $state_id . ' (original state tested: ' . $paypal_ec_payer_info['ship_state'] . ')' . "\ncountry1->fields['countries_id'] = " . $country1->fields['countries_id'] . "\ncountry2->fields['countries_id'] = " . $country2->fields['countries_id'] . "\n" . '$order = ' . print_r($order, true));

    // check to see whether PayPal should still be offered to this customer, based on the zone of their address:
    $this->update_status();
    if (!$this->enabled) {
      $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_ZONE_ERROR, true, FILENAME_SHOPPING_CART);
    }

    // see if the user is logged in
    if (!empty($_SESSION['customer_first_name']) && !empty($_SESSION['customer_id'])) {
      // They're logged in, so forward them straight to checkout stages, depending on address needs etc
      $order->customer['id'] = $_SESSION['customer_id'];

      // set the session value for express checkout temp
      $_SESSION['paypal_ec_temp'] = false;

      // if no address required for shipping, leave shipping portion alone
      if ($_SESSION['paypal_ec_payer_info']['ship_address_status'] != 'None' && $_SESSION['paypal_ec_payer_info']['ship_street_1'] != '') {
        // set the session info for the sendto
        $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];

        // This is the address matching section
        // try to match it first
        // note: this is by no means 100%
        $address_book_id = $this->findMatchingAddressBookEntry($_SESSION['customer_id'], $order->delivery);

        // no match, so add the record
        if (!$address_book_id) {
          $address_book_id = $this->addAddressBookEntry($_SESSION['customer_id'], $order->delivery, false);
        }

        // set the address for use
        $_SESSION['sendto'] = $address_book_id;
      }
      // set the users billto information (default address)
      if (!isset($_SESSION['billto'])) {
        $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
      }

      // debug
      $this->zcLog('ec_step2_finish - 3', 'Exiting ec_step2_finish logged-in mode.' . "\n" . 'Selected address: ' . $address_book_id . "\nOriginal was: " . $original_default_address_id);


      // select a shipping method, based on cheapest available option
      if (MODULE_PAYMENT_PAYPALWPP_AUTOSELECT_CHEAPEST_SHIPPING == 'Yes') $this->setShippingMethod();

      // send the user on
      if ($_SESSION['paypal_ec_markflow'] == 1) {
        $this->terminateEC('', false, FILENAME_CHECKOUT_PROCESS);
      } else {
        $this->terminateEC('', false, FILENAME_CHECKOUT_CONFIRMATION);
      }
    } else {
      // They're not logged in.  Create an account if necessary, and then log them in.
      // First, see if they're an existing customer, and log them in automatically

      // If Paypal didn't supply us an email address, something went wrong
      if (trim($paypal_ec_payer_info['payer_email']) == '') $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE, true);

      // attempt to obtain the user information using the payer_email from the info returned from PayPal, via email address
      $sql = "SELECT customers_id, customers_firstname, customers_lastname, customers_paypal_payerid, customers_paypal_ec
              FROM " . TABLE_CUSTOMERS . "
              WHERE customers_email_address = :emailAddress ";
      $sql = $db->bindVars($sql, ':emailAddress', $paypal_ec_payer_info['payer_email'], 'string');
      $check_customer = $db->Execute($sql);

      // debug
      $this->zcLog('ec_step2_finish - 4', 'Not logged in. Looking for account.' . "\n" . $sql . "\n" . print_r($check_customer, true));


      if (!$check_customer->EOF) {
        $acct_exists = true;

        // see if this was only a temp account -- if so, remove it
        if ($check_customer->fields['customers_paypal_ec'] == '1') {
          // Delete the existing temporary account
          $this->ec_delete_user($check_customer->fields['customers_id']);
          $acct_exists = false;

          // debug
          $this->zcLog('ec_step2_finish - 5', 'Found temporary account - deleting it.');

        }
      }

      // Create an account, if the account does not exist
      if (!$acct_exists) {

        // debug
        $this->zcLog('ec_step2_finish - 6', 'No ZC account found for this customer. Creating new account.' . "\n" . '$this->new_acct_notify =' . $this->new_acct_notify);

        // Generate a random 8-char password
        $password = zen_create_random_value(8);

        $sql_data_array = array();

        // set the customer information in the array for the table insertion
        $sql_data_array = array(
        'customers_firstname'           => $paypal_ec_payer_info['payer_firstname'],
        'customers_lastname'            => $paypal_ec_payer_info['payer_lastname'],
        'customers_email_address'       => $paypal_ec_payer_info['payer_email'],
        'customers_telephone'           => $paypal_ec_payer_info['ship_phone'],
        'customers_fax'                 => '',
        'customers_gender'              => $paypal_ec_payer_info['payer_gender'],
        'customers_newsletter'          => '0',
        'customers_password'            => zen_encrypt_password($password),
        'customers_paypal_payerid'      => $_SESSION['paypal_ec_payer_id']);

        // insert the data
        $result = zen_db_perform(TABLE_CUSTOMERS, $sql_data_array);

        // grab the customer_id (last insert id)
        $customer_id = $db->Insert_ID();

        // set the Guest customer ID -- for PWA purposes
        $_SESSION['customer_guest_id'] = $customer_id;

        // set the customer address information in the array for the table insertion
        $sql_data_array = array(
        'customers_id'              => $customer_id,
        'entry_gender'              => $paypal_ec_payer_info['payer_gender'],
        'entry_firstname'           => $paypal_ec_payer_info['payer_firstname'],
        'entry_lastname'            => $paypal_ec_payer_info['payer_lastname'],
        'entry_street_address'      => $paypal_ec_payer_info['ship_street_1'],
        'entry_suburb'              => $paypal_ec_payer_info['ship_street_2'],
        'entry_city'                => $paypal_ec_payer_info['ship_city'],
        'entry_zone_id'             => $state_id,
        'entry_postcode'            => $paypal_ec_payer_info['ship_postal_code'],
        'entry_country_id'          => $country_id);
        if ($state_id > 0) {
          $sql_data_array['entry_zone_id'] = $state_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = 0;
          $sql_data_array['entry_state'] = $paypal_ec_payer_info['ship_state'];
        }

        // insert the data
        zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

        // grab the address_id (last insert id)
        $address_id = $db->Insert_ID();

        // set the address id lookup for the customer
        $sql = "UPDATE " . TABLE_CUSTOMERS . "
                SET customers_default_address_id = :addrID
                WHERE customers_id = :custID";
        $sql = $db->bindVars($sql, ':addrID', $address_id, 'integer');
        $sql = $db->bindVars($sql, ':custID', $customer_id, 'integer');
        $db->Execute($sql);

        // insert the new customer_id into the customers info table for consistency
        $sql = "INSERT INTO " . TABLE_CUSTOMERS_INFO . "
                       (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created)
                VALUES (:custID, 0, now())";
        $sql = $db->bindVars($sql, ':custID', $customer_id, 'integer');
        $db->Execute($sql);

        // send Welcome Email if appropriate
        if ($this->new_acct_notify == 'Yes') {
          // require the language file
          global $language_page_directory, $template_dir;
          if (!isset($language_page_directory)) $language_page_directory = DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
          if (file_exists($language_page_directory . $template_dir . '/create_account.php')) {
            $template_dir_select = $template_dir . '/';
          } else {
            $template_dir_select = '';
          }
          require($language_page_directory . $template_dir_select . '/create_account.php');

          // set the mail text
          $email_text = sprintf(EMAIL_GREET_NONE, $paypal_ec_payer_info['payer_firstname']) . EMAIL_WELCOME . EMAIL_TEXT;
          $email_text .= "\n\n" . EMAIL_EC_ACCOUNT_INFORMATION . "\nUsername: " . $paypal_ec_payer_info['payer_email'] . "\nPassword: " . $password . "\n\n";
          $email_text .= EMAIL_CONTACT;

          // send the mail
          zen_mail($paypal_ec_payer_info['payer_firstname'] . " " . $paypal_ec_payer_info['payer_lastname'], $paypal_ec_payer_info['payer_email'], EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($email_text)), 'welcome');

          // set the express checkout temp -- false means the account is no longer "only" for EC ... it'll be permanent
          $_SESSION['paypal_ec_temp'] = false;
        } else {
          // Make it a temporary account that'll be deleted once they've checked out
          $sql = "UPDATE " . TABLE_CUSTOMERS . "
                  SET customers_paypal_ec = 1
                  WHERE customers_id = :custID ";
          $sql = $db->bindVars($sql, ':custID', $customer_id, 'integer');
          $db->Execute($sql);

          // set the boolean ec temp value since we created account strictly for EC purposes
          $_SESSION['paypal_ec_temp'] = true;
        }

        // hook notifier class vis a vis account-creation
        $this->notify('NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT');

      } else {
        // set the boolean ec temp value for the account to false, since we didn't have to create one
        $_SESSION['paypal_ec_temp'] = false;
      }

      // log the user in with the email sent back from paypal response
      $this->user_login($_SESSION['paypal_ec_payer_info']['payer_email'], false);

      // debug
      $this->zcLog('ec_step2_finish - 7', 'Auto-Logged customer in. (' . $_SESSION['paypal_ec_payer_info']['payer_email'] . ') (' . $_SESSION['customer_id'] . ')' . "\n" . '$_SESSION[paypal_ec_temp]=' . $_SESSION['paypal_ec_temp']);


      // This is the address matching section
      // try to match it first
      // note: this is by no means 100%
      $address_book_id = $this->findMatchingAddressBookEntry($_SESSION['customer_id'], $order->delivery);
      // no match add the record
      if (!$address_book_id) {
        $address_book_id = $this->addAddressBookEntry($_SESSION['customer_id'], $order->delivery, false);
        if (!$address_book_id) {
          $address_book_id = $_SESSION['customer_default_address_id'];
        }
      }
      // set the sendto to the address
      $_SESSION['sendto'] = $address_book_id;
      // set billto in the session
      $_SESSION['billto'] = $_SESSION['customer_default_address_id'];

      // select a shipping method, based on cheapest available option
      if (MODULE_PAYMENT_PAYPALWPP_AUTOSELECT_CHEAPEST_SHIPPING == 'Yes') $this->setShippingMethod();

      // debug
      $this->zcLog('ec_step2_finish - 8', 'Exiting via terminateEC (from originally-not-logged-in mode).' . "\n" . 'Selected address: ' . $address_book_id . "\nOriginal was: " . $original_default_address_id . "\nprepared data: " . print_r($order->delivery, true));

      // send the user on
      if ($_SESSION['paypal_ec_markflow'] == 1) {
        $this->terminateEC('', false, FILENAME_CHECKOUT_PROCESS);
      } else {
        $this->terminateEC('', false, FILENAME_CHECKOUT_CONFIRMATION);
      }
    }
  }
  /**
   * Determine the appropriate shipping method if applicable
   * By default, selects the lowest-cost quote
   */
  function setShippingMethod() {
    global $total_count, $total_weight;
    // ensure that cart contents is calculated properly for weight and value
    if (!isset($total_weight)) $total_weight = $_SESSION['cart']->show_weight();
    if (!isset($total_count)) $total_count = $_SESSION['cart']->count_contents();
    // set the shipping method if one is not already set
    // defaults to the cheapest shipping method
    if ( !$_SESSION['shipping'] || ( $_SESSION['shipping'] && ($_SESSION['shipping'] == false) && (zen_count_shipping_modules() > 1) ) ) {
      require_once(DIR_WS_CLASSES . 'http_client.php');
      require_once(DIR_WS_CLASSES . 'shipping.php');
      $shipping_Obj = new shipping;

      // generate the quotes
      $shipping_Obj->quote();

      // set the cheapest one
      $_SESSION['shipping'] = $shipping_Obj->cheapest();
    }
  }
  /**
   * Get Override Address (uses sendto if set, otherwise uses customer's primary address)
   */
  function getOverrideAddress() {
    global $db;

    // Only proceed IF *in* markflow mode AND logged-in (have to be logged in to get to markflow mode anyway)
    if (!empty($_GET['markflow']) && !empty($_SESSION['customer_id'])) {
      // From now on for this user we will edit addresses in Zen Cart, not by going to PayPal.
      $_SESSION['paypal_ec_markflow'] = 1;


      // debug
      $this->zcLog('getOverrideAddress - 1', 'Now in markflow mode.' . "\n" . 'SESSION[sendto] = ' . $_SESSION['sendto']);


      // find the users default address id
      if (!empty($_SESSION['sendto'])) {
        $address_id = $_SESSION['sendto'];
      } else {
        $sql = "SELECT customers_default_address_id
                FROM " . TABLE_CUSTOMERS . "
                WHERE customers_id = :customerId";
        $sql = $db->bindVars($sql, ':customerId', $_SESSION['customer_id'], 'integer');
        $default_address_id_arr = $db->Execute($sql);
        if (!$default_address_id_arr->EOF) {
          $address_id = $default_address_id_arr->fields['customers_default_address_id'];
        } else {
          // couldn't find an address.
          return false;
        }
      }
      // now grab the address from the database and set it as the overridden address
      $sql = "SELECT entry_firstname, entry_lastname,
                     entry_street_address, entry_suburb, entry_city, entry_postcode,
                     entry_country_id, entry_zone_id, entry_state
              FROM " . TABLE_ADDRESS_BOOK . "
              WHERE address_book_id = :addressId
              AND customers_id = :customerId
              LIMIT 1";
      $sql = $db->bindVars($sql, ':addressId', $address_id, 'integer');
      $sql = $db->bindVars($sql, ':customerId', $_SESSION['customer_id'], 'integer');
      $address_arr = $db->Execute($sql);

      // see if we found a record, if not then we have nothing to override with
      if (!$address_arr->EOF) {
        // get the state/prov code
        $sql = "SELECT zone_code
                FROM " . TABLE_ZONES . "
                WHERE zone_id = :zoneId";
        $sql = $db->bindVars($sql, ':zoneId', $address_arr->fields['entry_zone_id'], 'integer');
        $state_code_arr = $db->Execute($sql);
        if ($state_code_arr->EOF) {
          $state_code_arr->fields['zone_code'] = '';
        }
        if ($state_code_arr->fields['zone_code'] == '' && $address_arr->fields['entry_state'] != '') {
          $state_code_arr->fields['zone_code'] = $address_arr->fields['entry_state'];
        }
        $address_arr->fields['zone_code'] = $state_code_arr->fields['zone_code'];

        // get the country code
        // ISO 3166 standard country code
        $sql = "SELECT countries_iso_code_2
                FROM " . TABLE_COUNTRIES . "
                WHERE countries_id = :countryId";
        $sql = $db->bindVars($sql, ':countryId', $address_arr->fields['entry_country_id'], 'integer');
        $country_code_arr = $db->Execute($sql);
        if ($country_code_arr->EOF) {
          // default to US if not found
          $country_code_arr->fields['countries_iso_code_2'] = 'US';
        }
        $address_arr->fields['countries_iso_code_2'] = $country_code_arr->fields['countries_iso_code_2'];

        // debug
        $this->zcLog('getOverrideAddress - 2', '$address_arr->fields = ' . print_r($address_arr->fields, true));

        // return address data.
        return $address_arr->fields;
      }
      // debug
      $this->zcLog('getOverrideAddress - 3', 'no override record found');
    }
    // debug
    $this->zcLog('getOverrideAddress - 4', 'not logged in and not in markflow mode - nothing to override');

    return false;
  }
  /**
     * This method attempts to match items in an address book, to avoid
     * duplicate entries to the address book.  On a successful match it
     * returns the address_book_id(int) -  on failure it returns false.
     *
     * @param int $customer_id
     * @param array $address_question_arr
     * @return int|boolean
     */
  function findMatchingAddressBookEntry($customer_id, $address_question_arr) {
    global $db;

    // if address is blank, don't do any matching
    if ($address_question_arr['street_address'] == '') return false;

    // default
    $country_id = '223';
    $address_format_id = 2; //2 is the American format

    // first get the zone id's from the 2 digit iso codes
    // country first
    $sql = "SELECT countries_id, address_format_id
            FROM " . TABLE_COUNTRIES . "
            WHERE countries_iso_code_2 = :countryId
               OR countries_name = :countryId
            LIMIT 1";
    $sql = $db->bindVars($sql, ':countryId', $address_question_arr['country']['title'], 'string');
    $country = $db->Execute($sql);

    // see if we found a record, if not default to American format
    if (!$country->EOF) {
      $country_id = $country->fields['countries_id'];
      $address_format_id = $country->fields['address_format_id'];
    }

    // see if the country code has a state
    $sql = "SELECT zone_id
            FROM " . TABLE_ZONES . "
            WHERE zone_country_id = :zoneId
            LIMIT 1";
    $sql = $db->bindVars($sql, ':zoneId', $country_id, 'integer');
    $country_zone_check = $db->Execute($sql);
    $check_zone = $country_zone_check->RecordCount();

    // now try and find the zone_id (state/province code)
    // use the country id above
    if ($check_zone) {
      $sql = "SELECT zone_id
              FROM " . TABLE_ZONES . "
              WHERE zone_country_id = :zoneId
                AND zone_code = :zoneCode
                 OR zone_name = :zoneCode
              LIMIT 1";
      $sql = $db->bindVars($sql, ':zoneId', $country_id, 'integer');
      $sql = $db->bindVars($sql, ':zoneCode', $address_question_arr['state'], 'string');
      $zone = $db->Execute($sql);
      if (!$zone->EOF) {
        // grab the id
        $zone_id = $zone->fields['zone_id'];
      } else {
        $check_zone = false;
        $zone_id = 0;
      }
    }
    // debug
    $this->zcLog('findMatchingAddressBookEntry - 1-stats', 'country:' . print_r($country, true) . "\n" . 'country_zone_check:' . print_r($country_zone_check, true) . "\n" . 'zone_check:' . print_r($zone, true) . 'check_zone: ' . $check_zone . "\n" . 'zone:' . $zone_id);

    // do a match on address suburb
    $sql = "SELECT address_book_id, entry_street_address, entry_suburb
                FROM " . TABLE_ADDRESS_BOOK . "
                WHERE customers_id = :customerId
                AND entry_country_id = :countryId";
    if ($check_zone) {
      $sql .= "  AND entry_zone_id = :zoneId";
    }
    $sql = $db->bindVars($sql, ':zoneId', $zone_id, 'integer');
    $sql = $db->bindVars($sql, ':countryId', $country_id, 'integer');
    $sql = $db->bindVars($sql, ':customerId', $customer_id, 'integer');
    $answers_arr = $db->Execute($sql);
    // debug
    $this->zcLog('findMatchingAddressBookEntry - 2-read for match', "\nSQL was:" . $sql . "\nRecordCount = " . $answers_arr->RecordCount());

    if (!$answers_arr->EOF) {
      // build a base string to compare street+suburb content
      $matchQuestion = str_replace("\n", '', $address_question_arr['street_address']);
      $matchQuestion = trim($matchQuestion);
      $matchQuestion = $matchQuestion . str_replace("\n", '', $address_question_arr['suburb']);
      $matchQuestion = str_replace("\t", '', $matchQuestion);
      $matchQuestion = trim($matchQuestion);
      $matchQuestion = strtolower($matchQuestion);
      $matchQuestion = str_replace(' ', '', $matchQuestion);

      // go through the data
      while (!$answers_arr->EOF) {
        // now the matching logic

        // first from the db
        $fromDb = '';
        $fromDb = str_replace("\n", '', $answers_arr->fields['entry_street_address']);
        $fromDb = trim($fromDb);
        $fromDb = $fromDb . str_replace("\n", '', $answers_arr->fields['entry_suburb']);
        $fromDb = str_replace("\t", '', $fromDb);
        $fromDb = trim($fromDb);
        $fromDb = strtolower($fromDb);
        $fromDb = str_replace(' ', '', $fromDb);

        // debug
        $this->zcLog('findMatchingAddressBookEntry - 3a', "From PayPal:\r\n" . $matchQuestion . "\r\n\r\nFrom DB:\r\n" . $fromDb . "\r\n". print_r($answers_arr, true));

        // check the strings
        if (strlen($fromDb) == strlen($matchQuestion)) {
          if ($fromDb == $matchQuestion) {
            // exact match return the id
            // debug
            $this->zcLog('findMatchingAddressBookEntry - 3b', "Exact match:\n" . print_r($answers_arr->fields, true));
            return $answers_arr->fields['address_book_id'];
          }
        } elseif (strlen($fromDb) > strlen($matchQuestion)) {
          if (substr($fromDb, 0, strlen($matchQuestion)) == $matchQuestion) {
            // we have a match return it (PP)
            // debug
            $this->zcLog('findMatchingAddressBookEntry - 3b', "partial match (PP):\n" . print_r($answers_arr->fields, true));
            return $answers_arr->fields['address_book_id'];
          }
        } else {
          if ($fromDb == substr($matchQuestion, 0, strlen($fromDb))) {
            // we have a match return it (DB)
            // debug
            $this->zcLog('findMatchingAddressBookEntry - 3b', "partial match (DB):\n" . print_r($answers_arr->fields, true));
            return $answers_arr->fields['address_book_id'];
          }
        }

        $answers_arr->MoveNext();
      }
    }
    // debug
    $this->zcLog('findMatchingAddressBookEntry - 4', "no match");

    // no matches found
    return false;
  }
  /**
     * This method adds an address book entry to the database, this allows us to add addresses
     * that we get back from PayPal that are not in Zen Cart
     *
     * @param int $customer_id
     * @param array $address_question_arr
     * @return int
     */
  function addAddressBookEntry($customer_id, $address_question_arr, $make_default = false) {
    global $db;

    // debug
    $this->zcLog('addAddressBookEntry - 1', 'address to add: ' . "\n" . print_r($address_question_arr, true));

    // set some defaults
    $country_id = '223';
    $address_format_id = 2; //2 is the American format

    // first get the zone id's from the 2 digit iso codes
    // country first
    $sql = "SELECT countries_id, address_format_id
                FROM " . TABLE_COUNTRIES . "
                WHERE countries_iso_code_2 = :countryId
                OR countries_name = :countryId
                LIMIT 1";
    $sql = $db->bindVars($sql, ':countryId', $address_question_arr['country']['title'], 'string');
    $country = $db->Execute($sql);

    // see if we found a record, if not default to American format
    if (!$country->EOF) {
      $country_id = $country->fields['countries_id'];
      $address_format_id = (int)$country->fields['address_format_id'];
    }

    // see if the country code has a state
    $sql = "SELECT zone_id
                FROM " . TABLE_ZONES . "
                WHERE zone_country_id = :zoneId
                LIMIT 1";
    $sql = $db->bindVars($sql, ':zoneId', $country_id, 'integer');
    $country_zone_check = $db->Execute($sql);
    $check_zone = $country_zone_check->RecordCount();

    // now try and find the zone_id (state/province code)
    // use the country id above
    if ($check_zone) {
      $sql = "SELECT zone_id
                    FROM " . TABLE_ZONES . "
                    WHERE zone_country_id = :zoneId
                    AND zone_code = :zoneCode
                    OR zone_name = :zoneCode
                    LIMIT 1";
      $sql = $db->bindVars($sql, ':zoneId', $country_id, 'integer');
      $sql = $db->bindVars($sql, ':zoneCode', $address_question_arr['state'], 'string');
      $zone = $db->Execute($sql);
      if (!$zone->EOF) {
        // grab the id
        $zone_id = $zone->fields['zone_id'];
      } else {
        $zone_id = 0;
      }
    }

    // now run the insert

    // this isn't the best way to get fname/lname but it will get the majority of cases
    list($fname, $lname) = explode(' ', $address_question_arr['name']);

    $sql_data_array= array(array('fieldName'=>'entry_firstname', 'value'=>$fname, 'type'=>'string'),
                           array('fieldName'=>'entry_lastname', 'value'=>$lname, 'type'=>'string'),
                           array('fieldName'=>'entry_street_address', 'value'=>$address_question_arr['street_address'], 'type'=>'string'),
                           array('fieldName'=>'entry_postcode', 'value'=>$address_question_arr['postcode'], 'type'=>'string'),
                           array('fieldName'=>'entry_city', 'value'=>$address_question_arr['city'], 'type'=>'string'),
                           array('fieldName'=>'entry_country_id', 'value'=>$country_id, 'type'=>'integer'));
    $sql_data_array[] = array('fieldName'=>'entry_gender', 'value'=>$address_question_arr['payer_gender'], 'type'=>'enum:m|f');
    $sql_data_array[] = array('fieldName'=>'entry_suburb', 'value'=>$address_question_arr['suburb'], 'type'=>'string');
    if ($zone_id > 0) {
      $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>$zone_id, 'type'=>'integer');
      $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>'', 'type'=>'string');
    } else {
      $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>'0', 'type'=>'integer');
      $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>$address_question_arr['state'], 'type'=>'string');
    }
    $sql_data_array[] = array('fieldName'=>'customers_id', 'value'=>$customer_id, 'type'=>'integer');
    $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array);

    $new_address_book_id = $db->Insert_ID();

    $this->notify('NOTIFY_HEADER_ADDRESS_BOOK_ADD_ENTRY_DONE');

    // make default if set, update
    if ($make_default) {
      $sql_data_array = array();
      $sql_data_array[] = array('fieldName'=>'customers_default_address_id', 'value'=>$new_address_book_id, 'type'=>'integer');
      $where_clause = "customers_id = :customersID";
      $where_clause = $db->bindVars($where_clause, ':customersID', $customer_id, 'integer');
      $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
      $_SESSION['customer_default_address_id'] = $new_address_book_id;
    }

    // set the sendto
    $_SESSION['sendto'] = $new_address_book_id;

    // debug
    $this->zcLog('addAddressBookEntry - 2', 'added address #' . $new_address_book_id. "\n" . 'SESSION[sendto] is now set to ' . $_SESSION['sendto']);

    // return the address_id
    return $new_address_book_id;
  }


  /**
   * If we created an account for the customer, this logs them in and notes that the record was created for PayPal EC purposes
   */
  function user_login($email_address, $redirect = true) {
    global $db, $order;
    global $session_started;
    if ($session_started == false) {
      zen_redirect(zen_href_link(FILENAME_COOKIE_USAGE));
    }
    $sql = "SELECT * FROM " . TABLE_CUSTOMERS . "
            WHERE customers_email_address = :custEmail ";
    $sql = $db->bindVars($sql, ':custEmail', $email_address, 'string');
    $check_customer = $db->Execute($sql);

    if ($check_customer->EOF) {
      $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_LOGIN, true);
    }
    if (SESSION_RECREATE == 'True') {
      zen_session_recreate();
    }
    $sql = "SELECT entry_country_id, entry_zone_id
            FROM " . TABLE_ADDRESS_BOOK . "
            WHERE customers_id = :custID
            AND address_book_id = :addrID ";
    $sql = $db->bindVars($sql, ':custID', $check_customer->fields['customers_id'], 'integer');
    $sql = $db->bindVars($sql, ':addrID', $check_customer->fields['customers_default_address_id'], 'integer');
    $check_country = $db->Execute($sql);
    $_SESSION['customer_id'] = (int)$check_customer->fields['customers_id'];
    $_SESSION['customer_default_address_id'] = $check_customer->fields['customers_default_address_id'];
    $_SESSION['customer_first_name'] = $check_customer->fields['customers_firstname'];
    $_SESSION['customer_country_id'] = $check_country->fields['entry_country_id'];
    $_SESSION['customer_zone_id'] = $check_country->fields['entry_zone_id'];
    $order->customer['id'] = $_SESSION['customer_id'];
    $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
            SET customers_info_date_of_last_logon = now(),
                customers_info_number_of_logons = customers_info_number_of_logons+1
            WHERE customers_info_id = :custID ";
    $sql = $db->bindVars($sql, ':custID', $_SESSION['customer_id'], 'integer');
    $db->Execute($sql);
    $_SESSION['cart']->restore_contents();
    if ($redirect) {
      $this->terminateEC();
    }
    return true;
  }
  /**
   * If the account was created only for temporary purposes to place the PayPal order, delete it.
   */
  function ec_delete_user($cid) {
    global $db;
    unset($_SESSION['customer_id']);
    unset($_SESSION['customer_default_address_id']);
    unset($_SESSION['customer_first_name']);
    unset($_SESSION['customer_country_id']);
    unset($_SESSION['customer_zone_id']);
    unset($_SESSION['comments']);
    unset($_SESSION['customer_guest_id']);
    $cid = (int)$cid;
    $sql = "delete from " . TABLE_ADDRESS_BOOK . " where customers_id = " . $cid;
    $db->Execute($sql);
    $sql = "delete from " . TABLE_CUSTOMERS . " where customers_id = " . $cid;
    $db->Execute($sql);
    $sql = "delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = " . $cid;
    $db->Execute($sql);
    $sql = "delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . $cid;
    $db->Execute($sql);
    $sql = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = " . $cid;
    $db->Execute($sql);
    $sql = "delete from " . TABLE_WHOS_ONLINE . " where customer_id = " . $cid;
    $db->Execute($sql);
  }
  /**
   * If the EC flow has to be interrupted for any reason, this does the appropriate cleanup and displays status/error messages.
   */
  function terminateEC($error_msg = '', $kill_sess_vars = false, $goto_page = '') {
    global $messageStack, $order, $order_total_modules;
    $stackAlert = 'header';

    // debug
    $this->_doDebug('PayPal test Log - terminateEC-A', "goto page: " . $goto_page . "\nerror_msg: " . $error_msg . "\n\nSession data: " . print_r($_SESSION, true));

    if ($kill_sess_vars) {
      if (!empty($_SESSION['paypal_ec_temp'])) {
        $this->ec_delete_user($_SESSION['customer_id']);
      }
      // Unregister the paypal session variables, making the user start over.
      unset($_SESSION['paypal_ec_temp']);
      unset($_SESSION['paypal_ec_token']);
      unset($_SESSION['paypal_ec_payer_id']);
      unset($_SESSION['paypal_ec_payer_info']);
      unset($_SESSION['paypal_ec_final']);
      unset($_SESSION['paypal_ec_markflow']);
      // debug
      $this->zcLog('termEC-1', 'Killed the session vars as requested');
    }

    $this->zcLog('termEC-2', 'BEFORE: $this->showPaymentPage = ' . (int)$this->showPaymentPage . "\nToken Data:" . $_SESSION['paypal_ec_token']);
    // force display of payment page if GV/DC active for this customer
    if (MODULE_ORDER_TOTAL_INSTALLED && $this->showPaymentPage !== true && isset($_SESSION['paypal_ec_token']) ) {
      require_once(DIR_WS_CLASSES . 'order.php');
      $order = new order;
      require_once(DIR_WS_CLASSES . 'order_total.php');
      $order_total_modules = new order_total;
      $order_totals = $order_total_modules->process();
      $selection =  $order_total_modules->credit_selection();
      if (sizeof($selection)>0) $this->showPaymentPage = true;
    }
    // if came from Payment page, don't go back to it
    if ($_SESSION['paypal_ec_markflow'] == 1) $this->showPaymentPage = false;
    // if in DP mode, don't go to payment page ... we've already been there to get here
    if ($goto_page == FILENAME_CHECKOUT_PROCESS) $this->showPaymentPage = false;

    // debug
    $this->zcLog('termEC-3', 'AFTER: $this->showPaymentPage = ' . (int)$this->showPaymentPage);

    if (!empty($_SESSION['customer_first_name']) && !empty($_SESSION['customer_id'])) {
      if ($this->showPaymentPage === true || $goto_page == FILENAME_CHECKOUT_PAYMENT) {
        // debug
        $this->zcLog('termEC-4', 'We ARE logged in, and $this->showPaymentPage === true');
        // if no shipping selected or if shipping cost is < 0 goto shipping page
        if ((!$_SESSION['shipping'] || $_SESSION['shipping'] == '') || $_SESSION['shipping']['cost'] < 0) {
          // debug
          $this->zcLog('termEC-5', 'Have no shipping method selected, or shipping < 0 so set FILENAME_CHECKOUT_SHIPPING');
          $redirect_path = FILENAME_CHECKOUT_SHIPPING;
          $stackAlert = 'checkout_shipping';
        } else {
          // debug
          $this->zcLog('termEC-6', 'We DO have a shipping method selected, so goto PAYMENT');
          $redirect_path = FILENAME_CHECKOUT_PAYMENT;
          $stackAlert = 'checkout_payment';
        }
      } elseif ($goto_page) {
        // debug
        $this->zcLog('termEC-7', '$this->showPaymentPage NOT true, and have custom page parameter: ' . $goto_page);
        $redirect_path = $goto_page;
        $stackAlert = 'header';
        if ($goto_page == FILENAME_SHOPPING_CART) $stackAlert = 'shopping_cart';
      } else {
        // debug
        $this->zcLog('termEC-8', '$this->showPaymentPage NOT true, and NO custom page selected ... using SHIPPING as default');
        $redirect_path = FILENAME_CHECKOUT_SHIPPING;
        $stackAlert = 'checkout_shipping';
      }
    } else {
      // debug
      $this->zcLog('termEC-9', 'We are NOT logged in, so set snapshot to Shipping page, and redirect to login');
      $_SESSION['navigation']->set_snapshot(FILENAME_CHECKOUT_SHIPPING);
      $redirect_path = FILENAME_LOGIN;
      $stackAlert = 'login';
    }
    if ($error_msg) {
      $messageStack->add_session($stackAlert, $error_msg, 'error');
    }
    // debug
    $this->zcLog('termEC-10', 'Redirecting to ' . $redirect_path . ' - Stack: ' . $stackAlert . "\n" . 'Message: ' . $error_msg . "\nSession Data: " . print_r($_SESSION, true));
    zen_redirect(zen_href_link($redirect_path, '', 'SSL', true, false));
  }
  /**
   * Error / exception handling
   */
  function _errorHandler($response, $operation = '', $ignore_codes = '') {
    global $messageStack, $doPayPal;
    $gateway_mode = (isset($response['PNREF']) && $response['PNREF'] != '');
    $basicError = (!$response || (isset($response['RESULT']) && $response['RESULT'] != 0) || (isset($response['ACK']) && !strstr($response['ACK'], 'Success')) || (!isset($response['RESULT']) && !isset($response['ACK'])));
    $ignoreList = explode(',', str_replace(' ', '', $ignore_codes));
    foreach($ignoreList as $key=>$value) {
      if ($value != '' && $response['L_ERRORCODE0'] == $value) $basicError = false;
    }
    //echo '<br />basicError='.$basicError.'<br />' . urldecode(print_r($response,true)); die('halted');

    switch($operation) {
      case 'SetExpressCheckout':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ec_step1()', "In function: ec_step1()\r\n\r\nValue List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR;
          $errorNum = urldecode($response['L_ERRORCODE0'] . $response['RESULT']);
          if ($response['RESULT'] == 25) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_WPP_ACCOUNT_ERROR;
          if ($response['L_ERRORCODE0'] == 10002) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_SANDBOX_VS_LIVE_ERROR;
          if ($response['L_ERRORCODE0'] == 10565) {
            $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_WPP_BAD_COUNTRY_ERROR;
            $_SESSION['payment'] = '';
          }
          if ($response['L_ERRORCODE0'] == 10736) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_ADDR_ERROR;
          if ($response['L_ERRORCODE0'] == 10752) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED;

          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? $errorNum . ' ' . urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . (isset($response['RESPMSG']) ? ' ' . $response['RESPMSG'] : '') . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_MESSAGE . urldecode($response['L_ERRORCODE0'] . "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $errorText);
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>$detailedMessage), 'paymentalert');
          $this->terminateEC($errorText . ' (' . $errorNum . ') ' . $detailedMessage, true);
          return true;
        }
        break;

      case 'GetExpressCheckoutDetails':
        if ($basicError || $_SESSION['paypal_ec_token'] != urldecode($response['TOKEN'])) {
          // if response indicates an error, send the customer back to checkout and display the error. Debug to store owner if active.
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ec_step2()', "In function: ec_step2()\r\n\r\nValue List:\r\n" . str_replace('&',"\r\n", urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList)))) . "\r\n\r\nResponse:\r\n" . urldecode(print_r($response, true)));
          }
          $this->terminateEC(MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR . ' (' . $response['L_ERRORCODE0'] . ' ' . urldecode($response['L_SHORTMESSAGE0'] . $response['RESULT']) . ')', true);
          return true;
        }
        break;

      case 'DoExpressCheckoutPayment':
        if ($basicError || $_SESSION['paypal_ec_token'] != urldecode($response['TOKEN'])) {
          // there's an error, so alert customer, and if debug is on, notify storeowner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - before_process() - EC', "In function: before_process() - Express Checkout\r\n\r\nValue List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }

          // if funding source problem occurred, must send back to re-select alternate funding source
          if ($response['L_ERRORCODE0'] == 10422) {
            $paypal_url = $this->getPayPalLoginServer();
            zen_redirect($paypal_url . "?cmd=_express-checkout&token=" . $_SESSION['paypal_ec_token']);
            die();
          }
          // some other error condition
          $errorText = MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE;
          $errorNum = urldecode($response['L_ERRORCODE0']);
          if ($response['L_ERRORCODE0'] == 10415) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_ORDER_ALREADY_PLACED_ERROR;
          if ($response['L_ERRORCODE0'] == 10417) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_INSUFFICIENT_FUNDS_ERROR;
          if ($response['L_ERRORCODE0'] == 10474) $errorText .= urldecode($response['L_LONGMESSAGE0']);

          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? $errorNum . ' ' . urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . $response['RESULT'] . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_MESSAGE . urldecode($response['L_ERRORCODE0'] . "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $errorText);
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>$detailedMessage), 'paymentalert');
          $this->terminateEC(($detailedEmailMessage == '' ? $errorText . ' (' . urldecode($response['L_SHORTMESSAGE0'] . $response['RESULT']) . ') ' : $detailedMessage), true);
          return true;
        }
        break;
      case 'DoDirectPayment':
        if ($basicError || 
           (isset($_SESSION['paypal_ec_token']) && $_SESSION['paypal_ec_token'] != urldecode($response['TOKEN'])) ) {
            // Error, so send the store owner a complete dump of the transaction.
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - before_process() - DP', "In function: before_process() - Direct Payment \r\nDid first contact attempt return error? " . ($error_occurred ? "Yes" : "No") . " \r\n\r\nValue List:\r\n" . str_replace('&',"\r\n", urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList)))) . "\r\n\r\nResponse:\r\n" . urldecode(print_r($response, true)));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE;
          $errorNum = urldecode($response['L_ERRORCODE0'] . $response['RESULT'] . ' ' . $response['RESPMSG']);
          if ($response['RESULT'] == 25) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_WPP_ACCOUNT_ERROR;
          if ($response['L_ERRORCODE0'] == 10002) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_SANDBOX_VS_LIVE_ERROR;
          if ($response['L_ERRORCODE0'] == 10565) {
            $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_WPP_BAD_COUNTRY_ERROR;
            $_SESSION['payment'] = '';
          }
          if ($response['L_ERRORCODE0'] == 10736) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_ADDR_ERROR;
          if ($response['L_ERRORCODE0'] == 10752) {
            $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED;
            $errorNum = '10752';
          }
          if ($response['RESPMSG'] != '') $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED;

          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE || $errorText == MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? $errorNum . ' ' . urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_MESSAGE . urldecode($response['L_ERRORCODE0'] . "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $detailedMessage . "\n\n" . 'Transaction Response Details: ' . print_r($response, true) . "\n\n" . 'Transaction Submission: ' . urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList), true)));
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($detailedEmailMessage)), 'paymentalert');
          $this->terminateEC(($detailedEmailMessage == '' ? $errorText . ' (' . $errorNum . ') ' : $detailedMessage), ($gateway_mode ? true : false), FILENAME_CHECKOUT_PAYMENT);
          return true;
        }
        break;
      case 'DoRefund':
        if ($basicError || (!isset($response['RESPMSG']) && !isset($response['REFUNDTRANSACTIONID']))) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_ERROR;
          if ($response['L_ERRORCODE0'] == 10009) $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_REFUNDFULL_ERROR;
          if ($response['RESULT'] == 105 || isset($response['RESPMSG'])) $response['L_SHORTMESSAGE0'] = $response['RESULT'] . ' ' . $response['RESPMSG'];
          if (urldecode($response['L_LONGMESSAGE0']) == 'This transaction has already been fully refunded') $response['L_SHORTMESSAGE0'] = urldecode($response['L_LONGMESSAGE0']);
          if (urldecode($response['L_LONGMESSAGE0']) == 'Can not do a full refund after a partial refund') $response['L_SHORTMESSAGE0'] = urldecode($response['L_LONGMESSAGE0']);
          if (urldecode($response['L_LONGMESSAGE0']) == 'The partial refund amount must be less than or equal to the remaining amount') $response['L_SHORTMESSAGE0'] = urldecode($response['L_LONGMESSAGE0']);
          if (urldecode($response['L_LONGMESSAGE0']) == 'You can not refund this type of transaction') $response['L_SHORTMESSAGE0'] = urldecode($response['L_LONGMESSAGE0']);
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;
      case 'DoAuthorization':
      case 'DoReauthorization':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_ERROR;
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;
      case 'DoCapture':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_ERROR;
          if ($response['RESULT'] == 111) $response['L_SHORTMESSAGE0'] = $response['RESULT'] . ' ' . $response['RESPMSG'];
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;
      case 'DoVoid':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_ERROR;
          if ($response['RESULT'] == 12) $response['L_SHORTMESSAGE0'] = $response['RESULT'] . ' ' . $response['RESPMSG'];
          if ($response['RESULT'] == 108) $response['L_SHORTMESSAGE0'] = $response['RESULT'] . ' ' . $response['RESPMSG'];
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;
      case 'GetTransactionDetails':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_GETDETAILS_ERROR;
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;
      case 'TransactionSearch':
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_TRANSSEARCH_ERROR;
          $errorText .= ' (' . urldecode($response['L_SHORTMESSAGE0']) . ') ' . $response['L_ERRORCODE0'];
          $messageStack->add_session($errorText, 'error');
          return true;
        }
        break;

      default:
        if ($basicError) {
          // if error, display error message. If debug options enabled, email dump to store owner
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - ' . $operation, "Value List:\r\n" . str_replace('&',"\r\n", $doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList))) . "\r\n\r\nResponse:\r\n" . print_r($response, true));
          }
          $errorText = MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_API_ERROR;
          $errorNum .= ' (' . urldecode($response['L_SHORTMESSAGE0'] . ' ' . $response['RESPMSG']) . ') ' . $response['L_ERRORCODE0'];
          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_API_ERROR || $errorText == MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_MESSAGE . urldecode($response['L_ERRORCODE0'] . "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $detailedMessage . "\n\n" . 'Transaction Response Details: ' . print_r($response, true) . "\n\n" . 'Transaction Submission: ' . urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList), true)));
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALWPP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($detailedEmailMessage)), 'paymentalert');
          $messageStack->add_session($errorText . $errorNum . $detailedMessage, 'error');
          return true;
        }
        break;
    }
  }

  function tableCheckup() {
    global $db, $sniffer;
    $fieldOkay1 = (method_exists($sniffer, 'field_type')) ? $sniffer->field_type(TABLE_PAYPAL, 'txn_id', 'varchar(20)', true) : -1;
    $fieldOkay2 = ($sniffer->field_exists(TABLE_PAYPAL, 'module_name')) ? true : -1;
    $fieldOkay3 = ($sniffer->field_exists(TABLE_PAYPAL, 'order_id')) ? true : -1;

    if ($fieldOkay1 == -1) {
      $sql = "show fields from " . TABLE_PAYPAL;
      $result = $db->Execute($sql);
      while (!$result->EOF) {
        if  ($result->fields['Field'] == 'txn_id') {
          if  ($result->fields['Type'] == 'varchar(20)') {
            $fieldOkay1 = true; // exists and matches required type, so skip to other checkup
          } else {
            $fieldOkay1 = $result->fields['Type']; // doesn't match, so return what it "is"
            break;
          }
        }
        $result->MoveNext();
      }
    }

    if ($fieldOkay1 !== true) {
      // temporary fix to table structure for v1.3.7.x -- may remove in later release
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE payment_type payment_type varchar(40) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE txn_type txn_type varchar(40) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE payment_status payment_status varchar(32) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE reason_code reason_code varchar(40) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE pending_reason pending_reason varchar(32) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE invoice invoice varchar(128) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE payer_business_name payer_business_name varchar(128) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE address_name address_name varchar(64) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE address_street address_street varchar(254) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE address_city address_city varchar(120) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE address_state address_state varchar(120) default NULL");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE payer_email payer_email varchar(128) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE business business varchar(128) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE receiver_email receiver_email varchar(128) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE txn_id txn_id varchar(20) NOT NULL default ''");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE parent_txn_id parent_txn_id varchar(20) default NULL");
    }
    if ($fieldOkay2 !== true) {
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " ADD COLUMN module_name varchar(40) NOT NULL default '' after txn_type");
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " ADD COLUMN module_mode varchar(40) NOT NULL default '' after module_name");
    }
    if ($fieldOkay3 !== true) {
      $db->Execute("ALTER TABLE " . TABLE_PAYPAL . " CHANGE zen_order_id order_id int(11) NOT NULL default '0'");
    }

  }

}

?>