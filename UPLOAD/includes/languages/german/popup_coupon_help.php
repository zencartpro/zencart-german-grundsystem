<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: popup_coupon_help.php 295 2019-05-09 09:28:14Z webchills $
 */

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

define('TEXT_NO_CAT_TOP_ONLY_DENY', '<p>Dieser Aktionskupon ist nur für bestimmte Artikel gültig.');
define('TEXT_NO_CAT_RESTRICTIONS', '<p>Dieser Aktionskupon ist für alle Kategorien gültig.</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>Dieser Aktionskupon ist für alle Artikel gültig.</p>');
define('TEXT_NO_PROD_SALES', '<p>Dieser Aktionskupon ist nicht für Sonderangebote gültig.</p>');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','Aktionskupons können nicht zum Kauf von ' . TEXT_GV_NAMES . ' verwendet werden.');
define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Mit dieser Rechnungsadresse können keine Aktionskupons eingelöst werden.');