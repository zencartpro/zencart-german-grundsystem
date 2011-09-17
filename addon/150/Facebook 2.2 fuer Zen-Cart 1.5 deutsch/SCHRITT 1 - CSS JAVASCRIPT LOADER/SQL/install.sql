##############################################################################
# CSS Javascript Loader Multilanguage Install for 1.5 - 2011-09-07 - webchills
##############################################################################

SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'CSS/JS Loader';
DELETE FROM configuration WHERE configuration_group_id = @gid;
DELETE FROM configuration_group WHERE configuration_group_id = @gid;
DELETE FROM admin_pages WHERE page_key='configProdCssJsLoader';

INSERT INTO configuration_group (`configuration_group_title`,`configuration_group_description`,`sort_order`,`visible`) VALUES ('CSS/JS Loader', 'Set CSS/JS Loader Options', '1', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

SET @gid=last_insert_id();

UPDATE configuration_group SET sort_order = @gid WHERE configuration_group_id = @gid;

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Enable Minify', 'MINIFY_STATUS', 'true', 'Minifying will speed up your site\'s loading speed by combining and compressing css/js files.', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Max URL Lenght', 'MINIFY_MAX_URL_LENGHT', '500', 'On some server the maximum lenght of any POST/GET request URL is limited. If this is the case for your server, you can change the setting here', @gid, 2, NOW(), NOW(), NULL, NULL),
('Minify Cache Time', 'MINIFY_CACHE_TIME_LENGHT', '31536000', 'Set minify cache time (in second). Default is 1 year (31536000)', @gid, 3, NOW(), NOW(), NULL, NULL),
('Latest Cache Time', 'MINIFY_CACHE_TIME_LATEST', '0', 'Normally you don\'t have to set this, but if you have just made changes to your js/css files and want to make sure they are reloaded right away, you can reset this to 0.', @gid, 4, NOW(), NOW(), NULL, NULL);


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'CSS/JS Loader', 'CSS/JS Loader Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Minify aktivieren', 'MINIFY_STATUS', 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien und Javascripts werden kombiniert und komprimiert.', 43),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', 43),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT','Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', 43),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Änderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Änderungen sofort wirksam sind, stellen Sie auf 0.', 43);


###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdCssJsLoader','BOX_CONFIGURATION_PRODUCT_CSSJSLOADER','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);