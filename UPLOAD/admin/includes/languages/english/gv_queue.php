<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_queue.php 2023-10-28 20:49:16Z webchills $
 */

require DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'gv_name.php';
define('HEADING_TITLE', 'Gift Certificate Release Queue');


define('TABLE_HEADING_ORDERS_ID', 'Order-No.');
define('TABLE_HEADING_VOUCHER_VALUE', 'Gift Certificate Value');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');


define('TEXT_REDEEM_GV_MESSAGE_HEADER', 'You recently purchased a Gift Certificate from our online store.');
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', 'For security reasons this was not made immediately available to you.');
                                          );

define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', 'The Gift Certificate(s) you purchased are worth %s');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', 'Thank you for shopping with us!');

define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', TEXT_GV_NAME . ' Purchase');
define('TEXT_REDEEM_GV_SUBJECT_ORDER',' Order #');

define('TEXT_EDIT_ORDER','Edit Order ID# ');
define('TEXT_GV_NONE','No ' . TEXT_GV_NAME . ' to release');
