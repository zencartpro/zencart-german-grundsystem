<?php
/**
 * Zen Cart German Specific (zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0 
 * @version $Id: ot_coupon.php 2023-10-29 20:57:14Z webchills $
 */

  define('MODULE_ORDER_TOTAL_COUPON_TITLE', 'Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_HEADER', 'Gift Certificate/Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_DESCRIPTION', 'Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_TEXT_ENTER_CODE', 'Redemption Code');
  define('MODULE_ORDER_TOTAL_COUPON_REDEEM_INSTRUCTIONS', '<p>Please type your coupon code into the box next to  Redemption Code. Your coupon will be applied to the total and reflected in your cart after you click continue.</p><p>Please note: you may only use one coupon per order.</p>');
  define('MODULE_ORDER_TOTAL_COUPON_TEXT_CURRENT_CODE', 'Your Current Redemption Code: ');
  define('TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER', 'REMOVE');
  
  define('TEXT_REMOVE_REDEEM_COUPON', 'Discount Coupon Removed by Request!');
  define('MODULE_ORDER_TOTAL_COUPON_INCLUDE_ERROR', ' Setting Include tax = true, should only happen when recalculate = None');
define('MODULE_ORDER_TOTAL_COUPON_REMOVE_INSTRUCTIONS', '<p>To remove a Discount Coupon from this order replace the coupon code with: ' . TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER . '</p>');