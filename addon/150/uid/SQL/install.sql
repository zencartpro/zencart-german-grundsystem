################################################################################
# UID 2.0 Install Zen-Cart 1.5 - 2011-12-17 - webchills
################################################################################


INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('UID', 'Configure UID settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 

('Check the UID number', 'ENTRY_TVA_INTRACOM_CHECK', 'true', 'Check the Customers UID number by the europa.eu.int server<br /><b>Default: true</b>', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(''true'', ''false''), '),
('UID number of the store', 'TVA_SHOP_INTRACOM', 'XXXXXXXX', 'Enter your own UID number', @gid, 2, NOW(), NOW(), NULL, NULL),
('Minimum characters for the UID number', 'ENTRY_TVA_INTRACOM_MIN_LENGTH', '10', 'Required characters for VAT number<br/>Set to 0 if you dont want checking.', @gid, 3, NOW(), NOW(), NULL, NULL);


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'UID', 'UID Einstellungen', '1', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('UID Nummer überprüfen', 'ENTRY_TVA_INTRACOM_CHECK', '<br />Soll die UID Nummer am europa.eu.int server überprüft werden<br /><br /><b>Voreinstellung: true</b><br />',	43),
('UID Nummer des Shops', 'TVA_SHOP_INTRACOM', '<br />Geben Sie hier Ihre eigene UID Nummer ein<br />',	43),
('UID Nummer - Minimale Länge', 'ENTRY_TVA_INTRACOM_MIN_LENGTH', '<br />Erforderliche Zeichenlänge für die UID-Nummer<br/>Stellen Sie auf 0, wenn die Nummer nicht überprüft werden soll<br />',	43);


####################################
# add uid fields to existing tables
###################################

ALTER TABLE address_book ADD entry_tva_intracom VARCHAR(32) DEFAULT NULL AFTER entry_company;
ALTER TABLE orders ADD billing_tva_intracom VARCHAR(32) AFTER billing_company;

###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdUID','BOX_CONFIGURATION_PRODUCT_UID','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);
