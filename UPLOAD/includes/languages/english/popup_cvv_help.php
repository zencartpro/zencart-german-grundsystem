<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: popup_cvv_help.php 730 2015-12-22 10:49:16Z webchills $
 */

define('HEADING_CVV', 'What is CVV?');
define('TEXT_CVV_HELP1', 'Visa, Mastercard, Discover 3 Digit Card Verification Number<br /><br />
                    For your safety and security, we require that you enter your card\'s verification number.<br /><br />
                    The verification number is a 3-digit number printed on the back of your card.
                    It appears after and to the right of your card number.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));

define('TEXT_CVV_HELP2', 'American Express 4 Digit Card Verification Number<br /><br />
                    For your safety and security, we require that you enter your card\'s verification number.<br /><br />
                    The American Express verification number is a 4-digit number printed on the front of your card.
                    It appears after and to the right of your card number.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));

define('TEXT_CLOSE_CVV_WINDOW', 'Close Window [x]');