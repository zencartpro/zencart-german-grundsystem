<?php
/**
 * pre-calculate the category path
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_category_path.php 2023-10-23 14:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$show_welcome = false;
if (isset($_GET['cPath'])) {
  $cPath = $_GET['cPath'];
} elseif (isset($_GET['products_id']) && !zen_check_url_get_terms()) {
  $cPath = zen_get_product_path($_GET['products_id']);
} else {
  if ($current_page == 'index' && SHOW_CATEGORIES_ALWAYS == '1' && !zen_check_url_get_terms()) {
    $show_welcome = true;
    $cPath = (defined('CATEGORIES_START_MAIN') ? CATEGORIES_START_MAIN : '');
  } else {
    $show_welcome = false;
    $cPath = '';
  }
}
if (zen_not_null($cPath)) {
    $cPath_array = zen_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(count($cPath_array) - 1)];
} else {
    $current_category_id = TOPMOST_CATEGORY_PARENT_ID;
    $cPath_array = [];
}

// determine whether the current page is the home page or a product listing
//$this_is_home_page = ($current_page=='index' && ((int)$cPath == 0 || $show_welcome == true));
$this_is_home_page = ($current_page == 'index'
    && (!isset($_GET['cPath']) || $_GET['cPath'] == '')
    && (!isset($_GET['manufacturers_id']) || $_GET['manufacturers_id'] == '')
    && (!isset($_GET['typefilter']) || $_GET['typefilter'] == '')
);
