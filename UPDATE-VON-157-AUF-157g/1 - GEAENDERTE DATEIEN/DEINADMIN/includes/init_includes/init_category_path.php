<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_category_path.php 2023-10-29 16:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// calculate category path
$cPath = $_POST['cPath'] ?? $_GET['cPath'] ?? '';

if (empty($cPath)) {
    $cPath_array = [];
    $current_category_id = TOPMOST_CATEGORY_PARENT_ID;
} else {
    $cPath_array = zen_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(count($cPath_array) - 1)];

    // -----
    // If the current category_id is invalid (i.e. not present in the database),
    // issue a message and redirect the admin to the category_product_listing page.
    //
    if (zen_get_categories_status($current_category_id) === '') {
        $messageStack->add_session(sprintf(WARNING_CATEGORY_DOES_NOT_EXIST, (int)$current_category_id), 'warning');
        zen_redirect(zen_href_link(FILENAME_CATEGORY_PRODUCT_LISTING));
    }
}
