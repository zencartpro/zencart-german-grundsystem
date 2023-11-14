<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * $Id: featured.php 2023-11-14 20:49:16Z webchills $
 */

define('HEADING_TITLE', 'Featured Products');


define('TEXT_ADD_FEATURED_SELECT', 'Add Featured Product by Selection');
define('TEXT_ADD_FEATURED_PID', 'Add Featured Product by Product ID');
define('TEXT_SEARCH_FEATURED', 'Search current Featured Products');
define('TEXT_FEATURED_ACTIVE', 'Featured Product Active');
define('TEXT_FEATURED_INACTIVE', 'Featured Product Inactive');
define('TEXT_FEATURED_STATUS_BY_DATE', 'Status set by dates');

define('TEXT_FEATURED_PRODUCT', 'Product:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'Date Featured Active:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Date Featured Expires:');

define('TEXT_INFO_NEW_PRICE', 'Special Price:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Original Price:');
define('TEXT_INFO_DISPLAY_PRICE', 'Currently Displayed Price:');
define('TEXT_INFO_STATUS_CHANGED', 'Status Changed:');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Delete Featured');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this product as Featured?');

define('WARNING_FEATURED_PRE_ADD_PID_EMPTY', 'Warning: No Product ID was specified.');
define('WARNING_FEATURED_PRE_ADD_PID_DUPLICATE', 'Warning: Product ID#%u already is a Featured Product.');
define('WARNING_FEATURED_PRE_ADD_PID_NO_EXIST', 'Warning: Product ID#%u does not exist.');


define('TEXT_INFO_HEADING_PRE_ADD_FEATURED', 'Add Featured Price by Product ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'You may add a Featured Price by Product ID. This method may be appropriate for shops with many products if the selection page takes too long to render or selecting a product from the dropdown becomes unwieldy.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Enter the Product ID: ');

define('ERROR_INVALID_ACTIVE_DATE', 'The &quot;Active&quot; date is not valid, please re-enter.');
define('ERROR_INVALID_EXPIRES_DATE' , 'The &quot;Expires&quot; date is not valid, please re-enter.');