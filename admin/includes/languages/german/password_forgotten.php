<?php
/**
 * @package admin
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: password_forgotten.php 627 2010-08-30 15:05:14Z webchills $
 */

// $Id: password_forgotten.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE','Passwort erneut senden');
define('TEXT_ADMIN_EMAIL','Admin E-Mail Adresse:');
define('TEXT_BUTTON_REQUEST_RESET', 'Neues Passwort anfordern');
define('TEXT_BUTTON_LOGIN', 'Anmelden');
define('TEXT_BUTTON_CANCEL', 'Abbrechen');
define('ERROR_WRONG_EMAIL','<p>Sie haben eine falsche E-Mail Adresse eingegeben.</p>');
define('ERROR_WRONG_EMAIL_NULL','<p>Netter Versuch :-P</p>');
define('MESSAGE_PASSWORD_SENT','<p>Ihr neues Passwort wurde an die angegebene E-Mail Adresse verschickt.<br />Klicken Sie auf LOGIN um sich mit dem neuen temporären Passwort anzumelden.</p>');
define('TEXT_EMAIL_SUBJECT_PWD_RESET', STORE_NAME . ' - Ihre neues temporäres Passwort');
define('TEXT_EMAIL_MESSAGE_PWD_RESET', 'Es wurde eine neues Passwort von %s angefordert.' . "\n\n" . 'Ihr neues temporäres Passwort ist:' . "\n\n" . '%s' . "\n\n" . 'Bei der Anmeldung weden sie aufgefordert, ein neues Passwort zu erstellen.' . "\n\n" . 'Dieses temporäre passwort wird nach 24 Stunden ungültig.' . "\n\n\n");
