<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: store_manager.php 2023-10-28 16:59:50Z webchills $
 */

  define('HEADING_TITLE', 'Store Manager');


  define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', '<strong>Successful</strong> update for Attributes Sort Order');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>Successful</strong> update for Products Price Sorter Values');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>Successful</strong> reset of Products Viewed to 0');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>Successful</strong> reset of Products Ordered to 0');
  define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>Successful</strong> reset of all Master Categories for Linked Products');
  define('SUCCESS_UPDATE_COUNTER', '<strong>Successful</strong> Counter Updated to: ');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Error:</strong> No matching Configuration Keys were found ...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Error:</strong> No Configuration Key or Text was entered to search for ... Search was terminated');

  define('TEXT_INFO_COUNTER_UPDATE', '<strong>Update Hit Counter</strong><br>to a new value: ');
  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Update ALL Products Price Sorter</strong><br>to be able to sort by displayed prices: ');
  define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Reset ALL Products Viewed</strong><br>Reset Product Viewed Counts to 0: ');
  define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>Reset ALL Products Ordered</strong><br>Reset Product Ordered Counts to 0: ');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Reset ALL Products Master Categories ID</strong><br>to be used for Linked Products and Pricing: ');

  define('TEXT_NEW_ORDERS_ID', 'New Order ID');
  define('TEXT_INFO_SET_NEXT_ORDER_NUMBER', '<strong>Set next order number</strong><br>NOTE: You cannot set the order number to a value lower than any existing order already in the database.');
  define('TEXT_MSG_NEXT_ORDER', 'The next order number has been set to %s');
  define('TEXT_MSG_NEXT_ORDER_MAX', 'Due to existing order data, the next order number is currently: %s');
  define('TEXT_MSG_NEXT_ORDER_TOO_LARGE', 'Due to database limitations, you cannot set the next order number higher than 2000000000. Please choose a lower value.');

  

  


  define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Optimize Database</strong> to remove wasted space from deleted records.<br>May be optionally run monthly or weekly on a busy database.<br>(Best to run during non-busy times.)');
  define('TEXT_INFO_OPTIMIZING_DATABASE_TABLES', 'Database table optimization in progress. This may take a few minutes. Please wait. The previous menu will re-appear when finished ... ');
  define('SUCCESS_DB_OPTIMIZE', 'Database Optimization - Tables Processed: ');

  define('TEXT_INFO_PURGE_DEBUG_LOG_FILES', '<strong>Cleanup Debug Log Files</strong><br><strong>CAUTION: </strong>Zen Cart records PHP error messages for debugging purposes, and many payment modules can be set to log debug data to diagnose communication problems. <br>Clicking this purge option will *permanently* remove *ALL* debug logs associated with PHP errors and payment modules from the /logs/ folder.');
  define('SUCCESS_CLEAN_DEBUG_FILES', 'Debug Log Files Purged');
