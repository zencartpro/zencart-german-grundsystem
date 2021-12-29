<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: download_time_out.php 730 2015-12-22 17:49:16Z webchills $
 */

define('NAVBAR_TITLE', 'Your Download ...');
define('HEADING_TITLE', 'Your Download ...');

define('TEXT_INFORMATION', 'We\'re sorry but your download has expired.<br /><br />
  If you had other downloads and wish to retrieve them,
  please go to your <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">My Account</a> page to view your order.<br /><br />
  Or, if you believe that there is a problem with your order, please <a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">Contact Us</a> <br /><br />
  Thank you!
  ');