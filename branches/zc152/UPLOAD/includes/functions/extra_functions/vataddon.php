<?php
/**
 * @package functions
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: vataddon.php 344 2012-11-18 18:49:16Z webchills $
 */

function vatAddOn($product_check){
    
    if(DISPLAY_VATADDON_WHERE == '0'){
        return '';
    }
    $s = explode('|', DISPLAY_VATADDON_WHERE);
    $ok = in_array($GLOBALS['current_page'], $s);
    if($ok || $s[0] == 'ALL'){
        $vat = zen_get_tax_rate($product_check->fields['products_tax_class_id']) . '% ';
        $ret = sprintf(VAT_SHOW_TEXT, $vat);
        return $ret;
    } else {
        return '';
    }
}
?>
