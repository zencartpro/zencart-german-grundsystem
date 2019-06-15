<?php
/**
 * @package admin
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: coupon_admin.php 633 2018-04-03 16:02:08Z webchills $
 */

define('TOP_BAR_TITLE','Statistiken');
define('HEADING_TITLE','Aktionkupons');
define('HEADING_TITLE_STATUS','Status:');
define('TEXT_CUSTOMER','Kunde:');
define('TEXT_COUPON','Name des Aktionkupons');
define('TEXT_COUPON_ALL','Alle Aktionkupons');
define('TEXT_COUPON_ACTIVE','Aktive Aktionkupons');
define('TEXT_COUPON_INACTIVE','Inaktive Aktionskupons');
define('TEXT_SUBJECT','Betreff:');
define('TEXT_UNLIMITED','unlimitiert');
define('TEXT_FROM','Von:');
define('TEXT_FREE_SHIPPING','Versandkostenfrei');
define('TEXT_MESSAGE','Nachricht:');
define('TEXT_RICH_TEXT_MESSAGE', 'Rich-Text Nachricht:');
define('TEXT_SELECT_CUSTOMER','Kunde auswählen');
define('TEXT_ALL_CUSTOMERS','Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS','An alle Newsletter Abonnementen');
define('TEXT_CONFIRM_DELETE','Wollen Sie diesen Aktionskupon wirklich löschen?');
define('TEXT_SEE_RESTRICT','Verwendungseinschränkung:');

define('TEXT_COUPON_ANNOUNCE', 'Wir erlauben uns, Ihnen einen Aktionskupon anzubieten.');

define('TEXT_TO_REDEEM','Sie können diesen Aktionskupon während des Bestellvorgangs einlösen. Sie brauchen nur die Nummer des Aktionskupons in das entsprechende Eingabefeld einzugeben und abschließend auf "Einlösen" zu klicken.');
define('TEXT_IN_CASE','falls Sie irgendwelche Probleme haben.');
define('TEXT_VOUCHER_IS','Die Nummer des Aktionskupons lautet');
define('TEXT_REMEMBER','Bewahren Sie die Nummer des Aktionskupons sicher auf, damit Sie von diesem Sonderangebot profitieren können.');
define('TEXT_VISIT','Besuchen Sie uns auf %s');
define('TEXT_ENTER_CODE', ' und geben Sie die Nummer Ihres Aktionskupons ein');
define('TEXT_COUPON_HELP_DATE', '<p><p>Der Aktionskupon ist gültig vom %s bis zum %s</p></p>');
define('HTML_COUPON_HELP_DATE', '<p><p>Der Aktionskupon ist gültig vom %s bis zum %s</p></p>');

define('TABLE_HEADING_ACTION','Aktion');

define('CUSTOMER_ID','Kunden ID');
define('CUSTOMER_NAME','Kundenname');
define('REDEEM_DATE','Eingelöst am');
define('IP_ADDRESS','IP-Adresse');

define('TEXT_REDEMPTIONS','Einlösungen');
define('TEXT_REDEMPTIONS_TOTAL','Summe');
define('TEXT_REDEMPTIONS_CUSTOMER','Für diesen Kunden');
define('TEXT_NO_FREE_SHIPPING','Nicht versandkostenfrei');

define('NOTICE_EMAIL_SENT_TO','HINWEIS: E-Mail gesendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED','FEHLER: Es wurde kein Kunde ausgewählt.');
define('ERROR_NO_SUBJECT', 'FEHLER: Es wurde kein Betreff eingegeben.');

