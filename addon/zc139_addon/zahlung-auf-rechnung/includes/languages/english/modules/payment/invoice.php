<?php
/*
  $Id: invoice.php,v 1.21 2003/02/19 02:10:00 harley_vb Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/
//Berechnung Zahlungsziel
$tstamp = mktime(0, 0, 0, date("m"), date("d") + MODULE_PAYMENT_INVOICE_PAYDAY, date("Y"));
$tag = date("d.m.Y", $tstamp);
//Ende

  define('MODULE_PAYMENT_INVOICE_TEXT_TITLE', 'Invoice (payable up to'. $tag . ')');
  define('MODULE_PAYMENT_INVOICE_TEXT_DESCRIPTION', '');
  define('MODULE_PAYMENT_INVOICE_TEXT_EMAIL_FOOTER', 'Please you transfer the amount after receipt of the goods under indication of the order number up to' . $tag . ' on our account: ' . MODULE_PAYMENT_INVOICE_PAYTO . "\n\n" . 'Thank you!');
