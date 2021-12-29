<?php
/**
 * Load in any user functions
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: extra_functions.php 2019-06-15 17:49:16Z webchills $
 */
// must be called appropriately
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// set directories to check for function files
$extra_functions_directory = DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/';
$ws_extra_functions_directory = DIR_WS_FUNCTIONS . 'extra_functions/';

// Check for new functions in extra_functions directory
$directory_array = array();

if ($dir = @dir($extra_functions_directory)) {
  while ($file = $dir->read()) {
    if (!is_dir($extra_functions_directory . $file)) {
      if (preg_match('~^[^\._].*\.php$~i', $file) > 0) {
        $directory_array[] = $file;
      }
    }
  }
  if (sizeof($directory_array)) {
    sort($directory_array);
  }
  $dir->close();
}

$file_cnt=0;
for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
  $file_cnt++;
  $file = $directory_array[$i];

  if (file_exists($ws_extra_functions_directory . $file)) {
    include($ws_extra_functions_directory . $file);
  }
}
