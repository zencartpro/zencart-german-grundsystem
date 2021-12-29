<?php
/**
 * @package initSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: patch_clean_ampersands.php 1 2020-01-20 21:25:16Z webchills $
 */
/**
 * Suitable for versions of Zen Cart prior to v1.5.7
 *
 * Non-sanitization/access - $_GET
 *
 * Please Note : This file should be placed in includes/extra_configures and will automatically load.
 *  
 */

if (!isset($_GET)) {
    return;
}
if (!is_array($_GET)) {
    return;
}
foreach ($_GET as $key => $value) {
    if ($key === 'amp;') continue;
    if (strpos($key, 'amp;') !== 0) {
        continue;
    }
    $newtext = substr($key, 4);
    if (isset($_GET[$newtext])) continue;

    $_GET[$newtext] = $_GET['amp;' . $newtext];
    unset($_GET['amp;' . $newtext]);
}