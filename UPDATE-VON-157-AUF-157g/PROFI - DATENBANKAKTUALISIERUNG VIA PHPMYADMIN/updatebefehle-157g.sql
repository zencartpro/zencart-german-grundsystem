## Remove remnants of tell a friend
DELETE FROM configuration WHERE configuration_key = 'ALLOW_GUEST_TO_TELL_A_FRIEND';
DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO';
DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND';

#############
### 1.5.7g bring address formats up to date

### Move any none core address formats created by users
UPDATE address_format SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;
UPDATE countries SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;
UPDATE orders SET customers_address_format_id = customers_address_format_id + 13 WHERE customers_address_format_id  > 7;
UPDATE orders SET  delivery_address_format_id = delivery_address_format_id + 13 WHERE delivery_address_format_id > 7;
UPDATE orders SET  billing_address_format_id = billing_address_format_id + 13 WHERE billing_address_format_id > 7;

### Updated address summary for original address format address_summary
UPDATE address_format SET address_summary = 'Default $city $country' WHERE address_format_id = 1;
UPDATE address_format SET address_summary = '$city, $state $postcode' WHERE address_format_id = 2;
UPDATE address_format SET address_summary = 'Historic $city / $postcode - $statecomma$country' WHERE address_format_id = 3;
UPDATE address_format SET address_summary = 'Historic $city ($postcode)' WHERE address_format_id = 4;
UPDATE address_format SET address_summary = '$postcode $city' WHERE address_format_id = 5;
UPDATE address_format SET address_summary = '$city / $state / $postcode' WHERE address_format_id = 6 ;
UPDATE address_format SET address_summary = '$city $state $postcode' WHERE address_format_id = 7;

