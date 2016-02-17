<?php
/**
 * specials_index module
 *
 * @package modules
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: specials_index.php 730 2016-02-17 19:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$specials_index_query = '';
$display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $specials_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id, pd.products_description
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
    $specials_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id, pd.products_description
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = s.products_id
                             and p.products_id = pd.products_id
                             and p.products_status = '1' and s.status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $list_of_products . ")";
  }
}
if ($specials_index_query != '') $specials_index = $db->ExecuteRandomMulti($specials_index_query, MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

// BOF Easy Google Analytics module pt2
$google_enhanced_ecommerce_specials_counter = 0;
// BOF Easy Google Analytics module pt2
$num_products_count = ($specials_index_query == '') ? 0 : $specials_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS == 0 ) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
  }

  $list_box_contents = array();
  while (!$specials_index->EOF) {
    $products_price = zen_get_products_display_price($specials_index->fields['products_id']);
    if (!isset($productsInCategory[$specials_index->fields['products_id']])) $productsInCategory[$specials_index->fields['products_id']] = zen_get_generated_category_path_rev($specials_index->fields['master_categories_id']);

    $specials_index->fields['products_name'] = zen_get_products_name($specials_index->fields['products_id']);
// BOF Easy Google Analytics module pt3
   if (GOOGLE_ANALYTICS_ENABLED == "Enabled") {
        $google_enhanced_ecommerce_specials_counter ++;
        $geeImpression =    "\n\n <!-- Google Enhanced ECommerce -->\n"
                          . "<script type=\"text/javascript\"><!--\n"
                          . "ga('ec:addImpression', {\n"
                          . "   'id': '"       . $specials_index->fields['products_id']   . "',\n"
                          . "   'name': '"     . addslashes($specials_index->fields['products_name']) . "',\n"
                          . "   'list':        'Main Page Specials',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_specials_counter . ",\n"
                          . "});\n"
                          . "--></script>\n";

        $geeOnClick =       " onClick=\"ga('ec:addProduct', {\n"
                          . "   'id': '"       . $specials_index->fields['products_id']   . "',\n"
                          . "   'name': '"     . htmlspecialchars(addslashes($specials_index->fields['products_name'])) . "',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_specials_counter . ",\n"
                          . "});\n"
                          . "ga('ec:setAction', 'click', {list: 'Main Page Specials'});\n"
                          . "ga('send', 'event', 'UX', 'click', 'Main Page Specials'); \"";

    } else {
        $geeImpression = "";
        $geeOnClick    = "";
    }
// EOF Easy Google Analytics module pt3

// BOF Easy Google Analytics module pt4 (******MERGE******)   
// * Please merge these files carefully making sure that $geeOnClick is added to all links
// * and $geeImpression is added before the div close in your template files, rest can and should be ignored.
// * The following is just an example.

    $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsNew"' . ' ',
					  'text' => (($specials_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<div class="product_title"><a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '"' . $geeOnClick . '>' . $specials_index->fields['products_name'] . '</a></div>' . '<div class="box_image"><a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '"' . $geeOnClick . '>' . zen_image(DIR_WS_IMAGES . $specials_index->fields['products_image'], $specials_index->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a></div>') .'<div class="price">'.$products_price.'</div>'.'<div class="product_detail"><a href="'. zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '"' . $geeOnClick . '>' .zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT).'</a>'

                         . $geeImpression

					     . '</div>');
// EOF Easy Google Analytics module pt4 (******MERGE******)

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $specials_index->MoveNextRandom();
  }

  if ($specials_index->RecordCount() > 0) {
    $title = '<h2 class="centerBoxHeading">' . sprintf(TABLE_HEADING_SPECIALS_INDEX, strftime('%B')) . '</h2>';
    $zc_show_specials = true;
  }
}
?>