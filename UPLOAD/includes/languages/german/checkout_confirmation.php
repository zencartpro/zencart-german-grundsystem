<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: checkout_confirmation.php 629 2012-12-07 07:05:14Z webchills $
 */

define('NAVBAR_TITLE_1','Bestellung');
define('NAVBAR_TITLE_2','Bestellung bestätigen');

define('HEADING_TITLE','Schritt 3 von 3: Zahlungspflichtig bestellen');
define('TEXT_ZUSATZ_SCHRITT3','Überprüfen Sie Ihre Bestellung und drücken dann den Button "KAUFEN" unten auf dieser Seite.');
define('HEADING_BILLING_ADDRESS','Rechnungsanschrift');
define('HEADING_DELIVERY_ADDRESS','Lieferanschrift');
define('HEADING_SHIPPING_METHOD','Versandart:');
define('HEADING_PAYMENT_METHOD','Zahlungsart:');
define('HEADING_PRODUCTS','Warenkorbinhalt');
define('HEADING_TAX','MwSt.');
define('HEADING_ORDER_COMMENTS','Anmerkungen oder Hinweise');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Produkte, die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' gekennzeichnet sind, sind nicht vorrätig.<br />Diese Artikel werden nachträglich geliefert');
define('NO_COMMENTS_TEXT','Keine');
// buttonloesung
define('TABLE_HEADING_SINGLEPRICE','Einzelpreis');
define('TABLE_HEADING_PRODUCTIMAGE','Artikelbild');
define('TEXT_CONDITIONS_ACCEPTED_IN_LAST_STEP','Ich habe <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '" target="_blank"><u>AGB</u></a> und <a href="' . zen_href_link(FILENAME_WIDERRUFSRECHT, '', 'SSL') . '"><u>Widerrufsrecht</u></a> gelesen und akzeptiert.');
define('TEXT_NON_EU_COUNTRIES','Hinweis:<br/>Ihre Bestellung wird in ein Nicht-EU-Land geliefert. Zusätzlich können im Rahmen Ihrer Bestellung noch weitere Zölle, Steuern oder Kosten anfallen, die nicht über uns abgeführt bzw. von uns in Rechnung gestellt werden.');
