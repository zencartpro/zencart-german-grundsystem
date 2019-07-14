<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: logoff.php 785 2011-09-20 08:13:51Z webchills $
 */

  require('includes/application_top.php');
  unset($_SESSION['admin_id']);
  zen_session_destroy();
  require('includes/application_bottom.php');
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  exit();