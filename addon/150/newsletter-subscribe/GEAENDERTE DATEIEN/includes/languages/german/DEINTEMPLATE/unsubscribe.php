<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Originally Programmed By: Christopher Bradley (www.wizardsandwars.com) for OsCommerce
 * @copyright Modified by Jim Keebaugh for OsCommerce
 * @copyright Adapted for Zen Cart
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: unsubscribe.php 2012-08-03 10:05:14Z webchills $
 */

define('NAVBAR_TITLE', 'Newsletter abbestellen');
define('HEADING_TITLE', 'Newsletter abbestellen');

define('UNSUBSCRIBE_TEXT_INFORMATION', '<br />Schade, dass Sie unseren Newsletter nicht mehr abonnieren wollen. Wenn Sie Bedenken bezüglich unserer Bestimmungen für den Datenschutz haben, erhalten Sie <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><u>hier</u></a> weitere Informationen.<br /><br />Abonnementen unseres Newsletters erhalten Informationen über Artikel Neuerscheinungen, Sonderangebote oder Abverkäufe und über Neuerungen in unseren Shop.<br /><br />Wenn Sie den Newsletter nun abbestellen wollen, klicken Sie bitte auf den unten stehenden Button. ');
// you don't need to fill in UNSUBSCRIBE_TEXT_INFORMATION if you wish to edit the text from the Admin area
// This text only shows if the defined page is missing.
define('UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN', '<br />Schade, dass Sie unseren Newsletter nicht mehr abonnieren wollen. Wenn Sie Bedenken bezüglich unserer Bestimmungen für den Datenschutz haben, erhalten Sie <a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><u>hier</u></a> weitere Informationen.<br /><br />Abonnementen unseres Newsletters erhalten Informationen über Artikel Neuerscheinungen, Sonderangebote oder Abverkäufe und über Neuerungen in unseren Shop.<br /><br />Wenn Sie den Newsletter nun abbestellen wollen, klicken Sie bitte auf den unten stehenden Button. ');
define('UNSUBSCRIBE_DONE_TEXT_INFORMATION', '<br />Ihre E-Mail Adresse wurde wie gewünscht aus unserer Newsletter Datenbank entfernt. <br /><br />');
define('UNSUBSCRIBE_ERROR_INFORMATION', '<br />Die angegebene E-Mail Adresse konnte in unserer Newsletter Datenbank nicht gefunden werden oder wurde bereits aus dieser entfernt. <br /><br />');
// BEGIN newsletter_subscribe mod 1/1
//email unsubscribes
define('UNSUBSCRIBE_EMAIL_SUBJECT', 'Newsletter erfolgreich abgemeldet');
define('UNSUBSCRIBE_EMAIL_WELCOME', '' . "\n" . '<p />Newsletter Abmeldebestätigung von ' . STORE_NAME . '.<p />');
define('UNSUBSCRIBE_EMAIL_SEPARATOR', '--------------------');
define('UNSUBSCRIBE_EMAIL_TEXT', 'Ihre E-Mail Adresse wurde aus unserem Newsletter entfernt.<br />' . "\n" . '<p />' . "\n\n" . 'Sollten Sie unseren Newsletter später wieder einmal abonnieren wollen, können Sie ihn jederzeit auf unserer Website wieder anfordern.<p />' . "\n\n" . '');
define('UNSUBSCRIBE_EMAIL_CONTACT', '<br />Falls Sie Fragen dazu haben, mailen Sie uns an: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a><br />\n\n");
define('UNSUBSCRIBE_EMAIL_CLOSURE','Freundliche Grüße,' . "\n\n" . STORE_OWNER . "\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");
// send to admins when newsletter in unsubscribed
define('UNSUBSCRIBE_ADMIN_EMAIL_SUBJECT', 'Newsletterabmeldung');
define('UNSUBSCRIBE_ADMIN_EMAIL_TEXT', 'Newsletterabmeldung von: %s bei %s');

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('UNSUBSCRIBE_EMAIL_DISCLAIMER_NEW_CUSTOMER', 'Diese E-Mail Adresse wurde aus unserem Newsletter abgemeldet. Wenn Sie das für falsch halten, kontaktieren sie uns bitte.');
// END newsletter_subscribe mod 1/1