define('COUPON_NAME','Name des Aktionskupons');
define('COUPON_AMOUNT','Aktionskupon Betrag');
define('TEXT_COUPON_PRODUCT_COUNT_PER_ORDER', 'per Bestellung');
define('TEXT_COUPON_PRODUCT_COUNT_PER_PRODUCT', 'per qualifiziertem Artikel');
define('COUPON_CODE','Aktionskuponnummer');
define('COUPON_STARTDATE','Gültig ab');
define('COUPON_FINISHDATE','Gültig bis');
define('COUPON_RESTRICTIONS', 'Einschränkungen');
define('COUPON_FREE_SHIP','Versandkostenfrei');
define('COUPON_DESC','Aktionskupon Beschreibung<br />Diese wird dem Kunden angezeigt.');
define('COUPON_MIN_ORDER','Mindestbestellwert für diesen Aktionskupon');
define('COUPON_TOTAL', 'Kupon Minimum berechnet von: ');
define('TEXT_COUPON_TOTAL_PRODUCTS', 'erlaubte Artikel');
define('TEXT_COUPON_TOTAL_PRODUCTS_BASED', '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(basiert auf dem Gesamtwert der erlaubten Artikel gemäß der Einschränkungsregeln)');
define('TEXT_COUPON_TOTAL_ORDER', 'Alle Artikel');
define('TEXT_COUPON_TOTAL_ORDER_BASED', '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(basiiert auf dem Gesamtwert aller Artikel, unabhängig von geltenden Einschränkungsregeln)');
define('COUPON_USES_COUPON','Benutzung pro Aktionskupon');
define('COUPON_USES_USER','Benutzung pro Kunde');
define('COUPON_PRODUCTS','Gültige Artikelliste');
define('COUPON_CATEGORIES','Gültige Kategorienliste');
define('VOUCHER_NUMBER_USED','Anzahl der Benutzung');
define('DATE_CREATED','Erstellt am');
define('DATE_MODIFIED','Geändert am');
define('TEXT_HEADING_NEW_COUPON','Neuen Aktionskupon erstellen');
define('TEXT_NEW_INTRO','Bitte geben Sie folgende Informationen für den neuen Aktionskupon an.<br>');
define('COUPON_ZONE_RESTRICTION', 'Aktionskupon Gültigkeitszone: ');
define('TEXT_COUPON_ZONE_RESTRICTION', 'Die Aktionskupon Gültigkeitszone ist optional.');
define('COUPON_ORDER_LIMIT', 'Bisherige Bestellungen des Kunden weniger als: ');
define('COUPON_ORDER_LIMIT_HELP', 'Der Kunde muss bisherige Bestellungen weniger als haben, leer lassen für unlimitiert');

define('COUPON_IS_VALID_FOR_SALES', 'Kupon gültig fü Verkäufe:');
define('TEXT_COUPON_IS_VALID_FOR_SALES', 'Kupon IST erlaubt für Sonderangebote');
define('TEXT_COUPON_IS_VALID_FOR_SALES_EMAIL', 'Kupon ist erlaubt für Sonderangebote');
define('TEXT_NO_COUPON_IS_VALID_FOR_SALES', 'Kupon IST NICHT erlaubt für Sonderangebote');
define('TEXT_NO_COUPON_IS_VALID_FOR_SALES_EMAIL', 'Kupon ist nicht erlaubt für Sonderangebote');
define('ERROR_NO_COUPON_AMOUNT','Es wurde kein Betrag für den Aktionskupon eingetragen');
define('ERROR_NO_COUPON_NAME','Es wurde kein Name für den Aktionskupon eingetragen');
define('ERROR_COUPON_EXISTS','Ein Aktionskupon mit dieser Nummer existiert bereits');

define('COUPON_NAME_HELP','Ein kurzer Name für den Aktionskupon');
define('COUPON_AMOUNT_HELP','Geben Sie entweder eine Zahl für einen Fixbetrag oder den entsprechenden Wert in Prozent (z.B. 10%) ein.');
define('COUPON_CODE_HELP','Sie können einen eigenen Code verwenden oder das Feld leer lassen, um den Code automatisch erstellen zu lassen.');
define('COUPON_STARTDATE_HELP','Datum, ab dem der Aktionskupon gültig sein wird');
define('COUPON_FINISHDATE_HELP','Datum, ab dem der Aktionskupon ungültig sein wird');
define('COUPON_FREE_SHIP_HELP','Dieser Aktionskupon beinhaltet die Versandkosten einer Bestellung. Diese Einstellung ignoriert den Betrag des Aktionskupons, berücksichtigt jedoch den Mindestbestellwert.<br/><b>Achtung: Ein Aktionskupon schreibt entweder die Versandkosten gut oder gibt einen Rabatt. Beides gleichzeitig geht NICHT! Wenn Sie hier also versandkostenfrei ankreuzen, dann darf oben kein Betrag stehen!</b>');
define('COUPON_DESC_HELP','Eine Beschreibung des Aktionskupons für den Kunden');
define('COUPON_MIN_ORDER_HELP','Mindestbestellmenge, bevor der Aktionskupon eingelöst werden kann');
define('COUPON_TOTAL_HELP', 'If you specify a Coupon Minimum Order for this Discount Coupon, do you want the Minimum amount to be based on Allowed Products according to Coupon Restriction Rules or the Full Order Total, when determining if the Coupon Minimum Order has been met?<br />NOTE: Full Order Total means at least 1 of the Qualifying Restricted Products must be in the cart for the Discount Coupon to work.');
define('COUPON_USES_COUPON_HELP','Häufigkeit, mit der dieser Aktionskupon benutzt werden kann. Keine Eingabe = unbegrenzt');
define('COUPON_USES_USER_HELP','Häufigkeit, mit der ein Kunde über diesen Aktionskupon verrechnen darf. Keine Eingabe = unbegrenzt');
define('COUPON_PRODUCTS_HELP','Eine Textdatei mit den Artikeln (mit Komma getrennten Datenfeldern), die mit diesem Aktionskupon verwendet werden können. Wenn Sie dieses Feld leer lassen, gibt es keine Einschränkungen.');
define('COUPON_CATEGORIES_HELP','Eine Textdatei mit den Kategorien (mit Komma getrennten Datenfeldern), in denen mit Aktionskupon verrechnet werden kann. Bleibt dieses Feld leer, gibt es keine Einschränkungen.');
define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Bestätigen');
define('COUPON_BUTTON_CANCEL', 'Abbrechen');

