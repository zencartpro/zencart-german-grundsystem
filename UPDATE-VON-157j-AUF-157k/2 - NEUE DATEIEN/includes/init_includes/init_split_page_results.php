<?php
/**
 * Initially load the splitPageResults class, if a class of that
 * name is not already loaded, thus enabling that base class to be
 * overridden.
 *
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_split_page_results.php 2025-09-15 16:17:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (!class_exists('splitPageResults')) {
    require DIR_WS_CLASSES . 'split_page_results.php';
}
