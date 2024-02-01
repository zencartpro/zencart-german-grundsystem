<?php
/**
 * product_free_shipping_info header_php.php
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2024-02-01 11:46:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_PRODUCT_FREE_SHIPPING_INFO');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$product_info = zen_get_product_details($products_id_current = (!empty($_GET['products_id']) ? (int)$_GET['products_id'] : 0));
if ($current_page !== $product_info->fields['type_handler'] . '_info') {
    zen_redirect(zen_href_link($product_info->fields['type_handler'] . '_info', zen_get_all_get_params()));
}

zen_product_set_header_response($products_id_current, $product_info);

// ensure navigation snapshot is set in order to "go back" in case must-be-logged-in-for-price is enabled
if (!zen_is_logged_in()) {
    $_SESSION['navigation']->set_snapshot();
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_PRODUCT_FREE_SHIPPING_INFO');
