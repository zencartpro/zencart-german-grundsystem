<?php
/**
* @copyright Copyright 2003-2019 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
* $Id: bar.php 2019-06-22 09:17:20Z webchills $
*/

  class bar {
    var $code, $title, $description, $enabled, $payment;

// class constructor
    function __construct() {
      global $order;
      $this->code = 'bar';
      $this->title = MODULE_PAYMENT_BAR_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_BAR_TEXT_DESCRIPTION;
      $this->sort_order = defined('MODULE_PAYMENT_BAR_SORT_ORDER') ? MODULE_PAYMENT_BAR_SORT_ORDER : null;
      $this->enabled = (defined('MODULE_PAYMENT_BAR_STATUS') && MODULE_PAYMENT_BAR_STATUS == 'True');     

      if (null === $this->sort_order) return false;

      if ((int)MODULE_PAYMENT_BAR_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BAR_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_BAR_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;
      
 
 // check country
        $dest_country = isset ($order->billing['country']['iso_code_2']) ? $order->billing['country']['iso_code_2'] : 0 ;
        $dest_zone = 0;
        $error = false;
        $countries_table = MODULE_PAYMENT_BAR_COUNTRIES; 
        $country_zones = explode(",", $countries_table);
        if (in_array($dest_country, $country_zones)) {
            $dest_zone = $i;
            $this->enabled = true;
        } else {
            $this->enabled = false;
        }
        
// disable for various shipping methods -  add more if you use other shipping methods
  
  if (preg_match('#(table)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }
    
  if (preg_match('#(zones)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }
    
  if (preg_match('#(perweightunit)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }
    
  if (preg_match('#(freeshipper)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }
    
  if (preg_match('#(flat)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }
    
  if (preg_match('#(item)#i', $_SESSION['shipping']['id'])) {
      $this->enabled = false;
    }    
      
  

  
      
      
      
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_BAR_TEXT_DESCRIPTION);
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BAR_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Cash by fetch Module', 'MODULE_PAYMENT_BAR_STATUS', 'True', 'Do you want to accept Cash by fetch payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_BAR_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '2', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '4', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Countries', 'MODULE_PAYMENT_BAR_COUNTRIES', 'DE', 'Enter the countries for which you want to offer cash by fetch. Two digit ISO codes, comma separated.', '6', '5', now());");
// www.zen-cart-pro.at languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bar bei Abholung anbieten?', 'MODULE_PAYMENT_BAR_STATUS', '43', 'Wollen Sie Barzahlung bei Abholung aktivieren?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_BAR_SORT_ORDER', '43', 'Anzuzeigende Sortierreihenfolge. Die Niedrigste wird zuerst angezeigt.', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Bar bei Abholung bezahlt werden?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Länder', 'MODULE_PAYMENT_BAR_COUNTRIES', '43', 'Geben Sie hier die Länder an, für die Bar bei Abholung möglich sein soll.<br/>Zweistellige ISO-Codes durch Komma getrennt!', now())");   
// www.zen-cart-pro.at languages_id==43  END
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
// www.zen-cart.at languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_BAR_STATUS', 'MODULE_PAYMENT_BAR_ZONE', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', 'MODULE_PAYMENT_BAR_SORT_ORDER','MODULE_PAYMENT_BAR_COUNTRIES');
    }
  }