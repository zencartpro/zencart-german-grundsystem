<?php
/**
* @copyright Copyright 2003-2010 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* $Id: bar.php 582 2010-05-21 17:32:20Z webchills $
*/

  class bar {
    var $code, $title, $description, $enabled, $payment;

// class constructor
    function bar() {
      global $order;
      $this->code = 'bar';
      $this->title = MODULE_PAYMENT_BAR_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_BAR_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_BAR_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_BAR_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_BAR_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BAR_ORDER_STATUS_ID;
        $payment='bar';
      } else {
        if ($payment=='bar') {
          $payment='';
        }
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_BAR_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $db;
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_COD_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_COD_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
      
      
// Deaktivieren wenn Versandart ~ Tabellarische Versandkosten
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'table') !=0) {
$this->enabled = false;
}
}
// Deaktivieren wenn Versandart ~ Versandkosten nach Zonen
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'zones') !=0) {
$this->enabled = false;
}
}
// Deaktivieren wenn Versandart ~ Versandpauschale
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'flat') !=0) {
$this->enabled = false;
}
}

// Deaktivieren wenn Versandart ~ Versandkosten pro Stück
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'item') !=0) {
$this->enabled = false;
}
}

// Deaktivieren wenn Versandart ~ Versandkosten per Gewicht
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'perweightunit') !=0) {
$this->enabled = false;
}
}

// Deaktivieren wenn Versandart ~ Versandkostenfrei
if ($this->enabled == true) {
if (substr_count($_SESSION['shipping']['id'], 'freeshipper') !=0) {
$this->enabled = false;
}
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
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Cash by fetch Module', 'MODULE_PAYMENT_BAR_STATUS', 'True', 'Do you want to accept Cash by fetch payments?', '6', '7', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_BAR_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_BAR_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
// www.zen-cart.at languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bar bei Abholung anbieten?', 'MODULE_PAYMENT_BAR_STATUS', '43', 'Wollen Sie Barzahlung bei Abholung aktivieren?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_BAR_SORT_ORDER', '43', 'Anzuzeigende Sortierreihenfolge. Die Niedrigste wird zuerst angezeigt.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zone', 'MODULE_PAYMENT_BAR_ZONE', '43', 'Wenn Sie hier eine Zone auswählen, wird Barzahlung bei Abholung nur in dieser Zone angeboten.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Bar bei Abholung bezahlt werden?', now())");
// www.zen-cart.at languages_id==43  END
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
// www.zen-cart.at languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_BAR_STATUS', 'MODULE_PAYMENT_BAR_ZONE', 'MODULE_PAYMENT_BAR_ORDER_STATUS_ID', 'MODULE_PAYMENT_BAR_SORT_ORDER');
    }
  }
?>
