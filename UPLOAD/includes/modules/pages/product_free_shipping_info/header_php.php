<?php
/**
 * product_free_shipping_info header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2020-01-16 11:04:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_PRODUCT_FREE_SHIPPING_INFO');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));



// ensure navigation snapshot is set in order to "go back" in case must-be-logged-in-for-price is enabled
if (!zen_is_logged_in()) {
    $_SESSION['navigation']->set_snapshot();
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_PRODUCT_FREE_SHIPPING_INFO');
