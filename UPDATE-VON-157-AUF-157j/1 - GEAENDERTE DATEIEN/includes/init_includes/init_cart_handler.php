<?php
/**
 * initialise and handle cart actions
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_cart_handler.php 730 2014-02-08 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (isset($_GET['action'])) {
  /**
   * redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
   */
  if ($session_started == false) {
    zen_redirect(zen_href_link(FILENAME_COOKIE_USAGE));
  }
  if (DISPLAY_CART == 'true') {
    $goto =  FILENAME_SHOPPING_CART;
    $parameters = array('action', 'cPath', 'products_id', 'pid', 'main_page');
  } else {
    $chk_handler = zen_get_info_page(isset($_GET['products_id']) ? $_GET['products_id'] : 0);
    $goto = $_GET['main_page'];
    if ($_GET['action'] == 'buy_now') {
      if (strpos($goto, 'reviews') > 5) {
        $parameters = array('action');
        $goto = FILENAME_PRODUCT_REVIEWS;
      } else {
        $parameters = array('action', 'products_id');
      }
    } elseif ($_GET['main_page'] == $chk_handler) {
      $parameters = array('action', 'pid', 'main_page');
    } else {
      $parameters = array('action', 'pid', 'main_page', 'products_id');
    }
  }
  /**
   * require file containing code to handle default cart actions
   */
  require(DIR_WS_INCLUDES . 'main_cart_actions.php');
}
