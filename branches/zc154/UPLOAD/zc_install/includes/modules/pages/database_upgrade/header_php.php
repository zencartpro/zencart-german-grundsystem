<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 845 2015-02-28 16:51:25Z webchills $
 */
include('includes/modules/pages/database_upgrade/language_id_change.php');
/*
 * Database Upgrade script
 * 1. Checks to be sure that the configure.php exists and can be read
 * 2. Uses info from configure.php to connect to database
 * 3. Queries database to determine whether settings unique to each upgrade level exist or not
 * 4. Presents a list of upgrade steps to be completed (checkboxes)
 * 5. If can connect to database, but cannot find the "configuration" table, only allows option to rename table prefixes
 * 6. Requires admin password in order to do upgrade steps
 * 7. Cycles through processing each upgrade SQL file in sequence, as selected.
 *    Won't process upgrades if prerequisites for prior step aren't already validated.
 *
 * @todo  Optimize routine to check for database permissions at the MySQL "user" level.
 *           Needs: SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, INDEX, DROP
 *        NEEDS TO WORK RELIABLY FOR BOTH well-configured and poorly-configured hosting configurations
 */

/////////////////////////////////////////////////////////////////////
//this is the latest database-version-level that this script knows how to inspect and upgrade to.
//it is used to determine whether to stay on the upgrade page when done, or continue to the finished page
$latest_version = '1.5.4';

///////////////////////////////////
$is_upgrade = true; //that's what this page is all about!
$failed_entries=0;

$configure_files_array = array('../includes/configure.php','../admin/includes/configure.php');
$database_tablenames_array=array('../includes/database_tables.php', '../includes/extra_datafiles/music_type_database_names.php');

define('DIR_WS_INCLUDES', '../includes/');
$zc_install->test_store_configure(ERROR_TEXT_STORE_CONFIGURE,ERROR_CODE_STORE_CONFIGURE);
if (ZC_UPG_DEBUG==true && $zc_install->fatal_error) echo 'FATAL ERROR-CONFIGURE FILE';

if (!$zc_install->fatal_error) {
  if (ZC_UPG_DEBUG==true) echo 'configure.php file exists<br />';
  @require_once(DIR_WS_INCLUDES . 'configure.php');

  require(DIR_WS_INCLUDES . 'classes/db/' . DB_TYPE . '/query_factory.php');

  //open database connection to run queries against it
  $db_test = new queryFactory;
  $db_test->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

  //check to see if a database_table_prefix has been defined.  If not, set it to blank.
  if (!defined('DB_PREFIX') || DB_PREFIX == 'DB_PREFIX' || "'".DB_PREFIX."'" == 'DB_PREFIX') {
    define('DB_PREFIX','');
  }

  // Now check the database for what version it's at, if found
  require('includes/classes/class.installer_version_manager.php');
  $dbinfo = new versionManager;

  $privs_array =  explode('|||',zen_check_database_privs('','',true));
  $db_priv_ok = $privs_array[0];
  $zdb_privs_list =  $privs_array[1];
  $privs_found_text='';
  if (ZC_UPG_DEBUG==true) echo 'privs_list_to_parse='.$db_priv_ok.'|||'.$zdb_privs_list;
  foreach(array('ALL PRIVILEGES','SELECT','INSERT','UPDATE','DELETE','CREATE','ALTER','INDEX','DROP') as $value) {
    if (in_array($value,explode(', ',$zdb_privs_list))) {
      $privs_found_text .= $value .', ';
    }
  }
  $zdb_privs=str_replace(',  ',' ',$privs_found_text.' ');
  if (!zen_not_null($zdb_privs)) $zdb_privs=$zdb_privs_list;
  if ($zdb_privs_list == 'Not Checked') $zdb_privs = $zdb_privs_list;

// Finished querying database for configuration info
  $db_test->Close();


// *** NOW DETERMINE REQUIRED UPDATES BASED ON TEST RESULTS
$sniffer_text = '';

//display options based on what was found -- THESE SHOULD BE PROCESSED IN REVERSE ORDER, NEWEST VERSION FIRST... !
//that way only the "earliest-required" upgrade is suggested first.
    $needs_v1_5_4=false;
    if (!$dbinfo->version154) {
      $sniffer_text =  ' upgrade v1.5.3 to v1.5.4';
      $needs_v1_5_4=true;
    }
    $needs_v1_5_3=false;
    if (!$dbinfo->version153) {
      $sniffer_text =  ' upgrade v1.5.2 to v1.5.3';
      $needs_v1_5_3=true;
    }
    $needs_v1_5_2=false;
    if (!$dbinfo->version152) {
      $sniffer_text =  ' upgrade v1.5.1 to v1.5.2';
      $needs_v1_5_2=true;
    }
    $needs_v1_5_1=false;
    if (!$dbinfo->version151) {
      $sniffer_text =  ' upgrade v1.5.0 to v1.5.1';
      $needs_v1_5_1=true;
    }
    $needs_v1_5_0=false;
    if (!$dbinfo->version150) {
      $sniffer_text =  ' upgrade v1.3.9 to v1.5.0';
      $needs_v1_5_0=true;
    }
    $needs_v1_3_9=false;
    if (!$dbinfo->version139) {
      $sniffer_text =  ' upgrade v1.3.8 to v1.3.9';
      $needs_v1_3_9=true;
    }
    $needs_v1_3_8=false;
    if (!$dbinfo->version138) {
      $sniffer_text =  ' upgrade v1.3.7 to v1.3.8';
      $needs_v1_3_8=true;
    }
    $needs_v1_3_7=false;
    if (!$dbinfo->version137) {
      $sniffer_text =  ' upgrade v1.3.6 to v1.3.7';
      $needs_v1_3_7=true;
    }
    $needs_v1_3_6=false;
    if (!$dbinfo->version136) {
      $sniffer_text =  ' upgrade v1.3.5 to v1.3.6';
      $needs_v1_3_6=true;
    }
    $needs_v1_3_5=false;
    if (!$dbinfo->version135) {
      $sniffer_text =  ' upgrade v1.3.0.2 to v1.3.5';
      $needs_v1_3_5=true;
    }
    

    if (!isset($sniffer_text) || $sniffer_text == '') {
      $sniffer_text = ' &nbsp;*** No upgrade required ***';
      $sniffer_version = '';
    }

} // end if zc_install_error == false ....... and database schema checks

