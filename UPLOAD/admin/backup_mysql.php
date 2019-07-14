<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2019-06-17 11:04:51Z webchills $
 */


  define('OS_DELIM', '');

  require('includes/application_top.php');
  $debug = '';
  $dump_params = '';
  $tables_to_export = (isset($_GET['tables']) && $_GET['tables'] !='') ? str_replace(',',' ',$_GET['tables']) : '';
  $redirect= (isset($_GET['returnto']) && $_GET['returnto'] !='') ? $_GET['returnto'] : '';
  $resultcodes = '';
  $_POST['compress'] = (isset($_REQUEST['compress'])) ? $_REQUEST['compress'] : false;
  $strA = '';
  $strB = '';
  $compress_override = ((isset($_GET['comp']) && $_GET['comp']>0) || COMPRESS_OVERRIDE=='true') ? true : false;
  if (isset($_GET['debug']) && ($_GET['debug']=='ON' || $_GET['debug']>0)) $debug='ON';
  $skip_locks_requested = (isset($_REQUEST['skiplocks']) && $_REQUEST['skiplocks'] == 'yes');


// check to see if open_basedir restrictions in effect -- if so, likely won't be able to use this tool.
  $flag_basedir = false;
  $open_basedir=@ini_get('open_basedir');
  if ($open_basedir !='') {
    $basedir_check_array = explode(':',$open_basedir);
    foreach($basedir_check_array as $basedir_check) {
      if (!strstr(DIR_FS_ADMIN,$basedir_check)) $flag_basedir=true;
    }
    if ($flag_basedir) $messageStack->add(ERROR_CANT_BACKUP_IN_SAFE_MODE, 'error');
  }
// check to see if "exec()" is disabled in PHP -- if so, won't be able to use this tool.
  $exec_disabled = false;
  $php_disabled_functions = @ini_get("disable_functions");
  if ($php_disabled_functions != '') {
    if ($debug=='ON') $messageStack->add('PHP-Disabled-functions: ' . $php_disabled_functions,'error');
    if (in_array('exec', preg_split('/,/', str_replace(' ', '', $php_disabled_functions)))) {
      $messageStack->add(ERROR_EXEC_DISABLED, 'error');
      $exec_disabled = true;
    }
  }


