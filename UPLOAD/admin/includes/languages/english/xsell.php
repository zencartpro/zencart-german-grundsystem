<?php
/**
 * Cross Sell Products
 * Zen Cart German Specific
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for Zen Cart 1.5.7+, lat9, December 2021
 */
define('CROSS_SELL_SUCCESS', 'Cross-sell items successfully updated for <em>%1$s [%2$u]</em>.');    //-%1$s (product's name), %2%u (product's id).
define('MAIN_CROSS_SELL_REMOVED', 'All cross-sell items successfully removed for <em>%s</em>.');  //-%s (product's name)
define('ERROR_NO_MAIN_PRODUCT', 'No main product selected; no cross-sell can be defined.');
define('ERROR_INVALID_MAIN_PRODUCT', 'Invalid main product (%u); no cross-sell can be defined.');
define('ERROR_MISSING_MAIN_PRODUCT', 'Missing main product to create/update cross-sells; returning to main display.');
define('ERROR_CROSS_SELL_EXISTS', 'The requested product is already a cross-sell for the selected main product.');

define('ERROR_MODEL_NO_EXIST', 'Model number (%s) does not exist; the multiple cross-sell request was not performed');
define('ERROR_MODEL_MULTIPLE_PRODUCTS', 'Model number (%s) is associated with multiple products; the multiple cross-sell request was not performed.');
define('ERROR_NO_MODELS', 'At least one model-number must be supplied for multiple cross-sells to be added.');
define('MULTI_XSELL_SUCCESS', '%u cross-sells were successfully added.');
define('NO_MULTI_XSELLS_CREATED', 'All products are already cross-sold!');

define('HEADING_TITLE', 'Cross-Sell Advanced II');
define('SUBHEADING_MAIN_ADD', 'Create New Cross-Sell Product');
define('SUBHEADING_MAIN_TITLE', 'Viewing Current Products with Cross-sells');


define('SUBHEADING_TITLE_NEW', 'Manage Cross-Sells for %s');        //-%s is filled in with the main product's name and ID
define('SUBHEADING_NEW_ADD', 'Add a Single Cross-Sell');
define('SUBHEADING_MULTI_ADD', 'Add Multiple Cross-Sells');
define('SUBHEADING_MANAGE_EXISTING', 'Manage Existing Cross-Sells');

define('TABLE_HEADING_PRODUCT_ID', 'Product Id');
define('TABLE_HEADING_PRODUCT_MODEL', 'Product Model');
define('TABLE_HEADING_PRODUCT_NAME', 'Product Name');
define('TABLE_HEADING_CURRENT_SELLS', 'Current Cross-Sells');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Product Image');
define('TABLE_HEADING_PRODUCT_PRICE', 'Product Price');
define('TABLE_HEADING_PRODUCT_SORT', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_REMOVE', 'Remove?');

define('TEXT_BUTTON_NEW', 'New');
define('TEXT_BOTH_WAYS', 'Cross-sell Both Ways?');

define('TEXT_MAIN_INSTRUCTIONS', 'Use the forms below to either create a new cross-sell product or to manage existing cross-sells.');
define('TEXT_EDIT_INSTRUCTIONS', 'Use the forms below to either add a new cross-sell to the selected product or to manage the selected product\'s existing cross-sells.');

define('TEXT_NO_CROSS_SELL_PRODUCTS', 'No cross-sells have been defined for the selected product.');
define('TEXT_NO_CROSS_SELLS', 'No cross-sell products have been defined.');

define('TEXT_JS_MAIN_DELETE_CONFIRM', 'Are you sure you want to remove the cross-sell(s) for the above product?');
