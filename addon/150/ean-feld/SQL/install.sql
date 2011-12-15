##################################################################################
# EAN Feld 1.1 Multilanguage Install - 2011-12-15 - webchills
##################################################################################

ALTER TABLE `products` ADD `products_ean` VARCHAR( 13 ) NOT NULL;

INSERT INTO `product_type_layout` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `product_type_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(NULL, 'Show EAN Number', 'SHOW_PRODUCT_INFO_EAN', '1', 'Display EAN Number on Product Info 0= off 1= on', 1, NULL, NOW(), NOW(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''1'', ''text''=>''True''), array(''id''=>''0'', ''text''=>''False'')), ');


INSERT INTO `product_type_layout_language` (`configuration_id`, `configuration_title`, `configuration_key`, `languages_id`, `configuration_description`, `last_modified`, `date_added`) VALUES
(NULL, 'EAN anzeigen', 'SHOW_PRODUCT_INFO_EAN', 43, 'Soll die EAN auf der Produktinfoseite angezeigt werden?<br/> 0= AUS 1= AN', NOW(), NOW());