<?php
/**
 * @package Admin Profiles
 * @copyright Copyright 2006-2010 Kuroi Web Design
 * @copyright Portions Copyright 2003-2010 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_auth.php 367 2010-05-23 20:09:00Z kuroi $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (strpos(strtolower($PHP_SELF),FILENAME_PASSWORD_FORGOTTEN.'.php') !== FALSE &&
    substr_count(strtolower($PHP_SELF), '.php') > 1)
{
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (!(basename($PHP_SELF) == FILENAME_LOGIN . ".php"))
{
  $page = basename($PHP_SELF, ".php");
  if (!in_array($page, array(FILENAME_DEFAULT,FILENAME_PRODUCT,FILENAME_LOGOFF,FILENAME_ALT_NAV,FILENAME_PASSWORD_FORGOTTEN,FILENAME_DENIED)))
  {
    if (check_page($page) == FALSE)
    {
      header("location: ".FILENAME_DENIED.".php");
    }
  }
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
