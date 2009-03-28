<?php
/*
  $Id: backup.php,v 1.16 2002/03/16 21:30:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Datenbank Backup Manager');

define('TABLE_HEADING_TITLE', 'Titel');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Gr&ouml;&szlig;e');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neue Sicherung');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokal wiederherstellen');
define('TEXT_INFO_NEW_BACKUP', 'Der Sicherungsprozess kann mehrere Minuten in Anspruch nehmen - bitte keinesfalls unterbrechen.');
define('TEXT_INFO_UNPACK', '<br><br>(nach dem Entpacken der Datei aus dem Archiv)');
define('TEXT_INFO_RESTORE', 'Bitte den Prozess f&uuml;r die Wiederherstellung keinesfalls unterbrechen.<br><br>Je gr&ouml&szlig;er die Sicherung ist, desto l&auml;nger ben&ouml;tigt dieser Prozess!<br><br>Wenn m&ouml;glich, verwenden Sie einen MySQL Client.<br><br>Beispiel:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Bitte den Prozess f&uuml;r die Wiederherstellung keinesfalls unterbrechen.<br><br>Je gr&ouml&szlig;er die Sicherung ist, desto l&auml;nger ben&ouml;tigt dieser Prozess!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Die hoch zuladende Datei muss ein raw sql (Text) Format sein.');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Gr&ouml;&szlig;e:');
define('TEXT_INFO_COMPRESSION', 'Kompression:');
define('TEXT_INFO_USE_GZIP', 'GZIP verwenden');
define('TEXT_INFO_USE_ZIP', 'ZIP verwenden');
define('TEXT_INFO_USE_BZIP', 'BZIP2 verwenden');
define('TEXT_INFO_USE_NO_COMPRESSION', 'keine Kompression (Reine SQL Datei)');
define('TEXT_INFO_SAVE_ONLY', 'Nur auf Server speichern');
define('TEXT_INFO_DOWNLOAD_AND_SAVE', 'Download und speichern auf Server');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download ohne Speicherung auf Server');
define('TEXT_INFO_BEST_THROUGH_HTTPS', '(Sicherer &uuml;ber eine gesicherte HTTPS Verbindung)');
define('TEXT_DELETE_INTRO', 'wollen Sie diese Sicherung wirklich l&ouml;schen?');
define('TEXT_NO_EXTENSION', 'keine');
define('TEXT_BACKUP_DIRECTORY', 'Sicherungsverzeichnis:');
define('TEXT_LAST_RESTORATION', 'Letzte Wiederherstellung:');
define('TEXT_FORGET', '(vergessen)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: das Verzeichnis f&uuml;r die Sicherung existiert nicht. Bitte beheben Sie den Fehler in Ihrer configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Fehler: In das Verzeichnis f&uuml;r die Sicherung kann nicht geschrieben werden.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Fehler: Der Download Link ist nicht akzeptabel.');
define('ERROR_DECOMPRESSOR_NOT_AVAILABLE', 'Fehler: Kein geeigneter Entpacker verf&uuml;gbar.');
define('ERROR_UNKNOWN_FILE_TYPE', 'Fehler: unbekannter Dateityp.');
define('ERROR_RESTORE_FAILES', 'Fehler: Wiederherstellung gescheitert.');


define('SUCCESS_LAST_RESTORE_CLEARED', 'Erfolgreich: Das letzte Wiederherstellungsdatum wurde gel&ouml;scht.');
define('SUCCESS_DATABASE_SAVED', 'Erfolgreich: Die Datenbank wurde gesichert.');
define('SUCCESS_DATABASE_RESTORED', 'Erfolgreich: Die Datenbank wurde wiederhergestellt.');
define('SUCCESS_BACKUP_DELETED', 'Erfolgreich: Die Sicherung wurde entfernt.');

define('TEXT_BACKUP_UNCOMPRESSED', 'Die Backupdatei wurde entpackt: ');

?>