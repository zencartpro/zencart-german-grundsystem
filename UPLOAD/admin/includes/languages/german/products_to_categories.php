<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: products_to_categories.php 2020-07-09 11:37:14Z webchills $
 */

define('HEADING_TITLE', 'Artikel in mehreren Kategorien anzeigen');
define('HEADING_TITLE2', 'Kategorien / Artikel');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorien mit verlinkbaren Artikeln ...');

define('TABLE_HEADING_PRODUCTS_ID', 'Artikel ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'ARTIKEL ZU KATEGORIE INFORMATIONEN EDITIEREN');
define('TEXT_PRODUCTS_ID', 'Artikel ID ');
define('TEXT_PRODUCTS_NAME', 'Artikel: ');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer: ');
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Kategorie Links aktualisieren');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'anderen Artikel wählen nach ID#');
define('BUTTON_CATEGORY_LISTING', 'Kategorie Liste');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Zeige Artikel - Kategorie Links für: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Aktuelle Anzahl verlinkter Kategorien: ');

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Global Category Tools');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', 'This product is currently linked to the categories selected below.<br>To add/remove links, select/deselect the checkboxes as required and then click on the ' . BUTTON_UPDATE_CATEGORY_LINKS . ' button.<br />Further product/category actions are available using the ' . HEADER_CATEGORIES_GLOBAL_CHANGES . ' below.');

define('TEXT_INFO_MASTER_CATEGORY_CHANGE','A product has a Master Category ID (for pricing purposes) that can be considered as the category where the product actually resides. Additionally, a product can be linked (copied) to any number of other categories.<br>The Master Category ID can be changed by using this Master Category dropdown, that offers the currently linked categories as possible alternatives.<br>To set the Master Category ID to <strong>any</strong> category, use the "Move" option on the category listing page.');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>WARNING:</strong> You must set the MASTER CATEGORIES ID before changing Linked Categories');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Link (copy) Products from one Category to another Category');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet das ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere ALLE Artikel einer Kategorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Mit Kategorie verlinken: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere Artikel als verlinke Artikel ');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Artikel wurde zurückgesetzt und ist nicht mehr Teil dieser Kategorie  ...');

define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Ungültige Kategorie um Artikel aus Kategorie zu verlinken: ');
define('WARNING_CATEGORY_TARGET_NOT_EXIST','<strong>TARGET</strong> Category ID#%u invalid (does not exist)');
define('WARNING_CATEGORY_IDS_DUPLICATED', 'Warning: same Category IDs (#%u)');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Ungültige Kategorie um Artikel in Kategorie zu verlinken: ');
define('WARNING_NO_CATEGORIES_ID', 'WARNUNG: Keine Kategorie ausgewählt ... keine Änderung gemacht');
define('SUCCESS_COPY_LINKED', 'Erfolgreiche Aktualisierung der verlinkten Artikel ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Artikel aus folgender Kategorie verlinken: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Artikel in folgende Kategorie verlinken: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED_MISSING', 'WARNUNG: Ungültige/Fehlende Kategorie um Artikel in Kategorien zu verlinken: ');
define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine Änderungen durchgeführt - Artikel bereits verlinkt ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Remove Linked Products from a Category');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere Alle Artikel einer Kategorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne Link zu Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Remove Linked Products');

define('SUCCESS_REMOVE_LINKED', '%1$u linked product(s) removed from Category ID#%2$u');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', 'WARNING: No changes made: no products in TARGET Category ID#%1$u are linked from REF Category ID#%2$u');
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
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER_HEADING', 'Reset the Master Category ID for ALL Products in a Category');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der ausgewählten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zurücksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als HauptKategorie-ID verwenden');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Rücksetzen der Hauptkategorie-ID für ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Hauptkategorie-ID zurücksetzen');

define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Erfolgreiche Aktualisierung der Hauptkategorie-ID für alle Artikel der Kategorie: ');

define('TEXT_CATEGORIES_NAME', 'Kategorie Name');