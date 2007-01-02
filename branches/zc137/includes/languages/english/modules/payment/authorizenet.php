<?php
/**
 * Authorize.net SIM
 *
  * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: authorizenet.php 5369 2006-12-23 10:55:52Z drbyte $
 */

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Authorize.net SIM');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', 'Credit Card');  // Payment option title as displayed to the customer
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Credit Card Test Info:<br /><br />CC#: 4111111111111111<br />Expiry: Any');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Type:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Credit Card Owner:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Credit Card Number:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Credit Card Expiry Date:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'There has been an error processing your credit card. Please try again.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Your credit card was declined. Please try another card or contact your bank for more info.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Credit Card Error!');
?>