##########################################################################
# Ultimate SEO URLs 2.108 Uninstall - 2010-09-22 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

DELETE FROM `configuration_group` WHERE `configuration_group_title` LIKE '%SEO%';
DELETE FROM `configuration` WHERE `configuration_key` LIKE '%SEO%';
DROP TABLE IF EXISTS seo_cache;