##########################################################################
# reCAPTCHA 1.2 Uninstall 1.5 - 2011-09-07 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

SET @t4=0;
SELECT (@t4:=configuration_group_id) as t4 
FROM configuration_group
WHERE configuration_group_title= 'reCAPTCHA';
DELETE FROM configuration WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @t4 AND configuration_group_id != 0;
DELETE FROM configuration_language WHERE configuration_key LIKE '%RECAPTCHA%';
DELETE FROM admin_pages WHERE page_key='configProdreCaptcha';