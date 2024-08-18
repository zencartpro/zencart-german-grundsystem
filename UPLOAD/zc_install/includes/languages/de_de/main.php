<?php
/**
 * Main German language file for installer
 * Zen Cart German Specific
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: main.php 2024-08-17 09:53:29Z webchills $
 */


return [
'META_TAG_TITLE' => 'Zen Cart 1.5.7i deutsch - Installationsprogramm',
'HTML_PARAMS' => 'dir="ltr" lang="de"',
'ZC_VERSION_STRING' => '%s v%s',
'TEXT_PAGE_HEADING_INDEX' => 'Systemprüfung',
'TEXT_INDEX_FATAL_ERRORS' => 'Es gibt einige kritische Probleme, die behoben werden müssen bevor wie weitermachen können.',
'TEXT_INDEX_WARN_ERRORS' => 'Einige andere Probleme:',
'TEXT_INDEX_WARN_ERRORS_ALT' => 'Einige Probleme:',
'TEXT_HEADER_MAIN' => 'TIP: Die blauen Überschriften Links sind anclickbar und liefern Infos zur Bedeutung des jeweiligen Feldes.',
'TEXT_INDEX_HEADER_MAIN' => 'TIP: Für einige Fehlermeldungen oder Warnmeldungen unten sind genauere Infos durch Anclicken der Fehlermeldung/Warnmeldung verfügbar.',
'TEXT_INSTALLER_CHOOSE_LANGUAGE' => 'Sprache wählen',
'TEXT_HELP_CONTENT_CHOOSE_LANG' => 'Zen Cart ist multilingual und unterstützt soviele Sprachen wie Sprachpakete verfügbar sind. Installieren Sie die jeweiligen Sprachpakete und betreiben Sie den kompletten Shop in mehreren Sprachen. Deutsch und Englisch sind im Grundpaket bereits enthalten.',
'TEXT_PAGE_HEADING_SYSTEM_SETUP' => 'System Setup',
'TEXT_SYSTEM_SETUP_ADMIN_SETTINGS' => 'Admin Einstellungen',
'TEXT_SYSTEM_SETUP_CATALOG_SETTINGS' => 'Shop Frontend Einstellungen',
'TEXT_SYSTEM_SETUP_ADMIN_SERVER_DOMAIN' => 'Admin Server Domain',
'TEXT_SYSTEM_SETUP_ADMIN_SERVER_URL' => 'Admin Server URL',
'TEXT_SYSTEM_SETUP_ADMIN_PHYSICAL_PATH' => 'Admin Physischer Pfad',
'TEXT_SYSTEM_SETUP_CATALOG_ENABLE_SSL' => 'SSL für das Shop Frontend aktivieren?',
'TEXT_SYSTEM_SETUP_CATALOG_HTTP_SERVER_DOMAIN' => 'Shop Frontend HTTP Domain',
'TEXT_SYSTEM_SETUP_CATALOG_HTTP_URL' => 'Shop Frontend HTTP URL',
'TEXT_SYSTEM_SETUP_CATALOG_HTTPS_SERVER_DOMAIN' => 'Shop Frontend HTTPS Domain',
'TEXT_SYSTEM_SETUP_CATALOG_HTTPS_URL' => 'Shop Frontend HTTPS URL',
'TEXT_SYSTEM_SETUP_CATALOG_PHYSICAL_PATH' => 'Storefront Physischer Pfad',
'TEXT_SYSTEM_SETUP_AGREE_LICENSE' => 'Lizenzbedingungen akzeptieren: ',
'TEXT_SYSTEM_SETUP_CLICK_TO_AGREE_LICENSE' => '(Kreuzen Sie die Checkbox an, um die GPL Lizenzbedingungen zu akzeptieren. Klicken Sie den Titel in der linken Spalte an, um die Lizenzbedingungen anzuzeigen.)',
'TEXT_SYSTEM_SETUP_ERROR_DIALOG_TITLE' => 'Es gibt einige Probleme',
'TEXT_SYSTEM_SETUP_ERROR_DIALOG_CONTINUE' => 'Trotzdem weitermachen',
'TEXT_SYSTEM_SETUP_ERROR_CATALOG_PHYSICAL_PATH' => 'Es scheint ein Problem zu geben mit dem ' . '%%TEXT_SYSTEM_SETUP_CATALOG_PHYSICAL_PATH%%',
'TEXT_PAGE_HEADING_DATABASE' => 'Datenbank Setup',
'TEXT_DATABASE_HEADER_MAIN' => 'HINWEIS: Stellen Sie sicher, dass Sie bereits eine Datenbank angelegt haben. Dieses Installationsprogramm legt keine Datenbank an! Es befüllt lediglich eine bereits bestehende Datenbank, deren Zugangsdaten Sie hier angeben.<br>Hilfetexte zu den einzelnen Überschriften links erhalten Sie durch Anclicken der jeweiligen Titel.',
'TEXT_DATABASE_SETUP_SETTINGS' => 'Grundeinstellungen',
'TEXT_DATABASE_SETUP_DB_HOST' => 'Datenbank Host: ',
'TEXT_DATABASE_SETUP_DB_USER' => 'Datenbank User: ',
'TEXT_DATABASE_SETUP_DB_PASSWORD' => 'Datenbank Passwort: ',
'TEXT_DATABASE_SETUP_DB_NAME' => 'Datenbank Name: ',
'TEXT_DATABASE_SETUP_DEMO_SETTINGS' => 'Demo Daten',
'TEXT_DATABASE_SETUP_LOAD_DEMO' => 'Demo Daten installieren',
'TEXT_DATABASE_SETUP_LOAD_DEMO_DESCRIPTION' => 'Sollen die Demodaten in diese Datenbank geladen werden? Nur für Testshops sinnvoll!',
'TEXT_DATABASE_SETUP_ADVANCED_SETTINGS' => 'Erweiterte Einstellungen',
'TEXT_DATABASE_SETUP_DB_CHARSET' => 'Datenbank Character Set: ',
'TEXT_DATABASE_SETUP_DB_PREFIX' => 'Datenbank Prefix: ',
'TEXT_DATABASE_SETUP_SQL_CACHE_METHOD' => 'SQL Caching Methode: ',
'TEXT_DATABASE_SETUP_JSCRIPT_SQL_ERRORS1' => 'Beim Ausführen des SQL Installers sind einige Fehler aufgetreten',
'TEXT_DATABASE_SETUP_JSCRIPT_SQL_ERRORS2' => '<br>Details dazu finden Sie im Error Log',
'TEXT_DATABASE_SETUP_CHARSET_OPTION_UTF8MB4' => 'utf8mb4 (Voreinstellung)',
'TEXT_DATABASE_SETUP_CHARSET_OPTION_UTF8' => 'utf8 (älteres Format)',
'TEXT_DATABASE_SETUP_CHARSET_OPTION_LATIN1' => 'latin1 (Uraltformat)',
'TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_NONE' => 'kein SQL Caching',
'TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_DATABASE' => 'Datenbank',
'TEXT_DATABASE_SETUP_CACHE_TYPE_OPTION_FILE' => 'Datei',
'TEXT_EXAMPLE_DB_HOST' => 'normalerweise "localhost"',
'TEXT_EXAMPLE_DB_USER' => 'Geben Sie Ihren MySQL Benutzernamen ein',
'TEXT_EXAMPLE_DB_PWD' => 'Geben Sie das Passwort für diesen MySQL Benutzernaemn ein',
'TEXT_EXAMPLE_DB_PREFIX' => 'am besten leer lassen',
'TEXT_EXAMPLE_DB_NAME' => 'Geben Sie den Namen Ihrer MySQL Datenbank ein',
'TEXT_EXAMPLE_CACHEDIR' => 'verweist normalerweise auf den /your/user/home/public_html/zencart/cache Ordner',
'TEXT_DATABASE_SETUP_CONNECTION_ERROR_DIALOG_TITLE' => 'Es gibt einige Probleme',
'TEXT_CREATING_DATABASE' => 'Datenbank wird befüllt...',
'TEXT_LOADING_CHARSET_SPECIFIC' => 'Lade spezifische Daten für Ihr Character Set',
'TEXT_LOADING_DEMO_DATA' => 'Lade Demodaten',
'TEXT_LOADING_PLUGIN_DATA' => 'Lade SQL für vorinstallierte Plugins',
'TEXT_LOADING_PLUGIN_UPGRADES' => 'Loading SQL for Plugin upgrades',
'TEXT_COULD_NOT_UPDATE_BECAUSE_ANOTHER_VERSION_REQUIRED' => 'Konnte nicht auf version %s. aktualisieren. Wir haben festgestellt, dass Sie derzeit Version v%s verwenden. Sie müssen erst die Updates durchführen um auf Version %s kommen.',
'TEXT_PAGE_HEADING_ADMIN_SETUP' => 'Admin Setup',
'TEXT_ADMIN_SETUP_USER_SETTINGS' => 'Admin User Einstellungen',
'TEXT_ADMIN_SETUP_USER_NAME' => 'Admin Superuser Name: ',
'TEXT_EXAMPLE_USERNAME' => 'z.B. peter',
'TEXT_ADMIN_SETUP_USER_EMAIL' => 'Admin Superuser Emailadresse: ',
'TEXT_EXAMPLE_EMAIL' => 'z.B: peter@meinshop.de',
'TEXT_ADMIN_SETUP_USER_EMAIL_REPEAT' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email wiederholen: ',
'TEXT_ADMIN_SETUP_USER_PASSWORD' => 'Admin Passwort: ',
'TEXT_ADMIN_SETUP_USER_PASSWORD_HELP' => '<strong>NOTIEREN SIE SICH DIESES PASSWORT JETZT!!</strong>: Unterhalb ist Passwort für Ihren Admin User. Sie benötigen es zum Einloggen in den Adminbereich, daher NOTIEREN SIE SICH DIESES PASSWORT JETZT. Möglicherweise werden Sie beim ersten Login aufgefordert das Passwort zu ändern. Sie können das Passwort auch jederzeit später auf eines Ihrer Wahl ändern.',
'TEXT_ADMIN_SETUP_ADMIN_DIRECTORY' => 'Admin Verzeichnis: ',
'TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_DEFAULT' => 'Wir konnten Ihr Admin Verzeichnis nicht automatisch umbenennen. Sie müssen es selbst umbenennen bevor Sie in den Adminbereich einloggen können.',
'TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_NOT_ADMIN_CHANGED' => 'Wir haben Ihr Adminverzeichnis nicht umbenannt, da es offensichtlich bereits umbenannt wurde.',
'TEXT_ADMIN_SETUP_ADMIN_DIRECTORY_HELP_CHANGED' => 'Wir haben das Verzeichnis admin automatisch umbenannt. Der neue Name Ihres admin Verzeichnisses steht unten, NOTIEREN SIE SICH DIESEN NAMEN!',
'TEXT_PAGE_HEADING_COMPLETION' => 'Setup abgeschlossen',
'TEXT_COMPLETION_HEADER_MAIN' => '',
'TEXT_COMPLETION_INSTALL_COMPLETE' => 'Die Installation ist jetzt abgeschlossen',
'TEXT_COMPLETION_INSTALL_LINKS_BELOW' => 'Sie können nun Ihr Shop Frontend und Ihren Adminbereich mit folgenden Links erreichen:',
'TEXT_COMPLETION_UPGRADE_COMPLETE' => 'Herzlichen Glückwunsch, Ihr Update ist nun abgeschlossen.',
'TEXT_COMPLETION_ADMIN_DIRECTORY_WARNING' => 'Wir konnten Ihr Admin Verzeichnis nicht automatisch umbenennen. Sie müssen es selbst umbenennen bevor Sie in den Adminbereich einloggen können.',
'TEXT_COMPLETION_INSTALLATION_DIRECTORY_WARNING' => 'Bitte löschen Sie das zc_install Verzeichnis jetzt',
'TEXT_COMPLETION_INSTALLATION_DIRECTORY_EXPLANATION' => 'Sie müssen nun das Verzeichnis zc_install unbedingt löschen, um zu verhindern, dass jemand den Shop neu installiert und all Ihre Daten zerstört. Solange Sie dieses Verzeichnis nicht gelöscht haben, werden Sie nicht in den Adminbereich einloggen können.',
'TEXT_COMPLETION_CATALOG_LINK_TEXT' => 'Ihr Shop Frontend',
'TEXT_COMPLETION_ADMIN_LINK_TEXT' => 'Ihr Shop Adminbereich',
'TEXT_PAGE_HEADING_DATABASE_UPGRADE' => 'Datenbank Update',
'TEXT_DATABASE_UPGRADE_HEADER_MAIN' => '',
'TEXT_DATABASE_UPGRADE_STEPS_DETECTED' => 'Die folgende Liste zeigt die verschiedenen Updateschritte, die wir für Ihre Datenbank als nötig erkannt haben.<br>Warten Sie nach dem Clicken auf Bestätigung die Erfolgsmeldung ab, bei grossen Datenbanken mit vielen Bestellungen kann der Updateprozess einige Minuten dauern.',
'TEXT_DATABASE_UPGRADE_LEGEND_UPGRADE_STEPS' => 'Bitte bestätigen Sie Ihre gewünschten Updateschritte',
'TEXT_DATABASE_UPGRADE_ADMIN_CREDENTIALS' => 'Admin Zugangsdaten (SuperUser)',
'TEXT_VALIDATION_ADMIN_CREDENTIALS' => 'Um das Update zu autorisieren, müssen Sie Benutzernamen und Passwort eines Super Admins Ihres Zen Cart Shops angeben.',
'TEXT_HELP_TITLE_UPGRADEADMINNAME' => '%%TEXT_DATABASE_UPGRADE_ADMIN_CREDENTIALS%%',
'TEXT_HELP_CONTENT_UPGRADEADMINNAME' => 'Um das Update zu autorisieren, müssen Sie Benutzernamen und Passwort eines Super Admins Ihres Zen Cart Shops angeben.<br>Das sind Benutzername und Passwort, die Sie normalerweise verwenden, um in Ihre Shop Administration einzuloggen.<br>(Es ist NICHT Ihr FTP Passwort oder MySQL Passwort oder das Passwort für die Administration bei Ihrem Provider!)<br>Nur Sie oder ein anderer Shop Administrator kennen dieses Passwort.<br>Falls Sie aus Ihrer Shopadministration ausgeperrt sind, Ihr Passwort nicht mehr kennen und nicht in den Adminbereich einloggen können, dann können Sie ein neues Passwort direkt in der Datenbank setzen so wie in folgendem FAQ Beitrag beschrieben:<br><a href="https://www.zen-cart-pro.at/forum/threads/9866-Ich-habe-mein-Passwort-f%C3%BCr-den-Adminbereich-vergessen-Was-tun" target="_blank">Ich habe mein Passwort für den Adminbereich vergessen. Was tun?</a>.',
'TEXT_DATABASE_UPGRADE_ADMIN_USER' => 'Username',
'TEXT_DATABASE_UPGRADE_ADMIN_PASSWORD' => 'Passwort',
'TEXT_HELP_TITLE_UPGRADEADMINPWD' => 'Admin Passwort für das Update',
'TEXT_HELP_CONTENT_UPGRADEADMINPWD' => '%%TEXT_HELP_CONTENT_UPGRADEADMINNAME%%',
'TEXT_VALIDATION_ADMIN_PASSWORD' => 'Ein gültiges Passwort ist erforderlich',
'TEXT_ERROR_ADMIN_CREDENTIALS' => 'Angegebener Benutzername/Passwort falsch.<br><br>' . '%%TEXT_HELP_CONTENT_UPGRADEADMINNAME%%',
'TEXT_UPGRADE_IN_PROGRESS' => 'Update läuft. Fortschritt der einzelnen Schritte wird unten angezeigt ...',
'TEXT_UPGRADE_TO_VER_X_COMPLETED' => 'Update auf Version %s abgeschlossen.',
'TEXT_NO_REMAINING_UPGRADE_STEPS' => 'Das schaut gut aus! Es scheinen keine weiteren Updateschritte mehr nötig zu sein.',
'TEXT_CONTINUE' => 'Weiter',
'TEXT_CANCEL' => 'Abbrechen',
'TEXT_CONTINUE_FIX' => 'Zurück und Beheben',
'TEXT_REFRESH' => 'Neu laden',
'TEXT_UPGRADE' => 'Update ...',
'TEXT_CLEAN_INSTALL' => 'Frische Neuinstallation',
'TEXT_UPDATE_CONFIGURE' => 'Update Konfigurationsdatei',
'TEXT_NAVBAR_SYSTEM_INSPECTION' => 'Systemüberprüfung',
'TEXT_NAVBAR_SYSTEM_SETUP' => 'System Setup',
'TEXT_NAVBAR_DATABASE_UPGRADE' => 'Datenbank Update',
'TEXT_NAVBAR_DATABASE_SETUP' => 'Datenbank Setup',
'TEXT_NAVBAR_ADMIN_SETUP' => 'Admin Setup',
'TEXT_NAVBAR_COMPLETION' => 'Fertig',

'TEXT_INDEX_ALERTS' => 'Alerts',
'TEXT_ERROR_PROBLEMS_WRITING_CONFIGUREPHP_FILES' => 'Die configure.php konnten nicht vorbereitet und gespeichert werden. IHRE INSTALLATION IST NICHT KORREKT VOLLSTÄNDIG ABGESCHLOSSEN!<br>Details dazu sollten Sie in den Logdateien im Ordner /logs/ finden.',
'TEXT_ERROR_COULD_NOT_READ_CFGFILE_TEMPLATE' => 'Kann die Vorlage für die Konfigurationsdatei nicht lesen: %s. Stellen Sie sicher, dass diese Datei existiert und lesbar ist.',
'TEXT_ERROR_COULD_NOT_WRITE_CONFIGFILE' => 'Konnte die Konfigurationsdatei nicht schreiben: %s. Stellen Sie sicher, dass diese Datei existiert und beschreibbar ist.',
'TEXT_ERROR_STORE_CONFIGURE' => 'Frontend Konfigurationsdatei /includes/configure.php existiert nicht, ist nicht lesbar oder ist nicht beschreibbar',
'TEXT_ERROR_ADMIN_CONFIGURE' => 'Admin Konfigurationsdatei /admin/includes/configure.php existiert nicht, ist nicht lesbar oder ist nicht beschreibbar',
'TEXT_ERROR_PHP_VERSION' => str_replace(["\n", "\r"], '', 'Ungeeignete PHP Version.<p>Ihre verwendete PHP Version (' . PHP_VERSION . ') ist ungeeignet. Die deutsche Zen Cart Version 1.5.7i kann damit NICHT verwendet werden</p><p>Diese Version von Zen Cart deutsch ist kompatibel mit PHP Versionen von 8.0.x bis 8.3.x, wobei 8.2.x oder 8.3.x empfohlen sind.</p>'),
'TEXT_ERROR_PHP_VERSION_RECOMMENDED' => '<p>Ihre verwendete PHP Version ist veraltet. Für maximale Sicherheit und Kompatibilität sollten Sie mindestens PHP 8.2.x oder PHP 8.3.x verwenden. Wir können mit der Installation trotzdem weitermachen, weisen aber darauf hin, dass Sie in Ihrem eigenen Interesse keine solch veraltete PHP Version verwenden sollten.</p>',
'TEXT_ERROR_PHP_VERSION_MIN' => 'Die PHP Version sollte höher sein als %s',
'TEXT_ERROR_PHP_VERSION_MAX' => 'Die PHP Version sollte niedriger sein als %s',
'TEXT_ERROR_MYSQL_SUPPORT' => 'Probleme mit Ihrer MySQL (mysqli) Unterstützung. Ihrem Server scheint die mysqli-Erweiterung für PHP zu fehlen, die wir für die Verbindung mit Ihrer Datenbank verwenden. Wenden Sie sich an Ihr Hosting-Unternehmen, wenn Sie beim Fortfahren Datenbankfehler feststellen.',
'TEXT_ERROR_PDOMYSQL_SUPPORT' => 'Probleme mit Ihrer MySQL (pdo_mysql) Unterstützung. Ihrem Server scheint die pdo_mysql-Erweiterung für PHP zu fehlen, und ohne sie können wir keine Verbindung zu Ihrer Datenbank herstellen. Wenden Sie sich an Ihr Hosting-Unternehmen, um Hilfe zu erhalten.',
'TEXT_ERROR_PDOSQLITE_SUPPORT' => 'Ihrem Server scheint die pdo_sqlite-Erweiterung für PHP zu fehlen, die für kleine Zwischenspeicher und zum Testen von Anwendungen verwendet wird. Wenden Sie sich an Ihr Hosting-Unternehmen, um Hilfe zu erhalten.',
'TEXT_ERROR_PHPZIP_SUPPORT' => 'Ihrem Server scheint die php-zip-Erweiterung für PHP zu fehlen, die zum Entpacken von Zip-Dateien bei der Installation der Demo-Datenbilder verwendet wird. Wenden Sie sich an Ihr Hosting-Unternehmen, um Hilfe zu erhalten.',
'TEXT_ERROR_LOG_FOLDER' => DIR_FS_LOGS . ' Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_CACHE_FOLDER' => DIR_FS_SQL_CACHE . ' Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_IMAGES_FOLDER' => '/images/ Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_DEFINEPAGES_FOLDER' => '/includes/languages/german/html_includes/ Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_MEDIA_FOLDER' => '/media/ Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_PUB_FOLDER' => DIR_FS_DOWNLOAD_PUBLIC . ' Verzeichnis ist nicht beschreibbar',
'TEXT_ERROR_NGINX_FOLDER' => '/zc_install/includes/nginx_conf/ folder is not writeable',
'TEXT_ERROR_CONFIGURE_REQUIRES_UPDATE' => 'Ihre configure.php Datei stammt aus einer alten Zen Cart Version und muss aktualisiert werden, bevor wir weitermachen.',
'TEXT_ERROR_HTACCESS_SUPPORT' => 'Unterstützung für ".htaccess" Dateien ist nicht aktiviert.<br>[ <i><b>HINWEIS:</b> Falls Sie Nginx verwenden, finden Sie am <u>ENDE</u> dieses Installationsassistenten Informationen zur Verwendung von .htaccess Dateien in Nginx.<i> ]',
'TEXT_ERROR_SESSION_SUPPORT' => 'Probleme mit session Unterstützung',
'TEXT_ERROR_SESSION_SUPPORT_USE_TRANS_SID' => 'ini setting session.use_trans_sid ist aktiviert',
'TEXT_ERROR_SESSION_SUPPORT_AUTO_START' => 'ini setting session.auto_start ist aktiviert',
'TEXT_ERROR_DB_CONNECTION' => 'Probleme mit der Verbindung zur Datenbank',
'TEXT_ERROR_DB_CONNECTION_DEFAULT' => 'Möglicherweise Probleme mit der Verbindung zur Datenbank',
'TEXT_ERROR_DB_CONNECTION_UPGRADE' => 'Probleme mit der Datenbankverbindung mit den in Ihrer configure.php eingetragenen Datenbankzugangsdaten',
'TEXT_ERROR_SET_TIME_LIMIT' => 'max_execution_time setting deaktiviert',
'TEXT_ERROR_GD' => 'GD Extension nicht aktiviert',
'TEXT_ERROR_INTL' => 'INTL Extension nicht aktiviert. Erforderlich zum Handling von Datumsangaben und locale Support.',
'TEXT_ERROR_JSON' => 'JSON Extension nicht aktiviert. Erforderlich zum Parsen von Daten.',
'TEXT_ERROR_FILEINFO' => 'Fileinfo extension nicht aktiviert. Erforderlich zum Ermitteln von Dateigroessen.',
'TEXT_ERROR_ZLIB' => 'Zlib Extension nicht aktiviert',
'TEXT_ERROR_OPENSSL' => 'Openssl Extension nicht aktiviert',
'TEXT_ERROR_CURL' => 'Probleme mit der CURL Extension - PHP meldet, dass CURL nicht verfügbar ist.',
'TEXT_ERROR_UPLOADS' => 'Upload Extension in PHP nicht aktiviert',
'TEXT_ERROR_XML' => 'XML Extension in PHP nicht aktiviert',
'TEXT_ERROR_GZIP' => 'Die GZip Extension in PHP nicht aktiviert<br>[ <i><strong>HINWEIS:</strong> Falls Sie Nginx verwenden und GZip innerhalb von Nginx abhandeln, muss das für Sie nicht relevant sein.</i> ]',
'TEXT_ERROR_EXTENSION_NOT_LOADED' => '%s extension scheint nicht geladen zu sein',
'TEXT_ERROR_FUNCTION_DOES_NOT_EXIST' => 'PHP function %s existiert nicht',
'TEXT_ERROR_CURL_LIVE_TEST' => 'CURL Test fehlgeschlagen',
'TEXT_ERROR_HTTPS' => 'TIP: Sie sollten für Ihren Shop unbedingt SSL nutzen. Falls Sie bereits ein SSL Zertifikat aktiv haben, dann rufen Sie dieses Installationsprogramm gleich über https:// auf',
'TEXT_ERROR_SUCCESS_EXISTING_CONFIGURE' => 'Es wurde eine existierende configure.php-Datei gefunden, was auf eine bereits existierende Installation hinweist.',
'TEXT_ERROR_SUCCESS_EXISTING_CONFIGURE_NO_UPDATE' => 'Es wurde eine vorhandene Datei configure.php gefunden. Ihre Datenbank scheint jedoch aktuell zu sein. Dies deutet darauf hin, dass Sie sich auf einer Live-Site befinden. Wenn Sie mit der Installation fortfahren, wird der Inhalt der aktuellen Datenbank gelöscht! Sind Sie sicher, dass Sie mit der Installation fortfahren möchten?',
'TEXT_ERROR_MULTIPLE_ADMINS_NONE_SELECTED' => 'Es scheinen mehrere Admin-Verzeichnisse zu existieren. Entfernen Sie entweder die doppelten Admin-Verzeichnisse und klicken Sie auf Aktualisieren oder wählen Sie unten das richtige Admin-Verzeichnis und klicken Sie auf Aktualisieren.',
'TEXT_ERROR_MULTIPLE_ADMINS_SELECTED' => 'Es scheinen mehrere Admin-Verzeichnisse zu existieren. Wenn das unten ausgewählte Verzeichnis falsch ist, wählen Sie bitte ein anderes und klicken Sie auf Aktualisieren.',
'TEXT_ERROR_MYSQL_VERSION' => 'Die Datenbank am Server hat nicht die erforderliche minimale Version. MySQL: %s oder MariaDB: %s',
'TEXT_ERROR_SUCCESS_NO_ERRORS' => 'Auf Ihrem System wurden keine Fehler festgestellt. Sie können mit der Installation fortfahren.',
'TEXT_UPGRADE_INFO' => '%%TEXT_UPGRADE%%: prüft Ihre Datenbank und bietet anschließend die erforderlichen Schritte für ein Upgrade auf die aktuelle Version an (Hinzufügen neuer Felder/Ändern bestehender Felder). Dies ist ein nicht-destruktiver Prozess, aber wie bei allen Änderungen müssen Sie sicherstellen, dass Sie ein verifiziertes Backup Ihrer Datenbank zur Verfügung haben, bevor Sie fortfahren.',
'TEXT_CLEAN_INSTALL_INFO' => '%%TEXT_CLEAN_INSTALL%%: setzt die Datenbank in einen neuen Zustand zurück und löscht alle Daten. Optional können die Demodaten als Teil dieses Prozesses geladen werden.',
'TEXT_FORM_VALIDATION_REQUIRED' => 'erforderlich',
'TEXT_FORM_VALIDATION_AGREE_LICENSE' => 'Sie müssen den Lizemzbedingungen zustimmen',
'TEXT_FORM_VALIDATION_CATALOG_HTTPS_URL' => 'Hier ist eine URL erforderlich, auch wenn Sie SSL vorübergehend noch nicht aktiviert haben. Versuchen Sie, Ihren normalen Domänennamen zu verwenden.',
'TEXT_NAVBAR_INSTALLATION_INSTRUCTIONS' => 'Installationsanleitung',
'TEXT_NAVBAR_FORUM_LINK' => 'Forum',

'TEXT_HELP_TITLE_HTACCESSSUPPORT' => '.htaccess Unterstützung',
'TEXT_HELP_CONTENT_HTACCESSSUPPORT' => 'Es scheint ein Problem mit der Unterstützung von ".htaccess"-Dateien zu geben.<br>Sensible Dateien und Ordner auf Ihrer Website, die normalerweise durch Sicherheitsregeln in den integrierten ".htaccess"-Dateien, die mit Zen Cart geliefert werden, blockiert werden sollten, sind derzeit zugänglich.<br><br>Mögliche Ursachen:
<ul style="list-style-type:square"><li>Sie verwenden möglicherweise nicht Apache als Webserver ("htaccess"-Dateien sind nur für den Apache-Webserver verfügbar), oder,</li><li>Die Unterstützung für ".htaccess" ist deaktiviert oder falsch konfiguriert, oder,</li><li>Die ".htaccess"-Dateien, die mit Zen Cart geliefert werden, wurden nicht auf Ihre Website hochgeladen. <br><strong><i>Dateien, die mit "." beginnen, wie z.B. ".htaccess"-Dateien, werden in der Regel als "versteckte" Dateien behandelt, und Ihr FTP-Programm hat es möglicherweise versäumt, diese hochzuladen, wenn Sie die Anzeige und/oder Übertragung solcher versteckten Dateien in seinen Einstellungen deaktiviert haben.</i></strong></li></ul><br>
Sie können trotz dieser Situation mit der Installation fortfahren, aber bitte beachten Sie, dass Ihre Website weniger sicher sein wird, als sie sein sollte (wenn Sie den Apache-Webserver verwenden).<br><br>Wenn Sie den Nginx-Webserver verwenden, fahren Sie bitte mit der Installation fort und sichern Sie Ihre Installation mit den entsprechenden Nginx-Richtlinien, die unter "<strong>Wichtige Sicherheitsinformationen für Nginx</strong>" im Abschnitt "Setup abgeschlossen" dieses Installationsassistenten angegeben sind. <br><br>Wenn Sie nicht wissen, welcher Webserver verwendet wird, gehen Sie bitte davon aus, dass es sich um den Apache-Webserver handelt, und bitten Sie Ihren Webhosting-Anbieter um Hilfe bei der Aktivierung der ".htaccess"-Unterstützung.<br><br>',
'TEXT_HELP_TITLE_FOLDERPERMS' => 'Ordner Schreibrechte',
'TEXT_HELP_CONTENT_FOLDERPERMS' => 'Die Schreibrechte für diesen Ordner sind nicht korrekt, der Ordner muss beschreibbar sein (chmod 777 oder 666)',
'TEXT_HELP_TITLE_CONNECTIONDATABASECHECK' => 'Datenbank Verbindung',
'TEXT_HELP_CONTENT_CONNECTIONDATABASECHECK' => 'Wir haben erfolglos versucht zu MySQL via localhost zu verbinden. Manche Provider erfordern bei der Angabe des Datenbank Hosts statt localhost eine IP Adresse oder andere spezielle Angabe.<br><br>Falls localhost doch für Ihren Datenbankserver korrekt sein sollte, stellen Sie sicher, dass MySQL überhaupt läuft.',
'TEXT_HELP_TITLE_CHECKCURL' => '%%TEXT_ERROR_CURL%%',
'TEXT_HELP_CONTENT_CHECKCURL' => 'CURL ist ein Hintergrundprozess, der von PHP in Ihrem Shop verwendet wird, um sich mit externen Servern und Diensten wie Zahlungs- und Versandanbietern zu verbinden, um Transaktionen zu verarbeiten oder Echtzeit-Versandanfragen zu erhalten. Als wir die CURL-Funktionalität auf Ihrem Server getestet haben, konnten wir keine Verbindung herstellen. Dies könnte auf ein Problem mit Ihrer Webserverkonfiguration hinweisen. Wenden Sie sich an Ihren Hosting-Anbieter, um Unterstützung für die Aktivierung von CURL auf Ihrem Server zu erhalten.<br><br>Wenn Sie als Entwickler diese Site auf einem Offlineentwicklungsserver ausführen, ist es nicht verwunderlich, dass CURL für diesen Test keine Verbindung herstellen kann. CURL ist nicht für Entwicklungszwecke erforderlich, außer für das Testen der Transaktionsaktivität. Zu diesem Zeitpunkt ist die Online-Verbindung erforderlich.',
'TEXT_HELP_TITLE_ADMINSERVERDOMAIN' => 'Admin Server Domain',
'TEXT_HELP_CONTENT_ADMINSERVERDOMAIN' => 'Geben Sie hier die URL der Domain für Ihren Adminbereich an. Sie sollten unbedingt ein SSL Zertifikat haben und für diese Adresse immer https verwenden.',
'TEXT_HELP_TITLE_ENABLESSLCATALOG' => 'SSL für das Shop Frontend aktivieren?',
'TEXT_HELP_CONTENT_ENABLESSLCATALOG' => 'Kreuzen Sie diese Box an, wenn Sie ein SSL Zertifikat haben und der Shop per https erreichbar sein soll.',
'TEXT_HELP_TITLE_HTTPSERVERCATALOG' => 'Shop Frontend HTTP Domain',
'TEXT_HELP_CONTENT_HTTPSERVERCATALOG' => 'Geben Sie die Domain zu Ihrem Shop an, z.B. http://www.meinshop.de<br>Wenn Sie ein SSL Zertifikat aktiv haben und den Shop durchgehend per https betreiben wollen (empfohlen), dann geben Sie auch hier die Adresse mit https an, also z.B. https://www.meinshop.de',
'TEXT_HELP_TITLE_HTTPURLCATALOG' => 'Shop Frontend HTTP URL',
'TEXT_HELP_CONTENT_HTTPURLCATALOG' => 'Geben Sie die vollständige Adresse zu Ihrem Shop an. Wenn der Shop z.B. im Unterverzeichnis shop liegt  http://www.meinshop.de/shop/<br><br>Wenn Sie ein SSL Zertifikat aktiv haben und den Shop durchgehend per https betreiben wollen (empfohlen), dann geben Sie auch hier die Adresse mit https an, also z.B. https://www.meinshop.de/shop',
'TEXT_HELP_TITLE_HTTPSSERVERCATALOG' => 'Shop Frontend HTTPS URL',
'TEXT_HELP_CONTENT_HTTPSSERVERCATALOG' => 'Wenn Sie oben SSL aktivieren angekreuzt haben, dann geben Sie hier die SSL Domain an, z.B. https://www.meinshop.de',
'TEXT_HELP_TITLE_HTTPSURLCATALOG' => 'Shop Frontend HTTPS URL',
'TEXT_HELP_CONTENT_HTTPSURLCATALOG' => 'Geben Sie die vollständige https Adresse zu Ihrem Shop an. Wenn der Shop z.B. im Unterverzeichnis shop liegt https://www.meinshop.de/shop/',
'TEXT_HELP_TITLE_PHYSICALPATH' => 'Shop Frontend Physischer Pfad',
'TEXT_HELP_CONTENT_PHYSICALPATH' => 'Dies ist die vollständige Pfadangabe zum Shopverzeichnis auf Ihrem Server, wurde automatisch ausgelesen und sollte korrekt sein.',
'TEXT_HELP_TITLE_DBHOST' => 'Datenbank Host',
'TEXT_HELP_CONTENT_DBHOST' => 'Was ist der Datenbank-Host?<br>Der Datenbank-Host kann in Form eines Hostnamens, wie "localhost" oder "db1.myserver.com", oder als IP-Adresse, wie "192.168.0.1", angegeben werden. Die meisten Hosting-Unternehmen verwenden hier "localhost". <br>Ihr Hosting-Unternehmen kann Ihnen sagen, was Sie verwenden sollen, und diese Informationen werden normalerweise auf dem Bildschirm in ihrer Provider Administration angezeigt, wo Sie die Datenbank erstellen und der Datenbank Benutzerrechte zuweisen.<br>Wenn Sie Hilfe benötigen, um diese Informationen zu finden, konsultieren Sie die Online-FAQ-Dokumentation Ihres Hosting-Unternehmens.',
'TEXT_HELP_TITLE_DBUSER' => 'Datenbank User',
'TEXT_HELP_CONTENT_DBUSER' => 'Wie lautet der MySQL-Benutzername, der für die Verbindung zur Datenbank verwendet wird?<br>Ein Beispiel-Benutzername ist "myusername_store".<br>Aus PCI-Gründen sollten Sie hier NIEMALS "root" verwenden, wenn Sie auf einem mit dem Internet verbundenen Server arbeiten.<br><br>Diesem MySQL-Benutzer müssen die folgenden Berechtigungen gewährt werden: ALTER, CREATE, DELETE, DROP, INDEX, INSERT, LOCK TABLES, SELECT, UPDATE (oder einfach "Grant All").',
'TEXT_HELP_TITLE_DBPASSWORD' => 'Datenbank Passwort',
'TEXT_HELP_CONTENT_DBPASSWORD' => 'Wie lautet das Passwort für den MySQL-Benutzernamen, den Sie für diese Datenbank erstellt haben?',
'TEXT_HELP_TITLE_DBNAME' => 'Datenbank Name',
'TEXT_HELP_CONTENT_DBNAME' => 'Wie lautet der Name der Datenbank, in der die Daten gespeichert werden?<br>Ein Beispiel für einen Datenbanknamen ist "zencart" oder "myaccount_zencart".<br>Hinweis: <strong>Sie</strong> müssen diese Datenbank erstellen, BEVOR Sie mit der Installation von Zen Cart fortfahren können.<br>Sie können Ihre MySQL-Datenbank über das Control Panel Ihres Hosting-Unternehmens erstellen.',
'TEXT_HELP_TITLE_DEMODATA' => '%%TEXT_DATABASE_SETUP_LOAD_DEMO%%',
'TEXT_HELP_CONTENT_DEMODATA' => 'NUR FÜR TESTSHOPS SINNVOLL, NICHT FÜR DIE INSTALLATION EINES LIVESHOPS !!! In den Demodaten werden einige Beispielkategorien und -produkte mit einer Reihe von Produktattributen (Varianten), Rabatten, Verkäufen, Sonderangeboten usw. eingerichtet. Diese sind für neue Benutzer nützlich, um die Möglichkeiten des Shops und die Darstellung dieser Produktoptionen zu erkunden.<br><br> Anschließend können Sie die Demo-Produkte manuell löschen, oder Sie können diesen Clean-Install-Prozess ohne die Demo-Daten erneut durchführen, um mit Ihren eigenen Produkten neu zu beginnen.',
'TEXT_HELP_TITLE_DBCHARSET' => 'Datenbank Character Set',
'TEXT_HELP_CONTENT_DBCHARSET' => 'Normalerweise utf8mb4 oder utf8.<br>Verwenden Sie bitte utf8mb4.',
'TEXT_HELP_TITLE_DBPREFIX' => 'Datenbank Tabellen Prefix',
'TEXT_HELP_CONTENT_DBPREFIX' => 'Wir empfehlen dringend KEIN Präfix zu verwenden, es ist nicht notwendig!<br>Welches Präfix möchten Sie für die Datenbanktabellen von Zen Cart verwenden?<br>Historisch gesehen war es beim Shared Hosting üblich, eine sehr begrenzte Anzahl von Datenbanken anzubieten. Folglich haben sich mehrere Anwendungen eine einzige Datenbank geteilt und Tabellenpräfixe verwendet, um die Tabellen der einzelnen Anwendungen zu gruppieren und voneinander zu trennen.<br>Beispiel: <strong>zen_</strong><br><strong class="alert">TIP: Leer lassen, wenn kein Präfix benötigt wird.</strong>',
'TEXT_HELP_TITLE_SQLCACHEMETHOD' => 'SQL Cache Methode',
'TEXT_HELP_CONTENT_SQLCACHEMETHOD' => 'Die Standardeinstellung ist "keine". Bitte lassen Sie diese Einstellung am besten so.<br>Alternativen sind "Datenbank" oder "Datei". Wenn Ihr Server sehr langsam ist, verwenden Sie "keine". Wenn Ihre Website mäßig ausgelastet ist, verwenden Sie "database". Wenn Ihre Website extrem stark frequentiert ist, verwenden Sie "Datei".',
'TEXT_HELP_TITLE_SQLCACHEDIRECTORY' => 'SQL Cache Verzeichnis',
'TEXT_HELP_CONTENT_SQLCACHEDIRECTORY' => 'Geben Sie das Verzeichnis an, das für die dateibasierte Zwischenspeicherung verwendet werden soll. Dies ist ein Verzeichnis/Ordner auf Ihrem Webserver, dessen Berechtigungen auf beschreibbar gesetzt werden müssen, damit der Webserver (z. B. Apache) Dateien darin schreiben kann.',
'TEXT_HELP_TITLE_ADMINUSER' => 'Admin Superuser Name',
'TEXT_HELP_CONTENT_ADMINUSER' => 'Dies ist der Hauptbenutzername, der für die Verwaltung Ihres Admin-Zugangs und anderer Admin-Benutzerkonten verwendet wird. Er hat uneingeschränkte Rechte.<br>Nennen Sie ihn aus Sicherheitsgründen bitte keinesfalls einfach admin',
'TEXT_HELP_TITLE_ADMINEMAIL' => 'Admin Superuser Email',
'TEXT_HELP_CONTENT_ADMINEMAIL' => 'Diese E-Mail-Adresse wird für die Wiederherstellung des Passworts verwendet, falls Sie Ihr Passwort vergessen haben.',
'TEXT_HELP_TITLE_ADMINEMAIL2' => 'Email erneut eingeben',
'TEXT_HELP_CONTENT_ADMINEMAIL2' => 'Bitte geben Sie die E-Mail Adresse erneut ein. Dies dient nur dazu, versehentliche Tippfehler zu vermeiden!',
'TEXT_HELP_TITLE_ADMINPASSWORD' => 'Admin Superuser Passwort',
'TEXT_HELP_CONTENT_ADMINPASSWORD' => '<strong>NOTIEREN SIE SICH DIESES PASSWORT JETZT!!!!!</strong> - Sie benötigen es für den ersten Zugang zum Admin-Bereich.<br>Dies ist das Passwort, das dem oben angegebenen Admin-Benutzernamen zugewiesen ist. Sie können aufgefordert werden, es bei der ersten Anmeldung zu ändern, oder Sie können es ändern, sobald Sie im Admin-Bereich angemeldet sind.',
'TEXT_HELP_TITLE_ADMINDIRECTORY' => 'Admin Verzeichnis',
'TEXT_HELP_CONTENT_ADMINDIRECTORY' => 'Wir versuchen, Ihr Adminverzeichnis automatisch für Sie umzubenennen, um ein gewisses Maß an Sicherheit zu bieten. Wir wissen zwar, dass dies nicht narrensicher ist, aber es schreckt unbefugte Besucher davon ab, Ihre Website anzugreifen. Sie können den Namen des Ordners auch selbst ändern (benennen Sie den Ordner einfach in den von Ihnen gewünschten Namen um, indem Sie Ihr FTP-Programm oder das Dateimanager-Tool Ihres Hosting-Unternehmens in Ihrem Hosting-Kontrollzentrum verwenden).<br>Das Verzeichnis admin MUSS umbenannt werden, um die Administration überhaupt betreten zu können.',
'TEXT_VERSION_CHECK_NEW_VER' => 'Neue Version verfügbar v',
'TEXT_VERSION_CHECK_NEW_PATCH' => 'Neuer PATCH verfügbar: v',
'TEXT_VERSION_CHECK_PATCH' => 'patch',
'TEXT_VERSION_CHECK_DOWNLOAD' => 'Hier downloaden',
'TEXT_VERSION_CHECK_CURRENT' => 'Ihre Zen Cart Version scheint aktuell zu sein.',
'TEXT_ERROR_NEW_VERSION_AVAILABLE' => '<a href="https://www.zen-cart-pro.at">Es gibt eine neuere Version der deutschen Zen Cart Version, die Sie unter </a><a href="https://www.zen-cart-pro.at" style="text-decoration:underline" rel="noopener" target="_blank">www.zen-cart-pro.at</a> herunterladen können.',
'TEXT_DB_VERSION_NOT_FOUND' => 'Eine Zen Cart Datenbank für %s wurde nicht gefunden!',
'REASON_TABLE_ALREADY_EXISTS' => 'Kann Tabelle %s nicht anlegen, da sie bereits existiert',
'REASON_TABLE_DOESNT_EXIST' => 'Kann Tabelle %s nicht löschen, da sie nicht existiert.',
'REASON_TABLE_NOT_FOUND' => 'Ausführung nicht möglich da Tabelle %s nicht existiert.',
'REASON_CONFIG_KEY_ALREADY_EXISTS' => 'Kann configuration_key "%s" nicht einfügen, da er bereits existiert',
'REASON_COLUMN_ALREADY_EXISTS' => 'Kann Spalte %s nicht hinzufügen (ADD), da sie bereits existiert.',
'REASON_COLUMN_DOESNT_EXIST_TO_DROP' => 'Kann Spalte %s nicht entfernen (DROP), da sie nicht existiert.',
'REASON_COLUMN_DOESNT_EXIST_TO_CHANGE' => 'Kann Spalte %s nicht ändern (CHANGE), da sie nicht existiert.',
'REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS' => 'Kann prod-type-layout configuration_key "%s" nicht einfügen, da er bereits existiert',
'REASON_INDEX_DOESNT_EXIST_TO_DROP' => 'Kann index %s von Tabelle %s nicht entfernen, da er nicht existiert.',
'REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP' => 'Kann primary key von table %s nicht entfernen, da er nicht existiert.',
'REASON_INDEX_ALREADY_EXISTS' => 'Kann index %s nicht zu Tabelle %s hinzufügen, da er bereits existiert.',
'REASON_PRIMARY_KEY_ALREADY_EXISTS' => 'Kann primary key nicht zu Tabelle %s hinzufügen, da bereits ein primary key existiert.',
'REASON_CONFIG_GROUP_KEY_ALREADY_EXISTS' => 'Kann configuration_group_key "%s" nicht einfügen, da er bereits existiert',
'REASON_CONFIG_GROUP_ID_ALREADY_EXISTS' => 'Kann configuration_group_id "%s" nicht hinzufügen, da sie bereits existiert',
'TEXT_COMPLETION_NGINX_TEXT' => '<u>Wichtige Sicherheitsinformationen für Nginx</u>',
'TEXT_HELP_TITLE_NGINXCONF' => 'Zen Cart auf Nginx Web Servern absichern',
'TEXT_HELP_CONTENT_NGINXCONF' => '<p>Ihre Zen Cart-Installation wird mit Sicherheitsmaßnahmen in einem Format geliefert, das dem Apache-Webserver eigen ist. <br>
Um einen ähnlichen Satz von Maßnahmen für den Nginx-Webserver zu implementieren gehen Sie wie folgt vor.</p>
<hr>
<ul style="list-style-type:square">
<li>Gehen Sie in den Ordner <strong>"zc_install/includes/nginx_conf"</strong> und öffnen Sie die folgenden Dateien mit einem Texteditor wie Notepad++ oder Ultraedit:
  <ul style="list-style-type:circle">
    <li>zencart_ngx_http.conf</li>
    <li>zencart_ngx_server.conf</li>
  </ul>
</li>
<li>Fügen Sie den Inhalt von <strong>"zencart_ngx_http.conf"</strong> unter dem Abschnitt <strong>"http"</strong> Ihrer Nginx-Konfigurationsdatei hinzu.
  <ul style="list-style-type:circle">
    <li>Bearbeiten Sie die Caching-Dauern im <strong>"map"</strong>-Block nach Bedarf</li>
  </ul>
</li>
<li>Fügen Sie den Inhalt von <strong>"zencart_ngx_server.conf"</strong> in den entsprechenden <strong>"server"</strong>-Block für Zen Cart in Ihrer Nginx-Konfigurationsdatei ein.
  <ul style="list-style-type:circle">
    <li>Die Direktiven können für SSL- und/oder Nicht-SSL-Serverblöcke verwendet werden.</li>
    <li>Die Direktiven sollten am Anfang des Serverblocks vor allen anderen Standortblöcken platziert werden.
      <ul style="list-style-type:none">
        <li>- Die Reihenfolge, in der die Direktiven erscheinen, ist wichtig.</li>
        <li>- Ändern Sie diese Reihenfolge nicht, ohne die Richtlinien und ihre Auswirkungen vollständig zu verstehen.</li>
      </ul>
  </ul>
</li>
<li>Es ist besonders wichtig, dass diese Direktiven vor allen generischen php-Behandlungsblöcken wie ... erscheinen. <br>
  <pre><code>location ~ \.php { <strong>Nginx PHP Handling Directives;</strong> }</code></pre>
  ... oder andere Ortsblöcke, die vor diesen verarbeitet werden könnten.</li>
<li>Bearbeiten Sie stattdessen den <strong>"zencart_php_handler"</strong> Location-Block, um Ihre Nginx PHP Handling Directives anzupassen.
  <ul style="list-style-type:circle">
    <li>Duplizieren Sie einfach den Inhalt Ihres bestehenden PHP-Handling-Speicherplatzblocks.
      <ul style="list-style-type:none">
        <li>- Das heißt, kopieren Sie die entsprechenden Nginx-PHP-Behandlungsrichtlinien und fügen Sie sie ein.</li>
        <li>- Wenn Sie keinen bestehenden PHP-Handling-Location-Block haben, beziehen Sie sich bitte auf verfügbare Anleitungen wie die von <a href="https://www.nginx.com/resources/wiki/start/topics/examples/phpfcgi/" rel="noopener" target="_blank"><u>The Nginx Website</u></a>.</li>
      </ul>
    </li>
  </ul>
</li>
<li>Wenn Sie Plugins für "Pretty URLs" verwenden, fügen Sie die entsprechenden Direktiven in den angegebenen Block ein.</li>
<li>Nginx neu laden.
  <ul style="list-style-type:circle">
    <li>Tun Sie dies, bevor Sie dieses Dialogfeld schließen.</li>
    <li>Denken Sie daran, den Ordner <strong>"zc_install"</strong> zu löschen, wenn Sie fertig sind.
      <ul style="list-style-type:none">
        <li>- Einschließlich des Ordners <strong>"zc_install/includes/nginx_conf"</strong> und seines Inhalts.</li>
      </ul>
    </li>
  </ul>
</li>
<ol>
</div>
<div class="alert-box alert"> <strong>WICHTIG:</strong> Diese Standortblöcke sollten <strong>VOR</strong> allen anderen Standortblöcken in Ihrem Nginx-Konfigurations-Serverblock für Zen Cart stehen.</div>
<hr>',
'TEXT_HELP_TITLE_AGREETOTERMS' => 'Den Lizenzbedingungen zustimmen',
'TEXT_HELP_CONTENT_AGREETOTERMS' => '<p><b>Eine deutsche Übersetzung der GNU General Public License finden Sie online auf: http://www.gnu.de/documents/gpl-2.0.de.html</b></p>
<h2>The GNU General Public License (GPL)</h2>
<h3>Version 2, June 1991</h3>
<tt>
<p> Copyright (C) 1989, 1991 Free Software Foundation, Inc.<br>
  59 Temple Place, Suite 330, Boston, MA 02111-1307 USA</p>
<p> Everyone is permitted to copy and distribute verbatim copies<br>
  of this license document, but changing it is not allowed.</p>
<strong>
<p>Preamble</p>
</strong>
<p>The licenses for most software are designed to take away your freedom to share and change it. By contrast, the GNU General Public License is intended to guarantee your freedom to share and change free software--to make sure the software is free for all its users. This General Public License applies to most of the Free Software Foundation\'s software and to any other program whose authors commit to using it. (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.) You can apply it to your programs, too.</p>
<p>When we speak of free software, we are referring to freedom, not price. Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.</p>
<p> To protect your rights, we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software, or if you modify it.</p>
<p>For example, if you distribute copies of such a program, whether gratis or for a fee, you must give the recipients all the rights that you have. You must make sure that they, too, receive or can get the source code. And you must show them these terms so they know their rights.</p>
<p>We protect your rights with two steps: (1) copyright the software, and (2) offer you this license which gives you legal permission to copy, distribute and/or modify the software.</p>
<p>Also, for each author\'s protection and ours, we want to make certain that everyone understands that there is no warranty for this free software. If the software is modified by someone else and passed on, we want its recipients to know that what they have is not the original, so that any problems introduced by others will not reflect on the original authors\' reputations.</p>
<p>Finally, any free program is threatened constantly by software patents. We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses, in effect making the program proprietary. To prevent this, we have made it clear that any patent must be licensed for everyone\'s free use or not licensed at all.</p>
<p>The precise terms and conditions for copying, distribution and modification follow.</p>
<strong>
<p>TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION</p>
</strong>
<p><strong>0</strong>. This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License. The "Program", below, refers to any such program or work, and a "work based on the Program" means either the Program or any derivative work under copyright law: that is to say, a work containing the Program or a portion of it, either verbatim or with modifications and/or translated into another language. (Hereinafter, translation is included without limitation in the term "modification".) Each licensee is addressed as "you".</p>
<p>Activities other than copying, distribution and modification are not covered by this License; they are outside its scope. The act of running the Program is not restricted, and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program). Whether that is true depends on what the Program does.</p>
<p><strong>1</strong>. You may copy and distribute verbatim copies of the Program\'s source code as you receive it, in any medium, provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep intact all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program.</p>
<p>You may charge a fee for the physical act of transferring a copy, and you may at your option offer warranty protection in exchange for a fee.</p>
<p> <strong>2</strong>. You may modify your copy or copies of the Program or any portion of it, thus forming a work based on the Program, and copy and distribute such modifications or work under the terms of Section 1 above, provided that you also meet all of these conditions:</p>
<blockquote>
  <p>a) You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change.</p>
  <p>b) You must cause any work that you distribute or publish, that in whole or in part contains or is derived from the Program or any part thereof, to be licensed as a whole at no charge to all third parties under the terms of this License.</p>
  <p>c) If the modified program normally reads commands interactively when run, you must cause it, when started running for such interactive use in the most ordinary way, to print or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else, saying that you provide a warranty) and that users may redistribute the program under these conditions, and telling the user how to view a copy of this License. (Exception: if the Program itself is interactive but does not normally print such an announcement, your work based on the Program is not required to print an announcement.)</p>
