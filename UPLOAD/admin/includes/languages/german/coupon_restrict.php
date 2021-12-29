<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: coupon_restrict.php 2021-12-01 09:39:16Z webchills $
 */

define('HEADING_TITLE','Aktionskupon - Artikel/Kategorien Einschränkungen');
define('HEADING_TITLE_CATEGORY','Kategorieneinschränkungen');
define('HEADING_TITLE_PRODUCT','Artikeleinschränkungen');
define('HEADER_COUPON_ID','Aktionskupon ID');
define('HEADER_COUPON_NAME','Aktionskupon Name');
define('HEADER_CATEGORY_ID','Kategorie ID');
define('HEADER_CATEGORY_NAME','Kategorienname');
define('HEADER_PRODUCT_ID','Artikel ID');
define('HEADER_PRODUCT_NAME','Artikelname');
define('HEADER_RESTRICT_ALLOW','Erlauben');
define('HEADER_RESTRICT_DENY','Nicht erlauben');
define('HEADER_RESTRICT_REMOVE','Entfernen');
define('IMAGE_ALLOW','Erlauben');
define('IMAGE_DENY','Nicht erlauben');
define('IMAGE_REMOVE','Entfernen');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('MAX_DISPLAY_RESTRICT_ENTRIES', 20);
define('TEXT_ALL_PRODUCTS_ADD', 'Alle Artikel der Kategorie hinzufügen');
define('TEXT_ALL_PRODUCTS_REMOVE', 'Alle Artikel der Kategorie entfernen');
define('TEXT_INFO_ADD_DENY_ALL', '<strong>Bei der Auswahl von "Alle Artikel der Kategorie hinzufügen" werden nur Artikel hinzugefügt, für die noch keine Einschränkungen definiert wurden.<br />
                    Bei der Auswahl von "Alle Artikel der Kategorie entfernen" werden nur Artikel entfernt, die mit Erlaubt oder Nicht erlaubt gekennzeichnet wurden.</strong>');


define('ERROR_DISCOUNT_COUPON_DEFINED_CATEGORY', 'Kategorie nicht definiert');
define('ERROR_DISCOUNT_COUPON_DEFINED_PRODUCT', 'Artikel nicht definiert');
define('HEADER_MANUFACTURER_NAME', '<br> -- ODER -- <br>' . 'Hersteller: ');
define('TEXT_ALL_MANUFACTURERS_ADD', 'Alle Artikel des Herstellers hinzufügen');
define('TEXT_ALL_MANUFACTURERS_REMOVE', 'Alle Artikel des Herstellers entfernen');

define('TABLE_HEADING_STATUS', 'Status');

define('ERROR_RESET_CATEGORY_MANUFACTURER', 'Kategorie und Hersteller Filter zurückgesetzt. Verwenden Sie die Filter individuell.');

define('TEXT_PULLDOWN_ALLOW', 'Erlauben');
define('TEXT_PULLDOWN_DENY', 'Sperren');
define('TEXT_SUBMIT_CATEGORY_ADD', 'Hinzufügen');
define('TEXT_SUBMIT_PRODUCT_UPDATE', 'Aktualisieren');
define('TEXT_STATUS_TOGGLE', 'Toggle');
define('TEXT_STATUS_TOGGLE_TITLE', 'Click here to toggle the restriction\'s status');
define('TEXT_ALLOWED', 'Product or category is allowed');
define('TEXT_DENIED', 'Product or category is not allowed');

define('TEXT_NO_CATEGORY_RESTRICTIONS', 'No current category restrictions');
define('TEXT_NO_PRODUCT_RESTRICTIONS', 'No current product restrictions');
