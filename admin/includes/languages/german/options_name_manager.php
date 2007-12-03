<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: options_name_manager.php 2181 2005-10-20 18:37:16Z ajeh $
//

define('HEADING_TITLE_OPT', 'Artikeloptionen');
define('HEADING_TITLE_VAL', 'Attributmerkmale');
define('HEADING_TITLE_ATRIB', 'Artikelattribute');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Artikelname');
define('TABLE_HEADING_OPT_NAME', 'Attributname');
define('TABLE_HEADING_OPT_VALUE', 'Attributmerkmal');
define('TABLE_HEADING_OPT_PRICE', 'Preis');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Pr&auml;fix');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_DOWNLOAD', 'Downloadartikel:');
define('TABLE_TEXT_FILENAME', 'Dateiname:');
define('TABLE_TEXT_MAX_DAYS', 'Ablaufdatum:');
define('TABLE_TEXT_MAX_COUNT', 'Maximale Downloads:');
define('TEXT_WARNING_OF_DELETE', 'Diese Option hat verlinkte Artikel und Werte - es ist nicht sicher, diese zu l&ouml;schen.');
define('TEXT_OK_TO_DELETE', 'Diese Option hat keine verlinkte Artikel und Werte und kann gel&ouml;scht werden.');
define('TEXT_OPTION_ID', 'Option ID');
define('TEXT_OPTION_NAME', 'Attributname');
define('TABLE_HEADING_OPT_DISCOUNTED','Erm&auml;&szlig;igt');
define('ATTRIBUTE_WARNING_DUPLICATE','Doppeltes Attribut - Attribut wurde nicht hinzugef&uuml;gt');
// attributes duplicate warning
define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','Doppeltes Attribut existiert - Attribut wurde nicht ge&auml;ndert');
// attributes duplicate warning
define('ATTRIBUTE_WARNING_INVALID_MATCH','Attributoption und Attributmerkmal stimmen NICHT &uuml;berein - Attribut wurde nicht hinzugef&uuml;gt');
// miss matched option and options value
define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','Attributoption und Attributmerkmal stimmen NICHT &uuml;berein - Attribut wurde nicht ge&auml;ndert');
// miss matched option and options value
define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','M&ouml;glicherweise doppelter Attributname hinzugef&uuml;gt');
// Options Name Duplicate warning
define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','M&ouml;glicherweise doppeltes Attributmerkmal hinzugef&uuml;gt');
// Options Value Duplicate warning

define('PRODUCTS_ATTRIBUTES_EDITING','BEARBEITE');
// title
define('PRODUCTS_ATTRIBUTES_DELETE','L&Ouml;SCHE');
// title
define('PRODUCTS_ATTRIBUTES_ADDING','F&Uuml;GE NEUE ATTRIBUTE HINZU');
// title
define('TEXT_DOWNLOADS_DISABLED','HINWEIS: Downloads sind deaktiviert');
define('TABLE_TEXT_MAX_DAYS_SHORT', 'Tage:');
define('TABLE_TEXT_MAX_COUNT_SHORT', 'Max:');
define('TABLE_HEADING_OPTION_SORT_ORDER','Sortierung');
define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','Standardsortierung');
define('TEXT_SORT',' Sortierung: ');
define('TABLE_HEADING_OPT_WEIGHT_PREFIX','Pr&auml;fix');
define('TABLE_HEADING_OPT_WEIGHT','Gewicht');
define('TABLE_HEADING_OPT_SORT_ORDER','Sortierung');
define('TABLE_HEADING_OPT_DEFAULT','Standard');
define('TABLE_HEADING_YES','Ja');
define('TABLE_HEADING_NO','Nein');
define('TABLE_HEADING_OPT_TYPE', 'Attributtyp');
//CLR 031203 add option type column
define('TABLE_HEADING_OPTION_VALUE_SIZE','Gr&ouml;&szlig;e');
define('TABLE_HEADING_OPTION_VALUE_MAX','Maximal');
define('TABLE_HEADING_OPTION_VALUE_ROWS','Reihen');
define('TABLE_HEADING_OPTION_VALUE_COMMENTS','Kommentare');
define('TEXT_OPTION_VALUE_COMMENTS','Kommentare: ');
define('TEXT_OPTION_VALUE_ROWS', 'Zeilen: ');
define('TEXT_OPTION_VALUE_SIZE','Anzeigegr&ouml;&szlig;e: ');
define('TEXT_OPTION_VALUE_MAX','Maximale L&auml;nge: ');
define('TEXT_ATTRIBUTES_IMAGE','Attributbild Muster:');
define('TEXT_ATTRIBUTES_IMAGE_DIR','Attributbild Verzeichnis:');
define('TEXT_ATTRIBUTES_FLAGS','Attribut<br />Kennzeichen:');
define('TEXT_ATTRIBUTES_DISPLAY_ONLY', 'Nur zur<br />Ansicht verwendet:');
define('TEXT_ATTRIBUTES_IS_FREE', 'Attribut ist kostenlos<br />wenn Artikel kostenlos ist:');
define('TEXT_ATTRIBUTES_DEFAULT', 'Standard Attribute<br />zur Auswahl markiert:');
define('TEXT_ATTRIBUTE_IS_DISCOUNTED', 'Verwende selben Preisnachlass<br />wie von Artikel:');
define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','Inkludiert im Grundpreis<br />wenn Preis durch Attribute bestimmt');
define('TEXT_PRODUCT_OPTIONS_INFO','Artikeloptionen f&uuml;r erweiterte Einstellungen bearbeiten');

