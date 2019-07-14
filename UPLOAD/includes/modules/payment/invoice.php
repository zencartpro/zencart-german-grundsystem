<?php
/**
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: invoice.php 2019-06-24 20:19:14 webchills $
*/

  class invoice {
    var $code, $title, $description, $enabled;

// class constructor
    function __construct() {
      global $order;
      $this->code = 'invoice';
      $this->title = MODULE_PAYMENT_INVOICE_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION;
      $this->sort_order = defined('MODULE_PAYMENT_INVOICE_SORT_ORDER') ? MODULE_PAYMENT_INVOICE_SORT_ORDER : null;
      $this->enabled = (defined('MODULE_PAYMENT_INVOICE_STATUS') && MODULE_PAYMENT_INVOICE_STATUS == 'True'); 

      if (null === $this->sort_order) return false;

      if ((int)MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;
	  
      if ($this->enabled && (int)MODULE_PAYMENT_INVOICE_ZONE > 0 && isset($order->billing['country']['id'])) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_INVOICE_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
	  
	  $customer_id = $_SESSION['customer_id']; 
	  
	  $test_query = $db->Execute("select count(*) as total from " . TABLE_ORDERS . " where customers_id='" . $customer_id . "' AND orders_status=3");
	  $total = $test_query->fields['total']; 

	  if (($total+1) < MODULE_PAYMENT_INVOICE_FROM_ORDER) {
		$this->enabled = false;
	  }
	  
    }
	

// class methods
    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check(){
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION);
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
      	
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_INVOICE_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }
    
    
    function install() {
	    global $db;
      
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Payment by invoice', 'MODULE_PAYMENT_INVOICE_STATUS', 'True', 'Do you want to enable payment by invoice?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Name:', 'MODULE_PAYMENT_INVOICE_BANKNAM', '---', 'Your full bank name', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Account Holder:', 'MODULE_PAYMENT_INVOICE_ACCNAM', '---', 'The name associated with the account.', '6', '1', now());");
  
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBAN:', 'MODULE_PAYMENT_INVOICE_ACCIBAN', '---', 'Your IBAN', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('BIC/SWIFT:', 'MODULE_PAYMENT_INVOICE_BANKBIC', '---', 'Your BIC', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_INVOICE_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_PAYMENT_INVOICE_SORT_ORDER', '1', 'Niedrigste wird zuerst angezeigt.', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Order Status', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Nur für Stammkunden?', 'MODULE_PAYMENT_INVOICE_FROM_ORDER', '3', 'Ab der wievielten Bestellung soll Zahlung auf Rechnung möglich sein?', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zahlungsziel in Tagen', 'MODULE_PAYMENT_INVOICE_PAYDAY', '14', 'Tragen Sie hier das Zahlungsziel in Tagen ein.', '6', '0', now())");
      // www.zen-cart-pro.at german admin languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zahlung auf Rechnung anbieten?', 'MODULE_PAYMENT_INVOICE_STATUS', '43', 'Wollen Sie Zahlung auf Rechnung aktivieren?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bank Name', 'MODULE_PAYMENT_INVOICE_BANKNAM', '43', 'Tragen Sie hier den Namen Ihrer Bank ein', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Kontoinhaber', 'MODULE_PAYMENT_INVOICE_ACCNAM', '43', 'Tragen Sie hier den Namen des Kontoinhabers ein.', now())");
     
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('IBAN', 'MODULE_PAYMENT_INVOICE_ACCIBAN', '43', 'Tragen Sie hier Ihre IBAN ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('BIC/SWIFT', 'MODULE_PAYMENT_INVOICE_BANKBIC', '43', 'Tragen Sie hier Ihren BIC/SWIFT Code ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_INVOICE_SORT_ORDER', '43', 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Rechnung bezahlt werden?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zone', 'MODULE_PAYMENT_INVOICE_ZONE', '43', 'Wenn Sie hier eine Zone angeben, ist Zahlung auf Rechnung nur für Kunden mit Rechnungsadresse in dieser Zone möglich.', now())"); 
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Nur für Stammkunden?', 'MODULE_PAYMENT_INVOICE_FROM_ORDER', '43', 'Ab der wievielten Bestellung soll Zahlung auf Rechnung möglich sein?', now())");   
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zahlungsziel in Tagen', 'MODULE_PAYMENT_INVOICE_PAYDAY', '43', 'Tragen Sie hier das Zahlungsziel in Tagen ein.', now())"); 
    }

    function remove() {
	      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      // www.zen-cart-pro.at german admin languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
	  
	  return array('MODULE_PAYMENT_INVOICE_STATUS', 'MODULE_PAYMENT_INVOICE_ZONE', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', 'MODULE_PAYMENT_INVOICE_SORT_ORDER','MODULE_PAYMENT_INVOICE_FROM_ORDER','MODULE_PAYMENT_INVOICE_PAYDAY','MODULE_PAYMENT_INVOICE_BANKNAM','MODULE_PAYMENT_INVOICE_ACCNAM','MODULE_PAYMENT_INVOICE_ACCNUM','MODULE_PAYMENT_INVOICE_BLZ','MODULE_PAYMENT_INVOICE_ACCIBAN','MODULE_PAYMENT_INVOICE_BANKBIC');
	  
    }
  }