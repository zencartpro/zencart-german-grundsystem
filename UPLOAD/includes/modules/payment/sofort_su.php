<?php
/**
* Package Sofort for Zen Cart 1.5.7 German and PHP 8
* @copyright Copyright 2003-2022 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* $Id: sofort_su.php 2022-11-21 22:05:20Z webchills $
*/

require_once(dirname(__FILE__) . '/../../../ext/modules/payment/sofort/helper/Util.php');

/**
 * Sofort payment plugin
 */
class sofort_su
{

    /**
     * @var string
     */
    var $code = 'sofort_su';

    /**
     * @var string
     */
    var $title;
    
    /**
     * @var string
     */
    var $title_extern;

    /**
     * @var string
     */
    var $description;

    /**
     * @var boolean
     */
    var $enabled = false;

    /**
     * @var string
     */
    var $configuration_key;
    
    /**
     * @var boolean
     */
    var $recommended_payment;

    /**
     * @var string
     */
    var $zone;

    /**
     * @var string
     */
    var $sort_order;

    /**
     * @var string
     */
    var $order_status;
    
    /**
     * @var string
     */
    var $payment_aborted;
    
    /**
     * @var string
     */
    var $pending_not_credited_yet;
    
    /**
     * @var string
     */
    var $loss_not_credited;
    
    /**
     * @var string
     */
    var $received_credited;
    
    /**
     * @var string
     */
    var $refunded_refunded;
    
    /**
     * @var string
     */
    var $refunded_comp;

    /**
     * @var boolean
     */
    var $create_order;

    /**
     * @var boolean
     */
    var $logo;

    /**
     * @var boolean
     */
    var $customer_protection;

    /**
     * @var string
     */
    var $reason_one;

    /**
     * @var string
     */
    var $reason_two;

    /**
     * @var string
     */
    var $email_footer;

    /**
     * @var boolean
     */
    var $_check;

    /**
     * @var boolean
     */
    var $order_submitted = false;

