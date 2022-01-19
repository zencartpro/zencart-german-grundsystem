<?php
/**
 * config.zca_layout.php
 *
 * @package initSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: config.zca_layout.php 2022-01-19 20:25:16Z webchills $
 */
	
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}

$autoLoadConfig[115][] = array('autoType'=>'init_script',
                               'loadFile'=> 'init_zca_layout.php');
