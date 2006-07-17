<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* translatet from: cyaneo/hugo13 / www.zen-cart.at / 31.03.06 
* @version $Id: shopping_cart.php 2 2006-03-31 09:55:33Z rainer $
@@@LOOK@@@*/

define('NAVBAR_TITLE','Warenkorb');
define('HEADING_TITLE','Ihr Warenkorb enth&auml;lt:');
define('HEADING_TITLE_EMPTY', 'Ihr Einkaufswagen'); // new 1.3.0  
define('TEXT_INFORMATION', '!!!TRANSLATE!!! You may want to add some instructions for using the shopping cart here. (defined in includes/languages/german/shopping_cart.php)'); // new 1.3.0  
define('TABLE_HEADING_REMOVE','Entfernen');
define('TABLE_HEADING_QUANTITY','Anzahl');
define('TABLE_HEADING_MODEL','Artikelnummer');
define('TABLE_HEADING_PRICE','StückPreis');
define('TABLE_HEADING_TOTAL','Gesamt');
define('TEXT_CART_EMPTY','Ihr Warenkorb ist leer.');
define('SUB_TITLE_SUB_TOTAL','Zwischensumme:');
define('SUB_TITLE_TOTAL','Gesamt:');

define('OUT_OF_STOCK_CANT_CHECKOUT','Artikel, die markiert sind, ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' sind zurzeit leider nicht auf Lager.');
define('OUT_OF_STOCK_CAN_CHECKOUT','Artikel, die markiert sind, ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' sind zurzeit leider nicht auf Lager.');

define('TEXT_TOTAL_ITEMS','Summe Artikel:');
define('TEXT_TOTAL_WEIGHT','  Gewicht:');
define('TEXT_TOTAL_AMOUNT','  Betrag:');
define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[hilfe (?)]</a>');   // new 1.3.0  
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');  // new 1.3.0  
?>