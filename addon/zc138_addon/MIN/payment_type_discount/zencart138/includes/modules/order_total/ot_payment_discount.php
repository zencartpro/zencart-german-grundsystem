<?php
/**
 * @payment type discount module
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_payment_discount.php 500 2009-02-02 20:07:46Z webchills $
 */

class ot_payment_discount
{
  var $title, $output;

  function ot_payment_discount()
  {
    $this->code = 'ot_payment_discount';
    $this->title = MODULE_PAYMENT_DISCOUNT_DESCRIPTION;
    $this->description = MODULE_PAYMENT_DISCOUNT_DESCRIPTION_DISCOUNT;
    $this->enabled = MODULE_PAYMENT_DISCOUNT_STATUS;
    $this->sort_order = MODULE_PAYMENT_DISCOUNT_SORT_ORDER;
    $this->include_shipping = MODULE_PAYMENT_DISCOUNT_INC_SHIPPING;
    $this->include_tax = MODULE_PAYMENT_DISCOUNT_INC_TAX;
    $this->disc_minimum = (float)MODULE_PAYMENT_DISCOUNT_DISCOUNT_MINIMUM;
    $this->calculate_tax = MODULE_PAYMENT_DISCOUNT_CALC_TAX;
    $this->operator = 'none';
    $this->output = array();
  }

  function process()
  {
    global $order, $currencies;

    $delta = $this->calculate($this->get_order_total());
    if ($delta > 0)
    {
      $this->output[] = array('title' => $this->title,
                              'text' => $this->operator . $currencies->format($delta),
                              'value' => $delta);
	    $order->info['total'] = $this->add_subtract($order->info['total'], $delta);
		}
  }


  function calculate($amount)
  {
    global $order, $customer_id;
    $delta = 0;
    
    
    
    
    $table = split("[,]", MODULE_PAYMENT_DISCOUNT_DISCOUNT_TYPES);
    for ($i = 0, $j = count($table); $i < $j; $i++)
    {
      if ($_SESSION['payment'] == $table[$i])
      {
        if ($this->operator == 'none')
        {
          $this->operator = '-';// discount
        }
        else
        {
          $this->operator = 'none';
      }
    }
    }
    
    
    $process = false;
    switch ($this->operator)
    {
      
      case '-':// disc
        if ($order->info['total'] > $this->disc_minimum)
        {
          $this->percentage = (zen_not_null(MODULE_PAYMENT_DISCOUNT_DISCOUNT_PERCENTAGE) ? (float)MODULE_PAYMENT_DISCOUNT_DISCOUNT_PERCENTAGE : 0);
          $this->title = sprintf((defined('MODULE_PAYMENT_DISCOUNT_TITLE_CHECKOUT') ? MODULE_PAYMENT_DISCOUNT_TITLE_CHECKOUT : MODULE_PAYMENT_DISCOUNT_TITLE), MODULE_PAYMENT_DISCOUNT_DESCRIPTION_DISCOUNT);
          $process = true;
        }
        break;
      default:
        
    }
    
    if ($process && $this->enabled == 'true')
    {
      
      $delta = round($amount, 2) * ($this->percentage / 100);// percentage of total order
      
	    if ($this->calculate_tax == 'true')
	    {
				
	      $tax_delta = round($order->info['tax'], 2) * ($this->percentage / 100);
	      $order->info['tax'] = $this->add_subtract($order->info['tax'], $tax_delta);
	      
				
	      reset($order->info['tax_groups']);
	      while (list($key, $value) = each($order->info['tax_groups']))
	      {
	        $tax_group_delta = round($value, 2) * ($this->percentage / 100);
	        $order->info['tax_groups'][$key] = $this->add_subtract($order->info['tax_groups'][$key], $tax_group_delta);
	      }
	      
	      $delta = $delta + $tax_delta;
	    }
    }
    return $delta;
  }
  
  function add_subtract($a, $b)
  {
    if ($this->operator == '+')
      return $a + $b;// fee
    
    if ($this->operator == '-')
      return $a - $b;// disc
  }

