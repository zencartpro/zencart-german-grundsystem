######################################################################
# Facebook Open Graph UNINSTALL - 2011-09-07 - webchills
# Nur ausführen, wenn Sie das Modul aus der Datenbank entfernen wollen!
######################################################################

SET @configuration_group_id=0;
SELECT @configuration_group_id:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'Facebook Open Graph'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_language WHERE configuration_key LIKE '%FACEBOOK_OPEN_GRAPH%';