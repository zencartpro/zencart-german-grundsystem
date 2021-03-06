<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ot_coupon.php 730 2019-06-15 17:49:16Z webchills $
 */

  define('MODULE_ORDER_TOTAL_COUPON_TITLE', 'Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_HEADER', TEXT_GV_NAMES . '/Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_DESCRIPTION', 'Discount Coupon');
  define('MODULE_ORDER_TOTAL_COUPON_TEXT_ENTER_CODE', TEXT_GV_REDEEM);
  define('SHIPPING_NOT_INCLUDED', ' [Shipping not included]');
  define('TAX_NOT_INCLUDED', ' [Tax not included]');
  define('IMAGE_REDEEM_VOUCHER', 'Redeem Voucher');
  define('MODULE_ORDER_TOTAL_COUPON_REDEEM_INSTRUCTIONS', '<p>Please type your coupon code into the box next to  Redemption Code. Your coupon will be applied to the total and reflected in your cart after you click continue.</p><p>Please note: you may only use one coupon per order.</p>');
  define('MODULE_ORDER_TOTAL_COUPON_TEXT_CURRENT_CODE', 'Your Current Redemption Code: ');
  define('TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER', 'REMOVE');
  define('MODULE_ORDER_TOTAL_COUPON_REMOVE_INSTRUCTIONS', '<p>To remove a Discount Coupon from this order replace the coupon code with: ' . TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER . '</p>');
  define('TEXT_REMOVE_REDEEM_COUPON', 'Discount Coupon Removed by Request!');
  define('MODULE_ORDER_TOTAL_COUPON_INCLUDE_ERROR', ' Setting Include tax = true, should only happen when recalculate = None');