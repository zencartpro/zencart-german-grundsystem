<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
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
//
define('HEADING_TITLE', 'Shopmanager');
define('TABLE_CONFIGURATION_TABLE', 'Suche KONSTANTE Definitionen');

define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Die Sortierung der Attribute wurde <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', 'Sie Sortiererwerte für Artikelpreise wurden <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', 'Die meist besuchten Artikel wurden <strong>erfolgreich</strong> auf 0 zurückgesetzt');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', 'Die meist gekauften Artikel wurden erfolgreich auf 0 zurückgesetzt');
define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', 'Alle Hauptkategorien für verlinkte Artikel wurden <strong>erfolgreich</strong> zurückgesetzt');
define('SUCCESS_UPDATE_COUNTER', 'Der Counter wurde <strong>erfolgreich</strong> aktualisiert auf: ');
define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>Erfolgreiches</strong> Update des Admin-Änderungsprotokolls ');

define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Fehler:</strong> Keine übereinstimmenden Konfigurationsschlüssel gefunden ...');
define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Fehler:</strong> Kein Konfigurationsschlüssel oder Text wurden für die Suche angegeben ... die Suche wurde abgebrochen');

define('TEXT_INFO_COUNTER_UPDATE', '<strong>Aktualisiere Counter</strong><br />auf einen neuen Wert: ');
define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Aktualisiere ALLE Artikelpreissortierungen </strong><br />um eine nach Preisen sortierte Anzeige zu ermöglichen: ');
define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Setze ALLE meist gesehenen Artikel zurück</strong><br />Setze Anzahl der gesehenen Artikel auf 0: ');
define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>ALLE meist gekauften Artikel zurücksetzen</strong><br />Anzahl bestellter Artikel auf 0 setzen: ');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Setze ALLE Artikelhauptkategorie IDs</strong><br />zur Verwendung für verlinkte Artikel und Bepreisung zurück: ');
define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Leere Admin-Änderungsprotokolltabelle in der Datenbank <br />Achtung: Datenbank-Backup durchführen bevor Sie diese Aktion ausführen!</strong><br />Die Admin-Änderungsprotokolltabelle zeichnet jede Adminaktion auf und kann daher sehr groß werden. Eine Säuberung der Tabelle sollte daher von Zeit zu Zeit durchgeführt werden. Eine Warmeldung wird bei Überschreiten von mehr als 50000 Einträgen bzw. mehr als 60 Tagen angezeigt.');

define('TEXT_ORDERS_ID_UPDATE', '<strong>Aktuelle Bestell ID wird zurückgesetzt</strong>');
define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>HINWEIS: Vor der Aktualisierung der aktuellen Bestell ID ...</strong><br /><br />führen Sie bitte eine Testbestellung durch. Anschließend verwenden Sie die die Bestell ID, um die unten angeführten Informationen zu vervollständigen.<br />Die neue Bestell ID für die nächste reale Bestellung sollte um 1 weniger als die Bestell ID sein, die Sie verwenden möchten.<br /><strong>Beispiel:</strong> Wenn die nächste reale Bestellung die Bestell ID 1225 haben soll, geben Sie bitte als ID 1224 ein<br /><br /><strong>WARNUNG:</strong> Sie können Bestell IDs nur vorwärts und nicht rückwärts zurücksetzen.<br />Wenn Sie die Bestell ID auf 25 ändern und dann auf 20, wird die nächste Bestell ID trotzdem die 26 sein.');
define('TEXT_OLD_ORDERS_ID', 'Alte Bestell ID');
define('TEXT_NEW_ORDERS_ID', 'Neue Bestell ID');

define('TEXT_CONFIGURATION_CONSTANT', '<strong>Suche KONSTANTE oder Sprachdateidefinitionen</strong>');
define('TEXT_CONFIGURATION_KEY', 'Schlüssel oder Name:');
define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>HINWEIS:</strong> KONSTANTEN sind immer in Großbuchstaben geschrieben.<br />Die Suche in Sprachdateien kann eine Alternative sein, wenn in den Datenbanktabellen nichts gefunden wurde.');


define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>Suche in Sprachdateidefinitionen</strong>');
define('TEXT_CONFIGURATION_KEY_FILES', 'Suche Text:');
define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>HINWEIS:</strong> Die Suche in Sprachdateien kann in Groß- oder Kleinschreibung erfolgen');

define('TABLE_TITLE_KEY', '<strong>Schlüssel:</strong>');
define('TABLE_TITLE_TITLE', '<strong>Titel:</strong>');
define('TABLE_TITLE_DESCRIPTION', '<strong>Beschreibung:</strong>');
define('TABLE_TITLE_GROUP', '<strong>Gruppe:</strong>');
define('TABLE_TITLE_VALUE', '<strong>Wert:</strong>');

define('TEXT_LANGUAGE_LOOKUPS', 'Sprachdateisuche:');
define('TEXT_LANGUAGE_LOOKUP_NONE', 'Kein');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', 'Alle Sprachdateien für ' . strtoupper($_SESSION['language']) . ' - Webshop/Admin');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'Alle Hauptsprachdateien - Webshop (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /german.php etc.)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', 'Alle derzeit ausgewählten Sprachdateien - Webshop' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'Alle Hauptsprachdateien - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /german.php etc.)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', 'Alle derzeit ausgewählten Sprachdateien - Admin (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', 'Alle derzeit ausgewählten Sprachdateien - Webshop/Admin');

define('TEXT_INFO_NO_EDIT_AVAILABLE', 'Keine Bearbeitung erhältlich');
define('TEXT_INFO_CONFIGURATION_HIDDEN', ' oder VERSTECKT');

define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Datenbank optimieren</strong> um vergeudeten Raum von gelöschten Aufzeichnungen zu entfernen.<br/>Das kann monatlich oder wöchentlich auf einer frequentierten Datenbank erforderlich sein.<br/>(Am besten während der nichtaktiven Zeiten die Optimierung laufen lassen.)');
define('SUCCESS_DB_OPTIMIZE', 'Datenbank-Optimierung - Tabellen verarbeiten: ');

define('TEXT_INFO_PURGE_DEBUG_LOG_FILES', '<strong>Lösche Debug Log Files</strong><br /><strong>ACHTUNG: </strong>Zen Cart zeichnet PHP Fehlermeldungen zu Debugging Zwecken auf. Auch einige der Zahlungsarten Module zeichnen Debug Informationen auf, um evtl. Probleme bei der Zahlung analysieren zu können. <br />Wenn Sie auf Bestätigen klicken, werden alle Debug Log Files unwiderruflich gelöscht.');
define('SUCCESS_CLEAN_DEBUG_FILES', 'Debug Log Files Purged');