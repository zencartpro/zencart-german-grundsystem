<?php
//Berechnung Zahlungsziel
$tstamp = mktime(0, 0, 0, date("m"), date("d") + MODULE_PAYMENT_INVOICE_PAYDAY, date("Y"));
$tag = date("d.m.Y", $tstamp);
//Ende
define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Invoice (payable up to '. $tag . ')');
define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');
define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 
"Please use the following details to transfer your total order value:\n" .
"\nBank Name:  " . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
"\nAccount Holder: " . MODULE_PAYMENT_EUTRANSFER_ACCNAM . 
"\nAccount Number:   " . MODULE_PAYMENT_EUTRANSFER_ACCNUM . 
"\nBank Code:    " . MODULE_PAYMENT_EUTRANSFER_BLZ .
"\nIBAN:    " . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_EUTRANSFER_BANKBIC . 
"\n");