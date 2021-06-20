<?php
/**
 * @package Braintree SCA for Zen Cart German 1.5.6
 * @copyright Copyright 2003-2021 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @version $Id: braintree_transactions.php 2021-06-20 08:27:14 webchills $
*/


  require('includes/application_top.php');

  $braintree_sort_order_array = array(array('id' => '0', 'text' => TEXT_SORT_BRAINTREE_ID_DESC),
                             array('id' => '1', 'text' => TEXT_SORT_BRAINTREE_ID),
                             array('id' => '2', 'text' => TEXT_SORT_ZEN_ORDER_ID_DESC),
                             array('id' => '3', 'text'=> TEXT_SORT_ZEN_ORDER_ID),
                             array('id' => '4', 'text'=> TEXT_BRAINTREE_BRAND_DESC),
                             array('id' => '5', 'text'=> TEXT_BRAINTREE_BRAND)
                             );

  if (isset($_GET['braintree_sort_order'])) {
    $braintree_sort_order = $_GET['braintree_sort_order'];
  } else {
    $braintree_sort_order = 0;
  }


  switch ($braintree_sort_order) {
    case (0):
      $order_by = " order by b.braintree_id DESC";
      break;
    case (1):
      $order_by = " order by b.order_id";
      break;
    case (2):
      $order_by = " order by b.order_id DESC, b.braintree_id";
      break;
    case (3):
      $order_by = " order by b.order_id, b.braintree_id";
      break;
    case (4):
      $order_by = " order by b.payment_type DESC";
      break;
    case (5):
      $order_by = " order by b.payment_type";
      break;
      
    default:
      $order_by = " order by b.braintree_id DESC";
      break;
    }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $selected_status = (isset($_GET['payment_status']) ? $_GET['payment_status'] : '');

 

 
    
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>

    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
  </head>
   <body onLoad="init()">
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->

    <!-- body //-->
    <div class="container-fluid">
      <!-- body_text //-->
      <!-- only show if the Braintree module is installed //-->
