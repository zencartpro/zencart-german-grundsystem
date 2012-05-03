<?php
/**
 * @copyright Copyright (c) 2008 Philip Clarke
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com    
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * bugfix number format 2012-05-03 webchills
 */

  require('includes/application_top.php');

@ini_set('display_errors', '1');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<style type="text/css">
/*	.caution{color: #ff6633; font-weight: bold}
	.warning{color: red; font-weight: bold}
	.ok{color: green; font-weight: bold}*/
	.tdr{text-align: right}
</style>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus(), init();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_ADMIN_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right">
<?php
//   echo zen_draw_form('payment_status', FILENAME_WORLDPAY, '', 'get') . HEADING_PAYMENT_STATUS . ' ' . zen_draw_pull_down_menu('payment_status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_IPNS)), $payment_statuses), $selected_status, 'onChange="this.form.submit();"') . zen_hide_session_id() . zen_draw_hidden_field('paypal_ipn_sort_order', $_GET['paypal_ipn_sort_order']) . '</form>';
?>
<?php
//   echo '&nbsp;&nbsp;&nbsp;' . TEXT_PAYPAL_IPN_SORT_ORDER_INFO . zen_draw_form('paypal_ipn_sort_order', FILENAME_WORLDPAY, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('paypal_ipn_sort_order', $paypal_ipn_sort_order_array, $reset_paypal_ipn_sort_order, 'onChange="this.form.submit();"') . zen_hide_session_id() . zen_draw_hidden_field('payment_status', $_GET['payment_status']) . '</form>';
?>
            </td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_NUMBER; ?> #</td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_WORLDPAY_ID; ?> #</td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_WORLDPAY_TRANSACTION; ?> #</td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TXN_TYPE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PAYMENT_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PAYMENT_AMOUNT; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  if (zen_not_null($selected_status)) {
    $ipn_search = "and p.payment_status = '" . zen_db_prepare_input($selected_status) . "'";
    switch ($selected_status) {
      case 'Pending':
      case 'Completed':
      default:
        $wpr_query_raw = "select p.order_id, p.paypal_ipn_id, p.txn_type, p.payment_type, p.payment_status, p.pending_reason, p.mc_currency, p.payer_status, p.mc_currency, p.date_added, p.mc_gross, p.first_name, p.last_name, p.payer_business_name, p.parent_txn_id, p.txn_id from " . TABLE_PAYPAL . " as p, " .TABLE_ORDERS . " as o  where o.orders_id = p.order_id " . $ipn_search . $order_by;
        break;
    }
  } else {
        $wpr_query_raw = "select p.order_id, p.paypal_ipn_id, p.txn_type, p.payment_type, p.payment_status, p.pending_reason, p.mc_currency, p.payer_status, p.mc_currency, p.date_added, p.mc_gross, p.first_name, p.last_name, p.payer_business_name, p.parent_txn_id, p.txn_id from " . TABLE_PAYPAL . " as p left join " .TABLE_ORDERS . " as o on o.orders_id = p.order_id" . $order_by;
  }

  $wpr_query_raw = "select * from `".TABLE_WORLDPAY_PAYMENTS."` ORDER BY id DESC";

