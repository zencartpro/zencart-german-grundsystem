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
define('HEADING_TITLE', 'Bereits versandte Geschenkgutscheine');
define('TABLE_HEADING_SENDERS_NAME', 'Name des Absenders');
define('TABLE_HEADING_VOUCHER_VALUE', 'Geschenkgutschein Wert');
define('TABLE_HEADING_VOUCHER_CODE', 'Gutscheinnummer');
define('TABLE_HEADING_DATE_SENT', 'Gesendet am');
define('TEXT_HEADING_DATE_REDEEMED', 'Einlösedatum');

define('TEXT_INFO_SENDERS_ID', 'Absender ID:');
define('TEXT_INFO_AMOUNT_SENT', 'Betrag gesendet:');
define('TEXT_INFO_DATE_SENT', 'Gesendet am:');
define('TEXT_INFO_VOUCHER_CODE', 'Gutscheinnummer:');
define('TEXT_INFO_EMAIL_ADDRESS', 'E-Mail Adresse:');
define('TEXT_INFO_DATE_REDEEMED', 'Einlösedatum:');
define('TEXT_INFO_IP_ADDRESS', 'IP Adresse:');
define('TEXT_INFO_CUSTOMERS_ID', 'Kundennummer:');
define('TEXT_INFO_NOT_REDEEMED', 'Nicht eingelöst');