<?php  if (defined('MODULE_PAYMENT_BRAINTREE_STATUS')) { ?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><h1 class="pageHeading"><?php echo HEADING_ADMIN_TITLE; ?></h1><span class="supportinfo">Braintree Merchant ID: <?php echo MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID; ?><br/><a href="https://www.braintreegateway.com/login" target="_blank">Braintree Live Login</a> | <a href="https://sandbox.braintreegateway.com/login" target="_blank">Braintree Sandbox Login</a></span><br/></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right">

<?php
  echo '&nbsp;&nbsp;&nbsp;' . TEXT_BRAINTREE_SORT_ORDER_INFO . zen_draw_form('braintree_sort_order', FILENAME_BRAINTREE_TRANSACTIONS, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('braintree_sort_order', $braintree_sort_order_array, $reset_braintree_sort_order, 'onChange="this.form.submit();"') . zen_hide_session_id() . zen_draw_hidden_field('payment_status', $_GET['payment_status']) . '</form>';
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
              	<td class="dataTableHeadingContent">ID</td>
                <td class="dataTableHeadingContent"><?php echo BT_BESTELLNUMMER; ?></td>
                <td class="dataTableHeadingContent"><?php echo BT_NACHNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo BT_VORNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo BT_BETRAG; ?></td>
                <td class="dataTableHeadingContent">Transaction ID</td>
                <td class="dataTableHeadingContent"><?php echo BT_DATUM; ?></td>
                <td class="dataTableHeadingContent"><?php echo BT_KREDITKARTE; ?></td>  
               
                <td class="dataTableHeadingContent"><?php echo BT_ARTIKELANZAHL; ?></td> 
                <td class="dataTableHeadingContent">Status</td> 
               <td class="dataTableHeadingContent">Email</td>
              </tr>
<?php
  if (zen_not_null($selected_status)) {
    $ipn_search = "and b.payment_status  = :selectedStatus: ";
    $ipn_search = $db->bindVars($ipn_search, ':selectedStatus:', $selected_status, 'string');
    switch ($selected_status) {
      case 'SUCCESS':
     
      
        $braintree_query_raw = "select * from `".TABLE_BRAINTREE."` as b , " .TABLE_ORDERS . " as o  where o.orders_id = b.order_id  " . $ipn_search . $order_by;
        break;
        
        case 'CANCEL':
     
      
        $braintree_query_raw = "select * from `".TABLE_BRAINTREE."` as b where b.payment_status !='' " . $ipn_search . $order_by;
        break;
        
         case 'FAILURE':
     
      
        $braintree_query_raw = "select * from `".TABLE_BRAINTREE."` as b where b.payment_type !='' " . $ipn_search . $order_by;
        break;
        
        case 'NONE':
     
      default:
        $braintree_query_raw = "select * from `".TABLE_BRAINTREE."` as b where b.payment_status ='' " . $order_by;
        break;
   } 
  } else {
        $braintree_query_raw = "select * from `".TABLE_BRAINTREE."` as b left join " .TABLE_ORDERS . " as o on o.orders_id = b.order_id " . $order_by;

  }

  $ipn_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, $braintree_query_raw, $ipn_query_numrows);
  $braintree_response = $db->Execute($braintree_query_raw);
  while (!$braintree_response->EOF) {
    if ((!isset($_GET['braintreeId']) || (isset($_GET['braintreeId']) && ($_GET['braintreeId'] == $braintree_response->fields['braintree_id']))) && !isset($btInfo) ) {
      $braintreeInfo = new objectInfo($braintree_response->fields); 
    }

	

    
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_BRAINTREE_TRANSACTIONS, 'page=' . $_GET['page'] . '&braintreeId=' . $braintree_response->fields['braintree_id'] . (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($paypal_ipn_sort_order) ? '&paypal_ipn_sort_order=' . $paypal_ipn_sort_order : '') ) . '\'">' . "\n";
    
?>
<td class="dataTableContent"> <?php echo $braintree_response->fields['braintree_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_response->fields['order_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_response->fields['last_name']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_response->fields['first_name']; ?> </td>
                
                <td class="dataTableContent"> <?php echo $braintree_response->fields['settle_amount']; ?> </td>
             
                <td class="dataTableContent"> <?php echo $braintree_response->fields['txn_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_response->fields['payment_date']; ?>
                	<td class="dataTableContent"> <?php echo $braintree_response->fields['payment_type']; ?>
                
                	<td class="dataTableContent"> <?php echo $braintree_response->fields['num_cart_items']; ?>
                <td class="dataTableContent"> <?php echo $braintree_response->fields['payment_status']; ?>
                
                		<td class="dataTableContent"> <?php echo $braintree_response->fields['payer_email']; ?>
                	
                
               
              </tr>
<?php
    $braintree_response->MoveNext();
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $ipn_split->display_count($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, $_GET['page'], "Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Transaktionen)"); ?></td>
                    <td class="smallText" align="right"><?php echo $ipn_split->display_links($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($braintree_sort_order) ? '&braintree_sort_order=' . $braintree_sort_order : '')); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php




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
      if (is_object($braintreeInfo)) {
        $heading[] = array('text' => '<strong>' .'Braintree'.' #' . $braintreeInfo->braintree_id . '</strong>');
        $ipn = $db->Execute("select * from " . TABLE_BRAINTREE . " where braintree_id = '" . $braintreeInfo->braintree_id . "'");
        $ipn_count = $ipn->RecordCount();
	  $ipn->fields['STATE'];
	  

      switch ($ipn->fields['payment_status']){
      	case 'Completed':

		require_once(DIR_WS_CLASSES . 'order.php');

		$order = new order($braintreeInfo->order_id);
        $heading[] = array('text' => '<strong>' . TEXT_INFO_BRAINTREE_RESPONSE_BEGIN.'#'.$braintreeInfo->braintree_id.', '.TEXT_INFO_BRAINTREE_RESPONSE_END.'#'. $braintreeInfo->order_id . '</strong>');

        $contents[] = array('text' =>  '' . BT_DATUM .'' . ': '. zen_datetime_short($braintreeInfo->payment_date));
          $contents[] = array('text' =>  'TransactionID' . ': '.$braintreeInfo->txn_id);
          $contents[] = array('text' =>  '' . BT_BESTELLNUMMER .'' . ': '.$braintreeInfo->order_id);
          $contents[] = array('text' =>  '' . BT_NACHNAME .'' . ': '.$braintreeInfo->last_name);
          $contents[] = array('text' =>  '' . BT_VORNAME .'' . ': '.$braintreeInfo->first_name);
          
          $contents[] = array('text' =>  '' . BT_BETRAG .'' . ': '.$braintreeInfo->settle_amount);
          $contents[] = array('text' =>  'Status' . ': '.$braintreeInfo->payment_status);
	       $contents[] = array('text' =>  '' . BT_KREDITKARTE .'' . ': '.$braintreeInfo->payment_type);	    
         $contents[] = array('text' =>  'Email' . ': '.$braintreeInfo->payer_email);
	 
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('braintreeId', 'action')) . 'oID=' . $braintreeInfo->order_id .'&' . 'btID=' . $braintreeInfo->braintree_id .'&action=edit' . '&referer=ipn') . '">' . BT_VIEW_ORDER. '</a>');
        $count = 1;

		

		 

		  
			$contents[] = array('text' =>  '</table>');


         

         

         

         




		break;
		case 'CANCEL':
        $heading[] = array('text' => '<strong>Abgebrochene Transaktion #'.$braintreeInfo->TRID.'</strong>');
        $contents[] = array('text'=> 'keine Shopbestellung vorhanden' );

		// $contents[] = array('text' => '');
		
		

		break;
		default:
        $heading[] = array('text' => '<strong>Abgebrochene Transaktion #'.$braintreeInfo->TRID.'</strong>');
        $contents[] = array('text'=> 'keine Shopbestellung vorhanden' );
        }
      }
      break;
  }



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
<?php } else { ?>
<h1 class="pageHeading"><?php echo HEADING_ADMIN_TITLE; ?></h1>
<?php } ?>
 <!-- body_text_eof //-->
    </div>
    <!-- body_eof //-->

    <!-- footer //-->
    <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
    <!-- footer_eof //-->
  </body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>

