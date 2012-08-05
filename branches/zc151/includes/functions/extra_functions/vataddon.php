<?php
// $Id: vataddon.php 343 2008-06-28 12:11:52Z hugo13 $
// samples

function vatAddOn($product_check){
    if(!defined(ADD_VATADDON)){
        define('ADD_VATADDON', 'ALL');
    }
    if(ADD_VATADDON == 'NONE'){
        return '';
    }
    $s = explode('|', ADD_VATADDON);
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
