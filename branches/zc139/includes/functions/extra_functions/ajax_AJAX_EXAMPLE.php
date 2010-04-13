<?php
/**
 * ajax ::    
 *                      
 * @package ajax_example
 * @copyright Copyright 2007 rainer@langheiter.comn // http://edv.langheiter.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
 
  /**
  * @desc produces a linklist of manufactors
  */
  function rl1($product_id){
      global $db;
      sleep(0);
      $objResponse = new xajaxResponse();
      $mid = zen_get_products_manufacturers_id($product_id);
      $sql = "select " . $select_column_list . " pd.products_name, p.products_id, p.products_type, p.manufacturers_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping, p.products_qty_box_status
                      from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " .
                      TABLE_PRODUCTS_DESCRIPTION . " pd, " .
                      TABLE_MANUFACTURERS . " m
                      where p.products_status = 1
                        and pd.products_id = p.products_id
                        and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                        and p.manufacturers_id = m.manufacturers_id
                        and m.manufacturers_id = '" . $mid . "'" .
                        $alpha_sort;
      $res = $db->execute($sql);
      $tmp ='<hr><strong>MANU</strong><ul>';
      while (!$res->EOF){
          if($product_id != $res->fields['products_id']){
              $link = '<a href="'.zen_href_link('product_info', 'cPath='.zen_get_product_path($res->fields['products_id']).'&products_id='.$res->fields['products_id']).'">'.$res->fields['products_name'].'</a>';
              $tmp .= '<li>' .$link . '</li>';
          }
          $res->MoveNext();
      }
      $tmp .= '</ul>';
      #$objResponse->Assign("ajax-rl1", "innerHTML", "AJAX WAS HERE 1 :: " . $product_id.$tmp);
      $objResponse->Assign("ajax-rl1", "innerHTML", $tmp);
      return $objResponse;
  }
  function rl2(){
      $objResponse = new xajaxResponse();
      $objResponse->Assign("ajax-rl1", "innerHTML", "AJAX WAS HERE 2");
      return $objRespons;
  }

?>