// updates
define('ERROR_PRODUCTS_OPTIONS_VALUES', 'WARNUNG: Keine Artikel gefunden... es wurde nichts aktualisiert');
define('TEXT_SELECT_PRODUCT', ' W&auml;hlen Sie einen Artikel');
define('TEXT_SELECT_CATEGORY', ' W&auml;hlen Sie eine Kategorie');
define('TEXT_SELECT_OPTION', 'W&auml;hlen Sie einen Attributnamen');

// add
define('TEXT_OPTION_VALUE_ADD_ALL', '<br /><strong>ALLE Attributmerkmale f&uuml;r ALLE Artikel f&uuml;r Attributnamen ausw&auml;hlen</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_ALL', 'ALLE existierende Artikel mit mindestens EINEM Attributmerkmal und ALLE Attributmerkmale einem Attributnamen hinzuf&uuml;gen');
define('SUCCESS_PRODUCTS_OPTIONS_VALUES', 'Optionen erfolgreich aktualisiert');
define('TEXT_OPTION_VALUE_ADD_PRODUCT', '<br /><strong>ALLE Attributmerkmale zu einem Artikel f&uuml;r Attributnamen hinzuf&uuml;gen</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_PRODUCT', 'EINEN Artikel mit mindestens EINEM Attributmerkmal aktualisieren und ALLE Attributmerkmale einem Attributname hinzuf&uuml;gen');
define('TEXT_OPTION_VALUE_ADD_CATEGORY', '<br /><strong>ALLE Attributmerkmale zu EINER Kategorie von Artikel f&uuml;r Attributnamen hinzuf&uuml;gen</strong>');
define('TEXT_INFO_OPTION_VALUE_ADD_CATEGORY', 'EINE Kategorie von Artikel aktualisieren, wenn der Artikel mindestens EINEN Attributmerkmal hat und ALLE Attributmerkmale einem Attributnamen hinzuf&uuml;gen');
define('TEXT_COMMENT_OPTION_VALUE_ADD_ALL', '<strong>HINWEIS:</strong> Die Sortierung wird f&uuml;r diese Artikel auf die Standard Sortierung f&uuml;r Attributmerkmale gesetzt');

// delete
define('TEXT_OPTION_VALUE_DELETE_ALL', '<br /><strong>L&ouml;sche ALLE Attributmerkmale f&uuml;r ALLE Artikel f&uuml;r Attributnamen</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', 'Aktualisiere ALLE existierenden Artikel mit mindestens EINEM Attributmerkmal und l&ouml;sche ALLE Attributmerkmale eines Attributnamens');
define('TEXT_OPTION_VALUE_DELETE_PRODUCT', '<br /><strong>L&ouml;sche ALLE Attributmerkmale zu EINEM Artikel f&uuml;r Attributnamen</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_PRODUCT', 'Aktualisiere EINEN Artikel mit mindestens EINEM Attributmerkmal und l&ouml;sche ALLE Attributmerkmale eines Attributnamens');
define('TEXT_OPTION_VALUE_DELETE_CATEGORY', '<br /><strong>L&ouml;sche ALLE Attributmerkmale zu EINER Kategorie von Artikeln f&uuml;r Attributnamen</strong>');
define('TEXT_INFO_OPTION_VALUE_DELETE_CATEGORY', 'Aktualisiere EINE Kategorie von Artikeln, wenn der Artikel mindestens EINEN Attributmerkmal hat und l&ouml;sche ALLE Attributmerkmale eines Attributnamens');
define('TEXT_COMMENT_OPTION_VALUE_DELETE_ALL', '<strong>HINWEIS:</strong> Alle Attributmerkmale eines Attributnamens werden f&uuml;r die ausgew&auml;hlten Artikel gel&ouml;scht. Die Einstellungen der Attributmerkmale werden dabei nicht gel&ouml;scht.');
define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>Kopiere ALLE Attributmerkmale zueinem anderen Attributnamen</strong>');
define('TEXT_INFO_OPTION_VALUE_COPY_ALL', 'Alle Attributmerkmale werden von einem Attributnamen zu einem anderen Otionsnamen kopiert');
define('TEXT_SELECT_OPTION_FROM', 'Kopiere von Attributnamen: ');
define('TEXT_SELECT_OPTION_TO', 'Kopiere alle Attributmerkmale zum Attributnamen: ');
define('SUCCESS_OPTION_VALUES_COPIED', 'Erfolgreich kopiert! ');
define('ERROR_OPTION_VALUES_COPIED', 'Fehler - kann keine Attributmerkmale zum selben Attributnamen kopieren! ');
define('ERROR_OPTION_VALUES_NONE', 'Fehler - Es wurden keine Attributmerkmale definiert - es wurde nichts kopiert! ');
define('TEXT_WARNING_BACKUP', 'Warnung: F&uuml;hren Sie VOR jeder globalen &Auml;nderung immer eine Sicherung der Datenbank durch');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_PER_ROW', 'Attributbilder pro Reihe: ');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE', 'Attributstil f&uuml;r Radio Buttons/Checkboxen: ');
define('TEXT_OPTION_ATTIBUTE_MAX_LENGTH', '<strong>Maximale L&auml;nge und Anzeigegr&ouml;&szlig;e nur f&uuml;r Textattribute:</strong><br />');
define('TEXT_OPTION_IMAGE_STYLE', '<strong>Bilddarstellung:</strong>');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_0', '0= Bilder unter Attributnamen');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_1', '1= Elemente, Bilder und Attributmerkmale');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_2', '2= Elemente, Bilder und Attributnamen darunter');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_3', '3= Attributname unterhalb von Elementen und Bildern');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_4', '4= Elemente unterhalb der Bilder und Attributnamen');
define('TEXT_OPTION_ATTRIBUTE_IMAGES_STYLE_5', '5= Elemente &uuml;ber den Bildern und Attributnamen');


?>