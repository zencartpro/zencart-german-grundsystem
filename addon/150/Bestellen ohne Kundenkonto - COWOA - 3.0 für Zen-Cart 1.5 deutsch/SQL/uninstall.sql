#############################################################################################
# Bestellung ohne Kundenkonto (COWOA) 3.0 Uninstall 1.5 - 2011-09-17 - webchills
# NUR AUSFÜHREN FALLS SIE DAS MODUL VOLLSTÄNDIG ENTFERNEN WOLLEN!!!
#############################################################################################

ALTER TABLE customers DROP COWOA_account;
ALTER TABLE orders DROP COWOA_order;
DELETE FROM query_builder WHERE query_name = 'Permanent Account Holders Only';
DELETE FROM configuration_group WHERE configuration_group_title = 'COWOA';
DELETE FROM configuration_group WHERE configuration_group_description = 'Konfiguration von Bestellen ohne Kundenkonto';
DELETE FROM configuration WHERE configuration_key = 'COWOA_STATUS';
DELETE FROM configuration WHERE configuration_key = 'COWOA_ORDER_STATUS';
DELETE FROM configuration WHERE configuration_key = 'COWOA_LOGOFF';
DELETE FROM configuration_language WHERE configuration_key = 'COWOA_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'COWOA_ORDER_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'COWOA_LOGOFF';
UPDATE configuration SET configuration_value = 'False' WHERE configuration_title = 'Use split-login page';
DELETE FROM admin_pages WHERE page_key='configProdCowoa';