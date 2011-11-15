#
# * This SQL script upgrades the core Zen Cart database structure from v1.3.8 to v1.3.9
# *
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2011 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_upgrade_zencart_138_to_139.sql 655 2010-09-26 11:29:06Z webchills $
#

############ IMPORTANT INSTRUCTIONS ###############
#
# * Zen Cart uses the zc_install/index.php program to do database upgrades
# * This SQL script is intended to be used by running zc_install
# * It is *not* recommended to simply run these statements manually via any other means
# * ie: not via phpMyAdmin or via the Install SQL Patch tool in Zen Cart admin
# * The zc_install program catches possible problems and also handles table-prefixes automatically
# *
# * To use the zc_install program to do your database upgrade:
# * a. Upload the NEWEST zc_install folder to your server
# * b. Surf to zc_install/index.php via your browser
# * c. On the System Inspection page, scroll to the bottom and click on Database Upgrade
# *    NOTE: do NOT click on the "Install" button, because that will erase your database.
# * d. On the Database Upgrade screen, you'll be presented with a list of checkboxes for
# *    various Zen Cart versions, with the recommended upgrades already pre-selected.
# * e. Verify the checkboxes, then scroll down and enter your Zen Cart Admin username
# *    and password, and then click on the Upgrade button.
# * f. If any errors occur, you will be notified.  Some warnings can be ignored.
# * g. When done, you'll be taken to the Finished page.
#
#####################################################

# Set store to Down-For-Maintenance mode.  Must reset manually via admin after upgrade is done.
UPDATE configuration set configuration_value = 'true' where configuration_key = 'DOWN_FOR_MAINTENANCE';

# add switch for new split-tax functionality
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Split Tax Lines', 'SHOW_SPLIT_TAX_CHECKOUT', 'false', 'If multiple tax rates apply, show each rate as a separate line at checkout', '1', '22', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

#Impressum (new in 1.3.9 german)
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Imprint', 'DEFINE_IMPRESSUM_STATUS', '1', 'Enable the Defined Imprint Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '85', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
#Widerrufsrecht (new in 1.3.9 german)
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Right of Withdrawal', 'DEFINE_WIDERRUFSRECHT_STATUS', '1', 'Enable the Defined Right of Withdrawal Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '86', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');


# Clear out active customer sessions
TRUNCATE TABLE whos_online;
TRUNCATE TABLE db_cache;
TRUNCATE TABLE sessions;

# garbage collection for old paypal sessions:
DELETE FROM paypal_session WHERE expiry < unix_timestamp();

UPDATE banners set banners_url = 'http://www.zen-cart.com/partners/payment' where banners_url = 'http://www.zen-cart.com/index.php?main_page=infopages&pages_id=30';
DELETE from banners where banners_url like'%sashbox%';

#cleanup damaged media-manager content
delete from media_to_products where media_id not in (
SELECT media_id
FROM media_manager);
delete from media_clips where media_id not in (
SELECT media_id
FROM media_manager);

## Country ISO changes:
DELETE FROM countries where countries_iso_code_2 = 'FX' or countries_iso_code_3 = 'FXX';
DELETE FROM countries where countries_iso_code_2 = 'ZR' or countries_iso_code_3 = 'ZAR';
UPDATE countries SET countries_name = 'Serbia', countries_iso_code_2 = 'RS', countries_iso_code_3 = 'SRB' where countries_iso_code_3 = 'YUG';
UPDATE countries SET countries_name = 'Timor-Leste', countries_iso_code_2 = 'TL', countries_iso_code_3 = 'TLS' where countries_iso_code_3 = 'TMP';
UPDATE countries SET countries_name = 'Moldova' where countries_iso_code_3 = 'MDA';
UPDATE countries SET countries_name = 'Macao' where countries_iso_code_3 = 'MAC';
UPDATE countries SET countries_iso_code_3 = 'ROU' where countries_iso_code_3 = 'ROM';

# security data cleanup
update orders set cc_cvv = '' where cc_cvv != '' and orders_status != 1;

# force USPS module into production mode if not already
UPDATE configuration SET configuration_value = 'production' where configuration_key = 'MODULE_SHIPPING_USPS_SERVER';

ALTER TABLE authorizenet CHANGE transaction_id transaction_id bigint default NULL;
ALTER TABLE paypal CHANGE COLUMN notify_version notify_version varchar(6) NOT NULL default '';


#ALTER TABLE counter_history  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE counter_history CHANGE startdate startdate CHAR( 8 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

# fix counter_history race condition
#NEXT_X_ROWS_AS_ONE_COMMAND:5
CREATE TABLE counter_history_clean as 
SELECT * FROM counter_history WHERE 1 GROUP BY startdate;
DROP TABLE counter_history;
RENAME TABLE counter_history_clean 
TO counter_history;

ALTER TABLE counter_history ADD PRIMARY KEY(startdate);

ALTER TABLE orders_products ADD INDEX idx_prod_id_orders_id_zen (products_id,orders_id);
ALTER TABLE orders ADD INDEX idx_cust_id_orders_id_zen (customers_id,orders_id);

#Clean up rogue content
DELETE from record_company_info where record_company_id in (
SELECT record_company_id 
FROM record_company where record_company_image like '%.php');
DELETE FROM record_company where record_company_image like '%.php';


REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(575, 'Bank Account IBAN', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '---', 'International account id.<br>(ask your bank if you don''t know it)', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(572, 'Bank Account Name', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', '---', 'The name associated with the account.', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(573, 'Bank Account No.', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', '---', 'Your account number.', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(576, 'Bank BIC/SWIFT', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', '---', 'International bank id.<br>(ask your bank if you don''t know it)', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(571, 'Bank Name', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', '---', 'Your full bank name', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(574, 'Bank Code', 'MODULE_PAYMENT_EUTRANSFER_BLZ', '---', 'Your Bank Code', 6, 1, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(579, 'Set Order Status', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2010-09-26 12:29:20', 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(577, 'Module Sort order of display.', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2010-09-26 12:29:20', NULL, NULL);
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(570, 'Allow Bank Transfer Payment', 'MODULE_PAYMENT_EUTRANSFER_STATUS', 'True', 'Do you want to accept bank transfer order payments?', 6, 3, NULL, '2010-09-26 12:29:20', NULL, 'zen_cfg_select_option(array(''True'', ''False''), ');
REPLACE INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(578, 'Payment Zone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2010-09-26 12:29:20', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');

 
#############

#### VERSION UPDATE STATEMENTS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version's info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='3.9f', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.3.8->1.3.9f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='3.9f', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.3.8->1.3.9f', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';

#####  END OF UPGRADE SCRIPT
