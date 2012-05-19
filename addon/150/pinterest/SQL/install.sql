#####################################################################
# Pinterest 1.2.1 Multilanguage Install - 2012-04-29 - webchills
#####################################################################

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
('Pinterest Button', 'Set Pinterest.com Pin-It Button Options', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES
('Version', 'PINTEREST_BUTTON_VERSION', '1.2.1', 'Version Installed:', @gid, 1, NOW(), NULL, NULL),
('Enable Pinterest Button', 'PINTEREST_BUTTON_STATUS', 'false', 'Enable the Pinterest.com Pin It Button?', @gid, 2, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), 
('Pinterest Button Count', 'PINTEREST_BUTTON_COUNT', 'none', 'Display the count horizontally, vertically, or disable (none)', @gid, 3, NOW(), NULL, 'zen_cfg_select_option(array(\'none\', \'vertical\', \'horizontal\'),'),
('Pinterest Method', 'PINTEREST_BUTTON_METHOD', 'basic', 'Use the basic method (for single pin-it buttons per page) or the advanced method (for multiple buttons - asynchronous):', @gid, 4, NOW(), NULL, 'zen_cfg_select_option(array(\'basic\', \'advanced\'),');

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Pinterest Button', 'Einstellungen für Pinterest Pin-It Button', '1', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Pinterest Version', 'PINTEREST_BUTTON_VERSION', 'Installierte Pinterest Button Version', 43),
('Pinterest Button aktivieren?', 'PINTEREST_BUTTON_STATUS', 'Wollen Sie den Pinterest Pin-It Button aktivieren?', 43),
('Pinterest Button Zähler', 'PINTEREST_BUTTON_COUNT', 'Soll der Zähler horizontal, vertikal oder gar nicht angezeigt werden?', 43),
('Pinterest Einbindungsart', 'PINTEREST_BUTTON_METHOD', 'Verwenden Sie die Art basic für einzelne Pin-It Buttons pro Seite oder die Art advanced für mehrfache Buttons', 43);

##############################
# Register for admin Access
##############################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('configPinitbutton','BOX_CONFIGURATION_PINITBUTTON','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);