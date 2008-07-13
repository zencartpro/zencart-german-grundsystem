<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: invoice.php,v 1.1.8.5 2004/07/10 03:31:34 ajeh Exp $
//

define('TABLE_HEADING_COMMENTS','Kommentare');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikel');
define('TABLE_HEADING_TAX','MwSt');
define('TABLE_HEADING_TOTAL','Summe');
define('TABLE_HEADING_EXTRA','Extra');
define('TABLE_HEADING_QTY','Menge');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX','Einzelpreis (Netto)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX','Einzelpreis (Brutto)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX','Summe (Netto)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX','Summe (Brutto)');

define('ENTRY_CUSTOMER', 'KUNDE:');

define('ENTRY_SOLD_TO','Verkauft an:');
define('ENTRY_SHIP_TO','Versendet an:');
define('ENTRY_PAYMENT_METHOD','Zahlungsart:');
define('ENTRY_SUB_TOTAL','Zwischensumme:');
define('ENTRY_TAX','MwSt.:');
define('ENTRY_SHIPPING','Versandkosten:');
define('ENTRY_TOTAL','Endsumme:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');

define('ENTRY_ORDER_ID', 'Rechnungs-Nr');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;FREI');
?>
