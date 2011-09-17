# remove Quick Updates setting 
#

#SELECT @quick_updates_id:=configuration_group_id
#FROM configuration_group WHERE configuration_group_title="Quick Updates";
#DELETE FROM configuration WHERE configuration_group_id=@quick_updates_id;
#DELETE FROM configuration_group WHERE configuration_group_id=@quick_updates_id;


SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Quick Updates';
DELETE FROM configuration WHERE configuration_group_id = @t4;
DELETE FROM configuration_group WHERE configuration_group_id = @t4;

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, 1, 'Quick Updates', 'Set Quick Updates Options', '1', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Quick Updates';

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
(NULL, 'Display the ID', 'QUICKUPDATES_DISPLAY_ID', 'true', 'Enable/Disable the products id displaying', @t4, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Display the thumbnail', 'QUICKUPDATES_DISPLAY_THUMBNAIL', 'true', 'Enable/Disable the products thumbnail displaying', @t4, 2, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the model', 'QUICKUPDATES_MODIFY_MODEL', 'true', 'Enable/Disable the products model displaying and modification', @t4, 3, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the name', 'QUICKUPDATES_MODIFY_NAME', 'true', 'Enable/Disable the products name editing', @t4, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the Description', 'QUICKUPDATES_MODIFY_DESCRIPTION', 'true', 'Enable/Disable the displaying and modification of products description', @t4, 5, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the status of the products', 'QUICKUPDATES_MODIFY_STATUS', 'true', 'Allow/Disallow the Status displaying and modification', @t4, 6, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the weight of the products', 'QUICKUPDATES_MODIFY_WEIGHT', 'true', 'Allow/Disallow the Weight displaying and modification?', @t4, 7, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the quantity of the products', 'QUICKUPDATES_MODIFY_QUANTITY', 'true', 'Allow/Disallow the quantity displaying and modification', @t4, 8, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the manufacturer of the products', 'QUICKUPDATES_MODIFY_MANUFACTURER', 'false', 'Allow/Disallow the Manufacturer displaying and modification', @t4, 9, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the class of tax of the products', 'QUICKUPDATES_MODIFY_TAX', 'false', 'Allow/Disallow the Class of tax displaying and modification', @t4, 10, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the category', 'QUICKUPDATES_MODIFY_CATEGORY', 'true', 'Enable/Disable the products category modify', @t4, 11, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Display price with all included of tax', 'QUICKUPDATES_DISPLAY_TVA_OVER', 'true', 'Enable/Disable the displaying of the Price with all tax included when your mouse is over a product', @t4, 20, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Display the link towards the products information page', 'QUICKUPDATES_DISPLAY_PREVIEW', 'false', 'Enable/Disable the display of the link towards the products information page ', @t4, 30, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Display the link towards the page where you will be able to edit the product', 'QUICKUPDATES_DISPLAY_EDIT', 'true', 'Enable/Disable the display of the link towards the page where you will be able to edit the product', @t4, 31, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Activate or disactivate the commercial margin', 'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 'true', 'Do you want that the commercial margin be activate or not ?', @t4, 40, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Modify the sort order', 'QUICKUPDATES_MODIFY_SORT_ORDER', 'true', 'Enable/Disable the products sort order modify', @t4, 11, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),'),
(NULL, 'Use popup edit', 'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 'true', 'Enable/Disable using popup edit link to description editing', @t4, 11, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),');


# Übersetzung für den deutschen Adminbereich
REPLACE INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES 
(@t4, 43, 'Quick Updates', 'Quick Updates Einstellungen', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Zeige Artikel ID', 'QUICKUPDATES_DISPLAY_ID', 43, 'Anzeige der Artikel ID an/aus', NOW(), NOW()),
('Zeige Artikelbild (Thumbnail)', 'QUICKUPDATES_DISPLAY_THUMBNAIL', 43, 'Anzeige des Artikelbilds (Thumbnail) an/aus', NOW(), NOW()),
('Artikelnummer editierbar', 'QUICKUPDATES_MODIFY_MODEL', 43, 'Die Artikelnummer wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Artikelname editierbar', 'QUICKUPDATES_MODIFY_NAME', 43, 'Der Artikelname wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Artikelbeschreibung editierbar', 'QUICKUPDATES_MODIFY_DESCRIPTION', 43, 'Die Artikelbeschreibung wird angezeigt und ist editierbar an/aus<br />Wenn die Einstellung "Nutze Popup Edit" aktiviert ist, dann wird anstelle der Beschreibung ein Button angezeigt, der bei Klick die Beschreibung in einem Popup Fester öffnet.', NOW(), NOW()),
('Artikelstatus editierbar', 'QUICKUPDATES_MODIFY_STATUS', 43, 'Der Artikelstatus wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Artikelgewicht editierbar', 'QUICKUPDATES_MODIFY_WEIGHT', 43, 'Das Artikelgewicht wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Lagerbestand editierbar', 'QUICKUPDATES_MODIFY_QUANTITY', 43, 'Der Lagerbestand wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Hersteller editierbar', 'QUICKUPDATES_MODIFY_MANUFACTURER', 43, 'Der Hersteller wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Steuerklasse editierbar', 'QUICKUPDATES_MODIFY_TAX', 43, 'Die Steuerklasse wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Kategorie editierbar', 'QUICKUPDATES_MODIFY_CATEGORY', 43, 'Die Kategorie wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Bruttopreis editierbar', 'QUICKUPDATES_DISPLAY_TVA_OVER', 43, 'Der Bruttopreis wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Link zur Artikelvorschau', 'QUICKUPDATES_DISPLAY_PREVIEW', 43, 'Anzeige eines Links zur Artikelvorschau an/aus', NOW(), NOW()),
('Link zur Artikelbearbeitung', 'QUICKUPDATES_DISPLAY_EDIT', 43, 'Anzeige eines Links zur "normalen" Artikelbearbeitung an/aus', NOW(), NOW()),
('Genereller Preisaufschlag', 'QUICKUPDATES_ACTIVATE_COMMERCIAL_MARGIN', 43, 'Sie können oberhalb der Artikelanzeige einen generellen Preisaufschlag eingeben (fixer Betrag oder Prozentwert) an/aus', NOW(), NOW()),
('Sortierung editierbar', 'QUICKUPDATES_MODIFY_SORT_ORDER', 43, 'Die Sortierung wird angezeigt und ist editierbar an/aus', NOW(), NOW()),
('Nutze Popup Edit', 'QUICKUPDATES_MODIFY_DESCRIPTION_POPUP', 43, 'Öffnet ein Popup Fenster zum Editieren der Artikelbeschreibung, sofern Sie oben als edititerbar eingestellt wurde an/aus', NOW(), NOW());
