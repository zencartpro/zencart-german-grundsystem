<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 *   Translator:           klartexter unter Verwendung der                
 *                         Vorlagen von cyaneo/hugo13         
 *   Date of Translation:  06.09.2006                          
 *   Homepage:             www.zen-cart.at            
 *
 *  @version $Id: english.php 4385 2006-09-04 04:10:48Z drbyte $
 */

// added defines for header alt and text
define('HEADER_ALT_TEXT', 'Admin Powered by Zen Cart :: The Art of E-Commerce');
define('HEADER_LOGO_WIDTH', '200px');
define('HEADER_LOGO_HEIGHT', '70px');
define('HEADER_LOGO_IMAGE', 'logo.gif');
// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'de_DE.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d.%m.%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'dd.MM.yyyy'); //Use only 'dd', 'MM' and 'yyyy' here in any order

// //
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function zen_date_raw($date, $reverse = false){
    if ($reverse){
        return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
        }else{
        // edit by cyaneo for german Date support - thx to hugo13
        // return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
        return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
        }
    }

// removed for meta tags
// page title
//define('TITLE', 'Zen Cart');

// include template specific meta tags defines
if (file_exists(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');
// die(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');
// meta tags
define('ICON_METATAGS_ON', 'Meta Tags definiert');
define('ICON_METATAGS_OFF', 'Meta Tags nicht definiert');
define('TEXT_LEGEND_META_TAGS', 'Meta Tags definiert:');
define('TEXT_INFO_META_TAGS_USAGE', '<strong>Hinweis:</strong> Site/Tagline ist Ihre Einstellung f&uuml;r Ihre Seite in der Datei meta_tags.php.');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Startseite');
define('HEADER_TITLE_SUPPORT_SITE', 'Support');
define('HEADER_TITLE_ONLINE_CATALOG', 'Webshop');
define('HEADER_TITLE_VERSION', 'Version');
define('HEADER_TITLE_LOGOFF', 'Abmelden');
//define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
define('TEXT_GV_NAME', 'Gutschein');
define('TEXT_GV_NAMES', 'Gutscheine');
define('TEXT_DISCOUNT_COUPON', 'Rabattmarke');

// used for redeem code, redemption code, or redemption id
define('TEXT_GV_REDEEM', 'Gutscheinnummer');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd.mm.yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfiguration');
define('BOX_CONFIGURATION_MYSTORE', 'Mein Shop');
define('BOX_CONFIGURATION_LOGGING', 'Protokollierung');
define('BOX_CONFIGURATION_CACHE', 'Speicherverwaltung');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlungsarten');
define('BOX_MODULES_SHIPPING', 'Versandarten');
define('BOX_MODULES_ORDER_TOTAL', 'Bestellarten');
define('BOX_MODULES_PRODUCT_TYPES', 'Artikeltypen');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Webshop');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien & Artikel');
define('BOX_CATALOG_PRODUCT_TYPES', 'Artikeltypen');
define('BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'Attributnamen');
define('BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'Attributmerkmale');
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller');
define('BOX_CATALOG_REVIEWS', 'Bewertungen');
define('BOX_CATALOG_SPECIALS', 'Sonderangebote');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Artikel Neuerscheinungen');
define('BOX_CATALOG_SALEMAKER', 'Abverkaufsmanager');
define('BOX_CATALOG_PRODUCTS_PRICE_MANAGER', 'Artikelpreis Manager');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');
define('BOX_CUSTOMERS_GROUP_PRICING', 'Gruppenpreise');
define('BOX_CUSTOMERS_PAYPAL', 'PayPal IPN');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'L&auml;nder & Steuern');
define('BOX_TAXES_COUNTRIES', 'L&auml;nder');
define('BOX_TAXES_ZONES', 'Bundesl&auml;nder');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen');
define('BOX_TAXES_TAX_RATES', 'Steuers&auml;tze');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Statistiken');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Besuchte Artikel');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Gekaufte Artikel');
define('BOX_REPORTS_ORDERS_TOTAL', 'Umsatz pro Kunde');
define('BOX_REPORTS_PRODUCTS_LOWSTOCK', 'Artikelbestand');
define('BOX_REPORTS_CUSTOMERS_REFERRALS', 'Herkunftsverweise (Referrals)');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_ADMIN', 'Administratoren');
define('BOX_TOOLS_TEMPLATE_SELECT', 'Templates');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_BANNER_MANAGER', 'Bannermanager');
define('BOX_TOOLS_CACHE', 'Cache-Kontrolle');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen');
define('BOX_TOOLS_FILE_MANAGER', 'Dateimanager');
define('BOX_TOOLS_MAIL', 'Rundschreiben');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online?');
define('BOX_TOOLS_STORE_MANAGER', 'Shopmanager');
define('BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'Developers Tool Kit');
define('BOX_TOOLS_SQLPATCH','SQL Patches installieren');
define('BOX_TOOLS_EZPAGES','EZ-Pages');  // new 1.3.0

define('BOX_HEADING_EXTRAS', 'Extras');

// define pages editor files
define('BOX_TOOLS_DEFINE_PAGES_EDITOR', 'Seiteneditor');
define('BOX_TOOLS_DEFINE_MAIN_PAGE', 'Startseite');
define('BOX_TOOLS_DEFINE_CONTACT_US', 'Kontakt');
define('BOX_TOOLS_DEFINE_PRIVACY', 'Datenschutz');
define('BOX_TOOLS_DEFINE_SHIPPINGINFO', 'Preise und Versand');
define('BOX_TOOLS_DEFINE_CONDITIONS', 'AGB');
define('BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS', 'Bestellbest&auml;tigung');
define('BOX_TOOLS_DEFINE_PAGE_2', 'Seite 2');
define('BOX_TOOLS_DEFINE_PAGE_3', 'Seite 3');
define('BOX_TOOLS_DEFINE_PAGE_4', 'Seite 4');


// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalisation');
define('BOX_LOCALIZATION_CURRENCIES', 'W&auml;hrungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');

// gift vouchers box text in includes/boxes/gv_admin.php
define('BOX_HEADING_GV_ADMIN', TEXT_GV_NAMES . ' & Kupons');
define('BOX_GV_ADMIN_QUEUE', 'in Warteschleife');
define('BOX_GV_ADMIN_MAIL', TEXT_GV_NAME . ' senden ');
define('BOX_GV_ADMIN_SENT', 'bereits gesendet ');
define('BOX_COUPON_ADMIN', 'Administration');

define('IMAGE_RELEASE', 'einl&ouml;sen ' . TEXT_GV_NAME);

// javascript messages
define('JS_ERROR', 'Achtung! Es ist ein Fehler aufgetreten.!\nBitte &auml;ndern Sie folgendes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Das neue Artikelattribut ben&ouml;tigt eine Preisangabe\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Das neue Artikelattribut ben&ouml;tigt eine Preisangabe\n');

define('JS_PRODUCTS_NAME', '* Bitte tragen Sie einen Artikelnamen ein');
define('JS_PRODUCTS_DESCRIPTION', '* Bitte tragen Sie eine Artikelbeschreibung ein');
define('JS_PRODUCTS_PRICE', '* Bitte tragen Sie den Preis ein');
define('JS_PRODUCTS_WEIGHT', '* Bitte tragen Sie das Gewicht ein');
define('JS_PRODUCTS_QUANTITY', '* Bitte tragen Sie die Anzahl ein');
define('JS_PRODUCTS_MODEL', '* Bitte tragen Sie die Artikelnummer ein');
define('JS_PRODUCTS_IMAGE', '* Der neue Artikel ben&ouml;tigt ein Bild');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Der neue Artikel ben&ouml;tigt einen Preis\n');

define('JS_GENDER', '* Das \'Geschlecht\' muss ausgew&auml;hlt werden.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muss aus mindestens  ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_LAST_NAME', '* Der  \'Nachname\' muss aus mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muss wie folgt aussehen: xx/xx/xxxx (Tag/Monat/Jahr).\n');
define('JS_EMAIL_ADDRESS', '* Die \'e-Mail Adresse\' muss mindestens aus ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_ADDRESS', '* Die \'Anschrift\' muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_POST_CODE', '* Die \'Postleizahl\' muss aus mindestens  ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_CITY', '* Die \'Stadt\' muss mindestens  ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen haben.\n');
define('JS_STATE', '* Das \'Bundesland\' muss eingetragen sein.\n');
define('JS_STATE_SELECT', '-- Bitte w&auml;hlen Sie --');
define('JS_ZONE', '* Das \'Land\' muss ausgew&auml;hlt sein.');
define('JS_COUNTRY', '* Das \'Land\' muss ausgew&auml;hlt sein.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss aus mindestens  ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_PASSWORD', '* Das \'Passwort\' muss aus mindestens  ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Diese Bestellnummer %s existiert nicht!');

define('CATEGORY_PERSONAL', 'Pers&ouml;nlich');
define('CATEGORY_ADDRESS', 'Anschrift');
define('CATEGORY_CONTACT', 'Telefon');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Zusatz');

define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', ' <span class="errorText">ben&ouml;tigt</span>');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', ' <span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', ' <span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', ' <span class="errorText">Ihr Geburtsdatum muss folgene Form haben: TT.MM.JJJJ (z.B. 21.02.1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'e-Mail Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', ' <span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', ' <span class="errorText">Die e-Mail Adresse scheint nicht korrekt zu sein!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', ' <span class="errorText">Diese e-Mail Adresse existiert bereits!</span>');
define('ENTRY_COMPANY', 'Firma:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_PRICING_GROUP', 'Preiserm&auml;&szlig;igungsgruppe');
define('ENTRY_STREET_ADDRESS', 'Stra&szlig;e:');
define('ENTRY_STREET_ADDRESS_ERROR', ' <span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_SUBURB', 'Zusatz:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', ' <span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', ' <span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_STATE', 'Stadt:');
define('ENTRY_STATE_ERROR', ' <span class="errorText">ben&ouml;tigt</span>');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', ' <span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_FAX_NUMBER', 'Faxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'bestellen');
define('ENTRY_NEWSLETTER_NO', 'abbestellen');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Sende e-Mail');
define('IMAGE_BACK', 'Zur&uuml;ck');
define('IMAGE_BACKUP', 'Sichern');
define('IMAGE_CANCEL', 'Abbrechen');
define('IMAGE_CONFIRM', 'Best&auml;tigen');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'L&ouml;schen');
define('IMAGE_EDIT', 'Bearbeiten');
define('IMAGE_EMAIL', 'e-Mail');
define('IMAGE_FILE_MANAGER', 'Dateimanager');
define('IMAGE_ICON_STATUS_GREEN', 'Aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktivieren');
define('IMAGE_ICON_STATUS_RED', 'Deaktiviert');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktivieren');
define('IMAGE_ICON_STATUS_RED_EZPAGES', 'FEHLER -- zu viele URL oder Contenttypen aufgerufen');
define('IMAGE_ICON_STATUS_RED_ERROR', 'Fehler');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Einf&uuml;gen');
define('IMAGE_LOCK', 'sperren');
define('IMAGE_MODULE_INSTALL', 'Modul installieren');
define('IMAGE_MODULE_REMOVE', 'Modul deinstallieren');
define('IMAGE_MOVE', 'Verschieben');
define('IMAGE_NEW_BANNER', 'Neuer Banner');
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie');
define('IMAGE_NEW_COUNTRY', 'Neues Land');
define('IMAGE_NEW_CURRENCY', 'Neue W&auml;hrung');
define('IMAGE_NEW_FILE', 'Neue Datei');
define('IMAGE_NEW_FOLDER', 'Neuer Ordner');
define('IMAGE_NEW_LANGUAGE', 'Neue Sprache');
define('IMAGE_NEW_NEWSLETTER', 'Neuer Newsletter');
define('IMAGE_NEW_PRODUCT', 'Neuer Artikel');
define('IMAGE_NEW_SALE', 'Neuer Verkauf');
define('IMAGE_NEW_TAX_CLASS', 'Neue Steuerklasse');
define('IMAGE_NEW_TAX_RATE', 'Neuer Steuersatz');
define('IMAGE_NEW_TAX_ZONE', 'Neue Steuerzone');
define('IMAGE_NEW_ZONE', 'Neue Zone');
define('IMAGE_OPTION_NAMES', 'Attributnamen');
define('IMAGE_OPTION_VALUES', 'Optionswerte');
define('IMAGE_ORDERS', 'Bestellungen');
define('IMAGE_ORDERS_INVOICE', 'Rechnung');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packliste');
define('IMAGE_PREVIEW', 'Bewertungen');
define('IMAGE_RESTORE', 'Wiederherstellen');
define('IMAGE_RESET', 'Zur&uuml;cksetzen');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suchen');
define('IMAGE_SELECT', 'Ausw&auml;hlen');
define('IMAGE_SEND', 'Senden');
define('IMAGE_SEND_EMAIL', 'e-Mail senden');
define('IMAGE_UNLOCK', 'Entsperren');
define('IMAGE_UPDATE', 'Aktualisieren');
define('IMAGE_UPDATE_CURRENCIES', 'Umrechnungskurs aktualisieren');
define('IMAGE_UPLOAD', 'Upload');
define('IMAGE_TAX_RATES', 'Steuersatz');
define('IMAGE_DEFINE_ZONES', 'Zone');
define('IMAGE_PRODUCTS_PRICE_MANAGER', 'Artikelpreis Manager');
define('IMAGE_UPDATE_PRICE_CHANGES', 'Preis&auml;nderung aktualisieren');
define('IMAGE_ADD_BLANK_DISCOUNTS', 'Hinzuf&uuml;gen ' . DISCOUNT_QTY_ADD . ' Leerer Mengenrabatt');
define('IMAGE_CHECK_VERSION', 'Auf neue Version von Zen Cart pr&uuml;fen');
define('IMAGE_PRODUCTS_TO_CATEGORIES', 'Mehrfachkategorie Link Manager');

