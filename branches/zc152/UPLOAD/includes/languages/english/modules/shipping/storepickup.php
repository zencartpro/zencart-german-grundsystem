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
// $Id: storepickup.php 730 2014-02-09 14:49:16Z webchills $
//

define('MODULE_SHIPPING_STOREPICKUP_TEXT_TITLE', 'Store Pickup');
define('MODULE_SHIPPING_STOREPICKUP_TEXT_DESCRIPTION', 'Customer In Store Pick-up');
define('MODULE_SHIPPING_STOREPICKUP_TEXT_WAY', 'Walk In');


// The following is for defining multiple locations/methods on a per-language basis. It is only used if the shopper has selected a language other than the store's default.
// The content of the MODULE_SHIPPING_STOREPICKUP_MULTIPLE_WAYS definition should be the same as the multiple locations in the shipping module's settings in your admin, just with names changed.
// Typical formats are:
// "Location One, 5.00; Location Two, 3.50; Location Three, 0.00"
// "Location One, Location Two, Location Three"
// or leave it blank to simply use the same text as defined in the Admin, regardless of language
// TIP: This should really be left blank for the default language, otherwise the Admin settings field is never used.
define('MODULE_SHIPPING_STOREPICKUP_MULTIPLE_WAYS', "");
