<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxValidateAdminCredentials.php 2022-12-14 10:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require DIR_FS_INSTALL . 'includes/application_top.php';

$error = false;
$systemChecker = new systemChecker();
$adminCandidate = $systemChecker->validateAdminCredentials(
    trim(stripslashes($_POST['admin_user'])),
    trim(stripslashes($_POST['admin_password']))
);

if (!is_int($adminCandidate)) {
    $error = !$adminCandidate;
    $adminCandidate = '';
}

echo json_encode(compact('error', 'adminCandidate'));
