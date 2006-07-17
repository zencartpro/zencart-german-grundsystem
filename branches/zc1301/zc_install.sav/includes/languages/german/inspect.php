<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo                                         |
// | Date of Translation:  16.08.04                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id: inspect.php 2 2006-03-31 09:55:33Z rainer $
//
  
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Systempr&uuml;fung');
define('INSTALL_BUTTON', ' installieren '); // this comes before TEXT_MAIN
define('UPGRADE_BUTTON', 'Update'); // this comes before TEXT_MAIN
define('DB_UPGRADE_BUTTON', 'Datenbank aktualisieren'); // this comes before TEXT_MAIN
define('REFRESH_BUTTON', 'neu pr&uuml;fen');
//Button meanings: (to be made into help-text for future version):
// "Install" = make new configure.php files, regardless of existing contents.  Load new database by dropping old tables.
// "Upgrade" = read old configure.php files, and write new ones using new structure. Upgrade database, instead of wiping and new install
// "Database Upgrade" = don't write the configure.php files -- simply jump to the database-upgrade page. Only displayed if detected database version is new enough to not require configure.php file updates.

define('TEXT_MAIN', 'Bitte nehmen Sie sich einen Augenblick Zeit f&uuml;r die Systempr&uuml;fung - diese stellt sichter, ob alle notwendigen Systemvoraussetzungen f&uuml;r eine erfolgreiche Installation von Zen Cart gegeben sind. &nbsp;Bitte beheben Sie alle Fehler oder Warnungen, bevor Sie mit der Installation fortfahren. &nbsp;Klicken Sie anschlie&szlig;end auf <em>'.INSTALL_BUTTON.'&nbsp;</em>.');
define('SYSTEM_INSPECTION_RESULTS', 'Systempr&uuml;fung - Ergebnis');
define('OTHER_INFORMATION', 'Sonstige Systeminformation (Nur zur Refferenz)');
define('OTHER_INFORMATION_DESCRIPTION', 'Folgende Information mu&szlig; nicht unbedingt ein Problem oder eine fehlerhafte Konfiguration darstellen und dient einfach nur der Darstellung und Lokalisierung.');

define('NOT_EXIST','NICHT GEFUNDEN');
define('WRITABLE','beschreibbar');
define('UNWRITABLE',"<span class='errors'>nicht beschreibbar</span>");
define('UNKNOWN','unbekannt');

define('UPGRADE_DETECTION','Update Modus erh&auml;ltlich');
define('LABEL_PREVIOUS_INSTALL_FOUND','Es wurde eine vorherigen Zen Cart installation gefunden:');
define('LABEL_PREVIOUS_VERSION_NUMBER','Die installierte Version scheint eine Zen Cart v%s zu sein');
define('LABEL_PREVIOUS_VERSION_NUMBER_UNKNOWN','<em>Die Version Ihrer Datenbank konnte nicht korrekt ermittelt werden. Die Ursache kann ein falsches Tabellen-Pr&auml;fix sein oder es wurden fehlerhafte Angaben zu Ihrer Datenbank gemacht. <br /><br />ACHTUNG: Verwenden Sie die Update Option nur, wenn alle Angaben in Ihrer \'configure.php\' korrekt sind.</em>');

define('DISPLAY_PHP_INFO','PHP Info Link: ');
define('VIEW_PHP_INFO_LINK_TEXT','PHPINFO f&uuml;r Ihren Server anzeigen');
define('LABEL_WEBSERVER','Webserver');
define('LABEL_MYSQL_AVAILABLE','MySQL Support');
define('LABEL_MYSQL_VER','MySQL Version');
define('LABEL_DB_PRIVS','Datenbankprivilegien');
define('LABEL_POSTGRES_AVAILABLE','PostgreSQL Unterst&uuml;tzung');
define('LABEL_PHP_VER','PHP Version');
  define('LABEL_PHP_OS','PHP O/S');
