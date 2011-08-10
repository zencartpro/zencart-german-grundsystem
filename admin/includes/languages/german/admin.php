<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: admin.php 294 2008-05-29 05:01:46Z maleborg $
// $Id: admin.php 294 2008-05-29 05:01:46Z maleborg $ xx        xx

define('HEADING_TITLE','Administratoren');

define('TABLE_HEADING_ADMINS_NAME','Admin Name');
define('TABLE_HEADING_ADMINS_ID','ID');
define('TABLE_HEADING_ADMINS_EMAIL','E-Mail');
define('TABLE_HEADING_ACTION','Aktion');

define('TEXT_HEADING_NEW_ADMIN','Neu');
define('TEXT_HEADING_EDIT_ADMIN','Ändern');
define('TEXT_HEADING_DELETE_ADMIN','Löschen');
define('TEXT_HEADING_RESET_PASSWORD','Passwort löschen');

define('TEXT_ADMINS','Administratoren:');
define('TEXT_ADMINS_EMAIL','E-Mail:');

define('TEXT_NEW_INTRO','Bitte geben Sie folgende Information für den neuen Administrator an');
define('TEXT_EDIT_INTRO','Bitte führen Sie hier die notwendigen Änderungen durch');

define('TEXT_ADMINS_NAME','Admin Name:');
define('TEXT_ADMINS_PASSWORD','Passwort:');
define('TEXT_ADMINS_CONFIRM_PASSWORD','Passwort bestätigen:');

define('TEXT_DELETE_INTRO','Sind Sie sicher, dass Sie diesen Administrator löschen wollen?');
define('TEXT_DELETE_IMAGE','Admin Bild löschen?');


define('ENTRY_PASSWORD_NEW_ERROR','Ihr neues Passwort muss mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING','Die Passwörter stimmen nicht überein!');

define('TEXT_ADMINS_LEVEL','Admin Level dieser Anmeldung:');
define('TEXT_ADMIN_LEVEL_INSTRUCTIONS','Die Änderung des Admin Levels auf  Level 1 erlaubt das Überschreiben der Einstellungen, die durch dem "Demo" Admin getätigt wurden. Nur Admins mit Level 1 können die Admin Anmeldung sowie Passwörter ändern.');
define('TEXT_ADMIN_DEMO','Der Modus "Demo Admin" reduziert die Rechte eines Administrators in den wichtigsten Einstellungen auf "nur lesen". Somit können "Demo Admins" den vollen Funktionsumfang einsehen und kennen lernen, jedoch keine Systemrelevanten Einstellungen ändern.<br />Bitte stellen Sie sicher, dass Sie den Demo Admin auf Level "0" gesetzt haben, bevor Sie diesen aktivieren.');
define('TEXT_DEMO_STATUS','Derzeitiges Level des Demo Admins:');
define('TEXT_DEMO_OFF','Aus');
define('TEXT_DEMO_ON','Ein');
