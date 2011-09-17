<td colspan="2" align="right">
<?php
/**
 * @package payment - billpay
 * @copyright Copyright 2010 Billpay GmbH
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com  http://edv.langheiter.com
 * zahlungs.....(BillPay-text)
 * 
 * @version $Id: billpay.php 582 2010-06-02 08:24:32Z hugo13 $
 */


require_once(DIR_FS_CATALOG . 'includes/languages/' . $_SESSION['language'] . '/modules/payment/billpay.php');
		
	/** prepare default params for cancel request and invoice created request */
	if(isset($_GET["billpaycancel"]) || isset($_GET["billpayactive"]))
	{	
		require_once(DIR_FS_CATALOG . 'includes/modules/payment/billpay.php');
		$billpay = new billpay();
	
        $currency = $order->info[currency];
		
        //$total_query = $db->Execute("SELECT class, value FROM orders_total WHERE class='ot_total' AND orders_id = " . $_GET["oID"]);
		$total_query = $db->Execute("SELECT class, value FROM orders_total WHERE orders_id = " . $_GET["oID"]);
		while(!$total_query->EOF)
		{
            //$total_result[$total_array['class']] = $total_query->fields['value'];
			$total_result[$total_query->fields['class']] = $total_query->fields['value'];
            $total_query->MoveNext();
		}
        $total = $billpay->_currencyToSmallerUnit($total_result['ot_subtotal'] + $total_result['ot_shipping']);
		$total += $billpay->_currencyToSmallerUnit($total_result['ot_billpay_fee']);
        
		//$total += $billpay->_currencyToSmallerUnit($billpay->_calculateCartTax());
			
			$res = $db->Execute('SELECT shipping_class FROM billpay_bankdata WHERE orders_id = '.$_GET["oID"]);
			while(!$res->EOF)
			{   
                $shipping_array = $res->fields;
				$shipping_result = $shipping_array['shipping_class'];
                $res->MoveNext();
			}
			if(defined('MODULE_SHIPPING_'.strtoupper($shipping_result).'_TAX_CLASS'))
			{
				$tax_class = constant('MODULE_SHIPPING_'.strtoupper($shipping_result).'_TAX_CLASS');
				$shipping_tax = zen_get_tax_rate($tax_class, 
													$order->delivery['country']['id'], 
														$order->delivery['zone_id']);
				$billpay_shipping_tax = zen_calculate_tax($total_result['ot_shipping'], $shipping_tax);
				$total += $billpay->_currencyToSmallerUnit($billpay_shipping_tax);
			}
		}

	/** EOF prepare default params for cancel request and invoice created request */
	
	/** BEGIN cancel request */
	if(isset($_GET["billpaycancel"]))
	{
		require_once(DIR_FS_CATALOG . 'includes/billpay/api/ipl_cancel_request.php');
		
		$query = 'SELECT api_reference_id FROM billpay_bankdata WHERE orders_id = ' . $_GET["oID"];
		
		$res = $db->Execute($query);
		$a = $res->fields;
		
		$apiReferenceId = $a['api_reference_id'];
		
		if (!$apiReferenceId) {
			$errorMessage = 'ERROR: No api reference found for orders_id ' . $_GET["oID"];
			
			$billpay->_logError($errorMessage, 'ERROR trying to submit cancel');
			echo "<script>alert('" . $errorMessage . "');</script>";
		}
		
		$req = new ipl_cancel_request(MODULE_PAYMENT_BILLPAY_API_URL_BASE);
		$req->set_default_params($billpay->bp_merchant, $billpay->bp_portal, $billpay->bp_secure);
		$req->set_cancel_params($apiReferenceId, $total, $currency);

		try {
			$req->send();
			
			$_xmlreq = (string)utf8_decode($req->get_request_xml());
			$_xmlresp =	(string)utf8_decode($req->get_response_xml());
			$billpay->_logError($_xmlreq, 'XML request invoice created');
			$billpay->_logError($_xmlresp, 'XML response invoice created');
			
			if($req->has_error()) {
				
				if($billpay->testmode == true)
					echo "<script>alert('".$req->get_merchant_error_message()."');</script>";
				else
					echo "<script>alert('".$req->get_merchant_error_message()."');</script>";
			}
			else
			{
				$res = $db->Execute("SELECT configuration_value FROM configuration WHERE configuration_key = 'MODULE_PAYMENT_BILLPAY_STATUS_CANCELLED'");
				$a = $res->fields;
				$stateCancelled = $a['configuration_value'];
				
				$db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS_HISTORY . '(orders_id, orders_status_id, date_added, customer_notified, comments) '. 
								'VALUES (' . $_GET["oID"] . ", " . $stateCancelled . ", now(), 0,'" . MODULE_PAYMENT_BILLPAY_TEXT_CANCEL_COMMENT . "')");
				$db->Execute('UPDATE ' . TABLE_ORDERS . ' SET orders_status = ' . $stateCancelled . ' WHERE orders_id =  ' . $_GET["oID"]);

				$order->info['orders_status'] = $stateCancelled;

				$_xmlreq = (string)utf8_decode($req->get_request_xml());
				$_xmlresp =	(string)utf8_decode($req->get_response_xml());
				$billpay->_logError($_xmlreq, 'XML request invoice created');
				$billpay->_logError($_xmlresp, 'XML response invoice created');
			}
		}
		catch(Exception $e)
		{
			echo "<script>alert('".utf8_decode($e->getMessage())."');</script>";	
		}
	}
	/** EOF cancel request */

	/** BEGIN invoice created request */
	if(isset($_GET["billpayactive"]))
	{
		require_once(DIR_FS_CATALOG . 'includes/billpay/api/ipl_invoice_created_request.php');

		$query = 'SELECT api_reference_id FROM billpay_bankdata WHERE orders_id = ' . $_GET["oID"];
		
		$res = $db->Execute($query);
		$a = $res->fields;
		
		$apiReferenceId = $a['api_reference_id'];
		
		if (!$apiReferenceId) {
			$errorMessage = 'ERROR: No api reference found for orders_id ' . $_GET["oID"];
			
			$billpay->_logError($errorMessage, 'ERROR trying to submit cancel');
			echo "<script>alert('" . $errorMessage . "');</script>";
		}
		
		$req = new ipl_invoice_created_request(MODULE_PAYMENT_BILLPAY_API_URL_BASE);
		$req->set_default_params($billpay->bp_merchant, $billpay->bp_portal, $billpay->bp_secure);
		$req->set_invoice_params($total, $currency, $apiReferenceId);	
		
		try
		{
			$req->send();
			
			$_xmlreq = (string)utf8_decode($req->get_request_xml());
			$_xmlresp =	(string)utf8_decode($req->get_response_xml());
			$billpay->_logError($_xmlreq, 'XML request invoice created');
			$billpay->_logError($_xmlresp, 'XML response invoice created');	
			
			if($req->has_error()) {
				echo "<script>alert('".$req->get_merchant_error_message()."');</script>";
			}
			else
			{
				if($req->get_invoice_duedate() == "")
				{
					/** due date is empty. order already cancelled? */
					echo "<script>alert('".MODULE_PAYMENT_BILLPAY_TEXT_ERROR_SHORT."');</script>";
					$billpay->_logError('invoice duedate is empty', 'invoice created error');	
				}
				else
				{
					$res = $db->Execute("SELECT configuration_value FROM configuration WHERE configuration_key = 'MODULE_PAYMENT_BILLPAY_STATUS_ACTIVATED'");
					$a = $res->fields;
					
					$db->Execute('INSERT INTO ' . TABLE_ORDERS_STATUS_HISTORY . '(orders_id, orders_status_id, date_added, customer_notified, comments) '. 
									'VALUES (' . $_GET["oID"] . ", " . $a['configuration_value'] . ", now(), 0, '" . MODULE_PAYMENT_BILLPAY_TEXT_INVOICE_CREATED_COMMENT . "')");
					$db->Execute('UPDATE ' . TABLE_ORDERS . ' SET orders_status = ' . $a['configuration_value'] . ' WHERE orders_id =  ' . $_GET["oID"]);
			
					$upd_success = $db->Execute('UPDATE billpay_bankdata SET invoice_due_date = "'.$req->get_invoice_duedate().'" '.
													'WHERE orders_id = '.$_GET["oID"]);
				
					$_xmlreq = (string)utf8_decode($req->get_request_xml());
					$_xmlresp =	(string)utf8_decode($req->get_response_xml());
					$billpay->_logError($_xmlreq, 'XML request invoice created');
					$billpay->_logError($_xmlresp, 'XML response invoice created');	
				}	
			}
		}
		catch(Exception $e)
		{
			$_xmlreq = (string)utf8_decode($req->get_request_xml());
			$_xmlresp =	(string)utf8_decode($req->get_response_xml());
			$billpay->_logError($_xmlreq, 'XML request invoice created');
			$billpay->_logError($_xmlresp, 'XML response invoice created');	
			$billpay->_logError(print_r($_POST), 'DEBUG');
			echo "<script>alert('".$e->getMessage()."');</script>";
		}
	}
	/** EOF invoice created request */

	/** reload page for order status update */
	if(!isset($_GET[reloaded])){ ?>	
		<script language="JavaScript">
		    window.location.href = "<?php echo zen_href_link(FILENAME_ORDERS, 'oID='.$_GET["oID"].'&action=edit&reloaded=true') ?>";
		</script>
	<?php }

	

	/** DISPlAY billpay buttons for invoice and cancel */
	if($order->info['payment_module_code'] == "billpay")    // r.l. 
	{
		require_once('billpay_client_dialog.php');
		
		$res = $db->Execute("SELECT configuration_value FROM configuration WHERE configuration_key = 'MODULE_PAYMENT_BILLPAY_STATUS_ACTIVATED'");
		$a = $res->fields;
		$statusActived = $a['configuration_value'];
		
		$res = $db->Execute("SELECT configuration_value FROM configuration WHERE configuration_key = 'MODULE_PAYMENT_BILLPAY_STATUS_CANCELLED'");
		$a = $res->fields;
		$statusCancelled = $a['configuration_value'];
		
		if ($statusActived && $statusCancelled) {
            $sql = 'SELECT osh.orders_id, osh.orders_status_id, bb.invoice_due_date '.
                                            'FROM orders_status_history osh '.
                                              'INNER JOIN billpay_bankdata bb '.
                                                'ON osh.orders_id = bb.orders_id '.
                                            'WHERE osh.orders_status_id = ' . $statusActived . ' '.
                                             'AND osh.orders_id = '.$_GET["oID"];
			$status_query = $db->Execute($sql);
	
			if (!$res->RecordCount() && $order->info[orders_status]!=$statusActived)
				echo '<a href="#" onClick="create_billpay_invoice();return false">' . zen_image_button('button_zahlungsziel.gif', 'Zahlungsziel aktivieren') . '</a>';
			else
			{
				$billpay_order = $status_query->fields;
				if($billpay_order[invoice_due_date] == "")
				{
					echo '<a href="#" onClick="create_billpay_invoice();return false">' . zen_image_button('button_zahlungsziel.gif', 'Zahlungsziel aktivieren') . '</a>';
				}
				else if($order->info[orders_status]!=$statusCancelled)
				{
					echo '<a href="Javascript:void()" onClick="cancel_billpay_invoice();">' . zen_image_button('button_storno.gif', 'stornieren') . '</a>&nbsp;';
					echo '<a href="' . zen_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a>';
				}
				else if($order->info[orders_status]==$statusCancelled)
				{
					echo '<a href="' . zen_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a>';
				}
			}
		}
	}
	else
	{
		echo '<a href="' . zen_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a>';
	}
	echo '<a href="' . zen_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . zen_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>';
?>
</td>