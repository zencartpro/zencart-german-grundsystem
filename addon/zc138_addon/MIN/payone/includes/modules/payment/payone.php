<?php
/**
*
* @package payment
* @copyright Copyright 2008 rainer langheiter, http://edv.langheiter.com
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
*
* Title: PAYONE
* $Id$
* 
* 2008-06-09: added request param
*/

class payone {
    var $code, $title, $description, $enabled, $poDebug;
    function payone() {
        global $db, $order;
        $this->code = 'payone';
        if(!defined('MODULE_PAYMENT_PAYONE_DEBUG')){
            $this->poDebug = 0;
        } else {
            $this->poDebug = MODULE_PAYMENT_PAYONE_DEBUG;
        }
        
        $this->db = $db;
        $this->order = $order;
        $this->title = MODULE_PAYMENT_PAYONE_TEXT_TITLE;
        $this->description = MODULE_PAYMENT_PAYONE_TEXT_DESCRIPTION;
        $this->sort_order = MODULE_PAYMENT_PAYONE_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_PAYONE_STATUS == 'True') ? true : false);

        if ((int)MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID > 0) {
            $this->order_status = MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID;
        }
        if (is_object($this->order)) $this->update_status();
        $this->form_action_url = 'https://www.payone.de/frontend/';
        if (isset($_SESSION['payone_clearingtype'])) {
            $this->title = MODULE_PAYMENT_PAYONE_TEXT_TITLE . " ({$_SESSION['payone_clearingtype']})";
        }
    }

    function rlWriteLog($filename, $comment) {
        if ($this->poDebug) {
            $filename = str_replace('/var/www/html/shop.musto-onlineshop.com/', ':', $filename);
            $g = print_r($_GET, true);
            $p = print_r($_POST, true);
            $dat = date('Y.m.d  H:i:s');
            $comment = $dat . '  ' . $comment;
            $sql = "INSERT INTO rl_log (`id`, `filename`, `comment`, `get`, `post`)
                        VALUES (NULL, '$filename', '$comment', '$g', '$p');";
            $this->db->execute($sql);
        }
    }
    function update_status() {
        if (($this->enabled == true) && ((int)MODULE_PAYMENT_PAYONE_ZONE > 0)) {
            $check_flag = false;
            $check_query = $this->db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYONE_ZONE . "' and zone_country_id = '" . $this->order->billing['country']['id'] . "' order by zone_id");
            while ($check = zen_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $this->order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }
            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        $_SESSION['payone_clearingtype'] = $_POST['payone_clearingtype'];
    }
    function javascript_validation() {
        return false;
    }

    function selection() {
        $tmp_array = array('id' => $this->code, 'module' => $this->title, 'fields' => array());
        if (strpos(MODULE_PAYMENT_PAYONE_CLEARINGTYPES, "cc") !== false) array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_CLEARING_TYPE_CC, 'field' => zen_draw_radio_field('payone_clearingtype', 'cc', '', "id='payone_cc' class='payone_pay'")));
        if (strpos(MODULE_PAYMENT_PAYONE_CLEARINGTYPES, "elv") !== false) array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_CLEARING_TYPE_ELV, 'field' => zen_draw_radio_field('payone_clearingtype', 'elv', '', "id='payone_elv' class='payone_pay'")));
        if (strpos(MODULE_PAYMENT_PAYONE_CLEARINGTYPES, "rec") !== false) array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_CLEARING_TYPE_REC, 'field' => zen_draw_radio_field('payone_clearingtype', 'rec', '', "id='payone_rec' class='payone_pay'")));
        if (strpos(MODULE_PAYMENT_PAYONE_CLEARINGTYPES, "vor") !== false) array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_CLEARING_TYPE_VOR, 'field' => zen_draw_radio_field('payone_clearingtype', 'vor', '', "id='payone_vor' class='payone_pay'")));
        if (strpos(MODULE_PAYMENT_PAYONE_CLEARINGTYPES, "sb") !== false) array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_CLEARING_TYPE_SB, 'field' => zen_draw_radio_field('payone_clearingtype', 'sb', '', "id='payone_sb' class='payone_pay'")));

        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return $tmp_array;
    }

    function pre_confirmation_check() {
        if (empty($_POST['payone_clearingtype'])) {
            $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode(MODULE_PAYMENT_PAYONE_CLEARING_TYPE_ERROR);
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
        }
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return false;
    }

    function get_error() {
        $error = array('title' => MODULE_PAYMENT_PAYONE_ERROR_HEADING,
            'error' => stripslashes(urldecode($_GET['error'])));
        return $error;
    }

    function confirmation() {
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return false;
    }

    function html_print_r($object) {
        $output = "<!-- " . print_r($object, true) . " -->";
        $js = '<script language="javascript"  type="text/javascript">';
        $js .= "//alert('PayOne')";
        $js .= '</script>';
        $output .= $js;
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return $output;
    }

    function process_button() {
        global $currencies, $customer_id ;
        // Multi Currency - Set up variable
        // $product_query.=$this->html_print_r($this->order);
        $pid = 1;
        $OrderAmount = 0;
        $hsh_string = "";
        foreach($this->order->products as $product) {
            // $price = intval(zen_round($product['final_price'] / $product['qty'] * (1 + $product['tax'] / 100) * 100 * $currencies -> get_value($_SESSION['currency']), 0));
            $price = round($product['final_price'] * (1 + $product['tax'] / 100) * 100 * $currencies->get_value($_SESSION['currency']), 0);
            if ($product['tax'] == 0) $product['tax'] = "0";
            $p = split(':', $product['id']);
            $pr = $p[0];
            $product_query .= zen_draw_hidden_field('no[' . $pid . ']', $product['qty']);
            $product_query .= zen_draw_hidden_field('id[' . $pid . ']', $pr);
            $product_query .= zen_draw_hidden_field('pr[' . $pid . ']', $price);
            // $product_query .= zen_draw_hidden_field('ti[' . $pid . ']', $product['model']);
            $product_query .= zen_draw_hidden_field('de[' . $pid . ']', $product['name']);
            $product_query .= zen_draw_hidden_field('va[' . $pid . ']', $product['tax']);
            $hsh_string .= $pr . $product['qty'] . $price . $product['tax'];
            $OrderAmount += ($price * $product['qty']);
            $pid++;
        }

        $TotalAmount = intval(zen_round($this->order->info['total'] * 100 * $currencies->get_value($_SESSION['currency']), 0));
        if ($TotalAmount != $OrderAmount) {
            $product_query .= zen_draw_hidden_field('no[' . $pid . ']', 1);
            $product_query .= zen_draw_hidden_field('id[' . $pid . ']', 9999);
            $product_query .= zen_draw_hidden_field('pr[' . $pid . ']', intval($TotalAmount - $OrderAmount));
            $product_query .= zen_draw_hidden_field('ti[' . $pid . ']', "");
            $product_query .= zen_draw_hidden_field('de[' . $pid . ']', $this->order->info['shipping_method']);
            $product_query .= zen_draw_hidden_field('va[' . $pid . ']', "0");
            $hsh_string .= "9999" . "1" . intval($TotalAmount - $OrderAmount) . "0";
        }
        $hsh = md5($hsh_string . $this->order->info['currency'] . MODULE_PAYMENT_PAYONE_KEY);
        $process_button_string .= " <!-- hsh:'" . $hsh_string . $this->order->info['currency'] . "' --> ";
        // Multi Currency - ver 1.3
        $process_button_string =
        zen_draw_hidden_field('portalid', MODULE_PAYMENT_PAYONE_PORTALID) .
        zen_draw_hidden_field('aid', MODULE_PAYMENT_PAYONE_AID) .
        zen_draw_hidden_field('request', MODULE_PAYMENT_PAYONE_REQUEST) .
        zen_draw_hidden_field('display_name', MODULE_PAYMENT_PAYONE_DISPLAY_NAME) .
        zen_draw_hidden_field('display_address', MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS) .
        zen_draw_hidden_field('reference', time()) .
        zen_draw_hidden_field('clearingtype', $_POST['payone_clearingtype']) .
        zen_draw_hidden_field('mode', MODULE_PAYMENT_PAYONE_MODE) .
        zen_draw_hidden_field('hsh', $hsh) .
        zen_draw_hidden_field('param', zen_session_id()) .
        zen_draw_hidden_field('currency', $this->order->info['currency']) .
        zen_draw_hidden_field('amount', $TotalAmount) ;

        $language_code = $_SESSION['languages_code'];
        $process_button_string .=
        zen_draw_hidden_field('testMode', MODULE_PAYMENT_PAYONE_MODE) .
        zen_draw_hidden_field('firstname', $this->order->customer['firstname']) .
        zen_draw_hidden_field('lastname', $this->order->customer['lastname']) .
        zen_draw_hidden_field('street', $this->order->customer['street_address']) .
        zen_draw_hidden_field('zip', $this->order->customer['postcode']) .
        zen_draw_hidden_field('city', $this->order->customer['city']) .
        zen_draw_hidden_field('country', $this->order->customer['country']['iso_code_2']) .
        zen_draw_hidden_field('email', $this->order->customer['email_address']) .
        zen_draw_hidden_field('set_lang', $_SESSION['languages_code']);
        $process_button_string .= $product_query;
        $s = $this->order->info['currency'];
        $s .= print_r($currencies, true);
        $s .= print_r($_SESSION, true);
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__ . '  ' . $s);
        return $process_button_string ;
    }

    function before_process() {
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
    }

    function after_process() {
        $tmp = zen_session_id();
        $oid = $_SESSION['order_number_created'];
        $sql = "UPDATE po_transactions
                    SET orders_id = '$oid'
                    WHERE param='$tmp'";
        $this->db->Execute($sql);

        $x = mysql_escape_string($sql);
        $x .= 'ORDER::' . print_r($this->order, true);
        $x .= 'SESSION' . print_r($_SESSION, true);
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__ . ' :: ' . $x);

        if (SESSION_RECREATE == 'True') {
            zen_session_recreate();
        }

        return false;
    }

    function output_error() {
        return false;
    }

    function check() {
        if (!isset($this->_check)) {
            $check_query = $this->db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYONE_STATUS'");
            $this->_check = $check_query->RecordCount();
        }
        return $this->_check;
    }

    function install() {
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable PAYONE Module', 'MODULE_PAYMENT_PAYONE_STATUS', 'True', 'Do you want to accept PAYONE payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYONE_DEBUG', 'MODULE_PAYMENT_PAYONE_DEBUG', '0', 'MODULE_PAYMENT_PAYONE_DEBUG', '6', '1', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYONE PortalID', 'MODULE_PAYMENT_PAYONE_PORTALID', '0000000', 'Your PortalID at PAYONE', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYONE AID', 'MODULE_PAYMENT_PAYONE_AID', '00000', 'Your AccountID at PAYONE', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant key', 'MODULE_PAYMENT_PAYONE_KEY', '', 'Your own Merchant Key', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Name', 'MODULE_PAYMENT_PAYONE_DISPLAY_NAME', 'yes', 'Show the customers name in the payment window again?', '6', '1', 'zen_cfg_select_option(array(\'yes\', \'no\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display address', 'MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS', 'yes', 'Show the customers address in the payment window again?', '6', '1', 'zen_cfg_select_option(array(\'yes\', \'no\'), ', now())");
        //request
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Request', 'MODULE_PAYMENT_PAYONE_REQUEST', 'authorization', 'authorization:   Forderung wird sofort eingezogen (Vorgabe) <br />preauthorization:  Forderung wird später eingezogen (per API oder PMI)', '6', '1', 'zen_cfg_select_option(array(\'authorization\', \'preauthorization\'), ', now())");
        
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mode', 'MODULE_PAYMENT_PAYONE_MODE', 'test', 'The mode you are working in (test = Test Mode, live = Live Payment', '6', '5', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Payment methods', 'MODULE_PAYMENT_PAYONE_CLEARINGTYPES', 'elv', 'Select allowed payment methods (f.e. \"cc;elv\")', '6', '1', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYONE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYONE_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    }

    function remove() {
        $this->db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
        return array('MODULE_PAYMENT_PAYONE_DEBUG', 'MODULE_PAYMENT_PAYONE_STATUS', 'MODULE_PAYMENT_PAYONE_REQUEST', 'MODULE_PAYMENT_PAYONE_PORTALID', 'MODULE_PAYMENT_PAYONE_AID', 'MODULE_PAYMENT_PAYONE_KEY', 'MODULE_PAYMENT_PAYONE_MODE', 'MODULE_PAYMENT_PAYONE_ZONE', 'MODULE_PAYMENT_PAYONE_SORT_ORDER', 'MODULE_PAYMENT_PAYONE_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYONE_DISPLAY_NAME', 'MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS', 'MODULE_PAYMENT_PAYONE_CLEARINGTYPES');
    }
}
