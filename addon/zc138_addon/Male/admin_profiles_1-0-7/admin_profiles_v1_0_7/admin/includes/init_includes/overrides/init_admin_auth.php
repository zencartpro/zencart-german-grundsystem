<?php
/**
 * @package admin
 * @copyright Copyright kuroi web design 2006-2007
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_auth.php - amended for Admin Profiles 2007-04-30 by kuroi
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  if (!(basename($PHP_SELF) == FILENAME_LOGIN . ".php")) {
  	$page = basename($PHP_SELF, ".php");
  	if ($page != FILENAME_DEFAULT &&
		$page != FILENAME_PRODUCT &&
		$page != FILENAME_LOGOFF &&
		$page != FILENAME_ALT_NAV &&
		$page != FILENAME_PASSWORD_FORGOTTEN &&
		$page != 'denied') {
		if (check_page($page) == 'false') header("location: denied.php");
	}
    if (!isset($_SESSION['admin_id'])) {
      if (!(basename($PHP_SELF) == FILENAME_PASSWORD_FORGOTTEN . '.php')) {
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }
    }
  }


  if ((basename($PHP_SELF) == FILENAME_LOGIN . '.php') and (substr_count(dirname($PHP_SELF),'//') > 0 or substr_count(dirname($PHP_SELF),'.php') > 0)) {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
?>