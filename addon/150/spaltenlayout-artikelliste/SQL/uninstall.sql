###########################################################################
# Spaltenlayout für Artikelliste - UNINSTALL - 2012-01-01 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
###########################################################################

DELETE FROM configuration WHERE configuration_key IN ('PRODUCT_LISTING_LAYOUT_STYLE','PRODUCT_LISTING_COLUMNS_PER_ROW');
DELETE FROM configuration_language WHERE configuration_key IN ('PRODUCT_LISTING_LAYOUT_STYLE','PRODUCT_LISTING_COLUMNS_PER_ROW');
