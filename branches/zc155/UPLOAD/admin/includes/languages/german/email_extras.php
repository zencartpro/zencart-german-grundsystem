<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: email_extras.php 630 2015-12-22 16:05:14Z webchills $
 */

  define ('EMAIL_LOGO_FILENAME', 'header.jpg');  //-File is present in /email folder
  define ('EMAIL_LOGO_WIDTH', '550');
  define ('EMAIL_LOGO_HEIGHT', '110');
  define ('EMAIL_LOGO_ALT_TITLE_TEXT', 'Zen Cart! The Art of E-commerce');
  
  // -----
  // If you want to include some extra information in each email's header information (like perhaps the store address and/or phone number),
  // set this value to contain the full HTML content to be copied, e.g. '<div id="extra-stuff">Extra stuff for header</div>'.
  //
  define ('EMAIL_EXTRA_HEADER_INFO', '');

// office use only
define('OFFICE_FROM','Absender:');
define('OFFICE_EMAIL','E-Mail:');
define('OFFICE_SENT_TO','An:');
define('OFFICE_EMAIL_TO','E-Mail:');
define('OFFICE_USE','Nur für den internen Gebrauch:');
define('OFFICE_LOGIN_NAME','Kontoname:');
define('OFFICE_LOGIN_EMAIL','E-Mail Adresse:');
define('OFFICE_LOGIN_PHONE','<strong>Telefon:</strong>');
define('OFFICE_IP_ADDRESS','IP Adresse:');
define('OFFICE_HOST_ADDRESS','Hostname:');
define('OFFICE_DATE_TIME','Datum und Uhrzeit:');

// email disclaimer
define('EMAIL_DISCLAIMER','Diese E-Mail Adresse wurde uns von Ihnen oder einer unserer Kunden mitgeteilt. Sollten Sie diese Nachricht versehentlich erhalten haben, wenden Sie sich bitte an %s');
define('EMAIL_SPAM_DISCLAIMER', '-');
define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="http://www.zen-cart-pro.at" target="_blank">' . STORE_NAME . '</a>');
define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GUTSCHEIN ADMIN GESENDET]');
define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[AKTIONSKUPON]');
define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[BESTELLSTATUS]');
define('TEXT_UNSUBSCRIBE', ' "\n\nWenn Sie zukünftig keine Newsletter mehr erhalten wollen, klicken Sie einfach auf folgenden Link: \n")');

// for whos_online when gethost is off
define('OFFICE_IP_TO_HOST_ADDRESS', 'Deaktiviert');
define('TEXT_EMAIL_SUBJECT_ADMIN_USER_ADDED', 'Admin Alarm: Ein neue Admin Benutzer wurde hinzugefügt.');
define('TEXT_EMAIL_MESSAGE_ADMIN_USER_ADDED', 'Administrativer Alarm: Der Admin Benutzer (%s) wurde Ihrem Shop hinzugefügt von %s.' . "\n\n" . 'Wenn Sie oder ein authorisierter Administrator diese Änderung nicht veranlasst haben, dann ist es empfehlenswert die Sicherheit Ihres Shop sofort zu überprüfen.');
define('TEXT_EMAIL_SUBJECT_ADMIN_USER_DELETED', 'Admin Alarm: Ein Admin Benutzer wurde gelöscht.');
define('TEXT_EMAIL_MESSAGE_ADMIN_USER_DELETED', 'Administrativer Alarm: Der Admin Benutzer (%s) wurde aus Ihrem Shop gelöscht von %s.' . "\n\n" . 'Wenn Sie oder ein authorisierter Administrator diese Änderung nicht veranlasst haben, dann ist es empfehlenswert die Sicherheit Ihres Shop sofort zu überprüfen.');
define('TEXT_EMAIL_SUBJECT_ADMIN_USER_CHANGED', 'Admin Alarm: Ein Admin Benutzer wurde verändert.');
define('TEXT_EMAIL_ALERT_ADM_EMAIL_CHANGED', 'Admin Alarm: Die E-Mail Adresse von Admin Benutzer (%s) wurde geändert von (%s) zu (%s) von (%s)');
define('TEXT_EMAIL_ALERT_ADM_NAME_CHANGED', 'Admin Alarm: Der Benutzername von Admin Benutzer (%s) wur geändert von (%s) zu (%s) von (%s)');
define('TEXT_EMAIL_ALERT_ADM_PROFILE_CHANGED', 'Admin Alarm: Das Berechtigungsprofil von Admin Benutzer (%s) wurde geändert von (%s) zu (%s) von (%s)');