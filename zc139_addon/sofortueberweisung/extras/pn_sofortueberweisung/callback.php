<?php
/**
 * @version sofortüberweisung.de 2.0.1 - $Date$
 * @author Payment Network AG (integration@payment-network.com)
 * @link http://www.payment-network.com/
 *
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307
 * USA
 *
 ***********************************************************************************
 * this file contains code based on:
 * (c) 2000 - 2001 The Exchange Project
 * (c) 2001 - 2003 osCommerce, Open Source E-Commerce Solutions
 * (c) 2003 - 2006 Zend-Cart
 * Released under the GNU General Public License
 ***********************************************************************************
 *
 * $Id$
 *
 */

chdir('../../');
require ('includes/application_top.php');
require(DIR_WS_MODULES.'payment/pn/classPnSofortueberweisung.php');


define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_ORDER_NOT_FOUND', 'Error (SU102): Order %s not found' . "\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_WRONG_TOTALS', "Error (SU203): Totals do not match.\n(%s != %s)\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_UNEXPECTED_STATUS', 'Error (SU204): Order status is not temporary' . "\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_TRANSACTION', "Error during HTTP notification\nPlease check transaction and notification\nTransaction-ID: %s\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_TERMINATED', "\n" . 'Script terminated' . "\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SUCCESS_TRANSACTION', "Payment successful\nTransaction-ID: %s\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SUCCESS_CALLBACK', 'Success (SU000): Order status successfully updated' . "\n");
define('MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_WARNING_CALLBACK', 'Warning (SU001): Error discovered, but order status updated' . "\n");

//we use the notification password for responses
$password = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_NOTIFICATION_PASSWORD;
if(empty($password)) //not upgraded yet
	$password = MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_PROJECT_PASSWORD;

$objSu = new classPnSofortueberweisung($password, MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_HASH_ALGORITHM);

$data = $objSu->getNotification();

//notification corrupted?
if(!is_array($data)) {
	header("x-status: ".$data);
	print_r($_POST); 	
	echo $data;
	exit(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_TERMINATED);
}

$x_order_id = $data['user_variable_0'];
$x_customer_id = $data['user_variable_1'];

$order_query = ("select orders_status, currency from " . TABLE_ORDERS . " where orders_id = '" . (int) $x_order_id . "' and customers_id = '" . (int) $x_customer_id . "'");
if ($order = $db->Execute($order_query)) {

	if ($order->fields['orders_status'] == MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_TMP_STATUS_ID) {

		$total_query = ("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" .  (int)$x_order_id . "' and class = 'ot_total' limit 1");
		$total = $db->Execute($total_query);

		$order_total = number_format($total->fields['value'] * $currencies->get_value($order->fields['currency']), 2, '.','');

		//amount paid and total of order need to match
		if ($data['amount'] == $order_total) {
			$order_status = (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ORDER_STATUS_ID : (int) DEFAULT_ORDERS_STATUS_ID);
			$comment = sprintf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SUCCESS_TRANSACTION, $data['transaction']);
			echo MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_SUCCESS_CALLBACK;
		} else {
			printf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_WRONG_TOTALS, $data['amount'], $order_total);
			$order_status = (MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID > 0 ? (int)MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_UNC_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID);
			$comment = sprintf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_TRANSACTION, $data['transaction']);
			echo MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_WARNING_CALLBACK;
		}

		//update status
		$sql_data_array = array('orders_id' => (int)$x_order_id,
				      'orders_status_id' => $order_status,
				      'date_added' => 'now()',
				      'customer_notified' => '0',
				      'comments' => $comment);

		zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
		$db->Execute("update " . TABLE_ORDERS . " set orders_status = '" . $order_status . "', last_modified = now() where orders_id = '" . (int)$x_order_id . "'");

	} else {
		echo MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_UNEXPECTED_STATUS;
	}
} else {
	print_r($_POST); 
	printf(MODULE_PAYMENT_PN_SOFORTUEBERWEISUNG_ERROR_ORDER_NOT_FOUND, $x_order_id);
}
?>