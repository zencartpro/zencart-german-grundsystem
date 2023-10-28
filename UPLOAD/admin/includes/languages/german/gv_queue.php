<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_queue.php 2023-10-28 20:49:16Z webchills $
 */


define('HEADING_TITLE', TEXT_GV_NAME . ' Freigabe Warteschleife');


define('TABLE_HEADING_ORDERS_ID', 'Bestellnummer');
define('TABLE_HEADING_VOUCHER_VALUE', TEXT_GV_NAME . ' Wert');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');


define('TEXT_REDEEM_GV_MESSAGE_HEADER', 'Sie haben kürzlich einen ' . TEXT_GV_NAME . ' in unserem Onlineshop gekauft.');
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', 'Aus Sicherheitsgründen wurde der Betrag nicht sofort für Sie freigegeben und erst geprüft. ' .
                                          'Die Prüfung ist nun abgeschlossen und der Betrag wurde freigegeben. Sie können sich nun in unserem Shop einloggen und den ' . TEXT_GV_NAME . ' Wert via Email an jemand anderen senden oder ihn selbst verwenden.' . "\n\n"
                                          );

define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', 'The ' . TEXT_GV_NAME . '(s) you purchased are worth %s');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', 'Thank you for shopping with us!');

define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', TEXT_GV_NAME . ' Kauf');
define('TEXT_REDEEM_GV_SUBJECT_ORDER',' Bestellnummer');

define('TEXT_EDIT_ORDER','Bearbeite Bestellnummer ');
define('TEXT_GV_NONE','kein ' . TEXT_GV_NAME . ' zum Freigeben');