<?php
/**
 * @package plugins
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version GIT: $Id: Author: DrByte  Jun 30 2014 New in v1.5.4 $
 *
 * Designed for v1.5.4+
 * Loadpoint 1 is to simply load this file
 * Loadpoint 40 is for instantiating the observer class after dependencies are loaded
 *
 */
  $autoLoadConfig[1][] = array('autoType'=>'class',
                               'loadFile'=>'class.admin.zcObserverLogEventListener.php',
                               'classPath'=>DIR_WS_CLASSES);
  $autoLoadConfig[65][] = array('autoType'=>'classInstantiate',
                               'className'=>'zcObserverLogEventListener',
                               'objectName'=>'zcObserverLogEventListener');