define('LABEL_REGISTER_GLOBALS','Register Globals');
define('LABEL_SET_TIME_LIMIT','Max. Zeit zum Ausf&uuml;hren einer Seite');
define('LABEL_DISABLED_FUNCTIONS','Deaktivierte PHP Funktionen');
define('LABEL_SAFE_MODE','PHP Safe Mode');
define('LABEL_CURRENT_CACHE_PATH','Aktueller SQL Cache Ordner');
define('LABEL_SUGGESTED_CACHE_PATH','Vorgeschlagener SQL Cache Ordner');
define('LABEL_HTTP_HOST','HTTP Host');
define('LABEL_PATH_TRANLSATED','Aufgel&ouml;ster Pfad');
define('LABEL_PHP_API_MODE','PHP API Modus');
define('LABEL_PHP_MODULES','Aktive PHP Module');
define('LABEL_PHP_EXT_SESSIONS','PHP Sessions Support');
define('LABEL_PHP_SESSION_AUTOSTART','PHP Session.AutoStart');
define('LABEL_PHP_EXT_SAVE_PATH','PHP Sessions.Save_Path');
define('LABEL_PHP_EXT_FTP','PHP FTP Support');
define('LABEL_PHP_EXT_CURL','PHP cURL Support');
define('LABEL_PHP_MAG_QT_RUN','PHP magic_quotes_runtime Einstellung');
define('LABEL_PHP_EXT_GD','PHP GD Support');
  define('LABEL_GD_VER','GD Version');
define('LABEL_PHP_EXT_OPENSSL','PHP OpenSSL Support');
define('LABEL_PHP_UPLOAD_STATUS','PHP Upload Support');
define('LABEL_PHP_EXT_PFPRO','PHP Payflow Pro Support');
define('LABEL_PHP_EXT_ZLIB','PHP ZLIB Kompression Support');
define('LABEL_PHP_SESSION_TRANS_SID','PHP session.use_trans_sid');
define('LABEL_DISK_FREE_SPACE','Freier Speicher');
define('LABEL_XML_SUPPORT','PHP XML Support');
define('LABEL_OPEN_BASEDIR','PHP open_basedir Einschr&auml;nkungen');
define('LABEL_UPLOAD_TMP_DIR','PHP Upload TMP Verzeichnis');
define('LABEL_SENDMAIL_FROM','PHP sendmail \'from\'');
define('LABEL_SENDMAIL_PATH','PHP sendmail Pfad');
define('LABEL_SMTP_MAIL','PHP SMTP Lokalisierung');

define('LABEL_CRITICAL','Kritische Punkte');
define('LABEL_RECOMMENDED','Ähnliche Punkte');
define('LABEL_OPTIONAL','Optionale Punkte');

define('LABEL_EXPLAIN','&nbsp;F&uuml;r weitere Infos bitte hier klicken');
define('LABEL_FOLDER_PERMISSIONS','Datei- und Ordnerberechtigungen');
define('LABEL_WRITABLE_FOLDER_INFO','Damit alle administrative und alle t&auml;glichen Aufgaben von Zen Cart korrekt funktionieren,
ben&ouml;tigen einige Dateien/Ordner "Schreibrechte".  Im Folgendem erhalten Sie eine Liste der Dateien/Ordner, die gesonderte "Lese-/Schreibrechte" ben&ouml;tigen.
Bitte korrigieren Sie ggf. die empfohlenen Schreibrechte f&uuml;r diese Dateien/Ordner.
F&uuml;r eine erneute Pr&uuml;fung aktualisieren Sie bitte diese Seite in Ihrem Browser.<br /><br >Auf einigen Hosts ist eine Einstellung auf CHMOD 777 nicht erlaubt, aber CHMOD 666 ist in den meisten F&auml;llen m&ouml;glich. Beginnen Sie mit der h&ouml;heren Einstellung und - falls notwendig - versuchen Sie dann erst die niedrigere Einstellung.');
?>
