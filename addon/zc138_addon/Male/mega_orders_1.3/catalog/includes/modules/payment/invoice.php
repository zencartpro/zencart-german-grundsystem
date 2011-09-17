<?php
/*
  $Id: invoice.php,v 1.25 2003/02/19 02:14:00 harley_vb Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/
// code to zen cart by MultimediArts 14.10.2005
// modified for Zen-Cart 1.3.7 by Hugo13
// bugfixed by MaleBorg

  class invoice {
    var $code, $title, $description, $enabled;

// class constructor
    function invoice() {
      global $order;
      $this->code = 'invoice';
      $this->title = MODULE_PAYMENT_INVOICE_TEXT_TITLE;
      if (IS_ADMIN_FLAG === true && (MODULE_PAYMENT_INVOICE_PAYTO == 'the Store Owner/Website Name' || MODULE_PAYMENT_INVOICE_PAYTO == '')) $this->title .= '<span class="alert"> (not configured - needs pay-to)</span>';
      $this->description = MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_INVOICE_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_INVOICE_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID;
        $payment='invoice';
      } else {
        if ($payment=='invoice') {
          $payment='';
        }
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;
	  
      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_INVOICE_ZONE > 0) ) {
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
	  
	  // start �nderung
  	  $customer_id = $_SESSION['customer_id']; // Modifkation Hugo 13
	  
	  $test_query = $db->Execute("select count(*) as total from " . TABLE_ORDERS . " where customers_id='" . $customer_id . "' AND orders_status=3");
	  $total = $test_query->fields['total']; // Modifikation Hugo 13

	  if (($total+1) < MODULE_PAYMENT_INVOICE_FROM_ORDER) {
		$this->enabled = false;
	  }
	  // ende �nderung

// disable the module if the order only contains virtual products
	  // start �nderung
      /*if ($this->enabled == true) {
        if ($order->content_type == 'virtual') {
          $this->enabled = false;
        }
      }*/
	  // ende �nderung
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
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Rechnung', 'MODULE_PAYMENT_INVOICE_STATUS', 'True', 'Wollen Sie Zahlungen per Rechnung anbieten?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Bankverbindung:', 'MODULE_PAYMENT_INVOICE_PAYTO', 'the Store Owner/Website Name', 'Auf welches Konto soll &uuml;berwiesen werden?', '6', '1', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone f&uuml;r Rechnungen', 'MODULE_PAYMENT_INVOICE_ZONE', '0', 'Wenn Sie eine Zone ausw&auml;hlen, wird diese Zahlungsweise nur in dieser Zone angeboten.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Reihenfolge der Anzeige', 'MODULE_PAYMENT_INVOICE_SORT_ORDER', '1', 'Niedrigste wird zuerst angezeigt.', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Order Status', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', '0', 'Festlegung des Status f&uuml;r Bestellungen, welche mit dieser Zahlungsweise durchgef&uuml;hrt werden.', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Stammkunden', 'MODULE_PAYMENT_INVOICE_FROM_ORDER', '3', 'Rechnung ab x-ter Bestellung m&ouml;glich', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zahlungsziel in Tagen', 'MODULE_PAYMENT_INVOICE_PAYDAY', '14', 'Zahlungsziel in Tagen', '6', '0', now())");
    }

    function remove() {
	      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
	  // start �nderung
      /*return array('MODULE_PAYMENT_INVOICE_STATUS', 'MODULE_PAYMENT_INVOICE_ZONE', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', 'MODULE_PAYMENT_INVOICE_SORT_ORDER');*/
	  return array('MODULE_PAYMENT_INVOICE_STATUS', 'MODULE_PAYMENT_INVOICE_ZONE', 'MODULE_PAYMENT_INVOICE_ORDER_STATUS_ID', 'MODULE_PAYMENT_INVOICE_SORT_ORDER','MODULE_PAYMENT_INVOICE_FROM_ORDER','MODULE_PAYMENT_INVOICE_PAYTO','MODULE_PAYMENT_INVOICE_PAYDAY');
	  // ende �nderung
    }
  }
?>