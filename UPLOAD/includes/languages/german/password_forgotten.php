<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0 
 * @version $Id: password_forgotten.php 628 2018-04-01 10:05:14Z webchills $
 */

define('NAVBAR_TITLE_1','Anmelden');
define('NAVBAR_TITLE_2','Passwort vergessen');
define('HEADING_TITLE','Passwort vergessen');
define('TEXT_MAIN','Tragen Sie Ihre E-Mail Adresse ein, um ein neues Passwort zu erhalten.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT',STORE_NAME . ' - Neues Passwort');
define('EMAIL_PASSWORD_REMINDER_BODY','Ein neues Passwort wurde angefordert von ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . 'Ihr neues Passwort für \'' . STORE_NAME . '\' lautet:' . "\n\n" . '   %s' . "\n\nNachdem Sie mit dem neuen Passwort eingeloggt haben, ändern Sie das Passwort bitte auf eines Ihrer Wahl im Bereich 'Mein Konto'");
define('SUCCESS_PASSWORD_SENT', 'Falls Ihre Emailadresse mit einem Kundenkonto in unserem Shop verknüpft ist, wurde soeben ein neues Passwort an Ihre E-Mail Adresse versandt.');
