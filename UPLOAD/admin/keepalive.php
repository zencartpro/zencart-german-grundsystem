<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: keepalive.php 2021-10-24 17:47:36Z webchills $
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