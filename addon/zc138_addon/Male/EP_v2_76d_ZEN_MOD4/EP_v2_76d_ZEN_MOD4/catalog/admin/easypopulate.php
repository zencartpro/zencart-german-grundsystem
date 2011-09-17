<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/lizenz/gpl_license.htm.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: easypopulate.php,v 2.76d 2006/10/16 22:50:52 surfalot Exp $
// Adds, Bugfixes and Multilangual Support by rpa-com 2007/07/24

//*NEW supports register_globals=OFF

// Current EP Version
$curver = '2.76d-mod4 Zen-Cart 1.3.x';

require('includes/application_top.php');
require(DIR_FS_CATALOG .'includes/database_tables.php');

//
//*******************************
//*******************************
// C O N F I G U R A T I O N
// V A R I A B L E S
//*******************************
//*******************************

// **** Temp directory ****
// if you changed your directory structure from stock and do not have /catalog/temp/, then youll need to change this accordingly.
//
// Please set DOCUMENT_ROOT to $DOCUMENT_ROOT in your /catalog/admin/includes/configure.php
//$tempdir = DIR_FS_DOCUMENT_ROOT . "/catalog/temp/";
//$tempdir = DIR_FS_CATALOG . '' . "temp/"
$tempdir = "temp/";
$tempdir2 = "temp/";

//**** File Splitting Configuration ****
// we attempt to set the timeout limit longer for this script to avoid having to split the files
// NOTE:  If your server is running in safe mode, this setting cannot override the timeout set in php.ini
// uncomment this if you are not on a safe mode server and you are getting timeouts
// set_time_limit(330);

// if you are splitting files, this will set the maximum number of records to put in each file.
// if you set your php.ini to a long time, you can make this number bigger
global $maxrecs;
$maxrecs = 300; // default, seems to work for most people.  Reduce if you hit timeouts
//$maxrecs = 4; // for testing

//**** Image Defaulting ****
global $default_images, $default_image_manufacturer, $default_image_product, $default_image_category;

// set them to your own default "We don't have any picture" gif
//$default_image_manufacturer = 'no_image_manufacturer.gif';
//$default_image_product = 'no_image_product.gif';
//$default_image_category = 'no_image_category.gif';

// or let them get set to nothing
$default_image_manufacturer = '';
$default_image_product = '';
$default_image_category = '';

//**** Status Field Setting ****
// Set the v_status field to "Inactive" if you want the status=0 in the system
// Set the v_status field to "Delete" if you want to remove the item from the system <- THIS IS NOT WORKING YET!
// If zero_qty_inactive is true, then items with zero qty will automatically be inactive in the store.
global $active, $inactive, $zero_qty_inactive, $deleteit;
$active = 1;
$inactive = 0;
//$deleteit = 'Delete'; // not functional yet
$zero_qty_inactive = false;

//**** Size of products_model in products table ****
// set this to the size of your model number field in the db.  We check to make sure all models are no longer than this value.
// this prevents the database from getting fubared.  Just making this number bigger wont help your database!  They must match!
global $modelsize;
$modelsize = 25;

//**** Price includes tax? ****
// Set the v_price_with_tax to
// 0 if you want the price without the tax included
// 1 if you want the price to be defined for import & export including tax.
global $price_with_tax;
$price_with_tax =true;

// **** Quote -> Escape character conversion ****
// If you have extensive html in your descriptions and it's getting mangled on upload, turn this off
// set to 1 = replace quotes with escape characters
// set to 0 = no quote replacement
global $replace_quotes;
$replace_quotes = false;

// **** Field Separator ****
// change this if you can't use the default of tabs
// Tab is the default, comma and semicolon are commonly supported by various progs
// Remember, if your descriptions contain this character, you will confuse EP!
global $separator;
$separator = "\t"; // tab is default
//$separator = ","; // comma
//$separator = ";"; // semi-colon
//$separator = "~"; // tilde
//$separator = "-"; // dash
//$separator = "*"; // splat

// *** Excel safe output ***
// this setting will supersede the previous $separator setting and create a file
// that excel will import without spanning cells from embedded commas.
global $excel_safe_output;
$excel_safe_output = false; // default is: false
if ($excel_safe_output == true) { $separator = ","; }

// *** Preserve Tabs, Carriage returns and Line feeds ***
// this setting will preserve the special chars that can cause problems in
// a text based output. When used with $excel_safe_output, it will safely
// preserve these elements in the export and import.
global $preserve_tabs_cr_lf;
$preserve_tabs_cr_lf = false; // default is: false

// **** Max Category Levels ****
// change this if you need more or fewer categories
global $max_categories;
$max_categories = 4; // 7 is default

// VJ product attributes begin
// **** Product Attributes ****
// change this to false, if do not want to download product attributes
global $products_with_attributes;
$products_with_attributes = true;

// change this to true, if you use QTYpro and want to set attributes stock with EP.
global $products_attributes_stock;
$products_attributes_stock = false;


// change this if you want to download selected product options
// this might be handy, if you have a lot of product options, and your output file exceeds 256 columns (which is the max. limit MS Excel is able to handle)
global $attribute_options_select;
//$attribute_options_select = array('Size', 'Model'); // uncomment and fill with product options name you wish to download // comment this line, if you wish to download all product options
// VJ product attributes end

// *** Show settings on EP page ***
global $show_ep_settings;
$show_ep_settings = true; // default is: false



// ****************************************
// Froogle configuration variables
// -- YOU MUST CONFIGURE THIS!  IT WON'T WORK OUT OF THE BOX!
// ****************************************

// **** Froogle product info page path ****
// We can't use the tep functions to create the link, because the links will point to the admin, since that's where we're at.
// So put the entire path to your product_info.php page here
global $froogle_product_info_path;
$froogle_product_info_path = "http://www.yourdomain.com/catalog/product_info.php";

// **** Froogle product image path ****
// Set this to the path to your images directory
global $froogle_image_path;
$froogle_image_path = "http://www.yourdomain.com/catalog/images/";

// **** Froogle - search engine friendly setting
// if your store has SEARCH ENGINE FRIENDLY URLS set, then turn this to true
// I did it this way because I'm having trouble with the code seeing the constants
// that are defined in other places.
global $froogle_SEF_urls;
$froogle_SEF_urls = false;


// ****************************************
// End Froogle configuration variables
// ****************************************

//*******************************
//*******************************
// E N D
// C O N F I G U R A T I O N
// V A R I A B L E S
//*******************************
//*******************************


//*******************************
//*******************************
// S T A R T
// INITIALIZATION
//*******************************
//*******************************


//*******************************
//  We need this include line to avoid errors like:
//  undefined function zen_get_uploaded_file
if (!function_exists(zen_get_uploaded_file)){
   include ('includes/functions/extra_functions/easypopulate_functions.php');
	//include ('easypopulate_functions.php');
 }
//*******************************

// modify tableBlock for use here.
  class epbox extends tableBlock {
	// constructor
	function epbox($contents, $direct_ouput = true) {
	  $this->table_width = '';
	  if (!empty($contents) && $direct_ouput == true) {
		echo $this->tableBlock($contents);
	  }
	}
	// only member function
	function output($contents) {
	  return $this->tableBlock($contents);
	}
  }


// VJ product attributes begin
global $attribute_options_array;
$attribute_options_array = array();

if ($products_with_attributes == true) {
	if (is_array($attribute_options_select) && (count($attribute_options_select) > 0)) {
		foreach ($attribute_options_select as $value) {
			$attribute_options_query = "select distinct products_options_id from " . TABLE_PRODUCTS_OPTIONS . " where products_options_name = '" . $value . "'";

			$attribute_options_values = mysql_query($attribute_options_query);

			if ($attribute_options = mysql_fetch_array($attribute_options_values)){
				$attribute_options_array[] = array('products_options_id' => $attribute_options['products_options_id']);
			}
		}
	} else {
		$attribute_options_query = "select distinct products_options_id from " . TABLE_PRODUCTS_OPTIONS . " order by products_options_id";

		$attribute_options_values = mysql_query($attribute_options_query);

		while ($attribute_options = mysql_fetch_array($attribute_options_values)){
			$attribute_options_array[] = array('products_options_id' => $attribute_options['products_options_id']);
		}
	}
}
// VJ product attributes end

global $filelayout, $filelayout_count, $filelayout_sql, $langcode, $fileheaders;

// these are the fields that will be defaulted to the current values in the database if they are not found in the incoming file
global $default_these;
$default_these = array(
	'v_products_image',
	#'v_products_mimage',
	#'v_products_bimage',
	#'v_products_subimage1',
	#'v_products_bsubimage1',
	#'v_products_subimage2',
	#'v_products_bsubimage2',
	#'v_products_subimage3',
	#'v_products_bsubimage3',
	'v_categories_id',
	'v_products_price',
	'v_products_priced_by_attribute',
	'v_products_quantity',
	'v_products_weight',
	'v_products_sort_order',
	'v_date_avail',
	'v_instock',
	'v_tax_class_title',
	'v_manufacturers_name',
	'v_manufacturers_id',
	'v_products_dim_type',
	'v_products_length',
	'v_products_width',
	'v_products_height',
	'v_products_upc'
	);

//elari check default language_id from configuration table DEFAULT_LANGUAGE
$epdlanguage_query = mysql_query("select languages_id, name from " . TABLE_LANGUAGES . " where code = '" . DEFAULT_LANGUAGE . "'");
if (mysql_num_rows($epdlanguage_query)) {
	$epdlanguage = mysql_fetch_array($epdlanguage_query);
	$epdlanguage_id   = $epdlanguage['languages_id'];
	$epdlanguage_name = $epdlanguage['name'];
} else {
	Echo EASY_ERROR_1;
}

$langcode = ep_get_languages();

if ( $_GET['dltype'] != '' ){
	// if dltype is set, then create the filelayout.  Otherwise it gets read from the uploaded file
	ep_create_filelayout($_GET['dltype']); // get the right filelayout for this download
}

//*******************************
//*******************************
// E N D
// INITIALIZATION
//*******************************
//*******************************

