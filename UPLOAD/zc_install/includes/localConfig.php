<?php
/**
 * @package install
 * @copyright Copyright 2003-2019 Zen Cart Development Team
  * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: localConfig.php 3 2019-04-12 17:59:53Z webchills $
 *
 */

/**
 * Optionally set a MySQL mode during installation
 * Ref: https://dev.mysql.com/doc/refman/5.7/en/sql-mode.html
 */
define('DB_MYSQL_MODE', 'TRADITIONAL');
// define('DB_MYSQL_MODE', 'STRICT_ALL_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION,NO_ZERO_DATE,NO_ZERO_IN_DATE,ONLY_FULL_GROUP_BY,NO_AUTO_VALUE_ON_ZERO');
