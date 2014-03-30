#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.1 German to v1.5.2 German
# *
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2014 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_upgrade_zencart_151_to_152.sql 6 2014-03-30 09:45:57Z webchills $
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

ALTER TABLE sessions MODIFY COLUMN sesskey varchar(255) NOT NULL default '';
ALTER TABLE whos_online MODIFY COLUMN session_id varchar(255) NOT NULL default '';

UPDATE configuration SET configuration_description = 'This should point to the folder specified in your DIR_FS_SQL_CACHE setting in your configure.php files.' WHERE configuration_key = 'SESSION_WRITE_DIRECTORY';

UPDATE configuration set configuration_title = 'Log Page Parse Time', configuration_description = 'Record (to a log file) the time it takes to parse a page' WHERE configuration_key = 'STORE_PAGE_PARSE_TIME';
UPDATE configuration set configuration_title = 'Log Destination', configuration_description = 'Directory and filename of the page parse time log' WHERE configuration_key = 'STORE_PAGE_PARSE_TIME_LOG';
UPDATE configuration set configuration_title = 'Log Date Format', configuration_description = 'The date format' WHERE configuration_key = 'STORE_PARSE_DATE_TIME_FORMAT';
UPDATE configuration set configuration_title = 'Display The Page Parse Time', configuration_description = 'Display the page parse time on the bottom of each page<br />(Note: This DISPLAYS them. You do NOT need to LOG them to merely display them on your site.)' WHERE configuration_key = 'DISPLAY_PAGE_PARSE_TIME';
UPDATE configuration set configuration_title = 'Log Database Queries', configuration_description = 'Record the database queries to files in the system /logs/ folder. USE WITH CAUTION. This can seriously degrade your site performance and blow out your disk space storage quotas.' WHERE configuration_key = 'STORE_DB_TRANSACTIONS';

UPDATE configuration set configuration_title = 'Enable HTML Emails?', configuration_description = 'Send emails in HTML format if recipient has enabled it in their preferences.' WHERE configuration_key = 'EMAIL_USE_HTML';
UPDATE configuration set configuration_title = 'Email Admin Format?', configuration_description = 'Please select the Admin extra email format (Note: Enable HTML Emails must be on for HTML option to work)' WHERE configuration_key = 'ADMIN_EXTRA_EMAIL_FORMAT';

INSERT INTO address_format VALUES (7, '$firstname $lastname$cr$streets$cr$city $state $postcode$cr$country','$city $state / $country');
UPDATE countries set address_format_id = 7 where countries_iso_code_3 = 'AUS';
UPDATE countries set address_format_id = 5 where countries_iso_code_3 in ('BEL', 'NLD', 'SWE');
ALTER TABLE countries ADD status tinyint(1) DEFAULT '1';

ALTER TABLE paypal_payment_status_history MODIFY pending_reason varchar(32) default NULL;

ALTER TABLE sessions MODIFY sesskey varchar(255) NOT NULL default '';
ALTER TABLE whos_online MODIFY session_id varchar(255) NOT NULL default '';
ALTER TABLE admin_menus MODIFY menu_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY page_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY main_page VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY page_params VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages MODIFY menu_key VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_profiles MODIFY profile_name VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE admin_pages_to_profiles MODIFY page_key varchar(255) NOT NULL default '';

