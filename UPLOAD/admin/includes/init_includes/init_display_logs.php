<?php
/**
 * Zen Cart German Specific
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_display_logs.php 1 2019-06-16 09:15:08Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

define('DISPLAY_LOGS_CURRENT_VERSION', '2.1.1');
// -----
// Check to see if there are any debug-logs present and, if so, notify the current admin via header message ... unless the admin is already on the display logs page.
//
if ($current_page != FILENAME_DISPLAY_LOGS . '.php') {
    $path = (defined('DIR_FS_LOGS')) ? DIR_FS_LOGS : DIR_FS_SQL_CACHE;
    $log_files = glob($path . '/myDEBUG-*.log');
    $num_log_files = ($log_files === false) ? 0 : count ($log_files);
    unset ($log_files);
    if ($num_log_files > 0) {
        $messageStack->add(sprintf(DISPLAY_LOGS_MESSAGE_LOGS_PRESENT, $num_log_files, zen_href_link(FILENAME_DISPLAY_LOGS)), 'caution');
    }
}