// Note that LOCAL_EXE_MYSQL and LOCAL_EXE_MYSQL_DUMP are defined in the /admin/includes/languages/backup_mysql.php file
// These can occasionally be overridden in the URL by specifying &tool=/path/to/foo/bar/plus/utilname, depending on server support
// Do not change them here ... edit the LANGUAGES file instead.
// the following lines check to be sure that they've been entered correctly in the language file
  $pathsearch=array(str_replace('mysql','',LOCAL_EXE_MYSQL).'/',str_replace('mysql.exe','',LOCAL_EXE_MYSQL).'/','/usr/bin/','/usr/local/bin/','/usr/local/mysql/bin/','c:/mysql/bin/','d:/mysql/bin/','e:/mysql/bin/', 'c:/server/mysql/bin/', '\'c:/Program Files/MySQL/MySQL Server 5.0/bin/\'', '\'d:\\Program Files\\MySQL\\MySQL Server 5.0\\bin\\\'', '\'c:/Program Files/MySQL/MySQL Server 5.1/bin/\'');
  $pathsearch=array_merge($pathsearch,explode(':',$open_basedir));
  $mysql_exe = 'unknown';
  $mysqldump_exe = 'unknown';
  foreach($pathsearch as $path){
//    $path = str_replace('\\','/',$path); // convert backslashes
    $path = str_replace('//','/',$path); // convert double slashes to singles
    $path = str_replace("'","",$path); // remove ' marks if any
    $path = (substr($path,-1)!='/' && substr($path,-1)!='\\') ? $path . '/' : $path; // add a '/' to the end if missing

    if ($mysql_exe == 'unknown') {
      if (@file_exists($path.'mysql'))     $mysql_exe = $path.'mysql';
      if (@file_exists($path.'mysql.exe')) $mysql_exe = $path.'mysql.exe';
    }
    if ($mysqldump_exe == 'unknown') {
      if (@file_exists($path.'mysqldump'))     $mysqldump_exe = $path.'mysqldump';
      if (@file_exists($path.'mysqldump.exe')) $mysqldump_exe = $path.'mysqldump.exe';
    }
    if ($debug=='ON') $messageStack->add_session('Checking Path: '.$path.'<br />','caution');
    if ($mysql_exe != 'unknown' && $mysqldump_exe != 'unknown') break;
  }

  if (!$mysqldump_exe){
    $messageStack->add_session('WARNING: "mysqldump" binary not found. Backups may not work.<br />Please set full path to MYSQLDUMP binary in langauges/backup_mysql.php','error');
    $mysqldump_exe = ((@file_exists($mysqldump_exe) ? $mysqldump_exe : 'mysqldump' ) );
  }
  if (!$mysql_exe){
    $messageStack->add_session('WARNING: "mysql" binary not found. Restores may not work.<br />Please set full path to MYSQL binary in langauges/backup_mysql.php','error');
    $mysql_exe =     ((@file_exists($mysql_exe) ? $mysql_exe : 'mysql' ) );
  }
  if ($mysql_exe == 'unknown') {
    $mysql_exe = 'mysql';
  }
  if ($mysqldump_exe == 'unknown') {
    $mysqldump_exe = 'mysqldump';
  }

  $mysql_exe = '"'.$mysql_exe.'"';
  $mysqldump_exe = '"'.$mysqldump_exe.'"';
  if ($debug=='ON') $messageStack->add_session('<br />','caution');
  if ($debug=='ON') $messageStack->add_session('COMMAND FILES SELECTED:','caution');
  if ($debug=='ON') $messageStack->add_session('mysqlexe='.$mysql_exe.'<br />','caution');
  if ($debug=='ON') $messageStack->add_session('mysqldumpexe='.$mysqldump_exe.'<br /><br />','caution');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    switch ($action) {
      case 'forget':
        $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
        $messageStack->add_session(SUCCESS_LAST_RESTORE_CLEARED, 'success');
        zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'backupnow':
        zen_set_time_limit(250);  // not sure if this is needed anymore?

        $backup_file = 'db_' . DB_DATABASE . '-' . ($tables_to_export != '' ? 'limited-' : '' ) . date('YmdHis') . '.sql';

        $dump_params .= ' "--host=' . DB_SERVER . '"';
        $dump_params .= ' "--user=' . DB_SERVER_USERNAME . '"';
        $dump_params .= ' "--password=' . escapeshellcmd(DB_SERVER_PASSWORD) . '"';
        $dump_params .= ' --opt';   //"optimized" -- turns on all "fast" and optimized export methods
        $dump_params .= ' --complete-insert';  // undo optimization slightly and do "complete inserts"--lists all column names for benefit of restore of diff systems
        if ($skip_locks_requested) {
          $dump_params .= ' --skip-lock-tables --skip-add-locks';     //use this if your host prevents you from locking tables for backup
        }
//        $dump_params .= ' --skip-comments'; // mysqldump inserts '--' as comment delimiters, which is invalid on import (only for mysql v4.01+)
//        $dump_params .= ' --skip-quote-names';
//        $dump_params .= ' --force';  // ignore SQL errors if they occur
//        $dump_params .= ' --compatible=postgresql'; // other options are: ,mysql323, mysql40
        $dump_params .= ' "--result-file=' . DIR_FS_BACKUP . $backup_file . '"';
        $dump_params .= ' ' . DB_DATABASE;

        // if using the "--tables" parameter, this should be the last parameter, and tables should be space-delimited
        // fill $tables_to_export with list of tables, separated by spaces, if wanna just export certain tables
        $dump_params .= (($tables_to_export=='') ? '' : ' --tables ' . $tables_to_export);
        $dump_params .= " 2>&1";

        $toolfilename = (isset($_GET['tool']) && $_GET['tool'] != '') ? $_GET['tool'] : $mysqldump_exe;

        // remove " marks in parameters for friendlier IIS support
//REQUIRES TESTING:        if (strstr($toolfilename,'.exe')) $dump_params = str_replace('"','',$dump_params);

        if ($debug=='ON') $messageStack->add_session('COMMAND: '.OS_DELIM.$toolfilename . ' ' . $dump_params.OS_DELIM, 'caution');


        $resultcodes = @exec(OS_DELIM . $toolfilename . $dump_params . OS_DELIM, $output, $dump_results );
        @exec("exit(0)");
        if ($dump_results == -1) $messageStack->add_session(FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS . '<br />The command being run is: ' . $toolfilename . str_replace('--password='.DB_SERVER_PASSWORD,'--password=*****', str_replace('2>&1','',$dump_params)), 'error');
        if ($debug=='ON' || (zen_not_null($dump_results) && $dump_results!='0')) $messageStack->add_session('Result code: '.$dump_results, 'caution');

        #parse the value that comes back from the script
        if (zen_not_null($resultcodes)) list($strA, $strB) = preg_split ('/[|]/', $resultcodes);
        if ($debug=='ON') $messageStack->add_session("valueA: " . $strA,'error');
        if ($debug=='ON') $messageStack->add_session("valueB: " . $strB,'error');

        //$output contains response strings from execution. This displays if needed.
        foreach($output as $key=>$value) {$messageStack->add_session("$key => $value<br />",'caution'); }

        if (file_exists(DIR_FS_BACKUP . $backup_file) && ($dump_results == '0' || $dump_results=='')) { // display success message noting that MYSQLDUMP was used
          $messageStack->add_session('<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $backup_file . '">' . SUCCESS_DATABASE_SAVED . '</a>', 'success');
        } elseif ($dump_results=='127') {
          $messageStack->add_session(FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND, 'error');
        } elseif (stristr($strA, 'Access denied') && stristr($strA, 'LOCK TABLES') ) {
          unlink(DIR_FS_BACKUP . $backup_file);
          zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL, 'action=backupnow'.(($debug=='ON')?'&debug=ON':'') . (($_POST['compress']!=false)?'&compress='.$_POST['compress']:'') . (($tables_to_export!='')?'&tables='.str_replace(' ',',',$tables_to_export):'') . '&skiplocks=yes'));
        } else {
          $messageStack->add_session(FAILURE_DATABASE_NOT_SAVED, 'error');
        }

        //compress the file as requested & optionally download
        if (isset($_POST['download']) && ($_POST['download'] == 'yes') && file_exists(DIR_FS_BACKUP . $backup_file) ) {
          switch ($_POST['compress']) {
            case 'gzip':
              @exec(LOCAL_EXE_GZIP . ' ' . DIR_FS_BACKUP . $backup_file);
              $backup_file .= '.gz';
              break;
            case 'zip':
              @exec(LOCAL_EXE_ZIP . ' -j ' . DIR_FS_BACKUP . $backup_file . '.zip ' . DIR_FS_BACKUP . $backup_file);
              if (file_exists(DIR_FS_BACKUP . $backup_file) && file_exists(DIR_FS_BACKUP . $backup_file . 'zip')) unlink(DIR_FS_BACKUP . $backup_file);
              $backup_file .= '.zip';
          }
      if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {
            header('Content-Type: application/octetstream');
//            header('Content-Disposition: inline; filename="' . $backup_file . '"');
            header('Content-Disposition: attachment; filename=' . $backup_file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: must_revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header("Cache-control: private");
      } else {
            header('Content-Type: application/x-octet-stream');
            header('Content-Disposition: attachment; filename=' . $backup_file);
            header("Expires: Mon, 26 Jul 2001 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Pragma: no-cache");
      }

          readfile(DIR_FS_BACKUP . $backup_file);
          unlink(DIR_FS_BACKUP . $backup_file);

          exit;
        } else {
          switch ($_POST['compress'] && file_exists(DIR_FS_BACKUP . $backup_file)) {
            case 'gzip':
              @exec(LOCAL_EXE_GZIP . ' ' . DIR_FS_BACKUP . $backup_file);
              if (file_exists(DIR_FS_BACKUP . $backup_file)) @exec('gzip ' . DIR_FS_BACKUP . $backup_file);
              break;
            case 'zip':
              @exec(LOCAL_EXE_ZIP . ' -j ' . DIR_FS_BACKUP . $backup_file . '.zip ' . DIR_FS_BACKUP . $backup_file);
              if (file_exists(DIR_FS_BACKUP . $backup_file) && file_exists(DIR_FS_BACKUP . $backup_file . 'zip')) unlink(DIR_FS_BACKUP . $backup_file);
          }
        }
        zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'restorenow':
      case 'restorelocalnow':
        zen_set_time_limit(300);
          $specified_restore_file = (isset($_GET['file'])) ? $_GET['file'] : '';

          if ($specified_restore_file !='' && file_exists(DIR_FS_BACKUP . $specified_restore_file)) {
            $restore_file = DIR_FS_BACKUP . $specified_restore_file;
            $extension = substr($specified_restore_file, -3);

            //determine file format and unzip if needed
            if ( ($extension == 'sql') || ($extension == '.gz') || ($extension == 'zip') ) {
              switch ($extension) {
                case 'sql':
                  $restore_from = $restore_file;
                  $remove_raw = false;
                  break;
                case '.gz':
                  $restore_from = substr($restore_file, 0, -3);
                  exec(LOCAL_EXE_GUNZIP . ' ' . $restore_file . ' -c > ' . $restore_from);
                  $remove_raw = true;
                  break;
                case 'zip':
                  $restore_from = substr($restore_file, 0, -4);
                  exec(LOCAL_EXE_UNZIP . ' ' . $restore_file . ' -d ' . DIR_FS_BACKUP);
                  $remove_raw = true;
              }
            }
        } elseif ($action == 'restorelocalnow') {
            $sql_file = new upload('sql_file', DIR_FS_BACKUP);
            $specified_restore_file = $sql_file->filename;
            $restore_from = DIR_FS_BACKUP . $specified_restore_file;
        }

        //Restore using "mysql"
        $load_params  = ' "--database=' . DB_DATABASE . '"';
        $load_params .= ' "--host=' . DB_SERVER . '"';
        $load_params .= ' "--user=' . DB_SERVER_USERNAME . '"';
        $load_params .= ((DB_SERVER_PASSWORD =='') ? '' : ' "--password=' . escapeshellcmd(DB_SERVER_PASSWORD) . '"');
        $load_params .= ' ' . DB_DATABASE; // this needs to be the 2nd-last parameter
        $load_params .= ' < "' . $restore_from . '"'; // this needs to be the LAST parameter
        $load_params .= " 2>&1";
        //DEBUG echo $mysql_exe . ' ' . $load_params;

        if (file_exists($restore_from) && $specified_restore_file != '') {
          $toolfilename = (isset($_GET['tool']) && $_GET['tool'] != '') ? $_GET['tool'] : $mysql_exe;

          // remove " marks in parameters for friendlier IIS support
//REQUIRES TESTING:          if (strstr($toolfilename,'.exe')) $load_params = str_replace('"','',$load_params);

          if ($debug=='ON') $messageStack->add_session('COMMAND: '.OS_DELIM.$toolfilename . ' ' . $load_params.OS_DELIM, 'caution');

          $resultcodes=exec(OS_DELIM . $toolfilename . $load_params . OS_DELIM, $output, $load_results );
          exec("exit(0)");
          #parse the value that comes back from the script
          list($strA, $strB) = preg_split ('/[|]/', $resultcodes);
          if ($debug=='ON') $messageStack->add_session("valueA: " . $strA,'error');
          if ($debug=='ON') $messageStack->add_session("valueB: " . $strB,'error');
          if ($debug=='ON' || (zen_not_null($load_results) && $load_results!='0')) $messageStack->add_session('Result code: '.$load_results, 'caution');

          if ($load_results == '0') {
            // store the last-restore-date, if successful
            $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
            $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, date_added) values ('Last Database Restore', 'DB_LAST_RESTORE', '" . $specified_restore_file . "', 'Last database restore file', 6, now())");
            $messageStack->add_session('<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $specified_restore_file . '">' . SUCCESS_DATABASE_RESTORED . '</a>', 'success');
            } elseif ($load_results == '127') {
            $messageStack->add_session(FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND, 'error');
            } else {
            $messageStack->add_session(FAILURE_DATABASE_NOT_RESTORED, 'error');
            } // endif $load_results
          } else {
          $messageStack->add_session(sprintf(FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND, '[' . $restore_from .']'), 'error');
          } // endif file_exists

        zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL));
        break;
      case 'download':
        $extension = substr($_GET['file'], -3);

        if ( ($extension == 'zip') || ($extension == '.gz') || ($extension == 'sql') ) {
          if ($fp = fopen(DIR_FS_BACKUP . $_GET['file'], 'rb')) {
            $buffer = fread($fp, filesize(DIR_FS_BACKUP . $_GET['file']));
            fclose($fp);

            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $_GET['file']);

            echo $buffer;

            exit;
          }
        } else {
          $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL));

        $zremove_error = zen_remove(DIR_FS_BACKUP . '/' . $_GET['file']);
        // backwards compatibility:
        if (isset($zen_remove_error) && $zen_remove_error == true) $zremove_error = $zen_remove_error;

        if (!$zremove_error) {
          $messageStack->add_session(SUCCESS_BACKUP_DELETED, 'success');

          zen_redirect(zen_href_link(FILENAME_BACKUP_MYSQL));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = false;
  if (is_dir(DIR_FS_BACKUP)) {
    if (is_writable(DIR_FS_BACKUP)) {
      $dir_ok = true;
    } else {
      $messageStack->add(ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
    }
  } else {
    $messageStack->add(ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
  }


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
<?php if (substr(HTTP_SERVER, 0, 5) != 'https') {  // display security warning about downloads if not SSL ?>
          <tr>
            <td class="main"><?php echo WARNING_NOT_SECURE_FOR_DOWNLOADS; ?></td>
            <td class="main" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
<?php } ?>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FILE_DATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILE_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
//  if (!get_cfg_var('safe_mode') && $dir_ok == true) {
    $dir = dir(DIR_FS_BACKUP);
    $contents = array();
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_BACKUP . $file)) {
        if (substr($file,0,1) != '.' && !in_array($file, array('empty.txt', 'index.php', 'index.htm', 'index.html'))) {
          $contents[] = $file;
        }
      }
    }
    sort($contents);
    for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
      $entry = $contents[$i];
      $check = 0;

      if ((!isset($_GET['file']) || (isset($_GET['file']) && ($_GET['file'] == $entry))) && !isset($buInfo) && ($action != 'backup') && ($action != 'restorelocal')) {
        $file_array['file'] = $entry;
        $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry));
        $file_array['size'] = number_format(filesize(DIR_FS_BACKUP . $entry)) . ' bytes';
        switch (substr($entry, -3)) {
          case 'zip': $file_array['compression'] = 'ZIP'; break;
          case '.gz': $file_array['compression'] = 'GZIP'; break;
          default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
        }

        $buInfo = new objectInfo($file_array);
      }

      if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $buInfo->file . '&action=restore';
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        $onclick_link = 'file=' . $entry;
      }
