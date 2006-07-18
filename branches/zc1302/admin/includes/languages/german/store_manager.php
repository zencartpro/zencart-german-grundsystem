<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
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
//  $Id: store_manager.php 4 2006-03-31 16:38:40Z hugo13 $
//
//
define('HEADING_TITLE', 'Shopmanager');
define('TABLE_CONFIGURATION_TABLE', 'Suche KONSTANTE Definitionen');

define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Die Sortierreihenfolge der Attribute wurde <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', 'Sie Sortiererwerte f&uuml;r Artikelpreise wurden <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', 'Die gesehenen Artikel wurden <strong>erfolgreich</strong> auf 0 zur&uuml;ckgesetzt');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', 'Die bestellten Artikel wurden erfolgreich auf 0 zurückgesetzt');
define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', 'Alle Hauptkategorien f&uuml;r verlinkte Artikel wurden <strong>erfolgreich</strong> zur&uuml;ckgesetzt');
define('SUCCESS_UPDATE_COUNTER', 'Der Counter wurde <strong>erfolgreich</strong> aktualisiert auf: ');
define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Erfolgreiches</strong> Update des Admin-Änderungsprotokolls '); // new 1.3.0  

define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Fehler:</strong> Keine &uuml;bereinstimmenden Konfigurationsschl&uuml;ssel gefunden ...');
define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Fehler:</strong> Kein Konfigurationsschl&uuml;ssel oder Text wurden f&uuml;r die Suche angegeben ... die Suche wurde abgebrochen');

define('TEXT_INFO_COUNTER_UPDATE', '<strong>Aktualisiere Counter</strong><br />auf einen neuen Wert: ');
define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Aktualisiere ALLE Artikelpreissortierer </strong><br />um eine nach Preisen sortierte Anzeige zu erm&ouml;glichen: ');
define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Setze ALLE gesehenen Artikel zur&uuml;ck</strong><br />Setze Anzahl der gesehenen Artikel auf 0: ');
define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>ALLE bestellten Artikel zurücksetzen</strong><br />Anzahl bestellter Artikel auf 0 setzen: ');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Setze ALLE Artikelhauptkategorie IDs</strong><br />zur Verwendung f&uuml;r verlinkte Artikel und Bepreisung zur&uuml;ck: ');
define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Leere Admin-Änderungsprotokolltabelle in der Datenbank <br />Achtung: Datenbank-Backup durchf&uuml;hren bevor Sie diese Aktion ausf&uuml;hren!</strong><br />Die Admin-&Auml;nderungsprotokolltabelle zeichnet jede Adminaktion auf und kann daher sehr gro&szlig; werden. Eine S&auml;uberung der Tabelle sollte daher von Zeit zu Zeit durchgef&uuml;hrt werden. Eine Warmeldung wird bei &Uuml;berschreiten von mehr als 50000 Eintr&auml;gen bzw. mehr als 60 Tagen angezeigt.'); // new 1.3.0  

define('TEXT_ORDERS_ID_UPDATE', '<strong>Aktuelle Bestell ID wird zur&uuml;ckgesetzt</strong>');
define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>HINWEIS: Vor der Aktualisierung der aktuellen Bestell ID ...</strong><br /><br />f&uuml;hren Sie bitte eine Testbestellung durch. Anschlie&szlig;end verwenden Sie die die Bestell ID, um die unten angef&uuml;hrten Informationen zu vervollst&auml;ndigen.<br />Die neue Bestell ID f&uuml;r die n&auml;chste reale Bestellung sollte um 1 weniger als die Bestell ID sein, die Sie verwenden m&ouml;chten.<br /><strong>Beispiel:</strong> Wenn die n&auml;chste reale Bestellung die Bestell ID 1225 haben soll, geben Sie bitte als ID 1224 ein<br /><br /><strong>WARNUNG:</strong> Sie k&ouml;nnen Bestell IDs nur vorw&auml;rts und nicht r&uuml;ckw&auml;rts zur&uuml;cksetzen.<br />Wenn Sie die Bestell ID auf 25 &auml;ndern und dann auf 20, wird die n&auml;chste Bestell ID trotzdem die 26 sein.');
define('TEXT_OLD_ORDERS_ID', 'Alte Bestell ID');
define('TEXT_NEW_ORDERS_ID', 'Neue Bestell ID');

define('TEXT_CONFIGURATION_CONSTANT', '<strong>Suche KONSTANTE oder Sprachdateidefinitionen</strong>');
define('TEXT_CONFIGURATION_KEY', 'Schl&uuml;ssen oder Name:');
define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>HINWEIS:</strong> KONSTANTEN sind immer in Gro&szlig;buchstaben geschrieben.<br />Die Suche in Sprachdateien kann eine alternative sein, wenn in den Datenbanktabellen nichts gefunden wurde.');


define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Suche in Sprachdateidefinitionen</strong>');
define('TEXT_CONFIGURATION_KEY_FILES', 'Suche Text:');
define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>HINWEIS:</strong> Die Suche in Sprachdateien kann in Gro&szlig;- oder Kleinschreibung erfolgen');

define('TABLE_TITLE_KEY', '<strong>Schl&uuml;ssel:</strong>');
define('TABLE_TITLE_TITLE', '<strong>Titel:</strong>');
define('TABLE_TITLE_DESCRIPTION', '<strong>Beschreibung:</strong>');
define('TABLE_TITLE_GROUP', '<strong>Gruppe:</strong>');
define('TABLE_TITLE_VALUE', '<strong>Wert:</strong>');

define('TEXT_LANGUAGE_LOOKUPS', 'Sprachdatei suche:');
define('TEXT_LANGUAGE_LOOKUP_NONE', 'Kein');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Alle Sprachdateien f&uuml;r ' . strtoupper($_SESSION['language']) . ' - Webshop/Admin');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Alle Hauptsprachdateien - Webshop (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /german.php etc.)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Alle derzeit ausgew&auml;hlten Sprachdateien - Webshop' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Alle Hauptsprachdateien - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /german.php etc.)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Alle derzeit ausgew&auml;hlten Sprachdateien - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Alle derzeit ausgew&auml;hlten Sprachdateien - Webshop/Admin');

define('TEXT_INFO_NO_EDIT_AVAILABLE', 'Keine Bearbeitung erh&auml;ltlich');
define('TEXT_INFO_CONFIGURATION_HIDDEN', ' oder VERSTECKT');
?>