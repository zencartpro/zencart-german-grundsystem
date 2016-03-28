<?php
/**
 * Main German language file for installer
 * @package Installer
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: lngDeutsch.php 7 2016-03-28 13:49:16Z webchills $
 */
/**
 * defining language components for the page
 */
define('META_TAG_TITLE', 'Zen Cart 1.5.5 deutsch - Installationsprogramm');
define('HTML_PARAMS','dir="ltr" lang="de"');
define('ZC_VERSION_STRING', '%s v%s');
define('TEXT_PAGE_HEADING', 'Systemprüfung');
define('TEXT_INDEX_FATAL_ERRORS', 'Es gibt einige kritische Probleme, die behoben werden müssen bevor wie weitermachen können.');
define('TEXT_INDEX_WARN_ERRORS', 'Einige nicht kritische Probleme');
define('TEXT_HEADER_MAIN', 'TIP: Die blauen Überschriften Links sind anclickbar und liefern Infos zur Bedeutung des jeweiligen Feldes.');
define('TEXT_INDEX_HEADER_MAIN', 'TIP: Für einige Fehlermeldungen oder Warnmeldungen unten sind genauere Infos durch Anclicken der Fehlermeldung/Warnmeldung verfügbar.');
define('TEXT_INSTALLER_CHOOSE_LANGUAGE', 'Sprache wählen');
define('TEXT_HELP_CONTENT_CHOOSE_LANG', 'Zen Cart ist multilingual und unterstützt soviele Sprachen wie Sprachpakete verfügbar sind. Installieren Sie die jeweiligen Sprachpakete und betreiben Sie den kompletten Shop in mehreren Sprachen. Deutsch und Englisch sind im Grundpaket bereits enthalten.');

define('TEXT_PAGE_HEADING_SYSTEM_SETUP', 'System Setup');
define('TEXT_SYSTEM_SETUP_ADMIN_SETTINGS', 'Admin Einstellungen');
define('TEXT_SYSTEM_SETUP_CATALOG_SETTINGS', 'Shop Frontend Einstellungen');
define('TEXT_SYSTEM_SETUP_ADMIN_SERVER_DOMAIN', 'Admin Server Domain');
define('TEXT_SYSTEM_SETUP_ADMIN_SERVER_URL', 'Admin Server URL');
define('TEXT_SYSTEM_SETUP_ADMIN_PHYSICAL_PATH', 'Admin Physischer Pfad');
define('TEXT_SYSTEM_SETUP_CATALOG_ENABLE_SSL', 'SSL für das Shop Frontend aktivieren?');
define('TEXT_SYSTEM_SETUP_CATALOG_HTTP_SERVER_DOMAIN', 'Shop Frontend HTTP Domain');
define('TEXT_SYSTEM_SETUP_CATALOG_HTTP_URL', 'Shop Frontend HTTP URL');
define('TEXT_SYSTEM_SETUP_CATALOG_HTTPS_SERVER_DOMAIN', 'Shop Frontend HTTPS Domain');
define('TEXT_SYSTEM_SETUP_CATALOG_HTTPS_URL', 'Shop Frontend HTTPS URL');
define('TEXT_SYSTEM_SETUP_CATALOG_PHYSICAL_PATH', 'Shop Frontend Physischer Pfad');
define('TEXT_SYSTEM_SETUP_AGREE_LICENSE', 'Lizenzbedingungen akzeptieren: ');
define('TEXT_SYSTEM_SETUP_CLICK_TO_AGREE_LICENSE', '(Kreuzen Sie die Checkbox an, um die GPL 2 Lizenzbedingungen zu akzeptieren. Klicken Sie den Titel in der linken Spalte an, um die Lizenzbedingungen anzuzeigen.)');
define('TEXT_SYSTEM_SETUP_ERROR_DIALOG_TITLE', 'Es gibt einige Probleme');
define('TEXT_SYSTEM_SETUP_ERROR_DIALOG_CONTINUE', 'Trotzdem weitermachen');
define('TEXT_SYSTEM_SETUP_ERROR_CATALOG_PHYSICAL_PATH', 'Es scheint ein Problem zu geben mit dem ' . TEXT_SYSTEM_SETUP_CATALOG_PHYSICAL_PATH);


define('TEXT_PAGE_HEADING_DATABASE', 'Datenbank Setup');
define('TEXT_DATABASE_HEADER_MAIN', 'HINWEIS: Stellen Sie sicher, dass Sie bereits eine Datenbank angelegt haben. Dieses Installationsprogramm legt keine Datenbank an! Es befüllt lediglich eine bereits bestehende Datenbank, deren Zugangsdaten Sie hier angeben.<br/>Hilfetexte zu den einzelnen Überschriften links erhalten Sie durch Anclicken der jeweiligen Titel.');
define('TEXT_DATABASE_SETUP_SETTINGS', 'Grundeinstellungen');
define('TEXT_DATABASE_SETUP_DB_HOST', 'Datenbank Host: ');
define('TEXT_DATABASE_SETUP_DB_USER', 'Datenbank User: ');
define('TEXT_DATABASE_SETUP_DB_PASSWORD', 'Datenbank Passwort: ');
define('TEXT_DATABASE_SETUP_DB_NAME', 'Datenbank Name: ');
define('TEXT_DATABASE_SETUP_DEMO_SETTINGS', 'Demo Daten');
define('TEXT_DATABASE_SETUP_LOAD_DEMO', 'Demodaten installieren');
define('TEXT_DATABASE_SETUP_LOAD_DEMO_DESCRIPTION', 'Sollen die Demodaten in diese Datenbank geladen werden? Nur für Testshops sinnvoll!');
define('TEXT_DATABASE_SETUP_ADVANCED_SETTINGS', 'Erweiterte Einstellungen');
define('TEXT_DATABASE_SETUP_DB_CHARSET', 'Datenbank Character Set: ');
define('TEXT_DATABASE_SETUP_DB_PREFIX', 'Datenbank Präfix: ');
define('TEXT_DATABASE_SETUP_SQL_CACHE_METHOD', 'SQL Caching Methode: ');
define('TEXT_DATABASE_SETUP_JSCRIPT_SQL_ERRORS1', '<p>Beim Ausführen des SQL Installers sind einige Fehler aufgetreten');
define('TEXT_DATABASE_SETUP_JSCRIPT_SQL_ERRORS2', '<br>Details dazu finden Sie im Error Log.<p>');
define('TEXT_DATABASE_SETUP_CHARSET_OPTION_UTF8', 'UTF8 (Wir unterstützen nur utf8!)');
define('TEXT_DATABASE_SETUP_CHARSET_OPTION_LATIN1', 'Latin1');
define('TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_NONE', 'kein SQL Caching');
define('TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_DATABASE', 'Datenbank');
define('TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_FILE', 'Datei');
define('TEXT_EXAMPLE_DB_HOST', "normalerweise 'localhost'");
define('TEXT_EXAMPLE_DB_USER', 'Geben Sie Ihren MySQL Benutzernamen ein');
define('TEXT_EXAMPLE_DB_PWD', 'Geben Sie das Passwort für diesen MySQL Benutzernaemn ein');
define('TEXT_EXAMPLE_DB_PREFIX', 'am besten leer lassen');
define('TEXT_EXAMPLE_DB_NAME', 'Geben Sie den Namen Ihrer MySQL Datenbank ein');
define('TEXT_EXAMPLE_CACHEDIR', 'verweist normalerweise auf den /your/user/home/public_html/zencart/cache Ordner');

