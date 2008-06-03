<?php
/**
 * ot_total order-total module
 *
 * @package orderTotal
 * @desc map_shop generates google_map entries at http://shops.zen-cart.at
 * @copyright Copyright 2008 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
 */
  class ot_webchills {
    var $title, $output;

    function ot_webchills() {
      $this->code = 'ot_webchills';
      $this->title = MODULE_ORDER_TOTAL_WEBCHILLS_TITLE;
      $this->description = MODULE_ORDER_TOTAL_WEBCHILLS_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_WEBCHILLS_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;
      
      
      $paymentType = $GLOBALS['payment_modules']->selected_module;
      #$paymentType = 'cc';
      $country = $order->delivery['country']['iso_code_2'];
      $pym = explode(',', MODULE_ORDER_TOTAL_WEBCHILLS_PAYMENT);
      $pa = array();
      foreach ($pym as $key => $value) {
          $t = explode(':', $value);
          $type = $t[0];
          $iso = $t[1];
          $pa[$type][$iso]['limit'] = $t[2];
          $pa[$type][$iso]['cost'] = $t[3];
      }
      if(!isset($pa[$paymentType][$country]) && isset($pa[$paymentType]['DEF'])){
        $pa[$paymentType][$country] = $pa[$paymentType]['DEF'];
      }
      if(isset($pa[$paymentType][$country])){
            if($order->info['subtotal'] < $pa[$paymentType][$country]['limit'] || $pa[$paymentType][$country]['limit']==-1){
                $low_order_fee = $pa[$paymentType][$country]['cost'];
            }
            $order->info['tax'] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['tax_groups']["$tax_description"] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['total'] += $low_order_fee + zen_calculate_tax($low_order_fee, $tax);
            if (DISPLAY_PRICE_WITH_TAX == 'true') {
              $low_order_fee += zen_calculate_tax($low_order_fee, $tax);
            }
            if($low_order_fee>0){
                $this->output[] = array('title' => $this->title . ':',
                                        'text' => $currencies->format($low_order_fee, true, $order->info['currency'], $order->info['currency_value']),
                                        'value' => $low_order_fee);
            }
      }
      #rldp($pa[$paymentType][$country], 'COUNTRY_LIMIT');
      #echo "LAND: $country   TYPE: $paymentType";
      #rldp($pa, 'ALL');
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = "select configuration_value
                        from " . TABLE_CONFIGURATION . "
                        where configuration_key = 'MODULE_ORDER_TOTAL_WEBCHILLS_STATUS'";

        $check_query = $db->Execute($check_query);
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_WEBCHILLS_STATUS', 'MODULE_ORDER_TOTAL_WEBCHILLS_SORT_ORDER', 'MODULE_ORDER_TOTAL_WEBCHILLS_PAYMENT');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('This module is installed', 'MODULE_ORDER_TOTAL_WEBCHILLS_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_WEBCHILLS_SORT_ORDER', '444', 'Sort order of display.', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('WebChill', 'MODULE_ORDER_TOTAL_WEBCHILLS_PAYMENT', 'cc:AT:-1:6,cc:DEF:-1:8.6,cod:AT:75:6', 'cc:AT:100:6,cc:DEF:-1:8.6  ==> creditcard payment allways charged with 8.6 except Austria; at a limit of 100.-- its free', '6', '9', 'zen_cfg_textarea(', now())");
        if (defined('TABLE_CONFIGURATION_LANGUAGE')) {
          $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_description, configuration_language_id) values ('Installiert', 'MODULE_ORDER_TOTAL_WEBCHILLS_STATUS', '', '43')");
          $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_description, configuration_language_id) values ('Sortierung', 'MODULE_ORDER_TOTAL_WEBCHILLS_SORT_ORDER', 'Sortierung.', '43')");
          $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE . " (configuration_title, configuration_key, configuration_description, configuration_language_id) values ('WebChill', 'MODULE_ORDER_TOTAL_WEBCHILLS_PAYMENT', 'cc:AT:100:6,cc:DEF:-1:8.6  ==> creditcard payment allways charged with 8.6 except Austria; at a limit of 100.-- its free', '43')");
        }
    }

    
    function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>