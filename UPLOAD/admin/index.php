<?php
/**
 
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: index.php 2023-05-20 08:46:12Z webchills $
 */
use Zencart\FileSystem\FileSystem;

require_once('includes/application_bootstrap.php');

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : 'home';
$cmd = ($cmd == 'index') ? 'home' : $cmd;

if (file_exists(basename($cmd . '.php'))) {
    require basename($cmd . '.php');
    exit();
}

$adminPage = FileSystem::getInstance()->findPluginAdminPage($installedPlugins, $cmd);
if (!isset($adminPage)) {
    require 'includes/application_top.php';
    zen_redirect(zen_href_link(FILENAME_DEFAULT));
    exit(0);
}

require($adminPage);