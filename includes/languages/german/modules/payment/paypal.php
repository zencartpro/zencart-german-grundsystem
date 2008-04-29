<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id$
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'PayPal Zahlungsbestätigung');
  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'PayPal Zahlungsbestätigung');
  if (IS_ADMIN_FLAG === true) {
define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
  } else {

  }
  // to show the PayPal logo as the payment option name, use this:  https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif
  // to show CC icons with PayPal, use this instead:  https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG', 'https://www.paypal.com/de_DE/i/logo/PayPal_mark_37x23.gif');
define('MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_ALT', 'Einkaufen mit PayPal');
define('MODULE_PAYMENT_PAYPAL_ACCEPTANCE_MARK_TEXT', 'Sparen Sie Zeit. Kaufen Sie sicher ein. <br />Bezahlen Sie ohne ihre Kontoinformationen öffentlich preiszugeben.');
define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_LOGO', '<img src="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_PAYPALWPP_MARK_BUTTON_ALT . '" /> &nbsp;' .  '<span class="smallText">' . MODULE_PAYMENT_PAYPAL_ACCEPTANCE_MARK_TEXT . '</span>');
define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', 'Vorname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', 'Nachname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', 'Firmenname:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', 'Adresse:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', 'Strasse:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', 'Stadt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', 'Bundesland:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', 'Postleitzahl:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', 'Land:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'Payer E-Mail:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'Bezahler- ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Bezahlerstatus:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Adress- Status:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', 'Zahlungstyp:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', 'Zahlungsstatus:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', 'In Warteschleife - Ursache:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', 'Rechnung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', 'Zahlungsdatum:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', 'Währung:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', 'Bruttobetrag:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', 'Bezahlungsgebühr:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', 'Wechselkurs:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', 'Stückzahl Warenkorbinhalt:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', 'Trans. Typ:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', 'Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', 'Parent Trans. ID:');
define('MODULE_PAYMENT_PAYPAL_PURCHASE_DECRIPTION_TITLE', STORE_NAME . ' Einkauf');
define('MODULE_PAYMENT_PAYPAL_PURCHASE_DESCRIPTION_ITEMNUM', 'Empfangsbestätigung Verkäufer' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/modules/payment/paypal.php at line 357');
