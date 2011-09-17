########################################################################
# Grundpreisanzeige 2.1  Uninstall - 2010-05-22 - webchills
# Nur ausführen, wenn Sie das Modul aus der Datenbank entfernen wollen!
########################################################################

ALTER TABLE `products` DROP COLUMN `products_base_unit_price`;
ALTER TABLE `products` DROP COLUMN `products_base_unit`;
DELETE FROM configuration WHERE configuration_key LIKE '%SHOW_BASE_UNIT_PRICE%';
DELETE FROM configuration_language WHERE configuration_key LIKE '%SHOW_BASE_UNIT_PRICE%';