<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id$
 */

//  $Id$
//

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

define('NOTICE_EMAIL_SENT_TO','Hinweis: E-Mail gesendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED','Fehler: Es wurde kein Kunde ausgewählt.');
define('ERROR_NO_SUBJECT', 'Fehler: Es wurde kein Betreff eingegeben.');

define('COUPON_NAME','Name des Aktionskupons');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT','Aktionskupon Betrag');
define('COUPON_CODE','Aktionskuponnummer');
define('COUPON_STARTDATE','Gültig ab');
define('COUPON_FINISHDATE','Gültig bis');
define('COUPON_FREE_SHIP','Versandkostenfrei');
define('COUPON_DESC','Aktionskupon Beschreibung<br />Diese wird dem Kunden angezeigt.');
define('COUPON_MIN_ORDER','Mindestbestellwert für diesen Aktionskupon');
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

define('ERROR_NO_COUPON_AMOUNT','Es wurde kein Betrag für den Aktionskupon eingetragen');
define('ERROR_NO_COUPON_NAME','Es wurde kein Name für den Aktionskupon eingetragen');
define('ERROR_COUPON_EXISTS','Ein Aktionskupon mit dieser Nummer existiert bereits');

define('COUPON_NAME_HELP','Ein kurzer Name für den Aktionskupon');
define('COUPON_AMOUNT_HELP','Der Rabattwert für den Aktionskupon ist falsch. Geben Sie entweder eine Zahl oder den entsprechenden Wert in Prozent (z.B. 10%) ein.');
define('COUPON_CODE_HELP','Sie können einen eigenen Code verwenden oder das Feld leer lassen, um den Code automatisch erstellen zu lassen.');
define('COUPON_STARTDATE_HELP','Datum, ab dem der Aktionskupon gültig sein wird');
define('COUPON_FINISHDATE_HELP','Datum, ab dem der Aktionskupon ungültig sein wird');
define('COUPON_FREE_SHIP_HELP','Dieser Aktionskupon beinhaltet die Versandkosten einer Bestellung. Bemerkung: Diese Einstellung ignoriert den Betrag des Aktionskupons, berücksichtigt jedoch den Mindestbestellwert.');
define('COUPON_DESC_HELP','Eine Beschreibung des Aktionskupons für den Kunden');
define('COUPON_MIN_ORDER_HELP','Mindestbestellmenge, bevor der Aktionskupon eingelöst werden kann');
define('COUPON_USES_COUPON_HELP','Zeigt die Häufigkeit, mit der dieser Aktionskupon benutzt werden kann.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_USES_USER_HELP','Zeigt die Häufigkeit, mit der ein Kunde über diesen Aktionskupon verrechnen darf.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_PRODUCTS_HELP','Eine Textdatei mit den Artikeln (mit Komma getrennten Datenfeldern), die mit diesem Aktionskupon verwendet werden können. Wenn Sie dieses Feld leer lassen, gibt es keine Einschränkungen.');
define('COUPON_CATEGORIES_HELP','Eine Textdatei mit den Kategorien (mit Komma getrennten Datenfeldern), in denen mit Aktionskupon verrechnet werden kann. Bleibt dieses Feld leer, gibt es keine Einschränkungen.');
define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Bestätigen');
define('COUPON_BUTTON_BACK', 'Zurück');
define('COUPON_ACTIVE', 'Status');
define('COUPON_START_DATE', 'Startdatum');
define('COUPON_EXPIRE_DATE', 'Ablaufdatum');

define('ERROR_DISCOUNT_COUPON_WELCOME', 'Aktionskupon kann nicht deaktiviert werden, da es sich um den Aktionskupon "Willkommensgeschenk" handelt<br /><br />Verwenden Sie einen anderen Aktionskupon als Willkommensgeschenk, damit dieser gelöscht werden kann.');
define('SUCCESS_COUPON_DISABLED', 'Erfolgreich! der Aktionskupon wurde deaktiviert ...');
define('TEXT_COUPON_NEW', 'Verwenden Sie folgenden Aktionskuponnummer:');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', 'ACHTUNG! Doppelter Aktionskupon existiert ... Kopiervorgang abgebrochen für: ');
define('TEXT_CONFIRM_COPY', 'Wollen Sie diesen Aktionskupon kopieren?');
define('SUCCESS_COUPON_DUPLICATE', 'Aktionskupon erfolgreich kopiert ...<br /><br />Bitte Name und Datum überprüfen ...');
