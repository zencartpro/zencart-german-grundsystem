<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2007-01-03
 * @version $Id: login.php 5458 2006-12-29 22:00:08Z drbyte $
 */

define('NAVBAR_TITLE','anmelden');
define('HEADING_TITLE','Willkommen, bitte melden Sie sich an.');

define('HEADING_NEW_CUSTOMER','Sie sind neu hier? Dann bitte Kundenkonto erstellen:');
define('HEADING_NEW_CUSTOMER_SPLIT', 'New Customers' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');

define('TEXT_NEW_CUSTOMER_INTRODUCTION','Ein Kundenkonto bei ' . STORE_NAME . ' erm&ouml;glicht Ihnen z.B. komfortabel einzukaufen, sich Ihre aktuellen und bisherigen Bestellungen anzusehen u.v.m.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', 'Have a PayPal account? Want to pay quickly with a credit card? Use the PayPal button below to use the Express Checkout option.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">Or</span><br />' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', 'Create a Customer Profile with <strong>' . STORE_NAME . '</strong> which allows you to shop faster, track the status of your current orders, review your previous orders and take advantage of our other member\'s benefits.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');

define('HEADING_RETURNING_CUSTOMER','Stammkunden: Bitte melden Sie sich an');
define('HEADING_RETURNING_CUSTOMER_SPLIT', 'Returning Customers' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');

define('TEXT_RETURNING_CUSTOMER_SPLIT', 'In order to continue, please login to your <strong>' . STORE_NAME . '</strong> account.' . ' !!!TRANSLATE!!! file: includes/languages/LANGUAGE/login.php at line 357');

define('TEXT_PASSWORD_FORGOTTEN','Haben Sie Ihr Passwort vergessen?');

define('TEXT_LOGIN_ERROR','Achtung! e-Mail Adresse oder Passwort wurden nicht gefunden.');
define('TEXT_VISITORS_CART','<strong class="note">Hinweis:</strong> Der Inhalt Ihres "Besucherwarenkorbs" wird nach Ihrer Anmeldung in Ihren pers&ouml;nlichen "Kundenwarenkorb" verschoben. <a href="javascript:session_win();">[More Info]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS','Privatsph&auml;re');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION','Bitte best&auml;tigen Sie unsere AGB. Sie k&ouml;nnen diese <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>hier</u></a> nachlesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM','Ich habe die AGB gelesen und akzeptiert.');

?>