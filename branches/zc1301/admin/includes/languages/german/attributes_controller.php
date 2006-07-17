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
//  $Id: attributes_controller.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('HEADING_TITLE', 'Kategorie: '); // new 1.3.0  

define('HEADING_TITLE_OPT','Artikelattribute');
define('HEADING_TITLE_VAL','Attributmerkmale');
define('HEADING_TITLE_ATRIB','Attributmanager');
define('HEADING_TITLE_ATRIB_SELECT','Um sich Attributoptionen eines Artikels anzeigen zu lassen, w&auml;hlen Sie bitte einen Artikel aus ...');

define('TEXT_PRICES_AND_WEIGHTS', 'Preise und Gewicht');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR', 'Preisfaktor: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET', 'Offset: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_ONETIME', 'einmalig:');

define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME', 'einmaliger Faktor: ');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET_ONETIME', 'Offset: ');

define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES', 'Mengenrabatt Attribute:');
define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME', 'Einmalige Mengenrabatt Attribute:');

define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS', 'Preis pro Wort:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS_FREE', '- Freie W&ouml;rter:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS', 'Preis pro Buchstabe:');
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS_FREE', '- Freie Buchstaben:');

define('TABLE_HEADING_ID','ID');
define('TABLE_HEADING_PRODUCT','Artikelname');
define('TABLE_HEADING_OPT_NAME','Attributname');
define('TABLE_HEADING_OPT_VALUE','Attributmerkmal');
define('TABLE_HEADING_OPT_PRICE','Preis');
define('TABLE_HEADING_OPT_PRICE_PREFIX','Pr&auml;fix');
define('TABLE_HEADING_ACTION','Aktion');
define('TABLE_HEADING_DOWNLOAD','Downloadartikel');
define('TABLE_TEXT_FILENAME','Dateiname:');
define('TABLE_TEXT_MAX_DAYS','Ablauftage:');
define('TABLE_TEXT_MAX_COUNT','Maximale Downloadanzahl:');
define('TABLE_HEADING_OPT_DISCOUNTED','Rabatt');
define('TABLE_HEADING_PRICE_BASE_INCLUDED','Basis');
define('TABLE_HEADING_PRICE_TOTAL', 'Summe|Disc: einmalig:');
define('TEXT_WARNING_OF_DELETE','Diese Option ist Artikel und Optionen zugewiesen - ein L&ouml;schen wird nicht empfohlen.');
define('TEXT_OK_TO_DELETE','Diese Option ist keinen Artikeln und keinen Optionen zugewiesen und kann gel&ouml;scht werden.');
define('TEXT_OPTION_ID','Attribut ID');
define('TEXT_OPTION_NAME','Attributname');

define('ATTRIBUTE_WARNING_DUPLICATE','Hinzuf&uuml;gen nicht m&ouml;glich - Attribut ist bereits vorhanden'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','Änderung nicht m&ouml;glich - Attribut ist bereits vorhanden'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_INVALID_MATCH','Attribut konnte nicht erstellt werden - Attributoption und Attributmerkmal stimmen nicht &uuml;berein'); // miss matched option and options value
define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','Attribut konnte nicht ge&auml;ndert werden - Attributoption und Attributmerkmal stimmen nicht &uuml;berein'); // miss matched option and options value
define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','M&ouml;glicherweise wurde ein doppelter Attributname hinzugef&uuml;gt'); // Options Name Duplicate warning
define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','M&ouml;glicherweise wurde ein doppeltes Attributmerkmal hinzugef&uuml;gt'); // Options Value Duplicate warning

define('PRODUCTS_ATTRIBUTES_EDITING','BEARBEITE'); // title
define('PRODUCTS_ATTRIBUTES_DELETE','LÖSCHE'); // title
define('PRODUCTS_ATTRIBUTES_ADDING','FÜGE NEUES ATTRIBUT HINZU'); // title
define('TEXT_DOWNLOADS_DISABLED','Hinweis: Downloads sind deaktiviert');

define('TABLE_TEXT_MAX_DAYS_SHORT','Tage:');
define('TABLE_TEXT_MAX_COUNT_SHORT','Maximal:');

define('TABLE_HEADING_OPTION_SORT_ORDER','Sortierreihenfolge');
define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','Standardsortierung');
define('TEXT_SORT','Sortierung:');

