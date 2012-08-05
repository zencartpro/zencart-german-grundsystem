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
// $Id: subscribe.php,v 1.1 2006/06/16 01:46:14 Owner Exp $
//

define('NAVBAR_TITLE', 'Subscribe');
define('HEADING_TITLE', 'Subscribe');

define('TEXT_INFORMATION', '');
// you don't need to fill in TEXT_INFORMATION if you wish to edit the subscribe text from the Admin area
// If filled in, this text is shown below the defined page text
// Note: This uses the same defined_page for both subscriptions and confirmation

define('TEXT_INFORMATION_CONFIRM', '
  Before you begin receiving your subscription to our newsletter, you MUST reply to our subscribe-confirm request sent to your email<strong>%s</strong>.
  <br />
  <br />
  Please check your e-mail inbox. When you receive the confirmation request, just click on the confirmation link enclosed in the email.
  <br />
  <br />
  If you have troubles signing up, please send a message to <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .'</a>.
  ');

// greeting salutation
define('EMAIL_SUBJECT', 'Please confirm ' . STORE_NAME . ' newsletter subscription');

// First line of the greeting
define('EMAIL_WELCOME', '' . "\n" . '<p />We wish to welcome you to ' . STORE_NAME . '.<p />');
define('EMAIL_SEPARATOR', '--------------------');

define('EMAIL_TEXT', 'This email has been registered for a newsletter subscription on our site.<br />' . "\n" . 'Before you can begin receiving the newsletter, you must confirm your email address.<p />' . "\n\n" . 'If you did not subscribe, no action is needed.<p />' . "\n\n" . '');

define('EMAIL_CONFIRMATION_TEXT','Please click on the link below to confirm your subscription:<br />' . "\n\n" . '%s  '. "\n\n" );

define('EMAIL_CONTACT', '<br />For help with any of our online services, please email the store-owner: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a><br />\n\n");
define('EMAIL_CLOSURE','Sincerely,' . "\n\n" . STORE_OWNER . "\nStore Owner\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'This email address was given to us by you or by one of our customers. If you did not signup for an account, or feel that you have received this email in error, no action is needed. No newsletters will be sent without confirmation, and you will not receive another. You are always welcome to contact us with any concerns you may have.');

?>