  function get_order_total()
  {
    global  $order, $db;
    $order_total = $order->info['total'];
    
    if (is_object($_SESSION['cart']))
    {
      $products = $_SESSION['cart']->get_products();
      for ($i = 0, $j = sizeof($products); $i < $j; $i++)
      {
        $t_prid = zen_get_prid($products[$i]['id']);
        $gv_result = $db->Execute("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
        if (ereg('^GIFT', addslashes($gv_result->fields['products_model'])))
        {
          $qty = $_SESSION['cart']->get_quantity($t_prid);
          $products_tax = zen_get_tax_rate($gv_result->fields['products_tax_class_id']);
          if ($this->include_tax == 'false')
          {
            $gv_amount = $gv_result->fields['products_price'] * $qty;
          }
          else
          {
            $gv_amount = ($gv_result->fields['products_price'] + zen_calculate_tax($gv_result->fields['products_price'], $products_tax)) * $qty;
          }
          $order_total = $order_total + $gv_amount;
        }
      }
    }
    if ($this->include_tax == 'false')
      $order_total = $order_total - $order->info['tax'];
    if ($this->include_shipping == 'false')
      $order_total = $order_total - $order->info['shipping_cost'];
    
    return $order_total;
  }

  function check()
  {
  global $db;
    if (!isset($this->check))
    {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_DISCOUNT_STATUS'");
      $this->check = $check_query->RecordCount();
    }
    return $this->check;
  }

  function keys()
  {
    return array('MODULE_PAYMENT_DISCOUNT_STATUS', 'MODULE_PAYMENT_DISCOUNT_SORT_ORDER', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_PERCENTAGE', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_MINIMUM', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_TYPES', 'MODULE_PAYMENT_DISCOUNT_INC_SHIPPING', 'MODULE_PAYMENT_DISCOUNT_INC_TAX', 'MODULE_PAYMENT_DISCOUNT_CALC_TAX');
  }

  function install()
  {
  global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Modul aktivieren?', 'MODULE_PAYMENT_DISCOUNT_STATUS', 'true', 'Wollen Sie den Rabatt für die Zahlungsart aktivieren?', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Anzeigereihenfolge', 'MODULE_PAYMENT_DISCOUNT_SORT_ORDER', '220', 'Anzeigereihenfolge. Voreingestellt ist 220. Falls das geändert wird, darauf achten, dass dieses Modul vor der Steuerberechnung kommt.', '6', '2', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Versandkosten einrechnen?', 'MODULE_PAYMENT_DISCOUNT_INC_SHIPPING', 'true', 'Sollen die Versandkosten in die Berechnung miteinfliessen?', '6', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Steuer einrechnen?', 'MODULE_PAYMENT_DISCOUNT_INC_TAX', 'false', 'Soll die Steuer in die Berechnung miteinfliessen?.', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Rabatt Prozentsatz', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_PERCENTAGE', '3.00', 'Höhe des Rabatts in Prozent:', '6', '7', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Steuer neu berechnen?', 'MODULE_PAYMENT_DISCOUNT_CALC_TAX', 'true', 'Soll die Steuer auf Basis des reduzierten Betrages neu berechnet werden?', '6', '5','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Mindestbestellwert für den Rabatt', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_MINIMUM', '100', 'Welchen Mindestwert muss die Bestellsumme haben, damit der Rabatt gewährt wird? Voreingestellt: 100', '6', '2', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Zahlungsweisen, die den Rabatt erhalten', 'MODULE_PAYMENT_DISCOUNT_DISCOUNT_TYPES', 'moneyorder', 'Bei welchen Zahlungsweisen wollen Sie den Rabatt gewähren?<br />Voreingestellt: moneyorder. Sie können mehrere Zahlungsweisen angeben, sie müssen mit Komma getrennt sein.<br/>Als Name MUSS die jeweilige Klasse angegeben werden, z.B. cod,moneyorder,cc', '6', '2', now())");
     }

  function remove()
  {
  global $db;
    $keys = '';
    $keys_array = $this->keys();
    for ($i=0; $i<sizeof($keys_array); $i++)
    {
      $keys .= "'" . $keys_array[$i] . "',";
    }
    $keys = substr($keys, 0, -1);

    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
  }
}
?>