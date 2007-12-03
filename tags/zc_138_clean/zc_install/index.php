<?php
/**
 * index.php -- This is the main hub file for the Zen Cart installer
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 7404 2007-11-11 04:09:50Z drbyte $
 */

  define('IS_ADMIN_FLAG',false);
/*
 * Ensure that the include_path can handle relative paths, before we try to load any files
 */
  if (!strstr(ini_get('include_path'), '.')) ini_set('include_path', '.' . PATH_SEPARATOR . ini_get('include_path'));
/*
 * Initialize system core components
 */
  require('includes/application_top.php');

  /* This is for debug purposes to run installer from command line. Set to true to enable it:  */
  if (false) {
    if ($argc > 0) {
      for ($i=1;$i<$argc;$i++) {
        $it = split("=",$argv[$i]);
        $_GET[$it[0]] = $it[1];
        // parse_str($argv[$i],$tmp);
        // $_REQUEST = array_merge($_REQUEST, $tmp);
      }
    }
  }

  // init vars:
	$zc_first_field = '';

  // begin processing page-specific actions
  if (!isset($_GET['main_page']) || !zen_not_null($_GET['main_page'])) $_GET['main_page'] = 'index';
  $current_page = $_GET['main_page'];
  $page_directory = 'includes/modules/pages/' . $current_page;
  $language_page_directory = 'includes/languages/' . $language . '/';
  require($language_page_directory . $current_page . '.php');
  require('includes/languages/' . $language . '.php');


//  $zc_install->logDetails('$_POST = ' . print_r($_POST, true) . print_r($_SESSION, true), $current_page . '-index.php', 'testing_flow');
//  $zc_install->logDetails($zc_install->getConfigKey('*', true), $current_page . '-index.php - before header_php', 'testing_flow');


  require($page_directory . '/header_php.php');
  require(DIR_WS_INSTALL_TEMPLATE . 'common/html_header.php');

//  $zc_install->logDetails($zc_install->getConfigKey('*', true), $current_page . '-index.php - AFTER header_php', 'testing_flow');

  require(DIR_WS_INSTALL_TEMPLATE . 'common/main_template_vars.php');
  require(DIR_WS_INSTALL_TEMPLATE . 'common/tpl_main_page.php');
?>