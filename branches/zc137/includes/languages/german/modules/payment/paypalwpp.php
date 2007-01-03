<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2007-01-03
 * @version $Id$
 */

define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_EC', 'PayPal Express Checkout' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_WPP', 'PayPal Website Payments Pro' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PRO20', 'PayPal Website Payments Pro Payflow Edition (UK)' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_EC', 'PayPal Payflow Pro - Gateway');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_TITLE_PF_GATEWAY', 'PayPal Payflow Pro + Express Checkout' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');

  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADMIN_DESCRIPTION', '<strong>PayPal Express Checkout</strong>%s<br />' . (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' ? '<a href="https://manager.paypal.com/loginPage.do?partner=ZenCart" target="_blank">Manage your PayPal account.</a>' : '<a href="http://www.zen-cart.com/partners/paypal" target="_blank">Manage your PayPal account.</a>') . '<br /><br /><font color="green">Configuration Instructions:</font><br /><span class="alert">1. </span><a href="http://www.zen-cart.com/partners/paypal" target="_blank">Sign up for your PayPal account - click here.</a><br />' . 
(defined('MODULE_PAYMENT_PAYPALWPP_STATUS') ? '' : '... and click "install" above to enable PayPal Express Checkout support.</br>') . 
(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' && (!defined('MODULE_PAYMENT_PAYPALWPP_APISIGNATURE') || MODULE_PAYMENT_PAYPALWPP_APISIGNATURE == '') ? '<span class="alert">2. </span><strong>API credentials</strong> from the API Credentials option in your PayPal Profile Settings area. This module uses the <strong>API Signature</strong> option -- you will need the username, password and signature to enter in the fields below.' : (substr(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE,0,7) == 'Payflow' && (!defined('MODULE_PAYMENT_PAYPALWPP_PFUSER') || MODULE_PAYMENT_PAYPALWPP_PFUSER == '') ? '<span class="alert">2. </span><strong>PAYFLOW credentials</strong> This module needs your <strong>PAYFLOW Partner+Vendor+User+Password settings</strong> entered in the 4 fields below. These will be used to communicate with the Payflow system and authorize transactions to your account.' : '<span class="alert">2. </span>Ensure you have entered the appropriate security data for username/pwd etc, below.') ) . 
(MODULE_PAYMENT_PAYPALWPP_MODULE_MODE == 'PayPal' ? '<br /><span class="alert">3. </span>In your PayPal account, enable <strong>Instant Payment Notification</strong>:<br />under "Profile", select <em>Instant Payment Notification Preferences</em><ul style="margin-top: 0.5;"><li>click the checkbox to enable IPN</li><li>if there is not already a URL specified, set the URL to:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . '</li></ul>' : '') . 
'<font color="green"><hr /><strong>Requirements:</strong></font><br /><hr />*<strong>CURL</strong> is used for bidirectional communication with the gateway, so must be active on your hosting server (if you need to use a CURL proxy, set the CURL proxy settings under Admin->Configuration->My Store.)<br /><hr />'  . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  }

  define('MODULE_PAYMENT_PAYPALWPP_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_TITLE', 'Credit Card');
  define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TITLE', 'PayPal');
  define('MODULE_PAYMENT_PAYPALWPP_EC_TEXT_TYPE', 'PayPal Express Checkout');
define('MODULE_PAYMENT_PAYPALWPP_DP_TEXT_TYPE', 'PayPal Direct Payment' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_ERROR_HEADING', 'We\'re sorry, but we were unable to process your credit card.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CARD_ERROR', 'The credit card information you entered contains an error.  Please check it and try again.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_FIRSTNAME', 'Credit Card First Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_LASTNAME', 'Credit Card Last Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_OWNER', 'Cardholder Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_TYPE', 'Credit Card Type:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_NUMBER', 'Credit Card Number:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_EXPIRES', 'Credit Card Expiry Date:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_ISSUE', 'Credit Card Issue Date:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER', 'CVV Number:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(on back of the credit card)' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_DECLINED', 'Your credit card was declined. Please try another card or contact your bank for more information.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_INVALID_RESPONSE', 'We were not able to process your order. Please try again, select an alternate payment method, or contact the store owner for assistance.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_ERROR', 'An error occurred when we tried to contact the payment processor. Please try again, select an alternate payment method, or contact the store owner for assistance.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_ADDR_ERROR', 'The address information you entered does not appear to be valid or cannot be matched. Please select or add a different address and try again.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CONFIRMEDADDR_ERROR', 'The address you selected at PayPal is not a Confirmed address. Please return to PayPal and select or add a confirmed address and try again.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_ERROR', 'An error occurred when we tried to process your credit card. Please try again, select an alternate payment method, or contact the store owner for assistance.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_CARD', 'We apologize for the inconvenience, but the credit card you entered is not one that we accept. Please use a different credit card.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_BAD_LOGIN', 'There was a problem validating your account. Please try again.');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_OWNER', '* The cardholder\'s name must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_EC_HEADER', 'Fast, Secure Checkout with PayPal:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BUTTON_TEXT', 'Save time. Checkout securely. Pay without sharing your financial information.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_BUTTON_ALTTEXT', 'Click here to pay via PayPal Express Checkout' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_STATE_ERROR', 'The state assigned to your account is not valid.  Please go into your account settings and change it.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_WPP_ACCOUNT_ERROR', 'We are sorry for the inconvenience. The payment could not be initiated because the PayPal account configured by the store owner is not a PayPal Website Payments Pro account or PayPal gateway services have not been purchased.  Please select an alternate method of payment for your order.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_SANDBOX_VS_LIVE_ERROR', 'We are sorry for the inconvenience. The PayPal account in this store is presently misconfigured to use mixed sandbox and live settings. We are unable to complete your transaction. Please notify the store owner so they can correct this problem.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_WPP_BAD_COUNTRY_ERROR', 'We are sorry -- the PayPal account configured by the store administrator is based in a country that is not supported for Website Payments Pro at the present time. Please choose another payment method to complete your order.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_NOT_CONFIGURED', '<span class="alert">&nbsp;(NOTE: Module is not configured yet)</span>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GETDETAILS_ERROR', 'There was a problem retrieving transaction details. ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_ERROR', 'There was a problem voiding the transaction. ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_ERROR', 'There was a problem refunding the transaction amount specified. ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_ERROR', 'There was a problem authorizing the transaction. ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_ERROR', 'There was a problem voiding the transaction. ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUNDFULL_ERROR', 'Your Refund Request was rejected by PayPal.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_REFUND_AMOUNT', 'You requested a partial refund but did not specify an amount.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_ERROR', 'You requested a full refund but did not check the Confirm box to verify your intent.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_AUTH_AMOUNT', 'You requested an authorization but did not specify an amount.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_CAPTURE_AMOUNT', 'You requested a capture but did not specify an amount.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_CHECK', 'Confirm' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_CONFIRM_ERROR', 'You requested to void a transaction but did not check the Confirm box to verify your intent.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Confirm' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_CONFIRM_ERROR', 'You requested an authorization but did not check the Confirm box to verify your intent.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'You requested funds-Capture but did not check the Confirm box to verify your intent.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_INITIATED', 'PayPal refund for %s initiated. Transaction ID: %s. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_AUTH_INITIATED', 'PayPal Authorization for %s initiated. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPT_INITIATED', 'PayPal Capture for %s initiated. Receipt ID: %s. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_VOID_INITIATED', 'PayPal Void request initiated. Transaction ID: %s. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_GEN_API_ERROR', 'There was an error in the attempted transaction. Please see the API Reference guide or transaction logs for detailed information.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
  define('MODULE_PAYMENT_PAYPALWPP_TEXT_INVALID_ZONE_ERROR', 'We are sorry for the inconvenience; however, at the present time we are unable to use PayPal to process orders from the geographic region you selected as your PayPal address.  Please continue using normal checkout and select from the available payment methods to complete your order.');

// EC buttons -- Do not change these values:
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_IMG', 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_EC_BUTTON_SM_IMG', 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckoutsm.gif' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG', 'https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_TXT', 'Checkout with PayPal' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');

////////////////////////////////////////
// Styling of the PayPal Payment Page. Uncomment to customize.  Otherwise, simply create a Custom Page Style at PayPal and mark it as Primary or name it in your Zen Cart PayPal WPP settings.
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_IMAGE', '');  // this should be an HTTPS URL to the image file
  //define('MODULE_PAYMENT_PAYPALWPP_PAGECOLOR', '');  // 6-digit hex value
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_BORDER_COLOR', '');  // 6-digit hex value
  //define('MODULE_PAYMENT_PAYPALWPP_HEADER_BACK_COLOR', ''); // 6-digit hex value
////////////////////////////////////////


  // These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'First Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Last Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Business Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Address Name:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Address Street:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Address City:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Address State:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', 'Address Zip:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', 'Address Country:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'Payer Email:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay ID:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'Payer ID:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Payer Status:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Address Status:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', 'Payment Type:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', 'Payment Status:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', 'Pending Reason:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', 'Invoice:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', 'Payment Date:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'Currency:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Gross Amount:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Payment Fee:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Exchange Rate:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Cart items:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Trans. Type:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'Trans. ID:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'Parent Trans. ID:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TITLE', '<strong>Order Refunds</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_FULL', 'If you wish to refund this order in its entirety, click here:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Do Full Refund' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Do Partial Refund' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_PARTIAL_TEXT', '<br />... or enter the partial refund amount here and click on Partial Refund' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_SUFFIX', '*A Full refund may not be issued after a Partial refund has been applied.<br />*Multiple Partial refunds are permitted up to the remaining unrefunded balance.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'Refunded by store administrator.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_REFUND_FULL_CONFIRM_CHECK','Confirm: ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');


define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_TITLE', '<strong>Order Authorizations</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_PARTIAL_TEXT', 'If you wish to authorize part of this order, enter the amount  here:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_BUTTON_TEXT_PARTIAL', 'Do Authorization' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_AUTH_SUFFIX', '' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_REFUND_DEFAULT_MESSAGE', 'Refunded by store administrator.');

define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TITLE', '<strong>Capturing Authorizations</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FULL', 'If you wish to capture all or part of the outstanding authorized amounts for this order, enter the Capture Amount and select whether this is the final capture for this order.  Check the confirm box before submitting your Capture request.<br />' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Do Capture' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_AMOUNT_TEXT', 'Amount to Capture:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_FINAL_TEXT', 'Is this the final capture?' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_SUFFIX', '' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CAPTURE_DEFAULT_MESSAGE', 'Thank you for your order.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPALWPP_TEXT_CAPTURE_FULL_CONFIRM_CHECK','Confirm: ' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');

define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TITLE', '<strong>Voiding Order Authorizations</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID', 'If you wish to void an authorization, enter the authorization ID here, and confirm:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_DEFAULT_MESSAGE', 'Thank you for your patronage. Please come again.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_BUTTON_TEXT_FULL', 'Do Void' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');
define('MODULE_PAYMENT_PAYPAL_ENTRY_VOID_SUFFIX', '' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');



// this text is used to announce the username/password when the module creates the customer account and emails data to them:
define('EMAIL_EC_ACCOUNT_INFORMATION', 'Your account login details, which you can use to review your purchase, are as follows:' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypalwpp.php at line 357');



?>