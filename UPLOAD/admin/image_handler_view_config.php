<?php
/**
 * @package Image Handler 5.3.0
 * @copyright Copyright 2005-2006 Tim Kroeger (original author)
 * @copyright Copyright 2018-2022 lat 9 - Vinos de Frutas Tropicales
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: image_handler_view_config.php 2022-09-06 08:59:51Z webchills $
 */
require 'includes/application_top.php';

// -----
// Load, and create an instance of, the "helper" class for the Image Handler.  This class
// consolidates the various functions previously present in this module.
//
// Note: The $ihConf array is loaded as part of /admin/includes/functions/extra_functions/functions_bmz_image_handler.php.
//
require DIR_WS_CLASSES . 'ImageHandlerAdmin.php';
$ih_admin = new ImageHandlerAdmin();
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
    <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
</head>
<body>
<?php
require DIR_WS_INCLUDES . 'header.php';

// -----
// Set up arrays to display the information in the table below.
//
define('CHECK_NONE', 0);
define('CHECK_INTEGER', 1);
define('CHECK_QUALITY', 2);
define('CHECK_BACKGROUND', 3);
define('CHECK_BOOLEAN', 4);
define('CHECK_ARRAY', 5);
define('CHECK_FILETYPE', 6);
define('CHECK_DIR', 7);
define('CHECK_SIZE', 8);
$config_values = [
    'configuration' => [
        'IH_VERSION' => ['check' => CHECK_NONE],
        'IH_RESIZE' => ['check' => CHECK_NONE],
        'WATERMARK_GRAVITY' => ['check' => CHECK_NONE],
        'IH_CACHE_NAMING' => ['check' => CHECK_NONE],
        'SMALL_IMAGE_WIDTH' => ['check' => CHECK_INTEGER],
        'SMALL_IMAGE_HEIGHT' => ['check' => CHECK_INTEGER],
        'SMALL_IMAGE_FILETYPE' => ['check' => CHECK_FILETYPE],
        'SMALL_IMAGE_BACKGROUND' => ['check' => CHECK_BACKGROUND],
        'SMALL_IMAGE_QUALITY' => ['check' => CHECK_QUALITY],
        'WATERMARK_SMALL_IMAGES' => ['check' => CHECK_NONE],
        'MEDIUM_IMAGE_WIDTH' => ['check' => CHECK_INTEGER],
        'MEDIUM_IMAGE_HEIGHT' => ['check' => CHECK_INTEGER],
        'IMAGE_SUFFIX_MEDIUM' => ['check' => CHECK_NONE],
        'MEDIUM_IMAGE_FILETYPE' => ['check' => CHECK_FILETYPE],
        'MEDIUM_IMAGE_BACKGROUND' => ['check' => CHECK_BACKGROUND],
        'MEDIUM_IMAGE_QUALITY' => ['check' => CHECK_QUALITY],
        'WATERMARK_MEDIUM_IMAGES' => ['check' => CHECK_NONE],
        'LARGE_IMAGE_MAX_WIDTH' => ['check' => CHECK_INTEGER],
        'LARGE_IMAGE_MAX_HEIGHT' => ['check' => CHECK_INTEGER],
        'IMAGE_SUFFIX_LARGE' => ['check' => CHECK_NONE],
        'LARGE_IMAGE_FILETYPE' => ['check' => CHECK_FILETYPE],
        'LARGE_IMAGE_BACKGROUND' => ['check' => CHECK_BACKGROUND],
        'LARGE_IMAGE_QUALITY' => ['check' => CHECK_QUALITY],
        'WATERMARK_LARGE_IMAGES' => ['check' => CHECK_NONE],
    ],
    'ihConf' => [
        'noresize_key' => ['check' => CHECK_NONE],
        'noresize_dirs' => ['check' => CHECK_ARRAY],
        'trans_threshold' => ['check' => CHECK_NONE],
        'im_convert' => ['check' => CHECK_NONE],
        'gdlib' => ['check' => CHECK_INTEGER],
        'resize' => ['check' => CHECK_BOOLEAN],
        'default' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'bg' => ['check' => CHECK_BACKGROUND],
                'quality' => ['check' => CHECK_QUALITY],
            ],
        ],
        'dir' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'docroot' => ['check' => CHECK_DIR],
                'images' => ['check' => CHECK_DIR],
                'admin' => ['check' => CHECK_DIR],
            ],
        ],
        'small' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'width' => ['check' => CHECK_INTEGER],
                'height' => ['check' => CHECK_INTEGER],
                'filetype' => ['check' => CHECK_FILETYPE],
                'bg' => ['check' => CHECK_BACKGROUND],
                'quality' => ['check' => CHECK_QUALITY],
                'watermark' => ['check' => CHECK_BOOLEAN],
            ],
        ],
        'medium' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'prefix' => ['check' => CHECK_NONE],
                'suffix' => ['check' => CHECK_NONE],
                'width' => ['check' => CHECK_INTEGER],
                'height' => ['check' => CHECK_INTEGER],
                'filetype' => ['check' => CHECK_FILETYPE],
                'bg' => ['check' => CHECK_BACKGROUND],
                'quality' => ['check' => CHECK_QUALITY],
                'watermark' => ['check' => CHECK_BOOLEAN],
            ],
        ],
        'large' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'prefix' => ['check' => CHECK_NONE],
                'suffix' => ['check' => CHECK_NONE],
                'width' => ['check' => CHECK_INTEGER],
                'height' => ['check' => CHECK_INTEGER],
                'filetype' => ['check' => CHECK_FILETYPE],
                'bg' => ['check' => CHECK_BACKGROUND],
                'quality' => ['check' => CHECK_QUALITY],
                'watermark' => ['check' => CHECK_BOOLEAN],
            ],
        ],
        'watermark' => [
            'check' => CHECK_ARRAY,
            'fields' => [
                'gravity' => ['check' => CHECK_NONE],
            ],
        ],
    ]
];
?>
    <div class="container-fluid">
        <h1><?php echo HEADING_TITLE; ?></h1>
        <p><?php echo sprintf(INSTRUCTIONS, DIR_FS_CATALOG . 'includes/extra_configures/bmx_image_handler_conf.php', DIR_FS_CATALOG . 'includes/functions/extra_functions/functions_bmz_image_handler.php'); ?></p>
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <th colspan="3" class="text-center"><?php echo sprintf(CONFIG_HEADING, zen_href_link(FILENAME_CONFIGURATION, 'gID=4')); ?></th>
                </tr>
