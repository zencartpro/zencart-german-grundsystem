<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 734 2011-08-10 08:58:41Z hugo13 $
 */

  // require_once('../includes/configure.php');
  if(file_exists('../' . $_SESSION[installerConfigKeys][NEWADMIN_PATH] . '/includes/configure.php')) {
    require_once('../' . $_SESSION[installerConfigKeys][NEWADMIN_PATH] . '/includes/configure.php');
    $newadmin_path = $_SESSION[installerConfigKeys][NEWADMIN_PATH];
  } else {
    require_once('../admin/includes/configure.php');
    $newadmin_path = 'admin';
  }

  