if ( $_GET['download'] == 'stream' or  $_GET['download'] == 'activestream' or  $_GET['download'] == 'tempfile' ){
	//*******************************
	//*******************************
	// DOWNLOAD FILE
	//*******************************
	//*******************************
	$filestring = ""; // this holds the csv file we want to download
	$result = mysql_query($filelayout_sql);
	$row =  mysql_fetch_array($result);

	// $EXPORT_TIME=time();  // start export time when export is started.
	$EXPORT_TIME = strftime('%Y%b%d-%H%I');
	if ($_GET['dltype']=="froogle"){
		$EXPORT_TIME = "FroogleEP" . $EXPORT_TIME;
	} else {
		$EXPORT_TIME = "EP" . $EXPORT_TIME;
	}

	// Here we need to allow for the mapping of internal field names to external field names
	// default to all headers named like the internal ones
	// the field mapping array only needs to cover those fields that need to have their name changed
	if ( count($fileheaders) != 0 ){
		$filelayout_header = $fileheaders; // if they gave us fileheaders for the dl, then use them
	} else {
		$filelayout_header = $filelayout; // if no mapping was spec'd use the internal field names for header names
	}
	//We prepare the table heading with layout values
	foreach( $filelayout_header as $key => $value ){
		$filestring .= $key . $separator;
	}
	// now lop off the trailing tab
	$filestring = substr($filestring, 0, strlen($filestring)-1);

	// set the type
	if ( $_GET['dltype'] == 'froogle' ){
		$endofrow = "\n";
	} else {
		// default to normal end of row
		$endofrow = $separator . 'EOREOR' . "\n";
	}
	$filestring .= $endofrow;

	if ($_GET['download'] == 'activestream'){
	  header("Content-type: application/vnd.ms-excel");
	  header("Content-disposition: attachment; filename=$EXPORT_TIME" . (($excel_safe_output == true)?".csv":".txt"));
	  // Changed if using SSL, helps prevent program delay/timeout (add to backup.php also)
	  //	header("Pragma: no-cache");
	  if ($request_type== 'NONSSL'){
	    header("Pragma: no-cache");
	  } else {
	    header("Pragma: ");
	  }
	  header("Expires: 0");
	  echo $filestring;
	}

	$num_of_langs = count($langcode);
	while ($row){


		// if the filelayout says we need a products_name, get it
		// build the long full froogle image path
		$row['v_products_fullpath_image'] = $froogle_image_path . $row['v_products_image'];
		// Other froogle defaults go here for now
		$row['v_froogle_instock'] 		= 'Y';
		$row['v_froogle_shipping'] 		= '';
		$row['v_froogle_upc'] 			= '';
		$row['v_froogle_color']			= '';
		$row['v_froogle_size']			= '';
		$row['v_froogle_quantitylevel']		= '';
		$row['v_froogle_manufacturer_id']	= '';
		$row['v_froogle_exp_date']		= '';
		$row['v_froogle_product_type']		= 'OTHER';
		$row['v_froogle_delete']		= '';
		$row['v_froogle_currency']		= 'USD';
		$row['v_froogle_offer_id']		= $row['v_products_model'];
		$row['v_froogle_product_id']		= $row['v_products_model'];

		// names and descriptions require that we loop thru all languages that are turned on in the store
		foreach ($langcode as $key => $lang){
			$lid = $lang['id'];

			// for each language, get the description and set the vals
			$sql2 = "SELECT *
				FROM ".TABLE_PRODUCTS_DESCRIPTION."
				WHERE
					products_id = " . $row['v_products_id'] . " AND
					language_id = '" . $lid . "'
				";
			$result2 = mysql_query($sql2);
			$row2 =  mysql_fetch_array($result2);

			// I'm only doing this for the first language, since right now froogle is US only.. Fix later!
			// adding url for froogle, but it should be available no matter what
			if ($froogle_SEF_urls){
				// if only one language
				if ($num_of_langs == 1){
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '/products_id/' . $row['v_products_id'];
				} else {
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '/products_id/' . $row['v_products_id'] . '/language/' . $lid;
				}
			} else {
				if ($num_of_langs == 1){
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '?products_id=' . $row['v_products_id'];
				} else {
					$row['v_froogle_products_url_' . $lid] = $froogle_product_info_path . '?products_id=' . $row['v_products_id'] . '&language=' . $lid;
				}
			}

			$row['v_products_name_' . $lid] 	= $row2['products_name'];
			$row['v_products_description_' . $lid] 	= $row2['products_description'];
			$row['v_products_url_' . $lid] 		= $row2['products_url'];

			// froogle advanced format needs the quotes around the name and desc
			$row['v_froogle_products_name_' . $lid] = '"' . strip_tags(str_replace('"','""',$row2['products_name'])) . '"';
			$row['v_froogle_products_description_' . $lid] = '"' . strip_tags(str_replace('"','""',$row2['products_description'])) . '"';

			// support for Linda's Header Controller 2.0 here
			if(isset($filelayout['v_products_head_title_tag_' . $lid])){
				$row['v_products_head_title_tag_' . $lid] 	= $row2['products_head_title_tag'];
				$row['v_products_head_desc_tag_' . $lid] 	= $row2['products_head_desc_tag'];
				$row['v_products_head_keywords_tag_' . $lid] 	= $row2['products_head_keywords_tag'];
			}
			// end support for Header Controller 2.0
		}

		// for the categories, we need to keep looping until we find the root category

		// start with v_categories_id
		// Get the category description
		// set the appropriate variable name
		// if parent_id is not null, then follow it up.
		// we'll populate an aray first, then decide where it goes in the
		$thecategory_id = $row['v_categories_id'];
		$fullcategory = ''; // this will have the entire category stack for froogle
		for( $categorylevel=1; $categorylevel<$max_categories+1; $categorylevel++){
			if ($thecategory_id){
				$sql2 = "SELECT categories_name
					FROM ".TABLE_CATEGORIES_DESCRIPTION."
					WHERE
						categories_id = " . $thecategory_id . " AND
						language_id = " . $epdlanguage_id ;

				$result2 = mysql_query($sql2);
				$row2 =  mysql_fetch_array($result2);
				// only set it if we found something
				$temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
				// now get the parent ID if there was one
				$sql3 = "SELECT parent_id
					FROM ".TABLE_CATEGORIES."
					WHERE
						categories_id = " . $thecategory_id;
				$result3 = mysql_query($sql3);
				$row3 =  mysql_fetch_array($result3);
				$theparent_id = $row3['parent_id'];
				if ($theparent_id != ''){
					// there was a parent ID, lets set thecategoryid to get the next level
					$thecategory_id = $theparent_id;
				} else {
					// we have found the top level category for this item,
					$thecategory_id = false;
				}
				//$fullcategory .= " > " . $row2['categories_name'];
				$fullcategory = $row2['categories_name'] . " > " . $fullcategory;
			} else {
				$temprow['v_categories_name_' . $categorylevel] = '';
			}
		}
		// now trim off the last ">" from the category stack
		$row['v_category_fullpath'] = substr($fullcategory,0,strlen($fullcategory)-3);

		// temprow has the old style low to high level categories.
		$newlevel = 1;
		// let's turn them into high to low level categories
		for( $categorylevel=6; $categorylevel>0; $categorylevel--){
			if ($temprow['v_categories_name_' . $categorylevel] != ''){
				$row['v_categories_name_' . $newlevel++] = $temprow['v_categories_name_' . $categorylevel];
			}
		}
		// if the filelayout says we need a manufacturers name, get it
		if (isset($filelayout['v_manufacturers_name'])){
			if ($row['v_manufacturers_id'] != ''){
				$sql2 = "SELECT manufacturers_name
					FROM ".TABLE_MANUFACTURERS."
					WHERE
					manufacturers_id = " . $row['v_manufacturers_id']
					;
				$result2 = mysql_query($sql2);
				$row2 =  mysql_fetch_array($result2);
				$row['v_manufacturers_name'] = $row2['manufacturers_name'];
			}
		}


		// If you have other modules that need to be available, put them here

		// VJ product attribs begin
		if (isset($filelayout['v_attribute_options_id_1'])){
			$languages = zen_get_languages();

			$attribute_options_count = 1;
      foreach ($attribute_options_array as $attribute_options) {
				$row['v_attribute_options_id_' . $attribute_options_count] 	= $attribute_options['products_options_id'];

				for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$lid = $languages[$i]['id'];

					$attribute_options_languages_query = "select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options['products_options_id'] . "' and language_id = '" . (int)$lid . "'";

					$attribute_options_languages_values = mysql_query($attribute_options_languages_query);

					$attribute_options_languages = mysql_fetch_array($attribute_options_languages_values);

					$row['v_attribute_options_name_' . $attribute_options_count . '_' . $lid] = $attribute_options_languages['products_options_name'];
				}

				$attribute_values_query = "select products_options_values_id from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options['products_options_id'] . "' order by products_options_values_id";

				$attribute_values_values = mysql_query($attribute_values_query);

				$attribute_values_count = 1;
				while ($attribute_values = mysql_fetch_array($attribute_values_values)) {
					$row['v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count] 	= $attribute_values['products_options_values_id'];

                    //Attribut Preis
					$attribute_values_price_query = "select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$row['v_products_id'] . "' and options_id = '" . (int)$attribute_options['products_options_id'] . "' and options_values_id = '" . (int)$attribute_values['products_options_values_id'] . "'";

					$attribute_values_price_values = mysql_query($attribute_values_price_query);

					$attribute_values_price = mysql_fetch_array($attribute_values_price_values);

					//$row['v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count] 	= $attribute_values_price['price_prefix'] . $attribute_values_price['options_values_price'];

                    $row['v_attribute_price_prefix_' . $attribute_options_count . '_' . $attribute_values_count] 	= $attribute_values_price['price_prefix'];
					$row['v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count] 	= $attribute_values_price['options_values_price'];


                    //Attribut Preis Ende

                    //Attribut Default
					$attribute_values_default_query = "select attributes_default from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$row['v_products_id'] . "' and options_id = '" . (int)$attribute_options['products_options_id'] . "' and options_values_id = '" . (int)$attribute_values['products_options_values_id'] . "'";
					$attribute_values_default_values = mysql_query($attribute_values_default_query);

					$attribute_values_default = mysql_fetch_array($attribute_values_default_values);

					$row['v_attribute_values_default_' . $attribute_options_count . '_' . $attribute_values_count]  = $attribute_values_default['attributes_default'];
					//Attribut Default Ende

					//Attribut Gewicht
					//if ($flag_attributes_weight == true) {
					  $attribute_values_weight_query = "select products_attributes_weight, products_attributes_weight_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$row['v_products_id'] . "' and options_id = '" . (int)$attribute_options['products_options_id'] . "' and options_values_id = '" . (int)$attribute_values['products_options_values_id'] . "'";
					  $attribute_values_weight_values = mysql_query($attribute_values_weight_query);

					  $attribute_values_weight = mysql_fetch_array($attribute_values_weight_values);

					  //$row['v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count]  = $attribute_values_weight['products_attributes_weight_prefix'] . $attribute_values_weight['products_attributes_weight'];

					  $row['v_attribute_weight_prefix_' . $attribute_options_count . '_' . $attribute_values_count]  = $attribute_values_weight['products_attributes_weight_prefix'];
					  $row['v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count]  = $attribute_values_weight['products_attributes_weight'];

					//}
					//Attribut Gewicht Ende


					//Attribut Sort Order
					$attribute_sort_order_query = "select products_options_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$row['v_products_id'] . "' and options_id = '" . (int)$attribute_options['products_options_id'] . "' and options_values_id = '" . (int)$attribute_values['products_options_values_id'] . "'";
					$attribute_sort_order_values = mysql_query($attribute_sort_order_query);

					$attribute_sort_order = mysql_fetch_array($attribute_sort_order_values);

					$row['v_attribute_sort_order_' . $attribute_options_count . '_' . $attribute_values_count]  = $attribute_sort_order['products_options_sort_order'];
					//Attribut Sort Order


	//// attributes stock add start
	if ( $products_attributes_stock	== true ) {
		   $stock_attributes = $attribute_options['products_options_id'].'-'.$attribute_values['products_options_values_id'];

		   $stock_quantity_query = mysql_query("select products_stock_quantity from " . TABLE_PRODUCTS_STOCK . " where products_id = '" . (int)$row['v_products_id'] . "' and products_stock_attributes = '" . $stock_attributes . "'");
           $stock_quantity = mysql_fetch_array($stock_quantity_query);

		   $row['v_attribute_values_stock_' . $attribute_options_count . '_' . $attribute_values_count] = $stock_quantity['products_stock_quantity'];
 	}
	//// attributes stock add end


					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
						$lid = $languages[$i]['id'];

						$attribute_values_languages_query = "select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$attribute_values['products_options_values_id'] . "' and language_id = '" . (int)$lid . "'";

						$attribute_values_languages_values = mysql_query($attribute_values_languages_query);

						$attribute_values_languages = mysql_fetch_array($attribute_values_languages_values);

						$row['v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $lid] = $attribute_values_languages['products_options_values_name'];
					}

					$attribute_values_count++;
				}

				$attribute_options_count++;
			}
		}
		// VJ product attribs end

		// this is for the separate price per customer module
		if (isset($filelayout['v_customer_price_1'])){
			$sql2 = "SELECT
					customers_group_price,
					customers_group_id
				FROM
					".TABLE_PRODUCTS_GROUPS."
				WHERE
				products_id = " . $row['v_products_id'] . "
				ORDER BY
				customers_group_id"
				;
			$result2 = mysql_query($sql2);
			$ll = 1;
			$row2 =  mysql_fetch_array($result2);
			while( $row2 ){
				$row['v_customer_group_id_' . $ll] 	= $row2['customers_group_id'];
				$row['v_customer_price_' . $ll] 	= $row2['customers_group_price'];
				$row2 = mysql_fetch_array($result2);
				$ll++;
			}
		}
		if ($_GET['dltype'] == 'froogle'){
			// For froogle, we check the specials prices for any applicable specials, and use that price
			// by grabbing the specials id descending, we always get the most recently added special price
			// I'm checking status because I think you can turn off specials
			$sql2 = "SELECT
					specials_new_products_price
				FROM
					".TABLE_SPECIALS."
				WHERE
				products_id = " . $row['v_products_id'] . " and
				status = 1 and
				expires_date < CURRENT_TIMESTAMP
				ORDER BY
					specials_id DESC"
				;
			$result2 = mysql_query($sql2);
			$ll = 1;
			$row2 =  mysql_fetch_array($result2);
			if( $row2 ){
				// reset the products price to our special price if there is one for this product
				$row['v_products_price'] 	= $row2['specials_new_products_price'];
			}
		}

		//elari -
		//We check the value of tax class and title instead of the id
		//Then we add the tax to price if $price_with_tax is set to 1
		$row_tax_multiplier 		= zen_get_tax_class_rate($row['v_tax_class_id']);
		$row['v_tax_class_title'] 	= zen_get_tax_class_title($row['v_tax_class_id']);
		$row['v_products_price'] 	= round($row['v_products_price'] +
				($price_with_tax * $row['v_products_price'] * $row_tax_multiplier / 100),2);


		// Now set the status to a word the user specd in the config vars
		if ( $row['v_status'] == '1' ){
			$row['v_status'] = $active;
		} else {
			$row['v_status'] = $inactive;
		}

		// remove any bad things in the texts that could confuse EasyPopulate
		$therow = '';
		foreach( $filelayout as $key => $value ){
			//echo "The field was $key<br>";

			$thetext = $row[$key];
			// kill the carriage returns and tabs in the descriptions, they're killing me!
			if ($preserve_tabs_cr_lf == false || $_GET['dltype'] == 'froogle') {
			  $thetext = str_replace("\r",' ',$thetext);
			  $thetext = str_replace("\n",' ',$thetext);
			  $thetext = str_replace("\t",' ',$thetext);
			}
			if ($excel_safe_output == true && $_GET['dltype'] != 'froogle') {
			  // use quoted values and escape the embedded quotes for excel safe output.
			  $therow .= '"'.str_replace('"','""',$thetext).'"' . $separator;
			} else {
			  // and put the text into the output separated by $separator defined above
			  $therow .= $thetext . $separator;
			}
		}

		// lop off the trailing tab, then append the end of row indicator
		$therow = substr($therow,0,strlen($therow)-1) . $endofrow;

		if ($_GET['download'] == 'activestream'){
		  echo $therow;
		} else {
		  $filestring .= $therow;
		}
		// grab the next row from the db
		$row =  mysql_fetch_array($result);
	}

	// now either stream it to them or put it in the temp directory
	if ($_GET['download'] == 'activestream'){
		die();
	} elseif ($_GET['download'] == 'stream'){
		//*******************************
		// STREAM FILE
		//*******************************
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=$EXPORT_TIME" . (($excel_safe_output == true)?".csv":".txt"));
        // Changed if using SSL, helps prevent program delay/timeout (add to backup.php also)
	    //	header("Pragma: no-cache");
	    if ($request_type== 'NONSSL'){
	      header("Pragma: no-cache");
	    } else {
	      header("Pragma: ");
	    }
		header("Expires: 0");
		echo $filestring;
		die();
	} elseif ($_GET['download'] == 'tempfile') {
		//*******************************
		// PUT FILE IN TEMP DIR
		//*******************************
		$tmpfname = DIR_FS_CATALOG . '' . $tempdir . "$EXPORT_TIME" . (($excel_safe_output == true)?".csv":".txt");
		//unlink($tmpfname);
		$fp = fopen( $tmpfname, "w+");
		fwrite($fp, $filestring);
		fclose($fp);
		echo EASY_FILE_LOCATE . $tempdir .  "EP" . $EXPORT_TIME . (($excel_safe_output == true)?".csv":".txt");
		die();
	}
}   // *** END *** download section

//*******************************
//*******************************
// DOWNLOADING ENDS HERE
//*******************************
//*******************************

?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<td class="pageHeading" valign="top"><?php
echo EASY_VERSION_A . $curver .  EASY_DEFAULT_LANGUAGE . $epdlanguage_name . '(' . $epdlanguage_id .')' ;
?>

<p class="smallText">

<?php

//*******************************
//*******************************
// UPLOADING OF FILES STARTS HERE
//*******************************
//*******************************

//if ($localfile or (is_uploaded_file($usrfl) && $split==0)) {

//*NEW supports ZenCart Vers. 1.3.x
//if ($localfile or (is_uploaded_file($usrfl) && ($_GET['split']==0))) {

//*NEW supports register_globals=OFF

if ($localfile or (isset($_FILES['usrfl']) && ($_GET['split']==0))) {

	//*******************************
	//*******************************
	// UPLOAD AND INSERT FILE
	//*******************************
	//*******************************

    //if ($usrfl){ //*NEW supports register_globals=OFF
	if (isset($_FILES['usrfl'])){
	    //echo '$usrfl: ' . $_FILES['usrfl']['name'];
		// move the file to where we can work with it
		$file = zen_get_uploaded_file('usrfl');
		if (is_uploaded_file($file['tmp_name'])) {
			zen_copy_uploaded_file($file, DIR_FS_CATALOG . '' . $tempdir);
		}

		echo "<p class='smallText'><font color='green'><b>";
		echo EASY_UPLOAD_FILE. "</b></font><br>";
		//echo EASY_UPLOAD_TEMP . $usrfl . "<br>";
		//echo EASY_UPLOAD_USER_FILE . $usrfl_name . "<br>";
		//echo EASY_SIZE . $usrfl_size . "<br>";

        //*NEW supports register_globals=OFF
		echo EASY_UPLOAD_TEMP . $file['tmp_name'] . "<br>";
		echo EASY_UPLOAD_USER_FILE . $file['name'] . "<br>";
		echo EASY_SIZE . $file['size'] . "<br>";

		// get the entire file into an array
		//$readed = file(DIR_FS_CATALOG . '' . $tempdir . $usrfl_name);

		//*NEW supports register_globals=OFF
		$readed = file(DIR_FS_CATALOG . '' . $tempdir . $file['name']);
	}
	if ($localfile){
	    //echo '$localfile: ' . $localfile;
		// move the file to where we can work with it
		$file = zen_get_uploaded_file('usrfl');

		if (is_uploaded_file($file['tmp_name'])) {
			zen_copy_uploaded_file($file, DIR_FS_CATALOG . '' . $tempdir);
		}

		echo "<p class='smallText'><font color='green'><b>";
		echo EASY_FILENAME . $localfile . "</b></font><br>";

		// get the entire file into an array
		$readed = file(DIR_FS_CATALOG . '' . $tempdir . $localfile);
	}

    if ($excel_safe_output == true) {
	  // do excel safe input
      unset($readed);                    // kill array setup with above code
	  $readed = array();                 // start a new one for excel_safe_output

	  //$fp = fopen(DIR_FS_CATALOG . '' . $tempdir . ($usrfl?$usrfl_name:$localfile),'r') or die('##Can not open CSV file for reading. Script will terminate.<br />');  // open file
      //*NEW supports register_globals=OFF *** NOT TESTED ***
      $fp = fopen(DIR_FS_CATALOG . '' . $tempdir . ($_FILES['usrfl']?$file['name']:$localfile),'r') or die('##Can not open CSV file for reading. Script will terminate.<br />');  // open file

      while($line = fgetcsv($fp,32768,$separator))   // read new line (max 32K bytes)
	  {
	    unset($line[(sizeof($line)-1)]);  // remove EOREOR at the end of the array
		$readed[] = $line;                // add to array we will process later
	  }
	  $theheaders_array = $readed[0];     // pull out header line
	  fclose($fp);                        // close file

    } else {
	  // do normal EP input
	  // now we string the entire thing together in case there were carriage returns in the data
	  $newreaded = "";
	  foreach ($readed as $read){
		$newreaded .= $read;
	  }

	  // now newreaded has the entire file together without the carriage returns.
	  // if for some reason excel put qoutes around our EOREOR, remove them then split into rows
	  $newreaded = str_replace('"EOREOR"', 'EOREOR', $newreaded);
	  $readed = explode( $separator . 'EOREOR',$newreaded);

	  // Now we'll populate the filelayout based on the header row.
	  $theheaders_array = explode( $separator, $readed[0] ); // explode the first row, it will be our filelayout
    }

	$lll = 0;
	$filelayout = array();
	foreach( $theheaders_array as $header ){
		$cleanheader = str_replace( '"', '', $header);
	    // echo "Fileheader was $header<br><br><br>";
		$filelayout[ $cleanheader ] = $lll++; //
	}
	unset($readed[0]); //  we don't want to process the headers with the data

	//Datensatz Counter
	$dcount=0;

	// now we've got the array broken into parts by the expicit end-of-row marker.
	array_walk($readed, 'walk');

	//Datensatz Counter
	echo "<p class='smallText'><font color='green'><b>&nbsp;" . $dcount . EASYPOPULATE_DATACOUNT . "</b></font>";

}

//if (is_uploaded_file($usrfl) && ($_GET['split']==1)) {
if ((isset($_FILES['usrfl'])) && ($_GET['split']==1)) {

	//*******************************
	//*******************************
	// UPLOAD AND SPLIT FILE
	//*******************************
	//*******************************
	// move the file to where we can work with it

	$file = zen_get_uploaded_file('usrfl');

	//echo "Trying to move file...";
	if (is_uploaded_file($file['tmp_name'])) {
		zen_copy_uploaded_file($file, DIR_FS_CATALOG . '' . $tempdir);
	}

	//$infp = fopen(DIR_FS_CATALOG . '' . $tempdir . $usrfl_name, "r");
	$infp = fopen(DIR_FS_CATALOG . '' . $tempdir . $file['name'], "r");

	//toprow has the field headers
	$toprow = fgets($infp,32768);

	$filecount = 1;

	$tmpfname = EASYPOPULATE_FILE_SPLITS_PREFIX . $filecount . "-" . $file['name'];

	echo EASY_LABEL_FILE_COUNT_1A . $tmpfname;

	$tmpfpath = DIR_FS_CATALOG  . $tempdir . $tmpfname;

	$fp = fopen( $tmpfpath, "w+");
	fwrite($fp, $toprow);

	$linecount = 0;
	$line = fgets($infp,32768);
	while ($line){
		// walking the entire file one row at a time
		// but a line is not necessarily a complete row, we need to split on rows that have "EOREOR" at the end
		$line = str_replace('"EOREOR"', 'EOREOR', $line);
		fwrite($fp, $line);
		if (strpos($line, 'EOREOR')){
			// we found the end of a line of data, store it
			$linecount++; // increment our line counter
			if ($linecount >= $maxrecs){
				echo EASY_LABEL_LINE_COUNT_1 . $linecount . EASY_LABEL_LINE_COUNT_2 . '<Br>';
				$linecount = 0; // reset our line counter
				// close the existing file and open another;
				fclose($fp);
				// increment filecount
				$filecount++;

				//echo "Creating file EP_Split" . $filecount . ".txt ...  ";

				$tmpfname = EASYPOPULATE_FILE_SPLITS_PREFIX . $filecount . "-" . $file['name'];

				echo EASY_LABEL_FILE_COUNT_1A . $tmpfname;

				$tmpfpath = DIR_FS_CATALOG  . $tempdir . $tmpfname;;
				//Open next file name
				$fp = fopen( $tmpfpath, "w+");
				fwrite($fp, $toprow);
			}
		}
		$line=fgets($infp,32768);
	}
	echo EASY_LABEL_FILE_CLOSE_1 . $linecount . EASY_LABEL_FILE_CLOSE_2 . '<br><br> ';
	fclose($fp);
	fclose($infp);

	echo EASY_SPLIT_DOWN;

}


?>
      </p>

      <table width="<?php if ($show_ep_settings == true) { echo '95'; } else { echo '75'; } ?>%" border="2">
        <tr>
          <td width="75%">
           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php?split=0" METHOD=POST>
                <p style="margin-top: 8px;"><b><?PHP ECHO EASY_UPLOAD_EP_FILE;?></b></p>
                <p>
                  <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="100000000">
                  <input name="usrfl" type="file" size="50">
                  <input type="submit" name="buttoninsert" value="<?php echo TEXT_INSERT_INTO_DB ; ?>">
                <br>
                </p>
              </form>

           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php?split=1" METHOD=POST>
                <p style="margin-top: 8px;"><b><?php echo EASY_SPLIT_EP_FILE;?></b></p>
                <p>
                  <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000000">
                  <input name="usrfl" type="file" size="50">
                  <input type="submit" name="buttonsplit" value="<?php echo EASY_LABEL_SPLIT_FILE ; ?>">
                <br>
                </p>
             </form>

           <FORM ENCTYPE="multipart/form-data" ACTION="easypopulate.php" METHOD=POST>
                <p style="margin-top: 8px;"><b><?php echo sprintf(TEXT_IMPORT_TEMP, $tempdir2); ?></b></p>
                <!--p>
                  <INPUT TYPE="text" name="localfile" size="50"-->
                  <?php
					$dir = dir(DIR_FS_CATALOG . $tempdir2);
					$contents = array(array('id' => '', 'text' => TEXT_SELECT_ONE));
					while ($file = $dir->read()) {
					  if ( ($file != '.') && ($file != 'CVS') && ($file != '..') ) {
						//$file_size = filesize(DIR_FS_CATALOG . $tempdir2 . $file);

						$contents[] = array('id' => $file, 'text' => $file);
					  }
					}
					echo zen_draw_pull_down_menu('localfile', $contents, $localfile);
				  ?>
                  <input type="submit" name="buttoninsert" value="<?php echo TEXT_INSERT_INTO_DB ; ?>">
                  <br>
                <!--/p-->
             </form>
        <p>&nbsp</p>
		<p style="margin-top: 8px;"><b><?php echo EASY_LABEL_CREATE;?></b></p>
		<p><!-- Download file links -  Add your custom fields here -->
		  <table border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #666666; padding: 3px;">
		  <?php echo zen_draw_form('custom', 'easypopulate.php', 'id="custom"', 'get'); ?>
		  <tr><td class="smallText"><?php

		  echo zen_draw_pull_down_menu('download',array( 0 => array( "id" => 'activestream', 'text' => TEXT_SELECT_DOWNLOAD1 ), 1 => array( "id" => 'stream', 'text' => TEXT_SELECT_DOWNLOAD2 ), 2 => array( "id" => 'tempfile', 'text' => TEXT_SELECT_DOWNLOAD3 )));
		  echo '&nbsp;&nbsp;' . zen_draw_pull_down_menu('dltype',array( 0 => array( "id" => 'full', 'text' => EASY_LABEL_COMPLETE ), 1 => array( "id" => 'custom', 'text' => EASY_LABEL_CUSTOM ), 2 => array( "id" => 'priceqty', 'text' => EASY_LABEL_PQ ), 3 => array( "id" => 'catagory', 'text' => EASY_LABEL_CATEGORIES ), 4 => array( "id" => 'attrib', 'text' => EASY_LABEL_EP_ATTRIB ), 5 => array( "id" => 'froogle', 'text' => EASY_LABEL_EP_FROGGLE )),'custom','onChange="return switchForm(this);"');
		  echo '&nbsp;' . (($excel_safe_output == true)?".csv":".txt") . EASY_EXPORT_INFO;

          $cells = array();
          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_name', 'show', true) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_NAME . '</td></tr></table>');
          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_description', 'show', (!empty($_GET['epcust_description'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_DESCRIPTION . '</td></tr></table>');
          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_url', 'show', (!empty($_GET['epcust_url'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_URL . '</td></tr></table>');
          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_image', 'show', (!empty($_GET['epcust_image'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_IMAGE . '</td></tr></table>');

          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_category', 'show', (!empty($_GET['epcust_category'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_CATEGORIES . '</td></tr></table>');
          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_manufacturer', 'show', (!empty($_GET['epcust_manufacturer'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_MANUFACTURER . '</td></tr></table>');

          $cells[0][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_sort_order', 'show', (!empty($_GET['epcust_sort_order'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_SORT_ORDER . '</td></tr></table>');


          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_price', 'show', true) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_PRICE . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_quantity', 'show', (!empty($_GET['epcust_quantity'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_QUANTITY . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_weight', 'show', (!empty($_GET['epcust_weight'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_WEIGHT . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_tax_class', 'show', (!empty($_GET['epcust_tax_class'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_TAX_CLASS . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_avail', 'show', (!empty($_GET['epcust_avail'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_AVAILABLE . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_date_added', 'show', (!empty($_GET['epcust_date_added'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_DATE_ADDED . '</td></tr></table>');
          $cells[1][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_status', 'show', (!empty($_GET['epcust_status'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_STATUS . '</td></tr></table>');

          if ($products_with_attributes == true) {
		  	$cells[2][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_attributes', 'show', (!empty($_GET['epcust_attributes'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_ATTRIBUTES . '</td></tr></table>');
            $cells[2][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_attributes_weight', 'show', (!empty($_GET['epcust_attributes_weight'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_ATTRIBUTES_WEIGHT . '</td></tr></table>');
            $cells[2][] = array('text' => '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">' . zen_draw_checkbox_field('epcust_attributes_sort_order', 'show', (!empty($_GET['epcust_attributes_sort_order'])?true:false)) . '</td><td class="smallText"> ' . EASYPOPULATE_EXPORT_ATTRIBUTES_SORT_ORDER . '</td></tr></table>');

          }

          $bigbox = new epbox('',false);
          $bigbox->table_parameters = 'id="customtable" style="border: 1px solid #CCCCCC; padding: 2px; margin: 3px;"';
          echo $bigbox->output($cells);

          $manufacturers_array = array();
          $manufacturers_array[] = array( "id" => '', 'text' => EASY_EXPORT_MAN );
          $manufacturers_query = mysql_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
          while ($manufacturers = mysql_fetch_array($manufacturers_query)) {
            $manufacturers_array[] = array( "id" => $manufacturers['manufacturers_id'], 'text' => $manufacturers['manufacturers_name'] );
          }

          $status_array = array(array( "id" => '', 'text' => EASY_EXPORT_STATUS ),array( "id" => '1', 'text' => EASY_EXPORT_STATUS1 ),array( "id" => '0', 'text' => EASY_EXPORT_STATUS0 ));

          echo EASY_EXPORT_FILTER . zen_draw_pull_down_menu('epcust_category_filter', array_merge(array( 0 => array( "id" => '', 'text' => EASY_EXPORT_CAT )), zen_get_category_tree()));
		  echo ' ' . zen_draw_pull_down_menu('epcust_manufacturer_filter', $manufacturers_array) . ' ';
		  echo ' ' . zen_draw_pull_down_menu('epcust_status_filter', $status_array) . ' ';

          echo zen_draw_input_field('submit', EASY_LABEL_PRODUCT_START, ' style="padding: 0px"', false, 'submit');
          ?></td></tr>
		  </form>
		  </table>
		</p><br><br>

		<span class="smallText"><?php echo EASYPOPULATE_QUICK_LINKS; ?></span>
		<table width="100%" border="0" cellpadding="3" cellspacing="3"><tr><td width="50%" valign="top" bgcolor="#EEEEEE">
		<p style="margin-top: 8px;"><b><?php echo EASYPOPULATE_CREATE_DOWNLOAD; ?></b><br>
		<span class="smallText"><?php echo EASYPOPULATE_DOWNLOAD_INFO; ?></span></p>
		<p><!-- Download file links -  Add your custom fields here -->
		  <a href="easypopulate.php?download=stream&dltype=full"><?php echo EASYPOPULATE_LINK_DOWNLOAD . EASYPOPULATE_LINK_FULL . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_EDIT; ?></a><br>
		  <a href="easypopulate.php?download=stream&dltype=priceqty"><?php echo EASYPOPULATE_LINK_DOWNLOAD . EASYPOPULATE_LINK_PRICEQTY . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_EDIT; ?></a><br>
		  <a href="easypopulate.php?download=stream&dltype=category"><?php echo EASYPOPULATE_LINK_DOWNLOAD . EASYPOPULATE_LINK_CATEGORY . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_EDIT; ?></a><br>
		  <a href="easypopulate.php?download=stream&dltype=froogle"><?php echo EASYPOPULATE_LINK_DOWNLOAD . EASYPOPULATE_LINK_FROGGLE . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_EDIT; ?></a><br>
		  <!-- VJ product attributes begin //-->
		  <?php if ($products_with_attributes == true) { ?>
		  <a href="easypopulate.php?download=stream&dltype=attrib"><?php echo EASYPOPULATE_LINK_DOWNLOAD . EASYPOPULATE_LINK_ATTRIB . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_EDIT; ?></a><br>
		  <?php } ?>
		  <!-- VJ product attributes end //-->
		</p><br>
        </td><td width="50%" valign="top" bgcolor="#EEEEEE">
		<p style="margin-top: 8px;"><b><?php echo EASYPOPULATE_CREATE_FILES; ?></b><br>
		<span class="smallText"><?php echo EASYPOPULATE_FILES_INFO; ?></span></p>
		<p>
          <a href="easypopulate.php?download=tempfile&dltype=full"><?php echo EASYPOPULATE_LINK_CREATE . EASYPOPULATE_LINK_FULL . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_TEMP; ?></a><br>
          <a href="easypopulate.php?download=tempfile&dltype=priceqty"><?php echo EASYPOPULATE_LINK_CREATE . EASYPOPULATE_LINK_PRICEQTY . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_TEMP; ?></a><br>
          <a href="easypopulate.php?download=tempfile&dltype=category"><?php echo EASYPOPULATE_LINK_CREATE . EASYPOPULATE_LINK_CATEGORY . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_TEMP; ?></a><br>
          <a href="easypopulate.php?download=tempfile&dltype=froogle"><?php echo EASYPOPULATE_LINK_CREATE . EASYPOPULATE_LINK_FROGGLE . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_TEMP; ?></a><br>
          <!-- VJ product attributes begin //-->
          <?php if ($products_with_attributes == true) { ?>
          <a href="easypopulate.php?download=tempfile&dltype=attrib"><?php echo EASYPOPULATE_LINK_CREATE . EASYPOPULATE_LINK_ATTRIB . (($excel_safe_output == true)?".csv":".txt"). EASYPOPULATE_LINK_TEMP; ?></a><br>
          <?php } ?>
		  <!-- VJ product attributes end //-->
		</p><br>
		</td></tr></table>

          </td>

          <?php if ($show_ep_settings == true) { ?>
          <td width="25%" valign="top"><p style="margin-top: 8px;"><b><?php echo EASYPOPULATE_SETTINGS; ?></b></p>
		  <table border="0" cellpadding="0" cellspacing="0"><tr><td class="smallText">
		     <p><?php echo EASYPOPULATE_SET_TEMP_DIR; ?><br>
			 <?php echo $tempdir; ?></p>
		     <p><?php echo EASYPOPULATE_SET_SPLIT_FILE . $maxrecs .   EASYPOPULATE_SET_RECORDS; ?></p>
		     <p><?php echo EASYPOPULATE_SET_MODEL_NUM_SIZE . $modelsize; ?></p>
		     <p><?php echo EASYPOPULATE_SET_PRICE_TAX . ($price_with_tax?'true':'false'); ?></p>
		     <p><?php echo EASYPOPULATE_SET_REPLACE_QUOTES . ($replace_quotes?'true':'false'); ?></p>
		     <p>
			 <?php echo EASYPOPULATE_SET_FIELD_SEPERATOR;
			    switch ($separator) {
			   case "\t";
			     echo 'tab';
			     break;
			   case ",";
			     echo 'comma';
			     break;
			   case ";";
			     echo 'semi-colon';
			     break;
			   case "~";
			     echo 'tilde';
			     break;
			   case "-";
			     echo 'dash';
			     break;
			   case "*";
			     echo 'splat';
			     break;
			 }
			 ?></p>
		     <p><?php echo EASYPOPULATE_SET_EXCEL_SAFE . ($excel_safe_output?'true':'false'); ?></p>
		     <p><?php echo EASYPOPULATE_SET_PRESERVE . ($preserve_tabs_cr_lf?'true':'false'); ?></p>
		     <p><?php echo EASYPOPULATE_SET_CAT_DEPTH . $max_categories; ?></p>
		     <p><?php echo EASYPOPULATE_SET_ATTRIBUTES . ($products_with_attributes?'true':'false'); ?></p>
		     <p><?php echo EASYPOPULATE_SET_FROGGLE . ($froogle_SEF_urls?'true':'false'); ?></p>

			 <br>
			 <div style="padding: 10px; background-color: #ffffCC"><?php echo EASYPOPULATE_SET_INFO; ?></div>
			 </td></tr></table>

		  </td>
          <?php } ?>
        </tr>
      </table>
    </td>
 </tr>
</table>

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<p> </p>
<p> </p><p><br>
</p></body>
</html>

<?php

function ep_get_languages() {
	$languages_query = mysql_query("select languages_id, code from " . TABLE_LANGUAGES . " order by sort_order");
	// start array at one, the rest of the code expects it that way
	$ll =1;
	while ($ep_languages = mysql_fetch_array($languages_query)) {
		//will be used to return language_id en language code to report in product_name_code instead of product_name_id
		$ep_languages_array[$ll++] = array(
					'id' => $ep_languages['languages_id'],
					'code' => $ep_languages['code']
					);
	}
	return $ep_languages_array;
};

function zen_get_tax_class_rate($tax_class_id) {
	$tax_multiplier = 0;
	$tax_query = mysql_query("select SUM(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " WHERE  tax_class_id = '" . $tax_class_id . "' GROUP BY tax_priority");
	if (mysql_num_rows($tax_query)) {
		while ($tax = mysql_fetch_array($tax_query)) {
			$tax_multiplier += $tax['tax_rate'];
		}
	}
	return $tax_multiplier;
};

function zen_get_tax_title_class_id($tax_class_title) {
	$classes_query = mysql_query("select tax_class_id from " . TABLE_TAX_CLASS . " WHERE tax_class_title = '" . $tax_class_title . "'" );
	$tax_class_array = mysql_fetch_array($classes_query);
	$tax_class_id = $tax_class_array['tax_class_id'];
	return $tax_class_id ;
}

function print_el( $item2 ) {
	echo " | " . substr(strip_tags($item2), 0, 10);
};

function print_el1( $item2 ) {
	echo sprintf("| %'.4s ", substr(strip_tags($item2), 0, 80));
};
//////
//////
// ep_create_filelayout()
///////////////////////////////////////
function ep_create_filelayout($dltype){
	global $filelayout, $filelayout_count, $filelayout_sql, $langcode, $fileheaders, $max_categories;
	global $attribute_options_array;
	// depending on the type of the download the user wanted, create a file layout for it.
	$fieldmap = array(); // default to no mapping to change internal field names to external.

	// build filters
	$sql_filter = '';
	if (!empty($_GET['epcust_category_filter'])) {
	  $sub_categories = array();
	  $categories_query_addition = 'ptoc.categories_id = ' . (int)$_GET['epcust_category_filter'] . '';
	  zen_get_sub_categories($sub_categories, $_GET['epcust_category_filter']);
	  foreach ($sub_categories AS $ckey => $category ) {
		$categories_query_addition .= ' or ptoc.categories_id = ' . (int)$category . '';
	  }
	  $sql_filter .= ' and (' . $categories_query_addition . ')';
	}
	if ($_GET['epcust_manufacturer_filter']!='') {
	  $sql_filter .= ' and p.manufacturers_id = ' . (int)$_GET['epcust_manufacturer_filter'];
	}
	if ($_GET['epcust_status_filter']!='') {
	  $sql_filter .= ' and p.products_status = ' . (int)$_GET['epcust_status_filter'];
	}

	switch( $dltype ){
	case 'full':
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_products_model'		=> $iii++,
			'v_products_image'		=> $iii++,
			);

		foreach ($langcode as $key => $lang){
			$l_id = $lang['id'];
			// uncomment the head_title, head_desc, and head_keywords to use
			// Linda's Header Tag Controller 2.0
			// echo $langcode['id'] . $langcode['code'];
			$filelayout  = array_merge($filelayout , array(
					'v_products_name_' . $l_id		=> $iii++,
					'v_products_description_' . $l_id	=> $iii++,
					'v_products_url_' . $l_id	=> $iii++,
			//		'v_products_head_title_tag_'.$l_id	=> $iii++,
			//		'v_products_head_desc_tag_'.$l_id	=> $iii++,
			//		'v_products_head_keywords_tag_'.$l_id	=> $iii++,
					));
		}


		// uncomment the customer_price and customer_group to support multi-price per product contrib

    // VJ product attribs begin
     $header_array = array(
			'v_products_price'		=> $iii++,
			'v_products_priced_by_attribute' => $iii++,
			'v_products_weight'		=> $iii++,
			'v_products_sort_order'	=> $iii++,
			'v_date_avail'			=> $iii++,
			'v_date_added'			=> $iii++,
			'v_products_quantity'	=> $iii++,
			);

        $languages = zen_get_languages();

        $attribute_options_count = 1;
        foreach ($attribute_options_array as $attribute_options_values) {
            $key1 = 'v_attribute_options_id_' . $attribute_options_count;
            $header_array[$key1] = $iii++;

            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$l_id = $languages[$i]['id'];
					$key2 = 'v_attribute_options_name_' . $attribute_options_count . '_' . $l_id;
					$header_array[$key2] = $iii++;
            }

            $attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";
            $attribute_values_values = mysql_query($attribute_values_query);

            $attribute_values_count = 1;
            while ($attribute_values = mysql_fetch_array($attribute_values_values)) {
                $key3 = 'v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count;
                $header_array[$key3] = $iii++;

                for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                    $l_id = $languages[$i]['id'];
                    $key4 = 'v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $l_id;
                    $header_array[$key4] = $iii++;
                }

                $key5 = 'v_attribute_price_prefix_' . $attribute_options_count . '_' . $attribute_values_count;
                $header_array[$key5] = $iii++;

                $key5 = 'v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count;
                $header_array[$key5] = $iii++;

                //Attributes default
				$key7 = 'v_attribute_values_default_' . $attribute_options_count . '_' . $attribute_values_count;
				$header_array[$key7] = $iii++;

				//Attributes weight
				//if ($flag_attributes_weight == true) {
				    $key8 = 'v_attribute_weight_prefix_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key8] = $iii++;
					$key8 = 'v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key8] = $iii++;
                //}

                //Attributes sort order
                    $key8 = 'v_attribute_sort_order_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key8] = $iii++;


                //// attributes stock add start
                if ( $products_attributes_stock	== true ) {
                    $key6 = 'v_attribute_values_stock_' . $attribute_options_count . '_' . $attribute_values_count;
                    $header_array[$key6] = $iii++;
                }
                //// attributes stock add end

                $attribute_values_count++;
             }

            $attribute_options_count++;
        }
        // VJ product attribs end

		$header_array['v_manufacturers_name'] = $iii++;

		$filelayout = array_merge($filelayout, $header_array);

		// build the categories name section of the array based on the number of categores the user wants to have
		for($i=1;$i<$max_categories+1;$i++){
			$filelayout = array_merge($filelayout, array('v_categories_name_' . $i => $iii++));
		}

		$filelayout = array_merge($filelayout, array(
			'v_tax_class_title'		=> $iii++,
			'v_status'			=> $iii++,
			));

		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_image as v_products_image,
			p.products_price as v_products_price,
			p.products_priced_by_attribute as v_products_priced_by_attribute,
			p.products_weight as v_products_weight,
			p.products_sort_order as v_products_sort_order,
			p.products_date_available as v_date_avail,
			p.products_date_added as v_date_added,
			p.products_tax_class_id as v_tax_class_id,
			p.products_quantity as v_products_quantity,
			p.manufacturers_id as v_manufacturers_id,
			subc.categories_id as v_categories_id,
			p.products_status as v_status
			FROM
			".TABLE_PRODUCTS." as p,
			".TABLE_CATEGORIES." as subc,
			".TABLE_PRODUCTS_TO_CATEGORIES." as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			" . $sql_filter;

		break;
	case 'priceqty':
		$iii = 0;
		// uncomment the customer_price and customer_group to support multi-price per product contrib
		$filelayout = array(
			'v_products_model'		=> $iii++,
			'v_products_price'		=> $iii++,
			'v_products_quantity'		=> $iii++,
			#'v_customer_price_1'		=> $iii++,
			#'v_customer_group_id_1'		=> $iii++,
			#'v_customer_price_2'		=> $iii++,
			#'v_customer_group_id_2'		=> $iii++,
			#'v_customer_price_3'		=> $iii++,
			#'v_customer_group_id_3'		=> $iii++,
			#'v_customer_price_4'		=> $iii++,
			#'v_customer_group_id_4'		=> $iii++,
				);
		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_price as v_products_price,
			p.products_tax_class_id as v_tax_class_id,
			p.products_quantity as v_products_quantity
			FROM
			".TABLE_PRODUCTS." as p
			";
		break;

	case 'custom':
		$iii = 0;
		$filelayout = array( 'v_products_model' => $iii++ );
		if (!empty($_GET['epcust_upc'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_upc' => $iii++ ));
		}
		if (!empty($_GET['epcust_status'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_status' => $iii++ ));
		}

		foreach ($langcode as $key => $lang){
			$l_id = $lang['id'];
			if (!empty($_GET['epcust_name'])) {
			  $filelayout  = array_merge($filelayout , array( 'v_products_name_' . $l_id => $iii++ ));
			}
			if (!empty($_GET['epcust_description'])) {
			  $filelayout  = array_merge($filelayout , array( 'v_products_description_' . $l_id => $iii++ ));
			}
			if (!empty($_GET['epcust_url'])) {
			  $filelayout  = array_merge($filelayout , array( 'v_products_url_' . $l_id => $iii++ ));
			}
		}

		if (!empty($_GET['epcust_image'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_image' => $iii++ ));
		}

        if (!empty($_GET['epcust_shopping_sites'])) {
		  foreach($shopping_sites as $skey => $shopping_site ) {
			$filelayout  = array_merge($filelayout , array(
                             'v_shopping_sites_' . strtolower( str_replace(array(' ','.','/','_','-','\''), array('','','','','',''), $shopping_site['shopping_sites_title']) )	=> $iii++
                             ));
          }
		}

		if (!empty($_GET['epcust_attributes'])) {
          // VJ product attribs begin
          $languages = zen_get_languages();

          $attribute_options_count = 1;
          foreach ($attribute_options_array as $attribute_options_values) {
            $filelayout  = array_merge($filelayout , array( 'v_attribute_options_id_' . $attribute_options_count => $iii++ ));
            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                $filelayout  = array_merge($filelayout , array( 'v_attribute_options_name_' . $attribute_options_count . '_' . $languages[$i]['id'] => $iii++ ));
            }

            $attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";
            $attribute_values_values = mysql_query($attribute_values_query);

            $attribute_values_count = 1;
            while ($attribute_values = mysql_fetch_array($attribute_values_values)) {
                $filelayout  = array_merge($filelayout , array( 'v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));
                for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                    $filelayout  = array_merge($filelayout , array( 'v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $languages[$i]['id'] => $iii++ ));
                }
                $filelayout  = array_merge($filelayout , array( 'v_attribute_price_prefix_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));

                $filelayout  = array_merge($filelayout , array( 'v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));

                if (!empty($_GET['epcust_attributes_weight'])) {
                  $filelayout  = array_merge($filelayout , array( 'v_attribute_weight_prefix_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));
                  $filelayout  = array_merge($filelayout , array( 'v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));
                }

                if (!empty($_GET['epcust_attributes_sort_order'])) {
			      $filelayout  = array_merge($filelayout , array( 'v_attribute_sort_order_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));
			    }

                //// attributes stock add start
                if ( $products_attributes_stock	== true ) {
                    $filelayout  = array_merge($filelayout , array( 'v_attribute_values_stock_' . $attribute_options_count . '_' . $attribute_values_count => $iii++ ));
                }
                //// attributes stock add end
                $attribute_values_count++;
             }
            $attribute_options_count++;
          }
          // VJ product attribs end
		}
		if (!empty($_GET['epcust_price'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_price' => $iii++ ));
		  $filelayout  = array_merge($filelayout , array( 'v_products_priced_by_attribute' => $iii++ ));
		}
		if (!empty($_GET['epcust_cost'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_cost' => $iii++ ));
		}
		if (!empty($_GET['epcust_quantity'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_quantity' => $iii++ ));
		}
		if (!empty($_GET['epcust_weight'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_weight' => $iii++ ));
		}
		if (!empty($_GET['epcust_sort_order'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_sort_order' => $iii++ ));
		}
		if (!empty($_GET['epcust_date_added'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_date_added' => $iii++ ));
		}
		if (!empty($_GET['epcust_avail'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_date_avail' => $iii++ ));
		}
		if (!empty($_GET['epcust_manufacturer'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_manufacturers_name' => $iii++ ));
		}
		if (!empty($_GET['epcust_category'])) {
		  // build the categories name section of the array based on the number of categores the user wants to have
		  for($i=1;$i<$max_categories+1;$i++){
			$filelayout = array_merge($filelayout, array('v_categories_name_' . $i => $iii++));
		  }
		}
		if (!empty($_GET['epcust_tax_class'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_tax_class_title' => $iii++ ));
		}
		if (!empty($_GET['epcust_comment'])) {
		  $filelayout  = array_merge($filelayout , array( 'v_products_comment' => $iii++ ));
		}

		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_status as v_status,
			p.products_price as v_products_price,
			p.products_priced_by_attribute as v_products_priced_by_attribute,
			p.products_quantity as v_products_quantity,
			p.products_weight as v_products_weight,
			p.products_sort_order as v_products_sort_order,
			p.products_image as v_products_image,
			p.manufacturers_id as v_manufacturers_id,
			p.products_date_available as v_date_avail,
			p.products_date_added as v_date_added,
			p.products_tax_class_id as v_tax_class_id,
			subc.categories_id as v_categories_id
			FROM
			".TABLE_PRODUCTS." as p,
			".TABLE_CATEGORIES." as subc,
			".TABLE_PRODUCTS_TO_CATEGORIES." as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			" . $sql_filter;
		break;

	case 'category':
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_products_model'		=> $iii++,
		);

		// build the categories name section of the array based on the number of categores the user wants to have
		for($i=1;$i<$max_categories+1;$i++){
			$filelayout = array_merge($filelayout, array('v_categories_name_' . $i => $iii++));
		}


		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			subc.categories_id as v_categories_id
			FROM
			".TABLE_PRODUCTS." as p,
			".TABLE_CATEGORIES." as subc,
			".TABLE_PRODUCTS_TO_CATEGORIES." as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			";
		break;

	case 'froogle':
		// this is going to be a little interesting because we need
		// a way to map from internal names to external names
		//
		// Before it didn't matter, but with froogle needing particular headers,
		// The file layout is dynamically made depending on the number of languages
		$iii = 0;
		$filelayout = array(
			'v_froogle_products_url_1'			=> $iii++,
			);
		//
		// here we need to get the default language and put
		$l_id = 1; // dummy it in for now.
//		foreach ($langcode as $key => $lang){
//			$l_id = $lang['id'];
			$filelayout  = array_merge($filelayout , array(
					'v_froogle_products_name_' . $l_id		=> $iii++,
					'v_froogle_products_description_' . $l_id	=> $iii++,
					));
//		}
		$filelayout  = array_merge($filelayout , array(
			'v_products_price'		=> $iii++,
			'v_products_fullpath_image'	=> $iii++,
			'v_category_fullpath'		=> $iii++,
			'v_froogle_offer_id'		=> $iii++,
			'v_froogle_instock'		=> $iii++,
			'v_froogle_ shipping'		=> $iii++,
			'v_manufacturers_name'		=> $iii++,
			'v_froogle_ upc'		=> $iii++,
			'v_froogle_color'		=> $iii++,
			'v_froogle_size'		=> $iii++,
			'v_froogle_quantitylevel'	=> $iii++,
			'v_froogle_product_id'		=> $iii++,
			'v_froogle_manufacturer_id'	=> $iii++,
			'v_froogle_exp_date'		=> $iii++,
			'v_froogle_product_type'	=> $iii++,
			'v_froogle_delete'		=> $iii++,
			'v_froogle_currency'		=> $iii++,
				));
		$iii=0;
		$fileheaders = array(
			'product_url'		=> $iii++,
			'name'			=> $iii++,
			'description'		=> $iii++,
			'price'			=> $iii++,
			'image_url'		=> $iii++,
			'category'		=> $iii++,
			'offer_id'		=> $iii++,
			'instock'		=> $iii++,
			'shipping'		=> $iii++,
			'brand'			=> $iii++,
			'upc'			=> $iii++,
			'color'			=> $iii++,
			'size'			=> $iii++,
			'quantity'		=> $iii++,
			'product_id'		=> $iii++,
			'manufacturer_id'	=> $iii++,
			'exp_date'		=> $iii++,
			'product_type'		=> $iii++,
			'delete'		=> $iii++,
			'currency'		=> $iii++,
			);
		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model,
			p.products_image as v_products_image,
			p.products_price as v_products_price,
			p.products_priced_by_attribute as v_products_priced_by_attribute,
			p.products_weight as v_products_weight,
			p.products_sort_order as v_products_sort_order,
			p.products_date_added as v_date_avail,
			p.products_tax_class_id as v_tax_class_id,
			p.products_quantity as v_products_quantity,
			p.manufacturers_id as v_manufacturers_id,
			subc.categories_id as v_categories_id
			FROM
			".TABLE_PRODUCTS." as p,
			".TABLE_CATEGORIES." as subc,
			".TABLE_PRODUCTS_TO_CATEGORIES." as ptoc
			WHERE
			p.products_id = ptoc.products_id AND
			ptoc.categories_id = subc.categories_id
			" . $sql_filter;
		break;

// VJ product attributes begin
	case 'attrib':
		$iii = 0;
		$filelayout = array(
			'v_products_model'		=> $iii++
			);

    $header_array = array();

		$languages = zen_get_languages();

    global $attribute_options_array;

    $attribute_options_count = 1;
    foreach ($attribute_options_array as $attribute_options_values) {
			$key1 = 'v_attribute_options_id_' . $attribute_options_count;
			$header_array[$key1] = $iii++;

			for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
				$l_id = $languages[$i]['id'];

				$key2 = 'v_attribute_options_name_' . $attribute_options_count . '_' . $l_id;
				$header_array[$key2] = $iii++;
			}

			$attribute_values_query = "select products_options_values_id  from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$attribute_options_values['products_options_id'] . "' order by products_options_values_id";

			$attribute_values_values = mysql_query($attribute_values_query);

			$attribute_values_count = 1;
				while ($attribute_values = mysql_fetch_array($attribute_values_values)) {
					$key3 = 'v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key3] = $iii++;

					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
						$l_id = $languages[$i]['id'];

						$key4 = 'v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $l_id;
						$header_array[$key4] = $iii++;
					}

                    $key5 = 'v_attribute_price_prefix_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key5] = $iii++;

					$key5 = 'v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key5] = $iii++;

//Attributes default
$key7 = 'v_attribute_values_default_' . $attribute_options_count . '_' . $attribute_values_count;
$header_array[$key7] = $iii++;

//Attributes weight
//if ($flag_attributes_weight == true) {
    $key8 = 'v_attribute_weight_prefix_' . $attribute_options_count . '_' . $attribute_values_count;
	$header_array[$key8] = $iii++;
	$key8 = 'v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count;
	$header_array[$key8] = $iii++;
//}

//Attributes sort order
  $key8 = 'v_attribute_sort_order_' . $attribute_options_count . '_' . $attribute_values_count;
  $header_array[$key8] = $iii++;

//// attributes stock add start
	if ( $products_attributes_stock	== true ) {
					$key6 = 'v_attribute_values_stock_' . $attribute_options_count . '_' . $attribute_values_count;
					$header_array[$key6] = $iii++;
	}
//// attributes stock add end

					$attribute_values_count++;
				}

			$attribute_options_count++;
    }

    $filelayout = array_merge($filelayout, $header_array);

		$filelayout_sql = "SELECT
			p.products_id as v_products_id,
			p.products_model as v_products_model
			FROM
			".TABLE_PRODUCTS." as p
			";

		break;
// VJ product attributes end
	}
	$filelayout_count = count($filelayout);

}

//////
//////
// walk()
///////////////////////////////////////
function walk( $item1 ) {
	global $filelayout, $filelayout_count, $modelsize;
	global $active, $inactive, $langcode, $default_these, $deleteit, $zero_qty_inactive;
        global $epdlanguage_id, $price_with_tax, $replace_quotes;
	global $default_images, $default_image_manufacturer, $default_image_product, $default_image_category;
	global $separator, $max_categories;
	global $excel_safe_output;
	// first we clean up the row of data

    if ($excel_safe_output == true) {
	  $items = $item1;
	} else {
	  // chop blanks from each end
	  $item1 = ltrim(rtrim($item1));

	  // blow it into an array, splitting on the tabs
	  $items = explode($separator, $item1);
	}

	// make sure all non-set things are set to '';
	// and strip the quotes from the start and end of the stings.
	// escape any special chars for the database.
	foreach( $filelayout as $key=> $value){
		$i = $filelayout[$key];
		if (isset($items[$i]) == false) {
			$items[$i]='';
		} else {
			// Check to see if either of the magic_quotes are turned on or off;
			// And apply filtering accordingly.
			if (function_exists('ini_get')) {
				//echo "Getting ready to check magic quotes<br>";
				if (ini_get('magic_quotes_runtime') == 1){
					// The magic_quotes_runtime are on, so lets account for them
					// check if the last character is a quote;
					// if it is, chop off the quotes.
					if (substr($items[$i],-1) == '"'){
						$items[$i] = substr($items[$i],2,strlen($items[$i])-4);
					}
					// now any remaining doubled double quotes should be converted to one doublequote
					$items[$i] = str_replace('\"\"',"&#34",$items[$i]);
					if ($replace_quotes){
						$items[$i] = str_replace('\"',"&#34",$items[$i]);
						$items[$i] = str_replace("\'","&#39",$items[$i]);
					}
				} else { // no magic_quotes are on
					// check if the last character is a quote;
					// if it is, chop off the 1st and last character of the string.
					if (substr($items[$i],-1) == '"'){
						$items[$i] = substr($items[$i],1,strlen($items[$i])-2);
					}
					// now any remaining doubled double quotes should be converted to one doublequote
					$items[$i] = str_replace('""',"&#34",$items[$i]);
					if ($replace_quotes){
						$items[$i] = str_replace('"',"&#34",$items[$i]);
						$items[$i] = str_replace("'","&#39",$items[$i]);
					}
				}
			}
		}
	}
/*
	if ( $items['v_status'] == $deleteit ){
		// they want to delete this product.
		echo "Deleting product " . $items['v_products_model'] . " from the database<br>";
		// Get the ID

		// kill in the products_to_categories

		// Kill in the products table

		return; // we're done deleteing!
	}
*/
	// now do a query to get the record's current contents
	$sql = "SELECT
		p.products_id as v_products_id,
		p.products_model as v_products_model,
		p.products_image as v_products_image,
		p.products_price as v_products_price,
		p.products_priced_by_attribute as v_products_priced_by_attribute,
		p.products_weight as v_products_weight,
		p.products_sort_order as v_products_sort_order,
		p.products_date_added as v_date_avail,
		p.products_tax_class_id as v_tax_class_id,
		p.products_quantity as v_products_quantity,
		p.manufacturers_id as v_manufacturers_id,
		subc.categories_id as v_categories_id
		FROM
		".TABLE_PRODUCTS." as p,
		".TABLE_CATEGORIES." as subc,
		".TABLE_PRODUCTS_TO_CATEGORIES." as ptoc
		WHERE
		p.products_id = ptoc.products_id AND
		p.products_model = '" . $items[$filelayout['v_products_model']] . "' AND
		ptoc.categories_id = subc.categories_id
		";

	$result = mysql_query($sql);
	$row =  mysql_fetch_array($result);


	while ($row){
    	// OK, since we got a row, the item already exists.
		// Let's get all the data we need and fill in all the fields that need to be defaulted to the current values
		// for each language, get the description and set the vals
		foreach ($langcode as $key => $lang){
			//echo "Inside defaulting loop";
			//echo "key is $key<br>";
			//echo "langid is " . $lang['id'] . "<br>";
//			$sql2 = "SELECT products_name, products_description
//				FROM ".TABLE_PRODUCTS_DESCRIPTION."
//				WHERE
//					products_id = " . $row['v_products_id'] . " AND
//					language_id = '" . $lang['id'] . "'
//				";
			$sql2 = "SELECT *
				FROM ".TABLE_PRODUCTS_DESCRIPTION."
				WHERE
					products_id = " . $row['v_products_id'] . " AND
					language_id = '" . $lang['id'] . "'
				";
			$result2 = mysql_query($sql2);
			$row2 =  mysql_fetch_array($result2);
                        // Need to report from ......_name_1 not ..._name_0
			$row['v_products_name_' . $lang['id']] 		= $row2['products_name'];
			$row['v_products_description_' . $lang['id']] 	= $row2['products_description'];
			$row['v_products_url_' . $lang['id']] 		= $row2['products_url'];

			// support for Linda's Header Controller 2.0 here
			if(isset($filelayout['v_products_head_title_tag_' . $lang['id'] ])){
				$row['v_products_head_title_tag_' . $lang['id']] 	= $row2['products_head_title_tag'];
				$row['v_products_head_desc_tag_' . $lang['id']] 	= $row2['products_head_desc_tag'];
				$row['v_products_head_keywords_tag_' . $lang['id']] 	= $row2['products_head_keywords_tag'];
			}
			// end support for Header Controller 2.0
		}

		// start with v_categories_id
		// Get the category description
		// set the appropriate variable name
		// if parent_id is not null, then follow it up.
		$thecategory_id = $row['v_categories_id'];

		for( $categorylevel=1; $categorylevel<$max_categories+1; $categorylevel++){
			if ($thecategory_id){
				$sql2 = "SELECT categories_name
					FROM ".TABLE_CATEGORIES_DESCRIPTION."
					WHERE
						categories_id = " . $thecategory_id . " AND
						language_id = " . $epdlanguage_id ;

				$result2 = mysql_query($sql2);
				$row2 =  mysql_fetch_array($result2);
				// only set it if we found something
				$temprow['v_categories_name_' . $categorylevel] = $row2['categories_name'];
				// now get the parent ID if there was one
				$sql3 = "SELECT parent_id
					FROM ".TABLE_CATEGORIES."
					WHERE
						categories_id = " . $thecategory_id;
				$result3 = mysql_query($sql3);
				$row3 =  mysql_fetch_array($result3);
				$theparent_id = $row3['parent_id'];
				if ($theparent_id != ''){
					// there was a parent ID, lets set thecategoryid to get the next level
					$thecategory_id = $theparent_id;
				} else {
					// we have found the top level category for this item,
					$thecategory_id = false;
				}
			} else {
					$temprow['v_categories_name_' . $categorylevel] = '';
			}
		}
		// temprow has the old style low to high level categories.
		$newlevel = 1;
		// let's turn them into high to low level categories
		for( $categorylevel=$max_categories+1; $categorylevel>0; $categorylevel--){
			if ($temprow['v_categories_name_' . $categorylevel] != ''){
				$row['v_categories_name_' . $newlevel++] = $temprow['v_categories_name_' . $categorylevel];
			}
		}

		if ($row['v_manufacturers_id'] != ''){
			$sql2 = "SELECT manufacturers_name
				FROM ".TABLE_MANUFACTURERS."
				WHERE
				manufacturers_id = " . $row['v_manufacturers_id']
				;
			$result2 = mysql_query($sql2);
			$row2 =  mysql_fetch_array($result2);
			$row['v_manufacturers_name'] = $row2['manufacturers_name'];
		}

		//elari -
		//We check the value of tax class and title instead of the id
		//Then we add the tax to price if $price_with_tax is set to true
		$row_tax_multiplier = zen_get_tax_class_rate($row['v_tax_class_id']);
		$row['v_tax_class_title'] = zen_get_tax_class_title($row['v_tax_class_id']);
		if ($price_with_tax){
			$row['v_products_price'] = round($row['v_products_price'] + ($row['v_products_price'] * $row_tax_multiplier / 100),2);
		}

		// now create the internal variables that will be used
		// the $$thisvar is on purpose: it creates a variable named what ever was in $thisvar and sets the value
		foreach ($default_these as $thisvar){
			$$thisvar	= $row[$thisvar];
		}

		$row =  mysql_fetch_array($result);
	}

	// this is an important loop.  What it does is go thru all the fields in the incoming file and set the internal vars.
	// Internal vars not set here are either set in the loop above for existing records, or not set at all (null values)
	// the array values are handled separatly, although they will set variables in this loop, we won't use them.
	foreach( $filelayout as $key => $value ){
		$$key = $items[ $value ];
	}

        // so how to handle these?  we shouldn't built the array unless it's been giving to us.
	// The assumption is that if you give us names and descriptions, then you give us name and description for all applicable languages
	foreach ($langcode as $lang){
		//echo "Langid is " . $lang['id'] . "<br>";
		$l_id = $lang['id'];
		if (isset($filelayout['v_products_name_' . $l_id ])){
			//we set dynamically the language values
			$v_products_name[$l_id] 	= $items[$filelayout['v_products_name_' . $l_id]];
			$v_products_description[$l_id] 	= $items[$filelayout['v_products_description_' . $l_id ]];
			$v_products_url[$l_id] 		= $items[$filelayout['v_products_url_' . $l_id ]];
			// support for Linda's Header Controller 2.0 here
			if(isset($filelayout['v_products_head_title_tag_' . $l_id])){
				$v_products_head_title_tag[$l_id] 	= $items[$filelayout['v_products_head_title_tag_' . $l_id]];
				$v_products_head_desc_tag[$l_id] 	= $items[$filelayout['v_products_head_desc_tag_' . $l_id]];
				$v_products_head_keywords_tag[$l_id] 	= $items[$filelayout['v_products_head_keywords_tag_' . $l_id]];
			}
			// end support for Header Controller 2.0
		}
	}
	//elari... we get the tax_clas_id from the tax_title
	//on screen will still be displayed the tax_class_title instead of the id....
	if ( isset( $v_tax_class_title) ){
		$v_tax_class_id          = zen_get_tax_title_class_id($v_tax_class_title);
	}
	//we check the tax rate of this tax_class_id
        $row_tax_multiplier = zen_get_tax_class_rate($v_tax_class_id);

	//And we recalculate price without the included tax...
	//Since it seems display is made before, the displayed price will still include tax
	//This is same problem for the tax_clas_id that display tax_class_title
	if ($price_with_tax){
		$v_products_price        = round( $v_products_price / (1 + ( $row_tax_multiplier * $price_with_tax/100) ), 4);
	}

	// if they give us one category, they give us all 6 categories
	unset ($v_categories_name); // default to not set.
	if ( isset( $filelayout['v_categories_name_1'] ) ){
		$newlevel = 1;
		for( $categorylevel=6; $categorylevel>0; $categorylevel--){
			if ( $items[$filelayout['v_categories_name_' . $categorylevel]] != ''){
				$v_categories_name[$newlevel++] = $items[$filelayout['v_categories_name_' . $categorylevel]];
			}
		}
		while( $newlevel < $max_categories+1){
			$v_categories_name[$newlevel++] = ''; // default the remaining items to nothing
		}
	}

	if (ltrim(rtrim($v_products_quantity)) == '') {
		$v_products_quantity = 1;
	}
	if ($v_date_avail == '') {
//		$v_date_avail = "CURRENT_TIMESTAMP";
		$v_date_avail = "NULL";
	} else {
		// we put the quotes around it here because we can't put them into the query, because sometimes
		//   we will use the "current_timestamp", which can't have quotes around it.
		$v_date_avail = '"' . $v_date_avail . '"';
	}

	if ($v_date_added == '') {
		$v_date_added = "CURRENT_TIMESTAMP";
	} else {
		// we put the quotes around it here because we can't put them into the query, because sometimes
		//   we will use the "current_timestamp", which can't have quotes around it.
		$v_date_added = '"' . $v_date_added . '"';
	}


	// default the stock if they spec'd it or if it's blank
	$v_db_status = '1'; // default to active
	if ($v_status == $inactive){
		// they told us to deactivate this item
		$v_db_status = '0';
	}
	if ($zero_qty_inactive && $v_products_quantity == 0) {
		// if they said that zero qty products should be deactivated, let's deactivate if the qty is zero
		$v_db_status = '0';
	}

	if ($v_manufacturer_id==''){
		$v_manufacturer_id="NULL";
	}

	if (trim($v_products_image)==''){
		$v_products_image = $default_image_product;
	}

	if (strlen($v_products_model) > $modelsize ){
		echo "<font color='red'>" . strlen($v_products_model) . $v_products_model . EASY_ERROR_2 . "</font>";
		die();
	}

	// OK, we need to convert the manufacturer's name into id's for the database
	if ( isset($v_manufacturers_name) && $v_manufacturers_name != '' ){
		$sql = "SELECT man.manufacturers_id
			FROM ".TABLE_MANUFACTURERS." as man
			WHERE
				man.manufacturers_name = '" . $v_manufacturers_name . "'";
		$result = mysql_query($sql);
		$row =  mysql_fetch_array($result);
		if ( $row != '' ){
			foreach( $row as $item ){
				$v_manufacturer_id = $item;
			}
		} else {
			// to add, we need to put stuff in categories and categories_description
			$sql = "SELECT MAX( manufacturers_id) max FROM ".TABLE_MANUFACTURERS;
			$result = mysql_query($sql);
			$row =  mysql_fetch_array($result);
			$max_mfg_id = $row['max']+1;
			// default the id if there are no manufacturers yet
			if (!is_numeric($max_mfg_id) ){
				$max_mfg_id=1;
			}

			// Uncomment this query if you have an older 2.2 codebase
			/*
			$sql = "INSERT INTO ".TABLE_MANUFACTURERS."(
				manufacturers_id,
				manufacturers_name,
				manufacturers_image
				) VALUES (
				$max_mfg_id,
				'$v_manufacturers_name',
				'$default_image_manufacturer'
				)";
			*/

			// Comment this query out if you have an older 2.2 codebase
			$sql = "INSERT INTO ".TABLE_MANUFACTURERS."(
				manufacturers_id,
				manufacturers_name,
				manufacturers_image,
				date_added,
				last_modified
				) VALUES (
				$max_mfg_id,
				'$v_manufacturers_name',
				'$default_image_manufacturer',
				CURRENT_TIMESTAMP,
				CURRENT_TIMESTAMP
				)";
			$result = mysql_query($sql);
			$v_manufacturer_id = $max_mfg_id;
		}
	}
	// if the categories names are set then try to update them
	if ( isset($v_categories_name_1)){
		// start from the highest possible category and work our way down from the parent
		$v_categories_id = 0;
		$theparent_id = 0;
		for ( $categorylevel=$max_categories+1; $categorylevel>0; $categorylevel-- ){
			$thiscategoryname = $v_categories_name[$categorylevel];
			if ( $thiscategoryname != ''){
				// we found a category name in this field

				// now the subcategory
				$sql = "SELECT cat.categories_id
					FROM ".TABLE_CATEGORIES." as cat,
					     ".TABLE_CATEGORIES_DESCRIPTION." as des
					WHERE
						cat.categories_id = des.categories_id AND
						des.language_id = $epdlanguage_id AND
						cat.parent_id = " . $theparent_id . " AND
						des.categories_name = '" . $thiscategoryname . "'";
				$result = mysql_query($sql);
				$row =  mysql_fetch_array($result);
				if ( $row != '' ){
					foreach( $row as $item ){
						$thiscategoryid = $item;
					}
				} else {
					// to add, we need to put stuff in categories and categories_description
					$sql = "SELECT MAX( categories_id) max FROM ".TABLE_CATEGORIES;
					$result = mysql_query($sql);
					$row =  mysql_fetch_array($result);
					$max_category_id = $row['max']+1;
					if (!is_numeric($max_category_id) ){
						$max_category_id=1;
					}
					$sql = "INSERT INTO ".TABLE_CATEGORIES."(
						categories_id,
						categories_image,
						parent_id,
						sort_order,
						date_added,
						last_modified
						) VALUES (
						$max_category_id,
						'$default_image_category',
						$theparent_id,
						0,
						CURRENT_TIMESTAMP
						,CURRENT_TIMESTAMP
						)";
					$result = mysql_query($sql);
					$sql = "INSERT INTO ".TABLE_CATEGORIES_DESCRIPTION."(
							categories_id,
							language_id,
							categories_name
						) VALUES (
							$max_category_id,
							'$epdlanguage_id',
							'$thiscategoryname'
						)";
					$result = mysql_query($sql);
					$thiscategoryid = $max_category_id;
				}
				// the current catid is the next level's parent
				$theparent_id = $thiscategoryid;
				$v_categories_id = $thiscategoryid; // keep setting this, we need the lowest level category ID later
			}
		}
	}

	if ($v_products_model != "") {
		//   products_model exists!
		//Datensatz Counter
		global $dcount;
		$dcount= $dcount + 1;
		echo $dcount;

		array_walk($items, 'print_el');

	    // First we check to see if this is a product in the current db.
		$result = mysql_query("SELECT products_id FROM ".TABLE_PRODUCTS." WHERE (products_model = '". $v_products_model . "')");

		if (mysql_num_rows($result) == 0)  {
			//   insert into products

			$sql = "SHOW TABLE STATUS LIKE '".TABLE_PRODUCTS."'";
			$result = mysql_query($sql);
			$row =  mysql_fetch_array($result);
			$max_product_id = $row['Auto_increment'];
			if (!is_numeric($max_product_id) ){
				$max_product_id=1;
			}
			$v_products_id = $max_product_id;
			echo "<font color='green'> " . EASY_LABEL_NEW_PRODUCT . "</font><br>";

			$query = "INSERT INTO ".TABLE_PRODUCTS." (
					products_image,
					products_model,
					products_price,
					products_priced_by_attribute,
					products_status,
					products_last_modified,
					products_date_added,
					products_date_available,
					products_tax_class_id,
					products_weight,
					products_sort_order,
					products_quantity,
					manufacturers_id)
						VALUES (
							'$v_products_image',";

			// unmcomment these lines if you are running the image mods
			/*
				$query .=		. $v_products_mimage . '", "'
							. $v_products_bimage . '", "'
							. $v_products_subimage1 . '", "'
							. $v_products_bsubimage1 . '", "'
							. $v_products_subimage2 . '", "'
							. $v_products_bsubimage2 . '", "'
							. $v_products_subimage3 . '", "'
							. $v_products_bsubimage3 . '", "'
			*/

			$query .="				'$v_products_model',
								'$v_products_price',
								'$v_products_priced_by_attribute',
								'$v_db_status',
								CURRENT_TIMESTAMP,
								$v_date_added,
								$v_date_avail,
								'$v_tax_class_id',
								'$v_products_weight',
								'$v_products_sort_order',
								'$v_products_quantity',
								'$v_manufacturer_id')
							";
				$result = mysql_query($query);
		} else {
			// existing product, get the id from the query
			// and update the product data
			$row =  mysql_fetch_array($result);
			$v_products_id = $row['products_id'];
			echo "<font color='black'> ". EASY_LABEL_UPDATED ."</font><br>";
			$row =  mysql_fetch_array($result);
			$query = 'UPDATE '.TABLE_PRODUCTS.'
					SET
					products_price="'.$v_products_price.
					'" ,products_image="'.$v_products_image;

			// uncomment these lines if you are running the image mods
/*
				$query .=
					'" ,products_mimage="'.$v_products_mimage.
					'" ,products_bimage="'.$v_products_bimage.
					'" ,products_subimage1="'.$v_products_subimage1.
					'" ,products_bsubimage1="'.$v_products_bsubimage1.
					'" ,products_subimage2="'.$v_products_subimage2.
					'" ,products_bsubimage2="'.$v_products_bsubimage2.
					'" ,products_subimage3="'.$v_products_subimage3.
					'" ,products_bsubimage3="'.$v_products_bsubimage3;
*/

			$query .=
			        '", products_priced_by_attribute="'.$v_products_priced_by_attribute .
			        '", products_weight="'.$v_products_weight .
			        '", products_sort_order="'.$v_products_sort_order .
					'", products_tax_class_id="'.$v_tax_class_id .
					'", products_date_available= ' . $v_date_avail .
					', products_date_added= ' . $v_date_added .
					', products_last_modified=CURRENT_TIMESTAMP
					, products_quantity="' . $v_products_quantity .
					'" ,manufacturers_id=' . $v_manufacturer_id .
					' , products_status=' . $v_db_status . '
					WHERE
						(products_id = "'. $v_products_id . '")';

			$result = mysql_query($query);
		}

		// the following is common in both the updating an existing product and creating a new product
                if ( isset($v_products_name)){
			foreach( $v_products_name as $key => $name){
				if ($name!=''){
					$sql = "SELECT * FROM ".TABLE_PRODUCTS_DESCRIPTION." WHERE
							products_id = $v_products_id AND
							language_id = " . $key;
					$result = mysql_query($sql);
					if (mysql_num_rows($result) == 0) {
						// nope, this is a new product description
						$result = mysql_query($sql);
						$sql =
							"INSERT INTO ".TABLE_PRODUCTS_DESCRIPTION."
								(products_id,
								language_id,
								products_name,
								products_description,
								products_url)
								VALUES (
									'" . $v_products_id . "',
									" . $key . ",
									'". addslashes($name) . "',
									'". addslashes($v_products_description[$key]) . "',
									'". $v_products_url[$key] . "'
									)";
						// support for Linda's Header Controller 2.0
						if (isset($v_products_head_title_tag)){
							// override the sql if we're using Linda's contrib
							$sql =
								"INSERT INTO ".TABLE_PRODUCTS_DESCRIPTION."
									(products_id,
									language_id,
									products_name,
									products_description,
									products_url,
									products_head_title_tag,
									products_head_desc_tag,
									products_head_keywords_tag)
									VALUES (
										'" . $v_products_id . "',
										" . $key . ",
										'". addslashes($name) . "',
										'". addslashes($v_products_description[$key]) . "',
										'". $v_products_url[$key] . "',
										'". $v_products_head_title_tag[$key] . "',
										'". $v_products_head_desc_tag[$key] . "',
										'". $v_products_head_keywords_tag[$key] . "')";
						}
						// end support for Linda's Header Controller 2.0
						$result = mysql_query($sql);
					} else {
						// already in the description, let's just update it
						$sql =
							"UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET
								products_name='" . addslashes($name) . "',
								products_description='" . addslashes($v_products_description[$key]) . "',
								products_url='" . $v_products_url[$key] . "'
							WHERE
								products_id = '$v_products_id' AND
								language_id = '$key'";
						// support for Lindas Header Controller 2.0
						if (isset($v_products_head_title_tag)){
							// override the sql if we're using Linda's contrib
							$sql =
								"UPDATE ".TABLE_PRODUCTS_DESCRIPTION." SET
									products_name = '" . addslashes($name) . "',
									products_description = '" . addslashes($v_products_description[$key]) . "',
									products_url = '" . $v_products_url[$key] ."',
									products_head_title_tag = '" . $v_products_head_title_tag[$key] ."',
									products_head_desc_tag = '" . $v_products_head_desc_tag[$key] ."',
									products_head_keywords_tag = '" . $v_products_head_keywords_tag[$key] ."'
								WHERE
									products_id = '$v_products_id' AND
									language_id = '$key'";
						}
						// end support for Linda's Header Controller 2.0
						$result = mysql_query($sql);
					}
				}
			}
		}

		if (isset($v_categories_id)){
			//find out if this product is listed in the category given
			$result_incategory = mysql_query('SELECT
						'.TABLE_PRODUCTS_TO_CATEGORIES.'.products_id,
						'.TABLE_PRODUCTS_TO_CATEGORIES.'.categories_id
						FROM
							'.TABLE_PRODUCTS_TO_CATEGORIES.'
						WHERE
						'.TABLE_PRODUCTS_TO_CATEGORIES.'.products_id='.$v_products_id.' AND
						'.TABLE_PRODUCTS_TO_CATEGORIES.'.categories_id='.$v_categories_id);

			if (mysql_num_rows($result_incategory) == 0) {
				// nope, this is a new category for this product
				$res1 = mysql_query('INSERT INTO '.TABLE_PRODUCTS_TO_CATEGORIES.' (products_id, categories_id)
							VALUES ("' . $v_products_id . '", "' . $v_categories_id . '")');
			} else {
				// already in this category, nothing to do!
			}
		}

		// for the separate prices per customer (SPPC) module
		$ll=1;
		if (isset($v_customer_price_1)){

			if (($v_customer_group_id_1 == '') AND ($v_customer_price_1 != ''))  {
				echo "<font color='red'>" . EASY_ERROR_4 . "</font>";
				die();
			}
			// they spec'd some prices, so clear all existing entries
			$result = mysql_query('
						DELETE
						FROM
							'.TABLE_PRODUCTS_GROUPS.'
						WHERE
							products_id = ' . $v_products_id
						);
			// and insert the new record
			if ($v_customer_price_1 != ''){
				$result = mysql_query('
							INSERT INTO
								'.TABLE_PRODUCTS_GROUPS.'
							VALUES
							(
								' . $v_customer_group_id_1 . ',
								' . $v_customer_price_1 . ',
								' . $v_products_id . ',
								' . $v_products_price .'
								)'
							);
			}
			if ($v_customer_price_2 != ''){
				$result = mysql_query('
							INSERT INTO
								'.TABLE_PRODUCTS_GROUPS.'
							VALUES
							(
								' . $v_customer_group_id_2 . ',
								' . $v_customer_price_2 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}
			if ($v_customer_price_3 != ''){
				$result = mysql_query('
							INSERT INTO
								'.TABLE_PRODUCTS_GROUPS.'
							VALUES
							(
								' . $v_customer_group_id_3 . ',
								' . $v_customer_price_3 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}
			if ($v_customer_price_4 != ''){
				$result = mysql_query('
							INSERT INTO
								'.TABLE_PRODUCTS_GROUPS.'
							VALUES
							(
								' . $v_customer_group_id_4 . ',
								' . $v_customer_price_4 . ',
								' . $v_products_id . ',
								' . $v_products_price . '
								)'
							);
			}

		}
		// end: separate prices per customer (SPPC) module

		// VJ product attribs begin
		if (isset($v_attribute_options_id_1)){
			$attribute_rows = 1; // master row count

			$languages = zen_get_languages();

			// product options count
			$attribute_options_count = 1;
			$v_attribute_options_id_var = 'v_attribute_options_id_' . $attribute_options_count;

			while (isset($$v_attribute_options_id_var) && !empty($$v_attribute_options_id_var)) {
				// remove product attribute options linked to this product before proceeding further
				// this is useful for removing attributes linked to a product
				$attributes_clean_query = "delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "'";

				mysql_query($attributes_clean_query);

				$attribute_options_query = "select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$$v_attribute_options_id_var . "'";

				$attribute_options_values = mysql_query($attribute_options_query);

				// option table update begin
				if ($attribute_rows == 1) {
					// insert into options table if no option exists
					if (mysql_num_rows($attribute_options_values) <= 0) {
						for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
							$lid = $languages[$i]['id'];

						  $v_attribute_options_name_var = 'v_attribute_options_name_' . $attribute_options_count . '_' . $lid;

							if (isset($$v_attribute_options_name_var)) {
								$attribute_options_insert_query = "insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, language_id, products_options_name) values ('" . (int)$$v_attribute_options_id_var . "', '" . (int)$lid . "', '" . $$v_attribute_options_name_var . "')";

								$attribute_options_insert = mysql_query($attribute_options_insert_query);
							}
						}
					} else { // update options table, if options already exists
						for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
							$lid = $languages[$i]['id'];

							$v_attribute_options_name_var = 'v_attribute_options_name_' . $attribute_options_count . '_' . $lid;

							if (isset($$v_attribute_options_name_var)) {
								$attribute_options_update_lang_query = "select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$$v_attribute_options_id_var . "' and language_id ='" . (int)$lid . "'";

								$attribute_options_update_lang_values = mysql_query($attribute_options_update_lang_query);

								// if option name doesn't exist for particular language, insert value
								if (mysql_num_rows($attribute_options_update_lang_values) <= 0) {
									$attribute_options_lang_insert_query = "insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, language_id, products_options_name) values ('" . (int)$$v_attribute_options_id_var . "', '" . (int)$lid . "', '" . $$v_attribute_options_name_var . "')";

									$attribute_options_lang_insert = mysql_query($attribute_options_lang_insert_query);
								} else { // if option name exists for particular language, update table
									$attribute_options_update_query = "update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . $$v_attribute_options_name_var . "' where products_options_id ='" . (int)$$v_attribute_options_id_var . "' and language_id = '" . (int)$lid . "'";

									$attribute_options_update = mysql_query($attribute_options_update_query);
								}
							}
						}
					}
				}
				// option table update end

				// product option values count
				$attribute_values_count = 1;
				$v_attribute_values_id_var = 'v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count;

				while (isset($$v_attribute_values_id_var) && !empty($$v_attribute_values_id_var)) {
					$attribute_values_query = "select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$$v_attribute_values_id_var . "'";

					$attribute_values_values = mysql_query($attribute_values_query);

					// options_values table update begin
					if ($attribute_rows == 1) {
						// insert into options_values table if no option exists
						if (mysql_num_rows($attribute_values_values) <= 0) {
							for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
								$lid = $languages[$i]['id'];

								$v_attribute_values_name_var = 'v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $lid;

								if (isset($$v_attribute_values_name_var)) {
									$attribute_values_insert_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$$v_attribute_values_id_var . "', '" . (int)$lid . "', '" . $$v_attribute_values_name_var . "')";

									$attribute_values_insert = mysql_query($attribute_values_insert_query);
								}
							}


							// insert values to pov2po table
							$attribute_values_pov2po_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "')";

							$attribute_values_pov2po = mysql_query($attribute_values_pov2po_query);
						} else { // update options table, if options already exists
							for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
								$lid = $languages[$i]['id'];

								$v_attribute_values_name_var = 'v_attribute_values_name_' . $attribute_options_count . '_' . $attribute_values_count . '_' . $lid;

								if (isset($$v_attribute_values_name_var)) {
									$attribute_values_update_lang_query = "select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$$v_attribute_values_id_var . "' and language_id ='" . (int)$lid . "'";

									$attribute_values_update_lang_values = mysql_query($attribute_values_update_lang_query);

									// if options_values name doesn't exist for particular language, insert value
									if (mysql_num_rows($attribute_values_update_lang_values) <= 0) {
										$attribute_values_lang_insert_query = "insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$$v_attribute_values_id_var . "', '" . (int)$lid . "', '" . $$v_attribute_values_name_var . "')";

										$attribute_values_lang_insert = mysql_query($attribute_values_lang_insert_query);
									} else { // if options_values name exists for particular language, update table
										$attribute_values_update_query = "update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . $$v_attribute_values_name_var . "' where products_options_values_id ='" . (int)$$v_attribute_values_id_var . "' and language_id = '" . (int)$lid . "'";

										$attribute_values_update = mysql_query($attribute_values_update_query);
									}
								}
							}
						}
					}
					// options_values table update end

					// options_values price update begin
				  $v_attribute_values_price_var = 'v_attribute_values_price_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_values_price_var) && ($$v_attribute_values_price_var != '')) {
						$attribute_prices_query = "select options_values_price from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";

						$attribute_prices_values = mysql_query($attribute_prices_query);

						// options_values_prices table update begin
						// insert into options_values_prices table if no price exists
						if (mysql_num_rows($attribute_prices_values) <= 0) {
							$attribute_prices_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, options_values_price) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_values_price_var . "')";

							$attribute_prices_insert = mysql_query($attribute_prices_insert_query);
						} else { // update options table, if options already exists
							$attribute_prices_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set options_values_price = '" . $$v_attribute_values_price_var . "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";

							$attribute_prices_update = mysql_query($attribute_prices_update_query);
						}
					}
					// options_values price update end
					
					//BEGINN - attribute_price_prefix  --- price_prefix
 	
					$v_attribute_price_prefix_var = 'v_attribute_price_prefix_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_price_prefix_var) && ($$v_attribute_price_prefix_var != '')) {
						$attribute_price_prefix_query = "select price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";
						$attribute_price_prefix_values = mysql_query($attribute_price_prefix_query);
						
						// products_attributes_price_prefix table update begin
						// insert into attributes_values_default table if no default exists
						if (mysql_num_rows($attribute_price_prefix_values) <= 0) {
							$attribute_price_prefix_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, price_prefix) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_price_prefix_var . "')";
							$attribute_price_prefix_insert = mysql_query($attribute_price_prefix_insert_query);
						} else { // update options table, if options already exists
							$attribute_price_prefix_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set price_prefix = '" . $$v_attribute_price_prefix_var . "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";
							$attribute_price_prefix_update = mysql_query($attribute_price_prefix_update_query);
						}
					}
					// attribute_price_prefix update end

                    // options_values default update begin --- attributes_default 	
					$v_attribute_values_default_var = 'v_attribute_values_default_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_values_default_var) && ($$v_attribute_values_default_var != '')) {
						$attribute_default_query = "select attributes_default from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";
						$attribute_default_values = mysql_query($attribute_default_query);

						// attributes_default table update begin
						// insert into attributes_values_default table if no default exists
						if (mysql_num_rows($attribute_default_values) <= 0) {
							$attribute_default_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, attributes_default) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_values_default_var . "')";
							$attribute_default_insert = mysql_query($attribute_default_insert_query);
						} else { // update options table, if options already exists
							$attribute_default_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set attributes_default = '" . $$v_attribute_values_default_var . "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";
							$attribute_default_update = mysql_query($attribute_default_update_query);
						}
					}
					// options_values default update update end


				 // options_values weight update begin --- products_attributes_weight
				 //if ($flag_attributes_weight == true) {
					$v_attribute_values_weight_var = 'v_attribute_values_weight_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_values_weight_var) && ($$v_attribute_values_weight_var != '')) {
						$attribute_weight_query = "select products_attributes_weight from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";
						$attribute_weight_values = mysql_query($attribute_weight_query);

						// options_values_prices table update begin
						// insert into options_values_prices table if no price exists
						if (mysql_num_rows($attribute_weight_values) <= 0) {
							$attribute_weight_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, products_attributes_weight) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_values_weight_var . "')";
							$attribute_weight_insert = mysql_query($attribute_weight_insert_query);
						} else { // update options table, if options already exists
							$attribute_weight_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_attributes_weight = '" . $$v_attribute_values_weight_var .  "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";
							$attribute_weight_update = mysql_query($attribute_weight_update_query);
						}
					}
				 //}
				 // options_values weight update end
				 
				 //BEGINN - attribute_weight_prefix  --- products_attributes_weight_prefix
 	
					$v_attribute_weight_prefix_var = 'v_attribute_weight_prefix_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_weight_prefix_var) && ($$v_attribute_weight_prefix_var != '')) {
						$attribute_weight_prefix_query = "select products_attributes_weight_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";
						$attribute_weight_prefix_values = mysql_query($attribute_weight_prefix_query);
						
						// products_attributes_weight_prefix table update begin
						// insert into attributes_values_default table if no default exists
						if (mysql_num_rows($attribute_weight_prefix_values) <= 0) {
							$attribute_weight_prefix_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, products_attributes_weight_prefix) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_weight_prefix_var . "')";
							$attribute_weight_prefix_insert = mysql_query($attribute_weight_prefix_insert_query);
						} else { // update options table, if options already exists
							$attribute_weight_prefix_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_attributes_weight_prefix = '" . $$v_attribute_weight_prefix_var . "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";
							$attribute_weight_prefix_update = mysql_query($attribute_weight_prefix_update_query);
						}
					}
					// attribute_weight_prefix update end				 
				 
				 //BEGINN - attribute_sort_order  --- products_options_sort_order
				 
				 $v_attribute_sort_order_var = 'v_attribute_sort_order_' . $attribute_options_count . '_' . $attribute_values_count;

					if (isset($$v_attribute_sort_order_var) && ($$v_attribute_sort_order_var != '')) {
						$attribute_sort_order_query = "select products_options_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$v_products_id . "' and options_id ='" . (int)$$v_attribute_options_id_var . "' and options_values_id = '" . (int)$$v_attribute_values_id_var . "'";
						$attribute_sort_order_values = mysql_query($attribute_sort_order_query);

						// products_options_sort_order table update begin
						// insert into attributes_values_default table if no default exists
						if (mysql_num_rows($attribute_sort_order_values) <= 0) {
							$attribute_sort_order_insert_query = "insert into " . TABLE_PRODUCTS_ATTRIBUTES . " (products_id, options_id, options_values_id, products_options_sort_order) values ('" . (int)$v_products_id . "', '" . (int)$$v_attribute_options_id_var . "', '" . (int)$$v_attribute_values_id_var . "', '" . (float)$$v_attribute_sort_order_var . "')";
							$attribute_sort_order_insert = mysql_query($attribute_default_insert_query);
						} else { // update options table, if options already exists
							$attribute_sort_order_update_query = "update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_options_sort_order = '" . $$v_attribute_sort_order_var . "' where products_id = '" . (int)$v_products_id . "' and options_id = '" . (int)$$v_attribute_options_id_var . "' and options_values_id ='" . (int)$$v_attribute_values_id_var . "'";
							$attribute_sort_order_update = mysql_query($attribute_sort_order_update_query);
						}
					}
				 
				 //ENDE - attribute_sort_order




//////// attributes stock add start
		$v_attribute_values_stock_var = 'v_attribute_values_stock_' . $attribute_options_count . '_' . $attribute_values_count;

		if (isset($$v_attribute_values_stock_var) && ($$v_attribute_values_stock_var != '')) {

		$stock_attributes = $$v_attribute_options_id_var.'-'.$$v_attribute_values_id_var;

		$attribute_stock_query = mysql_query("select products_stock_quantity from " . TABLE_PRODUCTS_STOCK . " where products_id = '" . (int)$v_products_id . "' and products_stock_attributes ='" . $stock_attributes . "'");

		// insert into products_stock_quantity table if no stock exists
		if (mysql_num_rows($attribute_stock_query) <= 0) {
			$attribute_stock_insert_query =mysql_query("insert into " . TABLE_PRODUCTS_STOCK . " (products_id, products_stock_attributes, products_stock_quantity) values ('" . (int)$v_products_id . "', '" . $stock_attributes . "', '" . (int)$$v_attribute_values_stock_var . "')");

		} else { // update options table, if options already exists
			$attribute_stock_insert_query = mysql_query("update " . TABLE_PRODUCTS_STOCK. " set products_stock_quantity = '" . (int)$$v_attribute_values_stock_var . "' where products_id = '" . (int)$v_products_id . "' and products_stock_attributes = '" . $stock_attributes . "'");

			// turn on stock tracking on products_options table
		    $stock_tracking_query = mysql_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_track_stock = '1' where products_options_id = '" . (int)$$v_attribute_options_id_var . "'");

		}
	}
//////// attributes stock add end




					$attribute_values_count++;
					$v_attribute_values_id_var = 'v_attribute_values_id_' . $attribute_options_count . '_' . $attribute_values_count;
				}

				$attribute_options_count++;
				$v_attribute_options_id_var = 'v_attribute_options_id_' . $attribute_options_count;
			}

			$attribute_rows++;
		}
		// VJ product attribs end

	} else {
		// this record was missing the product_model
		array_walk($items, 'print_el');
		echo "<p class='smallText'>" . EASY_ERROR_3 ."<br>";
		echo "<br>";

	}

// end of row insertion code
}


require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
