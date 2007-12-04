<?php
/**
 * application_top.php Common actions carried out at the start of each page invocation.
 *
 * Initializes common classes & methods. Controlled by an array which describes
 * the elements to be initialised and the order in which that happens.
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: application_top.php 7470 2007-11-24 20:54:50Z drbyte $
 */
/*
 * turn off magic-quotes support, for both runtime and sybase, as both will cause problems if enabled
 */
set_magic_quotes_runtime(0);
if (@ini_get('magic_quotes_sybase') != 0) @ini_set('magic_quotes_sybase', 0);
/**
 * boolean if true the autoloader scripts will be parsed and their output shown. For debugging purposes only.
 */
define('DEBUG_AUTOLOAD', false);
/**
 * boolean used to see if we are in the admin script, obviously set to false here.
 */
define('IS_ADMIN_FLAG', false);
/**
 * integer saves the time at which the script started.
 */
define('PAGE_PARSE_START_TIME', microtime());
//  define('DISPLAY_PAGE_PARSE_TIME', 'true');
@ini_set("arg_separator.output","&");
/**
 * Set the local configuration parameters - mainly for developers
 */
if (file_exists('includes/local/configure.php')) {
  /**
   * load any local(user created) configure file.
   */
  include('includes/local/configure.php');
}
/**
 * set the level of error reporting
 * 
 * Note STRICT_ERROR_REPORTING should never be set to true on a production site. <br />
 * It is mainly there to show php warnings during testing/bug fixing phases.<br />
 * note for strict error reporting we also turn on show_errors as this may be disabled<br />
 * in php.ini. Otherwise we respect the php.ini setting 
 * 
 */
if (defined('STRICT_ERROR_REPORTING') && STRICT_ERROR_REPORTING == true) {
  @ini_set('display_errors', '1');
  error_reporting(E_ALL);
} else {
  error_reporting(0);
}
/**
 * check for and include load application parameters
 */
if (file_exists('includes/configure.php')) {
  /**
   * load the main configure file.
   */
  include('includes/configure.php');
} else {
  require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
  exit;
}
/**
 * if main configure file doesn't contain valid info (ie: is dummy or doesn't match filestructure, display assistance page to suggest running the installer)
 */
if (!defined('DIR_FS_CATALOG') || !is_dir(DIR_FS_CATALOG.'/includes/classes')) {
  require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
  exit;
}
/**
 * include the list of extra configure files
 */
if ($za_dir = @dir(DIR_WS_INCLUDES . 'extra_configures')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/\.php$/', $zv_file) > 0) {
      /**
       * load any user/contribution specific configuration files.
       */
      include(DIR_WS_INCLUDES . 'extra_configures/' . $zv_file);
    }
  }
  $za_dir->close();
}
$autoLoadConfig = array();
if (isset($loaderPrefix)) {
 $loaderPrefix = preg_replace('/[a-z_]^/', '', $loaderPrefix); 
} else {
  $loaderPrefix = 'config';
}
$loader_file = $loaderPrefix . '.core.php';
require('includes/initsystem.php');
/**
 * determine install status
 */
if (( (!file_exists('includes/configure.php') && !file_exists('includes/local/configure.php')) ) || (DB_TYPE == '') || (!file_exists('includes/classes/db/' .DB_TYPE . '/query_factory.php')) || !file_exists('includes/autoload_func.php')) {
  require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
  header('location: zc_install/index.php');
  exit;
}
/**
 * load the autoloader interpreter code.
*/
require('includes/autoload_func.php');
/**
 * load the counter code
**/
// counter and counter history
  require(DIR_WS_INCLUDES . 'counter.php');

// get customers unique IP that paypal does not touch
$customers_ip_address = $_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['customers_ip_address'])) {
  $_SESSION['customers_ip_address'] = $customers_ip_address;
}
?>