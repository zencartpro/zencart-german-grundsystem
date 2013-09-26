<?php
/**
 * @package admin
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_merkmale_functions.php 2012-06-13 19:53:47 webchills $
*/

   function zen_get_products_merkmale($product_id, $language = '') {
    global $db;

    if (empty($language)) $language = $_SESSION['languages_id'];

    $product_query = "select products_merkmale
                      from " . TABLE_PRODUCTS_DESCRIPTION . "
                      where products_id = '" . (int)$product_id . "'
                      and language_id = '" . (int)$language . "'";

    $product = $db->Execute($product_query);

    return $product->fields['products_merkmale'];
  }