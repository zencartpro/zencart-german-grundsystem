##########################################################################
# Zen Lightbox 1.5.2 Uninstall - 2010-05-21 - webchills
# NUR AUDFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Zen Lightbox';
DELETE FROM configuration WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_language WHERE configuration_key LIKE '%ZEN_LIGHTBOX%';