    /**
     * Initialize plugin configuration
     * 
     * @global order $order
     */
    function __construct()
    {
        global $order;  
        
        $this->title = defined('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE') ? MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE : null;
        
        if (defined('IS_ADMIN_FLAG')) {
        $this->title = MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE;
        } else if ($_GET['main_page'] == FILENAME_CHECKOUT_CONFIRMATION || $_GET['main_page'] == FILENAME_CHECKOUT_PROCESS) {
            $this->title = MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE;
        } else {
            $this->title = MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE . MODULE_PAYMENT_SOFORT_SU_TEXT_LOGO;
        }
        
        $this->title_extern = defined('MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE') ? MODULE_PAYMENT_SOFORT_SU_TEXT_TITLE : null;
     
        $this->recommended_payment = (defined('MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT') && MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT == 'True');
        
        if ($this->recommended_payment) {
            $this->title_extern .= ' ' . MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_CHECKOUT;
        }        
       
         $this->description = defined('MODULE_PAYMENT_SOFORT_SU_DESCRIPTION') ? MODULE_PAYMENT_SOFORT_SU_DESCRIPTION : null;
         $this->enabled = (defined('MODULE_PAYMENT_SOFORT_SU_STATUS') && MODULE_PAYMENT_SOFORT_SU_STATUS == 'True'); 
        
        
     
        $this->configuration_key = defined('MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY') ? MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY : null;
        $this->zone = defined('MODULE_PAYMENT_SOFORT_SU_ZONE') ? MODULE_PAYMENT_SOFORT_SU_ZONE : null;
        
       if (defined('MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID') && (int)MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID > 0) {
       $this->order_status = MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID;            
        }       
        
        $this->payment_aborted = defined('MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID : null;
        $this->pending_not_credited_yet = defined('MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID : null;
        $this->loss_not_credited = defined('MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID : null;
        $this->received_credited = defined('MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID : null;
        $this->refunded_compensation = defined('MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID : null;
        $this->refunded_refunded = defined('MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID') ? MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID : null;        
        $this->create_order = (defined('MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER') && MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER == 'True'); 
        $this->logo = (defined('MODULE_PAYMENT_SOFORT_SU_LOGO') && MODULE_PAYMENT_SOFORT_SU_LOGO == 'Text'); 
        $this->customer_protection = (defined('MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION') && MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION == 'True'); 
        $this->reason_one = defined('MODULE_PAYMENT_SOFORT_SU_REASON_ONE') ? MODULE_PAYMENT_SOFORT_SU_REASON_ONE : null;
        $this->reason_two = defined('MODULE_PAYMENT_SOFORT_SU_REASON_TWO') ? MODULE_PAYMENT_SOFORT_SU_REASON_TWO : null;
        $this->sort_order = defined('MODULE_PAYMENT_SOFORT_SU_SORT_ORDER') ? MODULE_PAYMENT_SOFORT_SU_SORT_ORDER : null;       
       

        if (is_object($order)) {
            $this->update_status();
        }
    }

    /**
     * Check if payment should be displayed
     * 
     * @global order $order
     * @global queryFactory $db
     */
    function update_status()
    {
        global $order, $db;        
              
        // check country
        $dest_country = $order->billing['country']['iso_code_2'] ?? 0;        
        $error = false;
        $countries_table = MODULE_PAYMENT_SOFORT_SU_COUNTRIES; 
        $country_zones = explode(",", $countries_table);
        if (in_array($dest_country, $country_zones)) {            
            $this->enabled = true;
        } else {
            $this->enabled = false;
        }

        if (($this->enabled == true) && ((int) MODULE_PAYMENT_SOFORT_SU_ZONE > 0) && isset($order->billing['country']['id'])) {
            $check_flag = false;

            $check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int) MODULE_PAYMENT_SOFORT_SU_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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

        if (empty($this->configuration_key)) {
            $this->enabled = false;
        }
    }

    /**
     * Is payment method installed
     * 
     * @global queryFactory $db
     * @return booleam
     */
    function check()
    {
        global $db;

        if (!isset($this->_check)) {
            $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_SOFORT_SU_STATUS'");
            $this->_check = $check_query->RecordCount();
        }

        return $this->_check;
    }

    /**
     * Javascript for payment selection (not used)
     * 
     * @return boolean
     */
    function javascript_validation()
    {
        return false;
    }

    /**
     * Payment selection
     * 
     * @return array
     */
    function selection()
    {
        $title = '';
        
        if ($this->logo) {
            if($this->customer_protection) {
                $title = $this->set_image_text('pink.png', MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT_KS, '138', '44');
            } else {
                $title = $this->set_image_text('pink.png', MODULE_PAYMENT_SOFORT_SU_CHECKOUT_TEXT, '134', '44');
            }
        } else {
            if($this->customer_protection) {
                $title = $this->set_image_text('pink.png', '', '138', '44');
            } else {
                $title = $this->set_image_text('pink.png', '', '138', '44');
            }
        }
        
        if (array_key_exists('sofort_order_submited', $_SESSION)) {
            unset($_SESSION['sofort_order_submited']);
        }

        $title = str_replace(
            '[[link_beginn]]', 
            '<a '
                . 'href="' . MODULE_PAYMENT_SOFORT_SU_CHECKOUT_INFOLINK_KS . '" '
                . 'target="_blank" '
                . 'style="cursor: pointer; text-decoration: underline;">', 
            $title
        );
        
        $title = str_replace('[[link_end]]', '</a>', $title);

        return array(
            'id' => $this->code,
            'module' => $this->title_extern,
            'fields' => array(
                array(
                    'title' => $title,
                    'field' => '',
                ),
            ),
        );
    }
    
    /**
     * Set selection image
     * 
     * @param string $image
     * @param string $text
     * @param int $width
     * @param int $height
     * @return string
     */
    function set_image_text($image, $text, $width, $height) 
    {
        $util = new Util();
        
        $image = '<img '
               . 'src="https://cdn.klarna.com/1.0/shared/image/generic/badge/' . $util->getShortCode($_SESSION['language']) . '/pay_now/descriptive/horizontal/' . $image . '"'
               . 'alt="' . MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGEALT . '" '
               . 'width="' . $width . '" '
               . 'height="' . $height . '"/>';

        $title = MODULE_PAYMENT_SOFORT_SU_DESCRIPTION_CHECKOUT_PAYMENT_IMAGE;
        $title = str_replace('{{image}}', $image, $title);
        $title = str_replace('{{text}}', $text, $title);
        
        return $title;
    }

    /**
     * Return error message from url
     * 
     * @return string
     */
    function get_error()
    {
        global $db;
        
        $error_text = array();

        if (isset($_GET['error'])) {
            if (array_key_exists('sofort_order_id', $_SESSION)) {
                require_once(dirname(__FILE__) .  '/../../sofort_states.php');
                $check_query = $db->Execute("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" . $db->prepareInput(MODULE_PAYMENT_SOFORT_UNCHANGED_ENGLISH) . "' LIMIT 1");
                
                if ($this->payment_aborted !== $check_query->fields['orders_status_id']) {
                    
                    $sql_data_array = array(
                        'orders_id' => $_SESSION['sofort_order_id'],
                        'orders_status_id' => $this->payment_aborted,
                        'date_added' => 'now()',
                        'customer_notified' => 0,
                        'comments' => 'Payment aborted. Time: ' . date("Y-m-d H:i:s")
                    );

                    $db->Execute("UPDATE `" . TABLE_ORDERS . "` SET orders_status = " . (int) $this->payment_aborted . " WHERE orders_id = " . (int) $_SESSION['sofort_order_id']);
                    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
                }
                
                if ($this->create_order) {
                    $this->restock($_SESSION['sofort_order_id']);
                }
            }
            
            $error_text = array();
            $error_text['error'] = MODULE_PAYMENT_SOFORT_SU_TEXT_ERROR_MESSAGE;
            unset($_SESSION['sofort_order_id']);
            unset($_SESSION['sofort_order_submited']);
            unset($_SESSION['sofort_transaction_id']);
        }

        return $error_text;
    }
    
    function restock($orderId)
    {
        global $db;
        
        $order = $db->Execute("SELECT products_id, products_quantity
                FROM " . $db->prepareInput(TABLE_ORDERS_PRODUCTS) . "
                WHERE orders_id = '" . (int) $orderId . "'");

        while (!$order->EOF) {
            $db->Execute("UPDATE " . $db->prepareInput(TABLE_PRODUCTS) . "
                    SET products_quantity = products_quantity + " . (int) $order->fields['products_quantity'] . ",
                            products_ordered = products_ordered - " . (int) $order->fields['products_quantity'] . "
                    WHERE products_id = '" . (int) $order->fields['products_id'] . "'");
            $order->MoveNext();
        }
    }

    /**
     * Check payment selection submit (not used)
     * 
     * @return boolean
     */
    function pre_confirmation_check()
    {
        return false;
    }

    /**
     * Return process button string (not used)
     * 
     * @return boolean
     */
    function process_button()
    {
        return false;
    }

    /**
     * Return confirmation payment data (not used)
     * 
     * @return boolean
     */
    function confirmation()
    {
        return false;
    }
    
    /**
     * @global order $order
     * @param int $orderId
     */
    function submit_payment_request($orderId = null)
    {
        global $order;
        if (!array_key_exists('sofort_order_submited', $_SESSION) && !$_SESSION['sofort_order_submited']) {
            $data = $this->payment_request($order, $orderId);

            if ($data['success']) {
                $_SESSION['sofort_order_submited'] = true;
                $_SESSION['submit_url'] = $data['url'];
            } else {
                zen_redirect($data['url']);
            }
        
        }
    }

    /**
     * Payment action before the order is created
     * 
     * @global order $order
     */
    function before_process()
    {
        require_once(dirname(__FILE__) . '/../../../ext/modules/payment/sofort/services/Communication.php');
        
        if (!$this->create_order && !array_key_exists('sofort_order_submited', $_SESSION)) {
            $this->submit_payment_request();
            zen_redirect($_SESSION['submit_url']);
        }
        
        if (!$this->create_order && array_key_exists('sofort_order_submited', $_SESSION)) {
            $communication = new Communication($this);
            $statusData = $communication->getTransactionDataById($_SESSION['sofort_transaction_id']);
            $_SESSION['sofort_status_data'] = $statusData;
            if ($statusData['status'] !== 'pending' && $statusData['status'] !== 'untraceable') {
                zen_redirect($_SESSION['submit_url']);
            }
        }
        
        if ($this->create_order && array_key_exists('sofort_order_submited', $_SESSION)) {
            $this->clean_session();
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
        }
    }
    
    /**
     * Payment action after order is created
     * @param int $insert_id
     */
    function after_order_create($insert_id)
    {
        if ($this->create_order) {
            $this->submit_payment_request($insert_id);
        }
        
    }

    /**
     * Payment action after the order is created
     * 
     * @global order $order
     */
    function after_process()
    {
        global $insert_id, $db;
        
        if (array_key_exists('sofort_transaction_id', $_SESSION)) {
            $db->Execute(
                "INSERT INTO `". DB_PREFIX . "pi_sofort_transaction` " . 
                "(order_id, transaction_id) " .
                "VALUES('" .
                    $db->prepareInput($insert_id) . "', '" .
                    $db->prepareInput($_SESSION['sofort_transaction_id']) .
                "')"
            );
        }
        
        if ($this->create_order && array_key_exists('sofort_order_submited', $_SESSION)) {
            $_SESSION['sofort_order_id'] = $insert_id;
            zen_redirect($_SESSION['submit_url']);
        }
        
        if (!$this->create_order && array_key_exists('sofort_order_submited', $_SESSION)) {
            $this->check_status($_SESSION['sofort_status_data']);
            $this->clean_session();
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
        }
    }   
    
    /**
     * Get shop order total
     * 
     * @return float $shopEndprice
     */
    function get_shop_total($order_totals, $order) 
    {
        //Frequent sources of errors: shipping-tax, external modules, sort order of shown 'ot_'-modules
        $ot_total_total = 0;

        if (MODULE_ORDER_TOTAL_INSTALLED) {
            foreach ($order_totals as $one_total) {
                if ($one_total['code'] == 'ot_total') {
                    $ot_total_total = $one_total['value'];
                }
            }
        }

        
        $order_object_total = zen_round($order->info['total'], 2);        

        //use the higher one
        $shop_total = 0;

        if ($ot_total_total >= $order_object_total) {
            $shop_total = $ot_total_total;
        } else if ($order_object_total > $ot_total_total) {
            $shop_total = $order_object_total;
        }

        //if payment is not EUR: calculate with exchange rate
        
        $shop_total = zen_round($order->info['total'], 2); 

        return number_format($shop_total, 2, '.','');
    }

    /**
     * Clear checkout session
     * 
     * @global order_total $order_total_modules
     * @global notifier $zco_notifier
     */
    function clean_session()
    {
        global $order_total_modules, $zco_notifier;

        if (is_object($_SESSION['cart'])) {
            $_SESSION['cart']->reset(true);
        }

        unset($_SESSION['sofort_order_id']);
        unset($_SESSION['submit_url']);
        unset($_SESSION['sofort_order_submited']);
        unset($_SESSION['sofort_transaction_id']);
        unset($_SESSION['sofort_status_data']);
        unset($_SESSION['sendto']);
        unset($_SESSION['billto']);
        unset($_SESSION['shipping']);
        unset($_SESSION['payment']);
        unset($_SESSION['comments']);
        
        if (is_object($order_total_modules)) {
            $order_total_modules->clear_posts();
        }

        if (is_object($zco_notifier)) {
            $zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_PROCESS');
        }
    }
    
    /**
     * Check order status and update if needed
     * 
     * @param array $status_data
     */
    function check_status($status_data)
    {
        require_once(dirname(__FILE__) . '/../../../ext/modules/payment/sofort/services/Communication.php');
        $communication = new Communication($this);
        $communication->handleSofortStatusUpdate($status_data);
    }

    /**
     * Sofort communication wrapper
     *
     * @param order $order
     * @return string
     */
    function payment_request(order $order, $orderId)
    {
        global $order, $order_totals;
        require_once(dirname(__FILE__) . '/../../../ext/modules/payment/sofort/services/Communication.php');
        
        $communication = new Communication($this);

        $communication->paymentRequest($order, $this->get_shop_total($order_totals, $order), $orderId);
        
        if ($communication->isValid()) {
            $success = true;
            $_SESSION['sofort_transaction_id'] = $communication->getTransactionId();
            $url = $communication->getPaymentRedirect();
        } else {
            $success = false;
            $errors = $communication->getErrors();
            
            $url = zen_href_link(
                FILENAME_CHECKOUT_PAYMENT, 'step=step2', 'SSL', true, false
            ) . '&payment_error=' . $this->code . '&error=' . $errors[0]['code'];
        }
        
        return array('success' => $success, 'url' => $url);
    }

    /**
     * Plugin installation routine
     * 
     * @global queryFactory $db
     * @global type $messageStack
     * @return null|string
     */
    function install()
    {
        global $db, $messageStack;

        if (defined('MODULE_PAYMENT_SOFORT_SU_STATUS')) {
            $messageStack->add_session(MODULE_PAYMENT_SOFORT_SU_INSTALL_ERROR, 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=sofort_su', 'SSL'));
            return 'failed';
        }

        include(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/sofort_su.php');

        include(DIR_FS_CATALOG . 'includes/sofort_states.php');
        
        $this->install_states();
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_STATUS_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_STATUS_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_STATUS', 'False', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY', '', '6', '0', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, use_function, set_function, date_added) values ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ZONE_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ZONE_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_ZONE', '0', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_TEMP_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_TITLE) .
                "', 'MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_ABORTED_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID_DESC) .
                "', '6', '35', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_CONFIRMED_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_PROF_SETTINGS_TITLE) .
                "', 'MODULE_PAYMENT_SOFORT_PROF_SETTINGS', " .
                "'', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_PROF_SETTINGS_DESC) . "', '6', '20', 'zen_cfg_select_option(array(),', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_CHECK_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_SV_PAID_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_REFUNDED_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_TITLE) .
                "'  , 'MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID', '" .
                $db->prepareInput($this->get_state_id(MODULE_PAYMENT_SOFORT_REFUNDED_ENGLISH)) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID_DESC) .
                "', '6', '30', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER', 'False', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_key, configuration_value, configuration_description,  configuration_group_id, sort_order, set_function, date_added)
                VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_TITLE) . "' , " .
                "'MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT', " . 
                "'False','" . 
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT_DESC)."', '6', '5', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_LOGO_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_LOGO_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_LOGO', 'Banner', '6', '1', 'zen_cfg_select_option(array(\'Text\', \'Banner\'), ', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION', 'False', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REASON_ONE_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REASON_ONE_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_REASON_ONE', '{{transaction}}', '6', '1', 'zen_cfg_select_option(array(\'{{transaction}}\', \'{{customer_id}}\'), ', now())");
        
        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REASON_TWO_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_REASON_TWO_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_REASON_TWO', '', '6', '0', now())");

        $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
                " (configuration_title, configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_SORT_ORDER_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_SORT_ORDER', '0', '6', '0', now())");
                
       $db->Execute("INSERT INTO " . $db->prepareInput(TABLE_CONFIGURATION) .
               " (configuration_title,  configuration_description, configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_COUNTRIES_TITLE) . "', '" .
                $db->prepareInput(MODULE_PAYMENT_SOFORT_SU_COUNTRIES_DESC) .
                "', 'MODULE_PAYMENT_SOFORT_SU_COUNTRIES', 'DE,AT,CH,BE,GB,NL,IT,PL,FR,ES', '6', '0', now())");
                
        $db->Execute("CREATE TABLE IF NOT EXISTS `". DB_PREFIX . "pi_sofort_transaction` ("
          . "`id` int(11) NOT NULL AUTO_INCREMENT,"
          . "`order_id` text NOT NULL,"
          . "`transaction_id` text NOT NULL,"
          . "PRIMARY KEY (`id`)"
        . ") AUTO_INCREMENT=1");

        return null;
    }
    
    /**
     * Install states
     */
    function install_states()
    {
        $this->add_order_state('MODULE_PAYMENT_SOFORT_TEMP_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_SV_UNPAID_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_SV_PAID_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_CONFIRMED_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_UNCONFIRMED_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_CANCELED_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_ABORTED_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_CHECK_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_REFUNDED_');
        $this->add_order_state('MODULE_PAYMENT_SOFORT_UNCHANGED_');
    }
 			
    /**
     * Return given state id (check if the given state exist, otherwise create it)
     * 
     * @global queryFactory $db
     * @param string $order_state
     * @return int
     */
    function add_order_state($order_state)
    {
        global $db;
        $check_query = $db->Execute("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" . $db->prepareInput(constant($order_state . 'ENGLISH')) . "' LIMIT 1");
        
        if ($check_query->RecordCount() < 1) {
            $status_query = $db->Execute("SELECT MAX(orders_status_id) AS status_id FROM " . TABLE_ORDERS_STATUS);

            $status_id = $status_query->fields['status_id'] + 1;

            $languages = zen_get_languages();

            foreach ($languages as $lang) {
                $state = $order_state . strtoupper($lang['directory']);

                if (!defined($state)) {
                    $state = $order_state . 'ENGLISH';
                }

                $db->Execute(
                    "INSERT INTO " . TABLE_ORDERS_STATUS . " "
                  . "(orders_status_id, language_id, orders_status_name) "
                  . "VALUES ('" 
                    . $status_id . "', '" 
                    . $lang['id'] . "', '" 
                    . $db->prepareInput(constant($state))
                  . "')"
                );
            }

            $flags_query = $db->Execute("DESCRIBE " . TABLE_ORDERS_STATUS . " public_flag");
            if ($flags_query->RecordCount() == 1) {
                $db->Execute("UPDATE " . TABLE_ORDERS_STATUS . " SET public_flag = 0 AND downloads_flag = 0 WHERE orders_status_id = '" . $status_id . "'");
            }

        }
    }
    
    /**
     * Get id from the given state name
     * 
     * @global queryFactory $db
     * @param string $order_state
     * @return int
     */
    function get_state_id($order_state) 
    {
        global $db;
        $check_query = $db->Execute("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" . $db->prepareInput($order_state) . "' LIMIT 1");
        return $check_query->fields['orders_status_id'];
    }

    /**
     * Plugin deinstall routine
     * 
     * @global queryFactory $db
     */
    function remove()
    {
        global $db;
        $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode("', '", $this->keys()) . "')");
    }

    /**
     * Get list of the plugin config keys
     * 
     * @return array
     */
    function keys()
    {
        return array(
            'MODULE_PAYMENT_SOFORT_SU_STATUS',
            'MODULE_PAYMENT_SOFORT_SU_CONFIGURATION_KEY',
            'MODULE_PAYMENT_SOFORT_SU_RECOMMENDED_PAYMENT',
            'MODULE_PAYMENT_SOFORT_SU_LOGO',
            'MODULE_PAYMENT_SOFORT_SU_CUSTOMER_PROTECTION',
            'MODULE_PAYMENT_SOFORT_SU_REASON_ONE',
            'MODULE_PAYMENT_SOFORT_SU_REASON_TWO',
            'MODULE_PAYMENT_SOFORT_SU_ZONE',
            'MODULE_PAYMENT_SOFORT_SU_SORT_ORDER',
            'MODULE_PAYMENT_SOFORT_SU_COUNTRIES',
            'MODULE_PAYMENT_SOFORT_PROF_SETTINGS',
            'MODULE_PAYMENT_SOFORT_SU_CREATE_ORDER',
            'MODULE_PAYMENT_SOFORT_SU_ORDER_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_ABORTED_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_PEN_NOT_CRE_YET_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_LOS_NOT_CRE_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_REC_CRE_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_REF_COM_STATUS_ID',
            'MODULE_PAYMENT_SOFORT_SU_REF_REF_STATUS_ID',
            
        );
    }

}
