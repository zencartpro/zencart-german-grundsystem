<?php
/*
  $Id: edit_orders.php,v 1.25 2003/08/07 00:28:44 jwh Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bestellung ändern');
define('HEADING_TITLE_SEARCH', 'Bestell-ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('ADDING_TITLE', 'Artikel hinzufügen');

define('ENTRY_UPDATE_TO_CC', '(Zur <b>Kredit-Karte</b> hinzuf&uuml;gen.)');
define('TABLE_HEADING_COMMENTS', 'Kommentare');
define('TABLE_HEADING_CUSTOMERS', 'Kunde');
define('TABLE_HEADING_ORDER_TOTAL', 'Summe');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modell');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'MwSt');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TABLE_HEADING_UNIT_PRICE', 'Einzelpreis');
define('TABLE_HEADING_TOTAL_PRICE', 'Summe');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Datum');

define('ENTRY_CUSTOMER', 'Kunde:');
define('ENTRY_CUSTOMER_NAME', 'Name');
define('ENTRY_CUSTOMER_COMPANY', 'Firma');
define('ENTRY_CUSTOMER_ADDRESS', 'Adresse');
define('ENTRY_CUSTOMER_SUBURB', 'Vorort');
define('ENTRY_CUSTOMER_CITY', 'Stadt');
define('ENTRY_CUSTOMER_STATE', 'Provinz');
define('ENTRY_CUSTOMER_POSTCODE', 'PLZ');
define('ENTRY_CUSTOMER_COUNTRY', 'Land');

define('ENTRY_SOLD_TO', 'verkauft an:');
define('ENTRY_DELIVERY_TO', 'Lieferung an:');
define('ENTRY_SHIP_TO', 'Versand an:');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse:');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse:');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsmethode:');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkarten-Typ:');
define('ENTRY_CREDIT_CARD_OWNER', 'Eigent&uuml;mer:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kreditkatren-Nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Ablaufdatum:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TAX', 'MwSt:');
define('ENTRY_SHIPPING', 'Versandkosten:');
define('ENTRY_TOTAL', 'Summe:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Letze Aktualisierung:');
define('ENTRY_NOTIFY_CUSTOMER_STANDARD', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_CUSTOMER_INVOICE', 'neue Rechnung (beta):');
define('ENTRY_NOTIFY_COMMENTS', 'Kommentare hinzuf&uuml;gen:');
define('ENTRY_PRINTABLE', 'Rechnung drucken');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Bestellung l&ouml;schen');
define('TEXT_INFO_DELETE_INTRO', 'Wollenn Sie wirklich diese Bestellung l&ouml;schen?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Lagerbestand wieder auff&uuml;llen');
define('TEXT_DATE_ORDER_CREATED', 'Erstelldatum:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_DATE_ORDER_ADDNEW', 'Artikel hinzufügen');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsmethode:');

define('TEXT_ALL_ORDERS', 'Alle Bestellungen');
define('TEXT_NO_ORDER_HISTORY', 'Keine Bestell-Historie vorhanden');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Bestellstatus ge&auml;ndert');
define('EMAIL_TEXT_SUBJECT2', '&Auml;nderung Ihrer Bestellung bei ');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer: 2008/');
define('EMAIL_TEXT_INVOICE_URL', 'Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Der Status Ihrer Bestellung wurde ge&auml;ndert.');
define('EMAIL_TEXT_STATUS_LABEL', 'Neuer Status: ');
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Kommentare zu ihrer Bestellung' . "\n\n%s\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'Falls Sie Fragen haben sollten, antworten Sie einfach auf diese Mail.');
define('EMAIL_THANKS_FOR_SHOPPING', 'Vielen Dank f&uuml;r Ihren Einkauf!');
define('EMAIL_DETAILS_FOLLOW', 'Im Nachfolgenden sehen Sie die Details Ihrer ge&auml;nderten Bestellung.');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'F&uuml;r eine detaillierte Rechnung bitte hier klicken');
define('EMAIL_TEXT_HEADER', 'Automatische &Auml;nderungsbest&auml;tigung');
define('PRODUCTS_TITLE', 'Artikel');
define('HEADING_ADDRESS_INFORMATION', 'Adressinformation');
define('ADDRESS_DELIVERY_TITLE', 'Lieferanschrift');
define('SHIPPING_METHOD_TITLE', 'Versandart');
define('ADDRESS_BILLING_TITLE', 'Rechnungsanschrift');
define('PAYMENT_METHOD_TITLE', 'Zahlungsart');

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Bestellung existiert nicht!');
define('SUCCESS_ORDER_UPDATED', 'Bestellung erfolgreich aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Die Bestellung wurde nicht aktualisiert!');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Artikel ausw&auml;hlen');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Optionen ausw&auml;hlen');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Keine Optionen: &Uuml;berspringe..');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'Menge');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Hinzuf&uuml;gen');


?>