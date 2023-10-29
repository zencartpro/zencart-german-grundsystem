<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: options_values_manager.php 2023-10-29 14:49:16Z webchills $
 */



define('HEADING_TITLE_ATRIB', 'Artikelattribute');

define('TABLE_HEADING_DOWNLOAD', 'Download-Artikel');
define('TABLE_TEXT_FILENAME', 'Dateiname:');
define('TABLE_TEXT_MAX_DAYS', 'Ablauftage:');
define('TABLE_TEXT_MAX_COUNT', 'Maximale Download-Anzahl:');
define('TEXT_WARNING_OF_DELETE', '<span class="alert">Diese Option ist Artikel und Optionen zugewiesen - ein Löschen wird nicht empfohlen.</span>');
define('TEXT_OK_TO_DELETE', 'Diese Option ist keinen Artikeln und keinen Optionen zugewiesen und kann gelöscht werden.');




define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE_SPECIFIC', 'Möglicherweise wurde ein doppeltes Attributmerkmal hinzugefügt: : "<b>%1$s</b>" %2$s für Attributname "%3$s" (values ids: %4$s)');




define('TEXT_DOWNLOADS_DISABLED', 'HINWEIS: Downloads sind deaktiviert');
define('TABLE_TEXT_MAX_DAYS_SHORT', 'Tage:');
define('TABLE_TEXT_MAX_COUNT_SHORT', 'Maximal:');



  define('TEXT_SORT',' Sortierung: ');



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

define('TEXT_PRODUCT_OPTIONS_INFO', 'Für weitere Einstellungen bitte Artikeloptionen bearbeiten');


define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>ALLE Attribute kopieren, bei denen Optionsname und Wert...</strong>');
define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Wählen Sie einen Optionsnamen und einen Wert aus, der bereits in einem (oder mehreren Artikel) existiert, über den Sie dann einen anderen Optionsnamen und Wert auf ALLEN Artikel mit dem vorhandenen Optionsnamen und Wert kopieren möchten');
define('TEXT_SELECT_OPTION_FROM', 'Abzugleichender Optionsname:');
define('TEXT_SELECT_OPTION_VALUES_FROM', 'Abzugleichender Optionswert:');
define('TEXT_SELECT_OPTION_TO', 'Hinzuzufügender Optionsname:');
define('TEXT_SELECT_OPTION_VALUES_TO', 'Hinzuzufügender Optionswert:');
define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', 'leeres Feld = ALLE Artikel, oder<br>geben Sie eine Kategorie ID für die zu aktualisierenden Artikel an');


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