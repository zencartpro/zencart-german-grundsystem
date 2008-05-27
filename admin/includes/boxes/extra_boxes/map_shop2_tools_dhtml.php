<?php
/**
 * @package map_shop
 * @desc map_shop generates google_map entries at http://shops.zen-cart.at
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com> <http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id$
 */
?>
<?php

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$options = array( array('box' => MAP_SHOP2_MENU, 'page' => 'map_shop2/'.MAP_SHOP2_FILENAME),
                );

foreach ($options as $key => $value) {
    if (!function_exists('page_allowed')) {
        $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
    }
    if (function_exists('page_allowed') && page_allowed($value['page'])=='true') {
        $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
    }
    
    
}
