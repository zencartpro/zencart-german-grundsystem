<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_category_path.php 2023-10-23 14:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// calculate category path
if (isset($_POST['cPath'])) {
    $cPath = $_POST['cPath'];
} elseif (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
} else {
    $cPath = '';
}

if (zen_not_null($cPath)) {
    $cPath_array = zen_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(count($cPath_array) - 1)];
} else {
    $cPath_array = [];
    $current_category_id = TOPMOST_CATEGORY_PARENT_ID;
}
