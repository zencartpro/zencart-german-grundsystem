<?php
/**
 
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: admin_page_registration.php 2023-10-28 17:49:16Z webchills $
 */

define('HEADING_TITLE', 'Admin Seiten Registrierung');
define('TEXT_PAGE_KEY', 'Seitenschlüssel');
define('TEXT_LANGUAGE_KEY', 'Seitenname');
define('TEXT_MAIN_PAGE', 'Seiten Dateiname');
define('TEXT_PAGE_PARAMS', 'Seiten Parameter');
define('TEXT_MENU_KEY', 'Menü');
define('TEXT_DISPLAY_ON_MENU', 'Anzeigen im Menü?');


define('TEXT_EXAMPLE_PAGE_KEY', '(z.B. meinModulSeitenName)');
define('TEXT_EXAMPLE_LANGUAGE_KEY', '(z.B. BOX_MEIN_MOD_SEITEN_NAME)');
define('TEXT_EXAMPLE_MAIN_PAGE', '(z.B. DATEINAME_SEITEN_NAME)');
define('TEXT_EXAMPLE_PAGE_PARAMS', '(z.B. option=1 oder im Normalfall leer lassen)');
define('TEXT_SELECT_MENU', 'Menü wählen');

define('ERROR_PAGE_KEY_NOT_ENTERED', 'Keinen Seitenschlüssel eingegeben. Alle Admin Seiten müssen einen einzigartigen Seitenschlüssel haben.');
define('ERROR_PAGE_KEY_ALREADY_EXISTS', 'Seitenschlüssel bereits vorhanden. Seitenschlüssel müssen einzigartig sein.');
define('ERROR_LANGUAGE_KEY_NOT_ENTERED', 'Language key not entered. All admin page must have a language key that defines the text on any menu link.');
define('ERROR_LANGUAGE_KEY_HAS_NOT_BEEN_DEFINED', 'The language key entered has not been defined. Please check that it has been spelt correctly.');
define('ERROR_MAIN_PAGE_NOT_ENTERED', 'Es wurde kein gültiger Dateiname für die Admin Seite eingegeben.');
define('ERROR_FILENAME_HAS_NOT_BEEN_DEFINED', 'Der eingegebene Dateiname existiert nicht, bitte prüfen The filename definition entered does not exist. Please check that it has been spelt correctly.');
define('ERROR_MENU_NOT_CHOSEN', 'Kein Menü ausgewählt. Sie müssen eine Admin Seite immer einem Menü zuordnen, auch wenn Sie die Seite nicht im Menü anzeigen lassen wollen.');
define('SUCCESS_ADMIN_PAGE_REGISTERED', 'Ihre Admin Seite wurde angelegt.');
