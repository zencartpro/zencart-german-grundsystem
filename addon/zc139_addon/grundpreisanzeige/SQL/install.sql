########################################################################
# Grundpreisanzeige 2.1  Install - 2010-05-22 - webchills
########################################################################

ALTER TABLE `products` ADD `products_base_unit_price` DECIMAL( 15, 2 ) AFTER `products_price`;
ALTER TABLE `products` ADD `products_base_unit` VARCHAR( 12 ) AFTER `products_base_unit_price`;

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Show Base Unit Price', 'SHOW_BASE_UNIT_PRICE', '0', 'Do you want to show the base unit price<br />0= off<br />1 = everywhere : product listing, all products, new products, product info<br />2 = Only on product info page', 19, 50, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Everywhere\'), array(\'id\'=>\'2\', \'text\'=>\'Product info only\')),
');

INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES ('Grundpreisanzeige', 'SHOW_BASE_UNIT_PRICE', '43', 'Wollen Sie den Grundpreis anzeigen?<br />0 = Nein<br />1 = auf allen Seiten (Artikelliste, Alle Artikel, Neue Artikel, Artikeldetailseite)<br />2 = Nur auf der Artikeldetailseite
', now(), now());