define('TEXT_DATABASE_SETUP_CONNECTION_ERROR_DIALOG_TITLE', 'Es gibt einige Probleme');
define('TEXT_CREATING_DATABASE', 'Datenbank wird befüllt...');
define('TEXT_LOADING_CHARSET_SPECIFIC', 'Lade spezifische Daten für Ihr Character Set');
define('TEXT_LOADING_DEMO_DATA', 'Lade Demodaten');
define('TEXT_LOADING_PLUGIN_DATA', 'Lade SQL für vorinstallierte Plugins');

define('TEXT_COULD_NOT_UPDATE_BECAUSE_ANOTHER_VERSION_REQUIRED', 'Konnte nicht auf Version %s aktualisieren. Wir haben festgestellt, dass Sie derzeit Version %s verwenden. Sie müssen erst die Updates durchführen um auf Version %s zu kommen.');

define('TEXT_PAGE_HEADING_ADMIN_SETUP', 'Admin Setup');
define('TEXT_ADMIN_SETUP_USER_SETTINGS', 'Admin User Einstellungen');
define('TEXT_ADMIN_SETUP_USER_NAME', 'Admin Superuser Name: ');
define('TEXT_EXAMPLE_USERNAME', 'z.B. peter');
define('TEXT_ADMIN_SETUP_USER_EMAIL', 'Admin Superuser Emailadresse: ');
define('TEXT_EXAMPLE_EMAIL', 'z.B: peter@meinshop.de');
define('TEXT_ADMIN_SETUP_USER_EMAIL_REPEAT', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email wiederholen: ');
define('TEXT_ADMIN_SETUP_USER_PASSWORD', 'Admin Passwort: ');
define('TEXT_ADMIN_SETUP_USER_PASSWORD_HELP', '<strong>NOTIEREN SIE SICH DIESES PASSWORT JETZT!!</strong>: Unterhalb ist Passwort für Ihren Admin User. Sie benötigen es zum Einloggen in den Adminbereich, daher NOTIEREN SIE SICH DIESES PASSWORT JETZT. Möglicherweise werden Sie beim ersten Login aufgefordert das Passwort zu ändern. Sie können das Passwort auch jederzeit später auf eines Ihrer Wahl ändern.');
define('TEXT_ADMIN_SETUP_ADMIN_DIRECTORY', 'Admin Verzeichnis: ');
define('TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_DEFAULT', 'Wir konnten Ihr Admin Verzeichnis nicht automatisch umbenennen. Sie müssen es selbst umbenennen bevor Sie in den Adminbereich einloggen können.');
define('TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_NOT_ADMIN_CHANGED', 'Wir haben Ihr Adminverzeichnis nicht umbenannt, da es offensichtlich bereits umbenannt wurde.');
define('TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_CHANGED', 'Wir haben das Verzeichnis admin automatisch umbenannt. Der neue Name Ihres admin Verzeichnisses steht unten, NOTIEREN SIE SICH DIESEN NAMEN!');
define('TEXT_ADMIN_SETUP_NEWSLETTER_SETTINGS', 'Newsletter');
define('TEXT_ADMIN_SETUP_NEWSLETTER_EMAIL', 'Newsletter Email: ');
define('TEXT_ADMIN_SETUP_NEWSLETTER_OPTIN', 'Newsletter bestellen: ');
//define('TEXT_MAIN_ADMIN_SETUP', '');


define('TEXT_PAGE_HEADING_COMPLETION', 'Setup abgeschlossen');
define('TEXT_COMPLETION_HEADER_MAIN', '');
define('TEXT_COMPLETION_INSTALL_COMPLETE', 'Die Installation ist jetzt abgeschlossen');
define('TEXT_COMPLETION_INSTALL_LINKS_BELOW', 'Sie können nun Ihr Shop Frontend und Ihren Adminbereich mit folgenden Links erreichen:');
define('TEXT_COMPLETION_UPGRADE_COMPLETE', 'Herzlichen Glückwunsch, Ihr Update ist nun abgeschlossen.');
define('TEXT_COMPLETION_ADMIN_DIRECTORY_WARNING', 'Wir konnten Ihr Admin Verzeichnis nicht automatisch umbenennen. Sie müssen es selbt umbenennen bevor Sie in den Adminbereich einloggen können.');
define('TEXT_COMPLETION_INSTALLATION_DIRECTORY_WARNING', 'Sie müssen nun das Verzeichnis zc_install unbedingt löschen, um zu verhindern, dass jemand den Shop neu installiert und all Ihre Daten zerstört. Solange Sie dieses Verzeichnis nicht gelöscht haben, werden Sie nicht in den Adminbereich einloggen können.');

define('TEXT_COMPLETION_CATALOG_LINK_TEXT', 'Ihr Shop Frontend');
define('TEXT_COMPLETION_ADMIN_LINK_TEXT', 'Ihr Shop Adminbereich');

define('TEXT_PAGE_HEADING_DATABASE_UPGRADE', 'Datenbank Update');
define('TEXT_DATABASE_UPGRADE_HEADER_MAIN', '');
define('TEXT_DATABASE_UPGRADE_STEPS_DETECTED', 'Die folgende Liste zeigt die verschiedenen Updateschritte, die wir für Ihre Datenbank als nötig erkannt haben.');
define('TEXT_DATABASE_UPGRADE_LEGEND_UPGRADE_STEPS', 'Bitte bestätigen Sie Ihre gewünschten Updateschritte');
define('TEXT_DATABASE_UPGRADE_ADMIN_CREDENTIALS', 'Admin Zugangsdaten (SuperUser)');
define('TEXT_VALIDATION_ADMIN_CREDENTIALS', 'Um das Update zu autorisieren, müssen Sie Benutzernamen und Passwort eines Super Admins Ihres Zen Cart Shops angeben.');
define('TEXT_HELP_TITLE_UPGRADEADMINNAME', TEXT_DATABASE_UPGRADE_ADMIN_CREDENTIALS);
define('TEXT_HELP_CONTENT_UPGRADEADMINNAME', 'Um das Update zu autorisieren, müssen Sie Benutzernamen und Passwort eines Super Admins Ihres Zen Cart Shops angeben.<br>Das sind Benutzername und Passwort, die Sie normalerweise verwenden, um in Ihre Shop Administration einzuloggen.<br>(Es ist NICHT Ihr FTP Passwort oder MySQL Passwort oder das Passwort für die Administration bei Ihrem Provider!)<br/>Nur Sie oder ein anderer Shop Administrator kennen dieses Passwort.<br>Falls Sie aus Ihrer Shopadministration ausgeperrt sind, Ihr Passwort nicht mehr kennen und nicht in den Adminbereich einloggen können, dann können Sie ein neues Passwort direkt in der Datenbank setzen so wie in folgendem FAQ Beitrag beschrieben:<br/><a href="https://www.zen-cart-pro.at/forum/threads/9866-Ich-habe-mein-Passwort-f%C3%BCr-den-Adminbereich-vergessen-Was-tun" target="_blank">Ich habe mein Passwort für den Adminbereich vergessen. Was tun?</a>.');
define('TEXT_DATABASE_UPGRADE_ADMIN_USER', 'Username');
define('TEXT_DATABASE_UPGRADE_ADMIN_PASSWORD', 'Passwort');
define('TEXT_HELP_TITLE_UPGRADEADMINPWD', 'Admin Passwort für das Update');
define('TEXT_HELP_CONTENT_UPGRADEADMINPWD', TEXT_HELP_CONTENT_UPGRADEADMINNAME);
define('TEXT_VALIDATION_ADMIN_PASSWORD', 'Ein gültiges Passwort ist erforderlich');
define('TEXT_ERROR_ADMIN_CREDENTIALS', 'Angegebener Benutzername/Passwort falsch.<br><br>' . TEXT_HELP_CONTENT_UPGRADEADMINNAME);
define('TEXT_UPGRADE_IN_PROGRESS', 'Update läuft. Fortschritt der einzelnen Schritte wird unten angezeigt ...');
define('TEXT_UPGRADE_TO_VER_X_COMPLETED', 'Update auf Version %s abgeschlossen.');
define('TEXT_NO_REMAINING_UPGRADE_STEPS', 'Das schaut gut aus! Es scheinen keine weiteren Updateschritte mehr nötig zu sein.');

define ('TEXT_CONTINUE', 'Weiter');
define ('TEXT_CANCEL', 'Abbrechen');
define ('TEXT_CONTINUE_FIX', 'Zurück und Beheben');
define ('TEXT_REFRESH', 'Neu laden');
define ('TEXT_UPGRADE', 'Update ...');
define ('TEXT_CLEAN_INSTALL', 'Frische Neuinstallation');
define ('TEXT_UPDATE_CONFIGURE', 'Update Konfigurationsdatei');

define('TEXT_NAVBAR_SYSTEM_INSPECTION', 'Systemüberprüfung');
define('TEXT_NAVBAR_SYSTEM_SETUP', 'System Setup');
define('TEXT_NAVBAR_DATABASE_UPGRADE', 'Datenbank Update');
define('TEXT_NAVBAR_DATABASE_SETUP', 'Datenbank Setup');
define('TEXT_NAVBAR_ADMIN_SETUP', 'Admin Setup');
define('TEXT_NAVBAR_COMPLETION', 'Fertig');
define('TEXT_NAVBAR_PAYMENT_PROVIDERS', 'Zahlungsanbieter');

define('TEXT_ERROR_PROBLEMS_WRITING_CONFIGUREPHP_FILES', 'Die configure.php konnten nicht vorbereitet und gespeichert werden. IHRE INSTALLATION IST NICHT KORREKT VOLLSTÄNDIG ABGESCHLOSSEN!<br>Details dazu sollten Sie in den Logdateien im Ordner /logs/ finden.');
define('TEXT_ERROR_COULD_NOT_READ_CFGFILE_TEMPLATE', 'Kann die Vorlage für die Konfigurationsdatei nicht lesen: %s. Stellen Sie sicher, dass diese Datei existiert und lesbar ist.');
define('TEXT_ERROR_COULD_NOT_WRITE_CONFIGFILE', 'Konnte die CKonfigurationsdatei nicht schreiben: %s. Stellen Sie sicher, dass diese Datei existiert und beschreibbar ist.');
define('TEXT_ERROR_STORE_CONFIGURE', "Frontend Konfigurationsdatei /includes/configure.php existiert nicht, ist nicht lesbar oder ist nicht beschreibbar");
define('TEXT_ERROR_ADMIN_CONFIGURE', "Admin Konfigurationsdatei /admin/includes/configure.php existiert nicht, ist nicht lesbar oder ist nicht beschreibbar");
define('TEXT_ERROR_PHP_VERSION', str_replace(array("\n", "\r"), '', 'Falsche PHP Version.
<p>Ihre verwendete PHP Version (' . PHP_VERSION . ') ist zu alt. Die deutsche Zen Cart Version 1.5.5 kann damit NICHT verwendet werden.</p>
<p>Diese Version von Zen Cart deutsch ist kompatibel mit PHP Versionen von 5.2.9 bis 7.0.<br>
Besuchen Sie unsere <a href="www.zen-cart-pro.at">www.zen-cart-pro.at</a> Website für die neueste deutsche Zen Cart Version</p>
'));
define('TEXT_ERROR_PHP_VERSION_RECOMMENDED', 'Für maximale Sicherheit und Kompatibilität sollten Sie mindestens PHP %s oder höher verwenden. Wir können mit der Installation trotzdem weitermachen, weisen aber darauf hin, dass Sie in Ihrem eigenen Interesse keine solch veraltete PHP Version verwenden sollten.');
define('TEXT_ERROR_PHP_VERSION_MIN', 'Die PHP Version sollte höher sein als %s');
define('TEXT_ERROR_PHP_VERSION_MAX', 'Die PHP Version sollte niedriger sein als %s');
define('TEXT_ERROR_MYSQL_SUPPORT', 'Probleme mit Ihrer MySQL (mysqli) Unterstützung');
define('TEXT_ERROR_LOG_FOLDER', DIR_FS_LOGS . ' Verzeichnis ist nicht beschreibbar');
define('TEXT_ERROR_CACHE_FOLDER', DIR_FS_SQL_CACHE . ' Verzeichnis ist nicht beschreibbar');
define('TEXT_ERROR_IMAGES_FOLDER', '/images/ Verzeichnis ist nicht beschreibbar');
define('TEXT_ERROR_DEFINEPAGES_FOLDER', '/includes/languages/german/html_includes/ Verzeichnis ist nicht beschreibbar');
define('TEXT_ERROR_MEDIA_FOLDER', '/media/ Verzeichnis ist nicht beschreibbar');
define('TEXT_ERROR_PUB_FOLDER', DIR_FS_DOWNLOAD_PUBLIC . ' Verzeichnis ist nicht beschreibbar');

define('TEXT_ERROR_CONFIGURE_REQUIRES_UPDATE', 'Ihre configure.php Datei stammt aus einer alten Zen Cart Version und muss aktualisiert werden, bevor wir weitermachen.');
define('TEXT_ERROR_HTACCESS_SUPPORT', 'Probleme mit .htaccess Unterstützung');
define('TEXT_ERROR_SESSION_SUPPORT', 'Probleme mit session Unterstützung');
define('TEXT_ERROR_SESSION_SUPPORT_USE_TRANS_SID', 'ini setting session.use_trans_sid ist aktiviert');
define('TEXT_ERROR_SESSION_SUPPORT_AUTO_START', 'ini setting session.auto_start ist aktiviert');
define('TEXT_ERROR_DB_CONNECTION', 'Probleme mit der Verbindung zur Datenbank');
define('TEXT_ERROR_DB_CONNECTION_DEFAULT', 'Möglicherweise Probleme mit der Verbindung zur Datenbank');
define('TEXT_ERROR_DB_CONNECTION_UPGRADE', 'Probleme mit der Datenbankverbindung mit den in Ihrer configure.php eingetragenen Datenbanzugangsdaten');
define('TEXT_ERROR_SET_TIME_LIMIT', 'max_execution_time setting deaktiviert ');
define('TEXT_ERROR_GD', 'GD Extension nicht aktiviert');
define('TEXT_ERROR_ZLIB', 'Zlib Extension nicht aktiviert');
define('TEXT_ERROR_OPENSSL', 'Openssl Extension nicht aktiviert');
define('TEXT_ERROR_CURL', 'Probleme mit der CURL Extension');
define('TEXT_ERROR_UPLOADS', 'Upload Extension nicht aktiviert');
define('TEXT_ERROR_XML', 'XML Extension nicht aktiviert');
define('TEXT_ERROR_GZIP', 'Gzip Extension nicht aktiviert');
define('TEXT_ERROR_EXTENSION_NOT_LOADED', '%s Extension scheint nicht geladen zu sein');
define('TEXT_ERROR_FUNCTION_DOES_NOT_EXIST', 'PHP Funktion %s existiert nicht');
define('TEXT_ERROR_CURL_LIVE_TEST', 'CURL Test fehlgeschlagen');
define('TEXT_ERROR_HTTPS', 'TIP: Sie sollten für Ihren Shop unbedingt SSL nutzen. Falls Sie bereits ein SSL Zertifikat aktiv haben, dann rufen Sie dieses Installationsprogramm gleich über https:// auf');
define('TEXT_ERROR_SUCCESS_EXISTING_CONFIGURE', '<b>UPDATEMODUS VERFÜGBAR!<br/>Es wurde eine bestehende configure.php Datei einer früheren Zen Cart Version gefunden.<br/>Wir werden versuchen, Ihre Datenbankstruktur zu aktualisieren, falls Sie unten "Update" wählen.</b>');
define('TEXT_ERROR_SUCCESS_EXISTING_CONFIGURE_NO_UPDATE', '<b>Es wurde eine bestehende configure.php Datei gefunden. Ihre Datenbank scheint allerdings aktuell zu sein. Das deutet darauf hin, dass wir uns hier in Ihrem Liveshop befinden.<br/> Wenn Sie mit der Installation fortfahren WERDEN ALLE INHALTE IHRER DATENBANK GELÖSCHT! Wollen Sie wirklich neu installieren?</b>');
define('TEXT_ERROR_MULTIPLE_ADMINS_NONE_SELECTED', 'Es scheinen mehrere Adminverzeichnisse zu existieren. Entweder entfernen Sie alte Adminverzeichnisse und clicken Aktualisieren oder wählen Sie unten das korrekte Admin Verzeichnis aus und clicken Aktualisieren.');
define('TEXT_ERROR_MULTIPLE_ADMINS_SELECTED', 'Es scheinen mehrere Admin Verzeichnisse zu existieren. Falls das ausgewählte Verzeichnis unten falsch ist, wählen Sie bitte ein anderes aus und klicken Aktualisieren.');
define('TEXT_ERROR_SUCCESS_NO_ERRORS', 'Es wurden keine Fehler oder Warnungen für Ihre Sysmkonfiguration erkannt. Sie können die Installation fortsetzen.');

define('TEXT_FORM_VALIDATION_REQUIRED', 'Erforderlich');
define('TEXT_FORM_VALIDATION_AGREE_LICENSE', 'Sie müssen die Lizenzbedingungen akzeptieren');
define('TEXT_FORM_VALIDATION_CATALOG_HTTPS_URL', 'Hier wird eine URL benötigt, auch wenn Sie übergangsweise SSL noch nicht aktivieren wollen. Versuchen Sie, Ihren normalen Domainnamen anzugeben.');

define('TEXT_NAVBAR_INSTALLATION_INSTRUCTIONS', 'Installationsanleitung');
define('TEXT_NAVBAR_FORUM_LINK', 'Forum');
define('TEXT_NAVBAR_WIKI_LINK', 'FAQ/Tutorials');

define('TEXT_HELP_TITLE_HTACCESSSUPPORT', 'htaccess Unterstützung');
define('TEXT_HELP_CONTENT_HTACCESSSUPPORT', 'Es scheint ein Problem mit der .htaccess Unterstützung auf Ihrem Server zu geben. Entweder Sie verwenden keinen Apache Webserver oder .htaccess Unterstützung ist deaktiviert oder nicht korrekt konfiguriert.<br><br>htaccess wird unbedingt benötigt, um bestimmte Dateien und Ordner auf Ihrem Server zu schützen.');
define('TEXT_HELP_TITLE_FOLDERPERMS', 'Ordner Schreibrechte');
define('TEXT_HELP_CONTENT_FOLDERPERMS', 'Die Schreibrechte für diesen Ordner sind nicht korrekt, der Ordner muss beschreibbar sein (chmod 777 oder 666)');
define('TEXT_HELP_TITLE_CONNECTIONDATABASECHECK', 'Datenbank Verbindung');
define('TEXT_HELP_CONTENT_CONNECTIONDATABASECHECK', 'Wir haben erfolglos versucht zu MySQL via localhost zu verbinden. Manche Provider erfordern bei der Angabe des Datenbank Hosts statt localhost eine IP Adresse oder andere spezielle Angabe.<br><br>Falls localhost doch für Ihren Datenbankserver korrekt sein sollte, stellen Sie sicher, dass MySQL überhaupt läuft.');
define('TEXT_HELP_TITLE_CHECKCURL', TEXT_ERROR_CURL);
define('TEXT_HELP_CONTENT_CHECKCURL', 'CURL is a background process used by (PHP in) your store to connect to external servers and services such as payment and shipping providers to process transactions or get real-time shipping quotes. When we tested CURL functionality on your server we were unable to establish a connection. This could indicate a problem with your webserver configuration. Please contact your hosting company for assistance to enable CURL support on your server.<br><br>If you are a developer running this site on an offline development server then it is unsurprising that CURL cannot connect for this test. CURL is not necessary for development purposes except for testing transactional activity, at which time connecting online will be required.');
define('TEXT_HELP_TITLE_ADMINSERVERDOMAIN', 'Admin Server Domain');
define('TEXT_HELP_CONTENT_ADMINSERVERDOMAIN', "Enter the domain name for accessing your Admin area. It is strongly recommended to use HTTPS (SSL) for this address. Consult your hosting company about enabling SSL on your site.");
define('TEXT_HELP_TITLE_ENABLESSLCATALOG', 'SSL für das Shop Frontend aktivieren?');
define('TEXT_HELP_CONTENT_ENABLESSLCATALOG', "Check this box if you have an SSL certificate on your hosting account and you want Zen Cart&reg; to use it when displaying sensitive pages such as Login, My Account, Checkout, etc.");
define('TEXT_HELP_TITLE_HTTPSERVERCATALOG', 'Shop Frontend HTTP Domain');
define('TEXT_HELP_CONTENT_HTTPSERVERCATALOG', "Enter the domain-part of the URL for your store. eg: http://www.example.com");
define('TEXT_HELP_TITLE_HTTPURLCATALOG', 'Shop Frontend HTTP URL');
define('TEXT_HELP_CONTENT_HTTPURLCATALOG', "Enter the entire URL for your store.  eg: http://www.example.com/zencart/");
define('TEXT_HELP_TITLE_HTTPSSERVERCATALOG', 'Shop Frontend HTTPS Domain');
define('TEXT_HELP_CONTENT_HTTPSSERVERCATALOG', "If you have checked the box above to enable use of SSL during checkout, you must enter here the domain-part of the https URL to your store.<br>This is typically something like:<br>https://www.example.com<br>https://www.hostingcompany.com/~username<br>https://www.hostingcompany.com/~username/subdomain.com");
define('TEXT_HELP_TITLE_HTTPSURLCATALOG', 'Shop Frontend HTTPS URL');
define('TEXT_HELP_CONTENT_HTTPSURLCATALOG', "Enter the https URL to your store. This is typically the same as the HTTPS Domain, followed by the foldername in which your store's files are kept. eg: https://www.example.com/zencart");
define('TEXT_HELP_TITLE_PHYSICALPATH', 'Shop Frontend Physischer Pfad');
define('TEXT_HELP_CONTENT_PHYSICALPATH', "This is the actual path (according to your server's filesystem) where your Zen Cart&reg; files are located. Common examples look like '/users/home/public_html/zencart'.");



define('TEXT_HELP_TITLE_DBHOST', 'Datenbank Host');
define('TEXT_HELP_CONTENT_DBHOST', "Wie lautet der Datenbank Host?  Bei den meisten Providern lautet er 'localhost', es kann aber auch eine Domainagabe sein, z.B. 'db1.myserver.com', oder eine IP-Adresse wie z.B. '192.168.0.1'.");
define('TEXT_HELP_TITLE_DBUSER', 'Datenbank Username');
define('TEXT_HELP_CONTENT_DBUSER', "Wie lautet der Username für diese Datenbank? An example username is 'myusername_store'.<br>For PCI reasons you should NEVER user 'root' here.");
define('TEXT_HELP_TITLE_DBPASSWORD', 'Datenbank Passwort');
define('TEXT_HELP_CONTENT_DBPASSWORD', "Wie lautet das Passwort für diesen Datenbankuser? als Sie die Datenbank angelegt haben, wurde auch ein Passwort erstellt. Sie finden es in der Regel in der Administrationsoberfläche Ihres Providers.");
define('TEXT_HELP_TITLE_DBNAME', 'Datenbank Name');
define('TEXT_HELP_CONTENT_DBNAME', "What is the name of the database used to hold the data? An example database name is 'zencart' or 'myaccount_zencart'.");
define('TEXT_HELP_TITLE_DBNAME', 'Database Name');
define('TEXT_HELP_CONTENT_DBNAME', "What is the name of the database used to hold the data? An example database name is 'zencart' or 'myaccount_zencart'.<br>NOTE: You must create this database BEFORE you can proceed with Zen Cart&reg; installation here.<br>You can create your MySQL database using your hosting company's control panel.");
define('TEXT_HELP_TITLE_DEMODATA', TEXT_DATABASE_SETUP_LOAD_DEMO);
define('TEXT_HELP_CONTENT_DEMODATA', "If you choose to load Demo Data, we will install a base set of products and categories, with sales and specials and attributes and more. These are useful for you to play around and see how various combinations can be set up and how they can look on your storefront.<br><br>You can certainly delete the demo products (by hand) later, or once you've toyed with the samples, you can re-run this install and choose to not install the demo data, and thus have a fully clean site for setting up your own new store.");
define('TEXT_HELP_TITLE_DBCHARSET', 'Datenbank Character Set');
define('TEXT_HELP_CONTENT_DBCHARSET', "Lassen Sie diese Einstellung unbedingt auf UTF8.");
define('TEXT_HELP_TITLE_DBPREFIX', 'Datenbank Präfix für Tabellennamen');
define('TEXT_HELP_CONTENT_DBPREFIX', "What is the prefix you would like used for database tables?  Example: 'zen_'  <strong class='alert'>TIP: Leave empty if no prefix is needed.</strong><br />You can use prefixes to allow more than one store to share the same database.");
define('TEXT_HELP_TITLE_SQLCACHEMETHOD', 'SQL Caching Methode');
define('TEXT_HELP_CONTENT_SQLCACHEMETHOD', "Default setting is 'none'. Alternatives are 'database' or 'file'. If your server is really slow, use 'none'. If your site is moderately busy, use 'database'. If your site is extremely high traffic, use 'file'. ");
define('TEXT_HELP_TITLE_SQLCACHEDIRECTORY', 'SQL Cache Directory');
define('TEXT_HELP_CONTENT_SQLCACHEDIRECTORY', "Enter the directory to use for file-based caching. This is a directory/folder on your webserver, and its permissions must be set to writable so that the webserver (eg Apache) can write files to it.");

define('TEXT_HELP_TITLE_ADMINUSER', 'Admin Superuser Name');
define('TEXT_HELP_CONTENT_ADMINUSER', "This will be the primary username used to manage your admin access and other admin user accounts. It will have unrestricted privileges.");
define('TEXT_HELP_TITLE_ADMINEMAIL', 'Admin Superuser Emailadresse');
define('TEXT_HELP_CONTENT_ADMINEMAIL', "This email address will be used for password recovery in case you forget your password.");
define('TEXT_HELP_TITLE_ADMINEMAIL2', 'Emailadresse erneut eintippen');
define('TEXT_HELP_CONTENT_ADMINEMAIL2', "Please re-enter the email address. This is just to help catch accidental typos!");
define('TEXT_HELP_TITLE_ADMINPASSWORD', 'Admin Superuser Passwort');
define('TEXT_HELP_CONTENT_ADMINPASSWORD', "NOTIEREN SIE SICH DIESES PASSWORT!!!!! Mit diesem Passwort und em Usernamen, den Sie oben angegeben haben, steigen Sie in Ihren Adminbereich ein. Beim ersten Einstieg werden Sie möglicherweise aufgefordert, das Passwort zu ändern. Sie können es auch jederzeit später in der Administration ändern.<br><br><strong>NOTIEREN SIE SICH DIESES PASSWORT JETZT!</strong>");
define('TEXT_HELP_TITLE_ADMINDIRECTORY', 'Admin Verzeichnis');
define('TEXT_HELP_CONTENT_ADMINDIRECTORY', "We try to rename your admin folder for you automatically, to offer a degree of security-by-obscurity. While we understand that this doesn't make it foolproof, it does discourage unauthorized visitors from attacking your site. You may still consider changing the foldername yourself (just rename the folder to whatever you wish it to be, by using your FTP program or your hosting company's File Manager tool in your hosting control panel).");

define('TEXT_VERSION_CHECK_NEW_VER', 'Neue Version verfügbar v');
define('TEXT_VERSION_CHECK_NEW_PATCH', 'Neuer PATCH verfügbar: v');
define('TEXT_VERSION_CHECK_PATCH', 'patch');
define('TEXT_VERSION_CHECK_DOWNLOAD', 'Hier herunterladen');
define('TEXT_VERSION_CHECK_CURRENT', 'Ihre Zen Cart Version scheint aktuell zu sein');
define('TEXT_ERROR_NEW_VERSION_AVAILABLE', '<a href="http://www.zen-cart-pro.at/">Es ist eine NEUERE Version von Zen Cart deutsch verfügbar, die Sie hier herunterladen können.</a>');

define('TEXT_DB_VERSION_NOT_FOUND', 'Es wurde keine Zen Cart Datenbank für %s gefunden!');

define('REASON_TABLE_ALREADY_EXISTS','Cannot create table %s because it already exists');
define('REASON_TABLE_DOESNT_EXIST','Cannot drop table %s because it does not exist.');
define('REASON_TABLE_NOT_FOUND','Cannot execute because table %s does not exist.');
define('REASON_CONFIG_KEY_ALREADY_EXISTS','Cannot insert configuration_key "%s" because it already exists');
define('REASON_COLUMN_ALREADY_EXISTS','Cannot ADD column %s because it already exists.');
define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','Cannot DROP column %s because it does not exist.');
define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','Cannot CHANGE column %s because it does not exist.');
define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','Cannot insert prod-type-layout configuration_key "%s" because it already exists');
define('REASON_INDEX_DOESNT_EXIST_TO_DROP','Cannot drop index %s on table %s because it does not exist.');
define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','Cannot drop primary key on table %s because it does not exist.');
define('REASON_INDEX_ALREADY_EXISTS','Cannot add index %s to table %s because it already exists.');
define('REASON_PRIMARY_KEY_ALREADY_EXISTS','Cannot add primary key to table %s because a primary key already exists.');
define('TEXT_HELP_TITLE_AGREETOTERMS', 'Lizenzbedingungen akzeptieren');
define('TEXT_HELP_CONTENT_AGREETOTERMS', "<h2>The GNU General Public License (GPL)</h2>
<p><b>Eine deutsche Übersetzung der GNU General Public License finden Sie online auf:<br/><a href=\"http://www.gnu.de/documents/gpl-2.0.de.html\" target=\"_blank\">www.gnu.de/documents/gpl-2.0.de.html</b></p>
<h3>Version 2, June 1991</h3>

<tt>

<p> Copyright (C) 1989, 1991 Free Software Foundation, Inc.<br>
                       59 Temple Place, Suite 330, Boston, MA  02111-1307  USA</p>

<p> Everyone is permitted to copy and distribute verbatim copies<br>
 of this license document, but changing it is not allowed.</p>

    <strong><p>Preamble</p></strong>

  <p>The licenses for most software are designed to take away your
freedom to share and change it.  By contrast, the GNU General Public
License is intended to guarantee your freedom to share and change free
software--to make sure the software is free for all its users.  This
General Public License applies to most of the Free Software
Foundation's software and to any other program whose authors commit to
using it.  (Some other Free Software Foundation software is covered by
the GNU Library General Public License instead.)  You can apply it to
your programs, too.</p>

  <p>When we speak of free software, we are referring to freedom, not
price.  Our General Public Licenses are designed to make sure that you
have the freedom to distribute copies of free software (and charge for
this service if you wish), that you receive source code or can get it
if you want it, that you can change the software or use pieces of it
in new free programs; and that you know you can do these things.</p>

<p>
  To protect your rights, we need to make restrictions that forbid
anyone to deny you these rights or to ask you to surrender the rights.
These restrictions translate to certain responsibilities for you if you
distribute copies of the software, or if you modify it.</p>

  <p>For example, if you distribute copies of such a program, whether
gratis or for a fee, you must give the recipients all the rights that
you have.  You must make sure that they, too, receive or can get the
source code.  And you must show them these terms so they know their
rights.</p>

  <p>We protect your rights with two steps: (1) copyright the software, and
(2) offer you this license which gives you legal permission to copy,
distribute and/or modify the software.</p>

  <p>Also, for each author's protection and ours, we want to make certain
that everyone understands that there is no warranty for this free
software.  If the software is modified by someone else and passed on, we
want its recipients to know that what they have is not the original, so
that any problems introduced by others will not reflect on the original
authors' reputations.</p>

  <p>Finally, any free program is threatened constantly by software
patents.  We wish to avoid the danger that redistributors of a free
program will individually obtain patent licenses, in effect making the
program proprietary.  To prevent this, we have made it clear that any
patent must be licensed for everyone's free use or not licensed at all.</p>

  <p>The precise terms and conditions for copying, distribution and
modification follow.</p>

        <strong><p>TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION</p></strong>

  <p><strong>0</strong>. This License applies to any program or other work which contains
a notice placed by the copyright holder saying it may be distributed
under the terms of this General Public License.  The \"Program\", below,
refers to any such program or work, and a \"work based on the Program\"
means either the Program or any derivative work under copyright law:
that is to say, a work containing the Program or a portion of it,
either verbatim or with modifications and/or translated into another
language.  (Hereinafter, translation is included without limitation in
the term \"modification\".)  Each licensee is addressed as \"you\".</p>

<p>Activities other than copying, distribution and modification are not
covered by this License; they are outside its scope.  The act of
running the Program is not restricted, and the output from the Program
is covered only if its contents constitute a work based on the
Program (independent of having been made by running the Program).
Whether that is true depends on what the Program does.</p>

  <p><strong>1</strong>. You may copy and distribute verbatim copies of the Program's
source code as you receive it, in any medium, provided that you
conspicuously and appropriately publish on each copy an appropriate
copyright notice and disclaimer of warranty; keep intact all the
notices that refer to this License and to the absence of any warranty;
and give any other recipients of the Program a copy of this License
along with the Program.</p>

<p>You may charge a fee for the physical act of transferring a copy, and
you may at your option offer warranty protection in exchange for a fee.</p>

<p>  <strong>2</strong>. You may modify your copy or copies of the Program or any portion
of it, thus forming a work based on the Program, and copy and
distribute such modifications or work under the terms of Section 1
above, provided that you also meet all of these conditions:</p>

<blockquote>

    <p>a) You must cause the modified files to carry prominent notices
    stating that you changed the files and the date of any change.</p>

    <p>b) You must cause any work that you distribute or publish, that in
    whole or in part contains or is derived from the Program or any
    part thereof, to be licensed as a whole at no charge to all third
    parties under the terms of this License.</p>

    <p>c) If the modified program normally reads commands interactively
    when run, you must cause it, when started running for such
    interactive use in the most ordinary way, to print or display an
    announcement including an appropriate copyright notice and a
    notice that there is no warranty (or else, saying that you provide
    a warranty) and that users may redistribute the program under
    these conditions, and telling the user how to view a copy of this
    License.  (Exception: if the Program itself is interactive but
    does not normally print such an announcement, your work based on
    the Program is not required to print an announcement.)</p></blockquote>

<p>These requirements apply to the modified work as a whole.  If
identifiable sections of that work are not derived from the Program,
and can be reasonably considered independent and separate works in
themselves, then this License, and its terms, do not apply to those
sections when you distribute them as separate works.  But when you
distribute the same sections as part of a whole which is a work based
on the Program, the distribution of the whole must be on the terms of
this License, whose permissions for other licensees extend to the
entire whole, and thus to each and every part regardless of who wrote it.</p>

<p>Thus, it is not the intent of this section to claim rights or contest
your rights to work written entirely by you; rather, the intent is to
exercise the right to control the distribution of derivative or
collective works based on the Program.</p>

<p>In addition, mere aggregation of another work not based on the Program
with the Program (or with a work based on the Program) on a volume of
a storage or distribution medium does not bring the other work under
the scope of this License.</p>

  <p><strong>3</strong>. You may copy and distribute the Program (or a work based on it,
under Section 2) in object code or executable form under the terms of
Sections 1 and 2 above provided that you also do one of the following:</p>
<blockquote>
    <p>a) Accompany it with the complete corresponding machine-readable
    source code, which must be distributed under the terms of Sections
    1 and 2 above on a medium customarily used for software interchange; or,</p>

   <p> b) Accompany it with a written offer, valid for at least three
    years, to give any third party, for a charge no more than your
    cost of physically performing source distribution, a complete
    machine-readable copy of the corresponding source code, to be
    distributed under the terms of Sections 1 and 2 above on a medium
    customarily used for software interchange; or,</p>

    <p>c) Accompany it with the information you received as to the offer
    to distribute corresponding source code.  (This alternative is
    allowed only for noncommercial distribution and only if you
    received the program in object code or executable form with such
    an offer, in accord with Subsection b above.)</p></blockquote>

