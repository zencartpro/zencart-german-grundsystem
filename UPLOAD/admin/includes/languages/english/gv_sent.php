<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_sent.php 2023-10-28 19:49:16Z webchills $
 */


require DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'gv_name.php';
define('HEADING_TITLE', 'Gift Certificates Sent');

define('TABLE_HEADING_SENDERS_NAME', 'Senders Name');
define('TABLE_HEADING_VOUCHER_VALUE', 'Gift Certificate Value');
define('TABLE_HEADING_VOUCHER_CODE', TEXT_GV_REDEEM);
define('TABLE_HEADING_DATE_SENT', 'Date Sent');
define('TEXT_HEADING_DATE_REDEEMED', 'Date Redeemed');


define('TEXT_INFO_SENDERS_ID', 'Senders ID:');
define('TEXT_INFO_AMOUNT_SENT', 'Amount Sent:');
define('TEXT_INFO_DATE_SENT', 'Date Sent:');
define('TEXT_INFO_VOUCHER_CODE', TEXT_GV_REDEEM . ':');
define('TEXT_INFO_EMAIL_ADDRESS', 'Email Addr:');
define('TEXT_INFO_DATE_REDEEMED', 'Date Redeemed:');
define('TEXT_INFO_IP_ADDRESS', 'IP Address:');
define('TEXT_INFO_CUSTOMERS_ID', 'Customer Id:');
define('TEXT_INFO_NOT_REDEEMED', 'Not Redeemed');