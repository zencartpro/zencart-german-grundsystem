SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Cross Sell';

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('', 'XSell Product Input Separator', 'XSELL_PRODUCT_INPUT_SEPARATOR', ',', 'You will need to insert all product id/model you want to cross-sell in 1 field, so each product id/model needs to be separated by a separator. The default is comma, choose another if you want to', @t4, 1, NOW(), NOW(), NULL, NULL);

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('', 'XSell Sort Order', 'XSELL_SORT_ORDER', 'sort_order', 'Sometimes you may want to display the xsell products randomly, especially if each product xsells with lots of others', @t4, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\'sort_order\', \'random\'),');