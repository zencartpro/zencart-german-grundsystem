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
// $Id$
//

define('HEADING_CVV','Was ist ein Kreditkarten Verifizierungscode (CVV)?');
define('TEXT_CVV_HELP1','Visa und Mastercard verwenden einen 3-Stelligen Verifizierungscode<br /><br />
                    Wir ben&ouml;tigen zu Ihrer Sicherheit die Eingabe des 3-Stelligen Verifizierungscodes Ihrer Visa oder Mastercard.<br /><br />
                    Dieser Verifizierungscode ist eine 3-Stellige Nummer auf der R&uuml;ckseite Ihrer Kreditkarte
                    und befindet sich auf dem Unterschriftsstreifen oben rechts.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));
define('TEXT_CVV_HELP2', 'American Express verwendet einen 4-Stelligen Verifizierungscode<br /><br />
                    Wir ben&ouml;tigen zu Ihrer Sicherheit die Eingabe der 4-Stelligen Verifizierungscodes Ihrer American Express Karte.<br /><br />
                    Der American Express Verifizierungscode ist ein 4-Stelliger Sicherheitscode auf der Vorderseite Ihrer Kreditkarte
                    und befindet sich nach und oberhalb Ihrer Kreditkartennummer.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));
define('TEXT_CLOSE_CVV_WINDOW', 'Fenster schlie&szlig;en [x]');


?>
