<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright Joseph Schilz
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: webchills - 2009-01-09
 */

define('NAVBAR_TITLE', 'Rechnungsinformation');

define('HEADING_TITLE', 'Schritt 1 von 4 - Rechnungsinformation');

define('TEXT_ORIGIN_LOGIN', 'Wenn Sie ein Kundenkonto bei uns haben, melden Sie sich <a href="%s"><u>hier</u></a> an.');
define('TEXT_LEGEND_HEAD', 'Neuer Account');
define('TEXT_MORE', 'Für alle Neukunden richten wir einen Geschenk-Coupon in Höhe von 10% ein. Diesen können sie bei Ihrer Bestellung einlösen.<br /><br />Um diesen zu erhalten, melden Sie sich in unserem Shop an.');

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

define('EMAIL_TEXT', 'Mit Ihrem Account, können Sie jetzt unsere <strong>Dienstleistung</strong> die wir bereit stellen nutzen. Einige dieser Dienstleistungen schließen ein:' . "\n\n" . '<li><strong>Dauerhafter Warenkorb</strong> - Ihre ausgewählten Produkte werden dort angezeigt, bis diese entfernt oder als Bestellung gesendet werden.' . "\n\n" . '<li><strong>Adressbuch</strong> - Wir können Ihre Produkte an eine andere Adresse außer Ihrem eigenen liefern. Um Geburtstag-Geschenke direkt an die Geburtstags-Person selbst zu senden.' . "\n\n" . '<li><strong>Bestell-History</strong> - Sehen Sie hier Ihre Einkäufe, die Sie bei uns getätigt haben.' . "\n\n" . '<li><strong>Produkt-Bewertung</strong> - Teilen Sie Ihre Meinung zu den Produkt für andere Kunden mit.' . "\n\n" . 'Ein Geschenk-Coupon - Als Dank das Sie sich in unserem Shop angemeldet haben, haben wir in Höhe von 10% für Sie bereit gestellt. Sie können den Gutschein einmalig für Ihre Bestellung, egal ob groß oder klein einlösen. Der Coupon-Code hierfür lautet:  \'08825bbc50\'.  Um diesen Code zu verwenden, tragen Sie diesen im entsprechenden Feld der Bestellungbestätigung ein.' . "\n\n");
define('EMAIL_CONTACT', 'Für Hilfe unseres Online-Service senden Sie einfach eine Mail: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");
define('EMAIL_GV_CLOSURE','Mit freundlichen Grüßen,' . "\n\n" . STORE_OWNER . "\nStore Owner\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Diese E-Mail-Adresse wurde uns von Ihnen oder von einem unserer Kunden gegeben. Wenn Sie diese E-Mail irrtümlicherweise erhalten haben, senden Sie bitte eine E-Mail an %s ');

define('TABLE_HEADING_CONTACT_DETAILS', 'Kontakt Details');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Weiter zu Schritt 2');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- teilen Sie uns Ihre Lieferadresse mit.');

