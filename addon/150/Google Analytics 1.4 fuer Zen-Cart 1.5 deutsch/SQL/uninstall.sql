##########################################################################
# Google Analytics 1.4 Uninstall 1.5 - 2011-09-17 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Google Analytics';
DELETE FROM configuration WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DROP TABLE IF EXISTS google_analytics_languages;
DELETE FROM configuration_language WHERE configuration_key LIKE '%GOOGLE_ANALYTICS%';
DELETE FROM admin_pages WHERE page_key='configProdGoogleAnalytics';