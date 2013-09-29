#########################################################################################
# Stock by Attributes 1.6 Multilanguage Install Zen-Cart 1.5.1 - 2013-04-17 - webchills
#########################################################################################


##############################
# create new table
##############################

CREATE TABLE products_with_attributes_stock (
        stock_id INT NOT NULL AUTO_INCREMENT ,
        products_id INT NOT NULL ,
        stock_attributes VARCHAR( 255 ) NOT NULL ,
        quantity FLOAT NOT NULL ,
        sort INT NOT NULL ,
        PRIMARY KEY ( `stock_id` )
        );
        
##############################
# add configuration
##############################

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) 
VALUES ('Show available stock level in cart when less than order', 'STOCK_SHOW_LOW_IN_CART', 'false', 'When customer places more items in cart than are available, show the available amount on the shopping cart page:','9','6', NULL, now(), NULL, "zen_cfg_select_option(array('true', 'false'),"),
       ('Display Images in Admin', 'STOCK_SHOW_IMAGE', 'false', 'Display image thumbnails on Products With Attributes Stock page? (warning, setting this to true can severly slow the loading of this page):', '9', '6', NULL, now(), NULL, "zen_cfg_select_option(array('true', 'false'),");
       
##############################
# add values for German admin
##############################

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Stock by Attributes - verfügbaren Lagerbestand im Warenkorb anzeigen?', 'STOCK_SHOW_LOW_IN_CART', 'Wenn der Kunde mehr in den Warenkorb legt als im Lagerbestand verfügbar, soll dann im Warenkorb die verfügbare Menge angezeigt werden?',	43),
('Stock by Attributes - Bilder im Admin anzeigen?', 'STOCK_SHOW_IMAGE', 'Sollen in der Stock by Attributes Administration Thumbnails der Artikelbilder angezeigt werden?<br />Achtung: Wenn das aktiviert wird, kann sich die Ladezeit dieser Adminseite deutlich erhöhen!',	43);
