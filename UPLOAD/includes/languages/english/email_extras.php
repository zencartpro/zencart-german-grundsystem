<?php
/**
* Zen Cart German Specific (158 code in 157)
* @copyright Copyright 2003-2023 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: email_extras.php 2023-10-29 11:32:14Z webchills $
*/

define ('EMAIL_LOGO_ALT_TITLE_TEXT', 'Zen Cart - German Version');
define ('EMAIL_LOGO_FILENAME', 'header.jpg');
define ('EMAIL_LOGO_WIDTH', '600');
define ('EMAIL_LOGO_HEIGHT', '70');



define ('EMAIL_EXTRA_HEADER_INFO', '');


define('OFFICE_FROM','<strong>From:</strong>');
define('OFFICE_EMAIL','<strong>Email:</strong>');


define('OFFICE_USE','<strong>Office Use Only:</strong>');
define('OFFICE_LOGIN_NAME','<strong>Login Name:</strong>');
define('OFFICE_LOGIN_EMAIL','<strong>Login Email:</strong>');
define('OFFICE_LOGIN_PHONE','<strong>Telephone:</strong>');
define('OFFICE_LOGIN_FAX','<strong>Fax:</strong>');
define('OFFICE_IP_ADDRESS','<strong>IP Address:</strong>');
define('OFFICE_HOST_ADDRESS','<strong>Host Address:</strong>');
define('OFFICE_DATE_TIME','<strong>Date and Time:</strong>');


define('EMAIL_TEXT_TELEPHONE', 'Telephone: ');


define('EMAIL_DISCLAIMER', '');
define('EMAIL_SPAM_DISCLAIMER', '-');

define('EMAIL_ORDER_MESSAGE',''); 

define('EMAIL_FOOTER_COPYRIGHT','Copyright (c) ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>');
define('TEXT_UNSUBSCRIBE', "\n\nTo unsubscribe from future newsletter and promotional mailings, simply click on the following link: \n");


define('EMAIL_ADVISORY', '-----' . "\n" . '<strong>IMPORTANT:</strong> For your protection and to prevent malicious use, all emails sent via this web site are logged and the contents recorded and available to the store owner. If you feel that you have received this email in error, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");


define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>This message is included with all emails sent from this site:</strong>');



define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT','[CREATE ACCOUNT]');
define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT','[GV CUSTOMER SENT]');
define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT','[NEW ORDER]');


define('EMAIL_TEXT_SUBJECT_LOWSTOCK','Warning: Low Stock');
define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE','Low Stock Report: ');