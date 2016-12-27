<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: prod_cat_header_code.php 730 2016-12-27 09:05:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $product_type = (isset($_POST['products_id']) ? zen_get_products_type($_POST['products_id']) : isset($_GET['product_type']) ? $_GET['product_type'] : 1);

  $type_admin_handler = $zc_products->get_admin_handler($product_type);

  function zen_reset_page() {
    global $db, $current_category_id;
    $look_up = $db->Execute("select p.products_id, pd.products_name, p.products_model, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_quantity_order_min, p.products_quantity_order_units, p.products_priced_by_attribute, p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.product_is_always_free_shipping, p.products_quantity_order_max from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . $current_category_id . "' order by pd.products_name");
    while (!$look_up->EOF) {
      $look_count ++;
      if ($look_up->fields['products_id']== $_GET['pID']) {
        exit;
      } else {
        $look_up->MoveNext();
      }
    }
    return round( ($look_count+.05)/MAX_DISPLAY_RESULTS_CATEGORIES);
  }
// make array for product types

  $sql = "select * from " . TABLE_PRODUCT_TYPES;
  $product_types = $db->Execute($sql);
  while (!$product_types->EOF) {
    $product_types_array[] = array('id' => $product_types->fields['type_id'],
                                     'text' => $product_types->fields['type_name']);
  
    $product_types->MoveNext();
  }
?>