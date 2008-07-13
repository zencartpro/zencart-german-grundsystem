<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: usertracking 2004-12-1 dave@open-operations.com http://open-operations.com
function zen_update_user_tracking()
  {
    global $db;
    global $customer_id, $languages_id, $_GET;
    foreach(explode(",", CONFIG_USER_TRACKING_EXCLUDED) as $skip_ip) {
    $skip_tracking[trim($skip_ip)] = 1;
    }
    if ($_SESSION['customer_id']) {
    $wo_customer_id = $customer_id;
    $customer = $db->Execute("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
    $wo_full_name = addslashes($customer->fields['customers_firstname'] . ' ' . $customer->fields['customers_lastname']);
    }
    else {
    $wo_customer_id = '';
    $wo_full_name = 'Guest';
    }
    $wo_session_id = zen_session_id();
    $wo_ip_address = getenv('REMOTE_ADDR');
    $wo_last_page_url = addslashes(getenv('REQUEST_URI'));
    $referer_url = ($_SERVER['HTTP_REFERER'] == '') ?  $wo_last_page_url : $_SERVER['HTTP_REFERER'];
	if (($_GET['products_id'] || $_GET['cPath'])) {
		if ($_GET['cPath'] && ZEN_CONFIG_SHOW_USER_TRACKING_CATEGORY == 'true') {   // JTD:12/04/06 - Woody feature request
			$cPath = $_GET['cPath'];
			$cPath_array = zen_parse_category_path($cPath);
			$cPath = implode('_', $cPath_array);
			$current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
			$page_desc_values = $db->Execute("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $current_category_id . "'");
			$page_desc = addslashes($page_desc_values->fields['categories_name']) . '&nbsp;-&nbsp;';
		}
	if ($_GET['products_id']) {
		$page_desc_values = $db->Execute("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $_GET['products_id'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
		$page_desc .= addslashes($page_desc_values->fields['products_name']);
	    }
	}
	else {
		$page_desc = addslashes(HEADING_TITLE);
		if ($page_desc == "HEADING_TITLE")
			$page_desc = addslashes(NAVBAR_TITLE);
	}
	$current_time = time();
    if ($skip_tracking[$wo_ip_address] != 1) {
    // JTD:05/15/06 - Query bug fixes for mySQL 5.x
    $cust_id = $_SESSION['customer_id'];
        if ($cust_id == NULL) {
            $cust_id = 0;
        }
    $customers_host_address = $_SESSION['customers_host_address']; // JTD:11/27/06 - added host address support
    $page_desc = substr($page_desc, 0, 63);
    $wo_last_page_url = substr($wo_last_page_url, 0, 253);
    $db->Execute("insert into " . TABLE_USER_TRACKING . " (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url, referer_url, page_desc, customers_host_address) values ('" . $cust_id . "', '" . $wo_full_name . "', '" . $wo_session_id . "', '" . $wo_ip_address . "', '" . $current_time . "', '" . $current_time . "', '" . $wo_last_page_url . "', '" . $referer_url . "', '" . $page_desc . "', '" . $customers_host_address . "')");
    }
  }
?>