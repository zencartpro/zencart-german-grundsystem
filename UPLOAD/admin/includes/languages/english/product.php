<?php 
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)

 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: product.php 2023-10-30 15:17:16Z webchills $
 */


define('TEXT_PRODUCTS_STATUS', 'Products Status:');
define('TEXT_PRODUCTS_VIRTUAL', 'Product is Virtual:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Always Free Shipping:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Products Quantity Box Shows:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date Available:');

define('TEXT_PRODUCT_IS_VIRTUAL', 'Yes, Skip Shipping Address');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'No, Shipping Address Required');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Yes, Always Free Shipping');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'No, Normal Shipping Rules');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Special, Product/Download Combo Requires a Shipping Address');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Yes, Show Quantity Box');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'No, Do not show Quantity Box');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Warning: Does not show Quantity Box, Default to Qty 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Warning: Does not show Quantity Box, Default to Qty 1');

define('TEXT_PRODUCTS_MANUFACTURER', 'Products Manufacturer:');
define('TEXT_PRODUCTS_NAME', 'Products Name:');
define('TEXT_PRODUCTS_MERKMALE', 'Merkmale für Buttonlösung:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Products Description:');
define('TEXT_PRODUCTS_QUANTITY', 'Products Quantity:');

define('TEXT_PRODUCTS_IMAGE', 'Product Image:');
define('TEXT_EDIT_PRODUCTS_IMAGE', 'Edit Product Image:');

define('TEXT_PRODUCTS_URL', 'Products URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Products Price (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Products Price (Gross):');
define('TEXT_PRODUCTS_WEIGHT', 'Products Shipping Weight:');

define('TEXT_PRODUCT_IS_FREE', 'Product is Free:');
define('TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Product is marked as FREE');
define('TEXT_PRODUCTS_IS_FREE_EDIT', '*Product is marked as FREE');

define('TEXT_PRODUCT_IS_CALL', 'Product is Call for Price:');
define('TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Product is marked as CALL FOR PRICE');
define('TEXT_PRODUCTS_IS_CALL_EDIT', '*Product is marked as CALL FOR PRICE');

define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Product Priced by Attributes:');

define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Display price will include lowest group attributes prices plus price');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Display price will include lowest group attributes prices plus price');

define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:');

define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Product Qty Minimum:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Product Qty Units:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Product Qty Maximum:');
define('TEXT_PRODUCTS_QTY_MIN_UNITS_PREVIEW', 'Warning: Minimum is less than Units');
define('TEXT_PRODUCTS_QTY_MIN_UNITS_MISMATCH_PREVIEW', 'Warning: Minimum is not a multiple of Units');

define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', '0 = Unlimited, 1 = No Qty Boxes');

define('TEXT_PRODUCTS_MIXED', 'Product Qty Min/Unit Mix:');

define('TEXT_PRODUCTS_SORT_ORDER', 'Sort Order:');

define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank">webpage</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.');


define('TEXT_META_TAG_TITLE_INCLUDES', '<strong>Select items to show in the page &lt;title&gt; tag (shown in this order):</strong><br><span class="alert">NOTE: If the Keywords and Description meta tag fields are both empty, all items (apart from the Title Additional Text) will be set to "yes". However, in this case the display of the Product Model and Product Price may be overriden (disabled) in Admin page Configuration->Product Info.</span>');
define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS', '<strong>Product Name:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS', '<strong>Title Additional Text:</strong><br>(defined below)');
define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS', '<strong>Product Model:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS', '<strong>Product Price:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS', '<strong>defined constant "SITE_TAGLINE":</strong>');
define('TEXT_META_TAGS_TITLE', '<strong>Title Additional Text:</strong><br><span class="alert">NOTE: Title Additional Text is not used if both Keywords and Description meta tag fields are empty.</span>');
define('TEXT_META_TAGS_KEYWORDS', '<strong>Keywords meta tag:</strong>');
define('TEXT_META_TAGS_DESCRIPTION', '<strong>Description meta tag:</strong>');
define('TEXT_META_EXCLUDED', '<span class="alert">EXCLUDED</span>');
define('TEXT_TITLE_PLUS_TAGLINE', 'Store Title+Tagline');

define('TEXT_PRODUCTS_PRICE_INFO', 'Price:');
define('WARNING_PRODUCT_DOES_NOT_EXIST' , 'Warning: Product ID#%u cannot be modified, it does not exist.');
