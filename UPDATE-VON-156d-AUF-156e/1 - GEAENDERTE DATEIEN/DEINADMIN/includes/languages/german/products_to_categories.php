<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: products_to_categories.php 2020-07-10 08:37:14Z webchills $
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
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Kategorie Links aktualisieren');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'anderen Artikel wählen nach ID#');
define('BUTTON_CATEGORY_LISTING', 'Kategorie Liste');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Zeige Artikel - Kategorie Links für: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Aktuelle Anzahl verlinkter Kategorien: ');

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globale Kategorie Tools');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO', 'Dieser Artikel ist derzeit mit den unten ausgewählten Kategorien verlinkt.<br> Um Links hinzuzufügen/zu entfernen, aktivieren/deaktivieren Sie die Kontrollkästchen nach Bedarf und klicken Sie dann auf die  ' . BUTTON_UPDATE_CATEGORY_LINKS . ' Schaltfläche.<br />Weitere Produkt-/Kategorie-Aktionen sind über die Schaltfläche ' . HEADER_CATEGORIES_GLOBAL_CHANGES . ' unten verfügbar.');

define('TEXT_INFO_MASTER_CATEGORY_CHANGE','Ein Artikel hat eine Master-Kategorie-ID (zu Preisfindungszwecken), die als die Kategorie angesehen werden kann, in der sich der Artikel tatsächlich befindet. Darüber hinaus kann ein Artikel mit einer beliebigen Anzahl anderer Kategorien verknüpft (verlinkt) werden.<br>Die Hauptkategorie-ID kann geändert werden, indem Sie diese Hauptkategorien-Dropdown-Liste verwenden, die die derzeit verknüpften Kategorien als mögliche Alternativen anbietet.<br>Um die Hauptkategorie-ID auf <strongk>eine</strong> Kategorie zu setzen, verwenden Sie die Option "Verschieben" auf der Seite mit der Auflistung der Kategorien.');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>WARNUNG:</strong> Sie müssen erst die MASTER KATEGORIE ID ändern bevor Sie verlinkte Kategorien ändern.');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Verlinke Artikel von einer Kategorie zu einer anderen Kategorie');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet das ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere ALLE Artikel einer Kategorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Mit Kategorie verlinken: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere Artikel als verlinke Artikel ');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Artikel wurde zurückgesetzt und ist nicht mehr Teil dieser Kategorie  ...');

define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Ungültige Kategorie um Artikel aus Kategorie zu verlinken: ');
define('WARNING_CATEGORY_TARGET_NOT_EXIST','<strong>ZIEL</strong> Kategorie ID#%u ungültig (existiert nicht)');
define('WARNING_CATEGORY_IDS_DUPLICATED', 'Warnung: dieselben Kategorie IDs (#%u)');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Ungültige Kategorie um Artikel in Kategorie zu verlinken: ');
define('WARNING_NO_CATEGORIES_ID', 'WARNUNG: Keine Kategorie ausgewählt ... keine Änderung gemacht');
define('SUCCESS_COPY_LINKED', 'Erfolgreiche Aktualisierung der verlinkten Artikel ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Artikel aus folgender Kategorie verlinken: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Artikel in folgende Kategorie verlinken: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED_MISSING', 'WARNUNG: Ungültige/Fehlende Kategorie um Artikel in Kategorien zu verlinken: ');
define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine Änderungen durchgeführt - Artikel bereits verlinkt ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED_HEADING', 'Entferne verlinkte Artikel aus einer Kategorie');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere Alle Artikel einer Kategorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne Link zu Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Entferne verlinkte Artikel');

define('SUCCESS_REMOVE_LINKED', '%1$u verlinkte Artikel entfernt aus Kategorie ID#%2$u');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', 'WARNUNG: keine Änderungen durchgeführt: keine Artikel in ZIEL Kategorie ID#%1$u sind verlinkt aus HERKUNFT Kategorie ID#%2$u');
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
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER_HEADING', 'Master Kategorie ID für ALLE Artikel in einer Kategorie zurücksetzen');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der ausgewählten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zurücksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als HauptKategorie-ID verwenden');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Rücksetzen der Hauptkategorie-ID für ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Hauptkategorie-ID zurücksetzen');

define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Erfolgreiche Aktualisierung der Hauptkategorie-ID für alle Artikel der Kategorie: ');

define('TEXT_CATEGORIES_NAME', 'Kategorie Name');