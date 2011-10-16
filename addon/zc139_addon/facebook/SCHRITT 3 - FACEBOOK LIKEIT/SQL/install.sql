#########################################################################
# Facebook Like Button Multilanguage Install - 2011-09-07 - webchills
#########################################################################

SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Facebook Like Button'; 
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('Facebook Like Button', 'Set Facebook Like Button Options', '1', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();
SET @gid=last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable Facebook Like Button', 'FACEBOOK_LIKE_BUTTON_STATUS', 'true', 'Enable the Facebook Like Button?', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Method', 'FACEBOOK_LIKE_BUTTON_METHOD', 'XBFML', 'Use the iframe or XBFML method?', @gid, 2, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'iframe\', \'XBFML\'),'),
('Alignment', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT', 'none', 'Float the widget to the left, right, or none', @gid, 3, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'none\', \'left\', \'right\'),'),
('Layout Style', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 'standard', 'Select a layout style', @gid, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'standard\', \'button_count\', \'box_count\'),'),
('Show Faces', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES', 'false', 'Specifies whether to display profile photos below the button (if true, set height to 80 or more; standard layout only)', @gid, 5, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Action', 'FACEBOOK_LIKE_BUTTON_ACTION', 'like', 'The verb to display on the button', @gid, 6, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'like\', \'recommend\'),'),
('Font', 'FACEBOOK_LIKE_BUTTON_FONT', 'arial', 'The verb to display on the button', @gid, 7, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'arial\', \'lucida grande\', \'segoe ui\', \'tahoma\', \'trebuchet ms\', \'verdana\'),'),
('Color Scheme', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME', 'light', 'The color scheme for the like button', @gid, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'light\', \'dark\'),'),
('Width', 'FACEBOOK_LIKE_BUTTON_WIDTH', '450', 'The width of the like button (standard => 450; button_count => 90; box_count => 55)', @gid, 9, NOW(), NOW(), NULL, NULL);

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Facebook Like Button', 'Facebook Like Button Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Facebook Like Button aktivieren', 'FACEBOOK_LIKE_BUTTON_STATUS', 'Wollen Sie den Facebook Like Button aktivieren?', 43),
('Einbindungsart', 'FACEBOOK_LIKE_BUTTON_METHOD', 'iFrame oder XBFML', 43),
('Ausrichtung', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT','Soll der Button links, rechts oder gar nicht floaten?', 43),
('Layout Stil', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 'Wählen Sie ein Layout', 43),
('Profilfotos anzeigen', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES','Sollen unter dem Button Profilfotos angezeigt werden? Falls ja, stellen Sie die Höhe auf 80 oder mehr. Nur im Standardlayout möglich.', 43),
('Text des Buttons', 'FACEBOOK_LIKE_BUTTON_ACTION','Welchen Text soll der Button haben?', 43),
('Schriftart', 'FACEBOOK_LIKE_BUTTON_FONT','Schriftart im Button', 43),
('Farbschema', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME','Farbschema des Buttons', 43),
('Breite', 'FACEBOOK_LIKE_BUTTON_WIDTH','Breite des Buttons. Standard: 450<br/>Button mit Zähler: 90<br/>Box mit Zähler: 55', 43);