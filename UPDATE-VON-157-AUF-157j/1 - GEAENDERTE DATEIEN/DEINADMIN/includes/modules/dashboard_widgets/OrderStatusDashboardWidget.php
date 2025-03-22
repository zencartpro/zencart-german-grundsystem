<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: OrderStatusDashboardWidget.php 2023-10-30 14:56:29Z webchills $
 */

if (!zen_is_superuser() && !check_page(FILENAME_ORDERS, '')) return;

// to disable this module for everyone, uncomment the following "return" statement so the rest of this file is ignored
// return;

?>
<div class="panel panel-default reportBox">
    <div class="panel-heading header"><?php echo BOX_TITLE_ORDERS; ?> </div>
    <table class="table table-striped table-condensed">
        <?php
        $ordersStatus = zen_getOrdersStatuses();
        $orders_status = $ordersStatus['orders_statuses'];

        foreach ($orders_status as $row) {
          $orders_pending = $db->Execute("SELECT count(*) as count FROM " . TABLE_ORDERS . " WHERE orders_status = " . (int)$row['id'], false, true, 1800);
          ?>
        <tr>
          <td><a href="<?php echo zen_href_link(FILENAME_ORDERS, 'statusFilterSelect=' . $row['id']); ?>"><?php echo $row['text']; ?></a>:</td>
          <td class="text-right"> <?php echo $orders_pending->fields['count']; ?></td>
        </tr>
        <?php
      }
      ?>
    </table>
</div>
