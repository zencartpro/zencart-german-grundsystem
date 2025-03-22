<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: specials.php 2023-11-14 20:33:16Z webchills $
 */

define('HEADING_TITLE', 'Specials');

define('TEXT_ADD_SPECIAL_SELECT', 'Add Special by Selection');
define('TEXT_ADD_SPECIAL_PID', 'Add Special by Product ID');
define('TEXT_SEARCH_SPECIALS', 'Search current Specials');
define('TEXT_SPECIAL_ACTIVE', 'Special Price Active');
define('TEXT_SPECIAL_INACTIVE', 'Special Price Inactive');
define('TEXT_SPECIAL_STATUS_BY_DATE', 'Status set by dates');

define('TEXT_SPECIALS_PRODUCT', 'Product:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Special Price:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Date Special Active:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Date Special Expires:');

define('TEXT_INFO_NEW_PRICE', 'Special Price:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Original Price:');
define('TEXT_INFO_DISPLAY_PRICE', 'Currently Displayed Price:');
define('TEXT_INFO_STATUS_CHANGED', 'Status Changed:');

define('TEXT_INFO_HEADING_DELETE_SPECIALS', 'Delete Special');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete the Special Price for this product?');

define('WARNING_SPECIALS_PRE_ADD_PID_EMPTY', 'Warning: No Product ID was specified.');
define('WARNING_SPECIALS_PRE_ADD_PID_DUPLICATE', 'Warning: Product ID#%u already on Special.');
define('WARNING_SPECIALS_PRE_ADD_PID_NO_EXIST', 'Warning: Product ID#%u does not exist.');
define('WARNING_SPECIALS_PRE_ADD_PID_GIFT', 'Warning: Product ID#%u is a Gift Certificate.');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Add Special Price by Product ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'You may add a Special Price by Product ID. This method may be appropriate for shops with many products if the selection page takes too long to render or selecting a product from the dropdown becomes unwieldy.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Enter the Product ID: ');
define('TEXT_SPECIALS_PRICE_NOTES_HEAD' , '<b>Notes:</b>');
define('TEXT_SPECIALS_PRICE_NOTES_BODY', '<li>Special Price may be a price (ex-tax). The decimal separator must be a "." (decimal-point), eg: <b>49.99</b>. The calculated percentage discount is shown next to the product\'s new price in the catalog.</li><li>Special Price may be a percentage discount, eg: <b>20%</b>.</li><li>Start/End dates are not obligatory. You may leave the expiry date empty for no expiration.</li><li>When dates are set, the status of the Special Price is automatically enabled/disabled accordingly.</li>');
define('ERROR_INVALID_ACTIVE_DATE' , 'The &quot;Active&quot; date is not valid, please re-enter.');
define('ERROR_INVALID_EXPIRES_DATE' , 'The &quot;Expires&quot; date is not valid, please re-enter.');