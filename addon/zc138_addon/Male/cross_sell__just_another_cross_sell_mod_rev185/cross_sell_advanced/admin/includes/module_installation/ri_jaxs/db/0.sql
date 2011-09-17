## Cross Sell v1.3.0
#
## The following is used to install the Cross-Sell Products mapping table and the admin switches for display control in the catalog.
## This script should be able to be run from Admin->Tools->Install SQL Patches
#

#DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
  ID int(10) NOT NULL auto_increment,
  products_id int(10) unsigned NOT NULL default 1,
  xsell_id int(10) unsigned NOT NULL default 1,
  sort_order int(10) unsigned NOT NULL default 1,
  PRIMARY KEY  (ID), 
  KEY idx_products_id_xsell (products_id)
) TYPE=MyISAM;


## add switches for:  MIN_DISPLAY_XSELL, MAX_DISPLAY_XSELL
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Cross-Sell Products', 'MIN_DISPLAY_XSELL', 1, 'This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1', 2, 17, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Cross-Sell Products', 'MAX_DISPLAY_XSELL', 6, 'This is the maximum number of configured Cross-Sell products to be displayed.<br />Default: 6', 3, 66, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cross-Sell Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', '3', 'Cross-Sell Products Columns to display per Row<br />0= off or set the sort order.<br />Default: 3', 18, 72, 'zen_cfg_select_option(array(0, 1, 2, 3, 4), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cross-Sell - Display prices?', 'XSELL_DISPLAY_PRICE', 'false', 'Cross-Sell -- Do you want to display the product prices too?<br />Default: false', 18, 72, 'zen_cfg_select_option(array(\'true\',\'false\'), ', now());


## For upgraders, you may want to add the additional index for marginal speed improvements:
# ALTER TABLE products_xsell ADD INDEX idx_products_id_xsell (products_id);
# INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cross-Sell - Display prices?', 'XSELL_DISPLAY_PRICE', 'false', 'Cross-Sell -- Do you want to display the product prices too?<br />Default: false', 18, 72, 'zen_cfg_select_option(array(\'true\',\'false\'), ', now());
