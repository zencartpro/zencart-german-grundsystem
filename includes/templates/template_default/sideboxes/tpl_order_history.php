<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_order_history.php 729 2011-08-09 15:49:16Z hugo13 $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  $content .= '<ul class="orderHistList">' . "\n" ;

  for ($i=1; $i<=sizeof($customer_orders); $i++) {

        $content .= '<li><a href="' . zen_href_link(zen_get_info_page($customer_orders[$i]['id']), 'products_id=' . $customer_orders[$i]['id']) . '">' . $customer_orders[$i]['name'] . '</a>&nbsp;&nbsp;<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=cust_order&pid=' . $customer_orders[$i]['id']) . '">' . zen_image($template->get_template_dir(ICON_IMAGE_TINYCART, DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . ICON_IMAGE_TINYCART, ICON_TINYCART_ALT) . '</a></li>' . "\n" ;
  }
  $content .= '</ul>' . "\n" ;
  $content .= '</div>';
?>