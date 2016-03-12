<?php
/**
 * @package paket tracking 
 * @copyright Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: track_orders.php 2015-01-23 08:19:14 webchills $
*/
// test if track orders sidebox should show
  $show_track_orders= false;

if ($show_track_orders = true) {
  if ($_SESSION['customer_id']) {
// retrieve the last x products purchased
  $tracking_orders_history_query = "select o.orders_id, o.date_purchased
                   from " . TABLE_ORDERS . " o
                   where o.customers_id = '" . (int)$_SESSION['customer_id'] . "'
                   order by o.date_purchased desc
                   limit " . MAX_DISPLAY_PRODUCTS_IN_TRACK_ORDERS_BOX;

    $tracking_orders_history = $db->Execute($tracking_orders_history_query);

    if ($tracking_orders_history->RecordCount() > 0) {
      $orders_ids = '';
      while (!$orders_history->EOF) {
        $orders_ids .= (int)$tracking_orders_history->fields['orders_id'] . ',';
        $tracking_orders_history->MoveNext();
      }
      $orders_ids = substr($orders_ids, 0, -1);
      $rows=0;
      $tracking_customer_orders_string = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
      $tracking_products_history_query = "select orders_id, date_purchased
                         from " . TABLE_ORDERS . "
                         where orders_id in (" . $orders_ids . ")
                         order by date_purchased desc";

      $tracking_products_history = $db->Execute($tracking_products_history_query);

      while (!$products_history->EOF) {
        $rows++;
        $tracking_customer_orders[$rows]['id'] = $tracking_products_history->fields['orders_id'];
        $tracking_customer_orders[$rows]['date'] = $tracking_products_history->fields['date_purchased'];
        $tracking_products_history->MoveNext();
      }
      $tracking_customer_orders_string .= '</table>';
    }
  }
      require($template->get_template_dir('tpl_track_orders.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_track_orders.php');
      $title =  BOX_HEADING_TRACK_ORDERS;
      $title_link = false;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
} // $show_track_orders