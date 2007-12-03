<?php
/**
 * initsystem.php
 *
 * loads and interprets the autoloader files
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: initsystem.php 5705 2007-01-27 19:01:07Z wilt $
 */
$base_dir = DIR_WS_INCLUDES . 'auto_loaders/';
if (file_exists(DIR_WS_INCLUDES . 'auto_loaders/overrides/' . $loader_file)) {
  $base_dir = DIR_WS_INCLUDES . 'auto_loaders/overrides/';
}
/**
 * load the default application_top autoloader file.
 */
include($base_dir . $loader_file);
if ($loader_dir = dir(DIR_WS_INCLUDES . 'auto_loaders')) {
  while ($loader_file = $loader_dir->read()) {
    $matchPattern = '/^' . $loaderPrefix . '\./';
    if ((preg_match($matchPattern, $loader_file) > 0) && (preg_match('/\.php$/', $loader_file) > 0)) {
      if ($loader_file != $loaderPrefix . '.core.php') {
        $base_dir = DIR_WS_INCLUDES . 'auto_loaders/';
        if (file_exists(DIR_WS_INCLUDES . 'auto_loaders/overrides/' . $loader_file)) {
          $base_dir = DIR_WS_INCLUDES . 'auto_loaders/overrides/';
        }
        /**
         * load the application_top autoloader files.
         */
        include($base_dir . $loader_file);
      }
    }
  }
}
?>