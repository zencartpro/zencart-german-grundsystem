<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: options_values_manager.php 2023-10-28 16:49:16Z webchills $
 */


define('HEADING_TITLE_ATRIB', 'Products Attributes');


define('TABLE_HEADING_DOWNLOAD', 'Downloadable products:');
define('TABLE_TEXT_FILENAME', 'Filename:');
define('TABLE_TEXT_MAX_DAYS', 'Expiry days:');
define('TABLE_TEXT_MAX_COUNT', 'Maximum download count:');

define('TEXT_WARNING_OF_DELETE', '<span class="alert">This option has products and values linked to it - it is not safe to delete it.<br>NOTE: Any associated Download files for this Option Value will not be removed from the server.</span>');
define('TEXT_OK_TO_DELETE', 'This option has no products and values linked to it - it is safe to delete it.');



define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE_SPECIFIC','Possible Duplicate Options Value Added: "<b>%1$s</b>" %2$s for option name "%3$s" (values ids: %4$s)'); 


define('TEXT_DOWNLOADS_DISABLED','NOTE: Downloads are disabled');

define('TABLE_TEXT_MAX_DAYS_SHORT', 'Days:');
define('TABLE_TEXT_MAX_COUNT_SHORT', 'Max:');


  define('TEXT_SORT',' Order: ');


  define('TEXT_OPTION_VALUE_COMMENTS','Comments: ');
  define('TEXT_OPTION_VALUE_SIZE','Display Size: ');
  define('TEXT_OPTION_VALUE_MAX','Maximum length: ');

  define('TEXT_ATTRIBUTES_IMAGE','Attributes Image Swatch:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','Attributes Image Directory:');

  define('TEXT_ATTRIBUTES_FLAGS','Attribute<br>Flags:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Used For<br>Display Purposes Only:');
  define('TEXT_ATTRIBUTES_IS_FREE', 'Attribute is Free<br>When Product is Free:');
  define('TEXT_ATTRIBUTES_DEFAULT', 'Default Attribute<br>to be Marked Selected:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Apply Same Discounts<br>Used by Product:');


  define('TEXT_PRODUCT_OPTIONS_INFO','Edit Product Options for additional settings');


  define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>Copy to ALL Products where Option Name and Value ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Select an Option Name and Value that currently exists on a product or products that you then want to copy another Option Name and Value to for all products with this existing Option Name and Value');
  define('TEXT_SELECT_OPTION_FROM', 'Option Name to match:');
  define('TEXT_SELECT_OPTION_VALUES_FROM', 'Option Value to match:');
  define('TEXT_SELECT_OPTION_TO', 'Option Name to add:');
  define('TEXT_SELECT_OPTION_VALUES_TO', 'Option Value to add:');
  define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', 'Leave blank for ALL Products or<br>enter a Category ID for Products to update');


  define('TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>Copy Option Name/Value to Products with existing Option Name ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', 'Select an Option Name and Value that currently exists on a product or products to add to all products or to only the products in the selected category that have the selected Option Name.
                                                   <br><strong>Example:</strong> Add Option Name: Color Option Value: Red to all Products with Option Name: Size
                                                   <br><strong>Example:</strong> Add Option Name: Color Option Value: Green with default values from Products ID: 34 to all Products with Option Name: Size
                                                   <br><strong>Example:</strong> Add Option Name: Color Option Value: Green with default values from Products ID: 34 to all Products with Option Name: Size for Categories ID: 65
        ');
  define('TEXT_SELECT_OPTION_TO_ADD_TO', 'Option Name to add to:');
  define('TEXT_SELECT_OPTION_FROM_ADD', 'Option Name to add:');
  define('TEXT_SELECT_OPTION_VALUES_FROM_ADD', 'Option Value to add:');
  define('TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', 'Default New Attribute Values from Product ID# or leave blank for no default values:');


  define('TEXT_INFO_FROM', ' from: ');
  define('TEXT_INFO_TO', ' to: ');
  define('ERROR_OPTION_VALUES_COPIED', 'Error: Duplicate Option Name and Option Value');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH', 'Error: Mismatched Option Name and Option Value selected');
  define('ERROR_OPTION_VALUES_NONE', 'Error: Nothing found to copy');
  define('SUCCESS_OPTION_VALUES_COPIED', 'Successful copy! ');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', 'Error: Missing Option Name/Value for Products ID#');

  define('TEXT_OPTION_VALUE_DELETE_ALL', '<strong>Delete Matching Attribute from ALL Products where Option Name and Value ...</strong>');
  define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Select an Option Name and Value that currently exists on a product or products that you want deleted from ALL Products or from ALL Products within one Category');
  define('TEXT_SELECT_DELETE_OPTION_FROM', 'Option Name to match:');
  define('TEXT_SELECT_DELETE_OPTION_VALUES_FROM', 'Option Value to match:');

  define('ERROR_OPTION_VALUES_DELETE_MISMATCH', 'Error: Mismatched Option Name and Option Value selected');

  define('SUCCESS_OPTION_VALUES_DELETE', 'Successful: Deletion of: ');
  define('LABEL_FILTER', 'Select Option Name to filter Values');
  define('TEXT_DISPLAY_NUMBER_OF_OPTION_VALUES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Option Values)');
  define('TEXT_SHOW_ALL', 'Show All');
