<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_special_funcs.php 2024-02-01 11:20:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// set a default time limit
zen_set_time_limit((int)GLOBAL_SET_TIME_LIMIT);

// -----
// Load required sales/specials/etc function-files for core use, in preparation to
// run associated functions which handle features that auto-expire and auto-activate.
//
require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'banner.php';
require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'specials.php';
require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'featured.php';
require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'salemaker.php';

// auto activate and expire banners
zen_activate_banners();
zen_expire_banners();

/**
 * only process once per session, do not include banners as banners expire per click as well as per date
 */
// check if a reset on one time sessions settings should occur due to the midnight hour happening
if (!isset($_SESSION['today_is'])) {
    $_SESSION['today_is'] = date('Y-m-d');
}

if ($_SESSION['today_is'] !== date('Y-m-d')) {
    $_SESSION['today_is'] = date('Y-m-d');
    $_SESSION['expirationsNeedUpdate'] = true;
}

// -----
// Note: the expirationsNeedUpdate is also set while an admin is working on
// Specials, Featured Products and SaleMaker sales.
//
if (!isset($_SESSION['expirationsNeedUpdate']) || $_SESSION['expirationsNeedUpdate'] === true) {
    // auto expire special products
    zen_start_specials();
    zen_expire_specials();

    // auto expire featured products
    zen_start_featured();
    zen_expire_featured();

    // auto expire salemaker sales
    zen_start_salemaker();
    zen_expire_salemaker();

    $_SESSION['expirationsNeedUpdate'] = false;
}
