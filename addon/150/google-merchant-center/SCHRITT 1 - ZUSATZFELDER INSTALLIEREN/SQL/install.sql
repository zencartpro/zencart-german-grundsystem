##################################################################################
# Zusatzfelder für Google Merchant Center Deutschland 3.1 - 2011-12-16 - webchills
##################################################################################

##############################################################################
# ean
##############################################################################
ALTER TABLE `products` ADD `products_ean` VARCHAR( 13 ) NOT NULL;

INSERT INTO `product_type_layout` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `product_type_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(NULL, 'Show EAN Number', 'SHOW_PRODUCT_INFO_EAN', '0', 'Display EAN Number on Product Info 0= off 1= on', 1, NULL, NOW(), NOW(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''1'', ''text''=>''True''), array(''id''=>''0'', ''text''=>''False'')), ');

INSERT INTO `product_type_layout_language` (`configuration_id`, `configuration_title`, `configuration_key`, `languages_id`, `configuration_description`, `last_modified`, `date_added`) VALUES
(NULL, 'EAN anzeigen', 'SHOW_PRODUCT_INFO_EAN', 43, 'Soll die EAN auf der Produktinfoseite angezeigt werden?<br/> 0= AUS 1= AN', NOW(), NOW());

##############################################################################
# isbn
##############################################################################
ALTER TABLE `products` ADD `products_isbn` VARCHAR( 13 ) NOT NULL;

INSERT INTO `product_type_layout` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `product_type_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(NULL, 'Show ISBN Number', 'SHOW_PRODUCT_INFO_ISBN', '0', 'Display ISBN Number on Product Info 0= off 1= on', 1, NULL, NOW(), NOW(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''1'', ''text''=>''True''), array(''id''=>''0'', ''text''=>''False'')), ');

INSERT INTO `product_type_layout_language` (`configuration_id`, `configuration_title`, `configuration_key`, `languages_id`, `configuration_description`, `last_modified`, `date_added`) VALUES
(NULL, 'ISBN anzeigen', 'SHOW_PRODUCT_INFO_ISBN', 43, 'Soll die ISBN auf der Produktinfoseite angezeigt werden?<br/> 0= AUS 1= AN', NOW(), NOW());

##############################################################################
# condition (Zustand)
##############################################################################
ALTER TABLE products ADD products_condition ENUM( 'new', 'used', 'refurbished' ) NOT NULL DEFAULT 'new';

##############################################################################
# availability (Verfügbarkeit)
##############################################################################
ALTER TABLE products ADD products_availability ENUM( 'in stock', 'available for order', 'out of stock', 'preorder' ) NOT NULL DEFAULT 'in stock';


##############################################################################
# brand (=Marke)
##############################################################################
ALTER TABLE `products` ADD `products_brand` VARCHAR( 32 ) NOT NULL;

##############################################################################
# taxonomy
##############################################################################
ALTER TABLE `products` ADD `products_taxonomy` VARCHAR( 512 )  NOT NULL;

INSERT INTO `product_type_layout` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `product_type_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(NULL, 'Show Brand', 'SHOW_PRODUCT_INFO_BRAND', '0', 'Display Brand on Product Info 0= off 1= on', 1, NULL, NOW(), NOW(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''1'', ''text''=>''True''), array(''id''=>''0'', ''text''=>''False'')), ');

INSERT INTO `product_type_layout_language` (`configuration_id`, `configuration_title`, `configuration_key`, `languages_id`, `configuration_description`, `last_modified`, `date_added`) VALUES
(NULL, 'Marke anzeigen', 'SHOW_PRODUCT_INFO_BRAND', 43, 'Soll die Marke auf der Produktinfoseite angezeigt werden?<br/> 0= AUS 1= AN', NOW(), NOW());