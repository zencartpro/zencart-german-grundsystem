CREATE TABLE products_with_attributes_stock (
        stock_id INT NOT NULL AUTO_INCREMENT ,
        products_id INT NOT NULL ,
        stock_attributes VARCHAR( 255 ) NOT NULL ,
        quantity FLOAT NOT NULL ,
        PRIMARY KEY ( `stock_id` )
        );

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, 
       configuration_description, configuration_group_id, sort_order, 
       last_modified, date_added, use_function, set_function) 
       VALUES ('Zeige Lagerbestand im Warenkorb an, wenn Bestellmenge zu hoch', 'STOCK_SHOW_LOW_IN_CART', 'false', 
               'Wenn der Kunde mehr Artikel in den Warenkorb legt als im Lager verfügbar sind, soll dann angezeigt werden, wieviel noch im Lager verfügbar ist?',
               '9',
               '6',
               NULL,
               now(),
               NULL,
               "zen_cfg_select_option(array('true', 'false'),"
       );