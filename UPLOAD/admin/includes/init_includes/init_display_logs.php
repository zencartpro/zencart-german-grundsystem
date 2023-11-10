<?php
/**
 * Zen Cart German Specific
 
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_display_logs.php 2023-11-08 20:15:08Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}


// -----
// If enabled check to see if there are any debug-logs present and, if so, notify the current admin via header message ... unless the admin is already on the display logs page.
//
if (DISPLAY_LOGS_SHOW_IN_HEADER =='true') {

if ($current_page != FILENAME_DISPLAY_LOGS . '.php') {
    $path = (defined('DIR_FS_LOGS')) ? DIR_FS_LOGS : DIR_FS_SQL_CACHE;
    $log_files = glob($path . '/myDEBUG-*.log');
    $num_log_files = ($log_files === false) ? 0 : count ($log_files);
    unset ($log_files);
    if ($num_log_files > 0) {
        $messageStack->add(sprintf(DISPLAY_LOGS_MESSAGE_LOGS_PRESENT, $num_log_files, zen_href_link(FILENAME_DISPLAY_LOGS)), 'caution');
    }
}
}