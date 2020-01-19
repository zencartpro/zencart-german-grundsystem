<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: products_to_categories.php 2020-01-19 20:37:14Z webchills $
 */

define('HEADING_TITLE', 'Artikel in mehrere Kategorien verlinken');
define('HEADING_TITLE2', 'Kategorien / Artikel');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorien mit verlinkbaren Artikeln ...');
define('TABLE_HEADING_PRODUCTS_ID', 'Artikel ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');

define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'Verlinkte Artikel bearbeiten');
define('TEXT_PRODUCTS_ID', 'Artikel ID ');
define('TEXT_PRODUCTS_NAME', 'Artikel: ');

define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Kategorie Links aktualisieren');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Aderen Artikel nach ID# wählen');
define('BUTTON_CATEGORY_LISTING', 'Kategorie Auflistung');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Zeige Artikel - Kategorie Links für: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Aktuelle Anzahl verlinkter Kategorien: ');

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globale Kategorie Tools');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', 'Dieser Artikel ist derzeit zu den unten ausgewählten Kategorien verlinkt.<br>Um Verlinkungen hinzuzufügen oder wegzunehmen, kreuzen Sie die entsprechenden Checkboxen an oder deselektieren Sie sie und clicken dann auf den ' . BUTTON_UPDATE_CATEGORY_LINKS . ' Button.<br />Weitere Aktionen für Artikel in Kategorien sind verfügbar über die Funktion ' . HEADER_CATEGORIES_GLOBAL_CHANGES . ' unten.');

define('TEXT_INFO_MASTER_CATEGORY_CHANGE','Ein Artikel hat immer eine Hauptkategorie ID (Master Category ID) für die Bepreisung. Sie gibt an in welcher Kategorie sich dieser Artikel grundsätlich befindet. Zusätzlich kann ein Artikel in unbegrenzt viele andere Kategorien verlinkt werden.<br>The Master Category ID can be changed by using this Master Category dropdown, that offers the currently linked categories as possible alternatives.<br>To set the Master Category ID to <strong>any</strong> category, use the "Move" option on the category listing page.');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>ACHTUNG:</strong> Sie müssen die Hauptkategorie-ID ändern bevor verlinkte Kategorien verändert werden!');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Verlinke Artikel von einer Kategorie in eine andere Kategorie');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet dass ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere ALLE Artikel einer Kategorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Mit Kategorie verlinken: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere Artikel als verlinke Artikel ');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Artikel wurde zurückgesetzt und ist nicht mehr Teil dieser Kategorie  ...');
define('WARNING_CATEGORY_REF_NOT_EXIST','<strong>HERKUNFT</strong> Kategorie ID#%u ungültig (existiert nicht)');
define('WARNING_CATEGORY_TARGET_NOT_EXIST','<strong>ZIEL</strong> Kategorie ID#%u ungültig (existiert nicht)');
define('WARNING_CATEGORY_IDS_DUPLICATED', 'Warnung: gleiche Kategorie IDs (#%u)');
define('WARNING_CATEGORY_NO_PRODUCTS', '<strong>HERKUNFT</strong> Kategorie ID#%u ungültig (enthält keine Artikel)');
define('WARNING_CATEGORY_SUBCATEGORIES', '<strong>ZIEL</strong> Kategorie ID#%u ungültig (enthält Unterkategorien)');
define('WARNING_NO_CATEGORIES_ID', 'Warnung: keine Kategorien ausgewählt ... keine Änderungen durchgeführt');
define('SUCCESS_COPY_LINKED', '%1$u Artikel kopiert (verlinkt), von HERKUNFT Kategorie ID#%2$u zu ZIEL Kategorie ID#%3$u');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED_MISSING', 'WARNUNG: Copy completed to Invalid Category to Link: ');

define('WARNING_COPY_FROM_IN_TO_LINKED', 'WARNUNG: Keine Artikel kopiert (alle Artikel in Kategorie ID#%1$u sind bereits verlinkt in Kategorie ID#%2$u');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Entferne verlinkte Artikel aus einer Kategorie');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere alle Artikel einer Kategorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne Link zu Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Entferne verlinkte Artikel');

define('SUCCESS_REMOVE_LINKED', ' %1$uVerlinkte Artikel erfolgreich entfernt aus Kategorie ID#%2$u');
define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine Änderungen gemacht, keine Artikel verlinkt ... </strong>');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>ACHTUNG: HAUPTKATEGORIE-ID KONFLIKT!! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>Hauptkategorie ID ist: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', 'Anmerkung: Die Hauptkategorie wird zur Preisberechnung bei verlinkten Artikeln verwendet. z.B. Sonderangebote <br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'Um dieses Problem zu beheben werden Sie zu dem ersten Artikel, der das Problem verursacht hat, weitergeleitet. Weisen Sie eine neue Hauptkategorie-ID zu, damit die Kategorie welche Sie versuchen zu entfernen, nicht läger die Hauptkategorie für diesen Artikel ist. Erst wenn alle Konflikte behoben sind kann das Löschen ausgeführt werden.');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' Widersprüchliche  Quellkategorie: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' Widersprüchliche  Zielkategorie: ');
define('SUCCESS_MASTER_CATEGORIES_ID', 'Erfolgreiche Aktualisierung Artikel zu Kategorie Links ...');
define('WARNING_MASTER_CATEGORIES_ID', 'WARNUNG: Keine Hauptkategorie gesetzt!');
define('TEXT_PRODUCTS_ID_INVALID', 'WARNUNG: UNGÜLTIGE ARTIKEL-ID ODER KEIN ARTIKEL AUSGEWÄHLT');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', 'Anmerkung: Eine Artikel-ID wird nicht unbedingt benötigt um alle Artikel einer Kategorie in eine andere Kategorie zu linken.<br />Allerdings werden bei gesetzter Artikel ID alle verfügbaren Kategorien und deren ID angezeigt.');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER_HEADING', 'Hauptkategorie ID für ALLE Artikel in einer Kategorie zurücksetzen');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der ausgewählten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zurücksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als Haupt Kategorie-ID verwenden');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Rücksetzen der Hauptkategorie-ID für ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Hauptkategorie-ID zurücksetzen');

define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Erfolgreiche Aktualisierung der Hauptkategorie-ID für alle Artikel der Kategorie: ');

define('TEXT_CATEGORIES_NAME', 'Kategorie Name');