<?php
/**
 * @package payment - billpay
 * @copyright Copyright 2010 Billpay GmbH
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * zahlungs.....(BillPay-text)
 * 
 * @version $Id$
 */
 ?>


<script language="Javascript">
	function create_billpay_invoice()
	{
		Check = confirm('<?php echo MODULE_PAYMENT_BILLPAY_TEXT_CREATE_INVOICE; ?>');
		if(Check == true) 
		{
			window.location.href = "<?php echo zen_href_link(FILENAME_ORDERS, 'oID=' . $_GET['oID'] . '&action=edit&billpayactive=true'); ?>";
			//window.location.href = "<?php echo HTTP_SERVER . DIR_WS_ADMIN . 'orders.php?oID='. $_GET["oID"].'&action=edit&billpayactive=true' ?>";
		}
	}
	
	function cancel_billpay_invoice()
	{
		Check = confirm('<?php echo MODULE_PAYMENT_BILLPAY_TEXT_CANCEL_ORDER; ?>');
		if(Check == true)
		{
			//window.location.href = "<?php echo zen_href_link(FILENAME_ORDERS, 'oID=' . $_GET['oID'] . '&action=edit&billpaycancel=true'); ?>";
			window.location.href = "<?php echo HTTP_SERVER . DIR_WS_ADMIN . 'orders.php?oID='. $_GET["oID"].'&action=edit&billpaycancel=true' ?>";			
		}
	}
</script>