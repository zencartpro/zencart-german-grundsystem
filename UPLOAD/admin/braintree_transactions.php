<?php
/**
 * @package Braintree SCA for Zen Cart German 1.5.7 and PHP 8
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @version $Id: braintree_transactions.php 2022-04-16 09:26:14 webchills $
*/

  require('includes/application_top.php');
  
  $braintree_sort_order_array = [
    ['id' => '0', 'text' => TEXT_SORT_BRAINTREE_ID_DESC],
    ['id' => '1', 'text' => TEXT_SORT_BRAINTREE_ID],
    ['id' => '2', 'text' => TEXT_SORT_ZEN_ORDER_ID_DESC],
    ['id' => '3', 'text' => TEXT_SORT_ZEN_ORDER_ID],
    ['id' => '4', 'text' => TEXT_BRAINTREE_BRAND_DESC],
    ['id' => '5', 'text' => TEXT_BRAINTREE_BRAND]
  ];

  $braintree_sort_order = 0;
  if (isset($_GET['braintree_sort_order'])) {
    $braintree_sort_order = (int) $_GET['braintree_sort_order'];
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
<link rel="stylesheet" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<style>
.supportinfo {
font-size: 13px;
margin: 0 0 20px 0;
padding:0
} 
.supportinfo a {
font-size: 13px;

}  
#btlogo{
width:172px;
height:40px;
float:right;
margin:5px 5px 5px 40px;
} 
#btsorter{
width:360px;
height:50px;
float:right;
margin:-50px 5px 0px 10px;
} 
</style>
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
<body>
    <!-- header //-->
    <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
    <!-- header_eof //-->
    <!-- body //-->
    <div class="container-fluid">
    <h1><?php echo HEADING_ADMIN_TITLE; ?></h1>
    <!-- only show if the Braintree module is installed //-->
<?php  if (defined('MODULE_PAYMENT_BRAINTREE_STATUS')) { ?>
<span id="btsorter"><img src="images/braintree-logo.png"><br><?php
  $hidden_field = (isset($_GET['braintree_sort_order'])) ? zen_draw_hidden_field('braintree_sort_order', $_GET['braintree_sort_order']) : '';
  echo '' . zen_draw_form('braintree_sort_order', FILENAME_BRAINTREE_TRANSACTIONS, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('braintree_sort_order', $braintree_sort_order_array, $braintree_sort_order, 'onChange="this.form.submit();"') . zen_hide_session_id() . $hidden_field . '</form>';
?></span>
    <span class="supportinfo">Braintree Merchant ID: <?php echo MODULE_PAYMENT_BRAINTREE_MERCHANT_ACCOUNT_ID; ?> | <a href="https://www.braintreegateway.com/login" target="_blank">Braintree Live Login</a> | <a href="https://sandbox.braintreegateway.com/login" target="_blank">Braintree Sandbox Login</a></span>

       <div class="row">
           <div class="col-sm-12 col-md-9 configurationColumnLeft">
              <table class="table">
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
    $bt_search = "and b.payment_status  = :selectedStatus: ";
    $bt_search = $db->bindVars($bt_search, ':selectedStatus:', $selected_status, 'string');
    switch ($selected_status) {
      case 'SUCCESS':     
      
        $braintree_query_raw = "SELECT * from `".TABLE_BRAINTREE."` as b , " .TABLE_ORDERS . " as o  where o.orders_id = b.order_id  " . $bt_search . $order_by;
        break;
        
        case 'CANCEL':     
      
        $braintree_query_raw = "SELECT * from `".TABLE_BRAINTREE."` as b where b.payment_status !='' " . $bt_search . $order_by;
        break;
        
       case 'FAILURE':     
      
        $braintree_query_raw = "SELECT * from `".TABLE_BRAINTREE."` as b where b.payment_type !='' " . $bt_search . $order_by;
        break;
        
        case 'NONE':
     
        default:
        $braintree_query_raw = "SELECT * from `".TABLE_BRAINTREE."` as b where b.payment_status ='' " . $order_by;
        break;
   } 
  } else {
        $braintree_query_raw = "SELECT * from `".TABLE_BRAINTREE."` as b left join " .TABLE_ORDERS . " as o on o.orders_id = b.order_id " . $order_by;

  }

  $bt_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_BRAINTREE_IPN, $braintree_query_raw, $bt_query_numrows);
  $braintree_response = $db->Execute($braintree_query_raw);
  foreach ($braintree_response as $braintree_tran) {
    if ((!isset($_GET['braintreeId']) || (isset($_GET['braintreeId']) && ($_GET['braintreeId'] == $braintree_response->fields['braintree_id']))) && !isset($btInfo) ) {
      $braintreeInfo = new objectInfo($braintree_tran); 
    }   
    
      echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_BRAINTREE_TRANSACTIONS, 'page=' . $_GET['page'] . '&braintreeId=' . $braintree_tran['braintree_id'] . (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($braintree_sort_order) ? '&braintree_sort_order=' . $braintree_sort_order : '') ) . '\'">' . "\n";
   