UPDATE configuration set configuration_description = 'Enter the time in seconds.<br />Max allowed is 900 for PCI Compliance Reasons.<br /> Default=900<br />Example: 900= 15 min <br /><br />Note: Too few seconds can result in timeout issues when adding/editing products', use_function = '', set_function = '' where configuration_key = 'SESSION_TIMEOUT_ADMIN';
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('PA-DSS Admin Session Timeout Enforced?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', '1', 'PA-DSS Compliance requires that any Admin login sessions expire after 15 minutes of inactivity. <strong>Disabling this makes your site NON-COMPLIANT with PA-DSS rules, thus invalidating any certification.</strong>', 1, 30, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Non-Compliant\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('PA-DSS Strong Password Rules Enforced?', 'PADSS_PWD_EXPIRY_ENFORCED', '1', 'PA-DSS Compliance requires that admin passwords must be changed after 90 days and cannot re-use the last 4 passwords. <strong>Disabling this makes your site NON-COMPLIANT with PA-DSS rules, thus invalidating any certification.</strong>', 1, 30, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Non-Compliant\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show linked status for categories', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 'true', 'Show Category products linked status?', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Admin Timeout gemäß PA-DSS Zertifizierung?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die Adminsitzung nach 15 Minuten Inaktivität beendet wird. Nach 15 Minuten Inaktivität werden Sie aus der Administration ausgeloggt. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br/><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Admin Passwortregeln gemäß PA-DSS Zertifizierung?', 'PADSS_PWD_EXPIRY_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die Adminpasswörter alle 90 Tage geändert werden und dabei nicht die 4 letzten Passwörter wiederverwendet werden dürfen. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br/><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Verlinkte Kategorien im Adminbereich anzeigen', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 43, 'Soll im Adminbereich angezeigt werden, wenn Artikel auch in anderen Kategorien verlinkt sind (gelbes Symbol neben dem Artikel)?', now(), now()),
('Orte für die Abholung', 'MODULE_SHIPPING_STOREPICKUP_LOCATIONS_LIST', 43, 'Hier können Sie verschiedene Orte für die Selbstabholung eintragen. Trennen Sie die Orte mit einem Strichpunkt (Semikolon).<br/>Optional können Sie je nach Abholort auch eine Gebühr verrechnen. Wird keine spezielle Gebühr definiert, dann gelten die normalen Kosten aus der näcjsten Einstellung.<br/><br/>Hier einige Beispiele:<br/><br/>Demogasse 17 - 1010 Wien;Beispielweg 15 - 8020 Graz<br/>Demogasse 17 - 1010 Wien,4.00;Beispielweg 15 - 8020 Graz,5.00<br/>Demogasse 17 - 1010 Wien,4.00;Beispielweg 15 - 8020 Graz,0.00<br/><br/>Wenn Sie in Ihrem Shop mehrere Sprachen aktiv haben und diese Ortsangaben je nach Sprache anders angeben wollen, dann beachten Sie bitte die Hinweise in der entsprechenden Sprachdatei (z.B. includes/languages/german/modules/shipping/storepickup.php)<br/>', now(), now()),
('E-Mail als MIME HTML versenden', 'EMAIL_USE_HTML', 43, 'Wollen Sie e-Mails im HTML Format versenden falls der Empfänger in seinen Einstellungen HTML statt Text angekreuzt hat?<br/>HINWEIS: Dies ist der generelle Hauptschalter. Wenn Sie hier auf false stellen, dann wird der Shop keinerlei HTML Emails versenden.', now(), now()),
('E-Mail an Admin: Format', 'ADMIN_EXTRA_EMAIL_FORMAT', 43, 'Wählen Sie das Format für e-Mails, die zusätzlich an den Administrator versendet werden.<br/>HINWEIS: Wenn Sie hier HTML auswählen, dann muss auch der generelle Hauptschalter HTML Emails versenden auf true gestellt sein, sonst werden trotzdem nur Text Emails an den Admin versandt.', now(), now());

## Delete old Image Handler entries
DELETE FROM configuration WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration WHERE configuration_key = 'WATERMARK_GRAVITY';
DELETE FROM configuration WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';
DELETE FROM configuration WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';
DELETE FROM configuration WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';
DELETE FROM configuration WHERE configuration_key = 'SHOW_UPLOADED_IMAGES';
DELETE FROM configuration WHERE configuration_key = 'ZOOM_GRAVITY';
DELETE FROM configuration WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';
DELETE FROM configuration_language WHERE configuration_key = 'IH_VERSION';
DELETE FROM configuration_language WHERE configuration_key = 'IH_RESIZE';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_SMALL_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_IMAGE_SIZE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_QUALITY';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH';
DELETE FROM configuration_language WHERE configuration_key = 'LARGE_IMAGE_MAX_HEIGHT';
DELETE FROM configuration_language WHERE configuration_key = 'WATERMARK_GRAVITY';
DELETE FROM configuration_language WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';
DELETE FROM configuration_language WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';
DELETE FROM configuration_language WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';
DELETE FROM configuration_language WHERE configuration_key = 'SHOW_UPLOADED_IMAGES';
DELETE FROM configuration_language WHERE configuration_key = 'ZOOM_GRAVITY';
DELETE FROM configuration_language WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';

## Delete old CSS/JS Loader entries
DELETE FROM configuration_group WHERE configuration_group_title = 'CSS/JS Loader';
DELETE FROM configuration_group WHERE configuration_group_title = 'MINIFY';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_STATUS';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_STATUS_JS';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_STATUS_CSS';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_MAX_URL_LENGHT';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_CACHE_TIME_LENGHT';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_CACHE_TIME_LATEST';
DELETE FROM configuration_language WHERE configuration_key LIKE '%MINIFY%';
DELETE FROM admin_pages WHERE page_key='configProdCssJsLoader';

## Delete old Google Analytics entries

DELETE FROM admin_pages WHERE page_key='configProdGoogleAnalytics';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AFTER_CODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_AFTER';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LANG';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_IDNUM';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_ACTIVE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_SKUCODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_ENABLED';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_AFTER_CODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_AFTER';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LANG';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_IDNUM';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_ACTIVE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_SKUCODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_ENABLED';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE';
DELETE FROM configuration_group WHERE configuration_group_title = 'Google Analytics Einstellungen';
DELETE FROM configuration_group WHERE configuration_group_title = 'Google Analytics Configuration';
DROP TABLE IF EXISTS google_analytics_languages;

## Delete old Facebook entries

DELETE FROM configuration_group WHERE configuration_group_title = 'Facebook Open Graph';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_STATUS';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_APPID';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_APPSECRET';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_ADMINID';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_OPEN_GRAPH_TYPE';
DELETE FROM configuration_language WHERE configuration_key LIKE '%FACEBOOK_OPEN_GRAPH%';
DELETE FROM admin_pages WHERE page_key='configProdFacebookOpenGraph';
DELETE FROM configuration_group WHERE configuration_group_title = 'Facebook Like Button';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_STATUS';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_METHOD';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ALIGNMENT';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_SHOW_FACES';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ACTION';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_FONT';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_WIDTH';
DELETE FROM configuration_language WHERE configuration_key LIKE '%FACEBOOK_LIKE_BUTTON%';
DELETE FROM admin_pages WHERE page_key='configProdFacebookOpenGraph';

## Delete old RSS Feed entries

DELETE FROM configuration_group WHERE configuration_group_title = 'RSS Feed';
DELETE FROM configuration WHERE configuration_key LIKE '%RSS_%';
DELETE FROM configuration_language WHERE configuration_key LIKE '%RSS_%';
DELETE FROM admin_pages WHERE page_key='configProdRSSFeed';

## Delete old Grid layout entries
DELETE FROM configuration WHERE configuration_key = 'PRODUCT_LISTING_LAYOUT_STYLE';
DELETE FROM configuration WHERE configuration_key = 'PRODUCT_LISTING_COLUMNS_PER_ROW';



## Install new Image Handler entries

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH resize images', 'IH_RESIZE', 'yes', 'Select either ''no'' which is old Zen-Cart behaviour or ''yes'' to activate automatic resizing and caching of images. If you want to use ImageMagick you have to specify the location of the <strong>convert</strong> binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em>.', 4, 76, NULL, now(), NULL, 'zen_cfg_select_option(array(''yes'', ''no''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images filetype', 'SMALL_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for small images as uploaded image''s.', 4, 77, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Image Handler Version', 'IH_VERSION', '4.4', 'This is used by image handler to check if the database is up to date with uploaded image handler files.', 0, 100, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images watermark', 'WATERMARK_SMALL_IMAGES', 'no', 'Set to ''yes'', if you want to show watermarked small images instead of unmarked small images.', 4, 78, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images zoom on hover', 'ZOOM_SMALL_IMAGES', 'no', 'Set to ''yes'', if you want to enable a nice zoom overlay while hovering the mouse pointer over small images.', 4, 79, now(), now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH small images zoom on hover size', 'ZOOM_IMAGE_SIZE', 'Medium', 'Set to ''Medium'', if you want to the zoom on hover display to use the medium sized image. Otherwise, to use the large sized image on hover, set to ''Large''', 4, 80, NULL, now(), NULL, 'zen_cfg_select_option(array(''Medium'', ''Large''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images filetype', 'MEDIUM_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for medium images as uploaded image''s.', 4, 81, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images background', 'MEDIUM_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to ''transparent'' to keep transparency.', 4, 82, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images compression quality', 'MEDIUM_IMAGE_QUALITY', '85', 'Specify the desired image quality for medium jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 83, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH medium images watermark', 'WATERMARK_MEDIUM_IMAGES', 'no', 'Set to ''yes'', if you want to show watermarked medium images instead of unmarked medium images.', 4, 84, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images filetype', 'LARGE_IMAGE_FILETYPE', 'no_change', 'Select one of ''jpg'', ''gif'' or ''png''. Internet Explorer has still issues displaying png-images with transparent areas. You better stick to ''gif'' for transparency or ''jpg'' for larger images. ''no_change'' is old zen-cart behavior, use the same file extension for large images as uploaded image''s.', 4, 85, NULL, now(), NULL, 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images background', 'LARGE_IMAGE_BACKGROUND', '255:255:255', 'If converted from an uploaded image with transparent areas, these areas become the specified color. Set to ''transparent'' to keep transparency.', 4, 86, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images compression quality', 'LARGE_IMAGE_QUALITY', '85', 'Specify the desired image quality for large jpg images, decimal values ranging from 0 to 100. Higher is better quality and takes more space. Default is 85 which is ok unless you have very specific needs.', 4, 87, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images watermark', 'WATERMARK_LARGE_IMAGES', 'no', 'Set to ''yes'', if you want to show watermarked large images instead of unmarked large images.', 4, 88, NULL, now(), NULL, 'zen_cfg_select_option(array(''no'', ''yes''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images maximum width', 'LARGE_IMAGE_MAX_WIDTH', '750', 'Specify a maximum width for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, 89, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH large images maximum height', 'LARGE_IMAGE_MAX_HEIGHT', '550', 'Specify a maximum height for your large images. If width and height are empty or set to 0, no resizing of large images is done.', 4, 90, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('IH watermark gravity', 'WATERMARK_GRAVITY', 'Center', 'Select the position for the watermark relative to the image''s canvas. Default is <strong>Center</Strong>.', 4, 91, NULL, now(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''NorthWest''), array(''id''=>''North'', ''text''=>''North''), array(''id''=>''NorthEast'', ''text''=>''NorthEast''), array(''id''=>''West'', ''text''=>''West''), array(''id''=>''Center'', ''text''=>''Center''), array(''id''=>''East'', ''text''=>''East''), array(''id''=>''SouthWest'', ''text''=>''SouthWest''), array(''id''=>''South'', ''text''=>''South''), array(''id''=>''SouthEast'', ''text''=>''SouthEast'')),');


INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES ('ImageHandler', 'BOX_TOOLS_IMAGE_HANDLER', 'FILENAME_IMAGE_HANDLER', '', 'tools', 'Y', 15);

## Install new column grid entries

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Layout Style', 'PRODUCT_LISTING_LAYOUT_STYLE', 'columns', 'Select the layout style:<br />Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)', '8', '40', NULL, now(), NULL, 'zen_cfg_select_option(array("rows", "columns"),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing - Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 'Select the number of columns of products to show in each row in the product listing. The default setting is 3.', '8', '41', NULL, now(), NULL, NULL);
               

## Install new image handler language entries

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('IH - Bildgröße ändern', 'IH_RESIZE', 43, 'Entweder ''No'' fÃ¼r normales Zen-Cart Verhalten oder ''Yes'' um die automatische Größenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now()),
('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', 43, 'WÃ¤hlen Sie ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für grÃ¶ÃŸere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now()),
('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', 43, 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je höher desto bessere Qualität und desto höhere Dateigröße. Voreingestellt ist 85.', now(), now()),
('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', now(), now()),
('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', now(), now()),
('IH - Kleine Bilder - Bildgröße bei Hover', 'ZOOM_IMAGE_SIZE', 43, 'Stellen Sie auf Medium wenn Sie beim Hover die Größe der mittleren Bilder haben wollen und auf Large, wenn Sie die GröÃŸe der groÃŸen Bilder verwenden wollen.', now(), now()),
('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je höher desto bessere Qualität und desto höhere Dateigröße. Voreingestellt ist 85.', now(), now()),
('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', now(), now()),
('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigröße und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now()),
('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', now(), now()),
('IH - Grosse Bilder - Maximale Breite', 'LARGE_IMAGE_MAX_WIDTH', 43, 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now()),
('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', 43, 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</strong>.', now(), now()),
('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', 43, 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer Größe nicht verändert.', now(), now());

## Install new column grid language entries

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Artikelliste - Layout Stil', 'PRODUCT_LISTING_LAYOUT_STYLE', 'Wählen Sie das Layout Ihrer Artikelliste:<br/>Jeder Artikel kann in einer eigenen Zeile angezeigt werden (rows) oder die Artikel können nebeneinander in mehreren Spalten pro Reihe angezeigt werden (columns)', 43),
('Artikelliste - Spalten pro Reihe', 'PRODUCT_LISTING_COLUMNS_PER_ROW', 'Wieviele Spalten pro Reihe wollen Sie in der Artikelliste anzeigen. Voreinstellung: 3', 43);


## Install New Minify entries

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('Minify', 'Set Minify Options', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

REPLACE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable Minify for Javascripts', 'MINIFY_STATUS_JS', 'true', 'Minifying will speed up your sites loading speed by combining and compressing Javascript files.', @gid, 1, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Minify for CSS', 'MINIFY_STATUS_CSS', 'true', 'Minifying will speed up your sites loading speed by combining and compressing CSS files.', @gid, 2, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Max URL Lenght', 'MINIFY_MAX_URL_LENGHT', '500', 'On some server the maximum lenght of any POST/GET request URL is limited. If this is the case for your server, you can change the setting here', @gid, 3, now(), now(), NULL, NULL),
('Minify Cache Time', 'MINIFY_CACHE_TIME_LENGHT', '31536000', 'Set minify cache time (in second). Default is 1 year (31536000)', @gid, 4, now(), now(), NULL, NULL),
('Latest Cache Time', 'MINIFY_CACHE_TIME_LATEST', '0', 'Normally you dont have to set this, but if you have just made changes to your js/css files and want to make sure they are reloaded right away, you can reset this to 0.', @gid, 5, now(), now(), NULL, NULL);
    

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Minify', 'Minify Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Minify für Javascripts aktivieren', 'MINIFY_STATUS_JS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. Javascripts werden kombiniert und komprimiert. Wollen Sie Minify für Javascripts aktivieren?', now(), now()),
('Minify für Stylesheets aktivieren', 'MINIFY_STATUS_CSS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien werden kombiniert und komprimiert. Wollen Sie Minify für CSS Stylesheets aktivieren?', now(), now()),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 43, 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', now(), now()),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT', 43, 'Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', now(), now()),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 43, 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Änderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Änderungen sofort wirksam sind, stellen Sie auf 0.', now(), now());

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES 
('configMinifySettings','BOX_CONFIGURATION_MINIFY','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);


## Install New Google Analytics

INSERT INTO configuration_group (configuration_group_title,configuration_group_description,sort_order,visible) VALUES ('Google Analytics', 'Google Analytics Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

REPLACE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Analytics Enabled', 'GOOGLE_ANALYTICS_ENABLED', 'Disabled', 'Enables / disables this plugin.', @gid, 1, now(), now(), NULL, 'zen_cfg_select_option(array(\'Enabled\', \'Disabled\'), '),
('Analytics Account', 'GOOGLE_ANALYTICS_UACCT', 'UA-XXXXXX-X', 'This number is the unique ID you were given by Google when you registered for your Google Analytics account. <b>Enter your Google Analytics account number below. It starts with UA</b>', @gid, 2, now(), now(), NULL, NULL),
('Target Address', 'GOOGLE_ANALYTICS_TARGET', 'customers', 'This element is used in conjunction with Google E-Commerce Tracking. It indicates how you want your "transactions" to be identified in your Analytics reports.<br><br>Addresses consist of City,State, and Country.<br><br>This information can help you determine locality of orders placed, shipped to, or billed to.<br><br><b>Which address type do you want to use for recording transaction information?</b><br>', @gid, 3, now(), now(), NULL, 'zen_cfg_select_option(array(\'customers\', \'delivery\', \'billing\'),'),
('Affiliation', 'GOOGLE_ANALYTICS_AFFILIATION', '', 'This <b>optional</b> tracking element is used in conjunction with Google E-Commerce Tracking.<br><br>The Affiliation tag describes the affiliating store or processing site.<br><br>It can be used if you have multiple stores (or web sites) in various locations and is used to track from which location a particular sale originated.<br><br><b>If you have one, enter your optional partner or store affiliation in the space provided below.</b><br>', @gid, 4, now(), now(), NULL, NULL),
('Use sku/code', 'GOOGLE_ANALYTICS_SKU_CODE', 'products_id', 'This tracking element is used in conjunction with Google Analytics E-Commerce tracking.<br><br>It enables you to track which products perform better than others using either the Product ID, or the Product Model Number as a unique identifier.<br><br>Indicate which identifier you want to use to track product performance by selecting one of the options below.</b>', @gid, 5, now(), now(), NULL, 'zen_cfg_select_option(array(\'products_id\', \'products_model\'),'),
('Activate Adwords Conversion Tracking', 'GOOGLE_CONVERSION_ACTIVE', 'No', 'This element enables you turn on or off Google Conversion Tracking.<br><br><span style="color:#ff0000;font-weight:bold;">Please Note:</span> Conversion tracking is used to track the effectiveness of Google AdWords paid search campaigns. If you are <b>not</b> running any paid search campaigns, then you should leave this set to "No".<br><br>If you are running Google AdWords (paid search) campaigns, then turning this on will place the proper conversion tracking code on your checkout success page and enable you to start tracking conversions.<br><br>Turning this on <b>requires you</b> to enter your unique Google Conversion Tracking ID in place of the "XXXXXXXXXXX" number shown in the next section.<br><br><b>Do you want to turn on Google AdWords Conversion Tracking?</b><br>', @gid, 6, now(), now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\'), '),
('Google AdWords Conversion Tracking Number', 'GOOGLE_CONVERSION_IDNUM', 'XXXXXXXXXX', 'If you activated Conversion Tracking in the previous section, then you <b>must</b> enter your unique Google Conversion Tracking ID in place of the "XXXXXXXXXXX" shown in the space provided below.<br><br>If you have activated Conversion Tracking, and do not enter your number below, tracking will not work.<br><br><b>Enter your AdWords Conversion Tracking ID Number below.</b>', @gid, 7, now(), now(), NULL, NULL),
('Google AdWords Language', 'GOOGLE_CONVERSION_LANG', 'de', 'Select the language to be used. The default is "English US".<br><br><b>Select your language below</b><br>', @gid, 8, now(), now(), NULL, 'zen_cfg_pull_down_google_languages('),
('Google Tracking Code Type To Use', 'GOOGLE_ANALYTICS_TRACKING_TYPE', 'universal', 'Select the type of tracking you wish to use. The default is the "universal" type. You have the ability to change this to the older "ga.js" method. <b>Select your tracking preference below.</b><br />', @gid, 9, now(), now(), NULL, 'zen_cfg_select_option(array(\'universal\', \'ga.js\', \'ga.js asynchronous\'), ');

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Google Analytics', 'Google Analytics', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('GA - Google Analytics aktivieren?', 'GOOGLE_ANALYTICS_ENABLED', 43, 'Wollen Sie Google Analytics aktivieren? <br/><br/>Enabled = Ja<br/>Disabled = Nein', now(), now()),
('GA - Analytics Account', 'GOOGLE_ANALYTICS_UACCT', 43, 'Google Analytics:<br/><br/>Die ID, die Sie von Google bei der Anmeldung zu Google Analytics bekommen haben.<br/>Format:<br/>UA-XXXXXX-X<br/><br/><b>Tragen Sie hier Ihre Analytics Account Nummer ein:</b>', now(), now()),
('GA - E-Commerce Tracking Zieladresse', 'GOOGLE_ANALYTICS_TARGET', 43, 'Google Analytics:<br/><br/>Diese Einstellung bezieht sich auf das Google E-Commerce Tracking und legt fest, ob sie die Auswertung auf Basis von Kundenadresse (customers), Rechnungsadresse (billing) oder Lieferadresse (delivery) haben wollen.<br/><br/><b>Welchen Adresstyp wollen Sie für die Aufzeichnung der Transaktionen verwenden?</b>', now(), now()),
('GA - Affiliate', 'GOOGLE_ANALYTICS_AFFILIATION', 43, 'Google Analytics:<br/><br/>Falls ein Affiliate vorhanden ist (z.B. ein zweiter Shop) hier eintragen. Bei dieser Einstellung geht es darum auszuwerten, von welchem Partnershop/Partnerseite der Kunde ursprünglich kam.<br/><br/><b>Tragen Sie hier den Affiliate ein:</b>', now(), now()),
('GA - SKU Code', 'GOOGLE_ANALYTICS_SKU_CODE', 43, 'Google Analytics:<br/><br/>Diese Einstellung bezieht sich auf das Google E-Commerce Tracking und legt fest, ob die Artikel ID oder die Artikelnummer in den Statistiken angezeigt werden soll.<br/><br/><b>Wählen Sie hier aus, was angezeigt werden soll: product_id = interne Zen-Cart Artikel ID<br/>products_model = eingegebene Artikelnummer</b>', now(), now()),
('GA - Conversion Tracking aktivieren?', 'GOOGLE_CONVERSION_ACTIVE', 43, 'Google Analytics:<br/><br/><b>WICHTIG:<br/>Diese Einstellung nur aktivieren, wenn auch das kostenpflichtige Google Adwords genutzt wird!</b><br/><br/>Durch Aktivieren wird der Google Conversion Tracking Code in die Checkout Success Seite eingefügt. Dadurch kann die Effektivität der Adwords Kampagne ausgewertet werden. Wenn Sie hier das Conversion Tracking aktivieren, müssen Sie in der nächsten Option Ihre Conversion Tracking Nummer einstellen.<br/><br/><b>Wollen Sie Google AdWords Conversion Tracking aktivieren?</b>', now(), now()),
('GA - Adwords Conversion Tracking Nummer', 'GOOGLE_CONVERSION_IDNUM', 43, 'Google Analytics:<br/><br/>Wenn Sie oben Conversion Tracking aktiviert haben, geben Sie hier Ihre Conversion Tracking ID anstelle der XXXXXXXXXXX ein. Sollten Sie hier keine Nummer eingeben, wird das Conversion Tracking nicht funktionieren.<br/><br/><b>Geben Sie hier Ihre AdWords Conversion Tracking ID ein:</b>', now(), now()),
('GA - Google Adwords Sprache', 'GOOGLE_CONVERSION_LANG', 43, 'Google Analytics:<br/><br/>Spracheinstellung für Google Adwords. Voreingestellt ist: Deutsch<br/><br/><b>Wählen Sie die gewünschte Sprache aus:</b>', now(), now()),
('GA - Art des Tracking Codes', 'GOOGLE_ANALYTICS_TRACKING_TYPE', 43, 'Google Analytics:<br/><br/>Welchen Tracking Code Typ wollen Sie verwenden? Voreingestellt ist der neueste universal Typ. Sie können das auf den veralteten ga.js oder auf den früher von Google angebotenen Asynchronous Typ umstellen. Besuchen Sie die <a href="http://code.google.com/apis/analytics/docs/tracking/home.html" target="_blank">Google Analytics Website</a> für genauere Informationen zu den verschiedenen Varianten<br/><br/><b>Wählen Sie Ihren Tracking Typ:</b>', now(), now()),
('GA - Benutzerdefinierten Tracking Code nach dem Hauptcode einfügen?', '43', 0, 'Google Analytics:<br/><br/>Wollen Sie einen weiteren benutzerdefinierten Trackingcode nach dem normalen Google Analytics Hauptcode einfügen? Das kann genutzt werden, um den Code an Ihre ganz individuellen Erfordernisse anzupassen. Fügen Sie Tracking Objekte entsprechend der Dokumentation der <a href="http://code.google.com/apis/analytics/docs/tracking/gaTrackingCustomVariables.html" target="_blank">Google Analytics Website</a> ein.<br/><br/>Voreingestellt ist: Deaktiviert.', now(), now()),
('GA - Benutzerdefinierter Tracking Code', 'GOOGLE_ANALYTICS_CUSTOM_CODE', 43, 'Google Analytics:<br/><br/>Falls Sie benutzerdefinierten Tracking Code aktiviert haben, fügen Sie diesen hier ein:', now(), now());

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configGoogleAnalytics','BOX_CONFIGURATION_GOOGLEANALYTICS','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);

DROP TABLE IF EXISTS google_analytics_languages;
CREATE TABLE google_analytics_languages (
  languages_id int(11) NOT NULL auto_increment,
  name varchar(50) NOT NULL default '',
  code char(10) NOT NULL default '',
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id),
  KEY idx_languages_name_zen (name)
);

INSERT INTO google_analytics_languages VALUES (1,'Chinese (simplified) - Chinesisch (einfach)','zh_CN',1);
INSERT INTO google_analytics_languages VALUES (2,'Chinese (traditional) - Chinesisch (traditionell)','zh_TW',2);
INSERT INTO google_analytics_languages VALUES (3,'Danish - Dänisch','da',3);
INSERT INTO google_analytics_languages VALUES (4,'Dutch - Holländisch','nl',4);
INSERT INTO google_analytics_languages VALUES (5,'English (Australia)','en_AU',5);
INSERT INTO google_analytics_languages VALUES (6,'English (UK))','en_GB',6);
INSERT INTO google_analytics_languages VALUES (7,'English (US)','en_US',7);
INSERT INTO google_analytics_languages VALUES (8,'Finnish - Finnisch','fi',8);
INSERT INTO google_analytics_languages VALUES (9,'French - Französisch','fr',9);
INSERT INTO google_analytics_languages VALUES (10,'German - Deutsch','de',10);
INSERT INTO google_analytics_languages VALUES (11,'Hebrew - Hebräisch','iw',11);
INSERT INTO google_analytics_languages VALUES (12,'Italian - Italienisch','it',12);
INSERT INTO google_analytics_languages VALUES (13,'Japanese - Japanisch','ja',13);
INSERT INTO google_analytics_languages VALUES (14,'Korean - Koreanisch','ko',14);
INSERT INTO google_analytics_languages VALUES (15,'Norwegian - Norwegisch','no',15);
INSERT INTO google_analytics_languages VALUES (16,'Polish - Polnisch','pl',16);
INSERT INTO google_analytics_languages VALUES (17,'Portuguese (Brazil) - Portugiesisch (Brasilien)','pt_BR',17);
INSERT INTO google_analytics_languages VALUES (18,'Portuguese (Portugal) - Portugiesisch (Portugal)','pt_PT',18);
INSERT INTO google_analytics_languages VALUES (19,'Russian - Russisch','ru',19);
INSERT INTO google_analytics_languages VALUES (20,'Spanish - Spanisch','es',20);
INSERT INTO google_analytics_languages VALUES (21,'Swedish - Schwedisch','sv',21);
INSERT INTO google_analytics_languages VALUES (22,'Turkish - Türkisch','tr',22);


## Install New Facebook

INSERT INTO configuration_group (configuration_group_title, configuration_group_description , sort_order , visible) VALUES ('Facebook Support', 'Facebook Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

REPLACE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Open Graph - Enable Facebook Open Graph', 'FACEBOOK_OPEN_GRAPH_STATUS', 'false', 'Enable Facebook Open Graph meta data?', @gid, 1, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Open Graph - Application ID', 'FACEBOOK_OPEN_GRAPH_APPID', '', 'Please enter your application ID (<a href="http://developers.facebook.com/setup/" target="_blank">Get an application ID</a>)', @gid, 2, now(), now(), NULL, NULL),
('Open Graph - Application Secret', 'FACEBOOK_OPEN_GRAPH_APPSECRET', '', 'Please enter your application secret', @gid, 3, now(), now(), NULL, NULL),
('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', '', 'Enter the Admin ID(s) of the Facebook user(s) that administer your Facebook fan page separated by commas (<a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>)', @gid, 4, now(), now(), NULL, NULL),
('Open Graph - Default Image', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', '', 'Enter the full path to your default image or leave blank to disable.  The default image is only used when the product image cannot be found.', @gid, 5, now(), now(), NULL, NULL),
('Open Graph - Object Type', 'FACEBOOK_OPEN_GRAPH_TYPE', 'product', 'Enter an Open Graph Object Type for your products (<a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>)', @gid, 6, now(), now(), NULL, NULL),
('Open Graph - Use cPath', 'FACEBOOK_OPEN_GRAPH_CPATH', 'true', 'Include the cPath in your URLs?', @gid, 7, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Open Graph - Include Language', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 'false', 'Include the language in your URLs?', @gid, 8, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Open Graph - Use Canonical URL', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 'true', 'Use the canonical URL from Zen Cart or try and recreate the URL?', @gid, 9, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Like Button - Enable Facebook Like Button', 'FACEBOOK_LIKE_BUTTON_STATUS', 'false', 'Enable the Facebook Like Button?', @gid, 10, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Like Button - Method', 'FACEBOOK_LIKE_BUTTON_METHOD', 'XBFML', 'Use the iframe, HTML5, or XBFML method?', @gid, 11, now(), now(), NULL, 'zen_cfg_select_option(array(\'iframe\', \'XBFML\', \'HTML5\'),'),
('Like Button - Alignment', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT', 'none', 'Float the widget to the left, right, or none', @gid, 12, now(), now(), NULL, 'zen_cfg_select_option(array(\'none\', \'left\', \'right\'),'),
('Like Button - Layout Style', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 'button_count', 'Select a layout style', @gid, 13, now(), now(), NULL, 'zen_cfg_select_option(array(\'standard\', \'button_count\', \'box_count\'),'),
('Like Button - Show Faces', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES', 'false', 'Specifies whether to display profile photos below the button (if true, set height to 80 or more; standard layout only)', @gid, 14, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Like Button - Action', 'FACEBOOK_LIKE_BUTTON_ACTION', 'like', 'The verb to display on the button', @gid, 15, now(), now(), NULL, 'zen_cfg_select_option(array(\'like\', \'recommend\'),'),
('Like Button - Font', 'FACEBOOK_LIKE_BUTTON_FONT', 'arial', 'Select a font:', @gid, 16, now(), now(), NULL, 'zen_cfg_select_option(array(\'arial\', \'lucida grande\', \'segoe ui\', \'tahoma\', \'trebuchet ms\', \'verdana\'),'),
('Like Button - Color Scheme', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME', 'light', 'The color scheme for the like button', @gid, 17, now(), now(), NULL, 'zen_cfg_select_option(array(\'light\', \'dark\'),'),
('Like Button - Width', 'FACEBOOK_LIKE_BUTTON_WIDTH', '90', 'The width of the like button (standard => 450; button_count => 90; box_count => 55)', @gid, 18, now(), now(), NULL, NULL),
('Like Button - Combined Send Button', 'FACEBOOK_LIKE_BUTTON_SEND', 'true', 'Create a combined Like and Send button?', @gid, 19, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Facebook Funktionen', 'Facebook Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Open Graph - Facebook Open Graph aktivieren', 'FACEBOOK_OPEN_GRAPH_STATUS', 43, 'Wollen Sie die Facebook Open Graph Metadaten aktivieren?', now(), now()),
('Open Graph - Anwendungsnummer', 'FACEBOOK_OPEN_GRAPH_APPID', 43, 'Tragen Sie hier Ihre Anwendungsnummer / Application ID ein. Falls Sie noch keine haben:<br/><a href="http://developers.facebook.com/setup/" target="_blank">Application ID beantragen</a>', now(), now()),
('Open Graph - Anwendungs Geheimcode', 'FACEBOOK_OPEN_GRAPH_APPSECRET', 43, 'Tragen Sie Ihren Anwendungs Geheimcode / Application Secret Key ein.', now(), now()),
('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', 43, 'Geben Sie die Admin ID(s) des oder der Facebook User an, die Ihre Facebook Fanseite administrieren. Wenn das mehrere sind, geben Sie die IDs mit Komma getrennt ein. Infos dazu:<br/><a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>', now(), now()),
('Open Graph - Standard Bild', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', 43, 'Geben Sie den vollen Pfad zu einem Standardbild an oder lassen Sie dieses Feld leer, um kein Standardbild zu verwenden. Ein hier eingestelltes Standardbild wird nur verwendet, wenn kein Artikelbild gefunden wird und stellt so sicher, dass zumindest ein passendes Bild bei Facebook gepostet wird.', now(), now()),
('Open Graph - Objekt Typ', 'FACEBOOK_OPEN_GRAPH_TYPE', 43, 'Geben Sie hier einen Open Graph Object Type für Ihre Artikel ein. Beispiel: product<br/>Infos dazu:<br/><a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>', now(), now()),
('Open Graph - Kategoriepfad in den URLs?', 'FACEBOOK_OPEN_GRAPH_CPATH', 43, 'Sollen Ihre URLs für Facebook den cPath enthalten?', now(), now()),
('Open Graph - Sprache in den Links?', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 43, 'Sollen Ihre URLs das Anhängsel für die Sprache enthalten?', now(), now()),
('Open Graph - Kanonische URLs verwenden?', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 43, 'Wollen Sie die kanonische URL der Seite verwenden (empfohlen) oder versuchen, die URL neu zu generieren?', now(), now()),
('Like Button - Facebook Like Button aktivieren?', 'FACEBOOK_LIKE_BUTTON_STATUS', 43, 'Wollen Sie den Facebook Like Button aktivieren?', now(), now()),
('Like Button - Einbindungsart', 'FACEBOOK_LIKE_BUTTON_METHOD', 43, 'iframe, HTML5 oder XBFML', now(), now()),
('Like Button - Ausrichtung', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT', 43, 'Soll der Button links, rechts oder gar nicht floaten?', now(), now()),
('Like Button - Layout Stil', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 43, 'Wählen Sie das Grundlayout für den Button: Standard, Button mit Counter oder Box mit Counter', now(), now()),
('Like Button - Profilfotos?', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES', 43, 'Sollen Profilfotos unter dem Button angezeigt werden (Falls ja setzen Sie die Höhe auf 80 und mehr. Nur im Standardlayout möglich)', now(), now()),
('Like Button - Aktion', 'FACEBOOK_LIKE_BUTTON_ACTION', 43, 'Aktion für den Button: like oder recommend', now(), now()),
('Like Button - Schriftart', 'FACEBOOK_LIKE_BUTTON_FONT', 43, 'Wählen Sie eine Schriftart aus:', now(), now()),
('Like Button - Farbschema', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME', 43, 'Farbschema light oder dark', now(), now()),
('Like Button - Breite', 'FACEBOOK_LIKE_BUTTON_WIDTH', 43, 'Breite des Like Buttons (Standard => 450; Button mit Counter => 90; Box mit Counter =>55)', now(), now()),
('Like Button - Senden und Liken kombinieren?', 'FACEBOOK_LIKE_BUTTON_SEND', 43, 'Soll der Button die Funktionen Send und Like kombinieren?', now(), now());

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configFacebook','BOX_CONFIGURATION_FACEBOOK','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);


## Install New RSS Feed

INSERT INTO configuration_group (configuration_group_title, configuration_group_description , sort_order , visible ) VALUES ('RSS Feed', 'RSS Feed Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

REPLACE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable RSS Feed?', 'RSS_FEED_ENABLED', 'true', 'Do you want to enable teh RSS Feeds?', @gid, 1, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('RSS Title', 'RSS_TITLE', '', 'RSS Title (if empty use Store Name)', @gid, 2, now(), now(), NULL, NULL),
('RSS Description', 'RSS_DESCRIPTION', '', 'RSS description', @gid, 3, now(), now(), NULL, NULL),
('RSS Image', 'RSS_IMAGE', '', 'A GIF, JPEG or PNG image that represents the channel', @gid, 4, now(), now(), NULL, NULL),
('RSS Image Name', 'RSS_IMAGE_NAME', '', 'RSS Image Name (if empty use Store Name)', @gid, 5, now(), now(), NULL, NULL),
('RSS Copyright', 'RSS_COPYRIGHT', '', 'RSS Copyright (if empty use Store Owner)', @gid, 6, now(), now(), NULL, NULL),
('RSS Managing Editor', 'RSS_MANAGING_EDITOR', '', 'RSS Managing Editor (if empty use Store Owner Email Address and Store Owner)', @gid, 7, now(), now(), NULL, NULL),
('RSS Webmaster', 'RSS_WEBMASTER', '', 'RSS Webmaster (if empty use Store Owner Email Address and Store Owner)', @gid, 8, now(), now(), NULL, NULL),
('RSS Author', 'RSS_AUTHOR', '', 'RSS Author (if empty use Store Owner Email Address and Store Owner)', @gid, 9, now(), now(), NULL, NULL),
('RSS Home Page Feed', 'RSS_HOMEPAGE_FEED', 'new_products', 'RSS Home Page Feed', @gid, 10, now(), now(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'),
('RSS Default Feed', 'RSS_DEFAULT_FEED', 'new_products', 'RSS Default Feed', @gid, 11, now(), now(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'),
('Strip tags', 'RSS_STRIP_TAGS', 'false', 'Strip tags', @gid, 12, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Generate Descriptions', 'RSS_ITEMS_DESCRIPTION', 'true', 'Generate Descriptions', @gid, 13, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Descriptions Length', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', '400', 'How many characters in description (0 for no limit)', @gid, 14, now(), now(), NULL, NULL),
('Time to live', 'RSS_TTL', '1440', 'Time to live - time after reader should refresh the info in minutes', @gid, 15, now(), now(), NULL, NULL),
('Default Products Limit', 'RSS_PRODUCTS_LIMIT', '100', 'Default Limit to Products Feed', @gid, 16, now(), now(), NULL, NULL),
('Add Product image', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 'true', 'Add product image to product description tag', @gid, 17, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Add "buy now" button', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 'false', 'Add "buy now" button to product description tag', @gid, 18, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Categories for Products', 'RSS_PRODUCTS_CATEGORIES', 'master', 'Use ''all'' or only ''master'' Categories for Products when specified cPath parameter', @gid, 19, now(), now(), NULL, 'zen_cfg_select_option(array(\'master\', \'all\'),'),
('Feed Cache', 'RSS_CACHE_TIME', '10', 'Cache Feeds in the cache folder. If you don''t want caching, set it to 0', @gid, 20, now(), now(), NULL, NULL);

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'RSS Feed', 'RSS Feed Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('RSS - RSS Feeds aktivieren?', 'RSS_FEED_ENABLED', 43, 'Wollen Sie die RSS Feeds aktivieren?', now(), now()),
('RSS - Titel', 'RSS_TITLE', 43, 'RSS Titel (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Beschreibung', 'RSS_DESCRIPTION', 43, 'RSS Beschreibung', now(), now()),
('RSS - Bild', 'RSS_IMAGE', 43, 'ein GIF, JPEG oder PNG Bild, das das RSS Feed illustriert', now(), now()),
('RSS - Bild Name', 'RSS_IMAGE_NAME', 43, 'RSS Bild Name (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Copyright', 'RSS_COPYRIGHT', 43, 'RSS Copyright (falls leer verwende den Shopinhaber)', now(), now()),
('RSS - Editor', 'RSS_MANAGING_EDITOR', 43, 'RSS Managing Editor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Webmaster', 'RSS_WEBMASTER', 43, 'RSS Webmaster (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Autor', 'RSS_AUTHOR', 43, 'RSS Autor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Home Page Feed', 'RSS_HOMEPAGE_FEED', 43, 'RSS Home Page Feed - Standardwert Neue Artikel', now(), now()),
('RSS - Default Feed', 'RSS_DEFAULT_FEED', 43, 'RSS Default Feed - Standarwert Neue Artikel', now(), now()),
('RSS - HTML Tags ausfiltern', 'RSS_STRIP_TAGS', 43, 'HTML Tags ausfiltern? Standardwert: false', now(), now()),
('RSS - Artikelbeschreibung', 'RSS_ITEMS_DESCRIPTION', 43, 'Soll die Artikelbeschreibung im Feed erscheinen?', now(), now()),
('RSS - Länge der Beschreibung', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', 43, 'Wollen Sie den Beschreibungstext auf eine bestimmte Länge beschränken? (0 für kein Limit)', now(), now()),
('RSS - Lebensdauer des Feeds', 'RSS_TTL', 43, 'Lebensdauer - Zeit in Minuten nach der ein RSS Reader das Feed refreshen soll - Standardwert: 1440', now(), now()),
('RSS - Standard Artikel Limit', 'RSS_PRODUCTS_LIMIT', 43, 'Wieviele Artikel soll das RSS Feed enthalten? Standardwert: 100', now(), now()),
('RSS - Füge Artikelbild hinzu', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 43, 'Soll das Artikelbild im Feed erscheinen?', now(), now()),
('RSS - Füge Jetzt kaufen Button hinzu', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 43, 'Soll der Jetzt kaufen Button im Feed erscheinen?', now(), now()),
('RSS - Kategorien für Artikel', 'RSS_PRODUCTS_CATEGORIES', 43, 'Wenn ein cPath mit angegeben wird, sollen die Artikel, dann nur aus der Masterkategorie kommen oder aus allen Kategorien? (wichtig bei verlinkten Artikeln)', now(), now()),
('RSS - Cache', 'RSS_CACHE_TIME', 43, 'Lebensdauer des Feed Cache in Minuten (es werden Feed Files im cache Ordner abgelegt). Wenn Sie kein Caching verwenden wollen stellen Sie auf 0', now(), now());

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configRSSFeed','BOX_CONFIGURATION_RSSFEED','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);


#############

#### VERSION UPDATE STATEMENTS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='5.2', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.1->1.5.2', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='5.2', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.1->1.5.2', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';

#####  END OF UPGRADE SCRIPT