define('IMAGE_ICON_STATUS_ON', 'Status - aktiviert');
define('IMAGE_ICON_STATUS_OFF', 'Status - deaktiviert');
define('IMAGE_ICON_LINKED', 'Artikel ist verlinkt');

define('IMAGE_REMOVE_SPECIAL', 'Info f&uuml;r Preiserm&auml;&szlig;igung entfernen');
define('IMAGE_REMOVE_FEATURED', 'Info f&uuml;r &auml;hnliche Artikel entfernen');
define('IMAGE_INSTALL_SPECIAL', 'Info f&uuml;r Preiserm&auml;&szlig;igung hinzuf&uuml;gen');
define('IMAGE_INSTALL_FEATURED', 'Info f&uuml;r &auml;hnliche Artikel hinzuf&uuml;gen');

define('ICON_PRODUCTS_PRICE_MANAGER', 'Artikelpreis Manager');
define('ICON_COPY_TO', 'Kopieren nach');
define('ICON_CROSS', 'Falsch');
define('ICON_CURRENT_FOLDER', 'Aktueller Ordner');
define('ICON_DELETE', 'L&ouml;schen');
define('ICON_EDIT', 'Bearbeiten');
define('ICON_ERROR', 'Fehler');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Ordner');
define('ICON_LOCKED', 'Gesperrt');
define('ICON_MOVE', 'mehr');
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_PREVIEW', 'Vorschau');
define('ICON_RESET', 'Zur&uuml;cksetzen');
define('ICON_STATISTICS', 'Statistiken');
define('ICON_SUCCESS', 'erfolgreich');
define('ICON_TICK', 'richtig');
define('ICON_UNLOCKED', 'Entsperren');
define('ICON_WARNING', 'Warnung');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_ADMINS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Administratoren)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Banner)');
define('TEXT_DISPLAY_NUMBER_OF_CATEGORIES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Kategorien)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> L&auml;nder)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Kunden)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> W&auml;hrungen)');
define('TEXT_DISPLAY_NUMBER_OF_FEATURED', 'Anzeigen von <b>%d</b> bis <b>%d</b> (von <b>%d</b> gekennzeichneten Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Sprachen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Hersteller)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Newsletter)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellstatus)');
define('TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Preisgruppen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Artikeltypen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> erwartete Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Abverk&auml;ufe)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerklassen)');
define('TEXT_DISPLAY_NUMBER_OF_TEMPLATES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Vorlage Zuordnungen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerzonen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuers&auml;tze)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Zonen)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');


