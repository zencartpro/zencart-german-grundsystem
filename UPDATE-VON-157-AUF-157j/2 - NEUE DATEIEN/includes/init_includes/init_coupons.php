<?php
/**
 * Zen Cart German Specific (200 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_coupon.php 2024-04-08 17:29:12Z webchills $
 */
/**
 * Return a coupon code found in $_GET['coupon_code'], if any.
 *
 * @return ?string the coupon_code if found, else null.
 */
function initCouponRequestCheck() {
    if (empty($_GET['coupon_code'])) {
        return null;
    }
    return zen_db_prepare_input($_GET['coupon_code']);
}

/**
 * Look for any coupon_code, validate it and apply it.
 *
 * @return void
 */
function initCouponChecks() {
    global $languageLoader, $messageStack;
    $coupon_code = initCouponRequestCheck();    
    if (empty($coupon_code)) {
        return;
    }

    // Load the ot_coupon module and its lang strings, for more validation.
    $module_file = DIR_WS_MODULES . 'order_total/ot_coupon.php';
    include_once($module_file);
    $languageLoader->loadExtraLanguageFiles(DIR_FS_CATALOG . DIR_WS_LANGUAGES, $_SESSION['language'], 'ot_coupon.php', '/modules/order_total');
    $ot_coupon = new ot_coupon;
    if (!$ot_coupon->check()) {
        return;
    }

    $coupon_id = $ot_coupon->performValidations($coupon_code);
    if (empty($coupon_id)) {
        // The coupon could not be applied for some reason
        $ot_coupon->setMessageStackValidationAlerts();
        return;
    }

    if (!empty($_SESSION['cc_id']) && $_SESSION['cc_id'] === $coupon_id) {
        // The coupon is already active.
        return;
    }

    // We found and validated the coupon successfully.
    $_SESSION['cc_id'] = $coupon_id;
    $messageStack->add('header', TEXT_VALID_COUPON, 'success');
}

initCouponChecks();
