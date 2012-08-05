<?php
define('HEADING_TITLE', 'Newsletter Manager');
define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_EMAIL', 'E-Mail Adresse');
define('TABLE_HEADING_PREFERENCE', 'senden als');
define('TABLE_HEADING_SUBSCRIPTION_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie die E-Mail löschen wollen?');
define('TEXT_INFO_HEADING_NEW_SUBSCRIPTION' , 'Neue Abonnementen');
define('TEXT_INFO_HEADING_EDIT_SUBSCRIPTION' , 'Abonnenten bearbeiten');
define('TEXT_INFO_EDIT_INTRO' , 'Führen Sie hier bitte die notwendigen Änderungen durch');
define('TEXT_INFO_INSERT_INTRO' , 'Hier eingetragene E-Mail Adressen werden automatisch bestätigt.');
define('TEXT_INFO_CLASS_TITLE' , 'E-Mail Adresse');
define('TEXT_INFO_CONFIRMED' , 'Bestätigt:');
define('TEXT_INFO_HEADING_DELETE_EMAIL' , 'E-Mail löschen');
define('TEXT_PURGE_SUBSCRIPTIONS' , 'Löschen Sie unbestätigte Abonnements älter als 90 Tage');

define('TEXT_INFO_HEADING_IMPORT_SUBSCRIPTION','Abonnenten importieren');
define('TEXT_INFO_IMPORT_INTRO','E-Mail Adressen von einer Datei auf Ihrem Computer importieren. Für beste Ergebnisse,importieren Sie zuerst eine kleine Testdatei.');
define('TEXT_INFO_IMPORT_FILE','zu importierende Datei:');
define('TEXT_INFO_IMPORT_ENCL','Wenn Felder durch Anführungszeichen oder andere Zeichen eingeschlossen werden, hier eingeben:');
define('TEXT_INFO_IMPORT_DELIM','Felder getrennt durch (| , \s \t etc):');
define('TEXT_INFO_IMPORT_HEADER_ROW','Überprüfen ob die erste Zeile eine Kopfzeile ist.');
define('TEXT_INFO_IMPORT_FORMAT','E-Mail Format:');
define('TEXT_INFO_IMPORT_SAMPLE',
'Geben Sie ein Beispiel ein, verwenden Sie \'format\' für das E-Mail Format Feld und \'email\' für die Email Adresse.<br />
Verwenden Sie NULL, um anzuzeigende Felder nicht zu importieren.<br />
Trennen Sie die Felder mit einem einfachen Abstand.');


define('TEXT_INFO_SUBSCRIPTIONS_IMPORTED', 'Erfolgreich importierte Adressen: %s');
define('TEXT_INFO_SUBSCRIPTIONS_PURGED', 'Abonnements bereinigt.');
define('TEXT_SUBSCRIPTION_STATUS_CUSTOMER' , 'Kunde');
define('TEXT_SUBSCRIPTION_STATUS_CONFIRMED' , 'Newsletter Abonnent');
define('TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED' , 'Offene Bestätigung');

define('TEXT_SUBSCRIPTION_DATE', 'Abonnement Datum');
define('TEXT_INFO_SUBSCRIPTION_STATUS_UNCONFIRMED','Diese E-Mail Adresse hat das Abonnement nicht bestätigt.<br />Newsletter wird ohne Bestätigung nicht versendet.');

define('NEWSONLY_SUBSCRIPTION_NOT_INSTALLED', 'WARNUNG: Das Newsletter ohne Kundenkonto Modul ist noch nicht installiert worden.');
define('NEWSONLY_SUBSCRIPTION_NOT_ENABLED', 'WARNUNG: Das Newsletter ohne Kundenkonto Modul ist nicht aktiv. Nicht alle Funktionen arbeiten. Sie können das unter Konfiguration -> Mein Shop ändern .');
define('TEXT_INSTALL', 'Installieren');
define('TEXT_REMOVE', 'Entfernen');
define('TEXT_NEWSONLY_REMOVE_CONFIRM','<b>WARNUNG: Dies entfernt nicht nur alle Einstellungen dieses Moduls sondern auch alle reinen Newsletter Abonnenten ohne Kundenkonto!!!<br/>Weiter?<br/><a href="%s">Ja</a>&nbsp;&nbsp;<a href="%s">Nein</a>');