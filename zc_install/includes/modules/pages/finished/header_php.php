<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

  // require_once('../includes/configure.php');
  if(file_exists('../' . $_SESSION[installerConfigKeys][NEWADMIN_PATH] . '/includes/configure.php')) {
    require_once('../' . $_SESSION[installerConfigKeys][NEWADMIN_PATH] . '/includes/configure.php');
    $newadmin_path = $_SESSION[installerConfigKeys][NEWADMIN_PATH];
  } else {
    require_once('../admin/includes/configure.php');
    $newadmin_path = 'admin';
  }

  