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

class payone_vor {
    var $code, $title, $description, $enabled, $poDebug;
      function payone_vor() {
        global $db, $order;
	    $this->code = 'payone_vor';
        if(!defined('MODULE_PAYMENT_PAYONE_DEBUG')){
            $this->poDebug = 0;
        } else {
            $this->poDebug = MODULE_PAYMENT_PAYONE_DEBUG;
        }
        
        $this->db = $db;
        $this->order = $order;
	      $this->title = MODULE_PAYMENT_PAYONE_VOR_TEXT_TITLE;
	      $this->description = MODULE_PAYMENT_PAYONE_VOR_TEXT_DESCRIPTION;
	      $this->sort_order = MODULE_PAYMENT_PAYONE_VOR_SORT_ORDER;
	      $this->enabled = ((MODULE_PAYMENT_PAYONE_VOR_STATUS == 'True') ? true : false);

        if ((int)MODULE_PAYMENT_PAYONE_VOR_ORDER_STATUS_ID > 0) {
	    $this->order_status = MODULE_PAYMENT_PAYONE_VOR_ORDER_STATUS_ID;
        }
        if (is_object($this->order)) $this->update_status();
        $this->form_action_url = 'https://www.payone.de/frontend/';
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
    }

    function update_status() {
        if (($this->enabled == true) && ((int)MODULE_PAYMENT_PAYONE_VOR_ZONE > 0)) {
            $check_flag = false;
            $check_query = $this->db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYONE_VOR_ZONE . "' and zone_country_id = '" . $this->order->billing['country']['id'] . "' order by zone_id");
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
    }
    function javascript_validation() {
        return false;
    }

    function selection() {
        $tmp_array = array('id' => $this->code, 'module' => $this->title, 'fields' => array());
        #array_push($tmp_array['fields'], array('title' => MODULE_PAYMENT_PAYONE_VOR_CLEARING_TYPE_VOR, 'field' => zen_draw_radio_field('payone_clearingtype', 'vor', '', "id='payone_vor' class='payone_pay'")));

        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return $tmp_array;
    }

    function pre_confirmation_check() {
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return false;
    }

    function get_error() {
        $error = array('title' => MODULE_PAYMENT_PAYONE_VOR_ERROR_HEADING,
            'error' => stripslashes(urldecode($_GET['error'])));
        return $error;
    }

