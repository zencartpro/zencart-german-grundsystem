<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: specials.php 2023-11-14 20:33:16Z webchills $
 */

define('HEADING_TITLE','Sonderangebote');

define('TEXT_ADD_SPECIAL_SELECT', 'Sonderangebot per Auswahl hinzufügen');
define('TEXT_ADD_SPECIAL_PID', 'Sonderangebot per Artikel ID hinzufügen');
define('TEXT_SEARCH_SPECIALS', 'Aktuelle Sonderangebote suchen');
define('TEXT_SPECIAL_ACTIVE', 'Sonderangebotspreis aktiv');
define('TEXT_SPECIAL_INACTIVE', 'Sonderangebotspreis inaktiv');
define('TEXT_SPECIAL_STATUS_BY_DATE', 'Status per Datum gesetzt');

define('TEXT_SPECIALS_PRODUCT', 'Artikel:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Sonderpreis:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Startdatum Sonderpreis:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Ablaufdatum Sonderpreis:');

define('TEXT_INFO_NEW_PRICE', 'Sonderpreis:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Original Preis:');
define('TEXT_INFO_DISPLAY_PRICE', 'Derzeit angezeigter Preis:');
define('TEXT_INFO_STATUS_CHANGED', 'Status geändert:');

define('TEXT_INFO_HEADING_DELETE_SPECIALS','Sonderpreis löschen');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Sonderpreis wirklich löschen?');

define('WARNING_SPECIALS_PRE_ADD_PID_EMPTY', 'Warnung: Keine Artikel ID angegeben.');
define('WARNING_SPECIALS_PRE_ADD_PID_DUPLICATE', 'Warnung: Artikel ID#%u hat schon Sonderpreis.');
define('WARNING_SPECIALS_PRE_ADD_PID_NO_EXIST', 'Warnung: Artikel ID#%u existiert nicht.');

define('WARNING_SPECIALS_PRE_ADD_PID_GIFT', 'Warnung: Artikel ID#%u ist ein Geschenkgutschein.');
define('TEXT_INFO_HEADING_PRE_ADD_SPECIALS', 'Sonderpreis per Artikel ID hinzufügen');
define('TEXT_INFO_PRE_ADD_INTRO', 'Sie können einen Sonderpreis per Artikel ID eingeben. Das kann für Shops mit sehr vielen Artikeln nützlich sein, wenn das Laden der Artikelliste im Dropdown zu lange dauert oder einfach unbequem ist.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Artikel ID eingeben: ');
define('TEXT_SPECIALS_PRICE_NOTES_HEAD' , '<b>Hinweise:</b>');
define('TEXT_SPECIALS_PRICE_NOTES_BODY', '<li>Der Sonderpreis wird netto also exclusive Steuer eingegeben. Das Trennzeichen zwischen Euro und Cent MUSS ein "." (Punkt) sein, z.B.: <b>49.99</b>.</li><li>Der Sonderpreis kann auch ein prozentueller Rabatt sein, z.B. <b>20%</b>.</li><li>Startdatum/Enddatum sind nicht zwingend einzugeben. Lassen Sie das Enddatum einfach leer, falls der Sonderpreis nicht ablaufen soll.</li><li>Falls Datumsangaben eingegeben werden, wird sich der Status des Sonderangebots automatisch entsprechend ändern.</li>');
define('ERROR_INVALID_ACTIVE_DATE' , 'Das &quot;Aktivdatum&quot; ist nicht gültig, bitte neu eingeben.');
define('ERROR_INVALID_EXPIRES_DATE' , 'Das &quot;Ablaufdatums&quot; ist nicht gültig, bitte neu eingeben.');