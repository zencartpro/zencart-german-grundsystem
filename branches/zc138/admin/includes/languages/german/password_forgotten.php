<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id$
//

define('HEADING_TITLE','Passwort erneut senden');
define('TEXT_ADMIN_EMAIL','Admin E-Mail Adresse:');
define('ERROR_WRONG_EMAIL','<p>Sie haben eine falsche E-Mail Adresse eingegeben.</p>');
define('ERROR_WRONG_EMAIL_NULL','<p>Netter Versuch :-P</p>');
define('SUCCESS_PASSWORD_SENT','<p>Ihr neues Passwort wurde an die angegebene E-Mail Adresse versendet.</p>');
define('TEXT_EMAIL_SUBJECT',STORE_NAME . ' - Neues Passwort');
define('TEXT_EMAIL_FROM',EMAIL_FROM);
define('TEXT_EMAIL_MESSAGE', 'Ein neues Passwort wurde angefordert von ' . $_SESSION['REMOTE_ADDR'] . "\n\nIhr neues Passwort f&uuml;r '" . STORE_NAME . "' ist:\n\n   %s\n\n");



?>