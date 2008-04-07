<?php
/**
 * paypaldp.php payment module class for Paypal Website Payments Pro
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
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
class paypaldp extends base {
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
  var $enableDirectPayment = true;
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
  var $buttonSource = 'ZenCart-DP_us';
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
  function paypaldp() {
    include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'paypaldp.php', 'false'));
    global $order;
    $this->code = 'paypaldp';
    $this->codeTitle = MODULE_PAYMENT_PAYPALDP_TEXT_ADMIN_TITLE_WPP;
    $this->codeVersion = '1.3.8a';
    $this->enableDirectPayment = true;
    $this->enabled = (MODULE_PAYMENT_PAYPALDP_STATUS == 'True');
    // Set the title & description text based on the mode we're in
    if (IS_ADMIN_FLAG === true) {
      $this->description = sprintf(MODULE_PAYMENT_PAYPALDP_TEXT_ADMIN_DESCRIPTION, ' (v' . $this->codeVersion . ')');
      $this->title = MODULE_PAYMENT_PAYPALDP_TEXT_ADMIN_TITLE_WPP;
      if ($this->enabled) {
        if ( (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'PayPal' && (MODULE_PAYMENT_PAYPALWPP_APISIGNATURE == '' || MODULE_PAYMENT_PAYPALWPP_APIUSERNAME == '' || MODULE_PAYMENT_PAYPALWPP_APIPASSWORD == ''))
              || (!defined('MODULE_PAYMENT_PAYPALWPP_STATUS') || MODULE_PAYMENT_PAYPALWPP_STATUS != 'True')
          ) $this->title .= '<span class="alert"><strong> NOT CONFIGURED YET</strong></span>';
        if (MODULE_PAYMENT_PAYPALDP_SERVER =='sandbox') $this->title .= '<strong><span class="alert"> (sandbox active)</span></strong>';
        if (MODULE_PAYMENT_PAYPALDP_DEBUGGING =='Log File' || MODULE_PAYMENT_PAYPALDP_DEBUGGING =='Log and Email') $this->title .= '<strong> (Debug)</strong>';
        if (!function_exists('curl_init')) $this->title .= '<strong><span class="alert"> CURL NOT FOUND. Cannot Use.</span></strong>';
      }
    } else {
      $this->description = MODULE_PAYMENT_PAYPALDP_TEXT_DESCRIPTION;
      $this->title = MODULE_PAYMENT_PAYPALDP_TEXT_TITLE; //cc
    }

    if ((!defined('PAYPAL_OVERRIDE_CURL_WARNING') || (defined('PAYPAL_OVERRIDE_CURL_WARNING') && PAYPAL_OVERRIDE_CURL_WARNING != 'True')) && !function_exists('curl_init')) $this->enabled = false;

    $this->enableDebugging = true;//(MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALDP_DEBUGGING =='Log and Email');
    $this->emailAlerts = (MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Log File' || MODULE_PAYMENT_PAYPALDP_DEBUGGING =='Log and Email' || MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Alerts Only');
    $this->sort_order = MODULE_PAYMENT_PAYPALDP_SORT_ORDER;

    $this->buttonSource = 'ZenCart-DP_us';
    if (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK') {
      $this->buttonSource = 'ZenCart-DP_uk';
    }
    if (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-US') {
      $this->buttonSource = 'ZenCart-GW_us';
    }

    $this->order_pending_status = MODULE_PAYMENT_PAYPALDP_ORDER_PENDING_STATUS_ID;
    if ((int)MODULE_PAYMENT_PAYPALDP_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_PAYPALDP_ORDER_STATUS_ID;
    }
//    $this->new_acct_notify = MODULE_PAYMENT_PAYPALDP_NEW_ACCT_NOTIFY;
    $this->zone = (int)MODULE_PAYMENT_PAYPALDP_ZONE;
    if (is_object($order)) $this->update_status();

    if (PROJECT_VERSION_MAJOR != '1' && substr(PROJECT_VERSION_MINOR, 0, 3) != '3.8') $this->enabled = false;

    // offer credit card choices for pull-down menu -- only needed for UK version
    $this->cards = array();
    if (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK') {
      if (CC_ENABLED_VISA=='1')    $this->cards[] = array('id' => 'Visa', 'text' => 'Visa');
      if (CC_ENABLED_MC=='1')      $this->cards[] = array('id' => 'MasterCard', 'text' => 'MasterCard');
      if (CC_ENABLED_MAESTRO=='1') $this->cards[] = array('id' => 'Maestro', 'text' => 'Maestro');
      if (CC_ENABLED_SWITCH=='1')  $this->cards[] = array('id' => 'Switch', 'text' => 'Switch');
      if (CC_ENABLED_SOLO=='1')    $this->cards[] = array('id' => 'Solo', 'text' => 'Solo');
    }

    // debug setup
    if (!@is_writable($this->_logDir)) $this->_logDir = DIR_FS_CATALOG . $this->_logDir;
    if (!@is_writable($this->_logDir)) $this->_logDir = DIR_FS_SQL_CACHE;
    // Regular mode:
    if ($this->enableDebugging) $this->_logLevel = PEAR_LOG_INFO;
    // DEV MODE:
    if (defined('PAYPAL_DEV_MODE') && PAYPAL_DEV_MODE == 'true') $this->_logLevel = PEAR_LOG_DEBUG;

    $this->tableCheckup();

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
    return '  if (payment_value == "' . $this->code . '") {' . "\n" .
           '    var cc_firstname = document.checkout_payment.paypalwpp_cc_firstname.value;' . "\n" .
           '    var cc_lastname = document.checkout_payment.paypalwpp_cc_lastname.value;' . "\n" .
           '    var cc_number = document.checkout_payment.paypalwpp_cc_number.value;' . "\n" .
           '    var cc_checkcode = document.checkout_payment.paypalwpp_cc_checkcode.value;' . "\n" .
           '    if (cc_firstname == "" || cc_lastname == "" || eval(cc_firstname.length) + eval(cc_lastname.length) < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
           '      error_message = error_message + "' . MODULE_PAYMENT_PAYPALDP_TEXT_JS_CC_OWNER . '";' . "\n" .
           '      error = 1;' . "\n" .
           '    }' . "\n" .
           '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
           '      error_message = error_message + "' . MODULE_PAYMENT_PAYPALDP_TEXT_JS_CC_NUMBER . '";' . "\n" .
           '      error = 1;' . "\n" .
           '    }' . "\n" .
           '    if (document.checkout_payment.paypalwpp_cc_checkcode.disabled == false && (cc_checkcode == "" || cc_checkcode.length < 3 || cc_checkcode.length > 4)) {' . "\n".
           '      error_message = error_message + "' . MODULE_PAYMENT_PAYPALDP_TEXT_JS_CC_CVV . '";' . "\n" .
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
            'var value = document.checkout_payment.paypalwpp_cc_type.value;' .
            'if (value == "Switch" || value == "Solo") {' .
            '    document.checkout_payment.paypalwpp_cc_issue_month.disabled = false;' .
            '    document.checkout_payment.paypalwpp_cc_issue_year.disabled = false;' .
            '    document.checkout_payment.paypalwpp_cc_checkcode.disabled = true;' .
            '    if (document.checkout_payment.paypalwpp_cc_issuenumber) document.checkout_payment.paypalwpp_cc_issuenumber.disabled = true;' .
            '} else if (value == "Maestro") {' .
            '    document.checkout_payment.paypalwpp_cc_issuenumber.disabled = false;' .
            '    if (document.checkout_payment.paypalwpp_cc_issue_month) document.checkout_payment.paypalwpp_cc_issue_month.disabled = true;' .
            '    if (document.checkout_payment.paypalwpp_cc_issue_year) document.checkout_payment.paypalwpp_cc_issue_year.disabled = true;' .
            '    document.checkout_payment.paypalwpp_cc_checkcode.disabled = false;' .
            '} else {' .
            '    if (document.checkout_payment.paypalwpp_cc_issuenumber) document.checkout_payment.paypalwpp_cc_issuenumber.disabled = true;' .
            '    if (document.checkout_payment.paypalwpp_cc_issue_month) document.checkout_payment.paypalwpp_cc_issue_month.disabled = true;' .
            '    if (document.checkout_payment.paypalwpp_cc_issue_year) document.checkout_payment.paypalwpp_cc_issue_year.disabled = true;' .
            '    document.checkout_payment.paypalwpp_cc_checkcode.disabled = false;' .
            '}';
    if (sizeof($this->cards) == 0) $this->cc_type_check = '';

    /**
     * since we are processing via the gateway, prepare and display the CC fields
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
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_FIRSTNAME,
                           'field' => zen_draw_input_field('paypalwpp_cc_firstname', $order->billing['firstname'], 'id="'.$this->code.'-cc-ownerf"'. $onFocus) . 
                           '<script type="text/javascript">function paypalwpp_cc_type_check() { ' . $this->cc_type_check . ' } </script>',
                           'tag' => $this->code.'-cc-ownerf');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_LASTNAME,
                           'field' => zen_draw_input_field('paypalwpp_cc_lastname', $order->billing['lastname'], 'id="'.$this->code.'-cc-ownerl"'. $onFocus),
                           'tag' => $this->code.'-cc-ownerl');
    if (sizeof($this->cards)>0) $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_TYPE,
                            'field' => zen_draw_pull_down_menu('paypalwpp_cc_type', $this->cards, '', 'onchange="paypalwpp_cc_type_check();" onblur="paypalwpp_cc_type_check();"' . 'id="'.$this->code.'-cc-type"'. $onFocus),
                           'tag' => $this->code.'-cc-type');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_NUMBER,
                           'field' => zen_draw_input_field('paypalwpp_cc_number', $ccnum, 'id="'.$this->code.'-cc-number"' . $onFocus),
                           'tag' => $this->code.'-cc-number');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_EXPIRES,
                           'field' => zen_draw_pull_down_menu('paypalwpp_cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"' . $onFocus) . '&nbsp;' . zen_draw_pull_down_menu('paypalwpp_cc_expires_year', $expires_year, '', 'id="'.$this->code.'-cc-expires-year"' . $onFocus),
                           'tag' => $this->code.'-cc-expires-month');
    $fieldsArray[] = array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_CHECKNUMBER,
                           'field' => zen_draw_input_field('paypalwpp_cc_checkcode', '', 'size="4" maxlength="4"' . ' id="'.$this->code.'-cc-cvv"' . $onFocus) . '&nbsp;<small>' . MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION . '</small><script type="text/javascript">paypalwpp_cc_type_check();</script>',
                           'tag' => $this->code.'-cc-cvv');

    $selection = array('id' => $this->code,
                       'module' => MODULE_PAYMENT_PAYPALDP_TEXT_TITLE,
                       'fields' => $fieldsArray);

    if (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK' && (CC_ENABLED_SOLO=='1' || CC_ENABLED_SWITCH=='1')) {
      // add extra fields for Switch/Solo cards
      for ($i = $today['year'] - 10; $i <= $today['year']; $i++) {
        $issue_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }
      array_splice($selection['fields'], 4, 0,
                   array(array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_ISSUE,
                               'field' => zen_draw_pull_down_menu('paypalwpp_cc_issue_month', $expires_month, '', 'id="'.$this->code.'-cc-issue-month"' . $onFocus ) . '&nbsp;' . zen_draw_pull_down_menu('paypalwpp_cc_issue_year', $issue_year, '', 'id="'.$this->code.'-cc-issue-year"' . $onFocus),
                               'tag' => $this->code.'-cc-issue-month')));
    }
    if (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK' && CC_ENABLED_MAESTRO=='1') {
      // add extra field for Maestro cards
      array_splice($selection['fields'], 4, 0,
                   array(array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_MAESTRO_ISSUENUMBER,
                               'field' => zen_draw_input_field('paypalwpp_cc_issuenumber', $maestronum, '', 'id="'.$this->code.'-cc-issuenumber"' . $onFocus ),
                               'tag' => $this->code.'-cc-issuenumber')));
    }
    return $selection;
  }
  /**
   * This is the credit card check done between checkout_payment and
   * checkout_confirmation (called from checkout_confirmation).
   * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   */
  function pre_confirmation_check() {
    global $messageStack;
    include(DIR_WS_CLASSES . 'cc_validation.php');
    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($_POST['paypalwpp_cc_number'],
                                       $_POST['paypalwpp_cc_expires_month'], $_POST['paypalwpp_cc_expires_year'],
                                       (isset($_POST['paypalwpp_cc_issue_month']) ? $_POST['paypalwpp_cc_issue_month'] : ''), (isset($_POST['paypalwpp_cc_issue_year']) ? $_POST['paypalwpp_cc_issue_year'] : ''));
    $error = '';
    switch ($result) {
      case -1:
      $error = MODULE_PAYMENT_PAYPALDP_TEXT_BAD_CARD;//sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
      if ($_POST['paypalwpp_cc_number'] == '') $error = str_replace('\n', '', MODULE_PAYMENT_PAYPALDP_TEXT_JS_CC_NUMBER); // yes, those are supposed to be single-quotes.
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


    $_POST['paypalwpp_cc_checkcode'] = preg_replace('/[^0-9]/i', '', $_POST['paypalwpp_cc_checkcode']);
    if (isset($_POST['paypalwpp_cc_issuenumber'])) $_POST['paypalwpp_cc_issuenumber'] = preg_replace('/[^0-9]/i', '', $_POST['paypalwpp_cc_issuenumber']);

    if (($result === false) || ($result < 1) ) {
      $messageStack->add_session('checkout_payment', $error . '<!-- ['.$this->code.'] -->' . '<!-- result: ' . $result . ' -->', 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $error, 'SSL', true, false));
    }

    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
    $this->cc_expiry_month = $cc_validation->cc_expiry_month;
    $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    $this->cc_checkcode = $_POST['paypalwpp_cc_checkcode'];
  }
  /**
   * Display Credit Card Information for review on the Checkout Confirmation Page
   */
  function confirmation() {
    $confirmation = array('title' => '',
                          'fields' => array(array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_FIRSTNAME,
                                                  'field' => $_POST['paypalwpp_cc_firstname']),
                                            array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_LASTNAME,
                                                  'field' => $_POST['paypalwpp_cc_lastname']),
                                            array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_TYPE,
                                                  'field' => $this->cc_card_type),
                                            array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_NUMBER,
                                                  'field' => substr($_POST['paypalwpp_cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['paypalwpp_cc_number']) - 8)) . substr($_POST['paypalwpp_cc_number'], -4)),
                                            array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_EXPIRES,
                                                  'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['paypalwpp_cc_expires_month'], 1, '20' . $_POST['paypalwpp_cc_expires_year'])),
                                            (isset($_POST['paypalwpp_cc_issuenumber']) ? array('title' => MODULE_PAYMENT_PAYPALDP_TEXT_CREDIT_CARD_TYPE,
                                                  'field' => $this->cc_card_type) : '')
                                            )));
    return $confirmation;
  }
  /**
   * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
   */
  function process_button() {
    $_SESSION['paypal_ec_markflow'] = 1;
    $process_button_string = "\n" . zen_draw_hidden_field('wpp_cc_type', $_POST['paypalwpp_cc_type']) . "\n" .
        zen_draw_hidden_field('wpp_cc_expdate_month', $_POST['paypalwpp_cc_expires_month']) . "\n" .
        zen_draw_hidden_field('wpp_cc_expdate_year', $_POST['paypalwpp_cc_expires_year']) . "\n" .
        zen_draw_hidden_field('wpp_cc_issuedate_month', $_POST['paypalwpp_cc_issue_month']) . "\n" .
        zen_draw_hidden_field('wpp_cc_issuedate_year', $_POST['paypalwpp_cc_issue_year']) . "\n" .
        zen_draw_hidden_field('wpp_cc_issuenumber', $_POST['paypalwpp_cc_issuenumber']) . "\n" .
        zen_draw_hidden_field('wpp_cc_number', $_POST['paypalwpp_cc_number']) . "\n" .
        zen_draw_hidden_field('wpp_cc_checkcode', $_POST['paypalwpp_cc_checkcode']) . "\n" .
        zen_draw_hidden_field('wpp_payer_firstname', $_POST['paypalwpp_cc_firstname']) . "\n" .
        zen_draw_hidden_field('wpp_payer_lastname', $_POST['paypalwpp_cc_lastname']) . "\n";
    return $process_button_string;
  }
  /**
   * Prepare and submit the final authorization to PayPal via the appropriate means as configured
   */
  function before_process() {
    global $order, $doPayPal, $messageStack;
    $options = array();
    $optionsShip = array();
    $optionsNVP = array();

    $options = $this->getLineItemDetails();

    //$this->zcLog('before_process - 1', 'Have line-item details:' . "\n" . print_r($options, true));

    $doPayPal = $this->paypal_init();
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
      $response = $cc_validation->validate($_POST['wpp_cc_number'], $_POST['wpp_cc_expdate_month'], $_POST['wpp_cc_expdate_year'], 
                                           $_POST['wpp_cc_issuedate_month'], $_POST['wpp_cc_issuedate_year']);
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

      if (($response === false) || ($response < 1) ) {
        $this->zcLog('before_process - DP-2', 'CC validation results: ' . $error . '(' . $response . ')');
        $messageStack->add_session('checkout_payment', $error . '<!-- ['.$this->code.'] -->' . '<!-- result: ' . $response . ' -->', 'error');
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $error, 'SSL', true, false));
        $this->zcLog('before_process - DP-3', 'CC info: ' . $cc_validation->cc_type . ' ' . substr($cc_validation->cc_number, 0, 4) . str_repeat('X', (strlen($cc_validation->cc_number) - 8)) . substr($cc_validation->cc_number, -4) . ' ' . $error);
      }
      if (!in_array($cc_validation->cc_type, array('Visa', 'MasterCard', 'Switch', 'Solo', 'Discover', 'American Express', 'Maestro'))) { 
        $messageStack->add_session('checkout_payment', MODULE_PAYMENT_PAYPALDP_TEXT_BAD_CARD . '<!-- [' . $this->code . ' ' . $cc_validation->cc_type . '] -->', 'error');
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, MODULE_PAYMENT_PAYPALDP_TEXT_BAD_CARD, 'SSL', true, false));
      }

      // if CC validation passed, continue using the validated data
      $cc_type = $cc_validation->cc_type;
      $cc_number = $cc_validation->cc_number;
      $cc_first_name = $_POST['wpp_payer_firstname'];
      $cc_last_name = $_POST['wpp_payer_lastname'];
      $cc_checkcode = $_POST['wpp_cc_checkcode'];
      $cc_expdate_month = $cc_validation->cc_expiry_month;
      $cc_expdate_year = $cc_validation->cc_expiry_year;
      $cc_issuedate_month = $_POST['wpp_cc_issuedate_month'];
      $cc_issuedate_year = $_POST['wpp_cc_issuedate_year'];
      $cc_issuenumber = $_POST['wpp_cc_issuenumber'];
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
                          'ZIP'         => $order->billing['postcode'],
                          'CITY'        => $order->billing['city'],
                          'STATE'       => $order->billing['state'],
                          'STREET2'     => $order->billing['suburb'],
                          'COUNTRYCODE' => $order->billing['country']['iso_code_2'],
                          'EXPDATE'     => $cc_expdate_month . $cc_expdate_year,
                          'EMAIL'       => $order->customer['email_address'],
                          'PHONENUM'    => $order->customer['telephone']));

      $optionsShip = array();
      if (isset($order->delivery) && $order->delivery['street_address'] != '') {
        $optionsShip= array('SHIPTONAME'   => ($order->delivery['name'] == '' ? $order->delivery['firstname'] . ' ' . $order->delivery['lastname'] : $order->delivery['name']),
                            'SHIPTOSTREET' => $order->delivery['street_address'],
                            'SHIPTOSTREET2' => $order->delivery['suburb'],
                            'SHIPTOCITY'   => $order->delivery['city'],
                            'SHIPTOZIP'    => $order->delivery['postcode'],
                            'SHIPTOSTATE'  => $order->delivery['state'],
                            'SHIPTOCOUNTRYCODE'=> $order->delivery['country']['iso_code_2']);
      }

      // if State is not supplied, repeat the city so that it's not blank, otherwise PayPal croaks
      if (!isset($optionsShip['SHIPTOSTATE']) || trim($optionsShip['SHIPTOSTATE']) == '') $optionsShip['SHIPTOSTATE'] = $optionsShip['SHIPTOCITY'];
      if ($optionsAll['STREET2'] == '') unset($optionsAll['STREET2']);
      if ($optionsShip['SHIPTOSTREET2'] == '') unset($optionsShip['SHIPTOSTREET2']);

      // Payment Transaction/Authorization Mode
      $optionsNVP['PAYMENTACTION'] = (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Sale';
      if (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') $this->order_status = MODULE_PAYMENT_PAYPALDP_ORDER_PENDING_STATUS_ID;

//      if (in_array($cc_type, array('Switch', 'Solo'))) {
//        $optionsNVP['PAYMENTACTION'] = 'Authorization';
//      }
      $optionsAll['BUTTONSOURCE'] = $this->buttonSource;
      $optionsAll['CURRENCY']     = $my_currency;
      $optionsAll['IPADDRESS']    = $cc_owner_ip;
      if ($cc_issuedate_month && $cc_issuedate_year) {
        $optionsAll['CARDSTART'] = $cc_issuedate_month . substr($cc_issuedate_year, -2);
      }
      if (isset($_POST['wpp_cc_issuenumber'])) $optionsAll['CARDISSUE'] = $_POST['wpp_cc_issuenumber'];

      // unused at present:
      // $options['CUSTOM'] = '';
      // $options['INVNUM'] = '';
      // $options['DESC'] = '';

      if (substr(MODULE_PAYMENT_PAYPALDP_MODULE_MODE,0,7) == 'Payflow') {
        if (isset($optionsAll['COUNTRYCODE'])) {
          $optionsAll['COUNTRY'] = $optionsAll['COUNTRYCODE'];
          unset($optionsAll['COUNTRYCODE']);
        }
        if (isset($optionsShip['SHIPTOCOUNTRYCODE'])) {
          $optionsShip['SHIPTOCOUNTRY'] = $optionsShip['SHIPTOCOUNTRYCODE'];
          unset($optionsShip['SHIPTOCOUNTRYCODE']);
        }
        if (isset($optionsShip['SHIPTOSTREET2'])) unset($optionsShip['SHIPTOSTREET2']);
        if (isset($optionsAll['STREET2'])) unset($optionsAll['STREET2']);
      }
      $this->zcLog('before_process - DP-4', 'optionsAll: ' . print_r($optionsAll, true) . "\n" . 'optionsNVP: ' . print_r($optionsNVP, true) . "\n" . 'optionsShip' . print_r($optionsShip, true) . "\n" . 'Rest of data: ' . "\n" . number_format($order_amount, 2) . ' ' . $cc_expdate_month . ' ' . substr($cc_expdate_year, -2) . ' ' . $cc_first_name . ' ' . $cc_last_name . ' ' . $cc_type);

      $response = $doPayPal->DoDirectPayment(number_format($order_amount, 2),
                                           $cc_number,
                                           $cc_checkcode,
                                           $cc_expdate_month . substr($cc_expdate_year, -2),
                                           $cc_first_name, $cc_last_name,
                                           $cc_type,
                                           $optionsAll, array_merge($optionsNVP, $optionsShip));

      $this->zcLog('before_process - DP-5', 'resultset:' . "\n" . urldecode(print_r($response, true)));

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
        $this->payment_type = MODULE_PAYMENT_PAYPALDP_PF_TEXT_TYPE;
        $this->transaction_id = $response['PNREF'];
        $this->payment_status = (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Completed';
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
        $this->payment_type = MODULE_PAYMENT_PAYPALDP_DP_TEXT_TYPE;
        $this->payment_status = (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') ? 'Authorization' : 'Completed';
        $this->pendingreason = (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') ? 'authorization' : '';
        $this->avs = $response['AVSCODE'];
        $this->cvv2 = $response['CVV2MATCH'];
        $this->correlationid = $response['CORRELATIONID'];
        $this->payment_time = urldecode($response['TIMESTAMP']);
        $this->amt = urldecode($response['AMT'] . ' ' . $response['CURRENCYCODE']);
        $this->auth_code = (isset($this->response['AUTHCODE'])) ? $this->response['AUTHCODE'] : $this->response['TOKEN'];
        $this->transactiontype = 'cart';
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
                     (isset($this->responsedata['auth_exp']) ? "\nAuth-Exp: " . $this->responsedata['auth_exp'] : "") . 
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
                          'module_mode' => MODULE_PAYMENT_PAYPALDP_MODULE_MODE,
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
                          'receiver_email' => (substr(MODULE_PAYMENT_PAYPALDP_MODULE_MODE,0,7) == 'Payflow' ? MODULE_PAYMENT_PAYPALDP_PFVENDOR : str_replace('_api1', '', MODULE_PAYMENT_PAYPALDP_APIUSERNAME)),
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
    include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'paypaldp.php', 'false'));
    $error = array('title' => MODULE_PAYMENT_PAYPALDP_ERROR_HEADING,
                   'error' => ((isset($_GET['error'])) ? stripslashes(urldecode($_GET['error'])) : MODULE_PAYMENT_PAYPALDP_TEXT_CARD_ERROR));
    return $error;
  }
  /**
   * Evaluate installation status of this module. Returns true if the status key is found.
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPALDP_STATUS'");
      $this->_check = !$check_query->EOF;
    }
    return $this->_check;
  }
  /**
   * Installs all the configuration keys for this module
   */
  function install() {
    global $db, $messageStack;
    // cannot install DP if EC not already enabled:
    if (!defined('MODULE_PAYMENT_PAYPALWPP_STATUS') || MODULE_PAYMENT_PAYPALWPP_STATUS != 'True') {
      $messageStack->add_session('<strong>Sorry, you must install and configure PayPal Express Checkout first.</strong> Website Payments Pro requires that you offer Express Checkout to your customers.<br /><a href="' . zen_href_link('modules.php?set=payment&module=paypalwpp', '', 'NONSSL') . '">Click here to set up Express Checkout.</a>' , 'error');
      zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=paypaldp', 'NONSSL'));
      return 'failed';
    }
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_PAYPALDP_STATUS', 'True', 'Do you want to enable this payment module?', '6', '25', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Live or Sandbox', 'MODULE_PAYMENT_PAYPALDP_SERVER', 'live', '<strong>Live: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', '6', '25', 'zen_cfg_select_option(array(\'live\', \'sandbox\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPALDP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPALDP_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '25', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPALDP_ORDER_STATUS_ID', '2', 'Set the status of orders paid with this payment module to this value. <br /><strong>Recommended: Processing[2]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Unpaid Order Status', 'MODULE_PAYMENT_PAYPALDP_ORDER_PENDING_STATUS_ID', '1', 'Set the status of unpaid orders made with this payment module to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
//    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_PAYPALDP_REFUNDED_STATUS_ID', '1', 'Set the status of refunded orders to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '25', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment Action', 'MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE', 'Final Sale', 'How do you want to obtain payment?<br /><strong>Default: Final Sale</strong>', '6', '25', 'zen_cfg_select_option(array(\'Auth Only\', \'Final Sale\'), ',  now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Currency', 'MODULE_PAYMENT_PAYPALDP_CURRENCY', 'Selected Currency', 'Which currency should the order be sent to PayPal as? <br />NOTE: if an unsupported currency is sent to PayPal, it will be auto-converted to USD (or GBP if using UK account)<br /><strong>Default: Selected Currency</strong>', '6', '25', 'zen_cfg_select_option(array(\'Selected Currency\', \'Only USD\', \'Only AUD\', \'Only CAD\', \'Only EUR\', \'Only GBP\', \'Only CHF\', \'Only CZK\', \'Only DKK\', \'Only HKD\', \'Only HUF\', \'Only JPY\', \'Only NOK\', \'Only NZD\', \'Only PLN\', \'Only SEK\', \'Only SGD\', \'Only THB\'), ',  now())");


    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: User', 'MODULE_PAYMENT_PAYPALDP_PFUSER', '', 'If you set up one or more additional users on the account, this value is the ID of the user authorized to process transactions. Otherwise it should be the same value as VENDOR. This value is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: Partner', 'MODULE_PAYMENT_PAYPALDP_PFPARTNER', 'ZenCart', 'Your Payflow Partner linked to your Payflow account. This value is case-sensitive.<br />Typical values: <strong>PayPal</strong> or <strong>ZenCart</strong>', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYFLOW: Vendor', 'MODULE_PAYMENT_PAYPALDP_PFVENDOR', '', 'Your merchant login ID that you created when you registered for the Payflow Pro account. This value is case-sensitive.', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) values ('PAYFLOW: Password', 'MODULE_PAYMENT_PAYPALDP_PFPASSWORD', '', 'The 6- to 32-character password that you defined while registering for the account. This value is case-sensitive.', '6', '25', now(), 'zen_cfg_password_input(', 'zen_cfg_password_display')");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal Mode', 'MODULE_PAYMENT_PAYPALDP_MODULE_MODE', 'PayPal', 'Which PayPal API system should be used for processing? <br /><u>Choices:</u><br /><font color=green>For choice #1, you need to supply <strong>API Settings</strong> in the Express Checkout module.</font><br /><strong>1. PayPal</strong> = Website Payments Pro with a US PayPal account<br />or<br /><font color=green>for choices 2 &amp; 3 you need to supply <strong>PAYFLOW settings</strong>,  (and have a Payflow account)</font><br /><strong>2. Payflow-UK</strong> = Website Payments Pro UK Payflow Edition<br /><strong>3. Payflow-US</strong> = Payflow Pro Gateway only<!--<br /><strong>4. PayflowUS+EC</strong> = Payflow Pro with Express Checkout-->', '6', '25',  'zen_cfg_select_option(array(\'PayPal\', \'Payflow-UK\', \'Payflow-US\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_PAYPALDP_DEBUGGING', 'Off', 'Would you like to enable debug mode?  A complete detailed log of failed transactions will be emailed to the store owner.', '6', '25', 'zen_cfg_select_option(array(\'Off\', \'Alerts Only\', \'Log File\', \'Log and Email\'), ', now())");

    $this->notify('NOTIFY_PAYMENT_PAYPALDP_INSTALLED');
  }

  function keys() {
    $keys_list = array('MODULE_PAYMENT_PAYPALDP_STATUS', 'MODULE_PAYMENT_PAYPALDP_SORT_ORDER', 'MODULE_PAYMENT_PAYPALDP_ZONE', 'MODULE_PAYMENT_PAYPALDP_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPALDP_ORDER_PENDING_STATUS_ID', /*'MODULE_PAYMENT_PAYPALDP_REFUNDED_STATUS_ID', */'MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE', 'MODULE_PAYMENT_PAYPALDP_CURRENCY', 'MODULE_PAYMENT_PAYPALDP_MODULE_MODE', 'MODULE_PAYMENT_PAYPALDP_SERVER', 'MODULE_PAYMENT_PAYPALDP_DEBUGGING');
    if (IS_ADMIN_FLAG === true && ((isset($_GET['debug']) && $_GET['debug']=='on') || PAYPAL_DEV_MODE == 'true') || strstr(MODULE_PAYMENT_PAYPALDP_MODULE_MODE, 'Payflow')) {
    //  $keys_list[]='MODULE_PAYMENT_PAYPALDP_MODULE_MODE';
    }
    return $keys_list;
  }
  /**
   * De-install this module
   */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE 'MODULE\_PAYMENT\_PAYPALDP\_%'");
    $this->notify('NOTIFY_PAYMENT_PAYPALDP_UNINSTALLED');
  }
  /**
   * Check settings and conditions to determine whether we are in an Express Checkout phase or not
   */
  function in_special_checkout() {
    if ((defined('MODULE_PAYMENT_PAYPALDP_STATUS') && MODULE_PAYMENT_PAYPALDP_STATUS == 'True') &&
             !empty($_SESSION['paypal_ec_token']) &&
             !empty($_SESSION['paypal_ec_payer_id']) &&
             !empty($_SESSION['paypal_ec_payer_info'])) {
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
    if (MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Log File') {
      $token = (isset($_SESSION['paypal_ec_token'])) ? $_SESSION['paypal_ec_token'] : preg_replace('/[^0-9.A-Z\-]/', '', $_GET['token']);
      $token = ($token == '') ? date('m-d-Y-h-i') : $token; // or time()
      $token .= $tokenHash;
      $file = $this->_logDir . '/' . $this->code . '_Paypal_Action_' . $token . '.log';
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
    if (MODULE_PAYMENT_PAYPALDP_DEBUGGING == 'Log and Email') {
      $data =  urldecode($data) . "\n\n";
      if ($useSession) $data .= "\nSession data: " . print_r($_SESSION, true);
      zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $subject, $this->code . "\n" . $data, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($this->code . "\n" . $data)), 'debug');
    }
  }
  /**
   * Initialize the PayPal/PayflowPro object for communication to the processing gateways
   */
  function paypal_init() {
    $ec_uses_gateway = (defined('MODULE_PAYMENT_PAYPALDP_PRO20_EC_METHOD') && MODULE_PAYMENT_PAYPALDP_PRO20_EC_METHOD == 'Payflow') ? true : false;
    $nvp = (!($ec_uses_gateway) && MODULE_PAYMENT_PAYPALWPP_APIPASSWORD != '' && MODULE_PAYMENT_PAYPALWPP_APISIGNATURE != '') ? true : false;
    $ec = ($nvp && ($this->in_special_checkout() || $_GET['type'] == 'ec')) ? true : false;
    if (substr(MODULE_PAYMENT_PAYPALDP_MODULE_MODE,0,7) == 'Payflow' && !$ec) {
      $doPayPal = new paypal_curl(array('mode' => 'payflow',
                                        'user' =>   trim(MODULE_PAYMENT_PAYPALWPP_PFUSER),
                                        'vendor' => trim(MODULE_PAYMENT_PAYPALWPP_PFVENDOR),
                                        'partner'=> trim(MODULE_PAYMENT_PAYPALWPP_PFPARTNER),
                                        'pwd' =>    trim(MODULE_PAYMENT_PAYPALWPP_PFPASSWORD),
                                        'server' => MODULE_PAYMENT_PAYPALDP_SERVER));
      $doPayPal->_endpoints = array('live'    => 'https://payflowpro.verisign.com/transaction',
                                    'sandbox' => 'https://pilot-payflowpro.verisign.com/transaction');
    } else {
      $doPayPal = new paypal_curl(array('mode' => 'nvp',
                                        'user' => trim(MODULE_PAYMENT_PAYPALWPP_APIUSERNAME),
                                        'pwd' =>  trim(MODULE_PAYMENT_PAYPALWPP_APIPASSWORD),
                                        'signature' => trim(MODULE_PAYMENT_PAYPALWPP_APISIGNATURE),
                                        'version' => '2.3',
                                        'server' => MODULE_PAYMENT_PAYPALDP_SERVER));
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
    $doPayPal->_trxtype = (MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE == 'Auth Only') ? 'A' : 'S';
//    $this->zcLog('comm details', 'Comm Details: ' . "\n" . print_r($doPayPal, true) . "\n\n" . 'MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE = ' . MODULE_PAYMENT_PAYPALDP_TRANSACTION_MODE  . "\ndoPayPal->_trxtype = " . $doPayPal->_trxtype . "\n");

    return $doPayPal;
  }
  /**
   * Determine which PayPal URL to direct the customer's browser to when needed
   */
  function getPayPalLoginServer() {
    if (MODULE_PAYMENT_PAYPALDP_SERVER == 'live') {
      // live url
      $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
    } else {
      // sandbox url
      $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
       // for UK sandbox -- NOTE: this system is intermittently flakey ... and if it's down, odd redirects occur.
      if (substr(MODULE_PAYMENT_PAYPALDP_MODULE_MODE,0,7) == 'Payflow') {
//        $paypal_url = 'https://test-expresscheckout.paypal.com/cgi-bin/webscr';
      }
    }
    return $paypal_url;
  }
  /**
   * Used to submit a refund for a given transaction.  FOR FUTURE USE.
   */
  function _doRefund($oID, $amount = 'Full', $note = '') {
    global $db, $doPayPal, $messageStack;
    $new_order_status = MODULE_PAYMENT_PAYPALDP_REFUNDED_STATUS_ID;
    $orig_order_amount = 0;
    $doPayPal = $this->paypal_init();
    $proceedToRefund = false;
    $refundNote = strip_tags(zen_db_input($_POST['refnote']));
    if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL) {
      $refundAmt = 'Full';
      if (isset($_POST['reffullconfirm']) && $_POST['reffullconfirm'] == 'on') {
        $proceedToRefund = true;
      } else {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALDP_TEXT_REFUND_FULL_CONFIRM_ERROR, 'error');
      }
    }
    if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
      $refundAmt = (float)$_POST['refamt'];
      $new_order_status = MODULE_PAYMENT_PAYPALDP_REFUNDED_STATUS_ID;
      $proceedToRefund = true;
      if ($refundAmt == 0) {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALDP_TEXT_INVALID_REFUND_AMOUNT, 'error');
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
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALDP_TEXT_REFUND_INITIATED, urldecode($response['GROSSREFUNDAMT']), urldecode($response['REFUNDTRANSACTIONID']). $response['PNREF']), 'success');
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
    $new_order_status = MODULE_PAYMENT_PAYPALDP_ORDER_STATUS_ID;


    $orig_order_amount = 0;
    $doPayPal = $this->paypal_init();
    $proceedToCapture = false;
    $captureNote = strip_tags(zen_db_input($_POST['captnote']));
    if (isset($_POST['captfullconfirm']) && $_POST['captfullconfirm'] == 'on') {
      $proceedToCapture = true;
    } else {
      $messageStack->add_session(MODULE_PAYMENT_PAYPALDP_TEXT_CAPTURE_FULL_CONFIRM_ERROR, 'error');
    }
    if (isset($_POST['captfinal']) && $_POST['captfinal'] == 'on') {
      $captureType = 'Complete';
    } else {
      $captureType = 'NotComplete';
    }
    if (isset($_POST['btndocapture']) && $_POST['btndocapture'] == MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL) {
      $captureAmt = (float)$_POST['captamt'];
      if ($captureAmt == 0) {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALDP_TEXT_INVALID_CAPTURE_AMOUNT, 'error');
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
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALDP_TEXT_CAPT_INITIATED, urldecode($response['AMT']), urldecode($response['RECEIPTID'] . $response['AUTHCODE']). $response['PNREF']), 'success');
        return true;
      }
    }
  }
  /**
   * Used to void a given previously-authorized transaction.  FOR FUTURE USE.
   */
  function _doVoid($oID, $note = '') {
    global $db, $doPayPal, $messageStack;
    $new_order_status = MODULE_PAYMENT_PAYPALDP_REFUNDED_STATUS_ID;
    $doPayPal = $this->paypal_init();
    $voidNote = strip_tags(zen_db_input($_POST['voidnote']));
    $voidAuthID = trim(strip_tags(zen_db_input($_POST['voidauthid'])));
    if (isset($_POST['ordervoid']) && $_POST['ordervoid'] == MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL) {
      if (isset($_POST['voidconfirm']) && $_POST['voidconfirm'] == 'on') {
        $proceedToVoid = true;
      } else {
        $messageStack->add_session(MODULE_PAYMENT_PAYPALDP_TEXT_VOID_CONFIRM_ERROR, 'error');
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
        $messageStack->add_session(sprintf(MODULE_PAYMENT_PAYPALDP_TEXT_VOID_INITIATED, urldecode($response['AUTHORIZATIONID']) . $response['PNREF']), 'success');
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
    $paypalSupportedCurrencies = (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK') ? $dp_currencies : $paypalSupportedCurrencies;

    $my_currency = substr(MODULE_PAYMENT_PAYPALDP_CURRENCY, 5);
    if (MODULE_PAYMENT_PAYPALDP_CURRENCY == 'Selected Currency') {
      $my_currency = ($val == '') ? $_SESSION['currency'] : $val;
    }

    if (!in_array($my_currency, $paypalSupportedCurrencies)) {
      $my_currency = (MODULE_PAYMENT_PAYPALDP_MODULE_MODE == 'Payflow-UK') ? 'GBP' : 'USD';
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
    global $db, $messageStack;
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
          $messageStack->add_session('header', MODULE_PAYMENT_PAYPALDP_TEXT_STATE_ERROR, 'error');
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
      if ($$order_totals[$i]['code']->credit_class == true) $creditsApplied += round($order_totals[$i]['value'],2);
      // treat all other OT's as if they're related to handling fees
      if (!in_array($order_totals[$i]['code'], array('ot_total','ot_subtotal','ot_tax','ot_total')) 
          && !($$order_totals[$i]['code']->credit_class)) {
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
    $optionsST['HANDLINGAMT'] = abs($optionsST['HANDLINGAMT']);

    // subtotals have to add up to AMT
    // Thus, if there is a discrepancy, make adjustment to HANDLINGAMT:
    $st = $optionsST['ITEMAMT'] + $optionsST['TAXAMT'] + $optionsST['SHIPPINGAMT'] + $optionsST['HANDLINGAMT'];
    if ($st != $optionsST['AMT']) $optionsST['HANDLINGAMT'] += ($optionsST['AMT'] - $st);


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
    if (abs($optionsST['HANDLINGAMT']) == 0) unset($optionsST['HANDLINGAMT']);

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

    if ($optionsST['ITEMAMT'] != $sumOfLineItems) {
      $optionsLI = array();
      $this->zcLog('getLineItemDetails 1', 'Order Subtotal does not match sum of line-item prices. Line-item-details skipped.' . "\n" . $optionsST['ITEMAMT'] . ' ' . $sumOfLineItems);
      //die('ITEMAMT != $sumOfLineItems ' . $optionsST['ITEMAMT'] . ' ' . $sumOfLineItems);
    }
    if ($optionsST['TAXAMT']  != $sumOfLineTax) {
      $optionsLI = array();
      $this->zcLog('getLineItemDetails 2', 'Tax Subtotal does not match sum of taxes for line-items. Line-item-details skipped.' . "\n" . $optionsST['TAXAMT'] . ' ' . $sumOfLineTax);
      //die('TAXAMT != $sumofLineTax ' . $optionsST['TAXAMT'] . ' ' . $sumOfLineTax);
    }

    // ensure all numbers are non-negative
    if (is_array($optionsST)) foreach ($optionsST as $key=>$value) {
      $optionsST[$key] = abs($value);
    }
    if (is_array($optionsLI)) foreach ($optionsLI as $key=>$value) {
      if (strstr($key, 'AMT')) $optionsLI[$key] = abs($value);
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
    if ($creditsApplied > 0) return array();
    //$this->zcLog('getLineItemDetails 6', 'no credits - okay');

    // if subtotals are not adding up correctly, then skip sending any line-item or subtotal details to PayPal
    $st = round($optionsST['ITEMAMT'] + $optionsST['TAXAMT'] + $optionsST['SHIPPINGAMT'] + $optionsST['HANDLINGAMT'],2);
    $stDiff = ($optionsST['AMT'] - $st);
    $stDiffRounded = (abs($st) - abs(round($optionsST['AMT'],2)));

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

    // Send Subtotal and LineItem results back to be submitted to PayPal
    return array_merge($optionsST, $optionsLI);
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
  }
  /**
   * If the EC flow has to be interrupted for any reason, this does the appropriate cleanup and displays status/error messages.
   */
  function terminateEC($error_msg = '', $kill_sess_vars = false, $goto_page = '') {
    global $messageStack, $order, $order_total_modules;
    $error_msg = trim($error_msg);
    if (substr($error_msg, -1) == '-') $error_msg = trim(substr($error_msg, 0, strlen($error_msg) - 1));
    $stackAlert = 'checkout_payment';

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

    $this->zcLog('termEC-2', 'BEFORE: Token Data:' . $_SESSION['paypal_ec_token']);

    if ($error_msg) {
      $messageStack->add_session($stackAlert, $error_msg, 'error');
    }
    // debug
    $this->zcLog('termEC-10', 'Redirecting to ' . $goto_page . ' - Stack: ' . $stackAlert . "\n" . 'Message: ' . $error_msg . "\nSession Data: " . print_r($_SESSION, true));
    zen_redirect(zen_href_link($goto_page, '', 'SSL', true, false));
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
      case 'DoDirectPayment':
        if ($basicError || 
           (isset($_SESSION['paypal_ec_token']) && $_SESSION['paypal_ec_token'] != urldecode($response['TOKEN'])) ) {
            // Error, so send the store owner a complete dump of the transaction.
          if ($this->enableDebugging) {
            $this->_doDebug('PayPal Error Log - before_process() - DP', "In function: before_process() - Direct Payment \r\nDid first contact attempt return error? " . ($error_occurred ? "Yes" : "No") . " \r\n\r\nValue List:\r\n" . str_replace('&',"\r\n", urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList)))) . "\r\n\r\nResponse:\r\n" . urldecode(print_r($response, true)));
          }
          $errorText = MODULE_PAYMENT_PAYPALDP_INVALID_RESPONSE;
          $errorNum = urldecode($response['L_ERRORCODE0'] . $response['RESULT'] . ' <!-- ' . $response['RESPMSG'] . ' -->');
          if ($response['RESULT'] == 25) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_NOT_WPP_ACCOUNT_ERROR;
          if ($response['L_ERRORCODE0'] == 10500 || $response['L_ERRORCODE0'] == 10501) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_NOT_US_WPP_ACCOUNT_ERROR;
          if ($response['HOSTCODE'] == 10500 || $response['HOSTCODE'] == 10501) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_NOT_UKWPP_ACCOUNT_ERROR;
          if ($response['L_ERRORCODE0'] == 10002) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_SANDBOX_VS_LIVE_ERROR;
          if ($response['L_ERRORCODE0'] == 10565) {
            $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_WPP_BAD_COUNTRY_ERROR;
            $_SESSION['payment'] = '';
          }
          if ($response['L_ERRORCODE0'] == 10736) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_ADDR_ERROR;
          if ($response['L_ERRORCODE0'] == 10752) {
            $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_DECLINED;
            $errorNum = '10752';
          }
          if ($response['RESPMSG'] != '') $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_DECLINED . ' ' . $errorText;

          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALDP_INVALID_RESPONSE || $errorText == MODULE_PAYMENT_PAYPALDP_TEXT_DECLINED || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? (isset($response['RESULT']) && $response['RESULT'] != 0 ? MODULE_PAYMENT_PAYPALDP_CANNOT_BE_COMPLETED . ' (' . $errorNum . ')' : $errorNum) . ' ' . urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALDP_TEXT_EMAIL_ERROR_MESSAGE . urldecode($response['L_ERRORCODE0']  . ' ' . $response['RESPMSG']. "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $detailedMessage . "\n\n" . 'Transaction Response Details: ' . print_r($response, true) . "\n\n" . 'Transaction Submission: ' . urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList), true)));
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALDP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($detailedEmailMessage)), 'paymentalert');
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_REFUND_ERROR;
          if ($response['L_ERRORCODE0'] == 10009) $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_REFUNDFULL_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_AUTH_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_CAPT_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_VOID_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_GETDETAILS_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_TRANSSEARCH_ERROR;
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
          $errorText = MODULE_PAYMENT_PAYPALDP_TEXT_GEN_API_ERROR;
          $errorNum .= ' (' . urldecode($response['L_SHORTMESSAGE0'] . ' <!-- ' . $response['RESPMSG']) . ' -->) ' . $response['L_ERRORCODE0'];
          $detailedMessage = ($errorText == MODULE_PAYMENT_PAYPALDP_TEXT_GEN_API_ERROR || $errorText == MODULE_PAYMENT_PAYPALDP_TEXT_DECLINED || $this->enableDebugging || $response['CURL_ERRORS'] != '' || $this->emailAlerts) ? urldecode(' ' . $response['L_SHORTMESSAGE0'] . ' - ' . $response['L_LONGMESSAGE0'] . ' ' . $response['CURL_ERRORS']) : '';
          $detailedEmailMessage = ($detailedMessage == '') ? '' : MODULE_PAYMENT_PAYPALDP_TEXT_EMAIL_ERROR_MESSAGE . ' ' . $response['RESPMSG'] . urldecode($response['L_ERRORCODE0'] . "\n" . $response['L_SHORTMESSAGE0'] . "\n" . $response['L_LONGMESSAGE0'] . $response['L_ERRORCODE1'] . "\n" . $response['L_SHORTMESSAGE1'] . "\n" . $response['L_LONGMESSAGE1'] . $response['L_ERRORCODE2'] . "\n" . $response['L_SHORTMESSAGE2'] . "\n" . $response['L_LONGMESSAGE2'] . ($response['CURL_ERRORS'] != '' ? "\n" . $response['CURL_ERRORS'] : '') . "\n\n" . 'Zen Cart message: ' . $detailedMessage . "\n\n" . 'Transaction Response Details: ' . print_r($response, true) . "\n\n" . 'Transaction Submission: ' . urldecode($doPayPal->_sanitizeLog($doPayPal->_parseNameValueList($doPayPal->lastParamList), true)));
          if ($detailedEmailMessage != '') zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_PAYPALDP_TEXT_EMAIL_ERROR_SUBJECT . ' (' . $errorNum . ')', $detailedMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML'=>nl2br($detailedEmailMessage)), 'paymentalert');
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
      // temporary fix to table structure for v1.3.7.x -- will remove in later release
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