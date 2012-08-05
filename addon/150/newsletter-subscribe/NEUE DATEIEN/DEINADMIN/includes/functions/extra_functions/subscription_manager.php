<?php
/**
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: subscription_manager.php 2012-08-03 11:12:12 webchills $
 */


function import_subscriptions($delim=',', $encl=false, $sample='', $def_format='TEXT', $header_row=true) {
	global $db;
	$email_elem=false; $format_elem=false;	$error = '';

	$sample_arr = explode(' ',trim($sample)); $elems = count($sample_arr);
  $email_elem = array_search('email',$sample_arr);
  $format_elem = array_search('format',$sample_arr);

	if($email_elem===false) { $error = 'Upload failed: No email element specified.'; }
  $import_file = $_FILES['subscriber_import_file']['tmp_name'];
  $import_error = $_FILES['subscriber_import_file']['error'];
	
	
	if(!empty($import_error)) {
	  switch($import_error) {
			case 1:
			case 2: $error = 'Upload failed: The uploaded file exceeds the upload_max_filesize<br/>'; break;
			case 3: $error = 'Upload failed: The uploaded file was only partially uploaded.<br/>'; break;
			case 4: $error = 'Upload failed: No file was uploaded.<br/>'; break;
			case 6: $error = 'Upload failed: Missing a temporary folder.<br/>'; break;
			default: $error = 'Upload failed: Unknown error uploading file.<br />'; break;
		}
	} elseif(empty($import_file)) { $error = 'Upload failed: File not found/uploaded.<br />'; return false;}

  if(empty($error)) {
		switch($delim) {
			case '\n' : $delim="\n"; break;
			case '\t' : $delim="\t"; break;
			case '\a' : $delim="\a"; break;
			case ' ' : case '' : $delim="\t"; break;
		}
		
		$row = 1; $imported=0;
		$handle = fopen($import_file, "r");
		zen_set_time_limit(600);
		for($row=1;(($data = fgetcsv($handle, 10000, $delim)) !== FALSE);$row++) {
			if((count($data)==1) && (strlen($data[0])<3)) { /* empty row */ }
			elseif($header_row && $row==1) { }
			else {
				$ea = (empty($data[$email_elem]) ? '' : $data[$email_elem]);
				$ef = (!empty($data[$format_elem]) && in_array(strtoupper($data[$format_elem]),array('HTML','TEXT'))) ? strtoupper($data[$format_elem]) : $def_format;
				if(!empty($ea)) {
					$db->Execute("REPLACE INTO " . TABLE_SUBSCRIBERS . 
											 " ( email_address, email_format, confirmed, subscribed_date ) VALUES ( '{$ea}', '{$ef}', '1', NOW() )");
					$imported++;
				}
			}
		}
		fclose($handle);
	}
	return array($imported, $error);
}

