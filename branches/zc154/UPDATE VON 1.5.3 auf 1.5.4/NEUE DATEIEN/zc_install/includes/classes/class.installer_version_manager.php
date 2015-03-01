<?php
/**
 * Version Manager Class
 *
 * This class is used during the installation and upgrade processes
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.installer_version_manager.php 845 2015-01-22 16:58:25Z webchills $
 */



/*////////////////////////////////////////////////////////////////////////////////////////////////////////////
////  HOW TO UPDATE FOR NEW RELEASES:
////  a. in function zen_database() below, set the $this->latest_version appropriately
////  b. in function check_check_all_versions(), update:
////     i)  add a line to call a new check_versionXXXX() function
////     ii) add another IF statement to set the displayed version text ($retVal)
////  c. add a new check_versionXXXX() function to the end of the class (BEFORE the closing } in the file)
////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

require_once(DIR_FS_CATALOG . 'includes/' . 'functions/extra_functions/rl_tools.php');
  class versionManager extends base{
    var $latest_version, $found_version, $zdb_configuration_table_found;

    function versionManager() {
      /**
       * The version that this edition of the installer is designed to support
       */
      $this->latest_version = '1.5.4';

      /**
       * Check to see if the configuration table can be found...thus validating the installation, in part.
       */
      $this->zdb_configuration_table_found = $this->check_configuration_table();
      /**
       * Check to see which versions are successfully detected
       */
      $this->found_version = $this->check_check_all_versions();
    }

    function check_configuration_table() {
      global $db_test;
// Check to see if any Zen Cart tables exist
      $tables = $db_test->Execute("SHOW TABLES like '".DB_PREFIX."configuration'");
       if (ZC_UPG_DEBUG==true) echo 'ZEN-Configuration (should be 1) = '. $tables->RecordCount() .'<br>';
       if ($tables->RecordCount() > 0) {
         return true;
       }
    }

    function check_check_all_versions() {
      if (!$this->zdb_configuration_table_found) return false;
      
      $this->version135 = $this->check_version_135();
      $this->version136 = $this->check_version_136();
      $this->version137 = $this->check_version_137();
      $this->version138 = $this->check_version_138();
      $this->version139 = $this->check_version_139();
      $this->version150 = $this->check_version_150();
      $this->version151 = $this->check_version_151();
      $this->version152 = $this->check_version_152();
      $this->version153 = $this->check_version_153();
      $this->version154 = $this->check_version_154();
        
        if ($this->version135 == true) $retVal = '1.3.5';
        if ($this->version136 == true) $retVal = '1.3.6';
        if ($this->version137 == true) $retVal = '1.3.7';
        if ($this->version138 == true) $retVal = '1.3.8';
        if ($this->version139 == true) $retVal = '1.3.9';
        if ($this->version150 == true) $retVal = '1.5.0';
        if ($this->version151 == true) $retVal = '1.5.1';
      if ($this->version152 == true) $retVal = '1.5.2';
      if ($this->version153 == true) $retVal = '1.5.3';
      if ($this->version154 == true) $retVal = '1.5.4';

      return $retVal;
    }

    

    function check_version_135() {
      global $db_test;
      $got_v1_3_5 = false;
      $got_v1_3_5a = false;
      $got_v1_3_5b = false;
      //1st check for v1.3.5
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key='PRODUCT_LIST_PRICE_BUY_NOW'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "135a-configkey_check PRODUCT_LIST_PRICE_BUY_NOW =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Display Product Add to Cart Button (0=off; 1=on; 2=on with Qty Box per Product)') {
        $got_v1_3_5a = true;
      }
      //2nd check for v1.3.5
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key='PRODUCT_LIST_ALPHA_SORTER'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "135b-configkey_check PRODUCT_LIST_ALPHA_SORTER =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Include Product Listing Alpha Sorter Dropdown') {
        $got_v1_3_5b = true;
      }

      if (ZC_UPG_DEBUG==true) {
        echo '1.3.5a='.$got_v1_3_5a.'<br>';
        echo '1.3.5b='.$got_v1_3_5b.'<br>';
      }
      // evaluate all 1.3.5 checks
      if ($got_v1_3_5a && $got_v1_3_5b ) {
        $got_v1_3_5 = true;
        if (ZC_UPG_DEBUG==true) echo '<br>Got 1.3.5<br>';
      }
      return $got_v1_3_5;
    } //end of 1.3.5 check

    function check_version_136() {
      global $db_test;
      $got_v1_3_6 = false;
      $got_v1_3_6a = false;
      $got_v1_3_6b = false;
      //1st check for v1.3.6
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key='META_TAG_INCLUDE_MODEL'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "136a-configkey_check META_TAG_INCLUDE_MODEL =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Meta Tags - Include Product Model in Title') {
        $got_v1_3_6a = true;
      }
      //2nd check for v1.3.6
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key='SHOW_SHOPPING_CART_EMPTY_UPCOMING'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "136b-configkey_check SHOW_SHOPPING_CART_EMPTY_UPCOMING =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Show Upcoming Products on empty Shopping Cart Page') {
        $got_v1_3_6b = true;
      }

      if (ZC_UPG_DEBUG==true) {
        echo '1.3.6a='.$got_v1_3_6a.'<br>';
        echo '1.3.6b='.$got_v1_3_6b.'<br>';
      }
      // evaluate all 1.3.6 checks
      if ($got_v1_3_6a && $got_v1_3_6b ) {
        $got_v1_3_6 = true;
        if (ZC_UPG_DEBUG==true) echo '<br>Got 1.3.6<br>';
      }
      return $got_v1_3_6;
    } //end of 1.3.6 check



    function check_version_137() {
      global $db_test;
      $got_v1_3_7 = false;
      $got_v1_3_7a = false;
      $got_v1_3_7b = false;
      //1st check for v1.3.7
      $sql = "select configuration_description from " . DB_PREFIX . "configuration where configuration_key='DEFINE_BREADCRUMB_STATUS'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "137a-configdesc_check DEFINE_BREADCRUMB_STATUS =" . $result->fields['configuration_description'] . '<br>';
      if  ($result->fields['configuration_description'] == 'Enable the Breadcrumb Trail Links?<br />0= OFF<br />1= ON<br />2= Off for Home Page Only') {
        $got_v1_3_7a = true;
      }
      //2nd check for v1.3.7
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key='USE_SPLIT_LOGIN_MODE'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "137b-configkey_check USE_SPLIT_LOGIN_MODE =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Use split-login page') {
        $got_v1_3_7b = true;
      }

      if (ZC_UPG_DEBUG==true) {
        echo '1.3.7a='.$got_v1_3_7a.'<br>';
        echo '1.3.7b='.$got_v1_3_7b.'<br>';
      }
      // evaluate all 1.3.7 checks
      if ($got_v1_3_7a && $got_v1_3_7b ) {
        $got_v1_3_7 = true;
        if (ZC_UPG_DEBUG==true) echo '<br>Got 1.3.7<br>';
      }
      return $got_v1_3_7;
    } //end of 1.3.7 check



    function check_version_138() {
      global $db_test;
      $got_v1_3_8 = false;
      $got_v1_3_8a = false;
      $got_v1_3_8b = false;
      //1st check for v1.3.8
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key = 'SHOW_SHOPPING_CART_COMBINED'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "138a-configtitle_check SHOW_SHOPPING_CART_COMBINED =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Show Notice of Combining Shopping Cart on Login') {
        $got_v1_3_8a = true;
      }
      //2nd check for v1.3.8
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key = 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "138b-configkey_check MAX_RANDOM_SELECT_FEATURED_PRODUCTS =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Random Featured Products for SideBox') {
        $got_v1_3_8b = true;
      }

      if (ZC_UPG_DEBUG==true) {
        echo '1.3.8a='.$got_v1_3_8a.'<br>';
        echo '1.3.8b='.$got_v1_3_8b.'<br>';
      }
      // evaluate all 1.3.8 checks
      if ($got_v1_3_8a && $got_v1_3_8b ) {
        $got_v1_3_8 = true;
        if (ZC_UPG_DEBUG==true) echo '<br>Got 1.3.8<br>';
      }
      return $got_v1_3_8;
    } //end of 1.3.8 check



    function check_version_139() {
      global $db_test;
      $got_v1_3_9 = false;
      $got_v1_3_9a = false;
      $got_v1_3_9b = false;
      //1st check for v1.3.9
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key = 'SHOW_SPLIT_TAX_CHECKOUT'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "139a-configtitle_check SHOW_SPLIT_TAX_CHECKOUT =" . $result->fields['configuration_title'] . '<br>';
      if  ($result->fields['configuration_title'] == 'Show Split Tax Lines') {
        $got_v1_3_9a = true;
      }
      //2nd check for v1.3.9
      $tables = $db_test->Execute("SHOW TABLES like '" . DB_PREFIX . "authorizenet'");
      if ($tables->RecordCount() > 0) {
        $sql = "show fields from " . DB_PREFIX . "authorizenet";
        $result = $db_test->Execute($sql);
        while (!$result->EOF) {
          if (ZC_UPG_DEBUG==true) echo "139b-fields-'transaction_id'->bigint=" . $result->fields['Field'] . '->' . $result->fields['Type'] . '<br>';
          if  ($result->fields['Field'] == 'transaction_id') {
            if (strstr(strtoupper($result->fields['Type']),'BIGINT'))  {
              $got_v1_3_9b = true;
            }
          }
        $result->MoveNext();
        }
      }

      if (ZC_UPG_DEBUG==true) {
        echo '1.3.9a='.$got_v1_3_9a.'<br>';
        echo '1.3.9b='.$got_v1_3_9b.'<br>';
      }
      // evaluate all 1.3.9 checks
      if ($got_v1_3_9a && $got_v1_3_9b ) {
        $got_v1_3_9 = true;
        if (ZC_UPG_DEBUG==true) echo '<br>Got 1.3.9<br><br>';
      }
      return $got_v1_3_9;
    } //end of 1.3.9 check




    function check_version_150() {
      global $db_test;
      $got_v1_5_0 = false;
      $got_v1_5_0a = false;
      $got_v1_5_0b = false;
      //1st check for v1.5.0
      $sql = "show fields from " . DB_PREFIX . "admin";
      $result = $db_test->Execute($sql);
      while (!$result->EOF) {
        if (ZC_UPG_DEBUG==true) echo "150-fields-'reset_token'" . $result->fields['Field'] . '->' . $result->fields['Type'] . '<br>';
        if  ($result->fields['Field'] == 'reset_token') {
          $got_v1_5_0a = true;
        }
        $result->MoveNext();
      }
      //2nd check for v1.5.0
      $sql = "show fields from " . DB_PREFIX . "admin";
      $result = $db_test->Execute($sql);
      while (!$result->EOF) {
        if (ZC_UPG_DEBUG==true) echo "150-fields-'last_failed_ip'" . $result->fields['Field'] . '->' . $result->fields['Type'] . '<br>';
        if  ($result->fields['Field'] == 'last_failed_ip') {
          $got_v1_5_0b = true;
        }
        $result->MoveNext();
      }
      if (ZC_UPG_DEBUG==true) {
        echo '1.5.0a='.$got_v1_5_0a.'<br>';
        echo '1.5.0b='.$got_v1_5_0b.'<br>';
      }
      // evaluate all 1.5.0 checks
      if ($got_v1_5_0a && $got_v1_5_0b ) {
        $got_v1_5_0 = true;
        if (ZC_UPG_DEBUG==true) echo 'Got 1.5.0<br><br>';
      }
      return $got_v1_5_0;
    } //end of 1.5.0 check


    function check_version_151() {
      global $db_test;
      $got_v1_5_1 = false;
      $sql = "show fields from " . DB_PREFIX . "admin_activity_log";
      $result = $db_test->Execute($sql);
      while (!$result->EOF && !$got_v1_5_1) {
        if (ZC_UPG_DEBUG==true) echo "151-fields-'ip_address TEST: '" . $result->fields['Field'] . '->' . $result->fields['Type'] . '<br>';
        if  ($result->fields['Field'] == 'ip_address' && strtoupper($result->fields['Type']) == 'VARCHAR(45)') {
          $got_v1_5_1 = true;
          if (ZC_UPG_DEBUG==true) echo 'Got 1.5.1<br><br>';
        }
        $result->MoveNext();
      }
      return $got_v1_5_1;
    } //end of 1.5.1 check


    function check_version_152() {
      global $db_test;
      $got_v1_5_2a = $got_v1_5_2b = false;
      $sql = "show fields from " . DB_PREFIX . "sessions";
      $result = $db_test->Execute($sql);
      while (!$result->EOF && !$got_v1_5_2a) {
        if (ZC_UPG_DEBUG==true && $result->fields['Field'] == 'sesskey') echo "152a-fields-'sesskey TEST: '" . $result->fields['Field'] . '->' . $result->fields['Type'] . ' (expecting VARCHAR(255))<br>';
        if  ($result->fields['Field'] == 'sesskey' && strtoupper($result->fields['Type']) == 'VARCHAR(255)') {
          $got_v1_5_2a = true;
          if (ZC_UPG_DEBUG==true) echo 'OKAY 1.5.2a<br><br>';
        }
        $result->MoveNext();
      }
      $sql = "select configuration_description from " . DB_PREFIX . "configuration where configuration_key = 'SESSION_WRITE_DIRECTORY'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "152b-configdesc_check SESSION_WRITE_DIRECTORY =" . $result->fields['configuration_description'] . '<br>';
      if  ($result->fields['configuration_description'] == 'This should point to the folder specified in your DIR_FS_SQL_CACHE setting in your configure.php files.') {
        $got_v1_5_2b = true;
        if (ZC_UPG_DEBUG==true) echo 'OKAY: 1.5.2b<br><br>';
      }
      if (ZC_UPG_DEBUG==true && !$got_v1_5_2b) echo 'BAD: 1.5.2b<br><br>';

      return ($got_v1_5_2a && $got_v1_5_2b);
    } //end of 1.5.2 check


    function check_version_153() {
      global $db_test;
      $got_v1_5_3a = false;
      $sql = "show fields from " . DB_PREFIX . "customers";
      $result = $db_test->Execute($sql);
      while (!$result->EOF && !$got_v1_5_3a) {
        if (ZC_UPG_DEBUG==true && $result->fields['Field'] == 'customers_password') echo "153a-fields-'customers_password TEST: '" . $result->fields['Field'] . '->' . $result->fields['Type'] . ' (expecting VARCHAR(255))<br>';
        if  ($result->fields['Field'] == 'customers_password' && strtoupper($result->fields['Type']) == 'VARCHAR(255)') {
          $got_v1_5_3a = true;
          if (ZC_UPG_DEBUG==true) echo 'OKAY 1.5.3a<br><br>';
        }
        $result->MoveNext();
      }
      if (ZC_UPG_DEBUG==true && !$got_v1_5_3a) echo 'BAD: 1.5.3a<br><br>';

      return $got_v1_5_3a;
    } //end of 1.5.3 check


    function check_version_154() {
      global $db_test;
      $got_v1_5_4a = false;
      $sql = "select configuration_title from " . DB_PREFIX . "configuration where configuration_key = 'PADSS_AJAX_CHECKOUT'";
      $result = $db_test->Execute($sql);
      if (ZC_UPG_DEBUG==true) echo "154a-configtitle_check PADSS_AJAX_CHECKOUT =" . $result->fields['configuration_title'] . '<br>';
      if (!$result->EOF && $result->fields['configuration_title'] == 'PA-DSS Ajax Checkout?') {
        $got_v1_5_4a = true;
      }
      if (ZC_UPG_DEBUG==true && !$got_v1_5_4a) echo 'BAD: 1.5.4a<br><br>';

      return $got_v1_5_4a;
    } //end of 1.5.4 check

  } // end class

