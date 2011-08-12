<?php
/**
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: backup_filenames.php 2011-08-12 19:45:06Z webchills $
 */

define('FILENAME_BACKUP', 'backup');

// Set this to 'true' if the zip options aren't appearing while doing a backup, and you are certain that gzip support exists on your server
//define('COMPRESS_OVERRIDE','false');
define('COMPRESS_OVERRIDE','true');
