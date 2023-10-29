<?php
/**
* Zen Cart German Specific (158 code in 157)

* @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: email_extras.php 2023-10-29 17:32:14Z webchills $
*/

define ('EMAIL_LOGO_FILENAME', 'header.jpg');  //-File is present in /email folder
define ('EMAIL_LOGO_WIDTH', '600');
define ('EMAIL_LOGO_HEIGHT', '70');



define ('EMAIL_EXTRA_HEADER_INFO', '');


define('OFFICE_FROM', '<strong>Absender:</strong>');
define('OFFICE_EMAIL', '<strong>E-Mail:</strong>');


define('OFFICE_USE', '<strong>Nur für den internen Gebrauch:</strong>');
define('OFFICE_LOGIN_NAME', '<strong>Kontoname:</strong>');
define('OFFICE_LOGIN_EMAIL', '<strong>E-Mail Adresse</strong>:');
define('OFFICE_LOGIN_PHONE', '<strong>Telefon:</strong>');
define('OFFICE_LOGIN_FAX','<strong>Fax:</strong>');
define('OFFICE_IP_ADDRESS', '<strong>IP Adresse:</strong>');
define('OFFICE_HOST_ADDRESS', '<strong>Hostname:</strong>');
define('OFFICE_DATE_TIME', '<strong>Datum und Uhrzeit:</strong>');


define('EMAIL_TEXT_TELEPHONE', 'Telefon: ');


define('EMAIL_DISCLAIMER', '');
define('EMAIL_SPAM_DISCLAIMER', '-');

define('EMAIL_ORDER_MESSAGE',''); 
define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>');
define('TEXT_UNSUBSCRIBE', "\n\nUm sich von zukünftigen Newsletter- und Infomails abzumelden, klicken Sie einfach auf den folgenden Link: \n");

define('EMAIL_ADVISORY', '-----' . "\n" . '<strong>WICHTIG:</strong> Aus Sicherheitsgründen werden alle gesendeten E-Mails zwischengespeichert. Sollten Sie diesbezüglich Fragen haben, wenden Sie sich bitte an: ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");


define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Diese Nachricht ist in allen E-Mails dieser Seite enthalten:</strong>');



define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT', '[NEUES KUNDENKONTO]');

define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT', '[GUTSCHEIN]');
define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT', '[NEUE BESTELLUNG]');


define('EMAIL_TEXT_SUBJECT_LOWSTOCK', 'WARNUNG: Lagermindestbestand unterschritten');
define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE', 'Lagerbestandsbericht: ');