<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The CCS-cart team     s                           |
// |                                                                      |
// | http://www.coors.de                                                  |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: functions_base_unit.php 2006-05-18 12:19:31Z joco $

////
// computes products_price + option groups lowest attributes price of each group when on
  function zen_get_products_base_unit_price($products_id) {
    global $db, $currencies;

    $product_check = $db->Execute("select products_price, products_base_unit_price, products_base_unit from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");

    // is there a products_price to add to attributes
    $products_base_unit_price = $product_check->fields['products_base_unit_price'];

    // do not select display only attributes and attributes_price_base_included is true
    $product_att_query = $db->Execute("select options_id, price_prefix, options_values_price, attributes_display_only, attributes_price_base_included from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and attributes_display_only != '1' and attributes_price_base_included='1'". " order by options_id, price_prefix, options_values_price");

    $the_options_id= 'x';
    $the_base_price= 0;

    return $currencies->format(zen_round($products_base_unit_price, 3)).'/'.$product_check->fields['products_base_unit'];
  }
?>