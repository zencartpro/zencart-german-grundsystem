<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: keepalive.php 1 2016-04-09 11:47:36Z webchills $
 */
 
require ('includes/application_top.php');

if (isset($_SESSION['admin_id'])) {
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  echo 'OK';
} else {
  header("HTTP/1.1 401 Unauthorized");
}

require (DIR_WS_INCLUDES . 'application_bottom.php');