<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
//  $Id: coupon_admin.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('TOP_BAR_TITLE','Statistiken');
define('HEADING_TITLE','Administration');
define('HEADING_TITLE_STATUS','Status:');
define('TEXT_CUSTOMER','Kunde:');
define('TEXT_COUPON','Name des Gutscheins');
define('TEXT_COUPON_ALL','Alle Gutscheine');
define('TEXT_COUPON_ACTIVE','Aktive Gutscheine');
define('TEXT_COUPON_INACTIVE','Inaktive Gutscheine');
define('TEXT_SUBJECT','Thema:');
define('TEXT_UNLIMITED','unlimitiert');
define('TEXT_FROM','Von:');
define('TEXT_FREE_SHIPPING','Versandkostenfrei');
define('TEXT_MESSAGE','Nachricht:');
define('TEXT_RICH_TEXT_MESSAGE', 'Rich-Text Nachricht:');
define('TEXT_SELECT_CUSTOMER','Kunde ausw&auml;hlen');
define('TEXT_ALL_CUSTOMERS','Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS','An alle Newsletter Abonnementen');
define('TEXT_CONFIRM_DELETE','Wollen Sie diesen Gutschein wirklich l&ouml;schen?');
define('TEXT_SEE_RESTRICT','Verwendungseinschr&auml;nkung:');

define('TEXT_COUPON_ANNOUNCE', 'Wir erlauben uns, Ihnen einen Shopgutschein anzubieten');

define('TEXT_TO_REDEEM','Sie k&ouml;nnen diesen Gutschein w&auml;hrend des Bestellvorgangs einl&ouml;sen. Sie brauchen nur die Gutscheinnummer in das entsprechende Eingabefeld eingeben und abschlie&szlig;end auf "einl&ouml;sen" klicken.');
define('TEXT_IN_CASE','falls Sie irgendeine Probleme haben.');
define('TEXT_VOUCHER_IS','Die Gutscheinnummer lautet');
define('TEXT_REMEMBER','Bewahren Sie die Gutscheinnummer sicher auf, damit Sie von diesem Sonderangebot profitieren k&ouml;nnen.');
define('TEXT_VISIT','Besuchen Sie uns auf ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' und geben Sie Ihre Gutscheinnummer ein');

define('TABLE_HEADING_ACTION','Aktion');

define('CUSTOMER_ID','Kundennummer');
define('CUSTOMER_NAME','Kundenname');
define('REDEEM_DATE','Einzul&ouml;sen bis');
define('IP_ADDRESS','IP-Adresse');

define('TEXT_REDEMPTIONS','Einl&ouml;sungen');
define('TEXT_REDEMPTIONS_TOTAL','In Summe');
define('TEXT_REDEMPTIONS_CUSTOMER','F&uuml;r diesen Kunden');
define('TEXT_NO_FREE_SHIPPING','nicht versandkostenfrei');

define('NOTICE_EMAIL_SENT_TO','Hinweis: Email gesendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED','Fehler: Kein Kunde ausgew&auml;hlt.');
define('ERROR_NO_SUBJECT', 'Fehler: Kein Betreff angegeben.');

define('COUPON_NAME','Name des Gutscheins');
define('COUPON_VALUE', 'Gutscheinwert');
define('COUPON_AMOUNT','Gutscheinbetrag');
define('COUPON_CODE','Gutscheincode');
define('COUPON_STARTDATE','G&uuml;ltig ab');
define('COUPON_FINISHDATE','G&uuml;ltig bis');
define('COUPON_FREE_SHIP','Versandkostenfrei');
define('COUPON_DESC','Gutscheinbeschreibung');
define('COUPON_MIN_ORDER','Mindestbestellwert f&uuml;r diesen Gutschein');
define('COUPON_USES_COUPON','Benutzung pro Gutschein');
define('COUPON_USES_USER','Benutzung pro Kunde');
define('COUPON_PRODUCTS','G&uuml;ltige Artikelliste');
define('COUPON_CATEGORIES','G&uuml;ltige Kategorienliste');
define('VOUCHER_NUMBER_USED','Anzahl der Benutzung');
define('DATE_CREATED','Erstelldatum');
define('DATE_MODIFIED','Ge&auml;ndert am');
define('TEXT_HEADING_NEW_COUPON','Neuen Gutschein erstellen');
define('TEXT_NEW_INTRO','Bitte geben Sie folgende Informationen f&uuml;r den neuen Gutschein an.<br>');

define('ERROR_NO_COUPON_AMOUNT','Es wurde kein Gutscheinbetrag eingetragen');
define('ERROR_NO_COUPON_NAME','Es wurde kein Gutscheinname eingetragen');
define('ERROR_COUPON_EXISTS','Ein Gutschein mit dieser Nummer existiert bereits');


define('COUPON_NAME_HELP','Ein kurzer Name f&uuml;r den Gutschein');
define('COUPON_AMOUNT_HELP','Der Rabattwert f&uuml;r den Gutschein ist falsch. Geben Sie entweder eine Zahl oder den entsprechenden Wert in Prozent (z.B. 10%) ein.');
define('COUPON_CODE_HELP','Sie k&ouml;nnen einen eigenen Code verwenden oder das Feld leer lassen, um den Code automatisch zu erstellen.');
define('COUPON_STARTDATE_HELP','Datum, ab dem der Gutschein g&uuml;ltig sein wird');
define('COUPON_FINISHDATE_HELP','Ablaufdatum des Gutscheins');
define('COUPON_FREE_SHIP_HELP','Dieser Gutschein beinhaltet die Versandkosten einer Bestellung. Bemerkung: Diese Einstellung ignoriert den Gutscheinbetrag, ber&uuml;cksichtigt jedoch den Mindestbestellwert.');
define('COUPON_DESC_HELP','Eine Beschreibung des Gutscheines f&uuml;r den Kunden');
define('COUPON_MIN_ORDER_HELP','Mindestbestellmenge, bevor Gutschein eingel&ouml;st werden kann');
define('COUPON_USES_COUPON_HELP','Zeigt die H&auml;ufigkeit, mit der dieser Gutschein benutzt werden kann.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_USES_USER_HELP','Zeigt die H&auml;ufigkeit, mit der ein Kunde &uuml;ber diesen Gutschein verrechnen darf.<br />Bemerkung: Keine Eingabe = unbegrenzt');
define('COUPON_PRODUCTS_HELP','Eine Textdatei mit den Artikeln (mit Komma getrennten Datenfeldern), die mit diesem Gutschein verwendet werden k&ouml;nnen. Wenn Sie dieses Feld leer lassen, gibt es keine Einschr&auml;nkungen.');
define('COUPON_CATEGORIES_HELP','Eine Textdatei mit den Kategorien (mit Komma getrennten Datenfeldern), in denen mit Gutschein verrechnet werden kann. Bleibt dieses Feld leer, gibt es keine Einschr&auml;nkungen.');
define('COUPON_BUTTON_PREVIEW', 'Vorschau');
define('COUPON_BUTTON_CONFIRM', 'Best&auml;tigen');
define('COUPON_BUTTON_BACK', 'Zur&uuml;ck');
define('COUPON_ACTIVE', 'Status');     // new 1.3.0  
define('COUPON_START_DATE', 'Start'); // new 1.3.0  
define('COUPON_EXPIRE_DATE', 'Läuft ab ');  // new 1.3.0  
?>