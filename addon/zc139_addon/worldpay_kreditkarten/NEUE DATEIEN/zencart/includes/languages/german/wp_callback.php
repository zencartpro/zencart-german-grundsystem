<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: wp_callback.php 670 2010-10-20 11:46:40Z webchills $
 */
define('NAVBAR_TITLE', 'Kasse');
define('NAVBAR_TITLE_1', 'Erfolgreich - Vielen Dank');
define('NAVBAR_TITLE_2', 'Transaktion abgebrochen');
define('HEADING_TITLE', 'Vielen Dank! Wir haben Ihre Bestellung erhalten.');
define('TEXT_SUCCESS', '');
define('TEXT_NOTIFY_PRODUCTS', 'Please notify me of updates to the products I have selected below:');
define('TEXT_SEE_ORDERS', 'Wir haben Ihnen soeben ein Email mit einer Bestellbestätigung geschickt, das nochmals alle Daten zu Ihrer Bestellung und weitere wichtige Informationen enthält.<br/>Bitte heben Sie dieses Email auf.<br/><br/>Sie können den Status Ihrer Bestellung und Ihre Bestellhistorie jederzeit unter <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mein Konto\'</a> ansehen.');
define('TEXT_CONTACT_STORE_OWNER', '<br/>Sollten Sie Fragen haben, wenden Sie sich bitte an unseren  <a href="' . zen_href_link(FILENAME_CONTACT_US) . '"> Kunden Service</a>.<br/>');
define('TEXT_THANKS_FOR_SHOPPING', '');
define('TABLE_HEADING_COMMENTS', '');
define('FOOTER_DOWNLOAD', 'Sie können Ihre Artikel auch zu einem späteren Zeitpunkt unter \'%s\' downloaden.');
define('TEXT_YOUR_ORDER_NUMBER', 'Ihre Bestellnummer lautet: ');
define('WP_TEXT_SUCCESS', '... Ihre Kreditkartenzahlung wurde erfolgreich verarbeitet.');
define('WP_TEXT_FAILURE', '... Ihre Kreditkartenzahlung wurde abgebrochen!');
define('WP_TEXT_HEADING', 'Rückmeldung von WorldPay:');
define('TEXT_CHECKOUT_LOGOFF_CUSTOMER', '<br/><b>Vielen Dank für Ihren Einkauf</b><br/>Bitte klicken Sie auf Abmelden, um sicherzustellen, dass Ihre Anmeldeinformationen nicht für die nächste Person sichtbar sind, die diesen Computer verwendet.'); 
define('WP_CONTACT_HEADING', 'Bitte überprüfen Sie Ihre Kontaktinformationen.  Sollten Sie Fehler feststellen <a href="/index.php?main_page=contact_us">kontaktieren Sie uns</a> bitte umgehend.');
define('WP_PAYMENT_HEADING', 'Details zu Ihrer Kreditkartenzahlung via WorldPay finden Sie hier.  Falls Sie irgendwelche Schwierigkeiten im Zahlungsablauf via WorldPay hatten, kontaktieren Sie bitte WorldPay.');
define('WP_CANCELLED_HEADING', 'Ihre Kreditkartenzahlung wurde abgebrochen.  Bitte <a href="/index.php?main_page=contact_us">kontaktieren Sie uns</a> um Zahlungsalternativen zu finden. Sollten Probleme mit Ihrer Zahlung bei WorldPay aufgetreten sein, nehmen Sie bitte mit WorldPay Kontakt auf.');
define('WP_TEST_HEADING', 'Dies war KEINE Livetransaktion! Testbetrieb des Kreditkartengateways! Es wurde kein wirkliches Geld transferiert.');
define('WP_CONTACT_INFO', 'Kontaktinformationen zu WorldPay finden Sie <a href="http://www.worldpay.com/about_us/index.php?page=contact" target="_blank">hier</a>');
define('TABLE_HEADING_DOWNLOAD_DATE', 'Link expires:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Downloads remaining:');
define('HEADING_DOWNLOAD', 'Download your products here:');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Product Download:');
define('EMAIL_TEXT_SUBJECT', 'Bestellbestätigung');
define('EMAIL_TEXT_HEADER', 'Bestellbestätigung');
define('EMAIL_TEXT_FROM',' von ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
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
define('EMAIL_GREETING_MR', 'Sehr geehrter Herr');
define('EMAIL_GREETING_MS', 'Sehr geehrte Frau');
// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' Bestellnummer ');
define('HEADING_ADDRESS_INFORMATION', 'Adressinformationen');
define('HEADING_SHIPPING_METHOD', 'Versandinformationen');