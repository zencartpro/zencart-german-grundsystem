########################################################################
# Wie haben Sie von uns erfahren 2.0  UNINSTALL - 2010-08-13 - webchills
# !!! Nur ausführen, wenn Sie das Modul vollständig entfernen wollen !!!
########################################################################

DROP TABLE IF EXISTS sources;
DROP TABLE IF EXISTS sources_other;
ALTER TABLE `customers_info` DROP COLUMN `customers_info_source_id`;
DELETE FROM configuration WHERE configuration_key LIKE '%DISPLAY_REFERRAL_OTHER%';
DELETE FROM configuration_language WHERE configuration_key LIKE '%DISPLAY_REFERRAL_OTHER%';
DELETE FROM configuration WHERE configuration_key LIKE '%REFERRAL_REQUIRED%';
DELETE FROM configuration_language WHERE configuration_key LIKE '%REFERRAL_REQUIRED%';