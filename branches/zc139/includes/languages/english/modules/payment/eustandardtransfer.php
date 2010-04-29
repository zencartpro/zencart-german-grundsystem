<?php
/**
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: eustandardtransfer.php with zone option 571 2010-04-29 08:36:14 webchills $
*/
define('MODULE_PAYMENT_EUTRANSFER_TEXT_TITLE', 'Moneyorder');

define('MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION', 
'Please use the following details to transfer your total order value:<br />' .
'<br />Bank name:  ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKNAM) .
'<br />Account Name: ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCNAM) . 
'<br />Account No:   ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCNUM) . 
'<br />IBAN:    ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCIBAN) .
'<br />BIC/SWIFT:   ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKBIC) .
'<br/>Your order will be processed as soon as we received the payment.');
   
define('MODULE_PAYMENT_EUTRANSFER_TEXT_EMAIL_FOOTER', 
"Please use the following details to transfer your total order value:\n" .
"\nBank name:  " . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
"\nAccount Name: " . MODULE_PAYMENT_EUTRANSFER_ACCNAM . 
"\nAccount No:   " . MODULE_PAYMENT_EUTRANSFER_ACCNUM . 
"\nIBAN:    " . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_EUTRANSFER_BANKBIC . 
"\n\nYour order will be processed as soon as we received the payment.");