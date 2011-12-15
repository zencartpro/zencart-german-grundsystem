##################################################################################
# EAN Feld 1.1 Uninstall - 2011-12-15 - webchills
# UNINSTALL - NUR AUSFÜHREN WENN SIE DAS EAN MODUL ENTFERNEN WOLLEN!
##################################################################################

ALTER TABLE `products` DROP `products_ean`;

DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_EAN';

DELETE FROM product_type_layout_language WHERE configuration_key = 'SHOW_PRODUCT_INFO_EAN';