// echo "<h1>$wpr_query_raw</h1>";
  
  $ipn_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, $wpr_query_raw, $ipn_query_numrows);
  $wp_response = $db->Execute($wpr_query_raw);  // AND HERE@S THE LOOP. QUERIES ABOVE RELATE TO SORTING OR SHOWING PENDING
  while (!$wp_response->EOF) {
    if ((!isset($_GET['wpId']) || (isset($_GET['wpId']) && ($_GET['wpId'] == $wp_response->fields['id']))) && !isset($wpInfo) ) {
      $wpInfo = new objectInfo($wp_response->fields); // controls display of box (reckon it should be a record count myself)
    }

	$wp_response->fields['REQUEST'] = unserialize(base64_decode($wp_response->fields['REQUEST']));

    if (isset($wpInfo) && is_object($wpInfo) && ($wp_response->fields['id'] == $wpInfo->id) && ( $wp_response->fields['REQUEST']['transStatus'] != 'C') ) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ORDERS, 'page=' . $_GET['page'] . '&wpId=' . $wpInfo->paypal_ipn_id . '&oID=' . $wpInfo->order_id . '&action=edit' . '&referer=ipn' . (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($paypal_ipn_sort_order) ? '&paypal_ipn_sort_order=' . $paypal_ipn_sort_order : '') ) . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_WORLDPAY, 'page=' . $_GET['page'] . '&wpId=' . $wp_response->fields['id'] . (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($paypal_ipn_sort_order) ? '&paypal_ipn_sort_order=' . $paypal_ipn_sort_order : '') ) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"> <?php echo $wp_response->fields['order_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $wp_response->fields['id']; ?> </td>
                <td class="dataTableContent"> <?php echo ($wp_response->fields['REQUEST']['transStatus']=='Y') ? $wp_response->fields['REQUEST']['transId'] : 'cancelled' ; ?> </td>
                <td class="dataTableContent"> <?php echo $wp_response->fields['REQUEST']['name']. '<br />'; ?>
                <?php echo $wp_response->fields['REQUEST']['countryString'] .'<br />'; ?>
                <td class="dataTableContent">
                <?php
                	if( intval($wp_response->fields['REQUEST']['testMode']) != 0 ){
						echo '<b>(test mode)</b> ';
                	}
                	if ( isset($wp_response->fields['REQUEST']['wafMerchMessage']) ) {
                		switch ($wp_response->fields['REQUEST']['wafMerchMessage']){
							case 'waf.caution':
                				echo TEXT_WAF_CAUTION_TABLE ;
                			break;
               				default:
                				echo TEXT_WAF_WARNING_TABLE ;
                		}
                	}else{
						echo ($wp_response->fields['REQUEST']['transStatus']=='Y') ? "None Issued" : "Transaction Cancelled";
                	}
                ?>
                </td>
                <td class="dataTableContent" align="right"><?php echo $wp_response->fields['REQUEST']['authCurrency'] . ' '.number_format((double)$wp_response->fields['REQUEST']['authAmount'], 2); ?></td>
                <td class="dataTableContent" align="right">
                	<?php
                	if (isset($wpInfo) && is_object($wpInfo) && ($wp_response->fields['id'] == $wpInfo->id) ) {
                	 echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif');
                	} else {
                	 echo '<a href="' . zen_href_link(FILENAME_WORLDPAY, 'page=' . $_GET['page'] . '&wpId=' . $wp_response->fields['id']) . (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($paypal_ipn_sort_order) ? '&paypal_ipn_sort_order=' . $paypal_ipn_sort_order : '') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                	} ?>&nbsp;
                </td>
              </tr>
<?php
    $wp_response->MoveNext();
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $ipn_split->display_count($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, $_GET['page'], "Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> IPN's)"); ?></td>
                    <td class="smallText" align="right"><?php echo $ipn_split->display_links($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($paypal_ipn_sort_order) ? '&paypal_ipn_sort_order=' . $paypal_ipn_sort_order : '')); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php

// this appears to be that bloddy box on the right hand side.


  $heading = array();
  $contents = array();
