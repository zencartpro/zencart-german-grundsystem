<?php
/**
 * @package worldpay_payment_module
 * @copyright Copyright Philip Clarke - http://exploitingIT.co.uk
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $ worldpay payment module version 2.0 $
 */

  define('FILENAME_WORLDPAY_RESPONSE', 'worldpay_response');
  define('BOX_CUSTOMERS_WORLDPAY_RESPONSE', 'WorldPay Payments');

  define('FILENAME_WORLDPAY', 'worldpay_response');

//begin ADMIN text
  define('HEADING_ADMIN_TITLE', 'WorldPay Payment Responses');
// define('HEADING_PAYMENT_STATUS', 'Payment Status');
// define('TEXT_ALL_IPNS', 'All');
  define('TABLE_HEADING_ORDER_NUMBER', 'Order');
  define('TABLE_HEADING_WORLDPAY_ID', 'WP');
  define('TABLE_HEADING_WORLDPAY_TRANSACTION', 'Transact');
  define('TABLE_HEADING_TXN_TYPE','Customer.');
  define('TABLE_HEADING_PAYMENT_STATUS', 'Advisory');
  define('TABLE_HEADING_PAYMENT_AMOUNT', 'Authorised Amount');
  define('TABLE_HEADING_ACTION', 'Action');
  define('MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', 50);
  define('TABLE_TEXT_WAF', 'Worldpay has issued a ');
  define('TABLE_TEXT_WAF_END', ' for this transaction');
  define('TEXT_WAF_CAUTION_TABLE', '<span style="color:orange; font-weight: bold">Caution.</span>');
  define('TEXT_WAF_WARNING_TABLE', '<span style="color:red; font-weight: bold">Warning.</span>');
  define('TEXT_INFO_WP_RESPONSE_BEGIN', 'WorldPay Payment ');
  define('TEXT_INFO_WP_RESPONSE_END', ' for order');
  define('TABLE_TOTALS_MATCH', '<span style="color:green; font-weight: normal">Totals Match</span>');
  define('TABLE_TOTALS_MISMATCH', '<span style="color:red; font-weight: bold">Warning: Totals do not Match</span>');
  define('TABLE_COUNTRY_MATCH', '<span style="color:green; font-weight: normal">Countries Match</span>');
  define('TABLE_COUNTRY_MISMATCH', '<span style="color:red; font-weight: bold">Warning: Country Mismatch</span>');
  define('TABLE_ADDRESS_MATCH', '<span style="color:green; font-weight: normal">Addresses Match</span>');
  define('TABLE_ADDRESS_MISMATCH', '<span style="color:red; font-weight: bold">Warning: Address Mismatch</span>');
  define('TABLE_POSTCODE_MATCH', '<span style="color:green; font-weight: normal">Postcodes Match</span>');
  define('TABLE_POSTCODE_MISMATCH', '<span style="color:red; font-weight: bold">Warning: Postcode Mismatch</span>');
  define('TABLE_TEXT_ORDER_TOTAL', 'Order Total');
  define('TABLE_TEXT_WP_RESPONSE_TOTAL', 'WorldPay Authorised Total');
  define('TABLE_TEXT_AVS_CODE', 'AVS Code');
  define('TABLE_TEXT_AVS_CVV_CHECK', 'Card Verification Value check:<br />(the 3 digit number of on the back)');
  define('TABLE_TEXT_AVS_POSTCODE_CHECK', 'Postcode check');
  define('TABLE_TEXT_AVS_ADDRESS_CHECK', 'Address check');
  define('TABLE_TEXT_AVS_COUNTRY_CHECK', 'Country check');
  define('TABLE_TEXT_WORLDPAY_TRANSACTION', 'Worldpay Transaction Id');
  define('TABLE_TEXT_WORLDPAY_TRANSACTION_END', '(appears in subject line of emails)');
  define('TABLE_TEXT_ORDER_COUNTRY', 'Original Order Country');
  define('TABLE_TEXT_WP_RESPONSE_COUNTRY', 'Credit Card Country');
  define('TABLE_TEXT_ORDER_ADDRESS', 'Original Billing Address');
  define('TABLE_TEXT_WP_RESPONSE_ADDRESS', 'WorldPay CC Address');
  define('TABLE_TEXT_ORDER_POSTCODE', 'Original Billing Postcode');
  define('TABLE_TEXT_WP_RESPONSE_POSTCODE', 'WorldPay CC Postcode');


?>