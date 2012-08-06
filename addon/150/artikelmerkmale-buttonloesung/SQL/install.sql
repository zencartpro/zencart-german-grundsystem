##################################################################################
# Buttonlösung 2.0 - 2012-08-05 - webchills
##################################################################################

ALTER TABLE `products_description` ADD `products_merkmale` VARCHAR( 128 ) NOT NULL DEFAULT '';


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Use additional product description in checkout confirmation', 'ENABLE_BUTTONLOESUNG', 'true', 'Do you want to enable the additional product description on the checkout confirmation page ("Buttonlösung" in Germany)?', '1', '999', NULL, now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');


INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description) VALUES
('Buttonlösung aktivieren', 'ENABLE_BUTTONLOESUNG', '43', 'Wollen Sie die zusätzlichen Artikelmerkmale und sonstigen Änderungen auf der Seite Bestellung bestätigen aktivieren ("Buttonlösung" in Deutschland)? Wenn Sie hier auf true stellen, dann erscheint beim Artikel bearbeiten ein zusätzliches Feld für die Eingabe der wesentlichen Merkmale des Artikels. Der dort hinterlegte Text wird dann auf der Seite Bestellung bestätigen unterhalb des Artikelnamens angezeigt. Weiterhin erscheinen auf der Seite Bestellung bestätigen zusätzliche Spalten für den Einzelpreis und das Artikelbild. Und bei Versand in Nicht-EU Staaten wird ein Hinweis auf die Zollgebühren eingeblendet.');



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('EU Countries', 'EU_COUNTRIES_FOR_LAST_STEP', 'BE,BG,DK,DE,EE,FI,FR,GR,IE,IT,LV,LT,LU,MT,NL,AT,PL,PT,RO,SE,SK,SI,ES,CZ,HU,GB,CY', 'Enter the countries which are part of the European Union. Two digit ISO codes, comma separated.', '1', '100', now(), now(), NULL, NULL);


INSERT INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('EU Länder', 'EU_COUNTRIES_FOR_LAST_STEP', 'Tragen Sie hier die Mitgliedsstaaten der Europäischen Union ein. Wenn an Länder geliefert wird, die nicht in dieser Liste stehen, dann erscheint im letzten Schritt des Bestellvorgangs ein Hinweis auf mögliche Zollgebühren. Zweistellige ISO Codes mit Komma getrennt.','43');