<p>The source code for a work means the preferred form of the work for
making modifications to it.  For an executable work, complete source
code means all the source code for all modules it contains, plus any
associated interface definition files, plus the scripts used to
control compilation and installation of the executable.  However, as a
special exception, the source code distributed need not include
anything that is normally distributed (in either source or binary
form) with the major components (compiler, kernel, and so on) of the
operating system on which the executable runs, unless that component
itself accompanies the executable.</p>

<p>If distribution of executable or object code is made by offering
access to copy from a designated place, then offering equivalent
access to copy the source code from the same place counts as
distribution of the source code, even though third parties are not
compelled to copy the source along with the object code.</p>

  <p><strong>4</strong>. You may not copy, modify, sublicense, or distribute the Program
except as expressly provided under this License.  Any attempt
otherwise to copy, modify, sublicense or distribute the Program is
void, and will automatically terminate your rights under this License.
However, parties who have received copies, or rights, from you under
this License will not have their licenses terminated so long as such
parties remain in full compliance.</p>

 <p> <strong>5</strong>. You are not required to accept this License, since you have not
signed it.  However, nothing else grants you permission to modify or
distribute the Program or its derivative works.  These actions are
prohibited by law if you do not accept this License.  Therefore, by
modifying or distributing the Program (or any work based on the
Program), you indicate your acceptance of this License to do so, and
all its terms and conditions for copying, distributing or modifying
the Program or works based on it.</p>

  <p><strong>6</strong>. Each time you redistribute the Program (or any work based on the
Program), the recipient automatically receives a license from the
original licensor to copy, distribute or modify the Program subject to
these terms and conditions.  You may not impose any further
restrictions on the recipients' exercise of the rights granted herein.
You are not responsible for enforcing compliance by third parties to
this License.</p>

  <p><strong>7</strong>. If, as a consequence of a court judgment or allegation of patent
