# This SQL script upgrades the core Zen Cart database structure from v1.2.3 to v1.2.4
#
# $Id: mysql_upgrade_zencart_123_to_124.sql 1245 2005-04-25 18:09:16Z drbyte $
#
## CONFIGURATION TABLE
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Manufacturers List - Verify Product Exist', 'PRODUCTS_MANUFACTURERS_STATUS', '1', 'Verify that at least 1 product exists and is active for the manufacturer name to show<br /><br />Note: When this feature is ON it can produce slower results on sites with a large number of products and/or manufacturers<br />0= off 1= on', 3, 7, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Use Proportional Images on Products and Categories', 'PROPORTIONAL_IMAGES_STATUS', '1', 'Use Proportional Images on Products and Categories?<br /><br />NOTE: Do not use 0 height or width settings for Proportion Images<br />0= off 1= on', 4, 75, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Update Cart Button Location', 'SHOW_SHOPPING_CART_UPDATE', '3', 'Show on Shopping Cart Update Cart Button Location as:<br /><br />1= Next to each Qty Box<br />2= Below all Products<br />3= Both Next to each Qty Box and Below all Products<br /><br />Note: this setting controls which of 3 tpl_shopping_cart_default files are called', '9', '22', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Read Only option type - Ignore for Add to Cart', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', '1', 'When a Product only uses READONLY attributes, should the Add to Cart button be On or Off?<br />0= OFF<br />1= ON', '13', '37', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Also Purchased Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', '3', 'Also Purchased Products Columns per Row<br />0= off or set the sort order', '18', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
# r.l. german
INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('SMTP Dom&auml;ne', 'EMAIL_SMTPAUTH_SEND_DOMAIN', '43', 'Tragen Sie hier die SMTP Dom&auml;ne ein. In den meisten F&auml;llen lautet diese &auml;hnlich wie die Dom&auml;ne des Shops, jedoch ohne HTTP://<br />Wird nur ben&ouml;tigt, wenn eine SMTP Authentifizierung f&uuml;r das e-Mail Konto verwendet wird.', now(), now()),
('SMTP Benutzername', 'EMAIL_SMTPAUTH_MAILBOX', '43', 'Tragen Sie hier die den Benutzernamen f&uuml;r das SMTP Konto ein. (z.B. shop@ihredomain.at).<br />Wird nur ben&ouml;tigt, wenn eine SMTP Authentifizierung f&uuml;r das e-Mail Konto verwendet wird.', now(), now()),
('SMTP Passwort', 'EMAIL_SMTPAUTH_PASSWORD', '43', 'Tragen Sie hier die das Passwort f&uuml;r das SMTP Konto ein.<br />Wird nur ben&ouml;tigt, wenn eine SMTP Authentifizierung f&uuml;r das e-Mail Konto verwendet wird.', now(), now()),
('SMTP Server', 'EMAIL_SMTPAUTH_MAIL_SERVER', '43', 'Tragen Sie hier den DNS Namen des SMTP Servers ein.<br />z.B.: mail.ihredomain.at<br />oder 55.66.77.88<br />Wird nur ben&ouml;tigt, wenn eine SMTP Authentifizierung f&uuml;r das e-Mail Konto verwendet wird.', now(), now()),
('e-Mail Fehler: freundliche Fehlermeldungen', 'EMAIL_FRIENDLY_ERRORS', 43, 'Sollen bei e-Mail Fehlern freundliche Fehlermeldungen angezeigt werden? Wird diese Option auf false gesetzt, werden PHP Fehlermeldungen angezeigt. Bitte nur w&auml;hrend des Troubleshootings auf false setzen.', now(), now()),
('Bild - Proportionale Bilder f&uuml;r Artikel und Kategorien', 'PROPORTIONAL_IMAGES_STATUS', '43', 'Sollen Bilder f&uuml;r Artikel und Kategorien proportional verwendet werden?<br /><br />Hinweis: Ist dieses Feature auf ON eingestellt, darf f&uuml;r die H&ouml;he und Breite nicht 0 verwendet werden<br />0= aus 1= ein',  now(),  now()),
('Warenkorb anzeigen - Buttonposition', 'SHOW_SHOPPING_CART_UPDATE', 43, 'Zeige im Warenkorb den Aktualisierungsbutton:<br /><br />1= nach den St&uuml;ckzahlen<br />2= Unterhalb der Artikel<br />3= Beides: Nach den St&uuml;ckzahlen und unterhalb der Artikel<br /><br />Hinweis: Diese Einstellung kontrolliert, welches der 3 tpl_shopping_cart_default Dateien aufgerufen wird', now(), now()),
('Artikel mit NURLESEN Optionstypen - Hinzuf&uuml;gen zum Warenkorb anzeigen', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', 43,'Wenn ein Artikel nur NURLESEN-Attribute verwendet, soll der Button <em>zum Warenkorb hinzuf&uuml;gen</em> angezeigt werden?<br />0= Nein<br />1= Ja', now(),  now()),
('Herstellerliste - Artikelüberpr&uuml;fung', 'PRODUCTS_MANUFACTURERS_STATUS', 43, '&Uuml;berpr&uuml;ft, ob mindestens 1 aktiver Artikel f&uuml; den Herstellernamen exisiert<br /><br />Hinweis: Wenn dieses Feature auf ON eingestellt ist, kann es bei Seiten mit vielen Herstellern / Artikel zu Beeintr&auml;chtingungen der Geschwindigkeit kommen<br />0= aus 1= ein', now(), now()),
('Kunden, die ... gekauft haben, haben auch... - Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', 43,  'Kunden, die ... gekauft haben, haben auch... - Spalten pro Reihe<br />0= aus oder Sortierreihenfolge angeben', now(), now());

ALTER TABLE project_version_history DROP COLUMN project_version_ip_address;

# This step was missed in the 1.2.3 upgrade when it was first released.
ALTER TABLE paypal CHANGE COLUMN payment_date payment_date datetime NOT NULL default '0001-01-01 00:00:00';
ALTER TABLE paypal CHANGE COLUMN zen_order_id zen_order_id int(11) unsigned NOT NULL default '0';

###########################################################################################
################## THE FOLLOWING LINE LAYOUT IS IMPORTANT ... the SELECT and FROM and WHERE words must start the beginning of these lines

#The following deletes the duplicate EMAIL_TRANSPORT entries in the configuration table created by the 1.2.3 upgrade script:
#NEXT_X_ROWS_AS_ONE_COMMAND:5
SET @t1=0;
SELECT (@t1:=configuration_id) as t1 
FROM configuration 
WHERE configuration_key = 'EMAIL_TRANSPORT' limit 1;
DELETE FROM configuration where configuration_key = 'EMAIL_TRANSPORT' and configuration_id > @t1;

## The following deletes the duplicate MODULE_ORDER_TOTAL_COUPON_INC_TAX entry created by the 1.2.3 upgrade
#NEXT_X_ROWS_AS_ONE_COMMAND:5
SET @t1=0;
SELECT (@t1:=configuration_id) as t1 
FROM configuration 
WHERE configuration_key = 'MODULE_ORDER_TOTAL_COUPON_INC_TAX' limit 1;
DELETE FROM configuration where configuration_key = 'MODULE_ORDER_TOTAL_COUPON_INC_TAX' and configuration_id > @t1;

## The following deletes the duplicate MODULE_ORDER_TOTAL_GV_INC_TAX entry created by the 1.2.3 upgrade
#NEXT_X_ROWS_AS_ONE_COMMAND:5
SET @t1=0;
SELECT (@t1:=configuration_id) as t1 
FROM configuration 
WHERE configuration_key = 'MODULE_ORDER_TOTAL_GV_INC_TAX' limit 1;
DELETE FROM configuration where configuration_key = 'MODULE_ORDER_TOTAL_GV_INC_TAX' and configuration_id > @t1;

## The following deletes the duplicate SHOW_SHOPPING_CART_DELETE entry created by the 1.2.3 upgrade
#NEXT_X_ROWS_AS_ONE_COMMAND:5
SET @t1=0;
SELECT (@t1:=configuration_id) as t1 
FROM configuration 
WHERE configuration_key = 'SHOW_SHOPPING_CART_DELETE' limit 1;
DELETE FROM configuration where configuration_key = 'SHOW_SHOPPING_CART_DELETE' and configuration_id > @t1;

#############

#### VERSION UPDATE COMMANDS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version's info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='2.4', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.2.3->1.2.4', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='2.4', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.2.3->1.2.4', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';


#####  END OF UPGRADE SCRIPT
