<?php
/**
 * Side Box Template
 * 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_order_history.php 2022-12-08 20:50:58Z webchills $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
$content .= '<ul class="list-links orderHistList">' . "\n" ;

foreach ($customer_orders as $row) {
  $content .= '
<li>
<a href="' . zen_href_link(zen_get_info_page($row['id']), 'products_id=' . $row['id']) . '">' . $row['name'] . '</a>
<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=cust_order&pid=' . $row['id']) . '"><i class="fa-solid fa-cart-arrow-down"></i></a>
</li>
';

  }
$content .= '</ul>' . "\n" ;
$content .= '</div>';
