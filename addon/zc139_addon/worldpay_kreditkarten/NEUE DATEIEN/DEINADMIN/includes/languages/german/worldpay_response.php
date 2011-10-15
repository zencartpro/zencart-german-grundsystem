<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: worldpay_response.php 2011-10-15 08:24:40Z webchills $
 */

  define('FILENAME_WORLDPAY_RESPONSE', 'worldpay_response');
  define('BOX_CUSTOMERS_WORLDPAY_RESPONSE', 'WorldPay Zahlungen');

  define('FILENAME_WORLDPAY', 'worldpay_response');

//begin ADMIN text
  define('HEADING_ADMIN_TITLE', 'WorldPay Zahlungen Rückmeldungen');
// define('HEADING_PAYMENT_STATUS', 'Payment Status');
// define('TEXT_ALL_IPNS', 'All');
  define('TABLE_HEADING_ORDER_NUMBER', 'Bestellung');
  define('TABLE_HEADING_WORLDPAY_ID', 'WP');
  define('TABLE_HEADING_WORLDPAY_TRANSACTION', 'Transaktion');
  define('TABLE_HEADING_TXN_TYPE','Kunde');
  define('TABLE_HEADING_PAYMENT_STATUS', 'Hinweis');
  define('TABLE_HEADING_PAYMENT_AMOUNT', 'Autorisierter Betrag');
  define('TABLE_HEADING_ACTION', 'Aktion');
  define('MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', 50);
  define('TABLE_TEXT_WAF', 'WorldPay hat rückgemeldet: ');
  define('TABLE_TEXT_WAF_END', ' für diese Transaktion');
  define('TEXT_WAF_CAUTION_TABLE', '<span style="color:orange; font-weight: bold">Vorsicht</span>');
  define('TEXT_WAF_WARNING_TABLE', '<span style="color:red; font-weight: bold">Warnung</span>');
  define('TEXT_INFO_WP_RESPONSE_BEGIN', 'WorldPay Zahlung ');
  define('TEXT_INFO_WP_RESPONSE_END', ' für Bestellung');
  define('TABLE_TOTALS_MATCH', '<span style="color:green; font-weight: normal">Gesamtsumme stimmt überein</span>');
  define('TABLE_TOTALS_MISMATCH', '<span style="color:red; font-weight: bold">Warnung: Gesamtsumme stimmt nicht überein</span>');
  define('TABLE_COUNTRY_MATCH', '<span style="color:green; font-weight: normal">Land stimmt überein</span>');
  define('TABLE_COUNTRY_MISMATCH', '<span style="color:red; font-weight: bold">Warnung: Land stimmt nicht überein</span>');
  define('TABLE_ADDRESS_MATCH', '<span style="color:green; font-weight: normal">Adresse stimmt überein</span>');
  define('TABLE_ADDRESS_MISMATCH', '<span style="color:red; font-weight: bold">Warnung: Addresse stimmt nicht überein</span>');
  define('TABLE_POSTCODE_MATCH', '<span style="color:green; font-weight: normal">Postleitzahl stimmt überein</span>');
  define('TABLE_POSTCODE_MISMATCH', '<span style="color:red; font-weight: bold">Warnung: Postleitzahl stimmt nicht überein</span>');
  define('TABLE_TEXT_ORDER_TOTAL', 'Gesamtsumme');
  define('TABLE_TEXT_WP_RESPONSE_TOTAL', 'WorldPay genehmigte Gesamtsumme');
  define('TABLE_TEXT_AVS_CODE', 'AVS Code');
  define('TABLE_TEXT_AVS_CVV_CHECK', 'Card Verification Code Prüfung:<br />(die 3stellige Nummer auf der Rückseite)');
  define('TABLE_TEXT_AVS_POSTCODE_CHECK', 'Überprüfung der Postleitzahl');
  define('TABLE_TEXT_AVS_ADDRESS_CHECK', 'Überprüfung der Adresse');
  define('TABLE_TEXT_AVS_COUNTRY_CHECK', 'Überprüfung des Landes');
  define('TABLE_TEXT_WORLDPAY_TRANSACTION', 'Worldpay Transaktions ID');
  define('TABLE_TEXT_WORLDPAY_TRANSACTION_END', '(erscheint im Betreff der Emails)');
  define('TABLE_TEXT_ORDER_COUNTRY', 'Original Land der Bestellung');
  define('TABLE_TEXT_WP_RESPONSE_COUNTRY', 'CC Land');
  define('TABLE_TEXT_ORDER_ADDRESS', 'Original Rechnungsadresse');
  define('TABLE_TEXT_WP_RESPONSE_ADDRESS', 'WorldPay CC Addresse');
  define('TABLE_TEXT_ORDER_POSTCODE', 'Original Postleitzahl');
  define('TABLE_TEXT_WP_RESPONSE_POSTCODE', 'WorldPay CC Postleitzahl');