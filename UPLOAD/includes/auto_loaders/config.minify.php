<?php
/**
 * CSS/JS Loader - Minify
 *
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @author yellow1912 (RubikIntegration.com)
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: config_minify.php 2014-03-23 09:34:05 webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 
             	
$autoLoadConfig[200][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_minify.php');