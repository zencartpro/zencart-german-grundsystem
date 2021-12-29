<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: display_logs_name.php 2019-06-16 09:49:16Z webchills $
 */
define('BOX_TOOLS_DISPLAY_LOGS', 'Logfiles anzeigen'); 
// -----
// This message is displayed in the admin header if any debug-logs are present.  When translating this message, be sure to keep the following "sprintf" tokens:
//
// %1$u ... Identifies the number of files present
// %2$s ... Contains the href to your admin's display-logs tool.
//
define ('DISPLAY_LOGS_MESSAGE_LOGS_PRESENT', '%1$u Debug Logfiles vorhanden, klicken Sie <a href="%2$s">hier</a> um sie anzuzeigen.');