?>
                <td class="dataTableContent"> <?php echo $braintree_tran['braintree_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_tran['order_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_tran['last_name']; ?> </td>
		            <td class="dataTableContent"> <?php echo $braintree_tran['first_name']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_tran['settle_amount']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_tran['txn_id']; ?> </td>
                <td class="dataTableContent"> <?php echo $braintree_tran['payment_date']; ?>
                <td class="dataTableContent"> <?php echo $braintree_tran['payment_type']; ?>
                <td class="dataTableContent"> <?php echo $braintree_tran['num_cart_items']; ?>
                <td class="dataTableContent"> <?php echo $braintree_tran['payment_status']; ?>
                <td class="dataTableContent"> <?php echo $braintree_tran['payer_email']; ?>
                	
              <?php echo '</tr>';
  }
?>
              <tr>
                    <td colspan="3" class="smallText"><?php echo $bt_split->display_count($bt_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_BRAINTREE_IPN, $_GET['page'], "Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Transaktionen)"); ?></td>
                    <td colspan="3" class="smallText"><?php echo $bt_split->display_links($bt_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_BRAINTREE_IPN, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], (zen_not_null($selected_status) ? '&payment_status=' . $selected_status : '') . (zen_not_null($braintree_sort_order) ? '&braintree_sort_order=' . $braintree_sort_order : '')); ?></td>
                  </tr>
                </table>
           </div>
<?php
  $heading = [];
  $contents = [];

  switch ($action) {
    case 'new':
      break;
    case 'edit':
      break;
    case 'delete':
      break;
    default:
      
      if (isset($braintreeInfo) && is_object($braintreeInfo)) {
        $heading[] = ['text' => '<strong>' . 'Braintree'.' #' . $braintreeInfo->braintree_id . '</strong>'];
        $bt = $db->Execute("SELECT * FROM " . TABLE_BRAINTREE . " WHERE braintree_id = '" . $braintreeInfo->braintree_id . "'");
        $bt_count = $bt->RecordCount();  
	  

      switch ($bt->fields['payment_status']){
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
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('braintreeId', 'action')) . 'oID=' . $braintreeInfo->order_id .'&' . 'btID=' . $braintreeInfo->braintree_id .'&action=edit' . '&referer=bt') . '">' . BT_VIEW_ORDER. '</a>');
        $count = 1;
		  
			$contents[] = array('text' =>  '</table>');
		break;
		case 'CANCEL':
        $heading[] = array('text' => '<strong>Abgebrochene Transaktion #'.$braintreeInfo->TRID.'</strong>');
        $contents[] = array('text'=> 'keine Shopbestellung vorhanden' );
		break;
		default:
        $heading[] = array('text' => '<strong>Abgebrochene Transaktion #'.$braintreeInfo->TRID.'</strong>');
        $contents[] = array('text'=> 'keine Shopbestellung vorhanden' );
        }
      }
      break;
  }
  if (!empty($heading) && !empty($contents)) {
    $box = new box();
      echo '<div class="col-sm-12 col-md-3 configurationColumnRight">';
    echo $box->infoBox($heading, $contents);
      echo '</div>';
  }
?>
       </div>
<?php } ?>
</div>
<?php require DIR_WS_INCLUDES . 'footer.php'; ?>
</body>
</html>
<?php require DIR_WS_INCLUDES . 'application_bottom.php'; ?>