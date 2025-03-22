<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: log_files.php 2023-10-30 14:46:12Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    exit('Invalid Access');
}

/**
 * @param array $log_filename_prefix_patterns Used by /admin/store_manager.php for purging debug logs
 *
 * Future use: could also be used by DisplayLogs plugin
 */
$log_filename_prefix_patterns = [
     'myDEBUG-',
     'upsoauth-',
     'fedexrest-',
     'Bambora_Debug_',
     'Square_',
     'SquareWebPay_',
     'AIM_Debug_',
     'SIM_Debug_',
     'FirstData_Debug_',
     'Linkpoint_Debug_',
     'Paypal',
     'paypal',
     'ipn_',
     'zcInstall',
     'SHIP_',
     'PAYMENT_',
     'usps_',
     '.*debug',
];