?>
<!--                 <td class="dataTableContent" onclick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'action=download&file=' . $entry) . '">' . zen_image(DIR_WS_ICONS . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td> -->
                <td class="dataTableContent" onClick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo '<a href="' . ((ENABLE_SSL_ADMIN == 'true') ? DIR_WS_HTTPS_ADMIN : DIR_WS_ADMIN) . 'backups/' . $entry . '">' . zen_image(DIR_WS_ICONS . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td>
                <td class="dataTableContent" align="center" onClick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry)); ?></td>
                <td class="dataTableContent" align="right" onClick="document.location.href='<?php echo zen_href_link(FILENAME_BACKUP_MYSQL, $onclick_link); ?>'"><?php echo number_format(filesize(DIR_FS_BACKUP . $entry)); ?> bytes</td>
                <td class="dataTableContent" align="right"><?php if (isset($buInfo) && is_object($buInfo) && ($entry == $buInfo->file)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $entry) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
    $dir->close();
//  } // endif safe-mode & dir_ok

// now let's display the backup/restore buttons below filelist
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_BACKUP_DIRECTORY . ' ' . DIR_FS_BACKUP; ?></td>
                <td align="right" class="smallText">
                    <?php if ( ($action != 'backup') && (isset($dir)) && !ini_get('safe_mode') && $dir_ok == true ) {
                             echo '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'action=backup'.(($debug=='ON')?'&debug=ON':'')) . (($tables_to_export!='')?'&tables='.str_replace(' ',',',$tables_to_export):'') . '">' .
                                   zen_image_button('button_backup.gif', IMAGE_BACKUP) . '</a>&nbsp;&nbsp;';
                          }
                          if ( ($action != 'restorelocal') && isset($dir) ) {
                             echo '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'action=restorelocal'.(($debug=='ON')?'&debug=ON':'')) . '">' .
                                   zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>';
                          } ?>
                </td>
              </tr>
