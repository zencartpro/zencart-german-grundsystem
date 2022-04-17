<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: featured.php 2022-04-17 16:19:04Z webchills $
 */

define('HEADING_TITLE', 'Empfohlene Artikel');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_STOCK', 'Lagerbestand');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Preis/Sonderpreis/Abverkauf');

define('TABLE_HEADING_AVAILABLE_DATE', 'Startdatum');
define('TABLE_HEADING_EXPIRES_DATE', 'Ablaufdatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_ADD_FEATURED_SELECT', 'Empfehlung per Auswahl hinzufügen');
define('TEXT_ADD_FEATURED_PID', 'Empfehlung per Artikel ID hinzufügen');
define('TEXT_SEARCH_FEATURED', 'Suche derzeitige empfohlene Artikel');
define('TEXT_FEATURED_ACTIVE', 'Aktive empfohlene Artikel');
define('TEXT_FEATURED_INACTIVE', 'Inaktive empfohlene Artikel');
define('TEXT_FEATURED_STATUS_BY_DATE', 'Status nach Datum');

define('TEXT_FEATURED_PRODUCT', 'Artikel:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'Empfehlung Startdatum:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Empfehlung Ablaufdatum:');

define('TEXT_INFO_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_INFO_LAST_MODIFIED', 'zuletzt geändert am:');
define('TEXT_INFO_NEW_PRICE', 'Sonderpreis:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Original Preis:');
define('TEXT_INFO_DISPLAY_PRICE', 'derzeit angezeigter Preis:');
define('TEXT_INFO_STATUS_CHANGED', 'Status geändert:');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Lösche Empfehlung');
define('TEXT_INFO_DELETE_INTRO', 'Wollen Sie diesen Artikel sicher nicht mehr als empfohlen markieren?');

define('WARNING_FEATURED_PRE_ADD_PID_EMPTY', 'Warnung: Artikel ID wurde nicht angegeben.');
define('WARNING_FEATURED_PRE_ADD_PID_DUPLICATE', 'Warnung: Artikel ID#%u ist bereits ein empfohlener Artikel.');
define('WARNING_FEATURED_PRE_ADD_PID_NO_EXIST', 'Warnung: Artikel ID#%u existiert nicht.');
define('TEXT_INFO_HEADING_PRE_ADD_FEATURED', 'Neue Artikel manuell hinzufügen per Artikel ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'Bei großen Datenbanken kann man Artikel manuell per Angabe der Artikel ID hinzufügen.<br><br>Dies wird dann angewandt, wenn die Seite zu lang zum übertragen braucht und der Versuch, ein Produkt per Dropdownfeld zu wählen wegen zu vielen Produkten zu schwierig wird.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Bitte geben Sie die Artikel ID ein: ');