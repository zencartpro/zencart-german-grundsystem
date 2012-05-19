##########################################################################
# Gruppenpreise pro Artikel 2.4 Uninstall - 2012-05-19 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

ALTER TABLE `products` DROP COLUMN `products_group_d_price`;
ALTER TABLE `products` DROP COLUMN `products_group_c_price`;
ALTER TABLE `products` DROP COLUMN `products_group_b_price`;
ALTER TABLE `products` DROP COLUMN `products_group_a_price`;

ALTER TABLE `specials` DROP COLUMN `specials_new_products_group_d_price`;
ALTER TABLE `specials` DROP COLUMN `specials_new_products_group_c_price`;
ALTER TABLE `specials` DROP COLUMN `specials_new_products_group_b_price`;
ALTER TABLE `specials` DROP COLUMN `specials_new_products_group_a_price`;