infringement or for any other reason (not limited to patent issues),
conditions are imposed on you (whether by court order, agreement or
otherwise) that contradict the conditions of this License, they do not
excuse you from the conditions of this License.  If you cannot
distribute so as to satisfy simultaneously your obligations under this
License and any other pertinent obligations, then as a consequence you
may not distribute the Program at all.  For example, if a patent
license would not permit royalty-free redistribution of the Program by
all those who receive copies directly or indirectly through you, then
the only way you could satisfy both it and this License would be to
refrain entirely from distribution of the Program.</p>

<p>If any portion of this section is held invalid or unenforceable under
any particular circumstance, the balance of the section is intended to
apply and the section as a whole is intended to apply in other
circumstances.</p>

<p>It is not the purpose of this section to induce you to infringe any
patents or other property right claims or to contest validity of any
such claims; this section has the sole purpose of protecting the
integrity of the free software distribution system, which is
implemented by public license practices.  Many people have made
generous contributions to the wide range of software distributed
through that system in reliance on consistent application of that
system; it is up to the author/donor to decide if he or she is willing
to distribute software through any other system and a licensee cannot
impose that choice.</p>
<p>

This section is intended to make thoroughly clear what is believed to
be a consequence of the rest of this License.</p>

<p>  <strong>8</strong>. If the distribution and/or use of the Program is restricted in
certain countries either by patents or by copyrighted interfaces, the
original copyright holder who places the Program under this License
may add an explicit geographical distribution limitation excluding
those countries, so that distribution is permitted only in or among
countries not thus excluded.  In such case, this License incorporates
the limitation as if written in the body of this License.</p>
<p>
  <strong>9</strong>. The Free Software Foundation may publish revised and/or new versions
