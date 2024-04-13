<?php
/**
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: eustandardtransfer.php 2024-04-13 16:49:14 webchills $
*/

// do not remove the following lines
if (IS_ADMIN_FLAG === true) {
if (!defined('MODULE_PAYMENT_EUTRANSFER_BANKNAM')) define('MODULE_PAYMENT_EUTRANSFER_BANKNAM', '');
if (!defined('MODULE_PAYMENT_EUTRANSFER_ACCNAM')) define('MODULE_PAYMENT_EUTRANSFER_ACCNAM', '');
if (!defined('MODULE_PAYMENT_EUTRANSFER_ACCIBAN')) define('MODULE_PAYMENT_EUTRANSFER_ACCIBAN', '');
if (!defined('MODULE_PAYMENT_EUTRANSFER_BANKBIC')) define('MODULE_PAYMENT_EUTRANSFER_BANKBIC', '');
}

define('MODULE_PAYMENT_EUTRANSFER_TEXT_TITLE', 'Vorkasse/Banküberweisung');

define('MODULE_PAYMENT_EUTRANSFER_TEXT_DESCRIPTION', 
'<div class="eustandardtransferdescription">Bitte verwenden Sie folgende Daten für die Überweisung des Gesamtbetrages:' .
'<br>Name der Bank:  ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKNAM) .
'<br>Kontoinhaber: ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCNAM) . 
'<br>IBAN:    ' . nl2br(MODULE_PAYMENT_EUTRANSFER_ACCIBAN) .
'<br>BIC/SWIFT:   ' . nl2br(MODULE_PAYMENT_EUTRANSFER_BANKBIC) .
'<br>Ihre Bestellung wird erst bearbeitet, sobald der Betrag auf unserem Konto eingegangen ist.</div>');

define('MODULE_PAYMENT_EUTRANSFER_TEXT_EMAIL_FOOTER', 
"Bitte verwenden Sie folgende Daten für die Überweisung des Gesamtbetrages:\n" .
"\nName der Bank:  " . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
"\nKontoinhaber: " . MODULE_PAYMENT_EUTRANSFER_ACCNAM . 
"\nIBAN:    " . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_EUTRANSFER_BANKBIC . 
"\n\nIhre Bestellung wird erst bearbeitet, sobald der Betrag auf unserem Konto eingegangen ist.");