<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: discount_coupon.php 698 2019-07-20 10:05:14Z webchills $
 */

define('NAVBAR_TITLE', 'Aktionskupon');
define('HEADING_TITLE', 'Aktionskupon');
define('TEXT_INFORMATION', '');
define('TEXT_COUPON_FAILED', '<span class="alert important">%s</span> scheint kein gültiger Aktionskupon zu sein. Bitte überprüfen Sie die Nummer auf Ihrem Aktionskupon und geben Sie diese nochmals ein.');
define('HEADING_COUPON_HELP', 'Aktionskupon Hilfe');
define('TEXT_CLOSE_WINDOW', 'Fenster schließen [x]');
define('TEXT_COUPON_HELP_HEADER', '<p class="bold">Der eingegebene Code gehört zu ');
define('TEXT_COUPON_HELP_NAME', '\'%s\'. </p>');
define('TEXT_COUPON_HELP_FIXED', '');
define('TEXT_COUPON_HELP_MINORDER', '<p>Ein Mindestbestellwert von %s für geeignete Artikel ist Voraussetzung zur Nutzung dieses Kupons.</p>');
define('TEXT_COUPON_HELP_FREESHIP', '');
define('TEXT_COUPON_HELP_DESC', '<p><span class="bold">Aktionskuponangebot:</span> %s</p><p class="smallText">Folgende Einschränkungen bestehen:</p>');
define('TEXT_COUPON_HELP_DATE', '<p>Der Aktionskupon ist gültig von %s bis %s</p>');
define('TEXT_COUPON_HELP_RESTRICT', '<p class="biggerText bold">Aktionskupon Einschränkungen</p>');
define('TEXT_COUPON_HELP_CATEGORIES', '<p class="bold">Gültig für folgende Kategorien:</p>');
define('TEXT_COUPON_HELP_PRODUCTS', '<p class="bold">Gültig für folgende Artikel:</p>');
define('TEXT_ALLOW', 'ja');
define('TEXT_DENY', 'nein');
define('TEXT_NO_CAT_TOP_ONLY_DENY', '<p>Dieser Aktionskupon ist nur für bestimmte Artikel gültig.');
define('TEXT_NO_CAT_RESTRICTIONS', '<p>Aktionskupon ist für alle Kategorien gültig.</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>Aktionskupon ist für alle Artikel gültig.</p>');
define('TEXT_NO_PROD_SALES', '<p>Dieser Aktionskupon ist nicht gültig für Artikel im Sonderangebot.</p>');
define('TEXT_CAT_ALLOWED', ' (Gültig für diese Kategorie)');
define('TEXT_CAT_DENIED', ' (Nicht gültig für diese Kategorie)');
define('TEXT_PROD_ALLOWED', ' (Gültig für diesen Artikel)');
define('TEXT_PROD_DENIED', ' (Nicht gültig für diesen Artikel)');
// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','<p class="smallText">Aktionskupons können nicht zum Kauf von ' . TEXT_GV_NAMES . ' verwendet werden. Limit: 1 Aktionskupon pro Bestellung.</p>');
define('TEXT_DISCOUNT_COUPON_ID_INFO', 'Aktionskupon Informationen abfragen ... ');
define('TEXT_DISCOUNT_COUPON_ID', 'Ihr Code: ');
define('TEXT_COUPON_GV_RESTRICTION_ZONES', 'Mit dieser Rechnungsadresse können keine Aktionkupons eingelöst werden.');