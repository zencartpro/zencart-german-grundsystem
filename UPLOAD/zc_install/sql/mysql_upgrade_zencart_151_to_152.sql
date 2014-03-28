#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.1 German to v1.5.2 German
# *
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2014 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_upgrade_zencart_151_to_152.sql 4 2014-03-28 07:45:57Z webchills $
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
DELETE FROM configuration WHERE configuration_key = 'MINIFY_STATUS';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_MAX_URL_LENGHT';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_CACHE_TIME_LENGHT';
DELETE FROM configuration WHERE configuration_key = 'MINIFY_CACHE_TIME_LATEST';
DELETE FROM configuration_language WHERE configuration_key LIKE '%MINIFY%';
DELETE FROM admin_pages WHERE page_key='configProdCssJsLoader';

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

INSERT INTO configuration_group (`configuration_group_title`,`configuration_group_description`,`sort_order`,`visible`) VALUES ('CSS/JS Loader', 'Set CSS/JS Loader Options', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable Minify for Javascripts', 'MINIFY_STATUS_JS', 'true', 'Minifying will speed up your site\'s loading speed by combining and compressing Javascript files.', @gid, 1, NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Minify for CSS', 'MINIFY_STATUS_CSS', 'true', 'Minifying will speed up your site\'s loading speed by combining and compressing CSS files.', @gid, 2, NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Max URL Lenght', 'MINIFY_MAX_URL_LENGHT', '500', 'On some server the maximum lenght of any POST/GET request URL is limited. If this is the case for your server, you can change the setting here', @gid, 3, NULL, now(), NULL, NULL),
('Minify Cache Time', 'MINIFY_CACHE_TIME_LENGHT', '31536000', 'Set minify cache time (in second). Default is 1 year (31536000)', @gid, 4, NULL, now(), NULL, NULL),
('Latest Cache Time', 'MINIFY_CACHE_TIME_LATEST', '0', 'Normally you don\'t have to set this, but if you have just made changes to your js/css files and want to make sure they are reloaded right away, you can reset this to 0.', @gid, 5, NULL, now(), NULL, NULL),
    

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Minify', 'Minify Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Minify für Javascripts aktivieren', 'MINIFY_STATUS_JS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. Javascripts werden kombiniert und komprimiert. Wollen Sie Minify für Javascripts aktivieren?', now(), now()),
('Minify für Stylesheets aktivieren', 'MINIFY_STATUS_CSS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien werden kombiniert und komprimiert. Wollen Sie Minify für CSS Stylesheets aktivieren?', now(), now()),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 43, 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', now(), now()),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT', 43, 'Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', now(), now()),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 43, 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Änderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Änderungen sofort wirksam sind, stellen Sie auf 0.', now(), now());

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('configMinifySettings', 'BOX_CONFIGURATION_MINIFY', 'FILENAME_CONFIGURATION', 'gID=31', 'configuration', 'Y', 31);



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

