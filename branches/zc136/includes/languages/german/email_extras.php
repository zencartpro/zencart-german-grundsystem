<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id: email_extras.php 3166 2006-03-11 02:45:51Z drbyte $
 */

// office use only
define('OFFICE_FROM', 'Absender:');define('OFFICE_EMAIL', 'e-Mail:');define('OFFICE_SENT_TO', 'An:');define('OFFICE_EMAIL_TO', 'An e-Mail:');define('OFFICE_USE', 'Nur f&uuml;r den internen Gebrauch:');define('OFFICE_LOGIN_NAME', 'Kontoname:');define('OFFICE_LOGIN_EMAIL', 'e-Mail Adresse:');define('OFFICE_LOGIN_PHONE', '<strong>Telephon:</strong>');define('OFFICE_IP_ADDRESS', 'IP Adresse:');define('OFFICE_HOST_ADDRESS', 'Hostname:');define('OFFICE_DATE_TIME', 'Datum und Uhrzeit:');
//  define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

// email disclaimer
define('EMAIL_DISCLAIMER', 'Diese e-Mail Adresse wurde uns von Ihnen oder einem unserer Kunden mitgeteilt.' . "\n"
     . 'Sollten Sie diese Nachricht versehentlich erhalten haben, wenden Sie sich bitte an <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">' . STORE_OWNER_EMAIL_ADDRESS . '</a>.<br />');define('EMAIL_SPAM_DISCLAIMER', '');define('EMAIL_FOOTER_COPYRIGHT', 'Copyright (c) 2004 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');

// email advisory for all emails customer generate - tell-a-friend and GV send
define('EMAIL_ADVISORY', '<br />Achtung: Aus Sicherheitsgr&uuml;nden werden alle gesendeten Mails zwischengespeichert.<br />Sollten Sie diesbez&uuml;glich Fragen haben, wenden Sie sich bitte an <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">' . STORE_OWNER_EMAIL_ADDRESS . '</a>.<br />');

// email advisory included warning for all emails customer generate - tell-a-friend and GV send
define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Diese Nachricht ist in allen e-Mails dieser Seite enthalten:</strong>');


// Admin additional email subjects
define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT', '[NEUES KONTO]');define('SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT', '[EMPFEHLUNG]');define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT', '[GUTSCHEIN]');define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT', '[BESTELLUNG]');define('SEND_EXTRA_CC_EMAILS_TO_SUBJECT', '[EXTRA CC BESTELLINFO] #');

// Low Stock Emails
define('EMAIL_TEXT_SUBJECT_LOWSTOCK', 'Warnung: Lagermindestbestand unterschritten');define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE', 'Lagerbestandsbericht: ');

// for when gethost is off
define('OFFICE_IP_TO_HOST_ADDRESS', 'Deaktiviert');


?>