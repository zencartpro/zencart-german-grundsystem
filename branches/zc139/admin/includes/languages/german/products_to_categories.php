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

define('HEADING_TITLE', 'Artikel in mehreren Kategorien anzeigen - Link Manager ...');
define('HEADING_TITLE2', 'Kategorien / Artikel');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'Kategorien mit verlinkbaren Artikeln ...');
define('TABLE_HEADING_PRODUCTS_ID', 'Artikel ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');
define('TABLE_HEADING_MODEL', 'Bezeichnung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', 'ARTIKEL ZU KATEGORIE INFORMATIONEN EDITIEREN');
define('TEXT_PRODUCTS_ID', 'Artikel ID ');
define('TEXT_PRODUCTS_NAME', 'Artikel: ');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer: ');
define('TEXT_PRODUCTS_PRICE', 'Preis: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'Kategorie Links aktualisieren');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'Artikel verlinken');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'Setze Artikel - Kategorie Links für: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;Aktuelle Anzahl verlinkter Kategorien: ');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
    'Artikel in mehreren Kategorien anzeigen - Link Manager wurde entwickelt um schnell einen Artikel mit ein oder mehreren anderen Kategorien verlinken zu können.<br />Es können auch alle Artikel einer Kategorie mit einer anderen Kategorie verlinkt werden. Selbstverständlich können bestehende Links mit dieses Tool wieder gelöscht werden. (siehe Information nächster Punkt)');
define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER',
    'Zur Preisberechnung muss jeder Artikel einer Hauptkategorie zugewiesen sein, unabhängig davon mit wievielen anderen Kategorien dieser verlinkt ist. Verwenden Sie dazu das Dropdown Feld "Hauptkategorie".<br />
Der Artikel ist aktuell folgenden Kategorien zugewiesen (siehe Checkbox). Einfach Checkbox neben Kategorienamen selektieren bzw. deselektiern um Verlinkung hinzu zu fügen bzw. zu löschen.<br />
Zum Speichern den Button ' . BUTTON_UPDATE_CATEGORY_LINKS . ' drücken.<br />'
    );
define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'Globale Kategorie-Link Änderungen und Hauptkategorie-ID Reset');
define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>ACHTUNG:</strong> Hauptkategorie-ID änderen bevor verlinkte Kategorien verändert werden!');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Kopiere ALLE Artikel einer Kategorie als VERLINKTE Artikel in eine andere ...</strong><br />z.B. 8 und 22 bedeutet das ALLE Artikel in Kategorie 8 zu Kategorie 22 verlinkt werden');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere ALLE Artikel einer Kategorie: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Mit Kategorie verlinken: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'Kopiere Artikel als verlinke Artikel ');
define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', 'WARNUNG: Artikel wurde zurückgesetzt und ist nicht mehr Teil dieser Kategorie  ...');
define('WARNING_COPY_LINKED', 'WARNUNG: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Ungültige Kategorie um Artikel aus Kategorie zu verlinken: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Ungültige Kategorie um Artikel in Kategorie zu verlinken: ');
define('WARNING_NO_CATEGORIES_ID', 'Warnung: Keine Kategorie ausgewählt ... keine Änderung gemacht');
define('SUCCESS_COPY_LINKED', 'Erfolgreiche Aktualisierung der verlinkten Artikel ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Artikel aus folgender Kategorie verlinken: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Artikel in folgende Kategorie verlinken: ');
define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>WARNUNG: Keine Änderungen durchgeführt - Artikel bereits verlinkt ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>Entferne ALLE VERLINKTEN Artikel einer Kategorie ...</strong><br />z.B. Bei 8 und 22 werden ALLE Artikel-Links zu Kategorie 22 in Kategorie 8 entfernt');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Selektiere Alle Artikel einer Kategorie: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Entferne Link zu Kategorie: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'Entferne verlinkte Artikel');
define('WARNING_REMOVE_LINKED', 'WARNUNG: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Nicht möglich Artikel aus folgender Kategorie zu verlinken: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Nicht möglich Artikel in diese Kategorie zu verlinken: ');
define('SUCCESS_REMOVE_LINKED', 'Verlinkte Artikel erfolgreich entfernt ... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'Verlinkte Artikel aus Kategorie löschen: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'Verlinkte Artikel in diese Kategorie löschen: ');
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
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>ALLE Artikel in der ausgewählten Kategorie sollen diese als Hauptkategorie verwenden ...</strong><br />z.B: Kategorie 22 zurücksetzen bedeutet, dass ALLE Produkte in Kategorie 22, diese als HauptKategorie-ID verwenden');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Rücksetzen der Hauptkategorie-ID für ALLE Artikel in Kategorie: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'Hauptkategorie-ID zurücksetzen');
define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'WARNUNG: Unzulässige Kategorie ausgewählt ...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'Erfolgreiche Aktualisierung der Hauptkategorie-ID für alle Artikel der Kategorie: ');
