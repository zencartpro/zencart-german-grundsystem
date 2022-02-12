<?php
/**
 * @package Installer
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2016-02-28 16:21:39Z webchills $
 */

  @unlink(DEBUG_LOG_FOLDER . '/progress.json');
  require (DIR_FS_INSTALL . 'includes/classes/class.zcDatabaseInstaller.php');
  $changedDir = (bool)$_POST['changedDir'];
  $adminDir = $_POST['adminDir'];
  $adminNewDir = $_POST['adminNewDir'];
  if (defined('DEVELOPER_MODE') && DEVELOPER_MODE === true)
  {
    $admin_password = 'developer1';
  } else {
    $admin_password = zen_create_PADSS_password();
  }
  if (isset($_POST['upgrade_mode']) && $_POST['upgrade_mode'] == 'yes')
  {
    $isUpgrade = TRUE;
  } else if (isset($_POST['http_server_catalog']))
  {
    $isUpgrade = FALSE;
    require (DIR_FS_INSTALL . 'includes/classes/class.zcConfigureFileWriter.php');
    $result = new zcConfigureFileWriter($_POST);

    $errors = $result->errors;
  }
