<?php
/**
 * Quantity Discounts in the order_total module
 * Version 1.8
 * By Scott Wilson (swguy) 
 * @copyright That Software Guy (www.thatsoftwareguy.com) 
 * @copyright Portions Copyright 2004-2006 Zen Cart Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

  class ot_quantity_discount {
    var $title, $output;
    var $explanation; 

    // Add categories you wish to exclude to this list.
    // Go to Admin->Catalog->Categories/Products and look 
    // at the left hand side of the list to determine 
    // category id.   Note that 99999 and 99998 are just given
    // as examples.
    function exclude_category($category) {
        switch($category) {
           case 99999:
           case 99998:
                return true;
        }
        return false;
    }

    // Add products you wish to exclude to this list.
    // Go to Admin->Catalog->Categories/Products->[Your category]
    // and look at the left hand side of the list to determine 
    // product id.   Note that 99999 and 99998 are just given
    // as examples.
    function exclude_product($id) {
        switch($id) {
           case 99999:
           case 99998:
                return true;
        }
        return false;
    }

    // Add categories with special discounting policies to this list.
    // Note that 99999, 99998 and 99997 are just given as examples.
    // Note that the Discounting Units you specified in Admin 
    // (percentage, currency, currency/item) are also used here.
    function apply_special_category_discount($category, $count, &$disc_amount) {
        switch($category) {
           case 99999:
           case 99998:
                if ($count > 100) {
                   $disc_amount = 50; 
                }
                break; 
           case 99997:
                $disc_amount = 75;
                break;
        }
    }

    // Add items with special discounting policies to this list.
    // Note that 99999, 99998 and 99997 are just given as examples.
    // Note that the Discounting Units you specified in Admin 
    // (percentage, currency, currency/item) are also used here.
    function apply_special_item_discount($id, $count, &$disc_amount) {
        switch($id) {
           case 99999:
           case 99998:
                if ($count > 100) {
                   $disc_amount = 50; 
                }
                break; 
           case 99997:
                $disc_amount = 75;
                break; 
        }
    }


    function ot_quantity_discount() {
      $this->code = 'ot_quantity_discount';
      $this->title = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_TITLE;
      $this->description = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_SORT_ORDER;
      $this->include_tax = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_CALC_TAX;
      $this->total_basis = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_TOTAL_BASIS;
      $this->units = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_UNITS;
      $this->total_level_1 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_1;
      $this->total_discount_1 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_1; 
      $this->total_level_2 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_2;
      $this->total_discount_2 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_2;
      $this->total_level_3 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_3;
      $this->total_discount_3 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_3;
      $this->total_level_4 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_4;
      $this->total_discount_4 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_4;
      $this->total_level_5 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_5; 
      $this->total_discount_5 = MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_5;
      $this->credit_class = true;
      $this->output = array();
      $this->extra_levels = array();
      $this->extra_discounts = array();
      $this->setup(); 
    }

    function add_extra_level_discount($newlevel, $newdiscount) {
       $this->extra_levels[] = $newlevel;
       $this->extra_discounts[] = $newdiscount;
    }
 
    function print_amount($amount) {
      global $db, $order, $currencies;
      return  $currencies->format($amount, true, $order->info['currency'], $order->info['currency_value']);
    }

    function get_disc_amount($count) {
      $disc_amount = 0;
      if ($count >= $this->total_level_1) 
          $disc_amount = $this->total_discount_1;
      if ($count >= $this->total_level_2) 
          $disc_amount = max($disc_amount, $this->total_discount_2);
      if ($count >= $this->total_level_3) 
          $disc_amount = max($disc_amount, $this->total_discount_3);
      if ($count >= $this->total_level_4) 
          $disc_amount = max($disc_amount, $this->total_discount_4);
      if ($count >= $this->total_level_5) 
          $disc_amount = max($disc_amount, $this->total_discount_5);
      for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
          if ($count >= $this->extra_levels[$i]) {
             $disc_amount = max($disc_amount, $this->extra_discounts[$i]); 
          }
      }
      return $disc_amount; 
    }


    function get_order_total() {
       global  $order;
       $order_total_tax = $order->info['tax'];
       $order_total = $order->info['total'];
       if ($this->include_shipping != 'true') $order_total -= $order->info['shipping_cost'];
       if ($this->include_tax != 'true') $order_total -= $order->info['tax'];
       $orderTotalFull = $order_total;
       $order_total = array('totalFull'=>$orderTotalFull, 'total'=>$order_total, 'tax'=>$order_total_tax);
   
       return $order_total;
    }

    function process() {
       global $db, $order, $currencies;
       $od_amount = $this->calculate_deductions();
       if ($od_amount['total'] > 0) {
         reset($order->info['tax_groups']);
         while (list($key, $value) = each($order->info['tax_groups'])) {
           $tax_rate = zen_get_tax_rate_from_desc($key);
           if ($od_amount[$key]) {
             $order->info['tax_groups'][$key] -= $od_amount[$key];
             $order->info['total'] -=  $od_amount[$key];
           }
         }
         // $od_amount['total'] = Mengenrabatt brutto
         // $od_amount['tax'] = UST des Mengenrabattes
         $order->info['total'] = $order->info['total'] - $od_amount['total'] + $od_amount['tax'];
         $this->output[] = array('title' => $this->title . ':',
         'text' => '-' . $currencies->format($od_amount['total'], true, $order->info['currency'], $order->info['currency_value']),
         'value' => $od_amount['total']);
   
       }
    }

    function calculate_deductions() {
       global $db, $order, $currencies;
 
       $od_amount = array();
       $od_amount['tax'] = 0;

       $products = $_SESSION['cart']->get_products();
       $prod_list = array();
       $prod_list_price = array();
       $cat_list = array();
       $cat_list_price = array();
       $all_items = 0;
       $cat_list_back = array();
       $prod_list_back = array(); 
       $all_items_price = 0;
       for ($i=0, $n=sizeof($products); $i<$n; $i++) {
          // Add categories you wish to exclude to exclude_category()
          if ($this->exclude_category($products[$i]['category'])) {
              continue; 
          }
          // Add products you wish to exclude to exclude_product()
          if ($this->exclude_product($products[$i]['id'])) {
              continue; 
          }
          $price = $products[$i]['final_price'];
          $quantity = $products[$i]['quantity'];

          // OK, it's an item you want to include.  Add it to the lists: 
          // by category
          $cat_list_back[$products[$i]['category']] = &$products[$i]; 
          $cat_list[$products[$i]['category']] += $quantity;
          $cat_list_price[$products[$i]['category']] += ($price * $quantity);

          // by products
          $prod_list_back[$products[$i]['id']] = &$products[$i];
          $prod_list[$products[$i]['id']] += $quantity;
          $prod_list_price[$products[$i]['id']] += ($price * $quantity);

          // by cart total
          $all_items += $quantity;
          $all_items_price += ($price * $quantity);
       }

       $cart_array = false;
       $key_list = array();
       if ($this->total_basis == 'Total By Category') {
          $key_list = array_keys($cat_list); 
          $cart_array = true;
       } else if ($this->total_basis == 'Total By Item') {
          $key_list = array_keys($prod_list); 
          $cart_array = true;
       } 

       $discount = 0;
       $this->explanation = YOUR_CURRENT_QUANTITY_DISCOUNT . "\\n" . "\\n"; 
       if ($cart_array == true) {
          // Discount by category or item number
       while (list($keypos, $listpos) = each($key_list)) {
             if ($this->total_basis == 'Total By Category') {
                $description = zen_get_category_name(
                       $cat_list_back[$listpos]['category'], 
                       $_SESSION['languages_id']) . " " . ITEMS;
                $count =  $cat_list[$listpos];
                $price =  $cat_list_price[$listpos];
                $disc_amount = $this->get_disc_amount($count); 
                $this->apply_special_category_discount(
                       $listpos, $count, $disc_amount);
             } else { 
                $description =  $prod_list_back[$listpos]['model'];
                $count =  $prod_list[$listpos];
                $price =  $prod_list_price[$listpos];
                $disc_amount = $this->get_disc_amount($count); 
                $this->apply_special_item_discount(
                       $listpos, $count, $disc_amount);
             }

             if ($disc_amount == 0)
                continue; 
              
             if ($this->units == 'currency') {
                $this_discount = $disc_amount; 
             } else if ($this->units == 'currency per item') {
                $this_discount = $disc_amount * $count; 
             } else  {
                $this_discount = $price * $disc_amount / 100;
             }

             // This is a discount, not a credit! :)
             if ($this_discount > $price)  {
                $this_discount = $price;
             }
             
             $this_discount_inc_tax = $this_discount; 
             if ($this->include_tax == 'true') {
                $this_discount_inc_tax = $this->gross_up($this_discount); 
             }

             $discount +=  $this_discount_inc_tax;

             // Build the discount explanation text string 
             $gross_expl = "";
             if ($this->include_tax == 'true') {
                  $gross_expl = "  (".GROSSED_UP." = " . $this->print_amount($this_discount_inc_tax) . ")\\n"; 
             } 
             if ($this->units == 'currency') {
                $this->explanation .= " " . 
                   $this->print_amount($this_discount) . OFF . 
                    $count . " " . 
                    $description . "@" .  
                   $this->print_amount($price) . $gross_expl . "\\n";
             } else if ($this->units == 'currency per item') {
                $this->explanation .= " " . 
                   $this->print_amount($disc_amount) . PER_ITEM_OFF . 
                    $count . " " . 
                    $description . "@" .  
                   $this->print_amount($price) . $gross_expl . "\\n";
             } else {
                $this->explanation .=  " " . $count . " " . 
                   $description . "@" .  
                   $this->print_amount($price) . " * " . $disc_amount .  "% = " . 
                   $this->print_amount($this_discount) . $gross_expl . "\\n"; 
             } 
          }
       } else {
          $count = $all_items; 
          $price = $all_items_price; 
          $disc_amount = $this->get_disc_amount($count); 
          if ($this->units == 'currency') {
             $this_discount = $disc_amount; 
          } else if ($this->units == 'currency per item') {
             $this_discount = $disc_amount * $count; 
          } else  {
             $this_discount = $price * $disc_amount / 100;
          }
          if ($this_discount > $price)  {
             $this_discount = $price;
          }
          $this_discount_inc_tax = $this_discount; 
          if ($this->include_tax == 'true') {
             $this_discount_inc_tax = $this->gross_up($this_discount); 
          }

          // Discount by cart total
          $discount =  $this_discount_inc_tax;
          $gross_expl = "";
          if ($this->include_tax == 'true') {
             $gross_expl = "  (".GROSSED_UP." = " . $this->print_amount($this_discount_inc_tax) . ")\\n"; 
          }
          if ($this->units == 'currency') {
              $this->explanation .= " " . 
                      $this->print_amount($this_discount) . OFF . 
                       $count . " " . 
                       ITEMS . " @ " .  
                      $this->print_amount($price) . $gross_expl . "\\n";
          } else if ($this->units == 'currency per item') {
              $this->explanation .= " " . 
                      $this->print_amount($disc_amount) . PER_ITEM_OFF . 
                       $count . " " . 
                       ITEMS . " @ " .  
                      $this->print_amount($price) . $gross_expl . "\\n";
          } else {
              $this->explanation .=  " " . $count . " " . 
                      ITEMS . " @ " .  
                      $this->print_amount($price) . " * " . $disc_amount .  "% = " . 
                      $this->print_amount($this_discount) . $gross_expl . "\\n"; 
          } 
       }
  
       $this->explanation .= "\\n\\n" . TOTAL_DISCOUNT . $this->print_amount($discount); 

       // Berechnung der UST nach dem Rabatt
       $od_amount['total'] = round($discount, 2); //ausgerechneter Mengenrabatt brutto
       switch ($this->calculate_tax) {
       case 'Standard':
          reset($order->info['tax_groups']);
          while (list($key, $value) = each($order->info['tax_groups']))
          {
             $tax_rate = zen_get_tax_rate_from_desc($key);
             if ($tax_rate > 0) {
                // Berechnung der UST vom Brutto-Mengenrabatt
                $od_amount[$key] = $tod_amount = round(($od_amount['total'] / (100 + $tax_rate)) * $tax_rate, 2) ;
                $od_amount['tax'] += $tod_amount;
             }
          }
          break;
      }
      return $od_amount;
   }

   function gross_up($net) {
      global $order;
      $gross_up_amt = 0; 
      reset($order->info['tax_groups']);
      while (list($key, $value) = each($order->info['tax_groups']))
      {
          $tax_rate = zen_get_tax_rate_from_desc($key);
          if ($tax_rate > 0) {
             $gross_up_amt += round((($net * $tax_rate)) /100, 2) ;
          }
      }
      return $net + $gross_up_amt; 
   }

   function pre_confirmation_check($order_total) {
      $od_amount = $this->calculate_deductions();
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
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_STATUS', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_SORT_ORDER', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_INC_TAX', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_CALC_TAX', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_UNITS', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_TOTAL_BASIS', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_1','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_1','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_2','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_2','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_3','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_3','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_4','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_4','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_5','MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_5');
    }

    function install() {
      global $db;

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('&copy; That Software Guy<br /><div><a href=\"http://www.thatsoftwareguy.com/donate.html\" target=\"_blank\">Donate</a> - Support this Module</div><div><a href=\"http://www.thatsoftwareguy.com/zencart_quantity_discounts.html\" target=\"_blank\">Help</a> - View the Documentation</div><br />This module is installed', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_SORT_ORDER', '295', 'Sort order of display.', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_INC_TAX', 'false', 'Include Tax in calculation.', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_CALC_TAX', 'Standard', 'Re-Calculate Tax', '6', '7','zen_cfg_select_option(array(\'None\', \'Standard\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Discount Basis', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_TOTAL_BASIS', 'Total By Category', 'How quantity totals are computed', '6', '8','zen_cfg_select_option(array(\'Total By Category\', \'Total By Item\', \'Total Items in Cart\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Discount Units', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_UNITS', 'percentage', 'Discounts expressed as a currency unit (e.g. dollars) or as a percentage ', '6', '9', 'zen_cfg_select_option(array(\'currency\', \'percentage\', \'currency per item\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 1', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_1', '0', 'Total required to reach this discount level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 1', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_1', '0', 'Percent or amount off at this level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 2', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_2', '0', 'Total required to reach this discount level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 2', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_2', '0', 'Percent or amount off at this level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 3', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_3', '0', 'Total required to reach this discount level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 3', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_3', '0', 'Percent or amount off at this level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 4', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_4', '0', 'Total required to reach this discount level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 4', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_4', '0', 'Percent or amount off at this level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Level 5', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_LEVEL_5', '0', 'Total required to reach this discount level', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Amount 5', 'MODULE_ORDER_TOTAL_QUANTITY_DISCOUNT_AMOUNT_5', '0', 'Percent or amount off at this level', '6', '5', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function get_level_policy($discount, $level) {
        if ($this->units == 'currency') {
            $off_amt = $this->print_amount($discount);
        } else if ($this->units == 'currency per item') {
            $off_amt = $this->print_amount($discount);
        } else {
            $off_amt = $discount . "%"; 
        }
        if ($this->total_basis == 'Total By Category') {
            $basis = BASIS_CATEGORY;
        } else if ($this->total_basis == 'Total By Item') {
            $basis = BASIS_ITEM;
        } else {
            $basis = BASIS_CART;
        }
 
        if ($this->units == 'currency per item') {
           $h_exp .= BUY . $level . $basis . GET . $off_amt . PER_ITEM_OFF;
        } else {
           $h_exp .= BUY . $level . $basis . GET . $off_amt . OFF ;
        }
        return $h_exp; 
    }

    // Users seeking more control over output should use get_discount_info()
    function get_html_policy($product = 0, $category = 0) {
        $h_exp = "<br />";
        if ($this->total_level_1 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_1, $this->total_level_1); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_2 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_2, $this->total_level_2); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_3 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_3, $this->total_level_3); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_4 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_4, $this->total_level_4); 
           $h_exp .= "<br />"; 
        }
        if ($this->total_level_5 > 0) {
           $h_exp .= $this->get_level_policy($this->total_discount_5, $this->total_level_5); 
           $h_exp .= "<br />"; 
        }

        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $h_exp .= $this->get_level_policy( $this->extra_discounts[$i], $this->extra_levels[$i]);
            $h_exp .= "<br />"; 
        }
  
        $h_exp .= "<br />";
        return $h_exp; 
    }

    // return info as an array; let people format it as they wish
    // Users seeking a preformatted html string should use get_html_policy()
    function get_discount_info($product = 0, $category = 0) {
        $response_arr = array(); 
        if ($this->total_level_1 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_1, $this->total_level_1); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_2 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_2, $this->total_level_2); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_3 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_3, $this->total_level_3); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_4 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_4, $this->total_level_4); 
           $response_arr[] = $h_exp; 
        }

        if ($this->total_level_5 > 0) {
           $h_exp = $this->get_level_policy($this->total_discount_5, $this->total_level_5); 
           $response_arr[] = $h_exp; 
        }

        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $h_exp = $this->get_level_policy( $this->extra_discounts[$i], $this->extra_levels[$i]);
           $response_arr[] = $h_exp; 
        }
        return $response_arr; 
    }

    // Just in case you only want a number and not a string
    function format_discount($discount, $naked) {
        if ($naked) return $discount;
        if ($this->units == 'currency') {
            $off_amt = $this->print_amount($discount);
        } else if ($this->units == 'currency per item') {
            $off_amt = $this->print_amount($discount);
        } else {
            $off_amt = $discount . "%"; 
        }
        return $off_amt; 
    } 

    // I wish there were a few more ways to get this information. :)
    function get_discount_parms($naked = false, $product = 0, $category = 0) {
        $response_arr = array(); 
        $pos = 0; 

        if ($this->total_level_1 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_1, $naked);
           $response_arr[$pos]['level'] = $this->total_level_1;
           $pos++; 
        }

        if ($this->total_level_2 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_2, $naked);
           $response_arr[$pos]['level'] = $this->total_level_2;
           $pos++; 
        }

        if ($this->total_level_3 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_3, $naked);
           $response_arr[$pos]['level'] = $this->total_level_3;
           $pos++; 
        }

        if ($this->total_level_4 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_4, $naked);
           $response_arr[$pos]['level'] = $this->total_level_4;
           $pos++; 
        }

        if ($this->total_level_5 > 0) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->total_discount_5, $naked);
           $response_arr[$pos]['level'] = $this->total_level_5;
           $pos++; 
        }

        for ($i = 0, $n=sizeof($this->extra_levels); $i < $n; $i++) {
           $response_arr[$pos]['discount'] = $this->format_discount($this->extra_discounts[$i], $naked);
           $response_arr[$pos]['level'] = $this->extra_levels[$i];
           $pos++; 
        }
        return $response_arr; 
    }

    // This only works for Discount Units percentage, since 
    // Discount Units currency takes a flat amount off the whole sale.
    // I also think it only makes sense for Discount Basis Total 
    // By Item, but I'm not going to enforce this.
    function get_discounted_prices($product, $category) {
       if ($this->units == 'currency' || $this->units == 'currency per item') {
          return null; 
       }
       $priceinfo = array(); 
       $base = zen_get_products_special_price($product);        
       if ($base == 0) {
           $base =  zen_get_products_base_price($product);        
       }
       $parms = $this->get_discount_parms(true, $product, $category);
       $pos = 0; 
       for ($i = 0; $i < sizeof($parms); $i++) {  
          $priceinfo[$pos]['level'] = $parms[$pos]['level']; 
          $off_amt = $base * ($parms[$pos]['discount']/100);
          $disprice = $base - $off_amt; 
          $priceinfo[$pos]['price'] = $this->print_amount($disprice);
          $pos++; 
       }
       return $priceinfo;
    }

    function get_html_explanation() {
        $h_exp = $this->explanation; 
        $h_exp = str_replace(YOUR_CURRENT_QUANTITY_DISCOUNT, "<h2>".YOUR_CURRENT_QUANTITY_DISCOUNT."</h2>", $h_exp);
        $h_exp = str_replace("\\n","<br />", $h_exp); 
        return $h_exp; 
    }

    function  setup() {
       // Add extra levels and discounts here in this manner: 
       // "Buy more than 100 items, get 50 (% or $, as per admin) off" 
       // $this->add_extra_level_discount(100, 50);
    }
  }
?>
