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
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id: moneyorder.php 2 2006-03-31 09:55:33Z rainer $
//

define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Vorkasse/&Uuml;berweisung');
define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Bitte &Uuml;berweisen Sie den Betrag auf unser Konto:<br />' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br /><br />Oder senden Sie einen Scheck an:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'Ihre Bestellung wird versendet, sobald wir den Betrag erhalten haben.');
define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Bitte &Uuml;berweisen Sie den Betrag auf unser Konto: ". MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\nOder senden Sie einen Scheck an:\n" . STORE_NAME_ADDRESS . "\n\n" . 'Ihre Bestellung wird versendet, sobald wir den Betrag erhalten haben.');
?>
