<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei sofort wieder vom Server !!!!!
* @copyright Copyright 2003-2023 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* Zen Cart German Version - www.zen-cart-pro.at
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_157g_update.php 2023-11-18 08:03:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {
	
	
// -----
// new tables customer_groups and customer_to_groups
//	

$db->Execute("DROP TABLE IF EXISTS customer_groups;");
$db->Execute("CREATE TABLE customer_groups (
  group_id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_name varchar(191) NOT NULL,
  group_comment varchar(255),
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (group_id),
  UNIQUE KEY idx_groupname_zen (group_name)
);");
$db->Execute("DROP TABLE IF EXISTS customers_to_groups;");
$db->Execute("CREATE TABLE customers_to_groups (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_id int UNSIGNED NOT NULL,
  customer_id int UNSIGNED NOT NULL,
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY idx_custid_groupid_zen (customer_id, group_id),
  KEY idx_groupid_custid_zen (group_id, customer_id)
);");

$db->Execute("INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order)
VALUES ('customerGroups', 'BOX_CUSTOMERS_CUSTOMER_GROUPS', 'FILENAME_CUSTOMER_GROUPS', '', 'customers', 'Y', 3);");
$messageStack->add('Neue Kundengruppen Tabellen erfolgreich angelegt', 'success');

// -----
// new tables for plugin managers
//

$db->Execute("DROP TABLE IF EXISTS plugin_control;");
$db->Execute("CREATE TABLE plugin_control (
  unique_key varchar(40) NOT NULL,
  name varchar(64) NOT NULL default '',
  description text,
  type varchar(11) NOT NULL default 'free',
  managed tinyint(1) NOT NULL default 0,
  status tinyint(1) NOT NULL default 0,
  author varchar(64) NOT NULL,
  version varchar(10),
  zc_versions text NOT NULL,
  zc_contrib_id int(11),
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;");



$db->Execute("DROP TABLE IF EXISTS plugin_control_versions;");
$db->Execute("CREATE TABLE plugin_control_versions (
  unique_key varchar(40) NOT NULL,
  version varchar(10),
  author varchar(64) NOT NULL,
  zc_versions text NOT NULL,
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key, version)
) ENGINE=MyISAM;");



$db->Execute("DROP TABLE IF EXISTS plugin_groups;");
$db->Execute("CREATE TABLE plugin_groups (
  unique_key varchar(20) NOT NULL,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;");



$db->Execute("DROP TABLE IF EXISTS plugin_groups_description;");
$db->Execute("CREATE TABLE plugin_groups_description (
  plugin_group_unique_key varchar(20) NOT NULL,
  language_id int(11) NOT NULL default 1,
  name varchar(64) NOT NULL default '',
  PRIMARY KEY  (plugin_group_unique_key,language_id)
) ENGINE=MyISAM;");

$db->Execute("INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES  ('plugins', 'BOX_MODULES_PLUGINS', 'FILENAME_PLUGIN_MANAGER', '', 'modules', 'Y', 4);");

$messageStack->add('Neue Plugin Manager Tabellen erfolgreich angelegt', 'success');

// -----
// Tell a Friend Relikte entfernen
//

$db->Execute("DELETE FROM configuration WHERE configuration_key = 'ALLOW_GUEST_TO_TELL_A_FRIEND';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS';");
$db->Execute("DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND';");
$db->Execute("DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND';");
$db->Execute("DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND';");
$db->Execute("DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_TELL_A_FRIEND';");
$db->Execute("DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND';");

// -----
// Remove deprecated defines
//

$db->Execute("DELETE FROM configuration WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'EMAIL_LINEFEED';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_LINEFEED';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'CC_CVV_MIN_LENGTH';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'CC_CVV_MIN_LENGTH';");
$db->Execute("DELETE FROM configuration WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';");
$db->Execute("DELETE FROM configuration_language WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';");

$messageStack->add('Veraltete Kunfigurationsoptionen erfolgreich entfernt', 'success');


// -----
// Bestehende Tabellen modifizieren
//

$db->Execute("ALTER TABLE layout_boxes ADD plugin_details varchar(100) NOT NULL default '';");
$db->Execute("ALTER TABLE customers ADD registration_ip varchar(45) NOT NULL default '';");
$db->Execute("ALTER TABLE customers ADD last_login_ip varchar(45) NOT NULL default '';");
$db->Execute("ALTER TABLE customers_info ADD INDEX idx_date_created_cust_id_zen (customers_info_date_account_created, customers_info_id);");
$db->Execute("ALTER TABLE orders_products MODIFY products_name varchar(191) NOT NULL default '';");
$db->Execute("ALTER TABLE products_description MODIFY products_name varchar(191) NOT NULL default '';");
$db->Execute("ALTER TABLE orders MODIFY customers_country varchar(64) NOT NULL default '';");
$db->Execute("ALTER TABLE orders MODIFY delivery_country varchar(64) NOT NULL default '';");
$db->Execute("ALTER TABLE orders MODIFY billing_country varchar(64) NOT NULL default '';");
$db->Execute("ALTER TABLE orders ADD shipping_tax_rate decimal(15,4) DEFAULT NULL AFTER order_tax; ");
$db->Execute("ALTER TABLE products_options ADD products_options_comment_position smallint(2) NOT NULL default '0' AFTER products_options_comment;");
$db->Execute("ALTER TABLE coupon_email_track MODIFY emailed_to varchar(96) default NULL;");

$messageStack->add('Bestehende Tabellen erfolgreich modifiziert', 'success');


// -----
// Logfileanzeige aktualisieren
//

$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Admin)?', 'REPORT_ALL_ERRORS_ADMIN', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', 10, 40, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');");
$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Store)?', 'REPORT_ALL_ERRORS_STORE', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', 10, 41, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');");
$db->Execute("INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors: Backtrace on Notice Errors?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 'No', 'Include backtrace information on &quot;Notice&quot; errors?  These are usually isolated to the identified file and the backtrace information just fills the logs. Default (<b>No</b>).', 10, 42, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\'),');");
$db->Execute("UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_ADMIN';");
$db->Execute("UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_STORE';");
$db->Execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES
('Log Manager: Days to Keep', 'LOG_MANAGER_KEEP_DAYS', '0', 'Enter the maximum number of <em>days</em> to keep any file with a <code>.log</code> file extension in your store\'s <b>logs</b> directory.<br><br>If the value you enter is non-zero, then any files created prior to that relative date will be <b>permanently removed</b> from your store\'s file-system.<br>', 10, 43, now(), NULL, NULL),
('Log Manager: Logs to Keep', 'LOG_MANAGER_KEEP_THESE', 'zcInstall', 'Enter a comma-separated list of name-prefixes for any log-files that you want to <b><i>keep</i></b>, regardless of their age.<br><br>The values you enter are <em>case-sensitive</em>, i.e. <em>zcInstall</em> is different than <em>zcinstall</em>.  The default setting (<code>zcInstall</code>) results in any file matching <code>/logs/zcInstall*.log</code> being kept regardless of its creation date.<br>', 10, 44, now(), NULL, NULL)");
$db->Execute("REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES      
('Logfiles Manager: Behaltedauer in Tagen', 'LOG_MANAGER_KEEP_DAYS', 43, 'Geben Sie die maximale Anzahl von <em>Tagen</em> ein, die eine Datei mit der Endung <code>.log</code> im Verzeichnis <b>logs</b> Ihres Servers aufbewahrt werden soll.<br><br>Bei 0 findet keinerlei automatische Löschung statt.<br>Wenn der von Ihnen eingegebene Wert ungleich Null ist, werden alle Dateien, die vor diesem relativen Datum erstellt wurden, <b>permanent</b> aus dem Dateisystem Ihres Servers entfernt.<br>', now(), now()),
('Logfiles Manager: Welche Logs behalten?', 'LOG_MANAGER_KEEP_THESE', 43, 'Geben Sie eine durch Komma getrennte Liste von Namenspräfixen für alle Logfiles ein, die Sie <b><i>beibehalten</i></b> möchten, unabhängig von ihrem Alter.<br><br>Die eingegebenen Werte sind <em>Groß-Kleinschreibung-sensitiv</em>, d.h. <em>zcInstall</em> ist anders als <em>zcinstall</em>.  Die Standardeinstellung (<code>zcInstall</code>) führt dazu, dass jede Datei, die mit <code>/logs/zcInstall*.log</code> übereinstimmt, unabhängig von ihrem Erstellungsdatum aufbewahrt wird.<br>', now(), now());");

$messageStack->add('Logfile Anzeige Konfiguration erfolgreich aktualisiert', 'success');


// -----
// Adressformate aktualisieren
//

$db->Execute("UPDATE address_format SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;");
$db->Execute("UPDATE countries SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;");
$db->Execute("UPDATE orders SET customers_address_format_id = customers_address_format_id + 13 WHERE customers_address_format_id  > 7;");
$db->Execute("UPDATE orders SET  delivery_address_format_id = delivery_address_format_id + 13 WHERE delivery_address_format_id > 7;");
$db->Execute("UPDATE orders SET  billing_address_format_id = billing_address_format_id + 13 WHERE billing_address_format_id > 7;");

$db->Execute("UPDATE address_format SET address_summary = 'Default $city $country' WHERE address_format_id = 1;");
$db->Execute("UPDATE address_format SET address_summary = '$city, $state $postcode' WHERE address_format_id = 2;");
$db->Execute("UPDATE address_format SET address_summary = 'Historic $city / $postcode - $statecomma$country' WHERE address_format_id = 3;");
$db->Execute("UPDATE address_format SET address_summary = 'Historic $city ($postcode)' WHERE address_format_id = 4;");
$db->Execute("UPDATE address_format SET address_summary = '$postcode $city' WHERE address_format_id = 5;");
$db->Execute("UPDATE address_format SET address_summary = '$city / $state / $postcode' WHERE address_format_id = 6 ;");
$db->Execute("UPDATE address_format SET address_summary = '$city $state $postcode' WHERE address_format_id = 7;");

$db->Execute("INSERT INTO address_format VALUES (8,'$firstname $lastname$cr$streets$cr$city$cr$country','$city');");
$db->Execute("INSERT INTO address_format VALUES (9,'$firstname $lastname$cr$streets$cr$postcode $city $state$cr$country','$postcode $city $state');");
$db->Execute("INSERT INTO address_format VALUES (10,'$firstname $lastname$cr$streets$cr$city $postcode$cr$country','$city $postcode');");
$db->Execute("INSERT INTO address_format VALUES (11,'$firstname $lastname$cr$streets$cr$city $state$cr$postcode$cr$country','$city $state / $postcode');");
$db->Execute("INSERT INTO address_format VALUES (12,'$firstname $lastname$cr$streets$cr$postcode$cr$city $state$cr$country','$postcode / $city / $state');");
$db->Execute("INSERT INTO address_format VALUES (13,'$firstname $lastname$cr$streets$cr$city $postcode$cr$state$cr$country','$city $postcode / $state');");
$db->Execute("INSERT INTO address_format VALUES (14,'$firstname $lastname$cr$streets$cr$postcode $city$cr$state$cr$country','$postcode $city / $state');");
$db->Execute("INSERT INTO address_format VALUES (15,'$firstname $lastname$cr$streets$cr$postcode$cr$city$cr$state$cr$country','$postcode / $city / $state');");
$db->Execute("INSERT INTO address_format VALUES (16,'$firstname $lastname$cr$streets$cr$city $postcode $state$cr$country',' $city $postcode $state');");
$db->Execute("INSERT INTO address_format VALUES (17,'$firstname $lastname$cr$streets$cr$city$cr$postcode $state$cr$country',' $city / $postcode $state');");
$db->Execute("INSERT INTO address_format VALUES (18,'$firstname $lastname$cr$streets$cr$city$cr$state $postcode$cr$country','$city / $state $postcode');");
$db->Execute("INSERT INTO address_format VALUES (19,'$firstname $lastname$cr$city$cr$streets$cr$postcode$cr$country','$city $street / $postcode');");
$db->Execute("INSERT INTO address_format VALUES (20,'$firstname $lastname$cr$streets$cr$postcode $city ($state)$cr$country','$postcode $city ($state)');");

$db->Execute("UPDATE countries SET address_format_id = '2' WHERE countries_iso_code_2 IN ('LV', 'MM', 'KN', 'SO', 'TT') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '5' WHERE countries_iso_code_2 IN ('AX', 'AL', 'DZ', 'AD', 'AR', 'AM', 'AZ', 'BA', 'BG', 'CV', 'CL', 'HR', 'CY', 'CZ', 'DK', 'DO', 'GQ', 'EE', 'ET', 'FO', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GE', 'GR', 'GL', 'GP', 'GN', 'GW', 'HT', 'IS', 'IL', 'JM', 'KW', 'LA', 'LI', 'LT', 'LU', 'MK', 'MG', 'MQ', 'YT', 'MD', 'MC', 'MA', 'NC', 'NE', 'NO', 'PY', 'PL', 'PT', 'RE', 'RO', 'SM', 'SN', 'SK', 'SI', 'PM', 'SJ', 'CH', 'SY', 'TJ', 'TM', 'UY', 'WF', 'PS', 'ME', 'SS') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '6' WHERE countries_iso_code_2 IN ('AF', 'IO', 'EG', 'FK', 'GI', 'IN', 'IR', 'IE', 'KZ', 'KE', 'KI', 'MT', 'MS', 'PN', 'RU', 'SC', 'SB', 'ZA', 'GS', 'LK', 'SH', 'SZ', 'TG', 'TC', 'TV', 'UA', 'AE', 'UZ', 'RS', 'ZW', 'GG', 'IM', 'JE') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN ('AS', 'KH', 'KY', 'CN', 'CX', 'CC', 'CO', 'GU', 'GY', 'HM', 'JP', 'KR', 'MH', 'FM', 'NF', 'MP', 'PK', 'PW', 'PR', 'UM', 'VI', 'CW', 'SX') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN  ('US', 'CA') AND address_format_id = '2';");
$db->Execute("UPDATE countries SET address_format_id = '8' WHERE countries_iso_code_2 IN ('AO', 'AG', 'AW', 'BB', 'BJ', 'BO', 'BW', 'BV', 'BI', 'CM', 'CF', 'TD', 'KM', 'CG', 'CI', 'DJ', 'DM', 'ER', 'FJ', 'GM', 'GD', 'HK', 'LY', 'MO', 'MW', 'ML', 'MR', 'MU', 'NA', 'QA', 'RW', 'LC', 'WS', 'ST', 'SL', 'SR', 'TO', 'UG', 'VU', 'EH', 'YE')  AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 IN ('CU', 'HN', 'LR', 'MX', 'TN', 'TR', 'VA') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 = 'IT' AND address_format_id = '5';");
$db->Execute("UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 IN ('AI', 'AQ', 'BS', 'BH', 'BD', 'BZ', 'BM', 'BT', 'BF', 'CK', 'TL', 'ID', 'JO', 'KP', 'LB', 'LS', 'MV', 'MN', 'NR', 'NP', 'BQ', 'NZ', 'NU', 'VC', 'SA', 'TW', 'TK', 'VG', 'ZM') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 = 'SG' AND address_format_id = '4';");
$db->Execute("UPDATE countries SET address_format_id = '11' WHERE countries_iso_code_2 IN ('BR', 'CR', 'GH', 'IQ', 'TH') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '12' WHERE countries_iso_code_2 IN ('EC', 'NI', 'PE', 'SD') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '13' WHERE countries_iso_code_2 = 'NG' AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '14' WHERE countries_iso_code_2 IN ('BY', 'GT', 'KG', 'MY', 'MZ', 'PA', 'SV', 'TZ') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '15' WHERE countries_iso_code_2 = 'OM' AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '16' WHERE countries_iso_code_2 IN ('PG', 'VE') AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '17' WHERE countries_iso_code_2 = 'PH' AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '18' WHERE countries_iso_code_2 IN ('VN', 'BN')  AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '19' WHERE countries_iso_code_2 = 'HU' AND address_format_id = '1';");
$db->Execute("UPDATE countries SET address_format_id = '20' WHERE countries_iso_code_2 = 'ES' AND address_format_id = '3';");

$messageStack->add('Adressformate erfolgreich aktualisiert', 'success');


// -----
// Image Handler auf 5.3.4, Display Logs auf 3.0.2, Cross Sell auf 2.0.2 aktualisieren
// 

$db->Execute("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'IH_VERSION';");
$db->Execute("INSERT INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '5.3.1', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');");
$db->Execute("UPDATE configuration SET configuration_value = '3.0.2' WHERE configuration_key = 'DISPLAY_LOGS_VERSION';");
$db->Execute("UPDATE configuration SET configuration_value = '2.0.2' WHERE configuration_key = 'XSELL_VERSION';");
$messageStack->add('Image Handler / Display Logs / Cross Sell erfolgreich aktualisiert', 'success');

// -----
// German Translations Date
// 
//
$db->Execute("REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES 
('20231118', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Uebersetzungen', now(), now());");

// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7g', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7g', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7g', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.7g deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.157g_update.php<br/>DEINADMIN/includes/init_includes/init_157g_update.php', 'success'); 
}