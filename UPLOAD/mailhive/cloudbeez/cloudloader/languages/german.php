<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2015 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */

if (!defined('MAILBEEZ_INSTALL_TITLE')) {
    define('MAILBEEZ_INSTALL_TITLE', 'CloudLoader');

    define('MAILBEEZ_INSTALL_SYSTEM_CHECK', 'System Test');
    define('MAILBEEZ_INSTALL_SYSTEM_CONFIRM', 'Einverstanden & Weiter');
    define('MAILBEEZ_INSTALL_CANCEL', 'Abbrechen');

    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_PHP', 'PHP Version 5.6 .. 8.1 wird unterstützt');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_SAFEMODE', 'Safe mode PHP Setting muss deaktiviert sein');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_CURL', 'cURL PHP Extension ist erforderlich');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_CONNECTION', 'Test Verbindung zum CloudBeez-Server aufbauen');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_CONNECTION_SPEED', 'Pr&uuml;fe Verbindungs-Geschwindigkeit');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_WRITE_PERM', 'Schreib-Rechte f&uuml;r das Installations-Verzeichnis');

    define('MAILBEEZ_INSTALL_INSTALL', 'Grund-Installation in Arbeit...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP1', 'Fordere Paket Informationen an...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP2', 'Lade Anwendungs-Dateien...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP3', 'Erstelle Backup...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP4', 'Untersuche Dateirechte...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP5', 'Entpacke Anwendungs-Dateien...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP6', 'Abschluss der Grund-Installation...');

    define('MAILBEEZ_INSTALL_INSTALL_FINISH', 'Grund-Installation erfolgreich abgeschlossen');

    define('MAILBEEZ_INSTALL_UPDATE', 'Aktualisierung des Grundsystems...');
    define('MAILBEEZ_INSTALL_UPDATE_FINISH', 'Aktualisierung des Grundsystems erfolgreich abgeschlossen');
    define('MAILBEEZ_INSTALL_UPDATE_STEP6', 'Abschluss der Systemaktualisierung...');

    define('MAILBEEZ_PACKAGE_INSTALL', 'Installation des Profi-Tarifs in Arbeit...');
    define('MAILBEEZ_PACKAGE_INSTALL_FINISH', 'Der Profi-Tarif wurde erfolgreich installiert');
    define('MAILBEEZ_PACKAGE_INSTALL_STEP6', 'Abschluss der Profi-Tarif Installation...');

    define('MAILBEEZ_PACKAGE_UPDATE', 'Aktualisierung des Profi-Tarifs...');
    define('MAILBEEZ_PACKAGE_UPDATE_FINISH', 'Der Profi-Tarif wurde erfolgreich aktualisiert');
    define('MAILBEEZ_PACKAGE_UPDATE_STEP6', 'Abschluss der Profi-Tarif Aktualisierung...');

    define('MAILBEEZ_INSTALL_ERROR_FILE_NOT_WRITEABLE', 'Insgesamt %s Datei(en) z.B. <small><ul><li>%s</ul></small> kann/k&ouml;nnen nicht aktualisiert werden - Bitte geben Sie dieser/diesen Datei(en) mit Hilfe eines FTP-Programmes Schreibrechte');
    define('MAILBEEZ_INSTALL_ERROR_DIR_NOT_CREATE', 'Das Verzeichnis %s konnte nicht erstellt werden - Bitte pruefen Sie Ihre Server-Konfiguration');
    define('MAILBEEZ_INSTALL_ERROR_BACKUP', 'Backup ist fehlgeschlagen');

    define('MAILBEEZ_INSTALL_BACKUP_LOCATION', 'Backup-Verzeichnis: %s');


    define('MAILBEEZ_INSTALL_PACKAGE_TITLE', 'W&auml;hlen Sie Ihren Profi Tarif');
}
