<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 7415 2007-11-11 06:19:40Z drbyte $
 */

  if (!isset($_POST['admin_username'])) $_POST['admin_username'] = '';
  if (!isset($_POST['admin_email'])) $_POST['admin_email'] = '';

  @require_once('../includes/configure.php');
  if (!defined('DB_TYPE') || DB_TYPE=='') {
    die('Database Type Invalid. Did your configure.php file get written correctly?');
    $zc_install->setError('Database Type Invalid', 27);
  }

  if (isset($_POST['submit'])) {
    if (!isset($_POST['admin_pass'])) $_POST['admin_pass'] = '';
    if (!isset($_POST['admin_pass_confirm'])) $_POST['admin_pass_confirm'] = '';
    if (!isset($_POST['check_for_updates'])) $_POST['check_for_updates'] = 'True';

    $zc_install->validateAdminSetup($_POST);
    $zc_install->isEqual($zc_install->configInfo['admin_pass'], zen_db_prepare_input($_POST['admin_pass_confirm']), ERROR_TEXT_ADMIN_PASS_NOTEQUAL, ERROR_CODE_ADMIN_PASS_NOTEQUAL);

    if (!$zc_install->error) {
      $zc_install->dbAdminSetup();
      $zc_install->resetConfigKeys();
      $zc_install->resetConfigInfo();
      header('location: index.php?main_page=finished' . zcInstallAddSID() );
      exit;
    }
  }

  setInputValue($_POST['admin_username'], 'ADMIN_USERNAME_VALUE', '');
  setInputValue($_POST['admin_email'], 'ADMIN_EMAIL_VALUE', '');

// this sets the first field to email address on login - setting in /common/tpl_main_page.php
  $zc_first_field= 'onload="document.getElementById(\'admin_username\').focus()"';

?>