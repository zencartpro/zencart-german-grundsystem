<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: banner_statistics.php 805 2015-12-22 15:49:16Z webchills $
 */

define('HEADING_TITLE', 'Banner Statistics');

define('TABLE_HEADING_SOURCE', 'Source');
define('TABLE_HEADING_VIEWS', 'Views');
define('TABLE_HEADING_CLICKS', 'Clicks');

define('TEXT_BANNERS_DATA', 'D<br>a<br>t<br>a');
define('TEXT_BANNERS_DAILY_STATISTICS', '%s Daily Statistics For %s %s');
define('TEXT_BANNERS_MONTHLY_STATISTICS', '%s Monthly Statistics For %s');
define('TEXT_BANNERS_YEARLY_STATISTICS', '%s Yearly Statistics');

define('STATISTICS_TYPE_DAILY', 'Daily');
define('STATISTICS_TYPE_MONTHLY', 'Monthly');
define('STATISTICS_TYPE_YEARLY', 'Yearly');

define('TITLE_TYPE', 'Type:');
define('TITLE_YEAR', 'Year:');
define('TITLE_MONTH', 'Month:');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: Graphs directory does not exist. Please create a graphs directory example: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: Graphs directory is not writeable. This is located at: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');