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
//  $Id: specials.php 4533 2006-09-17 17:21:10Z ajeh $
//

define('HEADING_TITLE','Sonderangebote und Abverk&auml;ufe');
define('TABLE_HEADING_PRODUCTS','Artikel');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS_PRICE','Artikelpreis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Prozentsatz');
define('TABLE_HEADING_AVAILABLE_DATE', 'verf&uuml;gbar ab');
define('TABLE_HEADING_EXPIRES_DATE','Ablaufdatum');
define('TABLE_HEADING_STATUS','Status');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_SPECIALS_PRODUCT','Artikel:');
define('TEXT_SPECIALS_SPECIAL_PRICE','Sonderpreis:');
define('TEXT_SPECIALS_EXPIRES_DATE','Ablaufdatum:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'verf&uuml;gbar ab:');
define('TEXT_SPECIALS_PRICE_TIP','<b>Hinweis zu Sonderpreisen::</b><ul><li>Zur Preisreduzierung k&ouml;nnen Sie im Feld "Sonderpreis" eine Prozentzahl eingeben, z.B..: <b>20%</b></li><li>Wenn Sie einen Preis eingeben, muss das Dezimaltrennzeichen ein Punkt (kein Komma Zeichen) sein! (Beispiel: <b>49.99</b></li><li>Wenn Sie kein Ablaufdatum verwenden m&ouml;chten, lassen Sie das Feld einfach leer.</li></ul>');
define('TEXT_INFO_DATE_ADDED','Erstelldatum:');
define('TEXT_INFO_LAST_MODIFIED','Letzte &Auml;nderung:');
define('TEXT_INFO_NEW_PRICE','Neuer Preis:');
define('TEXT_INFO_ORIGINAL_PRICE','Originalpreis:');
define('TEXT_INFO_DISPLAY_PRICE', 'Preis anzeigen:<br />');
define('TEXT_INFO_AVAILABLE_DATE', 'verf&uuml;gbar ab:');
define('TEXT_INFO_EXPIRES_DATE','Ablaufdatum:');
define('TEXT_INFO_STATUS_CHANGE','Letzte Status&auml;nderung:');
define('TEXT_IMAGE_NONEXISTENT','Bild existiert nicht');
define('TEXT_INFO_HEADING_DELETE_SPECIALS','Sonderpreis l&ouml;schen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Sonderpreis wirklich l&ouml;schen?');
define('SUCCESS_SPECIALS_PRE_ADD', 'Erfolgreich: Sonderangebot hinzugef&uuml;gt ... Bitte Preis und Datum anpassen ...');
define('WARNING_SPECIALS_PRE_ADD_EMPTY', 'Achtung: Keine Artikel ID angegeben ... nichts hinzugef&uuml;gt ...');
define('WARNING_SPECIALS_PRE_ADD_DUPLICATE', 'Achtung: Artikel ID ist bereits ein Angebot ... es wurde nichts hinzugef&uuml;gt ...');
define('WARNING_SPECIALS_PRE_ADD_BAD_PRODUCTS_ID', 'Warnung: Artikel ID ist ung&uuml;ltig ... es wurde nichts hinzugef&uuml;gt ...');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Sonderangebot mittels Artikel-ID hinzuf&uuml;gen');
define('TEXT_INFO_PRE_ADD_INTRO', 'Bei gro&szlig;en Datenbanken ist es ratsam Sonderangebote direkt &uuml;ber die Artikel-ID hinzuzuf&uuml;gen.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Bitte Artikel-ID eingeben: ');
define('TEXT_INFO_MANUAL', 'Artikel-ID als Sonderangebot hinzuf&uuml;gen');


?>