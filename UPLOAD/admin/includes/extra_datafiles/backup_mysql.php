<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2022-10-07 08:48:51Z webchills $
 */
if (!defined('FILENAME_BACKUP')) {
    define('FILENAME_BACKUP', 'backup');
}
define('FILENAME_BACKUP_MYSQL', 'backup_mysql');

// Set this to 'true' if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
define('COMPRESS_OVERRIDE','false');
//define('COMPRESS_OVERRIDE','true');

// define the locations of the mysql utilities.  Use FORWARD slashes /.

// Typical hosting Unix/Linux location is in '/usr/bin/' ... but not on Windows servers.
// try 'c:/mysql/bin/mysql.exe' and 'c:/mysql/bin/mysqldump.exe' on Windows hosts ... change drive letter and path as needed
define('MYSQL_EXE',     '/usr/bin/mysql');  // used for restores
define('MYSQLDUMP_EXE', '/usr/bin/mysqldump');  // used for backups

// If you use a local development server such as WAMP or XAMPP with a different MYSQL path to your production hosting, put the full paths here too.
// eg C:/wamp/bin/mysql/mysql5.6.12/bin/mysql.exe' or C:/xampp/mysql/bin/mysql.exe'
define('MYSQL_EXE_LOCAL',     'C:/wamp/bin/mysql/mysql5.6.12/bin/mysql.exe');  // used for restores
define('MYSQLDUMP_EXE_LOCAL', 'C:/wamp/bin/mysql/mysql5.6.12/bin/mysqldump.exe');  // used for backups

