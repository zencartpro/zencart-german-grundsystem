<?php
/**
 * @package Braintree for Zen Cart German 1.5.6 and PHP 7.3
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: braintree_api.php 2019-06-26 09:07:14 webchills $
*/
require_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/lib/Braintree.php');

if (!defined('TABLE_BRAINTREE'))
    define('TABLE_BRAINTREE', DB_PREFIX . 'braintree');

class braintree_api extends base {

    var $code;
    var $title;
    var $description;
    var $enabled;
    var $zone;
    var $cc_type_check = '';
    var $enableDebugging = false;
    var $sort_order = 0;
    var $order_pending_status = 1;
    var $order_status = DEFAULT_ORDERS_STATUS_ID;
    var $_logLevel = 0;

    /**
     * this module collects card-info onsite
     */
    var $collectsCardDataOnsite = TRUE;

    /**
     * class constructor
     */
    function __construct() {

        include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'braintree_api.php', 'false'));
        global $order;

        $this->code = 'braintree_api';
        $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_TITLE;
        $this->codeVersion = defined('MODULE_PAYMENT_BRAINTREE_VERSION') ? MODULE_PAYMENT_BRAINTREE_VERSION : null;     
        $this->enabled = (defined('MODULE_PAYMENT_BRAINTREE_STATUS') && MODULE_PAYMENT_BRAINTREE_STATUS == 'True');  

        // Set the title & description text based on the mode we're in
        if (IS_ADMIN_FLAG === true) {
            
            $this->description = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_DESCRIPTION;
            $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_ADMIN_TITLE;

            if ($this->enabled) {

                if (MODULE_PAYMENT_BRAINTREE_SERVER == 'sandbox')
                    $this->title .= '<strong><span class="alert">'. BRAINTREE_MESSAGE_SANDBOX_ACTIVE .'</span></strong>';
                if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File' || MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email')
                    $this->title .= '<strong> (Debug)</strong>';
                if (!function_exists('curl_init'))
                    $this->title .= '<strong><span class="alert">' . BRAINTREE_MESSAGE_CURL_NOT_FOUND .'</span></strong>';
            }
        } else {

            $this->description = MODULE_PAYMENT_BRAINTREE_TEXT_DESCRIPTION;
            $this->title = MODULE_PAYMENT_BRAINTREE_TEXT_TITLE;
        }

        if ((!defined('BRAINTREE_OVERRIDE_CURL_WARNING') || (defined('BRAINTREE_OVERRIDE_CURL_WARNING') && BRAINTREE_OVERRIDE_CURL_WARNING != 'True')) && !function_exists('curl_init'))
            $this->enabled = false;
        $this->enableDebugging = ((defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File') || (defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email'));
        $this->emailAlerts = (defined('MODULE_PAYMENT_BRAINTREE_DEBUGGING') && MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email');        
        $this->sort_order = defined('MODULE_PAYMENT_BRAINTREE_SORT_ORDER') ? MODULE_PAYMENT_BRAINTREE_SORT_ORDER : null;
        $this->order_pending_status = defined('MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID') ? MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID : null;    

        if (defined('MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID') && (int)MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID;            
        }  
        
        $this->zone = defined('MODULE_PAYMENT_BRAINTREE_ZONE') ? MODULE_PAYMENT_BRAINTREE_ZONE : null;
       

        if (is_object($order))
            $this->update_status();

        if (!(PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5)))
            $this->enabled = false;

        // debug setup
        if (!defined('DIR_FS_LOGS')) {
            $log_dir = 'logs/';
        } else {
            $log_dir = DIR_FS_LOGS;
        }

        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_CATALOG . $log_dir;
        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_SQL_CACHE;
        // Regular mode:
        if ($this->enableDebugging)
            $this->_logLevel = 2;
        // DEV MODE:
        if (defined('BRAINTREE_DEV_MODE') && BRAINTREE_DEV_MODE == 'true')
            $this->_logLevel = 3;
    }

    /**
     *  Sets payment module status based on zone restrictions etc
     */
    function update_status() {
        global $order, $db;

        // if store is not running in SSL, cannot offer credit card module, for PCI reasons
        if (IS_ADMIN_FLAG === false && (!defined('ENABLE_SSL') || ENABLE_SSL != 'true')) {
            $this->enabled = False;
            $this->zcLog('update_status', '' . BRAINTREE_MESSAGE_NO_SSL . '');
        }

        // check other reasons for the module to be deactivated:
        if ($this->enabled && (int) $this->zone > 0) {

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
                } else if ($check->fields['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }

                $check->MoveNext();
            }

            if (!$check_flag) {
                $this->enabled = false;
                $this->zcLog('update_status', ''. BRAINTREE_MESSAGE_ZONE_RESTRICTION .'');
            }

            // module cannot be used for purchase > 8,000 EUR
            $order_amount = $this->calc_order_amount($order->info['total'], 'EUR');

            if ($order_amount > 8000) {
                $this->enabled = false;
                $this->zcLog('update_status', ''. BRAINTREE_MESSAGE_LIMIT_EXCEEDED .'');
            }

            if ($order->info['total'] == 0) {
                $this->enabled = false;
                
            }
        }
    }

    /**
     *  Validate the credit card information via javascript (Number, Owner, and CVV Lengths)
     */
    function javascript_validation() {
        return '  if(payment_value == "' . $this->code . '") {' . "\n" .
                '    var cc_firstname = document.checkout_payment.braintree_cc_firstname.value;' . "\n" .
                '    var cc_lastname = document.checkout_payment.braintree_cc_lastname.value;' . "\n" .
                '    var cc_number = document.checkout_payment.braintree_cc_number.value;' . "\n" .
                '    var cc_checkcode = document.checkout_payment.braintree_cc_checkcode.value;' . "\n" .
                '    if(cc_firstname == "" || cc_lastname == "" || eval(cc_firstname.length) + eval(cc_lastname.length) < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
                '      error = 1;' . "\n" .
                '      jQuery(\'[name="braintree_cc_firstname"]\').addClass("missing");' . "\n" .
                '      jQuery(\'[name="braintree_cc_firstname"]\').after(\' <span class="alert validation">\' + \'' . addslashes(nl2br(stripslashes(str_replace('\\n', '', MODULE_PAYMENT_BRAINTREE_TEXT_JS_CC_OWNER)))) . '\' + \'</span>\');' . "\n" .
                '      jQuery(\'[name="braintree_cc_lastname"]\').addClass("missing");' . "\n" .
                '      jQuery(\'[name="braintree_cc_lastname"]\').after(\' <span class="alert validation">\' + \'' . addslashes(nl2br(stripslashes(str_replace('\\n', '', MODULE_PAYMENT_BRAINTREE_TEXT_JS_CC_OWNER)))) . '\' + \'</span>\');' . "\n" .
                '    }' . "\n" .
                '    if(cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
                '      error = 1;' . "\n" .
                '      jQuery(\'[name="braintree_cc_number"]\').addClass("missing");' . "\n" .
                '      jQuery(\'[name="braintree_cc_number"]\').after(\' <span class="alert validation">\' + \'' . addslashes(nl2br(stripslashes(str_replace('\\n', '', MODULE_PAYMENT_BRAINTREE_TEXT_JS_CC_NUMBER)))) . '\' + \'</span>\');' . "\n" .
                '    }' . "\n" .
                '    if(document.checkout_payment.braintree_cc_checkcode.disabled == false && (cc_checkcode == "" || cc_checkcode.length < 3 || cc_checkcode.length > 4)) {' . "\n" .
                '      jQuery(\'[name="braintree_cc_checkcode"]\').addClass("missing");' . "\n" .
                '      jQuery(\'[name="braintree_cc_checkcode"]\').siblings(\'small\').after(\' <span class="alert validation">\' + \'' . addslashes(nl2br(stripslashes(str_replace('\\n', '', MODULE_PAYMENT_BRAINTREE_TEXT_JS_CC_CVV)))) . '\' + \'</span>\');' . "\n" .
                '      error = 1;' . "\n" .
                '    }' . "\n" .
                '  }' . "\n";
    }

    /**
     * Display Credit Card Information Submission Fields on the Checkout Payment Page
     */
    function selection() {
        global $order;

        $this->cc_type_check = 'var value = document.checkout_payment.braintree_cc_type.value;' .
                'if(value == "Solo" || value == "Maestro" || value == "Switch") {' .
                '    document.checkout_payment.braintree_cc_issue_month.disabled = false;' .
                '    document.checkout_payment.braintree_cc_issue_year.disabled = false;' .
                '    document.checkout_payment.braintree_cc_checkcode.disabled = false;' .
                '    if(document.checkout_payment.braintree_cc_issuenumber) document.checkout_payment.braintree_cc_issuenumber.disabled = false;' .
                '} else {' .
                '    if(document.checkout_payment.braintree_cc_issuenumber) document.checkout_payment.braintree_cc_issuenumber.disabled = true;' .
                '    if(document.checkout_payment.braintree_cc_issue_month) document.checkout_payment.braintree_cc_issue_month.disabled = true;' .
                '    if(document.checkout_payment.braintree_cc_issue_year) document.checkout_payment.braintree_cc_issue_year.disabled = true;' .
                '    document.checkout_payment.braintree_cc_checkcode.disabled = false;' .
                '}';
                
             if ($this->cards && count($this->cards) == 0) {  
             	$this->cc_type_check = '';
            } 
                
        

        /**
         * since we are processing via the gateway, prepare and display the CC fields
         */
        $expires_month = array();
        $expires_year = array();
        $issue_year = array();

        for ($i = 1; $i < 13; $i++) {
            $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B - (%m)', mktime(0, 0, 0, $i, 1, 2000)));
        }

        $today = getdate();

        for ($i = $today['year']; $i < $today['year'] + 15; $i++) {
            $expires_year[] = array('id' => strftime('%y', mktime(0, 0, 0, 1, 1, $i)), 'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)));
        }

        $onFocus = ' onfocus="methodSelect(\'pmt-' . $this->code . '\')"';

        $fieldsArray = array();
        $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_FIRSTNAME,
            'field' => zen_draw_input_field('braintree_cc_firstname', $order->billing['firstname'], 'id="' . $this->code . '-cc-ownerf"' . $onFocus . ' autocomplete="off"') .
            '<script type="text/javascript">function braintree_cc_type_check() { ' . $this->cc_type_check . ' } </script>',
            'tag' => $this->code . '-cc-ownerf');
        $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_LASTNAME,
            'field' => zen_draw_input_field('braintree_cc_lastname', $order->billing['lastname'], 'id="' . $this->code . '-cc-ownerl"' . $onFocus . ' autocomplete="off"'),
            'tag' => $this->code . '-cc-ownerl');
        if ($this->cards && count($this->cards) > 0)
            $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_TYPE,
                'field' => zen_draw_pull_down_menu('braintree_cc_type', $this->cards, '', 'onchange="braintree_cc_type_check();" onblur="braintree_cc_type_check();"' . 'id="' . $this->code . '-cc-type"' . $onFocus),
                'tag' => $this->code . '-cc-type');
        $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_NUMBER,
            'field' => zen_draw_input_field('braintree_cc_number', $ccnum, 'id="' . $this->code . '-cc-number"' . $onFocus . ' autocomplete="off"', 'tel'),
            'tag' => $this->code . '-cc-number');
        $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_EXPIRES,
            'field' => zen_draw_pull_down_menu('braintree_cc_expires_month', $expires_month, strftime('%m'), 'id="' . $this->code . '-cc-expires-month"' . $onFocus) . '&nbsp;' . zen_draw_pull_down_menu('braintree_cc_expires_year', $expires_year, '', 'id="' . $this->code . '-cc-expires-year"' . $onFocus),
            'tag' => $this->code . '-cc-expires-month');
        $fieldsArray[] = array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_CHECKNUMBER,
            'field' => zen_draw_input_field('braintree_cc_checkcode', '', 'size="4" maxlength="4"' . ' id="' . $this->code . '-cc-cvv"' . $onFocus . ' autocomplete="off"', 'tel') . '&nbsp;<small>' . MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION . '</small><script type="text/javascript">braintree_cc_type_check();</script>',
            'tag' => $this->code . '-cc-cvv');

        $selection = array('id' => $this->code,
            'module' => MODULE_PAYMENT_BRAINTREE_TEXT_TITLE,
            'fields' => $fieldsArray);

        return $selection;
    }

    /**
     * This is the credit card check done between checkout_payment and
     * checkout_confirmation (called from checkout_confirmation).
     * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
     */
    function pre_confirmation_check() {
        global $messageStack, $order;

        include(DIR_WS_CLASSES . 'cc_validation.php');
        $cc_validation = new cc_validation();
        $result = $cc_validation->validate($_POST['braintree_cc_number'], $_POST['braintree_cc_expires_month'], $_POST['braintree_cc_expires_year'], (isset($_POST['braintree_cc_issue_month']) ? $_POST['braintree_cc_issue_month'] : ''), (isset($_POST['braintree_cc_issue_year']) ? $_POST['braintree_cc_issue_year'] : ''));
        $error = '';

        switch ($result) {
            case 1:
                break;
            case -1:
                $error = MODULE_PAYMENT_BRAINTREE_TEXT_BAD_CARD; //sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
                if ($_POST['braintree_cc_number'] == '')
                    $error = str_replace('\n', '', MODULE_PAYMENT_BRAINTREE_TEXT_JS_CC_NUMBER); // yes, those are supposed to be single-quotes.
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

        $_POST['braintree_cc_checkcode'] = preg_replace('/[^0-9]/i', '', $_POST['braintree_cc_checkcode']);
        if (isset($_POST['braintree_cc_issuenumber']))
            $_POST['braintree_cc_issuenumber'] = preg_replace('/[^0-9]/i', '', $_POST['braintree_cc_issuenumber']);

        if (($result === false) || ($result < 1)) {
            $messageStack->add_session($this->code, $error . '<!-- [' . $this->code . '] -->' . '<!-- result: ' . $result . ' -->', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }

        $this->cc_card_type = $cc_validation->cc_type;
        $this->cc_card_number = $cc_validation->cc_number;
        $this->cc_expiry_month = $cc_validation->cc_expiry_month;
        $this->cc_expiry_year = $cc_validation->cc_expiry_year;
        $this->cc_checkcode = $_POST['braintree_cc_checkcode'];
    }

    /**
     * Display Credit Card Information for review on the Checkout Confirmation Page
     */
    function confirmation() {

        $confirmation = array('title' => '',
            'fields' => array(array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_FIRSTNAME,
                    'field' => $_POST['braintree_cc_firstname']),
                array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_LASTNAME,
                    'field' => $_POST['braintree_cc_lastname']),
                array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_TYPE,
                    'field' => $this->cc_card_type),
                array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_NUMBER,
                    'field' => substr($_POST['braintree_cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['braintree_cc_number']) - 8)) . substr($_POST['braintree_cc_number'], -4)),
                array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_CREDIT_CARD_EXPIRES,
                    'field' => strftime('%B, %Y', mktime(0, 0, 0, $_POST['braintree_cc_expires_month'], 1, '20' . $_POST['braintree_cc_expires_year'])),
                    (isset($_POST['braintree_cc_issuenumber']) ? array('title' => MODULE_PAYMENT_BRAINTREE_TEXT_ISSUE_NUMBER,
                        'field' => $_POST['braintree_cc_issuenumber']) : '')
        )));

        return $confirmation;
    }

    /**
     * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
     */
    function process_button() {
        global $order;

        $process_button_string = '';
        $process_button_string .= "\n" . zen_draw_hidden_field('bt_cc_type', $_POST['braintree_cc_type']) . "\n" .
                zen_draw_hidden_field('bt_cc_expdate_month', $_POST['braintree_cc_expires_month']) . "\n" .
                zen_draw_hidden_field('bt_cc_expdate_year', $_POST['braintree_cc_expires_year']) . "\n" .
                zen_draw_hidden_field('bt_cc_issuedate_month', $_POST['braintree_cc_issue_month']) . "\n" .
                zen_draw_hidden_field('bt_cc_issuedate_year', $_POST['braintree_cc_issue_year']) . "\n" .
                zen_draw_hidden_field('bt_cc_issuenumber', $_POST['braintree_cc_issuenumber']) . "\n" .
                zen_draw_hidden_field('bt_cc_number', $_POST['braintree_cc_number']) . "\n" .
                zen_draw_hidden_field('bt_cc_checkcode', $_POST['braintree_cc_checkcode']) . "\n" .
                zen_draw_hidden_field('bt_payer_firstname', $_POST['braintree_cc_firstname']) . "\n" .
                zen_draw_hidden_field('bt_payer_lastname', $_POST['braintree_cc_lastname']) . "\n";
        $process_button_string .= zen_draw_hidden_field(zen_session_name(), zen_session_id());
        return $process_button_string;
    }

    /**
     * Zen Cart 1.5.4 Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
     */
    function process_button_ajax() {
        global $order;
        $processButton = array('ccFields' => array('bt_cc_type' => 'braintree_cc_type',
                'bt_cc_expdate_month' => 'braintree_cc_expires_month',
                'bt_cc_expdate_year' => 'braintree_cc_expires_year',
                'bt_cc_issuedate_month' => 'braintree_cc_issue_month',
                'bt_cc_issuedate_year' => 'braintree_cc_issue_year',
                'bt_cc_issuenumber' => 'braintree_cc_issuenumber',
                'bt_cc_number' => 'braintree_cc_number',
                'bt_cc_checkcode' => 'braintree_cc_checkcode',
                'bt_payer_firstname' => 'braintree_cc_firstname',
                'bt_payer_lastname' => 'braintree_cc_lastname',
            ), 'extraFields' => array(zen_session_name() => zen_session_id()));
        return $processButton;
    }

    /**
     * Prepare and submit the final authorization to Braintree via the appropriate means as configured
     */
    function before_process() {
        global $order, $messageStack;

        //$this->zcLog('before_process - DP-1', 'Beginning DP mode' . print_r($_POST, TRUE));
        // Validate credit card data
        include(DIR_WS_CLASSES . 'cc_validation.php');
        $cc_validation = new cc_validation();
        $response = $cc_validation->validate($_POST['bt_cc_number'], $_POST['bt_cc_expdate_month'], $_POST['bt_cc_expdate_year'], $_POST['bt_cc_issuedate_month'], $_POST['bt_cc_issuedate_year']);
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

        if (($response === false) || ($response < 1)) {
            $this->zcLog('before_process - DP-2', 'CC validation results: ' . $error . '(' . $response . ')');
            $messageStack->add_session($this->code, $error . '<!-- [' . $this->code . '] -->' . '<!-- result: ' . $response . ' -->', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }

        if (!in_array($cc_validation->cc_type, array('Visa', 'MasterCard', 'Switch', 'Solo', 'Discover', 'American Express', 'Maestro'))) {
            $messageStack->add_session($this->code, MODULE_PAYMENT_BRAINTREE_TEXT_BAD_CARD . '<!-- [' . $this->code . ' ' . $cc_validation->cc_type . '] -->', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }

        // if CC validation passed, continue using the validated data
        $cc_number = $cc_validation->cc_number;
        $cc_checkcode = (is_numeric($_POST['bt_cc_checkcode']) ? $_POST['bt_cc_checkcode'] : 0);
        $cc_expdate_month = $cc_validation->cc_expiry_month;
        $cc_expdate_year = $cc_validation->cc_expiry_year;
        $cc_type = $cc_validation->cc_type;
        $cc_owner_ip = current(explode(':', str_replace(',', ':', zen_get_ip_address())));

        $order->info['cc_type'] = $cc_type;
        $order->info['cc_number'] = substr($cc_number, 0, 4) . str_repeat('X', (strlen($cc_number) - 8)) . substr($cc_number, -4);
        $order->info['cc_owner'] = $_SESSION['customer_first_name'] . ' ' . $_SESSION['customer_last_name'];
        $order->info['cc_expires'] = $cc_expdate_month . substr($cc_expdate_year, -2);
        $order->info['ip_address'] = $cc_owner_ip;

        // Prepare products list

        for ($i = 0, $iMax = count($order->products); $i < $iMax; $i++) {

            if (isset($products_list)) {
                $products_list .= "\n";
            }

            $current_products_id = explode(':', $order->products[$i]['id']);

            $products_list .= $order->products[$i]['qty'] . 'x' . $order->products[$i]['name'] . ' (' . $current_products_id[0] . ') ';

            if (isset($order->products[$i]['attributes']) && count($order->products[$i]['attributes']) > 0) {

                for ($j = 0, $n2 = count($order->products[$i]['attributes']); $j < $n2; $j++) {

                    $products_list .= ' ' . $order->products[$i]['attributes'][$j]['value'];
                }
            }

            $products_list .= ' $' . zen_round(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), 2);
        }

        $products_list = (strlen($products_list) > 255) ? substr($products_list, 0, 250) . ' ...' : $products_list;

        $this->braintree_init();
        $setcurrentcy = MODULE_PAYMENT_BRAINTREE_CURRENCY;
        if (!isset($setcurrentcy)) {
            $setcurrentcy = DEFAULT_CURRENCY;
        }
        $merchant_account_id = MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID;

        try {
            $transaction_array = array(
                'amount' => $this->calc_order_amount($order->info['total'], $setcurrentcy),
                'merchantAccountId' => $merchant_account_id,
                'creditCard' => array(
                    'number' => $cc_number,
                    'expirationMonth' => $cc_validation->cc_expiry_month,
                    'expirationYear' => $cc_validation->cc_expiry_year,
                    'cardholderName' => $order->billing['firstname'] . '' . $order->billing['lastname'],
                    'cvv' => $cc_checkcode
                ),
                'customer' => array(
                    'firstName' => $order->customer['firstname'],
                    'lastName' => $order->customer['lastname'],
                    'phone' => $order->customer['telephone'],
                    'email' => $order->customer['email_address']
                ),
                'billing' => array(
                    'firstName' => $order->billing['firstname'],
                    'lastName' => $order->billing['lastname'],
                    'streetAddress' => $order->billing['street_address'],
                    'extendedAddress' => $order->billing['suburb'],
                    'locality' => $order->billing['city'],
                    'region' => $order->billing['state'],
                    'postalCode' => $order->billing['postcode'],
                    'countryCodeAlpha2' => $order->billing['country']['iso_code_2']
                ),
                'shipping' => array(
                    'firstName' => $order->delivery['firstname'],
                    'lastName' => $order->delivery['lastname'],
                    'streetAddress' => $order->delivery['street_address'],
                    'extendedAddress' => $order->delivery['suburb'],
                    'locality' => $order->delivery['city'],
                    'region' => $order->delivery['state'],
                    'postalCode' => $order->delivery['postcode'],
                    'countryCodeAlpha2' => $order->delivery['country']['iso_code_2']
                ), /*
                  'customFields' => array(
                  'products_purchased' => $products_list
                  ), */
                'options' => array(
                    'submitForSettlement' => MODULE_PAYMENT_BRAINTREE_SETTLEMENT
            ));


            $result = Braintree_Transaction::sale($transaction_array);



            if ($result->success) {

                $this->zcLog('before_process - DP-5', 'Result: Success');

                $this->transaction_id = $result->transaction->id;
                $this->payment_type = MODULE_PAYMENT_BRAINTREE_TEXT_TITLE . ' (' . $result->transaction->creditCardDetails->cardType . ')';
                $this->payment_status = 'Completed';
                $this->avs = $result->transaction->avsPostalCodeResponseCode;
                $this->cvv2 = $result->transaction->cvvResponseCode;

                $createdAt_date = new DateTime($result->transaction->createdAt->date);
                $createdAt_formatted = $createdAt_date->format('Y-m-d H:i:s');

                $this->payment_time = $createdAt_formatted;
                $this->amt = $result->transaction->amount;
                $this->transactiontype = 'cart';
                $this->numitems = count($order->products);

                $_SESSION['bt_FIRSTNAME'] = $result->transaction->customerDetails->firstName;
                $_SESSION['bt_LASTNAME'] = $result->transaction->customerDetails->lastName;
                $_SESSION['bt_BUSINESS'] = $result->transaction->billingDetails->company;
                $_SESSION['bt_NAME'] = $result->transaction->creditCardDetails->cardholderName;
                $_SESSION['bt_SHIPTOSTREET'] = $result->transaction->shippingDetails->streetAddress;
                $_SESSION['bt_SHIPTOSTREET2'] = $result->transaction->shippingDetails->extendedAddress;
                $_SESSION['bt_SHIPTOCITY'] = $result->transaction->shippingDetails->locality;
                $_SESSION['bt_SHIPTOSTATE'] = $result->transaction->shippingDetails->region;
                $_SESSION['bt_SHIPTOZIP'] = $result->transaction->shippingDetails->postalCode;
                $_SESSION['bt_SHIPTOCOUNTRY'] = $result->transaction->shippingDetails->countryName;
                $_SESSION['bt_ORDERTIME'] = $createdAt_formatted;
                $_SESSION['bt_CURRENCY'] = $result->transaction->currencyIsoCode;
                $_SESSION['bt_AMT'] = $result->transaction->amount;
                $_SESSION['bt_EXCHANGERATE'] = $result->transaction->disbursementDetails->settlementCurrencyExchangeRate;
                $_SESSION['bt_EMAIL'] = $order->customer['email_address'];
                $_SESSION['bt_PARENTTRANSACTIONID'] = $result->transaction->refundedTransactionId;
            } else if ($result->transaction) {


                  print_r("Error processing transaction:");
                  print_r("\n  message: " . $result->message);
                  print_r("\n  code: " . $result->transaction->processorResponseCode);
                  print_r("\n  text: " . $result->transaction->processorResponseText);
                 

                $error_msg = ''. BRAINTREE_MESSAGE_ERROR_PROCESSING .'' . $result->message;

                if (preg_match('/^1(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 1000 code it's Card Approved but since it didn't suceed above we assume it's Verification Failed.
                    // FROM " . TABLE_BRAINTREE . " : 1000 class codes mean the processor has successfully authorized the transaction; success will be true. However, the transaction could still be gateway rejected even though the processor successfully authorized the transaction if you have AVS and/or CVV rules set up and/or duplicate transaction checking is enabled and the transaction fails those validation.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_CUSTOMER_UNABLE_PROCESSING .'';
                } else if (preg_match('/^2(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 2000 code it's Card Declined
                    // FROM " . TABLE_BRAINTREE . " : 2000 class codes means the authorization was declined by the processor ; success will be false and the code is meant to tell you more about why the card was declined.                
                    if (defined('BRAINTREE_ERROR_CODE_' . $result->transaction->processorResponseCode)) {
                        $customer_error_msg = constant('BRAINTREE_ERROR_CODE_' . $result->transaction->processorResponseCode);
                    } else {
                        $customer_error_msg = ''. BRAINTREE_MESSAGE_PROCESSOR_DECLINE .'';
                    }
                } else if (preg_match('/^3(\d+)/', $result->transaction->processorResponseCode)) {

                    // If it's a 3000 code it's a processor failure
                    // FROM " . TABLE_BRAINTREE . " : 3000 class codes are problems with the back-end processing network, and dont necessarily mean a problem with the card itself.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_NETWORK_UNAVAILABLE .'';
                } else {

                    // This is the default error msg but technically it shouldn't be able to get here, Braintree in the future may add codes making it possible to not be a 1, 2, or 3k class code though.

                    $customer_error_msg = ''. BRAINTREE_MESSAGE_CUSTOMER_UNABLE_PROCESSING .'';
                }

                $this->zcLog('before_process - DP-5', 'Result: ' . $error_msg);

                $detailedEmailMessage = MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_MESSAGE . "\n\n" .
                        $result->message .
                        "\n\nProblem occurred while customer #" .
                        $order->customer['customer_id'] . ' -- ' .
                        $order->customer['firstname'] . ' ' .
                        $order->customer['lastname'] . ' -- was attempting checkout.' . "\n\n" . 'Detailed Validation errors below: ' . "\n\n" .
                        'Code: ' . $result->transaction->processorResponseCode . ' text: ' . $result->transaction->processorResponseText;

                if ($this->emailAlerts)
                    zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_SUBJECT, $detailedEmailMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($detailedEmailMessage)), 'paymentalert');

                $messageStack->add_session('checkout_payment', $customer_error_msg, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
            } else {

                /* Examples

                  print_r("Message: " . $result->message);
                  print_r("\nValidation errors: \n");
                  print_r($result->errors->deepAll());

                 */

                $error_msg = 'Message: ' . $result->message;
                $detailed_error_msg = 'Message: ' . $result->message . ' Validation error(s): ' . $result->errors->deepAll();

                $this->zcLog('before_process - DP-5', 'Result: ' . $detailed_error_msg);

                $detailedEmailMessage = MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_MESSAGE . "\n\n" .
                        $result->message .
                        "\n\nProblem occurred while customer #" .
                        $order->customer['customer_id'] . ' -- ' .
                        $order->customer['firstname'] . ' ' .
                        $order->customer['lastname'] . ' -- was attempting checkout.' . "\n\n" . 'Detailed Validation errors below: ' . "\n\n";

                foreach ($result->errors->deepAll() AS $error) {
                    $detailedEmailMessage .= ($error->code . ": " . $error->message . "\n");
                }

                if ($this->emailAlerts)
                    zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, MODULE_PAYMENT_BRAINTREE_TEXT_EMAIL_ERROR_SUBJECT, $detailedEmailMessage, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($detailedEmailMessage)), 'paymentalert');

                $messageStack->add_session('checkout_payment', $error_msg, 'error');
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
            }
        } catch (Exception $e) {

            $this->zcLog('before_process - DP-5', 'Result: ' . $e->getMessage());
            $messageStack->add_session('checkout_payment', ''. BRAINTREE_MESSAGE_ERROR_PROCESSING .'', 'error');
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
        }
    }

    /**
     * When the order returns from the processor, this stores the results in order-status-history and logs data for subsequent use
     */
    function after_process() {
        global $insert_id, $db, $order;

        // Add a new Order Status History record for this order's details
        $commentString = "Transaction ID: :transID: " .
                "\nPayment Type: :pmtType: " .
                ($this->payment_time != '' ? "\nTimestamp: :pmtTime: " : "") .
                "\nPayment Status: :pmtStatus: " .
                (isset($this->responsedata['auth_exp']) ? "\nAuth-Exp: " . $this->responsedata['auth_exp'] : "") .
                ($this->avs != '' ? "\nAVS Code: " . $this->avs . "\nCVV2 Code: " . $this->cvv2 : '') .
                (trim($this->amt) != '' ? "\nAmount: :orderAmt: " : "");

        $commentString = $db->bindVars($commentString, ':transID:', $this->transaction_id, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtType:', $this->payment_type, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtTime:', $this->payment_time, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':pmtStatus:', $this->payment_status, 'noquotestring');
        $commentString = $db->bindVars($commentString, ':orderAmt:', $this->amt, 'noquotestring');

        $sql_data_array = array(array('fieldName' => 'orders_id', 'value' => $insert_id, 'type' => 'integer'),
            array('fieldName' => 'orders_status_id', 'value' => $order->info['order_status'], 'type' => 'integer'),
            array('fieldName' => 'date_added', 'value' => 'now()', 'type' => 'noquotestring'),
            array('fieldName' => 'customer_notified', 'value' => 0, 'type' => 'integer'),
            array('fieldName' => 'comments', 'value' => $commentString, 'type' => 'string'));

        $db->perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

        // store the Braintree order meta data -- used for later matching and back-end processing activities
        $braintree_order = array('order_id' => $insert_id,
            'txn_type' => $this->transactiontype,
            'module_name' => $this->code,
            'module_mode' => 'USA',
            'reason_code' => $this->reasoncode,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'pending_reason' => $this->pendingreason,
            'first_name' => $_SESSION['bt_FIRSTNAME'],
            'last_name' => $_SESSION['bt_LASTNAME'],
            'payer_business_name' => $_SESSION['bt_BUSINESS'],
            'address_name' => $_SESSION['bt_NAME'],
            'address_street' => $_SESSION['bt_SHIPTOSTREET'],
            'address_city' => $_SESSION['bt_SHIPTOCITY'],
            'address_state' => $_SESSION['bt_SHIPTOSTATE'],
            'address_zip' => $_SESSION['bt_SHIPTOZIP'],
            'address_country' => $_SESSION['bt_SHIPTOCOUNTRY'],
            'payer_email' => $_SESSION['bt_EMAIL'],
            'payment_date' => 'now()',
            'txn_id' => $this->transaction_id,
            'parent_txn_id' => $_SESSION['bt_PARENTTRANSACTIONID'],
            'num_cart_items' => (float) $this->numitems,
            'settle_amount' => (float) urldecode($_SESSION['bt_AMT']),
            'settle_currency' => $_SESSION['bt_CURRENCY'],
            'exchange_rate' => (urldecode($_SESSION['bt_EXCHANGERATE']) > 0 ? urldecode($_SESSION['bt_EXCHANGERATE']) : 1.0),
            'date_added' => 'now()'
        );

        zen_db_perform(TABLE_BRAINTREE, $braintree_order);
    }

    /**
     * Build admin-page components
     *
     * @param int $zf_order_id
     * @return string
     */
    function admin_notification($zf_order_id) {

        if (!defined('MODULE_PAYMENT_BRAINTREE_STATUS'))
            return '';
        global $db;

        $module = $this->code;
        $output = '';
        $response = $this->_GetTransactionDetails($zf_order_id);

        if (file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/braintree_admin_notification.php'))
            include_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/braintree/braintree_admin_notification.php');

        return $output;
    }

    /**
     * Used to read details of an existing transaction.  FOR FUTURE USE.
     */
    function _GetTransactionDetails($oID) {

        if ($oID == '' || $oID < 1)
            return FALSE;
        global $db, $messageStack, $doPayPal;

        $doBraintree = $this->braintree_init();

        // look up history on this order from Braintree table

        $sql = "SELECT * FROM " . TABLE_BRAINTREE . " 
            WHERE order_id = :orderID
            AND parent_txn_id = ''
            LIMIT 1";

        $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
        $zc_btHist = $db->Execute($sql);
        if ($zc_btHist->RecordCount() == 0)
            return false;
        $txnID = $zc_btHist->fields['txn_id'];
        if ($txnID == '' || $txnID === 0)
            return FALSE;

        /**
         * Read data from PayPal
         */
        try {
            $result = Braintree_Transaction::find($txnID);

            // Load data into $response
            $response['FIRSTNAME'] = $result->customerDetails->firstName;
            $response['LASTNAME'] = $result->customerDetails->lastName;
            $response['BUSINESS'] = $result->billingDetails->company;
            $response['NAME'] = $result->creditCardDetails->cardholderName;
            $response['BILLTOSTREET'] = $result->billingDetails->streetAddress;
            $response['BILLTOSTREET2'] = $result->billingDetails->extendedAddress;
            $response['BILLTOCITY'] = $result->billingDetails->locality;
            $response['BILLTOSTATE'] = $result->billingDetails->region;
            $response['BILLTOZIP'] = $result->billingDetails->postalCode;
            $response['BILLTOCOUNTRY'] = $result->billingDetails->countryName;
            $response['TRANSACTIONID'] = $result->id;
            $response['PARENTTRANSACTIONID'] = $result->refundedTransactionId;
            $response['TRANSACTIONTYPE'] = $result->type;
            $response['PAYMENTTYPE'] = $result->creditCardDetails->cardType;
            $response['PAYMENTSTATUS'] = $result->status;

            $createdAt_date = new DateTime($result->createdAt->date);
            $createdAt_formatted = $createdAt_date->format('Y-m-d H:i:s');
            $response['ORDERTIME'] = $createdAt_formatted;

            $response['CURRENCY'] = $result->currencyIsoCode;
            $response['AMT'] = $result->amount;
            $response['EXCHANGERATE'] = $result->disbursementDetails->settlementCurrencyExchangeRate;
            $response['EMAIL'] = $zc_btHist->fields['payer_email'];
        } catch (Exception $e) {
            $messageStack->add($e->getMessage(), 'error');
        }

        return $response;
    }

    /**
     * Evaluate installation status of this module. Returns true if the status key is found.
     */
    function check() {
        global $db,$messageStack;

        if (!isset($this->_check)) {
            $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_BRAINTREE_STATUS'");
            $this->_check = !$check_query->EOF;
            if ($this->_check && defined('MODULE_PAYMENT_BRAINTREE_VERSION')) {
                $this->version = MODULE_PAYMENT_BRAINTREE_VERSION;
       
            }
        }
        return $this->_check;
    }

    /**
     * Installs all the configuration keys for this module
     */
    function install() {
        global $db, $messageStack;

        if (defined('MODULE_PAYMENT_BRAINTREE_STATUS')) {
            $messageStack->add_session(''. BRAINTREE_MESSAGE_ALREADY_INSTALLED .'', 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=braintree', 'NONSSL'));
            return 'failed';
        }

        $db->Execute('insert into ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Version', 'MODULE_PAYMENT_BRAINTREE_VERSION', '1.5.0', 'Version installed:', '6', '1', NOW(), NOW(), NULL, 'zen_cfg_read_only(');");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_BRAINTREE_STATUS', 'True', 'Do you want to enable this payment module?', '6', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Key', 'MODULE_PAYMENT_BRAINTREE_MERCHANTID', '', 'Your Merchant ID provided under the API Keys section.', '6', '3', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Public Key', 'MODULE_PAYMENT_BRAINTREE_PUBLICKEY', '', 'Your Public Key provided under the API Keys section.', '6', '4', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Private Key', 'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY', '', 'Your Private Key provided under the API Keys section.', '6', '5', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID', '', 'Your Merchant Account ID, this should contain your <strong>Merchant Account Name</strong>.<br>Example: myaccountUSD', '6', '6', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Production or Sandbox', 'MODULE_PAYMENT_BRAINTREE_SERVER', 'sandbox', '<strong>Production: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', '6', '7', 'zen_cfg_select_option(array(\'production\', \'sandbox\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account Default Currency', 'MODULE_PAYMENT_BRAINTREE_CURRENCY', 'EUR', 'Your Merchant Account Settlement Currency, must be the same as currency code in your Merchant Account Name.<br> Example: USD, CAD, AUD - You can see your store currencies from the <a target=\"_blank\" href=\"currencies.php\">Localization/Currency</a>(Opens New Window).', '6', '8', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_BRAINTREE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '9', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_BRAINTREE_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '10', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID', '2', 'Set the status of orders paid with this payment module to this value. <br /><strong>Recommended: Processing[2]</strong>', '6', '11', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Unpaid Order Status', 'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID', '1', 'Set the status of unpaid orders made with this payment module to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '12', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID', '5', 'Set the status of refunded orders to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '13', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_BRAINTREE_DEBUGGING', 'Alerts Only', 'Would you like to enable debug mode?  A complete detailed log of failed transactions will be emailed to the store owner if Log and Email is selected.', '6', '14', 'zen_cfg_select_option(array(\'Alerts Only\', \'Log File\', \'Log and Email\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Submit for Settlement', 'MODULE_PAYMENT_BRAINTREE_SETTLEMENT', 'true', 'Would you like to automatically Submit for Settlement?  Setting to false will only authorize and not submit for settlement (also know as capture) the transaction', '6', '15', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
        // www.zen-cart-pro.at german admin settings languages_id==43
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Kreditkartenzahlung via Braintree anbieten?', 'MODULE_PAYMENT_BRAINTREE_STATUS', '43', 'Wollen Sie Kreditkartenzahlung via Braintree aktivieren?', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Modulversion', 'MODULE_PAYMENT_BRAINTREE_VERSION', '43', 'Read Only Einstellung. Zeigt die Version des installierten Braintree Moduls an.', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Merchant Key ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANTID', '43', 'Tragen Sie hier die Merchant ID ein, die in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Public Key', 'MODULE_PAYMENT_BRAINTREE_PUBLICKEY', '43', 'Tragen Sie hier den Public Key ein, der in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Private Key', 'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY', '43', 'Tragen Sie hier den Private Key ein, der in Ihren Braintree API Keys Einstellungen angezeigt wird.', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Merchant Account ID', 'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID', '43', 'Tragen Sie hier Ihre Merchant Account ID ein, sie enthält normalerweise Ihren <strong>Merchant Account Namen</strong>.<br>Beispiel: myaccountEUR', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Livesystem oder Sandbox', 'MODULE_PAYMENT_BRAINTREE_SERVER', '43', 'Stellen Sie zunächst auf sandbox, um alles im Braintree Testsystem zu testen.<br>Nach erfolgreichen Tests und Freischaltung durch Braintree stellen Sie auf das Produktivsystem um.<br><br><strong>production: </strong> für echte Live Transaktionen<br><strong>sandbox: </strong> zum Testen im Sandbox System', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Währung in Ihrem Braintree Händleraccount', 'MODULE_PAYMENT_BRAINTREE_CURRENCY', '43', 'Ihre Auszahlungswährung für das Handelskonto muss mit dem Währungscode in Ihrem Handelskonto-Namen übereinstimmen.<br> Beispiel: EUR oder USD<br>Sie können Ihre Shopwährungen im Link <a target=\"_blank\" href=\"currencies.php\">Lokalisation/Währungen</a> (öffnet neues Fenster) sehen.', now())"); 
        $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_BRAINTREE_SORT_ORDER', '43', 'An welcher Stelle der Zahlungsarten soll Braintree angeboten werden? Niedrigste Werte werden zuoberst angezeigt.', now())");   
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Einschränkung auf Zahlungszone', 'MODULE_PAYMENT_BRAINTREE_ZONE', '43', 'Falls Sie hier eine Zone auswählen, dann wird Braintree Kreditkartenzahlung nur für Kunden dieser Zone angeboten.<br>Auf kein lassen, um diese Zahlungsart für alle Kunden anzubieten.', now())");
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für abgeschlossene Zahlungen', 'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die erfolgreich mit Braintree bezahlt wurden?<br>Empfohlen: Zahlung erhalten - in Arbeit[2]', now())");
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für nicht abgeschlossene Zahlungen', 'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die noch nicht erfolgreich mit Braintree bezahlt wurden?<br>Empfohlen: warten auf Zahlung[1]', now())");
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus für erstattete Zahlungen', 'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die via Braintree rückerstattet wurden?<br>Empfohlen: Storniert[5]', now())");
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Debug Modus', 'MODULE_PAYMENT_BRAINTREE_DEBUGGING', '43', 'Möchten Sie den Debug-Modus aktivieren?  Ein vollständiges detailliertes Protokoll der fehlgeschlagenen Transaktionen wird dem Shopadministrator per E-Mail zugesandt, wenn Log and E-Mail ausgewählt ist. Wird nur Log ausgewählt wird lediglich im Ordner logs ein Logfile geschrieben. Nützlich in der Testphase zur Fehleranalyse', now())");
			  $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Direkte Abrechnung oder bloß Autorisierung?', 'MODULE_PAYMENT_BRAINTREE_SETTLEMENT', '43', 'Möchten Sie automatisch zur Abrechnung einreichen?  Wenn Sie auf false setzen, wird die Transaktion nur autorisiert und nicht zur Abrechnung eingereicht (auch als Capture bezeichnet).', now())");
			  // create new braintree table
        $db->Execute("CREATE TABLE IF NOT EXISTS " . TABLE_BRAINTREE . " (`braintree_id` int(11) NOT NULL AUTO_INCREMENT,  `order_id` int(11) NOT NULL,  `txn_type` varchar(256) NOT NULL,  `module_name` text NOT NULL,  `reason_code` text NOT NULL,  `payment_type` varchar(256) NOT NULL,  `payment_status` varchar(256) NOT NULL,  `pending_reason` varchar(256) NOT NULL,  `first_name` text NOT NULL,  `last_name` text NOT NULL,  `payer_business_name` text NOT NULL,  `address_name` text NOT NULL,  `address_street` text NOT NULL,  `address_city` text NOT NULL,  `address_state` text NOT NULL,  `address_zip` varchar(256) NOT NULL,  `address_country` varchar(256) NOT NULL,  `payer_email` text NOT NULL,  `payment_date` date NOT NULL,  `txn_id` varchar(256) NOT NULL,  `parent_txn_id` varchar(256) NOT NULL,  `num_cart_items` int(11) NOT NULL,  `settle_amount` decimal(10,0) NOT NULL,  `settle_currency` varchar(256) NOT NULL,  `exchange_rate` decimal(10,0) NOT NULL,  `date_added` date NOT NULL,  `module_mode` text NOT NULL,  PRIMARY KEY (`braintree_id`),  UNIQUE KEY `order_id` (`order_id`)) ENGINE=MyISAM AUTO_INCREMENT=1");
        $this->notify('NOTIFY_PAYMENT_BRAINTREE_INSTALLED');
    }

    function keys() {

        $keys = array(
            'MODULE_PAYMENT_BRAINTREE_STATUS',
            'MODULE_PAYMENT_BRAINTREE_VERSION',
            'MODULE_PAYMENT_BRAINTREE_MERCHANTID',
            'MODULE_PAYMENT_BRAINTREE_PUBLICKEY',
            'MODULE_PAYMENT_BRAINTREE_PRIVATEKEY',
            'MODULE_PAYMENT_BRAINTREE_CURRENCY',
            'MODULE_PAYMENT_BRAINTREE_SORT_ORDER',
            'MODULE_PAYMENT_BRAINTREE_ZONE',
            'MODULE_PAYMENT_BRAINTREE_ORDER_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_ORDER_PENDING_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID',
            'MODULE_PAYMENT_BRAINTREE_SERVER',
            'MODULE_PAYMENT_BRAINTREE_DEBUGGING',
            'MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID',
            'MODULE_PAYMENT_BRAINTREE_SETTLEMENT'
        );

        return $keys;
    }

    /**
     * Uninstall this module
     */
    function remove() {
        global $db;
        $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
        // www.zen-cart-pro.at german admin languages_id == delete all
        $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
        $this->notify('NOTIFY_PAYMENT_BRAINTREE_UNINSTALLED');
    }

    /**
     * Debug Logging support
     */
    function zcLog($stage, $message) {
        static $tokenHash;

        if ($tokenHash == '')
            $tokenHash = '_' . zen_create_random_value(4);

        if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log File') {

            $token = date('m-d-Y-H-i');
            $token .= $tokenHash;
            if (!defined('DIR_FS_LOGS')) {
                $log_dir = 'cache/';
            } else {
                $log_dir = DIR_FS_LOGS;
            }
            $file = $log_dir . '/' . $this->code . '_Braintree_Action_' . $token . '.log';
            if (defined('BRAINTREE_DEV_MODE') && BRAINTREE_DEV_MODE == 'true')
                $file = $log_dir . '/' . $this->code . '_Braintree_Debug_' . $token . '.log';
            $fp = @fopen($file, 'a');
            @fwrite($fp, date('M-d-Y H:i:s') . ' (' . time() . ')' . "\n" . $stage . "\n" . $message . "\n=================================\n\n");
            @fclose($fp);
        }

        $this->_doDebug($stage, $message, false);
    }

    /**
     * Used to submit a refund for a given transaction.
     */
    function _doRefund($oID, $amount = 'Full', $note = '') {
        global $db, $doBraintree, $messageStack;

        $new_order_status = (int) MODULE_PAYMENT_BRAINTREE_REFUNDED_STATUS_ID;
        $doBraintree = $this->braintree_init();
        $proceedToRefund = false;
        $refundNote = strip_tags(zen_db_input($_POST['refnote']));

        if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_FULL) {
            $refundAmt = 'Full';
            if (isset($_POST['reffullconfirm']) && $_POST['reffullconfirm'] == 'on') {
                $proceedToRefund = true;
            } else {
                $messageStack->add_session(MODULE_PAYMENT_BRAINTREE_TEXT_REFUND_FULL_CONFIRM_ERROR, 'error');
            }
        }

        if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
            $refundAmt = (float) $_POST['refamt'];
            $proceedToRefund = true;
            if ($refundAmt == 0) {
                $messageStack->add_session(MODULE_PAYMENT_BRAINTREE_TEXT_INVALID_REFUND_AMOUNT, 'error');
                $proceedToRefund = false;
            }
        }

        // look up history on this order FROM " . TABLE_BRAINTREE . "  table
        $sql = "SELECT * FROM " . TABLE_BRAINTREE . "  WHERE order_id = :orderID AND parent_txn_id = '' ";
        $sql = $db->bindVars($sql, ':orderID', $oID, 'integer');
        $zc_btHist = $db->Execute($sql);
        if ($zc_btHist->RecordCount() == 0)
            return false;
        $txnID = $zc_btHist->fields['txn_id'];

        /**
         * Submit refund request to Braintree
         */
        if ($proceedToRefund) {

            try {

                $result = Braintree_Transaction::find($txnID);

                if ($result->status == "submitted_for_settlement" || $result->status == "authorized") {

                    // Transaction is pending so Void

                    $result = Braintree_Transaction::void($txnID);
                    $transactionid = $txnID;
                } else if ($result->status == "settled" || $result->status == "settling") {

                    // Transaction is Settled so Refund

                    if (isset($_POST['fullrefund']) && $_POST['fullrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_FULL) {
                        $result = Braintree_Transaction::refund($txnID);
                        $transactionid = $result->transaction->refundId;
                    }

                    if (isset($_POST['partialrefund']) && $_POST['partialrefund'] == MODULE_PAYMENT_BRAINTREE_ENTRY_REFUND_BUTTON_TEXT_PARTIAL) {
                        $result = Braintree_Transaction::refund($txnID, $refundAmt);
                        $transactionid = $result->transaction->refundId;
                    }
                }

                if ($result->success) {

                    if (!isset($result->transaction->amount))
                        $result->transaction->amount = $refundAmt;

                    $new_order_status = ($new_order_status > 0 ? $new_order_status : 1);

                    $sql_data_array = array('orders_id' => $oID,
                        'orders_status_id' => (int) $new_order_status,
                        'date_added' => 'now()',
                        'comments' => 'REFUND INITIATED. Trans ID:' . $transactionid . "\n" . ' Gross Refund Amt: ' . $refundAmt . "\n" . $refundNote,
                        'customer_notified' => 0
                    );

                    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

                    $db->Execute("UPDATE " . TABLE_ORDERS . "
                        SET orders_status = '" . (int) $new_order_status . "'
                        WHERE orders_id = '" . (int) $oID . "'");

                    $messageStack->add_session(sprintf(MODULE_PAYMENT_BRAINTREE_TEXT_REFUND_INITIATED, $refundAmt, $transactionid), 'success');
                    return true;
                } else {

                    $messageStack->add_session($result->errors, 'error');
                }
            } catch (Exception $e) {
                $messageStack->add_session($e->getMessage(), 'error');
            }
        }
    }

    /**
     * Debug Emailing support
     */
    function _doDebug($subject = 'Braintree debug data', $data, $useSession = true) {

        if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email') {

            $data = urldecode($data) . "\n\n";
            if ($useSession)
                $data .= "\nSession data: " . print_r($_SESSION, true);
            zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $subject, $this->code . "\n" . $data, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, array('EMAIL_MESSAGE_HTML' => nl2br($this->code . "\n" . $data)), 'debug');
        }
    }

    /**
     * Initialize the Braintree object for communication to the processing gateways
     */
    function braintree_init() {

        if (MODULE_PAYMENT_BRAINTREE_MERCHANTID != '' && MODULE_PAYMENT_BRAINTREE_PUBLICKEY != '' && MODULE_PAYMENT_BRAINTREE_PRIVATEKEY != '') {

            Braintree_Configuration::environment(MODULE_PAYMENT_BRAINTREE_SERVER);
            Braintree_Configuration::merchantId(MODULE_PAYMENT_BRAINTREE_MERCHANTID);
            Braintree_Configuration::publicKey(MODULE_PAYMENT_BRAINTREE_PUBLICKEY);
            Braintree_Configuration::privateKey(MODULE_PAYMENT_BRAINTREE_PRIVATEKEY);
        } else {
            return FALSE;
        }
    }

    /**
     * Calculate the amount based on acceptable currencies
     */
    function calc_order_amount($amount, $braintreeCurrency, $applyFormatting = false) {
        global $currencies;

        $amount = ($amount * $currencies->get_value($braintreeCurrency));

        if ($braintreeCurrency == 'JPY' || (int) $currencies->get_decimal_places($braintreeCurrency) == 0) {
            $amount = (int) $amount;
            $applyFormatting = FALSE;
        }

        $amount = round($amount, 2);

        return ($applyFormatting ? number_format($amount, $currencies->get_decimal_places($braintreeCurrency)) : $amount);
    }

}