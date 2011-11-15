<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id$
 */

//  $Id$
//

define('HEADING_TITLE', 'Empfohlene Artikel');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE', 'Prozentsatz');
define('TABLE_HEADING_AVAILABLE_DATE', 'Verfügbar ab');
define('TABLE_HEADING_EXPIRES_DATE', 'Ablaufdatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_FEATURED_PRODUCT', 'Artikel:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_INFO_DATE_ADDED', 'Erstellt am:');
define('TEXT_INFO_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_INFO_NEW_PRICE', 'Neuer Preis:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Originalpreis:');
define('TEXT_INFO_PERCENTAGE', 'Prozentsatz:');
define('TEXT_INFO_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_INFO_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_INFO_STATUS_CHANGE', 'Letzte Status Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Kein Bild vorhanden');
define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Lösche ähnlichen Artikel');
define('TEXT_INFO_DELETE_INTRO', 'Wollen Sie den empfohlenen Artikel wirklich löschen?');
define('SUCCESS_FEATURED_PRE_ADD', 'Erfolgreich: Empfohlener Artikel wurde hinzugefügt ... Aktualisieren Sie bitte die Daten ...');
define('WARNING_FEATURED_PRE_ADD_EMPTY', 'Warnung: Keine Artikel ID angegeben ... nichts wurde hinzugefügt ...');
define('WARNING_FEATURED_PRE_ADD_DUPLICATE', 'Warnung: Artikel ID ist bereits als Sonderangebot definiert ... nichts wurde hinzugefügt ...');
define('WARNING_FEATURED_PRE_ADD_BAD_PRODUCTS_ID', 'Warnung: Artikel ID ist ungültig ... nichts wurde hinzugefügt ...');
define('TEXT_INFO_HEADING_PRE_ADD_FEATURED', 'Neue Artikel manuell hinzufügen per Artikel ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'Bei großen Datenbanken kann man Artikel manuell per Angabe der Artikel ID hinzufügen.<br /><br />Dies wird dann angewandt, wenn die Seite zu lang zum übertragen braucht und der Versuch, ein Produkt per Dropdownfeld zu wählen wegen zu vielen Produkten zu schwierig wird.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Bitte geben Sie die Artikel ID ein: ');
define('TEXT_INFO_MANUAL', 'Artikel ID manuell als empfohlenen Artikel hinzufügen');
