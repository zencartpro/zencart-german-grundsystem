<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: invoice.php 627 2010-08-30 15:05:14Z webchills $
 */

//  $Id: invoice.php 627 2010-08-30 15:05:14Z webchills $
//

define('TABLE_HEADING_COMMENTS','Kommentare');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstellt am');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikel');
define('TABLE_HEADING_TAX','MwSt.');
define('TABLE_HEADING_TOTAL','Summe');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX','Preis (exkl. MwSt.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX','Preis (inkl. MwSt.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX','Summe (exkl. MwSt.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX','Summe (inkl. MwSt.)');
define('ENTRY_CUSTOMER', 'KUNDE:');
define('ENTRY_SOLD_TO','Verkauft an:');
define('ENTRY_SHIP_TO','Versendet an:');
define('ENTRY_PAYMENT_METHOD','Zahlungsarten:');
define('ENTRY_SUB_TOTAL','Zwischensumme:');
define('ENTRY_TAX','MwSt.:');
define('ENTRY_SHIPPING','Versandkosten:');
define('ENTRY_TOTAL','Endsumme:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_ORDER_ID', 'Rechnungsnummer: ');
define('TEXT_INFO_ATTRIBUTE_FREE', '  KOSTENLOS');
