<?php
/**
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: banner_statistics.php 628 2013-07-17 08:05:14Z webchills $
 */

define('HEADING_TITLE','Bannerstatistik');
define('TABLE_HEADING_SOURCE','Quelle');
define('TABLE_HEADING_VIEWS','Einblendungen');
define('TABLE_HEADING_CLICKS','Klicks');

define('TEXT_BANNERS_DATA','D<br>a<br>t<br>a');
define('TEXT_BANNERS_DAILY_STATISTICS','%s tägliche Statistik für %s %s');
define('TEXT_BANNERS_MONTHLY_STATISTICS','%s monatliche Statistik für %s');
define('TEXT_BANNERS_YEARLY_STATISTICS','%s jährliche Statistik');

define('STATISTICS_TYPE_DAILY','Täglich');
define('STATISTICS_TYPE_MONTHLY','Monatlich');
define('STATISTICS_TYPE_YEARLY','Jährlich');

define('TITLE_TYPE','Typ:');
define('TITLE_YEAR','Jahr:');
define('TITLE_MONTH','Monat:');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST','Achtung! Das Grafikverzeichnis existiert nicht. Bitte erstellen Sie das Verzeichnis <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE','Achtung! Das graphs Verzeichnis ist nicht beschreibbar. Es befindet sich hier: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');