of the General Public License from time to time.  Such new versions will
be similar in spirit to the present version, but may differ in detail to
address new problems or concerns.</p>

<p>Each version is given a distinguishing version number.  If the Program
specifies a version number of this License which applies to it and \"any
later version\", you have the option of following the terms and conditions
either of that version or of any later version published by the Free
Software Foundation.  If the Program does not specify a version number of
this License, you may choose any version ever published by the Free Software
Foundation.</p>

  <p><strong>10</strong>. If you wish to incorporate parts of the Program into other free
programs whose distribution conditions are different, write to the author
to ask for permission.  For software which is copyrighted by the Free
Software Foundation, write to the Free Software Foundation; we sometimes
make exceptions for this.  Our decision will be guided by the two goals
of preserving the free status of all derivatives of our free software and
of promoting the sharing and reuse of software generally.</p>

<p><strong>NO WARRANTY</strong></p>

  <p><strong>11</strong>. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY
FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN
OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
PROVIDE THE PROGRAM \"AS IS\" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED
OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS
TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE
PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING,
REPAIR OR CORRECTION.</p>

  <p><strong>12</strong>. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR
REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES,
INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING
OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED
TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY
YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER
PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE
POSSIBILITY OF SUCH DAMAGES.</p>

         <p><strong>END OF TERMS AND CONDITIONS</strong></p>



