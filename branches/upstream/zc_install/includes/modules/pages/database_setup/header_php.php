<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 7412 2007-11-11 05:47:50Z drbyte $
 */

$write_config_files_only = ((isset($_POST['submit']) && $_POST['submit']==ONLY_UPDATE_CONFIG_FILES) || (isset($_POST['configfile']) && zen_not_null($_POST['configfile'])) || (isset($_GET['configfile']) && zen_not_null($_GET['configfile'])) || ZC_UPG_DEBUG3 != false) ? true : false;
$zc_show_progress =(defined('DO_NOT_USE_PROGRESS_METER') && DO_NOT_USE_PROGRESS_METER == 'do_not_use') ? 'no' : 'yes';
$is_upgrade = (int)$zc_install->getConfigKey('is_upgrade');

// process submitted data
  if (isset($_POST['submit'])) {
    // process POSTed data
    $zc_install->validateDatabaseSetup($_POST);

    $zc_install->logDetails('Installer - Page: database_setup -- collected information: ' . str_replace(array($zc_install->getConfigKey('DB_SERVER_PASSWORD'), $_POST['db_pass']), '*****', print_r($zc_install->getConfigKey(), true)), 'database_setup1');
    if (ZC_UPG_DEBUG !== false) $zc_install->throwException('DIAGNOSTIC: database_setup -- session vars: ' . str_replace(array($zc_install->getConfigKey('DB_SERVER_PASSWORD'), $_POST['db_pass']), '*****', print_r($_SESSION, true)), 'database_setup');

    if (!$zc_install->fatal_error) {
      //now let's connect to the database and load the tables:
      if ($is_upgrade) { //if upgrading, move on to the upgrade page
        // update post-install settings such as paths
        $zc_install->dbAfterLoadActions();

        header('location: index.php?main_page=database_upgrade' . zcInstallAddSID() );
        exit;
      } elseif ($_POST['submit']==SAVE_DATABASE_SETTINGS) {
      // not upgrading - load the fresh database
         if ($zc_show_progress == 'yes') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Zen Cart&trade; Setup - Database Loading ...</title>
<link rel="stylesheet" type="text/css" href="includes/templates/template_default/css/stylesheet.css">
</head>
<div id="wrap">
  <div id="header">
  <img src="includes/templates/template_default/images/zen_header_bg.jpg">
  </div>
<div class="progress" align="center"><?php echo INSTALLATION_IN_PROGRESS; ?><br /><br />
<?php
         }

         // do actual database content-load:
         $zc_install->dbLoadProcedure();

         if ($zc_show_progress == 'yes') {
           $linkto = 'index.php?main_page=system_setup' . zcInstallAddSID() ;
           $link = '<a href="' . $linkto . '">' . '<br /><br />Done!<br />Click Here To Continue<br /><br />' . '</a>';
           echo "\n<script type=\"text/javascript\">\nwindow.location=\"$linkto\";\n</script>\n";
           echo '<noscript>'.$link.'</noscript><br /><br />';
           echo '<div id="footer"><p>Copyright &copy; 2003-' . date('Y') . ' <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a></p></div></div></body></html>';
         } else {
           header('location: index.php?main_page=system_setup' . zcInstallAddSID() );
         }
         exit;
      } elseif ($write_config_files_only && !$zc_install->fatal_error) {
         header('location: index.php?main_page=database_upgrade' . zcInstallAddSID() );
         exit;
      } //endif $is_upgrade
    }
  }

  if ($is_upgrade) { // read previous settings from configure.php
    $zdb_type       = zen_read_config_value('DB_TYPE');
    $zdb_prefix     = zen_read_config_value('DB_PREFIX');
    $zdb_server     = zen_read_config_value('DB_SERVER');
    $zdb_user       = zen_read_config_value('DB_SERVER_USERNAME');
    $zdb_pwd        = zen_read_config_value('DB_SERVER_PASSWORD');
    $zdb_name       = zen_read_config_value('DB_DATABASE');
    $zdb_sql_cache  = ($zc_install->getConfigKey('DIR_FS_SQL_CACHE')=='') ? zen_read_config_value('DIR_FS_SQL_CACHE') : $zc_install->getConfigKey('DIR_FS_SQL_CACHE');
    $zdb_cache_type = zen_read_config_value('SQL_CACHE_METHOD');
    $zdb_persistent = zen_read_config_value('USE_PCONNECT');
    $zdb_sessions   = (zen_read_config_value('STORE_SESSIONS')) ? 'true' : 'false';
  } else { // set defaults:
    $zdb_type       = 'MySQL';
    $zdb_prefix     = '';
    $zdb_server     = 'localhost';
    $zdb_user       = 'root';
    $zdb_name       = 'zencart';
    $zdb_sql_cache  = $zc_install->getConfigKey('DIR_FS_SQL_CACHE');
    $zdb_cache_type = 'none';
    $zdb_persistent = 'false';
    $zdb_sessions   = 'true';
  } //endif $is_upgrade

  if (!isset($dir_fs_www_root) || $dir_fs_www_root == '') $dir_fs_www_root = $zc_install->detectDocumentRoot();
  if ($zdb_sql_cache == '') $zdb_sql_cache = $dir_fs_www_root . '/cache';

  if (!isset($_POST['db_host']))     $_POST['db_host']    = $zdb_server;
  if (!isset($_POST['db_username'])) $_POST['db_username']= $zdb_user;
  if (!isset($_POST['db_name']))     $_POST['db_name']    = $zdb_name;
  if (!isset($_POST['sql_cache']))   $_POST['sql_cache']  = $zdb_sql_cache;
  if (!isset($_POST['db_conn']))     $_POST['db_conn']    = $zdb_persistent;
  if (!isset($_POST['db_sess']))     $_POST['db_sess']    = $zdb_sessions;
  if (!isset($_POST['db_prefix']))   $_POST['db_prefix']  = $zdb_prefix;
  if (!isset($_POST['db_type']))     $_POST['db_type']    = $zdb_type;
  if (!isset($_POST['cache_type']))  $_POST['cache_type'] = $zdb_cache_type;

  setInputValue($_POST['db_host'],    'DATABASE_HOST_VALUE', $zdb_server);
  setInputValue($_POST['db_username'],'DATABASE_USERNAME_VALUE', $zdb_user);
  setInputValue($_POST['db_name'],    'DATABASE_NAME_VALUE', $zdb_name);
  setInputValue($_POST['sql_cache'],  'SQL_CACHE_VALUE', $zdb_sql_cache);
  setInputValue($_POST['db_prefix'],  'DATABASE_NAME_PREFIX', $zdb_prefix );
  setRadioChecked($_POST['db_conn'],  'DB_CONN', $zdb_persistent);
  setRadioChecked($_POST['db_sess'],  'DB_SESS', $zdb_sessions);

  $zc_first_field= 'onload="document.getElementById(\'db_username\').focus()"';

?>