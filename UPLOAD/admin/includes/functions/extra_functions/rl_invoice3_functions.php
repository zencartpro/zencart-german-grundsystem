<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: rl_invoice3_functions.php 2016-06-19 07:19:17Z webchills $
 */

if (!function_exists('zen_cfg_read_only')) {
  function zen_cfg_read_only($text, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    return $text . zen_draw_hidden_field($name, $text);
  }
}
function isMultiLingual() {
        global $db;
        $sql = "SHOW  TABLES  LIKE  '" . TABLE_CONFIGURATION_LANGUAGE . "'";
        $res = $db->Execute($sql);
        if ($res->RecordCount() == 0) {
            return false;
        } else {
            return true;
        }
    }