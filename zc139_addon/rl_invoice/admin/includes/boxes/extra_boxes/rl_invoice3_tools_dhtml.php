<?php
/**
 * @package map_shop
 * @desc map_shop generates google_map entries at http://shops.zen-cart.at
 * @copyright Copyright 2006-2007 rainer langheiter
 * @author rainer langheiter <zen-cart@langheiter.com> <http://edv.langheiter.com/zencart/>
 * @license http://www.gnu.org/copyleft/gpl.html     
 * @version $Id: rl_invoice3_tools_dhtml.php 470 2009-01-08 08:58:16Z hugo13 $
 */
?>
<?php

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$options = array( array('box' => RL_INVOICE3_MENU, 'page' =>  RL_INVOICE3_ADMIN_FILENAME),
                );

foreach ($options as $key => $value) {
    if (!function_exists('page_allowed')) {
        $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
    }
    if (function_exists('page_allowed') && page_allowed($value['page'])=='true') {
        $za_contents[] = array('text' => $value['box'], 'link' => zen_href_link($value['page'], '', 'NONSSL'));
    }
    
    
}
