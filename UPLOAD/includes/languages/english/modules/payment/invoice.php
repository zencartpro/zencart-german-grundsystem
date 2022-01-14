<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0 
 * @version $Id: invoice.php 2019-06-22 10:16:14Z webchills $
 */

if (IS_ADMIN_FLAG === true) {
if (!defined('MODULE_PAYMENT_INVOICE_STATUS')) define('MODULE_PAYMENT_INVOICE_STATUS', 'False');
if (!defined('MODULE_PAYMENT_INVOICE_BANKNAM')) define('MODULE_PAYMENT_INVOICE_BANKNAM', '');
if (!defined('MODULE_PAYMENT_INVOICE_ACCNAM')) define('MODULE_PAYMENT_INVOICE_ACCNAM', '');
if (!defined('MODULE_PAYMENT_INVOICE_ACCIBAN')) define('MODULE_PAYMENT_INVOICE_ACCIBAN', '');
if (!defined('MODULE_PAYMENT_INVOICE_BANKBIC')) define('MODULE_PAYMENT_INVOICE_BANKBIC', '');
}

//Berechnung Zahlungsziel
if (MODULE_PAYMENT_INVOICE_STATUS === 'True'){
$tstamp = mktime(0, 0, 0, date('m'), date('d') + MODULE_PAYMENT_INVOICE_PAYDAY, date('Y'));
$tag = date('d.m.Y', $tstamp);
}
//Ende
define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Invoice (payable up to '. $tag . ')');
define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');
define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 
"Please use the following details to transfer your total order value:\n" .
"\nBank Name:  " . MODULE_PAYMENT_EUTRANSFER_BANKNAM .
"\nAccount Holder: " . MODULE_PAYMENT_EUTRANSFER_ACCNAM . 
"\nIBAN:    " . MODULE_PAYMENT_EUTRANSFER_ACCIBAN .
"\nBIC/SWIFT:   " . MODULE_PAYMENT_EUTRANSFER_BANKBIC . 
"\n");