function transfer_subscriptions() {
	global $db;
	$sql = "SELECT customers_id, customers_email_address, customers_email_format, customers_newsletter FROM " . TABLE_CUSTOMERS . " 
			WHERE customers_newsletter = 1";
	
	$cust_subscribers = $db->Execute($sql);
	
	$i=0;
	
	while(!$cust_subscribers->EOF) {
		$i++;
		$db->Execute("REPLACE INTO " . TABLE_SUBSCRIBERS . " 
					  (	customers_id, email_address, email_format, subscribed_date )
					  VALUES
					  ( '" . $cust_subscribers->fields['customers_id'] . "',
						'" . $cust_subscribers->fields['customers_email_address'] . "',
						'" . $cust_subscribers->fields['customers_email_format'] . "',
						NOW() )");
		$cust_subscribers->MoveNext();
	}
}

function install_newsonly_subscriptions() {
	global $db;

	if(!defined('NEWSONLY_SUBSCRIPTION_VERSION') || (NEWSONLY_SUBSCRIPTION_VERSION < 204)) {

		// new install or old upgrade. Drop/Create database.
		//		$db->Execute("DROP TABLE IF EXISTS " . TABLE_SUBSCRIBERS );
		$db->Execute("
			CREATE TABLE IF NOT EXISTS " . TABLE_SUBSCRIBERS . " (
				`subscriber_id` int(11) NOT NULL auto_increment,
				`customers_id` int(11) default NULL,
				`email_address` varchar(96) NOT NULL default '' UNIQUE,
				`email_format` varchar(4) NOT NULL default 'TEXT',
				`confirmed` varchar(8) default NULL,
				`subscribed_date` date NOT NULL default '0000-00-00',
				PRIMARY KEY  (`subscriber_id`)
			) ;");

		if(!defined('NEWSONLY_SUBSCRIPTION_ENABLED')) {
	
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added` , `use_function` , `set_function` )
							VALUES ('Enable Newsletter-only subscriptions?', 'NEWSONLY_SUBSCRIPTION_ENABLED', 'true', 'Are visitors allowed to subscribe to your newsletter without creating a customer account?', '1', '200', NULL , NOW(), NULL , 'zen_cfg_select_option(array(''true'', ''false''),')");
	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." 
							( `configuration_title` , `configuration_key` , `configuration_description` , `configuration_language_id` )
							VALUES ('Newsletter ohne Kundenkunto aktivieren?', 'NEWSONLY_SUBSCRIPTION_ENABLED', 'Sollen sich Besucher ohne Kundenkonto für den Newsletter anmelden können?', '43')");
	
		}

		if(!defined('NEWSONLY_SUBSCRIPTION_VERSION')) {
		
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added` )
							VALUES ('News-only Subscriptions Version', 'NEWSONLY_SUBSCRIPTION_VERSION', '205', 'Are visitors allowed to subscribe to your newsletter without creating a customer account?', '0', '0', NULL , NOW() )");
		} else {
			$db->Execute("UPDATE " . TABLE_CONFIGURATION ." 
									 SET configuration_value = '205', 
											 configuration_description = 'Newsletter Subscribe Version',
											 last_modified = NOW() 
									 WHERE configuration_key = 'NEWSONLY_SUBSCRIPTION_VERSION'");
		}

		if(!defined('NEWSONLY_SUBSCRIPTION_HEADER')) {
	
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added` , `use_function` , `set_function` )
							VALUES ('Show Newsletter-only subscription field in header?', 'NEWSONLY_SUBSCRIPTION_HEADER',  'false', 'Show subscribe link in header? Note: You must edit your custom template tpl_header.php file in order to use this. See readme that came with contribution.','19', '200', NULL , NOW(), NULL , 'zen_cfg_select_option(array(''true'', ''false''),')");
		$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." 
							( `configuration_title` , `configuration_key` , `configuration_description` , `configuration_language_id` )
							VALUES ('Newsletteranmeldung im Header anzeigen', 'NEWSONLY_SUBSCRIPTION_HEADER', 'Soll im Header ein Link zum Newsletterabo angezeigt werden? Hinweis: Sie müssen dazu Ihre includes/templates/DEINTEMPLATE/common/tpl_header.php entsprechend anpassen!', '43')");
	
		
		}
		
		if(!defined('NEWSONLY_SUBSCRIPTION_CC_STATUS')) {
	
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added` , `use_function` , `set_function` )
							VALUES ('Send Notice of Newsletter-only Subscriptions To - Status',
							'NEWSONLY_SUBSCRIPTION_CC_STATUS',  '0',
							'Would you like to send a notice of new newsletter-only subscribers?<br />0=off, 1=on','12', '200', NULL , NOW(), NULL , 'zen_cfg_select_option(array(''0'', ''1''),')");
		$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." 
							( `configuration_title` , `configuration_key` , `configuration_description` , `configuration_language_id` )
							VALUES ('Benachrichtigung über Newsletteranmeldung an Admin senden?', 'NEWSONLY_SUBSCRIPTION_CC_STATUS', 'Soll der Admin per Mail über eine Newsletteranmaldung benachrichtigt werden?', '43')");
	
		
		}
	
		if(!defined('NEWSONLY_SUBSCRIPTION_CC')) {
	
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added`  )
							VALUES ('Send Notice of Newsletter-only Subscriptions To', 'NEWSONLY_SUBSCRIPTION_CC',  '',
							'Send notice of newsletter-only subscriptions to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;','12', '201', NULL , NOW() )");
	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." 
							( `configuration_title` , `configuration_key` , `configuration_description` , `configuration_language_id` )
							VALUES ('Emailadresse für Benachrichtigung über Newsletteranmeldung', 'NEWSONLY_SUBSCRIPTION_CC', 'In Folgendem Format eingeben: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt; ', '43')");
	
		
		}
		
	
		if(!defined('NEWSONLY_SUBSCRIPTION_TEST_GROUP')) {
	
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION ." 
							( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `last_modified` , `date_added`  )
							VALUES ('Newsletter Test Group Email', 'NEWSONLY_SUBSCRIPTION_TEST_GROUP',  '',
							'Enter the email addresses of customers and newsletter-only subscribers that you wish to send test emails to.<br />Only valid subscriber/customer emails will work.','12', '202', NULL , NOW() )");
		$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_LANGUAGE ." 
							( `configuration_title` , `configuration_key` , `configuration_description` , `configuration_language_id` )
							VALUES ('Emailadressen für Newsletter Tests', 'NEWSONLY_SUBSCRIPTION_TEST_GROUP', 'Geben Sie hier die Emailadressen von Kunden und von Newsletterabonnenten ohne Kundenkonto ein, die Sie für Test Emails verwenden wollen.<br/>Hinweis: Diese Adressen müssen den Newsletter abonniert haben!', '43')");
	
		}
	
		
		
		// update the existing query in the query builder to reflect 'customer only' status
		$db->Execute("UPDATE " . TABLE_QUERY_BUILDER ." SET 
							query_name='Customer Account Newsletter Subscribers', 
							query_description='Returns name and email address of newsletter subscribers who have a customer account.'
							WHERE query_string='select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'';");
	
		// check for our query strings. add if absent.
		
		// All newsletter subscribers (customer and news-only)
		$qc1 = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
		" WHERE query_string = 'select c.customers_firstname, c.customers_lastname, s.email_address as customers_email_address from TABLE_SUBSCRIBERS as s left join TABLE_CUSTOMERS as c on c.customers_id = s.customers_id '");
	
		if(empty($qc1->fields['total'])) {
			$db->Execute("INSERT INTO " . TABLE_QUERY_BUILDER ." 
							(query_category, query_name, query_description, query_string, query_keys_list)
							VALUES ('email,newsletters', 'All Newsletter Subscribers',
							'Returns name and email address of all Customer Account subscribers and all Newsletter-Only subscribers.',
							'select c.customers_firstname, c.customers_lastname, s.email_address as customers_email_address from TABLE_SUBSCRIBERS as s left join TABLE_CUSTOMERS as c on c.customers_id = s.customers_id ', '')");
		}
		
		// Newsletter-only subscribers - fix on old versions.
		$qc2 = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
		" WHERE query_string = 'SELECT email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'");
	
		if(!empty($qc2->fields['total'])) {
			$db->Execute("UPDATE " . TABLE_QUERY_BUILDER . " 
				SET query_string = 'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address' 
				WHERE query_string = 'SELECT email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'"
			);
		}
	
		// Newsletter-only subscribers
		$qc2b = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
		" WHERE query_string = 'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'");
	
		if(empty($qc2b->fields['total'])) {
			$db->Execute("INSERT INTO " . TABLE_QUERY_BUILDER ." 
							(query_category, query_name, query_description, query_string, query_keys_list)
							VALUES ('email,newsletters', 'Newsletter-only Subscribers',
							'Returns email address of all confirmed Newsletter-Only subscribers.',
							'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address', '')");
		}
	
		// newsletter-only test group.
		$qc3 = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
		" WHERE query_string = 'SELECT s.email_address as customers_email_address FROM TABLE_SUBSCRIBERS as s LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( s.email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' '");
	
		if(empty($qc3->fields['total'])) {
			$db->Execute("INSERT INTO " . TABLE_QUERY_BUILDER ." 
				(query_category, query_name, query_description, query_string)
				VALUES ('email,newsletters', 'Email Test Group - Newsletter-only subscribers',
				'Returns name and email address of Newsletter-only subscribers designated in Email test group configuration.',
				'SELECT s.email_address as customers_email_address FROM TABLE_SUBSCRIBERS as s LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( s.email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' ') ");
	
		}
		
		// customer email testgroup
		$qc4 = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
		" WHERE query_string = 'SELECT c.customers_email_address as customers_email_address FROM TABLE_CUSTOMERS as c LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( c.customers_email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' '");
	
		if(empty($qc4->fields['total'])) {
			$db->Execute("INSERT INTO " . TABLE_QUERY_BUILDER ." 
				(query_category, query_name, query_description, query_string)
				VALUES ('email,newsletters', 'Email Test Group - Customers',
				'Returns name and email address of Newsletter-only subscribers designated in Email test group configuration.',
				'SELECT c.customers_email_address as customers_email_address FROM TABLE_CUSTOMERS as c LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( c.customers_email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' ') ");
	
		}
	
		 transfer_subscriptions();
		} else {
			if(NEWSONLY_SUBSCRIPTION_VERSION == '204'){

				// Newsletter-only subscribers - fix on old versions.
				$qc2 = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
				" WHERE query_string = 'SELECT email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'");
			
				if(!empty($qc2->fields['total'])) {
					$db->Execute("UPDATE " . TABLE_QUERY_BUILDER . " 
						SET query_string = 'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address' 
						WHERE query_string = 'SELECT email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'"
					);
				}
			
				// Newsletter-only subscribers
				$qc2b = $db->Execute("select count(*) as total FROM " . TABLE_QUERY_BUILDER . 
				" WHERE query_string = 'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address'");
			
				if(empty($qc2b->fields['total'])) {
					$db->Execute("INSERT INTO " . TABLE_QUERY_BUILDER ." 
									(query_category, query_name, query_description, query_string, query_keys_list)
									VALUES ('email,newsletters', 'Newsletter-only Subscribers',
									'Returns email address of all confirmed Newsletter-Only subscribers.',
									'SELECT email_address as customers_email_address FROM TABLE_SUBSCRIBERS WHERE email_format != ''NONE'' and confirmed = 1 and (customers_id IS NULL or customers_id = 0) order by email_address', '')");
				}

			
			} elseif(NEWSONLY_SUBSCRIPTION_VERSION == '205'){
			
			}
			
			$db->Execute("UPDATE " . TABLE_CONFIGURATION ." 
									 SET configuration_value = '205', 
											 configuration_description = 'Newsletter Subscribe Version',
											 last_modified = NOW() 
									 WHERE configuration_key = 'NEWSONLY_SUBSCRIPTION_VERSION'");
			
		}
		
		
		
	}

function remove_newsonly_subscriptions() {
	global $db;
	$db->Execute("DELETE FROM " . TABLE_CONFIGURATION ." WHERE configuration_key LIKE 'NEWSONLY_SUBSCRIPTION%'");
	$db->Execute("DELETE FROM " . TABLE_CONFIGURATION_LANGUAGE ." WHERE configuration_key LIKE 'NEWSONLY_SUBSCRIPTION%'");
	$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES ." WHERE page_key LIKE 'CustomerNewsletterSubscribe%'");
	$db->Execute("DELETE FROM " . TABLE_QUERY_BUILDER . 
	" WHERE query_string = 'select c.customers_firstname, c.customers_lastname, s.email_address as customers_email_address from TABLE_SUBSCRIBERS as s left join TABLE_CUSTOMERS as c on c.customers_id = s.customers_id '");

	$db->Execute("DELETE FROM " . TABLE_QUERY_BUILDER . 
	" WHERE query_string = 'SELECT s.email_address as customers_email_address FROM TABLE_SUBSCRIBERS as s LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( s.email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' '");

	$db->Execute("DELETE FROM " . TABLE_QUERY_BUILDER . 
	" WHERE query_string = 'SELECT c.customers_email_address as customers_email_address FROM TABLE_CUSTOMERS as c LEFT JOIN TABLE_CONFIGURATION as q on LOCATE( c.customers_email_address, q.configuration_value) >= 1 WHERE configuration_key = ''NEWSONLY_SUBSCRIPTION_TEST_GROUP'' '");

	$db->Execute("UPDATE " . TABLE_QUERY_BUILDER ." SET 
						query_name='Newsletter Subscribers', 
						query_description='Returns name and email address of newsletter subscribers who have a customer account.'
						WHERE query_string='select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'';");

	$db->Execute("DROP TABLE IF EXISTS " . TABLE_SUBSCRIBERS );
}



?>
