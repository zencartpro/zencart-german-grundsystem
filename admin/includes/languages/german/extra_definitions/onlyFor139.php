<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 *
 *
 * NOTE: This file is only for v1.3.9, and should be deleted when upgrading to v2.x, since its contents will be merged with the main language files.
 *
 *
 */
if (!defined('IS_ADMIN_FLAG'))
{
  die('Illegal Access');
}

define('WARNING_ADMIN_FOLDERNAME_VULNERABLE', '!!!TRANSLATE!!! CAUTION: <a href="http://tutorials.zen-cart.com/index.php?article=33" target="_blank">Your /admin/ foldername should be renamed to something less common</a>, to prevent unauthorized access.');
define('WARNING_EMAIL_SYSTEM_DISABLED', 'WARNING: The email subsystem is turned off. No emails will be sent until it is re-enabled in Admin->Configuration->Email Options.');
define('TEXT_CURRENT_VER_IS', 'You are presently using: ');
define('ERROR_NO_DATA_TO_SAVE', 'ERROR: The data you submitted was found to be empty. YOUR CHANGES HAVE *NOT* BEEN SAVED. You may have a problem with your browser or your internet connection.');
define('TEXT_HIDDEN', 'Hidden');
define('TEXT_VISIBLE', 'Visible');
define('TEXT_HIDE', 'Hide');
define('TEXT_EMAIL', 'Email');
define('TEXT_NOEMAIL', '!!!TRANSLATE!!! No Email');
