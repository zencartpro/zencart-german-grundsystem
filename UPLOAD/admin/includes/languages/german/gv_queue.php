<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_queue.php 630 2019-06-16 17:39:16Z webchills $
 */
require 'gv_name.php';
define('HEADING_TITLE', TEXT_GV_NAME . ' Warteschlange');
define('TABLE_HEADING_CUSTOMERS','Kunden');
define('TABLE_HEADING_ORDERS_ID','Bestellnummer');
define('TABLE_HEADING_VOUCHER_VALUE',TEXT_GV_NAME . ' Betrag');
define('TABLE_HEADING_DATE_PURCHASED','Bestelldatum');
define('TABLE_HEADING_ACTION','Aktion');
define('TEXT_REDEEM_GV_MESSAGE_HEADER', 'Sie haben kürzlich einen ' . TEXT_GV_NAME . ' bei '. STORE_NAME . ' gekauft.');
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', 'Aus Sicherheitsgründen werden Gutscheine nicht sofort zur Verfügung gestellt. Der Betrag konnte jetzt freigegeben werden. Sie können jetzt unseren Online-Shop besuchen und den ' . TEXT_GV_NAME . ' Wert an die gewünschte Person weiterleiten oder ihn selbst einlösen.');
define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', 'Der ' . TEXT_GV_NAME . ' den Sie gekauft haben, hat einen Wert von %s');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', 'Danke, dass Sie bei uns eingekauft haben!');
define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', TEXT_GV_NAME . ' Kauf');
define('TEXT_REDEEM_GV_SUBJECT_ORDER', ' Bestellung #');
define('TEXT_EDIT_ORDER','Editiere Bestellung ID#');
define('TEXT_GV_NONE','Kein ' . TEXT_GV_NAME . ' zur Freigabe vorhanden');