### Add new address formats
INSERT INTO address_format VALUES (8,'$firstname $lastname$cr$streets$cr$city$cr$country','$city');
INSERT INTO address_format VALUES (9,'$firstname $lastname$cr$streets$cr$postcode $city $state$cr$country','$postcode $city $state');
INSERT INTO address_format VALUES (10,'$firstname $lastname$cr$streets$cr$city $postcode$cr$country','$city $postcode');
INSERT INTO address_format VALUES (11,'$firstname $lastname$cr$streets$cr$city $state$cr$postcode$cr$country','$city $state / $postcode');
INSERT INTO address_format VALUES (12,'$firstname $lastname$cr$streets$cr$postcode$cr$city $state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (13,'$firstname $lastname$cr$streets$cr$city $postcode$cr$state$cr$country','$city $postcode / $state');
INSERT INTO address_format VALUES (14,'$firstname $lastname$cr$streets$cr$postcode $city$cr$state$cr$country','$postcode $city / $state');
INSERT INTO address_format VALUES (15,'$firstname $lastname$cr$streets$cr$postcode$cr$city$cr$state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (16,'$firstname $lastname$cr$streets$cr$city $postcode $state$cr$country',' $city $postcode $state');
INSERT INTO address_format VALUES (17,'$firstname $lastname$cr$streets$cr$city$cr$postcode $state$cr$country',' $city / $postcode $state');
INSERT INTO address_format VALUES (18,'$firstname $lastname$cr$streets$cr$city$cr$state $postcode$cr$country','$city / $state $postcode');
INSERT INTO address_format VALUES (19,'$firstname $lastname$cr$city$cr$streets$cr$postcode$cr$country','$city $street / $postcode');
INSERT INTO address_format VALUES (20,'$firstname $lastname$cr$streets$cr$postcode $city ($state)$cr$country','$postcode $city ($state)');


### Update countries with new address_format_id use countries_iso_code_2 to match and only change if still set to original address_format_id.
UPDATE countries SET address_format_id = '2' WHERE countries_iso_code_2 IN ('LV', 'MM', 'KN', 'SO', 'TT') AND address_format_id = '1';
UPDATE countries SET address_format_id = '5' WHERE countries_iso_code_2 IN ('AX', 'AL', 'DZ', 'AD', 'AR', 'AM', 'AZ', 'BA', 'BG', 'CV', 'CL', 'HR', 'CY', 'CZ', 'DK', 'DO', 'GQ', 'EE', 'ET', 'FO', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GE', 'GR', 'GL', 'GP', 'GN', 'GW', 'HT', 'IS', 'IL', 'JM', 'KW', 'LA', 'LI', 'LT', 'LU', 'MK', 'MG', 'MQ', 'YT', 'MD', 'MC', 'MA', 'NC', 'NE', 'NO', 'PY', 'PL', 'PT', 'RE', 'RO', 'SM', 'SN', 'SK', 'SI', 'PM', 'SJ', 'CH', 'SY', 'TJ', 'TM', 'UY', 'WF', 'PS', 'ME', 'SS') AND address_format_id = '1';
UPDATE countries SET address_format_id = '6' WHERE countries_iso_code_2 IN ('AF', 'IO', 'EG', 'FK', 'GI', 'IN', 'IR', 'IE', 'KZ', 'KE', 'KI', 'MT', 'MS', 'PN', 'RU', 'SC', 'SB', 'ZA', 'GS', 'LK', 'SH', 'SZ', 'TG', 'TC', 'TV', 'UA', 'AE', 'UZ', 'RS', 'ZW', 'GG', 'IM', 'JE') AND address_format_id = '1';
UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN ('AS', 'KH', 'KY', 'CN', 'CX', 'CC', 'CO', 'GU', 'GY', 'HM', 'JP', 'KR', 'MH', 'FM', 'NF', 'MP', 'PK', 'PW', 'PR', 'UM', 'VI', 'CW', 'SX') AND address_format_id = '1';
UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN  ('US', 'CA') AND address_format_id = '2';
UPDATE countries SET address_format_id = '8' WHERE countries_iso_code_2 IN ('AO', 'AG', 'AW', 'BB', 'BJ', 'BO', 'BW', 'BV', 'BI', 'CM', 'CF', 'TD', 'KM', 'CG', 'CI', 'DJ', 'DM', 'ER', 'FJ', 'GM', 'GD', 'HK', 'LY', 'MO', 'MW', 'ML', 'MR', 'MU', 'NA', 'QA', 'RW', 'LC', 'WS', 'ST', 'SL', 'SR', 'TO', 'UG', 'VU', 'EH', 'YE')  AND address_format_id = '1';
UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 IN ('CU', 'HN', 'LR', 'MX', 'TN', 'TR', 'VA') AND address_format_id = '1';
UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 = 'IT' AND address_format_id = '5';
UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 IN ('AI', 'AQ', 'BS', 'BH', 'BD', 'BZ', 'BM', 'BT', 'BF', 'CK', 'TL', 'ID', 'JO', 'KP', 'LB', 'LS', 'MV', 'MN', 'NR', 'NP', 'BQ', 'NZ', 'NU', 'VC', 'SA', 'TW', 'TK', 'VG', 'ZM') AND address_format_id = '1';
UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 = 'SG' AND address_format_id = '4';
UPDATE countries SET address_format_id = '11' WHERE countries_iso_code_2 IN ('BR', 'CR', 'GH', 'IQ', 'TH') AND address_format_id = '1';
UPDATE countries SET address_format_id = '12' WHERE countries_iso_code_2 IN ('EC', 'NI', 'PE', 'SD') AND address_format_id = '1';
UPDATE countries SET address_format_id = '13' WHERE countries_iso_code_2 = 'NG' AND address_format_id = '1';
UPDATE countries SET address_format_id = '14' WHERE countries_iso_code_2 IN ('BY', 'GT', 'KG', 'MY', 'MZ', 'PA', 'SV', 'TZ') AND address_format_id = '1';
UPDATE countries SET address_format_id = '15' WHERE countries_iso_code_2 = 'OM' AND address_format_id = '1';
UPDATE countries SET address_format_id = '16' WHERE countries_iso_code_2 IN ('PG', 'VE') AND address_format_id = '1';
UPDATE countries SET address_format_id = '17' WHERE countries_iso_code_2 = 'PH' AND address_format_id = '1';
UPDATE countries SET address_format_id = '18' WHERE countries_iso_code_2 IN ('VN', 'BN')  AND address_format_id = '1';
UPDATE countries SET address_format_id = '19' WHERE countries_iso_code_2 = 'HU' AND address_format_id = '1';
UPDATE countries SET address_format_id = '20' WHERE countries_iso_code_2 = 'ES' AND address_format_id = '3';
################

#val_function update for email addresses
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE_SINGLE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}' WHERE configuration_key = 'EMAIL_FROM';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE_SINGLE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}' WHERE configuration_key = 'STORE_OWNER_EMAIL_ADDRESS';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_ORDER_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_GV_CUSTOMER_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_GV_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_LOW_STOCK_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='CONTACT_US_LIST';

# modify existing tables for 1.5.7g
ALTER TABLE layout_boxes ADD plugin_details varchar(100) NOT NULL default '';
ALTER TABLE customers ADD registration_ip varchar(45) NOT NULL default '';
ALTER TABLE customers ADD last_login_ip varchar(45) NOT NULL default '';
ALTER TABLE customers_info ADD INDEX idx_date_created_cust_id_zen (customers_info_date_account_created, customers_info_id);

ALTER TABLE orders_products MODIFY products_name varchar(191) NOT NULL default '';
ALTER TABLE products_description MODIFY products_name varchar(191) NOT NULL default '';

ALTER TABLE orders MODIFY customers_country varchar(64) NOT NULL default '';
ALTER TABLE orders MODIFY delivery_country varchar(64) NOT NULL default '';
ALTER TABLE orders MODIFY billing_country varchar(64) NOT NULL default '';
ALTER TABLE orders ADD shipping_tax_rate decimal(15,4) DEFAULT NULL AFTER order_tax; 

ALTER TABLE products_options ADD products_options_comment_position smallint(2) NOT NULL default '0' AFTER products_options_comment;

ALTER TABLE coupon_email_track MODIFY emailed_to varchar(96) default NULL;

# Remove deprecated defines
DELETE FROM configuration WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';
DELETE FROM configuration_language WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';
DELETE FROM configuration WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';
DELETE FROM configuration_language WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';
DELETE FROM configuration WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';
DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';
DELETE FROM configuration WHERE configuration_key = 'EMAIL_LINEFEED';
DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_LINEFEED';
DELETE FROM configuration WHERE configuration_key = 'CC_CVV_MIN_LENGTH';
DELETE FROM configuration_language WHERE configuration_key = 'CC_CVV_MIN_LENGTH';
DELETE FROM configuration WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';
DELETE FROM configuration_language WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';

#### Added in case was missed on upgrades.  also modified to allow for IgnoreDups in case someone had earlier version installed.
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Admin)?', 'REPORT_ALL_ERRORS_ADMIN', 'No', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', 10, 40, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Store)?', 'REPORT_ALL_ERRORS_STORE', 'No', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', 10, 41, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors: Backtrace on Notice Errors?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 'No', 'Include backtrace information on &quot;Notice&quot; errors?  These are usually isolated to the identified file and the backtrace information just fills the logs. Default (<b>No</b>).', 10, 42, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\'),');
UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_ADMIN';
UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_STORE';

