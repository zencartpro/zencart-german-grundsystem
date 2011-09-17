<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_confirmation.php for COWOA 3.0 ZC150 2011-09-17 10:10:40Z webchills $
 */

define('NAVBAR_TITLE_1','Kasse');
define('NAVBAR_TITLE_2','Bestellung bestätigen');

if($_SESSION['COWOA']) $COWOA=TRUE;

if($COWOA)
	define('HEADING_TITLE', 'Schritt 4 von 4 , Bestellung bestätigen');
else
	define('HEADING_TITLE', 'Schritt 3 von 3 , Bestellung bestätigen');

define('HEADING_BILLING_ADDRESS','Rechnungsanschrift');
define('HEADING_DELIVERY_ADDRESS','Lieferanschrift');
define('HEADING_SHIPPING_METHOD','Versandart:');
define('HEADING_PAYMENT_METHOD','Zahlungsart:');
define('HEADING_PRODUCTS','Warenkorbinhalt');
define('HEADING_TAX','MwSt.');
define('HEADING_ORDER_COMMENTS','Anmerkungen oder Hinweise');
// no comments entered
define('NO_COMMENTS_TEXT','Keine');
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE','<strong>Bestellung bestätigen</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE','- weiter um Ihre Bestellung zu bestätigen ... Vielen Dank!');

define('OUT_OF_STOCK_CAN_CHECKOUT', 'Produkte, die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' gekennzeichnet sind, sind nicht vorrätig.<br />Diese Artikel werden nachträglich geliefert');
