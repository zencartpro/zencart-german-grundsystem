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
// $Id: popup_coupon_help.php 2 2006-03-31 09:55:33Z rainer $
//

define('HEADING_COUPON_HELP','Gutschein Hilfe');
define('TEXT_CLOSE_WINDOW','Fenster schlie&szlig;en [x]');
define('TEXT_COUPON_HELP_HEADER','Herzlichen Gl&uuml;ckwunsch! Sie haben Ihren Gutschein erfolgreich eingel&ouml;st.');
define('TEXT_COUPON_HELP_NAME','<br /><br />Name des Gutscheins: %s');
define('TEXT_COUPON_HELP_FIXED','<br /><br />Der Gutscheinwert von %s Nachlass wird in Ihrer Bestellung gutgeschrieben.');
define('TEXT_COUPON_HELP_MINORDER','<br /><br />Sie ben&ouml;tigen noch Artiken im Wert von %s, damit Sie Ihren Gutschein einl&ouml;sen k&ouml;nnen');
define('TEXT_COUPON_HELP_FREESHIP','<br /><br />Dieser Gutschein erm&ouml;glicht Ihnen eine <strong>versandkostenfreie</strong> Lieferung');
define('TEXT_COUPON_HELP_DESC','<br /><br />Gutscheinbeschreibung: %s');
define('TEXT_COUPON_HELP_DATE','<br /><br />Dieser Gutschein ist von %s bis %s g&uuml;ltig');
define('TEXT_COUPON_HELP_RESTRICT','<br /><br />Artikel-/Kategoriebeschr&auml;nkungen');
define('TEXT_COUPON_HELP_CATEGORIES','Kategorie');
define('TEXT_COUPON_HELP_PRODUCTS','Artikel');
define('TEXT_ALLOW','erlauben');
define('TEXT_DENY','verbieten');

define('TEXT_ALLOWED', ' (erlaubt)');
define('TEXT_DENIED', ' (nicht erlaubt)');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','Kupons k&ouml;nnen nicht in ' . TEXT_GV_NAMES . ' umgewandelt werden.');
?>
