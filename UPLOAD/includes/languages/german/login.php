<?php
/**
 * Zen Cart German Specific
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 
 * @version $Id: login.php 2019-06-24 19:05:14Z webchills $
 */

define('NAVBAR_TITLE','Anmelden');
define('HEADING_TITLE','Willkommen, bitte melden Sie sich an.');

define('HEADING_NEW_CUSTOMER','Sie sind neu hier? Dann erstellen Sie bitte ein Kundenkonto');
define('HEADING_NEW_CUSTOMER_SPLIT', 'Neukunden');

define('TEXT_NEW_CUSTOMER_INTRODUCTION','Ein Kundenkonto bei ' . STORE_NAME . ' ermöglicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen u.v.m.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', 'Haben Sie ein PayPal Konto? Sie möchten mit einer Kreditkarte schnell zahlen? Klicken Sie auf den PayPal Button unten, um die Option "Paypal Express" zu verwenden.');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">oder</span><br />');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Ein Kundenkonto bei ' . STORE_NAME . ' ermöglicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen sowie alle Vorteile zu nutzen, die Kunden vorbehalten sind.');

define('HEADING_RETURNING_CUSTOMER','Stammkunden: Bitte melden Sie sich an');
define('HEADING_RETURNING_CUSTOMER_SPLIT', 'Stammkunden ');

define('TEXT_RETURNING_CUSTOMER_SPLIT', 'Zum Fortfahren, bitte anmelden');

define('TEXT_PASSWORD_FORGOTTEN','Passwort vergessen?');

define('TEXT_LOGIN_ERROR','Achtung! E-Mail Adresse oder Passwort wurden nicht gefunden.');
define('TEXT_VISITORS_CART','<strong class="note">Hinweis:</strong> Der Inhalt Ihres aktuellen Besucher Warenkorbs wird nach Ihrer Anmeldung bzw. Registrierung in Ihren Kunden Warenkorb übernommen. <a href="javascript:session_win();">[Hilfe]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS','Datenschutz');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION','Bitte bestätigen Sie unsere Datenschutzbestimmungen. Sie können diese <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>hier</u></a> nachlesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM','Ich habe die Datenschutzbestimmungen gelesen und akzeptiert.');
define('ERROR_SECURITY_ERROR', 'Es gab einen Sicherheitsfehler, als Sie versucht haben sich anzumelden.');
define('TEXT_LOGIN_BANNED', 'FEHLER: Zugriff verweigert.');
define('HEADING_PAYPAL_CUSTOMER_SPLIT', 'Login und Bezahlen mit PayPal');
define('TEXT_PAYPAL_CUSTOMER_SPLIT', 'Express Checkout mit PayPal: Bei der Anmeldung mit PayPal über den PayPal Express Button werden Ihre bei PayPal hinterlegten Kontaktdaten für ein Kundenkonto in unserem Onlineshop genutzt. Sie müssen Ihre Daten nicht eintippen und wickeln die Zahlung über PayPal ab.');
