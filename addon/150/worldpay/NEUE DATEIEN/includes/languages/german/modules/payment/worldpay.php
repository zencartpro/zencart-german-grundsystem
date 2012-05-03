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
  define('MODULE_PAYMENT_WORLDPAY_TEXT_CATALOG_TITLE', 'Sichere Kreditkartenzahlung');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ADMIN_TITLE', 'WorldPay Payment Gateway');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ADMIN_DESCRIPTION', 'WorldPay Kreditkartenzahlung');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_DESCRIPTION', 'Worldpay Payment Modul');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_ERROR_MESSAGE', 'Ihre Zahlung wurde abgebrochen oder abgelehnt. Bitte versuchen Sie es erneut.');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_TITLE', 'Kreditkarte');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_PAYMENTMETHOD', 'Kreditkarte');
  define('MODULE_PAYMENT_WORLDPAY_TEXT_PURCHASE', 'Einkauf bei ');
  define('MODULE_PAYMENT_WORLDPAY_TOTALS_MATCH', 'Summen stimmen überein');
  define('MODULE_PAYMENT_WORLDPAY_TOTALS_MISMATCH', 'Warnung: Summen stimmen nicht überein');
  define('MODULE_PAYMENT_WORLDPAY_COUNTRY_MATCH', 'Land stimmt überein');
  define('MODULE_PAYMENT_WORLDPAY_COUNTRY_MISMATCH', 'Warnung: Land stimmt nicht überein');
  define('MODULE_PAYMENT_WORLDPAY_ADDRESS_MATCH', 'Adresse stimmt überein');
  define('MODULE_PAYMENT_WORLDPAY_ADDRESS_MISMATCH', 'Warnung: Adresse stimmt nicht überein');
  define('MODULE_PAYMENT_WORLDPAY_POSTCODE_MATCH', 'Postleitzahl stimmt überein');
  define('MODULE_PAYMENT_WORLDPAY_POSTCODE_MISMATCH', 'Warnung: Postleitzahl stimmt nicht überein');
  define('MODULE_PAYMENT_WORLDPAY_SUHOSIN_TEXT', 'Suhosin ist ein PHP Modul, das die Kommunikation zwischen WorldPay und Zen-Cart beeinflussen kann. Wenden Sie sich bitte bei Schwierigkeiten durch Suhosin an ihren Provider.');
  define('MODULE_PAYMENT_WORLDPAY_CAUTION', 'WorldPay hat einen VORSICHTSHINWEIS für diese Transaktion ausgegeben.');
  define('MODULE_PAYMENT_WORLDPAY_WARNING', 'WorldPay hat eine WARNUNG für diese Transaktion ausgegeben.');
  define('MODULE_PAYMENT_WORLDPAY_CCMAP', 'Ich wähle meine Kreditkarte später aus.');  
  define('IMAGE_BUTTON_CONTINUE', 'Weiter');