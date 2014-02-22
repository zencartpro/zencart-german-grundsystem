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
// $Id: newsletter_subscribe.php, v1 2006/05/16, dmcl1/notgoddess
//  

  define('BOX_HEADING_SUBSCRIBE', 'Newsletter'); // sidebox title
  
  define('BUTTON_IMAGE_SUBSCRIBE', 'button_subscribe.gif');
  define('BUTTON_SUBSCRIBE_ALT', 'Subscribe');
  define('BOX_SUBSCRIBE_DEFAULT_TEXT', 'Enter your email address to subscribe to our Newsletter.');
  
// header Subscribe Button/Box Subscribe Button
  define('HEADER_SUBSCRIBE_LABEL', 'Newsletter:'); // header text before input field
  define('HEADER_SUBSCRIBE_BUTTON','Subscribe'); // button text for css buttons
  define('HEADER_SUBSCRIBE_DEFAULT_TEXT', 'Enter email address'); // in input field

  define('TEXT_SUBSCRIBER_DEFAULT_NAME', 'Newsletter Subscriber');

  define('TEXT_NEWSONLY_SUBSCRIPTIONS_DISABLED','At this time newsletter-only subscriptions are not being accepted.  Our apologies if you reached this page in error.  We welcome you to create an account with us.');

define('SUBSCRIBE_DUPLICATE_CUSTOMERS_ERROR', 'There is already a Customer Account using that email address. To subscribe to the newsletter, please <a href="index.php?main_page=login">LOGIN</a> and select the My Account link at the top right. <a href="index.php?main_page=password_forgotten">Click here</a> if you have forgotten your password.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ERROR', 'This email address has already placed a Newsletter-Only subscription.  If you did not receive the confirmation request, please email <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a> from the address and request the subscription.');
define('SUBSCRIBE_DUPLICATE_NEWSONLY_ACCT', 'A Newsletter-Only subscription has been registered with this email address. If you currently receive our newsletter, but do not have an account.');
define('SUBSCRIBE_MERGED_NEWSONLY_ACCT', 'A Newsletter-Only subscription has been registered with this email address. Your subscription has been added to your new customer account.  You may now manage your subscription from your account page.');
define('SUBSCRIBE_NEWSLETTER_ONLY', 'Newsletter-Only Subscriber:');
define('SUBSCRIBE_NEWSLETTER_ONLY2', '(Check if you currently receive our newsletter, but do not have an account.)');
define('SUBSCRIBE_DUPLICATE_OTHER_ACCT', 'This email address is already being used by another Customer Account.');
define('SUBSCRIBE_DUPLICATE_CONFIRM_ERROR', 'This email address has already placed a Newsletter-Only subscription.');
define('SUBSCRIBE_NONEXISTANT_EMAIL_ERROR','This email address has not been registered.');
define('SUBSCRIBE_MULTIPLE_EMAIL_ERROR','Please contact <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a> regarding your subscription.');

?>
