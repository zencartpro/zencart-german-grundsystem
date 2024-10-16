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





function mh_define($const, $value)
{
    if (!defined($const))
        define($const, $value);
}



mh_define('MH_ROOT_PATH', 'mailhive/');

$gx_version = null;

if (function_exists('zen_redirect')) {
    mh_define('MH_PLATFORM', 'zencart');
    // sorry zencart - didn't had the time to migrate everything to your DB-Class (might come later - its cool)
    // http://www.zen-cart.com/wiki/index.php/Developers_-_Porting_modules_from_osC
    require_once(MH_DIR_FS_CATALOG . MH_ROOT_PATH . 'cloudbeez/cloudloader/php/osc_database.php');


} elseif (function_exists('gm_get_conf')) {
    mh_define('MH_PLATFORM', 'gambio');
    if (!function_exists('xtc_date_short')) {
        require_once(DIR_FS_INC . 'xtc_date_short.inc.php');
    }
    if (!function_exists('xtc_parse_input_field_data')) {
        require_once(DIR_FS_INC . 'xtc_parse_input_field_data.inc.php');
    }
    include_once(MH_DIR_FS_CATALOG . 'release_info.php');
    //echo $gx_version;
    mh_define('MH_PLATFORM_GAMBIO', substr($gx_version, 1, 1));

} elseif (defined('PROJECT_VERSION_PLAIN')) {
    // mercari no longer supported
    /*
    mh_define('MH_PLATFORM', 'mercari');
    if (!function_exists('date_short')) {
        require_once(DIR_FS_INC . 'inc.date_short.php');
    }

    if (!function_exists('parse_input_field_data')) {
        require_once(DIR_FS_INC . 'inc.parse_input_field_data.php');
    }
    require_once(MH_DIR_FS_CATALOG . 'mailhive/cloudbeez/cloudloader/php/osc_database.php');
    $db_link = tep_db_connect();
//    require_once(MH_DIR_FS_CATALOG . 'mailhive/common/classes/oscommerce/split_page_results.php');
    mh_define('MH_PLATFORM_MERCARI', PROJECT_VERSION_TYPE . ' ' . PROJECT_VERSION_PLAIN);

    if (is_object($message_stack)) {
        $messageStack = $message_stack;
    }

    */
} elseif (function_exists('xtc_redirect')) {
    mh_define('MH_PLATFORM', 'xtc');
    if (!function_exists('xtc_date_short')) {
        require_once(DIR_FS_INC . 'xtc_date_short.inc.php');
    }
    if (!function_exists('xtc_parse_input_field_data')) {
        if (file_exists(DIR_FS_INC . 'xtc_parse_input_field_data.inc.php')) {
            require_once(DIR_FS_INC . 'xtc_parse_input_field_data.inc.php');
        } else {
            // cseov2next ultimate
            function xtc_parse_input_field_data($data, $parse)
            {
                return strtr(trim($data), $parse);
            }
        }
    }

    // matches xtcModfied and modified
    mh_define('MH_PLATFORM_XTCM', preg_match('/odified/', PROJECT_VERSION));
    mh_define('MH_PLATFORM_XTC_SEO', preg_match('/commerce:SEO/', PROJECT_VERSION));
    mh_define('MH_PLATFORM_XTC_ECB', preg_match('/eComBASE/', PROJECT_VERSION));
} elseif (defined('FILENAME_ADVANCED_MENU')) {
    mh_define('MH_PLATFORM', 'digistore');
} elseif (preg_match('/CRE Loaded/', PROJECT_VERSION) || preg_match('/Loaded/', PROJECT_VERSION)) {
    // CRE Loaded PCI B2B
    mh_define('MH_PLATFORM', 'creloaded');

    if (preg_match('/CRE Loaded PCI B2B/', PROJECT_VERSION) || preg_match('/Loaded Commerce B2B/', PROJECT_VERSION)) {
        mh_define('MH_PLATFORM_CRE', 'B2B');
    } else {
        mh_define('MH_PLATFORM_CRE', '');
    }

} else {
    mh_define('MH_PLATFORM', 'oscommerce');

    if (function_exists('tep_get_version')) {
        mh_define('MH_PLATFORM_OSC', (float)tep_get_version());
    } else {
        mh_define('MH_PLATFORM_OSC', '2.2');
    }

    if (MH_PLATFORM_OSC > 2.2) {
        mh_define('MH_PLATFORM_OSC_23', true);
    }
    mh_define('MH_PLATFORM_OSCMAX_25', preg_match('/osCmax v2.5/', PROJECT_VERSION));

    mh_define('MH_PLATFORM_TRUELOADED', preg_match('/Trueloaded/', PROJECT_VERSION));

    /*
    // WP Online Store
    if (defined('WPOLS_PLUGINS_DIR')) {
        mh_define('MH_PLATFORM_OSC_WPOS', PROJECT_VERSION);
        mh_define('MH_FORM_METHOD', 'post');
        mh_define('MH_PAGE_NAME', 'pages');

        $post = mh_cfg('MAILBEEZ_MAILHIVE_WPOLS_PAGE_ID');
        if (mh_cfg('MH_CONTEXT') == 'STORE') {
            $GLOBALS['post'] = &get_post($post);
        } else {
            if (strtolower($_SERVER["REQUEST_METHOD"]) == 'post') {
                $_GET = $_REQUEST;
            }
        }
    }
    */
}

mh_define('MH_PLATFORM_OSC', false);
mh_define('MH_PLATFORM_OSC_23', false);
mh_define('MH_PLATFORM_OSCMAX_25', false);
mh_define('MH_PLATFORM_TRUELOADED', false);
mh_define('MH_PLATFORM_GAMBIO', false);
mh_define('MH_PLATFORM_XTCM', false);
mh_define('MH_PLATFORM_XTC_SEO', false);
mh_define('MH_PLATFORM_XTC_ECB', false);
