<?php
/**
 * ajaxValidateAdminCredentials.php
 * @package Installer
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: ajaxValidateAdminCredentials.php 1 2015-12-26 21:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error          = FALSE;
$postParams     = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
$systemChecker  = new systemChecker();
$adminCandidate = $systemChecker->validateAdminCredentials(
  trim($postParams['admin_user']),
  trim($postParams['admin_password'])
);

if (!is_int($adminCandidate)) {
  $error = !$adminCandidate;
  $adminCandidate = '';
}

echo json_encode(compact('error', 'adminCandidate'));
