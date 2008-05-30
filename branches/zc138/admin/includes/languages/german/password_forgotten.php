<?php
/**
 * @package linkpoint_api_payment_module
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr    http://www.zen-cart.at    2007-01-03
 * @version $Id$
 */

// $Id$
//

define('HEADING_TITLE','Passwort erneut senden');
define('TEXT_ADMIN_EMAIL','Admin E-Mail Adresse:');
define('ERROR_WRONG_EMAIL','<p>Sie haben eine falsche E-Mail Adresse eingegeben.</p>');
define('ERROR_WRONG_EMAIL_NULL','<p>Netter Versuch :-P</p>');
define('SUCCESS_PASSWORD_SENT','<p>Ihr neues Passwort wurde an die angegebene E-Mail Adresse verschickt.</p>');
define('TEXT_EMAIL_SUBJECT',STORE_NAME . ' - Neues Passwort');
define('TEXT_EMAIL_FROM',EMAIL_FROM);
define('TEXT_EMAIL_MESSAGE', 'Ein neues Passwort wurde angefordert von ' . $_SESSION['REMOTE_ADDR'] . "\n\nIhr neues Passwort für '" . STORE_NAME . "' ist:\n\n   %s\n\n");
