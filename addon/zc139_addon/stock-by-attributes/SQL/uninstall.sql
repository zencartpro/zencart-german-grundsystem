###########################################################################
# Stock by Attributes 1.4.13 - UNINSTALL - 2011-04-16 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
###########################################################################


##############################
# delete config settings
##############################

DELETE FROM configuration WHERE configuration_key IN ('STOCK_SHOW_LOW_IN_CART','STOCK_SHOW_IMAGE');
DELETE FROM configuration_language WHERE configuration_key IN ('STOCK_SHOW_LOW_IN_CART','STOCK_SHOW_IMAGE');


##############################
# delete pwa table
##############################

DROP TABLE IF EXISTS products_with_attributes_stock;      
