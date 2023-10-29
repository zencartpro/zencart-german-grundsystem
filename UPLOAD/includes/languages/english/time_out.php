<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: time_out.php 2023-10-29 07:49:16Z webchills $
 */

define('NAVBAR_TITLE', 'Login Time Out');
define('HEADING_TITLE', 'Whoops! Your session has expired.');
define('HEADING_TITLE_LOGGED_IN', 'Whoops! Sorry, but you are not allowed to perform the action requested. ');
define('TEXT_INFORMATION', '<p>If you were placing an order, please login and your shopping cart will be restored. You may then go back to the checkout and complete your final purchases.</p><p>If you had completed an order and wish to review it' . (DOWNLOAD_ENABLED == 'true' ? ', or had a download and wish to retrieve it' : '') . ', please go to your <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">My Account</a> page to view your order.</p>');

define('TEXT_INFORMATION_LOGGED_IN', 'You are still logged in to your account and may continue shopping. Please choose a destination from a menu.');

define('HEADING_RETURNING_CUSTOMER', 'Login');
