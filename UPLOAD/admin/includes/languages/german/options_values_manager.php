<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: options_values_manager.php 2022-04-17 16:00:14Z webchills $
 */


define('HEADING_TITLE_OPT', 'Artikeloptionen');
define('HEADING_TITLE_VAL', 'Attributmerkmale');
define('HEADING_TITLE_ATRIB', 'Artikelattribute');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');
define('TABLE_HEADING_OPT_NAME', 'Attributname');
define('TABLE_HEADING_OPT_VALUE', 'Attributmerkmal');
define('TABLE_HEADING_OPT_PRICE', 'Preis');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Präfix');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_DOWNLOAD', 'Download-Artikel');
define('TABLE_TEXT_FILENAME', 'Dateiname:');
define('TABLE_TEXT_MAX_DAYS', 'Ablauftage:');
define('TABLE_TEXT_MAX_COUNT', 'Maximale Download-Anzahl:');
define('TEXT_WARNING_OF_DELETE', '<span class="alert">Diese Option ist Artikel und Optionen zugewiesen - ein Löschen wird nicht empfohlen.</span>');
define('TEXT_OK_TO_DELETE', 'Diese Option ist keinen Artikeln und keinen Optionen zugewiesen und kann gelöscht werden.');
define('TEXT_OPTION_ID', 'Option ID');
define('TEXT_OPTION_NAME', 'Attributname');

define('ATTRIBUTE_WARNING_DUPLICATE', 'Hinzufügen nicht möglich - Attribut ist bereits vorhanden');

define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE', 'Änderung nicht möglich - Attribut ist bereits vorhanden');

define('ATTRIBUTE_WARNING_INVALID_MATCH', 'Attribut konnte nicht erstellt werden - Attributoption und Attributmerkmal stimmen nicht überein');

define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE', 'Attribut konnte nicht geändert werden - Attributoption und Attributmerkmal stimmen nicht überein');

define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE', 'Möglicherweise wurde ein doppelter Attributname hinzugefügt');

define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE', 'Möglicherweise wurde ein doppeltes Attributmerkmal hinzugefügt');


define('PRODUCTS_ATTRIBUTES_EDITING', 'BEARBEITE');

define('PRODUCTS_ATTRIBUTES_DELETE', 'LÖSCHE');

define('PRODUCTS_ATTRIBUTES_ADDING', 'FÜGE NEUES ATTRIBUT HINZU');

define('TEXT_DOWNLOADS_DISABLED', 'HINWEIS: Downloads sind deaktiviert');
define('TABLE_TEXT_MAX_DAYS_SHORT', 'Tage:');
define('TABLE_TEXT_MAX_COUNT_SHORT', 'Maximal:');
define('TABLE_HEADING_OPTION_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER', 'Standardsortierung');
define('TEXT_SORT', 'Sortierung:');
define('TABLE_HEADING_OPT_WEIGHT_PREFIX', 'Präfix');
define('TABLE_HEADING_OPT_WEIGHT', 'Gewicht');
define('TABLE_HEADING_OPT_SORT_ORDER', 'Sortierung');


define('TABLE_HEADING_OPT_TYPE', 'Optionsart');

define('TABLE_HEADING_OPTION_VALUE_SIZE', 'Größe');
define('TABLE_HEADING_OPTION_VALUE_MAX', 'Maximal');

define('TEXT_OPTION_VALUE_COMMENTS', 'Kommentare:');
define('TEXT_OPTION_VALUE_SIZE', 'Darstellungsgröße:');
define('TEXT_OPTION_VALUE_MAX', 'Maximale Länge:');
define('TEXT_ATTRIBUTES_IMAGE', 'Muster des Attributsbildes:');
define('TEXT_ATTRIBUTES_IMAGE_DIR', 'Verzeichnis des Attributsbildes:');
define('TEXT_ATTRIBUTES_FLAGS', 'Attributs-<br>kennzeichen:');
define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Nur zur<br>Darstellung benötigt:');
define('TEXT_ATTRIBUTES_IS_FREE', 'Attribut ist kostenlos<br>wenn der Artikel kostenlos ist:');
define('TEXT_ATTRIBUTES_DEFAULT', 'Attribut, welches standardmäßig<br>markiert werden soll:');
define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Rabatte verwenden die vom<br>Artikel verwendet werden:');
define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Inklusive Grundpreis<br>wenn Preis durch Attribute bestimmt wird:');
define('TEXT_PRODUCT_OPTIONS_INFO', 'Für weitere Einstellungen bitte Artikeloptionen bearbeiten');

