<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_sent.php 630 2019-06-16 17:39:16Z webchills $
 */

require 'gv_name.php';
define('HEADING_TITLE', TEXT_GV_NAMES .' versandt');
define('TABLE_HEADING_SENDERS_NAME', 'Name des Absenders');
define('TABLE_HEADING_VOUCHER_VALUE', TEXT_GV_NAME . ' Value');
define('TABLE_HEADING_VOUCHER_CODE', TEXT_GV_REDEEM);
define('TABLE_HEADING_DATE_SENT', 'Gesendet am');
define('TEXT_HEADING_DATE_REDEEMED', 'Einlösedatum');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_SENDERS_ID', 'Absender ID:');
define('TEXT_INFO_AMOUNT_SENT', 'Betrag gesendet:');
define('TEXT_INFO_DATE_SENT', 'Gesendet am:');
define('TEXT_INFO_VOUCHER_CODE', TEXT_GV_REDEEM . ':');
define('TEXT_INFO_EMAIL_ADDRESS', 'E-Mail Adresse:');
define('TEXT_INFO_DATE_REDEEMED', 'Einlösedatum:');
define('TEXT_INFO_IP_ADDRESS', 'IP Adresse:');
define('TEXT_INFO_CUSTOMERS_ID', 'Kundennummer:');
define('TEXT_INFO_NOT_REDEEMED', 'Nicht eingelöst');