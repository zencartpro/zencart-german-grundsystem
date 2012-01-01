##################################################################################
# Spaltenlayout für Artikelliste - Multilanguage Install - 2012-01-01 - webchills
##################################################################################


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES 
('Product Listing - Layout Style', 'PRODUCT_LISTING_LAYOUT_STYLE', 'columns', 'Select the layout style:<br />Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)', '8', '40', NULL, now(), NULL, 'zen_cfg_select_option(array("rows", "columns"),'),
('Product Listing - Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 'Select the number of columns of products to show in each row in the product listing. The default setting is 3.', '8', '41', NULL, now(), NULL, NULL);
               
##############################
# Add values for German admin
##############################

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Artikelliste - Layout Stil', 'PRODUCT_LISTING_LAYOUT_STYLE', 'Wählen Sie das Layout Ihrer Artikelliste:<br/>Jeder Artikel kann in einer eigenen Zeile angezeigt werden (rows) oder die Artikel können nebeneinander in mehreren Spalten pro Reihe angezeigt werden (columns)', 43),
('Artikelliste - Spalten pro Reihe', 'PRODUCT_LISTING_COLUMNS_PER_ROW', 'Wieviele Spalten pro Reihe wollen Sie in der Artikelliste anzeigen. Voreinstellung: 3', 43);

