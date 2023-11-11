<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: coupon_admin.php 2023-10-28 20:44:24Z webchills $
 */


define('HEADING_TITLE','Aktionkupons');
define('HEADING_TITLE_STATUS','Status:');

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
define('TEXT_CONFIRM_DELETE','Wollen Sie diesen Aktionskupon wirklich löschen?');
define('TEXT_SEE_RESTRICT','Verwendungseinschränkung:');

define('TEXT_COUPON_ANNOUNCE', 'Wir freuen uns, Ihnen einen Aktionskupon anzubieten.');

define('TEXT_TO_REDEEM','Sie können diesen Aktionskupon während des Bestellvorgangs einlösen. Sie brauchen nur die Nummer des Aktionskupons in das entsprechende Eingabefeld einzugeben und abschließend auf "Einlösen" zu klicken.');

define('TEXT_VOUCHER_IS','Die Nummer des Aktionskupons lautet');
define('TEXT_REMEMBER','Bewahren Sie die Nummer des Aktionskupons sicher auf, damit Sie von diesem Sonderangebot profitieren können.');
define('TEXT_VISIT','Besuchen Sie uns auf %s');
define('TEXT_COUPON_HELP_DATE', '<p><p>Der Aktionskupon ist gültig vom %s bis zum %s</p></p>');
define('HTML_COUPON_HELP_DATE', '<p><p>Der Aktionskupon ist gültig vom %s bis zum %s</p></p>');



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
define('COUPON_DESC','Aktionskupon Beschreibung<br>Diese wird dem Kunden angezeigt.');
define('COUPON_MIN_ORDER','Mindestbestellwert für diesen Aktionskupon');
define('COUPON_TOTAL', 'Kupon Minimum berechnet von: ');
define('TEXT_COUPON_TOTAL_PRODUCTS', 'erlaubte Artikel');
define('TEXT_COUPON_TOTAL_PRODUCTS_BASED', '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(basiert auf dem Gesamtwert der erlaubten Artikel gemäß der Einschränkungsregeln)');
define('TEXT_COUPON_TOTAL_ORDER', 'Alle Artikel');
define('TEXT_COUPON_TOTAL_ORDER_BASED', '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(basiert auf dem Gesamtwert aller Artikel, unabhängig von geltenden Einschränkungsregeln)');
define('COUPON_USES_COUPON','Benutzung pro Aktionskupon');
define('COUPON_USES_USER','Benutzung pro Kunde');
define('COUPON_PRODUCTS','Gültige Artikelliste');
define('COUPON_CATEGORIES','Gültige Kategorienliste');

define('DATE_CREATED','Erstellt am');
define('DATE_MODIFIED','Geändert am');
define('TEXT_HEADING_NEW_COUPON','Neuen Aktionskupon erstellen');
define('TEXT_NEW_INTRO','Bitte geben Sie folgende Informationen für den neuen Aktionskupon an.<br>');
define('COUPON_ZONE_RESTRICTION', 'Aktionskupon Gültigkeitszone: ');
define('TEXT_COUPON_ZONE_RESTRICTION', 'Die Aktionskupon Gültigkeitszone ist optional.');
define('COUPON_ORDER_LIMIT', 'Bisherige Bestellungen des Kunden weniger als: ');
define('COUPON_ORDER_LIMIT_HELP', 'Der Kunde muss bisherige Bestellungen weniger als haben, leer lassen für unlimitiert');

define('COUPON_IS_VALID_FOR_SALES', 'Kupon gültig für Sonderangebote?');
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
define('COUPON_FREE_SHIP_HELP','Dieser Aktionskupon beinhaltet die Versandkosten einer Bestellung. Diese Einstellung ignoriert den Betrag des Aktionskupons, berücksichtigt jedoch den Mindestbestellwert.<br><b>Achtung: Ein Aktionskupon schreibt entweder die Versandkosten gut oder gibt einen Rabatt. Beides gleichzeitig geht NICHT! Wenn Sie hier also versandkostenfrei ankreuzen, dann darf oben kein Betrag stehen!</b>');
define('COUPON_DESC_HELP','Eine Beschreibung des Aktionskupons für den Kunden');
define('COUPON_MIN_ORDER_HELP','Mindestbestellmenge, bevor der Aktionskupon eingelöst werden kann');
define('COUPON_TOTAL_HELP', 'Wenn Sie eine Mindestbestellmenge für diesen Aktionskupon angeben, möchten Sie dann, dass der Mindestbetrag auf zulässigen Produkten gemäß den Kuponbeschränkungsregeln oder der Gesamtzahl der Bestellungen basiert, wenn Sie feststellen, dass die Kupon-Mindestbestellmenge erreicht wurde?<br>HINWEIS: Alle Artikel bedeutet, dass mindestens einer der qualifizierten eingeschränkten Artikel im Warenkorb sein muss, damit der Rabattcoupon funktioniert.');
define('COUPON_SALE_HELP', 'Wenn Sie <i>NICHT erlaubt</i> wählen, werden Artikel im Sonderangebot oder Abverkauf nicht ermäßigt oder für dien Mindestbestellwert herangezogen.');
define('COUPON_USES_COUPON_HELP','Häufigkeit, mit der dieser Aktionskupon benutzt werden kann. Keine Eingabe = unbegrenzt');
define('COUPON_USES_USER_HELP','Häufigkeit, mit der ein Kunde über diesen Aktionskupon verrechnen darf. Keine Eingabe = unbegrenzt');

