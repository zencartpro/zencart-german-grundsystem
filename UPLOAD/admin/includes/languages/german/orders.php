<?php
/**
 * Zen Cart German Specific
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: orders.php 635 2020-01-18 10:05:14Z webchills $
 */

define('HEADING_TITLE', 'Bestellungen');
define('HEADING_TITLE_DETAILS', 'Bestell Details');
define('HEADING_TITLE_SEARCH', 'Bestell ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('HEADING_TITLE_SEARCH_DETAIL_ORDERS_PRODUCTS', 'Artikelname oder ID:XX oder Artikelnummer ');
define('HEADING_TITLE_SEARCH_ALL','Suche: ');
define('HEADING_TITLE_SEARCH_PRODUCTS','Artikelsuche: ');
define('TEXT_RESET_FILTER', 'Suchfilter entfernen');
define('TEXT_INFO_SEARCH_DETAIL_FILTER_ORDERS_PRODUCTS', 'Suchfilter: ');
define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart<br />Versandart');
define('TABLE_HEADING_ORDERS_ID', 'ID');

define('TEXT_BILLING_SHIPPING_MISMATCH', 'Rechnungs- und Versandadresse stimmen nicht überein ');

define('TABLE_HEADING_COMMENTS', 'Kommentare:');
define('TABLE_HEADING_CUSTOMERS', 'Kunden');
define('TABLE_HEADING_ORDER_TOTAL', 'Bestellsumme');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_TYPE', 'Bestelltyp');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Stück');

define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'MwSt.');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. MwSt.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. MwSt.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Summe (exkl. MwSt.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Summe (inkl. MwSt.)');
define('TABLE_HEADING_UPDATED_BY', 'aktualisiert von');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde wurde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstellt am');

define('ENTRY_CUSTOMER', 'Kunde:');
define('ENTRY_CUSTOMER_ADDRESS', 'Kundenadresse:<br><i class="fa fa-2x fa-user"></i>');
define('ENTRY_SOLD_TO', 'Verkauft an:');
define('ENTRY_DELIVERY_TO', 'Geliefert an:');
define('ENTRY_SHIP_TO', 'Versendet an:');
define('ENTRY_SHIPPING_ADDRESS', 'Versandadresse:<br><i class="fa fa-2x fa-truck"></i>');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse:<br><i class="fa fa-2x fa-credit-card"></i>');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart:');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteninhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer:');
define('ENTRY_CREDIT_CARD_CVV', 'CVV Nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Karte gültig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TAX', 'MwSt.:');
define('ENTRY_SHIPPING', 'Versand:');
define('ENTRY_TOTAL', 'Summe:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Datum der letzten Aktualisierung:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde wurde benachrichtigt:');
define('ENTRY_NOTIFY_COMMENTS', 'Weitere Kommentare:');
define('ENTRY_PRINTABLE', 'Rechnung drucken');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Bestellung löschen');
define('TEXT_INFO_DELETE_INTRO', 'Wollen Sie diese Bestellung wirklich löschen?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Sollen die verkauften Artikel wieder in den Lagerbestand zurückfliessen?');
define('TEXT_DATE_ORDER_CREATED', 'Erstellt am:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart:');
define('TEXT_PAID', 'Bezahlt');
define('TEXT_UNPAID', 'Unbezahlt');

define('TEXT_ALL_ORDERS', 'Alle Bestellungen');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bestellstatus aktualisiert');
define('EMAIL_TEXT_ORDER_CUSTOMER_GENDER_MALE', 'Sehr geehrter Herr ');
define('EMAIL_TEXT_ORDER_CUSTOMER_GENDER_FEMALE', 'Sehr geehrte Frau ');
define('EMAIL_TEXT_ORDER_CUSTOMER_NEUTRAL', 'Sehr geehrte(r) ');
define('EMAIL_TEXT_UPDATEINFO', 'Wir informieren Sie über den Status Ihrer Bestellung bei ');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum der Bestellung:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<strong>Anmerkung:</strong> ' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATED', 'Ihr Bestellstatus wurde aktualisiert.' . "\n\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>Neuer Status:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Wenn Sie noch Fragen haben, wenden Sie sich bitte an diese E-Mail Adresse <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">' . STORE_OWNER_EMAIL_ADDRESS . '</a>.<br />' . "\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'FEHLER: Die Bestellung existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Die Bestellung wurde aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'WARNUNG: Keine Änderung festgestellt. Die Bestellung wurde nicht aktualisiert.');

define('ENTRY_ORDER_ID', 'Rechnungsnummer: ');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">KOSTENLOS</span>');

define('TEXT_DOWNLOAD_TITLE', 'Download Status');
define('TEXT_DOWNLOAD_STATUS', 'Status');
define('TEXT_DOWNLOAD_FILENAME', 'Dateiname');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Tage');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Downloads');

define('TEXT_DOWNLOAD_AVAILABLE', 'Verfügbar');
define('TEXT_DOWNLOAD_EXPIRED', 'Abgelaufen');
define('TEXT_DOWNLOAD_MISSING', 'Nicht auf dem Server');

define('TEXT_EXTENSION_NOT_UNDERSTOOD', 'Dateierweiterung %s nicht unterstützt'); 
define('TEXT_FILE_NOT_FOUND', 'Datei nicht gefunden'); 
define('IMAGE_ICON_STATUS_CURRENT', 'Status - Vorhanden');
define('IMAGE_ICON_STATUS_EXPIRED', 'Status - Abgelaufen');
define('IMAGE_ICON_STATUS_MISSING', 'Status - Vermisst');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Download freigegeben');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Download gesperrt');
define('TEXT_MORE', '... mehr');

define('TEXT_INFO_IP_ADDRESS', 'IP Adresse: ');
define('TEXT_DELETE_CVV_FROM_DATABASE', 'Lösche Kreditkartenprüfziffer aus der Datenbank');
define('TEXT_DELETE_CVV_REPLACEMENT', 'Gelöscht');
define('TEXT_MASK_CC_NUMBER','Diese Zahl verdecken');

define('TEXT_INFO_EXPIRED_DATE', 'Ablaufdatum:<br />');
define('TEXT_INFO_EXPIRED_COUNT', 'Ablaufzähler:<br />');

define('TABLE_HEADING_CUSTOMER_COMMENTS', 'Kunden<br />Kommentare');
define('TEXT_COMMENTS_YES', 'Kundenkommentare - JA');
define('TEXT_COMMENTS_NO', 'Kundenkommentare - NEIN');
define('TEXT_CUSTOMER_LOOKUP', '<i class="fa fa-search"></i> Kunden ansehen');

define('TEXT_INVALID_ORDER_STATUS', '<span class="alert">(Ungültiger Bestellstatus)</span>');

define('BUTTON_TO_LIST', 'Liste der Bestellungen');
define('SELECT_ORDER_LIST', 'Gehe zu Bestellung:');
define('TEXT_MAP_CUSTOMER_ADDRESS', 'Karte Kundenadresse');
define('TEXT_MAP_SHIPPING_ADDRESS', 'Karte Lieferadresse');
define('TEXT_MAP_BILLING_ADDRESS', 'Karte Rechnungsadresse');
