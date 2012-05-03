<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: worldpay.php 2011-10-15 08:24:40Z webchills $
 */

  define('FILENAME_WORLDPAY', 'worldpay_response');
  define('TABLE_WORLDPAY_PAYMENTS', DB_PREFIX . 'worldpay_payments');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_CATALOG_TITLE', 'Secure Credit Card Payment');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ADMIN_TITLE', 'WorldPay Payment Gateway');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ADMIN_DESCRIPTION', 'WorldPay Credit Card Payments');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_DESCRIPTION', '<strong>Worldpay Payment Module</strong>');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ERROR_MESSAGE', 'Your transaction has been cancelled or declined.  Please try again');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_TITLE', 'Credit Card');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_PAYMENTMETHOD', 'Credit Card');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_PURCHASE', 'Purchase from ');
  define('MODULE_PAYMENT_WORLDPAY_TOTALS_MATCH', 'Totals Match');
  define('MODULE_PAYMENT_WORLDPAY_TOTALS_MISMATCH', 'Warning: Totals do not Match');
  define('MODULE_PAYMENT_WORLDPAY_COUNTRY_MATCH', 'Countries Match');
  define('MODULE_PAYMENT_WORLDPAY_COUNTRY_MISMATCH', 'Warning: Country Mismatch');
  define('MODULE_PAYMENT_WORLDPAY_ADDRESS_MATCH', 'Addresses Match');
  define('MODULE_PAYMENT_WORLDPAY_ADDRESS_MISMATCH', 'Warning: Address Mismatch');
  define('MODULE_PAYMENT_WORLDPAY_POSTCODE_MATCH', 'Postcodes Match');
  define('MODULE_PAYMENT_WORLDPAY_POSTCODE_MISMATCH', 'Warning: Postcode Mismatch');
  define('MODULE_PAYMENT_WORLDPAY_SUHOSIN_TEXT', 'Suhosin is a PHP module that can affect communication between WorldPay and ZenCart');
  define('MODULE_PAYMENT_WORLDPAY_CAUTION', 'WorldPay has issued a CAUTION for this transaction');
  define('MODULE_PAYMENT_WORLDPAY_WARNING', 'WorldPay has issued a WARNING for this transaction');
  define('MODULE_PAYMENT_WORLDPAY_CCMAP', 'I will select a card later.'); 
  define('IMAGE_BUTTON_CONTINUE', 'Checkout again');