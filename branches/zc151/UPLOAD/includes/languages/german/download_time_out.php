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
// $Id: download_time_out.php 293 2008-05-28 21:10:40Z maleborg $
//

define('NAVBAR_TITLE', 'Ihr Download ...');
define('HEADING_TITLE', 'Ihr Download ...');

define('TEXT_INFORMATION', 'Leider ist Ihr Download abgelaufen.<br /><br />
  Falls Sie weitere Downloads haben und Sie fortsetzen wollen,
  gehen Sie bitte auf Ihre <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mein Konto</a>-Seite.<br /><br />
  Falls Probleme bei Ihrem Download auftreten, bitte <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">kontaktieren Sie uns</a> <br /><br />
  Vielen Dank!
  ');
