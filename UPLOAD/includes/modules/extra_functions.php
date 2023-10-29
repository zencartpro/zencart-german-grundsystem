<?php
/**
 * Load in any user functions
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: extra_functions.php 2023-10-29 15:49:16Z webchills $
 */
use Zencart\FileSystem\FileSystem;

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$extraFuncsMain = (new FileSystem)->listFilesFromDirectoryAlphaSorted(DIR_WS_FUNCTIONS . 'extra_functions/', '~^[^\._].*\.php$~i');
$extraFuncsMain = collect($extraFuncsMain)->map(function ($item, $key) {
    return DIR_WS_FUNCTIONS . 'extra_functions/' . $item;
})->toArray();
$context = (new FileSystem)->isAdminDir(__DIR__) ? 'admin' : 'catalog';
$extraFuncsPlugins = [];
foreach ($installedPlugins as $plugin) {
    $path = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'] . '/' . $context . '/' . DIR_WS_FUNCTIONS . 'extra_functions/';
    $efPluginFile = (new FileSystem)->listFilesFromDirectoryAlphaSorted($path, '~^[^\._].*\.php$~i');
    $efPluginFile = collect($efPluginFile)->map(function ($item, $key) use ($path) {
        return $path . $item;
    })->toArray();
    $extraFuncsPlugins = array_merge($extraFuncsPlugins, $efPluginFile);
}
$extraFuncsFiles = array_merge($extraFuncsPlugins, $extraFuncsMain);

foreach ($extraFuncsFiles as $file) {
    if (!file_exists($file)) {
        continue;
    }
    include($file);
}

unset($extraFuncsMain, $extraFuncsPlugins, $extraFuncsFiles, $efPluginFile, $file);
