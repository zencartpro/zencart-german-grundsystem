<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: download_time_out.php 294 2015-12-23 19:28:14Z webchills $
 */

define('NAVBAR_TITLE', 'Ihr Download ...');
define('HEADING_TITLE', 'Ihr Download ...');

define('TEXT_INFORMATION', 'Leider ist Ihr Download abgelaufen.<br /><br />
  Falls Sie weitere Downloads haben und Sie fortsetzen wollen,
  gehen Sie bitte auf Ihre <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mein Konto</a>-Seite.<br /><br />
  Falls Probleme bei Ihrem Download auftreten, bitte <a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">kontaktieren Sie uns</a> <br /><br />
  Vielen Dank!
  ');