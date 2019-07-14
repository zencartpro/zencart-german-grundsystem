<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: password_forgotten.php 629 2016-03-05 09:05:14Z webchills $
 */

define('HEADING_TITLE','Passwort zurücksetzen');
define('TEXT_ADMIN_EMAIL','Admin E-Mail Adresse:');
define('TEXT_BUTTON_REQUEST_RESET', 'Neues Passwort anfordern');
define('TEXT_BUTTON_LOGIN', 'Anmelden');
define('TEXT_BUTTON_CANCEL', 'Abbrechen');
define('ERROR_WRONG_EMAIL','Sie haben eine falsche E-Mail Adresse eingegeben.');
define('ERROR_WRONG_EMAIL_NULL','Netter Versuch :-P');
define('MESSAGE_PASSWORD_SENT','Falls die angegebene E-Mailadresse einen Admin Account im Shop hat, wurde ein neues Passwort an die angegebene E-Mail Adresse verschickt.<br />Klicken Sie auf LOGIN um sich mit dem neuen temporären Passwort anzumelden.</p>');
define('TEXT_EMAIL_SUBJECT_PWD_RESET', 'Ihre neues temporäres Passwort');
define('TEXT_EMAIL_MESSAGE_PWD_RESET', 'Es wurde eine neues Passwort von der IP Adresse %s angefordert.' . "\n\n" . 'Ihr neues temporäres Passwort ist:' . "\n\n" . '%s' . "\n\n" . 'Bei der Anmeldung werden sie aufgefordert, ein neues Passwort zu erstellen.' . "\n\n" . 'Dieses temporäre Passwort wird nach 24 Stunden ungültig.' . "\n\n\n");