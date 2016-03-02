##########################################################################
# Zen Colorbox 2.3 UNINSTALL - 2016-03-02 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
##########################################################################

DELETE FROM configuration WHERE configuration_key LIKE 'ZEN_COLORBOX_%';
DELETE FROM configuration_group WHERE configuration_group_title = 'Zen Colorbox';
DELETE FROM configuration_language WHERE configuration_key LIKE '%ZEN_COLORBOX%';
DELETE FROM admin_pages WHERE language_key = 'BOX_CONFIGURATION_ZEN_COLORBOX';