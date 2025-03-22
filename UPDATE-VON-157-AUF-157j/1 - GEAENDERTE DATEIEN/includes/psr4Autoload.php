<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: psr4Autoload.php 2024-10-16 16:09:16Z webchills $
 */
$psr4Autoloader->addPrefix('Zencart\QueryBuilder', DIR_FS_CATALOG . DIR_WS_CLASSES);
$psr4Autoloader->addPrefix('Zencart\Traits', DIR_FS_CATALOG . DIR_WS_CLASSES . 'traits');
$psr4Autoloader->addPrefix('Zencart\FileSystem', DIR_FS_CATALOG . DIR_WS_CLASSES );
$psr4Autoloader->addPrefix('Zencart\InitSystem', DIR_FS_CATALOG . DIR_WS_CLASSES );
$psr4Autoloader->addPrefix('Zencart\PluginManager', DIR_FS_CATALOG . DIR_WS_CLASSES);
$psr4Autoloader->addPrefix('Zencart\LanguageLoader', DIR_FS_CATALOG . DIR_WS_CLASSES . 'ResourceLoaders');
$psr4Autoloader->addPrefix('Zencart\ResourceLoaders', DIR_FS_CATALOG . DIR_WS_CLASSES . 'ResourceLoaders');
$psr4Autoloader->addPrefix('Zencart\PageLoader', DIR_FS_CATALOG . DIR_WS_CLASSES . 'ResourceLoaders');
$psr4Autoloader->addPrefix('Zencart\Events', DIR_FS_CATALOG . DIR_WS_CLASSES );
$psr4Autoloader->addPrefix('Zencart\PluginSupport', DIR_FS_CATALOG . DIR_WS_CLASSES . 'PluginSupport');
$psr4Autoloader->addPrefix('Zencart\ViewBuilders', DIR_FS_CATALOG . DIR_WS_CLASSES . 'ViewBuilders');
$psr4Autoloader->addPrefix('Zencart\Exceptions', DIR_FS_CATALOG . DIR_WS_CLASSES . 'Exceptions');
$psr4Autoloader->addPrefix('Zencart\Filters', DIR_FS_CATALOG . DIR_WS_CLASSES . 'Filters');
$psr4Autoloader->addPrefix('Zencart\Request', DIR_FS_CATALOG . DIR_WS_CLASSES);
if (defined('DIR_FS_ADMIN')) {
    $psr4Autoloader->addPrefix('Zencart\Paginator', DIR_FS_ADMIN . DIR_WS_CLASSES);
} else {
 $psr4Autoloader->setClassFile('Zencart\Search\Search', DIR_FS_CATALOG . DIR_WS_CLASSES . 'class.search.php');
}
