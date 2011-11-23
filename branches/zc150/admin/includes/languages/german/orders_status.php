<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart-pro.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart-pro.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

//  $Id: orders_status.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE','Bestellstatus');
define('TABLE_HEADING_ORDERS_STATUS','Bestellstatus');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_INFO_EDIT_INTRO','Führen Sie hier bitte die notwendigen Änderungen durch');
define('TEXT_INFO_ORDERS_STATUS_NAME','Bestellstatus:');
define('TEXT_INFO_INSERT_INTRO','Tragen Sie bitte den neuen Bestellstatus mit den dazu notwendigen Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Bestellstatus wirklich löschen?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS','Neuer Bestellstatus');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS','Bestellstatus bearbeiten');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS','Bestellstatus löschen');
define('ERROR_REMOVE_DEFAULT_ORDER_STATUS','FEHLER: Der Standardbestellstatus kann nicht gelöscht werden. Legen Sie bitte einen anderen Bestellstatus als Standard fest und versuchen Sie es noch einmal.');
define('ERROR_STATUS_USED_IN_ORDERS','FEHLER: Dieser Bestellstatus wird derzeit in aktuellen Bestellungen verwendet.');
define('ERROR_STATUS_USED_IN_HISTORY','FEHLER: Dieser Bestellstatus wird derzeit in der aktuellen Bestellstatistik verwendet.');
