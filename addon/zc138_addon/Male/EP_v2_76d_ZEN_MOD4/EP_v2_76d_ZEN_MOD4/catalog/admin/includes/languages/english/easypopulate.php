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
// $Id:easypopulate.php,v2.76d-Zen-Cart 1.2 7/13/2005 16:43:55 thegordo $
// modified by rpa-com

define('HEADING_TITLE', 'Easy Populate Configuration');
define('EASY_VERSION_A', 'Easy Populate Advance');
define('EASY_VERSION_B', 'Easy Populate Basic ');
define('EASY_DEFAULT_LANGUAGE', '  -  Default Language ');
define('EASY_UPLOAD_FILE', 'File uploaded. ');
define('EASY_UPLOAD_TEMP', 'Temporary filename: ');
define('EASY_UPLOAD_USER_FILE', 'User filename: ');
define('EASY_SIZE', 'Size: ');
define('EASY_FILENAME', 'Filename: ');
define('EASY_SPLIT_DOWN', 'You can download your split files your Store Root Directory under /temp/');
define('EASY_UPLOAD_EP_FILE', 'Upload EP File for Import');
define('EASY_SPLIT_EP_FILE', 'Upload and Split a EP File');

define('TEXT_IMPORT_TEMP', 'Import Data from file in %s');
define('TEXT_INSERT_INTO_DB', 'Insert into DB');
define('TEXT_SELECT_ONE', 'Select a EP File for Import');
define('TEXT_SPLIT_FILE', 'Select a EP File');
define('EASY_LABEL_CREATE', 'Create an export files');
define('EASY_LABEL_CREATE_SELECT', 'Select method to save export file');
define('EASY_LABEL_CREATE_SAVE', 'Save to temp file on server');
define('EASY_LABEL_SELECT_DOWN', 'Select fields to download');
define('EASY_LABEL_SORT', 'Select field for sort order');
define('EASY_LABEL_PRODUCT_RANGE', 'Limit by Products_ID(s)');
define('EASY_LABEL_LIMIT_CAT', 'Limit By Category');
define('EASY_LABEL_LIMIT_MAN', 'Limit By Manufacture');

define('TEXT_SELECT_DOWNLOAD1', 'Direkter Download');
define('TEXT_SELECT_DOWNLOAD2', 'Erstellen, dann Download');
define('TEXT_SELECT_DOWNLOAD3', 'Erstellen in temp-Verzeichnis');

define('EASY_LABEL_LIMIT_NUMBER', 'Limit number of products to Download');
define('TEXT_SPLIT_FILE', 'Split file');

