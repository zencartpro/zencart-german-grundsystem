<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: currency_cron.core.php 2021-10-25 17:12:36Z webchills $
 */
if (!defined('USE_PCONNECT')) define('USE_PCONNECT', 'false');
/**
 * autoloader array for admin currency_cron.php
 */
  $autoLoadConfig[0][] = array('autoType'=>'require',
                               'loadFile'=> DIR_FS_CATALOG . DIR_WS_INCLUDES .  'version.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                               'loadFile'=>'class.notifier.php');
  $autoLoadConfig[0][] = array('autoType'=>'classInstantiate',
                               'className'=>'notifier',
                               'objectName'=>'zco_notifier');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                               'loadFile'=>'sniffer.php');
  $autoLoadConfig[0][] = array('autoType'=>'class',
                               'loadFile'=>'object_info.php',
                               'classPath'=>DIR_WS_CLASSES);
  $autoLoadConfig[20][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_db_config_read.php');
  $autoLoadConfig[30][] = array('autoType'=>'classInstantiate',
                                'className'=>'sniffer',
                                'objectName'=>'sniffer');
  $autoLoadConfig[40][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_general_funcs.php');
  $autoLoadConfig[60][] = array('autoType'=>'require',
                                'loadFile'=> DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php');
  $autoLoadConfig[70][] = array('autoType'=>'init_script',
                                'loadFile'=> 'init_languages.php');
  $autoLoadConfig[90][] = array('autoType'=>'require',
                                 'loadFile'=> DIR_WS_FUNCTIONS . 'localization.php');
  $autoLoadConfig[120][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_special_funcs.php');
//   $autoLoadConfig[140][] = array('autoType'=>'init_script',
//                                  'loadFile'=> 'init_errors.php');
  $autoLoadConfig[170][] = array('autoType'=>'init_script',
                                 'loadFile'=> 'init_admin_history.php');

  $autoLoadConfig[1][] = array('autoType'=>'class',
                               'loadFile'=>'class.admin.zcObserverLogEventListener.php',
                               'classPath'=>DIR_WS_CLASSES);
  $autoLoadConfig[40][] = array('autoType'=>'classInstantiate',
                               'className'=>'zcObserverLogEventListener',
                               'objectName'=>'zcObserverLogEventListener');