// Option Names/Values copier from one to another
define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>ALLE Attribute kopieren, bei denen Optionsname und Wert...</strong>');
define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Wählen Sie einen Optionsnamen und einen Wert aus, der bereits in einem (oder mehreren Artikel) existiert, über den Sie dann einen anderen Optionsnamen und Wert auf ALLEN Artikel mit dem vorhandenen Optionsnamen und Wert kopieren möchten');
define('TEXT_SELECT_OPTION_FROM', 'Abzugleichender Optionsname:');
define('TEXT_SELECT_OPTION_VALUES_FROM', 'Abzugleichender Optionswert:');
define('TEXT_SELECT_OPTION_TO', 'Hinzuzufügender Optionsname:');
define('TEXT_SELECT_OPTION_VALUES_TO', 'Hinzuzufügender Optionswert:');
define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', 'leeres Feld = ALLE Artikel, oder<br>geben Sie eine Kategorie ID für die zu aktualisierenden Artikel an');

// Option Name/Value to Option Name for Category with Product defaults
define('TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>Kopiere Optionsname u. Wert zu Artikel mit einem bestimmten Optionsnamen ...</strong>');
define('TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', 'Selektieren Sie einen Optionsnamen und Wert der aktuell einem Produkt/Produkte zugeordnet ist, damit sie diese Information einer Kategorie od. allen Artikeln zuweisen können die einen bestimmten Optionsnamen besitzen.
                                                 <br><strong>z.B.:</strong> Hinzufügen Optionsname: Color, Optionswert: Red, zu allen Artikeln mit dem Optionsnamen: Size
                                                 <br><strong>z.B.:</strong> Hinzufügen Optionsname: Color, Optionswert: Red, mit default Werten von Artikel-ID: 34 zu allen Artikeln mit dem Optionsnamen: Size
                                                 <br><strong>z.B.:</strong> Hinzufügen Optionsname: Color, Optionswert: Red, mit default Werten von Artikel-ID: 34 zu allen Artikeln mit dem Optionsnamen: Size fü Kategorie ID: 65
      ');
define('TEXT_SELECT_OPTION_TO_ADD_TO', 'mit Optionsname:');
define('TEXT_SELECT_OPTION_FROM_ADD', 'Optionsname hinzufügen:');
define('TEXT_SELECT_OPTION_VALUES_FROM_ADD', 'Optionswert hinzufügen:');
define('TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', 'Default Optionswerte von Artikel ID# nehmen oder Feld leer lassen:');
define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie soll mit bereits existierenden Artikelattributen verfahren werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', 'Existierende Attribute <strong>löschen</strong>, und dann kopieren');
define('TEXT_COPY_ATTRIBUTES_UPDATE', 'Existierende Attribute mit neuen Werten <strong>aktualisieren</strong>');
define('TEXT_COPY_ATTRIBUTES_IGNORE', 'Existierende Attribute <strong>ignorieren</strong> und neue hinzufügen');
define('TEXT_INFO_FROM', ' von: ');
define('TEXT_INFO_TO', ' nach: ');
define('ERROR_OPTION_VALUES_COPIED', 'FEHLER: Doppelter Optionsname und Optionswert');
define('ERROR_OPTION_VALUES_COPIED_MISMATCH', 'FEHLER: Ausgewählter Optionsname und Optionswert stimmen nicht überein');
define('ERROR_OPTION_VALUES_NONE', 'FEHLER: Nichts zum Kopieren gefunden');
define('SUCCESS_OPTION_VALUES_COPIED', 'Kopieren erfolgreich! ');
define('ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', 'FEHLER: kein Optionsname/-wert für Artikel-Nr:');
define('TEXT_OPTION_VALUE_DELETE_ALL', '<strong>ALLE Attribute löschen, bei denen Optionsname und Wert...</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Wählen Sie einen Optionsnamen und einen Wert aus, der bereits in einem (oder mehreren Artikel) existiert, den Sie aus ALLEN Artikel bzw. aus ALLEN Artikel einer Kategorie löschen möchten');
define('TEXT_SELECT_DELETE_OPTION_FROM', 'Abzugleichender Optionsname:');
define('TEXT_SELECT_DELETE_OPTION_VALUES_FROM', 'Abzugleichender Optionswert:');
define('ERROR_OPTION_VALUES_DELETE_MISMATCH', 'FEHLER: Ausgewählter Optionsname und Optionswert stimmen nicht überein');
define('SUCCESS_OPTION_VALUES_DELETE', 'Erfolgreich gelöscht: ');
define('LABEL_FILTER', 'Optionswert zum Filtern wählen');
define('TEXT_DISPLAY_NUMBER_OF_OPTION_VALUES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Optionswerten)');
define('TEXT_SHOW_ALL', 'Zeige alle');