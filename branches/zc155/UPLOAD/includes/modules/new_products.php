<?php
/**
 * new_products.php module
 *
 * @package modules
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_products.php 730 2016-02-17 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars
$categories_products_id_list = '';
$list_of_products = '';
$new_products_query = '';

$display_limit = zen_get_new_date_range();

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                p.products_date_added, p.products_price, p.products_type, p.master_categories_id,pd.products_description
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and   p.products_status = 1 " . $display_limit;
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma

    $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                  p.products_date_added, p.products_price, p.products_type, p.master_categories_id, pd.products_description
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and p.products_status = 1
                           and p.products_id in (" . $list_of_products . ")";
  }
}

if ($new_products_query != '') $new_products = $db->ExecuteRandomMulti($new_products_query, MAX_DISPLAY_NEW_PRODUCTS);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($new_products_query == '') ? 0 : $new_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS == 0 ) {
    $col_width = floor(100/$num_products_count);
  } else {
    $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS);
  }

  while (!$new_products->EOF) {
    $products_price = zen_get_products_display_price($new_products->fields['products_id']);
    if (!isset($productsInCategory[$new_products->fields['products_id']])) $productsInCategory[$new_products->fields['products_id']] = zen_get_generated_category_path_rev($new_products->fields['master_categories_id']);

// BOF Easy Google Analytics module pt2
$google_enhanced_ecommerce_new_counter = 0;
      
if (GOOGLE_ANALYTICS_ENABLED == "Enabled") {
        $google_enhanced_ecommerce_new_counter ++;
        $geeImpression =    "\n\n <!-- Google Enhanced ECommerce -->\n"
					      . "<script type=\"text/javascript\"><!--\n"
                          . "ga('ec:addImpression', {\n"
                          . "   'id': '"       . $new_products->fields['products_id']   . "',\n"
                          . "   'name': '"     . addslashes($new_products->fields['products_name']) . "',\n"
                          . "   'list':        'Main Page New',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_new_counter . ",\n"
                          . "});\n"
                          . "--></script>\n";

        $geeOnClick =       " onClick=\"ga('ec:addProduct', {\n"
                          . "   'id': '"       . $new_products->fields['products_id']   . "',\n"
                          . "   'name': '"     . htmlspecialchars(addslashes($new_products->fields['products_name'])) . "',\n"
                          . "   'position': "   . $google_enhanced_ecommerce_new_counter . ",\n"
                          . "});\n"
                          . "ga('ec:setAction', 'click', {list: 'Main Page New'});\n"
                          . "ga('send', 'event', 'UX', 'click', 'Main Page New'); \"";

      } else {
        $geeImpression = "";
        $geeOnClick    = "";
      }

// EOF Easy Google Analytics module pt2

// BOF Easy Google Analytics module pt3 (******MERGE******)   
// * Please merge these files carefully making sure that $geeOnClick is added to all links
// * and $geeImpression is added before the div close in your template files, rest can and should be ignored.
// * The following is just an example.
    $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsNew"' . ' ',
					   'text' => (($new_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<div class="product_title"><a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '"' . $geeOnClick . '>' . $new_products->fields['products_name'] . '</a></div>' . '<div class="box_image"><a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '"' . $geeOnClick . '>' . zen_image(DIR_WS_IMAGES . $new_products->fields['products_image'], $new_products->fields['products_name'], IMAGE_PRODUCT_NEW_WIDTH, IMAGE_PRODUCT_NEW_HEIGHT) . '</a></div>') .'<div class="price">'.$products_price.'</div>'.'<div class="product_detail"><a href="'. zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '"' . $geeOnClick . '>' .zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT).'</a>'

                         . $geeImpression

                         . '</div>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $new_products->MoveNextRandom();
  }

  if ($new_products->RecordCount() > 0) {
    if (isset($new_products_category_id) && $new_products_category_id != 0) {
      $category_title = zen_get_categories_name((int)$new_products_category_id);
      $title = '<h2 class="centerBoxHeading">' . sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' ) . '</h2>';
    } else {
      $title = '<h2 class="centerBoxHeading">' . sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</h2>';
    }
    $zc_show_new_products = true;
  }
}
// BOF Easy Google Analytics module pt4

     function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}

// BOF Easy Google Analytics module pt4

?>