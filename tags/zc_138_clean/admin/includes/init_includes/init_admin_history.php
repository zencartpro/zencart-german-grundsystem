<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_history.php 6584 2007-07-12 08:03:03Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  // log page visit into admin activity history
  if (basename($PHP_SELF) != FILENAME_DEFAULT . '.php') {
    $sql_data_array = array( 'access_date' => 'now()',
                             'admin_id' => (int)$_SESSION['admin_id'],
                             'page_accessed' =>  basename($PHP_SELF) . (!isset($_SESSION['admin_id']) || (int)$_SESSION['admin_id'] == 0 ? ' ' . (isset($_POST['admin_name']) ? $_POST['admin_name'] : (isset($_POST['admin_email']) ? $_POST['admin_email'] : '') ) : ''),
                             'page_parameters' => zen_get_all_get_params(),
                             'ip_address' => substr($_SERVER['REMOTE_ADDR'],0,15)
                             );
    zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
  }
?>