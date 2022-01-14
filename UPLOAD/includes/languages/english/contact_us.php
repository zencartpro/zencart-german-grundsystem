<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: contact_us.php 2022-01-14 19:05:14Z webchills $
 */

define('HEADING_TITLE', 'Contact Us');
define('NAVBAR_TITLE', 'Contact Us');
define('TEXT_SUCCESS', 'Your message has been successfully sent.');
define('EMAIL_SUBJECT', 'Website Inquiry to ' . STORE_NAME);

define('ENTRY_NAME', 'Full Name:');
define('ENTRY_EMAIL', 'Email Address:');
define('ENTRY_TELEPHONE', 'Telephone Number:');
define('ENTRY_ENQUIRY', 'Message:');

define('SEND_TO_TEXT','Send Email To:');
define('ENTRY_EMAIL_NAME_CHECK_ERROR','Sorry, is your name correct? Our system requires a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters. Please try again.');
define('ENTRY_EMAIL_CONTENT_CHECK_ERROR','Did you forget your message? We would like to hear from you. You can type your comments in the text area below.');

define('NOT_LOGGED_IN_TEXT', 'Not logged in');
