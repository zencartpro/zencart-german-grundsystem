##########################################################################
# RSS Feed 2.1.4 Uninstall - 2010-07-25 - webchills
# NUR AUSF�HREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) FROM configuration_group WHERE configuration_group_title= 'RSS Feed' LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration WHERE configuration_key = 'RSS_FEED_VERSION';
DELETE FROM configuration_language WHERE configuration_key LIKE '%RSS Feed%';