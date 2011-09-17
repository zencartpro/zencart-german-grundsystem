###########################################################################
# Master Passwort - UNINSTALL - 2011-05-16 - webchills
# NUR AUSFÜHREN WENN SIE DAS MODUL AUS DER DATENBANK ENTFERNEN WOLLEN!!!!!
###########################################################################

DELETE FROM configuration WHERE configuration_key LIKE ('MASTER_PASS');
DELETE FROM configuration_language WHERE configuration_key LIKE ('MASTER_PASS');