<?php
/**
 * ajaxTestSystemSetup.php
 * @package Installer
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxTestSystemSetup.php 2 2019-04-12 13:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error = FALSE;
$errorList = array();

//physical path tests

if (!file_exists($_POST['physical_path']. '/includes/vers' . 'ion.php'))
{
  $error = TRUE;
  $errorList[] = TEXT_SYSTEM_SETUP_ERROR_CATALOG_PHYSICAL_PATH;
}

echo json_encode(array('error'=>$error, 'errorList'=>$errorList));
