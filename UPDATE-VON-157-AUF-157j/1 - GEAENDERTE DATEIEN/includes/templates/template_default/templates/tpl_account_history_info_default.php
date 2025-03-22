<?php
/**
 * Displays information related to a single specific order, both for checkout_success and in account_history_info
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_account_history_info_default.php 2023-10-26 16:15:05Z webchills $
 */
?>
<div class="centerColumn" id="accountHistInfo">

<div class="forward"><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></div>
<br class="clearBoth">

<?php if ($current_page != FILENAME_CHECKOUT_SUCCESS) { ?>
<h2 id="orderHistoryDetailedOrder"><?php echo HEADING_TITLE . ORDER_HEADING_DIVIDER . sprintf(HEADING_ORDER_NUMBER, zen_output_string_protected($_GET['order_id'])); ?></h2>
<?php } ?>

<table id="orderHistoryHeading">
    <tr class="tableHeading">
        <th scope="col" id="myAccountQuantity"><?php echo HEADING_QUANTITY; ?></th>
        <th scope="col" id="myAccountProducts"><?php echo HEADING_PRODUCTS; ?></th>
<?php
  if (isset($order->info['tax_groups']) && count($order->info['tax_groups']) > 1) {
?>
        <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
<?php
 }
?>
        <th scope="col" id="myAccountTotal"><?php echo HEADING_TOTAL; ?></th>
    </tr>
<?php
  foreach($order->products as $op) {
  ?>
    <tr>
        <td class="accountQuantityDisplay"><?php echo $op['qty'] . CART_QUANTITY_SUFFIX; ?></td>
        <td class="accountProductDisplay">
<a href="<?php echo zen_href_link(zen_get_info_page($op['id']), 'products_id=' . $op['id']); ?>"><?php echo $op['name']; ?></a>
<?php
    if (isset($op['attributes']) && !empty($op['attributes'])) {
      echo '<ul class="orderAttribsList">';
      foreach($op['attributes'] as $attr) {
        echo '<li>' . $attr['option'] . TEXT_OPTION_DIVIDER . nl2br(zen_output_string_protected($attr['value'])) . '</li>';
      }
        echo '</ul>';
    }
?>
        </td>
<?php
    if (isset($order->info['tax_groups']) && count($order->info['tax_groups']) > 1) {
?>
        <td class="accountTaxDisplay"><?php echo zen_display_tax_value($op['tax']) . '%' ?></td>
<?php
    }
?>
        <td class="accountTotalDisplay">
        <?php
         $ppe = zen_round(zen_add_tax($op['final_price'], $op['tax']), $currencies->get_decimal_places($order->info['currency']));
         $ppt = $ppe * $op['qty'];
        //        echo $currencies->format(zen_add_tax($op['final_price'], $op['tax']) * $op['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($op['onetime_charges'] != 0 ? '<br>' . $currencies->format(zen_add_tax($op['onetime_charges'], $op['tax']), true, $order->info['currency'], $order->info['currency_value']) : '')
        echo $currencies->format($ppt, true, $order->info['currency'], $order->info['currency_value']) . ($op['onetime_charges'] != 0 ? '<br>' . $currencies->format(zen_add_tax($op['onetime_charges'], $op['tax']), true, $order->info['currency'], $order->info['currency_value']) : '');
        ?></td>
    </tr>
<?php
  }
?>
</table>
<hr>
<div id="orderTotals">
<?php
  foreach($order->totals as $ot) {
?>
     <div class="amount larger forward"><?php echo $ot['text'] ?></div>
     <div class="lineTitle larger forward"><?php echo $ot['title'] ?></div>
<br class="clearBoth">
<?php
  }
?>

</div>

<?php
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>


<?php
/**
 * Used to loop thru and display order status information
 */
if (!empty($order->statuses)) {
?>

<h2 id="orderHistoryStatus"><?php echo HEADING_ORDER_HISTORY; ?></h2>
<table id="myAccountOrdersStatus">
    <tr class="tableHeading">
        <th scope="col" id="myAccountStatusDate"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
        <th scope="col" id="myAccountStatus"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
        <th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       </tr>
<?php
  // -----
  // The *first* comment, made by the customer, is 'protected' from using HTML taga; all others are
  // made by the admin or a 'known' entity and HTML is allowed.
  //
  $protected = true;
  foreach ($order->statuses as $statuses) {
?>
    <tr>
        <td><?php echo zen_date_short($statuses['date_added']); ?></td>
        <td><?php echo $statuses['orders_status_name']; ?></td>
        <td>
<?php
    if (!empty($statuses['comments'])) {
       echo nl2br(zen_output_string($statuses['comments'], false, $protected));
    }
?>
       </td>
     </tr>
<?php
    $protected = false;
  }
?>
</table>
<?php } ?>

<hr>
<div id="myAccountShipInfo" class="floatingBox back">
<?php
  if (!empty($order->delivery['format_id'])) {
?>
<h3><?php echo HEADING_DELIVERY_ADDRESS; ?></h3>
<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></address>
<?php
  }
?>

<?php
    if (!empty($order->info['shipping_method'])) {
?>
<h4><?php echo HEADING_SHIPPING_METHOD; ?></h4>
<div><?php echo $order->info['shipping_method']; ?></div>
<?php } else { ?>
<div><?php echo TEXT_MISSING_SHIPPING_INFO; ?></div>
<?php
    }
?>
</div>

<div id="myAccountPaymentInfo" class="floatingBox forward">
<h3><?php echo HEADING_BILLING_ADDRESS; ?></h3>
<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></address>

<h4><?php echo HEADING_PAYMENT_METHOD; ?></h4>
<div><?php echo $order->info['payment_method']; ?></div>
</div>
<br class="clearBoth">

<?php if(RL_INVOICE3_STATUS=='true') {?>
<?php    
    require_once(DIR_WS_INCLUDES . 'classes/class.rl_invoice3.php');
    $pdfT = new rl_invoice3($_GET['order_id'], $paper['orientation'], $paper['unit'], $paper['format']);
    // use $pdfT->getPDFAttachments('NO') if only the invoice should be shown
    $a = $pdfT->getPDFAttachments('ALL');
    $tmp1 = '<div class="rl-invoice3-hlink"><span class="rl-invoice3-hlink-text">'. RL_INVOICE3_INVLINK_TEXT . '</span>';
    $tmp = '';
    foreach ($a as $key => $v) {
        if(isset($v['fn'])){
            $pa = zen_href_link('rl_invoice3', '', 'SSL') . '&fn=' . $v['fn'] . '&order=' . $_GET['order_id'];
            $tmp .=  '| <a href="' . $pa . '">'. $v['name'] . '</a>';
        } else {
            $tmp .=  '| <a href="' . str_replace(DIR_FS_CATALOG, '', $v['file']) . '">'. $v['name'] . '</a>';
        }
    }
    $tmp .= '</div>';
    echo $tmp1 . substr($tmp, 1);
?>
<?php } ?>

</div> 