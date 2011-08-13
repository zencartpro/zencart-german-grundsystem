<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// |  http://www.zen-cart.at/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: coupon_restrict.php 697 2010-12-22 10:28:42Z webchills $
//

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

define('TEXT_MANUFACTURER', 'Hersteller: ');
define('TEXT_CATEGORY', 'Kategorie: ');
define('ERROR_DISCOUNT_COUPON_DEFINED_CATEGORY', 'Kategorie nicht definiert');
define('ERROR_DISCOUNT_COUPON_DEFINED_PRODUCT', 'Artikel nicht definiert');
