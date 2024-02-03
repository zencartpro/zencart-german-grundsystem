<?php
/**
 * ajaxLoadUpdatesSql.php
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxLoadUpdatesSql.php 2024-02-02 13:40:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error = false;
$errorList = [];
$db_type = 'mysql';
$updateList = [
    '1.2.7' => ['required' => '1.2.6'],
    '1.3.0' => ['required' => '1.2.7'],
    '1.3.5' => ['required' => '1.3.0'],
    '1.3.6' => ['required' => '1.3.5'],
    '1.3.7' => ['required' => '1.3.6'],
    '1.3.8' => ['required' => '1.3.7'],
    '1.3.9' => ['required' => '1.3.8'],
    '1.5.0' => ['required' => '1.3.9'],
    '1.5.1' => ['required' => '1.5.0'],
    '1.5.2' => ['required' => '1.5.1'],
    '1.5.3' => ['required' => '1.5.2'],
    '1.5.4' => ['required' => '1.5.3'],
    '1.5.5' => ['required' => '1.5.4'],
    '1.5.6' => ['required' => '1.5.5'],
    '1.5.7' => ['required' => '1.5.6'],
   
];

$systemChecker = new systemChecker();
$dbVersion = $systemChecker->findCurrentDbVersion();
$postedVersion = sanitize_version($_POST['version']);
$updateVersion = str_replace('version-', '', $postedVersion);
$updateVersion = str_replace('_', '.', $updateVersion);
$versionInfo = $updateList[$updateVersion];

if ($versionInfo['required'] !== $dbVersion) {
    $error = true;
    if (empty($versionInfo['required'])) {
        $versionInfo['required'] = '[ ERROR: NOT READY FOR UPGRADES YET. NOTIFY DEV TEAM!] ';
    }
    $errorList[] = sprintf(TEXT_COULD_NOT_UPDATE_BECAUSE_ANOTHER_VERSION_REQUIRED, $updateVersion, $dbVersion, $versionInfo['required']);
}
if ($error) {
    echo json_encode(['error' => $error, 'version' => $updateVersion, 'errorList' => $errorList]);
    die();
}

require_once(DIR_FS_INSTALL . 'includes/classes/class.zcDatabaseInstaller.php');

$file = DIR_FS_INSTALL . 'sql/updates/' . $db_type . '_upgrade_zencart_' . str_replace('.', '', $updateVersion) . '.sql';
$options = $systemChecker->getDbConfigOptions();
$dbInstaller = new zcDatabaseInstaller($options);
$extendedOptions = [
    'doJsonProgressLogging' => true,
    'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
    'id' => 'main',
    'message' => sprintf(TEXT_UPGRADING_TO_VERSION, $updateVersion),
];
$result = $dbInstaller->getConnection();
$errDates = $dbInstaller->runZeroDateSql($options);
$errorUpg = $dbInstaller->parseSqlFile($file, $extendedOptions);
if ($error) {
    echo json_encode(['error' => $error, 'version' => $updateVersion, 'errorList' => $errorList]);
    die();
}

// Plugins
$pluginsfolder = DIR_FS_INSTALL . 'sql/plugins/updates/';
// get all *.sql files in alpha order
$sql_files = glob($pluginsfolder . '*.sql');
if ($sql_files !== false) {
    foreach ($sql_files as $file) {
        $extendedOptions = [
            'doJsonProgressLogging' => true,
            'doJsonProgressLoggingFileName' => DEBUG_LOG_FOLDER . '/progress.json',
            'id' => 'main',
            'message' => TEXT_LOADING_PLUGIN_UPGRADES . ' ' . $file,
        ];
        logDetails('processing file ' . $file);
        $errorUpg = $dbInstaller->parseSqlFile($file, $extendedOptions);
    }
}

echo json_encode(['error' => $error, 'version' => $updateVersion, 'errorList' => $errorList]);

function sanitize_version($version) {
    $sanitizedString = preg_replace('/[^a-zA-Z0-9_-]/', '', $version);
    return $sanitizedString;
}
