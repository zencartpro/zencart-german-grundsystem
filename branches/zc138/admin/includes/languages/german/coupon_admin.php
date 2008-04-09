<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
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
define('TEXT_SELECT_CUSTOMER','Kunde ausw&auml;hlen');
define('TEXT_ALL_CUSTOMERS','Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS','An alle Newsletter Abonnementen');
define('TEXT_CONFIRM_DELETE','Wollen Sie diesen Aktionskupon wirklich l&ouml;schen?');
define('TEXT_SEE_RESTRICT','Verwendungseinschr&auml;nkung:');
define('TEXT_COUPON_ANNOUNCE', 'Wir erlauben uns, Ihnen einen Aktionskupon anzubieten');
define('TEXT_TO_REDEEM','Sie k&ouml;nnen diesen Aktionskupon w&auml;hrend des Bestellvorgangs einl&ouml;sen. Sie brauchen nur die Nummer des Aktionskupons in das entsprechende Eingabefeld eingeben und abschlie&szlig;end auf &quot;Einl&ouml;sen&quot; klicken.');
define('TEXT_IN_CASE','falls Sie irgendeine Probleme haben.');
define('TEXT_VOUCHER_IS','Die Nummer des Aktionskupons lautet');
define('TEXT_REMEMBER','Bewahren Sie die Nummer des Aktionskupons sicher auf, damit Sie von diesem Sonderangebot profitieren k&ouml;nnen.');
define('TEXT_VISIT','Besuchen Sie uns auf ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' und geben Sie die Nummer Ihres Aktionskupons ein');
define('TEXT_COUPON_HELP_DATE', '<p><p>The coupon is valid between %s and %s</p></p>' . ' !!!TRANSLATE!!! file: admin/includes/languages/LANGUAGE/coupon_admin.php at line 357');
define('HTML_COUPON_HELP_DATE', '<p><p>The coupon is valid between %s and %s</p></p>' . ' !!!TRANSLATE!!! file: admin/includes/languages/LANGUAGE/coupon_admin.php at line 357');
define('TABLE_HEADING_ACTION','Aktion');
define('CUSTOMER_ID','Kundennummer');
define('CUSTOMER_NAME','Kundenname');
define('REDEEM_DATE','Einzul&ouml;sen bis');
define('IP_ADDRESS','IP-Adresse');
define('TEXT_REDEMPTIONS','Einl&ouml;sungen');
define('TEXT_REDEMPTIONS_TOTAL','In Summe');
define('TEXT_REDEMPTIONS_CUSTOMER','F&uuml;r diesen Kunden');
define('TEXT_NO_FREE_SHIPPING','Nicht versandkostenfrei');
define('NOTICE_EMAIL_SENT_TO','Hinweis: E-Mail gesendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED','Fehler: Kein Kunde ausgew&auml;hlt.');
define('ERROR_NO_SUBJECT', 'Fehler: Kein Betreff angegeben.');
define('COUPON_NAME','Name des Aktionskupons');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT','Aktionskupon Betrag');
define('COUPON_CODE','Aktionskuponnummer');
define('COUPON_STARTDATE','G&uuml;ltig ab');
define('COUPON_FINISHDATE','G&uuml;ltig bis');
define('COUPON_FREE_SHIP','Versandkostenfrei');
define('COUPON_DESC','Aktionskupon Beschreibung');
define('COUPON_MIN_ORDER','Mindestbestellwert f&uuml;r diesen Aktionskupon');
define('COUPON_USES_COUPON','Benutzung pro Aktionskupon');
define('COUPON_USES_USER','Benutzung pro Kunde');
define('COUPON_PRODUCTS','G&uuml;ltige Artikelliste');
define('COUPON_CATEGORIES','G&uuml;ltige Kategorienliste');
define('VOUCHER_NUMBER_USED','Anzahl der Benutzung');
define('DATE_CREATED','Erstelldatum');
define('DATE_MODIFIED','Ge&auml;ndert am');
define('TEXT_HEADING_NEW_COUPON','Neuen Aktionskupon erstellen');
define('TEXT_NEW_INTRO','Bitte geben Sie folgende Informationen f&uuml;r den neuen Aktionskupon an.<br>');
define('COUPON_ZONE_RESTRICTION', 'Aktionskupon G&uuml;ltigkeitszone: ');
define('TEXT_COUPON_ZONE_RESTRICTION', 'Die Aktionskupon G&uuml;ltigkeitszone ist optional.');
define('ERROR_NO_COUPON_AMOUNT','Es wurde kein Betrag f&uuml;r den Aktionskupon eingetragen');
define('ERROR_NO_COUPON_NAME','Es wurde kein Name f&uuml;r den Aktionskupon eingetragen');
define('ERROR_COUPON_EXISTS','Ein Aktionskupon mit dieser Nummer existiert bereits');
define('COUPON_NAME_HELP','Ein kurzer Name f&uuml;r den Aktionskupon');
define('COUPON_AMOUNT_HELP','Der Rabattwert f&uuml;r den Aktionskupon ist falsch. Geben Sie entweder eine Zahl oder den entsprechenden Wert in Prozent (z.B. 10%) ein.');
define('COUPON_CODE_HELP','Sie k&ouml;nnen einen eigenen Code verwenden oder das Feld leer lassen, um den Code automatisch erstellen zu lassen.');
define('COUPON_STARTDATE_HELP','Datum, ab dem der Aktionskupon g&uuml;ltig sein wird');
define('COUPON_FINISHDATE_HELP','Ablaufdatum des Aktionskupons');
define('COUPON_FREE_SHIP_HELP','Dieser Aktionskupon beinhaltet die Versandkosten einer Bestellung. Bemerkung: Diese Einstellung ignoriert den Betrag des Aktionskupons, ber&uuml;cksichtigt jedoch den Mindestbestellwert.');
define('COUPON_DESC_HELP','Eine Beschreibung des Aktionskupons f&uuml;r den Kunden');
define('COUPON_MIN_ORDER_HELP','Mindestbestellmenge, bevor der Aktionskupon eingel&ouml;st werden kann');
define('COUPON_USES_COUPON_HELP','Zeigt die H&auml;ufigkeit, mit der dieser Aktionskupon benutzt werden kann.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_USES_USER_HELP','Zeigt die H&auml;ufigkeit, mit der ein Kunde &uuml;ber diesen Aktionskupon verrechnen darf.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_PRODUCTS_HELP','Eine Textdatei mit den Artikeln (mit Komma getrennten Datenfeldern), die mit diesem Aktionskupon verwendet werden k&ouml;nnen. Wenn Sie dieses Feld leer lassen, gibt es keine Einschr&auml;nkungen.');
define('COUPON_CATEGORIES_HELP','Eine Textdatei mit den Kategorien (mit Komma getrennten Datenfeldern), in denen mit Aktionskupon verrechnet werden kann. Bleibt dieses Feld leer, gibt es keine Einschr&auml;nkungen.');
define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Best&auml;tigen');
define('COUPON_BUTTON_BACK', 'Zur&uuml;ck');
define('COUPON_ACTIVE', 'Status');
define('COUPON_START_DATE', 'Startdatum');
define('COUPON_EXPIRE_DATE', 'Ablaufdatum');
define('ERROR_DISCOUNT_COUPON_WELCOME', 'Aktionskupon kann nicht deaktiviert werden, da es sich um den Aktionskupon &quot;Willkommensgeschenk&quot; handelt<br /><br />Verwenden Sie einen anderen Aktionskupon als Willkommensgeschenk, damit dieser gel&ouml;scht werden kann.');
define('SUCCESS_COUPON_DISABLED', 'Gutschein deaktiviert! ...');
define('TEXT_COUPON_NEW', 'Verwenden Sie folgenden Aktionskuponnummer:');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', 'ACHTUNG! Doppelter Aktionskupon existiert ... Kopiervorgang abgebrochen f&uuml;r: ');
define('TEXT_CONFIRM_COPY', 'Wollen Sie diesen Aktionskupon kopieren?');
define('SUCCESS_COUPON_DUPLICATE', 'Aktionskupon erfolgreich kopiert ...<br /><br />Bitte Name und Datum &uuml;berpr&uuml;fen ...');


?>