define('TABLE_HEADING_OPT_WEIGHT_PREFIX','Pr&auml;fix');
define('TABLE_HEADING_OPT_WEIGHT','Gewicht');
define('TABLE_HEADING_OPT_SORT_ORDER','Sortierung');
define('TABLE_HEADING_OPT_DEFAULT','Standard');

define('TABLE_HEADING_OPT_TYPE','Optionsart'); //CLR 031203 add option type column
define('TABLE_HEADING_OPTION_VALUE_SIZE','Gr&ouml;&szlig;e');
define('TABLE_HEADING_OPTION_VALUE_MAX','Maximal');
define('TABLE_HEADING_OPTION_VALUE_ROWS','Reihen');
define('TABLE_HEADING_OPTION_VALUE_COMMENTS','Kommentare');

define('TEXT_OPTION_VALUE_COMMENTS','Kommentare:');
define('TEXT_OPTION_VALUE_SIZE','Darstellungsgr&ouml;&szlig;e:');
define('TEXT_OPTION_VALUE_MAX','Maximale L&auml;nge:');

define('TEXT_ATTRIBUTES_IMAGE','Muster des Attributsbildes:');
define('TEXT_ATTRIBUTES_IMAGE_DIR','Verzeichnis des Attributsbildes:');

define('TEXT_ATTRIBUTES_FLAGS','Attributs-<br />kennzeichen:');
define('TEXT_ATTRIBUTES_DISPLAY_ONLY','Nur zur<br />Darstellung ben&ouml;tigt:');
define('TEXT_ATTRIBUTES_IS_FREE','Attribut ist kostenlos<br />wenn der Artikel kostenlos ist:');
define('TEXT_ATTRIBUTES_DEFAULT','Attribut, welches standardm&auml;&szlig;ig<br />markiert werden soll:');
define('TEXT_ATTRIBUTE_IS_DISCOUNTED','Rabatte verwenden die vom<br />Artikel verwendet werden:');
define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','Basispreis inkludieren<br />bei "Preis per Attribut:');
define('TEXT_ATTRIBUTES_REQUIRED', 'Attribute ben&ouml;tigt<br />f&uuml;r Text:');

define('LEGEND_BOX', 'Legende:');
define('LEGEND_KEYS', 'AUS/AN');
define('LEGEND_ATTRIBUTES_DISPLAY_ONLY', 'Nur anzeigen');
define('LEGEND_ATTRIBUTES_IS_FREE', 'Frei');
define('LEGEND_ATTRIBUTES_DEFAULT', 'Standard');
define('LEGEND_ATTRIBUTE_IS_DISCOUNTED', 'erm&auml;&szlig;igt');
define('LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED', 'Grundpreis');
define('LEGEND_ATTRIBUTES_REQUIRED', 'ben&ouml;tigt');
define('LEGEND_ATTRIBUTES_IMAGES', 'Bilder');
define('LEGEND_ATTRIBUTES_DOWNLOAD', 'G&uuml;ltiger/Ung&uuml;ltiger<br />Dateiname');

define('TEXT_ATTRIBUTES_UPDATE_SORT_ORDER','Zur Standardsortierung');
define('TEXT_PRODUCTS_LISTING','Artikelliste f&uuml;r:');
define('TEXT_NO_PRODUCTS_SELECTED','Kein Artikel ausgew&auml;hlt');
define('TEXT_NO_ATTRIBUTES_DEFINED','Kein Attribut f&uuml;r Artikel ID# gew&auml;hlt');

define('TEXT_PRODUCTS_ID','Artikel ID#');
define('TEXT_ATTRIBUTES_DELETE','LÖSCHE ALLE');
define('TEXT_ATTRIBUTES_COPY_PRODUCTS','zu Artikel kopieren');
define('TEXT_ATTRIBUTES_COPY_CATEGORY','zur Kategorie kopieren');

define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','Attribut f&uuml;r Artikel ID# ge&auml;ndert');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','<strong>ALLE</strong> Artikelattribute f&uuml;r diesen Artikel l&ouml;schen:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','Attribute von einem anderen Artikel oder von einer ganzen Kategorie kopieren:<br />');

define('TEXT_ATTRIBUTES_COPY_TO_PRODUCTS','ARTIKEL');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','Kopiere Attribute zu einem anderen<strong>Artikel</strong> von ID#');
define('TEXT_INFO_ATTRIBUTES_FEATURE_COPY_TO','Artikel w&auml;hlen, zu dem Sie alle Attribute kopieren wollen:');