define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Bestätigen');


define('COUPON_ACTIVE', 'Status');
define('COUPON_START_DATE', 'Startdatum');
define('COUPON_EXPIRE_DATE', 'Ablaufdatum');
define('TEXT_INFO_DUPLICATE_MANAGEMENT', '<strong>Aktionskupon Mehrfach Management</strong><br><br>Clicken Sie auf den Rabatt Coupon für den Sie Aktionen durchführen wollen<br>oder verwenden Sie den ausgewählten Coupon: <strong>%s</strong>');
define('ERROR_DISCOUNT_COUPON_WELCOME', 'Aktionskupon kann nicht deaktiviert werden, da es sich um den Aktionskupon "Willkommensgeschenk" handelt<br><br>Verwenden Sie einen anderen Aktionskupon als Willkommensgeschenk, damit dieser gelöscht werden kann.');
define('SUCCESS_COUPON_DISABLED', 'Erfolgreich! Der Aktionskupon wurde deaktiviert ...');
define('TEXT_COUPON_NEW', 'Verwenden Sie folgenden Aktionskuponnummer:');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', 'ACHTUNG! Doppelter Aktionskupon existiert ... Kopiervorgang abgebrochen für: ');
define('TEXT_CONFIRM_COPY', 'Wollen Sie diesen Aktionskupon kopieren?');
define('SUCCESS_COUPON_DUPLICATE', 'Aktionskupon erfolgreich kopiert ...<br><br>Bitte Name und Datum überprüfen ...');
define('WARNING_COUPON_DUPLICATE', 'Warnung! Keine Aktionskupons angelegt! Die Anzahl der anzulegenden Kupons wurde nicht festgelegt ... ');
define('WARNING_COUPON_DUPLICATE_FAILED' , 'Warnung! Duplizierung fehlgeschlagen');
define('TEXT_COUPON_COPY_INFO', 'Duplikate erstellen');
define('TEXT_COUPON_COPY_DUPLICATE', 'Mehrfache Coupons erstellen auf Basis von: ');
define('TEXT_COUPON_COPY_DUPLICATE_CNT', 'Wieviele Duplikate möchten Sie erstellen? ');

define('TEXT_CONFIRM_DELETE_DUPLICATE', 'Alle zum Basis Coupon passenden Rabatt Coupons löschen<br>Beispiel: <strong>%s</strong> würde alle Aktionskupons löschen, die beginnen mit: <strong>%s</strong>');
define('TEXT_COUPON_DELETE_DUPLICATE', 'Alle Coupons löschen, die zu diesem Code passen: ');

define('TEXT_DISCOUNT_COUPON_EMAIL', 'Email');
define('TEXT_DISCOUNT_COUPON_CONFIRM_DELETE', 'Deaktivieren bestätigen');
define('TEXT_DISCOUNT_COUPON_CONFIRM_RESTORE', 'Wiederherstellen bestätigen');

define('TEXT_DISCOUNT_COUPON_EDIT', 'Bearbeiten');
define('TEXT_DISCOUNT_COUPON_DELETE', 'Deaktivieren');
define('TEXT_DISCOUNT_COUPON_DEACTIVATED' , 'Deaktiviert: ');
define('TEXT_DISCOUNT_COUPON_RESTORE', 'Wiederherstellen');
define('TEXT_DISCOUNT_COUPON_RESTRICT', 'Einschränken');
define('TEXT_DISCOUNT_COUPON_REPORT', 'Report');
define('TEXT_DISCOUNT_COUPON_COPY', 'Kopieren');
define('TEXT_DISCOUNT_COUPON_COPY_MULTIPLE', 'Klone zu mehreren');
define('TEXT_DISCOUNT_COUPON_DELETE_MULTIPLE', 'Deaktiviere mehrere');
define('TEXT_DISCOUNT_COUPON_REPORT_MULTIPLE', 'Mehrere Report');
define('TEXT_DISCOUNT_COUPON_DOWNLOAD', 'Download mehrere');
define('REDEEM_ORDER_ID', 'Bestellnummer');
define('SUCCESS_COUPON_REACTIVATE', 'Reaktivierung erfolgreich');
define('TEXT_CONFIRM_REACTIVATE', 'Wollen Sie diesen Aktionskupon wirklich wiederherstellen?<br>HINWEIS: Eine Wiederherstellung betrifft nicht das Start/Ablauf Datum.<br>Eien Wiederherstellung betrifft nicht Einschränkungen für die Zahl der Verwendungen per Kupon oder Kunde, falls der Kupon bereits eingelöst wurde.');

define('SUCCESS_COUPON_FOUND', 'Aktionskupon gefunden!');
define('ERROR_COUPON_NOT_FOUND', 'Aktionskupon nicht gefunden!');
define('ERROR_NO_COUPON_CODE', 'Aktionskupon Code nicht eingegeben!');
define('ERROR_NO_COUPONS', 'keine Aktionskupons'); 