<?php
foreach ($config_values['configuration'] as $config_name => $config_options) {
    $entry_error = false;
    $config_link = $entry_title = $entry_message = '';
    if (!defined($config_name)) {
        $entry_value = 'not defined';
        $entry_error = true;
    } else {
        $entry_value = constant($config_name);
        $info = $db->Execute(
            "SELECT configuration_id, configuration_title
               FROM " . TABLE_CONFIGURATION . "
              WHERE configuration_key = '$config_name'
              LIMIT 1"
        );
        if ($info->EOF) {
            $entry_title = 'not found';
            $entry_error = true;
            $config_link = $config_name;
        } else {
            $entry_title = $info->fields['configuration_title'];
            $config_link = '<a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=4&cID=' . $info->fields['configuration_id'] . '&action=edit') . '">' . $config_name . '</a>';
        }
        $entry_message = '&nbsp;';
        switch ($config_options['check']) {
            // -----
            // Check that the value is a positive integer (no decimal points)
            //
            case CHECK_INTEGER:
                $entry_error = $ih_admin->validatePositiveInteger($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_NOT_INTEGER;
                }
                break;
            case CHECK_QUALITY:
                $entry_error = $ih_admin->validateQuality($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_QUALITY;
                }
                break;
            case CHECK_BACKGROUND:
                $entry_error = $ih_admin->validateBackground($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_BACKGROUND;
                }
                break;
            case CHECK_FILETYPE:
                $entry_error = $ih_admin->validateFiletype($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_FILETYPE;
                }
                break;
            default:
                break;
        }
    }
?>
                <tr<?php echo ($entry_error) ? ' class="danger"' : ''; ?>>
                    <td><?php echo $config_link; ?></td>
                    <td><?php echo $entry_title; ?></td>
                    <td><?php echo $entry_value; ?> <span><?php echo $entry_message; ?></span></td>
                </tr>
<?php
}
?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <tr>
                    <th colspan="2" class="text-center">Values from the $ihConf array</th>
                </tr>
