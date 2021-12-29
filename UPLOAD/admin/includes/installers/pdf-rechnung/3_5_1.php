<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: 3_5_1.php 2018-06-18 18:19:17Z webchills $
 */

$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '3.5.1' WHERE configuration_key = 'RL_INVOICE3_MODUL_VERSION' LIMIT 1;");
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "pdf/rechnung_de.pdf' WHERE configuration_key = 'RL_INVOICE3_PDF_BACKGROUND' LIMIT 1;");
$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . DIR_FS_CATALOG . "pdf/|1' WHERE configuration_key = 'RL_INVOICE3_PDF_PATH' LIMIT 1;");