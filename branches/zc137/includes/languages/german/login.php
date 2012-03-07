<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id: login.php 5458 2006-12-29 22:00:08Z drbyte $
 */

define('NAVBAR_TITLE','Anmelden');
define('HEADING_TITLE','Willkommen, bitte melden Sie sich an.');

define('HEADING_NEW_CUSTOMER','Sie sind neu hier? Dann erstellen Sie bitte Kundenkonto erstellen:');
define('HEADING_NEW_CUSTOMER_SPLIT', 'Neue Kunden');

define('TEXT_NEW_CUSTOMER_INTRODUCTION','Ein Kundenkonto bei ' . STORE_NAME . ' erm&ouml;glicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen u.v.m.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', 'Haben Sie ein PayPal Konto? M&ouml;chten mit einer Kreditkarte schnell zahlen? Klicken Sie auf den PayPal Button unten, um die Option &quot;Paypal Express&quot; zu verwenden.');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">oder</span><br />');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Ein Kundenkonto bei ' . STORE_NAME . ' erm&ouml;glicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen sowie weiterer Vorteile die Kunden vorbehalten sind.');

define('HEADING_RETURNING_CUSTOMER','Stammkunden: Bitte melden Sie sich an');
define('HEADING_RETURNING_CUSTOMER_SPLIT', 'Stammkunden ');

define('TEXT_RETURNING_CUSTOMER_SPLIT', 'Zum Fortfahren, bitte anmelden');

define('TEXT_PASSWORD_FORGOTTEN','Haben Sie Ihr Passwort vergessen?');

define('TEXT_LOGIN_ERROR','Achtung! E-Mail Adresse oder Passwort wurden nicht gefunden.');
define('TEXT_VISITORS_CART','<strong class="note">Hinweis:</strong> Der Inhalt Ihres aktuellen Warenkorbs wird nach Ihrer Anmeldung bzw. Registrierung in Ihrem &quot;pers&ouml;nlichen Warenkorb&quot; &uuml;bernommen. <a href="javascript:session_win();">[More Info]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS','Datenschutz');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION','Bitte best&auml;tigen Sie unsere Datenschutzbestimmungen. Sie k&ouml;nnen diese <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>hier</u></a> nachlesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM','Ich habe die Datenschutzbestimmungen gelesen und akzeptiert.');

?>