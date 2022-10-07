<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2022-10-07 08:50:16Z webchills $
 */

define('HEADING_TITLE', 'MySQL Datenbank Backup/Wiederherstellung');
define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Backup Verzeichnis<br>"'.DIR_FS_BACKUP.'"<br>existiert nicht (Slash Richtung hat keine Bedeutung).<br>Bitte prüfen Sie die configure.php im Adminverzeichnis (oder /local/configure.php falls verwendet).');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Fehler: Backup Verzeichnis ist nicht beschreibbar.');
define('ERROR_CANT_BACKUP_IN_SAFE_MODE','FEHLER: Dieses Backup-Skript funktioniert nur selten, wenn safe_mode aktiviert ist oder open_basedir-Beschränkungen gelten.<br>Wenn Sie bei der Sicherung keine Fehler erhalten, prüfen Sie, ob die Datei weniger als 200kb groß ist. Wenn ja, dann ist die Sicherung wahrscheinlich unzuverlässig.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Fehler: Download Link nicht korrekt.');
define('ERROR_EXEC_DISABLED','ERROR: Das "exec()" Kommando auf diesem Server ist deaktiviert. Dieses Script kann nicht ausgeführt werden. Wenden Sie sich an Ihren Provider, um PHP exec() aktivieren zu lassen.');
define('ERROR_SHELL_EXEC_DISABLED','Der Pfad zu mysql kann nicht erkannt werden, da die "shell_exec()" Funktion deaktiviert ist. Ermittle Pfade anhand der im Script hardcodierten Einträge...');
define('ERROR_NOT_FOUND', 'nicht gefunden');
define('ERROR_PHP_DISABLED_FUNCTIONS', 'Deaktivierte PHP Funktionen: ');
define('FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS','Die Sicherung ist fehlgeschlagen, weil beim Starten des Sicherungsprogramms (mysqldump oder mysqldump.exe) ein Fehler aufgetreten ist.<br>Wenn Sie auf einem Windows 2003-Server arbeiten, müssen Sie möglicherweise die Berechtigungen für cmd.exe ändern, um dem Internet-Gastkonto einen speziellen Zugriff zum Lesen/Ausführen zu ermöglichen.<br>Sie sollten mit Ihrem Provider darüber sprechen, warum exec()-Befehle fehlschlagen, wenn Sie versuchen, das mysqldump-Binary/Programm auszuführen.');
define('FAILURE_DATABASE_NOT_RESTORED', 'Fehler: Die Datenbank wurde möglicherweise NICHT richtig wiederhergestellt. Bitte überprüfen Sie sie sorgfältig.');
define('FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', 'Fehler: Die Datenbank wurde NICHT wiederherhestellt.  FEHLER: DATEI NICHT GEFUNDEN: %s. Beachten Sie dass komprimierte Dateien folgendermaßen benannt sein müssen: *.sql.gz oder *.sql.zip.');
define('FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', 'FEHLER: Konnte das MYSQL Restore Utility nicht finden. WIEDERHERSTELLUNG FEHLGESCHLAGEN.');
define('FAILURE_DATABASE_NOT_SAVED', 'Fehler: Die Datenbank wurde NICHT gesichert.');
define('FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', 'FEHLER: Konnte das MYSQLDUMP Backup Utility nicht finden. BACKUP FEHLGESCHLAGEN.');
define('SUCCESS_BACKUP_DELETED', 'Erfolg: Das Backup wurde entfernt.');
define('SUCCESS_DATABASE_RESTORED', 'Erfolg: Die Datenbank wurde wiederhergestellt.');
define('SUCCESS_DATABASE_SAVED', 'Erfolg: Die Datenbank wurde gesichert.');
define('SUCCESS_LAST_RESTORE_CLEARED', 'Erfolg: Die letzte Wiederherstellung wurde entfernt.');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Größe');
define('TABLE_HEADING_TITLE', 'Titel');
define('TEXT_ADD_SUFFIX', 'Hier können Sie ein optionales Suffix an den Dateinamen anhängen (nur Ascii Zeichen):');
define('TEXT_BACKUP_DIRECTORY', 'Backup Verzeichnis:');
define('TEXT_CHECK_PATH', 'Prüfe Pfad: ');
define('TEXT_COMMAND', 'Kommando: ');
define('TEXT_COMMAND_RUN', '<br>Das auszuführende Kommando ist: ');
define('TEXT_DEBUG_ON', 'Backup MySQL <strong>Debug ON</strong>');
define('TEXT_DELETE_INTRO', 'Wollen Sie dieses Backup wirklich löschen?');
define('TEXT_EXECUTABLES_FOUND', 'MySQL Tools gefunden:');
define('TEXT_EXECUTABLES_NOT_FOUND', 'MySQL Tools (mysql, mysqldump) nicht gefunden.');
define('TEXT_FIX_CACHE_KEY', 'Führen Sie fix_cache_key.php aus');
define('TEXT_FORGET', '(vergessen)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Dies ist sicherer wenn der Upload über eine gesicherte HTTPS Verbindung erfolgt.');
define('TEXT_INFO_COMPRESSION', 'Kompression:');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download ohne Speicherung am Server');
define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neues Backup');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokale Wiederherstellung');
define('TEXT_INFO_NEW_BACKUP', '<b>Unterbrechen Sie den Sicherungsprozess nicht</b>, er kann einige Minuten dauern.');
define('TEXT_INFO_RESTORE', '<b>Unterbrechen Sie den Wiederherstellungsprozess nicht.</b>.<br><br>Je größer die Backupdatei ist, desto länger wird die Wiederherstellung dauern!<br><br>Falls möglich verwenden Sie den mysql client.<br><br>Beispiel:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', '<b>Unterbrechen Sie den Wiederherstellungsprozess nicht.</b><br>Je größer die Backupdatei ist, desto länger wird die Wiederherstellung dauern!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Die hochgeladene Datei muss eine einfache Textdatei mit sql-Abfragen sein und die Erweiterung ".sql" haben.');
define('TEXT_INFO_SIZE', 'Größe:');
define('TEXT_INFO_SKIP_LOCKS', 'Skip Lock Option (Ankreuzen, wenn Sie einen LOCK TABLES Berechtigungsfehler bekommen)');
define('TEXT_INFO_UNPACK', '<br><br>(nach Entpacken der Datei aus dem Archiv)');
define('TEXT_INFO_USE_GZIP', 'GZIP verwenden');
define('TEXT_INFO_USE_NO_COMPRESSION', 'keine Kompression (reines SQL)');
define('TEXT_INFO_USE_ZIP', 'ZIP verwenden');
define('TEXT_LAST_RESTORATION', 'Letzte Wiederherstellung:');
define('TEXT_NO_EXTENSION', 'keine');
define('TEXT_RESULT_CODE', 'Ergebnis Code: ');
define('TEXT_SELECTED_EXECUTABLES', 'Ausgewählte Dateien: ');

