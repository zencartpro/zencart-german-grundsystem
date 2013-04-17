<?php
/**
 * @package admin
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: reg_stock_by_attributes.php 2012-08-21 16:02:14Z webchills $
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('stock_by_attributes')) {
        // Add SBA 1.5 to webshop menu
        zen_register_admin_page('stock_by_attributes', 'BOX_CATALOG_PRODUCTS_WITH_ATTRIBUTES_STOCK','FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK', '', 'catalog', 'Y', 100);
    }
}
?>