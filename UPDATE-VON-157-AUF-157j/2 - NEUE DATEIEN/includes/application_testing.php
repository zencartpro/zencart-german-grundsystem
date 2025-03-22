<?php
/**
 * application_testing.php
 * Carry out some actions if we are using test framework
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: application_testing.php 2023-10-23 15:27:24Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
if  (isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] === 'Symfony BrowserKit') {
    define('ZENCART_TESTFRAMEWORK_RUNNING', true);
}

if (!defined('ZENCART_TESTFRAMEWORK_RUNNING')) {
    return;
}
$user = $_SERVER['USER'] ?? $_SERVER['MY_USER'] ?? 'runner';
$prefix = (IS_ADMIN_FLAG === true) ? '..' : '.';
$context = (IS_ADMIN_FLAG === true) ? 'admin' : 'store';
$config = $prefix . '/not_for_release/testFramework/Support/configs/' . $user . '.' . $context . '.configure.php';
if (!file_exists($config)) {
  die($config . ' does not exist');
}
require($config);


