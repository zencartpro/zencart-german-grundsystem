<?php
/**
 * Very simple error logging to file
 *
 * Sometimes it is difficult to debug PHP background activities, especially when most information cannot be safely output to the screen.
 * However, using the PHP error logging facility we can store all PHP errors to a file, and then review separately.
 * Using this method, the debug details are stored at: /logs/myDEBUG-adm-999999-00000000.log
 * Credits to @lat9 for adding backtrace functionality
 *
 * @package debug
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: enable_error_logging.php 2021-11-29 20:13:51Z webchills $
 */

require DIR_FS_CATALOG . 'includes/extra_configures/enable_error_logging.php';