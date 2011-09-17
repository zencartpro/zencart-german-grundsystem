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
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////
// $Id: super_orders.php 25 2006-02-03 18:55:56Z BlindSide $
*/

require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');

define('HEADING_TITLE_ORDERS_LISTING', 'Bestellungsaufstellung');
define('HEADING_TITLE_ORDER_DETAILS', 'Bestell #');
define('HEADING_TITLE_SEARCH', 'Bestell ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('HEADING_REOPEN_ORDER', 'Wieder beginnen');

define('TABLE_HEADING_ORDERS_ID','ID');
define('TABLE_HEADING_STATUS_HISTORY', 'Status History');
define('TABLE_HEADING_ADD_COMMENTS', 'Bearbeite neuer Status/Kommentare');
define('TABLE_HEADING_FINAL_STATUS', 'Bestellung schlie&szlig;en');
define('TABLE_HEADING_COMMENTS', 'Kommentare');
define('TABLE_HEADING_CUSTOMERS', 'Kunde');
define('TABLE_HEADING_ORDER_TOTAL', 'Gesamt Rechnung');
define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_TYPE', 'Bestelltyp');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'MwSt');
define('TABLE_HEADING_TOTAL', 'Gesamt');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. MwSt)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. MwSt)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Summe (exkl. MwSt)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Summe (inkl. MwSt)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Der Kunde wurde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstelldatum');

define('TABLE_HEADING_ADMIN_NOTES', 'Admin Mitteilung');
define('TABLE_HEADING_AUTHOR', 'Verfasser');
define('TABLE_HEADING_ADD_NOTES', 'Bearbeite neue Mitteilung');
define('TABLE_HEADING_KARMA', 'Karma');
define('TEXT_WARN_NOT_VISIBLE', ' (Diese Mitteilung ist VERTRAULICH)');
define('TEXT_TOTAL_KARMA', 'Gesamt Karma: ');
define('TEXT_ADMIN_NOTES_NONE', 'Kunde hat keinen R&uuml;ckblick');

define('PAYMENT_TABLE_NUMBER', 'Nummer');
define('PAYMENT_TABLE_NAME', 'Zahlungsname');
define('PAYMENT_TABLE_AMOUNT', 'Betrag');
define('PAYMENT_TABLE_TYPE', 'Typ');
define('PAYMENT_TABLE_POSTED', 'gesendet am');
define('PAYMENT_TABLE_MODIFIED', 'Letzte Akualisiereung');
define('PAYMENT_TABLE_ACTION', 'Action');
define('ALT_TEXT_ADD', 'bearbeiten');
define('ALT_TEXT_UPDATE', 'UPDATE');
define('ALT_TEXT_DELETE', 'L&Ouml;SCHEN');

define('ENTRY_PAYMENT_DETAILS', 'Zahlungsdetails');
define('ENTRY_CUSTOMER_ADDRESS', 'Kundenadresse:');
define('ENTRY_SHIPPING_ADDRESS', 'Versandadresse:');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse:');
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
define('ENTRY_AMOUNT_APPLIED', 'Betrag angewandt:');
define('ENTRY_BALANCE_DUE', 'Gesamt Saldo:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde wurde informiert?');
define('ENTRY_NOTIFY_COMMENTS', 'Weitere Kommentare?');

define('HEADING_COLOR_KEY', 'Farben Schl&uuml;ssel:');
define('TEXT_PURCHASE_ORDERS', 'Bestellung');
define('TEXT_PAYMENTS', 'Zahlung');
define('TEXT_REFUNDS', 'Erstattung');

define('TEXT_MAILTO', 'Mail an');
define('TEXT_STORE_EMAIL', 'web');
define('TEXT_WHOIS_LOOKUP', 'wer ist');
define('TEXT_ICON_LEGEND', 'Action Icon Legende:');
define('TEXT_BILLING_SHIPPING_MISMATCH', 'Rechnung und Versand nicht gefunden');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'L&ouml;sche Bestellung - ');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass diese Bestellung gel&ouml;scht werden soll?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Arikelmenge wieder in Bestand');
define('TEXT_DATE_ORDER_CREATED', 'Erstelldatum:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Letzte &Auml;nderung:');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart:');
define('TEXT_INFO_SHIPPING_METHOD', 'Versandart:');
define('TEXT_ALL_ORDERS', 'Alle Bestellungen');
define('TEXT_NO_ORDER_HISTORY', 'keine Bestellstatistik verf&uuml;gbar');
define('TEXT_DISPLAY_ONLY', '(Nur anzeigen)');

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Die Bestellung existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Die Bestellung wurde aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Keine &Auml;nderung festgestellt. Die Rechnung wurde nicht aktualisiert.');
define('SUCCESS_MARK_COMPLETED', 'Die Bestellung #%s ist komplett!');
define('WARNING_MARK_CANCELLED', 'Warnung: Bestellung #%s wurde abgebrochen');
define('WARNING_ORDER_REOPEN', 'Warnung: Bestellung #%s wurde wieder hergestellt');

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

define('IMAGE_ICON_STATUS_CURRENT', 'Status - Vorhanden');
define('IMAGE_ICON_STATUS_EXPIRED', 'Status - Abgelaufen');
define('IMAGE_ICON_STATUS_MISSING', 'Status - Vermisst');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Download freigegeben');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Download gesperrt');
define('TEXT_MORE', '... mehr');

define('TEXT_INFO_IP_ADDRESS', 'IP Adresse: ');

define('TEXT_NEW_WINDOW', ' (Neues Fenster)');
define('IMAGE_SHIPPING_LABEL', 'Versandetikett');
define('ICON_ORDER_DETAILS', 'Bestelldetails anzeigen');
define('ICON_ORDER_PRINT', 'Drucke Datenblatt' . TEXT_NEW_WINDOW);
define('ICON_ORDER_INVOICE', 'Display Invoice' . TEXT_NEW_WINDOW);
define('ICON_ORDER_PACKINGSLIP', 'Anzeige Packliste' . TEXT_NEW_WINDOW);
define('ICON_ORDER_SHIPPING_LABEL', 'Versandetikett anzeigen' . TEXT_NEW_WINDOW);
define('ICON_ORDER_DELETE', 'Bestellung l&ouml;schen');
define('ICON_EDIT_CONTACT', 'Kontaktdaten bearbeiten');
define('ICON_EDIT_PRODUCT', 'Artikel bearbeiten');
define('ICON_EDIT_TOTAL', 'Bestellsumme bearbeiten');
define('ICON_EDIT_HISTORY', 'Status Hisorie bearbeiten');
define('ICON_CLOSE_STATUS', 'Status schlie&szlig;en');
define('ICON_MARK_COMPLETED', 'Bestellzeichen komplett');
define('ICON_MARK_CANCELLED', 'Bestellzeichen l&ouml;schen');

define('MINI_ICON_ORDERS', 'Zeige Kunde/n Bestellung');
define('MINI_ICON_INFO', 'Zeige Kunde/n Profil');

define('BUTTON_TO_LIST', 'Bestellung');
define('BUTTON_SPLIT', 'Packliste teilen');
define('SELECT_ORDER_LIST', 'Gehe zu Bestellung:');

define('TEXT_NO_PAYMENT_DATA', 'Keine Zahlungsdaten verf&uuml;gbar');
define('TEXT_PAYMENT_DATA', 'Bestellung Zahlungsdaten');
?>