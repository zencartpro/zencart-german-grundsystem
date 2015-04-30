<?php
/**
 * autoloader array for catalog application_top.php
 *
 * @package initSystem
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.widerruf_downloads.php 2015-04-14 15:32:00 webchills $
 */ 
$autoLoadConfig[200][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.widerruf_downloads.php');
$autoLoadConfig[200][] = array('autoType'=>'classInstantiate',
                              'className'=>'widerruf_downloads',
                              'objectName'=>'widerruf_downloads');