define('TEXT_DEFAULT', 'Standard');
define('TEXT_SET_DEFAULT', 'als Standard definieren');
define('TEXT_FIELD_REQUIRED', ' <span class="Feld">* ben&ouml;tigt</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fehler: Es wurde keine Standardw&auml;hrung definiert. Sie k&ouml;nnen diese im Admin Men&uuml; unter "Erweitert->W&auml;hrungen" definieren.');

define('TEXT_CACHE_CATEGORIES', 'Kategorien');
define('TEXT_CACHE_MANUFACTURERS', 'Hersteller');
define('TEXT_CACHE_ALSO_PURCHASED', 'Verkaufsf&ouml;rderung');

define('TEXT_NONE', '--kein--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Ziel %s existiert nicht');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Ziel %s ist schreibgesch&uuml;tzt');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Dateiupload wurde nicht gespeichert.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateityp %s ist nicht erlaubt');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Erfolgreich: Dateiupload %s wurde gespeichert');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: Keine Datei hochgeladen.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warnung: Die Option "Dateiupload" ist in der php.ini deaktiviert.');
define('ERROR_ADMIN_SECURITY_WARNING', 'Warnung: Ihr Admin login ist nicht sicher ... entweder noch Standard-Login-Einstellungen: Admin admin oder nicht entfernt: demo demoonly<br />Login(s) sollten zur Sicherheit so schnell als möglich geändert werden.<br />F&uuml;r zusätzliche Sicherheitshinweise siehe auch Verzeichnis /docs');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Ihre Datenbank scheint einen Patch zu benötigen. Siehe auch Tools->Server Information um die Patchlevels zu betrachten.');
define('WARN_DATABASE_VERSION_PROBLEM','true'); //set to false to turn off Warnings about database version mismatches
define('WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>WARNUNG:</strong> Der Shop ist z.Zt. wegen Wartung geschlossen ...<br />ANMERKUNG: Sie k&ouml;nnen die meisten Zahlungs- und Versand-Module im Wartungszustand  nicht pr&uuml;fen');
define('WARNING_BACKUP_CFG_FILES_TO_DELETE', 'WARNUNG: Diese Dateien sollten gel&ouml;scht werden, um fremde Zugriffe zu verhindern: ');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationsverzeichnis besteht noch: ' . DIR_FS_CATALOG . 'zc_install. Dieses Verzeichnis aus Sicherheitsgr&uuml;nden bitte entfernen.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: Ihre Konfigurationsdatei: %sincludes/configure.php. Dies ist ein potenzielles Sicherheitsrisiko - &auml;ndern Sie bitte die Zugriffsrechte (Read-only, CHMOD 644 oder 444l).');

