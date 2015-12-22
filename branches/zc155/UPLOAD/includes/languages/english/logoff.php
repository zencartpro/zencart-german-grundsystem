<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: logoff.php 729 2011-08-09 15:49:16Z hugo13 $
 */

define('HEADING_TITLE', 'Log Off');
define('NAVBAR_TITLE', 'Log Off');
define('TEXT_MAIN', 'You have been logged off your account. It is now safe to leave the computer.<br /><br />If you had items in your cart, they have been saved. The items inside it will be restored when you <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">log back into your account</span></a>.<br />');