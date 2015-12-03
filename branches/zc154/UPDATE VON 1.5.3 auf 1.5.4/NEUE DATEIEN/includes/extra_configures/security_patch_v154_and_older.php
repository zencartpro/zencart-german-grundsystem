<?php
/**
 *  Security Patch for v1.5.4 (and older) to mitigate an Information Leak.
 *
 * @package initSystem
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
/**
 *
 * Please Note : This file should be placed in includes/extra_configures and will automatically load.
 *
 */

if (isset($_GET['main_page']) && $_GET['main_page'] == 'popup_image_additional') {
    if (isset($_REQUEST['products_image_large_additional'])) {
        $basepath = "";
        $realBase = realpath($basepath);
        $userpath = $basepath . $_REQUEST['products_image_large_additional'];
        $realUserPath = realpath($userpath);
        if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
            $_REQUEST['products_image_large_additional'] = '';
        }
    }
} 