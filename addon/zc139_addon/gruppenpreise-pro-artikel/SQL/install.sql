#####################################################################
# Gruppenpreise pro Artikel 2.1 Install - 2010-09-24 - webchills
#####################################################################


ALTER TABLE `products` ADD `products_group_a_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_price` ,
ADD `products_group_b_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_a_price` ,
ADD `products_group_c_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_b_price` ,
ADD `products_group_d_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_c_price` ;

ALTER TABLE `specials` ADD `specials_new_products_group_a_price` DECIMAL( 15, 4 ) NOT NULL AFTER `specials_new_products_price` ,
ADD `specials_new_products_group_b_price` DECIMAL( 15, 4 ) NOT NULL AFTER `specials_new_products_group_a_price` ,
ADD `specials_new_products_group_c_price` DECIMAL( 15, 4 ) NOT NULL AFTER `specials_new_products_group_b_price` ,
ADD `specials_new_products_group_d_price` DECIMAL( 15, 4 ) NOT NULL AFTER `specials_new_products_group_c_price` ;
