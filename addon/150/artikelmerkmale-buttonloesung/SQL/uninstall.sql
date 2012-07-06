##################################################################################
# Artikelmerkmale für Buttonlösung - Uninstall - 2012-07-05 - webchills
# !!!!!UNINSTALL - NUR AUSFÜHREN WENN SIE DAS MODUL ENTFERNEN WOLLEN!!!!!
##################################################################################

ALTER TABLE `products_description` DROP `products_merkmale`;

DELETE FROM configuration WHERE configuration_key = 'ENABLE_BUTTONLOESUNG';

DELETE FROM configuration_language WHERE configuration_key = 'ENABLE_BUTTONLOESUNG';