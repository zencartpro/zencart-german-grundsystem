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
// $Id: popup_cvv_help.php 293 2008-05-28 21:10:40Z maleborg $
//

define('HEADING_CVV','Was ist eine Kreditkarten Prüfziffer (CVV)?');
define('TEXT_CVV_HELP1','Visa und Mastercard verwenden eine 3-stellige Prüfziffer<br /><br />
                    Wir benötigen zu Ihrer Sicherheit die Eingabe der 3-stelligen Prüfziffer Ihrer Visa oder Mastercard.<br /><br />
                    Diese Prüfziffer ist eine 3-stellige Nummer auf der Rückseite Ihrer Kreditkarte
                    und befindet sich auf dem Unterschriftsstreifen oben rechts.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));
define('TEXT_CVV_HELP2', 'American Express verwendet eine 4-stelligen Prüfziffer<br /><br />
                    Wir benötigen zu Ihrer Sicherheit die Eingabe der 4-stelligen Prüfziffer Ihrer American Express Karte.<br /><br />
                    Die American Express Prüfziffer ist eine 4-stellige Nummmer auf der Vorderseite Ihrer Kreditkarte
                    und befindet sich rechts hinter Ihrer Kreditkartennummer.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));
define('TEXT_CLOSE_CVV_WINDOW', 'Fenster schließen [x]');
