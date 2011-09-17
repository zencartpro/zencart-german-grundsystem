#####################################################################
# Master Passwort Multilanguage Install - 2011-05-16 - webchills
#####################################################################

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Master Password', 'MASTER_PASS', 'yourpassword', 'This password will allow you to login to any customer\'s account.', 1, 23, now(), now(), NULL, NULL);

##############################
# Add values for German admin
##############################

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Master Passwort', 'MASTER_PASS', 'Mit diesem Passwort können Sie in jeden Kundenaccount einloggen.',	43);