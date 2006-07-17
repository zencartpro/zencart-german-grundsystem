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
// $Id: login.php 2 2006-03-31 09:55:33Z rainer $
//

define('NAVBAR_TITLE','anmelden');
define('HEADING_TITLE','Willkommen, bitte melden Sie sich an.');

define('HEADING_NEW_CUSTOMER','Sie sind neu hier? Dann k&ouml;nnen Sie sich hier Ihr pers&ouml;nliches Konto erstellen:');
define('TEXT_NEW_CUSTOMER_INTRODUCTION','Ein Kundenkonto bei ' . STORE_NAME . ' erm&ouml;glicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen u.v.m.');

define('HEADING_RETURNING_CUSTOMER','Stammkunden: Bitte melden Sie sich an');

define('TEXT_PASSWORD_FORGOTTEN','Haben Sie Ihr Passwort vergessen?');

define('TEXT_LOGIN_ERROR','Achtung! e-Mail Adresse oder Passwort wurden nicht gefunden.');
define('TEXT_VISITORS_CART','<strong class="note">Hinweis:</strong> Der Inhalt Ihres "Besucherwarenkorbs" wird nach Ihrer Anmeldung in Ihren pers&ouml;nlichen "Kundenwarenkorb" verschoben. <a href="javascript:session_win();">[weiter Infos]</a>');
define('TABLE_HEADING_PRIVACY_CONDITIONS','Privatsph&auml;re');

define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION','Bitte best&auml;tigen Sie unsere AGB. Sie k&ouml;nnen diese <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>hier</u></a> nachlesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM','Ich habe die AGB gelesen und akzeptiert.');
?>
