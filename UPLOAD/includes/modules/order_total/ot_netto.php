<?php
/**
 * ot_netto order-total module
 *
 * @package orderTotal
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_netto.php 731 2012-02-21 18:49:16Z webchills $
 */

  class ot_netto {
    var $title, $output;

    function ot_netto() {
      $this->code = 'ot_netto';
      $this->title = MODULE_ORDER_TOTAL_NETTO_TITLE;
      $this->description = MODULE_ORDER_TOTAL_NETTO_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_NETTO_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_NETTO_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;
      $Tax_total = 0;

      reset($order->info['tax_groups']);
      while (list($key, $value) = each($order->info['tax_groups'])) {
        // sum all tax values to calculate total tax:
        if ($value > 0) $Tax_total += $value;
      }
      
      // subtract total tax from total invoice amount to calculate net amount:
      $Netto = $order->info['total']-$Tax_total;
      
      // output net amount:
      $this->output[] = array('title' => $this->title . ':',
                        'text' => $currencies->format($Netto, true, $order->info['currency'], $order->info['currency_value']),
                        'value' => $Netto);
    }

    function check() {
    global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_NETTO_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_NETTO_STATUS', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER');
    }

    function install() {
    global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display net amount?', 'MODULE_ORDER_TOTAL_NETTO_STATUS', 'true', 'Do you want to display the net amount?', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER', '299', 'Sort order of display.', '6', '6', now())");
    // www.zen-cart-pro.at german admin languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Nettobetrag anzeigen?', 'MODULE_ORDER_TOTAL_NETTO_STATUS', '43', 'Wollen Sie den Nettobetrag anzeigen?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Anzeigereihenfolge', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER', '43', 'Anzeigereihenfolge', now())");
    }

    function remove() {
    global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
       // www.zen-cart-pro.at german admin languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>
