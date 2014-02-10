<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 729 2011-08-09 15:49:16Z hugo13 $
 */

  $zc_install->resetConfigKeys();

  if (isset($_POST['submit'])) {
    if (isset($_POST['license_consent']) && $_POST['license_consent'] == 'agree') {
      header('location: index.php?main_page=inspect' . zcInstallAddSID() );
      exit;
    }
    if (isset($_POST['license_consent']) && $_POST['license_consent'] == 'disagree') {
      header('location: index.php' . zcInstallAddSID() );
      exit;
    }
  }
?>