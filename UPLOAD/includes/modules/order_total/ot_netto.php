<?php
/**
 * ot_netto order-total module
 * Zen Cart German Specific 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ot_netto.php 2022-02-11 18:46:16Z webchills $
 */
class ot_netto extends base
{
    public    $code,
              $title,
              $description,
              $sort_order,
              $output;
    protected $_check;

    public function __construct() 
    {
      global $order, $currencies;
      $this->code = 'ot_netto';
      $this->title = MODULE_ORDER_TOTAL_NETTO_TITLE;
      $this->description = MODULE_ORDER_TOTAL_NETTO_DESCRIPTION; 
      $this->enabled = (defined('MODULE_ORDER_TOTAL_NETTO_STATUS') && MODULE_ORDER_TOTAL_NETTO_STATUS == 'True'); 
      $this->sort_order = defined('MODULE_ORDER_TOTAL_NETTO_SORT_ORDER') ? (int)MODULE_ORDER_TOTAL_NETTO_SORT_ORDER : null;
        if (null === $this->sort_order) {
            return false;
        }
      $this->output = array();
    }

    public function process() 
    {
      global $order, $currencies;
      $Tax_total = 0; 

      reset($order->info['tax_groups']);
      foreach($order->info['tax_groups'] as $key => $value) {      
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

    public function check() 
    {
    global $db;
      if (!isset($this->_check)) {
            $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_ORDER_TOTAL_NETTO_STATUS' LIMIT 1");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    public function keys() 
    {

      return array('MODULE_ORDER_TOTAL_NETTO_STATUS', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER');
    }

    public function install() 
    {
    global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display net amount?', 'MODULE_ORDER_TOTAL_NETTO_STATUS', 'true', 'Do you want to display the net amount?', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER', '299', 'Sort order of display.', '6', '6', now())");
    // www.zen-cart-pro.at german admin languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Nettobetrag anzeigen?', 'MODULE_ORDER_TOTAL_NETTO_STATUS', '43', 'Wollen Sie den Nettobetrag anzeigen?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Anzeigereihenfolge', 'MODULE_ORDER_TOTAL_NETTO_SORT_ORDER', '43', 'Anzeigereihenfolge', now())");
    }

    public function remove() 
    {
    global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
       // www.zen-cart-pro.at german admin languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }