<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: login.php 2023-10-28 19:49:16Z webchills $
 */

define('HEADING_TITLE', 'Admin Login');
define('HEADING_TITLE_EXPIRED', 'Admin Login - Passwort abgelaufen');

define('TEXT_SUBMIT','Absenden');

define('TEXT_ADMIN_PASS', 'Admin Passwort');
define('TEXT_ADMIN_OLD_PASSWORD', 'Altes Passwort');
define('TEXT_ADMIN_NEW_PASSWORD', 'Neues Passwort');
define('TEXT_ADMIN_CONFIRM_PASSWORD', 'Passwort bestätigen');
define('ERROR_WRONG_LOGIN', 'Benutzername und / oder Passwort falsch.');
define('ERROR_SECURITY_ERROR', 'Es gab einen Sicherheitsfehler, als Sie versucht haben sich anzumelden.');
define('TEXT_PASSWORD_FORGOTTEN', 'Passwort vergessen?');

define('LOGIN_EXPIRY_NOTICE', '');
define('ERROR_PASSWORD_EXPIRED', 'HINWEIS: Die Gültigkeit Ihres Passworts ist abgelaufen. Bitte wählen Sie ein neues Passwort. Ihr Passwort <strong>muss Zahlen und Buchstaben enthalten und mindestens 7 Zeichen lang sein.</strong>');
define('TEXT_TEMPORARY_PASSWORD_MUST_BE_CHANGED', 'Aus Sicherheitsgründen muss Ihr temporäres Passwort geändert werden. Bitte wählen Sie ein neues Passwort.<br>Ihr Passwort <strong>muss Zahlen und Buchstaben enthalten und mindestens 7 Zeichen lang sein.</strong>');
define('SUCCESS_PASSWORD_UPDATED', 'Passwort aktualisiert');

define('TEXT_EMAIL_SUBJECT_LOGIN_FAILURES', 'Benachrichtigung über mehrere fehlgeschlagene Admin Anmeldeversuche');
define('TEXT_EMAIL_MULTIPLE_LOGIN_FAILURES', 'Wichtiger HINWEIS: Es gab mehrere fehlgeschlagene Anmeldeversuche für Ihr administratives Benutzerkonto. Zu Ihrer Sicherheit und für die Sicherheit des Shops wird Ihr Benutzerkonto nach 6 erfolglosen Loginversuchen für mindestens 30 Minuten gesperrt. In dieser Zeit ist keine Anmeldung möglich, selbst wenn Sie sich mit dem korrekten Passwort anmelden wollen. Weitere erfolglose Anmeldeversuche sperren Ihr Benutzerkonto für weitere 30 Minuten. Während dieser Zeit ist es Ihnen nicht möglich, ihr Passwort zurückzusetzen. Wir bitten diese Unannehmlichkeiten zu entschuldigen.' . "\n\nDer letzte Anmeldeversuch kam von dieser IP-Adresse: %s.\n\n\n");

define('EXPIRED_DUE_TO_SSL', 'HINWEIS: Die Gültigkeit Ihres Passwort ist abgelaufen weil der Shop auf SSL Verschlüsselung (höhere Sicherheit) umgestellt wurde. Die Passwortänderung unter SSL ist ein wichtiger Schritt zu größerer Sicherheit. Entschuldigen Sie bitte die Unannehmlichkeiten. Es gelten die für den Shop eingestellten Passwortregeln.');
