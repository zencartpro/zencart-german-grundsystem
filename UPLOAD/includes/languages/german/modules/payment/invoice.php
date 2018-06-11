<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: invoice.php 295 2018-04-10 12:55:14Z webchills $
 */
 
//Berechnung Zahlungsziel
if (MODULE_PAYMENT_INVOICE_STATUS === 'True'){
$tstamp = mktime(0, 0, 0, date('m'), date('d') + MODULE_PAYMENT_INVOICE_PAYDAY, date('Y'));
$tag = date('d.m.Y', $tstamp);
}
//Ende
define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Rechnung (zahlbar bis zum '. $tag . ')');
define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');

define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 
"Bitte verwenden Sie folgende Daten für die Überweisung des Gesamtbetrages:\n" .
"\nName der Bank:  " . MODULE_PAYMENT_INVOICE_BANKNAM .
"\nKontoinhaber: " . MODULE_PAYMENT_INVOICE_ACCNAM . 
"\nIBAN:    " . MODULE_PAYMENT_INVOICE_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_INVOICE_BANKBIC . 
"\n");