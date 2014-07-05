<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart-pro.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart-pro.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

//  $Id: specials.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE','Sonderangebote und Abverkäufe');

define('TABLE_HEADING_PRODUCTS','Artikel');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS_PRICE','Artikelpreis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Prozentsatz');
define('TABLE_HEADING_AVAILABLE_DATE', 'Verfügbar ab');
define('TABLE_HEADING_EXPIRES_DATE','Ablaufdatum');
define('TABLE_HEADING_STATUS','Status');
define('TABLE_HEADING_ACTION','Aktion');

define('TEXT_SPECIALS_PRODUCT','Artikel:');
define('TEXT_SPECIALS_SPECIAL_PRICE','Sonderpreis:');
define('TEXT_SPECIALS_EXPIRES_DATE','Ablaufdatum:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_SPECIALS_PRICE_TIP','<b>Hinweis zu Sonderpreisen::</b><ul><li>Zur Preisreduzierung können Sie im Feld "Sonderpreis" eine Prozentzahl eingeben, z.B..: <b>20%</b></li><li>Wenn Sie einen Preis eingeben, muss das Dezimaltrennzeichen ein Punkt (kein Komma Zeichen) sein! (Beispiel: <b>49.99</b></li><li>Wenn Sie kein Ablaufdatum verwenden möchten, lassen Sie das Feld einfach leer.</li></ul>');

define('TEXT_INFO_DATE_ADDED','Erstellt am:');
define('TEXT_INFO_LAST_MODIFIED','Letzte Änderung:');
define('TEXT_INFO_NEW_PRICE','Neuer Preis:');
define('TEXT_INFO_ORIGINAL_PRICE','Originalpreis:');
define('TEXT_INFO_DISPLAY_PRICE', 'Angezeigter Preis:<br />');
define('TEXT_INFO_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_INFO_EXPIRES_DATE','Ablaufdatum:');
define('TEXT_INFO_STATUS_CHANGE','Letzte Statusänderung:');
define('TEXT_IMAGE_NONEXISTENT','Bild existiert nicht');

define('TEXT_INFO_HEADING_DELETE_SPECIALS','Sonderpreis löschen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Sonderpreis wirklich löschen?');

define('SUCCESS_SPECIALS_PRE_ADD', 'Erfolgreich: Sonderangebot hinzugefügt ... Bitte Preis und Datum anpassen ...');
define('WARNING_SPECIALS_PRE_ADD_EMPTY', 'Achtung: Keine Artikel ID angegeben ... nichts hinzugefügt ...');
define('WARNING_SPECIALS_PRE_ADD_DUPLICATE', 'Achtung: Artikel ID ist bereits ein Sonderangebot ... es wurde nichts hinzugefügt ...');
define('WARNING_SPECIALS_PRE_ADD_BAD_PRODUCTS_ID', 'WARNUNG: Artikel ID ist ungültig ... es wurde nichts hinzugefügt ...');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Sonderangebot mittels Artikel-ID hinzufügen');
define('TEXT_INFO_PRE_ADD_INTRO', 'Bei großen Datenbanken ist es ratsam Sonderangebote direkt über die Artikel-ID hinzuzufügen.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Bitte Artikel-ID eingeben: ');
define('TEXT_INFO_MANUAL', 'Artikel-ID als Sonderangebot hinzufügen');
