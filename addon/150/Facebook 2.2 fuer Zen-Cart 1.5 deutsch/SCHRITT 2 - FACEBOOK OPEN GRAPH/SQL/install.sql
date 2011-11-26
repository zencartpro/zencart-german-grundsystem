########################################################################
# Facebook Open Graph Multilanguage Install 1.5 - 2011-09-07 - webchills
########################################################################


INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('Facebook Open Graph', 'Set Facebook Open Graph Options', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable Facebook Open Graph', 'FACEBOOK_OPEN_GRAPH_STATUS', 'true', 'Enable Facebook Open Graph meta data?', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Application ID', 'FACEBOOK_OPEN_GRAPH_APPID', '', 'Please enter your application ID (<a href="http://developers.facebook.com/setup/" target="_blank">Get an application ID</a>)', @gid, 2, NOW(), NOW(), NULL, NULL),
('Application Secret', 'FACEBOOK_OPEN_GRAPH_APPSECRET', '', 'Please enter your application secret', @gid, 3, NOW(), NOW(), NULL, NULL),
('Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', '', 'Enter the Admin ID(s) of the Facebook user(s) that administer your Facebook fan page separated by commas (<a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>)', @gid, 4, NOW(), NOW(), NULL, NULL),
('Default Image', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', '', 'Enter the full path to your default image or leave blank to disable.  The default image is only used when the product image cannot be found.', @gid, 5, NOW(), NOW(), NULL, NULL),
('Type', 'FACEBOOK_OPEN_GRAPH_TYPE', '', 'Enter an Open Graph type for your products (<a href="http://developers.facebook.com/docs/opengraph#types" target="_blank">Open Graph Types</a>)', @gid, 6, NOW(), NOW(), NULL, NULL);


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Facebook Open Graph', 'Facebook Open Graph Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Facebook Open Graph aktivieren', 'FACEBOOK_OPEN_GRAPH_STATUS', 'Wollen Sie die Facebook Open Graph Metadaten aktivieren?', 43),
('Anwendungsnummer', 'FACEBOOK_OPEN_GRAPH_APPID', 'Tragen Sie hier Ihre Anwendungsnummer / Application ID ein. Falls Sie noch keine haben:<br/><a href="http://developers.facebook.com/setup/" target="_blank">Application ID beantragen</a>', 43),
('Anwendungs Geheimcode', 'FACEBOOK_OPEN_GRAPH_APPSECRET','Tragen Sie Ihren Anwendungs Geheimcode / Application Secret Key ein.', 43),
('Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', 'Geben Sie die Admin ID(s) des oder der Facebook User an, die Ihre Facebook Fanseite administrieren. Wenn das mehrere sind, geben Sie die IDs mit Komma getrennt ein. Infos dazu:<br/><a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>', 43),
('Default Bild', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE','Geben Sie den vollen Pfad zu einem Defaultbild an oder lassen Sie dieses Feld leer, um kein Defaultbild zu verwenden. Ein hier eingestelltes Defaultbild wird nur verwendet, wenn kein Artikelbild gefunden wird.', 43),
('Typ', 'FACEBOOK_OPEN_GRAPH_TYPE','Geben Sie hier einen Open Graph Typ für Ihre Artikel ein. Beispiel: product<br/>Infos dazu:<br/><a href="http://developers.facebook.com/docs/opengraph#types" target="_blank">Open Graph Types</a>', 43);


###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdFacebookOpenGraph','BOX_CONFIGURATION_PRODUCT_OPENGRAPH','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);