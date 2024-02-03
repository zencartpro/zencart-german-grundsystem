<?php
/**
 * ajaxTestSystemSetup.php
 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxTestSystemSetup.php 2024-02-02 13:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error = false;
$errorList = [];

//physical path tests

if (!file_exists($_POST['physical_path'] . '/includes/vers' . 'ion.php')) {
    $error = true;
    $errorList[] = TEXT_SYSTEM_SETUP_ERROR_CATALOG_PHYSICAL_PATH;
}

echo json_encode(['error' => $error, 'errorList' => $errorList]);
