##################################################################################
# YouTube Video auf Artikeldetailseite 1.4 INSTALL - 2016-03-05 - webchills
##################################################################################

ALTER TABLE `products` ADD `products_youtube` VARCHAR( 15 ) NOT NULL;

INSERT INTO `product_type_layout` (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `product_type_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
('Show YouTube', 'SHOW_PRODUCT_INFO_YOUTUBE', '1', 'Display YouTube Video on Product Info 0= off 1= on', 1, NULL, NOW(), NOW(), NULL, 'zen_cfg_select_drop_down(array(array(''id''=>''1'', ''text''=>''True''), array(''id''=>''0'', ''text''=>''False'')), ');

INSERT INTO `product_type_layout_language` (`configuration_title`, `configuration_key`, `languages_id`, `configuration_description`, `last_modified`, `date_added`) VALUES
('YouTube Video anzeigen', 'SHOW_PRODUCT_INFO_YOUTUBE', 43, 'Soll das YouTube Video falls hinterlegt auf der Produktinfoseite angezeigt werden?<br/> 0= AUS 1= AN', NOW(), NOW());
