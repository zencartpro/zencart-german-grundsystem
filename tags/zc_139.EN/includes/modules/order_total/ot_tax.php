<?php
/**
 * ot_tax order-total module
 *
 * @package orderTotal
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
  class ot_tax {
    var $title, $output;

    function ot_tax() {
      $this->code = 'ot_tax';
      $this->title = MODULE_ORDER_TOTAL_TAX_TITLE;
      $this->description = MODULE_ORDER_TOTAL_TAX_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_TAX_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;

      reset($order->info['tax_groups']);
      $taxDescription = '';
      $taxValue = 0;
      while (list($key, $value) = each($order->info['tax_groups'])) {
        if (SHOW_SPLIT_TAX_CHECKOUT == 'true')
        {
          if ($value > 0 or STORE_TAX_DISPLAY_STATUS == 1) {
            $this->output[] = array('title' => $key . ':',
                                    'text' => $currencies->format($value, true, $order->info['currency'], $order->info['currency_value']),
                                    'value' => $value);
          }
        } else 
        {
          if ($value > 0)
          {
            $taxDescription .= $key . ' + ';
            $taxValue += $value;
          }
        }
      }
      if (SHOW_SPLIT_TAX_CHECKOUT != 'true' && ($taxValue > 0 or STORE_TAX_DISPLAY_STATUS == 1))
      {
        $this->output[] = array(
                        'title' => substr($taxDescription, 0 , strlen($taxDescription)-3) . ':' , 
                        'text' => $currencies->format($taxValue, true, $order->info['currency'], $order->info['currency_value']) , 
                        'value' => $taxValue);
      }
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_TAX_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_TAX_STATUS', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER');
    }

    function install() {
	  global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('This module is installed', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '300', 'Sort order of display.', '6', '2', now())");
    }

    function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>