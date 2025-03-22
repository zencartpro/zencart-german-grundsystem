<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: application_top.php 2024-02-20 09:56:36Z webchills $
 */

if (PHP_VERSION_ID < 80002) {
    die('Sorry, this version of Zen Cart German requires PHP 8.0.2 or greater.');
}

/**
 * Bootstrap file contains former application_top code
 *
 * Initializes common classes & methods. Controlled by an array which describes
 * the elements to be initialised and the order in which that happens.
 *
 */
require_once('includes/application_bootstrap.php');
/**
 * Prepare init-system
 */

use Zencart\InitSystem\InitSystem;
use Zencart\FileSystem\FileSystem;

$autoLoadConfig = array();
if (isset($loaderPrefix)) {
  $loaderPrefix = preg_replace('/[^a-z_]/', '', $loaderPrefix);
} else {
  $loaderPrefix = 'config';
}
$loader_file = $loaderPrefix . '.core.php';
$initSystem = new InitSystem('admin', $loaderPrefix, new FileSystem, $pluginManager, $installedPlugins);

if (defined('DEBUG_AUTOLOAD') && DEBUG_AUTOLOAD == true) $initSystem->setDebug(true);

$loaderList = $initSystem->loadAutoLoaders();
$initSystemList = $initSystem->processLoaderList($loaderList);

require(DIR_FS_CATALOG . 'includes/autoload_func.php');