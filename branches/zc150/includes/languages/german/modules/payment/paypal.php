<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id: paypal.php 627 2010-08-30 15:05:14Z webchills $
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'PayPal IPN');
  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'PayPal');
  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong> (Basic PayPal Service)<br /><a href="https://www.paypal.com/mrb/mrb=R-6C7952342H795591R&pal=9E82WJBKKGPLQ" target="_blank">Managen Sie Ihren PayPal Konto.</a><br /><br /><font color="green">Konfigurations Anleitung:</font><br />1. <a href="http://www.zen-cart.com/partners/paypal" target="_blank">Melden Sie sich bei Ihrem PayPal Konto an - Klicken Sie hier.</a><br />2. In Ihrem PayPal Konto, unter "Profile",<ul><li>stellen Sie ein <strong>Instant Payment Notification Preferences</strong> URL to:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . '<br />(Sollte bereits eine andere URL eingetragen sein, sollten Sie diese Einstellung unverändert lassen.)<br /><span class="alert">Stellen Sie sicher, das die Checkbox Enable IPN markiert ist!</span></li><li>in <strong>Website Payments Preferences</strong> set your <strong>Automatic Return URL</strong> to:<br />'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</li>' . (defined('MODULE_PAYMENT_PAYPAL_STATUS') ? '' : '<li>... and click "install" above to enable PayPal support... and "edit" to tell Zen Cart your PayPal settings.</li>') . '</ul><font color="green"><hr /><strong>Requirements:</strong></font><br /><hr />*<strong>PayPal Account</strong> (<a href="http://www.zen-cart.com/partners/paypal" target="_blank">click to signup</a>)<br />*<strong>*<strong>Port 80</strong> is used for bidirectional communication with the gateway, so must be open on your host\'s router/firewall<br />*<strong>PHP allow_url_fopen</strong> must be enabled<br />*<strong>Settings</strong> must be configured as described above.' );
  } else {
define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
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
define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', 'Bezahler E-Mail:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', 'Bezahler- ID:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', 'Bezahlerstatus:');
define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', 'Adress Status:');

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


define('MODULE_PAYMENT_PAYPAL_PURCHASE_DESCRIPTION_TITLE', STORE_NAME . ' Einkauf');
define('MODULE_PAYMENT_PAYPAL_PURCHASE_DESCRIPTION_ITEMNUM', 'Empfangsbestätigung Verkäufer');
