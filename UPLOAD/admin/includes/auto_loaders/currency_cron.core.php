<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: currency_cron.core.php 2024-01-12 14:29:36Z webchills $
 */
if (!defined('USE_PCONNECT')) {
    define('USE_PCONNECT', 'false');
}
/**
 * autoloader array for admin currency_cron.php
 */
$autoLoadConfig[0][] = [
    'autoType' => 'require',
    'loadFile' => DIR_FS_CATALOG . DIR_WS_INCLUDES . 'version.php',
];
$autoLoadConfig[0][] = [
    'autoType' => 'class',
    'loadFile' => 'class.notifier.php',
];
$autoLoadConfig[0][] = [
    'autoType' => 'classInstantiate',
    'className' => 'notifier',
    'objectName' => 'zco_notifier',
];
$autoLoadConfig[0][] = [
    'autoType' => 'class',
    'loadFile' => 'sniffer.php',
];
$autoLoadConfig[0][] = [
    'autoType' => 'class',
    'loadFile' => 'object_info.php',
    'classPath' => DIR_WS_CLASSES,
];
$autoLoadConfig[20][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_db_config_read.php',
];
$autoLoadConfig[30][] = [
    'autoType' => 'classInstantiate',
    'className' => 'sniffer',
    'objectName' => 'sniffer',
];
$autoLoadConfig[35][] = [
    'autoType' => 'require',
    'loadFile' => DIR_WS_FUNCTIONS . 'admin_access.php',
];
$autoLoadConfig[40][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_general_funcs.php',
];
$autoLoadConfig[60][] = [
    'autoType' => 'require',
    'loadFile' => DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php',
];
$autoLoadConfig[65][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_languages.php',
];
$autoLoadConfig[90][] = [
    'autoType' => 'require',
    'loadFile' => DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'functions_exchange_rates.php',
];
$autoLoadConfig[120][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_special_funcs.php',
];
$autoLoadConfig[170][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_admin_history.php',
];

$autoLoadConfig[1][] = [
    'autoType' => 'class',
    'loadFile' => 'class.admin.zcObserverLogEventListener.php',
    'classPath' => DIR_WS_CLASSES,
];
$autoLoadConfig[40][] = [
    'autoType' => 'classInstantiate',
    'className' => 'zcObserverLogEventListener',
    'objectName' => 'zcObserverLogEventListener',
];

