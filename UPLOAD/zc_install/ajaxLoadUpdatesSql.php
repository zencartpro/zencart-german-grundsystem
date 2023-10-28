<?php
/**
 * ajaxLoadUpdatesSql.php
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajaxLoadUpdatesSql.php 2023-10-26 09:40:53Z webchills $
 */
define('IS_ADMIN_FLAG', false);
define('DIR_FS_INSTALL', __DIR__ . '/');
define('DIR_FS_ROOT', realpath(__DIR__ . '/../') . '/');

require(DIR_FS_INSTALL . 'includes/application_top.php');

$error = FALSE;
$errorList = array();
$db_type = 'mysql';
$updateList = array(
        '1.2.7'=>array('required'=>'1.2.6'),
        '1.3.0'=>array('required'=>'1.2.7'),
        '1.3.5'=>array('required'=>'1.3.0'),
        '1.3.6'=>array('required'=>'1.3.5'),
        '1.3.7'=>array('required'=>'1.3.6'),
        '1.3.8'=>array('required'=>'1.3.7'),
        '1.3.9'=>array('required'=>'1.3.8'),
        '1.5.0'=>array('required'=>'1.3.9'),
        '1.5.1'=>array('required'=>'1.5.0'),
        '1.5.2'=>array('required'=>'1.5.1'),
        '1.5.3'=>array('required'=>'1.5.2'),
        '1.5.4'=>array('required'=>'1.5.3'),
        '1.5.5'=>array('required'=>'1.5.4'),
        '1.5.6'=>array('required'=>'1.5.5'),
        '1.5.7'=>array('required'=>'1.5.6'),
        );

$systemChecker = new systemChecker();
$dbVersion = $systemChecker->findCurrentDbVersion();
$updateVersion = str_replace('version-', '', $_POST['version']);
$updateVersion = str_replace('_', '.', $updateVersion);
$versionInfo = $updateList[$updateVersion];

// $errorList[] = "I have $dbVersion. POST=" . $_POST['version'] . ' which asks for updateVersion=' . $updateVersion . '; therefore versionRequired=' . $versionInfo[required];

if ($versionInfo['required'] != $dbVersion)
{
  $error = TRUE;
  if (empty($versionInfo['required'])) $versionInfo['required'] = '[ ERROR: NOT READY FOR UPGRADES YET. NOTIFY DEV TEAM!] ';
  $errorList[] = sprintf(TEXT_COULD_NOT_UPDATE_BECAUSE_ANOTHER_VERSION_REQUIRED, $updateVersion, $dbVersion, $versionInfo['required']);
}
if ($error) {
    echo json_encode(array('error'=>$error, 'version'=>$_POST['version'], 'errorList'=>$errorList)); die();
}
  require_once(DIR_FS_INSTALL . 'includes/classes/class.zcDatabaseInstaller.php');
  $file = DIR_FS_INSTALL . 'sql/updates/' . $db_type . '_upgrade_zencart_' . str_replace('.', '', $updateVersion) . '.sql';
  $options = $systemChecker->getDbConfigOptions();
  $dbInstaller = new zcDatabaseInstaller($options);
  $result = $dbInstaller->getConnection();
  $errDates = $dbInstaller->runZeroDateSql($options);
  $errorUpg = $dbInstaller->parseSqlFile($file);
if ($error) {
    echo json_encode(array('error'=>$error, 'version'=>$_POST['version'], 'errorList'=>$errorList)); die();
}

// Plugins
$pluginsfolder = DIR_FS_INSTALL . 'sql/plugins/updates/';
// get all *.sql files in alpha order
$sql_files = glob($pluginsfolder . '*.sql');
if ($sql_files !== false) {
    foreach ($sql_files as $file) {
        $extendedOptions = array('doJsonProgressLogging'=>TRUE, 'doJsonProgressLoggingFileName'=>DEBUG_LOG_FOLDER . '/progress.json', 'id'=>'main', 'message'=>TEXT_LOADING_PLUGIN_UPGRADES . ' ' . $file);
        logDetails('processing file ' . $file);
        $errorUpg = $dbInstaller->parseSqlFile($file, $extendedOptions);
    }
}
echo json_encode(array('error'=>$error, 'version'=>$_POST['version'], 'errorList'=>$errorList));
