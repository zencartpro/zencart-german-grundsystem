##################################################################################
# Artikelmerkmale für Buttonlösung - 2012-07-05 - webchills
##################################################################################

ALTER TABLE `products_description` ADD `products_merkmale` VARCHAR( 128 ) NOT NULL DEFAULT '';


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Use additional product description in checkout confirmation', 'ENABLE_BUTTONLOESUNG', 'true', 'Do you want to enable the additional product description on the checkout confirmation page ("Buttonlösung" in Germany)?', '1', '999', NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');


INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description) VALUES
('Artikelmerkmale für Buttonlösung aktivieren', 'ENABLE_BUTTONLOESUNG', '43', 'Wollen Sie die zusätzlichen Artikelmerkmale auf der Seite Bestellung bestätigen aktivieren ("Buttonlösung" in Deutschland)? Wenn Sie hier auf true stellen, dann erscheint beim Artikel bearbeiten ein zusätzliches Feld für die Eingabe der wesentlichen Merkmale des Artikels. Der dort hinterlegte Text wird dann auf der Seite Bestellung bestätigen unterhalb des Artikelnamens angezeigt.');