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
// $Id: popup_coupon_help.php 293 2008-05-28 21:10:40Z maleborg $
//

define('HEADING_COUPON_HELP','Aktionskupon Hilfe');
define('TEXT_CLOSE_WINDOW','Fenster schließen [x]');
define('TEXT_COUPON_HELP_HEADER','Herzlichen Glückwunsch! Sie haben Ihren Aktionskupon erfolgreich eingelöst.');
define('TEXT_COUPON_HELP_NAME','<br /><br />Name des Aktionskupons: %s');
define('TEXT_COUPON_HELP_FIXED','<br /><br />Der Wert des Aktionskupons von %s wird in Ihrer Bestellung gutgeschrieben.');
define('TEXT_COUPON_HELP_MINORDER','<br /><br />Sie benötigen noch Artikel im Wert von %s, damit Sie Ihren Aktionskupon einlösen können');
define('TEXT_COUPON_HELP_FREESHIP','<br /><br />Dieser Aktionskupon ermöglicht Ihnen eine <strong>versandkostenfreie</strong> Lieferung');
define('TEXT_COUPON_HELP_DESC','<br /><br />Aktionskupon Beschreibung: %s');
define('TEXT_COUPON_HELP_DATE','<br /><br />Dieser Aktionskupon ist von %s bis %s gültig');
define('TEXT_COUPON_HELP_RESTRICT','<br /><br />Artikel-/Kategoriebeschränkungen');
define('TEXT_COUPON_HELP_CATEGORIES','Kategorie');
define('TEXT_COUPON_HELP_PRODUCTS','Artikel');
define('TEXT_ALLOW','erlauben');
define('TEXT_DENY','verbieten');
define('TEXT_ALLOWED', ' (erlaubt)');
define('TEXT_DENIED', ' (nicht erlaubt)');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','Aktionskupons können nicht zum Kauf von ' . TEXT_GV_NAMES . ' verwendet werden.');
define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Mit dieser Rechnungsadresse können keine Aktionskupons eingelöst werden.');
