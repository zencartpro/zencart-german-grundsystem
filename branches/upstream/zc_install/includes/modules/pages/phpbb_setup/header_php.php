<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 7011 2007-09-15 12:20:46Z drbyte $
 */

// check to see if we're upgrading
$is_upgrade = (int)$zc_install->getConfigKey('is_upgrade');

  if (!isset($_POST['phpbb_use'])) $_POST['phpbb_use'] = 'false';

  if ($_SERVER['DOCUMENT_ROOT'] == '') { // try to calculate docroot
    $docroot = substr($_SERVER['SCRIPT_FILENAME'],0,strpos($_SERVER['SCRIPT_FILENAME'],$_SERVER['PHP_SELF']));
  } else {
    $docroot = $_SERVER['DOCUMENT_ROOT'];
  }
  $phpbb_suggest_dir = '';

  //look for typical paths to phpBB files
  foreach (array('/phpBB2', '/phpbb2', '/phpbb', '/phpBB', '/forum', '/forums') as $testpath) {
    if (@file_exists($docroot . $testpath . '/config.php') )  {
      $phpbb_suggest_dir = $docroot . $testpath;
      break;
    }
    if (@file_exists($docroot . str_replace($docroot,'',$_GET['DIR_FS_CATALOG'] ) . $testpath . '/config.php') && $phpbb_suggest_dir=='')  {
      $phpbb_suggest_dir = $docroot .str_replace($docroot,'',$_GET['DIR_FS_CATALOG'] ) . $testpath ;
      break;
    }
  }
  $phpbb_suggest_dir = (substr($phpbb_suggest_dir,-1)=='/') ? substr($phpbb_suggest_dir,0,(strlen($phpbb_suggest_dir)-1)) : $phpbb_suggest_dir; //remove any trailing slashes
  $phpbb_suggest_dir = str_replace('//','/',$phpbb_suggest_dir); // remove any double-slashes

  if (isset($_POST['submit'])) {
    if ($_POST['phpbb_use'] == 'true') {
      $zc_install->fileExists($_POST['phpbb_dir'] . '/config.php', ERROR_TEXT_PHPBB_CONFIG_NOTEXIST . ' :'. $_POST['phpbb_dir'] . '/config.php',  ERROR_CODE_PHPBB_CONFIG_NOTEXIST);
//    } else {
//      $_POST['phpbb_dir'] = '';  // if option set to "false", then do not enter a path in the configure.php file.
    }

    if (!$zc_install->fatal_error) {
      $zc_install->setConfigKey('DIR_FS_PHPBB', $_POST['phpbb_dir']);
      $zc_install->setConfigKey('PHPBB_ENABLE', $_POST['phpbb_use']);
//      $zc_install->setConfigKey('PHPBB_DB_NAME', $_POST['phpbb_db_name']);
//      $zc_install->setConfigKey('PHPBB_DB_PREFIX', $_POST['phpbb_db_prefix']);
      header('location: index.php?main_page=config_checkup&action=write' . zcInstallAddSID() );
    }
  } //endif 'submit'

  //future use (2 lines):
//  if (!isset($_POST['phpbb_db_name'])) $_POST['phpbb_db_name'] = '';
//  if (!isset($_POST['phpbb_db_prefix'])) $_POST['phpbb_db_prefix'] = '';
  // set defaults
  if (!isset($_POST['phpbb_dir'])) $_POST['phpbb_dir'] = $phpbb_suggest_dir;
  if (!isset($_POST['phpbb_use'])) $_POST['phpbb_use'] = 'false';

  setInputValue($_POST['phpbb_dir'], 'PHPBB_DIR_VALUE', $phpbb_suggest_dir);
  setRadioChecked($_POST['phpbb_use'], 'PHPBB_USE', 'false');
?>