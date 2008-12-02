<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr    http://www.zen-cart.at    2007-01-03
 * @version $Id: orders.php 391 2008-11-17 17:00:12Z webchills $
 */


define('HEADING_TITLE', 'Bestellungen');
define('HEADING_TITLE_SEARCH', 'Bestell ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('HEADING_TITLE_SEARCH_DETAIL_ORDERS_PRODUCTS', 'Suche nach Artikelname oder <strong>ID:XX</strong> or Artikelnummer ');
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
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'MwSt.');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. MwSt.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. MwSt.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Summe (exkl. MwSt.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Summe (inkl. MwSt.)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Der Kunde wurde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Erstellt am');

define('ENTRY_CUSTOMER', 'Kunde:');
define('ENTRY_SOLD_TO', 'Verkauft an:');
define('ENTRY_DELIVERY_TO', 'Geliefert an:');
define('ENTRY_SHIP_TO', 'Versendet an:');
define('ENTRY_SHIPPING_ADDRESS', 'Versandadresse:');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse:');
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
define('TEXT_NO_ORDER_HISTORY', 'keine Bestellstatistik verfügbar');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bestellstatus aktualisiert');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum der Bestellung:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<strong>Anmerkung:</strong> ' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATED', 'Ihr Bestellstatus wurde aktualisiert.' . "\n\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>Neuer Status:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Wenn Sie noch Fragen haben, wenden Sie sich bitte an diese E-Mail Adresse <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">' . STORE_OWNER_EMAIL_ADDRESS . '</a>.<br />' . "\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Die Bestellung existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Die Bestellung wurde aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Keine Änderung festgestellt. Die Rechnung wurde nicht aktualisiert.');

define('ENTRY_ORDER_ID', 'Rechnungsnummer');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">KOSTENLOS</span>');

define('TEXT_DOWNLOAD_TITLE', 'Download Status');
define('TEXT_DOWNLOAD_STATUS', 'Status');
define('TEXT_DOWNLOAD_FILENAME', 'Dateiname');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Tage');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Downloads');

define('TEXT_DOWNLOAD_AVAILABLE', 'Verfügbar');
define('TEXT_DOWNLOAD_EXPIRED', 'Abgelaufen');
define('TEXT_DOWNLOAD_MISSING', 'Nicht auf dem Server');

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

// Erweiterung für Lastschriftverfahren online 2.0
define('TEXT_GERMANBT', 'Bankeinzug');
define('TEXT_GERMANBT_OWNER', 'Kontoinhaber:');
define('TEXT_GERMANBT_NUMBER', 'Kontonummer:');
define('TEXT_GERMANBT_BLZ', 'BLZ:');
define('TEXT_GERMANBT_NAME', 'Bank:');
define('TEXT_GERMANBT_BIC', 'BIC:');
define('TEXT_GERMANBT_FAX', 'Einzugsermächtigung wird per Fax bestätigt');
define('TEXT_GERMANBT_STATUS', 'Prüfstatus:');
define('TEXT_GERMANBT_PRZ', 'Prüfverfahren:');
define('TEXT_GERMANBT_ERROR_1', 'Kontonummer stimmt nicht mit BLZ überein!');
define('TEXT_GERMANBT_ERROR_2', 'Für diese Kontonummer ist kein Prüfverfahren definiert!');
define('TEXT_GERMANBT_ERROR_3', 'Kontonummer nicht prüfbar! Prüfverfahren nicht implementiert');
define('TEXT_GERMANBT_ERROR_4', 'Kontonummer technisch nicht prüfbar!');
define('TEXT_GERMANBT_ERROR_5', 'Bankleitzahl nicht gefunden!');
define('TEXT_GERMANBT_ERROR_8', 'Keine Bankleitzahl angegeben!');
define('TEXT_GERMANBT_ERROR_9', 'Keine Kontonummer angegeben!');
define('TEXT_GERMANBT_ERRORCODE', 'Fehlercode:');

