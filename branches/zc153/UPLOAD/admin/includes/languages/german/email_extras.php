<?php
/**
 * @package admin
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
  * @version $Id: email_extras.php 628 2013-08-17 09:05:14Z webchills $
 */


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
define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '" target="_blank">' . STORE_NAME . '</a>');
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