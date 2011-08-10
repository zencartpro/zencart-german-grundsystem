<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: packingslip.php 302 2008-05-30 19:49:12Z maleborg $
//

define('TABLE_HEADING_COMMENTS','Kommentare');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstellt am');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikel');
define('ENTRY_CUSTOMER', 'KUNDE:');
define('ENTRY_SOLD_TO','Verkauft an:');
define('ENTRY_SHIP_TO','Versand an:');
define('ENTRY_PAYMENT_METHOD','Zahlungsart:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_ORDER_ID','Rechnungsnummer');
