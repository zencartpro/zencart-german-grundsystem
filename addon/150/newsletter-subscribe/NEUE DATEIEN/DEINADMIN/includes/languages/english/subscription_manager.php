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
//  $Id: subscription_manager.php,v 1.1 2006/06/16 01:46:13 Owner Exp $
//

define('HEADING_TITLE', 'Subscription Management');
define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_EMAIL', 'Email Address');
define('TABLE_HEADING_PREFERENCE', 'Preference');
define('TABLE_HEADING_SUBSCRIPTION_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this email?');
define('TEXT_INFO_HEADING_NEW_SUBSCRIPTION' , 'New Suscription');
define('TEXT_INFO_HEADING_EDIT_SUBSCRIPTION' , 'Edit Suscription');
define('TEXT_INFO_EDIT_INTRO' , 'Please make any necessary changes');
define('TEXT_INFO_INSERT_INTRO' , 'Subscriptions entered here are automatically confirmed.');
define('TEXT_INFO_CLASS_TITLE' , 'Email Address');
define('TEXT_INFO_CONFIRMED' , 'Confirmed:');
define('TEXT_INFO_HEADING_DELETE_EMAIL' , 'Delete Email');
define('TEXT_PURGE_SUBSCRIPTIONS' , 'Purge unconfirmed subscriptions older than 90 days');

define('TEXT_INFO_HEADING_IMPORT_SUBSCRIPTION','Import Subscriptions');
define('TEXT_INFO_IMPORT_INTRO','Import subscriptions from a file on your computer. For best results, import a small test file first.');
define('TEXT_INFO_IMPORT_FILE','File to import:');
define('TEXT_INFO_IMPORT_ENCL','If fields are enclosed by quotes or other character, enter it here:');
define('TEXT_INFO_IMPORT_DELIM','Fields separated by (| , \s \t etc):');
define('TEXT_INFO_IMPORT_HEADER_ROW','Check if the first line is a header row.');
define('TEXT_INFO_IMPORT_FORMAT','Default email format:');
define('TEXT_INFO_IMPORT_SAMPLE',
'Enter a sample record, using \'format\' for email format field and \'email\' for email.<br />
Use NULL to indicate fields not to import.<br />
Separate fields with a single space.');


define('TEXT_INFO_SUBSCRIPTIONS_IMPORTED', 'Successfully imported %s subscriptions.');
define('TEXT_INFO_SUBSCRIPTIONS_PURGED', 'Subscriptions purged.');
define('TEXT_SUBSCRIPTION_STATUS_CUSTOMER' , 'Customer');
define('TEXT_SUBSCRIPTION_STATUS_CONFIRMED' , 'Newsletter-Only Subscriber');
define('TEXT_SUBSCRIPTION_STATUS_UNCONFIRMED' , 'Pending Confirmation');

define('TEXT_SUBSCRIPTION_DATE', 'Subscription Date');
define('TEXT_INFO_SUBSCRIPTION_STATUS_UNCONFIRMED', 
'This email address has not been confirmed.<br />Newsletter will not be sent until subscriber confirms.');

define('NEWSONLY_SUBSCRIPTION_NOT_INSTALLED', 'Warning: The Newsletter-only Subscription contribution has not been installed.');
define('NEWSONLY_SUBSCRIPTION_NOT_ENABLED', 'Warning: The Newsletter-only Subscription contribution is disabled. Not all functions will work. To enable, go to Configuration -> My Store and enable.');
define('TEXT_INSTALL', 'Install');
define('TEXT_REMOVE', 'Remove');
define('TEXT_NEWSONLY_REMOVE_CONFIRM','Warning! This will remove all newsletter only subscriptions!! Continue? <a href="%s">Yes</a>&nbsp;&nbsp;<a href="%s">No</a>');
?>
