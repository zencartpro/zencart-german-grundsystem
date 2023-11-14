<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2015 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */


header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header('Cache-Control:none');
header("Pragma: no-cache");


// include local configuration if available
$local_conf_dir = MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/local/';
if ($dir = @dir($local_conf_dir)) {
    while ($local_conf_file = $dir->read()) {
        if (!is_dir($local_conf_dir . $local_conf_file)) {
            if (preg_match('/\.php$/', $local_conf_file) > 0) {
                @require_once($local_conf_dir . $local_conf_file);
            }
        }
    }
    $dir->close();
}
$isDebug = array_key_exists('debug', $_REQUEST);
$isDebug = 1;
if ($isDebug) {
    ini_set('display_errors', 1);
    error_reporting(1);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}


/*
 * Address timeout limits
 */
if (!ini_get('safe_mode'))
    set_time_limit(3600);

/*
 * Handle fatal errors with AJAX
 */
register_shutdown_function('installerShutdown');
function installerShutdown()
{
    global $cloudloader;
    $error = error_get_last();
    if (!is_null($error) && $error['type'] == 1) {
        header('HTTP/1.1 500 Internal Server Error');
        $errorMsg = htmlspecialchars_decode(strip_tags($error['message']));
        echo $errorMsg;
        if (isset($cloudloader))
            $cloudloader->log('Fatal error: %s on line %s in file %s', $errorMsg, $error['line'], $error['file']);
        exit;
    }
}

/*
 * Bootstrap the installer
 */

if (!function_exists('json_encode')) {
    require_once('php/json_fallback.php');
}

define('PATH_INSTALL', str_replace("\\", "/", realpath(dirname(__FILE__) . "/../../")));
$url = (defined('CLOUDLOADER_URL')) ? CLOUDLOADER_URL : 'http://cloudbeez.com';

define('CLOUDBEEZ_GATEWAY_PUBLIC', $url . '/api/public/v1'); // api/public/v1
define('CLOUDBEEZ_GATEWAY_PRIVATE', $url . '/api/private/v1'); // api/private/v1
//define('CLOUDBEEZ_CONNECTION_SPEED_TEST_URL', CLOUDLOADER_URL . '/speedtest_file.zip');
define('CLOUDBEEZ_CONNECTION_SPEED_TEST_URL', 'http://cloudbeez.com/speedtest_file.zip');
define('CLOUDBEEZ_CONNECTION_SPEED_LIMIT', 333000); // 10.000kb / 30s = 333kb/s

require_once 'CloudloaderException.php';
require_once 'CloudloaderBase.php';
require_once 'Cloudloader.php';

include_once $base_path . 'cloudloader.php';

if (!defined('MH_PLATFORM')) {
    require_once('PlatformObserver.php');
}


$install_lang = $_SESSION['language'];


if (file_exists($base_path . 'cloudloader/languages/' . $install_lang . '.php')) {
    include($base_path . 'cloudloader/languages/' . $install_lang . '.php');
} else {
    $install_lang = 'english';
    include($base_path . 'cloudloader/languages/' . $install_lang . '.php');
}


switch ($install_lang) {
    case 'english':
        $inst_lang = 'en';
        break;
    case 'german':
        $inst_lang = 'de';
        break;
    default:
        $inst_lang = 'en';
        break;
}
