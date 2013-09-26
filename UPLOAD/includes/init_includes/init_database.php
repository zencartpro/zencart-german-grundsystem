<?php
/**
 * Initialise database driver and connect
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_database.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * require the query_factory clsss based on the DB_TYPE
 */
require('includes/classes/db/' .DB_TYPE . '/query_factory.php');
$db = new queryFactory();

$down_for_maint_source = 'nddbc.html';

if (!$db->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false)) {
  if (file_exists('zc_install/index.php')) {
    header('location: zc_install/index.php');
    exit;
  } elseif (file_exists($down_for_maint_source)) {
    if (defined('HTTP_SERVER') && defined('DIR_WS_CATALOG')) {
      header('location: ' . HTTP_SERVER . DIR_WS_CATALOG . $down_for_maint_source );
    } else {
      header('location: ' . $down_for_maint_source );
//    header('location: mystoreisdown.html');
    }
    exit;
  } else {
    exit;
  }
}
?>