<?php
/**
 * @package admin
 * @copyright Portions Copyright 2006 Paul Mathot http://www.beterelektro.nl/zen-cart
 * @copyright Copyright 2006 Andrew Berezin andrew@eCommerce-service.com
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version quick_updates 2.03
 */

 require('includes/application_top.php');

// to add a products column look for:
// added for QUICKUPDATES_NEW_COLUMN_1
// and use it as an example to add your own

// added for QUICKUPDATES_NEW_COLUMN_1
// note: these 3 settings have been moved to config file (extra_configures/quick_updates.php)
//define('QUICKUPDATES_MODIFY_NEW_COLUMN_1', 'true');
//define('QUICKUPDATES_NEW_COLUMN_1', 'products_artlid');
//define('TABLE_HEADING_NEW_COLUMN_1', 'artlid');

$export_products = array();

// ? without this line the taxprice will be rounded to 0 decimals
$currencies->currencies[DEFAULT_CURRENCY]['decimal_places'] = 4;

define('QUICKUPDATES_DISPLAY_TVA_PRICES', QUICKUPDATES_DISPLAY_TVA_OVER);

// bof functions
function zen_quickupdates_table_head($sort_field, $head_text, $cols=1) {
  $str = '';
  $str .= '<td class="dataTableHeadingContent" align="center" valign="middle"' . ($cols > 1 ? ' colspan="' . $cols . '"' : '') . '>';
  if($sort_field != '') {
    $str .= '<a href="' . zen_href_link(FILENAME_QUICK_UPDATES, 'sort_by=' . trim($sort_field) . ' ASC') . '">' . zen_image(DIR_WS_IMAGES . 'icon_up.gif', TEXT_SORT_ALL . $head_text . ' ' . TEXT_ASCENDINGLY) . '</a>';
    $str .= '<a href="' . zen_href_link(FILENAME_QUICK_UPDATES, 'sort_by=' . trim($sort_field) . ' DESC') . '">' . zen_image(DIR_WS_IMAGES . 'icon_down.gif', TEXT_SORT_ALL . $head_text . ' ' . TEXT_DESCENDINGLY) . '</a><br />';
  }
  $str .= $head_text . '</td>';
  return $str;
}
// eof functions

// bof GET paramaters to/from $_SESSION array & product copy stuff
if ($_POST['quick_copy_from_id'] > 0)
  $_SESSION['quick_updates']['quick_copy_from_id'] = (int)$_POST['quick_copy_from_id'];
if (!((int)$_SESSION['quick_updates']['quick_copy_from_id']) > 0)
  $_SESSION['quick_updates']['quick_copy_from_id'] = (int)QUICKUPDATES_COPY_PRODUCT_ID_DEFAULT;

if (isset($_POST['quick_copy_number']))
  $_SESSION['quick_updates']['quick_copy_number'] = (int)$_POST['quick_copy_number'];
if (!(isset($_SESSION['quick_updates']['quick_copy_number'])))
  $_SESSION['quick_updates']['quick_copy_number'] = 0;
  
////
// This module changes the $_POST array! (moves import data to $_POST['quick_updates_new'])
if(is_file(DIR_WS_MODULES . 'quick_import.php')) include_once(DIR_WS_MODULES . 'quick_import.php');

$products_copied = 0;
unset($quick_copy);
if($_POST['quick_updates_copy']){
  for($i = 1; $i <= $_SESSION['quick_updates']['quick_copy_number']; $i++ ){
    if(zen_products_id_valid($_SESSION['quick_updates']['quick_copy_from_id'])){
      $quick_copy = quick_copy_product($_SESSION['quick_updates']['quick_copy_from_id']);
      // returns: $quick_copy['master_categories_id'] &  $quick_copy_products_id = $quick_copy['products_id'];
    }else{
       $messageStack->add(TEXT_PRODUCT_COPY_FROM_INVALID . '<strong>' . $_SESSION['quick_updates']['quick_copy_from_id'] . '</strong>', 'error'); 
    }
      
    if($quick_copy){
      $products_copied .= $quick_copy['products_id'] . '; ';
    }
  }
  if($quick_copy){
    $messageStack->add(TEXT_PRODUCT_COPIED_FROM . '<strong>' . $_SESSION['quick_updates']['quick_copy_from_id'] . '</strong>' . TEXT_PRODUCT_COPIED_TO_PRODUCTS_ID . '<strong>' . $products_copied . '</strong>' . TEXT_PRODUCT_COPIED_TO_MASTER_CATEGORIES_ID . '<strong>' .$quick_copy['master_categories_id'] . '</strong>' . TEXT_PRODUCT_COPIED_SELECTION_CHANGED_WARNING, 'success');
  }
}
if($quick_copy){
  // a product has been copied, make sure it will show in the listing
  $_SESSION['quick_updates']['cPath'] = (int)$quick_copy['master_categories_id'];
  $_SESSION['quick_updates']['products_status'] = 'all';
  $_SESSION['quick_updates']['manufacturer'] = 0;
  $_SESSION['quick_updates']['sort_by'] = 'p.products_id DESC';
  //$messageStack->add(TEXT_PRODUCT_COPIED_FROM . '<strong>' . $_SESSION['quick_updates']['quick_copy_from_id'] . '</strong>' . TEXT_PRODUCT_COPIED_TO_PRODUCTS_ID . '<strong>' . $quick_copy['products_id'] . '</strong>' . TEXT_PRODUCT_COPIED_TO_MASTER_CATEGORIES_ID . '<strong>' .$quick_copy['master_categories_id'] . '</strong>' . TEXT_PRODUCT_COPIED_SELECTION_CHANGED_WARNING, 'success');
}

if (isset($_GET['products_status']))
  /// do not convert to int here! (conversion is done later anyway)
  $_SESSION['quick_updates']['products_status'] = zen_db_prepare_input($_GET['products_status']);
// set the products_status view back to all (is not numeric) if a product has been copied (copied products are inactive by default)
if(!isset($_SESSION['quick_updates']['products_status']) || $_POST['quick_updates_copy'])
  $_SESSION['quick_updates']['products_status'] = 'all';

$current_category_id = 0;
if (isset($_GET['cPath']))
  $_SESSION['quick_updates']['cPath'] = (int)$_GET['cPath'];
if(isset($_SESSION['quick_updates']['cPath']))
  //$cPath = $_SESSION['quick_updates']['cPath'];
  $current_category_id = $_SESSION['quick_updates']['cPath'];


if (isset($_REQUEST['categories_switch']))
  $_SESSION['quick_updates']['categories_switch'] = zen_db_prepare_input($_REQUEST['categories_switch']);
if(!isset($_SESSION['quick_updates']['categories_switch']))
  $_SESSION['quick_updates']['categories_switch'] = 'linked_cats'; // or master_cats
  
$sort_by = 'p.products_id DESC';
if (isset($_GET['sort_by']))
  $_SESSION['quick_updates']['sort_by'] = zen_db_prepare_input($_GET['sort_by']);
if(isset($_SESSION['quick_updates']['sort_by']))
  $sort_by = $_SESSION['quick_updates']['sort_by'];
// by default show most recent added products first

$manufacturer = 0;
if (isset($_GET['manufacturer']))
  $_SESSION['quick_updates']['manufacturer'] = (int)$_GET['manufacturer'];
if(isset($_SESSION['quick_updates']['manufacturer']))
  $manufacturer = $_SESSION['quick_updates']['manufacturer'];

$reset_editor = 1;
if (isset($_GET['reset_editor']))
  $_SESSION['quick_updates']['reset_editor'] = (int)$_GET['reset_editor'];
