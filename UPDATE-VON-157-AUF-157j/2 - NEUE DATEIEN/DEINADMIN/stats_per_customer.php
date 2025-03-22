<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2021 ThatSoftwareGuy
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: stats_per_customer.php 2024-11-03 20:04:16Z webchills $
 */
require('includes/application_top.php');

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
      <?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
  </head>
  <body>
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->
    <div class="container-fluid">
      <!-- body //-->

      <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php 
       $query = $db->Execute("SELECT c.customers_firstname, c.customers_lastname  
                                    FROM " . TABLE_CUSTOMERS . " c 
                                    WHERE c.customers_id = " . (int)$_GET['cid']);
?>
       <h2><?php echo $query->fields['customers_firstname'] . " " . $query->fields['customers_lastname']; ?></h2>

      <table class="table table-hover">
        <thead>
          <tr class="dataTableHeadingRow">
            <th class="dataTableHeadingContent right"><?php echo TABLE_HEADING_YEAR; ?></th>
            <th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_TOTAL_PURCHASED; ?>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $customers_query_raw = "SELECT c.customers_id, c.customers_firstname, c.customers_lastname, YEAR(date_purchased) as year, 
                                           SUM(op.products_quantity * op.final_price) + SUM(op.onetime_charges) AS ordersum
                                    FROM " . TABLE_CUSTOMERS . " c,
                                         " . TABLE_ORDERS_PRODUCTS . " op,
                                         " . TABLE_ORDERS . " o
                                    WHERE c.customers_id = o.customers_id
                                    AND c.customers_id = " . (int)$_GET['cid']. " 
                                    AND o.orders_id = op.orders_id
                                    GROUP BY year ORDER BY year DESC "; 
            $customers = $db->Execute($customers_query_raw);
            $total = 0;
            foreach ($customers as $customer) { ?>
<?php         $total += $customer['ordersum']; ?>
            <tr class="dataTableRow">
              <td class="dataTableContent text-right"><?php echo $customer['year']; ?>&nbsp;&nbsp;</td>
              <td class="dataTableContent text-right"><?php echo $currencies->format($customer['ordersum']); ?></td>
            </tr>
            <?php } ?>
            <tr class="dataTableRow">
              <td class="dataTableContent text-right"><?php echo TOTAL_SALES; ?></td>
              <td class="dataTableContent text-right"><?php echo $currencies->format($total); ?></td>
            </tr>

        </tbody>
      </table>
      <!-- body_text_eof //-->
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
