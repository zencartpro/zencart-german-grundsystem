<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
/*
  Written by Jonathan Hilgeman of SiteCreative.com (osc@sitecreative.com)

  Version History
  ---------------------------------------------------------------
  11/4/04 by Scott Drake of ecdiscounts.com (webmaster@ecdiscounts.com)

  1.3a - Updated readme file to correct installation problem.
         Added a Edit button instead of a Text Link.
         Replaced Zen-Cart's non functioning Edit button with a Details button.

  2004-08-10
  1.3 - ported to zen-cart 1.2 from rainer AT langheiter DOT com // http://www.filosofisch.com

  08/08/03
  1.2a - Fixed a query problem on osC 2.1 stores.

  08/08/03
  1.2 - Added more recommendations to the instructions.
        Added "Customer" fields for editing on osC 2.2.
        Corrected "Billing" fields so they update correctly.
        Added Company and Suburb Fields.
        Added optional shipping tax variable.
        First (and hopefully last) fix for currency formatting.

  08/08/03
  1.1 - Added status editing (fixed order status bug from 1.0).
        Added comments editing. (with compatibility for osC 2.1)
        Added customer notifications.
        Added some additional information to the instructions file.
        Fixed bug with product names containing single quotes.

  08/07/03
  1.0 - Original Release.

  To Do in Version 1.3
  ---------------------------------------------------------------

  Note from the author
  ---------------------------------------------------------------
  This tool was designed and tested on osC 2.2 Milestone 2.2,
  but may work for other versions, as well. Most database changes
  were minor, so getting it to work on other versions may just
  need some tweaking. Hope this helps make your life easier!

  - Jonathan Hilgeman, August 7th, 2003
*/
  global $db;
  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  require(DIR_WS_CLASSES . 'order.php');

  $oID = zen_db_prepare_input($_GET['oID']);
  $step = zen_db_prepare_input($_POST['step']);
  $add_product_categories_id = zen_db_prepare_input($_POST['add_product_categories_id']);
  $add_product_products_id = zen_db_prepare_input($_POST['add_product_products_id']);
  $add_product_quantity = zen_db_prepare_input($_POST['add_product_quantity']);

  // New "Status History" table has different format.
  $OldNewStatusValues = (zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "old_value") && zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "new_value"));
  $CommentsWithStatus = zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "comments");
  $SeparateBillingFields = zen_field_exists(TABLE_ORDERS, "billing_name");

  // Optional Tax Rate/Percent
  $AddShippingTax = "19.0"; // e.g. shipping tax of 17.5% is "17.5"

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = $db -> Execute("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['languages_id'] . "'");
#  while ($orders_status = zen_db_fetch_array($orders_status_query)) {
  while (!$orders_status_query -> EOF) {
    $orders_statuses[] = array('id' => $orders_status_query->fields['orders_status_id'],
                               'text' => $orders_status_query->fields['orders_status_name']);
    $orders_status_array[$orders_status_query->fields['orders_status_id']] = $orders_status_query->fields['orders_status_name'];
    $orders_status_query -> MoveNext();
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : 'edit');
//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
$order_query = $db -> Execute("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$oID . "'");
//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################


  if (zen_not_null($action)) {
    switch ($action) {

	// Update Order
	case 'update_order':

		$oID = zen_db_prepare_input($_GET['oID']);
		$order = new order($oID);
		$status = zen_db_prepare_input($_POST['status']);

		// Update Order Info
		$UpdateOrders = "update " . TABLE_ORDERS . " set
			customers_name = '" . zen_db_input(stripslashes($_POST['update_customer_name'])) . "',
			customers_company = '" . zen_db_input(stripslashes($_POST['update_customer_company'])) . "',
			customers_street_address = '" . zen_db_input(stripslashes($_POST['update_customer_street_address'])) . "',
			customers_suburb = '" . zen_db_input(stripslashes($_POST['update_customer_suburb'])) . "',
			customers_city = '" . zen_db_input(stripslashes($_POST['update_customer_city'])) . "',
			customers_state = '" . zen_db_input(stripslashes($_POST['update_customer_state'])) . "',
			customers_postcode = '" . zen_db_input($_POST['update_customer_postcode']) . "',
			customers_country = '" . zen_db_input(stripslashes($_POST['update_customer_country'])) . "',
			customers_telephone = '" . zen_db_input($_POST['update_customer_telephone']) . "',
			customers_email_address = '" . zen_db_input($_POST['update_customer_email_address']) . "',";

		$UpdateOrders .= "billing_name = '" . zen_db_input(stripslashes($_POST['update_billing_name'])) . "',
			billing_company = '" . zen_db_input(stripslashes($_POST['update_billing_company'])) . "',
			billing_street_address = '" . zen_db_input(stripslashes($_POST['update_billing_street_address'])) . "',
			billing_suburb = '" . zen_db_input(stripslashes($_POST['update_billing_suburb'])) . "',
			billing_city = '" . zen_db_input(stripslashes($_POST['update_billing_city'])) . "',
			billing_state = '" . zen_db_input(stripslashes($_POST['update_billing_state'])) . "',
			billing_postcode = '" . zen_db_input($_POST['update_billing_postcode']) . "',
			billing_country = '" . zen_db_input(stripslashes($_POST['update_billing_country'])) . "',";

		$UpdateOrders .= "delivery_name = '" . zen_db_input(stripslashes($_POST['update_delivery_name'])) . "',
			delivery_company = '" . zen_db_input(stripslashes($_POST['update_delivery_company'])) . "',
			delivery_street_address = '" . zen_db_input(stripslashes($_POST['update_delivery_street_address'])) . "',
			delivery_suburb = '" . zen_db_input(stripslashes($_POST['update_delivery_suburb'])) . "',
			delivery_city = '" . zen_db_input(stripslashes($_POST['update_delivery_city'])) . "',
			delivery_state = '" . zen_db_input(stripslashes($_POST['update_delivery_state'])) . "',
			delivery_postcode = '" . zen_db_input($_POST['update_delivery_postcode']) . "',
			delivery_country = '" . zen_db_input(stripslashes($_POST['update_delivery_country'])) . "',
			payment_method = '" . zen_db_input($_POST['update_info_payment_method']) . "',
			cc_type = '" . zen_db_input($_POST['update_info_cc_type']) . "',
			cc_owner = '" . zen_db_input($_POST['update_info_cc_owner']) . "',";


		if(substr($update_info_cc_number,0,8) != "(Last 4)")
		$UpdateOrders .= "cc_number = '". $_POST['update_info_cc_number']. "',";

		$UpdateOrders .= "cc_expires = '". $_POST['update_info_cc_expires']. "',
			orders_status = '" . zen_db_input($status) . "'";

		if(!$CommentsWithStatus)
		{
			#$UpdateOrders .= ", comments = '" . zen_db_input($comments) . "'";
		}

		$UpdateOrders .= " where orders_id = '" . zen_db_input($oID) . "';";

		$db -> Execute($UpdateOrders);
		$order_updated = true;


        	$check_status = $db -> Execute("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        	#$check_status = zen_db_fetch_array($check_status_query);

		// Update Status History & Email Customer if Necessary
		if ($order->info['orders_status'] != $status)
		{
			// Notify Customer
          		$customer_notified = '0';
			if (isset($_POST['notify']) && ($_POST['notify'] == 'on'))
			{
			   // neue Rechnung schicken?
			   if ($_POST['newinvoice'] == 'on')
			   {
			     // neue Rechnung erstellen
			     $notify_comments = '';
			     if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on')) {
			       $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $comments) . "\n\n";
			     }
			     $html_msg['EMAIL_TEXT_HEADER'] = EMAIL_TEXT_HEADER;
			     $html_msg['EMAIL_FIRST_NAME'] = $check_status->fields['customers_name'];
			     $html_msg['EMAIL_LAST_NAME'] = '';
			     $html_msg['INTRO_STORE_NAME'] = STORE_NAME;
			     $html_msg['EMAIL_THANKS_FOR_SHOPPING'] = EMAIL_THANKS_FOR_SHOPPING;
			     $html_msg['EMAIL_DETAILS_FOLLOW'] = EMAIL_DETAILS_FOLLOW;
			     $html_msg['INTRO_ORDER_NUM_TITLE'] = EMAIL_TEXT_ORDER_NUMBER;
			     $html_msg['INTRO_ORDER_NUMBER'] = $oID;
			     $html_msg['INTRO_DATE_TITLE'] = EMAIL_TEXT_DATE_ORDERED;
			     $html_msg['INTRO_DATE_ORDERED'] = zen_date_long($check_status->fields['date_purchased']);
			     $html_msg['INTRO_URL_VALUE'] = zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL');
			     $html_msg['INTRO_URL_TEXT'] = EMAIL_TEXT_INVOICE_URL_CLICK;
			     $html_msg['ORDER_COMMENTS'] = '';
			     $html_msg['PRODUCTS_TITLE'] = PRODUCTS_TITLE;
			     $html_msg['HEADING_ADDRESS_INFORMATION'] = HEADING_ADDRESS_INFORMATION;
			     $html_msg['ADDRESS_DELIVERY_TITLE'] = ADDRESS_DELIVERY_TITLE;
			     $html_msg['SHIPPING_METHOD_TITLE'] = SHIPPING_METHOD_TITLE;
			     $html_msg['ADDRESS_BILLING_TITLE'] = ADDRESS_BILLING_TITLE;
			     $html_msg['PAYMENT_METHOD_TITLE'] = PAYMENT_METHOD_TITLE;
			     $html_msg['ADDRESS_DELIVERY_DETAIL'] = $order->delivery['name'] . "<br />" . $order->delivery['street_address'] . "<br />" .  $order->delivery['postcode'] . "\n" . $order->delivery['city'] . "<br />" . $order->delivery['country'];
			     $html_msg['ADDRESS_BILLING_DETAIL'] = $order->billing['name'] . "<br />" . $order->billing['street_address'] . "<br />" .  $order->billing['postcode'] . "\n" . $order->billing['city'] . "<br />" . $order->billing['country'];
			     $html_msg['SHIPPING_METHOD_DETAIL'] = $order->info['shipping_method'];
			     $html_msg['PAYMENT_METHOD_DETAIL'] = $order->info['payment_method'];
			     $html_msg['PAYMENT_METHOD_FOOTER'] = $order->info['cc_type'];
			     $html_msg['EXTRA_INFO'] = '';
			     // Product-Liste
			     for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
				$products_ordered_html = '<tr>' . '<td class="product-details" align="right" valign="top" width="30">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . '<td class="product-details" valign="top">' . $order->products[$i]['name'] . ($order->products[$i]['model'] != '' ? ' (' . $order->products[$i]['model'] . ') ' : '') . '<nobr><small><em> '. $order->products[$i]['attributes'] .'</em></small></nobr></td>' . '<td class="product-details-num" valign="top" align="right">' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . ($order->products[$i]['onetime_charges'] !=0 ? '</td></tr><tr><td>&nbsp;</td><td class="product-details">' . TEXT_ONETIME_CHARGES_BASKET . '</td>' . '<td class="product-details-num" align="right">' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1) : '') . '</td></tr>';
				$html_msg['PRODUCTS_DETAIL']=$html_msg['PRODUCTS_DETAIL'] . '<table class="product-details" border="0" width="100%" cellspacing="0" cellpadding="2">' . $products_ordered_html . '</table>';
			     }
			     // Order Totals
			     $html_msg['ORDER_TOTALS'] = '<table border="0" width="100%" cellspacing="0" cellpadding="2">' . '<td class="order-totals-text" align="right" width="100%">' . '&nbsp;' . '</td> ' . "\n" . '<td class="order-totals-num" align="right" nowrap="nowrap">' . '---------' .'</td> </tr>' . "\n" . '<tr>';
			     for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
				$email_order = $email_order . strip_tags($order->totals[$i]['title']) . ' ' . strip_tags($order->totals[$i]['text']) . "\n";
				$html_ot = '<td class="order-totals-text" align="right" width="100%">' . $order->totals[$i]['title'] . '</td> ' . "\n" . '<td class="order-totals-num" align="right" nowrap="nowrap">' .($order->totals[$i]['text']) .'</td> </tr>' . "\n" . '<tr>';
				$html_msg['ORDER_TOTALS'] = $html_msg['ORDER_TOTALS'] . '<table border="0" width="100%" cellspacing="0" cellpadding="2">' . $html_ot . '</table>';
			     }
			     // Text-Mail
			     $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . $html_msg['INTRO_ORDER_NUM_TITLE'] . $html_msg['INTRO_ORDER_NUMBER'] . "\n" . EMAIL_TEXT_DATE_ORDERED . $html_msg['INTRO_DATE_ORDERED'] . "\n" . $html_msg['INTRO_URL_VALUE'] . "\n\n" . $notify_comments . $email_order . "\n\n" . EMAIL_TEXT_STATUS_PLEASE_REPLY . "\n" . 'Ihr ' . STORE_NAME;
			     // HTML-MAIL
			     zen_mail($check_status->fields['customers_name'], $check_status->fields['customers_email_address'], EMAIL_TEXT_SUBJECT2 . STORE_NAME, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'checkout_extra');
			     zen_mail($check_status->fields['customers_name'], STORE_OWNER_EMAIL_ADDRESS, EMAIL_TEXT_SUBJECT2 . STORE_NAME, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'checkout_extra');
			   } else {
			     $html_msg['EMAIL_FIRST_NAME'] = $check_status->fields['customers_name'];
			     $html_msg['EMAIL_LAST_NAME'] = '';
			     $html_msg['EMAIL_TEXT_ORDER_NUMBER'] = EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID;
			     $html_msg['EMAIL_TEXT_INVOICE_URL'] = EMAIL_TEXT_INVOICE_URL . ' ' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL');
			     $html_msg['EMAIL_TEXT_DATE_ORDERED'] = EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($check_status->fields['date_purchased']);
			     $html_msg['EMAIL_TEXT_STATUS_COMMENTS'] = 'Kommentare: ' . $notify_comments;
			     $html_msg['EMAIL_TEXT_STATUS_UPDATED'] = EMAIL_TEXT_STATUS_UPDATE;
			     $html_msg['EMAIL_TEXT_STATUS_LABEL'] = EMAIL_TEXT_STATUS_LABEL . $orders_status_array[$status];
			     $html_msg['EMAIL_TEXT_STATUS_PLEASE_REPLY'] = EMAIL_TEXT_STATUS_PLEASE_REPLY;
			     // Text-Mail
			     $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . $html_msg['EMAIL_TEXT_ORDER_NUMBER'] . "\n" . $html_msg['EMAIL_TEXT_DATE_ORDERED'] . "\n" . $html_msg['EMAIL_TEXT_INVOICE_URL'] . "\n\n" . $notify_comments . EMAIL_TEXT_STATUS_UPDATE . "\n" . $html_msg['EMAIL_TEXT_STATUS_LABEL'] ."\n\n" . EMAIL_TEXT_STATUS_PLEASE_REPLY . "\n" . 'Ihr ' . STORE_NAME;
			     // HTML-MAIL
			     zen_mail($check_status->fields['customers_name'], $check_status->fields['customers_email_address'], STORE_NAME . ': ' . EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'order_status_extra');
			     zen_mail($check_status->fields['customers_name'], STORE_OWNER_EMAIL_ADDRESS, STORE_NAME . ': ' . EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'order_status_extra');
			     }
			     $customer_notified = '1';
			}

			// "Status History" table has gone through a few
			// different changes, so here are different versions of
			// the status update.

			// NOTE: Theoretically, there shouldn't be a
			//       orders_status field in the ORDERS table. It
			//       should really just use the latest value from
			//       this status history table.

			if($CommentsWithStatus)
			{
			$db -> Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . "
				(orders_id, orders_status_id, date_added, customer_notified, comments)
				values ('" . zen_db_input($oID) . "', '" . zen_db_input($status) . "', now(), " . zen_db_input($customer_notified) . ", '" . zen_db_input($comments)  . "')");
			}
			else
			{
				if($OldNewStatusValues)
				{
				$db -> Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . "
					(orders_id, new_value, old_value, date_added, customer_notified)
					values ('" . zen_db_input($oID) . "', '" . zen_db_input($status) . "', '" . $order->info['orders_status'] . "', now(), " . zen_db_input($customer_notified) . ")");
				}
				else
				{
				$db -> Execute("insert into " . TABLE_ORDERS_STATUS_HISTORY . "
					(orders_id, orders_status_id, date_added, customer_notified)
					values ('" . zen_db_input($oID) . "', '" . zen_db_input($status) . "', now(), " . zen_db_input($customer_notified) . ")");
				}
			}
		}

		// Update Products
		$RunningSubTotal = 0;
		$RunningTax = 0;
		$Abzuege = 0;
		$update_products = $_POST['update_products'];
		foreach($update_products as $orders_products_id => $products_details)
		{
			// Update orders_products Table
			//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
			#$order = zen_db_fetch_array($order_query);
			if ($products_details["qty"] != $order_query->fields['products_quantity']){
				$differenza_quantita = ($products_details["qty"] - $order_query->fields['products_quantity']);
					$db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order_query->fields['products_id'] . "'");
			}
			//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
			if($products_details["qty"] > 0)
			{
				$Query = "update " . TABLE_ORDERS_PRODUCTS . " set
					products_model = '" . $products_details["model"] . "',
					products_name = '" . str_replace("'", "&#39;", $products_details["name"]) . "',
					final_price = '" . ($products_details["final_price"] / (100 + $products_details["tax"]) * 100) . "',
					products_price = final_price,
					products_tax = '" . $products_details["tax"] . "',
					products_quantity = '" . $products_details["qty"] . "'
					where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);

				// Update Tax and Subtotals
				$RunningSubTotal += $products_details["qty"] * $products_details["final_price"];
				$RunningTax += ($products_details["final_price"] * $products_details["qty"] / (100 + $products_details["tax"]) * $products_details["tax"]);

				// Update Any Attributes
				if(IsSet($products_details[attributes]))
				{
					foreach($products_details["attributes"] as $orders_products_attributes_id => $attributes_details)
					{
						$Query = "update " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
							products_options = '" . $attributes_details["option"] . "',
							products_options_values = '" . $attributes_details["value"] . "'
							where orders_products_attributes_id = '$orders_products_attributes_id';";
						$db -> Execute($Query);
					}
				}
			}
			else
			{
				// 0 Quantity = Delete
				$Query = "delete from " . TABLE_ORDERS_PRODUCTS . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
				$row = $db->fields;
					//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
				#$order = zen_db_fetch_array($order_query);
					if ($products_details["qty"] != $row->fields['products_quantity']){
						$differenza_quantita = ($products_details["qty"] - $row->fields['products_quantity']);
						$db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$row->fields['products_id'] . "'");
					}
					//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
				$Query = "delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
			}
         $order_query -> MoveNext();
		}

		// Shipping & More Tax
            $update_totals = $_POST['update_totals'];
			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");
				if($ot_class == "ot_shipping")
				{
					$RunningTax += (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
				}
				if($ot_class == "ot_custom")
				{
					$RunningTax += (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
				}
				if($ot_class == "ot_cod_fee")
				{
					$RunningTax += (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
				}
				if($ot_class == "ot_coupon")
				{
					$RunningTax -= (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
					$Abzuege += $ot_value;
				}
				if($ot_class == "ot_group_pricing")
				{
					$RunningTax -= (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
					$Abzuege += $ot_value;
				}
				if($ot_class == "ot_gv")
				{
					$RunningTax -= (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
					$Abzuege += $ot_value;
				}
				if($ot_class == "ot_quantity_discount")
				{
					$RunningTax -= (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
					$Abzuege += $ot_value;
				}
				if($ot_class == "ot_loworderfee")
				{
					$RunningTax += (($AddShippingTax * $ot_value) / (100 + $AddShippingTax));
				}
				$ShippingTax = $RunningTax;
			}

		// Update Totals

			$RunningTotal = 0;
			$sort_order = 0;

			// Do pre-check for Tax field existence
				$ot_tax_found = 0;
				foreach($update_totals as $total_details)
				{
					extract($total_details,EXTR_PREFIX_ALL,"ot");
					if($ot_class == "ot_tax")
					{
						$ot_tax_found = 1;
						break;
					}
				}

			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");

				if( trim(strtolower($ot_title)) == "tax" || trim(strtolower($ot_title)) == "tax:" )
				{
					if($ot_class != "ot_tax" && $ot_tax_found == 0)
					{
						// Inserting Tax
						$ot_class = "ot_tax";
						$ot_value = "x"; // This gets updated in the next step
						$ot_tax_found = 1;
					}
				}

				if( trim($ot_title) && trim($ot_value) )
				{
					$sort_order++;

					// Update ot_subtotal, ot_tax, and ot_total classes
						if($ot_class == "ot_subtotal")
						$ot_value = $RunningSubTotal;

						if($ot_class == "ot_tax")
						{
						$ot_value = $RunningTax;
						// echo "ot_value = $ot_value<br>\n";
						}

						if($ot_class == "ot_total")
						$ot_value = $RunningTotal - $RunningTax - (2 * $Abzuege);

					// Set $ot_text (display-formatted value)
						// $ot_text = "\$" . number_format($ot_value, 2, '.', ',');

						$order = new order($oID);
						$ot_text = $currencies->format($ot_value, true, $order->info['currency'], $order->info['currency_value']);

					if($ot_total_id > 0)
					{
						// In Database Already - Update
						$Query = "update " . TABLE_ORDERS_TOTAL . " set
							title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							sort_order = '$sort_order'
							where orders_total_id = '$ot_total_id'";
						$db -> Execute($Query);
					}
					else
					{

						// New Insert
						$Query = "insert into " . TABLE_ORDERS_TOTAL . " set
							orders_id = '$oID',
							title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							class = '$ot_class',
							sort_order = '$sort_order'";
						$db -> Execute($Query);
					}

					$RunningTotal += $ot_value;
				}
				elseif($ot_total_id > 0)
				{
					// Delete Total Piece
					$Query = "delete from " . TABLE_ORDERS_TOTAL . " where orders_total_id = '$ot_total_id'";
					$db -> Execute($Query);
				}

			}
		$Query = "update " . TABLE_ORDERS . " set
			order_total = '" . ($ot_value) . "'
			where orders_id = '" . zen_db_input($oID) . "'";
			$db -> Execute($Query);
		if ($order_updated)
		{
			$messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
		}

		zen_redirect(zen_href_link("edit_orders.php", zen_get_all_get_params(array('action')) . 'action=edit'));

	break;

	// Add a Product
	case 'add_product':
		if($step == 5)
		{
			// Get Order Info
			$oID = zen_db_prepare_input($_GET['oID']);
			$order = new order($oID);

			$AddedOptionsPrice = 0;

			// Get Product Attribute Info
			if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					$result = $db -> Execute("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id='$add_product_products_id' and options_id=$option_id and options_values_id=$option_value_id");
					###r.l. $row = zen_db_fetch_array($result);
					$row = $result->fields;
					extract($row, EXTR_PREFIX_ALL, "opt");
					$AddedOptionsPrice += $opt_options_values_price;
					$option_value_details[$option_id][$option_value_id] = array ("options_values_price" => $opt_options_values_price);
					$option_names[$option_id] = $opt_products_options_name;
					$option_values_names[$option_value_id] = $opt_products_options_values_name;
				}
			}

			// Get Product Info
			$InfoQuery = "select p.products_model,p.products_price,pd.products_name,p.products_tax_class_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id=p.products_id where p.products_id='$add_product_products_id'";
			$result = $db -> Execute($InfoQuery);
			#$row = zen_db_fetch_array($result);
			extract($result->fields, EXTR_PREFIX_ALL, "p");

			// Following functions are defined at the bottom of this file
			$CountryID = zen_get_country_id($order->delivery["country"]);
			$ZoneID = zen_get_zone_id($CountryID, $order->delivery["state"]);

			$ProductsTax = zen_get_tax_rate($p_products_tax_class_id, $CountryID, $ZoneID);

			$Query = "insert into " . TABLE_ORDERS_PRODUCTS . " set
				orders_id = $oID,
				products_id = $add_product_products_id,
				products_model = '$p_products_model',
				products_name = '" . str_replace("'", "&#39;", $p_products_name) . "',
				products_price = '$p_products_price',
				final_price = '" . ($p_products_price + $AddedOptionsPrice) . "',
				products_tax = '$ProductsTax',
				products_quantity = $add_product_quantity;";
			$db -> Execute($Query);
			$new_product_id = zen_db_insert_id();
			//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
			$db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $add_product_quantity . ", products_ordered = products_ordered + " . $add_product_quantity . " where products_id = '" . $add_product_products_id . "'");
			//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
			if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					$Query = "insert into " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
						orders_id = $oID,
						orders_products_id = $new_product_id,
						products_options = '" . $option_names[$option_id] . "',
						products_options_values = '" . $option_values_names[$option_value_id] . "',
						options_values_price = '" . $option_value_details[$option_id][$option_value_id]["options_values_price"] . "',
						price_prefix = '+';";
					$db -> Execute($Query);
				}
			}

			// Calculate Tax and Sub-Totals
			$order = new order($oID);
			$RunningSubTotal = 0;
			$RunningTax = 0;

			for ($i=0; $i<sizeof($order->products); $i++)
			{
			$RunningSubTotal += ($order->products[$i]['qty'] * $order->products[$i]['final_price'] * (100 + $order->products[$i]['tax']) / 100);
			$RunningTax += (($order->products[$i]['tax'] / 100) * ($order->products[$i]['qty'] * $order->products[$i]['final_price']) + $ShippingTax);
			}


			// Tax
			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '\$" . number_format($RunningTax, 2, '.', ',') . "',
				value = '" . $RunningTax . "'
				where class='ot_tax' and orders_id=$oID";
			$db -> Execute($Query);

			// Sub-Total
			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '\$" . number_format($RunningSubTotal, 2, '.', ',') . "',
				value = '" . $RunningSubTotal . "'
				where class='ot_subtotal' and orders_id=$oID";
			$db -> Execute($Query);

			// Total
			$Query = "select sum(value) as total_value from " . TABLE_ORDERS_TOTAL . " where class != 'ot_total' and orders_id=$oID";
			$result = $db -> Execute($Query);
			#$row = zen_db_fetch_array($result);
			$Total = ($result->fields["total_value"] - $RunningTax);

			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '<b>\$" . number_format($Total, 2, '.', ',') . "</b>',
				value = '" . $Total . "'
				where class='ot_total' and orders_id=$oID";
			$db -> Execute($Query);

			zen_redirect(zen_href_link("edit_orders.php", zen_get_all_get_params(array('action')) . 'action=edit'));

		}
	break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = zen_db_prepare_input($_GET['oID']);

    $orders_query = $db -> Execute("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!$orders_query->RecordCount()) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php #require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order($oID);
?>


      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?> #<?php echo $oID; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_RL_INVOICE, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_rl_invoice.gif', IMAGE_BACK) . '</a>'; ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>


<!-- Begin Addresses Block -->
      <tr><?php echo zen_draw_form('edit_order', "edit_orders.php", zen_get_all_get_params(array('action','paycc')) . 'action=update_order'); ?>
      <td>
      <table width="100%" border="0"><tr> <td><div align="center">
      <table width="548" border="0" align="center">
  <!--DWLayoutTable-->
  <tr>
    <td colspan="2" valign="top"><b> <?php echo ENTRY_CUSTOMER; ?> </b></td>
    <td width="6" rowspan="9" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="150" valign="top"><b> <?php echo ENTRY_BILLING_ADDRESS; ?></b></td>
    <td width="6" rowspan="9" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="150" valign="top"><span class="main"><b><?php echo ENTRY_SHIPPING_ADDRESS; ?></b></span></td>
    <td width="1">&nbsp;</td>
  </tr>
  <tr>
    <td width="60" valign="top"> <?php echo ENTRY_CUSTOMER_NAME; ?>:</td>
    <td width="150" valign="top"><span class="main">
      <input name="update_customer_name" size="25" value="<?php echo zen_html_quotes($order->customer['name']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_name" size="25" value="<?php echo zen_html_quotes($order->billing['name']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_name" size="25" value="<?php echo zen_html_quotes($order->delivery['name']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"> <?php echo ENTRY_CUSTOMER_COMPANY; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_company" size="25" value="<?php echo zen_html_quotes($order->customer['company']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_company" size="25" value="<?php echo zen_html_quotes($order->billing['company']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_company" size="25" value="<?php echo zen_html_quotes($order->delivery['company']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><?php echo ENTRY_CUSTOMER_ADDRESS; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_street_address" size="25" value="<?php echo zen_html_quotes($order->customer['street_address']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_street_address" size="25" value="<?php echo zen_html_quotes($order->billing['street_address']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_street_address" size="25" value="<?php echo zen_html_quotes($order->delivery['street_address']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><?php echo ENTRY_CUSTOMER_SUBURB; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_suburb" size="25" value="<?php echo zen_html_quotes($order->customer['suburb']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_suburb" size="25" value="<?php echo zen_html_quotes($order->billing['suburb']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_suburb" size="25" value="<?php echo zen_html_quotes($order->delivery['suburb']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><?php echo ENTRY_CUSTOMER_CITY; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_city" size="25" value="<?php echo zen_html_quotes($order->customer['city']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_city" size="25" value="<?php echo zen_html_quotes($order->billing['city']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_city" size="25" value="<?php echo zen_html_quotes($order->delivery['city']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><?php echo ENTRY_CUSTOMER_STATE; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_state" size="25" value="<?php echo zen_html_quotes($order->customer['state']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_state" size="25" value="<?php echo zen_html_quotes($order->billing['state']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_state" size="25" value="<?php echo zen_html_quotes($order->delivery['state']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"> <?php echo ENTRY_CUSTOMER_POSTCODE; ?>:</td>
    <td valign="top"><span class="main">
      <input name="update_customer_postcode" size="25" value="<?php echo $order->customer['postcode']; ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_postcode" size="25" value="<?php echo $order->billing['postcode']; ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_postcode" size="25" value="<?php echo $order->delivery['postcode']; ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"> <?php echo ENTRY_CUSTOMER_COUNTRY; ?></td>
    <td valign="top"><span class="main">
      <input name="update_customer_country" size="25" value="<?php echo zen_html_quotes($order->customer['country']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_billing_country" size="25" value="<?php echo zen_html_quotes($order->billing['country']); ?>">
    </span></td>
    <td valign="top"><span class="main">
      <input name="update_delivery_country" size="25" value="<?php echo zen_html_quotes($order->delivery['country']); ?>">
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</div></td></tr></table>
<!-- End Addresses Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Phone/Email Block -->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
      		<tr>
      		  <td class="main"><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b></td>
      		  <td class="main"><input name='update_customer_telephone' size='15' value='<?php echo $order->customer['telephone']; ?>'></td>
      		</tr>
      		<tr>
      		  <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
      		  <td class="main"><input name='update_customer_email_address' size='35' value='<?php echo $order->customer['email_address']; ?>'></td>
      		</tr>
      	</table></td>
      </tr>
      </td>
      </tr>
<!-- End Phone/Email Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Payment Block -->
      <tr>
	<td><table border="0" cellspacing="0" cellpadding="2">
	  <tr>
	    <td class="main"><b><?php echo ENTRY_PAYMENT_METHOD; ?></b></td>
	    <td class="main"><input name='update_info_payment_method' size='20' value='<?php echo $order->info['payment_method']; ?>'>
	    <?php
	    if($order->info['payment_method'] != "Credit Card")
	    echo ENTRY_UPDATE_TO_CC;
	    ?></td>
	  </tr>

	<?php if ($order->info['cc_type'] || $order->info['cc_owner'] || $order->info['payment_method'] == "Credit Card" || $order->info['cc_number']) { ?>
	  <!-- Begin Credit Card Info Block -->
	  <tr>
	    <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
	    <td class="main"><input name='update_info_cc_type' size='10' value='<?php echo $order->info['cc_type']; ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
	    <td class="main"><input name='update_info_cc_owner' size='20' value='<?php echo $order->info['cc_owner']; ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
	    <td class="main"><input name='update_info_cc_number' size='20' value='<?php echo $order->info['cc_number']; ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
	    <td class="main"><input name='update_info_cc_expires' size='4' value='<?php echo $order->info['cc_expires']; ?>'></td>
	  </tr>
	  <!-- End Credit Card Info Block -->
	<?php } ?>
	
	<?php
        if( (zen_not_null($order->info['account_name']) || zen_not_null($order->info['account_number']) || zen_not_null($order->info['po_number'])) ) {
		?>
		          <tr>
		            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_ACCOUNT_NAME; ?></td>
		            <td class="main"><?php echo $order->info['account_name']; ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_ACCOUNT_NUMBER; ?></td>
		            <td class="main"><?php echo $order->info['account_number']; ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_PURCHASE_ORDER_NUMBER; ?></td>
		            <td class="main"><?php echo $order->info['po_number']; ?></td>
		          </tr>
		<?php
		// purchaseorder end
		    }
?>

	</table></td>
      </tr>
<!-- End Payment Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Products Listing Block -->
      <tr>
	<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr class="dataTableHeadingRow">
	    <td class="dataTableHeadingContent" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
	    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
	    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TAX; ?></td>
	    <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_UNIT_PRICE; ?></td>
	    <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_PRICE; ?></td>
	  </tr>

	<!-- Begin Products Listings Block -->
	<?
      	// Override order.php Class's Field Limitations
		$index = 0;
		$order->products = array();
		$orders_products_query = $db -> Execute("select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$oID . "'");
		#while ($orders_products = zen_db_fetch_array($orders_products_query)) {
      while (!$orders_products_query -> EOF){
		$order->products[$index] = array('qty' => $orders_products_query->fields['products_quantity'],
                                        'name' => str_replace("'", "&#39;", $orders_products_query->fields['products_name']),
                                        'model' => $orders_products_query->fields['products_model'],
                                        'tax' => $orders_products_query->fields['products_tax'],
                                        'price' => $orders_products_query->fields['products_price'],
                                        //'final_price' => $orders_products_query->fields['final_price'],
					'final_price' => $orders_products_query->fields['final_price'] + $orders_products_query->fields['final_price'] * $orders_products_query->fields['products_tax'] / 100,
                                        'orders_products_id' => $orders_products_query->fields['orders_products_id']);

		$subindex = 0;
		$attributes_query_string = "select * from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$oID . "' and orders_products_id = '" . (int)$orders_products_query->fields['orders_products_id'] . "'";
		$attributes_query = $db -> Execute($attributes_query_string);

		#while ($attributes = zen_db_fetch_array($attributes_query)) {
      while (!$attributes_query -> EOF){
		  $order->products[$index]['attributes'][$subindex] = array('option' => $attributes_query->fields['products_options'],
		                                                           'value' => $attributes_query->fields['products_options_values'],
		                                                           'prefix' => $attributes_query->fields['price_prefix'],
		                                                           'price' => $attributes_query->fields['options_values_price'],
		                                                           'orders_products_attributes_id' => $attributes_query->fields['orders_products_attributes_id']);
		$subindex++;
      $attributes_query -> MoveNext();
		}
		$index++;
      $orders_products_query -> MoveNext();

		}

	for ($i=0; $i<sizeof($order->products); $i++) {
		$orders_products_id = $order->products[$i]['orders_products_id'];

		$RowStyle = "dataTableContent";

		echo '	  <tr class="dataTableRow">' . "\n" .
		   '	    <td class="' . $RowStyle . '" valign="top" align="right">' . "<input name='update_products[$orders_products_id][qty]' size='2' value='" . $order->products[$i]['qty'] . "'>&nbsp;x</td>\n" .
		   '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][name]' size='25' value='" . $order->products[$i]['name'] . "'>";

		// Has Attributes?
		if (sizeof($order->products[$i]['attributes']) > 0) {
			for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) {
				$orders_products_attributes_id = $order->products[$i]['attributes'][$j]['orders_products_attributes_id'];
				echo '<br><nobr><small>&nbsp;<i> - ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][option]' size='10' value='" . $order->products[$i]['attributes'][$j]['option'] . "'>" . ': ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][value]' size='10' value='" . $order->products[$i]['attributes'][$j]['value'] . "'>";
				echo '</i></small></nobr>';
			}
		}

		echo '	    </td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][model]' size='12' value='" . $order->products[$i]['model'] . "'>" . '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="center" valign="top">' . "<input name='update_products[$orders_products_id][tax]' size='3' value='" . zen_display_tax_value($order->products[$i]['tax']) . "'>" . '%</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][final_price]' size='5' value='" . number_format($order->products[$i]['final_price'], 2, '.', '') . "'>" . '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</td>' . "\n" .
		     '	  </tr>' . "\n";
	}
	?>
	<!-- End Products Listings Block -->

	<!-- Begin Order Total Block -->
	  <tr>
	    <td align="right" colspan="6">
	    	<table border="0" cellspacing="0" cellpadding="2" width="100%">
	    	<tr>
	    	<td align='center' valign='top'><br><a href="<? echo $PHP_SELF . "?oID=$oID&action=add_product&step=1"; ?>"><u><b><font size='3'><?php echo TEXT_DATE_ORDER_ADDNEW; ?> </font></b></u></a></td>
	    	<td align='right'>
	    	<table border="0" cellspacing="0" cellpadding="2">
<?php

      	// Override order.php Class's Field Limitations
		$totals_query = $db -> Execute("select * from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$oID . "' order by sort_order");
		$order->totals = array();
		#while ($totals = zen_db_fetch_array($totals_query)) {
      while (!$totals_query -> EOF){
         $order->totals[] = array('title' => $totals_query->fields['title'], 'text' => $totals_query->fields['text'], 'class' => $totals_query->fields['class'], 'value' => $totals_query->fields['value'], 'orders_total_id' => $totals_query->fields['orders_total_id']);
         $totals_query -> MoveNext();
         }

	$TotalsArray = array();
	for ($i=0; $i<sizeof($order->totals); $i++) {
		$TotalsArray[] = array("Name" => $order->totals[$i]['title'], "Price" => number_format($order->totals[$i]['value'], 2, '.', ''), "Class" => $order->totals[$i]['class'], "TotalID" => $order->totals[$i]['orders_total_id']);
		$TotalsArray[] = array("Name" => "          ", "Price" => "", "Class" => "ot_custom", "TotalID" => "0");
	}

	array_pop($TotalsArray);
	foreach($TotalsArray as $TotalIndex => $TotalDetails)
	{
		$TotalStyle = "smallText";
		if(($TotalDetails["Class"] == "ot_subtotal") || ($TotalDetails["Class"] == "ot_total"))
		{
			echo	'	      <tr>' . "\n" .
				'		<td class="main" align="right"><b>' . $TotalDetails["Name"] . '</b></td>' .
				'		<td class="main"><b>' . $TotalDetails["Price"] .
						"<input name='update_totals[$TotalIndex][title]' type='hidden' value='" . trim($TotalDetails["Name"]) . "' size='" . strlen($TotalDetails["Name"]) . "' >" .
						"<input name='update_totals[$TotalIndex][value]' type='hidden' value='" . $TotalDetails["Price"] . "' size='6' >" .
						"<input name='update_totals[$TotalIndex][class]' type='hidden' value='" . $TotalDetails["Class"] . "'>\n" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . '</b></td>' .
				'	      </tr>' . "\n";
		}
		elseif($TotalDetails["Class"] == "ot_tax")
		{
			echo	'	      <tr>' . "\n" .
				'		<td align="right" class="' . $TotalStyle . '">' . "<input name='update_totals[$TotalIndex][title]' size='" . strlen(trim($TotalDetails["Name"])) . "' value='" . trim($TotalDetails["Name"]) . "'>" . '</td>' . "\n" .
				'		<td class="main"><b>' . $TotalDetails["Price"] .
						"<input name='update_totals[$TotalIndex][value]' type='hidden' value='" . $TotalDetails["Price"] . "' size='6' >" .
						"<input name='update_totals[$TotalIndex][class]' type='hidden' value='" . $TotalDetails["Class"] . "'>\n" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . '</b></td>' .
				'	      </tr>' . "\n";
		}
		else
		{
			echo	'	      <tr>' . "\n" .
				'		<td align="right" class="' . $TotalStyle . '">' . "<input name='update_totals[$TotalIndex][title]' size='" . strlen(trim($TotalDetails["Name"])) . "' value='" . trim($TotalDetails["Name"]) . "'>" . '</td>' . "\n" .
				'		<td align="right" class="' . $TotalStyle . '">' . "<input name='update_totals[$TotalIndex][value]' size='6' value='" . $TotalDetails["Price"] . "'>" .
						"<input type='hidden' name='update_totals[$TotalIndex][class]' value='" . $TotalDetails["Class"] . "'>" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" .
						'</td>' . "\n" .
				'	      </tr>' . "\n";
		}
	}
?>
	    	</table>
	    	</td>
	    	</tr>
	    	</table>
	    </td>
	  </tr>
	<!-- End Order Total Block -->

	</table></td>
      </tr>

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

      <tr>
        <td class="main"><table border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_DATE_ADDED; ?></b></td>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></b></td>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_STATUS; ?></b></td>
            <? if($CommentsWithStatus) { ?>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
            <? } ?>
          </tr>
<?php
    $orders_history_query = $db -> Execute("select * from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . zen_db_input($oID) . "' order by date_added");
    if ($orders_history_query->RecordCount()) {
      #while ($orders_history = zen_db_fetch_array($orders_history_query)) {
      while (!$orders_history_query -> EOF){
        echo '          <tr>' . "\n" .
             '            <td class="smallText" align="center">' . zen_datetime_short($orders_history_query->fields['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history_query->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history_query->fields['orders_status_id']] . '</td>' . "\n";

        if($CommentsWithStatus) {
        echo '            <td class="smallText">' . nl2br(zen_db_output($orders_history_query->fields['comments'])) . '&nbsp;</td>' . "\n";
        }

        echo '          </tr>' . "\n";
        $orders_history_query -> MoveNext();
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>

      <tr>
        <td class="main"><br><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td class="main">
        <?
        if($CommentsWithStatus) {
        	echo zen_draw_textarea_field('comments', 'soft', '60', '5');
	}
	else
	{
		echo zen_draw_textarea_field('comments', 'soft', '60', '5', $order->info['comments']);
	}
	?>
        </td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo ENTRY_STATUS; ?></b> <?php echo zen_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']) . '  (Immer zuerst AKTUALISIEREN, dann den Status &auml;ndern!)'; ?></td>
          </tr>
          <tr>
            <td class="main"><b><?php echo ENTRY_NOTIFY_CUSTOMER_STANDARD; ?></b> <?php echo zen_draw_checkbox_field('notify', '', true); ?></td>
          <tr>
            <td class="main"><b><?php echo ENTRY_NOTIFY_CUSTOMER_INVOICE; ?></b> <?php echo zen_draw_checkbox_field('newinvoice', '', false); ?></td>
          </tr>
          <? if($CommentsWithStatus) { ?>
          <tr>
                <td class="main"><b><?php echo ENTRY_NOTIFY_COMMENTS; ?></b> <?php echo zen_draw_checkbox_field('notify_comments', '', true); ?></td>
          </tr>
          <? } ?>
        </table></td>
      </tr>

      <tr>
	<td align='center' valign="top"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
      </tr>
      </form>
<?php
  }

if($action == "add_product")
{
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo ADDING_TITLE; ?> #<?php echo $oID; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . zen_href_link(edit_orders, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>

<?
	// ############################################################################
	//   Get List of All Products
	// ############################################################################

		//$result = zen_db_query("SELECT products_name, p.products_id, x.categories_name, ptc.categories_id FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id=p.products_id LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc ON ptc.products_id=p.products_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id=ptc.categories_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " x ON x.categories_id=ptc.categories_id ORDER BY categories_id");
		$result = $db -> Execute("SELECT products_name, p.products_id, categories_name, ptc.categories_id FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id=p.products_id LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc ON ptc.products_id=p.products_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id=ptc.categories_id ORDER BY categories_name");
		#hile($row = zen_db_fetch_array($result)) 		{
      while (!$result -> EOF){
 		   extract($result->fields,EXTR_PREFIX_ALL,"db");
			$ProductList[$db_categories_id][$db_products_id] = $db_products_name;
			$CategoryList[$db_categories_id] = $db_categories_name;
			$LastCategory = $db_categories_name;
         $result -> MoveNext();
		}

		// ksort($ProductList);

		$LastOptionTag = "";
		$ProductSelectOptions = "<option value='0'>Don't Add New Product" . $LastOptionTag . "\n";
		$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
		foreach($ProductList as $Category => $Products)
		{
			$ProductSelectOptions .= "<option value='0'>$Category" . $LastOptionTag . "\n";
			$ProductSelectOptions .= "<option value='0'>---------------------------" . $LastOptionTag . "\n";
			asort($Products);
			foreach($Products as $Product_ID => $Product_Name)
			{
				$ProductSelectOptions .= "<option value='$Product_ID'> &nbsp; $Product_Name" . $LastOptionTag . "\n";
			}

			if($Category != $LastCategory)
			{
				$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
				$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
			}
		}


	// ############################################################################
	//   Add Products Steps
	// ############################################################################

		echo "<tr><td><table border='0'>\n";

		// Set Defaults
			if(!IsSet($add_product_categories_id))
			$add_product_categories_id = 0;

			if(!IsSet($add_product_products_id))
			$add_product_products_id = 0;

		// Step 1: Choose Category
			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
			echo "<td class='dataTableContent' align='right'><b>STEP 1:</b></td><td class='dataTableContent' valign='top'>";
			echo ' ' . zen_draw_pull_down_menu('add_product_categories_id', zen_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
			echo "<input type='hidden' name='step' value='2'>";
			echo "</td>\n";
			echo "</form></tr>\n";
			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";

		// Step 2: Choose Product
		if(($step > 1) && ($add_product_categories_id > 0))
		{
			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
			echo "<td class='dataTableContent' align='right'><b>STEP 2:</b></td><td class='dataTableContent' valign='top'><select name=\"add_product_products_id\" onChange=\"this.form.submit();\">";
			$ProductOptions = "<option value='0'>" .  ADDPRODUCT_TEXT_SELECT_PRODUCT . "\n";
			asort($ProductList[$add_product_categories_id]);
			foreach($ProductList[$add_product_categories_id] as $ProductID => $ProductName)
			{
			$ProductOptions .= "<option value='$ProductID'> $ProductName\n";
			}
			$ProductOptions = str_replace("value='$add_product_products_id'","value='$add_product_products_id' selected", $ProductOptions);
			echo $ProductOptions;
			echo "</select></td>\n";
			echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
			echo "<input type='hidden' name='step' value='3'>";
			echo "</form></tr>\n";
			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";
		}

		// Step 3: Choose Options
		if(($step > 2) && ($add_product_products_id > 0))
		{
			// Get Options for Products
			$result = $db -> Execute("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id='$add_product_products_id'");

			// Skip to Step 4 if no Options
			if($result->RecordCount() == 0)
			{
				echo "<tr class=\"dataTableRow\">\n";
				echo "<td class='dataTableContent' align='right'><b>STEP 3:</b></td><td class='dataTableContent' valign='top' colspan='2'><i>No Options - Skipped...</i></td>";
				echo "</tr>\n";
				$step = 4;
			}
			else
			{
#				while($row = zen_db_fetch_array($result))  {
            while (!$result -> EOF){
 					extract($result->fields,EXTR_PREFIX_ALL,"db");
					$Options[$db_products_options_id] = $db_products_options_name;
					$ProductOptionValues[$db_products_options_id][$db_products_options_values_id] = $db_products_options_values_name;
               $result -> MoveNext();
				}

				echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
				echo "<td class='dataTableContent' align='right'><b>STEP 3:</b></td><td class='dataTableContent' valign='top'>";
				foreach($ProductOptionValues as $OptionID => $OptionValues)
				{
					$OptionOption = "<b>" . $Options[$OptionID] . "</b> - <select name='add_product_options[$OptionID]'>";
					foreach($OptionValues as $OptionValueID => $OptionValueName)
					{
					$OptionOption .= "<option value='$OptionValueID'> $OptionValueName\n";
					}
					$OptionOption .= "</select><br>\n";

					if(IsSet($add_product_options))
					$OptionOption = str_replace("value='" . $add_product_options[$OptionID] . "'","value='" . $add_product_options[$OptionID] . "' selected",$OptionOption);

					echo $OptionOption;
				}
				echo "</td>";
				echo "<td class='dataTableContent' align='center'><input type='submit' value='" . ADDPRODUCT_TEXT_OPTIONS_CONFIRM . "'>";
				echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
				echo "<input type='hidden' name='add_product_products_id' value='$add_product_products_id'>";
				echo "<input type='hidden' name='step' value='4'>";
				echo "</td>\n";
				echo "</form></tr>\n";
			}

			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";
		}

		// Step 4: Confirm
		if($step > 3)
		{
			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
			echo "<td class='dataTableContent' align='right'><b>STEP 4:</b></td>";
			echo "<td class='dataTableContent' valign='top'><input name='add_product_quantity' size='2' value='1'>" . ADDPRODUCT_TEXT_CONFIRM_QUANTITY . "</td>";
			echo "<td class='dataTableContent' align='center'><input type='submit' value='" . ADDPRODUCT_TEXT_CONFIRM_ADDNOW . "'>";

			if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					echo "<input type='hidden' name='add_product_options[$option_id]' value='$option_value_id'>";
				}
			}
			echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
			echo "<input type='hidden' name='add_product_products_id' value='$add_product_products_id'>";
			echo "<input type='hidden' name='step' value='5'>";
			echo "</td>\n";
			echo "</form></tr>\n";
		}

		echo "</table></td></tr>\n";
}
?>
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
<?
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>