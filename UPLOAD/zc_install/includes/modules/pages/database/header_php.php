<?php
/**
 * Zen Cart German Specific (158 code in 157 /zencartpro adaptations)
 
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2024-02-02 13:49:16Z webchills $
 */

$dbCharset = [
    ['id' => 'utf8mb4', 'text' => TEXT_DATABASE_SETUP_CHARSET_OPTION_UTF8MB4],
    ['id' => 'utf8', 'text' => TEXT_DATABASE_SETUP_CHARSET_OPTION_UTF8],
    
];
$dbCharsetOptions = zen_get_select_options($dbCharset, $db_charset ?? 'utf8mb4');

$sqlCacheType = [
    ['id' => 'none', 'text' => TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_NONE],
    ['id' => 'file', 'text' => TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_FILE],
    ['id' => 'database', 'text' => TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_DATABASE],
];
$sqlCacheTypeOptions = zen_get_select_options($sqlCacheType, $sql_cache_method ?? '');

$db_user_fallback = $configReader->getDefine('DB_SERVER_USERNAME');
$db_password_fallback = $configReader->getDefine('DB_SERVER_PASSWORD');
$db_name_fallback = $configReader->getDefine('DB_DATABASE');
$install_demo_data = false;


if (defined('DEVELOPER_MODE') && DEVELOPER_MODE === true) {
    if (empty($db_user_fallback)) {
        $db_user_fallback = (defined('DEVELOPER_DBUSER_DEFAULT') ? DEVELOPER_DBUSER_DEFAULT : 'zencart');
    }
    $db_user = $db_user ?? $db_user_fallback;

    if (empty($db_password_fallback)) {
        $db_password_fallback = (defined('DEVELOPER_DBPASSWORD_DEFAULT') ? DEVELOPER_DBPASSWORD_DEFAULT : 'zencart');
    }
    $db_password = $db_password ?? $db_password_fallback;

    if (empty($db_name_fallback)) {
        $db_name_fallback = (defined('DEVELOPER_DBNAME_DEFAULT') ? DEVELOPER_DBNAME_DEFAULT : 'zencart');
    }
    $db_name = $db_name ?? $db_name_fallback;

    if (empty($db_host_fallback)) {
        $db_host_fallback = (defined('DEVELOPER_DBHOST_DEFAULT') ? DEVELOPER_DBHOST_DEFAULT : 'localhost');
    }
    $db_host = $db_host ?? $db_host_fallback;

    if (defined('DEVELOPER_INSTALL_DEMO_DATA')) {
        $install_demo_data = !empty(DEVELOPER_INSTALL_DEMO_DATA);
    }
} else {
    if (empty($db_user_fallback)) {
        $db_user_fallback = 'zencart';
    }
    if (!isset($db_password_fallback)) {
        $db_password_fallback = 'zencart';
    }
    if (empty($db_name_fallback)) {
        $db_name_fallback = 'zencart';
    }
    $db_user = $db_user_fallback;
    $db_password = $db_password_fallback;
    $db_name = $db_name ?? $db_name_fallback;
}

$db_user = $db_user ?? '';
$db_password = $db_password ?? '';
$db_host = $db_host ?? 'localhost';
$db_prefix = $db_prefix ?? '';


// attempt to intelligently manage user-adjusted subdirectory values if they are different from detected defaults
if (!isset($_POST['detected_http_server_catalog'])) {
    $_POST['detected_http_server_catalog'] = '';
}
if (!isset($_POST['detected_https_server_catalog'])) {
    $_POST['detected_https_server_catalog'] = '';
}
if ($_POST['http_server_catalog'] !== $_POST['detected_http_server_catalog']) {
    $_POST['dir_ws_http_catalog'] = rtrim(str_replace($_POST['http_server_catalog'], '', $_POST['http_url_catalog']), '/') . '/';
}
if ($_POST['https_server_catalog'] !== $_POST['detected_https_server_catalog']) {
    $_POST['dir_ws_https_catalog'] = rtrim(str_replace($_POST['https_server_catalog'], '', $_POST['https_url_catalog']), '/') . '/';
}
