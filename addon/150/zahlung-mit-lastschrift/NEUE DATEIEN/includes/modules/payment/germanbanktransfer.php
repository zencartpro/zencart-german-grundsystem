<?php
/**
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: germanbanktransfer.php multilanguage for ZC150 german 2012-01-10 webchills $
 */
  
  class germanbanktransfer {
    var $code, $title, $description, $enabled;

// class constructor
    function germanbanktransfer() {
      global $order;

      $this->code = 'germanbanktransfer';
      $this->title = MODULE_PAYMENT_GERMANBT_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_GERMANBT_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_GERMANBT_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_GERMANBT_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_GERMANBT_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_GERMANBT_ORDER_STATUS_ID;
      }
      if (is_object($order)) $this->update_status();

        $this->email_footer = MODULE_PAYMENT_GERMANBT_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
	  global $db;
      global $order, $customer_id;
      
      // check country
        $dest_country = $order->billing['country']['iso_code_2'];
        $dest_zone = 0;
        $error = false;
        $countries_table = MODULE_PAYMENT_GERMANBT_COUNTRIES; 
        $country_zones = split("[,]", $countries_table);
        if (in_array($dest_country, $country_zones)) {
            $dest_zone = $i;
            $this->enabled = true;
        } else {
            $this->enabled = false;
        }


      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_GERMANBT_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_GERMANBT_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
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

	  // check banktransfer after x times
  	  if (MODULE_PAYMENT_GERMANBT_ENABLE_AFTER == 'true'){
	  $customer_id = $_SESSION['customer_id'];
	  $sql = 'SELECT count(*) as total from ' . TABLE_ORDERS . ' WHERE customers_id='.$customer_id.' AND orders_status =' . MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_ORDER_STATUS .'';
      $result = $db -> Execute($sql);

	  $total = $result -> fields['total'];
	  if (($total+1) < MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_TIMES) {
		$this->enabled = false;
       }
	  }
	  // end check banktransfer after x times

// disable the module if the order only contains virtual products
	  // start änderung
      /*if ($this->enabled == true) {
        if ($order->content_type == 'virtual') {
          $this->enabled = false;
        }
      }*/
	  // ende änderung
    }

    function javascript_validation() {
      $js = 'if (payment_value == "' . $this->code . '") {' . "\n" .
            '  var banktransfer_blz = document.checkout_payment.banktransfer_blz.value;' . "\n" .
            '  var banktransfer_number = document.checkout_payment.banktransfer_number.value;' . "\n" .
            '  var banktransfer_owner = document.checkout_payment.banktransfer_owner.value;' . "\n" ;

    if (MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION =='true'){
      $js .='  var banktransfer_fax = document.checkout_payment.banktransfer_fax.checked;' . "\n" .
            '  if (banktransfer_fax == false) {' . "\n" ;
    }
      $js .='    if (banktransfer_owner == "") {' . "\n" .
            '      error_message = error_message + "' . JS_GERMANBT_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (banktransfer_blz == "") {' . "\n" .
            '      error_message = error_message + "' . JS_GERMANBT_BLZ . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (banktransfer_number == "") {' . "\n" .
            '      error_message = error_message + "' . JS_GERMANBT_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" ;
    if (MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION =='true'){
      $js .='  }' . "\n" ;
    }
      $js .='}' . "\n";
      return $js;
    }

    function selection() {
      global $order;//, $gbt_array, $gbt_number;
        $gbt_array =& $_SESSION['gbt_array']; 
        $gbt_number =& $_SESSION['gbt_number']; 

      $selection = array('id' => $this->code,
                         'module' => $this->title,
      	                 'fields' => array(array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE_NOTE,
      	                                         'field' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_ACCEPTANCE),      
      	                                   array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_OWNER,
      	                                         'field' => zen_draw_input_field('banktransfer_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
      	                                   array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_BLZ,
      	                                         'field' => zen_draw_input_field('banktransfer_blz', $gbt_array["bt_blz"], 'size="8" maxlength="8"')),
      	                                   array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_NUMBER,
      	                                         'field' => zen_draw_input_field('banktransfer_number', $gbt_number, 'size="16" maxlength="32"')),
//      	                                 array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_NAME,
//      	                                       'field' => zen_draw_input_field('banktransfer_bankname', $gbt_array["bt_bankname"])),
                                           array('title' => MODULE_PAYMENT_GERMANBT_TEXT_NOTE,
      	                                         'field' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_INFO),  
      	                                          array('title' => '',
      	                                         'field' => zen_draw_hidden_field('recheckok', $gbt_array["recheckok"]))
      	                                   ));

      if (MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION =='true'){
        $selection['fields'][] = array('title' => MODULE_PAYMENT_GERMANBT_TEXT_NOTE,
      	                               'field' => MODULE_PAYMENT_GERMANBT_TEXT_NOTE2 . '<a href="' . MODULE_PAYMENT_GERMANBT_URL_NOTE . '" target="_blank"><b>' . MODULE_PAYMENT_GERMANBT_TEXT_NOTE3 . '</b></a>' . MODULE_PAYMENT_GERMANBT_TEXT_NOTE4);
      	$selection['fields'][] = array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_FAX,
      	                               'field' => zen_draw_checkbox_field('banktransfer_fax', 'on'));

      }

      return $selection;
    }

    function pre_confirmation_check(){
//      global $gbt_array, $gbt_number;

        $gbt_array =& $_SESSION['gbt_array']; 
        $gbt_number =& $_SESSION['gbt_number']; 


      if ($_POST['banktransfer_fax'] == false) {
        include(DIR_WS_CLASSES . 'banktransfer_validation.php');

        $banktransfer_validation = new AccountCheck;
        $banktransfer_result = $banktransfer_validation->CheckAccount($_POST['banktransfer_number'], $_POST['banktransfer_blz']);

error_log("banktransfer_result: " . $banktransfer_result, 3, "/tmp/beadboxx.log");

        $gbt_number = $banktransfer_validation->banktransfer_number;
        $gbt_array = array("bt_owner" => $_POST['banktransfer_owner'],
                          "bt_blz" => $banktransfer_validation->banktransfer_blz,
                          "bt_prz" => $banktransfer_validation->PRZ,
                          "bt_status" => $banktransfer_result);
//print_r ($gbt_array);
        if ($banktransfer_validation->Bankname != '')
          $gbt_array["bt_bankname"] =  $banktransfer_validation->Bankname;
        else
          $gbt_array["bt_bankname"] = $_POST['banktransfer_bankname'];



       if ($banktransfer_result > 0 ||  $_POST['banktransfer_owner'] == '') {
          if ($_POST['banktransfer_owner'] == '') {
            $error = 'Name des Kontoinhabers fehlt!';
            $recheckok = '';
          } else {
            switch ($banktransfer_result) {
              case 1: // number & blz not ok
                $error = MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_1;
                $recheckok = 'true';
                break;
              case 5: // BLZ not found
                $error = MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_5;
                $recheckok = 'true';
                break;
              case 8: // no blz entered
                $error = MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_8;
               break;
              case 9: // no number entered
                $error = MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_9;
                break;
              default:
                $error = MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR_4;
                $recheckok = 'true';
                break;
            }
          }

          if ($_POST['recheckok'] != "true") {
            $gbt_array['recheckok'] = $recheckok;
            $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) ;

            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'NONSSL', true, false));
          }
        }
      } else {
        $gbt_array = array("bt_owner" => $_POST['banktransfer_owner'],
                          "bt_fax" => true);
      }
    }

    function confirmation() {
//      global $gbt_array, $gbt_number;
        $gbt_array =& $_SESSION['gbt_array']; 
        $gbt_number =& $_SESSION['gbt_number']; 

      if (!$_POST['banktransfer_owner'] == '') {
        $confirmation = array('title' => $this->title,
                              'fields' => array(array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_OWNER,
                                                      'field' => $gbt_array["bt_owner"]),
                                                array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_BLZ,
                                                      'field' => $gbt_array["bt_blz"]),
                                                array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_NUMBER,
                                                      'field' => $gbt_number),
                                                array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_NAME,
                                                      'field' => $gbt_array["bt_bankname"])
                                                ));
      }
      if ($gbt_array["bt_fax"] == true) {
        $confirmation = array('fields' => array(array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_FAX)));
      }
      return $confirmation;
    }

    function process_button() {
      return false;

    }

    function before_process() {
      return false;
    }

    function after_process() {
      global $insert_id; //, $gbt_number, $gbt_array;
        $gbt_array =& $_SESSION['gbt_array']; 
        $gbt_number =& $_SESSION['gbt_number']; 
      // $_POST, $banktransfer_val, $banktransfer_owner, $banktransfer_bankname, $_POST['banktransfer_number'], $_POST['banktransfer_number'], $banktransfer_status, $banktransfer_prz, $banktransfer_fax, $checkout_form_action, $checkout_form_submit;

//      $db->Execute("INSERT INTO banktransfer (orders_id, banktransfer_blz, banktransfer_bankname, banktransfer_number, banktransfer_owner, banktransfer_status, banktransfer_prz) VALUES ('" . $insert_id . "', '" . $gbt_array['bt_blz'] . "', '" . $gbt_array['bt_bankname'] . "', '" . $gbt_number . "', '" . $gbt_array['bt_owner'] ."', '" . $gbt_array['bt_status'] ."', '" . $gbt_array['bt_prz'] ."')");
// ('" . $insert_id . "', '" . $gbt_array['bt_blz'] . "', '" . $gbt_array['bt_bankname'] . "', '" . $gbt_number . "', '" . $gbt_array['bt_owner'] ."', '" . $gbt_array['bt_status'] ."', '" . $gbt_array['bt_prz'] ."')");
      $sql_data_array = array('orders_id' => $insert_id,
                              'banktransfer_blz' => $gbt_array['bt_blz'],
                              'banktransfer_bankname' => $gbt_array['bt_bankname'],
                              'banktransfer_number' => $gbt_number,
                              'banktransfer_owner' => $gbt_array['bt_owner'],
                              'banktransfer_status' => $gbt_array['bt_status'],
                              'banktransfer_prz' => $gbt_array['bt_prz']);

      if ($gbt_array['bt_fax'] == true)
        $sql_data_array ["banktransfer_fax"] = $gbt_array['bt_fax'];

      zen_db_perform(TABLE_GERMANBT, $sql_data_array);

      unset($gbt_array);
      unset($gbt_number);
//      zen_session_unregister('gbt_array');
//      zen_session_unregister('gbt_number');

    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_GERMANBT_TEXT_BANK_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_GERMANBT_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }
	
    function install() {
		   global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Activate direct debiting?', 'MODULE_PAYMENT_GERMANBT_STATUS', 'True', 'Do you want to offer direct debiting for German bank accounts?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_GERMANBT_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order:', 'MODULE_PAYMENT_GERMANBT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)values ('Get Bank codes from database?', 'MODULE_PAYMENT_GERMANBT_DATABASE_BLZ', 'true', 'Should we search in the database for the bank codes? It is strongly recommended to set this to true! Make sure that you have imported the bank codes before into the table banktransfer_blz!', '6', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Order Status:', 'MODULE_PAYMENT_GERMANBT_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value.', '6', '5', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key,configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)values ('Allow data via Fax?', 'MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION', 'false', 'Should customers to be able to send their data via fax?', '6', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Fax-URL','MODULE_PAYMENT_GERMANBT_URL_NOTE', 'fax.html', 'Your HTML template for the fax. Must be placed in shop root.', '6', '7', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Activate Direct debiting starting with x order?', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER', 'false', 'Do you want to allow direct debiting after x orders? ', '6', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Direct debiting starting with order x', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_TIMES', '3', 'How many times the customer has to order before he can use direct debiting?', '6', '9', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Order status for qualifying', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_ORDER_STATUS', '3', 'Which order status must the orders have to qualify for direct debiting?', '6', '10', 'zen_cfg_pull_down_order_statuses(','zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Countries', 'MODULE_PAYMENT_GERMANBT_COUNTRIES', 'DE', 'Enter the countries for which you want to offer German banktransfer. Two digit ISO codes, comma separated.', '6', '11', now());");
      // www.zen-cart-pro.at languages_id==43 START
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zahlung per Lastschrift aktivieren?', 'MODULE_PAYMENT_GERMANBT_STATUS', '43', 'Wollen Sie Zahlung per Lastschrift anbieten?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Zone', 'MODULE_PAYMENT_GERMANBT_ZONE', '43', 'Wenn Sie hier eine Zone angeben, ist Lastschrift nur für Kunden mit Rechnungsadresse in dieser Zone möglich.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_PAYMENT_GERMANBT_SORT_ORDER', '43', 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Datenbankbasierte BLZ Abfrage?', 'MODULE_PAYMENT_GERMANBT_DATABASE_BLZ', '43', 'Sollen die Bankleitzahlen in der Datenbank gesucht werden? (empfohlen!) Stellen Sie sicher, dass die Tabelle banktransfer_blz existiert und mit Inhalt befüllt wurde!', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bestellstatus', 'MODULE_PAYMENT_GERMANBT_ORDER_STATUS_ID', '43', 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Lastschrift bezahlt werden?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Daten per Fax erlauben?', 'MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION', '43', 'Möchten Sie erlauben, dass die Kunden Ihre Zahlungsdaten per Fax senden?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Fax-URL', 'MODULE_PAYMENT_GERMANBT_URL_NOTE', '43', 'Die HTML Vorlage für das Fax. Muss im Shopverzeichnis liegen.', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Lastschrift ab x-ter Bestellung möglich?', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER', '43', 'Möchten Sie die Zahlung per Lastschrift erst nach der x-ten Bestellung erlauben?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Lastschrift ab Bestellung x', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_TIMES', '43', 'Lastschrift ab welcher Bestellung erlauben?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Status der Bestellung für die Berechnung', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_ORDER_STATUS', '43', 'Welchen Bestellstatus sollen Bestellungen haben, damit sie für die Lastschrift in Frage kommen?', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Länder', 'MODULE_PAYMENT_GERMANBT_COUNTRIES', '43', 'Geben Sie hier die Länder an, für die Lastschrift möglich sein soll. Da ohnehin nur deutsche Konten möglich sind, ist es am besten, hier nur DE zu lassen.<br/>Zweistellige ISO-Codes durch Komma getrennt!', now())");   
      // www.zen-cart-pro.at languages_id==43  END
      $db->Execute("CREATE TABLE IF NOT EXISTS " . TABLE_GERMANBT . " (orders_id int(11) NOT NULL default '0', banktransfer_owner varchar(64) default NULL, banktransfer_number varchar(24) default NULL, banktransfer_bankname varchar(255) default NULL, banktransfer_blz varchar(8) default NULL, banktransfer_status int(11) default NULL, banktransfer_prz char(2) default NULL, banktransfer_fax char(2) default NULL, KEY orders_id(orders_id))");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      // www.zen-cart-pro.at languages_id == delete all
      $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_GERMANBT_STATUS', 'MODULE_PAYMENT_GERMANBT_ZONE', 'MODULE_PAYMENT_GERMANBT_COUNTRIES', 'MODULE_PAYMENT_GERMANBT_ORDER_STATUS_ID', 'MODULE_PAYMENT_GERMANBT_SORT_ORDER', 'MODULE_PAYMENT_GERMANBT_DATABASE_BLZ', 'MODULE_PAYMENT_GERMANBT_FAX_CONFIRMATION', 'MODULE_PAYMENT_GERMANBT_URL_NOTE', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER','MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_TIMES', 'MODULE_PAYMENT_GERMANBT_ENABLE_AFTER_ORDER_STATUS');
    }
  }
?>
