<?php
/**
 
  
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: psr4Autoload.php 2023-05-20 08:14:24Z webchills $
 */
$psr4Autoloader->addPrefix('Zencart\FileSystem', DIR_FS_CATALOG . DIR_WS_CLASSES );
$psr4Autoloader->addPrefix('Zencart\InitSystem', DIR_FS_CATALOG . DIR_WS_CLASSES );
$psr4Autoloader->addPrefix('Zencart\Traits', DIR_FS_CATALOG . DIR_WS_CLASSES . 'traits');
$psr4Autoloader->addPrefix('Zencart\LanguageLoader', DIR_FS_CATALOG . DIR_WS_CLASSES . 'ResourceLoaders');
$psr4Autoloader->addPrefix('Zencart\PluginManager', DIR_FS_CATALOG . DIR_WS_CLASSES);
$psr4Autoloader->addPrefix('Zencart\PluginSupport', DIR_FS_CATALOG . DIR_WS_CLASSES . 'PluginSupport');
$psr4Autoloader->addPrefix('Zencart\QueryBuilder', DIR_FS_CATALOG . DIR_WS_CLASSES);
$psr4Autoloader->addPrefix('Zencart\TableViewControllers', DIR_FS_CATALOG . DIR_WS_CLASSES . 'TableViewControllers');
$psr4Autoloader->addPrefix('Zencart\Exceptions', DIR_FS_CATALOG . DIR_WS_CLASSES . 'Exceptions');
$psr4Autoloader->addPrefix('Zencart\Paginator', DIR_FS_ADMIN . DIR_WS_CLASSES);
