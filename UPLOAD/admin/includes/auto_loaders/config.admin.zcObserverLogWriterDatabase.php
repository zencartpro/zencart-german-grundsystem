<?php
/**
 * @package plugins
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: config.admin.zcObserverLogWriterDatabase.php 2021-12-28 17:56:29Z webchills $
 *
 * Designed for v1.5.4+
 * Loadpoint 1 is to simply load this file
 * Loadpoint 40 is for instantiating the observer class after dependencies are loaded
 *
 */
  $autoLoadConfig[1][] = array('autoType'=>'class',
                               'loadFile'=>'class.admin.zcObserverLogWriterDatabase.php',
                               'classPath'=>DIR_WS_CLASSES);
  $autoLoadConfig[65][] = array('autoType'=>'classInstantiate',
                               'className'=>'zcObserverLogWriterDatabase',
                               'objectName'=>'zcObserverLogWriterDatabase');
