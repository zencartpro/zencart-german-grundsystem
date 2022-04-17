<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: coupon_restrict.php 2022-04-17 16:02:16Z webchills $
 */

define('HEADING_TITLE','Aktionskupon - Artikel/Kategorien Einschränkungen');
define('HEADING_TITLE_CATEGORY','Kategorieneinschränkungen');
define('HEADING_TITLE_PRODUCT','Artikeleinschränkungen');

define('SUB_HEADING_COUPON_NAME', 'Einschränkungen für den Aktionskupon namens &quot;%1$s&quot; [%2$u].');  //-%1$s = coupon-name, %2$u = coupon_id
define('TABLE_HEADING_CATEGORY_ID', 'Kategorie ID');
define('TABLE_HEADING_CATEGORY_NAME', 'Kategoriename');
define('TABLE_HEADING_PRODUCT_NAME', 'Artikelname');
define('TABLE_HEADING_PRODUCT_ID', 'Artikel ID');
define('TABLE_HEADING_RESTRICT', 'Einschränkung');
define('TABLE_HEADING_RESTRICT_REMOVE', 'Entfernen');
define('IMAGE_REMOVE', 'Diese Einschränkung entfernen');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('MAX_DISPLAY_RESTRICT_ENTRIES', 20);
define('TEXT_ALL_PRODUCTS_ADD', 'Alle Artikel der Kategorie hinzufügen');
define('TEXT_ALL_PRODUCTS_REMOVE', 'Alle Artikel der Kategorie entfernen');
define('TEXT_INFO_ADD_DENY_ALL', '<strong>Bei der Auswahl von "Alle Artikel der Kategorie hinzufügen" werden nur Artikel hinzugefügt, für die noch keine Einschränkungen definiert wurden.<br>
                    Bei der Auswahl von "Alle Artikel der Kategorie entfernen" werden nur Artikel entfernt, die mit Erlaubt oder Nicht erlaubt gekennzeichnet wurden.</strong>');


define('ERROR_DISCOUNT_COUPON_DEFINED_CATEGORY', 'Kategorie nicht abgeschlossen');
define('ERROR_DISCOUNT_COUPON_DEFINED_PRODUCT', 'Artikel nicht abgeschlossen');
define('HEADER_MANUFACTURER_NAME', '<br> -- ODER -- <br>' . 'Hersteller: ');
define('TEXT_ALL_MANUFACTURERS_ADD', 'Alle Artikel des Herstellers hinzufügen');
define('TEXT_ALL_MANUFACTURERS_REMOVE', 'Alle Artikel des Herstellers entfernen');

define('TABLE_HEADING_STATUS', 'Status');

define('ERROR_RESET_CATEGORY_MANUFACTURER', 'Kategorie und Hersteller Filter zurückgesetzt. Verwenden Sie die Filter individuell.');

define('TEXT_PULLDOWN_ALLOW', 'Erlauben');
define('TEXT_PULLDOWN_DENY', 'Sperren');
define('TEXT_SUBMIT_CATEGORY_ADD', 'Hinzufügen');
define('TEXT_SUBMIT_PRODUCT_UPDATE', 'Aktualisieren');
define('TEXT_STATUS_TOGGLE', 'Umschalten');
define('TEXT_STATUS_TOGGLE_TITLE', 'Hier clicken um den Status der Einschränkung umzuschalten');
define('TEXT_ALLOWED', 'Artikel oder Kategorie ist erlaubt');
define('TEXT_DENIED', 'Artikel oder Kategorie ist nicht erlaubt');

define('TEXT_NO_CATEGORY_RESTRICTIONS', 'keine aktuellen Kategorie Einschränkungen');
define('TEXT_NO_PRODUCT_RESTRICTIONS', 'keine aktuellen Artikel Einschränkungen');
