<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2014 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */


///////////////////////////////////////////////////////////////////////////////
///																			 //
///                 MailBeez Core file - do not edit                         //
///                                                                          //
///////////////////////////////////////////////////////////////////////////////

require('includes/application_top.php');


if (!defined('MH_DIR_FS_CATALOG')) {
    define('MH_DIR_FS_CATALOG', (substr(DIR_FS_CATALOG, -1) != '/') ? DIR_FS_CATALOG . '/' : DIR_FS_CATALOG);
    define('MH_DIR_WS_CATALOG', (substr(DIR_WS_CATALOG, -1) != '/') ? DIR_WS_CATALOG . '/' : DIR_WS_CATALOG);
}

// set MH_ROOT_PATH
if (!defined('MH_ROOT_PATH')) {
    // default location
    $_MH_ROOT_PATH = 'mailhive/';
    $_mh_search_paths = array('mailhive/', 'ext/mailhive/', 'includes/external/mailhive/');

    foreach ($_mh_search_paths as $_MH_ROOT_PATH_TRY) {
        if (file_exists(MH_DIR_FS_CATALOG . $_MH_ROOT_PATH_TRY . 'cloudbeez/cloudloader_core.php')) {
            $_MH_ROOT_PATH = $_MH_ROOT_PATH_TRY;
            break;
        }
    }

    define('MH_ROOT_PATH', $_MH_ROOT_PATH);
}
if (isset($_POST['cloudloader_mode']) || isset($_GET['cloudloader_mode'])) {
    // installer entrypoint
    if (file_exists(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/dev_environment.php')) {
        include(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/dev_environment.php');
    }
    require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader/bootstrap/inc_mailbeez.php');
} else {
    if (file_exists(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/main/inc_mailbeez.php')) {
        // mailbeez installed
        require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/main/inc_mailbeez.php');
    } else {
        // not yet installed, load installer
        if (file_exists(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/local/devsettings.php')) {
            include(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'common/local/devsettings.php');
        }
        // Please install MailBeez
        if (defined('MAILBEEZ_INSTALLER_DISABLED') && MAILBEEZ_INSTALLER_DISABLED) {
            echo "installer disabled";
        } else {
            require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader/bootstrap/inc_cloudloader_core_bootstrap.php');
        }
    }
}