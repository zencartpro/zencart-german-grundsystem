<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: email_extras.php 2081 2005-10-03 05:34:18Z ajeh $
//

// office use only
define('OFFICE_FROM','Absender:');define('OFFICE_EMAIL','e-Mail:');define('OFFICE_SENT_TO','An:');define('OFFICE_EMAIL_TO','An e-Mail:');define('OFFICE_USE','Nur f&uuml;r den internen Gebrauch:');define('OFFICE_LOGIN_NAME','Kontoname:');define('OFFICE_LOGIN_EMAIL','e-Mail Adresse:');define('OFFICE_LOGIN_PHONE','<strong>Telephon:</strong>');define('OFFICE_IP_ADDRESS','IP Adresse:');define('OFFICE_HOST_ADDRESS','Hostname:');define('OFFICE_DATE_TIME','Datum und Uhrzeit:');

// email disclaimer
define('EMAIL_DISCLAIMER','Diese e-Mail Adresse wurde uns von Ihnen oder einer unserer Kunden mitgeteilt. Sollten Sie diese Nachricht versehentlich erhalten haben, wenden Sie sich bitte an %s');define('EMAIL_SPAM_DISCLAIMER', '');define('EMAIL_FOOTER_COPYRIGHT', 'Copyright &copy; 2004 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GV ADMIN GESENDET]');define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[ERM&Auml;SSIGUNGSSCHEIN]');define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[BESTELLSTATUS]');define('TEXT_UNSUBSCRIBE', ' "\n\nWenn Sie zuk&uuml;nftig keine Newsletter mehr erhalten wollen, klicken Sie einfach auf folgenden Link: \n")');

// for whos_online when gethost is off
define('OFFICE_IP_TO_HOST_ADDRESS', 'Deaktiviert');


?>