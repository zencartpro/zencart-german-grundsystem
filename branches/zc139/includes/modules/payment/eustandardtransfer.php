<?php
/**
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: eustandardtransfer.php,v 1.4.1 2003/09/25 19:57:14 lopo Exp $
 * @version $Id: eustandardtransfer.php, ZC v1.3.8 2008-04-15 MENTAT
 * @version $Id: eustandardtransfer.php with zone option multilanguage 571 2010-04-29 08:36:14 webchills $
*/

  class eustandardtransfer {
    var $code, $title, $description, $enabled;

// class constructor
    function eustandardtransfer() {
      global $order;
    
      $this->code = 'eustandardtransfer';
      $this->title = MODULE_PAYMENT_EUTRANSFER_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_EUTRANSFER_SORT_ORDER;
      $this->email_footer = MODULE_PAYMENT_EUTRANSFER_TEXT_EMAIL_FOOTER;
      $this->enabled = ((MODULE_PAYMENT_EUTRANSFER_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID;
      }
      
      if (is_object($order)) $this->update_status();
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_EUTRANSFER_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_EUTRANSFER_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      global $HTTP_POST_VARS;

      $confirmation = array('title' => $this->title . ': ' . $this->check,
                            'fields' => array(array('title' => MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION)));

      return $confirmation;
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

    function output_error() {
      return false;
    }
function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_EUTRANSFER_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }


    function install() {
	global $db;
	
       $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Bank Transfer Payment', 'MODULE_PAYMENT_EUTRANSFER_STATUS', 'True', 'Do you want to accept bank transfer order payments?', '6', '3', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Name', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', '---', 'Your full bank name', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Account Name', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', '---', 'The name associated with the account.', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Account No.', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', '---', 'Your account number.', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Code', 'MODULE_PAYMENT_EUTRANSFER_BLZ', '---', 'Your Bank Code', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank Account IBAN', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '---', 'International account id.<br>(ask your bank if you don\'t know it)', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bank BIC/SWIFT', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', '---', 'International bank id.<br>(ask your bank if you don\'t know it)', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Module Sort order of display.', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
			// www.zen-cart-pro.at r.l. languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Vorauskasse per Banküberweisung anbieten?', 'MODULE_PAYMENT_EUTRANSFER_STATUS', '43', 'Wollen Sie Vorauskasse per Banküberweisung aktivieren?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bank Name', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', '43', 'Tragen Sie hier den Namen Ihrer Bank ein', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Kontoinhaber', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', '43', 'Tragen Sie hier den Namen des Kontoinhabers ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Kontonummer', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', '43', 'Tragen Sie hier Ihre Kontonummer ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bankleitzahl', 'MODULE_PAYMENT_EUTRANSFER_BLZ', '43', 'Tragen Sie hier die Bankleitzahl ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('IBAN', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '43', 'Tragen Sie hier Ihre IBAN ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('BIC/SWIFT', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', '43', 'Tragen Sie hier Ihren BIC/SWIFT Code ein.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', '43', 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Banküberweisung bezahlt werden?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', '43', 'Wenn Sie hier eine Zone angeben, ist Banküberweisung nur für Kunden mit Rechnungsadresse in dieser Zone möglich. Es empfiehlt sich dafür eine Zone anzulegen, die nur die Länder mit EURO enthält.', now())");   
			// www.zen-cart-pro.at r.l. languages_id==43  END
   }
  function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      // www.zen-cart-pro.at r.l. languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
	
    function keys() {
      $keys = array('MODULE_PAYMENT_EUTRANSFER_STATUS', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', 'MODULE_PAYMENT_EUTRANSFER_BLZ',  'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', 
					'MODULE_PAYMENT_EUTRANSFER_BANKBIC', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER' , 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID' , 'MODULE_PAYMENT_EUTRANSFER_ZONE');

      return $keys;
    }
  }
?>