<br>
<br>
<br>



<!-- START OF 'HOW TO APPLY' SECTION -->
<p>
<strong> How to Apply These Terms to Your New Programs</strong></p>

<p>  If you develop a new program, and you want it to be of the greatest
possible use to the public, the best way to achieve this is to make it
free software which everyone can redistribute and change under these terms.</p>

 <p> To do so, attach the following notices to the program.  It is safest
to attach them to the start of each source file to most effectively
convey the exclusion of warranty; and each file should have at least
the \"copyright\" line and a pointer to where the full notice is found.</p>


<blockquote>
    <p>one line to give the program's name and a brief idea of what it does.<br>
    Copyright (C) <year>  <name of author></p>

    <p>This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.</p>

  <p>  This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.</p>

    <p>You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA</p>
</blockquote>
<p>
Also add information on how to contact you by electronic and paper mail.</p>

<p>If the program is interactive, make it output a short notice like this
when it starts in an interactive mode:</p>

<blockquote>
   <p> Gnomovision version 69, Copyright (C) year name of author
    Gnomovision comes with ABSOLUTELY NO WARRANTY; for details type `show w'.
    This is free software, and you are welcome to redistribute it
    under certain conditions; type `show c' for details.</p>
</blockquote>

<p>The hypothetical commands `show w' and `show c' should show the appropriate
parts of the General Public License.  Of course, the commands you use may
be called something other than `show w' and `show c'; they could even be
mouse-clicks or menu items--whatever suits your program.</p>
<p>
You should also get your employer (if you work as a programmer) or your
school, if any, to sign a \"copyright disclaimer\" for the program, if
necessary.  Here is a sample; alter the names:</p>

<blockquote>
  <p>Yoyodyne, Inc., hereby disclaims all copyright interest <br>in the program
  `Gnomovision' (which makes passes at compilers)<br>written by James Hacker.</p>

  <p>signature of Ty Coon, 1 April 1989<br>
  Ty Coon, President of Vice</p>
  </blockquote>

<p>This General Public License does not permit incorporating your program into
proprietary programs.  If your program is a subroutine library, you may
consider it more useful to permit linking proprietary applications with the
library.  If this is what you want to do, use the GNU Library General
Public License instead of this License.</p>");
