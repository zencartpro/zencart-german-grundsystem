<?php
/**
 * Zen Cart German Specific
 * whos_online functions
 *
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: whos_online.php 734 2021-11-28 20:49:16Z webchills $
 */

function zen_update_whos_online()
{
    // exclude ajax pages from whos-online updates
    if (preg_match('|ajax\.php$|', $_SERVER['SCRIPT_NAME']) && $_GET['act'] != '') return;

    global $db;

    $wo_customer_id = '';
    $wo_full_name = '&yen;' . 'Guest';

    if (zen_is_logged_in() && !zen_in_guest_checkout()) {
        $wo_customer_id = $_SESSION['customer_id'];

        $sql = "SELECT customers_firstname, customers_lastname
                FROM " . TABLE_CUSTOMERS . "
                WHERE customers_id = '" . (int)$_SESSION['customer_id'] . "'";

        $customer = $db->Execute($sql);

        $wo_full_name = $customer->fields['customers_lastname'] . ', ' . $customer->fields['customers_firstname'];
    }

    $wo_session_id = zen_session_id();
    $wo_ip_address = substr(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown', 0, 45);
  $wo_user_agent = substr(zen_db_prepare_input(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''), 0, 254);

	$_SERVER['QUERY_STRING'] = (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') ? $_SERVER['QUERY_STRING'] : zen_get_all_get_params();
  if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
   } else {
    if (isset($_SERVER['QUERY_STRING'])) {
     $uri = $_SERVER['SCRIPT_NAME'] .'?'. $_SERVER['QUERY_STRING'];
    } else {
     $uri = $_SERVER['SCRIPT_NAME'] .'?'. $_SERVER['argv'][0];
    }
  }
  if (substr($uri, -1)=='?') $uri = substr($uri,0,strlen($uri)-1);
  $wo_last_page_url = (zen_not_null($uri) ? substr($uri, 0, 254) : 'Unknown');
  // MailBeez
  // avoid /mailhive.php?cron_simple=1 in who is online table
  if (preg_match("/mailhive.php/", $wo_last_page_url)) {
   return false;
  }
  // - MailBeez
  $current_time = time();
  $xx_mins_ago = ($current_time - 900);

  // remove entries that have expired
  $sql = "delete from " . TABLE_WHOS_ONLINE . "
          where time_last_click < '" . $xx_mins_ago . "'";

  $db->Execute($sql);

  $stored_customer_query = "select count(*) as count
                              from " . TABLE_WHOS_ONLINE . "
                              where session_id = '" . zen_db_input($wo_session_id) . "' and ip_address='" . zen_db_input($wo_ip_address) . "'";

  $stored_customer = $db->Execute($stored_customer_query);

  if (empty($wo_session_id)) {
    $wo_full_name = '&yen;' . 'Spider';
  }

  if ($stored_customer->fields['count'] > 0) {
    $sql = "update " . TABLE_WHOS_ONLINE . "
              set customer_id = '" . (int)$wo_customer_id . "',
                  full_name = '" . zen_db_input($wo_full_name) . "',
                  ip_address = '" . zen_db_input($wo_ip_address) . "',
                  time_last_click = '" . zen_db_input($current_time) . "',
                  last_page_url = '" . zen_db_input($wo_last_page_url) . "',
                  host_address = '" . zen_db_input($_SESSION['customers_host_address']) . "',
                  user_agent = '" . zen_db_input($wo_user_agent) . "'
                WHERE session_id = '" . zen_db_input($wo_session_id) . "'
                AND ip_address='" . zen_db_input($wo_ip_address) . "'";

        $db->Execute($sql);

    } else {
        $sql = "INSERT INTO " . TABLE_WHOS_ONLINE . "
                (customer_id, full_name, session_id, ip_address, time_entry,
                 time_last_click, last_page_url, host_address, user_agent)
                VALUES ('" . (int)$wo_customer_id . "', '" . zen_db_input($wo_full_name) . "', 
                '" . zen_db_input($wo_session_id) . "', '" . zen_db_input($wo_ip_address) . "',
                '" . zen_db_input($current_time) . "', '" . zen_db_input($current_time) . "',
                '" . zen_db_input($wo_last_page_url) . "',
                '" . zen_db_input($_SESSION['customers_host_address']) . "',
                '" . zen_db_input($wo_user_agent) . "')";
        $db->Execute($sql);
    }
}

function whos_online_session_recreate($old_session, $new_session)
{
    global $db;

    $sql = "UPDATE " . TABLE_WHOS_ONLINE . "
            SET session_id = :newSessionID 
            WHERE session_id = :oldSessionID";
    $sql = $db->bindVars($sql, ':newSessionID', $new_session, 'string');
    $sql = $db->bindVars($sql, ':oldSessionID', $old_session, 'string');
    $db->Execute($sql);
}