if (ZC_UPG_DEBUG2==true) {
  
  echo '<br>135='.$dbinfo->version135;
  echo '<br>136='.$dbinfo->version136;
  echo '<br>137='.$dbinfo->version137;
  echo '<br>138='.$dbinfo->version138;
  echo '<br>139='.$dbinfo->version139;
  echo '<br>150='.$dbinfo->version150;
  echo '<br>151='.$dbinfo->version151;
  echo '<br>152='.$dbinfo->version152;
  echo '<br>153='.$dbinfo->version153;
  echo '<br>154='.$dbinfo->version154;
  echo '<br>';
  }

// IF FORM WAS SUBMITTED, CHECK SELECTIONS AND PERFORM THEM
  if (isset($_POST['submit'])) {
    $sniffer_text =  '';
    $sniffer_version = '';
    $nothing_to_process = false;
    if (is_array($_POST['version'])) {
      if (ZC_UPG_DEBUG2==true) foreach($_POST['version'] as $value) { echo 'Selected: ' . htmlspecialchars($value, ENT_COMPAT, CHARSET, TRUE).'<br />';}
      reset($_POST['version']);
      if (sizeof($_POST['version'])) $zc_install->updateAdminIpList();
      while (list(, $value) = each($_POST['version'])) {
        $sniffer_file = '';
        switch ($value) {
          case '1.3.5':  // upgrading from v1.3.5 TO 1.3.6
//          if (!$dbinfo->version135 || $dbinfo->version136) continue;  // if prerequisite not completed, or already done, skip
            $sniffer_file = '_upgrade_zencart_135_to_136.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_3_6 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.3.6';
            break;
          case '1.3.6':  // upgrading from v1.3.6 TO 1.3.7
//          if (!$dbinfo->version135 || $dbinfo->version137) continue;  // if prerequisite not completed, or already done, skip
            $sniffer_file = '_upgrade_zencart_136_to_137.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_3_7 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.3.7';
            break;
          case '1.3.7':  // upgrading from v1.3.7 TO 1.3.8
//          if (!$dbinfo->version137 || $dbinfo->version138) continue;  // if prerequisite not completed, or already done, skip
            $sniffer_file = '_upgrade_zencart_137_to_138.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_3_8 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.3.8';
            break;
          case '1.3.8':  // upgrading from v1.3.8 TO 1.3.9
//          if (!$dbinfo->version138 || $dbinfo->version139) continue;  // if prerequisite not completed, or already done, skip
            $sniffer_file = '_upgrade_zencart_138_to_139.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_3_9 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.3.9';
            break;
       case '1.3.9':  // upgrading from v1.3.9 TO 1.5.0
            $sniffer_file = '_upgrade_zencart_139_to_150.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_5_0 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.5.0';
            break;
       case '1.5.0':  // upgrading from v1.5.0 TO 1.5.1
            $sniffer_file = '_upgrade_zencart_150_to_151.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_5_1 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.5.1';
            break;
       case '1.5.1':  // upgrading from v1.5.1 TO 1.5.2
            $sniffer_file = '_upgrade_zencart_151_to_152.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_5_2 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.5.2';
            break;
       case '1.5.2':  // upgrading from v1.5.2 TO 1.5.3
            $sniffer_file = '_upgrade_zencart_152_to_153.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_5_3 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.5.3';
            break;
       case '1.5.3':  // upgrading from v1.5.3 TO 1.5.4
            $sniffer_file = '_upgrade_zencart_153_to_154.sql';
            if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
            $got_v1_5_4 = true; //after processing this step, this will be the new version-level
            $db_upgraded_to_version='1.5.4';
            break;
          default:
            $nothing_to_process=true;
        } // end switch
        if (file_exists(DIR_WS_INCLUDES . '../extras/curltest.php')) @unlink(DIR_WS_INCLUDES . '../extras/curltest.php');
        if (file_exists(DIR_WS_INCLUDES . 'modules/payment/paypal/ipn_application_top.php')) @unlink(DIR_WS_INCLUDES . 'modules/payment/paypal/ipn_application_top.php');

        //check for errors
        $zc_install->test_store_configure(ERROR_TEXT_STORE_CONFIGURE,ERROR_CODE_STORE_CONFIGURE);
        if (!$zc_install->fatal_error && isset($_POST['adminid']) && isset($_POST['adminpwd'])) {
          $zc_install->fileExists('sql/' . DB_TYPE . $sniffer_file, DB_TYPE . $sniffer_file . ' ' . ERROR_TEXT_DB_SQL_NOTEXIST, ERROR_CODE_DB_SQL_NOTEXIST);
          $zc_install->functionExists(DB_TYPE, ERROR_TEXT_DB_NOTSUPPORTED, ERROR_CODE_DB_NOTSUPPORTED);
          $zc_install->dbConnect(DB_TYPE, DB_SERVER, DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, ERROR_TEXT_DB_CONNECTION_FAILED, ERROR_CODE_DB_CONNECTION_FAILED,ERROR_TEXT_DB_NOTEXIST, ERROR_CODE_DB_NOTEXIST);
          $zc_install->verifyAdminCredentials($_POST['adminid'], $_POST['adminpwd']);
        } //end if !fatal_error

        if (ZC_UPG_DEBUG2==true) echo 'Processing ['.$sniffer_file.']...<br />';
        if ($zc_install->error == false && $nothing_to_process==false) {
          //open database connection to run queries against it
          $db = new queryFactory;
          $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

          // load the upgrade.sql file(s) relative to the required step(s)
          $query_results = executeSql('sql/'. DB_TYPE . $sniffer_file, DB_DATABASE, DB_PREFIX);
           if ($query_results['queries'] > 0 && $query_results['queries'] != $query_results['ignored']) {
             $messageStack->add('upgrade',$query_results['queries'].' statements processed.', 'success');
           } else {
             $messageStack->add('upgrade','Failed: '.$query_results['queries'], 'error');
           }
           if (zen_not_null($query_results['errors'])) {
             foreach ($query_results['errors'] as $value) {
               $messageStack->add('upgrade-error-details','SKIPPED: '.$value, 'error');
             }
           }
           if ($query_results['ignored'] != 0) {
             $messageStack->add('upgrade','Hinweis: '.$query_results['ignored'].' Updateschritte ignoriert. Sie kvnnen diese meist harmlosen Fehler in der Tabelle "upgrade_exceptions" in der Datenbank nachsehen.', 'caution');
           }
/*           if (zen_not_null($query_results['output'])) {
           foreach ($query_results['output'] as $value) {
echo 'CAUTION: '.$value.'<br />';
             if (zen_not_null($value)) $messageStack->add('INFO: '.$value, 'caution');
           }
         }
*/
        $failed_entries += $query_results['ignored'];

        if ($db_upgraded_to_version == '1.5.0') {
          $zc_install->addSuperUser();
        }

        $db->Close();
      } // end if "no error"

    } // end while - version loop
    if ($failed_entries !=0 ) {
      $zc_install->setError('<span class="errors">HINWEIS: Einige Updateschritte im Updateskript wurden |bersprungen: '.$failed_entries.'<br />Ganz am Ende dieser Seite sehen Sie Details dazu.<br />(Details wurden ebenfalls in der Datenbank in der Tabelle "upgrade_exceptions" protokolliert.)</span><br /><b>WICHTIG: In den meisten Fdllen kvnnen diese fehlgeschlagenen Schritte ignoriert werden!<br />Sie weisen nur darauf hinein, dass Sie einige Einstellungen, die das Update vornehmen wollte, ohnehin bereits aktiv hatten.</b><br />Wdhlen Sie nun Update abgeschlossen und setzen die Konfiguration in der Administration fort.','85', false);
    }
    if (ZC_UPG_DEBUG2==true) echo '<span class="errors">HINWEIS: \bersprungene Updateschritte: '.$failed_entries.'<br />Ganz am Ende dieser Seite sehen Sie Details dazu.<br />(Details wurden ebenfalls in der Datenbank in der Tabelle "upgrade_exceptions" protokolliert.)</span>';
  } // end if-is-array-POST['version']



    // PREFIX-RENAME ROUTINE:
    // if database table-prefix 'change' has been requested, process it here:
    if (isset($_POST['newprefix'])) {
      $zc_install->checkPrefix($_POST['newprefix'], ERROR_TEXT_DB_PREFIX_NODOTS, ERROR_CODE_DB_PREFIX_NODOTS);
      $newprefix = $_POST['newprefix'];
      if (isset($_POST['db_prefix'])) { //use specified "old" prefix if entered
        $db_prefix_rename_from = $_POST['db_prefix'];
      } else {
        $db_prefix_rename_from = DB_PREFIX;
      }
      if ($newprefix != $db_prefix_rename_from) { // don't process prefix changes if same prefix selected
        $zc_install->doPrefixRename($newprefix, $db_prefix_rename_from);
      } //endif newprefix != DB_PREFIX
  } //endif prefix POST'd

// ?
  if (isset($_POST['upgrade'])) {
      header('location: index.php?main_page=system_setup' . zcInstallAddSID() );
    exit;
  }


 if ($db_upgraded_to_version==$latest_version && $zc_install->error == false && $failed_entries==0) {
  // if all db upgrades have been applied, go to the 'finished' page.
  header('location: index.php?main_page=finished' . zcInstallAddSID() );
  exit;
  } else { //return for more upgrades
    if (!$zc_install->fatal_error && !$zc_install->error && $failed_entries==0 ) {
      header('location: index.php?main_page=database_upgrade' . zcInstallAddSID() );
      exit;
    }
  }//endif
 } // end if POST==submit

 if (isset($_POST['skip'])) {
  header('location: index.php?main_page=finished' . zcInstallAddSID() );
  exit;
 }
 if (isset($_POST['refresh'])) {
   header('location: index.php?main_page=database_upgrade' . zcInstallAddSID() );
   exit;
 }

  // quick sanitization
  foreach($_POST as $key=>$val) {
    if(is_array($val)){
      foreach($val as $key2 => $val2){
        $_POST[$key][$key2] = htmlspecialchars($val2, ENT_COMPAT, CHARSET, TRUE);
      }
    } else {
      $_POST[$key] = htmlspecialchars($val, ENT_COMPAT, CHARSET, TRUE);
    }
  }

  $adminName = (isset($_POST['adminid'])) ? $_POST['adminid'] : '';
