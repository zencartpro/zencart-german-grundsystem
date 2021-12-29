<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: users.php 2021-11-30 20:49:16Z webchills $
 */

if (!defined('HEADING_TITLE')) { //this file included by admin_account.php
  define('HEADING_TITLE', 'Admin Users');
}
define('IMAGE_ADD_USER', 'Add User');

define('TEXT_ID', 'ID');
define('TEXT_ADMIN_NAME', 'Username');

define('TEXT_ADMIN_PROFILE', 'Profile');
define('TEXT_CHOOSE_PROFILE', 'Choose Profile');
define('TEXT_PASSWORD', 'Password');
define('TEXT_CONFIRM_PASSWORD', 'Confirm Password');
define('TEXT_NO_USERS_FOUND', 'No admin users found');
define('TEXT_CONFIRM_DELETE', 'Delete requested. Please confirm: ');

define('ERROR_NO_USER_DEFINED', 'The option requested requires a username to be specified.');
define('ERROR_USER_MUST_HAVE_PROFILE', 'User must be assigned a profile.');
define('ERROR_DUPLICATE_USER', 'Sorry, an admin user of that name already exists. Please select another name.');
define('ERROR_ADMIN_NAME_TOO_SHORT', 'Admin user names must have at least %s characters.');
define('ERROR_PASSWORD_TOO_SHORT', 'Passwords must contain at least %s characters.');
define('SUCCESS_NEW_USER_ADDED', 'New Admin User "%s" created.');
define('SUCCESS_USER_DETAILS_UPDATED', 'User details updated.');
define('SUCCESS_PASSWORD_UPDATED', 'Password updated.');
define('ERROR_ADMIN_INVALID_EMAIL_ADDRESS', 'The email address you provided seems to be invalid.');
define('ERROR_ADMIN_INVALID_CHARS_IN_USERNAME', 'The admin username you entered contains invalid characters.');
