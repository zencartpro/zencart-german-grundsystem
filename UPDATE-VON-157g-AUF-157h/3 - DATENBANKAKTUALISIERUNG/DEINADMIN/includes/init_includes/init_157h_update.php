<?php
/**
* !!!! Nach erfolgreicher Aktualisierung, löschen Sie diese Datei sofort wieder vom Server !!!!!
* @copyright Copyright 2003-2024 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* Zen Cart German Version - www.zen-cart-pro.at
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_157h_update.php 2024-04-15 06:58:51Z webchills $
*/

if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
}
// -----
// Script erst starten, nachdem ein Admin eingeloggt ist, damit jemand die Updatemeldungen mitbekommt.
//
if (isset($_SESSION['admin_id'])) {
	
	
// -----
// Neue Konfig Admin Layout
// 

$db->Execute("INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Admin Layout', 'Admin Layout Settings', '1', '1');");
$db->Execute("SET @gid=last_insert_id();");
$db->Execute("UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();");

$db->Execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Useful Link 1 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_1_TEXT', 'Link 1', 'Enter the text for Useful Link 1:<br>', @gid, 1,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 1 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_1_URL', 'https://www.google.at','Enter the URL for Useful Link 1:<br>', @gid, 2, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 2 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_2_TEXT', 'Link 2', 'Enter the text for Useful Link 2:<br>', @gid, 3,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 2 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_2_URL', 'https://www.google.at','Enter the URL for Useful Link 2:<br>', @gid, 4, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 3 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_3_TEXT', 'Link 3', 'Enter the text for Useful Link 3:<br>', @gid, 5,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 3 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_3_URL', 'https://www.google.at','Enter the URL for Useful Link 3:<br>', @gid, 6, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 4 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_4_TEXT', 'Link 4', 'Enter the text for Useful Link 4:<br>', @gid, 7,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 4 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_4_URL', 'https://www.google.at','Enter the URL for Useful Link 4:<br>', @gid, 8, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 5 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_5_TEXT', 'Link 5', 'Enter the text for Useful Link 5:<br>', @gid, 9,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 5 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_5_URL', 'https://www.google.at','Enter the URL for Useful Link 5:<br>', @gid, 10, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 6 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_6_TEXT', 'Link 6', 'Enter the text for Useful Link 6:<br>', @gid, 11,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 6 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_6_URL', 'https://www.google.at','Enter the URL for Useful Link 6:<br>', @gid, 12, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 7 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_7_TEXT', 'Link 7', 'Enter the text for Useful Link 7:<br>', @gid, 13,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 7 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_7_URL', 'https://www.google.at','Enter the URL for Useful Link 7:<br>', @gid, 14, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 8 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_8_TEXT', 'Link 8', 'Enter the text for Useful Link 8:<br>', @gid, 15,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 8 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_8_URL', 'https://www.google.at','Enter the URL for Useful Link 8:<br>', @gid, 16, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 9 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_9_TEXT', 'Link 9', 'Enter the text for Useful Link 9:<br>', @gid, 17,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 9 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_9_URL', 'https://www.google.at','Enter the URL for Useful Link 9:<br>', @gid, 18, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 10 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_10_TEXT', 'Link 10', 'Enter the text for Useful Link 10:<br>', @gid, 19,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 10 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_10_URL', 'https://www.google.at','Enter the URL for Useful Link 10:<br>', @gid, 20, NOW(), NULL, 'zen_cfg_textarea(')
;");

##############################
# Add values for German admin
##############################

$db->Execute("INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Admin Layout', 'Einstellungen für das Admin Layout', '1', '1');");

