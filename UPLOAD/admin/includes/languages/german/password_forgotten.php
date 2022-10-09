<?php
/**
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: password_forgotten.php 2022-10-07 16:59:14Z webchills $
 */

define('HEADING_TITLE','Passwort zurücksetzen');
define('TEXT_ADMIN_EMAIL','Admin E-Mail Adresse:');
define('TEXT_ADMIN_USERNAME', 'Admin Username');
define('TEXT_BUTTON_REQUEST_RESET', 'Neues Passwort anfordern');
define('TEXT_BUTTON_LOGIN', 'Anmelden');
define('TEXT_BUTTON_CANCEL', 'Abbrechen');
define('ERROR_WRONG_EMAIL','Sie haben eine falsche E-Mail Adresse eingegeben.');
define('ERROR_WRONG_EMAIL_NULL','Netter Versuch :-P');
define('MESSAGE_PASSWORD_SENT','Falls die angegebene E-Mailadresse einen Admin Account im Shop hat, wurde ein neues Passwort an die angegebene E-Mail Adresse verschickt.<br>Klicken Sie auf ANMELDEN um sich mit dem neuen temporären Passwort anzumelden.</p>');
define('TEXT_EMAIL_SUBJECT_PWD_RESET', 'Ihre neues temporäres Passwort');
define('TEXT_EMAIL_MESSAGE_PWD_RESET', 'Es wurde eine neues Passwort von der IP Adresse %s angefordert.' . "\n\n" . 'Ihr neues temporäres Passwort ist:' . "\n\n" . '%s' . "\n\n" . 'Bei der Anmeldung werden sie aufgefordert, ein neues Passwort zu erstellen.' . "\n\n" . 'Dieses temporäre Passwort wird nach 24 Stunden ungültig.' . "\n\n\n");
define('TEXT_EMAIL_SUBJECT_PWD_FAILED_RESET', 'Zugriffswarnung!');
define('TEXT_EMAIL_MESSAGE_PWD_FAILED_RESET', "Fehlgeschlagene Versuche, das Administrator-Passwort zurückzusetzen wurden erhalten von %s\n\nUngültige E-Mail und/oder ungültiger Benutzername angegeben.\n\nWenn Sie Administratorkonten mit derselben E-Mail-Adresse haben, sollten Sie in Erwägung ziehen, ihnen eindeutige E-Mail-Adressen zuzuweisen, um das Zurücksetzen zu erleichtern.");