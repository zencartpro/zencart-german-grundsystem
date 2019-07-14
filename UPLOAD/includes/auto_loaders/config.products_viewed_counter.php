<?php
/**
 *
 * @package statistics
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version GIT: $Id: Author: DrByte  Tue Aug 28 14:21:34 2012 -0400 New in v1.5.1 $
 */
/**
 * Designed for v1.5.1
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}
$autoLoadConfig[190][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.products_viewed_counter.php');
$autoLoadConfig[190][] = array('autoType'=>'classInstantiate',
                              'className'=>'products_viewed_counter',
                              'objectName'=>'products_viewed_counter');
