<?php
/**
 * featured_products module - prepares content for display
 *
 * @package modules
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: featured_products.php 730 2016-02-17 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$featured_products_query = '';
$display_limit = '';


if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id,pd.products_description
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1 and f.status = 1
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
    $featured_products_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id,pd.products_description
                                from (" . TABLE_PRODUCTS . " p
                                left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                                left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id)
                                where p.products_id = f.products_id
                                and p.products_id = pd.products_id
                                and p.products_status = 1 and f.status = 1
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and p.products_id in (" . $list_of_products . ")";
  }
}
if ($featured_products_query != '') $featured_products = $db->ExecuteRandomMulti($featured_products_query, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';
// BOF Easy Google Analytics module pt3
$google_enhanced_ecommerce_featured_counter = 0;
// EOF Easy Google Analytics module pt3

$num_products_count = ($featured_products_query == '') ? 0 : $featured_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS == 0) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS);
  }
  while (!$featured_products->EOF) {
    $products_price = zen_get_products_display_price($featured_products->fields['products_id']);
    if (!isset($productsInCategory[$featured_products->fields['products_id']])) $productsInCategory[$featured_products->fields['products_id']] = zen_get_generated_category_path_rev($featured_products->fields['master_categories_id']);

// BOF Easy Google Analytics module  pt4
     if (GOOGLE_ANALYTICS_ENABLED == "Enabled") {
        $google_enhanced_ecommerce_featured_counter ++;
        $geeImpression =    "\n\n <!-- Google Enhanced ECommerce -->\n"
					      . "<script type=\"text/javascript\"><!--\n"
                          . "ga('ec:addImpression', {\n"
                          . "   'id': '"       . $featured_products->fields['products_id']   . "',\n"
                          . "   'name': '"     . addslashes($featured_products->fields['products_name']) . "',\n"
                          . "   'list':        'Main Page Featured',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_featured_counter . ",\n"
                          . "});\n"
                          . "--></script>\n";

        $geeOnClick =       " onClick=\"ga('ec:addProduct', {\n"
                          . "   'id': '"       . $featured_products->fields['products_id']   . "',\n"
                          . "   'name': '"     . htmlspecialchars(addslashes($featured_products->fields['products_name'])) . "',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_featured_counter . ",\n"
                          // . "});} \"\n";
                          . "});\n"
                          . "ga('ec:setAction', 'click', {list: 'Main Page Featured'});\n"
                          . "ga('send', 'event', 'UX', 'click', 'Main Page Featured'); \"";


      } else {
        $geeImpression = "";
        $geeOnClick    = "";
      }

// EOF Easy Google Analytics module pt4

// BOF Easy Google Analytics module pt5 (****MERGE****)
// * Please merge these files carefully making sure all places that $geeOnClick is added to all links
// * and $geeImpression just before end of dev to the $list_box_contents is added to your template files, rest can and should be ignored. 
    $list_box_contents[$row][$col] = array('params' =>'class="centerBoxContentsFeatured centeredContent back"' . ' ' . 'style="width:' . $col_width . '%;"',
   					                         'text' => (($featured_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<div class="product_title"><a href="'
					                             . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath='
					                             . $productsInCategory[$featured_products->fields['products_id']]
					                             . '&products_id=' . $featured_products->fields['products_id']) . '"' . $geeOnClick . '>'
					                             . $featured_products->fields['products_name']
					                             . '</a></div>'
					                             . '<div class="box_image"><a href="' . zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '"' . $geeOnClick . '>' . zen_image(DIR_WS_IMAGES . $featured_products->fields['products_image'], $featured_products->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a></div>')
					                             . '<div class="price">'.$products_price.'</div>'
					                             . '<div class="product_detail"><a href="'. zen_href_link(zen_get_info_page($featured_products->fields['products_id']), 'cPath=' . $productsInCategory[$featured_products->fields['products_id']] . '&products_id=' . $featured_products->fields['products_id']) . '"' . $geeOnClick . '>'
					                             . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT).'</a>'

                                                 . $geeImpression

					                             . '</div>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $featured_products->MoveNextRandom();
  }

  if ($featured_products->RecordCount() > 0) {
    if (isset($new_products_category_id) && $new_products_category_id !=0) {
      $category_title = zen_get_categories_name((int)$new_products_category_id);
      $title = '<h2 class="centerBoxHeading">' . TABLE_HEADING_FEATURED_PRODUCTS . ($category_title != '' ? ' - ' . $category_title : '') . '</h2>';
    } else {
      $title = '<h2 class="centerBoxHeading">' . TABLE_HEADING_FEATURED_PRODUCTS . '</h2>';
    }
    $zc_show_featured = true;
  }
}
?>