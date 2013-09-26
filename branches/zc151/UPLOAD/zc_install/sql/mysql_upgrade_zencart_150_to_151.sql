#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.0 to v1.5.1
# *
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2013 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_upgrade_zencart_150_to_151.sql 19334 2013-09-25 13:12:59Z webchills $
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
# * d. On the Database Upgrade screen, you will be presented with a list of checkboxes for
# *    various Zen Cart versions, with the recommended upgrades already pre-selected.
# * e. Verify the checkboxes, then scroll down and enter your Zen Cart Admin username
# *    and password, and then click on the Upgrade button.
# * f. If any errors occur, you will be notified.  Some warnings can be ignored.
# * g. When done, you will be taken to the Finished page.
#
#####################################################

# Set store to Down-For-Maintenance mode.  Must reset manually via admin after upgrade is done.
UPDATE configuration set configuration_value = 'true' where configuration_key = 'DOWN_FOR_MAINTENANCE';

# Clear out active customer sessions
TRUNCATE TABLE whos_online;
TRUNCATE TABLE db_cache;
TRUNCATE TABLE sessions;

#ALTER TABLE admin_activity_log CHANGE COLUMN gzpost gzpost mediumblob ;

ALTER TABLE admin_activity_log CHANGE COLUMN ip_address ip_address varchar(45) NOT NULL default '';
ALTER TABLE whos_online CHANGE COLUMN ip_address ip_address varchar(45) NOT NULL default '';
ALTER TABLE admin CHANGE COLUMN last_login_ip last_login_ip varchar(45) NOT NULL default '';
ALTER TABLE admin CHANGE COLUMN last_failed_ip last_failed_ip varchar(45) NOT NULL default '';
ALTER TABLE coupon_redeem_track CHANGE COLUMN redeem_ip redeem_ip varchar(45) NOT NULL default '';
ALTER TABLE coupon_gv_queue CHANGE COLUMN ipaddr ipaddr varchar(45) NOT NULL default '';


#Buttonloesung Merkmale in table products_description
ALTER TABLE products_description ADD products_merkmale varchar(256) NOT NULL default '';

#Vataddon Admin Control
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display Vat Addon', 'DISPLAY_VATADDON_WHERE', 'ALL', 'Do you want to display the text incl. or excl. VAT plus shipping costs near the prices?<br />0=off<br/>ALL=everywhere<br/>product_info=only on products details page<br />', '1', '120', NULL, now(), NULL, 'zen_cfg_select_option(array(\'0\', \'ALL\', \'product_info\'), ');

#EU Countries fuer Buttonloesung
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EU Countries', 'EU_COUNTRIES_FOR_LAST_STEP', 'BE,BG,DK,DE,EE,FI,FR,GR,IE,IT,LV,LT,LU,MT,NL,AT,PL,PT,RO,SE,SK,SI,ES,CZ,HU,GB,CY', 'Enter the countries which are part of the European Union. Two digit ISO codes, comma separated.', '1', '100', now(), now(), NULL, NULL);

#Set TinyMCE as default HTML editor
UPDATE configuration SET configuration_value = 'CKEDITOR' WHERE configuration_key = 'HTML_EDITOR_PREFERENCE';


#############

#### VERSION UPDATE STATEMENTS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='5.1', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.0->1.5.1', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='5.1', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.0->1.5.1', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';

#####  END OF UPGRADE SCRIPT

