<?php
/*
 * This file is derived from order_history.php
 *
 ******************************************************************************
 * order_history sidebox - if enabled, shows customers' most recent orders    *
 *                                                                            *
 * @package templateSystem                                                    *
 * @copyright Copyright 2003-2005 Zen Cart Development Team                   *
 * @copyright Portions Copyright 2003 osCommerce                              *
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0   *
 * @version $Id: order_history.php 2718 2005-12-28 06:42:39Z drbyte $         *
 ******************************************************************************
 * File ID: track_orders.php v2.2 by colosports
 */
// test if track orders sidebox should show
  $show_track_orders= false;

if ($show_track_orders = true) {
  if ($_SESSION['customer_id']) {
// retreive the last x products purchased
  $orders_history_query = "select o.orders_id, o.date_purchased
                   from " . TABLE_ORDERS . " o
                   where o.customers_id = '" . (int)$_SESSION['customer_id'] . "'
                   order by o.date_purchased desc
                   limit " . MAX_DISPLAY_PRODUCTS_IN_TRACK_ORDERS_BOX;

    $orders_history = $db->Execute($orders_history_query);

    if ($orders_history->RecordCount() > 0) {
      $orders_ids = '';
      while (!$orders_history->EOF) {
        $orders_ids .= (int)$orders_history->fields['orders_id'] . ',';
        $orders_history->MoveNext();
      }
      $orders_ids = substr($orders_ids, 0, -1);
      $rows=0;
      $customer_orders_string = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
      $products_history_query = "select orders_id, date_purchased
                         from " . TABLE_ORDERS . "
                         where orders_id in (" . $orders_ids . ")
                         order by date_purchased desc";

      $products_history = $db->Execute($products_history_query);

      while (!$products_history->EOF) {
        $rows++;
        $customer_orders[$rows]['id'] = $products_history->fields['orders_id'];
        $customer_orders[$rows]['date'] = $products_history->fields['date_purchased'];
        $products_history->MoveNext();
      }
      $customer_orders_string .= '</table>';
    }
  }
      require($template->get_template_dir('tpl_track_orders.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_track_orders.php');
      $title =  BOX_HEADING_TRACK_ORDERS;
      $title_link = false;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
} // $show_track_orders
?>