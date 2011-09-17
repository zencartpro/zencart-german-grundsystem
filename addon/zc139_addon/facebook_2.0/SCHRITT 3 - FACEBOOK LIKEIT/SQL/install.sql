######################################################################
# Facebook Like Button Multilanguage Install - 2011-05-19 - webchills
######################################################################

SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) 
FROM configuration_group 
WHERE configuration_group_title= 'Facebook Like Button' 
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND @configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND @configuration_group_id != 0;

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, 'Facebook Like Button', 'Set Facebook Like Button Options', '1', '1');
SET @configuration_group_id=last_insert_id();
UPDATE configuration_group SET sort_order = @configuration_group_id WHERE configuration_group_id = @configuration_group_id;

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
(NULL, 'Enable Facebook Like Button', 'FACEBOOK_LIKE_BUTTON_STATUS', 'true', 'Enable the Facebook Like Button?', @configuration_group_id, 10, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Method', 'FACEBOOK_LIKE_BUTTON_METHOD', 'iframe', 'Use the iframe or XBFML method?', @configuration_group_id, 20, NOW(), NULL, 'zen_cfg_select_option(array(\'iframe\', \'XBFML\'),'),
(NULL, 'Alignment', 'FACEBOOK_LIKE_BUTTON_ALIGNMENT', 'none', 'Float the widget to the left, right, or none', @configuration_group_id, 40, NOW(), NULL, 'zen_cfg_select_option(array(\'none\', \'left\', \'right\'),'),
(NULL, 'Layout Style', 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE', 'standard', 'Select a layout style', @configuration_group_id, 50, NOW(), NULL, 'zen_cfg_select_option(array(\'standard\', \'button_count\', \'box_count\'),'),
(NULL, 'Show Faces', 'FACEBOOK_LIKE_BUTTON_SHOW_FACES', 'false', 'Specifies whether to display profile photos below the button (if true, set height to 80 or more; standard layout only)', @configuration_group_id, 60, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
(NULL, 'Action', 'FACEBOOK_LIKE_BUTTON_ACTION', 'like', 'The verb to display on the button', @configuration_group_id, 70, NOW(), NULL, 'zen_cfg_select_option(array(\'like\', \'recommend\'),'),
(NULL, 'Font', 'FACEBOOK_LIKE_BUTTON_FONT', 'arial', 'The verb to display on the button', @configuration_group_id, 80, NOW(), NULL, 'zen_cfg_select_option(array(\'arial\', \'lucida grande\', \'segoe ui\', \'tahoma\', \'trebuchet ms\', \'verdana\'),'),
(NULL, 'Color Scheme', 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME', 'light', 'The color scheme for the like button', @configuration_group_id, 90, NOW(), NULL, 'zen_cfg_select_option(array(\'light\', \'dark\'),'),
(NULL, 'Width', 'FACEBOOK_LIKE_BUTTON_WIDTH', '450', 'The width of the like button (standard => 450; button_count => 90; box_count => 55)', @configuration_group_id, 100, NOW(), NULL, NULL);

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@configuration_group_id, 43, 'Facebook Like Button', 'Facebook Like Button Einstellungen', '1', '1');

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