define('_JANUARY', 'Januar');
define('_FEBRUARY', 'Februar');
define('_MARCH', 'M&auml;rz');
define('_APRIL', 'April');
define('_MAY', 'Mai');
define('_JUNE', 'Juni');
define('_JULY', 'Juli');
define('_AUGUST', 'August');
define('_SEPTEMBER', 'September');
define('_OCTOBER', 'Oktober');
define('_NOVEMBER', 'November');
define('_DECEMBER', 'Dezember');

define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Gutscheinen)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Kupons)');

define('TEXT_VALID_PRODUCTS_LIST', 'Artikelliste');
define('TEXT_VALID_PRODUCTS_ID', 'Artikel ID');
define('TEXT_VALID_PRODUCTS_NAME', 'Artikelbezeichnung');
define('TEXT_VALID_PRODUCTS_MODEL', 'Artikelnummer');

define('TEXT_VALID_CATEGORIES_LIST', 'Kategorienliste');
define('TEXT_VALID_CATEGORIES_ID', 'Kategorie ID');
define('TEXT_VALID_CATEGORIES_NAME', 'Kategoriename');

define('DEFINE_LANGUAGE', 'Sprache w&auml;hlen:');

define('BOX_ENTRY_COUNTER_DATE', 'Besucherz&auml;hler gestartet:');
define('BOX_ENTRY_COUNTER', 'Besucherz&auml;hler:');

