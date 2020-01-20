<?php
/**
 * document_general header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 730 2020-01-17 10:49:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_DOCUMENT_GENERAL_INFO');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_DOCUMENT_GENERAL_INFO');
