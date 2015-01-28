<?php
/**
 * Main German language file for installer *
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: german.php 809 2015-01-22 16:33:24Z webchills $
 */
/**
 * defining language components for the page
 */
define('YES', 'JA');
define('NO', 'NEIN');
define('REFRESH_BUTTON', 'Nochmal prüfen');
define('OKAY', 'Okay');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// META TAG TITLE
define('META_TAG_TITLE', 'Zen-Cart 1.5.4 deutsch - Installationsprogramm');

define('INSTALLATION_IN_PROGRESS','Installation läuft...');

if (isset($_GET['main_page']) && ($_GET['main_page']== 'index' || $_GET['main_page']== 'license')) {
    define('TEXT_ERROR_WARNING', 'Es müssen nur einige Kleinigkeiten behoben werden, bevor wir fortfahren können.');
} else {
    define('TEXT_ERROR_WARNING', '<span class="errors"><strong>WARNUNG: Es sind Probleme aufgetreten</strong></span>');
}

define('DB_ERROR_NOT_CONNECTED', 'Installationsfehler: Es konnte keine Verbindung zur Datenbank hergestellt werden');
define('SHOULD_UPGRADE','Sie sollten ein Upgrade in Betracht ziehen!');
define('MUST_UPGRADE','Sie müssen zuerst upgraden bevor Sie Zen-Cart installieren');