define('TEXT_ATTRIBUTES_COPY_TO_CATEGORY','KATEGORIE');
define('TEXT_INFO_ATTRIBUTES_FEATURE_CATEGORIES_COPY_TO','Kategorie w&auml;hlen, zu der Sie alle Attribute kopieren wollen:');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','Kopiere Attribute zu allen Artikel in der<strong>Kategorie</strong> von Artikel ID#');

define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>Wie sollen existierende Artikelattribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE','L&ouml;schen Sie <strong>vorhandene</strong>Attribute zuerst, bevor Sie die neuen Attribute kopieren');
define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>Aktualisieren</strong> Sie die neuen Einstellungen/Preise, dann f&uuml;gen Sie neue hinzu');
define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>Igorieren</strong> und nur neue Attribute hinzuf&uuml;gen');

define('SUCCESS_PRODUCT_UPDATE_SORT','Attribut Sortierreihenfolge wurde aktualisiert f&uuml;r ID#');
define('SUCCESS_PRODUCT_UPDATE_SORT_NONE','Keine Attribute zum aktualisieren der Sortierreihenfolge vorhanden f&uuml;r ID#');
define('SUCCESS_ATTRIBUTES_DELETED','Attribute wurden gel&ouml;scht');
define('SUCCESS_ATTRIBUTES_UPDATE','Attribute wurden aktualisiert');

define('WARNING_PRODUCT_COPY_TO_CATEGORY_NONE','Keine Kategorie zum Kopieren ausgew&auml;hlt');
define('TEXT_PRODUCT_IN_CATEGORY_NAME','- in Kategorie:');

define('TEXT_DELETE_ALL_ATTRIBUTES','Sind Sie sicher, dass Sie alle Attribute f&uuml;r ID# l&ouml;schen wollen?');

define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>Überspringe neues Attribut </strong>');
define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>f&uuml;ge neues Attribut ein von</strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>aktualisiere von Attribut </strong>');

// preview
define('TEXT_ATTRIBUTES_PREVIEW','ATTRIBUTE VORSCHAU');
define('TEXT_ATTRIBUTES_PREVIEW_DISPLAY','VORSCHAU DER ATTRIBUTE ANZEIGEN FÜR ID#');
define('TEXT_PRODUCT_OPTIONS','<strong>Bitte w&auml;hlen Sie:</strong>');
define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

define('TEXT_ATTRIBUTES_INSERT_INFO','<strong>Definieren Sie die Attributeinstellungen, anschlie&szlig;end klicken Sie auf "Einf&uuml;gen" um die Änderungen zu speichern</strong>');
define('TEXT_PRICED_BY_ATTRIBUTES','Preis durch Attribute festgelegt');
define('TEXT_PRODUCTS_PRICE','Artikelpreis:');
define('TEXT_SPECIAL_PRICE','Sonderpreis:');
define('TEXT_SALE_PRICE','Abverkaufspreis:');
define('TEXT_FREE','KOSTENLOS');
define('TEXT_CALL_FOR_PRICE','Preis bitte anfragen');
define('TEXT_SAVE_CHANGES', 'ÄNDERUNGEN AKTUALISIEREN UND SPEICHERN:');

define('TEXT_INFO_ID', 'ID#');
define('TEXT_INFO_ALLOW_ADD_TO_CART_NO', 'Nicht zum Warenkorb hinzugef&uuml;gt');
define('TEXT_DELETE_ATTRIBUTES_OPTION_NAME_VALUES', 'Sollen wirklich ALLE Attributmerkmale des Attributnamens gelöscht werden ...'); // new 1.3.0  
define('TEXT_INFO_PRODUCT_NAME', '<strong>Produkt Name: </strong>');  // new 1.3.0  
define('TEXT_INFO_PRODUCTS_OPTION_NAME', '<strong>Artikeloptionen : </strong>');     // new 1.3.0  
define('TEXT_INFO_PRODUCTS_OPTION_ID', '<strong>ID#</strong>'); // new 1.3.0  
define('SUCCESS_ATTRIBUTES_DELETED_OPTION_NAME_VALUES', 'ALLE Attrbutmerkmale für Attributnamen wurden gelöscht: '); // new 1.3.0  
?>