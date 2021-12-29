<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_sent.php 2021-12-02 16:39:16Z webchills $
 */


require DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'gv_name.php';
define('HEADING_TITLE', TEXT_GV_NAMES . ' gesandt');
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