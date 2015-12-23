<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: popup_cvv_help.php 294 2015-12-23 19:28:14Z webchills $
 */

define('HEADING_CVV','Was ist eine Kreditkarten Prüfziffer (CVV)?');
define('TEXT_CVV_HELP1','Visa, Mastercard und Discover verwenden eine 3-stellige Prüfziffer<br /><br />
                    Wir benötigen zu Ihrer Sicherheit die Eingabe dieser 3-stelligen Prüfziffer.<br /><br />
                    Diese Prüfziffer ist eine 3-stellige Nummer auf der Rückseite Ihrer Kreditkarte
                    und befindet sich auf dem Unterschriftsstreifen oben rechts.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));
define('TEXT_CVV_HELP2', 'American Express verwendet eine 4-stelligen Prüfziffer<br /><br />
                    Wir benötigen zu Ihrer Sicherheit die Eingabe der 4-stelligen Prüfziffer Ihrer American Express Karte.<br /><br />
                    Die American Express Prüfziffer ist eine 4-stellige Nummmer auf der Vorderseite Ihrer Kreditkarte
                    und befindet sich rechts hinter Ihrer Kreditkartennummer.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));
define('TEXT_CLOSE_CVV_WINDOW', 'Fenster schließen [x]');