### New since 1.5.7g - Log Manager
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Manager: Days to Keep', 'LOG_MANAGER_KEEP_DAYS', '0', 'Enter the maximum number of <em>days</em> to keep any file with a <code>.log</code> file extension in your store\'s <b>logs</b> directory.<br><br>If the value you enter is non-zero, then any files created prior to that relative date will be <b>permanently removed</b> from your store\'s file-system.<br>', 10, 42, now());
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Manager: Logs to Keep', 'LOG_MANAGER_KEEP_THESE', 'zcInstall', 'Enter a comma-separated list of name-prefixes for any log-files that you want to <b><i>keep</i></b>, regardless of their age.<br><br>The values you enter are <em>case-sensitive</em>, i.e. <em>zcInstall</em> is different than <em>zcinstall</em>.  The default setting (<code>zcInstall</code>) results in any file matching <code>/logs/zcInstall*.log</code> being kept regardless of its creation date.<br>', 10, 43, now());
REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Logfiles anzeigen: Version', 'DISPLAY_LOGS_VERSION', 43, 'Version der Logfile Anzeige im Admin', now(), now()),
('Logfiles anzeigen: Maximale Anzahl', 'DISPLAY_LOGS_MAX_DISPLAY', 43, 'Wieviele Logfiles sollen maximal auf einer Seite angezeigt werden. (Voreinstellung: <b>20</b>)', now(), now()),
('Logfiles anzeigen: Maximale Dateigröße', 'DISPLAY_LOGS_MAX_FILE_SIZE', 43, 'Stellen Sie hier die maximale Dateigröße für die anzuzeigenden Logfiles ein.  (Voreinstellung: <b>80000</b>)', now(), now()),
('Logfiles anzeigen: Enthaltene Logfiletypen', 'DISPLAY_LOGS_INCLUDED_FILES', 43, 'Tragen Sie hier die <em>Präfixe</em> der Logfiles ein, die in der Anzeige berücksichtigt werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Ausgeschlossene Logfiletypen', 'DISPLAY_LOGS_EXCLUDED_FILES', 43, 'Tragen Sie hier die Präfixe der Logfiles ein, die von der Anzeige <em>ausgeschlossen</em> werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Hinweis im Header der Administration', 'DISPLAY_LOGS_SHOW_IN_HEADER', 43, 'Wenn Errorlogs vorhanden sind, wird im Header der Shopadministration ein entsprechender Hinweis angezeigt, um Sie darauf aufmerksam zu machen.<br>Wenn Sie diesen Hinweis nicht haben wollen, können Sie ihn hier deaktivieren<br>Hinweis anzeigen = true<br>Hinweis nicht anzeigen = false.', now(), now()),
('Logfiles Level: Adminbereich', 'REPORT_ALL_ERRORS_ADMIN', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Adminbereich auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu einigen Logfiles mit völlig harmlosen Warnings führen.', now(), now()),
('Logfiles Level: Frontend', 'REPORT_ALL_ERRORS_STORE', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Frontend auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu extrem vielen Logfiles mit völlig harmlosen Warnings führen und die Performance des Frontends negativ beeinflussen.', now(), now()),
('Logfiles Level: Backtrace auch bei Notices?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 43, 'Wollen Sie Backtrace-Informationen zu &quot;Notice&quot; Fehlern einbeziehen?<br>Diese sind in der Regel auf die identifizierte Datei beschränkt und die Backtrace-Informationen füllen nur die Logs. Voreinstellung (<b>Nein</b>).<br>Nur zu detaillierten Fehleranalyse sinnvoll.', now(), now()),
('Logfiles Manager: Behaltedauer in Tagen', 'LOG_MANAGER_KEEP_DAYS', 43, 'Geben Sie die maximale Anzahl von <em>Tagen</em> ein, die eine Datei mit der Endung <code>.log</code> im Verzeichnis <b>logs</b> Ihres Servers aufbewahrt werden soll.<br><br>Bei 0 findet keinerlei automatische Löschung statt.<br>Wenn der von Ihnen eingegebene Wert ungleich Null ist, werden alle Dateien, die vor diesem relativen Datum erstellt wurden, <b>permanent</b> aus dem Dateisystem Ihres Servers entfernt.<br>', now(), now()),
('Logfiles Manager: Welche Logs behalten?', 'LOG_MANAGER_KEEP_THESE', 43, 'Geben Sie eine durch Komma getrennte Liste von Namenspräfixen für alle Logfiles ein, die Sie <b><i>beibehalten</i></b> möchten, unabhängig von ihrem Alter.<br><br>Die eingegebenen Werte sind <em>Groß-Kleinschreibung-sensitiv</em>, d.h. <em>zcInstall</em> ist anders als <em>zcinstall</em>.  Die Standardeinstellung (<code>zcInstall</code>) führt dazu, dass jede Datei, die mit <code>/logs/zcInstall*.log</code> übereinstimmt, unabhängig von ihrem Erstellungsdatum aufbewahrt wird.<br>', now(), now());


# New Plugin tables
# New since 157g

# --------------------------------------------------------

#
# Table structure for table 'plugin_control'
#

DROP TABLE IF EXISTS plugin_control;
CREATE TABLE plugin_control (
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
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_control_versions'
#

DROP TABLE IF EXISTS plugin_control_versions;
CREATE TABLE plugin_control_versions (
  unique_key varchar(40) NOT NULL,
  version varchar(10),
  author varchar(64) NOT NULL,
  zc_versions text NOT NULL,
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key, version)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups'
#

DROP TABLE IF EXISTS plugin_groups;
CREATE TABLE plugin_groups (
  unique_key varchar(20) NOT NULL,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups_description'
#

DROP TABLE IF EXISTS plugin_groups_description;
CREATE TABLE plugin_groups_description (
  plugin_group_unique_key varchar(20) NOT NULL,
  language_id int(11) NOT NULL default 1,
  name varchar(64) NOT NULL default '',
  PRIMARY KEY  (plugin_group_unique_key,language_id)
) ENGINE=MyISAM;

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES  ('plugins', 'BOX_MODULES_PLUGINS', 'FILENAME_PLUGIN_MANAGER', '', 'modules', 'Y', 4);

# update Image Handler Version to 5.3.3
UPDATE configuration SET configuration_value = '5.3.4' WHERE configuration_key = 'IH_VERSION';

# update display logs version to 3.0.2
UPDATE configuration SET configuration_value = '3.0.2' WHERE configuration_key = 'DISPLAY_LOGS_VERSION';

# update cross sell version to 2.0.2
UPDATE configuration SET configuration_value = '2.0.2' WHERE configuration_key = 'XSELL_VERSION';


# new tables customer_groups and customer_to_groups since 1.5.7g

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order)
VALUES ('customerGroups', 'BOX_CUSTOMERS_CUSTOMER_GROUPS', 'FILENAME_CUSTOMER_GROUPS', '', 'customers', 'Y', 3);

CREATE TABLE customer_groups (
  group_id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_name varchar(191) NOT NULL,
  group_comment varchar(255),
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (group_id),
  UNIQUE KEY idx_groupname_zen (group_name)
);
CREATE TABLE customers_to_groups (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_id int UNSIGNED NOT NULL,
  customer_id int UNSIGNED NOT NULL,
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY idx_custid_groupid_zen (customer_id, group_id),
  KEY idx_groupid_custid_zen (group_id, customer_id)
);

REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES 
('20231118', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Uebersetzungen', now(), now());


## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='5.7g', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7g', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='5.7', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7g', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';