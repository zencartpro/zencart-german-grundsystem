<?php
/**
 * 
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/ 
 * @version $Id$
 */

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

define('RL_INVOICE3_ORDERINVOICE', 'AUFTRAGSBESTÄTIGUNG UND RECHNUNG:');
define('RL_INVOICE3_INVOICEDATE', 'Rechnungsdatum:');
define('RL_INVOICE3_CITY2', 'Wien, ');
define('RL_INVOICE3_CONTACT', 'Kontakt:');
define('RL_INVOICE3_TEL', 'Telefon:');
define('RL_INVOICE3_MAIL', 'E-Mail:');
define('RL_INVOICE3_ORDERFROM', 'Ihre Bestellung vom:');
define('RL_INVOICE3_ORDERID', 'Bestellnummer:');
define('RL_INVOICE3_BUYER', 'Besteller:');
define('RL_INVOICE3_CUSTOMERNO', 'Kundennummer:');
define('RL_INVOICE3_THEEND', 'wir wünschen ihnen viel spass mit unseren produkten & hoffen, sie bald wieder im shop begrüssen zu dürfen');

