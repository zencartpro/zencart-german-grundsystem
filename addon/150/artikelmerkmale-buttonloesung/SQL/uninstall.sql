##################################################################################
# Buttonlösung 2.0 - Uninstall - 2012-08-05 - webchills
# !!!!!UNINSTALL - NUR AUSFÜHREN WENN SIE DAS MODUL ENTFERNEN WOLLEN!!!!!
##################################################################################

ALTER TABLE `products_description` DROP `products_merkmale`;
DELETE FROM configuration WHERE configuration_key = 'ENABLE_BUTTONLOESUNG';
DELETE FROM configuration WHERE configuration_key = 'EU_COUNTRIES_FOR_LAST_STEP';
DELETE FROM configuration_language WHERE configuration_key = 'ENABLE_BUTTONLOESUNG';
DELETE FROM configuration_language WHERE configuration_key = 'EU_COUNTRIES_FOR_LAST_STEP';