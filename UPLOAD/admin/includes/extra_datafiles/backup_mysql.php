<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2022-02-10 21:21:51Z webchills $
 */
define('FILENAME_BACKUP_MYSQL', 'backup_mysql');

// Set this to true if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
//define('COMPRESS_OVERRIDE',false);
define('COMPRESS_OVERRIDE',true);