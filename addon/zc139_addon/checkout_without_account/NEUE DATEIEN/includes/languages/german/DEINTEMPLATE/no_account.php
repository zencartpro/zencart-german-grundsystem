<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright Joseph Schilz
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: no_account.php for COWOA 2.0 ZC139 2010-10-27 09:55:39Z webchills $
 */

define('NAVBAR_TITLE', 'Rechnungsinformation');

define('HEADING_TITLE', 'Schritt 1 von 4 - Rechnungsinformation');

define('TEXT_ORIGIN_LOGIN', 'Wenn Sie bereits ein Kundenkonto bei uns haben, melden Sie sich bitte <a href="%s"><u>hier</u></a> an.');
define('TEXT_LEGEND_HEAD', 'Neues Kundenkonto');
define('TEXT_MORE', 'Für alle Neukunden richten wir einen Geschenk-Coupon in Höhe von 10% ein. Diesen können sie bei Ihrer Bestellung einlösen.<br /><br />Um diesen zu erhalten, melden Sie sich in unserem Shop an.');
define('EMAIL_TEXT_COWOA', 'Pflichtfeld');

// greeting salutation
define('EMAIL_SUBJECT', 'Herzlich Willkommen bei ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Hallo Herr %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Hallo Frau %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Hallo %s' . "\n\n");

// First line of the greeting
define('EMAIL_WELCOME', 'Wir möchten sie herzlich bei <strong>' . STORE_NAME . '</strong> begrüßen.');
define('EMAIL_SEPARATOR', '--------------------');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Glückwunsch! Um Ihren Besuch in unserem Online-Shop zu belohnen, werden wir für Ihre nächste Bestellung einen Geschenk-Coupon ausstellen, den Sie dann hier einlösen können!' . "\n\n");
// your Discount Coupon Description will be inserted before this next define
define('EMAIL_COUPON_REDEEM', 'Um den Geschenk-Coupon zu verwenden treten Sie ein ' . TEXT_GV_REDEEM . ' Code für Ihre Bestellung:  <strong>%s</strong>' . "\n\n");

define('EMAIL_GV_INCENTIVE_HEADER', 'Just for stopping by today, we have sent you a ' . TEXT_GV_NAME . ' for %s!' . "\n");
define('EMAIL_GV_REDEEM', 'Der ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . ' ist: %s ' . "\n\n" . 'Sie können den ' . TEXT_GV_REDEEM . ' nach Ihrer Bestellung hier im Shop einlösen. ');
define('EMAIL_GV_LINK', ' Oder Sie können diesen über den Link einlösen: ' . "\n");
// GV link will automatically be included before this line

define('EMAIL_GV_LINK_OTHER','Sobald Sie den ' . TEXT_GV_NAME . ' zu Ihrer Rechnung beigefügt haben, können Sie diesen verwenden ' . TEXT_GV_NAME . ' Für Sie selbst oder einen Freund!' . "\n\n");

define('EMAIL_TEXT', 'HINWEIS: Dieses Email ist nur eine Information an Sie als Admin, dass dieser Kunde soeben eine Bestellung ohne Kundenkonto gestartet hat. Der Kunde hat kein solches Willkommensemail erhalten, da er die COWOA Funktion genutzt und kein echtes Kundenkonto hat!');
define('EMAIL_CONTACT', '-');
define('EMAIL_GV_CLOSURE','-');

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Im Folgenden sehen Sie die Details zu diesem COWOA Kunden:');

define('TABLE_HEADING_CONTACT_DETAILS', 'Kontakt Details');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Weiter zu Schritt 2');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- teilen Sie uns Ihre Lieferadresse mit.');