// not installed
define('NOT_INSTALLED_TEXT', 'nicht installiert');

// Product Options Values Sort Order - option_values.php
define('BOX_CATALOG_PRODUCT_OPTIONS_VALUES', 'Sortierreihenfolge von Attributmerkmalen');

define('TEXT_UPDATE_SORT_ORDERS_OPTIONS', '<strong>Attribut - Sortierreihenfolge der "Standard Attributmerkmale" aktualisieren</strong>');
define('TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES', '<strong>Sortierreihenfolge der "Artikelattribute" aktualisieren</strong><br />und mit den "Standard Attributmerkmalen" abgleichen');

// Product Options Name Sort Order - option_values.php
define('BOX_CATALOG_PRODUCT_OPTIONS_NAME', 'Sortierreihenfolge der Attributnamen');

// Attributes only
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER', 'Attributmanager');

// generic model
define('TEXT_MODEL', 'Artikelnummer:');

// column controller
define('BOX_TOOLS_LAYOUT_CONTROLLER', 'Boxlayout');

// check GV release queue and alert store owner
define('SHOW_GV_QUEUE', true);
define('TEXT_SHOW_GV_QUEUE', '%s wartet auf &uuml;berpr&uuml;fung');
define('IMAGE_GIFT_QUEUE', TEXT_GV_NAME . ' Warteschleife');
define('IMAGE_ORDER', 'Bestellung');

define('BOX_TOOLS_EMAIL_WELCOME', 'Willkommensnachricht');

define('IMAGE_DISPLAY', 'Anzeige');
define('IMAGE_UPDATE_SORT', 'Sortierreihenfolge aktualisieren');
define('IMAGE_EDIT_PRODUCT', 'Artikel bearbeiten');
define('IMAGE_EDIT_ATTRIBUTES', 'Attribute bearbeiten');
define('TEXT_NEW_PRODUCT', 'Artikel in der Kategorie: &quot;%s&quot;');
define('IMAGE_OPTIONS_VALUES', 'Optionsnamen und Attributmerkmale');
define('TEXT_PRODUCTS_PRICE_MANAGER', 'ARTIKELPREIS MANAGER');
define('TEXT_PRODUCT_EDIT', 'ARTIKEL BEARBEITEN');
define('TEXT_ATTRIBUTE_EDIT', 'ATTRIBUTE BEARBEITEN');
define('TEXT_PRODUCT_DETAILS','Details ansehen');

// sale maker
define('DEDUCTION_TYPE_DROPDOWN_0', 'Betrag abziehen');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Prozent');
define('DEDUCTION_TYPE_DROPDOWN_2', 'Neuer Preis');

// Min and Units
define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Minimum:');
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'Anzahl:');
define('PRODUCTS_QUANTITY_IN_CART_LISTING', 'Im Warenkorb:');
define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING', 'Weitere hinzuf&uuml;gen:');

define('TEXT_PRODUCTS_MIX_OFF', '*Keine gemischte Optionen');
define('TEXT_PRODUCTS_MIX_ON', '*Gemischte Optionen');

// search filters
define('TEXT_INFO_SEARCH_DETAIL_FILTER', 'Suchfilter: ');
define('HEADING_TITLE_SEARCH_DETAIL', 'Suchen: ');

define('PREV_NEXT_PRODUCT', 'Artikel: ');
define('TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*Die Kategorie ist deaktiviert</span>');
define('TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*Der Artikel ist deaktiviert</span>');