<?php
  if (defined('DB_LAST_RESTORE')) {
?>
              <tr>
                <td class="smallText" colspan="4"><?php echo TEXT_LAST_RESTORATION . ' ' . DB_LAST_RESTORE . ' <a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'action=forget') . '">' . TEXT_FORGET . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'backup':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_NEW_BACKUP . '</strong>');

      $contents = array('form' => zen_draw_form('backup', FILENAME_BACKUP_MYSQL, 'action=backupnow'.(($debug=='ON')?'&debug=ON':''). (($tables_to_export!='')?'&tables='.str_replace(' ',',',$tables_to_export):'')));
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);

      $contents[] = array('text' => '<br />' . zen_draw_radio_field('compress', 'no', (!@file_exists(LOCAL_EXE_GZIP) && !$compress_override ? true : false)) . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
      if (@file_exists(LOCAL_EXE_GZIP) || $compress_override) $contents[] = array('text' => '<br />' . zen_draw_radio_field('compress', 'gzip', true) . ' ' . TEXT_INFO_USE_GZIP);
      if (@file_exists(LOCAL_EXE_ZIP)) $contents[] = array('text' => zen_draw_radio_field('compress', 'zip',(!@file_exists(LOCAL_EXE_GZIP) ? true : false)) . ' ' . TEXT_INFO_USE_ZIP);
      $contents[] = array('text' => '<br />' . zen_draw_radio_field('skiplocks', 'yes', false) . ' ' . TEXT_INFO_SKIP_LOCKS);


      // Download to file --- Should only be done if SSL is active, otherwise database is exposed as clear text
      if ($dir_ok == true) {
        $contents[] = array('text' => '<br />' . zen_draw_checkbox_field('download', 'yes') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><span class="errorText">*' . TEXT_INFO_BEST_THROUGH_HTTPS . '</span>');
      } else {
        $contents[] = array('text' => '<br />' . zen_draw_radio_field('download', 'yes', true) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br /><span class="errorText">*' . TEXT_INFO_BEST_THROUGH_HTTPS . '</span>');
      }

      // display backup button
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_backup.gif', IMAGE_BACKUP) . '&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL,(($debug=='ON')?'debug=ON':'')) . (($tables_to_export!='')?'&tables='.str_replace(' ',',',$tables_to_export):''). '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restore':
      $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

      $contents[] = array('text' => zen_break_string(sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP . (($buInfo->compression != TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression != TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : ''), 35, ' '));
      $contents[] = array('align' => 'center', 'text' => '<br /><a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=restorenow'.(($debug=='ON')?'&debug=ON':'')) . '">' . zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file.(($debug=='ON')?'&debug=ON':'')) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restorelocal':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</strong>');

      $contents = array('form' => zen_draw_form('restore', FILENAME_BACKUP_MYSQL, 'action=restorelocalnow'.(($debug=='ON')?'&debug=ON':''), 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br /><br />' . TEXT_INFO_BEST_THROUGH_HTTPS);
      $contents[] = array('text' => '<br />' . zen_draw_file_field('sql_file'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_restore.gif', IMAGE_RESTORE) . '&nbsp;<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL,(($debug=='ON')?'debug=ON':'')) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      if ($dir_ok == false) break;       
      $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

      $contents = array('form' => zen_draw_form('delete', FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br /><strong>' . $buInfo->file . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($buInfo) && is_object($buInfo)) {
        $heading[] = array('text' => '<strong>' . $buInfo->date . '</strong>');

        $contents[] = array('align' => 'center',
                            'text' => '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=restore'.(($debug=='ON')?'&debug=ON':'')) . '">' .
                                                    zen_image_button('button_restore.gif', IMAGE_RESTORE) . '</a> ' .
                                      (($dir_ok==true && $exec_disabled==false) ? '<a href="' . zen_href_link(FILENAME_BACKUP_MYSQL, 'file=' . $buInfo->file . '&action=delete') . '">' .
                                                    zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>' : '' ) );
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br />' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>