define('EASY_LABEL_PRODUCT_AVAIL', 'Range Available: ');
define('EASY_LABEL_PRODUCT_TO', ' to ');
define('EASY_LABEL_PRODUCT_RECORDS', '    Total number of records: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'begin: ');
define('EASY_LABEL_PRODUCT_END', 'end: ');
define('EASY_LABEL_PRODUCT_START', 'Start File Creation ');

define('EASY_FILE_LOCATE', 'You can get your file in your Store Root Directory under ');
define('EASY_FILE_LOCATE_2', ' by clicking this Link and going to the file manager');
define('EASY_FILE_RETURN', ' You can return to EP by clicking this link.');
define('EASY_IMPORT_TEMP_DIR', 'Import from Temp Dir ');
define('EASY_LABEL_DOWNLOAD', 'Download');

define('EASY_LABEL_CUSTOM', 'Custom');
define('EASY_LABEL_PQ', 'Price/Qty');
define('EASY_LABEL_CATEGORIES', 'Categories');

define('EASY_EXPORT_INFO', ' file (model number is always included).');
define('EASY_EXPORT_FILTER', 'filter by: ');
define('EASY_EXPORT_CAT', '- category -');
define('EASY_EXPORT_MAN', '- manufacturer -');
define('EASY_EXPORT_STATUS', '- status -');
define('EASY_EXPORT_STATUS1', 'activ');
define('EASY_EXPORT_STATUS0', 'disabled');

define('EASY_LABEL_COMPLETE', 'Complete');
define('EASY_LABEL_TAB', 'tab-delimited .txt file to edit');
define('EASY_LABEL_MPQ', 'Model/Price/Qty');
define('EASY_LABEL_EP_MC', 'Model/Category');
define('EASY_LABEL_EP_FROGGLE', 'Froogle');
define('EASY_LABEL_EP_ATTRIB', 'Attributes');
define('EASY_LABEL_NONE', 'None');
define('EASY_LABEL_CATEGORY', '1st Category Name');
define('PULL_DOWN_MANUFACTURES', 'Manufactures');
define('EASY_LABEL_PRODUCT', 'Product ID Number');
define('EASY_LABEL_MANUFACTURE', 'Manufacture ID Number');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Download a EP or Froogle file');
define('EASY_LABEL_EP_MA', 'Model/Attributes');
//define('EASY_LABEL_EP_FR_TITLE', 'Create EP or Froogle Files in Temp Dir ');
//define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '!New Product!</font><br>');
define('EASY_LABEL_UPDATED', "!Updated!");
define('EASY_LABEL_DELETE_STATUS_1', "<font color='red'> !! Deleting product ");
define('EASY_LABEL_DELETE_STATUS_2', " from the database !!</font><br>");
define('EASY_LABEL_LINE_COUNT_1', 'Added ');
define('EASY_LABEL_LINE_COUNT_2', 'records and closing file... ');
define('EASY_LABEL_FILE_COUNT_1A', 'Creating FILE ');
//define('EASY_LABEL_FILE_COUNT_1B', 'Creating file EPB_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', 'Added ');
define('EASY_LABEL_FILE_CLOSE_2', ' records and closing file...');

//errormessages
define('EASY_ERROR_1', 'Strange but there is no default language to work... That may not happen, just in case... ');
define('EASY_ERROR_2', '... ERROR! - Too many characters in the model number.<br>
			25 is the maximum on a standard Zen-Cart install.<br>
			Your maximum product_model length is set to ');
define('EASY_ERROR_2A', ' <br>You can either shorten your model numbers or increase the size of the field in the database.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', '<p class=smallText>No products_id field in record. This line was not imported <br><br>');
define('EASY_ERROR_4', '<font color=red>ERROR - v_customer_group_id and v_customer_price must occur in pairs</font>');
define('EASY_ERROR_5', '</b><font color=red>ERROR - You are trying to use a file created with EP Advance, please try with Easy Populate Advance </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR - You are trying to use a file created with EP Basic, please try with Easy Populate basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advance </u></b></font>');

//Text
define('EASYPOPULATE_TEXT_UPLOAD', 'Upload EP File');
define('EASYPOPULATE_TEXT_SPLIT', 'Split EP File');
define('EASYPOPULATE_TEXT_IMPORT', 'Import from Temp Dir');
define('EASYPOPULATE_TEXT_DOWNLOAD', 'Download EP and Froogle Files');
define('EASYPOPULATE_TEXT_CREATE', 'Create EP and Froogle Files in Temp Dir');
define('EASYPOPULATE_TEXT_SELECT_ONE', 'Select a EP File for Import');

//Buttons
define('EASYPOPULATE_BUT_INSERT', 'Insert into db');
define('EASYPOPULATE_BUT_SPLIT', 'Split file');

//Attributes
define('EASYPOPULATE_ATTR_WITH', '(Attributes Included)');
define('EASYPOPULATE_ATTR_NOT', '(Attributes Not Included)');

//Links
define('EASYPOPULATE_LINK_DOWNLOAD', 'Download: ');
define('EASYPOPULATE_LINK_CREATE', 'Create: ');
define('EASYPOPULATE_LINK_EDIT', ' to edit');
define('EASYPOPULATE_LINK_TEMP', ' in temp dir');

define('EASYPOPULATE_LINK_FULL', '<b>Complete</b> tab-delimited .txt file to edit');
define('EASYPOPULATE_LINK_PRICEQTY', '<b>Model/Price/Qty</b> tab-delimited .txt file to edit');
define('EASYPOPULATE_LINK_CATEGORY', '<b>Model/Category</b> tab-delimited .txt file to edit');
define('EASYPOPULATE_LINK_FROGGLE', '<b>Froogle</b> tab-delimited .txt file');
define('EASYPOPULATE_LINK_ATTRIB', '<b>Model/Attributes</b> tab-delimited .txt file');

define('EASYPOPULATE_QUICK_LINKS', 'Quick Links');
define('EASYPOPULATE_CREATE_DOWNLOAD', 'Create then Download Files');
define('EASYPOPULATE_DOWNLOAD_INFO', 'Create entire file in server memory then stream download after completed.');

define('EASYPOPULATE_CREATE_FILES', 'Create Files in Temp Dir');
define('EASYPOPULATE_FILES_INFO', 'Create entire file in server memory then save to Temp Dir after completed.');

define('EASYPOPULATE_FILE_SPLITS_PREFIX', 'Split-');

define('EASYPOPULATE_DATACOUNT', ' Records imported!');

//Export
define('EASYPOPULATE_EXPORT_NAME', 'name');
define('EASYPOPULATE_EXPORT_DESCRIPTION', 'decription');
define('EASYPOPULATE_EXPORT_URL', 'url');
define('EASYPOPULATE_EXPORT_IMAGE', 'image');
define('EASYPOPULATE_EXPORT_CATEGORIES', 'Category');
define('EASYPOPULATE_EXPORT_MANUFACTURER', 'manufacturer');
define('EASYPOPULATE_EXPORT_SORT_ORDER', 'sort order');
define('EASYPOPULATE_EXPORT_PRICE', 'price');
define('EASYPOPULATE_EXPORT_QUANTITY', 'quantity');
define('EASYPOPULATE_EXPORT_WEIGHT', 'weight');
define('EASYPOPULATE_EXPORT_TAX_CLASS', 'tax class');
define('EASYPOPULATE_EXPORT_AVAILABLE', 'available');
define('EASYPOPULATE_EXPORT_DATE_ADDED', 'date added');
define('EASYPOPULATE_EXPORT_STATUS', 'status');
define('EASYPOPULATE_EXPORT_ATTRIBUTES', 'attributes');
define('EASYPOPULATE_EXPORT_ATTRIBUTES_WEIGHT', 'attributes weight');
define('EASYPOPULATE_EXPORT_ATTRIBUTES_SORT_ORDER', 'attributes sort order');

//SETTINGS
define('EASYPOPULATE_SETTINGS', 'Settings');
define('EASYPOPULATE_SET_TEMP_DIR', 'Temp Dir:');
define('EASYPOPULATE_SET_SPLIT_FILE', 'Split File on: ');
define('EASYPOPULATE_SET_RECORDS', ' records');
define('EASYPOPULATE_SET_MODEL_NUM_SIZE', 'Model Num Size: ');
define('EASYPOPULATE_SET_PRICE_TAX', 'Price with tax: ');
define('EASYPOPULATE_SET_REPLACE_QUOTES', 'Replace quotes: ');
define('EASYPOPULATE_SET_FIELD_SEPERATOR', 'Field seperator: ');
define('EASYPOPULATE_SET_EXCEL_SAFE', 'Excel safe output: ');
define('EASYPOPULATE_SET_PRESERVE', 'Preserve tab/cr/lf: ');
define('EASYPOPULATE_SET_CAT_DEPTH', 'Category depth: ');
define('EASYPOPULATE_SET_ATTRIBUTES', 'Enable attributes: ');
define('EASYPOPULATE_SET_FROGGLE', 'SEF Froogle URLS: ');
define('EASYPOPULATE_SET_INFO', 'Please see the manual in this contributions package for help in changing these settings.');

?>