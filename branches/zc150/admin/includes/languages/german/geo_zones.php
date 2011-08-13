<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2007-01-03
 * @version $Id: geo_zones.php 627 2010-08-30 15:05:14Z webchills $
 */

define('HEADING_TITLE','Zonendefinitionen - Steuern, Zahlungsarten und Versandarten');

define('TABLE_HEADING_COUNTRY','Land');
define('TABLE_HEADING_COUNTRY_ZONE','Bundesland/Steuerzone');
define('TABLE_HEADING_TAX_ZONES','Steuerzonen');
define('TABLE_HEADING_TAX_ZONES_DESCRIPTION', 'Zonenbeschreibung');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION','Aktion');
//define('TEXT_LEGEND', 'LEGEND: ');
define('TEXT_LEGEND_TAX_AND_ZONES', ': Steuersätze & -zonen definiert ');
define('TEXT_LEGEND_ONLY_ZONES', ': Steuerzonen, aber keine Steuersätze definiert ');
define('TEXT_LEGEND_NOT_CONF', ': Nicht konfiguriert ');

define('TEXT_INFO_HEADING_NEW_ZONE','Neue Steuerzone');
define('TEXT_INFO_NEW_ZONE_INTRO','Geben Sie bitte die notwendigen Informationen für die neue Steuerzone ein');

define('TEXT_INFO_HEADING_EDIT_ZONE','Steuerzone bearbeiten');
define('TEXT_INFO_EDIT_ZONE_INTRO','Führen Sie hier bitte die notwendigen Änderungen durch');

define('TEXT_INFO_HEADING_DELETE_ZONE','Steuerzone löschen');
define('TEXT_INFO_DELETE_ZONE_INTRO','Wollen Sie diese Steuerzone wirklich löschen?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE','Neue Steuerklasse');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO','Geben Sie bitte die notwendigen Informationen für die neue Steuerklasse ein');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE','Steuerklasse bearbeiten');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO','Führen Sie hier bitte die notwendigen Änderungen durch');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE','Steuerklasse löschen');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO','Wollen Sie diese Steuerklasse wirklich löschen?');

define('TEXT_INFO_DATE_ADDED','Erstellt am:');
define('TEXT_INFO_LAST_MODIFIED','Letzte Änderung:');
define('TEXT_INFO_ZONE_NAME','Name der Steuerzone');
define('TEXT_INFO_NUMBER_ZONES','Anzahl der Steuerzonen:');
define('TEXT_INFO_ZONE_DESCRIPTION','Beschreibung:');
define('TEXT_INFO_COUNTRY','Land:');
define('TEXT_INFO_COUNTRY_ZONE','Bundesland/Steuerzone:');
define('TYPE_BELOW','Alle Zonen/Bundesländer');
define('PLEASE_SELECT','Alle Zonen/Bundesländer');
define('TEXT_ALL_COUNTRIES','Alle Länder');

define('TEXT_INFO_NUMBER_TAX_RATES','Anzahl der Steuersätze:');
define('ERROR_TAX_RATE_EXISTS','WARNUNG: Es wurden bereits Steuersätze für dieses Bundesland/Steuerzone definiert. Bitte löschen Sie zuerst diese definierten Steuersätze, bevor Sie die Steuerzone löschen.');