<?php
foreach ($config_values['ihConf'] as $key => $values) {
    $entry_error = false;
    $single_entry = true;
    if (!isset($ihConf[$key])) {
        $entry_error = true;
        $entry_value = 'not set';
        $entry_message = 'Missing key value from $ihConf array.';
    } else {
        $entry_value = $ihConf[$key];
        $entry_message = '&nbsp;';
        switch ($values['check']) {
            // -----
            // Check that the value is a positive integer (no decimal points)
            //
            case CHECK_INTEGER:
                $entry_error = $ih_admin->validatePositiveInteger($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_NOT_INTEGER;
                }
                break;
            case CHECK_QUALITY:
                $entry_error = $ih_admin->validateQuality($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_QUALITY;
                }
                break;
            case CHECK_BACKGROUND:
                $entry_error = $ih_admin->validateBackground($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_BACKGROUND;
                }
                break;
            case CHECK_BOOLEAN:
                $entry_error = $ih_admin->validateBoolean($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_NOT_BOOLEAN;
                }
                break;
            case CHECK_FILETYPE:
                $entry_error = $ih_admin->validateFiletype($entry_value);
                if ($entry_error) {
                    $entry_message = ERROR_INVALID_FILETYPE;
                }
                break;
            case CHECK_ARRAY:
                if (!is_array($entry_value)) {
                    $entry_error = true;
                    $entry_message = ERROR_NOT_ARRAY;
                } else {
                    $single_entry = !isset($values['fields']);
                }
                $entry_value = json_encode($entry_value);
                break;
            default:
                break;
        }
    }

    $entry_value = ($entry_value === true) ? 'true' : (($entry_value === false) ? 'false' : $entry_value);
    if ($entry_message !== '&nbsp;') {
        $entry_message = "($entry_message)";
    }
?>
                <tr<?php echo ($entry_error) ? ' class="danger"' : ''; ?>>
                    <td<?php echo ($single_entry === true) ? '' : ' colspan="2" class="text-center info"'?>><?php echo '$ihConf[' . $key . ']'; ?></td>
<?php
    if ($single_entry === true) {
?>
                    <td><?php echo $entry_value; ?> <span><?php echo $entry_message; ?></span></td>
                </tr>
<?php
    }

    if (!$single_entry && isset($values['fields'])) {
        foreach ($values['fields'] as $subkey => $subvalues) {
            $subkey_value = $ihConf[$key][$subkey];
            $entry_message = '&nbsp;';
            switch ($subvalues['check']) {
                // -----
                // Check that the value is a positive integer (no decimal points)
                //
                case CHECK_INTEGER:
                    $entry_error = $ih_admin->validatePositiveInteger($subkey_value);
                    if ($entry_error) {
                        $entry_message = ERROR_NOT_INTEGER;
                    }
                    break;
                case CHECK_QUALITY:
                    $entry_error = $ih_admin->validateQuality($subkey_value);
                    if ($entry_error) {
                        $entry_message = ERROR_INVALID_QUALITY;
                    }
                    break;
                case CHECK_BACKGROUND:
                    $entry_error = $ih_admin->validateBackground($subkey_value);
                    if ($entry_error) {
                        $entry_message = ERROR_INVALID_BACKGROUND;
                    }
                    break;
                case CHECK_BOOLEAN:
                    $entry_error = $ih_admin->validateBoolean($subkey_value);
                    if ($entry_error) {
                        $entry_message = ERROR_NOT_BOOLEAN;
                    }
                    break;
                case CHECK_FILETYPE:
                    $entry_error = $ih_admin->validateFiletype($subkey_value);
                    if ($entry_error) {
                        $entry_message = ERROR_INVALID_FILETYPE;
                    }
                    break;
                default:
                    break;
            }
            if ($entry_message !== '&nbsp;') {
                $entry_message = "($entry_message)";
            }
?>
                <tr<?php echo ($entry_error) ? ' class="danger"' : ''; ?>>
                    <td><?php echo $subkey; ?></td>
                    <td><?php echo ($subkey_value === true) ? 'true' : (($subkey_value === false) ? 'false' : $subkey_value); ?> <span><?php echo $entry_message; ?></span></td>
                </tr>
<?php
        }
    }
}
?>
            </table>
        </div>
    </div>
    <?php require DIR_WS_INCLUDES . 'footer.php'; ?>
</body>
</html>
<?php
require DIR_WS_INCLUDES . 'application_bottom.php';