$action = '' ; // $_GET['action'];
  switch ($action) {
    case 'new':
      break;
    case 'edit':
      break;
    case 'delete':
      break;
    default:
      // Everything from here is for the box
      if (is_object($wpInfo)) {

      $ipn = $db->Execute("select * from " . TABLE_WORLDPAY_PAYMENTS . " where id = '" . $wpInfo->id . "'");
      $ipn_count = $ipn->RecordCount();
	  $ipn->fields['REQUEST'] = unserialize(base64_decode($ipn->fields['REQUEST']));
	  $ipn->fields['SESSION'] = unserialize(base64_decode($ipn->fields['SESSION']));

      switch ($ipn->fields['REQUEST']['transStatus']){
      	case 'Y':

		require_once(DIR_WS_CLASSES . 'order.php');

		$order = new order($wpInfo->order_id);
        $heading[] = array('text' => '<strong>' . TEXT_INFO_WP_RESPONSE_BEGIN.'#'.$wpInfo->id.', '.TEXT_INFO_WP_RESPONSE_END.'#'. $wpInfo->order_id . '</strong>');


        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('wpId', 'action')) . 'oID=' . $wpInfo->order_id .'&' . 'wpID=' . $wpInfo->id .'&action=edit' . '&referer=ipn') . '">' . zen_image_button('button_orders.gif', IMAGE_ORDERS) . '</a>');


        $contents[] = array('text' => '<br>' . TABLE_TEXT_WORLDPAY_TRANSACTION . ': <b>'. ( isset($ipn->fields['REQUEST']['transId'])  ? $ipn->fields['REQUEST']['transId'] : 'Not Sent' ) .'</b><br />'. TABLE_TEXT_WORLDPAY_TRANSACTION_END);
        $count = 1;

		if ( isset($ipn->fields['REQUEST']['wafMerchMessage']) ) {
			switch ($ipn->fields['REQUEST']['wafMerchMessage']){
				case 'waf.caution':
					$contents[] = array('text' => '<br />'.TABLE_TEXT_WAF . TEXT_WAF_CAUTION_TABLE . TABLE_TEXT_WAF_END);
				break;
				default:
					$contents[] = array('text' => '<br />'.TABLE_TEXT_WAF. TEXT_WAF_WARNING_TABLE .TABLE_TEXT_WAF_END );
			}
		}

		  $AVS = $ipn->fields['REQUEST']['AVS'];
		  
          $contents[] = array('text' => '<br /><table><tr><td colspan="2">'.TABLE_TEXT_AVS_CODE . ': '. ( trim($AVS) !='' ? $AVS : '<b>Not Sent.</b>' ) );

          $avs = array( 0=>TABLE_TEXT_AVS_CVV_CHECK, 1=>TABLE_TEXT_AVS_POSTCODE_CHECK, 2=>TABLE_TEXT_AVS_ADDRESS_CHECK, 3=>TABLE_TEXT_AVS_COUNTRY_CHECK ) ;

		  if(isset($ipn->fields['REQUEST']['AVS'])){
			foreach($avs as $key=>$val){
					$res = '';
					switch ($AVS[$key]){
						case 0:
							$res = 'not supported';
						break;
						case 1:
							$res = 'not checked';
						break;
						case 2:
							$res = 'matched';
						break;
						case 4:
							$res = 'not matched';
						break;
					}
				$contents[] = array('text' =>  '<tr><td>'.$val . ':</td><td>'. $res.'</td></tr>');
			}
		  }
			$contents[] = array('text' =>  '</table>');


          $totMatch = ((strtolower($ipn->fields['REQUEST']['countryString'])==strtolower($order->billing['country']))) ? TABLE_COUNTRY_MATCH : TABLE_COUNTRY_MISMATCH ;
          $contents[] = array('text' => '<br /><table>
	<tr><td>' . TABLE_TEXT_ORDER_COUNTRY . ':</td><td class="tdr">'.$order->billing['country'].'</td></tr>
	<tr><td>' . TABLE_TEXT_WP_RESPONSE_COUNTRY .':</td><td class="tdr">'.$ipn->fields['REQUEST']['countryString'].'</td></tr>
	<tr><td colspan="2" align="right">'. $totMatch .'</td></tr>
</table>
');

          $totMatch = (($ipn->fields['REQUEST']['authCurrency']==$order->info['currency']) && ($ipn->fields['REQUEST']['authAmount']==$order->info['total'])) ? TABLE_TOTALS_MATCH : TABLE_TOTALS_MISMATCH ;
          $contents[] = array('text' => '<br/><table>
	<tr><td>' . TABLE_TEXT_ORDER_TOTAL . ':</td><td class="tdr">'.$order->info['currency'].' '.$order->info['total'].'</td></tr>
	<tr><td>' . TABLE_TEXT_WP_RESPONSE_TOTAL .':</td><td class="tdr">'.$ipn->fields['REQUEST']['authCurrency'].' '.$ipn->fields['REQUEST']['authAmount'].'</td></tr>
	<tr><td colspan="2" align="right">'. $totMatch .'</td></tr>
</table>
');

          $totMatch = ((strtolower($ipn->fields['REQUEST']['address'])==strtolower($ipn->fields['REQUEST']['M_address']))) ? TABLE_ADDRESS_MATCH : TABLE_ADDRESS_MISMATCH ;
          $contents[] = array('text' => '<br /><table>
	<tr><td valign="top">' . TABLE_TEXT_ORDER_ADDRESS . ':</td><td class="tdr">'.nl2br($ipn->fields['REQUEST']['M_address']).'</td></tr>
	<tr><td valign="top">' . TABLE_TEXT_WP_RESPONSE_ADDRESS .':</td><td class="tdr">'.nl2br($ipn->fields['REQUEST']['address']).'</td></tr>
	<tr><td colspan="2" align="right">'. $totMatch .'</td></tr>
</table>
');

          $totMatch = ((strtolower($ipn->fields['REQUEST']['postcode'])==strtolower($ipn->fields['REQUEST']['M_postcode']))) ? TABLE_POSTCODE_MATCH : TABLE_POSTCODE_MISMATCH ;
          $contents[] = array('text' => '<br /><table>
	<tr><td valign="top">' . TABLE_TEXT_ORDER_POSTCODE . ':</td><td class="tdr">'.nl2br($ipn->fields['REQUEST']['M_postcode']).'</td></tr>
	<tr><td valign="top">' . TABLE_TEXT_WP_RESPONSE_POSTCODE .':</td><td class="tdr">'.nl2br($ipn->fields['REQUEST']['postcode']).'</td></tr>
	<tr><td colspan="2" align="right">'. $totMatch .'</td></tr>
</table>
');




		break;
		case 'C':
        $heading[] = array('text' => '<strong>Cancelled Transaction #'.$wpInfo->id.'</strong>');
        $contents[] = array('text'=> 'Customer: <strong>'. $ipn->fields['SESSION']['customer_first_name']. ' '.$ipn->fields['SESSION']['customer_last_name'].'</strong>' );

		// $contents[] = array('text' => '');
		
		if(isset($ipn->fields['SESSION']['wp_products']) && is_array($ipn->fields['SESSION']['wp_products'])){
		$contents[] = array('text'=>'<i>Shopping cart contained</i>');
			foreach($ipn->fields['SESSION']['wp_products'] as $product){
					$contents[] = array('text' => $product['quantity'] .' x '.$product['name']);
					$contents[] = array('text' => 'Final price: '. $product['final_price']);
			}
		}

		break;
		default:
        $heading[] = array('text' => '<strong>Warning: transaction code.</strong>');
        $contents[] = array('text' => '<pre>'.print_r($ipn->fields['REQUEST'], true).'</pre>');
      }
    }
      break;
	}

//           $contents[] = array('text' => "ORDER<pre>".print_r($order, true).'</pre><br />' );
//           $contents[] = array('text' => 'ipn REQUEST<pre>'.print_r($ipn->fields['REQUEST'], true)."\n\n</pre><br />" );
//            $contents[] = array('text' => 'ipn SESSION<pre>'.print_r($ipn->fields['SESSION'], true).'</pre><br />' );
//           $contents[] = array('text' => 'wp REQUEST<pre>'.print_r($wp_response->fields['REQUEST'], true).'</pre><br />' );


  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