</blockquote>
<p>These requirements apply to the modified work as a whole. If identifiable sections of that work are not derived from the Program, and can be reasonably considered independent and separate works in themselves, then this License, and its terms, do not apply to those sections when you distribute them as separate works. But when you distribute the same sections as part of a whole which is a work based on the Program, the distribution of the whole must be on the terms of this License, whose permissions for other licensees extend to the entire whole, and thus to each and every part regardless of who wrote it.</p>
<p>Thus, it is not the intent of this section to claim rights or contest your rights to work written entirely by you; rather, the intent is to exercise the right to control the distribution of derivative or collective works based on the Program.</p>
<p>In addition, mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License.</p>
<p><strong>3</strong>. You may copy and distribute the Program (or a work based on it, under Section 2) in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following:</p>
<blockquote>
  <p>a) Accompany it with the complete corresponding machine-readable source code, which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,</p>
  <p> b) Accompany it with a written offer, valid for at least three years, to give any third party, for a charge no more than your cost of physically performing source distribution, a complete machine-readable copy of the corresponding source code, to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,</p>
  <p>c) Accompany it with the information you received as to the offer to distribute corresponding source code. (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer, in accord with Subsection b above.)</p>
</blockquote>
<p>The source code for a work means the preferred form of the work for making modifications to it. For an executable work, complete source code means all the source code for all modules it contains, plus any associated interface definition files, plus the scripts used to control compilation and installation of the executable. However, as a special exception, the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler, kernel, and so on) of the operating system on which the executable runs, unless that component itself accompanies the executable.</p>
<p>If distribution of executable or object code is made by offering access to copy from a designated place, then offering equivalent access to copy the source code from the same place counts as distribution of the source code, even though third parties are not compelled to copy the source along with the object code.</p>
<p><strong>4</strong>. You may not copy, modify, sublicense, or distribute the Program except as expressly provided under this License. Any attempt otherwise to copy, modify, sublicense or distribute the Program is void, and will automatically terminate your rights under this License. However, parties who have received copies, or rights, from you under this License will not have their licenses terminated so long as such parties remain in full compliance.</p>
<p> <strong>5</strong>. You are not required to accept this License, since you have not signed it. However, nothing else grants you permission to modify or distribute the Program or its derivative works. These actions are prohibited by law if you do not accept this License. Therefore, by modifying or distributing the Program (or any work based on the Program), you indicate your acceptance of this License to do so, and all its terms and conditions for copying, distributing or modifying the Program or works based on it.</p>
<p><strong>6</strong>. Each time you redistribute the Program (or any work based on the Program), the recipient automatically receives a license from the original licensor to copy, distribute or modify the Program subject to these terms and conditions. You may not impose any further restrictions on the recipients\' exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License.</p>
<p><strong>7</strong>. If, as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues), conditions are imposed on you (whether by court order, agreement or otherwise) that contradict the conditions of this License, they do not excuse you from the conditions of this License. If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations, then as a consequence you may not distribute the Program at all. For example, if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you, then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program.</p>
<p>If any portion of this section is held invalid or unenforceable under any particular circumstance, the balance of the section is intended to apply and the section as a whole is intended to apply in other circumstances.</p>
<p>It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the integrity of the free software distribution system, which is implemented by public license practices. Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice.</p>
<p> This section is intended to make thoroughly clear what is believed to be a consequence of the rest of this License.</p>
<p> <strong>8</strong>. If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted interfaces, the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries, so that distribution is permitted only in or among countries not thus excluded. In such case, this License incorporates the limitation as if written in the body of this License.</p>
<p> <strong>9</strong>. The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time. Such new versions will be similar in spirit to the present version, but may differ in detail to address new problems or concerns.</p>
<p>Each version is given a distinguishing version number. If the Program specifies a version number of this License which applies to it and "any later version", you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation. If the Program does not specify a version number of this License, you may choose any version ever published by the Free Software Foundation.</p>
<p><strong>10</strong>. If you wish to incorporate parts of the Program into other free programs whose distribution conditions are different, write to the author to ask for permission. For software which is copyrighted by the Free Software Foundation, write to the Free Software Foundation; we sometimes make exceptions for this. Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally.</p>
<p><strong>NO WARRANTY</strong></p>
<p><strong>11</strong>. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.</p>
<p><strong>12</strong>. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>
<p><strong>END OF TERMS AND CONDITIONS</strong></p>',
    'TEXT_UPGRADING_TO_VERSION' => 'Aktualisierung auf Version %s',
    'TEXT_PROGRESS_FINISHED' => 'Abgeschlossen',
];
