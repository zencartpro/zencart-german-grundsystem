<?php
/**
 * @package payment - billpay
 * @copyright Copyright 2010 Billpay GmbH
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com  http://edv.langheiter.com
 * zahlungs.....(BillPay-text)
 * 
 * @version $Id$
 */

 if($order->info['payment_module_code'] == 'billpay')   // r.l. 
 {
 	require_once(DIR_FS_CATALOG . 'includes/languages/' . $_SESSION['language'] . '/modules/payment/billpay.php');

 	$res =  $db->Execute(' SELECT account_holder, account_number, bank_code, bank_name, invoice_reference, invoice_due_date '.
									  ' FROM billpay_bankdata WHERE orders_id = '.$_GET["oID"]);
	
    
    while (!$res->EOF){
        $bank_data = $res->fields;
        echo '<table><tr><td>';
        $dat = $bank_data[invoice_due_date];
        $year = substr($dat,0,-4);
        $mon = substr($dat,4,-2);
        $day = substr($dat,6,2);
        $bank_data_string .= MODULE_PAYMENT_BILLPAY_TEXT_INVOICE_INFO1;
        $bank_data_string .= $day.".".$mon.".".$year;
        $bank_data_string .= MODULE_PAYMENT_BILLPAY_TEXT_INVOICE_INFO2.'<br/>';
        $bank_data_string .= '<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_TEXT_ACCOUNT_HOLDER .':</strong>&nbsp;' . $bank_data[account_holder].'<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_TEXT_ACCOUNT_NUMBER .':</strong>&nbsp;' . $bank_data[account_number].'<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_TEXT_BANK_CODE .':</strong>&nbsp;' . $bank_data[bank_code].'<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_TEXT_BANK_NAME .':</strong>&nbsp;' . $bank_data[bank_name].'<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_TEXT_PURPOSE .':</strong>&nbsp;' . $bank_data[invoice_reference].'<br/>';
        $bank_data_string .= '<strong>'.MODULE_PAYMENT_BILLPAY_DUEDATE_TITLE .':</strong>&nbsp;' . $day.".".$mon.".".$year . '<br/>';
        echo $bank_data_string;
        echo '</td></tr></table>';
        $res->MoveNext();
    }
 }
