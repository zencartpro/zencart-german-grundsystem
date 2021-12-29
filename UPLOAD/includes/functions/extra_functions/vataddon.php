<?php
/**
 * @package functions
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: vataddon.php 2021-12-28 09:49:16Z webchills $
 */

function vatAddOn($product_check){
    
    if(DISPLAY_VATADDON_WHERE == '0'){
        return '';
    }
    $s = explode('|', DISPLAY_VATADDON_WHERE);
    $ok = in_array($GLOBALS['current_page'], $s);
    if($ok || $s[0] == 'ALL'){
        $vat = zen_get_tax_rate($product_check->fields['products_tax_class_id']) . '% ';
        if ($product_check->fields['product_is_always_free_shipping'] == 1) {
        $ret = sprintf(VAT_SHOW_TEXT_VERSANDKOSTENFREI, $vat);
        } else {
            $ret = sprintf(VAT_SHOW_TEXT, $vat);
        }
        return $ret;
    } else {
        return '';
    }
}