// admin demo
define('ADMIN_DEMO_ACTIVE', 'Sie befinden sich im Admin "Demo" Modus. Einige Einstellungen sind deaktiviert.');
define('ADMIN_DEMO_ACTIVE_EXCLUSION', 'Sie befinden sich im Admin "Demo" Modus. Einige Einstellungen sind deaktiviert - <strong>Mitteilung: Admin Einstellungen &uuml;berschreiben aktiviert</strong>');
define('ERROR_ADMIN_DEMO', 'Sie befinden sich im Admin "Demo" Modus ... diese Option(en) ist deaktiviert und kann nicht ausgef&uuml;hrt werden');

// Version Check notices
define('TEXT_VERSION_CHECK_NEW_VER', 'Eine neue Version ist verf&uuml;gbar: Zen Cart v');
 define('TEXT_VERSION_CHECK_NEW_PATCH', 'Ein neuer PATCH ist verf&uuml;gbar: v');
 define('TEXT_VERSION_CHECK_PATCH', 'patch');
 define('TEXT_VERSION_CHECK_DOWNLOAD', 'hier herunterladen');
 define('TEXT_VERSION_CHECK_CURRENT', 'Sie verwenden die aktuellste Version von Zen Cart&trade;.');

// downloads manager
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', 'zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Downloads)');
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'Download Manager');

define('BOX_CATALOG_FEATURED', 'Ähnliche Artikel');

define('ERROR_NOTHING_SELECTED', 'Es wurde nichts ausgew&auml;hlt ... Es wurden keine Änderungen durchgef&uuml;hrt');
define('TEXT_STATUS_WARNING', '<strong>HINWEIS:</strong> Der Status ist auf "auto aktiviert/deaktiviert", wenn Datumsangaben vorliegen');

define('TEXT_LEGEND_LINKED', 'Verlinkter Artikel');
define('TEXT_MASTER_CATEGORIES_ID', 'Artikel Hauptkategorie:');
define('TEXT_LEGEND', 'LEGENDE: ');
define('TEXT_LEGEND_STATUS_OFF', 'Status AUS ');
define('TEXT_LEGEND_STATUS_ON', 'Status AN ');

define('TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>HINWEIS: Die Hauptkategorie wird f&uuml;r die Bepreisung verwendet, wo<br />Artikelkategorien Preise bei verlinkten Artikel beeinflussen, z.B. bei Abverk&auml;ufen</strong>');
define('TEXT_YES', 'Ja');
define('TEXT_NO', 'Nein');

// shipping error messages
define('ERROR_SHIPPING_CONFIGURATION', '<strong>Fehler in der Versandkonfiguration!</strong>');
define('ERROR_SHIPPING_ORIGIN_ZIP', '<strong>Warnung:</strong> Die Postleitzahl des Webshops ist nicht definiert. (Einstellungen in Konfiguration -> Versandoptionen)');
define('ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>Warnung:</strong> 0kg Gewicht ist f&uuml;r kostenfreien Versand konfiguriert und das Modul <strong>versandkostenfrei</strong> ist deaktiviert');
define('ERROR_USPS_STATUS', '<strong>Warnung:</strong> Bei USPS fehlt entweder der Benutzername und/oder das Passwort, oder ... ist auf TEST gesetzt und arbeitet nicht im PRODUKTIONSMODUS<br />Wenn Sie weiterhin keine Werte erhalten, kontaktieren Sie bitte USPS und aktivieren dort Ihren Account');

define('ERROR_SHIPPING_MODULES_NOT_DEFINED', 'ANMERKUNG: Sie haben keine Versandmodule aktiviert. Bitte &auml;ndern Sie das bei Module->Versandarten.');
define('ERROR_PAYMENT_MODULES_NOT_DEFINED', 'ANMERKUNG: Sie haben keine Zahlungsmodule aktiviert. Bitte &auml;ndern Sie das in Module->Zahlungsarten.');

// text pricing
define('TEXT_CHARGES_WORD', 'Berechnete Geb&uuml;hren:');
define('TEXT_PER_WORD', '<br />Preis pro Wort: ');
define('TEXT_WORDS_FREE', ' Wort(e) frei ');
define('TEXT_CHARGES_LETTERS', 'Berechnete Geb&uuml;hren:');
define('TEXT_PER_LETTER', '<br />Preis pro Buchstabe: ');
define('TEXT_LETTERS_FREE', ' Buchstabe(n) frei ');
define('TEXT_ONETIME_CHARGES', '*Einmalige Geb&uuml;hren = ');
define('TEXT_ONETIME_CHARGES_EMAIL', '*Einmalige Geb&uuml;hren = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Option f&uuml;r Mengenrabatte');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY', 'Stk.');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE', 'Preis');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Option f&uuml;r einmalige Geb&uuml;hren bei Mengenrabatten');
define('TEXT_CATEGORIES_PRODUCTS', 'W&auml;hlen Sie eine Kategorie mit Artikel ...');
define('TEXT_PRODUCT_TO_VIEW', 'W&auml;hlen Sie einen Artikel und klicken Sie auf anzeigen ...');

