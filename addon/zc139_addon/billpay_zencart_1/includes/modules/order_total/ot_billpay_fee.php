<?php

class ot_billpay_fee {
    var $title, $output, $db;

    function ot_billpay_fee() {
      global $order, $db;

      $this->db = $db;
      $this->code = 'ot_billpay_fee';
      $this->title = MODULE_ORDER_TOTAL_BILLPAY_FEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_BILLPAY_FEE_DESCRIPTION;
      $this->type = MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE;
      $this->enabled = ((MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_BILLPAY_FEE_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies, $billpay_cost, $billpay_country, $shipping;

      if (MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS == 'true') {
        if ($_SESSION['payment'] == 'billpay')
        {
        	$value = $this->calculateFee();
        	$order->info['total'] += $value;
        	$order->info['total'] += $this->calculateTax();
            $tax_description = zen_get_tax_description(MODULE_ORDER_TOTAL_BILLPAY_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
            $order->info['tax'] += $this->calculateTax();
            $order->info['tax_groups'][$tax_description] += $this->calculateTax();
            if(DISPLAY_PRICE_WITH_TAX == "true")
            {
       			$value += $this->calculateTax();
            }
            $this->output[] = array('title' => $this->title . ':',
                                    'text' => $currencies->format($value, false),
                                    'value' => $value);
        }
      }
    }

    function display()
    {
		global $currencies;
    	if($this->type == "prozentual")
    	{
    		return " ".MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT."% " . MODULE_ORDER_TOTAL_BILLPAY_FEE_FROM_TOTAL;
    	}
       	$value = $this->calculateFee();
      	$value += $this->calculateTax();
    	return $currencies->format($value, false);
    }

    function calculateFee()
    {
    	$value = 0;
        if($this->type == "fest")
        {
        	$value = MODULE_ORDER_TOTAL_BILLPAY_FEE_VALUE;
        }
        else if($this->type == "prozentual")
        {
        	$value = $order->info['total'] / 100 * MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT;
        }
        else if($this->type == "gestaffelt")
        {
        	$arr = explode(";", MODULE_ORDER_TOTAL_BILLPAY_FEE_GRADUATE);
        	foreach($arr as $val)
        	{
        		$element = explode("=", $val);
        		if($order->info['total'] <= $element[0])
        		{
        			$value = $element[1];
        			break;
        		}
        		$value = $element[1];
        	}
        }
        return $value;
    }
    
    function calculateTax()
    {
    	global $order; 
    	
    	$value = 0;
    	$billpay_tax = zen_get_tax_rate(MODULE_ORDER_TOTAL_BILLPAY_FEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
    	$value += zen_calculate_tax($this->calculateFee(), $billpay_tax);
        return $value;
    }
    
    function check() {
      if (!isset($this->_check)) {
        $check_query = $this->db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS', 
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_SORT_ORDER', 
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE',
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT',
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_VALUE',
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_GRADUATE',
      				'MODULE_ORDER_TOTAL_BILLPAY_FEE_TAX_CLASS');
    }

    function install() {
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_STATUS', 'true', 'Billpay Rechnungsgebühr', 'Berechnung der Rechnungsgebühr', '6', '0', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
	  $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_TYPE', 'fest', 'Gebühr Typ', 'Wählen Sie die Art der Gebühr. Die Gebühr kann als fester Betrag, ein Prozentwert auf die Rechnungssumme oder gestaffelter Betrag erhoben werden.', '6', '0', 'zen_cfg_select_option(array(\'fest\', \'prozentual\', \'gestaffelt\'), ', now())");
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_SORT_ORDER', '35', 'Sortierreihenfolge', 'Anzeigereihenfolge', '6', '0', now())");
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_PERCENT', '1', 'Prozentsatz', 'Geben Sie hier den Prozentwert als ganze Zahl ein. Dieser Prozentwert wird auf die Rechnungssumme erhoben, falls der Gebührtyp \"prozentual\" aktiviert ist.', '6', '0', now())");
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_VALUE', '0.5', 'fester Wert', 'Geben Sie hier den festen Wert ein. Dieser Wert wird der Rechnungssumme aufaddiert, falls der Gebührtyp \"fest\" aktiviert ist.', '6', '0', now())");
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_GRADUATE', '', 'Staffelung', 'Geben Sie hier die Gebührenstaffelung in der Form {Rechnungssumme}={Gebühr};{Rechnungssumme}={Gebühr}; ein. Diese Staffelung wird auf die Rechnungssumme erhoben, falls der Gebührtyp \"Staffelung\" aktiviert ist.', '6', '0', now())");
      $this->db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_title, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('MODULE_ORDER_TOTAL_BILLPAY_FEE_TAX_CLASS', '0', 'Steuerklasse', 'W&auml;hlen Sie eine Steuerklasse.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      $this->db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>