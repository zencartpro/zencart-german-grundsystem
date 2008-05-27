<?php
// $Id$
// samples
#define('ADD_VATADDON', 'NONE');
#define('ADD_VATADDON', 'ALL');
#define('ADD_VATADDON', 'product_info|products_new'); // only display at productDetail & new Products

define('AAA', '<br/><div class="taxAddon">inkl. %s MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></div>');

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
        $ret = '<br/><div class="taxAddon">inkl. ' . $vat . 'MwSt.<br/> zzgl. <a href="' . zen_href_link(FILENAME_SHIPPING) . '">Versandkosten</a></div>';
        $ret = sprintf(AAA, $vat);
        return $ret;
    } else {
        return '';
    }
}
?>
