<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: advanced_search.php 2 2006-03-31 09:55:33Z rainer $
*/

define('NAVBAR_TITLE_1','Erweiterte Suche');
define('NAVBAR_TITLE_2','Suchergebnisse');

define('HEADING_TITLE_1','Erweiterte Suche');
define('HEADING_TITLE_2','Artikel entsprechen Ihren Suchkriterien');

define('HEADING_SEARCH_CRITERIA','Suchkriterien:');

define('TEXT_SEARCH_IN_DESCRIPTION','In Artikelbeschreibungen suchen');
define('ENTRY_CATEGORIES','Kategorien:');
define('ENTRY_INCLUDE_SUBCATEGORIES','Mit Unterkategorien');
define('ENTRY_MANUFACTURERS','Hersteller:');
define('ENTRY_PRICE_RANGE', 'Suche nach Preisstaffel');  // new 1.3.0
define('ENTRY_PRICE_FROM','Preis von:');
define('ENTRY_PRICE_TO','bis:');
define('ENTRY_DATE_RANGE', 'Suche nach Einstellungsdatum');  // new 1.3.0
define('ENTRY_DATE_FROM','Eintrag ab:');
define('ENTRY_DATE_TO','bis:');

define('TEXT_SEARCH_HELP_LINK','Hilfe [?]');

define('TEXT_ALL_CATEGORIES','Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS','Alle Hersteller');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikelname');
define('TABLE_HEADING_MANUFACTURER','Hersteller');
define('TABLE_HEADING_QUANTITY','Anzahl');
define('TABLE_HEADING_PRICE','Preis');
define('TABLE_HEADING_WEIGHT','Gewicht');
define('TABLE_HEADING_BUY_NOW','Jetzt kaufen');

define('TEXT_NO_PRODUCTS','Kein Artikel entsprechend Ihren Suchkriterien gefunden.');
define('KEYWORD_FORMAT_STRING', 'Schlüsselwort'); // new 1.3.0
define('ERROR_AT_LEAST_ONE_INPUT','Es muss wenigstens eine Auswahl getroffen werden.');
define('ERROR_INVALID_FROM_DATE','Fehler bei');
define('ERROR_INVALID_TO_DATE','Fehler bei');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE','"Eintrag bis" muss sp&auml;ter als Eintrag "vom" sein.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', '"Preis von" muss eine Zahl sein.');
define('ERROR_PRICE_TO_MUST_BE_NUM', '"Preis vis" muss eine Zahl sein.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM','"Preis bis" muss gr&ouml;&szlig;er sein als "Preis von".');
define('ERROR_INVALID_KEYWORDS','Falsche Suchw&ouml;rter.');
?>