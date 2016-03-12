##########################################################################
# Paket Tracking 2.6 Uninstall - 2016-03-12- webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
# Entfernt auch Datenbankeinträge älterer Paket Tracking Versionen
##########################################################################

ALTER TABLE `orders_status_history` DROP COLUMN `track_id1`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_id2`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_id3`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_id4`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_id5`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_id6`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_day`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_month`;
ALTER TABLE `orders_status_history` DROP COLUMN `track_year`;

DELETE FROM configuration WHERE configuration_title LIKE '%PT -%';
DELETE FROM configuration WHERE configuration_title LIKE '%Package Tracking -%';
DELETE FROM configuration WHERE configuration_key = 'MAX_DISPLAY_PRODUCTS_IN_TRACK_ORDERS_BOX';
DELETE FROM configuration WHERE configuration_key = 'TY_TRACKER';
DELETE FROM configuration_language WHERE configuration_title LIKE '%PT -%';
DELETE FROM configuration_language WHERE configuration_title LIKE '%Paket Tracking -%';
DELETE FROM configuration_group WHERE configuration_group_title LIKE 'Package Tracker%';
DELETE FROM configuration_group WHERE configuration_group_title LIKE 'Paket Tracking%';
DELETE FROM configuration_group WHERE configuration_group_title LIKE 'Ty Package Tracker%';
DELETE FROM admin_pages WHERE page_key='configProdPaketTracking';