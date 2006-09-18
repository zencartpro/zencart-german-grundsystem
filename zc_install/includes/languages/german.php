<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// | Date of Translation:  28.08.05                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id$
//

define('YES', 'JA');
define('NO', 'NEIN');
define('REFRESH_BUTTON', 'Nochmal pr&uuml;fen');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// META TAG TITLE
define('META_TAG_TITLE', 'Zen Cart Installationsprogramm');

define('INSTALLATION_IN_PROGRESS','Installation l&auml;uft...');
if (isset($_GET['main_page']) && ($_GET['main_page']== 'index' || $_GET['main_page']== 'license')) {
    define('TEXT_ERROR_WARNING', 'Hi: Es m&uuml;ssen nur einige Kleinigkeiten adressiert werden, bevor wir fortfahren k&ouml;nnen.');
} else {
    define('TEXT_ERROR_WARNING', '<span class="errors"><strong>Warnung: Es sind Probleme aufgetreten</strong></span>');
}

define('DB_ERROR_NOT_CONNECTED', 'Installationsfehler: Es konnte keine Verbindung zur Datenbank hergestellt werden');
define('MUST_UPGRADE','Sie m&uuml;ssen zuerst upgraden bevor Sie Zen-Cart installieren');

define('UPLOAD_SETTINGS','Die maximale Uploadgr&ouml;&szlig;e muss kleiner als einer der folgenden Werte sein:.<br />
<em>upload_max_filesize</em> in php.ini %s <br />
<em>post_max_size</em> in php.ini: %s <br />' .
//'<em>Zen Cart</em> Upload Setting: %s <br />' .
'Einige Apache-Einstellungen k&ouml;nnen das Hochladen von Dateien verhindern bzw. Ihre Dateigr&ouml;&szlig;e begrenzen.
Nutzen Sie die Apache-Dokumentation um weitere Informationen zu erhalten.');

define('TEXT_HELP_LINK', ' mehr...');
define('TEXT_CLOSE_WINDOW', 'Fenster schlie&szlig;en');
define('STORE_ADDRESS_DEFAULT_VALUE', 'Shopname
  Adresse
  Land
  Telefonnummer');

define('ERROR_TEXT_4_1_2', 'PHP Version ist 4.1.2');
define('ERROR_CODE_4_1_2', '1');
define('ERROR_TEXT_PHP_OLD_VERSION', 'PHP Version wird nicht unterst&uuml;tzt');
define('ERROR_CODE_PHP_OLD_VERSION', '55');

define('ERROR_TEXT_ADMIN_CONFIGURE', '/admin/includes/configure.php existiert nicht');
define('ERROR_CODE_ADMIN_CONFIGURE', '2');

define('ERROR_TEXT_STORE_CONFIGURE', '/includes/configure.php existiert nicht');
define('ERROR_CODE_STORE_CONFIGURE', '3');

define('ERROR_TEXT_PHYSICAL_PATH_ISEMPTY', 'Das Feld f&uuml;r den physikalischen Pfad darf nicht leer sein');
define('ERROR_CODE_PHYSICAL_PATH_ISEMPTY', '9');

define('ERROR_TEXT_PHYSICAL_PATH_INCORRECT', 'Der physikalische Pfad ist falsch');
define('ERROR_CODE_PHYSICAL_PATH_INCORRECT', '10');

define('ERROR_TEXT_VIRTUAL_HTTP_ISEMPTY', 'Das Feld f&uuml;r den virtuellen HTTP Pfad darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTP_ISEMPTY', '11');

define('ERROR_TEXT_VIRTUAL_HTTPS_ISEMPTY', 'Das Feld f&uuml;r den virtuellen HTTPS Pfad darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTPS_ISEMPTY', '12');

define('ERROR_TEXT_VIRTUAL_HTTPS_SERVER_ISEMPTY', 'Das Feld f&uuml;r den virtuellen HTTPS Server darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTPS_SERVER_ISEMPTY', '13');

define('ERROR_TEXT_DB_USERNAME_ISEMPTY', 'Das Feld f&uuml;r den DB Benutzernamen darf nicht leer sein');
define('ERROR_CODE_DB_USERNAME_ISEMPTY', '16'); // re-using another one, since message is essentially the same.

define('ERROR_TEXT_DB_HOST_ISEMPTY', 'Das Feld f&uuml;r den DB Host darf nicht leer sein');
define('ERROR_CODE_DB_HOST_ISEMPTY', '24');

define('ERROR_TEXT_DB_NAME_ISEMPTY', 'Das Feld f&uuml;r den DB Namen darf nicht leer sein');
define('ERROR_CODE_DB_NAME_ISEMPTY', '25');

define('ERROR_TEXT_DB_SQL_NOTEXIST', 'Die SQL Installationsdatei existiert nicht');
define('ERROR_CODE_DB_SQL_NOTEXIST', '26');

define('ERROR_TEXT_DB_NOTSUPPORTED', 'Diese Datenbank wird nicht unterst&uuml;tzt');
define('ERROR_CODE_DB_NOTSUPPORTED', '27');

define('ERROR_TEXT_DB_CONNECTION_FAILED', 'Die Verbindung zur Datenbank ist fehlgeschlagen');
define('ERROR_CODE_DB_CONNECTION_FAILED', '28');

define('ERROR_TEXT_DB_CREATE_FAILED', 'Die Datenbank konnte nicht erstellt werden');
define('ERROR_CODE_DB_CREATE_FAILED', '29');

define('ERROR_TEXT_DB_NOTEXIST', 'Die Datenbank existiert nicht');
define('ERROR_CODE_DB_NOTEXIST', '30');

define('ERROR_TEXT_STORE_NAME_ISEMPTY', 'Das Feld f&uuml;r den Shopnamen darf nicht leer sein');
define('ERROR_CODE_STORE_NAME_ISEMPTY', '31');

define('ERROR_TEXT_STORE_OWNER_ISEMPTY', 'Das Feld f&uuml;r den Shopinhaber darf nicht leer sein');
define('ERROR_CODE_STORE_OWNER_ISEMPTY', '32');

define('ERROR_TEXT_STORE_OWNER_EMAIL_ISEMPTY', 'Das Feld f&uuml;r die Shop e-Mail Adresse darf nicht leer sein');
define('ERROR_CODE_STORE_OWNER_EMAIL_ISEMPTY', '33');

define('ERROR_TEXT_STORE_OWNER_EMAIL_NOTEMAIL', 'Die e-Mail Adresse des Shops ist nicht korrekt');
define('ERROR_CODE_STORE_OWNER_EMAIL_NOTEMAIL', '34');

define('ERROR_TEXT_STORE_ADDRESS_ISEMPTY', 'Das Feld f&uuml;r die Shopadresse darf nicht leer sein');
define('ERROR_CODE_STORE_ADDRESS_ISEMPTY', '35');

define('ERROR_TEXT_DEMO_SQL_NOTEXIST', 'Die SQL Datei f&uuml;r die Demoartikel existiert nicht');
define('ERROR_CODE_DEMO_SQL_NOTEXIST', '36');

define('ERROR_TEXT_ADMIN_USERNAME_ISEMPTY', 'Das Feld f&uuml;r den Admin Benutzernamen darf nicht leer sein');
define('ERROR_CODE_ADMIN_USERNAME_ISEMPTY', '46');

define('ERROR_TEXT_ADMIN_EMAIL_ISEMPTY', 'Das Feld f&uuml;r die Admin e-Mail Adresse darf nicht leer sein');
define('ERROR_CODE_ADMIN_EMAIL_ISEMPTY', '47');

define('ERROR_TEXT_ADMIN_EMAIL_NOTEMAIL', 'Die Admin e-Mail Adresse ist nicht g&uuml;ltig');
define('ERROR_CODE_ADMIN_EMAIL_NOTEMAIL', '48');

define('ERROR_TEXT_ADMIN_PASS_ISEMPTY', 'Das Feld f&uuml;r das Admin Passwort darf nicht leer sein');
define('ERROR_CODE_ADMIN_PASS_ISEMPTY', '49');

define('ERROR_TEXT_ADMIN_PASS_NOTEQUAL', 'Das Passwort stimmt nicht &uuml;berein');
define('ERROR_CODE_ADMIN_PASS_NOTEQUAL', '50');

define('ERROR_TEXT_PHP_VERSION', 'Ihre derzeit verwendete PHP Version wird nicht unterst&uuml;tzt');
define('ERROR_CODE_PHP_VERSION', '55');

define('ERROR_TEXT_ADMIN_CONFIGURE_WRITE', 'In die Admin Konfigurationsdatei kann nicht geschrieben werden');
define('ERROR_CODE_ADMIN_CONFIGURE_WRITE', '56');

define('ERROR_TEXT_STORE_CONFIGURE_WRITE', 'In die Shop Konfigurationsdatei kann nicht geschrieben werden');
define('ERROR_CODE_STORE_CONFIGURE_WRITE', '57');

define('ERROR_TEXT_CACHE_DIR_ISEMPTY', 'Das Feld f&uuml;r das Sitzungs-/SQL Cache Verzeichnis darf nicht leer sein');
define('ERROR_CODE_CACHE_DIR_ISEMPTY', '61');

define('ERROR_TEXT_CACHE_DIR_ISDIR', 'Das Sitzungs-/SQL Cache Verzeichnis existiert nicht');
define('ERROR_CODE_CACHE_DIR_ISDIR', '62');

define('ERROR_TEXT_CACHE_DIR_ISWRITEABLE', 'Es konnte nicht in das Sitzungs-/SQL Cache Verzeichnis geschrieben werden');
define('ERROR_CODE_CACHE_DIR_ISWRITEABLE', '63');

define('ERROR_TEXT_PHPBB_CONFIG_NOTEXIST', 'Die phpBB Konfigurationsdateien existieren nicht');
define('ERROR_CODE_PHPBB_CONFIG_NOTEXIST', '68');

define('ERROR_TEXT_REGISTER_GLOBALS_ON', 'Register Globals ist ON');
define('ERROR_CODE_REGISTER_GLOBALS_ON', '69');

define('ERROR_TEXT_SAFE_MODE_ON', 'Safe Mode ist ON');
define('ERROR_CODE_SAFE_MODE_ON', '70');

define('ERROR_TEXT_CACHE_CUSTOM_NEEDED','Der Cache Ordner muss das Zwischenspeichern von Dateien unterst&uuml;tzen');
define('ERROR_CODE_CACHE_CUSTOM_NEEDED', '71');

define('ERROR_TEXT_TABLE_RENAME_CONFIGUREPHP_FAILED','Es konnten nicht alle Konfigurationsdateien mit den neuen Einstellungen gespeichert werden');
define('ERROR_CODE_TABLE_RENAME_CONFIGUREPHP_FAILED', '72');

define('ERROR_TEXT_TABLE_RENAME_INCOMPLETE','Es konnten nicht alle Tabellen umbenannt werden');
define('ERROR_CODE_TABLE_RENAME_INCOMPLETE', '73');

define('ERROR_TEXT_SESSION_SAVE_PATH','PHP "session.save_path" ist nicht beschreibbar');
define('ERROR_CODE_SESSION_SAVE_PATH','74');

define('ERROR_TEXT_MAGIC_QUOTES_RUNTIME','PHP "magic_quotes_runtime" ist aktiv');
define('ERROR_CODE_MAGIC_QUOTES_RUNTIME','75');

define('ERROR_TEXT_DB_VER_UNKNOWN','Datenbank Versionsinformation unbekannt');
define('ERROR_CODE_DB_VER_UNKNOWN','76');

define('ERROR_TEXT_DB_MYSQL5','MySQL 5 Support noch nicht vollst&auml;ndig getestet');
define('ERROR_CODE_DB_MYSQL5','90');

define('ERROR_TEXT_UPLOADS_DISABLED','Dateiuploads sind deaktiviert');
define('ERROR_CODE_UPLOADS_DISABLED','77');

define('ERROR_TEXT_ADMIN_PWD_REQUIRED','F&uuml;r die Aktualisierung wird das Administrator Passwort ben&ouml;tigt');
define('ERROR_CODE_ADMIN_PWD_REQUIRED','78');

define('ERROR_TEXT_PHP_SESSION_SUPPORT','PHP Session Support wird ben&ouml;tigt');
define('ERROR_CODE_PHP_SESSION_SUPPORT','80');

define('ERROR_TEXT_PHP_AS_CGI','PHP im cgi Modus wird nicht empfohlen au&szlig;er es handelt sich um einen Windows Server');
define('ERROR_CODE_PHP_AS_CGI','81');

define('ERROR_TEXT_DISABLE_FUNCTIONS','Auf Ihrem Server sind ben&ouml;tigte PHP Funktionen deaktiviert');
define('ERROR_CODE_DISABLE_FUNCTIONS','82');

define('ERROR_TEXT_OPENSSL_WARN','OpenSSL ist "ein" Weg, mit dem Sie auf einem Server sichere SSL (https://) Verbindung f&uuml;r Ihre Seite anbieten k&ouml;nnen.<br /><br />Wird diese Funktion als nicht erh&auml;ltlich angezeigt, kann dies folgende Ursachen haben:<br />(a) Der von Ihnen verwendete Webhost unterst&uuml;tzt kein SSL<br />(b) Auf Ihrem Werbserver ist OpenSSL nicht installiert, es wird - VIELLEICHT - eine andere Form der SSL Unterst&uuml;tzung zur Verf&uumlgung; gestellt<br />(c) Ihr Webhost kann derzeit Ihr SSL Zertifikat nicht ber&uuml;cksichtigen, SSL kann deshalb noch nicht aktiviert werden<br />(d) PHP k&ouml;nnte so konfiguriert sein, dass OpenSSL derzeit nicht unterst&uuml;tzt wird.<br /><br />Wenn Sie SSL auf Ihrer Webseite BEN&Ouml;TIGEN, kontaktieren Sie zur Sicherheit auf jeden Fall Ihren Provider.');
define('ERROR_CODE_OPENSSL_WARN','79');

define('ERROR_TEXT_DB_PREFIX_NODOTS','Datenbank Tabellen-Pr&auml;fixe d&uuml;rfen keines der folgenden Zeichen beinhalten: / or \\ or . ');
define('ERROR_CODE_DB_PREFIX_NODOTS','83');

define('ERROR_TEXT_PHP_SESSION_AUTOSTART','PHP Session.autostart sollte deaktiviert werden.');
define('ERROR_CODE_PHP_SESSION_AUTOSTART','84');
define('ERROR_TEXT_PHP_SESSION_TRANS_SID','PHP Session.use_trans_sid sollte deaktiviert werden.');
define('ERROR_CODE_PHP_SESSION_TRANS_SID','86');
define('ERROR_TEXT_DB_PRIVS','Fehlende Berechtigung f&uuml; diesen Datenbankbenutzer');
define('ERROR_CODE_DB_PRIVS','87');
define('ERROR_TEXT_COULD_NOT_WRITE_CONFIGURE_FILES','Es ist ein Fehler beim Schreiben in /includes/configure.php aufgetreten');
define('ERROR_CODE_COULD_NOT_WRITE_CONFIGURE_FILES','88');
define('ERROR_TEXT_GD_SUPPORT','GD Support Details');
define('ERROR_CODE_GD_SUPPORT','89');

define('ERROR_TEXT_OPEN_BASEDIR','Es k&ouml;nnte Probleme mit Uploads oder Backups geben.');
define('ERROR_CODE_OPEN_BASEDIR','92');
define('ERROR_TEXT_CURL_SUPPORT','cURL Unterst&uuml;tzung nicht gefunden.');
define('ERROR_CODE_CURL_SUPPORT','93');

  $error_code ='';
if (isset($_GET['error_code'])) {
  $error_code = $_GET['error_code'];
  }

switch ($error_code) {
  case ('1'):
    define('POPUP_ERROR_HEADING', 'PHP Version 4.1.2 gefunden');
    define('POPUP_ERROR_TEXT', 'In der PHP Version 4.1.2 wurden einige Bugs entdeckt. Dadurch kann es vorkommen, dass auf die Admin Sektion nicht zugegriffen werden kann. Bitte aktualisieren Sie nach M&ouml;glichkeit Ihre PHP Version.');
    
  break;
  case ('2'):
    define('POPUP_ERROR_HEADING', '/admin/includes/configure.php existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datei /admin/includes/configure.php existiert nicht. Erstellen Sie entwerder eine neue Datei oder benennen Sie die Datei /admin/includes/dist-configure.php in configure.php um. Nach dem Erstellen muss die Datei Lese- und Schreibrechte besitzen bzw. auf CHMOD 666 oder CHMOD 777 gesetzt werden.');
    
  break;
  case ('3'):
    define('POPUP_ERROR_HEADING', '/includes/configure.php existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datei /includes/configure.php existiert nicht. Erstellen Sie entweder eine neue Datei oder benennen Sie die Datei /admin/includes/dist-configure.php in configure.php um. Nach dem Erstellen muss die Datei Lese- und Schreibrechte besitzen bzw. auf CHMOD 666 oder CHMOD 777 gesetzt werden.');
    
  break;
  case ('4'):
    define('POPUP_ERROR_HEADING', 'Physikalischer Pfad');
    define('POPUP_ERROR_TEXT', 'Der physikalische Pfad ist der Pfad zum Verzeichnis, wo die Zen Cart Dateien installiert werden. Ein Beispiel: Auf einigen Linux Systemen werden HTML Dateien in das Verzeichnis /var/www/html abgelegt. Wenn Sie nun Ihre Zen Cart Dateien in das Verzeichnis \'shop\' installieren, dann lautet der physikalische Pfad /var/www/html/shop. Normalerweise l&ouml;st das Installationsprogramm den Pfad korrekt auf.');
    
  break;
  case ('5'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTP Pfad');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse, die Sie in Ihrem Browser eingeben um auf Ihre Shopseite zu gelangen. Wenn der Shop in das \'Rootverzeichnis\' installiert wurde, w&uuml;rde diese z.B. \'http://www.ihredomain.at\' lauten. Wenn Sie Ihren Zen Cart Shop z.B. in das Unterverzeichnis \'shop\' installiert haben, so w&uuml;rde diese dann \'http://www.ihredomain.at/shop\' lauten.');
    
  break;
  case ('6'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTPS Server');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse zu Ihrem sicheren SSL Server. Diese Adresse h&auml;ngt von auf Ihrem Webserver installierten SSL Modus ab. Sie k&ouml;nnen auf <a href="http://www.zen-cart.com/modules/xoopsfaq/index.php?cat_id=2#46" target="_blank">Zen Cart FAQ</a> mehr zum Thema SSL erfahren.');
    
  break;
  case ('7'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTPS Path');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse, die Sie in Ihrem Browser eingeben um auf Ihre Shopseite &uuml;ber eine sichere SSL Verbindung zu gelangen, z.B. \'https://www.ihredomain.at\'. Sie k&ouml;nnen auf <a href="http://www.zen-cart.com/modules/xoopsfaq/index.php?cat_id=2#46" target="_blank">Zen Cart FAQ</a> mehr zum Thema SSL erfahren.');
    
  break;
  case ('8'):
    define('POPUP_ERROR_HEADING', 'SSL aktivieren');
    define('POPUP_ERROR_TEXT', 'Diese Einstellung legt fest, ob der SSL Modus (HTTPS:) auf Ihrer Zen Cart Webseite verwendet werden soll oder nicht.<br /><br />TIPP: Jede Seite, in der pers&ouml;nliche Informationen eingegeben werden - z.B. Benutzerkonten, Bestellungen, Kreditkarteninformationen etc. - kann zur Verwendung mit SSL aktiviert werden. Ebenso kann der Admin Bereich damit gesch&uuml;tzt werden.<br /><br />Sie m&uuml;ssen daf&uuml;r Zugang zu einem SSL Server haben (erkennbar durch die Verwendung von HTTPS anstelle von HTTP). <br /><br />Wenn Sie nicht sicher sind ob Sie Zugang zu einem SSL Server haben, lassen Sie diese Option deaktiviert und fragen bei Ihrem Provider nach. Hinweis: Wie alle Einstellungen, k&ouml;nnen Sie diese ebenso nachtr&auml;glich in der configure.php &auml;ndern.');
    
  break;
  case ('9'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den physikalischen Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld f&uuml;r den physikalische Pfad leer gelassen. Bitte geben Sie einen g&uuml;ltigen Eintrag ein.');
    
  break;
  case ('10'):
    define('POPUP_ERROR_HEADING', 'Der physikalische Pfad ist nicht richtig');
    define('POPUP_ERROR_TEXT', 'Der Eintrag f&uuml;r den physikalischen Pfad scheint nicht richtig zu sein. Bitte korrigieren Sie dies und versuchen Sie es noch einmal.');
    
  break;
  case ('11'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den virtuellen HTTP Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld f&uuml;r den virtuellen HTTP Pfad leer gelassen. Bitte geben Sie einen g&uuml;ltigen Pfad an.');
    
  break;
  case ('12'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den virtuellen HTTPS Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld f&uuml;r den virtuellen HTTPS Pfad leer gelassen. Bitte geben Sie einen g&uuml;ltigen Pfad an.');

  break;
  case ('13'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den virtuellen HTTPS Server darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld f&uuml;r den virtuellen HTTPS Pfad leer gelassen, jedoch die Option zur Verwendung des SSL Modus aktiviert. Bitte geben Sie einen g&uuml;ltigen Pfad an oder deaktivieren Sie den SSL Modus');
    
  break;
  case ('14'):
    define('POPUP_ERROR_HEADING', 'Datenbanktyp');
    define('POPUP_ERROR_TEXT', 'Zen Cart unterst&uuml;tzt mehrere Datenbanktypen. Dieses Feature ist jedoch zur Zeit noch nicht vollst&auml;ndig ausgebaut. Derzeit sollten Sie die Einstellung auf der Verwendung von MySQL Datenbanken belassen.');
    
  break;
  case ('15'):
    define('POPUP_ERROR_HEADING', 'Datenbank Host');
    define('POPUP_ERROR_TEXT', 'Das ist der Name des Webservers, auf dem die Datenbank l&auml;uft. In den meisten F&auml;llen kann die Einstellung auf \'localhost\' belassen werden. Andernfalls fragen Sie Ihren Provider nach den Namen Ihres Datenbankservers.');
    
  break;
  case ('16'):
    define('POPUP_ERROR_HEADING', 'Datenbank Benutzername');
    define('POPUP_ERROR_TEXT', 'Jede Datenbank ben&ouml;tigt f&uuml;r den Zugriff einen Benutzernamen. Den Benutzernamen erhalten Sie bei Ihrem Provider.');
    
  break;
  case ('17'):
    define('POPUP_ERROR_HEADING', 'Datenbank Passwort');
    define('POPUP_ERROR_TEXT', 'Jede Datenbank ben&ouml;tigt f&uuml;r den Zugriff ein Passwort. Dieses Passwort erhalten Sie bei Ihrem Provider.');
    
  break;
  case ('18'):
    define('POPUP_ERROR_HEADING', 'Datenbank Name');
    define('POPUP_ERROR_TEXT', 'Das ist der Name der Datenbank, die Sie zur Verwendung von Zen Cart ben&ouml;tigen. Wenn Sie nicht sicher sind wof&uuml;r Sie das ben&ouml;tigen, kontaktieren Sie Ihren Provider.');
    
  break;
  case ('19'):
    define('POPUP_ERROR_HEADING', 'Datenbank Pr&auml;fix');
    define('POPUP_ERROR_TEXT', 'Mit Zen Cart ist es m&ouml;glich, den verwendeten Tabellen ein Pr&auml;fix voranzustellen. Diese Funktion ist hilfreich, wenn Sie z.B. nur eine Datenbank aber mehrere Skripte installiert haben, die auf diese Datenbank zugreifen. Grunds&auml;tzlich sollten Sie die vorgegebene Standardeinstellung verwenden.');
    
  break;
  case ('20'):
    define('POPUP_ERROR_HEADING', 'Datenbank erstellen');
    define('POPUP_ERROR_TEXT', 'Diese Einstellung gibt an, ob das Installationsprogramm versuchen soll, eine Datenbank zu erstellen. Hinweis: Die Option \'erstellen\' hat nichts mit dem Hinzuf&uuml;gen von Tabellen zu tun, die Zen Cart ben&ouml;tigt (welche sowieso automatisch erstellt werden). Viele Provider geben Ihren Benutzern nicht das Recht, Datenbanken zu \'erstellen\', bieten jedoch eine andere M&ouml;glichkeit zum erstellen einer Datenbank (z.B. cPanel oder phpMyAdmin). Im Zweifelsfall kontaktieren sie bitte Ihren Provider.');
    
  break;
  case ('21'):
    define('POPUP_ERROR_HEADING', 'Datenbankverbindung');
    define('POPUP_ERROR_TEXT', 'Eine dauerhafte Verbindung ist eine Methode zur Reduzierung des Ladevorgangs der Datenbank. Sie sollten im Zweifelsfall Ihren Provider konsultieren, bevor Sie diese Einstellung aktivieren. Eine Aktivierung der Einstellung "dauerhafte Verbindung" kann zu Problemen in der Datenbank f&uuml;hren, wenn der Datenbankserver f&uuml;r diese Einstellung nicht konfiguriert wurde.<br /><br /> Daher noch einmal unser Rat: Sie sollten im Zweifelsfall Ihren Provider konsultieren, bevor Sie diese Einstellung aktivieren.');
    
  break;
  case ('22'):
    define('POPUP_ERROR_HEADING', 'Datenbanksitzung');
    define('POPUP_ERROR_TEXT', 'Diese Einstellung legt fest, ob Sitzungen in eine Datei oder in der Datenbank gespeichert werden sollen. Dateigespeicherte Sitzungen sind schneller, datenbankgespeicherte Sitzungen sind sicherer und empfiehlt sich bei Onlineshops mit sicherer SSL Verbindung.');
    
  break;
  case ('23'):
    define('POPUP_ERROR_HEADING', 'SSL aktivieren');
    define('POPUP_ERROR_TEXT', '');
    
  break;
  case ('24'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den DB Host darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Der Eintrag f&uuml;r den Datenbank Host darf nicht leer sein. Bitte geben Sie einen g&uuml;ltigen Namen f&uuml;r den Datenbank Host ein. <br />Das ist der Name f&uuml;r den Webserver, auf dem die Datenbank l&auml;uft. In den meisten F&auml;llen kann der Eintrag \'localhost\' verwendet werden. In Ausnahmef&auml;llen m&uuml;ssen Sie Ihren Provider f&uuml;r den Namen des Datenbank Hosts konsultieren.');
  break;
  
  case ('25'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den DB Namen darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Der Eintrag f&uuml;r Datenbank Namen darf nicht leer sein. Bitte geben Sie den Namen Ihrer Datenbank ein.<br />Das ist der Name f&uuml;r die Datenbank, die Sie zur Verwendung mit Zen Cart ben&ouml;tigen. Wenn Sie sich nicht sicher sind, fragen Sie bitte Ihren Provider f&uuml;r weiter Informationen.');
    
  break;
  case ('26'):
    define('POPUP_ERROR_HEADING', 'SQL Installationsdatei existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die SQL Datei, die zur Installation von Zen Cart ben&ouml;tigt wird, existiert nicht. Diese Datei sollte im \'zc_install\' Verzeichnis vorhanden sein und lautet so &auml;hnlich wie \'mysql_zencart.sql\'.');
    
  break;
  case ('27'):
    define('POPUP_ERROR_HEADING', 'Datenbank nicht unterst&uuml;tzt');
    define('POPUP_ERROR_TEXT', 'Der Datenbanktyp, den Sie ausgew&auml;hlt haben, scheint von Ihrer installierten PHP Version nicht unterst&uuml;tzt zu werden. Kl&auml;ren Sie dies mit Ihrem Provider, ob der gew&auml;hlte Datenbanktyp f&uuml;r die verwendete PHP Version kompiliert wurde und ob die notwendigen Module/DLLs geladen sind.');
    
  break;
  case ('28'):
    define('POPUP_ERROR_HEADING', 'Verbindung zur Datenbank fehlgeschlagen');
    define('POPUP_ERROR_TEXT', 'Es konnte keine Verbindung zur Datenbank hergestellt werden. Daf&uuml;r kann es mehrere Ursache geben: <br /><br />Sie haben entweder einen falschen DB Hostnamen angegeben oder der DB Benutzername bzw. das <em>DB Passwort </em>ist falsch. <br /><br />Ebenso kann der Name der Datenbank falsch sein. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben auf Richtigkeit und versuchen Sie es noch einmal.');
    
  break;
  case ('29'):
    define('POPUP_ERROR_HEADING', 'Datenbank konnte nicht erstellt werden');
    define('POPUP_ERROR_TEXT', 'Eventuell haben Sie keine Berechtigung zum Erstellen einer leeren Datenbank. Setzen Sie sich bitte mit Ihrem Provider in Verbindung um eventuell eine Datenbank f&uuml;r Sie zu erstellen. Alternativ h&auml;lt Ihr Provider cPanel oder phpMyAdmin zum Erstellen einer Datenbank f&uuml;r Sie bereit. Wenn Sie dann eine Datenbank erstellt haben, DEAKTIVIEREN Sie bitte die Option \'Datenbank erstellen\', um mit der Installation fortfahren zu k&ouml;nnen.');
    
  break;
  case ('30'):
    define('POPUP_ERROR_HEADING', 'Database existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datenbank, die Sie angegeben haben, scheint nicht zu existieren. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben und korrigieren Sie diese gegebenenfalls.');
    
  break;
  case ('31'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den Shopnamen darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie einen Namen f&uuml;r Ihren Shop ein.');
    
  break;
  case ('32'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den Shopbetreiber darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie den Namen des Shopbetreibers ein. Diese Information wird in der \'Schreiben Sie uns\' Seite, in der \'Willkommen\' e-Mail und an anderen Stellen im Shop sichtbar sein.');
    
  break;
  case ('33'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r die Shop e-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie die prim&auml;re e-Mail Adresse des Shops ein. Diese e-Mail Adresse wird als Kontaktadresse in e-Mails, die vom Shop gesendet werden, verwendet. Diese Adresse wird im Shop standardm&auml;&szlig;ig nicht angezeigt.');
    
  break;
  case ('34'):
    define('POPUP_ERROR_HEADING', 'Die e-Mail Adresse f&uuml;r den Shop ist nicht g&uuml;ltig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie eine g&uuml;ltige e-Mail Adresse an.');
    
  break;
  case ('35'):
    define('POPUP_ERROR_HEADING', 'Die Adresse f&uuml;r den Shop ist nicht g&uuml;ltig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie die Strasse, die Postleitzahl, die Stadt und das Land des Shops an. Diese Anschrift wird in der \'Schreiben Sie uns\' Seite (kann bei Bedarf deaktiviert werden) und auf den Rechnungen angezeigt. Ebenso ist diese Adresse f&uuml;r Kunden, die per Vorkasse zahlen, w&auml;hrend der Bestellung sichtbar.');
    
  break;
  case ('36'):
    define('POPUP_ERROR_HEADING', 'Die SQL Datei f&uuml;r die Demoartikel existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die SQL Datei f&uuml;r die Demoartikel konnte nicht gefunden werden. Bitte stellen Sie sicher, dass die Datei /zc_install/demo/xxxxxxx_demo.sql vorhanden ist. (xxxxxxx = Ihr verwendeter Datenbanktyp).');
    
  break;
  case ('37'):
    define('POPUP_ERROR_HEADING', 'Shopname');
    define('POPUP_ERROR_TEXT', 'Der Name des Shops. Dieser Name wird in e-Mails, die von Shop gesendet werden, verwendet und auf einigen Shopseiten als Browsertitel.');
    
  break;
  case ('38'):
    define('POPUP_ERROR_HEADING', 'Shopinhaber');
    define('POPUP_ERROR_TEXT', 'Dieser Name wird in einigen e-Mails, die vom Shop gesendet werden, verwendet.');
    
  break;
  case ('39'):
    define('POPUP_ERROR_HEADING', 'e-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Diese Adresse dient als Kontaktadresse f&uuml;r den Shop. Die meisten e-Mails, die vom Shop gesendet werden - ebenso die \'Schreiben Sie uns\' Seite - benutzen diese Adresse.');
    
  break;
  case ('40'):
    define('POPUP_ERROR_HEADING', 'Land');
    define('POPUP_ERROR_TEXT', 'Das Land, von dem aus der Shop betrieben wird. Es ist sehr wichtig, dass Sie hier korrekte Angaben machen, da davon u.A. die Berechnung der Steuern und der Versandkosten abh&auml;ngig ist.');
    
  break;
  case ('41'):
    define('POPUP_ERROR_HEADING', 'Bundesland');
    define('POPUP_ERROR_TEXT', 'Das Bundesland, in dem der Shop betrieben wird. Es ist sehr wichtig, dass Sie hier korrekte Angaben machen, da davon ev. die Berechnung der Steuern und der Versandkosten abh&auml;ngig sein kann.');
    
  break;
  case ('42'):
    define('POPUP_ERROR_HEADING', 'Shopdresse');
    define('POPUP_ERROR_TEXT', 'Ihre Shopadresse - wird auf Rechnungen und bei der Bestellung verwendet');
    
  break;
  case ('43'):
    define('POPUP_ERROR_HEADING', 'Standardsprache');
    define('POPUP_ERROR_TEXT', 'Die Sprache, mit der Ihr Shop betrieben werden soll. Zen Cart kann multilingual ausgebaut werden - vorausgesetzt, Sie haben die dazu notwendigen Sprachdateien.');
    
  break;
  case ('44'):
    define('POPUP_ERROR_HEADING', 'Standardw&auml;hrung');
    define('POPUP_ERROR_TEXT', 'W&auml;hlen Sie die W&auml;hrung aus, mit der der Shop standardm&auml;&szlig;ig betrieben werden soll. Wenn Ihre W&auml;hrung hier nicht aufgelistet ist, k&ouml;nnen Sie diese nach der Installation einfach im Admin Bereich &auml;ndern.');
    
  break;
  case ('45'):
    define('POPUP_ERROR_HEADING', 'Demoartikel installieren');
    define('POPUP_ERROR_TEXT', 'Bitte w&auml;hlen Sie, ob Sie Demoartikel verwenden wollen. Diese Demodaten enthalten einige Beispiele zur Demonstration der Leistungsf&auml;higkeit des Shops.');
    
  break;
  case ('46'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r den Admin Benutzername darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Um sich im Admin Bereich anmelden zu k&ouml;nnen, ben&ouml;tigen Sie einen Admin Benutzernamen.');
    
  break;
  case ('47'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r die Admin e-Mail Adresse darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Die Admin e-Mail Adresse ist notwendig z.B. f&uuml;r den Fall, dass Sie Ihr Passwort vergessen haben und Sie es sich - per e-Mail - zusenden lassen m&uuml;ssen.');
    
  break;
  case ('48'):
    define('POPUP_ERROR_HEADING', 'Die e-Mail Admin Adresse ist nicht g&uuml;ltig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie eine g&uuml;ltige e-Mail Adresse an.');
    
  break;
  case ('49'):
    define('POPUP_ERROR_HEADING', 'Admin Passwort darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Aus Sicherheitsgr&uuml;nden darf das Admin Passwort nicht leer sein.');
    
  break;
  case ('50'):
    define('POPUP_ERROR_HEADING', 'Passwort stimmt nicht &uuml;berein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie das Passwort und die Passwortbest&auml;tigung erneut ein.');
    
  break;
  case ('51'):
    define('POPUP_ERROR_HEADING', 'Admin Benutzername');
    define('POPUP_ERROR_TEXT', 'Um sich im Admin Bereich anmelden zu k&ouml;nnen, ben&ouml;tigen Sie einen Admin Benutzernamen.');
    
  break;
  case ('52'):
    define('POPUP_ERROR_HEADING', 'Admin e-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Die Admin e-Mail Adresse ist notwendig z.B. f&uuml;r den Fall, dass Sie Ihr Passwort vergessen haben und Sie es sich - per e-Mail - zusenden lassen m&uuml;ssen.');
    
  break;
  case ('53'):
    define('POPUP_ERROR_HEADING', 'Admin Passwort');
    define('POPUP_ERROR_TEXT', 'Das Admin Passwort dient zu Ihrer Sicherheit und erm&ouml;glicht Ihnen den Zugang zum Admin Bereich.');
    
  break;
  case ('54'):
    define('POPUP_ERROR_HEADING', 'Admin Passwortbest&auml;tigung');
    define('POPUP_ERROR_TEXT', 'Dient zur &Uuml;berpr&uuml;fung des eingegebenen Passworts und soll vor Tippfehlern vorbeugen.');
    
  break;
  case ('55'):
    define('POPUP_ERROR_HEADING', 'Die PHP Version wird nicht unterst&uuml;tzt');
    define('POPUP_ERROR_TEXT', 'Ihre PHP Version wird von Zen cart nicht unterst&uuml;tzt. Ebenso sind in der PHP Version 4.1.2 einige Bugs enthalten, die z.B. Probleme beim Zugriff auf den Admin Bereich verursachen. Sie werden angehalten, Ihre PHP Version nach M&ouml;glichkeit zu aktualisieren.');
    
  break;
  case ('56'):
    define('POPUP_ERROR_HEADING', 'In die Admin configure.php kann nicht geschrieben werden');
    define('POPUP_ERROR_TEXT', 'In die Datei admin/includes/configure.php kann nicht geschrieben werden. Bitte setzten Sie die entsprechenden Schreibrechte (auf Unix oder Linux Systemen z.B. setzten Sie - bis zum Abschluss der Installation - die Rechte auf CHMOD 777 oder 666 und auf Windows Systemen deaktivieren Sie den Schreibschutz der Datei).');
    
  break;
  case ('57'):
    define('POPUP_ERROR_HEADING', 'in die Shop configure.php kann nicht geschrieben werden');
    define('POPUP_ERROR_TEXT', 'In die Datei /includes/configure.php kann nicht geschrieben werden. Bitte setzten Sie die entsprechenden Schreibrechte (auf Unix oder Linux Systemen z.B. setzten Sie - bis zum Abschluss der Installation - die Rechte auf CHMOD 777 oder 666 und auf Windows Systemen deaktivieren Sie den Schreibschutz der Datei).');
    
  break;
  case ('58'):
    define('POPUP_ERROR_HEADING', 'Datenbank Pr&auml;fix');
    define('POPUP_ERROR_TEXT', 'Zen Cart bietet Ihen die M&ouml;glichkeit, ein Pr&auml;fix f&uuml;r die Tabellen Ihrer Datenbank zu verwenden. Diese Funktion ist hilfreich, wenn Sie z.B. nur eine Datenbank aber mehrere Skripte installiert haben, die auf diese Datenbank zugreifen. Grunds&auml;tzlich sollten Sie die vorgegebene Standardeinstellung verwenden.');
    
  break;
  case ('59'):
    define('POPUP_ERROR_HEADING', 'SQL Cache Verzeichnis');
    define('POPUP_ERROR_TEXT', 'SQL Abfragen k&ouml;nnen entweder in der Datenbank oder in eine Datei auf Ihrem Webserver oder &uuml;berhaupt nicht gespeichert werden. Wenn Sie sich f&uuml;r eine dateibasierte Speicherung entscheiden, geben Sie bitte das Verzeichnis, in der sich die Datei befindet, an. <br /><br />Die Standardinstallation von Zen Cart beinhaltet bereits einen \'cache\' Ordner. Stellen Sie sicher, dass die notwendigen Schreibrechte f&uuml;r diesen Ordner gesetzt sind.<br /><br />Bitte stellen Sie sicher, dass das gew&auml;hlte Verzeichnis existiert und die notwendigen Schreibrechte gesetzt sind (CHMOD 777 oder mindestens CHMOD 666).');
    
  break;
  case ('60'):
    define('POPUP_ERROR_HEADING', 'SQL Cache Methode');
    define('POPUP_ERROR_TEXT', 'Einige SQL Abfragen sind Cache - f&auml;hig und sind als solche markiert. Diese Methode bietet einen Geschwindigkeitsvorteil. Sie k&ouml;nnen entscheiden, welche Methode Sie zum Zwischenspeichern von SQL Abfragen verwenden wollen.<br /><br /><strong>None - Kein Cache</strong>. Keine SQL Abfragen werden zwischengespeichert. Wenn Sie wenige Kategorien/Artikel haben, kann diese Methode die bessere Wahl sein.<br /><br /><strong>File - Cache in eine Datei</strong>. SQL Abfragen werden in eine Datei auf der Festplatte Ihres Webservers gespeichert. F&uuml;r die einwandfreie Funktion muss sichergestellt sein, dass das Verzeichnis, wo die Abfragen gespeichert werden, die notwendigen Lese- und Schreibrechte besitzt. Diese Methode kann bei Seiten mit gro&szlig;em Kategorie-/Artikelbestand die bessere Wahl sein.<br /><br /><strong>Database - Datenbank Cache</strong>. SQL Abfragen werden in eine daf&uuml;r vorgesehene Tabelle in der Datenbank gespeichert. Klingt komisch, ist aber so ;-) - Diese Methode kann bei Seiten mit mittleren Kategorie-/Artikelbestand einen Geschwindigkeitsvorteil bringen.');
    
  break;
  case ('61'):
    define('POPUP_ERROR_HEADING', 'Das Feld f&uuml;r das Sitzungs/SQL Cache Verzeichnis darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, m&uuml;ssen Sie ein Verzeichnis angeben. Stellen Sie auch sicher, dass der Server die notwendigen Rechte zum Schreiben f&uuml;r dieses Verzeichnis besitzt.');
    
  break;
  case ('62'):
    define('POPUP_ERROR_HEADING', 'Das Session/SQL Cache Verzeichnis existiert nicht');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, muss ein Verzeichnis f&uuml;r das Speichern von SQL Abfragen vorhanden sein. Stellen Sie sicher, dass das Verzeichnis vorhanden ist und der Server die notwendigen Rechte zum Schreiben f&uuml;r dieses Verzeichnis besitzt.');
    
  break;
  case ('63'):
    define('POPUP_ERROR_HEADING', 'In das Sitzungs/SQL Cache Verzeichnis kann nicht geschrieben werden');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, muss ein Verzeichnis f&uuml;r das Speichern von SQL Abfragen und die notwendigen Lese- und Schreibrechte vorhanden sein. Stellen Sie sicher, dass das Verzeichnis vorhanden ist und der Server die notwendigen Rechte zum Schreiben f&uuml;r dieses Verzeichnis besitzt (Auf Unix/Linux Systemen stellen Sie CHMOD 666 oder 777 ein und auf Windows Systemen deaktivieren Sie den Schreibschutz.');
    
  break;
  case ('64'):
    define('POPUP_ERROR_HEADING', 'Wollen Sie einen Link zu einem phpBB Forum auf Ihren Shop anbieten?');
    define('POPUP_ERROR_TEXT', 'Wenn Sie m&ouml;chten, dass Ihr Zen Cart Shop einen Link zu einem bereits existierendes phpBB Forum haben soll, w&auml;hlen Sie \'ja\'.');
    
  break;
  case ('65'):
    define('POPUP_ERROR_HEADING', 'phpBB Datenbank Pr&auml;fix');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie das Pr&auml;fix der Datenbanktabellen f&uuml;r Ihr phpBB Forum an. Normalerweise lautet dieser \'phpBB_\'');
    
  break;
  case ('66'):
    define('POPUP_ERROR_HEADING', 'phpBB Datenbankname');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie heri den Namen der Datenbank Ihres phpBB Forums bekannt.');
  break;
  case ('67'):
    define('POPUP_ERROR_HEADING', 'phpBB Verzeichnis');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie hier den vollst&auml;ndigen relativen Pfad zu Ihren phpBB Dateien an. Damit erm&ouml;glichen Sie Ihrem Zen Cart Shop Kunden, die auf den phpBB Link klicken, direkt zum phpBB Forum weiter zu leiten.<br /><br />Der Pfad, der hier eingegeben werden muss, ist relativ zum "Rootverzeichnis" ihres Webservers. Wenn z.B. Ihre phpBB Forum Installation in <strong>/home/users/username/public_html/phpbb </strong> liegt, dann m&uuml;ssen Sie <strong>/home/users/username/public_html/phpbb/ </strong>eingeben. Wenn diese in einem Unterordner liegen, so muss dieser im Pfad angegeben werden.<br /><br />Zen Cart wird versuchen, die Datei "<em>config.php</em>" in diesem Ordner zu finden.');
  break;
  case ('68'):
    define('POPUP_ERROR_HEADING', 'phpBB Verzeichnis');
    define('POPUP_ERROR_TEXT', 'Es konnte keine phpBB Konfigurationsdatei in dem von Ihnen angegebenen Verzeichnis gefunden werden. phpBB muss bereit installiert sein, wenn Sie diese automatische Konfiguration verwenden wollen. Andernfalls &uuml;berspringen Sie diese Konfiguration und Installieren Sie es zu einem sp&auml;teren Zeitpunkt.<br /><br />Der Pfad, der hier eingegeben werden muss, ist relativ zum "Rootverzeichnis" ihres Webservers. Wenn z.B. Ihre phpBB Forum Installation in <strong>/home/users/username/public_html/phpbb </strong> liegt, dann m&uuml;ssen Sie <strong>/home/users/username/public_html/phpbb/ </strong>eingeben. Wenn diese in einem Unterordner liegen, so muss dieser im Pfad angegeben werden.<br /><br />Zen Cart wird versuchen, die Datei "<em>config.php</em>" in diesem Ordner zu finden.');
  break;
  case ('69'):
    define('POPUP_ERROR_HEADING', 'Register Globals');
    define('POPUP_ERROR_TEXT', 'Zen Cart funktioniert mit "Register Globals" ON und OFF. Jedoch bietet die Einstellung der "Register Globals" auf "OFF" mehr Sicherheit f&uuml;r Ihr System.');
  break;
  case ('70'):
    define('POPUP_ERROR_HEADING', 'Safe Mode ist ON');
    define('POPUP_ERROR_TEXT', 'Zen Cart, eine Full-Service e-Commerce Anwendung, funktioniert nicht richtig auf Servern mit aktiviertem Safe Mode.<br /><br />Um ein professionelles e-Commerce System zu betreiben, ben&ouml;tigen Sie oftmals mehr Features als es "Billig-Anbieter" auf "Shared-Hostings" erm&ouml;glichen k&ouml;nnen. Um das Optimum aus Ihrem Shopsystems heraus zu holen, bitten Sie Ihren Provider, in der php.ini die Einstellung "SAFE_MODE =OFF" zu setzten.');
  break;
  case ('71'):
    define('POPUP_ERROR_HEADING', 'Der Ordner f&uuml;r die Cache Option wird ben&ouml;tigt');
    define('POPUP_ERROR_TEXT', 'Wenn Sie "Datei-basierten SQL Cache" in Zen Cart verwenden wollen, stellen Sie sicher, dass ein Ordner mit den entsprechenden Lese- und Schreibrechten auf dem Webserver vorhanden ist.<br /><br />Optional k&ouml;nnen Sie auch die Option "Datenbank Cache" oder" Kein Cache" w&auml;hlen. In diesem Fall k&ouml;nnen Sie "Sitzungen speichern" deaktivieren.<br /><br />Um den Ordner die ben&ouml;tigten rechte zu erteilen, verwenden Sie Ihr FTP Programm oder Ihren Shell Zugang, um die Lese- und Schreibrechte auf CHMOD 666 oder 777 zu setzten.<br /><br />Im Speziellen fall muss die userID Ihres Webservers (z.B.: \'apache\' oder \'www-user\' oder vielleicht \'IUSR_irgendwas\' unter Windows) s&auml;mtliche \'Lese- Schreib- und L&ouml;schrechte\' etc. f&uuml;r den Cache Ordner besitzen.');
  break;
  case ('72'):
    define('POPUP_ERROR_HEADING', 'FEHLER: Es konnten nicht alle configure.php Dateien mit den neuen Einstellungen gespeichert werden');
    define('POPUP_ERROR_TEXT', 'Bei dem Versuch Ihre configure.php Dateien zu aktualisieren, ist ein Fehler aufgetreten. Sie m&uuml;ssen die Konfigurationsdateien /includes/configure.php und /admin/includes/configure.php manuell bearbeiten und stellen Sie sicher, dass die "define" f&uuml;r "DB_PREFIX" korrekt f&uuml;r die Tabellen der Zen Cart Datenbank eingestellt ist.');
  break;
  case ('73'):
    define('POPUP_ERROR_HEADING', 'FEHLER: Das neue Pr&auml;fix der Tabellen konnten nicht auf alle Tabellen angewendet werden');
    define('POPUP_ERROR_TEXT', 'Bei dem Versuch, das Pr&auml;fix der Tabellen umzubenennen, ist ein Fehler aufgetreten. Bitte &uuml;berpr&uuml;fen Sie die Namen der Tabellen in Ihrer Zen Cart Datenbank manuell. Im schlimmsten Fall m&uuml;ssen Sie eine Datenbank-Wiederherstellung von Ihrer Sicherung durchf&uuml;hren.');
  break;
  case ('74'):
    define('POPUP_ERROR_HEADING', 'HINWEIS: PHP "session.save_path" ist nicht beschreibbar');
    define('POPUP_ERROR_TEXT', '<strong>Das ist nur ein Hinweis</strong>, der Ihnen mitteilt, dass Sie nicht in den durch die PHP-Einstellung "session.save_path" festgelegten Pfad schreiben k&ouml;nnen.<br /><br />Das hei&szlig;t Sie k&ouml;nnen diesen Pfad nicht zum Speichern tempor&auml;rer Dateien nutzen.  Nutzen Sie stattdessen den vorgeschlagenen Cache-Pfad.');
  break;
  case ('75'):
    define('POPUP_ERROR_HEADING', 'HINWEIS: PHP "magic_quotes_runtime" ist aktiv');
    define('POPUP_ERROR_TEXT', 'Es empfiehlt sich "magic_quotes_runtime" zu deaktivieren. Ist es dennoch aktiv kann es unerwartete SQL Fehler (1064) verursachen.<br /><br />Wenn Sie es nicht f&uuml;r den kompletten Server deaktivieren k&ouml;nnen, ist es evtl. per .htaccess oder Ihre eigene php.ini-Datei in Ihrem privaten Webspace m&ouml;glich. Bitten Sie Ihren Provider um Hilfe.');
  break;
  case ('76'):
    define('POPUP_ERROR_HEADING', 'Database Engine Versions-Informationen unbekannt');
    define('POPUP_ERROR_TEXT', 'Die Version Ihrer Datenbank-Engine kann nicht ermittelt werden.<br /><br />Das ist nicht zwingend ein ernsthaftes Problem. Das kann auf Produktivsystem absolut &uuml;lich sein.<br /><br />Es ist ok, fortzufahren, wenn diese Information als "Unknown" angezeigt wird.');
  break;
  case ('77'):
    define('POPUP_ERROR_HEADING', 'Datei-Uploads sind DEAKTIVIERT');
    define('POPUP_ERROR_TEXT', 'Datei-Uploads sind DEAKTIVIERT. Um sie zu aktivieren, stellen Sie sicher, dass <em><strong>file_uploads = on</strong></em> in Ihrer php.ini Datei vorhanden ist.');
  break;
  case ('78'):
    define('POPUP_ERROR_HEADING', 'ADMIN PASSWORT IST F&Uuml;R EIN UPDATE NOTWENDIG');
    define('POPUP_ERROR_TEXT', 'Der Admin-Nutzername sowie das Passwort des Shops wird ben&ouml;tigt um die notwendigen &Auml;nderungen in der Datenbank vornehmen zu k&ouml;nnen.<br /><br />Bitte geben Sie einen g&uuml;ltigen Nutzernamen sowie das daszugeh&ouml;rige Passwort ein.');
  break;
  case ('79'):
    define('POPUP_ERROR_HEADING','OpenSSL Information');
    define('POPUP_ERROR_TEXT','OpenSSL ist "eine" M&ouml;glichkeit um Ihren Server SSL-f&auml;hig (https://) zu machen.<br /><br />Sollte dies nicht m&ouml;glich sein, kann es folgende Ursachen haben:<br />(a) Ihr Provider unterst&uuml;tzt SSL nicht<br />(b) Auf Ihrem Webserver ist OpenSSL nicht installiert, aber es K&Ouml;NNTE eine anderer SSL-Service verf&uuml;gbar sein<br />(c) Ihr Provider wei&szlig; nicht &uuml;ber Ihr SSL-Zertifikat bescheid, so dass sie SSL-Unterst&uuml;tzung f&uuml;r Ihre Domain freischalten.<br />(d) PHP ist noch nicht f&uuml;r die Verwendung von OpenSSL konfiguriert.<br /><br />Sie sollten auf jeden Fall Ihren Provider kontaktieren, wenn Sie SLL-Verschl&uuml;sselung verwenden wollen.');
  break;
  case ('80'):
    define('POPUP_ERROR_HEADING', 'PHP Session Support wird ben&ouml;tigt');
    define('POPUP_ERROR_TEXT', 'Sie m&uuml;ssen PHP Sessions auf Ihrem Webserver aktivieren. Sie k&ouml;nnten versuchen folgendes Modul zu installieren: php4-session ');
  break;
  case ('81'):
    define('POPUP_ERROR_HEADING', 'PHP sollte nicht als CGI laufen, sofern der Server nicht auf Windows l&auml;uft');
    define('POPUP_ERROR_TEXT', 'PHP als CGI auszuf&uuml;hren kann auf einigen Linux/Unix-Servern Probleme verursachen.<br /><br />Windows-Servers, f&uuml;hren PHP immer als CGI-Modul aus. In diesem Fall kann diese Warnung ignoriert werden..');
  break;
  case ('82'):
    define('POPUP_ERROR_HEADING', ERROR_TEXT_DISABLE_FUNCTIONS);
    define('POPUP_ERROR_TEXT', 'In Ihre PHP Konfiguration (php.ini) sind eine oder mehrere der folgenden Funktionen deaktiviert:<br /><ul><li>set_time_limit</li><li>exec</li></ul>Ihr Server leidet wahrscheinlich unter gedrosselter Leistung um die Sicherheitsma&szlig;nahmen zu gew&auml;hrleisten. Dies wird meist auf hoch frequentierten &ouml;ffentlichen Servern gemacht. Das ist allerdings nicht optimal f&uuml;r e-Commerce-Systeme.<br /><br />Deshalb sollten Sie sich mit Ihrem Provider in Verbindung setzen, um eine L&ouml;sung f&uuml;r dieses Problem zu finden.');
  break;
  case ('83'):
    define('POPUP_ERROR_HEADING','Unerlaubtes Zeichen im Tabellen-Pr&auml;fix');
    define('POPUP_ERROR_TEXT','Der Tabellen-Pr&auml;fix darf keines der folgenden Zeichen enthalten :<br />
&nbsp;&nbsp; / oder \\ oder . <br /><br />Bitte nutzen Sie einen anderen Pr&auml;fix. Wir empfehlen sowas wie "zen_" .');
  break;
  case ('84'):
    define('POPUP_ERROR_HEADING','PHP Session.autostart sollte deaktiviert werden.');
    define('POPUP_ERROR_TEXT','Die session.auto_start Option in Ihrer php.ini ist auf ON gesetzt. <br /><br />Dies k&ouml;nnte evtl. zu Problemen mit dem Session-Handling f&uuml;hren, da Zen Cart Sessions startet sobald es bereit ist. Das automatische Starten der Sessions kann bei einigen Server-Konfigurationen zu Fehlern f&uuml;hren.<br /><br />Um die Option zu deaktivieren, k&ouml;nnen Sie folgenden Eintrag in einer .htaccess-Datei (Wurzelverzeichnis) probieren: <br /><br /><code>php_value session.auto_start 0</code>');
  break;
  case ('85'):
    define('POPUP_ERROR_HEADING','Einige Updates (SQL) konnten nicht installiert werden.');
    define('POPUP_ERROR_TEXT','W&auml;hrend des Datenbank-Updates wurden einige SQL-Anweisungen nicht ausgef&uuml;hrt damit keine doppelten Eintr&auml;ge entstehen.<br /><br />Die h&auml;ufigsten Ursachen dieser Fehler/Ausnahmen sind installierte Add-Ons die &Auml;nderungen an der Kern-Datenbank-Struktur vornehmen. Der Updater versucht keine Probleme zu generieren. <br /><br />Ihr Shop sollte trotz dieser Fehler funktionieren. Wir empfehlen trotzdem dies vorher zu testen. <br /><br />Wollen Sie die Fehler dennoch untersuchen k&ouml;nnen Sie in der Tabelle "upgrade_exceptions" nach Details suchen.');
  break;
  case ('86'):
    define('POPUP_ERROR_HEADING','PHP Session.use_trans_sid sollte deaktiviert werden.');
    define('POPUP_ERROR_TEXT','Die session.use_trans_sid Option in Ihrer php.ini ist auf ON gesetzt. <br /><br />Dies k&ouml;nnte evtl. zu Problemen mit dem Session-Handling f&uuml;hren.<br /><br />Durch setzen einer .htaccess mit einem Parameter (<a href="http://www.olate.com/articles/252">http://www.olate.com/articles/252</a>) kann man dies umgehen. Oder Sie deaktivieren diese Einstellung in Ihrer php.ini.<br /><br />Mehr Informationen zu Sicherheitsrisiken erhalten Sie hier: <a href="http://shh.thathost.com/secadv/2003-05-11-php.txt">http://shh.thathost.com/secadv/2003-05-11-php.txt</a>.');
  break;
  case ('87'):
    define('POPUP_ERROR_HEADING','Zugriffsrechte f&uuml;r Datenbank-Nutzer ben&ouml;tigt');
    define('POPUP_ERROR_TEXT','Zen Cart ben&ouml;tigt das folgende Datenbank-Zugriffsrechte:<ul><li>ALL PRIVILEGES<br /><em>oder</em></li><li>SELECT</li><li>INSERT</li><li>UPDATE</li><li>DELETE</li><li>CREATE</li><li>ALTER</li><li>INDEX</li><li>DROP</li></ul>Im t&auml;glichen Gebrauch ben&ouml;tigt man zwar keine "CREATE" und "DROP" Rechte, aber diese sind f&uuml;r die Installation, ein Update oder SQL-Patches unverzichtbar.');
  break;
  case ('88'):
    define('POPUP_ERROR_HEADING','Fehler beim schreiben in /includes/configure.php');
    define('POPUP_ERROR_TEXT','Bei dem Versuch Ihre Einstellungen in die daf&uuml;r vorgesehne Datei (configure.php) zu schreiben konnte Zen Cart&trade;-Installer das erfolgreiche Schreiben der Datei nicht best&auml;tigen. Bitte pr&uuml;fen Sie die Zugriffsrechte der configure.php-Dateien.<br /><br />- /includes/configure.php<br />- /admin/includes/configure.php<br /><br />Bitte pr&uuml;fen Sie ebenfalls, dass ausreichend Webspace zur Verf&uuml;gung steht. <br /><br />Sollten die Dateien eine Gr&ouml;&szlig;e von 0-bytes haben, ist wahrscheinlich nicht gen&uuml;gend Plattenplatz vorhanden.<br /><br />Optimale Zugriffsrechte f&uuml;r Unix/Linux: CHMOD 777 bis Intalltion komplett, danach CHMOD 644 oder 444.<br /><br />Unter Windows sollte nach der Installation der Schreibschutz aktiviert werden.');
  break;
  case ('89'):
    define('POPUP_ERROR_HEADING','GD Support Details');
    define('POPUP_ERROR_TEXT','Zen Cart&trade; nutzt GD in PHP, soweit vorhanden, um Bilder zu verarbeiten. version 2.0 wird empfohlen.<br /><br />Sollte die GD-Unterst&uuml;tzung nicht in die PHP-Installation eincompiliert worden sein, sollten sie Ihren Provider um Hilfe bitten.');
  break;
  case ('90'):
    define('POPUP_ERROR_HEADING','MySQL 5 wird nicht vollst&auml;ndig unterst&uuml;tzt');
    define('POPUP_ERROR_TEXT','Es wurde viel M&uuml;he investiert um Datenbank-Abfragen in Zen Cart&trade; mit MySQL 5 kompatibel zu machen, trotzdem ist ein vollst&auml;ndiger Test noch nicht abgeschlossen.<br /><br />Sie k&ouml;nnen die Installation fortsetzen, sollten aber immer beachten, dass die vollst&auml;ndige Unterst&uuml;tzung noch in der Entwicklung ist.<br /><br />Sollten Sie bei der Nutzung von Zen Cart&trade; mit MySQL 5 auf SQL-Fehlermeldungen sto&szlig;en, melden Sie diese bitte in unserem Support-Forum (Bitte schauen Sie erst, ob das Problem nicht schon gemeldet wurde!), so dass wir das Problem beheben k&ouml;nnen.');
  break;
  case ('91'):
    define('POPUP_ERROR_HEADING','PHP-Versions Warnung');
    define('POPUP_ERROR_TEXT','Zen Cart&trade; l&auml;uft mit PHP ab Version 4.3.2.<br /><br />&Auml;ltere PHP-Versionen besitzen einige von Zen Cart&trade; verwendete Funktionen nicht und andere sind fehlerhaft.<br /><br />Wir empfehlen dringend Ihre PHP-Version auf den aktuellsten Stand zu bringen, wenn Sie Zen Cart&trade; auf diesem Server verwenden wollen.');
  break;
  case ('92'):
    define('POPUP_ERROR_HEADING','open_basedir Einschr&auml;nkungen k&ouml;nnen Probleme verursachen');
    define('POPUP_ERROR_TEXT','Ihr PHP ist so konfiguriert, dass Sie Ihre Skripte nur in einem "basedir"-Verzeichnis ausf&uuml;hren k&ouml;nnen. Dennoch scheinen Ihre Dateien in einem Verzeichnis au&szlig;erhalb des erlaubten "basedir" zu liegen.<br /><br />U.a. k&ouml;nnten Sie Probleme mit Datei-Uploads oder Backups bekommen.<br /><br />Sie sollten sich mit Ihrem Provider in Verbindung setzen um dieses Problem zu beheben.');
  break;
  case ('93'):
    define('POPUP_ERROR_HEADING','cURL Unterst&uuml;tzung nicht gefunden');
    define('POPUP_ERROR_TEXT','Einige Zahlungs- sowie Versand-Module von Drittanbietern ben&ouml;tigen cURL um mit externen Servern kommunizieren zu k&ouml;nnen. <br /><br />Es scheint, dass Ihr Server cURL-Support nicht konfiguriert hat oder dies f&uuml;r Ihren Account nicht aktiviert ist. Sind Sie auf diese Module angewiesen, m&uuml;ssen Sie Ihren Provider bitten cURL auf Ihrem Server zu installieren.');
  break;



}

?>
