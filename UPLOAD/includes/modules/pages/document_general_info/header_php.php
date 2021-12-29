<?php
/**
 * document_general header_php.php 
 *
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: header_php.php 732 2021-11-28 21:42:16Z webchills $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_DOCUMENT_GENERAL_INFO');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$product_info = zen_get_product_details($products_id_current = (!empty($_GET['products_id']) ? (int)$_GET['products_id'] : 0));

zen_product_set_header_response($products_id_current, $product_info);
// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_DOCUMENT_GENERAL_INFO');