define('TEXT_INFO_SET_MASTER_CATEGORIES_ID', 'Ung&uuml;ltige Master Category ID');
define('TEXT_INFO_ID', ' ID# ');
define('TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>Achtung:</strong> Dieser Artikel ist mit mehreren Kategorien verlinkt, aber die Masterkategorie wurde nicht eingestellt!');

define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Preis auf Anfrage');
define('PRODUCTS_PRICE_IS_FREE_TEXT', 'kostenlos');

define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// min, max, units
define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Maximal:');

// Discount Savings
define('PRODUCT_PRICE_DISCOUNT_PREFIX', 'Sie sparen&nbsp;');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '%');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT', '&nbsp;ein');
// Sale Maker Sale Price
define('PRODUCT_PRICE_SALE', 'Abverkauf:&nbsp;');

// Rich Text / HTML resources
define('TEXT_HTML_EDITOR_NOT_DEFINED', 'Wenn kein HTML Editor definiert oder JavaScript deaktiviert ist, kann hier der HTML Text manuell eingegeben werden.');
define('TEXT_WARNING_HTML_DISABLED', '<span class = "main">Hinweis: Sie verwenden "nur-TEXT" als e-Mail Versandmethode. Wenn Sie e-Mails als HTML versenden wollen, m&uuml;ssen Sie "verwende MIME HTML" in den e-Mail Optionen aktivieren</span>');
define('TEXT_WARNING_CANT_DISPLAY_HTML', '<span class = "main">Hinweis: Sie verwenden "nur-TEXT" als e-Mail Versandmethode. Wenn Sie e-Mails als HTML versenden wollen, m&uuml;ssen Sie "verwende MIME HTML" in den e-Mail Optionen aktivieren</span>');
define('TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML', 'Sie k&ouml;nnen diesen Text lesen, wei wir Ihnen eine e-Mail im HTML Format zugesendet haben. Ihr e-Mail Programm kann jedoch keine Nachrichten im HTML Format anzeigen.")');
define('ENTRY_EMAIL_PREFERENCE', 'e-Mail Formateinstellungen:');
define('ENTRY_EMAIL_FORMAT_COMMENTS', 'Die Auswahl "keine" oder "hat ausgew&auml;hlt" deaktiviert ALLE e-Mails, inklusive der Bestellbest&auml;tigungen');
define('ENTRY_EMAIL_HTML_DISPLAY', 'HTML');
define('ENTRY_EMAIL_TEXT_DISPLAY', 'nur-TEXT');
define('ENTRY_EMAIL_NONE_DISPLAY', 'Nie');
define('ENTRY_EMAIL_OPTOUT_DISPLAY', 'hat augew&auml;hlt von Newslettern');
define('ENTRY_NOTHING_TO_SEND', 'Ihre Nachricht hat keinen Inhalt');
define('EMAIL_SEND_FAILED', 'Fehler: Senden der E-Mail an: "%s" <%s> mit Betreff: "%s" fehlgeschlagen');

  define('EDITOR_NONE', 'Normaler Text');
  define('TEXT_EDITOR_INFO', 'interner HTML-Editor');
  define('ERROR_EDITORS_FOLDER_NOT_FOUND', 'Sie haben den internen HTML-Editor vorgew&auml;hlt in Konfiguration -> Mein Shop. Der Ordner kann nicht lokalisiert werden. Bitte pr&uuml;fen Sie, ob der Ordner verschoben wurde oder deaktivieren Sie die getroffene Einstellung  \''.DIR_WS_CATALOG.'editor/\' ordner');
  define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Artikelsortierung: ');
define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Artikelsortierreihenfolge, Artikelname');
define('TEXT_SORT_PRODUCTS_NAME', 'Artikelname');
define('TEXT_SORT_PRODUCTS_MODEL', 'Artikelmodell');
define('TEXT_SORT_PRODUCTS_QUANTITY', 'Artikelmenge+, Artikelname');
define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Artikelmenge-, Artikelname');
define('TEXT_SORT_PRODUCTS_PRICE', 'Artikelpreis+, Artikelname');
define('TEXT_SORT_PRODUCTS_PRICE_DESC', 'Artikelpreis-, Artikelname');
define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Kategorie Sortierung, Kategoriename');
define('TEXT_SORT_CATEGORIES_NAME', 'Kategoriename');



define('TABLE_HEADING_YES', 'Ja');
define('TABLE_HEADING_NO', 'Nein');
define('TEXT_IMAGES_OVERWRITE', 'Bestehendes Bild &uuml;berschreiben? Verwenden Sie "Nein" bei manuell eingegebenem Namen');
define('TEXT_IMAGE_OVERWRITE_WARNING', 'WARNUNG: DATEINAME wurde aktualisiert aber nicht &uuml;berschrieben ');
  define('TEXT_IMAGES_DELETE', 'Bild l&ouml;schen?<br />Bild wurde nicht vom Server entfernt:');

