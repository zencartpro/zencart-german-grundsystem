<?php
/**
 * @package admin
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_auth.php 13694 2009-06-30 12:11:46Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  if (strtolower(basename($PHP_SELF)) == FILENAME_PASSWORD_FORGOTTEN . '.php' && substr_count(strtolower($PHP_SELF), '.php') > 1)
  {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL')); 
  }
  if (!(basename($PHP_SELF) == FILENAME_LOGIN . '.php')) {
   if (!(basename($PHP_SELF) == FILENAME_PASSWORD_FORGOTTEN . '.php')) {
    if (!isset($_SESSION['admin_id'])) {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
   }
  }

  if ((basename($PHP_SELF) == FILENAME_LOGIN . '.php') and (substr_count(dirname($PHP_SELF),'//') > 0 or substr_count(dirname($PHP_SELF),'.php') > 0)) {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
?>