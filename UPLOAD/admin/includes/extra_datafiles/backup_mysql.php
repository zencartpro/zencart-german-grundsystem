<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2019-04-13 14:43:51Z webchills $
 */
define('FILENAME_BACKUP_MYSQL', 'backup_mysql');



// Set this to true if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
define('COMPRESS_OVERRIDE',false);
//define('COMPRESS_OVERRIDE',true);
