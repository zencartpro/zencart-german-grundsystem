<?php
/**
 * @package admin
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: users.php 729 2011-08-09 15:49:16Z hugo13 $
 */

define('HEADING_TITLE', 'Admin Benutzer');

define('IMAGE_ADD_USER', 'Benutzer hinzufügen');
define('IMAGE_RESET_PWD', 'Passwort zurücksetzen');

define('TEXT_ID', 'ID');
define('TEXT_NAME', 'Name');
define('TEXT_EMAIL', 'E-Mail');
define('TEXT_PROFILE', 'Profil');
define('TEXT_PASSWORD', 'Passwort');
define('TEXT_CONFIRM_PASSWORD', 'Passwort bestätigen');
define('TEXT_NO_USERS_FOUND', 'Keine Admin Benutzer gefunden');
define('TEXT_CONFIRM_DELETE', 'Löschung angefordert, bitte bestätigen: ');

define('ERROR_NO_USER_DEFINED', 'Die Aktion, die Sie ausführen wollen kann, nicht ohne Angabe eines Benutzers durchgeführt werden');
define('ERROR_USER_MUST_HAVE_PROFILE', 'Benutzer muss ein Profil zugeordnet werden');
define('ERROR_DUPLICATE_USER', 'Ein Benutzer mit diesem Namen existiert bereits, bitte wählen Sie einen anderen Namen.');
define('ERROR_ADMIN_NAME_TOO_SHORT', 'Der Benutzername muss mindestens %s Zeichen haben');
define('ERROR_PASSWORD_TOO_SHORT', 'Das Passwort muss mindestens %s Zeichen lang sein');
define('SUCCESS_NEW_USER_ADDED', 'Neuer Benutzer wurde hinzugefügt');
define('SUCCESS_USER_DETAILS_UPDATED', 'Benutzerdetails aktualisiert');
define('SUCCESS_PASSWORD_UPDATED', 'Passwort aktualisiert');
define('ERROR_ADMIN_INVALID_EMAIL_ADDRESS', 'Die angegebene E-Mail Adresse enthält ungültige Zeichen.');
define('ERROR_ADMIN_INVALID_CHARS_IN_USERNAME', 'Der angegebene Benutzername enthält ungültige Zeichen.');
