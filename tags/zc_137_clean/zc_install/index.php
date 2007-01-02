<?php
/**
 * index.php -- This is the main hub file for the Zen Cart installer *
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 4022 2006-07-25 01:07:37Z drbyte $
 */

  define('IS_ADMIN_FLAG',false);
  require('includes/application_top.php');

  /* This is for debug purposes to run installer from SSH command line. Set to true to enable it:  */
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

  if (!isset($_GET['main_page']) || !zen_not_null($_GET['main_page'])) $_GET['main_page'] = 'index';
  $current_page = $_GET['main_page'];
  $page_directory = 'includes/modules/pages/' . $current_page;
  $language_page_directory = 'includes/languages/' . $language . '/';
  require('includes/languages/' . $language . '.php');

  // init vars:
	$zc_first_field = '';

  // lang must be loaded before the header module
  require('includes/languages/' . $language . '/' . $current_page . '.php');
  require($page_directory . '/header_php.php');

  require(DIR_WS_INSTALL_TEMPLATE . 'common/html_header.php');
  require(DIR_WS_INSTALL_TEMPLATE . 'common/main_template_vars.php');
  require(DIR_WS_INSTALL_TEMPLATE . 'common/tpl_main_page.php');
?>