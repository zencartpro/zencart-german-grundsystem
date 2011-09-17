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
//  DESCRIPTION:   Takes all the order data found on    //
//  the details screen and formats it for printing on   //
//  standard 8.5" x 11" paper.                          //
//////////////////////////////////////////////////////////
// $Id: super_data_sheet.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('PAGE_TITLE', 'Bestell-Details');
define('HEADER_ORDER_DATA', 'Bestellung #');
define('HEADER_CUSTOMER_ID', 'Kunde #');
define('HEADER_ADDRESS_DATA', 'ADRESS-DATEN');
define('HEADER_STATUS_HISTORY', 'STATUS Historie');
define('HEADER_PAYMENT_HISTORY', 'Zahlungs Historie');

define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_COMMENTS', 'Kommentar');
define('TABLE_HEADING_TYPE', 'Bestell-Typ');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_TAX', 'MwSt');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. MwSt)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. MwSt)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Summe (exkl. MwSt)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Summe (inkl. MwSt)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Der Kunde wurde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstelldatum');

define('TABLE_HEADING_ADMIN_NOTES', 'Admin Notiz');
define('TABLE_HEADING_AUTHOR', 'Verfasser');
define('TABLE_HEADING_ADD_NOTES', 'Neue Notiz bearbeiten');
define('TABLE_HEADING_RATING', 'Sch&auml;tzung');
define('TEXT_WARN_NOT_VISIBLE', ' (Diese Information ist VERTRAULICH)');
define('TEXT_AVG_RATING', 'Durchschnittliche Sch&auml;tzung: ');
define('TEXT_ADMIN_NOTES_NONE', 'Kunde hat keine Pr&uuml;fung');

define('PAYMENT_TABLE_NUMBER', 'Nummer');
define('PAYMENT_TABLE_NAME', 'Abrechnungs-Name');
define('PAYMENT_TABLE_AMOUNT', 'Betrag');
define('PAYMENT_TABLE_TYPE', 'Typ');
define('PAYMENT_TABLE_POSTED', 'Gesendet am');
define('PAYMENT_TABLE_MODIFIED', 'Letzte Aktualisierung');
define('PAYMENT_TABLE_ACTION', 'Aktion');

define('ENTRY_CUSTOMER_ADDRESS', 'Kunde:');
define('ENTRY_SHIPPING_ADDRESS', 'Versand:');
define('ENTRY_BILLING_ADDRESS', 'Abrechnung:');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart:');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteninhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer:');
define('ENTRY_CREDIT_CARD_CVV', 'CVV Nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Karte g&uuml;ltig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TAX', 'MwSt:');
define('ENTRY_SHIPPING', 'Versand:');
define('ENTRY_TOTAL', 'Summe:');
define('ENTRY_AMOUNT_APPLIED', 'Angewanter Betrag:');
define('ENTRY_BALANCE_DUE', 'Saldo f&auml;llig:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_STATUS', 'Status:');

define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart:');
define('TEXT_INFO_SHIPPING_METHOD', 'Versandart:');

define('ENTRY_ORDER_ID','Bestellung #');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">FREI</span>');

define('TEXT_DOWNLOAD_TITLE', 'Download Status');
define('TEXT_DOWNLOAD_STATUS', 'Status');
define('TEXT_DOWNLOAD_FILENAME', 'Dateiname');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Tage');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Downloads');
define('TEXT_DOWNLOAD_AVAILABLE', 'Verf&uuml;gbar');
define('TEXT_DOWNLOAD_EXPIRED', 'Abgelaufen');
define('TEXT_DOWNLOAD_MISSING', 'Nicht auf dem Server');

define('IMAGE_ICON_STATUS_CURRENT', 'Status - Lieferbar');
define('IMAGE_ICON_STATUS_EXPIRED', 'Status - Abgelaufen');
define('IMAGE_ICON_STATUS_MISSING', 'Status - Vermisst');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Download freigegeben');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Download gesperrt');

define('TEXT_INFO_IP_ADDRESS', 'IP Adresse: ');
define('TEXT_NO_PAYMENT_DATA', 'Kein Zahlungsdatum verf&uuml;gbar');
?>