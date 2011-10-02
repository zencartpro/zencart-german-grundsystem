##################################################################################
# UPDATE von Version 2.0 auf Version 3.0 - 2011-10-02 - webchills
##################################################################################

##############################################################################
# availability (Verfügbarkeit)
##############################################################################
ALTER TABLE products ADD products_availability ENUM( 'in stock', 'available for order', 'out of stock', 'preorder' ) NOT NULL DEFAULT 'in stock';

##############################################################################
# taxonomy
##############################################################################
ALTER TABLE `products` ADD `products_taxonomy` TEXT NOT NULL;



SET @gid=0;
SELECT @gid:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Google Merchant Center Deutschland';
SET @security_key = SUBSTR(MD5(RAND()),1,10);


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Enthaltene Hersteller', 'GOOGLE_MCDE_POS_MANUFACTURERS', '', 'Geben Sie die Hersteller IDs an, die enthalten sein sollen, durch Komma getrennt (z.B. 1,2,3)<br>Leer lassen, um alle Hersteller aufzunehmen (empfohlen)', @gid, 35, NOW(), NULL, NULL),
('Ausgeschlossene Hersteller', 'GOOGLE_MCDE_NEG_MANUFACTURERS', '', 'Geben Sie die Hersteller IDs an, die ausgeschlossen werden sollen durch Komma getrennt (z.B. 1,2,3)<br>Leer lassen, um alle Hersteller aufzunehmen (empfohlen)', @gid, 36, NOW(), NULL, NULL),
('Sicherheitsschlüssel', 'GOOGLE_MCDE_KEY', @security_key, 'Geben Sie eine zufällige Folge von Ziffern und Buchstaben ein, um sicherzustellen, dass nur der Admin das Produktfeed generieren kann.', @gid, 37, NOW(), NULL, NULL);

