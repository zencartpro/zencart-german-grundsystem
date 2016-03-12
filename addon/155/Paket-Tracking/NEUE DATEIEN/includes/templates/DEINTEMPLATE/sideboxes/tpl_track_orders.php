<?php
/**
 * @package paket tracking 
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_track_orders.php 2015-12-09 17:05:14 webchills $
*/
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  
  
  if (sizeof($customer_orders)==0) {
     $content .= '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, '','SSL') . '">'.PT_SIDEBOX_TRACKYOURORDER.'</a>';
 }
else {
	  $content .= '<ul class="orderHistList">' . "\n" ;
  for ($i=1; $i<=sizeof($customer_orders); $i++) {

        $content .= '<li><a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $customer_orders[$i]['id'],'SSL') . '">' .PT_SIDEBOX_ORDERNUMBER.'' . $customer_orders[$i]['id'] . '</a></li>' . "\n" ;
  }
  $content .= '</ul>' . "\n" ;
}
  $content .= '</div>';
?>