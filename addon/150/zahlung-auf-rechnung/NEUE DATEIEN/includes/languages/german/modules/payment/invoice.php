<?php
/**
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: invoice.php 2011-09-04 13:36:14 webchills $
*/
//Berechnung Zahlungsziel
$tstamp = mktime(0, 0, 0, date("m"), date("d") + MODULE_PAYMENT_INVOICE_PAYDAY, date("Y"));
$tag = date("d.m.Y", $tstamp);
//Ende
define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Rechnung (zahlbar bis zum '. $tag . ')');
define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');
define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 
"Bitte überweisen Sie den Betrag nach Erhalt der Ware unter Angabe der Bestellnummer auf unser Konto:\n" .
"\nName der Bank:  " . MODULE_PAYMENT_INVOICE_BANKNAM .
"\nKontoinhaber: " . MODULE_PAYMENT_INVOICE_ACCNAM . 
"\nKontonummer:   " . MODULE_PAYMENT_INVOICE_ACCNUM . 
"\nBankleitzahl:    " . MODULE_PAYMENT_INVOICE_BLZ .
"\nIBAN:    " . MODULE_PAYMENT_INVOICE_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_INVOICE_BANKBIC . 
"\n\nVielen Dank.");