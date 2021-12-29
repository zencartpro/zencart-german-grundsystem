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

// fix for zencart 1.57
if (stristr($_SERVER['REQUEST_URI'], '?cmd=mailbeez')) {
    $redirect_url = str_replace('index.php?cmd=mailbeez&', 'mailbeez.php?', $_SERVER['REQUEST_URI']);
    header("Location: $redirect_url");
    die();
}

$cloudloader_mode = (isset($_POST['cloudloader_mode'])) ? $_POST['cloudloader_mode'] : $_GET['cloudloader_mode'];

// Advisory ID: usd201900
// https://www.usd.de
// Vulnerability Type: XSS
// 2019-12-31 Gerbert Roitburd and Markus Schneider discover vulnerability in a Penetration Test

if (!in_array($cloudloader_mode, array(
    'install_core',
    'install_package',
    'update_core',
    'update_package'))) {
    $cloudloader_mode = '';
}


if (!defined('MH_ROOT_PATH')) {
    define('MH_ROOT_PATH', 'mailhive/');
}


switch ($cloudloader_mode) {
    case 'install_core':
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader_core.php');
        break;

    case 'update_core':
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/functions/compatibility.php');
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader_core.php');
        break;

    case '_install_package':
    case 'select_package':
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader/bootstrap/inc_cloudloader_package_bootstrap.php');

        break;

    case 'install_package':
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/functions/compatibility.php');
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader_packages.php');

        break;

    case 'update_package':
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/functions/compatibility.php');
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader_packages.php');

        break;
    default:
        break;
}
