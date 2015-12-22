<?php
/**
 * footer code - calculates information for display, and calls the template file for footer-rendering
 *
 * @package templateStructure
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: footer.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$time_start = explode(' ', PAGE_PARSE_START_TIME);
$time_end = explode(' ', microtime());
$parse_time = number_format(($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0])), 3);

if (STORE_PAGE_PARSE_TIME == 'true') {
  error_log(strftime(STORE_PARSE_DATE_TIME_FORMAT) . ' - ' . $_SERVER['REQUEST_URI'] . ' (' . $parse_time . 's)' . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
}
?>