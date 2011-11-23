<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart-pro.at/index.php                                     |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart-pro.at/license/2_0.txt.                              |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

// $Id: define_pages_editor.php 627 2010-08-30 15:05:14Z webchills $
//

define('HEADING_TITLE', 'Definiere Seiten für: ');
define('NAVBAR_TITLE', 'Definiere Seiten');
define('TEXT_INFO_EDIT_PAGE', 'Wählen Sie eine Seite zum Bearbeiten aus:');
define('TEXT_INFO_MAIN_PAGE', 'Startseite');
define('TEXT_INFO_SHIPPINGINFO', 'Preise und Versand');
define('TEXT_INFO_PRIVACY', 'Datenschutzbestimmungen');
define('TEXT_INFO_CONDITIONS', 'AGB');
define('TEXT_INFO_CONTACT_US', 'Impressum & Kontakt');
define('TEXT_INFO_CHECKOUT_SUCCESS', 'Bestellbestätigung');
define('TEXT_INFO_PAGE_2', 'Seite 2');
define('TEXT_INFO_PAGE_3', 'Seite 3');
define('TEXT_INFO_PAGE_4', 'Seite 4');
define('TEXT_FILE_DOES_NOT_EXIST', 'Die Datei existiert nicht: %s');
define('ERROR_FILE_NOT_WRITEABLE', 'FEHLER: In die Datei kann nicht geschrieben werden. Bitte ändern Sie die Berechtigung von: %s');
define('TEXT_INFO_SELECT_FILE', 'Wählen Sie eine Seite zum Bearbeiten aus ...');
define('TEXT_INFO_EDITING', 'Editiere Datei:');
define('TEXT_INFO_CAUTION','HINWEIS: Sie sollten immer nur die Dateien Ihres aktuellen Templates bearbeiten, z.B.: /languages/' . $_SESSION['language'] . '/html_defines/' . $template_dir . '<br />Nach den Änderungen sollten Sie eine Sicherung Ihrer Dateien erstellen.');
