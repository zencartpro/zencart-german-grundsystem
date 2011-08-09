<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

  require('includes/application_top.php');
  error_reporting(E_ALL);
  unset($_SESSION['admin_id']);
  zen_session_destroy();
  require('includes/application_bottom.php');
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  exit();