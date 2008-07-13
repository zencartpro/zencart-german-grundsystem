<?php
/**
 * Better Together Discounts in the order_total module
 * By Scott Wilson (swguy) 
 * http://www.thatsoftwareguy.com
 * Version 1.6
 * @copyright Copyright 2006, That Software Guy
 * @copyright Portions Copyright 2004-2006 Zen Cart Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

  // Make it pretty obvious that there's a problem
  function bailout($str) { 
      trigger_error($str); 
      die($str); 
  }

  define('PROD_TO_PROD', '1');
  define('PROD_TO_CAT', '2');
  define('CAT_TO_CAT', '3');

  define('TWOFER_PROD', '11');
  define('TWOFER_CAT', '12');

  class bt_discount {
     function init($ident1, $ident2, $type, $amt, $flavor) {
          $this->isvalid = 0; 
          if ($type != "$" && $type != "%") {
              bailout("Bad type " . $type); 
          }
          if ($flavor != PROD_TO_PROD && 
              $flavor != PROD_TO_CAT &&
              $flavor != CAT_TO_CAT) {
              bailout("Bad flavor " . $flavor); 
          }
          $this->ident1 = $ident1; // Product id or category
          $this->ident2 = $ident2; // Product id or category 
          $this->type = $type; // % or $ 
          $this->amt = $amt;   // numerical amount 
          $this->flavor = $flavor; // PROD_TO_PROD, PROD_TO_CAT, CAT_TO_CAT
          $this->isvalid = 1; 
     } 
     function getid() {
          return $this->ident1;
     } 
  }

  class bt_twofer{
     function init($ident1, $flavor) {
          $this->isvalid = 0; 
          if ($flavor != TWOFER_PROD && 
              $flavor != TWOFER_CAT) {
              bailout("Bad flavor " . $flavor); 
          }
          $this->ident1 = $ident1; // Product id or category
          $this->flavor = $flavor; // PROD, CAT
          $this->isvalid = 1; 
     } 
     function getid() {
          return $this->ident1;
     } 
  }

  class ot_better_together {
    var $title, $output;

    function ot_better_together() {
      $this->code = 'ot_better_together';
      $this->title = MODULE_ORDER_TOTAL_BETTER_TOGETHER_TITLE;
      $this->description = MODULE_ORDER_TOTAL_BETTER_TOGETHER_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER;
      $this->include_tax = MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX;
      $this->credit_class = true;
      $this->output = array();
      $this->discountlist = array();
      $this->twoferlist = array();
      $this->nocontext = 0; 
      $this->setup(); 
    }
   
    function setnocontext() { 
      $this->nocontext = 1; 
    } 

    function add_twoforone_prod($ident1) { 
         $d = new bt_twofer; 
         $d->init($ident1, TWOFER_PROD);
         if ($d->isvalid == 1) { 
            $this->twoferlist[] = & $d; 
         }
    }

    function add_twoforone_cat($ident1) { 
         $d = new bt_twofer; 
         $d->init($ident1, TWOFER_CAT);
         if ($d->isvalid == 1) { 
            $this->twoferlist[] = & $d; 
         }
    }
 
    function add_prod_to_prod($ident1, $ident2, $type, $amt)  {
         $d = new bt_discount; 
         $d->init($ident1, $ident2, $type, $amt, PROD_TO_PROD);
         if ($d->isvalid == 1) { 
            $this->discountlist[] = & $d; 
         }
    }

    function add_prod_to_cat($ident1, $ident2, $type, $amt)  {
         $d = new bt_discount; 
         $d->init($ident1, $ident2, $type, $amt, PROD_TO_CAT);
         if ($d->isvalid == 1) { 
            $this->discountlist[] = & $d; 
         }
    }

    function add_cat_to_cat($ident1, $ident2, $type, $amt)  {
         $d = new bt_discount; 
         $d->init($ident1, $ident2, $type, $amt, CAT_TO_CAT);
         if ($d->isvalid == 1) { 
            $this->discountlist[] = & $d; 
         }
    }


    function print_amount($amount) {
      global $db, $order, $currencies;
      return  $currencies->format($amount, true, $order->info['currency'], $order->info['currency_value']);
    }

    function get_discount($discount_item, &$all_items) {
        $discount = 0; 
        for ($dis=0, $n=count($this->discountlist); $dis<$n; $dis++) {
           $li = $this->discountlist[$dis]; 

           // Based on type, check ident1
           if ( ($li->flavor == PROD_TO_PROD) || 
                ($li->flavor == PROD_TO_CAT) ) {
              if ($li->ident1 != $discount_item['id']) {
                 continue;
              }
           } else {
              if ($li->ident1 != $discount_item['category']) {
                 continue;
              }
           }

           for ($i=0, $n1=sizeof($all_items); $i<$n1; $i++) {
               if ($all_items[$i]['quantity'] == 0) 
                  continue;
               $match = 0; 
               if ($li->flavor == PROD_TO_PROD) {
                  if ($all_items[$i]['id'] == $li->ident2) {
                     $match = 1;
                  }
               } else {
                  if ($all_items[$i]['category'] == $li->ident2) {
                     $match = 1;
                  }
               }

               if ($match == 1) { 
                   $all_items[$i]['quantity'] -= 1;
                   if ($li->type == "$") {
                      $discount = $li->amt;
                   } else {
                      $discount = $all_items[$i]['final_price'] *  
                                  $li->amt / 100;
                   }
                   return $discount;
               }
           }
        }

        return 0;
    }

    function is_twofer($discount_item) {
        $discount = 0; 
        for ($dis=0, $n=count($this->twoferlist); $dis<$n; $dis++) {
           $li = $this->twoferlist[$dis]; 

           // Based on type, check ident1
           if ( ($li->flavor == TWOFER_PROD) && 
                ($li->ident1 == $discount_item['id']) ) {
                 return true;
           } else if ( ($li->flavor == TWOFER_CAT) && 
                       ($li->ident1 == $discount_item['category']) ) {
                 return true;
           }
       }
       return false;
    }

    function get_order_total() {
       global  $order;
       $order_total_tax = $order->info['tax'];
       $order_total = $order->info['total'];
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
          $order->info['total'] = $order->info['total'] - $od_amount['total'];
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
       $discountable_products = array();
       // Build discount list 
       for ($i=0, $n=sizeof($products); $i<$n; $i++) {
            $discountable_products[$i] = $products[$i]; 
       }

       // Now compute discounts
       $discount = 0;
       for ($i=0, $n=sizeof($discountable_products); $i<$n; $i++) {
            // Is it a twofer? 
            if ($this->is_twofer($discountable_products[$i])) {
                $npairs = (int)($discountable_products[$i]['quantity']/2);
                $discountable_products[$i]['quantity'] -= ($npairs * 2);
                $item_discountable = $npairs * $discountable_products[$i]['final_price'];
                if ($this->include_tax == 'true') {
                      $discount += $this->gross_up($item_discountable); 
                } else {
                      $discount += $item_discountable;
                }
            }

            // Otherwise, do regular bt processing
            while ($discountable_products[$i]['quantity'] > 0) { 
                $discountable_products[$i]['quantity'] -= 1;
                $item_discountable = $this->get_discount(       
                    $discountable_products[$i], $discountable_products);
                if ($item_discountable == 0) { 
                    $discountable_products[$i]['quantity'] += 1;
                    break;
                } else {
                   if ($this->include_tax == 'true') {
                      $discount += $this->gross_up($item_discountable); 
                   } else {
                      $discount += $item_discountable;
                   }
                }
            }
       }

       $od_amount['total'] = round($discount, 2); 
       switch ($this->calculate_tax) {
       case 'Standard':
          reset($order->info['tax_groups']);
          while (list($key, $value) = each($order->info['tax_groups']))
          {
             $tax_rate = zen_get_tax_rate_from_desc($key);
             if ($tax_rate > 0) {
                $od_amount[$key] = $tod_amount = round((($od_amount['total'] * $tax_rate)) /100, 2) ;
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
       return $gross_up_amt + $net; 
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
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('&copy; That Software Guy<br /><div><a href=\"http://www.thatsoftwareguy.com/donate.html\" target=\"_blank\">Donate</a> - Support this Module</div><div><a href=\"http://www.thatsoftwareguy.com/zencart_better_together.html\" target=\"_blank\">Help</a> - View the Documentation</div><br />This module is installed', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_SORT_ORDER', '292', 'Sort order of display.', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX', 'false', 'Include Tax in calculation.', '6', '3','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX', 'Standard', 'Re-Calculate Tax', '6', '4','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    // call this in product info page
    function get_discount_info($id, $cat) { 
       global $order, $currencies;
       $response_arr = array(); 

       for ($dis=0, $n=count($this->twoferlist); $dis<$n; $dis++) {
           $li = $this->twoferlist[$dis]; 
           $match = 0;
           if ( ($li->flavor == TWOFER_PROD) && 
                ($li->ident1 == $id)  ) {
              $match = 1; 
              if ($this->nocontext == 0) {
                 $disc_string = TWOFER_PROMO_STRING; 
              } else {
                 $disc_link = '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1).'">'. zen_get_products_name($li->ident1, $_SESSION['languages_id']).'</a>';
                 $disc_string = QUALIFY; 
                 $disc_string .= GET_THIS; 
                 $disc_string .= SECOND; 
                 $disc_string .= $disc_link;
                 $disc_string .= FREE;
              }
           } else if ( ($li->flavor == TWOFER_CAT) && 
                       ($li->ident1 == $cat) ) {
              $match = 1; 
              if ($this->nocontext == 0) {
                 $disc_string = TWOFER_CAT_PROMO_STRING; 
              } else {
                 $disc_link = '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $id).'">'. zen_get_products_name($id, $_SESSION['languages_id']).'</a>';
                 $disc_string = QUALIFY; 
                 $disc_string .= GET_THIS; 
                 $disc_string .= SECOND; 
                 $disc_string .= $disc_link;
                 $disc_string .= FREE;
              }
           }
           if ($match == 1) {
              $response_arr[] = $disc_string;
              continue;
           }
       }

       for ($dis=0, $n=count($this->discountlist); $dis<$n; $dis++) {
           $li = $this->discountlist[$dis]; 
           $match = 0; 
           if ( ($li->flavor == PROD_TO_PROD) &&
                ($li->ident1 == $id) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident2).'">'. zen_get_products_name($li->ident2, $_SESSION['languages_id']).'</a>';
           } else if ( ($li->flavor == PROD_TO_CAT) &&
                ($li->ident1 == $id) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident2).'">'. zen_get_category_name($li->ident2, $_SESSION['languages_id']).'</a>';
           } else if ( ($li->flavor == CAT_TO_CAT) &&
                ($li->ident1 == $cat) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident2).'">'. zen_get_category_name($li->ident2, $_SESSION['languages_id']).'</a>';
           }
           if ($match == 1) {
              if ($this->nocontext == 0)  
                 $disc_string = BUY_THIS_ITEM; 
              else 
                 $disc_string = QUALIFY; 
              if ($li->flavor == PROD_TO_PROD) {
                  $disc_string .= GET_THIS; 
              } else {
                  $disc_string .= GET_ANY; 
              } 
              if ( ($li->flavor == PROD_TO_PROD)  &&
                   ($li->ident1 == $li->ident2) && 
                   ($this->nocontext == 0) ) {
                     $disc_string .= SECOND_ONE;
              } else { 
                  $disc_string .= $disc_link; 
              }
              $disc_string .= " "; 
              if ($li->type == "%") {
                 if ($li->amt != 100) {
                    $str_amt = $li->amt . "%"; 
                    $off_string = sprintf(OFF_STRING_PCT, $str_amt);
                 } else {
                    $off_string = FREE_STRING;
                 }
                 $disc_string .= $off_string;
              } else {
                 $curr_string = $currencies->format($li->amt, true, $order->info['currency'], $order->info['currency_value']);
                 $off_string = sprintf(OFF_STRING_CURR, $curr_string); 
                 $disc_string .= $off_string;
              }
              $response_arr[] = $disc_string;
           }
       }
       return $response_arr;
    }

    // call this in product info page to show what to do to get a 
    // discount (the opposite way.)
    function get_reverse_discount_info($id, $cat) { 
       global $order, $currencies;
       $response_arr = array(); 

       for ($dis=0, $n=count($this->discountlist); $dis<$n; $dis++) {
           $li = $this->discountlist[$dis]; 
           $match = 0; 
           if ($li->ident2 == $li->ident1) {
               continue;
           }
           $this_string = REV_GET_DISC; 
           if ( ($li->flavor == PROD_TO_PROD) &&
                ($li->ident2 == $id) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1).'">'. zen_get_products_name($li->ident1, $_SESSION['languages_id']).'</a>';
              if ($this->nocontext == 1) { 
                   $this_string = GET_YOUR_PROD . zen_get_products_name($li->ident2, $_SESSION['languages_id']); 
              }
           } else if ( ($li->flavor == PROD_TO_CAT) &&
                ($li->ident2 == $cat) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1).'">'. zen_get_products_name($li->ident1, $_SESSION['languages_id']).'</a>';
              if ($this->nocontext == 1) { 
                   $this_string = GET_YOUR_CAT . zen_get_category_name($li->ident2, $_SESSION['languages_id']); 
              }
           } else if ( ($li->flavor == CAT_TO_CAT) &&
                ($li->ident2 == $cat) ) {
              $match = 1; 
              $disc_link = '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident1).'">'. zen_get_category_name($li->ident1, $_SESSION['languages_id']).'</a>';
              if ($this->nocontext == 1) { 
                   $this_string = GET_YOUR_CAT . zen_get_category_name($li->ident2, $_SESSION['languages_id']); 
              }
           }
           if ($match == 1) {
              if ( ($li->flavor == PROD_TO_PROD) || 
                   ($li->flavor == PROD_TO_CAT) )  {
                  $disc_string = REV_GET_THIS; 
              } else {
                  $disc_string = REV_GET_ANY; 
              } 
              $disc_string .= $disc_link; 
              $disc_string .= $this_string; 
              if ($li->type == "%") {
                 if ($li->amt != 100) {
                    $str_amt = $li->amt . "%"; 
                    $off_string = sprintf(OFF_STRING_PCT, $str_amt);
                 } else {
                    $off_string = FREE_STRING;
                 }
                 $disc_string .= $off_string;
              } else {
                 $curr_string = $currencies->format($li->amt, true, $order->info['currency'], $order->info['currency_value']);
                 $off_string = sprintf(OFF_STRING_CURR, $curr_string); 
                 $disc_string .= $off_string;
              }
              $response_arr[] = $disc_string;
           }
       }
       return $response_arr;
    }


    function setup() {
         // Add all linkages here
         // Some examples are provided: 
/*
         // Buy product 83, get product 53 at 50% off 
         $this->add_prod_to_prod(83, 53, "%", 50); 

         // Buy product 83, get one free 
         $this->add_prod_to_prod(83, 83, "%", 100); 

         // Buy product 83, get an item from category 14 free 
         $this->add_prod_to_cat(83, 14, "%", 100); 

         // Buy an item from category 21, get an item from category 14 free
         $this->add_cat_to_cat(21, 14, "%", 100); 

         // Buy item 12, get a second one free.
         $this->add_twoforone_prod(12);

         // Buy any item from category 10, get a second identical one free
         $this->add_twoforone_cat(10);

         // $this->add_twoforone_prod(17);
         $this->add_prod_to_prod(26, 27, "%", 100); 
         $this->add_prod_to_prod(83, 15, "%", 50); 
         $this->add_prod_to_prod(83, 20, "%", 25); 
         $this->add_cat_to_cat(14, 14, "%", 100); 
         $this->add_prod_to_prod(3, 25, "%", 50); 
*/
    }

  }
?>
