<?php
/**
 * Down For Maintenance
 *
 * @package page
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2022-04-09 11:01:16Z webchills $
 */
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

if (DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF === 'true') {
    $flag_disable_right = true;
}
if (DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF === 'true') {
    $flag_disable_left = true;
}
if (DOWN_FOR_MAINTENANCE_FOOTER_OFF === 'true') {
    $flag_disable_footer = true;
}
if (DOWN_FOR_MAINTENANCE_HEADER_OFF === 'true') {
    $flag_disable_header = true;
}

$sql = "SELECT last_modified from " . TABLE_CONFIGURATION . "
          WHERE configuration_key = 'DOWN_FOR_MAINTENANCE'";
$maintenance_on_at_time = $db->Execute($sql);
define('TEXT_DATE_TIME', $maintenance_on_at_time->fields['last_modified']);

header("HTTP/1.1 503 Service Unavailable");
