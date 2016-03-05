##################################################################################
# YouTube Video auf Artikeldetailseite 1.4 UNINSTALL - 2016-03-05 - webchills
# UNINSTALL - NUR AUSFÜHREN WENN SIE DIE ZUSATZFELDER ENTFERNEN WOLLEN!
##################################################################################

ALTER TABLE `products` DROP `products_youtube`;
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_YOUTUBE';
DELETE FROM product_type_layout_language WHERE configuration_key = 'SHOW_PRODUCT_INFO_YOUTUBE';