define('COUPON_ACTIVE', 'Status');
define('COUPON_START_DATE', 'Startdatum');
define('COUPON_EXPIRE_DATE', 'Ablaufdatum');
define('TEXT_INFO_DUPLICATE_MANAGEMENT', '<strong>Multiple Discount Coupons Management</strong><br /><br />Click on Discount Coupon to base changes on<br />or use the selected Base Coupon Code: <strong>%s</strong>');
define('ERROR_DISCOUNT_COUPON_WELCOME', 'Aktionskupon kann nicht deaktiviert werden, da es sich um den Aktionskupon "Willkommensgeschenk" handelt<br /><br />Verwenden Sie einen anderen Aktionskupon als Willkommensgeschenk, damit dieser gelöscht werden kann.');
define('SUCCESS_COUPON_DISABLED', 'Erfolgreich! Der Aktionskupon wurde deaktiviert ...');
define('TEXT_COUPON_NEW', 'Verwenden Sie folgenden Aktionskuponnummer:');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', 'ACHTUNG! Doppelter Aktionskupon existiert ... Kopiervorgang abgebrochen für: ');
define('TEXT_CONFIRM_COPY', 'Wollen Sie diesen Aktionskupon kopieren?');
define('SUCCESS_COUPON_DUPLICATE', 'Aktionskupon erfolgreich kopiert ...<br /><br />Bitte Name und Datum überprüfen ...');
define('WARNING_COUPON_DUPLICATE', 'Warning! No Discount Coupons were made! Number of Discount Coupons to create was not defined ... ');

define('TEXT_COUPON_COPY_INFO', 'Copy for multiple duplicates');
define('TEXT_COUPON_COPY_DUPLICATE', 'Create Multiple Coupons with Base Coupon Code of: ');
define('TEXT_COUPON_COPY_DUPLICATE_CNT', 'How many duplicate Discount Coupons do you want to create? ');

define('TEXT_CONFIRM_DELETE_DUPLICATE', 'Delete all matching Discount Coupons based on the Base coupon code<br />Example: <strong>%s</strong> would delete all Discount Coupons codes starting with: <strong>%s</strong>');
define('TEXT_COUPON_DELETE_DUPLICATE', 'Delete all Discount Coupons matching base code: ');

define('TEXT_DISCOUNT_COUPON_EMAIL', 'Email Discount Coupon');
define('TEXT_DISCOUNT_COUPON_CONFIRM_DELETE', 'Confirm Delete Discount Coupon');
define('TEXT_DISCOUNT_COUPON_CONFIRM_RESTORE', 'Confirm Restore Discount Coupon');

define('TEXT_DISCOUNT_COUPON_EDIT', 'Edit Discount Coupon');
define('TEXT_DISCOUNT_COUPON_DELETE', 'Delete Discount Coupon');
define('TEXT_DISCOUNT_COUPON_RESTORE', 'Restore Discount Coupon');
define('TEXT_DISCOUNT_COUPON_RESTRICT', 'Restrict Discount Coupon');
define('TEXT_DISCOUNT_COUPON_REPORT', 'Discount Coupon Report');
define('TEXT_DISCOUNT_COUPON_COPY', 'Copy Discount Coupon');
define('TEXT_DISCOUNT_COUPON_COPY_MULTIPLE', 'Copy to Multiple Discount Coupons');
define('TEXT_DISCOUNT_COUPON_DELETE_MULTIPLE', 'Delete Multiple Discount Coupons');
define('TEXT_DISCOUNT_COUPON_REPORT_MULTIPLE', 'Multiple Discount Coupons Report');
define('TEXT_DISCOUNT_COUPON_DOWNLOAD', 'Download Multiple Coupon Codes');
define('REDEEM_ORDER_ID', 'Order #');
define('SUCCESS_COUPON_REACTIVATE', 'Successful Reactivate');
define('TEXT_CONFIRM_REACTIVATE', 'Are you sure you want to restore this Coupon?<br />NOTE: Restore does not affect Start/Expiration Dates.<br />Restore does not affect limits on use per coupon/use per customer if already redeemed.');

define('SUCCESS_COUPON_FOUND', 'Discount Coupon found!');
define('ERROR_COUPON_NOT_FOUND', 'Discount Coupon not found!');
define('ERROR_NO_COUPON_CODE', 'Discount Coupon coupon code not entered!');