<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/hugo13/maleborg/webchills	http://www.zen-cart-pro.at	2010-05-01
 * @version $Id$
 */
/**
 * defining language components for the page
 */
  
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Systemprüfung');
define('INSTALL_BUTTON', ' Installieren ');
// this comes before TEXT_MAIN
define('UPGRADE_BUTTON', 'Update');
// this comes before TEXT_MAIN
define('DB_UPGRADE_BUTTON', 'Datenbank aktualisieren');
// this comes before TEXT_MAIN
//Button meanings: (to be made into help-text for future version):
// "Install" = make new configure.php files, regardless of existing contents.  Load new database by dropping old tables.
// "Upgrade" = read old configure.php files, and write new ones using new structure. Upgrade database, instead of wiping and new install
// "Database Upgrade" = don't write the configure.php files -- simply jump to the database-upgrade page. Only displayed if detected database version is new enough to not require configure.php file updates.

define('TITLE_DOCUMENTATION', 'Dokumentation');
define('TEXT_DOCUMENTATION', '<h3>Haben Sie die Installationsanleitung bereits gelesen?</h3>Die <a href="http://www.zen-cart-pro.at/zcvb/forum/vbglossar.php?do=showcat&catid=6" target="_blank">Installationsanleitung</a> ist meist eine große Hilfe und sollte vorab gelesen werden, wenn nicht bereits geschehen.<br />Die Anleitung finden Sie auch im Ordner docs.<br/>In dieser finden Sie unter anderem Angaben über die zu setzenden CHMOD Level einzelner Dateien und Ordner sowie weitere Angaben über mögliche Einstellungen nach Abschluss der Installation. Weiterhin enthält diese Links zur <a href="http://www.zen-cart-pro.at/zcvb/forum/vbglossar.php" target="_blank">Online FAQs</a> und anderen hilfreichen Informationen.');
define('TEXT_MAIN', 'Bitte nehmen Sie sich einen Augenblick Zeit für die Systemprüfung - diese stellt sicher, ob alle notwendigen Systemvoraussetzungen für eine erfolgreiche Installation von Zen Cart gegeben sind. Bitte beheben Sie alle Fehler oder Warnungen, bevor Sie mit der Installation fortfahren. Klicken Sie anschließend auf <em>'.INSTALL_BUTTON.'&nbsp;</em>.');
define('SYSTEM_INSPECTION_RESULTS', 'Systemprüfung - Ergebnis');
define('OTHER_INFORMATION', 'Sonstige Systeminformation (Nur zur Referenz)');
define('OTHER_INFORMATION_DESCRIPTION', 'Folgende Informationen müssen nicht unbedingt auf ein Problem oder eine fehlerhafte Konfiguration hinweisen. Sie dienen lediglich zur Informationszwecken und zeigen den genauen Ort der Information an.');
define('NOT_EXIST','NICHT GEFUNDEN');
define('WRITABLE','beschreibbar');
define('UNWRITABLE',"<span class='errors'>nicht beschreibbar</span>");
define('UNKNOWN','unbekannt');
define('ON','EIN');
define('OFF','AUS');
define('OK','OK');
define('UPGRADE_DETECTION','Update Modus verfügbar');
define('LABEL_PREVIOUS_INSTALL_FOUND','Es wurde eine vorherigen Zen Cart Installation gefunden:');
define('LABEL_PREVIOUS_VERSION_NUMBER','Die installierte Version scheint eine Zen Cart v%s zu sein');
define('LABEL_PREVIOUS_VERSION_NUMBER_UNKNOWN','<em>Die Version Ihrer Datenbank konnte nicht korrekt ermittelt werden. Die Ursache kann ein falsches Tabellen-Präfix sein oder es wurden fehlerhafte Angaben zu Ihrer Datenbank gemacht. <br /><br />ACHTUNG: Verwenden Sie die Update Option nur, wenn alle Angaben in Ihrer \'configure.php\' korrekt sind.</em>');
define('LABEL_UPGRADE_VS_INSTALL', 'Installieren oder Updaten?');
define('LABEL_INSTALL', 'Bereit für die Installation?  <br>(Es werden alle existierenden Daten gelöscht. Sie befinden sich NICHT im Updatemodus!!!)');
define('IMAGE_STOP_BEFORE_UPGRADING', '<div class="center"><img src="includes/templates/template_default/images/stop.gif" border="0" alt="ACHTUNG: Bitte korrekte Option auswählen." /></div>');
define('LABEL_ACTION_SELECTION_INSTRUCTIONS','<p class="errors extralarge"><span class="center">Achtung:</span><br />Falls Sie updaten, wählen Sie bitte "<span style="text-decoration: underline;">Datenbank aktualisieren</span>" um Ihre Daten zu konvertieren.</p><p class="extralarge">Wenn Sie "Installieren" wählen, wird der Inhalt der Datenbank gelöscht.</p>');
define('DISPLAY_PHP_INFO','PHP Info Link: ');
define('VIEW_PHP_INFO_LINK_TEXT','PHPINFO für Ihren Server anzeigen');
define('LABEL_WEBSERVER','Webserver');
define('LABEL_MYSQL_AVAILABLE','MySQL Unterstützung');
define('LABEL_MYSQL_VER','MySQL Version');
define('LABEL_DB_PRIVS','Datenbankprivilegien');
define('LABEL_POSTGRES_AVAILABLE','PostgreSQL Unterstützung');
define('LABEL_PHP_VER','PHP Version');
define('LABEL_PHP_OS','PHP O/S');
define('LABEL_REGISTER_GLOBALS','Register Globals');
define('LABEL_SET_TIME_LIMIT','Max. Zeit zum Ausführen einer Seite');
define('LABEL_DISABLED_FUNCTIONS','Deaktivierte PHP Funktionen');
define('LABEL_SAFE_MODE','PHP Safe Mode');
define('LABEL_CURRENT_CACHE_PATH','Aktueller SQL Cache Ordner');
define('LABEL_SUGGESTED_CACHE_PATH','Vorgeschlagener SQL Cache Ordner');
define('LABEL_HTTP_HOST','HTTP Host');
define('LABEL_PATH_TRANLSATED','Aufgelöster Pfad');
define('LABEL_REALPATH', 'Realer/absoluter Pfad');
define('LABEL_PHP_API_MODE','PHP API Modus');
define('LABEL_PHP_MODULES','Aktive PHP Module');
define('LABEL_PHP_EXT_SESSIONS','PHP Sessions Unterstützung');
define('LABEL_PHP_SESSION_AUTOSTART','PHP Session.AutoStart');
define('LABEL_PHP_EXT_SAVE_PATH','PHP Sessions.Save_Path');
define('LABEL_PHP_EXT_FTP','PHP FTP Unterstützung');
define('LABEL_PHP_EXT_CURL','PHP cURL Unterstützung');
define('LABEL_CURL_NONSSL','CURL NON-SSL Fähigkeit');
define('LABEL_CURL_SSL','CURL SSL Fähigkeit');
define('LABEL_CURL_NONSSL_PROXY','CURL NON-SSL Fähigkeit via Proxy');
define('LABEL_CURL_SSL_PROXY','CURL SSL Fähigkeit via Proxy');
define('LABEL_PHP_MAG_QT_RUN','PHP magic_quotes_runtime Einstellung');
define('LABEL_PHP_MAG_QT_SYBASE','PHP magic_quotes_sybase Einstellung');
define('LABEL_PHP_EXT_GD','PHP GD Unterstützung');
define('LABEL_GD_VER','GD Version');
define('LABEL_PHP_EXT_OPENSSL','PHP OpenSSL Unterstützung');
define('LABEL_PHP_UPLOAD_STATUS','PHP Upload Unterstützung');
define('LABEL_PHP_EXT_PFPRO','PHP Payflow Pro Unterstützung');
define('LABEL_PHP_EXT_ZLIB','PHP ZLIB Kompression Unterstützung');
define('LABEL_PHP_SESSION_TRANS_SID','PHP session.use_trans_sid');
define('LABEL_DISK_FREE_SPACE','Freier Speicher');
define('LABEL_XML_SUPPORT','PHP XML Unterstützung');
define('LABEL_OPEN_BASEDIR','PHP open_basedir Einschränkungen');
define('LABEL_UPLOAD_TMP_DIR','PHP Upload TMP Verzeichnis');
define('LABEL_SENDMAIL_FROM','PHP sendmail \'from\'');
define('LABEL_SENDMAIL_PATH','PHP sendmail Pfad');
define('LABEL_SMTP_MAIL','PHP SMTP Lokalisierung');
define('LABEL_GZIP', 'PHP Output Buffering (gzip)');
define('LABEL_INCLUDE_PATH','PHP include_path');
define('LABEL_CRITICAL','Kritische Punkte');
define('LABEL_RECOMMENDED','Ähnliche Punkte');
define('LABEL_OPTIONAL','Optionale Punkte');
define('LABEL_EXPLAIN','Für weitere Infos bitte hier klicken');
define('LABEL_FOLDER_PERMISSIONS','Datei- und Ordnerberechtigungen');
define('LABEL_WRITABLE_FILE_INFO', 'Damit das Installationsprogramm die Informationen, die Sie auf den folgenden Seiten eingeben, ordnungsgemäß in die configure.php Dateien schreiben kann, sollten die unten angezeigten Dateien "beschreibbar" sein');
define('LABEL_WRITABLE_FOLDER_INFO','Damit alle administrativen und alle täglichen Aufgaben von Zen Cart korrekt funktionieren, benötigen einige Dateien/Ordner "Schreibrechte". Im Folgendem erhalten Sie eine Liste der Dateien/Ordner, die gesonderte "Lese-/Schreibrechte" benötigen. Bitte korrigieren Sie ggf. die empfohlenen Schreibrechte für diese Dateien/Ordner. Für eine erneute Prüfung aktualisieren Sie bitte diese Seite in Ihrem Browser.<br /><br >Auf einigen Hosts ist eine Einstellung auf CHMOD 777 nicht erlaubt, aber CHMOD 666 ist in den meisten Fällen möglich. Beginnen Sie mit der höheren Einstellung und - falls notwendig - versuchen Sie dann erst die niedrigere Einstellung.');
