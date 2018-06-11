<?php
/**
 * BEISPIELDATEI ADMIN!
 *
 * @package Configuration Settings
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: dist-configure.php 2018-03-30 13:24:50Z webchills $
 * @private
 */

/*************** NOTE: This file is VERY similar to, but DIFFERENT from the "store" version of configure.php. ***********/
/***************       The 2 files should be kept separate and not used to overwrite each other.              ***********/
/*************** HINWEIS: Diese Datei ist sehr ähnlich, aber unterschiedlich von der "frontend" Version von configure.php ***********/
/***************          Die 2 Dateien sollten getrennt gehalten und nicht verwendet werden, um einander zu überschreiben.***********/

/**
 * Enter the domain for your Admin URL. If you have SSL, enter the correct https address in the HTTP_SERVER setting, instead of just an http address.
 */
  /**
 * Geben Sie die Domain für Ihre Admin-URL ein. Wenn Sie SSL haben, geben Sie die korrekte https-Adresse in der HTTP_SERVER-Einstellung ein, anstatt nur eine HTTP-Adresse.
 */

define('HTTP_SERVER', 'https://localhost');
/**
 * Note about HTTPS_SERVER:
 * There is no longer an HTTPS_SERVER setting for the Admin. Instead, put your SSL URL in the HTTP_SERVER setting above.
 */

/**
 * Note about DIR_WS_ADMIN
 * The DIR_WS_ADMIN value is now auto-detected.
 * In the rare case where it cannot be detected properly, you can add your own DIR_WS_ADMIN definition below.
 */
 /**
 * Hinweis zu HTTPS_SERVER:
 * Es gibt seit Zen Cart 1.5.5 kein HTTPS_SERVER setting für den admin mehr. Stattdessen tragen Sie einfach Ihre SSL URL bei HTTP_SERVER oben ein.
 */

/**
 * Hinweis zu DIR_WS_ADMIN
 * Der Wert für DIR_WS_ADMIN wird automatisch erknnt und muss nicht angegeben werden
 * Im sehr unwahrscheinlichen Fall, dass das Adminverzeichnis nicht korrekt erkannt wird, könnten Sie eine eigene DIR_WS_ADMIN Definition eintragen.
 */

/**
 * Enter the domain for your storefront URL.
 * Enter a separate SSL URL in HTTPS_CATALOG_SERVER if your store supports SSL.
 */
  /**
 * Geben Sie die Domain für Ihre Frontend URL ein
 * Geben Sie eine separate SSL URL in HTTPS_CATALOG_SERVER an falls Ihre Website SSL unterstützt.
 */

define('HTTP_CATALOG_SERVER', 'http://localhost');
define('HTTPS_CATALOG_SERVER', 'https://localhost');

/**
 * Do you use SSL for your customers login/checkout on the storefront? If so, enter 'true'. Else 'false'.
 */
 /**
 * Verwenden Sie SSL für Login/Checkout der Kunden im Frontend? Falls ja, 'true'. Falls nein 'false'.
 * EIN LIVESHOP SOLLTE AUF GAR KEINEN FALL OHNE SSL BETRIEBEN WERDEN, daher stellen Sie sicher, dass Sie ein SSL Zertifikat aktiv haben und stellen dann hier immer auf true
 */
define('ENABLE_SSL_CATALOG', 'true');

/**
 * These DIR_WS_xxxx values refer to the name of any subdirectory in which your store is located.
 * These values get added to the HTTP_CATALOG_SERVER and HTTPS_CATALOG_SERVER values to form the complete URLs to your storefront.
 * They should always start and end with a slash ... ie: '/' or '/foldername/'
 */
 /**
 * Diese DIR_WS_xxxx-Werte beziehen sich auf den Namen eines Unterverzeichnisses, in dem sich Ihr Shop befindet
 * Diese Werte werden zu den Werten HTTP_CATALOG_SERVER und HTTPS_CATALOG_SERVER hinzugefügt, um die vollständigen URLs zu Ihrem Shop zu bilden.
 * Sie sollten immer mit einem Schrägstrich beginnen und enden ... d.h: '/' oder '/ordnername/'
 */
define('DIR_WS_CATALOG', '/');
define('DIR_WS_HTTPS_CATALOG', '/');

/**
 * This is the complete physical path to your store's files.  eg: /var/www/vhost/accountname/public_html/store/
 * Should have a closing / on it.
 */
 /**
  * Dies ist der komplette physische Pfad zu den Dateien Ihres Shops. z.B.: /var/www/vhost/accountname/public_html/store/
 * Sollte immer einen Slash / enden.
 */
define('DIR_FS_CATALOG', '/var/www/vhost/accountname/public_html/store/');

/**
 * NOTE about DIR_FS_ADMIN
 * The value for DIR_FS_ADMIN is now auto-detected.
 * In the very rare case where there is a need to override the autodetection, simply add your own definition for it below.
 */

/**
 * The following settings define your database connection.
 * These must be the SAME as you're using in your non-admin copy of configure.php
 * Die folgenden Einstellungen definieren Ihre Datenbankverbindung.
 * Sie müssen hier dieselben Datenbankdaten verwenden wie in der configure.php in Ihrem Adminverzeichnis!
 */
define('DB_TYPE', 'mysql'); // immer 'mysql'
define('DB_PREFIX', ''); // Prefix für die Datenbanktabellen, am besten KEIN Prefix verwenden
define('DB_CHARSET', 'utf8'); // immer 'utf8'
define('DB_SERVER', 'localhost');  // Adresse des Datenbankservers
define('DB_SERVER_USERNAME', ''); // Datenbankusername
define('DB_SERVER_PASSWORD', ''); // Datenbankpasswort
define('DB_DATABASE', ''); // Name der Datenbank

/**
 * This is an advanced setting to determine whether you want to cache SQL queries.
 * Options are 'none' (which is the default) and 'file' and 'database'.
 */
 /**
 * Dies ist eine erweiterte Einstellung, um festzustellen, ob Sie SQL-Abfragen zwischenspeichern möchten
 * Optionen sind 'none' (empfohlene Voreinstellung) oder 'file' oder 'database'.
 */
define('SQL_CACHE_METHOD', 'none');

/**
 * Reserved for future use
 */
  /**
 * Dieses Setting wird derzeit nicht verwendet und ist für spätere Versionen gedacht
 */

define('SESSION_STORAGE', '');

/**
 * Advanced use only:
 * The following are OPTIONAL, and should NOT be set unless you intend to change their normal use. Most sites will leave these untouched.
 * To use them, uncomment AND add a proper defined value to them.
 */
 /**
 * Profi User only:
 * Die folgenden Einstellungen sind OPTIONAL und sollten NICHT gesetzt werden, es sei denn, Sie beabsichtigen, ihre normale Verwendung zu ändern. Die meisten Seiten werden diese unberührt lassen.
 * Um sie zu verwenden, entkommentieren und einen entsprechenden Wert eintragen.
 * Sehr sinnvoll kann es sein, den Ordner zu den Logfiles auf eine Ebene unterhalb des Shopverzeichnisses zu legen, so dass dieser nicht per www erreichbar ist, das wäre dann z.B.
 * define('DIR_FS_LOGS','/var/irgendwas/logs');
 */
// define('DIR_FS_SQL_CACHE','');
// define('DIR_FS_DOWNLOAD','');
// define('DIR_FS_LOGS','');