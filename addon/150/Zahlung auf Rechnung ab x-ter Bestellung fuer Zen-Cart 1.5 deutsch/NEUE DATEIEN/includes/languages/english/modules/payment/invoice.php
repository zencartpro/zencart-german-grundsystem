<?php
/**
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
*/
//Berechnung Zahlungsziel
$tstamp = mktime(0, 0, 0, date("m"), date("d") + MODULE_PAYMENT_INVOICE_PAYDAY, date("Y"));
$tag = date("d.m.Y", $tstamp);
//Ende
define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Invoice (payable up to'. $tag . ')');
define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');
define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 
"Please transfer the amount after receipt of the goods under indication of the order number to:\n" .
"\nBank Name:  " . MODULE_PAYMENT_INVOICE_BANKNAM .
"\nAccount Holder: " . MODULE_PAYMENT_INVOICE_ACCNAM . 
"\nAccount Number:   " . MODULE_PAYMENT_INVOICE_ACCNUM . 
"\nBank Code:    " . MODULE_PAYMENT_INVOICE_BLZ .
"\nIBAN:    " . MODULE_PAYMENT_INVOICE_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_INVOICE_BANKBIC . 
"\n\nThank you.");