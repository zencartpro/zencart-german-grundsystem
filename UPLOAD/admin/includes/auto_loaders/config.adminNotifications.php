<?php
/**
 * @package admin
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: Zcwilt Thu Nov 1 17:28:42 2018 +0000 New in v1.5.6 $
 */
if (!defined('IS_ADMIN_FLAG')) { die('Illegal Access'); }

$autoLoadConfig[0][] = array(
	'autoType'=>'class',
	'loadFile'=>'AdminNotifications.php',
	'classPath'=> DIR_FS_ADMIN . DIR_WS_CLASSES
);
