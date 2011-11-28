###############################################################################################
# Bestellung ohne Kundenkonto (COWOA) 3.0 Multilanguage Install 1.5.0 - 2011-11-28 - webchills
###############################################################################################


##############################
# Change existing tables
##############################

ALTER TABLE customers ADD COWOA_account tinyint(1) NOT NULL default 0;
ALTER TABLE orders ADD COWOA_order tinyint(1) NOT NULL default 0;
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '', 'email,newsletters', 'Permanent Account Holders Only', 'Send email only to permanent account holders ', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS where COWOA_account != 1 order by customers_lastname, customers_firstname, customers_email_address');

##############################
# Set Split-Login-Page to true
##############################

UPDATE configuration SET configuration_value = 'True' WHERE configuration_title = 'Use split-login page';

##############################
# Add COWOA config
##############################


INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('COWOA', 'Configure Checkout Without an Account', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('COWOA - General', 'COWOA_STATUS', 'false', 'Activate COWOA Checkout? <br />Set to True to allow a customer to checkout without an account.', @gid, 10, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('COWOA - Enable Order Status', 'COWOA_ORDER_STATUS', 'false', 'Enable The Order Status Function of COWOA?<br />Set to True so that a Customer that uses COWOA will receive an E-Mail with instructions on how to view the status of their order.', @gid, 11, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
('Enable Forced Logoff', 'COWOA_LOGOFF', 'false', 'Enable The Forced LogOff Function of COWOA?<br />Set to True so that a Customer that uses COWOA will be logged off automatically after a sucessfull checkout. If they are getting a file download, then they will have to wait for the Status E-Mail to arrive in order to download the file.', @gid, 12, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');


##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'COWOA', 'Konfiguration von Bestellen ohne Kundenkonto', '1', '1');

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('COWOA - Allgemein', 'COWOA_STATUS', 'COWOA aktivieren?<br/>Stellen Sie auf True, wenn Sie Bestellung ohne Kundenkonto anbieten wollen.', 43),
('COWOA - Bestellstatus aktivieren', 'COWOA_ORDER_STATUS', 'Wollen Sie die Bestellstatus Funktionalität von COWOA aktivieren?<br/>Stellen Sie auf True, damit ein Kunde, der ohne Kundenkonto bestellt ein Mail mit Informationen bekommt, wie er den Status seiner Bestellung einsehen kann', 43),
('COWOA - Automatisches Ausloggen', 'COWOA_LOGOFF','Wollen Sie die automatische Logoff Funktion von COWOA aktivieren?<br/>Stellen Sie auf True, so dass ein Kunde der ohne Kundenkonto bestellt nach erfolgreicher Bestellung automatisch ausgeloggt wird. Falls der COWOA Kunde einen Download gekauft hat, kann er diesen dann erst mittels Link im Bestellstatusupdate-Email herunterladen.', 43);


###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configProdCowoa','BOX_CONFIGURATION_PRODUCT_COWOA','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);

