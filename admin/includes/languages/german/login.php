<?php
/**
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: login.php 627 2010-08-30 15:05:14Z webchills $
 */

//  $Id: login.php 627 2010-08-30 15:05:14Z webchills $
//
// TRANSLATE!!
define('HEADING_TITLE', 'Admin Login');
define('HEADING_TITLE_EXPIRED', 'Admin Login - Password Expired');
define('TEXT_ADMIN_NAME', 'Benutzername: ');
define('TEXT_ADMIN_PASS', 'Passwort: ');
define('TEXT_ADMIN_OLD_PASSWORD', 'Old Password:');
define('TEXT_ADMIN_NEW_PASSWORD', 'New Password:');
define('TEXT_ADMIN_CONFIRM_PASSWORD', 'Confirm Password:');
define('ERROR_WRONG_LOGIN', '<p>Benutzername und / oder Passwort falsch.</p>');
define('ERROR_SECURITY_ERROR', 'Es gab einen Sicherheitsfehler, als Sie versucht haben sich anzumelden.');
define('TEXT_PASSWORD_FORGOTTEN', 'Passwort vergessen?');

define('LOGIN_EXPIRY_NOTICE', 'Please be aware that after 15 minutes of inactivity, you will be required to login again.<br /><br />Note: All passwords expire every 90 days.');
define('ERROR_PASSWORD_EXPIRED', 'NOTE: Your password has expired. Please select a new password. Your password <strong>must contain both NUMBERS and LETTERS and minimum 7 characters.</strong>');
define('TEXT_TEMPORARY_PASSWORD_MUST_BE_CHANGED', 'For security reasons, your temporary password needs to be changed. Please select a new password.<br />Your password <strong>must contain both NUMBERS and LETTERS and minimum 7 characters.</strong>');

define('TEXT_EMAIL_SUBJECT_LOGIN_FAILURES', 'Admin login failure notice');
define('TEXT_EMAIL_MULTIPLE_LOGIN_FAILURES', 'Important Notice: There have been multiple unsuccessful login attempts to your administrative account. For your protection and for system security, after 6 attempts the account will be locked for a minimum of 30 minutes, during which you will be unable to login even if you remember your password. Continued attempts to login will continue to lock the account for another 30 minutes. You will not be able to do password resets during this time. Apologies for the inconvenience.' . "\n\nThe last login attempt was from this IP address: %s.\n\n\n");

define('EXPIRED_DUE_TO_SSL', 'Note: Your password has expired because your site has changed from non-SSL (less secure) to being SSL-protected (more secure). Changing your password under SSL is an important step to greater security. Sorry for any inconvenience. Standard password expiry rules apply.');