$db->Execute("REPLACE INTO ".TABLE_CONFIGURATION_LANGUAGE." (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Nützlicher Link 1 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_1_TEXT', 'Geben Sie den Text für den Nützlichen Link 1 ein:<br>',	43),
('Nützlicher Link 1 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_1_URL', 'Geben Sie die URL für den Nützlichen Link 1 ein:<br>',	43),
('Nützlicher Link 2 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_2_TEXT', 'Geben Sie den Text für den Nützlichen Link 2 ein:<br>',	43),
('Nützlicher Link 2 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_2_URL', 'Geben Sie die URL für den Nützlichen Link 2 ein:<br>',	43),
('Nützlicher Link 3 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_3_TEXT', 'Geben Sie den Text für den Nützlichen Link 3 ein:<br>',	43),
('Nützlicher Link 3 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_3_URL', 'Geben Sie die URL für den Nützlichen Link 3 ein:<br>',	43),
('Nützlicher Link 4 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_4_TEXT', 'Geben Sie den Text für den Nützlichen Link 4 ein:<br>',	43),
('Nützlicher Link 4 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_4_URL', 'Geben Sie die URL für den Nützlichen Link 4 ein:<br>',	43),
('Nützlicher Link 5 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_5_TEXT', 'Geben Sie den Text für den Nützlichen Link 5 ein:<br>',	43),
('Nützlicher Link 5 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_5_URL', 'Geben Sie die URL für den Nützlichen Link 5 ein:<br>',	43),
('Nützlicher Link 6 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_6_TEXT', 'Geben Sie den Text für den Nützlichen Link 6 ein:<br>',	43),
('Nützlicher Link 6 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_6_URL', 'Geben Sie die URL für den Nützlichen Link 6 ein:<br>',	43),
('Nützlicher Link 7 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_7_TEXT', 'Geben Sie den Text für den Nützlichen Link 7 ein:<br>',	43),
('Nützlicher Link 7 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_7_URL', 'Geben Sie die URL für den Nützlichen Link 7 ein:<br>',	43),
('Nützlicher Link 8 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_8_TEXT', 'Geben Sie den Text für den Nützlichen Link 8 ein:<br>',	43),
('Nützlicher Link 8 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_8_URL', 'Geben Sie die URL für den Nützlichen Link 8 ein:<br>',	43),
('Nützlicher Link 9 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_9_TEXT', 'Geben Sie den Text für den Nützlichen Link 9 ein:<br>',	43),
('Nützlicher Link 9 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_9_URL', 'Geben Sie die URL für den Nützlichen Link 9 ein:<br>',	43),
('Nützlicher Link 10 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_10_TEXT', 'Geben Sie den Text für den Nützlichen Link 10 ein:<br>',	43),
('Nützlicher Link 10 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_10_URL', 'Geben Sie die URL für den Nützlichen Link 10 ein:<br>',	43)");

###################################
# Register for Admin Access Control
###################################

$db->Execute("INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configAdminLayout','BOX_CONFIGURATION_ADMIN_LAYOUT','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);");

$db->Execute("INSERT IGNORE INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('GermanHelpPage','GERMAN_HELP_PAGE','FILENAME_GERMAN_HELP','','extras','N',99);");


$messageStack->add('Admin Layout erfolgreich aktualisiert', 'success');

// -----
// German Translations Date
// 
//
$db->Execute("REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES 
('20240415', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Uebersetzungen', now(), now());");

// -----
// Version History aktualisieren
// 
//  
$db->Execute ("INSERT INTO ".TABLE_PROJECT_VERSION_HISTORY." (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM ".TABLE_PROJECT_VERSION.";");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7h', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7h', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';");
$db->Execute ("UPDATE ".TABLE_PROJECT_VERSION." SET project_version_major='1', project_version_minor='5.7', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.7->1.5.7h', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';");
// -----
// abschließende Erfolgsmeldung ausgeben
//
$messageStack->add('Aktualisierung auf 1.5.7h deutsch erfolgreich abgeschlossen.<br/><b>WICHTIG:<br/>Bevor Sie nun irgendwohin clicken, löschen Sie erst folgende Dateien vom Server:<br/>DEINADMIN/includes/auto_loaders/config.157h_update.php<br/>DEINADMIN/includes/init_includes/init_157h_update.php', 'success'); 
}