<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: checkout_process.php 627 2010-08-30 15:05:14Z webchills $
 */

define('EMAIL_TEXT_SUBJECT', 'Bestellbestätigung');
define('EMAIL_TEXT_HEADER', 'Bestellbestätigung');
define('EMAIL_TEXT_FROM', ' von '); //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING', 'Vielen Dank für Ihren Einkauf!');
define('EMAIL_DETAILS_FOLLOW', 'Im Nachfolgenden sehen Sie die Details Ihrer Bestellung.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Rechnung:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Für eine detaillierte Rechnung bitte hier klicken');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_PRODUCTS', 'Artikel');
define('EMAIL_TEXT_SUBTOTAL', 'Zwischensumme:');
define('EMAIL_TEXT_TAX', 'MwSt.:');
define('EMAIL_TEXT_SHIPPING', 'Versandkosten:');
define('EMAIL_TEXT_TOTAL', 'Gesamt:');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferanschrift');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsanschrift');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsart');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' Bestellnummer ');
define('HEADING_ADDRESS_INFORMATION', 'Adressinformationen');
define('HEADING_SHIPPING_METHOD', 'Versandart');
