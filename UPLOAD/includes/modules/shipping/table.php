<?php
/**
 * Zen Cart German Specific 
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: table.php 2022-01-11 16:08:16Z webchills $
 */
/**
 * Enter description here...
 *
 */
class table extends base {
  /**
   * Enter description here...
   *
   * @var string
   */
  var $code;
  /**
   * Enter description here...
   *
   * @var string
   */
  var $title;
  /**
   * Enter description here...
   *
   * @var string
   */
  var $description;
  /**
   * Enter description here...
   *
   * @var string
   */
  var $icon;
  /**
   * Enter description here...
   *
   * @var boolean
   */
  var $enabled;
  /**
   * Enter description here...
   *
   * @return table
   */
  function __construct() {
    global $db;

    $this->code = 'table';
    $this->title = MODULE_SHIPPING_TABLE_TEXT_TITLE;
    $this->description = MODULE_SHIPPING_TABLE_TEXT_DESCRIPTION;
    $this->sort_order = defined('MODULE_SHIPPING_TABLE_SORT_ORDER') ? MODULE_SHIPPING_TABLE_SORT_ORDER : null;
    if (null === $this->sort_order) return false;

    $this->icon = '';
    $this->tax_class = MODULE_SHIPPING_TABLE_TAX_CLASS;
    $this->tax_basis = MODULE_SHIPPING_TABLE_TAX_BASIS;
    // disable only when entire cart is free shipping
    if (zen_get_shipping_enabled($this->code)) {
      $this->enabled = (MODULE_SHIPPING_TABLE_STATUS == 'True');
    }

    if ($this->enabled) {
      // check MODULE_SHIPPING_TABLE_HANDLING_METHOD is in
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_TABLE_HANDLING_METHOD'");
      if ($check_query->EOF) {
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Handling Per Order or Per Box', 'MODULE_SHIPPING_TABLE_HANDLING_METHOD', 'Order', 'Do you want to charge Handling Fee Per Order or Per Box?', '6', '0', 'zen_cfg_select_option(array(\'Order\', \'Box\'), ', now())");
      }
    }

    $this->update_status();
  }

  /**
   * Perform various checks to see whether this module should be visible
   */
  function update_status() {
    global $order, $db;
    if (!$this->enabled) return;
    if (IS_ADMIN_FLAG === true) return;

    if ((int)MODULE_SHIPPING_TABLE_ZONE > 0) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . "
                             where geo_zone_id = '" . MODULE_SHIPPING_TABLE_ZONE . "'
                             and zone_country_id = '" . (int)$order->delivery['country']['id'] . "'
                             order by zone_id");
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
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $method
   * @return unknown
   */
  function quote($method = '') {
    global $order, $shipping_weight, $shipping_num_boxes, $total_count;

    // shipping adjustment
    switch (MODULE_SHIPPING_TABLE_MODE) {
      case ('price'):
        $order_total = $_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices() ;
        break;
      case ('weight'):
        $order_total = $shipping_weight;
        break;
      case ('item'):
        $order_total = $total_count - $_SESSION['cart']->free_shipping_items();
        break;
    }

    $order_total_amount = $_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices() ;

    $table_cost = preg_split("/[:,]/" , MODULE_SHIPPING_TABLE_COST);
    $size = sizeof($table_cost);
    for ($i=0, $n=$size; $i<$n; $i+=2) {
      if (round($order_total,9) <= $table_cost[$i]) {
        if (strstr($table_cost[$i+1], '%')) {
          $shipping = ($table_cost[$i+1]/100) * $order_total_amount;
        } else {
          $shipping = $table_cost[$i+1];
        }
        break;
      }
    }

    if (MODULE_SHIPPING_TABLE_MODE == 'weight') {
      $shipping = $shipping * $shipping_num_boxes;
      // show boxes if weight
      switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
        case (0):
        $show_box_weight = '';
        break;
        case (1):
        $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
        break;
        case (2):
        $show_box_weight = ' (' . number_format($shipping_weight * $shipping_num_boxes,2) . TEXT_SHIPPING_WEIGHT . ')';
        break;
        default:
        $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
        break;
      }
    }

    $this->quotes = array('id' => $this->code,
    'module' => MODULE_SHIPPING_TABLE_TEXT_TITLE . $show_box_weight,
    'methods' => array(array('id' => $this->code,
    'title' => MODULE_SHIPPING_TABLE_TEXT_WAY,
    'cost' => $shipping + (MODULE_SHIPPING_TABLE_HANDLING_METHOD == 'Box' ? MODULE_SHIPPING_TABLE_HANDLING * $shipping_num_boxes : MODULE_SHIPPING_TABLE_HANDLING) ) ));

    if ($this->tax_class > 0) {
      $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
    }

    if (zen_not_null($this->icon)) $this->quotes['icon'] = zen_image($this->icon, $this->title);

    return $this->quotes;
  }
  /**
   * Enter description here...
   *
   * @return unknown
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_TABLE_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Enter description here...
   *
   */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Table Method', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Do you want to offer table rate shipping?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Shipping Table', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'The shipping cost is based on the total cost or weight of items or count of the items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc<br />You can also use percentage amounts, such 25:8.50,35:5%,40:9.50,10000:7% to charge a percentage value of the Order Total', '6', '0', 'zen_cfg_textarea(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Table Method', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'The shipping cost is based on the order total or the total weight of the items ordered or the total number of items orderd.', '6', '0', 'zen_cfg_select_option(array(\'weight\', \'price\', \'item\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handling Fee', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Handling fee for this shipping method.', '6', '0', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Handling Per Order or Per Box', 'MODULE_SHIPPING_TABLE_HANDLING_METHOD', 'Order', 'Do you want to charge Handling Fee Per Order or Per Box?', '6', '0', 'zen_cfg_select_option(array(\'Order\', \'Box\'), ', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tax Basis', 'MODULE_SHIPPING_TABLE_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");
    // www.zen-cart-pro.at german admin languages_id==43 START
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Tabellarische Versandkosten aktivieren?', 'MODULE_SHIPPING_TABLE_STATUS', '43', 'Möchten Sie die tabellarische Methode aktivieren?', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Versandkostentabelle', 'MODULE_SHIPPING_TABLE_COST', '43', 'Die Versandkosten basieren auf den Gesamtkosten, dem Gewicht oder der Anzahl der Artikel<br/><br/>Beispiel: 25: 8.50,50: 5.50, etc.<br/>Bis zu 25 (Preis, Gewicht oder Anzahl) betragen die Versandkosten 8,50, von dort bis 50 (Preis, Gewicht oder Anzahl) betragen die Versandkosten 5,50, etc.<br/><br/>Sie können auch Prozent nutzen, um prozentuale Versandkosten für den Auftrag zu berechnen.<br/><br/>Beispiel: 25:8.50,35:5%,40:9.50,10000:7%', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Berechnungsmethode', 'MODULE_SHIPPING_TABLE_MODE', '43', 'Die Versandkosten basieren auf dem Gesamtgewicht der Artikel (weight), der Auftragssumme (price) oder der Anzahl der bestellten Artikel (item).', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bearbeitungsgebühr', 'MODULE_SHIPPING_TABLE_HANDLING', '43', 'Bearbeitungsgebühr für diese Methode', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Bearbeitungsgebühr pro Bestellung oder pro Paket', 'MODULE_SHIPPING_TABLE_HANDLING_METHOD', '43', 'Wollen Sie die Bearbeitungsgebühr pro Bestellung oder pro Paket verrechnen?', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Steuerklasse', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '43', 'Folgende Steuerklasse auf die Versandkosten anwenden:', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Grundlage der Steuern', 'MODULE_SHIPPING_TABLE_TAX_BASIS', '43', 'Möglichkeiten sind:<br />Shipping = Lieferadresse = Steuern der Versandkosten richten sich nach der Lieferadresse des Kunden<br />Billing = Rechnungsadresse = Steuern der Versandkosten richten sich nach der Rechnungsadresse des Kunden<br />Store = Shopadresse = Steuern der Versandkosten richten sich nach der Adresse des Shops', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Versandzone', 'MODULE_SHIPPING_TABLE_ZONE', '43', 'Für welche Länder soll diese Versandart angeboten werden?<br />Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION_LANGUAGE   . " (configuration_title, configuration_key, configuration_language_id, configuration_description, date_added) values ('Sortierreihenfolge', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '43', 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now())");
  }
  /**
   * Enter description here...
   *
   */
    function remove() {
      global $db;
      
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE\_SHIPPING\_TABLE\_%'");
      // www.zen-cart-pro.at german admin languages_id == delete all
     $db->Execute("delete from " . TABLE_CONFIGURATION_LANGUAGE . " where configuration_key like 'MODULE\_SHIPPING\_TABLE\_%'");
    }

  /**
   * Enter description here...
   *
   * @return unknown
   */
  function keys() {
    return array('MODULE_SHIPPING_TABLE_STATUS', 'MODULE_SHIPPING_TABLE_COST', 'MODULE_SHIPPING_TABLE_MODE', 'MODULE_SHIPPING_TABLE_HANDLING', 'MODULE_SHIPPING_TABLE_HANDLING_METHOD', 'MODULE_SHIPPING_TABLE_TAX_CLASS', 'MODULE_SHIPPING_TABLE_TAX_BASIS', 'MODULE_SHIPPING_TABLE_ZONE', 'MODULE_SHIPPING_TABLE_SORT_ORDER');
  }
}
