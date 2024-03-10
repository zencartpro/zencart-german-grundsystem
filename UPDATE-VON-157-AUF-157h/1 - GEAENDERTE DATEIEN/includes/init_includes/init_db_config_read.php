<?php
/**
 * read the configuration settings from the db
 * see  {@link  https://docs.zen-cart.com/dev/code/init_system/} for more details.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_db_config_read.php 2023-10-29 19:34:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
use App\Models\Configuration;
use App\Models\ProductTypeLayout;

// need to enable caching in eloquent. for now, no caching @todo
$use_cache = (isset($_GET['nocache']) ? false : true ) ;
$config = new Configuration;
$config->loadConfigSettings();
$config = new ProductTypeLayout;
$config->loadConfigSettings();

if (file_exists(DIR_WS_CLASSES . 'db/' . DB_TYPE . '/define_queries.php')) {
  /**
 * Load the database dependant query defines
 */
  include(DIR_WS_CLASSES . 'db/' . DB_TYPE . '/define_queries.php');
}
