<?php
/**
 * autoloader activation point for canonical url handling script
 *
 * @package initSystem
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.canonical.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
/**
 * point 161 was selected specifically based on dependancies
 */
  $autoLoadConfig[161][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_canonical.php');
