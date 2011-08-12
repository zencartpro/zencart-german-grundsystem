<?php
/**
 *
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: backup.php 2011-08-12 19:14:43Z webchills $
 */


// define the locations of the mysql utilities.  Typical location is in '/usr/bin/' ... but not on Windows servers.
// try 'c:/mysql/bin/mysql.exe' and 'c:/mysql/bin/mysqldump.exe' on Windows hosts ... change drive letter and path as needed
define('LOCAL_EXE_MYSQL',     '/usr/bin/mysql');  // used for restores
define('LOCAL_EXE_MYSQLDUMP', '/usr/bin/mysqldump');  // used for backups

define('HEADING_TITLE', 'Datenbank Backup Manager');
define('WARNING_NOT_SECURE_FOR_DOWNLOADS','<span class="errorText">HINWEIS: Sie haben kein SSL aktiv. Alle Downloads von dieser Seite werden NICHT verschlüsselt. Sicherungen und Wiederherstellungen werden problemlos funktionieren, allerdings stellt das Nichtverwenden von SSL ein Sicherheitsrisiko dar.');
define('TABLE_HEADING_TITLE', 'Titel');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Größe');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neue Sicherung');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokal wiederherstellen');
define('TEXT_INFO_NEW_BACKUP', 'Der Sicherungsprozess kann mehrere Minuten in Anspruch nehmen - bitte keinesfalls unterbrechen.');
define('TEXT_INFO_UNPACK', '<br/><br/>(nach dem Entpacken der Datei aus dem Archiv)');
define('TEXT_INFO_RESTORE', 'Bitte den Prozess für die Wiederherstellung keinesfalls unterbrechen.<br><br>Je größer die Sicherung ist, desto länger benötigt dieser Prozess!<br><br>Wenn möglich, verwenden Sie einen MySQL Client.<br><br>Beispiel:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Bitte den Prozess für die Wiederherstellung keinesfalls unterbrechen.<br><br>Je größer die Sicherung ist, desto länger benötigt dieser Prozess!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Die hochzuladende Datei muss ein raw sql (Text) Format sein.');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Größe:');
define('TEXT_INFO_COMPRESSION', 'Kompression:');
define('TEXT_INFO_USE_GZIP', 'GZIP verwenden');
define('TEXT_INFO_USE_ZIP', 'ZIP verwenden');
define('TEXT_INFO_SKIP_LOCKS', 'Skip Lock Option (Ankreuzen falls Sie einen LOCK TABLES permissions error bekommen)');
define('TEXT_INFO_USE_NO_COMPRESSION', 'keine Kompression (Reine SQL Datei)');


define('TEXT_INFO_DOWNLOAD_ONLY', 'Download ohne Speicherung auf Server');
define('TEXT_INFO_BEST_THROUGH_HTTPS', '(Sicherer über eine gesicherte HTTPS Verbindung)');
define('TEXT_DELETE_INTRO', 'Wollen Sie diese Sicherung wirklich löschen?');
define('TEXT_NO_EXTENSION', 'keine');
define('TEXT_BACKUP_DIRECTORY', 'Sicherungsverzeichnis:');
define('TEXT_LAST_RESTORATION', 'Letzte Wiederherstellung:');
define('TEXT_FORGET', '(vergessen)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: das Verzeichnis für die Sicherung existiert nicht. Bitte beheben Sie den Fehler in Ihrer configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Fehler: In das Verzeichnis für die Sicherung kann nicht geschrieben werden.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Fehler: Der Download Link ist nicht akzeptabel.');
define('ERROR_CANT_BACKUP_IN_SAFE_MODE','FEHLER: This backup script seldom works when safe_mode is enabled or open_basedir restrictions are in effect.<br />If you get no errors doing a backup, check to see whether the file is less than 200kb. If so, then the backup is likely unreliable.');
define('ERROR_EXEC_DISABLED','ERROR: Your server\'s "exec()" command has been disabled. This script cannot run. Ask your host if they are willing to re-enable PHP exec().');
define('ERROR_FILE_NOT_REMOVEABLE', 'Error: Could not remove the file specified. You may have to use FTP to remove the file, due to a server-permissions configuration limitation.');


define('SUCCESS_LAST_RESTORE_CLEARED', 'Erfolgreich: Das letzte Wiederherstellungsdatum wurde gelöscht.');
define('SUCCESS_DATABASE_SAVED', 'Erfolgreich: Die Datenbank wurde gesichert.');
define('SUCCESS_DATABASE_RESTORED', 'Erfolgreich: Die Datenbank wurde wiederhergestellt.');
define('SUCCESS_BACKUP_DELETED', 'Erfolgreich: Die Sicherung wurde entfernt.');

define('FAILURE_DATABASE_NOT_SAVED', 'Fehlgeschlagen: The database has NOT been saved.');
define('FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', 'FEHLER: Konnte das MYSQLDUMP Backup Tool nicht finden. BACKUP FEHLGESCHLAGEN.');
define('FAILURE_DATABASE_NOT_RESTORED', 'Fehlgeschlagen: Die Datenbank ist möglicherweise nicht korrekt wiederhergestellt worden. Bitte genauestens prüfen.');
define('FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', 'Fehlgeschlagen: Die Dstenbank wurde NICHT wiederhergestellt.  ERROR: DATEI NICHT GEFUNDEN: %s');
define('FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', 'FEHLER: Konnte das MYSQLDUMP Backup Tool nicht finden. WIEDERHERSTELLUNG FEHLGESCHLAGEN.');
define('FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS','Das Backup ist fehlgeschlagen weil das Backupprogramm nicht gestartet werden konnte (mysqldump or mysqldump.exe).<br />If running on Windows 2003 server, you may need to alter permissions on cmd.exe to allow Special Access to the Internet Guest Account to read/execute.<br />You should talk to your webhost about why exec() commands are failing when attempting to run the mysqldump binary/program.');