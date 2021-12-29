<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2021-12-27 15:39:16Z webchills $
 */

// define the locations of the mysql utilities.  Typical location is in '/usr/bin/' ... but not on Windows servers.
// try 'c:/mysql/bin/mysql.exe' and 'c:/mysql/bin/mysqldump.exe' on Windows hosts ... change drive letter and path as needed
define('LOCAL_EXE_MYSQL',     '/usr/bin/mysql');  // used for restores
define('LOCAL_EXE_MYSQLDUMP', '/usr/bin/mysqldump');  // used for backups

// the following are the language definitions

define('HEADING_TITLE', 'Datenbank Backup Manager - MySQL');
define('WARNING_NOT_SECURE_FOR_DOWNLOADS','<span class="errorText">HINWEIS: SSL ist nicht aktiviert. Alle Dateien, die Sie downloaden sind nicht verschlüsselt. Sie können alle Backup Funktionen uneingeschränkt nutzen - die Verwendung dieses Tools ohne gesicherte SSL Verbindung stellt jedoch ein erhebliches Sicherheitsrisiko dar.');
define('TABLE_HEADING_TITLE', 'Titel');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Grösse');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neue Sicherung');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokal wiederherstellen');
define('TEXT_INFO_NEW_BACKUP', 'Der Sicherungsprozess kann mehrere Minuten in Anspruch nehmen - bitte keinesfalls unterbrechen.');
define('TEXT_INFO_UNPACK', '<br><br>(nach dem Entpacken der Datei aus dem Archiv)');
define('TEXT_INFO_RESTORE', 'Bitte den Prozess für die Wiederherstellung keinesfalls unterbrechen.<br><br>Je grösser die Sicherung ist, desto länger benötigt dieser Prozess!<br><br>Wenn möglich, verwenden Sie einen MySQL Client.<br><br>Beispiel:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Bitte den Prozess für die Wiederherstellung keinesfalls unterbrechen.<br><br>Je grösser die Sicherung ist, desto länger benötigt dieser Prozess!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Die hoch zuladende Datei muss ein raw sql (Text) Format sein.');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Grösse:');
define('TEXT_INFO_COMPRESSION', 'Kompression:');
define('TEXT_INFO_USE_GZIP', 'GZIP verwenden');
define('TEXT_INFO_USE_ZIP', 'ZIP verwenden');
define('TEXT_INFO_SKIP_LOCKS', 'Skip Lock Option (Ankreuzen, falls Sie einen LOCK TABLES Berechtigungsfehler bekommen)');
define('TEXT_INFO_USE_NO_COMPRESSION', 'keine Kompression (Reine SQL Datei)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download ohne Speicherung am Server');
define('TEXT_INFO_BEST_THROUGH_HTTPS', '(Sicherer über eine gesicherte HTTPS Verbindung)');
define('TEXT_DELETE_INTRO', 'Wollen Sie diese Sicherung wirklich löschen?');
define('TEXT_NO_EXTENSION', 'keine');
define('TEXT_BACKUP_DIRECTORY', 'Sicherungsverzeichnis:');
define('TEXT_LAST_RESTORATION', 'Letzte Wiederherstellung:');
define('TEXT_FORGET', '(vergessen)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'FEHLER: das Verzeichnis für die Sicherung existiert nicht. Bitte beheben Sie den FEHLER in Ihrer configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'FEHLER: In das Verzeichnis für die Sicherung kann nicht geschrieben werden.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'FEHLER: Der Download Link ist nicht korrekt.');
define('ERROR_CANT_BACKUP_IN_SAFE_MODE','FEHLER: Dieses Tool funktioniert nicht, wenn der safe_mode aktiv ist oder eine open_basedir restriction.<br />Falls Sie während des Backups keine FEHLERmeldung bekommen, überprüfen Sie die Dateigröße der Sicherung. Ist diese unter 200 KB, ist die Datei vermutlich nicht brauchbar!');
define('ERROR_EXEC_DISABLED','FEHLER: Auf Ihrem Server ist "exec()" deaktiviert. Dieses Tool kann so nicht verwendet werden. Wenden Sie sich an Ihren Provider für eine Aktivierung von PHP exec().');

define('SUCCESS_LAST_RESTORE_CLEARED', 'ERFOLGREICH: Das letzte Wiederherstellungsdatum wurde gelöscht.');
define('SUCCESS_DATABASE_SAVED', 'ERFOLGREICH: Die Datenbank wurde gesichert.');
define('SUCCESS_DATABASE_RESTORED', 'ERFOLGREICH: Die Datenbank wurde wiederhergestellt.');
define('SUCCESS_BACKUP_DELETED', 'ERFOLGREICH: Die Sicherung wurde entfernt.');
define('FAILURE_DATABASE_NOT_SAVED', 'FEHLER: Die Datenbank wurde NICHT gesichert.');
define('FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', 'FEHLER: Das MYSQLDUMP Sicherungsutility konnte nicht lokalisiert werden. SICHERUNG GESCHEITERT.');
define('FAILURE_DATABASE_NOT_RESTORED', 'FEHLER: Die Datenbank wurde eventuell NICHT richtig wiederhergestellt. Bitte überprüfen Sie die Wiederherstellung.');
define('FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', 'FEHLER: Die Datenbank wurde NICHT wiederhergestellt.  FEHLER: DIE DATEI %s KONNTE NICHT GEFUNDEN WERDEN');
define('FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', 'FEHLER: das MYSQL Wiederherstellungsutility konnte nicht lokalisiert werden. WIEDERHERSTELLUNG GESCHEITERT.');
define('FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS','Die Sicherung ist fehlgeschlagen, da das Backup Tool nicht gestartet werden konnte (mysqldump oder mysqldump.exe).<br />Auf einem WindowsServer müssen Sie die Berechtigungen der cmd.exe so setzen, dass der Internet Guest Account lesen und schreiben darf.<br />Auf einem Linux Server wednen Sie sich bitte an Ihren Provider um zu klären, warum exec() Befehle fehlschlagen.');

