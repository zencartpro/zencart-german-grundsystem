<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// $Id:easypopulate_functions.php,v1.2.5.4 2005/09/26 langer $
//

function recaptcha_query($query) {
	global $ep_debug_logging, $ep_debug_logging_all, $ep_stack_sql_error;
	$result = mysql_query($query);
	if (mysql_errno()) {
		$ep_stack_sql_error = true;
		if ($ep_debug_logging == true) {
			// langer - will add time & date..
			$string = "MySQL error ".mysql_errno().": ".mysql_error()."\nWhen executing:\n$query\n";
			write_debug_log($string);
		}
	} elseif ($ep_debug_logging_all == true) {
		$string = "MySQL PASSED\nWhen executing:\n$query\n";
		write_debug_log($string);
	}
	return $result;
}

function install_recaptcha() {
	global $db;
	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_GROUP . " VALUES ('', 'reCAPTCHA', 'Config options for reCAPTCHA text', '1', '1')");
	$group_id = mysql_insert_id();
	$db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = " . $group_id . " WHERE configuration_group_id = " . $group_id);
	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " VALUES 
		('', 'Enable Contact Form', 'CONTACT_US_RECAPTCHA_STATUS', 'true', 'Disply reCAPTCHA text on contact form (default: true)', " . $group_id . ", '9', NULL, now(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
		('', 'reCAPTCHA Public Key', 'CONTACT_US_RECAPTCHA_PUBLIC_KEY', '', 'Public key given from reCAPTCHA website (default: blank).', " . $group_id . ", '0', NULL, now(), NULL, NULL),
		('', 'reCAPTCHA Private Key', 'CONTACT_US_RECAPTCHA_PRIVATE_KEY', '', 'Private key given from reCAPTCHA website (default: blank).', " . $group_id . ", '0', NULL, now(), NULL, NULL),
		('', 'reCAPTCHA Theme', 'CONTACT_US_RECAPTCHA_THEME', 'white', 'Choose a theme option for the widget.', " . $group_id . ", '1', NULL, now(), NULL, 'zen_cfg_select_option(array(\"red\", \"white\", \"blackglass\", \"clean\"),')		
		");
}

function remove_recaptcha() {
	global $db;
	
	$sql = "SELECT
			configuration_group_id
		FROM
			" . TABLE_CONFIGURATION_GROUP . "
		WHERE
		configuration_group_title = 'Easy Populate'";
		
	$result = recaptcha_query($sql);
	if (mysql_num_rows($result)) {
		// we have at least 1 group - let's delete it
		$recaptcha_groups =  mysql_fetch_array($result);
		foreach ($recaptcha_groups as $recaptcha_group) {
			
	    $db->Execute("delete from " . TABLE_CONFIGURATION_GROUP . "
	             where configuration_group_id = '" . (int)$recaptcha_group . "'");
	             
		}
	}
	
	// define array of configuration keys
	$recaptca_keys = array('CONTACT_US_RECAPTCHA_STATUS','CONTACT_US_RECAPTCHA_PUBLIC_KEY','CONTACT_US_RECAPTCHA_PRIVATE_KEY','CONTACT_US_RECAPTCHA_THEME');
	
	// now delete any EP keys found in config
	foreach ($recaptcha_keys as $recaptcha_key) {
	  @$db->Execute("delete from " . TABLE_CONFIGURATION . "
	           where configuration_key = '" . $recaptcha_key . "'");
	}
}


/* End of file */