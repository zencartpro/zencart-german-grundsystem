<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: specials.php 629 2020-01-18 10:39:16Z webchills $
 */

define('HEADING_TITLE','Sonderangebote und Abverkäufe');

define('TABLE_HEADING_PRODUCTS','Artikel');

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