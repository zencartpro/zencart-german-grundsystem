DELETE FROM `zen_products` WHERE products_id>124;
DELETE FROM `zen_products_to_categories` WHERE products_id>124;
DELETE FROM `zen_products_description` WHERE products_id>124;
DELETE FROM `zen_products_to_categories` WHERE products_id>124;

DELETE FROM zen_categories WHERE categories_id > 1054;
DELETE FROM zen_categories_description WHERE categories_id > 1054;
