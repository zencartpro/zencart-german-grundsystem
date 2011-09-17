ALTER TABLE `products` ADD `products_group_a_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_price` ,
ADD `products_group_b_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_a_price` ,
ADD `products_group_c_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_b_price` ,
ADD `products_group_d_price` DECIMAL( 15, 4 ) NOT NULL AFTER `products_group_c_price` ;