if(isset($_SESSION['quick_updates']['reset_editor']))
  $reset_editor = $_SESSION['quick_updates']['reset_editor'];
// possible to default to the editor set in admin?

// using the stored pagenumber doesn't always make sense, reset it in that cases
if(isset($_POST['quick_updates_copy']) || isset($_REQUEST['row_by_page']) || isset($_REQUEST['products_status']) || isset($_REQUEST['sort_by']))
  $_SESSION['quick_updates']['page'] = 1;
if($_REQUEST['page'])
  $_SESSION['quick_updates']['page'] = (int)$_REQUEST['page'];

if(isset($_SESSION['quick_updates']['page']))
  $page = $_SESSION['quick_updates']['page'];

if (isset($_GET['row_by_page']))
  $_SESSION['quick_updates']['row_by_page'] = (int)$_GET['row_by_page'];
if(isset($_SESSION['quick_updates']['row_by_page']))
  $row_by_page = $_SESSION['quick_updates']['row_by_page'];
if(!($row_by_page > 0)) $row_by_page = MAX_DISPLAY_SEARCH_RESULTS;
  define('MAX_DISPLAY_ROW_BY_PAGE' , $row_by_page );

// eof GET paramaters to/from $_SESSION array & product copy stuff

// define the szen for rollover lines per page
$row_bypage_array = array();
//for ($i = 10; $i <=100 ; $i=$i+5)
for ($i = 5; $i <= 320 ; $i=$i*2) {
  $row_bypage_array[] = array('id' => $i,
                              'text' => $i);
}

