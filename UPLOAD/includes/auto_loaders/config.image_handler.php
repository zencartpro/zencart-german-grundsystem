<?php
/**
 * @package Image Handler 5.3.0
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018-2022 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: config.image_handler.php 2022-09-06 08:51:51Z webchills $
 */
 
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// ----
// Initialize the plugin's observer ...
// 
$autoLoadConfig[200][] = [
    'autoType' => 'class',
    'loadFile' => 'observers/ImageHandlerObserver.php'
];
$autoLoadConfig[200][] = [
    'autoType' => 'classInstantiate',
    'className' => 'ImageHandlerObserver',
    'objectName' => 'imageHandlerObserver'
];
