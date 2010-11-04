<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id:  
 */
   // added for QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN updates
  define('QUICKUPDATES_MODIFY_PURCHASE_AND_MARGIN', 'false');
 
  define('QUICKUPDATES_DISPLAY_ID_INFO', '<a target="_blank" href="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'index.php?main_page=product_info&products_id=%1$s">' . '%3$s' . '</a>');
  
  // (Some of)the definitions below may (or should?) be moved to the quick_updates admin
  define('QUICKUPDATES_COPY_PRODUCT_ID_DEFAULT', 1);
  define('QUICKUPDATES_DISPLAY_THUMBNAIL_WIDTH', '30');
  define('QUICKUPDATES_DISPLAY_THUMBNAIL_HEIGHT', '');
  
  // change to 'true' to enable wholesale price updates
  define('QUICKUPDATES_MODIFY_WHOLESALE_PRICE', 'false');
  // 
  define('QUICKUPDATES_MODIFY_WHOLESALE_PRICE_INPUT_SIZE', '6');

  // added for QUICKUPDATES_NEW_COLUMN_1
  // look in admin/quick_updates.php for "added for QUICKUPDATES_NEW_COLUMN_1" to see what has been added, to make quick_updates support this extra column.
  // (In my case I added "products_artlid" because I wanted to store the article id's from my main supplier into my database)
  // Enable/disable the new column
  define('QUICKUPDATES_MODIFY_NEW_COLUMN_1', 'false');
  // The name of the column you added to your database products table
  // (note: all other columns are not defined but hard coded, so this is the only "easy user configurable" column)
  define('QUICKUPDATES_NEW_COLUMN_1', 'products_artlid');
  // The table heading text for this extra column (actually belongs in the language file)
  define('TABLE_HEADING_NEW_COLUMN_1', 'artlid');
?>