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
//  $Id: rl_invoice3.php 580 2010-05-04 12:35:53Z hugo13 $
//
// added by STEVE
define('RL_INVOICE3_FILE_MISSING', 'ERROR - Unable to find file.<br />
Please contact us directly to report this error.
<br />
Thank You<br />
<c/f: ');

define('TABLE_HEADING_COMMENTS','Kommentare');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikel');
define('TABLE_HEADING_TAX3','UST');
define('TABLE_HEADING_TOTAL','Summe');
define('TABLE_HEADING_EXTRA','Extra');
define('TABLE_HEADING_QTY','Menge');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX','Einzelpreis (exkl. UST)');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX_AMAZON','Preis(netto)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX','Einzelpreis');

define('TABLE_HEADING_TOTAL_EXCLUDING_TAX','Summe (exkl. UST)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX_AMAZON','Gesamt(netto)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX','Summe');


define('ENTRY_CUSTOMER', 'KUNDE:');

define('ENTRY_SOLD_TO','Verkauft an:');
define('ENTRY_SHIP_TO','Versendet an:');
define('ENTRY_PAYMENT_METHOD','Zahlungsarten:');
define('ENTRY_SUB_TOTAL','Zwischensumme:');
define('ENTRY_TAX','UST.:');
define('ENTRY_SHIPPING','Versandkosten:');
define('ENTRY_TOTAL','Endsumme:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_NAME', 'Name:');
define('ENTRY_EMAIL_ADDRESS','Email:');

define('ENTRY_ORDER_ID', 'Rechnungsnummer');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;KOSTENLOS');

define('LIEFERADRESSE', 'Lieferadresse');
define('RECHNUNGSADRESSE', 'Rechnungsadresse');

define('RL_INVOICE3_INVLINK_PRE', 'hugo13_');
define('RL_INVOICE3_INVLINK', 'rechnung.pdf');
define('RL_INVOICE3_INVLINK_TEXT', 'Herunterladen:');

define('RL_INVOICE3_SUBTOTAL', 'Zwischensumme: ');
define('RL_INVOICE3_BALANCE', 'Übertrag: ');
define('RL_INVOICE3_PAYMENT_METHOD','Zahlungsart:');
//added by Steve
define('RL_INVOICE3_SHIPPING_METHOD','Versandart:');
define('RL_INVOICE3_ENTRY_DATE_INVOICE','Rechnungsdatum:');