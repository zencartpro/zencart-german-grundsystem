<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: store_manager.php 2023-10-28 16:59:50Z webchills $
*/
define('HEADING_TITLE', 'Shopmanager');


define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', 'Die Sortierung der Attribute wurde <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', 'Sie Sortiererwerte für Artikelpreise wurden <strong>erfolgreich</strong> aktualisiert');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', 'Die meist besuchten Artikel wurden <strong>erfolgreich</strong> auf 0 zurückgesetzt');
define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', 'Die meist gekauften Artikel wurden erfolgreich auf 0 zurückgesetzt');
define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', 'Alle Hauptkategorien für verlinkte Artikel wurden <strong>erfolgreich</strong> zurückgesetzt');
define('SUCCESS_UPDATE_COUNTER', 'Der Counter wurde <strong>erfolgreich</strong> aktualisiert auf: ');

define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>Fehler:</strong> Keine übereinstimmenden Konfigurationsschlüssel gefunden ...');
define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>Fehler:</strong> Kein Konfigurationsschlüssel oder Text wurden für die Suche angegeben ... die Suche wurde abgebrochen');

define('TEXT_INFO_COUNTER_UPDATE', '<strong>Aktualisiere Counter</strong><br>auf einen neuen Wert: ');
define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>Aktualisiere ALLE Artikelpreissortierungen </strong><br>um eine nach Preisen sortierte Anzeige zu ermöglichen: ');
define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>Setze ALLE meist gesehenen Artikel zurück</strong><br>Setze Anzahl der gesehenen Artikel auf 0: ');
define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>ALLE meist gekauften Artikel zurücksetzen</strong><br>Anzahl bestellter Artikel auf 0 setzen: ');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>Setze ALLE Artikelhauptkategorie IDs</strong><br>zur Verwendung für verlinkte Artikel und Bepreisung zurück: ');

define('TEXT_NEW_ORDERS_ID', 'Neue Bestellnummer');
define('TEXT_INFO_SET_NEXT_ORDER_NUMBER', '<strong>Legen Sie hier Ihre nächste Bestellnummer fest</strong><br>HINWEIS: Ihre neue Bestellnummer muss größer sein als die bereits bestehenden Bestellungen in Ihrer Datenbank.');
define('TEXT_MSG_NEXT_ORDER', 'Ihre nächste Bestellnummer wurde ist %s');
define('TEXT_MSG_NEXT_ORDER_MAX', 'Basierend auf den bestehenden Bestellungen ist Ihre nächste Bestellnummer momentan: %s');
define('TEXT_MSG_NEXT_ORDER_TOO_LARGE', 'Aufgrund des Datenbanklimits können Sie keine Bestellnummer höher als 2000000000 einstellen. Bitte wählen Sie einen kleineren Wert.');



define('TEXT_INFO_DATABASE_OPTIMIZE', '<strong>Datenbank optimieren</strong> um vergeudeten Raum von gelöschten Aufzeichnungen zu entfernen.<br>Das kann monatlich oder wöchentlich auf einer frequentierten Datenbank erforderlich sein.<br>(Am besten während der nichtaktiven Zeiten die Optimierung laufen lassen.)');
define('TEXT_INFO_OPTIMIZING_DATABASE_TABLES', 'Datenbank Tabellen Optimierung läuft. Die kann eine paar Minuten dauern, bitte warten Sie. Das vorherige Menü erscheint, sobald dieser Vorgang abgeschlossen ist ... ');
define('SUCCESS_DB_OPTIMIZE', 'Datenbank-Optimierung - Tabellen verarbeiten: ');

define('TEXT_INFO_PURGE_DEBUG_LOG_FILES', '<strong>Debug Logfiles löschen</strong><br><strong>VORSICHT: </strong>Zen-Cart schreibt PHP Fehlermeldungen zum Debuggen in den Ordner cache. Ebenso können viele Zahlungsmodule (z.B. PayPal) mit dem Schreiben von Logfiles konfiguriert sein.<br>Wenn Sie diesen Löschen Button betätigen, dann werden ALLE Debug Logfiles, die im Ordner cache oder in den cache Ordnern der jeweiligen Zahlungsmodule liegen UNWIDERRUFLICH gelöscht.');
define('SUCCESS_CLEAN_DEBUG_FILES', 'Debug Log Files gelöscht');