<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: gv_queue.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', ' Warteschleife');
define('TABLE_HEADING_CUSTOMERS','Kunden');
define('TABLE_HEADING_ORDERS_ID','Bestellnummer');
define('TABLE_HEADING_VOUCHER_VALUE',TEXT_GV_NAME . ' Betrag');
define('TABLE_HEADING_DATE_PURCHASED','Bestelldatum');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_REDEEM_GV_MESSAGE_HEADER', 'Sie haben einen ' . TEXT_GV_NAME . ' bei '. STORE_NAME . ' bestellt.');
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', 'Aus Sicherheitsgr&uuml;nden werden Gutscheine nicht sofort zur Verf&uuml;gung gestellt. Der Betrag konnte jetzt freigegeben werden. Sie k&ouml;nnen jetzt unseren Online-Shop besuchen und den ' . TEXT_GV_NAME . ' an die gew&uuml;nschte Person weiterleiten. . "\n\n"');
define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', 'Der ' . TEXT_GV_NAME . ' den Sie bestellt haben, hat einen Wert von %s');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', 'Danke, dass Sie bei uns eingekauft haben!');
define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', TEXT_GV_NAME . ' bestellen');
define('TEXT_REDEEM_GV_SUBJECT_ORDER', ' Bestell #');
define('TEXT_EDIT_ORDER','Bestell ID# bearbeiten');
define('TEXT_GV_NONE','Kein ' . TEXT_GV_NAME . ' zur Ver&ouml;ffentlichung vorhanden');


?>