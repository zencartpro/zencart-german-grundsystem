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
// $Id: gv_redeem.php 293 2008-05-28 21:10:40Z maleborg $
//

define('NAVBAR_TITLE', TEXT_GV_NAME .' einlösen ');
define('HEADING_TITLE', TEXT_GV_NAME .' einlösen ');
define('TEXT_INFORMATION', 'Weitere Informationen zum Thema ' . TEXT_GV_NAME . ' erfahren Sie in unserer <br /><br /><strong><a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a></strong>');
define('TEXT_INVALID_GV','Der ' . TEXT_GV_NAME . 'code ist ungültig oder wurde bereits eingelöst. Wenn Sie Fragen haben, kontaktieren Sie uns bitte über unser Kontaktformular hier im Shop');
define('TEXT_VALID_GV','Herzlichen Glückwunsch, Sie haben einen ' . TEXT_GV_NAME . ' im Wert von %s eingelöst.');