// bof get tx classes
$tax_class_array = array(array('id' => '0', 'text' => NO_TAX_TEXT));
$classes = $db->Execute("select tax_class_id, tax_class_title
                         from " . TABLE_TAX_CLASS . "
                         order by tax_class_title");
while (!$classes->EOF) {
  $tax_class_array[] = array('id' => $classes->fields['tax_class_id'],
                             'text' => $classes->fields['tax_class_title']);
  $classes->MoveNext();
}
// eof get tx classes

// bof get manufacturers
$manufacturers_array = array(array('id' => '0', 'text' => NO_MANUFACTURER));
//$manufacturers_array = array(array('id' => '0', 'text' => TEXT_ALL_MANUFACTURERS));
$manufacturers = $db->Execute("select manufacturers_id, manufacturers_name
                         from " . TABLE_MANUFACTURERS . "
                         order by manufacturers_name");
while (!$manufacturers->EOF) {
  $manufacturers_array[] = array('id' => $manufacturers->fields['manufacturers_id'],
                                 'text' => $manufacturers->fields['manufacturers_name']);
  $manufacturers->MoveNext();
}
// eof get manufacturers
// bof get category_tree
$quick_updates_category_tree = zen_get_category_tree();
// eof get category_tree

// bof Update database
switch ($_GET['action']) {
  case 'update' :
    // bof prepare al new data for database input
    if(sizeof($_POST['quick_updates_new']) > 0){
      foreach($_POST['quick_updates_new'] as $key => $value){
        // $value is an array here (contains values like ['products_model'][$products_id] = '1' for example)
        $_POST['quick_updates_new'][$key] = zen_db_prepare_input($value);
      }
    }
    // eof prepare al new data for database input

    $quick_updates_count = array();
    if($_POST['quick_updates_new']['products_model']){;
      foreach($_POST['quick_updates_new']['products_model'] as $products_id => $new_value) {
        if (trim($_POST['quick_updates_new']['products_model'][$products_id]) != trim($_POST['quick_updates_old']['products_model'][$products_id])) {
          $quick_updates_count['products_model'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_model='" . zen_db_input($new_value) . "', products_last_modified=NOW() WHERE products_id=" . (int)$products_id);
        }
      }
    }

    // added for QUICKUPDATES_NEW_COLUMN_1
    if($_POST['quick_updates_new'][QUICKUPDATES_NEW_COLUMN_1]){
      foreach($_POST['quick_updates_new'][QUICKUPDATES_NEW_COLUMN_1] as $products_id => $new_value) {
        if ($_POST['quick_updates_new'][QUICKUPDATES_NEW_COLUMN_1][$products_id] != $_POST['quick_updates_old'][QUICKUPDATES_NEW_COLUMN_1][$products_id]) {
          $quick_updates_count[QUICKUPDATES_NEW_COLUMN_1][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET " . QUICKUPDATES_NEW_COLUMN_1 . "='" . $new_value . "' WHERE products_id =" . (int)$products_id);
        }
      }
    }
            
    if($_POST['quick_updates_new']['products_name']){
      foreach($_POST['quick_updates_new']['products_name'] as $products_id => $new_value) {
        if (trim(stripslashes($_POST['quick_updates_new']['products_name'][$products_id])) != trim(stripslashes($_POST['quick_updates_old']['products_name'][$products_id]))) {
          $quick_updates_count['products_name'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET products_name='" . zen_db_input($new_value) . "' WHERE products_id=" . (int)$products_id . " and language_id=" . (int)$_SESSION['languages_id']);
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['products_description']){
      foreach($_POST['quick_updates_new']['products_description'] as $products_id => $new_value) {
        if (trim(stripslashes($_POST['quick_updates_new']['products_description'][$products_id])) != trim(stripslashes($_POST['quick_updates_old']['products_description'][$products_id]))) {
          $quick_updates_count['products_description'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS_DESCRIPTION . " SET products_description='" . zen_db_input($new_value) . "' WHERE products_id=" . (int)$products_id . " and language_id=" . (int)$_SESSION['languages_id']);
        }
      }
    }
    if($_POST['quick_updates_new']['products_price']){
      foreach($_POST['quick_updates_new']['products_price'] as $products_id => $new_value) {
        // we look if it's a price markup and if so we look if this product has been unchecked for the markup
        if((!isset($_POST['flag_markup'])) || ($_POST['markup_checked'][$products_id] == true)){
          // not doing markups, or this product is checked for markup
          // (this saves a lot of obsolete hidden $_POST's,  when not doing price markups)
          $apply_price_update = true;
        }else{
          // doing markups, but this products is not checked
          $apply_price_update = false;
        }
        if (($_POST['quick_updates_new']['products_price'][$products_id] != $_POST['quick_updates_old']['products_price'][$products_id]) && $apply_price_update) {
          $quick_updates_count['products_price'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_price='" . zen_db_input($new_value) . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
          // fix the sort order for prices (catalog side)
          zen_update_products_price_sorter((int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['products_weight']){
      foreach($_POST['quick_updates_new']['products_weight'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_weight'][$products_id] != $_POST['quick_updates_old']['products_weight'][$products_id]) {
          $quick_updates_count['products_weight'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_weight='" . zen_db_input($new_value) . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['products_quantity']){
      foreach($_POST['quick_updates_new']['products_quantity'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_quantity'][$products_id] != $_POST['quick_updates_old']['products_quantity'][$products_id]) {
          $quick_updates_count['products_quantity'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_quantity='" . zen_db_input($new_value) . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['manufacturers_id']){
      foreach($_POST['quick_updates_new']['manufacturers_id'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['manufacturers_id'][$products_id] != $_POST['quick_updates_old']['manufacturers_id'][$products_id]) {
          $quick_updates_count['manufacturers_id'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET manufacturers_id='" . (int)$new_value . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['products_sort_order']){
      foreach($_POST['quick_updates_new']['products_sort_order'] as $products_id => $new_value) {
        if (trim($_POST['quick_updates_new']['products_sort_order'][$products_id]) != trim($_POST['quick_updates_old']['products_sort_order'][$products_id])) {
          $quick_updates_count['products_sort_order'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_sort_order='" . zen_db_input($new_value) . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['products_image']){
      foreach($_POST['quick_updates_new']['products_image'] as $products_id => $new_value) {
        if (trim($_POST['quick_updates_new']['products_image'][$products_id]) != trim($_POST['quick_updates_old']['products_image'][$products_id])) {
          $quick_updates_count['products_image'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_image='" . zen_db_input($new_value) . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_old']['products_status']){
      foreach($_POST['quick_updates_old']['products_status'] as $products_id => $status) {
        if(!isset($_POST['quick_updates_new']['products_status'][$products_id])) $_POST['quick_updates_new']['products_status'][$products_id] = '0';
        if ($_POST['quick_updates_new']['products_status'][$products_id] != $_POST['quick_updates_old']['products_status'][$products_id]) {
          $quick_updates_count['products_status'][$products_id] = $products_id;
          zen_set_product_status((int)$products_id, (int)$_POST['quick_updates_new']['products_status'][$products_id]);
        }
      }
    }
    if($_POST['quick_updates_new']['products_tax_class_id']){
      foreach($_POST['quick_updates_new']['products_tax_class_id'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_tax_class_id'][$products_id] != $_POST['quick_updates_old']['products_tax_class_id'][$products_id]) {
          $quick_updates_count['products_tax_class_id'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_tax_class_id='" . (int)$new_value . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
        }
      }
    }
    if($_POST['quick_updates_new']['categories_id']){
      foreach($_POST['quick_updates_new']['categories_id'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['categories_id'][$products_id] != $_POST['quick_updates_old']['categories_id'][$products_id]) {
          if(zen_childs_in_category_count($new_value)) {
            $messageStack->add(TEXT_CATEGORY_WITH_CHILDS . ' ' . zen_get_category_name($new_value, (int)$_SESSION["languages_id"]) . ' [' . $new_value . ']', 'error');
            continue;
          }
          // if the categories_id that links the master_categories_id is updated, we update the master accordingly (to prevent invalid linked master id's)
          if($_POST['quick_updates_old']['categories_id'] == $_POST['quick_updates_old']['master_categories_id']){
            $quick_updates_count['master_categories_id'][$products_id] = $products_id;
            $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET master_categories_id='" . (int)$new_value . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
            zen_update_products_price_sorter((int)$products_id); // needed?
          }
          $quick_updates_count['categories_id'][$products_id] = $products_id;
          //$db->Execute("INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES . " SET categories_id='" . (int)$new_value . "', products_id=" . (int)$products_id . " WHERE products_id=" . (int)$products_id) . " AND categories_id=" . (int)$_POST['quick_updates_old']['categories_id'][$products_id]);
          // changed INSERT INTO to UPDATE to prevent conflicts
          $db->Execute("UPDATE " . TABLE_PRODUCTS_TO_CATEGORIES . " SET categories_id='" . (int)$new_value . "', products_id=" . (int)$products_id . " WHERE products_id=" . (int)$products_id . " AND categories_id=" . (int)$_POST['quick_updates_old']['categories_id'][$products_id]);
        }
      }
    }

    if($_POST['quick_updates_new']['master_categories_id']){
      foreach($_POST['quick_updates_new']['master_categories_id'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['master_categories_id'][$products_id] != $_POST['quick_updates_old']['master_categories_id'][$products_id]) {
          if(zen_childs_in_category_count($new_value)) {
            $messageStack->add(TEXT_CATEGORY_WITH_CHILDS . ' ' . zen_get_category_name($new_value, (int)$_SESSION["languages_id"]) . ' [' . $new_value . ']', 'error');
            continue;
          }
          // add invalid warning here?? (if the new master_cat is not linked)
          $quick_updates_count['master_categories_id'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET master_categories_id='" . (int)$new_value . "', products_last_modified=now() WHERE products_id=" . (int)$products_id);
          zen_update_products_price_sorter((int)$products_id); // needed?       
        }
      }
    }
    
    // added for products_purchase_price and margin
    if($_POST['quick_updates_new']['products_purchase_price']){
      foreach($_POST['quick_updates_new']['products_purchase_price'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_purchase_price'][$products_id] != $_POST['quick_updates_old']['products_purchase_price'][$products_id]) {
          $quick_updates_count['products_purchase_price'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_purchase_price='" . $new_value . "', products_last_modified=now() WHERE products_id =" . (int)$products_id);
        }
      }
    }

    // added for products_purchase_price and margin
    if($_POST['quick_updates_new']['products_margin']){
      foreach($_POST['quick_updates_new']['products_margin'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_margin'][$products_id] != $_POST['quick_updates_old']['products_margin'][$products_id]) {
          $quick_updates_count['products_margin'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_margin='" . $new_value . "', products_last_modified=now() WHERE products_id =" . (int)$products_id);
        }
      }
    }

    // added for p.products_price_w
    if($_POST['quick_updates_new']['products_price_w']){
      foreach($_POST['quick_updates_new']['products_price_w'] as $products_id => $new_value) {
        if ($_POST['quick_updates_new']['products_price_w'][$products_id] != $_POST['quick_updates_old']['products_price_w'][$products_id]) {
          $quick_updates_count['products_price_w'][$products_id] = $products_id;
          $db->Execute("UPDATE " . TABLE_PRODUCTS . " SET products_price_w='" . $new_value . "', products_last_modified=now() WHERE products_id =" . (int)$products_id);
        }
      }
    }

    $quick_updates_count_string = '';
    if(sizeof($quick_updates_count) > 0){
      $quick_updates_count_string = '<table id="quick_updates_count">' . "\n";
      foreach($quick_updates_count as $key => $value){
        $quick_updates_count_string .=  '<tr><th>' . $key . TEXT_PRODUCTS_UPDATED_IDS . ': </th><td>' . implode(', ',$value) . '</td></tr>' . "\n";
        foreach($value as $key2 => $value2){
          $quick_updates_ids[$key2] = true;
        }
      }
      $quick_updates_count_string .= '</table>' . "\n";

      $messageStack->add(sizeof($quick_updates_ids) . ' ' . TEXT_PRODUCTS_UPDATED . $quick_updates_count_string, 'success');
    }

    break;

  case 'calcul' :
    if ($_POST['price_markup']) $preview_markup_price = true;
    break;
} // end switch ($_GET['action'])
// eof Update database

// bof get products data from db
//// control string sort page
  if ($sort_by && !ereg('order by', $sort_by)){
     $sort_by = 'order by ' . $sort_by ;
   }else{
     // added default sort order
      $sort_by = 'order by ' . 'products_id DESC' ;
   }

  //// controle lenght (lines per page)
  $split_page = $page;
  if ($split_page > 1)
    $rows = $split_page * MAX_DISPLAY_ROW_BY_PAGE - MAX_DISPLAY_ROW_BY_PAGE;

  $extra_query = '';
  // added for products_purchase_price and margin
  if(QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN == 'true')
    $extra_query .= ' p.products_purchase_price, p.products_margin,';

  // added for p.products_price_w
  if(QUICKUPDATES_MODIFY_WHOLESALE_PRICE == 'true')
    $extra_query .= ' p.products_price_w,';
    
  // added for QUICKUPDATES_NEW_COLUMN_1
  if(QUICKUPDATES_MODIFY_NEW_COLUMN_1 == 'true')
    $extra_query .= ' p.' . QUICKUPDATES_NEW_COLUMN_1 . ',';   
    
  $products_query_raw = "select p.products_id, p.products_type, p.products_image,
                                " . $extra_query . "
                                p.products_model, pd.products_name, p.products_status,
                                p.products_weight, p.products_quantity, p.manufacturers_id,
                                p.products_price, p.products_tax_class_id, p.products_date_added,
                                p.products_last_modified, p.products_date_available,
                                p.products_quantity_order_min, p.products_quantity_order_units, p.products_priced_by_attribute,
                                p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.product_is_always_free_shipping,
                                pd.products_description,
                                p.products_quantity_order_max, p.products_sort_order,
                                p.master_categories_id,
                                m.manufacturers_name,
                                p2c.categories_id
                         from  " . TABLE_PRODUCTS . " p

                          LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION["languages_id"] . "')
                          LEFT JOIN " . TABLE_MANUFACTURERS . " m ON (p.manufacturers_id = m.manufacturers_id)                          
                          LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ON (p.products_id = p2c.products_id)";

  $where = array();
  if(is_numeric($_SESSION['quick_updates']['products_status'])){
    $where[] = "p.products_status = '" . (int)$_SESSION['quick_updates']['products_status'] . "'";
  }
  if ($current_category_id > 0){
    $where[] = "p2c.categories_id = '" . $current_category_id . "'";
  }
  if($manufacturer){
    $where[] = "p.manufacturers_id = '" . (int)$manufacturer . "'";
  }
  if(sizeof($where) > 0) {
    $products_query_raw .= " where " . implode(' and ', $where);
  }
 
  $products_query_raw .= " " . $sort_by;

//// page splitter and display each products info
  $products_split = new splitPageResults($split_page, MAX_DISPLAY_ROW_BY_PAGE, $products_query_raw, $products_query_numrows);
  $products = $db->Execute($products_query_raw);
// eof get products data from db

// Let's start displaying page with forms
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/stylesheet_quick_updates.css">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script language="javascript" src="includes/javascript/quick_updates_price_calculations.js"></script>
<script type="text/javascript">
<!--
function init()
{
   cssjsmenu('navbar');
   if (document.getElementById)
   {
     var kill = document.getElementById('hoverJS');
     kill.disabled = true;
   }
 }

function popupWindow(url) {
  window.open(url, 'popupWindow', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no');
}

var browser_family;
var up = 1;

if (document.all && !document.getElementById)
  browser_family = "dom2";
else if (document.layers)
  browser_family = "ns4";
else if (document.getElementById)
  browser_family = "dom2";
else
  browser_family = "other";

-->
</script>
</head>
<body onload="init()" id="quickUpdates">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- bof #quickUpdatesWrapper -->
<table id="quickUpdatesWrapper">
  <tr>
    <td>
    <!-- bof pageHeading -->
      <table>
        <tr>
          <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
          <td class="pageHeading" align="right">
<?php
// bof show the current categories_image or manufacturers_image
$image_sql = '';
if($current_category_id > 0){
  $image_sql = "select c.categories_image as image from " . TABLE_CATEGORIES . " c where c.categories_id=" . $current_category_id;
} else {
  if($manufacturer){
    $image_sql = "select manufacturers_image as image from " . TABLE_MANUFACTURERS . " where manufacturers_id=" . $manufacturer;
  }
}
if($image_sql != '') {
  $image = $db->Execute($image_sql);
  echo zen_image(DIR_WS_CATALOG . DIR_WS_IMAGES . $image->fields['image'], '', 40);
}
// eof show the current categories_image or manufacturers_image
?>
          </td>
        </tr>
      </table>
      <div class="quHeadingText"><?php echo QU_HEADING_TEXT; ?></div>
      <!-- eof pageHeading -->
            
      <!-- bof top forms -->
      <table class="quTop">
        <tr>
          <td>
            <?php
            // bof show quick copy repeat button
            if ($_SESSION['quick_updates']['quick_copy_number'] > 0){
              echo TEXT_QUICK_COPY_REPEAT . $_SESSION['quick_updates']['quick_copy_from_id'] . ' x ' . $_SESSION['quick_updates']['quick_copy_number'];
              echo zen_draw_form('quickcopyfromtop', FILENAME_QUICK_UPDATES);
              echo zen_draw_hidden_field('quick_copy_from_id', $_SESSION['quick_updates']['quick_copy_from_id']);
              echo zen_draw_hidden_field('quick_updates_copy', 1) . "\n";
              echo zen_draw_hidden_field('quick_copy_number', $_SESSION['quick_updates']['quick_copy_number']) . "\n";
              echo zen_image_submit('button_copy.gif', BUTTON_TEXT_QUICK_COPY) . "\n";
              echo '</form>' . "\n"; ;
            }
            // eof show quick copy repeat button
            ?>
          </td>
          <td class="smallText" align="center" valign="top">
          <!-- bof spec_price form -->
            <?php 
            if(QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN == 'true'){
              echo zen_draw_form('price_markup', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('action', 'info', 'pID')) . "action=calcul");
              echo TEXT_INPUT_SPEC_PRICE;
              echo zen_draw_input_field('price_markup',0,'size="5"');
              if ($preview_markup_price != true) {
                echo '&nbsp;&nbsp;' . zen_image_submit('button_preview.gif', IMAGE_PREVIEW, zen_get_all_get_params(array()));
              } else {
                echo '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_QUICK_UPDATES, zen_get_all_get_params(array())) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
              }
              
                //no idea what this line is usefull for so it's commented out
                echo '&nbsp;' . zen_draw_checkbox_field('marge','yes',true,'no') . '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_MARGE_INFO);
              if ($preview_markup_price != true) {
                echo TEXT_SPEC_PRICE_INFO1 ;
              } else {
                echo TEXT_SPEC_PRICE_INFO2;
              }
              ?>
            </form>
            <?php
            }
            ?>
          <!-- eof spec_price form -->
          </td>
          <td class="smallText" align="center" valign="top"></td>
          <td class="smallText"></td>
          <td class="smallText" align="center" valign="top">
<?php
      // bof toggle switch for editor
      echo TEXT_EDITOR_INFO . zen_draw_form('set_editor_form', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('action', 'reset_editor')), 'get') . '&nbsp;' . zen_draw_pull_down_menu('reset_editor', $editors_pulldown, $current_editor_key, 'onChange="this.form.submit();"') . zen_hide_session_id() . zen_draw_hidden_field('action', 'set_editor') .
      '</form>';
      // eof toggle switch for editor
?>
          </td>
        </tr>
      </table>
      <table class="quTop">
        <tr>
          <td class="smallText"><?php echo zen_draw_form('row_by_page', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('row_by_page')), 'get') . TEXT_MAXI_ROW_BY_PAGE . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('row_by_page', $row_bypage_array, $row_by_page, 'onChange="this.form.submit();"'); ?></form></td>
          <td class="smallText" align="center" valign="top"><?php echo zen_draw_form('manufacturers', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('manufacturer')), 'get') . DISPLAY_MANUFACTURERS . '&nbsp;&nbsp' . zen_draw_pull_down_menu("manufacturer", $manufacturers_array, $manufacturer, 'onChange="this.form.submit();"'); ?></form></td>
          <td class="smallText" align="center" valign="top"><?php echo zen_draw_form('manufacturers', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('manufacturer')), 'get') . DISPLAY_STATUS . '&nbsp;&nbsp' . zen_draw_pull_down_menu("products_status", array('0' => array('id' => 'all', 'text' => 'All'), '1' => array('id' => '1', 'text' => 'Active'), '2' => array('id' => '0', 'text' => 'Inactive')), $_SESSION['quick_updates']['products_status'] ,'onChange="this.form.submit();"'); ?></form></td>
          <td class="smallText" align="center" valign="top"><?php echo zen_draw_form('categorie', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('cPath')), 'get') . DISPLAY_CATEGORIES . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('cPath', $quick_updates_category_tree, $current_category_id, 'onChange="this.form.submit();"') . '</form>'; ?></td>
          <td>
            <?php
            echo zen_draw_form('form_categories_switch', FILENAME_QUICK_UPDATES);
            $array = array();
            //$array[] = array('id' => $_SESSION['quick_updates']['quick_copy_number'],'text' => $_SESSION['quick_updates']['quick_copy_number'] . 'x');
            $array[] = array('id' => 'linked_cats','text' => 'Edit Linked Cats');
            $array[] = array('id' => 'master_cats','text' => 'Edit Master Cats');
            echo zen_draw_pull_down_menu('categories_switch',  $array, $_SESSION['quick_updates']['categories_switch'], 'onChange="this.form.submit();"');
            echo '</form>';
            ?>
          </td>  
            

        </tr>
      </table>
      <!-- eof top forms -->

      <!-- bof quick_updates form -->
      <?php echo zen_draw_form('quick_updates', FILENAME_QUICK_UPDATES, zen_get_all_get_params(array('action')) . 'action=update', 'post'); ?>
      <!-- bof quick_updates form table -->
      <table class="quFormTable"  cellspacing="0">
        <tr>
          <td>
            <!-- bof button_update table -->
            <table>
              <tr>
                <td class="smalltext" align="middle"><?php echo WARNING_MESSAGE; ?> </td>
                <td class="pageHeading" align="right">
                  <script language="javascript"><!--
                    switch (browser_family) {
                      case "dom2":
                      case "ie4":
                        document.write('<div id="descDiv">');
                        break;
                      default:
                        document.write('<ilayer id="descDiv"><layer id="descDiv_sub">');
                        break;
                    }
                    -->
                  </script>
                </td>
                <td align="right" valign="middle"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE);?></td>
               </tr>
            </table>
            <!-- eof button_update table -->
            <!-- bof wrapper quickUpdatesProductsTable -->
            <table id="quickUpdatesProductsTable"  cellspacing="0">
              <tr>
                <td valign="top">
                  <!-- bof quickUpdates Table -->
                  <table  cellspacing="0">
                    <!-- bof dataTableHeadingRow -->
                    <tr class="dataTableHeadingRow">
<?php
//if(QUICKUPDATES_DISPLAY_ID == 'true') // we always display the id
  echo zen_quickupdates_table_head('p.products_id', TABLE_HEADING_ID);
if(QUICKUPDATES_DISPLAY_THUMBNAIL == 'true')
  echo zen_quickupdates_table_head('', TABLE_HEADING_IMAGE);
if(QUICKUPDATES_MODIFY_MODEL == 'true')
  echo zen_quickupdates_table_head('p.products_model', TABLE_HEADING_MODEL);
  
// added for QUICKUPDATES_NEW_COLUMN_1  
if(QUICKUPDATES_MODIFY_NEW_COLUMN_1 == 'true')
  echo zen_quickupdates_table_head('p.' . QUICKUPDATES_MODIFY_NEW_COLUMN_1, TABLE_HEADING_NEW_COLUMN_1);  
  
if(QUICKUPDATES_MODIFY_NAME == 'true')
  echo zen_quickupdates_table_head('pd.products_name', TABLE_HEADING_PRODUCTS);
if(QUICKUPDATES_MODIFY_DESCRIPTION == 'true')
  echo zen_quickupdates_table_head('pd.products_description', TABLE_HEADING_PRODUCTS_DESCRIPTION);
if(QUICKUPDATES_MODIFY_MANUFACTURER == 'true')
  echo zen_quickupdates_table_head('m.manufacturers_name', TABLE_HEADING_MANUFACTURERS);
if(QUICKUPDATES_MODIFY_STATUS == 'true')
  echo zen_quickupdates_table_head('p.products_status', TABLE_HEADING_STATUS);
if(QUICKUPDATES_MODIFY_SORT_ORDER == 'true')
  echo zen_quickupdates_table_head('p.products_sort_order', TABLE_HEADING_SORT_ORDER);
if(QUICKUPDATES_MODIFY_QUANTITY == 'true')
  echo zen_quickupdates_table_head('p.products_quantity', TABLE_HEADING_QUANTITY);

// added for products_purchase_price and margin
if(QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN == 'true')
  echo zen_quickupdates_table_head('p.products_purchase_price', TABLE_HEADING_PURCHASE_PRICE);
if(QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN == 'true')
  echo zen_quickupdates_table_head('p.products_margin', TABLE_HEADING_MARGIN);

// added for p.products_price_w
if(QUICKUPDATES_MODIFY_WHOLESALE_PRICE == 'true')
  echo zen_quickupdates_table_head('p.products_price_w', TABLE_HEADING_WHOLESALE_PRICE);

echo zen_quickupdates_table_head('p.products_price', TABLE_HEADING_PRICE);

if(QUICKUPDATES_DISPLAY_TVA_PRICES == 'true')
  echo zen_quickupdates_table_head('p.products_price', TABLE_HEADING_TAX_PRICE);
if(QUICKUPDATES_MODIFY_WEIGHT == 'true')
  echo zen_quickupdates_table_head('p.products_weight', TABLE_HEADING_WEIGHT);
if(QUICKUPDATES_MODIFY_TAX == 'true')
  echo zen_quickupdates_table_head('p.products_tax_class_id', TABLE_HEADING_TAX);
if(QUICKUPDATES_MODIFY_CATEGORY == 'true')
  echo zen_quickupdates_table_head('p2c.categories_id', TABLE_HEADING_CATEGORY);
if(QUICKUPDATES_DISPLAY_PREVIEW == 'true')
  echo zen_quickupdates_table_head('', '&nbsp;');
if(QUICKUPDATES_DISPLAY_EDIT == 'true')
  echo zen_quickupdates_table_head('', '&nbsp;');
?>
                    </tr>
                    <!-- eof dataTableHeadingRow -->
<?php

if ($_POST['price_markup']){
  $flag_markup = true;
  // beter move markup type/value detection etc here (outside the while loop)  
}

// bof walk products object
while (!$products->EOF) {
  // check the previous products_id:
  // we do not want products that are linked to multiple categories show up multiple times! ("top cat" selected)
  if($prev_products_id != $products->fields['products_id']){
    $rows++;
    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
    //// check for global add value or rates, calcul and round values rates
    if ($flag_markup){
      if (substr($_POST['price_markup'],-1) == '%') {
        $value = trim($_POST['price_markup'], '%');
        if(strpos($_POST['price_markup'], '-') === 0){
          $value = trim($value, '-');
          // substract percentage
          $price = sprintf("%01.4f", round($products->fields['products_price'] - (($value/ 100) * $products->fields['products_price']),4));
        } else {
          $value = trim($value, '+');
          // add percentage
          //(add is the same as substract of course, but I retain this if/else structure because different treatment might be desired)
          $valeur = (1 - (ereg_replace("%", '', $_POST['price_markup']) / 100));
          $price = sprintf("%01.4f", round($products->fields['products_price'] + (($value/ 100) * $products->fields['products_price']),4));     
        }
      } else {
        // add value
        $price = sprintf("%01.4f", round($products->fields['products_price'] + $_POST['price_markup'],4));
      }
    } else {
      $price = $products->fields['products_price'] ;
    }

    //// Check Tax_rate for displaying TTC
    $tax_rate = $db->Execute("select r.tax_rate, c.tax_class_title from " . TABLE_TAX_RATES . " r, " . TABLE_TAX_CLASS . " c where r.tax_class_id=" . $products->fields['products_tax_class_id'] . " and c.tax_class_id=" . $products->fields['products_tax_class_id']);

    if($tax_rate->fields['tax_rate'] == '')
      $tax_rate->fields['tax_rate'] = 0;

    //// display Product Infomation Lines
    $tr = '<tr class="dataTableRow" onmouseover="';
    if($flag_markup) {
      if(QUICKUPDATES_DISPLAY_TVA_OVER == 'true'){
        $tr .= 'display_ttc(\'display\', ' . $price . ', ' . $tax_rate->fields['tax_rate'] . ');';
      }
      $tr .= 'this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="';
      if(QUICKUPDATES_DISPLAY_TVA_OVER == 'true'){
        $tr .= 'display_ttc(\'delete\');';
      }
    } else {
      if(QUICKUPDATES_DISPLAY_TVA_OVER == 'true'){
        $tr .= 'display_ttc(\'display\', ' . $products->fields['products_price'] . ', ' . $tax_rate->fields['tax_rate'] . ');';
      }
      $tr .= 'this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="';
      if(QUICKUPDATES_DISPLAY_TVA_OVER == 'true'){
        $tr .= 'display_ttc(\'delete\', \'\', \'\', 0);';
      }
    }
    $tr .= 'this.className=\'dataTableRow\'">';
    echo $tr;

    //if(QUICKUPDATES_DISPLAY_ID == 'true')
    // we always display the id!
      echo '<td class="smallText">';
      // added for external links paulm
      if (defined('QUICKUPDATES_DISPLAY_ID_INFO')){
        // handler page needed for products type
        $handler_page = '';
        //$handler_page = ?
        echo sprintf(QUICKUPDATES_DISPLAY_ID_INFO, $products->fields['products_id'], $handler_page, zen_image(DIR_WS_IMAGES . 'icon_info.gif', QUICKUPDATES_DISPLAY_ID_INFO_ALT));
      }
      echo $products->fields['products_id'];
      echo '</td>' . "\n";


    if(QUICKUPDATES_DISPLAY_THUMBNAIL == 'true'){
      echo '<td class="smallText productsImage">' .
      zen_draw_hidden_field('quick_updates_new[products_image][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_image']), 'id="SelectImageName_' . $products->fields['products_id'] . '"') .
      zen_draw_hidden_field('quick_updates_old[products_image][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_image'])) .
      '<a href="javascript:selectFileID=\'SelectImageName_' . $products->fields['products_id'] . '\';updateImgId=\'SelectImageName_' . $products->fields['products_id'] . '_img\';popupWindow(\'' . zen_href_link(FILENAME_POPUP_FILE_SELECT, 'sdir=' . dirname($products->fields['products_image']) . '/') . '\');">' .
      zen_image(DIR_WS_CATALOG_IMAGES . $products->fields['products_image'], TEXT_SELECT_IMAGE, QUICKUPDATES_DISPLAY_THUMBNAIL_WIDTH, QUICKUPDATES_DISPLAY_THUMBNAIL_HEIGHT, 'id="SelectImageName_' . $products->fields['products_id'] . '_img"') . '</a>'
       . '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_MODEL == 'true') {
      echo '<td class="smallText productsModel">';
      echo zen_draw_input_field('quick_updates_new[products_model][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_model']), 'size="12"') . zen_draw_hidden_field('quick_updates_old[products_model][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_model']));  
      // added for external links paulm
      if (defined('QUICKUPDATES_MODIFY_MODEL_INFO')){
        echo sprintf(QUICKUPDATES_MODIFY_MODEL_INFO, $products->fields['products_id'], stripslashes($products->fields['products_model']), zen_image(DIR_WS_IMAGES . 'icon_info.gif', stripslashes($products->fields['products_model'])));
      }
      echo '</td>' . "\n";
      }
    
    // added for QUICKUPDATES_NEW_COLUMN_1
    if(QUICKUPDATES_MODIFY_NEW_COLUMN_1 == 'true'){
      echo '<td class="smallText ' . QUICKUPDATES_NEW_COLUMN_1 . '">';
      $parameters = 'size="6"';
      echo zen_draw_input_field('quick_updates_new[' . QUICKUPDATES_NEW_COLUMN_1 . '][' . $products->fields['products_id'] . ']', stripslashes($products->fields[QUICKUPDATES_NEW_COLUMN_1]), $parameters) . zen_draw_hidden_field('quick_updates_old[' . QUICKUPDATES_NEW_COLUMN_1 . '][' . $products->fields['products_id'] . ']', stripslashes($products->fields[QUICKUPDATES_NEW_COLUMN_1]));
      // added for external links paulm
      if (defined('QUICKUPDATES_QUICKUPDATES_NEW_COLUMN_1_INFO')){
        echo sprintf(QUICKUPDATES_QUICKUPDATES_NEW_COLUMN_1_INFO, $products->fields['products_id'], stripslashes($products->fields[QUICKUPDATES_NEW_COLUMN_1]), zen_image(DIR_WS_IMAGES . 'icon_info.gif', stripslashes($products->fields[QUICKUPDATES_NEW_COLUMN_1])));
      }      
      echo '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_NAME == 'true'){
      // added div wrapper to allow advanced :hover styling
      echo '<td class="smallText productsName"><div>' . zen_draw_input_field('quick_updates_new[products_name][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_name']), 'size="16"') . zen_draw_hidden_field('quick_updates_old[products_name][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_name'])) . '</div></td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_DESCRIPTION == 'true'||QUICKUPDATES_MODIFY_DESCRIPTION_POPUP == 'true') {
      echo '<td class="smallText productsDescription">';
      // no need to display description when popup edit is enabled (?)
      if(QUICKUPDATES_MODIFY_DESCRIPTION_POPUP == 'true') echo '<div style="display: none">';
      echo zen_draw_textarea_field('quick_updates_new[products_description][' . $products->fields['products_id'] . ']', 'soft', 200, 2, stripslashes($products->fields['products_description']), 'id="description_' . $products->fields['products_id'] . '"') . zen_draw_hidden_field('quick_updates_old[products_description][' . $products->fields['products_id'] . '] ', stripslashes($products->fields['products_description']));
      if(QUICKUPDATES_MODIFY_DESCRIPTION_POPUP == 'true') echo '</div>';
      //echo "</td>\n";
      if(QUICKUPDATES_MODIFY_DESCRIPTION_POPUP == 'true') {
      //echo '<td class="smallText productsDescription">'
        echo '<a href="javascript:textEditFieldID=\'description_' . $products->fields['products_id'] . '\';popupWindow(\'' . zen_href_link(FILENAME_POPUP_TEXT_EDIT) . '\');">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', TEXT_HTML_EDIT_DESC) . '<span class="cssPopup">' . stripslashes($products->fields['products_description']) . '</span></a>';
      }
      echo "</td>\n";
    }

    if(QUICKUPDATES_MODIFY_MANUFACTURER == 'true') {
      echo '<td class="smallText manufacturersID">' . zen_draw_pull_down_menu('quick_updates_new[manufacturers_id][' . $products->fields['products_id'] . ']', $manufacturers_array, $products->fields['manufacturers_id'], 'style="width: 6em;"') . zen_draw_hidden_field('quick_updates_old[manufacturers_id][' . $products->fields['products_id'] . ']', $products->fields['manufacturers_id']) . '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_STATUS == 'true') {
      echo '<td class="smallText">' . zen_draw_checkbox_field('quick_updates_new[products_status][' . $products->fields['products_id'] . ']', 1, false, $products->fields['products_status'], '') . zen_draw_hidden_field('quick_updates_old[products_status][' . $products->fields['products_id'] . ']', $products->fields['products_status']) .
      '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_SORT_ORDER == 'true') {
      echo '<td class="smallText">' . zen_draw_input_field('quick_updates_new[products_sort_order][' . $products->fields['products_id'] . ']', $products->fields['products_sort_order'], 'size="3"') . zen_draw_hidden_field('quick_updates_old[products_sort_order][' . $products->fields['products_id'] . ']', $products->fields['products_sort_order']) .
      '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_QUANTITY == 'true') {
      echo '<td class="smallText">' . zen_draw_input_field('quick_updates_new[products_quantity][' . $products->fields['products_id'] . ']', $products->fields['products_quantity'], 'size="3"') . zen_draw_hidden_field('quick_updates_old[products_quantity][' . $products->fields['products_id'] . ']', $products->fields['products_quantity']) . '</td>' . "\n";
    }

    // added for products_purchase_price and margin
    if(QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN == 'true'){
      $parameters = 'size="6" onKeyUp="updateMargin(' . $products->fields['products_id'] . ');"';
      echo '<td class="smallText productsPurchasePrice">' . zen_draw_input_field('quick_updates_new[products_purchase_price][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_purchase_price']), $parameters) . zen_draw_hidden_field('quick_updates_old[products_purchase_price][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_purchase_price'])) . '</td>' . "\n";
    }

    // added for products_purchase_price and margin
    if(QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN == 'true'){
      //if ($products->fields['products_margin'] == 0 ) $zeroWarning= ' *'; else $zeroWarning = '';
      $parameters = 'size="6"';
      echo '<td class="smallText productsMargin">' . zen_draw_input_field('quick_updates_new[products_margin][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_margin']), $parameters) . zen_draw_hidden_field('quick_updates_old[products_margin][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_margin'])) . '</td>' . "\n";
    }

    // added for p.products_price_w
    if(QUICKUPDATES_MODIFY_WHOLESALE_PRICE == 'true'){
      $parameters = 'size="' . QUICKUPDATES_MODIFY_WHOLESALE_PRICE_INPUT_SIZE . '"';
      echo '<td class="smallText products_price_w">' . zen_draw_input_field('quick_updates_new[products_price_w][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_price_w'])) . zen_draw_hidden_field('quick_updates_old[products_price_w][' . $products->fields['products_id'] . ']', stripslashes($products->fields['products_price_w']), $parameters) . '</td>' . "\n";
    }

    //// get the specials products list
    $specials_array = array();
    $specials = $db->Execute("select p.products_id, s.products_id, s.specials_id from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
    while (!$specials->EOF) {
      $specials_array[] = $specials->fields['products_id'];
      $specials->MoveNext();
    }
    //// check specials
    $parameters = 'size="6"';
    if(QUICKUPDATES_DISPLAY_TVA_PRICES == 'true'){
      // updateMargin on products_price(was only on products_purchase_price before)
      $parameters .= ' onKeyUp="updateGross(' . $products->fields['products_id'] . '); updateMargin(' . $products->fields['products_id'] . ');"';
    }

    if (in_array($products->fields['products_id'], $specials_array)){      
      $spec = $db->Execute("select s.products_id, s.specials_id from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = " . (int)$products->fields['products_id'] . "");
      $flag_special = true;
      echo '<td class="smallText specialPrice">';
    }else{
      $flag_special = false;
      echo '<td class="smallText productsPrice">';
    }
    echo zen_draw_input_field('quick_updates_new[products_price][' . $products->fields['products_id'] . ']', $price, $parameters);
    
    if ($flag_markup){
      echo zen_draw_checkbox_field('markup_checked[' . $products->fields['products_id'] . ']', '1', (!($flag_special)&&($_POST['marge'])));
      //echo zen_draw_hidden_field('markup[' . $products->fields['products_id'] . ']', '1');
    } else {
      // this has become obsolete since we changed prices to update by default when markup is not set
      //echo zen_draw_hidden_field('update_price[' . $products->fields['products_id'] . ']', 'yes');
    }
    if($flag_special){
      echo '&nbsp;<a target=blank href="' . zen_href_link(FILENAME_SPECIALS, 'sID=' . $spec->fields['specials_id'] . '&action=edit') . '" target="_blank">'. zen_image(DIR_WS_IMAGES . 'icon_info.gif', TEXT_SPECIALS_PRODUCTS) . '</a>';    
    }
      
    if(QUICKUPDATES_DISPLAY_TVA_PRICES == 'true'){
      $parameters = 'size="6"';

      $parameters .= ' onKeyUp="updateNet(' . $products->fields['products_id'] . '); updateMargin(' . $products->fields['products_id'] . ');"';

      // $taxprice needs the $currencies->currencies[DEFAULT_CURRENCY]['decimal_places'] to be set (done at top of file)
      // an alternative might be to use $price (i.s.o. $taxprice) and update it with updatGross('$products->fields['products_id']') for each product ?)
      $tax_price = zen_add_tax($price, $tax_rate->fields['tax_rate']);
      $tax_price = sprintf("%01.2f", round($tax_price, 4));
      echo '</td>' . "\n";

      echo '<td class="smallText">' . zen_draw_input_field('quick_updates_new[products_taxprice][' . $products->fields['products_id'] . ']', $tax_price, $parameters);

      //echo zen_draw_hidden_field('update_taxprice['.$products->fields['products_id'].']','yes');
      echo zen_draw_hidden_field('quick_updates_old[products_tax_value]['.$products->fields['products_id'].']', $tax_rate->fields['tax_rate']);
    }


    echo zen_draw_hidden_field('quick_updates_old[products_price][' . $products->fields['products_id'] . ']', $products->fields['products_price']);

    echo '<a target="_blank" href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_products_price_manager.gif', QUICKUPDATES_PPM_LINK_ALT) . '</a>';
    
    echo '</td>' . "\n";

    if(QUICKUPDATES_MODIFY_WEIGHT == 'true') {
      echo '<td class="smallText">' . zen_draw_input_field('quick_updates_new[products_weight][' . $products->fields['products_id'] . ']', $products->fields['products_weight'], 'size="4"') . zen_draw_hidden_field('quick_updates_old[products_weight][' . $products->fields['products_id'] . ']', $products->fields['products_weight']) . '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_TAX == 'true') {
      echo '<td class="smallText">' . zen_draw_pull_down_menu('quick_updates_new[products_tax_class_id][' . $products->fields['products_id'] . ']', $tax_class_array, $products->fields['products_tax_class_id'], 'style="width: 5em;"') . zen_draw_hidden_field('quick_updates_old[products_tax_class_id][' . $products->fields['products_id'] . ']', $products->fields['products_tax_class_id']) . '</td>' . "\n";
    }

    if(QUICKUPDATES_MODIFY_CATEGORY == 'true') {

      //products_to_categories.php?products_filter=198
      $zen_get_master_categories_pulldown = zen_get_master_categories_pulldown($products->fields['products_id']);
      /*
      if(!in_array($products->fields['categories_id'], $zen_get_master_categories_pulldown)){
        //exit('error');
      }
      */
      $multilinked = false;      
      if(count($zen_get_master_categories_pulldown) > 2){
        $multilinked = true;
      }
      $invalidcat = false;
      if(($multilinked == false)&&($products->fields['master_categories_id'] != $products->fields['categories_id'])){
        $invalidcat = true;
      }
      $prod2cat_link =  '<a href="' . zen_href_link('products_to_categories.php', 'products_filter=' . (int)$products->fields['products_id']) . '">(' . $products->fields['categories_id'] . '/' . $products->fields['master_categories_id']. ')</a>';

      //
      
      echo '<td class="smallText">';
      
      if($_SESSION['quick_updates']['categories_switch'] == 'master_cats'){
        // show/edit the master cats products table
        echo zen_draw_pull_down_menu('quick_updates_new[master_categories_id][' . $products->fields['products_id'] . ']', zen_get_master_categories_pulldown($products->fields['products_id']), $products->fields['master_categories_id']);  
      }else{
        // show/edit the linked cats products_to_categories table
        if($invalidcat == true){
           echo TEXT_QU_CHECK_CAT_INVALID;          
        }elseif($multilinked == true){
           echo TEXT_QU_CHECK_CAT_MULTILINKS;
        }else{
          echo zen_draw_pull_down_menu('quick_updates_new[categories_id][' . $products->fields['products_id'] . ']', $quick_updates_category_tree, $products->fields['categories_id'], '');
          echo zen_draw_hidden_field('quick_updates_old[categories_id][' . $products->fields['products_id'] . ']', $products->fields['categories_id']);
        }        
      }

      // we need the old master_categories_id value in both cases
      echo zen_draw_hidden_field('quick_updates_old[master_categories_id][' . $products->fields['products_id'] . ']', $products->fields['master_categories_id']);
      echo $prod2cat_link;
      echo '</td>' . "\n";

    } // eof QUICKUPDATES_MODIFY_CATEGORY

     //// links to preview or full edit
    $type_handler = $zc_products->get_admin_handler($products->fields['products_type']);
    if(QUICKUPDATES_DISPLAY_PREVIEW == 'true')
      echo '<td class="smallText"><a href="' . zen_href_link(FILENAME_PRODUCT, 'cPath=' . $products->fields['master_categories_id'] . '&pID=' . $products->fields['products_id'] . '&action=new_product_preview&read=only' . '&product_type=' . $products->fields['products_type']) . ' target="blank">' .  zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a></td>' . "\n";
    if(QUICKUPDATES_DISPLAY_EDIT == 'true')
      echo '<td class="smallText"><a href="' . zen_href_link($type_handler, 'cPath=' . $products->fields['master_categories_id'] . '&product_type=' . $products->fields['products_type'] . '&pID=' . $products->fields['products_id']  . '&action=new_product') . '" target="blank">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a></td>' . "\n";
    echo '</tr>';
    // bof export viewed products paulm
    // (= preparation to post to external script + quick copy function)
    $export_products[$products->fields['products_id']]['products_model'] = $products->fields['products_model'];
    if(defined('QUICKUPDATES_NEW_COLUMN_1')){
      $export_products[$products->fields['products_id']][QUICKUPDATES_NEW_COLUMN_1] = $products->fields[QUICKUPDATES_NEW_COLUMN_1];
    }
    // eof export viewed products paulm

    $prev_products_id = $products->fields['products_id'];
    } // eof if($prev_products_id != $products->fields['products_id']){
  $products->MoveNext();
}
// eof walk products object
?>
                  </table>
                  <!-- eof quickUpdates Table -->
                </td>
              </tr>
            </table>
            <!-- eof wrapper quickUpdatesProductsTable -->
          </td>
        </tr>
        <tr>
          <td align="right">
<?php
  // post flag_markup (is being used while updating prices)
  if ($flag_markup){
    echo zen_draw_hidden_field('flag_markup', '1');
  }
  // bof  display bottom page buttons
  echo '<a href="javascript:window.print()">' . PRINT_TEXT . '</a>&nbsp;&nbsp;';
  echo zen_image_submit('button_update.gif', IMAGE_UPDATE);
  echo '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_QUICK_UPDATES, "row_by_page=$row_by_page") . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
  // eof  display bottom page buttons
?>
          </td>
        </tr>
        <tr>
          <td>
            <!-- bof  bottom page selection -->
            <table>
              <tr>
                <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, $split_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS);  ?></td>
                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_ROW_BY_PAGE, MAX_DISPLAY_PAGE_LINKS, $split_page); ?></td>
              </tr>
            </table>
            <!-- eof  bottom page selection -->
          </td>
        </tr>
      </table>
      <!-- bof quick_updates form table -->
      </form>
      <!-- eof quick_updates form -->

      <table class="quBottom">
        <tr>
          <td>
            <!-- bof export viewed products paulm //-->
            <?php
            // not using zen_draw_form because we are posting to an external url
            if (defined('QUICKUPDATES_EXPORT_PRODUCTS_URL')&&(is_array($export_products))){
              echo '<form name="export_products" action="'. QUICKUPDATES_EXPORT_PRODUCTS_URL . '" method="post">';
              foreach($export_products as $key => $value){
                //echo zen_draw_hidden_field('selected_product[' . $key . ']', $value) . "\n";
                echo zen_draw_hidden_field('export_products[' . $key . '][products_model]', $value['products_model']) . "\n";
                if (defined('QUICKUPDATES_NEW_COLUMN_1')){
                  echo zen_draw_hidden_field('export_products[' . $key . '][' . QUICKUPDATES_NEW_COLUMN_1 . ']', $value[QUICKUPDATES_NEW_COLUMN_1]) . "\n";
                }
              }
              echo zen_image_submit('button_update.gif', 'Export products');
              echo '</form>';
            }
            ?>
            <!-- eof export viewed products paulm //-->
          </td>          
          <td>
            <!-- // bof quick copy form -->
            <?php
            $quick_copy_from_array = array();
            //export_products[$products->fields['products_id']]['products_model']
             if (zen_products_id_valid(QUICKUPDATES_COPY_PRODUCT_ID_DEFAULT)){
               $quick_copy_from_array[] = array(
                                            'id' => QUICKUPDATES_COPY_PRODUCT_ID_DEFAULT,
                                            'text' => 'id:' . QUICKUPDATES_COPY_PRODUCT_ID_DEFAULT . ' (' . TEXT_QUICK_COPY_PRODUCT_ID_DEFAULT . ')'
                                          );
             }
             foreach((array)$export_products as $key => $value){
               if(!empty($value['products_model'])) $text = ' (' . $value['products_model'] . ')';
               $quick_copy_from_array[] = array(
                                            'id' => $key,
                                            'text' => 'id:' . $key . $text
                                            );
             }
             echo zen_draw_form('quickcopyfrom', FILENAME_QUICK_UPDATES);
             echo zen_draw_pull_down_menu('quick_copy_from_id',  $quick_copy_from_array, $_SESSION['quick_updates']['quick_copy_from_id']);
              $array = array();
              //$array[] = array('id' => $_SESSION['quick_updates']['quick_copy_number'],'text' => $_SESSION['quick_updates']['quick_copy_number'] . 'x');
              $array[] = array('id' => 0,'text' => '0x');
              $array[] = array('id' => 1,'text' => '1x');
			  $array[] = array('id' => 2,'text' => '2x');
			  $array[] = array('id' => 3,'text' => '3x');
			  $array[] = array('id' => 4,'text' => '4x');
			  $array[] = array('id' => 5,'text' => '5x');
			  $array[] = array('id' => 6,'text' => '6x');
			  $array[] = array('id' => 7,'text' => '7x');
			  $array[] = array('id' => 8,'text' => '8x');
			  $array[] = array('id' => 9,'text' => '9x');
			  $array[] = array('id' => 10,'text' => '10x');
             echo zen_draw_pull_down_menu('quick_copy_number',  $array, $_SESSION['quick_updates']['quick_copy_number']);

             echo zen_draw_hidden_field('quick_updates_copy', 1) . "\n";
             echo zen_image_submit('button_copy.gif', BUTTON_TEXT_QUICK_COPY) . "\n";
            ?>
            </form>
            <!-- // eof quick copy form -->
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table><!-- eof #quickUpdatesWrapper -->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>