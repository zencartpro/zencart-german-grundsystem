<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: it_recht_kanzlei_functions.php 2016-05-31 20:13:51Z webchills $
 */

if (!function_exists('zen_cfg_read_only')) {
  function zen_cfg_read_only($text, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    return $text . zen_draw_hidden_field($name, $text);
  }
}

function generate_new_token() {
global $db;
$db->Execute("UPDATE ".TABLE_CONFIGURATION." SET configuration_value = '0' WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN'");	
$db->Execute("UPDATE ".TABLE_CONFIGURATION." SET configuration_value = '".md5(time() . rand(0,99999))."' WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN'");
}