define('ERROR_DEFINE_OPTION_NAMES', 'Warnung: Es wurde kein Attributname definiert');
define('ERROR_DEFINE_OPTION_VALUES', 'Warnung: Es wurde kein Optionswert definiert');
define('ERROR_DEFINE_PRODUCTS', 'Warnung: Es wurden keine Artikel definiert');
  define('ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', 'Warnung: Diesem Produkt ist keine Kategorie zugeordnet worden');

define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON', 'Hinzuf&uuml;gen inklusive Unterkategorien');
define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF', 'Hinzuf&uuml;gen ohne Unterkategorien');

define('BUTTON_PREVIOUS_ALT', 'Vorheriger Artikel');
  define('BUTTON_NEXT_ALT', 'N&auml;chster Artikel');

define('BUTTON_PRODUCTS_TO_CATEGORIES', 'Mehrfachkategorie Link Manager');
define('BUTTON_PRODUCTS_TO_CATEGORIES_ALT', 'Kopiere Artikel in mehrere Kategorien');

  define('TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'Alle globalen Kopier-, Hinzuf&uuml;gen- und L&ouml;scheigenschaften sind z.Zt. AUS');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'Anzeige globale Eigenschaften - AN');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'Anzeige globale Eigenschaften - AUS');

// moved from categories and all product type language files
define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Kann Produkt nicht in selbe Kategorie verlinken.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Bilderverzeichnis hat keine Schreibrechte: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Bilderverzeichnis existiert nicht: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fehler: Kategorie kann nicht in eine Unterkategorie verschoben werden.');
define('ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'Fehler: Produkt exisitiert bereits in dieser Kategorie.');
define('ERROR_CATEGORY_HAS_PRODUCTS', 'Fehler: Kategorie enthält Produkte!<br /><br />Diese Aktion ist temporär zulässig während Sie Kategorien neu anordnen. Dennoch gilt der Grundsatz: Eine Kategorie kann entweder andere Kategorien oder Produkte enthalten aber <strong>niemals</strong>beides!');
define('SUCCESS_CATEGORY_MOVED', 'Erfolgreich! Kategorie erfolgreich verschoben ...');
define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'Fehler: Kategorie kann nicht in sich selbst verschoben werden! ID#');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'Achtung: EZ-PAGES HEADER - Ein nur für Admin IP');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'Achtung: EZ-PAGES FOOTER - Ein nur für Admin IP');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'Achtung: EZ-PAGES SIDEBOX - Ein nur für Admin IP');

// moved from product types
// warnings on Virtual and Always Free Shipping
  define('TEXT_VIRTUAL_PREVIEW','Achtung: Virtuelles Produkt - kein Versand!<br />Sind alle Produkte einer Bestellung virtuell wird keine Versandoption angeboten');
  define('TEXT_VIRTUAL_EDIT','Achtung: Virtuelles Produkt - kein Versand!<br />Sind alle Produkte einer Bestellung virtuell wird keine Versandoption angeboten');
  define('TEXT_FREE_SHIPPING_PREVIEW','Achtung: kostenloser Versand ausgewählt!<br />Modul "Versandkostenfrei" muss installiert sein wenn alle Artikel einer Bestellung versandkostenfrei sind');
  define('TEXT_FREE_SHIPPING_EDIT','Achtung: kostenloser Versand ausgewählt!<br />Modul "Versandkostenfrei" muss installiert sein wenn alle Artikel einer Bestellung versandkostenfrei sind');

// admin activity log warnings
  define('WARNING_ADMIN_ACTIVITY_LOG_DATE', 'Achtung: Die Admin Protokolltabelle hat Einträge die &auml;lter sind als 2 Monate und sollte deshalb geleert werden ... ');
  define('WARNING_ADMIN_ACTIVITY_LOG_RECORDS', 'Achtung: Die Admin Protokolltabelle hat &uuml;ber 50000 Eintr&auml;ge und sollte deshalb geleert werden ... ');
  define('RESET_ADMIN_ACTIVITY_LOG', 'Wählen Sie Tools -> Shopmanager und leeren die Admin-Protokolltabelle');

  define('CATEGORY_HAS_SUBCATEGORIES', 'Achtung: Kategorie besitzt Unterkategorien<br />Artikel können nicht hinzugef&uuml;gt werden');

///////////////////////////////////////////////////////////
// include additional files:
require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
include(zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false'));

// Additional Localisation - Languages - Phone Country Code
define('TEXT_INFO_LANGUAGE_ID', 'Geben Sie den Telefon L&auml;ndercode OHNE 0 ein<br />(english MUSS 1 sein, deutsch MUSS 43 sein):');
define('TEXT_INFO_LANGUAGE_CODE', 'Code:<br />(en = englisch, de = deutsch)');
?>