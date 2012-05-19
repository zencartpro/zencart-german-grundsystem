########################################################################
# Pinterest 1.2.1 UNINSTALL - 2012-04-29 - webchills
# Nur ausführen, wenn Sie das Modul aus der Datenbank entfernen wollen!
########################################################################

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'Pinterest Button';
DELETE FROM configuration WHERE configuration_group_id = @t4;
DELETE FROM configuration_group WHERE configuration_group_id = @t4;
DELETE FROM configuration_language WHERE configuration_key LIKE '%PINTEREST%';
DELETE FROM admin_pages WHERE page_key='configPinitbutton';