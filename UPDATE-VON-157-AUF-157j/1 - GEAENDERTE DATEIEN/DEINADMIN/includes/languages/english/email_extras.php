<?php
/**
* Zen Cart German Specific
* @copyright Copyright 2003-2022 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: email_extras.php 2023-10-28 20:02:16Z webchills $
*/

define ('EMAIL_LOGO_ALT_TITLE_TEXT', '');
define ('EMAIL_LOGO_FILENAME', 'header.jpg');  //-File is present in /email folder
define ('EMAIL_LOGO_WIDTH', '600');
define ('EMAIL_LOGO_HEIGHT', '70');


define ('EMAIL_EXTRA_HEADER_INFO', '');


define('EMAIL_ORDER_UPDATE_MESSAGE',''); 

define('OFFICE_FROM','From:');
define('OFFICE_EMAIL','E-mail:');

define('OFFICE_USE','Office Use Only:');
define('OFFICE_LOGIN_NAME','Login Name:');
define('OFFICE_LOGIN_EMAIL','Login e-mail:');
define('OFFICE_LOGIN_PHONE','Telephone:');
define('OFFICE_IP_ADDRESS','IP Address:');
define('OFFICE_HOST_ADDRESS','Host Address:');
define('OFFICE_DATE_TIME','Date and Time:');
define('EMAIL_DISCLAIMER', '');


define('EMAIL_SPAM_DISCLAIMER','-');
define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' '  . STORE_NAME . '');
define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[GV ADMIN SENT]');
define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[DISCOUNT COUPONS]');
define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[ORDERS STATUS]');
define('TEXT_UNSUBSCRIBE', "\n\nTo unsubscribe from future newsletter and promotional mailings, simply click on the following link: \n");


define('OFFICE_IP_TO_HOST_ADDRESS', 'Disabled');

define('TEXT_EMAIL_SUBJECT_ADMIN_USER_ADDED', 'Admin Alert: New admin user added.');
define('TEXT_EMAIL_MESSAGE_ADMIN_USER_ADDED', 'Administrative alert: A new admin user (%s) has been ADDED to your store by %s.' . "\n\n" . 'If you or an authorized administrator did not initiate this change, it is advised that you verify your site security immediately.');
define('TEXT_EMAIL_SUBJECT_ADMIN_USER_DELETED', 'Admin Alert: An admin user has been deleted.');
define('TEXT_EMAIL_MESSAGE_ADMIN_USER_DELETED', 'Administrative alert: An admin user (%s) has been DELETED from your store by %s.' . "\n\n" . 'If you or an authorized administrator did not initiate this change, it is advised that you verify your site security immediately.');
define('TEXT_EMAIL_SUBJECT_ADMIN_USER_CHANGED', 'Admin Alert: Admin user details have been changed.');
define('TEXT_EMAIL_ALERT_ADM_EMAIL_CHANGED', 'Admin alert: Admin user (%s) email address has been changed from (%s) to (%s) by (%s)');
define('TEXT_EMAIL_ALERT_ADM_NAME_CHANGED', 'Admin alert: Admin user (%s) username has been changed from (%s) to (%s) by (%s)');
define('TEXT_EMAIL_ALERT_ADM_PROFILE_CHANGED', 'Admin alert: Admin user (%s) security profile has been changed from (%s) to (%s) by (%s)');