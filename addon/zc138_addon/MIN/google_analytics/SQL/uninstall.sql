##########################################################################
# Google Analytics 1.3 Uninstall - 2008-12-30 - webchills
# NUR AUDFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Google Analytics Configuration';
DELETE FROM configuration WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DROP TABLE IF EXISTS google_analytics_languages;
DELETE FROM configuration_language WHERE configuration_key LIKE '%GOOGLE_ANALYTICS%';
