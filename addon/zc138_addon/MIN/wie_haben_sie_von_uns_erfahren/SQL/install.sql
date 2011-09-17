########################################################################
# Wie haben Sie von uns erfahren 2.0  
# Multilanguage Install - 2010-08-13 - webchills
########################################################################

DROP TABLE IF EXISTS sources;
CREATE TABLE sources (
  sources_id int NOT NULL auto_increment,
  sources_name varchar(64) NOT NULL,
  PRIMARY KEY (sources_id),
  KEY IDX_SOURCES_NAME (sources_name)
);

INSERT INTO sources VALUES (1, 'Google');
INSERT INTO sources VALUES (2, 'Yahoo!');
INSERT INTO sources VALUES (3, 'Facebook');
INSERT INTO sources VALUES (4, 'Twitter');
INSERT INTO sources VALUES (5, 'eBay');
INSERT INTO sources VALUES (6, 'Friends');

DROP TABLE IF EXISTS sources_other;
CREATE TABLE sources_other (
  customers_id int NOT NULL default '0',
  sources_other_name varchar(64) NOT NULL,
  PRIMARY KEY (customers_id)
);

ALTER TABLE customers_info ADD customers_info_source_id int NOT NULL AFTER customers_info_date_account_last_modified;


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display "Other" Referral option', 'DISPLAY_REFERRAL_OTHER', 'true', 'Display "Other - please specify" with text box in referral source in account creation', '1', '22', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Require Referral', 'REFERRAL_REQUIRED', 'false', 'Require the Referral Source in account creation', '5', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Zeige die Option "Andere" bei Wie haben Sie von uns erfahren?', 'DISPLAY_REFERRAL_OTHER', 'Soll die Option "Andere - bitte genauer beschreiben" mit einem Freitextfeld bei "Wie haben Sie von uns erfahren" bei der Registrierung angezeigt werden?', 43),
('Wie haben Sie von uns erfahren als Pflichtfeld?', 'REFERRAL_REQUIRED', 'Soll die Abfrage "Wie haben Sie von uns erfahren" ein Pflichfeld bei der Registrierung sein?', 43);