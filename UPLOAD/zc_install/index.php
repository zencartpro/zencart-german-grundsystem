<?php
/**
 * index.php -- This is the main controller file for the Zen Cart installer
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: index.php 738 2021-11-28 17:58:41Z webchills $
 */
  // Actual version check is more strict; this is just to start the program
  // For true minimum, see includes/systemChecks.yml under checkPhpVersionMin
  if (PHP_VERSION_ID < 50500) {
    die('Sorry, Mindestvoraussetzung ist PHP 5.5');
  }
  define('IS_ADMIN_FLAG',false);

/* Debugging
 *  'silent': suppress all logging
 *  'screen': display-to-screen and also to the /logs/ folder  (synonyms: TRUE or 'TRUE' or 1)
 *  'file':   log-to-file-only   (synonyms: anything other than above options)
 */
  $debug_logging = 'file';

/*
 * Ensure that the include_path can handle relative paths, before we try to load any files
 */
  if (!strstr(ini_get('include_path'), '.')) ini_set('include_path', '.' . PATH_SEPARATOR . ini_get('include_path'));

/*
 * Initialize system core components
 */
  define('DIR_FS_INSTALL', __DIR__ . DIRECTORY_SEPARATOR);
  define('DIR_FS_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

  require DIR_FS_INSTALL . 'includes/application_top.php';

  if ($controller == 'cli') {
    require DIR_FS_INSTALL . 'includes/cli_controller.php';
  } else {
    require DIR_FS_INSTALL . $page_directory . '/header_php.php';
    require DIR_FS_INSTALL . DIR_WS_INSTALL_TEMPLATE . 'common/html_header.php';
    require DIR_FS_INSTALL . DIR_WS_INSTALL_TEMPLATE . 'common/main_template_vars.php';
    require DIR_FS_INSTALL . DIR_WS_INSTALL_TEMPLATE . 'common/tpl_main_page.php';
  }
