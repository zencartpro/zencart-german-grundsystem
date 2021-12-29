<?php
/**
 * Zen Cart German Specific
 * Specials
 * @package page
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: main_template_vars.php 731 2019-04-12 12:49:16Z webchills $
 */

if (MAX_DISPLAY_SPECIAL_PRODUCTS > 0 ) {
// Start Salesmaker to Specials //	
	$disp_order_default = PRODUCT_ALL_LIST_SORT_DEFAULT;
	require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_LISTING_DISPLAY_ORDER));
	$order_by = isset($order_by) ? $order_by : 'ORDER BY s.specials_date_added DESC';
	$sale_categories = $db->Execute("SELECT sale_categories_all FROM " . TABLE_SALEMAKER_SALES . " WHERE sale_status = 1");

if ($sale_categories->RecordCount() > 0){
	$sale_categories_all = '';
	while(!$sale_categories->EOF) {
	  	$sale_categories_all .= substr($sale_categories->fields['sale_categories_all'], 0, -1); 
		  $sale_categories->MoveNext();
	}
	$sale_categories_all = substr($sale_categories_all, 1); 

        $specials_query_raw = "SELECT p.products_type, p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id,
                                    p.products_date_added,  p.products_model, p.products_quantity, p.products_weight, p.product_is_call,
                                    p.product_is_always_free_shipping, p.products_qty_box_status,
                                    p.master_categories_id
                         FROM " . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_SPECIALS . " s ON (s.products_id = p.products_id)
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (pd.products_id = p.products_id)
                         WHERE p.products_status = '1'
                           AND ( (s.status = 1 AND p.products_id = s.products_id) OR (p.master_categories_id IN ($sale_categories_all)) )
                           AND p.products_id = pd.products_id
                           AND pd.language_id = :languagesID
                         ".$extra.' '.$order_by;

} else {
  
        $specials_query_raw = "SELECT p.products_type, p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id,
                                    p.products_date_added,  p.products_model, p.products_quantity, p.products_weight, p.product_is_call,
                                    p.product_is_always_free_shipping, p.products_qty_box_status,
                                    p.master_categories_id
                         FROM (" . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                         WHERE p.products_id = s.products_id and p.products_id = pd.products_id and p.products_status = '1'
                           AND s.status = 1
                           AND pd.language_id = :languagesID
                         ".$extra.' '.$order_by;
}

  $specials_query_raw = $db->bindVars($specials_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');
  
  $zco_notifier->notify('NOTIFY_SPECIALS_MAIN_TEMPLATE_VARS_SQL_STRING', array(), $specials_query_raw);
  
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);
  $specials = $db->Execute($specials_split->sql_query);
  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  $num_products_count = $specials->RecordCount();
  if ($num_products_count) {
    if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS==0 ) {
      $col_width = floor(100/$num_products_count);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
    }

    $list_box_contents = array();
    while (!$specials->EOF) {

      $products_price = zen_get_products_display_price($specials->fields['products_id']);
      $specials->fields['products_name'] = zen_get_products_name($specials->fields['products_id']);
      $list_box_contents[$row][$col] = array('params' => 'class="specialsListBoxContents"' . ' ' . 'style="width:' . $col_width . '%;"',
                                             'text' => '<a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . (($specials->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : zen_image(DIR_WS_IMAGES . $specials->fields['products_image'], $specials->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>') . '<br /><a href="' . zen_href_link(zen_get_info_page($specials->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($specials->fields['master_categories_id']) . '&products_id=' . $specials->fields['products_id']) . '">' . $specials->fields['products_name'] . '</a><br />' . $products_price);
      $col ++;
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $specials->MoveNext();
    }
    
    $zco_notifier->notify('NOTIFY_SPECIALS_MAIN_TEMPLATE_VARS_END', array(), $list_box_contents);
    
    require($template->get_template_dir('tpl_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_specials_default.php');
  }
}
