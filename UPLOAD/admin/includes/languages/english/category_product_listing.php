<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: category_product_listing.php 2023-10-29 16:31:16Z webchills $
 */
define('HEADING_TITLE', 'Categories / Products');
define('HEADING_TITLE_GOTO', 'Go To:');

define('TABLE_HEADING_IMAGE','Image');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products');

define('TABLE_HEADING_QUANTITY', 'Quantity');

define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sort');

define('TEXT_PRODUCTS_STATUS_ON_OF', ' of ');
define('TEXT_PRODUCTS_STATUS_ACTIVE', ' active ');
define('TEXT_CATEGORIES', 'Categories:');
define('TEXT_PRODUCTS', 'Products:');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete Category');
define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Warning:</strong> Linked Products whose Master Categories ID are deleted will not price properly. You should first assure that when deleting a Category that contains Linked Products that you reset the Product(s) Master Categories ID to another Category before removing a Category');
define('TEXT_DELETE_WARNING_CHILDS','<b>WARNING:</b> There are %u subcategories still under this category!');
define('TEXT_DELETE_WARNING_PRODUCTS','<b>WARNING:</b> There are %u products still under this category!');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move Category');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE_PRODUCT', 'Move product<br><strong>ID#%1$u %2$s</strong><br>from current category<br><strong>ID#%3$u %4$s</strong><br>to:');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete Product/Links');
define('TEXT_DELETE_PRODUCT_INTRO', 'Delete this product\'s links to categories or delete the product completely.<br>For easier linking/unlinking of products to multiple categories, you may also use the <a href="index.php?cmd=' . FILENAME_PRODUCTS_TO_CATEGORIES . '&amp;products_filter=%u">Multiple Categories Link Manager</a>.<br><br><strong>Linked categories</strong> are pre-selected ready for deletion.<br>The <strong>Master Category</strong> (<span class="text-danger">highlighted</span>) is de-selected to prevent accidental deletion.<br><br>To delete a product completely, select ALL categories including the Master Category.');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move Product');
define('TEXT_MOVE_PRODUCTS_INTRO', 'Move this product from this category to the selected category.<br>If this current category is also the product\'s Master Category, that will also be updated to the selected category.<br>');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories: ');
define('TEXT_INFO_HEADING_COPY_TO', 'Copy To');
define('TEXT_INFO_CURRENT_PRODUCT', 'Current Product: ');
define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK','Link this product into another category as selected above');
define('TEXT_COPY_AS_DUPLICATE','Create a Duplicate product in the category selected above');
define('TEXT_COPY_METATAGS','Copy Metatags to Duplicate?');
define('TEXT_COPY_LINKED_CATEGORIES','Copy Linked Categories to Duplicate?');
define('TEXT_COPY_EDIT_DUPLICATE', 'Open Duplicate Product for editing');

define('TEXT_COPY_AS_DUPLICATE_ATTRIBUTES', 'Attributes copied from Product ID#%u to duplicate Product ID#%u');
define('TEXT_COPY_AS_DUPLICATE_METATAGS', 'Metatags for Language ID#%u copied from Product ID#%u to duplicate Product ID#%u');
define('TEXT_COPY_AS_DUPLICATE_CATEGORIES', 'Linked Category ID#%u copied from Product ID#%u to duplicate Product ID#%u');
define('TEXT_COPY_AS_DUPLICATE_DISCOUNTS', 'Discounts copied from Product ID#%u to duplicate Product ID#%u');
define('TEXT_DUPLICATE_IDENTIFIER', '[COPY]');
define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attributes Changes for Products ID# ');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attribute Features For:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads: ');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Delete <strong>ALL</strong> Product Attributes for:<br>');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Copy Attributes to another <strong>product</strong> from:<br>');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Copy Attributes to another <strong>category</strong> from:<br>');

define('TEXT_COPY_ATTRIBUTES', 'Copy Product Attributes to Duplicate?');

define('TEXT_COPY_DISCOUNTS_ONLY', 'Only used for Duplicate Products with Quantity Discounts ...');
define('TEXT_COPY_DISCOUNTS', 'Copy Product Quantity Discounts to Duplicate?');

define('TEXT_INFO_HEADING_STATUS_CATEGORY', 'Change Category Status for:');
define('TEXT_CATEGORIES_STATUS_INTRO', 'Change <strong>this</strong> category\'s status to: ');
define('TEXT_CATEGORIES_STATUS_OFF', 'Disabled');
define('TEXT_CATEGORIES_STATUS_ON', 'Enabled');
define('TEXT_PRODUCTS_STATUS_INFO', 'Change ALL included products status to:');
define('TEXT_PRODUCTS_STATUS_OFF', 'Disabled');
define('TEXT_PRODUCTS_STATUS_ON', 'Enabled');
define('TEXT_PRODUCTS_STATUS_NOCHANGE', 'Unchanged');
define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>WARNING ...</strong><br>Note: Disabling products (whether they are linked or master products) in a category will result in ALL instances of that product being disabled in ALL categories.');
define('TEXT_SUBCATEGORIES_STATUS_INFO', 'Change ALL subcategories status to:');
define('TEXT_SUBCATEGORIES_STATUS_OFF', 'Disabled');
define('TEXT_SUBCATEGORIES_STATUS_ON', 'Enabled');
define('TEXT_SUBCATEGORIES_STATUS_NOCHANGE', 'Unchanged');

define('WARNING_PRODUCTS_IN_TOP_INFO', 'WARNING: You have Products in the Top Level Category. This will cause pricing to not work properly in the Catalog. Products found: ');

define('TEXT_COPY_MEDIA_MANAGER', 'Copy media?');
define('SUCCESS_ATTRIBUTES_DELETED','Attributes successfully deleted');

define('TEXT_INFO_HEADING_CHANGE_PRICE', 'Change Net Price'); 
define('TEXT_CHANGE_PRICE_INTRO', 'Product: %s.');
define('TEXT_CHANGE_PRICE_LABEL', 'New Net Price:');
define('TEXT_SORT_CATEGORIES_NAME_DESC','Category Name (desc)');
define('TEXT_SORT_CATEGORIES_ID','Category ID');
define('TEXT_SORT_CATEGORIES_ID_DESC','Category ID (desc)');
define('TEXT_SORT_CATEGORIES_STATUS','Category Status (disabled)');
define('TEXT_SORT_CATEGORIES_STATUS_DESC','Category Status (enabled)');
define('TEXT_SORT_PRODUCTS_MODEL_DESC','Products Model (desc)');
define('TEXT_SORT_PRODUCTS_STATUS','Status (disabled), Name');
define('TEXT_SORT_PRODUCTS_STATUS_DESC','Status (enabled), Name');
define('TEXT_SORT_PRODUCTS_ID','Products ID');
define('TEXT_SORT_PRODUCTS_ID_DESC','Products ID (desc)');
define('TEXT_SORT_PRODUCTS_WEIGHT','Weight');
define('TEXT_HIDE_IMAGES', 'Hide Images');
define('TEXT_SHOW_IMAGES' , 'Show Images');
