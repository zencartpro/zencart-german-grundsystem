<?php
/**
 * Authorize.net SIM Payment Module
 *
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: authorizenet.php 2022-01-14 19:05:14Z webchills $
 */

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Authorize.net (SIM)');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', 'Kreditkarte');  // Payment option title as displayed to the customer


  if (defined('MODULE_PAYMENT_AUTHORIZENET_STATUS') && MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') {
    define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', '<a rel="noreferrer noopener" target="_blank" href="https://account.authorize.net/">Authorize.net Merchant Login</a>' . (MODULE_PAYMENT_AUTHORIZENET_TESTMODE != 'Production' ? '<br /><br />Testing Info:<br /><b>Automatic Approval Credit Card Numbers:</b><br />Visa#: 4007000000027<br />MC#: 5424000000000015<br />Discover#: 6011000000000012<br />AMEX#: 370000000000002<br /><br /><b>Note:</b> These credit card numbers will return a decline in live mode, and an approval in test mode.  Any future date can be used for the expiration date and any 3 or 4 (AMEX) digit number can be used for the CVV Code.<br /><br /><b>Automatic Decline Credit Card Number:</b><br /><br />Card #: 4222222222222<br /><br />This card number can be used to receive decline notices for testing purposes.' : '') . '<br /><br /><strong>SETTINGS</strong><br />Your "response" and "receipt" and "relay" URL settings in your Authorize.net Merchant Profile can be left BLANK, or if necessary you can set the "relay URL" to point to https://your_domain.com/foldername/index.php?main_page=checkout_process<br><br>If you are having problems with this, see <a href="https://docs.zen-cart.com/user/modules/authorizenet_sim/" rel="noreferrer noopener" target="_blank">the SIM Setup FAQ article</a> for detailed setup instructions.');
  } else {
    define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', '<a rel="noreferrer noopener" target="_blank" href="https://reseller.authorize.net/application?resellerId=10023">Click Here to Sign Up for an Account</a><br /><br /><a rel="noreferrer noopener" target="_blank" href="https://account.authorize.net/">Click to Login to the Authorize.net Merchant Area</a><br /><br /><strong>Requirements:</strong><br /><hr>*<strong>Authorize.net Account</strong> (see link above to signup)<br />*<strong>Authorize.net username and transaction key</strong> available from your Merchant Area<br><br>See <a href="https://docs.zen-cart.com/user/modules/authorizenet_sim/" rel="noreferrer noopener" target="_blank">the SIM Setup FAQ article</a> for detailed setup instructions.');
  }


define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE','Kreditkarten Typ:');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER','Karteninhaber:');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER','Kartennummer:');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES','Gültig bis:');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CVV', 'Kreditkarten Prüfziffer:');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_POPUP_CVV_LINK', 'Was ist das?');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER','* Der Name des Karteninhabers muss mindestens ' . CC_OWNER_MIN_LENGTH . ' characters.\n. Zeichen haben!');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER','* Die Kartennummer muss mindestens ' . CC_NUMBER_MIN_LENGTH . ' characters.\n. Zeichen haben!');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV', '* Die drei- oder vierstellige Kreditkarten Prüfziffer von der Rückseite der Kreditkarte muss eingegeben werden.\n');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE','Ein Fehler ist bei der Überprüfung der Kreditkarte aufgetreten. Bitte versuchen Sie es noch einmal.');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE','Ihre Kreditkarte wurde abgelehnt. Für weitere Informationen kontaktieren Sie bitte Ihre Bank');
define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR','Kreditkartenfehler!');
