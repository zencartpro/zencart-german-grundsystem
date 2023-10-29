<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0 
 * @version $Id: ot_coupon.php 2022-01-14 19:57:14Z webchills $
 */

define('MODULE_ORDER_TOTAL_COUPON_TITLE','Aktionskupon');
define('MODULE_ORDER_TOTAL_COUPON_HEADER', TEXT_GV_NAMES . '/Aktionskupon');
define('MODULE_ORDER_TOTAL_COUPON_DESCRIPTION','Aktionskupon');
define('MODULE_ORDER_TOTAL_COUPON_TEXT_ENTER_CODE', TEXT_GV_REDEEM);

define('MODULE_ORDER_TOTAL_COUPON_REDEEM_INSTRUCTIONS', '<p>Geben Sie bitte die Nummer Ihres Aktionskupons in das Eingabefeld ein. Der Wert des Aktionskupons wird nach Drücken der Schaltfläche "Weiter" der Bestellung gutgeschrieben.</p>');
define('MODULE_ORDER_TOTAL_COUPON_TEXT_CURRENT_CODE', 'Ihr aktueller Aktionskupon: ');
define('TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER', 'ENTFERNEN');

define('TEXT_REMOVE_REDEEM_COUPON', 'Der Aktionskupon wurde entfernt!');
define('MODULE_ORDER_TOTAL_COUPON_INCLUDE_ERROR', ' Die Einstellung Include Tax = True sollte nur dann aktiviert sein, wenn die Einstellung für Recalculate = None ist.');
define('MODULE_ORDER_TOTAL_COUPON_REMOVE_INSTRUCTIONS', '<p>Um den Aktionskupon wieder zu entfernen geben Sie bitte den Text ' . TEXT_COMMAND_TO_DELETE_CURRENT_COUPON_FROM_ORDER . ' ein und Drücken Sie ENTER oder RETURN</p>');