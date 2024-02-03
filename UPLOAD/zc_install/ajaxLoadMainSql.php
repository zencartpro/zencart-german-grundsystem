<?php
/**
 * ajaxLoadMainSql.php
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxLoadMainSql.php 2024-02-02 13:59:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error = false;

$db_type = 'mysql';


require_once(DIR_FS_INSTALL . 'includes/classes/class.zcDatabaseInstaller.php');

$options = [
    'db_host' => $_POST['db_host'],
    'db_user' => $_POST['db_user'],
    'db_password' => $_POST['db_password'],
    'db_name' => $_POST['db_name'],
    'db_charset' => $_POST['db_charset'],
    'db_prefix' => $_POST['db_prefix'],
    'db_type' => $db_type,
];
// trim spaces from inputs
foreach ($options as $key => $val) {
    $options[$key] = trim($val);
}
$dbInstaller = new zcDatabaseInstaller($options);
$result = $dbInstaller->getConnection();
$extendedOptions = [
    'doJsonProgressLogging' => true,
    'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
    'id' => 'main',
    'message' => TEXT_CREATING_DATABASE,
];
$file = DIR_FS_INSTALL . 'sql/install/mysql_zencart.sql';
logDetails('processing file ' . $file);
$error = $dbInstaller->parseSqlFile($file, $extendedOptions);
if ($error) {
    echo json_encode(['error' => $error, 'file' => $file]);
    die();
}
// localization file
$charset = $_POST['db_charset'];
if (!in_array($charset, ['utf8', 'latin1'])) {
    $charset = 'utf8';
}
$file = DIR_FS_INSTALL . 'sql/install/mysql_' . $charset . '.sql';
if (file_exists($file)) {
    $extendedOptions = [
        'doJsonProgressLogging' => true,
        'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
        'id' => 'main',
        'message' => TEXT_LOADING_CHARSET_SPECIFIC,
    ];
    logDetails('processing file ' . $file);
    $error = $dbInstaller->parseSqlFile($file, $extendedOptions);
}
if ($error) {
    echo json_encode(['error' => $error, 'file' => $file]);
    die();
}
// Demo data
if (isset($_POST['demoData'])) {
    $extendedOptions = [
        'doJsonProgressLogging' => true,
        'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
        'id' => 'main',
        'message' => TEXT_LOADING_DEMO_DATA,
    ];
    $file = DIR_FS_INSTALL . 'sql/demo/mysql_demo.sql';
    logDetails('processing file ' . $file);
    $error = $dbInstaller->parseSqlFile($file, $extendedOptions);

    // attempt to unzip demo images, failing silently if Zip extension isn't installed
    if (class_exists('ZipArchive')) {
        // system('unzip --q demo_images/images.zip -d ../images/');
        $za = new ZipArchive;
        if ($za->open('demo_images/images.zip') === true) {
            $za->extractTo('../images');
            $za->close();
        }
    }
}
if ($error) {
    echo json_encode(['error' => $error, 'file' => $file]);
    die();
}
// Save data
logDetails('saving cfg keys');
$error = $dbInstaller->updateConfigKeys();
if ($error) {
    echo json_encode(['error' => $error, 'file' => $file]);
    die();
}

// Plugins
$pluginsfolder = DIR_FS_INSTALL . 'sql/plugins/';
if ($d = dir($pluginsfolder)) {
    while ($entry = $d->read()) {
        if (!is_dir($pluginsfolder . $entry)) {
            if (preg_match('~^[^\._].*\.sql$~', $entry) > 0) {
                $extendedOptions = [
                    'doJsonProgressLogging' => true,
                    'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
                    'id' => 'main',
                    'message' => TEXT_LOADING_PLUGIN_DATA . ' ' . $entry,
                ];
                $file = $pluginsfolder . $entry;
                logDetails('processing file ' . $file);
                $error = $dbInstaller->parseSqlFile($file, $extendedOptions);
            }
        }
    }
    $d->close();
}

echo json_encode(['error' => $error, 'file' => $file]);
die();