define('WARNING_NOT_SECURE_FOR_DOWNLOADS','<span class="errorText">HINWEIS: Sie haben SSL nicht aktiviert. Alle Downloads, die Sie von dieser Seite aus tätigen, werden nicht verschlüsselt. Backups und Wiederherstellungen sind problemlos möglich, aber das Herunter- und Hochladen von Dateien vom/auf den Server stellt ein Sicherheitsrisiko dar.</span>');
define('WARNING_MYSQL_NOT_FOUND','WARNUNG: "<strong>mysql</strong>" binary nicht gefunden. <strong>Wiederherstellungen</strong> funktionieren wahrscheinlich nicht.<br>Bitte geben Sie den vollständigen Pfad zur MYSQL binary in folgender Datei an: DEINADMIN/includes/extra_datafiles/backup_mysql.php');
define('WARNING_MYSQLDUMP_NOT_FOUND','WARNUNG: "<strong>mysqldump</strong>" binary nicht gefunden. <strong>Sicherungen</strong> funktionieren wahrscheinlich nicht.<br>Bitte geben Sie den vollständigen Pfad zur MYSQLDUMP binary in folgender Datei an: DEINADMIN/includes/extra_datafiles/backup_mysql.php');
define('TEXT_TEMP_SQL_DELETED','temporäre .sql Datei gelöscht');
define('TEXT_TEMP_SQL_NOT_DELETED','tempporäre .sql Datei NICHT gelöscht');
define('ICON_FILE_DOWNLOAD', 'download');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_RESTORE', 'Wiederherstellung');
