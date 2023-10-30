<?php
/**
 * Debug Logging Configuration
 *
 * Sometimes it is difficult to debug PHP background activities, especially when most information cannot be safely output to the screen.
 * However, using the PHP error logging facility we can store all PHP errors to a file, and then review separately.
 * Zen Cart's debug details are stored at: /logs/myDEBUG-yyyymmdd-hhiiss-xxxxx.log
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: enable_error_logging.php 2023-10-30 14:30:29Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    exit('Invalid Access');
}

$pages_to_debug = [];
/**
 * Specify the pages you wish to enable debugging for (ie: main_page=xxxxxxxx)
 * Using '*' will cause all pages to be enabled
 */
$pages_to_debug[] = '*';
//   $pages_to_debug[] = '';
//   $pages_to_debug[] = '';



/**
 * Error reporting level to log
 * Default: E_ALL & ~E_NOTICE
 */
$errors_to_log = E_ALL & ~E_NOTICE;


///// DO NOT EDIT BELOW THIS LINE /////
// This passes the updated settings above into the error handling configuration to override the defaults
zen_enable_error_logging($pages_to_debug, $errors_to_log);

