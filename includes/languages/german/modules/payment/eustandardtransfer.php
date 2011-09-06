<?php
/**
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: eustandardtransfer.php 572 2011-09-06 17:36:14 webchills $
*/
define('MODULE_PAYMENT_EUTRANSFER_TEXT_TITLE', 'Vorkasse/Banküberweisung');

define('MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION', 
'Bitte verwenden Sie folgende Daten für die Überweisung des Gesamtbetrages:' .
'<br />Name der Bank:  ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKNAM) .
'<br />Kontoinhaber: ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCNAM) . 
'<br />Kontonummer:   ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCNUM) . 
'<br />Bankleitzahl:    ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BLZ) .
'<br />IBAN:    ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCIBAN) .
'<br />BIC/SWIFT:   ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKBIC) .
'<br/>Ihre Bestellung wird erst bearbeitet, sobald der Betrag auf unserem Konto eingegangen ist.');

define('MODULE_PAYMENT_EUTRANSFER_TEXT_EMAIL_FOOTER', 
"Bitte verwenden Sie folgende Daten für die Überweisung des Gesamtbetrages:\n" .
"\nName der Bank:  " . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
"\nKontoinhaber: " . MODULE_PAYMENT_EUTRANSFER_ACCNAM . 
"\nKontonummer:   " . MODULE_PAYMENT_EUTRANSFER_ACCNUM . 
"\nBankleitzahl:    " . MODULE_PAYMENT_EUTRANSFER_BLZ .
"\nIBAN:    " . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_EUTRANSFER_BANKBIC . 
"\n\nIhre Bestellung wird erst bearbeitet, sobald der Betrag auf unserem Konto eingegangen ist.");