    function confirmation() {
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return false;
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
        $hsh = md5($hsh_string . $this->order->info['currency'] . MODULE_PAYMENT_PAYONE_VOR_KEY);
        $process_button_string .= " <!-- hsh:'" . $hsh_string . $this->order->info['currency'] . "' --> ";
        $process_button_string =
        zen_draw_hidden_field('portalid', MODULE_PAYMENT_PAYONE_VOR_PORTALID) .
        zen_draw_hidden_field('aid', MODULE_PAYMENT_PAYONE_VOR_AID) .
        zen_draw_hidden_field('request', MODULE_PAYMENT_PAYONE_VOR_REQUEST) .
        zen_draw_hidden_field('display_name', MODULE_PAYMENT_PAYONE_VOR_DISPLAY_NAME) .
        zen_draw_hidden_field('display_address', MODULE_PAYMENT_PAYONE_VOR_DISPLAY_ADDRESS) .
        zen_draw_hidden_field('reference', time()) .
        zen_draw_hidden_field('clearingtype', 'vor') .
        zen_draw_hidden_field('mode', MODULE_PAYMENT_PAYONE_VOR_MODE) .
        zen_draw_hidden_field('hsh', $hsh) .
        zen_draw_hidden_field('param', zen_session_id()) .
        zen_draw_hidden_field('currency', $this->order->info['currency']) .
        zen_draw_hidden_field('amount', $TotalAmount) ;

        $language_code = $_SESSION['languages_code'];
        $process_button_string .=
        zen_draw_hidden_field('testMode', MODULE_PAYMENT_PAYONE_VOR_MODE) .
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

        $x = mysql_escape_string($sql) . 'ORDER::' . print_r($this->order, true) . 'SESSION' . print_r($_SESSION, true);
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
            $check_query = $this->db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYONE_VOR_STATUS'");
            $this->_check = $check_query->RecordCount();
        }
        return $this->_check;
    }

    function install() {
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable PAYONE Module', 'MODULE_PAYMENT_PAYONE_VOR_STATUS', 'True', 'Do you want to accept PAYONE payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYONE_VOR_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYONE PortalID', 'MODULE_PAYMENT_PAYONE_VOR_PORTALID', '0000000', 'Your PortalID at PAYONE', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PAYONE AID', 'MODULE_PAYMENT_PAYONE_VOR_AID', '00000', 'Your AccountID at PAYONE', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant key', 'MODULE_PAYMENT_PAYONE_VOR_KEY', '', 'Your own Merchant Key', '6', '2', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Request', 'MODULE_PAYMENT_PAYONE_VOR_REQUEST', 'authorization', 'authorization:   Forderung wird sofort eingezogen (Vorgabe) <br />preauthorization:  Forderung wird später eingezogen (per API oder PMI)', '6', '1', 'zen_cfg_select_option(array(\'authorization\', \'preauthorization\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mode', 'MODULE_PAYMENT_PAYONE_VOR_MODE', 'test', 'The mode you are working in (test = Test Mode, live = Live Payment', '6', '5', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYONE_VOR_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Name', 'MODULE_PAYMENT_PAYONE_VOR_DISPLAY_NAME', 'yes', 'Show the customers name in the payment window again?', '6', '1', 'zen_cfg_select_option(array(\'yes\', \'no\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display address', 'MODULE_PAYMENT_PAYONE_VOR_DISPLAY_ADDRESS', 'yes', 'Show the customers address in the payment window again?', '6', '1', 'zen_cfg_select_option(array(\'yes\', \'no\'), ', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYONE_VOR_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Payment methods', 'MODULE_PAYMENT_PAYONE_VOR_CLEARINGTYPES', 'elv', 'Select allowed payment methods (f.e. \"cc;elv\")', '6', '1', now())");
        $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_PAYMENT_PAYONE_VOR_DEBUG', 'MODULE_PAYMENT_PAYONE_VOR_DEBUG', '0', 'MODULE_PAYMENT_PAYONE_VOR_DEBUG', '6', '1', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now())");
        if(!existTable('rl_log')){
            $sql = 'CREATE TABLE `rl_log` (
                      `id` int(11) NOT NULL auto_increment,
                      `filename` varchar(150) NOT NULL,
                      `comment` text NOT NULL,
                      `get` text NOT NULL,
                      `post` text NOT NULL,
                      PRIMARY KEY  (`id`)
                    )';
            $this->db->execute($sql);
        }
        if(!existTable('po_transactions')){
            $sql = "CREATE TABLE `po_transactions` (
                      `txid` int(11) NOT NULL default '0',
                      `memo` text NOT NULL,
                      `param` varchar(255) NOT NULL default '',
                      `po_userid` mediumint(8) unsigned NOT NULL default '0',
                      `amount` float(3,2) NOT NULL default '0.00',
                      `clearingtype` varchar(8) NOT NULL default '',
                      `txtime` int(11) NOT NULL default '0',
                      `po_accessid` mediumint(8) unsigned NOT NULL default '0',
                      `portalid` mediumint(8) unsigned NOT NULL default '0',
                      `productid` mediumint(8) unsigned NOT NULL default '0',
                      `aid` smallint(5) unsigned NOT NULL default '0',
                      `status` varchar(15) NOT NULL default '',
                      `failedcause` varchar(10) NOT NULL default '',
                      `failedcost` float(4,2) NOT NULL default '0.00',
                      `balance` float(4,2) NOT NULL default '0.00',
                      `orders_id` int(11) NOT NULL,
                      PRIMARY KEY  (`txid`)
                    )";
            $this->db->execute($sql);
        }
        if(defined('TABLE_CONFIGURATION_LANGUAGE') && existTable(TABLE_CONFIGURATION_LANGUAGE)){
            $sql = "INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE . " (`configuration_key`, `configuration_language_id`, `configuration_title`, `configuration_description`) VALUES
                        ('MODULE_PAYMENT_PAYONE_VOR_AID', 43, '" . MODULE_PAYMENT_PAYONE_AID . "', '" . MODULE_PAYMENT_PAYONE_AID_DESC . "'),
                        ('MODULE_PAYMENT_PAYONE_VOR_CLEARINGTYPES', 43, 'Payment methods', 'Select allowed payment methods (f.e. \"cc;elv\")'),
                        ('MODULE_PAYMENT_PAYONE_VOR_DEBUG', 43, '" . MODULE_PAYMENT_PAYONE_DEBUG . "', '" . MODULE_PAYMENT_PAYONE_DEBUG_DESC . "'),
                        ('MODULE_PAYMENT_PAYONE_VOR_DISPLAY_ADDRESS', 43, '" . MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS . "', '" . MODULE_PAYMENT_PAYONE_DISPLAY_ADDRESS_DESC . "'),
                        ('MODULE_PAYMENT_PAYONE_VOR_DISPLAY_NAME', 43, '" . MODULE_PAYMENT_PAYONE_DISPLAY_NAME . "', '" . MODULE_PAYMENT_PAYONE_DISPLAY_NAME_DESC . "'),
                        ('MODULE_PAYMENT_PAYONE_VOR_KEY', 43, '" . MODULE_PAYMENT_PAYONE_KEY . "', '" . MODULE_PAYMENT_PAYONE_KEY . "'),
                        ('MODULE_PAYMENT_PAYONE_VOR_MODE', 43, 'Modus', 'Live oder Test-Modus auswählen (test = Testmodus, live = Live Zahlung'),
                        ('MODULE_PAYMENT_PAYONE_VOR_ORDER_STATUS_ID', 43, 'Bestell-Status', 'Bestellstatus nach erfolgreicher Bestellung'),
                        ('MODULE_PAYMENT_PAYONE_VOR_PORTALID', 43, 'PAYONE PortalID', 'Ihre PAYONE PortalID'),
                        ('MODULE_PAYMENT_PAYONE_VOR_REQUEST', 43, 'Forderung', 'authorization:   Forderung wird sofort eingezogen (Vorgabe) <br />preauthorization:  Forderung wird später eingezogen (per API oder PMI)'),
                        ('MODULE_PAYMENT_PAYONE_VOR_SORT_ORDER', 43, 'Sort order of display.', 'Sort order of display. Lowest is displayed first.'),
                        ('MODULE_PAYMENT_PAYONE_VOR_STATUS', 43, 'PAYONE Module aktivieren', 'Wollen Sie PAYONE-Vorkasse als Zahlungsmittel aktivieren?'),
                        ('MODULE_PAYMENT_PAYONE_VOR_ZONE', 43, 'Payment Zone', 'If a zone is selected, only enable this payment method for that zone.');";
            $this->db->execute($sql);
        }
    }

    function remove() {
        $this->db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
        if(defined('TABLE_CONFIGURATION_LANGUAGE') && existTable(TABLE_CONFIGURATION_LANGUAGE)){
            $this->db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
        }
    }

    function keys() {
        return array('MODULE_PAYMENT_PAYONE_VOR_STATUS', 'MODULE_PAYMENT_PAYONE_VOR_ZONE', 'MODULE_PAYMENT_PAYONE_VOR_PORTALID', 'MODULE_PAYMENT_PAYONE_VOR_AID', 'MODULE_PAYMENT_PAYONE_VOR_KEY', 'MODULE_PAYMENT_PAYONE_VOR_REQUEST', 'MODULE_PAYMENT_PAYONE_VOR_MODE', 'MODULE_PAYMENT_PAYONE_VOR_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYONE_VOR_DISPLAY_NAME', 'MODULE_PAYMENT_PAYONE_VOR_DISPLAY_ADDRESS', 'MODULE_PAYMENT_PAYONE_VOR_SORT_ORDER', 'MODULE_PAYMENT_PAYONE_VOR_CLEARINGTYPES', 'MODULE_PAYMENT_PAYONE_VOR_DEBUG');
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

    function html_print_r($object) {
        $output = "<!-- " . print_r($object, true) . " -->";
        $js = '<script language="javascript"  type="text/javascript">';
        $js .= "//alert('PayOne')";
        $js .= '</script>';
        $output .= $js;
        $this->rlWriteLog(__FILE__, __FUNCTION__ . ' :: ' . __LINE__);
        return $output;
    }

}
