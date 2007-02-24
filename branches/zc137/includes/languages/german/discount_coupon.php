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
// $Id: discount_coupon.php 4591 2006-09-23 04:25:15Z ajeh $
//

define('NAVBAR_TITLE', 'Aktionskupon');
define('HEADING_TITLE', 'Aktionskupon');
define('TEXT_INFORMATION', '');
define('TEXT_COUPON_FAILED', '<span class="alert important">%s</span> scheint kein g&uuml;ltiger Aktionskupon Code zu sein. Bitte nochmals eintippen.');
define('HEADING_COUPON_HELP', 'Aktionskupon Hilfe');
define('TEXT_CLOSE_WINDOW', 'Fenster schlie&szlig;en [x]');
define('TEXT_COUPON_HELP_HEADER', '<p class="bold">Der eingegebene Code geh&ouml;rt zu Aktionskupon: ');
define('TEXT_COUPON_HELP_NAME', '\'%s\'. </p>');
define('TEXT_COUPON_HELP_FIXED', '');
define('TEXT_COUPON_HELP_MINORDER', '');
define('TEXT_COUPON_HELP_FREESHIP', '');
define('TEXT_COUPON_HELP_DESC', '<p><span class="bold">Aktionskuponangebot:</span> %s</p><p class="smallText">Folgende Einschr&auml;nkungen bestehen:</p>');
define('TEXT_COUPON_HELP_DATE', '<p>Der Aktionskupon ist g&uuml;ltig von %s bis %s</p>');
define('TEXT_COUPON_HELP_RESTRICT', '<p class="biggerText bold">Aktionskupon Einschr&auml;nkungen</p>');
define('TEXT_COUPON_HELP_CATEGORIES', '<p class="bold">G&uuml;ltig f&uuml;r folgende Kategorien:</p>');
define('TEXT_COUPON_HELP_PRODUCTS', '<p class="bold">G&uuml;ltig f&uuml;r folgende Artikel:</p>');
define('TEXT_ALLOW', 'ja');
define('TEXT_DENY', 'nein');
define('TEXT_NO_CAT_RESTRICTIONS', '<p>Aktionskupon ist f&uuml;r alle Kategorien g&uuml;ltig.</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>Aktionskupon ist f&uuml;r alle Artikel g&uuml;ltig.</p>');
define('TEXT_CAT_ALLOWED', ' (G&uuml;ltig f&uuml;r diese Kategorie)');
define('TEXT_CAT_DENIED', ' (Nicht g&uuml;ltig f&uuml;r diese Kategorie)');
define('TEXT_PROD_ALLOWED', ' (G&uuml;ltig f&uuml;r diesen Artikel)');
define('TEXT_PROD_DENIED', ' (Nicht g&uuml;ltig f&uuml;r diesen Artikel)');
// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','<p class="smallText">Aktionskupons k&ouml;nnen nicht zum Kauf von ' . TEXT_GV_NAMES . ' verwendet werden. Limit: 1 Aktionskupon pro Bestellung.</p>');
define('TEXT_DISCOUNT_COUPON_ID_INFO', 'Aktionskupon einl&ouml;sen ');
define('TEXT_DISCOUNT_COUPON_ID', 'Kuponnummer: ');
define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Mit dieser Rechnungsadresse k&ouml;nnen keine Aktionkupons eingel&ouml;st werden.');



?>