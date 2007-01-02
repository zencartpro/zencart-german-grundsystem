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
// $Id: advanced_search_result.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE_1', 'Erweiterte Suche');d
efine('NAVBAR_TITLE_2','Suchergebnisse');

//define('HEADING_TITLE_1', 'Advanced Search');
define('HEADING_TITLE', 'Erweiterte Suche');
define('HEADING_SEARCH_CRITERIA','Suchkriterien:');
define('TEXT_SEARCH_IN_DESCRIPTION','In Artikelbeschreibungen suchen');
define('ENTRY_CATEGORIES', 'Kategorien:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Mit Unterkategorien');
define('ENTRY_MANUFACTURERS', 'Hersteller:');
define('ENTRY_PRICE_FROM', 'Preis von:');
define('ENTRY_PRICE_TO', 'Preis bis:');
define('ENTRY_DATE_FROM', 'Eintrag ab:');
define('ENTRY_DATE_TO', 'Eintrag bis:');
define('TEXT_SEARCH_HELP_LINK', 'Hilfe [?]');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller');
define('HEADING_SEARCH_HELP', 'Hilfe zur Suche');
define('TEXT_SEARCH_HELP', 'Suchbegriffe k&ouml;nnen mit Hilfe von UND oder ODER benutzt werden.<br /><br />Beispiel: mit Microsoft UND Maus werden Begriffe mit beiden W&ouml;rtern gefunden. Wohingegen mit Microsoft ODER Maus Begriffe gefunden werden, die entweder Microsoft oder Maus beinhalten.');
define('TEXT_CLOSE_WINDOW', 'Fenster schlie&szlig;en [x]');
define('TABLE_HEADING_IMAGE', 'Artikelbild');
define('TABLE_HEADING_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Artikelname');
define('TABLE_HEADING_MANUFACTURER', 'Hersteller');
define('TABLE_HEADING_QUANTITY', 'Anzahl');
define('TABLE_HEADING_PRICE', 'Preis');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
define('TABLE_HEADING_BUY_NOW', 'Jetzt kaufen');
define('TEXT_NO_PRODUCTS', 'Kein Artikel entsprechend Ihren Suchkriterien gefunden.');
define('ERROR_AT_LEAST_ONE_INPUT', 'Es muss mindestens eine Auswahl getroffen werden.');
define('ERROR_INVALID_FROM_DATE', 'Fehler bei');
define('ERROR_INVALID_TO_DATE', 'Fehler bei');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', '"Eintrag bis" mus sp&auml;ter sein als "Eitrag vom".');
define('ERROR_PRICE_FROM_MUST_BE_NUM', '"Preis von" muss eine Zahl sein.');
define('ERROR_PRICE_TO_MUST_BE_NUM', '"Preis bis" muss eine Zahl sein.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '"Preis bis" muss gr&ouml;&szlig;er sein als "Preis von".');
define('ERROR_INVALID_KEYWORDS', 'Unzul&auml;ssige Schl&uuml;sselw&ouml;rter');
?>