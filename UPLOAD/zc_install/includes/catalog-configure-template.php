<?php
/**
 * @package Configuration Settings
 * @copyright Copyright 2003-2017 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * File Built by %%_INSTALLER_METHOD_%% on %%_DATE_NOW_%%
 */

/*************** NOTE: This file is VERY similar to, but DIFFERENT from the "admin" version of configure.php. ***********/
/***************       The 2 files should be kept separate and not used to overwrite each other.              ***********/
/*************** HINWEIS: Diese Datei ist sehr ähnlich, aber unterschiedlich von der "admin" Version von configure.php ***********/
/***************          Die 2 Dateien sollten getrennt gehalten und nicht verwendet werden, um einander zu überschreiben.***********/

/**
 * Enter the domain for your store
 * HTTP_SERVER is your Main webserver: eg-http://www.yourdomain.com
 * HTTPS_SERVER is your Secure/SSL webserver: eg-https://www.yourdomain.com
 */
 /**
 * Geben Sie die Domain für Ihren Shop an
 * HTTP_SERVER ist die Hauptadresse zu Ihrem Shop: z.B. http://www.meinshop.de
 * HTTPS_SERVER ist die SSL Adresse zu Ihrem Shop z.B. https://www.meinshop.de
 */
define('HTTP_SERVER', '%%_CATALOG_HTTP_SERVER_%%');
define('HTTPS_SERVER', '%%_CATALOG_HTTPS_SERVER_%%');

/**
 *  If you want to tell Zen Cart to use your HTTPS URL on sensitive pages like login and checkout, set this to 'true'. Otherwise 'false'. (Keep the quotes)
 */
 /**
 *  Wenn Sie Zen Cart mitteilen möchten, dass Sie Ihre HTTPS URL auf sensible Seiten wie Login und Checkout verwenden, setzen Sie hier auf 'true'. Ansonsten 'false'. 
 */
define('ENABLE_SSL', '%%_ENABLE_SSL_CATALOG_%%');

/**
 * These DIR_WS_xxxx values refer to the name of any subdirectory in which your store is located.
 * These values get added to the HTTP_CATALOG_SERVER and HTTPS_CATALOG_SERVER values to form the complete URLs to your storefront.
 * They should always start and end with a slash ... ie: '/' or '/foldername/'
 */
 /**
 * Diese DIR_WS_xxxx-Werte beziehen sich auf den Namen eines Unterverzeichnisses, in dem sich Ihr Shop befindet
 * Diese Werte werden zu den Werten HTTP_CATALOG_SERVER und HTTPS_CATALOG_SERVER hinzugefügt, um die vollständigen URLs zu Ihrem Shop zu bilden.
 * Sie sollten immer mit einem Schrägstrich beginnen und enden ... d.h: '/' oder '/ordenername/'
 */
define('DIR_WS_CATALOG', '%%_DIR_WS_CATALOG_%%');
define('DIR_WS_HTTPS_CATALOG', '%%_DIR_WS_HTTPS_CATALOG_%%');

/**
 * This is the complete physical path to your store's files.  eg: /var/www/vhost/accountname/public_html/store/
 * Should have a closing / on it.
 */
 /**
 * Dies ist der komplette physische Pfad zu den Dateien Ihres Shops. z.B.: /var/www/vhost/accountname/public_html/store/
 * Sollte immer einen Slash / enden.
 */
define('DIR_FS_CATALOG', '%%_DIR_FS_CATALOG_%%');

/**
 * The following settings define your database connection.
 * These must be the SAME as you're using in your non-admin copy of configure.php
 *//**
 * Die folgenden Einstellungen definieren Ihre Datenbankverbindung.
 * Sie müssen hier dieselben Datenbankdaten verwenden wie in der configure.php in Ihrem Adminverzeichnis!
 */
define('DB_TYPE', '%%_DB_TYPE_%%'); // always 'mysql'
define('DB_PREFIX', '%%_DB_PREFIX_%%'); // prefix for database table names -- preferred to be left empty
define('DB_CHARSET', '%%_DB_CHARSET_%%'); // 'utf8' or 'latin1' are most common
define('DB_SERVER', '%%_DB_SERVER_%%');  // address of your db server
define('DB_SERVER_USERNAME', '%%_DB_SERVER_USERNAME_%%');
define('DB_SERVER_PASSWORD', '%%_DB_SERVER_PASSWORD_%%');
define('DB_DATABASE', '%%_DB_DATABASE_%%');

/**
 * This is an advanced setting to determine whether you want to cache SQL queries.
 * Options are 'none' (which is the default) and 'file' and 'database'.
 */
 /**
 * Dies ist eine erweiterte Einstellung, um festzustellen, ob Sie SQL-Abfragen zwischenspeichern möchten
 * Optionen sind 'none' (empfohlene Voreinstellung) oder 'file' oder 'database'.
 */
define('SQL_CACHE_METHOD', '%%_SQL_CACHE_METHOD_%%');

/**
 * Reserved for future use
 */
 /**
 * Dieses Setting wird derzeit nicht verwendet und ist für spätere Versionen gedacht
 */
define('SESSION_STORAGE', '%%_SESSION_STORAGE_%%');

/**
 * Advanced use only:
 * The following are OPTIONAL, and should NOT be set unless you intend to change their normal use. Most sites will leave these untouched.
 * To use them, uncomment AND add a proper defined value to them.
 */
 /**
 * Profi User only:
 * Die folgenden Einstellungen sind OPTIONAL und sollten NICHT gesetzt werden, es sei denn, Sie beabsichtigen, ihre normale Verwendung zu ändern. Die meisten Seiten werden diese unberührt lassen.
 * Um sie zu verwenden, entkommentieren und einen entsprechenden Wert eintragen.
 * Sinnvoll kann es sein, den Ordner zu den Logfiles auf eine Ebene unterhalb des Shopverzeichnisses zu legen, so dass dieser nicht per www erreichbar ist, das wäre dann z.B.
 * define('DIR_FS_LOGS','/var/irgendwas/logs');
 */
// define('DIR_FS_SQL_CACHE' ...
// define('DIR_FS_DOWNLOAD' ...
// define('DIR_FS_LOGS' ...
