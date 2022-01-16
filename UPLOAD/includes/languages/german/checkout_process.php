<?php
/**
 * Zen Cart German Specific
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: checkout_process.php 2022-01-16 08:57:14Z webchills $
 */

define('EMAIL_TEXT_SUBJECT', 'Bestellbestätigung');
define('EMAIL_TEXT_HEADER', 'Bestellbestätigung ');
define('EMAIL_TEXT_FROM', ' von '); //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING', 'Vielen Dank für Ihren Einkauf!');
define('EMAIL_DETAILS_FOLLOW', 'Im Nachfolgenden sehen Sie die Details Ihrer Bestellung.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Bestelldetails:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Für Details zur Bestellung bitte hier klicken');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_PRODUCTS', 'Artikel');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferanschrift');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsanschrift');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsart');
define('EMAIL_SEPARATOR', '------------------------------------------------------');

define('EMAIL_GREETING_MR', 'Sehr geehrter Herr');
define('EMAIL_GREETING_MS', 'Sehr geehrte Frau');
define('EMAIL_GREETING_NEUTRAL', 'Sehr geehrte(r)');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' Bestellnummer ');
define('HEADING_ADDRESS_INFORMATION', 'Adressinformation');
define('HEADING_SHIPPING_METHOD', 'Versandart');