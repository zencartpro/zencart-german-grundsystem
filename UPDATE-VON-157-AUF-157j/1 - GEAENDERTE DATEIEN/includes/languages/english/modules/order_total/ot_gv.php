<?php
/**
 * Zen Cart German Specific (zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ot_gv.php 2023-10-29 20:49:16Z webchills $
 */

  define('MODULE_ORDER_TOTAL_GV_TITLE', 'Gift Certificates');
  define('MODULE_ORDER_TOTAL_GV_HEADER', 'Gift Certificates/Discount Coupons');
  define('MODULE_ORDER_TOTAL_GV_DESCRIPTION', 'Gift Certificates');
  define('MODULE_ORDER_TOTAL_GV_USER_PROMPT', 'Apply Amount: ');
  define('MODULE_ORDER_TOTAL_GV_TEXT_ENTER_CODE', 'Redemption Code');
  define('TEXT_INVALID_REDEEM_AMOUNT', 'It appears that the amount you have tried to apply and your Gift Certificate balance do not match. Please try again.');
  define('MODULE_ORDER_TOTAL_GV_USER_BALANCE', 'Available balance: ');
  define('MODULE_ORDER_TOTAL_GV_REDEEM_INSTRUCTIONS', '<p>To use Gift Certificate funds already in your account, type the amount you wish to apply in the box that says \'Apply Amount\'. You will need to choose a payment method,  then click the continue button to apply the funds to your shopping cart.</p><p>If you are redeeming a <em>new</em> Gift Certificate you should type the number into the box next to Redemption Code. The amount redeemed will be added to your account when you click the continue button.</p>');
  define('MODULE_ORDER_TOTAL_GV_INCLUDE_ERROR', ' Setting Include tax = true, should only happen when recalculate = None');