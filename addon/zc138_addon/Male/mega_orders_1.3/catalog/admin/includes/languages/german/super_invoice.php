<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Replaces admin/invoice.php, adds     //
//  amount paid & balance due values based on           //
//  super_order class calculations.  Also includes the  //
//  option to display a tax exemption number,           //
//  configurable from the admin.                        //
//////////////////////////////////////////////////////////
// $Id: super_invoice.php 25 2006-02-03 18:55:56Z BlindSide $
*/

// Don't forget to configure the new Phone and Fax numbers in the Admin!
// Configuration > My Store > Store Phone/Store Fax

define('HEADER_INVOICE', 'Rechnung - Bestellung #');
define('HEADER_TAX_ID', 'Fed Tax ID #');
define('HEADER_PHONE', 'Telefon:');
define('HEADER_FAX', 'Fax:');
define('HEADER_CUSTOMER_NOTES', 'Bestellmitteilung:');
define('HEADER_PO_NUMBER', 'Bestellnummer:');
define('HEADER_PO_INVOICE_DATE', 'Rechnungsdatum:');
define('HEADER_PO_TERMS', 'Fristen:');
define('HEADER_PO_TERMS_LENGTH', '30 Tage');

define('TABLE_HEADING_COMMENTS', 'Kommentare');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'MwSt');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. MwSt)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. MwSt)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Summe (exkl. MwSt)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Summe (inkl. MwSt)');
define('TABLE_HEADING_PRICE_NO_TAX', 'Einheitspreis');
define('TABLE_HEADING_TOTAL_NO_TAX', 'Summe');

define('ENTRY_CUSTOMER', 'Kunde');
define('ENTRY_BILL_TO', 'Rechnung an');
define('ENTRY_SHIP_TO', 'Versand an');
define('ENTRY_PO_INFO', 'Bestell DETAILS');
define('ENTRY_NO_TAX', 'Keine!');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TAX', 'MwSt:');
define('ENTRY_SHIPPING', 'Versand:');
define('ENTRY_TOTAL', 'Summe:');
define('ENTRY_ORDER_ID','Bestellung #');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart:');

define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;Frei');
?>