define('UPLOAD_SETTINGS','Die maximale Uploadgröße muss kleiner als einer der folgenden Werte sein:.<br />
<em>upload_max_filesize</em> in php.ini %s <br />
<em>post_max_size</em> in php.ini: %s <br />' .
//'<em>Zen Cart</em> Upload Setting: %s <br />' .
'Einige Apache-Einstellungen können das Hochladen von Dateien verhindern bzw. Ihre Dateigröße begrenzen.
Nutzen Sie die Apache-Dokumentation um weitere Informationen zu erhalten.');

define('TEXT_HELP_LINK', '[Hilfe]');
define('TEXT_CLOSE_WINDOW', 'Fenster schließen');
define('STORE_ADDRESS_DEFAULT_VALUE', 'Shopname
  Adresse
  Land
  Telefonnummer');

define('ERROR_TEXT_ADMIN_CONFIGURE', '/admin/includes/configure.php existiert nicht');
define('ERROR_CODE_ADMIN_CONFIGURE', '2');

define('ERROR_TEXT_STORE_CONFIGURE', '/includes/configure.php existiert nicht');
define('ERROR_CODE_STORE_CONFIGURE', '3');

define('ERROR_TEXT_PHYSICAL_PATH_ISEMPTY', 'Das Feld für den physikalischen Pfad darf nicht leer sein');
define('ERROR_CODE_PHYSICAL_PATH_ISEMPTY', '9');

define('ERROR_TEXT_PHYSICAL_PATH_INCORRECT', 'Der physikalische Pfad ist falsch');
define('ERROR_CODE_PHYSICAL_PATH_INCORRECT', '10');

define('ERROR_TEXT_VIRTUAL_HTTP_ISEMPTY', 'Das Feld für den virtuellen HTTP Pfad darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTP_ISEMPTY', '11');

define('ERROR_TEXT_VIRTUAL_HTTPS_ISEMPTY', 'Das Feld für den virtuellen HTTPS Pfad darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTPS_ISEMPTY', '12');

define('ERROR_TEXT_VIRTUAL_HTTPS_SERVER_ISEMPTY', 'Das Feld für den virtuellen HTTPS Server darf nicht leer sein');
define('ERROR_CODE_VIRTUAL_HTTPS_SERVER_ISEMPTY', '13');

define('ERROR_TEXT_DB_USERNAME_ISEMPTY', 'Das Feld für den DB Benutzernamen darf nicht leer sein');
define('ERROR_CODE_DB_USERNAME_ISEMPTY', '16'); // re-using another one, since message is essentially the same.

define('ERROR_TEXT_DB_HOST_ISEMPTY', 'Das Feld für den DB Host darf nicht leer sein');
define('ERROR_CODE_DB_HOST_ISEMPTY', '24');

define('ERROR_TEXT_DB_NAME_ISEMPTY', 'Das Feld für den DB Namen darf nicht leer sein');
define('ERROR_CODE_DB_NAME_ISEMPTY', '25');

define('ERROR_TEXT_DB_SQL_NOTEXIST', 'Die SQL Installationsdatei existiert nicht');
define('ERROR_CODE_DB_SQL_NOTEXIST', '26');

define('ERROR_TEXT_DB_NOTSUPPORTED', 'Diese Datenbank wird nicht unterstützt');
define('ERROR_CODE_DB_NOTSUPPORTED', '27');

define('ERROR_TEXT_DB_CONNECTION_FAILED', 'Die Verbindung zur Datenbank ist fehlgeschlagen');
define('ERROR_CODE_DB_CONNECTION_FAILED', '28');

define('ERROR_TEXT_DB_CREATE_FAILED', 'Die Datenbank konnte nicht erstellt werden');
define('ERROR_CODE_DB_CREATE_FAILED', '29');

define('ERROR_TEXT_DB_NOTEXIST', 'Die Datenbank existiert nicht');
define('ERROR_CODE_DB_NOTEXIST', '30');

define('ERROR_TEXT_STORE_NAME_ISEMPTY', 'Das Feld für den Shopnamen darf nicht leer sein');
define('ERROR_CODE_STORE_NAME_ISEMPTY', '31');

define('ERROR_TEXT_STORE_OWNER_ISEMPTY', 'Das Feld für den Shopinhaber darf nicht leer sein');
define('ERROR_CODE_STORE_OWNER_ISEMPTY', '32');

define('ERROR_TEXT_STORE_OWNER_EMAIL_ISEMPTY', 'Das Feld für die Shop E-Mail Adresse darf nicht leer sein');
define('ERROR_CODE_STORE_OWNER_EMAIL_ISEMPTY', '33');

define('ERROR_TEXT_STORE_OWNER_EMAIL_NOTEMAIL', 'Die E-Mail Adresse des Shops ist nicht korrekt');
define('ERROR_CODE_STORE_OWNER_EMAIL_NOTEMAIL', '34');

define('ERROR_TEXT_STORE_ADDRESS_ISEMPTY', 'Das Feld für die Shopadresse darf nicht leer sein');
define('ERROR_CODE_STORE_ADDRESS_ISEMPTY', '35');

define('ERROR_TEXT_DEMO_SQL_NOTEXIST', 'Die SQL Datei für die Demoartikel existiert nicht');
define('ERROR_CODE_DEMO_SQL_NOTEXIST', '36');

define('ERROR_TEXT_ADMIN_USERNAME_ISEMPTY', 'Das Feld für den Admin Benutzernamen darf nicht leer sein');
define('ERROR_CODE_ADMIN_USERNAME_ISEMPTY', '46');

define('ERROR_TEXT_ADMIN_EMAIL_ISEMPTY', 'Das Feld für die Admin E-Mail Adresse darf nicht leer sein');
define('ERROR_CODE_ADMIN_EMAIL_ISEMPTY', '47');

define('ERROR_TEXT_ADMIN_EMAIL_NOTEMAIL', 'Die Admin E-Mail Adresse ist nicht gültig');
define('ERROR_CODE_ADMIN_EMAIL_NOTEMAIL', '48');

define('ERROR_TEXT_ADMIN_PASS_ISEMPTY', 'Das Feld für das Admin Passwort darf nicht leer sein');
define('ERROR_CODE_ADMIN_PASS_ISEMPTY', '49');

define('ERROR_TEXT_ADMIN_PASS_NOTEQUAL', 'Die Passwörter stimmen nicht überein');
define('ERROR_CODE_ADMIN_PASS_NOTEQUAL', '50');

define('ERROR_TEXT_4_1_2', 'PHP Version 4.1.2');
define('ERROR_CODE_4_1_2', '1');
define('ERROR_TEXT_PHP_OLD_VERSION', 'Diese PHP Version wird nicht unterstützt');
define('ERROR_CODE_PHP_OLD_VERSION', '55');
define('ERROR_TEXT_PHP_VERSION', 'Diese PHP Version nicht unterstützt');
define('ERROR_CODE_PHP_VERSION', '91');

define('ERROR_TEXT_ADMIN_CONFIGURE_WRITE', 'In die Admin Konfigurationsdatei kann nicht geschrieben werden');
define('ERROR_CODE_ADMIN_CONFIGURE_WRITE', '56');

define('ERROR_TEXT_STORE_CONFIGURE_WRITE', 'In die Shop Konfigurationsdatei kann nicht geschrieben werden');
define('ERROR_CODE_STORE_CONFIGURE_WRITE', '57');

define('ERROR_TEXT_CACHE_DIR_ISEMPTY', 'Das Feld für das Sitzungs-/SQL Cache Verzeichnis darf nicht leer sein');
define('ERROR_CODE_CACHE_DIR_ISEMPTY', '61');

define('ERROR_TEXT_CACHE_DIR_ISDIR', 'Das Sitzungs-/SQL Cache Verzeichnis existiert nicht');
define('ERROR_CODE_CACHE_DIR_ISDIR', '62');

define('ERROR_TEXT_CACHE_DIR_ISWRITEABLE', 'Es konnte nicht in das Sitzungs-/SQL Cache Verzeichnis geschrieben werden');
define('ERROR_CODE_CACHE_DIR_ISWRITEABLE', '63');

define('ERROR_TEXT_ADMIN_PASS_INSECURE', 'Passwort ist zu unsicher. Muss aus Buchstaben und Zahlen bestehen, <br>und mindestens 7 Zeichen lang sein.');
define('ERROR_CODE_ADMIN_PASS_INSECURE', '64');

define('ERROR_TEXT_REGISTER_GLOBALS_ON', 'Register Globals ist ON');
define('ERROR_CODE_REGISTER_GLOBALS_ON', '69');

define('ERROR_TEXT_SAFE_MODE_ON', 'Safe Mode ist ON');
define('ERROR_CODE_SAFE_MODE_ON', '70');

define('ERROR_TEXT_CACHE_CUSTOM_NEEDED','Der Cache Ordner muss das Zwischenspeichern von Dateien unterstützen');
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

define('ERROR_TEXT_UPLOADS_DISABLED','Dateiuploads sind deaktiviert');
define('ERROR_CODE_UPLOADS_DISABLED','77');

define('ERROR_TEXT_ADMIN_PWD_REQUIRED','Für die Aktualisierung wird das Administrator Passwort benötigt');
define('ERROR_CODE_ADMIN_PWD_REQUIRED','78');

define('ERROR_TEXT_PHP_SESSION_SUPPORT','PHP Session Support wird benötigt');
define('ERROR_CODE_PHP_SESSION_SUPPORT','80');

define('ERROR_TEXT_PHP_AS_CGI','PHP im CGI Modus wird nicht empfohlen außer es handelt sich um einen Windows Server');
define('ERROR_CODE_PHP_AS_CGI','81');

define('ERROR_TEXT_DISABLE_FUNCTIONS','Auf Ihrem Server sind benötigte PHP Funktionen deaktiviert');
define('ERROR_CODE_DISABLE_FUNCTIONS','82');

define('ERROR_TEXT_OPENSSL_WARN','OpenSSL ist "eine" Möglichkeit, mit dem Sie auf ihrem Server eine sichere SSL (https://) Verbindung für Ihren Shop anbieten können.<br /><br />Wird diese Funktion als nicht erhältlich angezeigt, kann dies folgende Ursachen haben:<br />(a) Der von Ihnen verwendete Webhoster unterstützt kein SSL<br />(b) Auf Ihrem Webserver ist OpenSSL nicht installiert. Es wird - VIELLEICHT - eine andere Form der SSL Unterstützung zur Verfügung gestellt<br />(c) Ihr Webhoster kann derzeit Ihr SSL Zertifikat nicht berücksichtigen, SSL kann deshalb noch nicht aktiviert werden<br />(d) PHP könnte so konfiguriert sein, dass OpenSSL derzeit nicht unterstützt wird.<br /><br />Wenn Sie SSL auf Ihrer Webseite BENÖTIGEN, kontaktieren Sie zur Sicherheit auf jeden Fall Ihren Webhoster.');
define('ERROR_CODE_OPENSSL_WARN','79');

define('ERROR_TEXT_DB_PREFIX_NODOTS','Datenbank Tabellen-Präfixe dürfen nur Buhstaben, Zahlen und Unterstriche (_) enthalten. ');
define('ERROR_CODE_DB_PREFIX_NODOTS','83');

define('ERROR_TEXT_PHP_SESSION_AUTOSTART','PHP Session.autostart sollte deaktiviert werden.');
define('ERROR_CODE_PHP_SESSION_AUTOSTART','84');
define('ERROR_TEXT_PHP_SESSION_TRANS_SID','PHP Session.use_trans_sid sollte deaktiviert werden.');
define('ERROR_CODE_PHP_SESSION_TRANS_SID','86');
define('ERROR_TEXT_DB_PRIVS','Fehlende Berechtigung für diesen Datenbankbenutzer');
define('ERROR_CODE_DB_PRIVS','87');
define('ERROR_TEXT_COULD_NOT_WRITE_CONFIGURE_FILES','Es ist ein Fehler beim Schreiben in /includes/configure.php aufgetreten');
define('ERROR_CODE_COULD_NOT_WRITE_CONFIGURE_FILES','88');
define('ERROR_TEXT_GD_SUPPORT','GD Support Details');
define('ERROR_CODE_GD_SUPPORT','89');

define('ERROR_TEXT_DB_MYSQL5','MySQL 5.7 (and höher) Unterstützung wurde nicht vollständig getestet');
define('ERROR_CODE_DB_MYSQL5','90');
define('ERROR_TEXT_OPEN_BASEDIR','Es könnte Probleme mit Uploads oder Backups geben.');
define('ERROR_CODE_OPEN_BASEDIR','92');
define('ERROR_TEXT_CURL_SUPPORT','CURL Unterstützung nicht gefunden.');
define('ERROR_CODE_CURL_SUPPORT','93');
define('ERROR_TEXT_CURL_NOT_COMPILED', 'CURL nicht in PHP compiliert - bitte benachrichtigen Sie Ihren Webhoster.');
define('ERROR_TEXT_CURL_PROBLEM_GENERAL', 'CURL Probleme festgestellt: ');
define('ERROR_TEXT_CURL_SSL_PROBLEM', 'CURL benötigt SSL Unterstützung. Bitte benachrichtigen Sie den Serveradminstrator oder Webhoster.');
define('ERROR_CODE_CURL_SSL_PROBLEM','95');

define('ERROR_TEXT_MAGIC_QUOTES_SYBASE','PHP "magic_quotes_sybase" ist aktiviert');
define('ERROR_CODE_MAGIC_QUOTES_SYBASE','94');

  $error_code ='';
if (isset($_GET['error_code'])) {
  $error_code = $_GET['error_code'];
  }

switch ($error_code) {
  case ('1'):
    define('POPUP_ERROR_HEADING', 'PHP Version 4.1.2 gefunden');
    define('POPUP_ERROR_TEXT', 'In der PHP Version 4.1.2 wurden einige Bugs entdeckt. Dadurch kann es vorkommen, dass auf die Admin Sektion nicht zugegriffen werden kann. Bitte aktualisieren Sie nach Möglichkeit Ihre PHP Version.');
    
  break;
  case ('2'):
    define('POPUP_ERROR_HEADING', '/admin/includes/configure.php existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datei /admin/includes/configure.php existiert nicht. Erstellen Sie entweder eine neue Datei oder benennen Sie die Datei /admin/includes/dist-configure.php in configure.php um. Nach dem Erstellen muss die Datei Lese- und Schreibrechte besitzen bzw. auf CHMOD 666 oder CHMOD 777 gesetzt werden.');
    
  break;
  case ('3'):
    define('POPUP_ERROR_HEADING', '/includes/configure.php existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datei /includes/configure.php existiert nicht. Erstellen Sie entweder eine neue Datei oder benennen Sie die Datei /admin/includes/dist-configure.php in configure.php um. Nach dem Erstellen muss die Datei Lese- und Schreibrechte besitzen bzw. auf CHMOD 666 oder CHMOD 777 gesetzt werden.');
    
  break;
  case ('4'):
    define('POPUP_ERROR_HEADING', 'Physikalischer Pfad');
    define('POPUP_ERROR_TEXT', 'Der physikalische Pfad ist der Pfad zum Verzeichnis, wo die Zen Cart Dateien installiert werden. Ein Beispiel: Auf einigen Linux Systemen werden HTML Dateien in das Verzeichnis /var/www/html abgelegt. Wenn Sie nun Ihre Zen Cart Dateien in das Verzeichnis \'shop\' installieren, dann lautet der physikalische Pfad /var/www/html/shop. Normalerweise erkennt das Installationsprogramm den Pfad automatisch.');
    
  break;
  case ('5'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTP Pfad');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse, die Sie in Ihrem Browser eingeben um auf Ihre Shopseite zu gelangen. Wenn der Shop in das \'Rootverzeichnis\' installiert wurde, würde diese z.B. \'http://www.ihredomain.at\' lauten. Wenn Sie Ihren Zen Cart Shop z.B. in das Unterverzeichnis \'shop\' installiert haben, so würde diese dann \'http://www.ihredomain.at/shop\' lauten.');
    
  break;
  case ('6'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTPS Server');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse zu Ihrem sicheren SSL Server. Diese Adresse hängt von auf Ihrem Webserver installierten SSL Modus ab. Sie können auf <a href="http://www.zen-cart-pro.at/modules/xoopsfaq/index.php?cat_id=2#46" target="_blank">Zen Cart FAQ</a> mehr zum Thema SSL erfahren.');
    
  break;
  case ('7'):
    define('POPUP_ERROR_HEADING', 'Virtueller HTTPS Path');
    define('POPUP_ERROR_TEXT', 'Das ist die Adresse, die Sie in Ihrem Browser eingeben, um auf Ihre Shopseite über eine sichere SSL Verbindung zu gelangen, z.B. \'https://www.ihredomain.at\'. Sie können auf <a href="http://www.zen-cart-pro.at/modules/xoopsfaq/index.php?cat_id=2#46" target="_blank">Zen Cart FAQ</a> mehr zum Thema SSL erfahren.');
    
  break;
  case ('8'):
    define('POPUP_ERROR_HEADING', 'SSL aktivieren');
    define('POPUP_ERROR_TEXT', 'Diese Einstellung legt fest, ob der SSL Modus (HTTPS:) auf Ihrer Zen Cart Webseite verwendet werden soll oder nicht.<br /><br />TIPP: Jede Seite, in der persönliche Informationen eingegeben werden - z.B. Benutzerkonten, Bestellungen, Kreditkarteninformationen etc. - kann zur Verwendung mit SSL aktiviert werden. Ebenso kann der Admin Bereich damit geschützt werden.<br /><br />Sie müssen dafür Zugang zu einem SSL Server haben (erkennbar durch die Verwendung von HTTPS anstelle von HTTP). <br /><br />Wenn Sie nicht sicher sind ob Sie Zugang zu einem SSL Server haben, lassen Sie diese Option deaktiviert und fragen bei Ihrem Webhoster nach. HINWEIS: Wie alle Einstellungen, können Sie diese ebenso nachträglich in der configure.php ändern.');
    
  break;
  case ('9'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den physikalischen Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld für den physikalische Pfad leer gelassen. Bitte geben Sie einen gültigen Pfad ein.');
    
  break;
  case ('10'):
    define('POPUP_ERROR_HEADING', 'Der physikalische Pfad ist nicht richtig');
    define('POPUP_ERROR_TEXT', 'Der Eintrag für den physikalischen Pfad scheint nicht richtig zu sein. Bitte korrigieren Sie dies und versuchen Sie es noch einmal.');
    
  break;
  case ('11'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den virtuellen HTTP Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld für den virtuellen HTTP Pfad leer gelassen. Bitte geben Sie einen gültigen Pfad an.');
    
  break;
  case ('12'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den virtuellen HTTPS Pfad darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld für den virtuellen HTTPS Pfad leer gelassen. Bitte geben Sie einen gültigen Pfad an.');

  break;
  case ('13'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den virtuellen HTTPS Server darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Sie haben das Feld für den virtuellen HTTPS Pfad leer gelassen, jedoch die Option zur Verwendung des SSL Modus aktiviert. Bitte geben Sie einen gültigen Pfad an oder deaktivieren Sie den SSL Modus');
    
  break;
  case ('14'):
    define('POPUP_ERROR_HEADING', 'Datenbank Character Set / Kollation');
    define('POPUP_ERROR_TEXT', 'Die deutsche Zen-Cart Version verwendet durchgehend utf-8 sowohl für Datenbank als auch in den Sprachdateien. Wir empfehlen daher unbedingt hier die Vorauswahl utf-8 zu lassen!');

  break;
  case ('15'):
    define('POPUP_ERROR_HEADING', 'Datenbank Host');
    define('POPUP_ERROR_TEXT', 'Das ist der Name des Webservers, auf dem die Datenbank läuft. In den meisten Fällen kann die Einstellung auf \'localhost\' belassen werden. Andernfalls fragen Sie Ihren Webhoster nach den Namen Ihres Datenbankservers.');
    
  break;
  case ('16'):
    define('POPUP_ERROR_HEADING', 'Datenbank Benutzername');
    define('POPUP_ERROR_TEXT', 'Jede Datenbank benötigt für den Zugriff einen Benutzernamen. Den Benutzernamen erhalten Sie bei Ihrem Webhoster.');
    
  break;
  case ('17'):
    define('POPUP_ERROR_HEADING', 'Datenbank Passwort');
    define('POPUP_ERROR_TEXT', 'Jede Datenbank benötigt für den Zugriff ein Passwort. Dieses Passwort erhalten Sie bei Ihrem Webhoster.');
    
  break;
  case ('18'):
    define('POPUP_ERROR_HEADING', 'Datenbank Name');
    define('POPUP_ERROR_TEXT', 'Das ist der Name der Datenbank, die Sie zur Verwendung von Zen Cart benötigen. Den Manen der Datenbank finden Sie in der Regel in der Administration Ihres Webhoster, wo Sie die Datenbank ja zuvor auch angelegt haben.');
    
  break;
  case ('19'):
    define('POPUP_ERROR_HEADING', 'Datenbank Präfix');
    define('POPUP_ERROR_TEXT', 'Mit Zen Cart ist es möglich, den verwendeten Tabellen ein Präfix voranzustellen. Diese Funktion ist hilfreich, wenn Sie z.B. nur eine Datenbank aber mehrere Skripte installiert haben, die auf diese Datenbank zugreifen. Grundsätzlich sollten Sie die vorgegebene Standardeinstellung ohne Präfix verwenden. Wir empfehlen in der Datenbank ausschliesslich Zen-Cart zu installieren und nicht eine Datenbank für unterschiedeliche Scripts zu verwenden.');
    
  break;
  case ('20'):
    define('POPUP_ERROR_HEADING', 'Datenbank erstellen');
    define('POPUP_ERROR_TEXT', 'Diese Einstellung gibt an, ob das Installationsprogramm versuchen soll, eine Datenbank zu erstellen. HINWEIS: Die Option \'erstellen\' hat nichts mit dem Hinzufügen von Tabellen zu tun, die Zen Cart benötigt (welche sowieso automatisch erstellt werden). Viele WEbhoster geben Ihren Benutzern nicht das Recht, Datenbanken zu \'erstellen\', bieten jedoch eine andere Möglichkeit zum Erstellen einer Datenbank (z.B. cPanel oder phpMyAdmin). Im Zweifelsfall kontaktieren Sie bitte Ihren Webhoster.');
    
  break;
//  case ('21'):
//    define('POPUP_ERROR_HEADING', 'Database Connection');
//    define('POPUP_ERROR_TEXT', 'Persistent connections are a method of reducing the load on the database. You should consult your server host before setting this option.  Enabling "persistent connections" could cause your host to experience database problems if they haven\'t configured to handle it.<br /><br />Again, be sure to talk to your host before considering use of persistent connections.');
//
//  break;
//  case ('22'):
//    define('POPUP_ERROR_HEADING', 'Database Sessions');
//    define('POPUP_ERROR_TEXT', 'This detemines whether session information is stored in a file or in the database. While file-based sessions are slightly faster, <strong>database sessions are recommended</strong> for all online stores using SSL connections, for the sake of security.');
//
//  break;
  case ('23'):
    define('POPUP_ERROR_HEADING', 'SSL aktivieren');
    define('POPUP_ERROR_TEXT', 'Die Einstellung "true" bewirkt lediglich , das Zen-Cart versucht, alle entsprechend vorgesehenden Seiten mit SSL abzusichern bzw. aufzurufen. Damit SSL funktioniert müssen Sie die korrekten Eingaben im Feld HTTPS Server und HTTPS Pfad vornehmen. Diese erhalten von Ihrem Webhoster.<br />Falls Ihr Webspace keine SSL Unterstützung bietet, dann können Sie dieses evtl. nachrüsten. Bitte nehmen Sie dafür mit Ihrem Webhoster Kontakt auf');
    
  break;
  case ('24'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den DB Host darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Der Eintrag für den Datenbank Host darf nicht leer sein. Bitte geben Sie einen gültigen Namen für den Datenbank Host ein. <br />Das ist der Name für den Webserver, auf dem die Datenbank lüuft. In den meisten Fällen kann der Eintrag \'localhost\' verwendet werden. In Ausnahmefällen müssen Sie Ihren Webhoster für den Namen des Datenbank Hosts konsultieren.');
  break;
  
  case ('25'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den DB Namen darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Der Eintrag für Datenbank Namen darf nicht leer sein. Bitte geben Sie den Namen Ihrer Datenbank ein.<br />Das ist der Name für die Datenbank, die Sie zur Verwendung mit Zen Cart benötigen. Wenn Sie sich nicht sicher sind, fragen Sie bitte Ihren Webhoster für weitere Informationen.');
    
  break;
  case ('26'):
    define('POPUP_ERROR_HEADING', 'SQL Installationsdatei existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die SQL Datei, die zur Installation von Zen Cart benötigt wird, existiert nicht. Diese Datei sollte im \'zc_install\' Verzeichnis vorhanden sein und lautet so ähnlich wie \'mysql_zencart.sql\'.');
    
  break;
  case ('27'):
    define('POPUP_ERROR_HEADING', 'Datenbank nicht unterstützt');
    define('POPUP_ERROR_TEXT', 'Der Datenbanktyp, den Sie ausgewählt haben, scheint von Ihrer installierten PHP Version nicht unterstützt zu werden. Klären Sie dies mit Ihrem Webhoster, ob der gewählte Datenbanktyp für die verwendete PHP Version kompiliert wurde und ob die notwendigen Module/DLLs geladen sind.');
    
  break;
  case ('28'):
    define('POPUP_ERROR_HEADING', 'Verbindung zur Datenbank fehlgeschlagen');
    define('POPUP_ERROR_TEXT', 'Es konnte keine Verbindung zur Datenbank hergestellt werden. Dafür kann es mehrere Ursachen geben: <br /><br />Sie haben entweder einen falschen DB Hostnamen angegeben oder der DB Benutzername bzw. das <em>DB Passwort </em>ist falsch. <br /><br />Ebenso kann der Name der Datenbank falsch sein. Bitte überprüfen Sie Ihre Angaben auf Richtigkeit und versuchen Sie es noch einmal.');
    
  break;
  case ('29'):
    define('POPUP_ERROR_HEADING', 'Zone für den Shop wurde nicht ausgewählt');
    define('POPUP_ERROR_TEXT', 'Bitte wöhen Sie eine Zone aus der Liste aus. Diese Informationen wird für Steuer- und Versandkostenberechnung benötigt. Sie können die Zone später in der Administration unter Konfiguration -> Mein Shop wieder ändern.');
    
  break;
  case ('30'):
    define('POPUP_ERROR_HEADING', 'Database existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die Datenbank, die Sie angegeben haben, scheint nicht zu existieren. Bitte überprüfen Sie Ihre Angaben und korrigieren Sie diese gegebenenfalls.');
    
  break;
  case ('31'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den Shopnamen darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie einen Namen für Ihren Shop ein.');
    
  break;
  case ('32'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den Shopbetreiber darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie den Namen des Shopbetreibers ein. Diese Information wird in der \'Schreiben Sie uns\' Seite, in der \'Willkommen\' E-Mail und an anderen Stellen im Shop sichtbar sein.');
    
  break;
  case ('33'):
    define('POPUP_ERROR_HEADING', 'Das Feld für die Shop E-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie die primäre E-Mail Adresse des Shops ein. Diese E-Mail Adresse wird als Kontaktadresse in E-Mails, die vom Shop gesendet werden, verwendet. Diese Adresse wird im Shop standardmäßig nicht angezeigt.');
    
  break;
  case ('34'):
    define('POPUP_ERROR_HEADING', 'Die E-Mail Adresse für den Shop ist nicht gültig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie eine gültige E-Mail Adresse an.');
    
  break;
  case ('35'):
    define('POPUP_ERROR_HEADING', 'Die Adresse für den Shop ist nicht gültig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie die Strasse, die Postleitzahl, die Stadt und das Land des Shops an. Diese Anschrift wird in der \'Schreiben Sie uns\' Seite (kann bei Bedarf deaktiviert werden) und auf den Rechnungen angezeigt. Ebenso ist diese Adresse für Kunden, die per Vorkasse zahlen, während der Bestellung sichtbar.');
    
  break;
  case ('36'):
    define('POPUP_ERROR_HEADING', 'Die SQL Datei für die Demoartikel existiert nicht');
    define('POPUP_ERROR_TEXT', 'Die SQL Datei für die Demoartikel konnte nicht gefunden werden. Bitte stellen Sie sicher, dass die Datei /zc_install/demo/xxxxxxx_demo.sql vorhanden ist. (xxxxxxx = Ihr verwendeter Datenbanktyp).');
    
  break;
  case ('37'):
    define('POPUP_ERROR_HEADING', 'Shopname');
    define('POPUP_ERROR_TEXT', 'Der Name des Shops. Dieser Name wird in E-Mails, die von Shop gesendet werden und auf einigen Shopseiten als Browsertitel verwendet.');
    
  break;
  case ('38'):
    define('POPUP_ERROR_HEADING', 'Shopinhaber');
    define('POPUP_ERROR_TEXT', 'Dieser Name wird in einigen E-Mails, die vom Shop gesendet werden, verwendet.');
    
  break;
  case ('39'):
    define('POPUP_ERROR_HEADING', 'E-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Diese Adresse dient als Kontaktadresse für den Shop. Die meisten E-Mails, die vom Shop gesendet werden - ebenso die \'Schreiben Sie uns\' Seite - benutzen diese Adresse.');
    
  break;
  case ('40'):
    define('POPUP_ERROR_HEADING', 'Land');
    define('POPUP_ERROR_TEXT', 'Das Land, von dem aus der Shop betrieben wird. Es ist sehr wichtig, dass Sie hier korrekte Angaben machen, da davon u.A. die Berechnung der Steuern und der Versandkosten abhängig ist.');
    
  break;
  case ('41'):
    define('POPUP_ERROR_HEADING', 'Bundesland');
    define('POPUP_ERROR_TEXT', 'Das Bundesland, in dem der Shop betrieben wird. Es ist sehr wichtig, dass Sie hier korrekte Angaben machen, da davon ev. die Berechnung der Steuern und der Versandkosten abhängig sein kann.');
    
  break;
  case ('42'):
    define('POPUP_ERROR_HEADING', 'Shopdresse');
    define('POPUP_ERROR_TEXT', 'Ihre Shopadresse wird auf Rechnungen und bei der Bestellung verwendet');
    
  break;
  case ('43'):
    define('POPUP_ERROR_HEADING', 'Standardsprache');
    define('POPUP_ERROR_TEXT', 'Die Sprache, mit der Ihr Shop betrieben werden soll. Zen Cart kann multilingual ausgebaut werden - vorausgesetzt, Sie haben die dazu notwendigen Sprachdateien.');
    
  break;
  case ('44'):
    define('POPUP_ERROR_HEADING', 'Standardwährung');
    define('POPUP_ERROR_TEXT', 'Wählen Sie die Währung aus, mit der der Shop standardmäßig betrieben werden soll. Wenn Ihre Währung hier nicht aufgelistet ist, können Sie diese nach der Installation einfach im Admin Bereich ändern.');
    
  break;
  case ('45'):
    define('POPUP_ERROR_HEADING', 'Demoartikel installieren');
    define('POPUP_ERROR_TEXT', 'Bitte wählen Sie, ob Sie Demoartikel verwenden wollen. Diese Demodaten enthalten einige Beispiele zur Demonstration der Leistungsfähigkeit des Shops. <br/>WICHTIG:<br/>Die Demodaten sind NUR für einen Testshop gedacht, den Sie zusätzlich zu Ihrem eigentlich Shop installieren. Wenn Sie diese Installation für Ihren echten Shop ausführen, dann kreuzen Sie die Demodaten NICHT an. Sie haben sonst ganz unnötige Artikel, Kategorien und Attribute in Ihrem Shop, die Sie später mühsam wieder deaktivieren oder löschen müssen.');
    
  break;
  case ('46'):
    define('POPUP_ERROR_HEADING', 'Das Feld für den Admin Benutzername darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Um sich im Admin Bereich anmelden zu können, benötigen Sie einen Admin Benutzernamen.');
    
  break;
  case ('47'):
    define('POPUP_ERROR_HEADING', 'Das Feld für die Admin E-Mail Adresse darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Die Admin E-Mail Adresse ist notwendig z.B. für den Fall, dass Sie Ihr Passwort vergessen haben und Sie es sich - per E-Mail - zusenden lassen müssen.');
    
  break;
  case ('48'):
    define('POPUP_ERROR_HEADING', 'Die E-Mail Admin Adresse ist nicht gültig');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie eine gültige E-Mail Adresse an.');
    
  break;
  case ('49'):
    define('POPUP_ERROR_HEADING', 'Admin Passwort darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Aus Sicherheitsgründen darf das Admin Passwort nicht leer sein.');
    
  break;
  case ('50'):
    define('POPUP_ERROR_HEADING', 'Die Passwörter stimmen nicht überein');
    define('POPUP_ERROR_TEXT', 'Bitte geben Sie das Passwort und die Passwortbestätigung erneut ein.');
    
  break;
  case ('51'):
    define('POPUP_ERROR_HEADING', 'Admin Benutzername');
    define('POPUP_ERROR_TEXT', 'Um sich im Admin Bereich anmelden zu können, benötigen Sie einen Admin Benutzernamen.');
    
  break;
  case ('52'):
    define('POPUP_ERROR_HEADING', 'Admin E-Mail Adresse');
    define('POPUP_ERROR_TEXT', 'Die Admin E-Mail Adresse ist notwendig z.B. für den Fall, dass Sie Ihr Passwort vergessen haben und Sie es sich - per e-Mail - zusenden lassen müssen.');
    
  break;
  case ('53'):
    define('POPUP_ERROR_HEADING', 'Admin Passwort');
    define('POPUP_ERROR_TEXT', 'Das Admin Passwort dient zu Ihrer Sicherheit und ermöglicht Ihnen den Zugang zum Admin Bereich. Das Passwort muss mindestens 7 Zeichen haben und mindestens eine Ziffer enthalten. Sie werden Ihr Passwort später alle 90 tage ändern müssen. Dazu werden Sie nach Ablauf der 90 Tage automatisch aufgefordert.');
    
  break;
  case ('54'):
    define('POPUP_ERROR_HEADING', 'Admin Passwortbestätigung');
    define('POPUP_ERROR_TEXT', 'Dient zur Überprüfung des eingegebenen Passworts und soll Tippfehlern vorbeugen.');
    
  break;
  case ('55'):
    define('POPUP_ERROR_HEADING', 'Die PHP Version wird nicht unterstützt');
    define('POPUP_ERROR_TEXT', 'Ihre PHP Version wird von Zen cart nicht unterstützt. Ebenso sind in der PHP Version 4.1.2 einige Bugs enthalten, die z.B. Probleme beim Zugriff auf den Admin Bereich verursachen. Sie werden angehalten, Ihre PHP Version nach Möglichkeit zu aktualisieren.');
    
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
    define('POPUP_ERROR_HEADING', 'Datenbank Präfix');
    define('POPUP_ERROR_TEXT', 'Zen Cart bietet Ihen die Möglichkeit, ein Präfix für die Tabellen Ihrer Datenbank zu verwenden. Diese Funktion ist hilfreich, wenn Sie z.B. nur eine Datenbank aber mehrere Skripte installiert haben, die auf diese Datenbank zugreifen. Grundsätzlich sollten Sie die vorgegebene Standardeinstellung verwenden.');
    
  break;
  case ('59'):
    define('POPUP_ERROR_HEADING', 'SQL Cache Verzeichnis');
    define('POPUP_ERROR_TEXT', 'SQL Abfragen können entweder in der Datenbank oder in eine Datei auf Ihrem Webserver oder überhaupt nicht gespeichert werden. Wenn Sie sich für eine dateibasierte Speicherung entscheiden, geben Sie bitte das Verzeichnis, in der sich die Datei befindet, an. <br /><br />Die Standardinstallation von Zen Cart beinhaltet bereits einen \'cache\' Ordner. Stellen Sie sicher, dass die notwendigen Schreibrechte für diesen Ordner gesetzt sind.<br /><br />Bitte stellen Sie sicher, dass das gewählte Verzeichnis existiert und die notwendigen Schreibrechte gesetzt sind (CHMOD 777 oder mindestens CHMOD 666).');
    
  break;
  case ('60'):
    define('POPUP_ERROR_HEADING', 'SQL Cache Methode');
    define('POPUP_ERROR_TEXT', 'Einige SQL Abfragen sind Cache - fähig und sind als solche markiert. Diese Methode bietet einen Geschwindigkeitsvorteil. Sie können entscheiden, welche Methode Sie zum Zwischenspeichern von SQL Abfragen verwenden wollen.<br /><br /><strong>None - Kein Cache</strong>. Keine SQL Abfragen werden zwischengespeichert. Wenn Sie wenige Kategorien/Artikel haben, kann diese Methode die bessere Wahl sein.<br /><br /><strong>File - Cache in eine Datei</strong>. SQL Abfragen werden in eine Datei auf der Festplatte Ihres Webservers gespeichert. Für die einwandfreie Funktion muss sichergestellt sein, dass das Verzeichnis, wo die Abfragen gespeichert werden, die notwendigen Lese- und Schreibrechte besitzt. Diese Methode kann bei Seiten mit großem Kategorie-/Artikelbestand die bessere Wahl sein.<br /><br /><strong>Database - Datenbank Cache</strong>. SQL Abfragen werden in eine dafür vorgesehene Tabelle in der Datenbank gespeichert. Klingt komisch, ist aber so ;-) - Diese Methode kann bei Seiten mit mittleren Kategorie-/Artikelbestand einen Geschwindigkeitsvorteil bringen.');
    
  break;
  case ('61'):
    define('POPUP_ERROR_HEADING', 'Das Feld für das Sitzungs/SQL Cache Verzeichnis darf nicht leer sein');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, müssen Sie ein Verzeichnis angeben. Stellen Sie auch sicher, dass der Server die notwendigen Rechte zum Schreiben für dieses Verzeichnis besitzt.');
    
  break;
  case ('62'):
    define('POPUP_ERROR_HEADING', 'Das Session/SQL Cache Verzeichnis existiert nicht');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, muss ein Verzeichnis für das Speichern von SQL Abfragen vorhanden sein. Stellen Sie sicher, dass das Verzeichnis vorhanden ist und der Server die notwendigen Rechte zum Schreiben für dieses Verzeichnis besitzt.');
    
  break;
  case ('63'):
    define('POPUP_ERROR_HEADING', 'In das Sitzungs/SQL Cache Verzeichnis kann nicht geschrieben werden');
    define('POPUP_ERROR_TEXT', 'Wenn Sie die Option Sitzungs/SQL Cache aktivieren wollen, muss ein Verzeichnis für das Speichern von SQL Abfragen und die notwendigen Lese- und Schreibrechte vorhanden sein. Stellen Sie sicher, dass das Verzeichnis vorhanden ist und der Server die notwendigen Rechte zum Schreiben für dieses Verzeichnis besitzt (Auf Unix/Linux Systemen stellen Sie CHMOD 666 oder 777 ein und auf Windows Systemen deaktivieren Sie den Schreibschutz.');
  break;

  case ('64'):
    define('POPUP_ERROR_HEADING', 'Admin Passwort Scherheits Anforderungen');
    define('POPUP_ERROR_TEXT', 'Ihr Admin Passwort muss aus mindestens 7 Zeichen bestehen und muss sowohl Buchstaben als auch Zahlen enthalten.<br /><br />Hinweis: Passwörter sind maximal 90 Tage gültig und müssen dann geändert werden.');

  break;

  case ('69'):
    define('POPUP_ERROR_HEADING', 'Register Globals');
    define('POPUP_ERROR_TEXT', 'Zen Cart funktioniert mit "Register Globals" ON und OFF. Jedoch bietet die Einstellung der "Register Globals" auf "OFF" mehr Sicherheit für Ihr System.');
  break;
  case ('70'):
    define('POPUP_ERROR_HEADING', 'Safe Mode ist ON');
    define('POPUP_ERROR_TEXT', 'Zen Cart, eine Full-Service e-Commerce Anwendung, funktioniert nicht richtig auf Servern mit aktiviertem Safe Mode.<br /><br />Um ein professionelles e-Commerce System zu betreiben, benötigen Sie oftmals mehr Features als es "Billig-Anbieter" auf "Shared-Hostings" ermöglichen können. Um das Optimum aus Ihrem Shopsystems heraus zu holen, bitten Sie Ihren Webhoster, in der php.ini die Einstellung "SAFE_MODE =OFF" zu setzten.');
  break;
  case ('71'):
    define('POPUP_ERROR_HEADING', 'Der Ordner für die Cache Option wird benötigt');
    define('POPUP_ERROR_TEXT', 'Wenn Sie "Datei-basierten SQL Cache" in Zen Cart verwenden wollen, stellen Sie sicher, dass ein Ordner mit den entsprechenden Lese- und Schreibrechten auf dem Webserver vorhanden ist.<br /><br />Optional können Sie auch die Option "Datenbank Cache" oder" Kein Cache" wählen. In diesem Fall können Sie "Sitzungen speichern" deaktivieren.<br /><br />Um den Ordner die benötigten Rechte zu erteilen, verwenden Sie Ihr FTP Programm oder Ihren Shell Zugang, um die Lese- und Schreibrechte auf CHMOD 666 oder 777 zu setzten.<br /><br />Im speziellen Fall muss die userID Ihres Webservers (z.B.: \'apache\' oder \'www-user\' oder vielleicht \'IUSR_irgendwas\' unter Windows) sämtliche \'Lese- Schreib- und Löschrechte\' etc. für den Cache Ordner besitzen.');
  break;
  case ('72'):
    define('POPUP_ERROR_HEADING', 'FEHLER: Es konnten nicht alle configure.php Dateien mit den neuen Einstellungen gespeichert werden');
    define('POPUP_ERROR_TEXT', 'Bei dem Versuch Ihre configure.php Dateien zu aktualisieren, ist ein Fehler aufgetreten. Sie müssen die Konfigurationsdateien /includes/configure.php und /admin/includes/configure.php manuell bearbeiten und stellen Sie sicher, dass die "define" für "DB_PREFIX" korrekt für die Tabellen der Zen Cart Datenbank eingestellt ist.');
  break;
  case ('73'):
    define('POPUP_ERROR_HEADING', 'FEHLER: Das neue Präfix der Tabellen konnten nicht auf alle Tabellen angewendet werden');
    define('POPUP_ERROR_TEXT', 'Bei dem Versuch, das Präfix der Tabellen umzubenennen, ist ein Fehler aufgetreten. Bitte überprüfen Sie die Namen der Tabellen in Ihrer Zen Cart Datenbank manuell. Im schlimmsten Fall müssen Sie eine Datenbank-Wiederherstellung von Ihrer Sicherung durchführen.');
  break;
  case ('74'):
    define('POPUP_ERROR_HEADING', 'HINWEIS: PHP "session.save_path" ist nicht beschreibbar');
    define('POPUP_ERROR_TEXT', '<strong>Das ist nur ein Hinweis</strong>, der Ihnen mitteilt, dass Sie nicht in den durch die PHP-Einstellung "session.save_path" festgelegten Pfad schreiben können.<br /><br />Das heißt Sie können diesen Pfad nicht zum Speichern temporärer Dateien nutzen.  Nutzen Sie stattdessen den vorgeschlagenen Cache-Pfad.');
  break;
  case ('75'):
    define('POPUP_ERROR_HEADING', 'HINWEIS: PHP "magic_quotes_runtime" ist aktiv');
    define('POPUP_ERROR_TEXT', 'Es empfiehlt sich "magic_quotes_runtime" zu deaktivieren. Ist es dennoch aktiv kann es unerwartete SQL Fehler (1064) verursachen.<br /><br />Wenn Sie es nicht für den kompletten Server deaktivieren können, ist es evtl. per .htaccess oder Ihre eigene php.ini-Datei in Ihrem privaten Webspace möglich. Bitten Sie Ihren Webhoster um Hilfe.');
  break;
  case ('76'):
    define('POPUP_ERROR_HEADING', 'Database Engine Versions-Informationen unbekannt');
    define('POPUP_ERROR_TEXT', 'Die Version Ihrer Datenbank-Engine kann nicht ermittelt werden.<br /><br />Das ist nicht zwingend ein ernsthaftes Problem. Das kann auf Produktivsystem absolut üblich sein.<br /><br />Es ist ok, fortzufahren, wenn diese Information als "Unknown" angezeigt wird.');
  break;
  case ('77'):
    define('POPUP_ERROR_HEADING', 'Datei-Uploads sind DEAKTIVIERT');
    define('POPUP_ERROR_TEXT', 'Datei-Uploads sind DEAKTIVIERT. Um sie zu aktivieren, stellen Sie sicher, dass <em><strong>file_uploads = on</strong></em> in Ihrer php.ini Datei vorhanden ist.');
  break;
  case ('78'):
    define('POPUP_ERROR_HEADING', 'ADMIN PASSWORT IST FüR EIN UPDATE NOTWENDIG');
    define('POPUP_ERROR_TEXT', 'Der Admin-Nutzername sowie das Passwort des Shops wird benötigt um die notwendigen Änderungen in der Datenbank vornehmen zu können.<br /><br />Bitte geben Sie einen gültigen Nutzernamen sowie das daszugehörige Passwort ein.');
  break;
  case ('79'):
    define('POPUP_ERROR_HEADING','OpenSSL Information');
    define('POPUP_ERROR_TEXT','OpenSSL ist "eine" Möglichkeit um Ihren Server SSL-fähig (https://) zu machen.<br /><br />Sollte dies nicht möglich sein, kann es folgende Ursachen haben:<br />(a) Ihr Webhoster unterstützt SSL nicht<br />(b) Auf Ihrem Webserver ist OpenSSL nicht installiert, aber es KöNNTE eine anderer SSL-Service verfügbar sein<br />(c) Ihr Webhoster weiß nicht über Ihr SSL-Zertifikat bescheid, so dass Sie SSL-Unterstützung für Ihre Domain freischalten.<br />(d) PHP ist noch nicht für die Verwendung von OpenSSL konfiguriert.<br /><br />Sie sollten auf jeden Fall Ihren Webhoster kontaktieren, wenn Sie SLL-Verschlüsselung verwenden wollen.');
  break;
  case ('80'):
    define('POPUP_ERROR_HEADING', 'PHP Session Support wird benötigt');
    define('POPUP_ERROR_TEXT', 'Sie müssen PHP Sessions auf Ihrem Webserver aktivieren. Sie könnten versuchen folgendes Modul zu installieren: php4-session ');
  break;
  case ('81'):
    define('POPUP_ERROR_HEADING', 'PHP sollte nicht als CGI laufen, sofern der Server nicht auf Windows läuft');
    define('POPUP_ERROR_TEXT', 'PHP als CGI auszuführen kann auf einigen Linux/Unix-Servern Probleme verursachen.<br /><br />Windows-Servers, führen PHP immer als CGI-Modul aus. In diesem Fall kann diese Warnung ignoriert werden..');
  break;
  case ('82'):
    define('POPUP_ERROR_HEADING', ERROR_TEXT_DISABLE_FUNCTIONS);
    define('POPUP_ERROR_TEXT', 'In Ihre PHP Konfiguration (php.ini) sind eine oder mehrere der folgenden Funktionen deaktiviert:<br /><ul><li>set_time_limit</li><li>exec</li></ul>Ihr Server leidet wahrscheinlich unter gedrosselter Leistung um die Sicherheitsmaßnahmen zu gewährleisten. Dies wird meist auf hoch frequentierten öffentlichen Servern gemacht. Das ist allerdings nicht optimal für e-Commerce-Systeme.<br /><br />Deshalb sollten Sie sich mit Ihrem Webhoster in Verbindung setzen, um eine Lösung für dieses Problem zu finden.');
  break;
  case ('83'):
    define('POPUP_ERROR_HEADING','Unerlaubtes Zeichen im Tabellen-Präfix');
    define('POPUP_ERROR_TEXT','Der Tabellen-Präfix darf nur Buchstaben, Zahlen und den Unterstrich (_) enthalten.keines der folgenden Zeichen enthalten :<br /><br />Bitte nutzen Sie einen anderen Präfix. Wir empfehlen sowas wie "zen_" .');
  break;
  case ('84'):
    define('POPUP_ERROR_HEADING','PHP Session.autostart sollte deaktiviert werden.');
    define('POPUP_ERROR_TEXT','Die session.auto_start Option in Ihrer php.ini ist auf ON gesetzt. <br /><br />Dies könnte evtl. zu Problemen mit dem Session-Handling führen, da Zen Cart Sessions startet sobald es bereit ist. Das automatische Starten der Sessions kann bei einigen Server-Konfigurationen zu Fehlern führen.<br /><br />Um die Option zu deaktivieren, können Sie folgenden Eintrag in einer .htaccess-Datei (Wurzelverzeichnis) probieren: <br /><br /><code>php_value session.auto_start 0</code>');
  break;
  case ('85'):
    define('POPUP_ERROR_HEADING','Einige Updates (SQL) konnten nicht installiert werden.');
    define('POPUP_ERROR_TEXT','Während des Datenbank-Updates wurden einige SQL-Anweisungen nicht ausgeführt damit keine doppelten Einträge entstehen.<br /><br />Die häufigsten Ursachen dieser Fehler/Ausnahmen sind installierte Add-Ons die Änderungen an der Kern-Datenbank-Struktur vornehmen. Der Updater versucht keine Probleme zu generieren. <br /><br />Ihr Shop sollte trotz dieser Fehler funktionieren. Wir empfehlen trotzdem dies vorher zu testen. <br /><br />Wollen Sie die Fehler dennoch untersuchen können Sie in der Tabelle "upgrade_exceptions" nach Details suchen.');
  break;
  case ('86'):
    define('POPUP_ERROR_HEADING','PHP Session.use_trans_sid sollte deaktiviert werden.');
    define('POPUP_ERROR_TEXT','Die session.use_trans_sid Option in Ihrer php.ini ist auf ON gesetzt. <br /><br />Dies könnte evtl. zu Problemen mit dem Session-Handling führen.<br /><br />Durch setzen einer .htaccess mit einem Parameter (<a href="http://www.olate.com/articles/252">http://www.olate.com/articles/252</a>) kann man dies umgehen. Oder Sie deaktivieren diese Einstellung in Ihrer php.ini.<br /><br />Mehr Informationen zu Sicherheitsrisiken erhalten Sie hier: <a href="http://shh.thathost.com/secadv/2003-05-11-php.txt">http://shh.thathost.com/secadv/2003-05-11-php.txt</a>.');
  break;
  case ('87'):
    define('POPUP_ERROR_HEADING','Zugriffsrechte für Datenbank-Nutzer benötigt');
    define('POPUP_ERROR_TEXT','Zen Cart benötigt das folgende Datenbank-Zugriffsrechte:<ul><li>ALL PRIVILEGES<br /><em>oder</em></li><li>SELECT</li><li>INSERT</li><li>UPDATE</li><li>DELETE</li><li>CREATE</li><li>ALTER</li><li>INDEX</li><li>DROP</li></ul>Im täglichen Gebrauch benötigt man zwar keine "CREATE" und "DROP" Rechte, aber diese sind für die Installation, ein Update oder SQL-Patches unverzichtbar.');
  break;
  case ('88'):
    define('POPUP_ERROR_HEADING','Fehler beim Schreiben in /includes/configure.php');
    define('POPUP_ERROR_TEXT','Bei dem Versuch Ihre Einstellungen in die dafür vorgesehene Datei (configure.php) zu schreiben konnte Zen Cart&reg;-Installer das erfolgreiche Schreiben der Datei nicht bestätigen. Bitte prüfen Sie die Zugriffsrechte der configure.php-Dateien.<br /><br />- /includes/configure.php<br />- /admin/includes/configure.php<br /><br />Bitte prüfen Sie ebenfalls, dass ausreichend Webspace zur Verfügung steht. <br /><br />Sollten die Dateien eine Gr&ouml;&szlig;e von 0-bytes haben, ist wahrscheinlich nicht genügend Plattenplatz vorhanden.<br /><br />Optimale Zugriffsrechte für Unix/Linux: CHMOD 777 bis Intalltion komplett, danach CHMOD 644 oder 444.<br /><br />Unter Windows sollte nach der Installation der Schreibschutz aktiviert werden.');
  break;
  case ('89'):
    define('POPUP_ERROR_HEADING','GD Support Details');
    define('POPUP_ERROR_TEXT','Zen Cart&reg; nutzt GD in PHP, soweit vorhanden, um Bilder zu verarbeiten. version 2.0 wird empfohlen.<br /><br />Sollte die GD-Unterstützung nicht in die PHP-Installation eincompiliert worden sein, sollten sie Ihren Webhoster um Hilfe bitten.');
  break;
  case ('90'):
    define('POPUP_ERROR_HEADING','MySQL 5 wird nicht vollständig unterstützt');
    define('POPUP_ERROR_TEXT','Es wurde viel Mühe investiert um Datenbank-Abfragen in Zen Cart&reg; mit MySQL 5 kompatibel zu machen, trotzdem ist ein vollständiger Test noch nicht abgeschlossen.<br /><br />Sie können die Installation fortsetzen, sollten aber immer beachten, dass die vollständige Unterstützung noch in der Entwicklung ist.<br /><br />Sollten Sie bei der Nutzung von Zen Cart&reg; mit MySQL 5 auf SQL-Fehlermeldungen stoßen, melden Sie diese bitte in unserem Support-Forum (Bitte schauen Sie erst, ob das Problem nicht schon gemeldet wurde!), so dass wir das Problem beheben können.');
  break;
  case ('91'):
    define('POPUP_ERROR_HEADING','PHP-Versions Warnung');
    define('POPUP_ERROR_TEXT','Zen Cart&reg; läuft mit PHP ab Version 4.3.2.<br /><br />Ältere PHP-Versionen besitzen einige von Zen Cart&reg; verwendete Funktionen nicht und andere sind fehlerhaft.<br /><br />Wir empfehlen dringend Ihre PHP-Version auf den aktuellsten Stand zu bringen, wenn Sie Zen Cart&reg; auf diesem Server verwenden wollen.');
  break;
  case ('92'):
    define('POPUP_ERROR_HEADING','open_basedir Einschränkungen können Probleme verursachen');
    define('POPUP_ERROR_TEXT','Ihr PHP ist so konfiguriert, dass Sie Ihre Skripte nur in einem "basedir"-Verzeichnis ausführen können. Dennoch scheinen Ihre Dateien in einem Verzeichnis außerhalb des erlaubten "basedir" zu liegen.<br /><br />U.a. könnten Sie Probleme mit Datei-Uploads oder Backups bekommen.<br /><br />Sie sollten sich mit Ihrem Webhoster in Verbindung setzen um dieses Problem zu beheben.');
  break;
  case ('93'):
    define('POPUP_ERROR_HEADING','cURL Unterstützung nicht gefunden');
    define('POPUP_ERROR_TEXT','Einige Zahlungs- sowie Versand-Module von Drittanbietern benötigen cURL um mit externen Servern kommunizieren zu können. <br /><br />Es scheint, dass Ihr Server cURL-Support nicht konfiguriert hat oder dies für Ihren Account nicht aktiviert ist. Sind Sie auf diese Module angewiesen, müssen Sie Ihren Webhoster bitten cURL auf Ihrem Server zu installieren.');
  break;
  case ('94'):
    define('POPUP_ERROR_HEADING', 'NOTE: PHP "magic_quotes_sybase" is active');
    define('POPUP_ERROR_TEXT', 'It is best to have "magic_quotes_sybase" disabled. When enabled, it can cause unexpected 1064 SQL errors, and other code-execution problems.<br /><br />If you cannot disable it for the whole server, it may be possible to disable via .htaccess or your own php.ini file in your private webspace.  Talk to your hosting company for assistance.');
  break;
  case ('95'):
    define('POPUP_ERROR_HEADING','CURL benötigt SSL Support. Bitte kontaktieren Sie Ihren Provider');
    define('POPUP_ERROR_TEXT','Zen Cart&reg; uses CURL and SSL to communicate with some payment and shipping service providers.<br />The installer has just tested your CURL SSL support and found that it failed.<br /><br />You will not be able to use PayPal or Authorize.net or FirstData/Linkpoint payment modules, and possibly other third-party contributed payment/shipping modules until you enable SSL support in CURL and PHP.<br /><br />More information on CURL can be found at the <a href="http://curl.haxx.se" target="_blank">CURL website</a>');
  break;
  case ('96'):
    define('POPUP_ERROR_HEADING','Adminordner Name');
    define('POPUP_ERROR_TEXT','Geben Sie bitte einen neuen Namen für den Admin Ordner an. Der Adminordner muss umbenannt werden damit das Adminsystem betreten werden kann');
  break;

}
define('TEXT_VERSION_CHECK_NEW_VER', 'Neue Version verfügbar v');
define('TEXT_VERSION_CHECK_NEW_PATCH', 'Neuer PATCH verfügbar: v');
define('TEXT_VERSION_CHECK_PATCH', 'patch');
define('TEXT_VERSION_CHECK_DOWNLOAD', 'Hier herunterladen');
define('TEXT_VERSION_CHECK_CURRENT', 'Ihre Zen Cart version scheint aktuell zu sein.');
define('TEXT_ERROR_NEW_VERSION_AVAILABLE', '<a href="http://www.zen-cart-pro.at/forum">Es steht eine NEUERE VERSION der deutschen Zen Cart Version zur Verfügung, die Sie hier herunterladen können: </a><a href="http://www.zen-cart-pro.at/forum" style="text-decoration:underline" target="_blank">www.zen-cart-pro.at</a>');
define('LABEL_ZC_VERSION_CHECK', 'Zen Cart Version:');
