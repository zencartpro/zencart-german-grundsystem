<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* translatet from: cyaneo/hugo13 / www.zen-cart.at / 31.03.06 
* @version $Id: tell_a_friend.php 2 2006-03-31 09:55:33Z rainer $
*/

define('NAVBAR_TITLE','weiterempfehlen');

define('HEADING_TITLE', 'Weiterempfehlung für %s');

define('FORM_TITLE_CUSTOMER_DETAILS','Ihre Details');
define('FORM_TITLE_FRIEND_DETAILS','Details Ihres Freundes');
define('FORM_TITLE_FRIEND_MESSAGE','Ihre Nachricht');

define('FORM_FIELD_CUSTOMER_NAME','Ihr Name:');
define('FORM_FIELD_CUSTOMER_EMAIL','Ihre e-Mail Adresse:');
define('FORM_FIELD_FRIEND_NAME','Ihres Freundes Namen lautet:');
define('FORM_FIELD_FRIEND_EMAIL','Ihres Freundes e-Mail Adresse lautet:');

define('EMAIL_SEPARATOR','----------------------------------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT','Ihre Weiterempfehlung für <strong>%s</strong> wurde erfolgreich an <strong>%s</strong> versand.');

define('EMAIL_TEXT_HEADER','Wichtige Notiz!');

define('EMAIL_TEXT_SUBJECT',' Ihr Freund %s hat diesen Artikel bei  %s gefunden');
define('EMAIL_TEXT_GREET', 'Hallo %s!' . "\n\n");
define('EMAIL_TEXT_INTRO','<br /><br />Ihr Freund %s meint, dass Sie der Artikel <strong>%s</strong> bei %s interessieren könnte.');

define('EMAIL_TELL_A_FRIEND_MESSAGE','%s schreibt Ihnen:');

define('EMAIL_TEXT_LINK','Um den Artikel anzusehen, klicken Sie bitte auf den nachfolgenden Link:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', 'Mit freundlichen Grüssen,' . "\n\n" . '%s');

define('ERROR_TO_NAME','Achtung! Das Eingabefeld "der Name Ihres Freundes" darf nicht leer sein .');
define('ERROR_TO_ADDRESS','Achtung! Die e-Mail Adresse Ihres Freundes scheint ungültig zu sein.');
define('ERROR_FROM_NAME','Achtung! Das Eingabefeld "Ihr Name" darf nicht leer sein.');
define('ERROR_FROM_ADDRESS','Achtung! Ihre e-Mail Adresse scheint ungültig zu sein.');
// email advisory included warning for all emails customer generate - tell-a-friend and GV send
define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>Diese Nachricht wird an alle Mails, die von dieser Seite gesendet werden angehängt:</strong>');
?>
