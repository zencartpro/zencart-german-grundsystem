<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* translatet from: cyaneo/hugo13 / www.zen-cart.at / 31.03.06 
* @version $Id: index.php 2 2006-03-31 09:55:33Z rainer $
@@@LOOK@@@*/

define('TEXT_MAIN','Definieren Sie hier Ihren pers&ouml;nlichen Text. Diesen Text k&ouml;nnen Sie in <strong>/includes/languages/german/index.php (Zeile 27)</strong> editieren.');

// Showcase vs Store
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST','Willkommen <span class="greetUser">Gast!</span> Wollen Sie sich <a href="%s">anmelden</a>?');
} else {
  define('TEXT_GREETING_GUEST', 'Willkommen! Bitte genie&szlig;en Sie unseren Schauraum.');
}

define('TEXT_GREETING_PERSONAL', 'Willkommen <span class="greetUser">%s</span>! Wollen Sie sehen, was es <a href="%s">neues</a> bei uns gibt?');

define('TEXT_INFORMATION', 'Definieren Sie hier Ihren pers&ouml;nlichen Text. Diesen Text k&ouml;nnen Sie in <strong>/includes/languages/german/index.php (Zeile 38)</strong> editieren.');

//moved to english
//define('TABLE_HEADING_FEATURED_PRODUCTS','Featured Products');

// define('TABLE_HEADING_NEW_PRODUCTS','Neue Artikel im %s');
// define('TABLE_HEADING_UPCOMING_PRODUCTS','Demn&auml;chst hier');
// define('TABLE_HEADING_DATE_EXPECTED','Erscheinungstermin');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
define('HEADING_TITLE','Kategorien');
define('TABLE_HEADING_IMAGE','Artikelbild');
define('TABLE_HEADING_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS','Artikelname');
define('TABLE_HEADING_MANUFACTURER','Hersteller');
define('TABLE_HEADING_QUANTITY','Menge');
define('TABLE_HEADING_PRICE','Preis');
define('TABLE_HEADING_WEIGHT','Gewicht');
define('TABLE_HEADING_BUY_NOW','Jetzt kaufen');
define('TEXT_NO_PRODUCTS','In dieser Kategorie gibt es derzeit keine Artikel.');
define('TEXT_NO_PRODUCTS2','Von diesem Hersteller ist kein Artikelverf&uuml;gbar.');
define('TEXT_NUMBER_OF_PRODUCTS','Anzahl der Artikel:');
define('TEXT_SHOW','<b>Herstellerauswahl:</b>');
define('TEXT_BUY','Kaufe 1 ');
define('TEXT_NOW',' jetzt');
define('TEXT_ALL_CATEGORIES','Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS','Alle Hersteller');
} elseif ($category_depth == 'top') {
define('HEADING_TITLE', 'Willkommen in unserem Online Shop!'); /*Replace this line with the headline you would like for your shop. For example: Welcome to My SHOP!*/
} elseif ($category_depth == 'nested') {
  // this will also be used on Top Level
define('HEADING_TITLE', 'Willkommen in unserem Online Shop!'); /*Replace this line with the headline you would like for your shop. For example: Welcome to My SHOP!*/
}
?>
