##########################################################################
# Ultimate SEO URLs 2.107 Uninstall - 2010-05-21 - webchills
# NUR AUSF�HREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

DELETE FROM `configuration_group` WHERE `configuration_group_title` LIKE '%SEO%';
DELETE FROM `configuration` WHERE `configuration_key` LIKE '%SEO%';
DROP TABLE IF EXISTS seo_cache;