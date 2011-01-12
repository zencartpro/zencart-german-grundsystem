<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_auth.php 17421 2010-08-31 00:23:52Z drbyte $
 */

if (!defined('IS_ADMIN_FLAG')) die('Illegal Access');

// admin folder rename required
if (!defined('ADMIN_BLOCK_WARNING_OVERRIDE') || ADMIN_BLOCK_WARNING_OVERRIDE == '')
{
  if (basename($_SERVER['SCRIPT_FILENAME']) != FILENAME_ALERT_PAGE . '.php')
  {
    if (substr(DIR_WS_ADMIN, -7) == '/admin/' || substr(DIR_WS_HTTPS_ADMIN, -7) == '/admin/')
    {
      zen_redirect(zen_href_link(FILENAME_ALERT_PAGE));
    }
    $check_path = dirname($_SERVER['SCRIPT_FILENAME']) . '/../zc_install';
    if (is_dir($check_path))
    {
      zen_redirect(zen_href_link(FILENAME_ALERT_PAGE));
    }
  }
}
if (basename($_SERVER['SCRIPT_FILENAME']) != FILENAME_ALERT_PAGE . '.php')
{

  if (strpos(strtolower($PHP_SELF),FILENAME_PASSWORD_FORGOTTEN.'.php') !== FALSE &&
  substr_count(strtolower($PHP_SELF), '.php') > 1)
  {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!(basename($PHP_SELF) == FILENAME_LOGIN . ".php"))
  {
    if (!isset($_SESSION['admin_id']))
    {
      if (!(basename($PHP_SELF) == FILENAME_PASSWORD_FORGOTTEN . '.php'))
      {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }
    }
  }

  if ((basename($PHP_SELF) == FILENAME_LOGIN . '.php') &&
  (substr_count(dirname($PHP_SELF),'//') > 0 || substr_count(dirname($PHP_SELF),'.php') > 0))
  {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
}
