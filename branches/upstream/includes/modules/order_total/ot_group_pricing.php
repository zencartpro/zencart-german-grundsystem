<?php
/**
 * @package orderTotal
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_group_pricing.php 4601 2006-09-24 18:48:43Z wilt $
 */

class ot_group_pricing {
	var $title, $output;

	function ot_group_pricing() {
		$this->code = 'ot_group_pricing';
		$this->title = MODULE_ORDER_TOTAL_GROUP_PRICING_TITLE;
		$this->description = MODULE_ORDER_TOTAL_GROUP_PRICING_DESCRIPTION;
		$this->sort_order = MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER;
		$this->include_shipping = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING;
		$this->include_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX;
		$this->calculate_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX;
		$this->tax_class = MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS;
		$this->credit_class = true;
		$this->output = array();
	}

	function process() {
		global $db, $order, $currencies;
		$od_amount = $this->calculate_deductions($this->get_order_total());
		if ($od_amount['total'] > 0) {
      reset($order->info['tax_groups']);
                  $tax = 0;
			while (list($key, $value) = each($order->info['tax_groups'])) {
				$tax_rate = zen_get_tax_rate_from_desc($key);
				if ($od_amount[$key]) {
					$order->info['tax_groups'][$key] -= $od_amount[$key];
					$order->info['total'] -=  $od_amount[$key];
                                        $tax += $od_amount[$key];
				}
			}
      if (DISPLAY_PRICE_WITH_TAX == 'true') {
        $od_amount['total'] += zen_calculate_tax($od_amount['total'], $tax);
      }
      
      $order->info['total'] = $order->info['total'] - $od_amount['total'];
			$this->output[] = array('title' => $this->title . ':',
			'text' => '-' . $currencies->format($od_amount['total'], true, $order->info['currency'], $order->info['currency_value']),
			'value' => $od_amount['total']);

		}
	}

	function get_order_total() {
		global $order;
		$order_total = $order->info['total'];
		if ($this->include_tax == 'false') $order_total -= $order->info['tax'];
		if ($this->include_shipping == 'false') $order_total -= $order->info['shipping_cost'];

		return $order_total;
	}
	function calculate_deductions($order_total) {
		global $db, $order;
		$od_amount = array();
		$tax_address = zen_get_tax_locations();
		$group_query = $db->Execute("select customers_group_pricing from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$_SESSION['customer_id'] . "'");
		if ($group_query->fields['customers_group_pricing'] != '0') {
			$group_discount = $db->Execute("select group_name, group_percentage from " . TABLE_GROUP_PRICING . " where
                                        group_id = '" . (int)$group_query->fields['customers_group_pricing'] . "'");
			$gift_vouchers = $_SESSION['cart']->gv_only();
			$discount = ($order_total - $gift_vouchers) * $group_discount->fields['group_percentage'] / 100;
			$od_amount['total'] = round($discount, 2);
      /**
       * when calculating the ratio add some insignificant values to stop divide by zero errors
       */
      $ratio = ($od_amount['total'] + .000001)/($order_total - $gift_vouchers + .000001);
			switch ($this->calculate_tax) {
				case 'Standard':
          reset($order->info['tax_groups']);
          while (list($key, $value) = each($order->info['tax_groups'])) {
					  $tax_rate = zen_get_tax_rate_from_desc($key);
					  if ($tax_rate > 0) {
					    $od_amount[$key] = $tod_amount = round(($order->info['tax_groups'][$key]) * $ratio, 2) ;
					    $od_amount['tax'] += $tod_amount;
					  }
          }
				break;
				case 'Credit Note':
          reset($order->info['tax_groups']);
          while (list($key, $value) = each($order->info['tax_groups'])) {
  					$tax_rate = zen_get_tax_rate_from_desc($order->info['tax_groups']);
					  if ($tax_rate > 0) {
					    $od_amount[$key] = $tod_amount = round(($order->info['tax_groups'][$key]) * $ratio, 2) ;
					    $od_amount['tax'] += $tod_amount;
					  }
          }
				break;
			}
		}
		return $od_amount;
	}
	function pre_confirmation_check($order_total) {
		global $order;
		if ($this->include_shipping == 'false') $order_total -= $order->info['shipping_cost'];
		if ($this->include_tax == 'false') $order_total -= $order->info['tax'];
		$od_amount = $this->calculate_deductions($order_total);
		return $od_amount['total'] + $od_amount['tax'];
	}

	function credit_selection() {
		return $selection;
	}

	function collect_posts() {
	}

	function update_credit_account($i) {
	}

	function apply_credit() {
	}

	function check() {
		global $db;
		if (!isset($this->_check)) {
			$check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS'");
			$this->_check = $check_query->RecordCount();
		}

		return $this->_check;
	}

	function keys() {
		return array('MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS');
	}

	function install() {
		global $db;
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('This module is installed', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', '290', 'Sort order of display.', '6', '2', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Shipping', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'false', 'Include Shipping value in amount before discount calculation?', '6', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'true', 'Include Tax value in amount before discount calculation?', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'Standard', 'Re-Calculate Tax', '6', '7','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', '0', 'Use the following tax class when treating Group Discount as Credit Note.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
	}

	function remove() {
		global $db;
		$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
	}
}
?>