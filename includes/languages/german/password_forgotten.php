<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id: password_forgotten.php 3086 2006-03-01 00:40:57Z drbyte $
 */

define('NAVBAR_TITLE_1','Anmelden');define('NAVBAR_TITLE_2','Passwort vergessen');define('HEADING_TITLE','Passwort vergessen');define('TEXT_MAIN','Tragen Sie Ihre e-Mail Adresse ein, um ein neues Passwort zu erhalten.');define('TEXT_NO_EMAIL_ADDRESS_FOUND','Achtung! Die e-Mail Adresse wurde nicht in unserer Datenbank gefunden.');define('EMAIL_PASSWORD_REMINDER_SUBJECT',STORE_NAME . ' - Neues Passwort');define('EMAIL_PASSWORD_REMINDER_BODY','Ein neues Passwort wurde angefordert von ' . $_SERVER['REMOTE_ADDR']  . '.' . "\n\n" . 'Ihr neues Passwort f&uuml;r \'' . STORE_NAME . '\' lautet:' . "\n\n" . '   %s' . "\n\n");define('SUCCESS_PASSWORD_SENT', 'Erfolgreich! Ein neues Passwort wurde an Ihre e-Mail Adresse versandt.');


?>