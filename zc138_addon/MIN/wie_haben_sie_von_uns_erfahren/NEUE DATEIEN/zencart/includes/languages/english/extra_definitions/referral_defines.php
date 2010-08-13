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
// $Id: english.php 277 2004-09-10 23:03:52Z wilt $
//

//define('CATEGORY_SOURCE', 'Referral Source'); //rmh referral

//rmh referral begin
define('ENTRY_SOURCE', 'How did you hear about us:');
define('ENTRY_SOURCE_ERROR', 'Please select how you first heard about us.');
define('ENTRY_SOURCE_OTHER', '(if "Other" please specify):');
define('ENTRY_SOURCE_OTHER_ERROR', 'Please enter how you first heard about us.');
if (REFERRAL_REQUIRED == 'true') {
  define('ENTRY_SOURCE_TEXT', '*');
  define('ENTRY_SOURCE_OTHER_TEXT', '*');
} else {
  define('ENTRY_SOURCE_TEXT', '');
  define('ENTRY_SOURCE_OTHER_TEXT', '');
}
//rmh referral end
define('PULL_DOWN_SOURCES', 'Please select a source');
define('PULL_DOWN_OTHER', 'Other - (please specifiy)'); //rmh referral

?>