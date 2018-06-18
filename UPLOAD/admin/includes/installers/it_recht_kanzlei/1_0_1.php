<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: 1_0_1.php 2018-06-18 18:59:51Z webchills $
 */

$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '1.0.1' WHERE configuration_key = 'IT_RECHT_KANZLEI_MODUL_VERSION' LIMIT 1;");
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '".md5(time() . rand(0,99999))."' WHERE configuration_key = 'IT_RECHT_KANZLEI_TOKEN' LIMIT 1;");