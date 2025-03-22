<?php
/**
 * Time out page
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 2023-10-28 15:49:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_LOGIN_TIMEOUT');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));


$breadcrumb->add(NAVBAR_TITLE);
// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_LOGIN_TIMEOUT');
