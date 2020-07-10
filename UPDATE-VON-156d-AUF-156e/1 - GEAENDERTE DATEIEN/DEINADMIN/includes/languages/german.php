<?php
/**
 * Zen Cart German Specific
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: german.php 667 2020-07-10 07:37:04Z webchills $
 */
if (!defined('IS_ADMIN_FLAG'))
{
  die('Illegal Access');
}

define('CONNECTION_TYPE_UNKNOWN', '\'%s\' ist kein gültiger Verbindungstyp zum Erzeugen von URLs' . PHP_EOL . '%s' . PHP_EOL);

// added defines for header alt and text
define('HEADER_ALT_TEXT', 'Admin powered by Zen-Cart 1.5.6 - deutsche Version');
define('HEADER_LOGO_WIDTH', '240px');
define('HEADER_LOGO_HEIGHT', '70px');
define('HEADER_LOGO_IMAGE', 'logo.gif');
define('TEXT_PASSWORD_LAST_CHANGE', 'Passwort zuletzt geändert:&nbsp;');
define('TEXT_LAST_LOGIN_INFO', 'Letztes Login [IP]:&nbsp;');

// look in your $PATH_LOCALE/locale directory for available locales..
$locales = array('de_DE.UTF-8', 'de_AT.UTF-8', 'de_CH.UTF-8', 'de_DE.ISO_8859-1','de_DE@euro', 'de_DE', 'de', 'ge', 'deu.deu');
@setlocale(LC_TIME, $locales);
define('DATE_FORMAT_SHORT', '%d.%m.%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
// for now both defines are needed until Spiffy is completely removed.
define('DATE_FORMAT_SPIFFYCAL', 'dd.MM.yyyy'); //Use only 'dd', 'MM' and 'yyyy' here in any order
define('DATE_FORMAT_DATE_PICKER', 'yy-mm-dd');  //Use only 'dd', 'mm' and 'yy' here in any order
define('ADMIN_NAV_DATE_TIME_FORMAT', '%A %d %b %Y %X'); // this is used for strftime()

////
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


// // include template specific meta tags defines
//   if (file_exists(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
//     $template_dir_select = $template_dir . '/';
//   } else {
//     $template_dir_select = '';
//   }
//   require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// used for prefix to browser tabs in admin pages
define('TEXT_ADMIN_TAB_PREFIX', 'Admin');
// if you have multiple stores and want the Store Name to be part of the admin title (ie: for browser tabs), swap this line with the one above
//define('TEXT_ADMIN_TAB_PREFIX', 'Admin ' . STORE_NAME);
// meta tags
define('ICON_METATAGS_ON', 'Meta Tags definiert');
define('ICON_METATAGS_OFF', 'Meta Tags nicht definiert');
define('TEXT_LEGEND_META_TAGS', 'Meta Tags definiert:');
define('TEXT_INFO_META_TAGS_USAGE', '<strong>Hinweis:</strong> Site/Tagline ist Ihre Einstellung für Ihre Seite in der Datei meta_tags.php.');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Admin Startseite');
define('HEADER_TITLE_SUPPORT_SITE', 'Supportforum');
define('HEADER_TITLE_ONLINE_CATALOG', 'Shop Startseite');
define('HEADER_TITLE_VERSION', 'Version');
define('HEADER_TITLE_ACCOUNT', 'Account');
define('HEADER_TITLE_LOGOFF', 'Abmelden');
//define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
define('TEXT_GV_NAME', 'Gutschein');
define('TEXT_GV_NAMES', 'Gutscheine');
define('TEXT_DISCOUNT_COUPON', 'Aktionskupon');

// used for redeem code, redemption code, or redemption id
define('TEXT_GV_REDEEM', 'Gutscheinnummer');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');

define('TEXT_CHECK_ALL', 'Alle wählen');
define('TEXT_UNCHECK_ALL', 'Alle abwählen');
define('NONE', 'Kein');

define('TEXT_UNKNOWN', 'Unbekannt');
// configuration box text
define('BOX_HEADING_CONFIGURATION', 'Konfiguration');
define('BOX_CONFIGURATION_MY_STORE', 'Mein Shop - Grundeinstellungen');
define('BOX_CONFIGURATION_MINIMUM_VALUES', 'Minimale Werte');
define('BOX_CONFIGURATION_MAXIMUM_VALUES', 'Maximale Werte');
define('BOX_CONFIGURATION_IMAGES', 'Bilder');
define('BOX_CONFIGURATION_CUSTOMER_DETAILS', 'Kundendetails');
define('BOX_CONFIGURATION_SHIPPING_PACKAGING', 'Versandoptionen');
define('BOX_CONFIGURATION_PRODUCT_LISTING', 'Artikelliste');
define('BOX_CONFIGURATION_STOCK', 'Lagerverwaltung und Warenkorb');
define('BOX_CONFIGURATION_LOGGING', 'Protokollierung/Logfiles');
define('BOX_CONFIGURATION_EMAIL_OPTIONS', 'E-Mail Optionen');
define('BOX_CONFIGURATION_ATTRIBUTE_OPTIONS', 'Attributeinstellungen');
define('BOX_CONFIGURATION_GZIP_COMPRESSION', 'GZip Kompression');
define('BOX_CONFIGURATION_SESSIONS', 'Sitzungen/Sessions');
define('BOX_CONFIGURATION_REGULATIONS', 'AGB & Datenschutz');
define('BOX_CONFIGURATION_GV_COUPONS', 'Gutscheine & Aktionskupons');
define('BOX_CONFIGURATION_CREDIT_CARDS', 'Kreditkarten');
define('BOX_CONFIGURATION_PRODUCT_INFO', 'Artikeldetailseite');
define('BOX_CONFIGURATION_LAYOUT_SETTINGS', 'Layouteinstellungen');
define('BOX_CONFIGURATION_WEBSITE_MAINTENANCE', 'Shopwartung');
define('BOX_CONFIGURATION_NEW_LISTING', 'Liste - Neue Artikel');
define('BOX_CONFIGURATION_FEATURED_LISTING', 'Liste - Empfohlene Artikel');
define('BOX_CONFIGURATION_ALL_LISTING', 'Liste - Alle Artikel');
define('BOX_CONFIGURATION_INDEX_LISTING', 'Liste - Artikelindex');
define('BOX_CONFIGURATION_DEFINE_PAGE_STATUS', 'Define Pages Einstellungen');
define('BOX_CONFIGURATION_EZPAGES_SETTINGS', 'EZ-Pages Einstellungen');

// modules box text
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlungsarten');
define('BOX_MODULES_SHIPPING', 'Versandarten');
define('BOX_MODULES_ORDER_TOTAL', 'Zusammenfassung');
define('BOX_MODULES_PRODUCT_TYPES', 'Artikeltypen');

// categories box text
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
define('BOX_CATALOG_PRODUCT', 'Artikel');
define('BOX_CATALOG_PRODUCTS_TO_CATEGORIES', 'Artikel in Kategorien');
define('BOX_CATALOG_CATEGORY', 'Category');

// customers box text
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');
define('BOX_CUSTOMERS_GROUP_PRICING', 'Gruppenpreise');
define('BOX_CUSTOMERS_PAYPAL', 'PayPal IPN');
define('BOX_CUSTOMERS_INVOICE', 'Rechnung');
define('BOX_CUSTOMERS_PACKING_SLIP', 'Lieferschein');

// taxes box text
define('BOX_HEADING_LOCATION_AND_TAXES', 'Länder & Steuern');
define('BOX_TAXES_COUNTRIES', 'Länder');
define('BOX_TAXES_ZONES', 'Zonen / Bundesländer');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen');
define('BOX_TAXES_TAX_RATES', 'Steuersätze');

// reports box text
define('BOX_HEADING_REPORTS', 'Statistiken');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Besuchte Artikel');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Gekaufte Artikel');
define('BOX_REPORTS_ORDERS_TOTAL', 'Umsatz pro Kunde');
define('BOX_REPORTS_PRODUCTS_LOWSTOCK', 'Artikelbestand');
define('BOX_REPORTS_CUSTOMERS_REFERRALS', 'Herkunftsverweise (Referrals)');

// tools text
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_TEMPLATE_SELECT', 'Templates');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_BANNER_MANAGER', 'Bannermanager');
define('BOX_TOOLS_CACHE', 'Cache-Kontrolle');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen');
define('BOX_TOOLS_FILE_MANAGER', 'Dateimanager');
define('BOX_TOOLS_MAIL', 'Rundschreiben');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter & Artikelbenachrichtigungen Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server/Version Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online?');
define('BOX_TOOLS_STORE_MANAGER', 'Shopmanager');
define('BOX_TOOLS_DEVELOPERS_TOOL_KIT', 'Developers Tool Kit');
define('BOX_TOOLS_SQLPATCH','SQL Patches installieren');
define('BOX_TOOLS_EZPAGES','EZ-Pages');

define('BOX_HEADING_EXTRAS', 'Extras');

// define pages editor files
define('BOX_TOOLS_DEFINE_PAGES_EDITOR', 'Seiteneditor');
define('BOX_TOOLS_DEFINE_MAIN_PAGE', 'Startseite');
define('BOX_TOOLS_DEFINE_CONTACT_US', 'Kontakt');
define('BOX_TOOLS_DEFINE_PRIVACY', 'Datenschutzbestimmungen');
define('BOX_TOOLS_DEFINE_SHIPPINGINFO', 'Preise und Versand');
define('BOX_TOOLS_DEFINE_CONDITIONS', 'AGB');
define('BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS', 'Bestellbestätigung');
define('BOX_TOOLS_DEFINE_PAGE_2', 'Seite 2');
define('BOX_TOOLS_DEFINE_PAGE_3', 'Seite 3');
define('BOX_TOOLS_DEFINE_PAGE_4', 'Seite 4');

// localization box text
define('BOX_HEADING_LOCALIZATION', 'Lokalisation');
define('BOX_LOCALIZATION_CURRENCIES', 'Währungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');

// gift vouchers box text
define('BOX_HEADING_GV_ADMIN', 'Ermäßigungen');
define('BOX_GV_ADMIN_QUEUE', TEXT_GV_NAMES . ' Warteschleife');
define('BOX_GV_ADMIN_MAIL', TEXT_GV_NAME . ' senden ');
define('BOX_GV_ADMIN_SENT', 'Bereits gesendet ');
define('BOX_COUPON_ADMIN', 'Aktionskupon Admin');
define('BOX_COUPON_RESTRICT','Aktionskupon Einschränkungen');

// admin access box text
define('BOX_HEADING_ADMIN_ACCESS', 'Administratoren');
define('BOX_ADMIN_ACCESS_USERS',  'Admin User');
define('BOX_ADMIN_ACCESS_PROFILES', 'Admin Profile');
define('BOX_ADMIN_ACCESS_PAGE_REGISTRATION', 'Admin Seiten Registrierung');
define('BOX_ADMIN_ACCESS_LOGS', 'Admin Aktivitäten Logs');

define('IMAGE_RELEASE', TEXT_GV_NAME . ' freigeben');

// javascript messages
define('JS_ERROR', 'Achtung! Es ist ein Fehler aufgetreten.!\nBitte ändern Sie folgendes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Das neue Artikelattribut benötigt eine Preisangabe\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Das neue Artikelattribut benötigt eine Preisangabe\n');

define('JS_PRODUCTS_NAME', '* Bitte tragen Sie einen Artikelnamen ein');
define('JS_PRODUCTS_DESCRIPTION', '* Bitte tragen Sie eine Artikelbeschreibung ein');
define('JS_PRODUCTS_PRICE', '* Bitte tragen Sie den Preis ein');
define('JS_PRODUCTS_WEIGHT', '* Bitte tragen Sie das Gewicht ein');
define('JS_PRODUCTS_QUANTITY', '* Bitte tragen Sie die Anzahl ein');
define('JS_PRODUCTS_MODEL', '* Bitte tragen Sie die Artikelnummer ein');
define('JS_PRODUCTS_IMAGE', '* Der neue Artikel benötigt ein Bild');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Der neue Artikel benötigt einen Preis\n');

define('JS_GENDER', '* Das \'Geschlecht\' muss ausgewählt werden.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muss aus mindestens  ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_LAST_NAME', '* Der  \'Nachname\' muss aus mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muss wie folgt aussehen: xx/xx/xxxx (Tag/Monat/Jahr).\n');
define('JS_EMAIL_ADDRESS', '* Die \'E-Mail Adresse\' muss mindestens aus ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_ADDRESS', '* Die \'Anschrift\' muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_POST_CODE', '* Die \'Postleizahl\' muss aus mindestens  ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_CITY', '* Die \'Stadt\' muss mindestens  ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen haben.\n');
define('JS_STATE', '* Das \'Bundesland\' muss eingetragen sein.\n');
define('JS_STATE_SELECT', '-- Bitte wählen Sie --');
define('JS_ZONE', '* Das \'Bundesland\' muss ausgewählt sein.');
define('JS_COUNTRY', '* Das \'Land\' muss ausgewählt sein.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss aus mindestens  ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_PASSWORD', '* Das \'Passwort\' muss aus mindestens  ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press OK and wait for this process to be completed.');
define('JS_ORDER_DOES_NOT_EXIST', 'Diese Bestellnummer %s existiert nicht!');
define('TEXT_NO_ORDER_HISTORY', 'eine Bestellhistorie verfügbar');

define('CATEGORY_PERSONAL', 'Persönlich');
define('CATEGORY_ADDRESS', 'Anschrift');
define('CATEGORY_CONTACT', 'Telefon');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Zusatz');

define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', '<span class="errorText">benötigt</span>');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', '<span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', '<span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '<span class="errorText">Ihr Geburtsdatum muss folgene Form haben: TT.MM.JJJJ (z.B. 21.02.1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '<span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '<span class="errorText">Die E-Mail Adresse scheint nicht korrekt zu sein!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '<span class="errorText">Diese E-Mail Adresse existiert bereits!</span>');
define('ENTRY_COMPANY', 'Firma:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_PRICING_GROUP', 'Preisermäßigungsgruppe');
define('ENTRY_STREET_ADDRESS', 'Straße:');
define('ENTRY_STREET_ADDRESS_ERROR', '<span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_SUBURB', 'Zusatz:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', '<span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', '<span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_STATE', 'Stadt:');
define('ENTRY_STATE_ERROR', '<span class="errorText">benötigt</span>');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '<span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_FAX_NUMBER', 'Faxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Bestellen');
define('ENTRY_NEWSLETTER_NO', 'Abbestellen');
define('ENTRY_NEWSLETTER_ERROR', '');

define('ERROR_PASSWORDS_NOT_MATCHING', 'Das Passwort und die Passwortbestätigung müssen identisch sein');
define('ENTRY_PASSWORD_CHANGE_ERROR', '<strong>Entschuldigung, Ihr neues Passwort wurde abgelehnt.</strong><br />');
define('ERROR_PASSWORD_RULES', 'Passwörter müssen sowohl Buchstaben als auch Zahlen enthalten und mindestens %s Zeichen lang sein. Außerdem darf Ihr neues Passwort nicht mit einem der letzten 4 benutzten Passwörter identisch sein. Passwörter verlieren alle 90 Tage ihre Gültigkeit. Danach werden Sie automatisch aufgefordert Ihr Passwort zu ändern.');
define('ERROR_TOKEN_EXPIRED_PLEASE_RESUBMIT', 'FEHLER: Entschuldigung, es trat ein Fehler während der Verarbeitung Ihrer Daten auf. Bitte übermitteln Sie Ihre Daten erneut.');

// images
//define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_BACK', 'Zurück');
define('IMAGE_BACKUP', 'Sichern');
define('IMAGE_CANCEL', 'Abbrechen');
define('IMAGE_CONFIRM', 'Bestätigen');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Löschen');
define('IMAGE_EDIT', 'Bearbeiten');
define('IMAGE_EMAIL', 'E-Mail');
define('IMAGE_GO', 'Go');
define('IMAGE_FILE_MANAGER', 'Dateimanager');
define('IMAGE_ICON_STATUS_GREEN', 'Aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktivieren');
define('IMAGE_ICON_STATUS_RED', 'Deaktiviert');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktivieren');
define('IMAGE_ICON_STATUS_RED_EZPAGES', 'FEHLER -- zu viele URL oder Contenttypen aufgerufen');
define('IMAGE_ICON_STATUS_RED_ERROR', 'Fehler');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Einfügen');
define('IMAGE_LOCK', 'Sperren');
define('IMAGE_MODULE_INSTALL', 'Modul installieren');
define('IMAGE_MODULE_REMOVE', 'Modul deinstallieren');
define('IMAGE_MOVE', 'Verschieben');
define('IMAGE_NEW_BANNER', 'Neuer Banner');
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie');
define('IMAGE_NEW_COUNTRY', 'Neues Land');
define('IMAGE_NEW_CURRENCY', 'Neue Währung');
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
define('IMAGE_ORDERS_PACKINGSLIP', 'Lieferschein');
define('IMAGE_PERMISSIONS', 'Berechtigungen bearbeiten');
define('IMAGE_PREVIEW', 'Vorschau');
define('IMAGE_RESTORE', 'Wiederherstellen');
define('IMAGE_RESET', 'Zurücksetzen');
define('IMAGE_RESET_PWD', 'Passwort zurücksetzen');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suchen');
define('IMAGE_SELECT', 'Auswählen');
define('IMAGE_SEND', 'Senden');
define('IMAGE_SEND_EMAIL', 'E-Mail senden');
define('IMAGE_SUBMIT', 'Submit');
define('IMAGE_UNLOCK', 'Freigeben');
define('IMAGE_UPDATE', 'Aktualisieren');
define('IMAGE_UPDATE_CURRENCIES', 'Umrechnungskurs aktualisieren');
define('IMAGE_UPLOAD', 'Upload');
define('IMAGE_TAX_RATES', 'Steuersatz');
define('IMAGE_DEFINE_ZONES', 'Zone');
define('IMAGE_PRODUCTS_PRICE_MANAGER', 'Artikelpreis Manager');
define('IMAGE_UPDATE_PRICE_CHANGES', 'Preisänderung aktualisieren');
define('IMAGE_ADD_BLANK_DISCOUNTS', 'Hinzufügen von ' . DISCOUNT_QTY_ADD . ' leeren Mengenrabatten');
define('IMAGE_CHECK_VERSION', 'Auf neue Version von Zen Cart prüfen');
define('IMAGE_PRODUCTS_TO_CATEGORIES', 'Mehrfachkategorie Link Manager');

define('IMAGE_ICON_STATUS_ON', 'Status - aktiviert');
define('IMAGE_ICON_STATUS_OFF', 'Status - deaktiviert');
define('IMAGE_ICON_LINKED', 'Artikel ist verlinkt');
define('IMAGE_ICON_LINKED_CATEGORY', 'Kategorie enthält verlinkte Artikel');

define('IMAGE_REMOVE_SPECIAL', 'Info für Preisermäßigung entfernen');
define('IMAGE_REMOVE_FEATURED', 'Info für empfohlene Artikel entfernen');
define('IMAGE_INSTALL_SPECIAL', 'Info für Preisermäßigung hinzufügen');
define('IMAGE_INSTALL_FEATURED', 'Info für empfohlene Artikel hinzufügen');

define('TEXT_VERSION_CHECK_BUTTON', 'auf neue Version prüfen');
define('TEXT_BUTTON_RESET_ACTIVITY_LOG', 'Aktivitäten Log anzeigen');
define('ICON_PRODUCTS_PRICE_MANAGER', 'Artikelpreis Manager');
define('ICON_COPY_TO', 'Kopieren nach');
define('ICON_CROSS', 'Falsch');
define('ICON_CURRENT_FOLDER', 'Aktueller Ordner');
define('ICON_DELETE', 'Löschen');
define('ICON_EDIT', 'Bearbeiten');
define('ICON_ERROR', 'Fehler');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Ordner');
define('ICON_MOVE', 'Verschieben');
define('ICON_PERMISSIONS', 'Permissions');
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_PREVIEW', 'Vorschau');
define('ICON_RESET', 'Zurücksetzen');
define('ICON_STATISTICS', 'Statistiken');
define('ICON_SUCCESS', 'Erfolgreich');
define('ICON_TICK', 'Richtig');
define('ICON_WARNING', 'Warnung');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_ADMINS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Administratoren)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bannern)');
define('TEXT_DISPLAY_NUMBER_OF_CATEGORIES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Kategorien)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Länder)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Kunden)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Währungen)');
define('TEXT_DISPLAY_NUMBER_OF_FEATURED', 'Zeigen von <b>%d</b> bis <b>%d</b> (von <b>%d</b> gekennzeichneten Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Sprachen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Hersteller)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Newsletter)');
define('TEXT_DISPLAY_NUMBER_OF_OPTIONS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Optionen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellstatus)');
define('TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Preisgruppen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Artikeltypen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> erwarteten Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Abverkäufe)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerklassen)');
define('TEXT_DISPLAY_NUMBER_OF_TEMPLATES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Vorlage Zuordnungen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerzonen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuersätze)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Zonen)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Nächste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'Letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorherige von %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Nächste von %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '&laquo;ERSTE');
define('PREVNEXT_BUTTON_PREV', '[&laquo;&nbsp;Vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[Nächste&nbsp;&raquo;]');
define('PREVNEXT_BUTTON_LAST', 'LETZTE&raquo;');

define('TEXT_DEFAULT', 'Standard');
define('TEXT_SET_DEFAULT', 'Als Standard definieren');
define('TEXT_FIELD_REQUIRED', '<span class="Feld">* benötigt</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'FEHLER: Es wurde keine Standardwährung definiert. Sie können diese im Admin Menü unter Lokalisation->Währungen definieren.');

define('TEXT_NONE', '--kein--');
define('TEXT_TOP', 'Top');
define('PLEASE_SELECT', 'Bitte wählen ...');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'FEHLER: Zielverzeichnis %s existiert nicht');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'FEHLER: Zielverzeichnis %s ist schreibgeschützt');
define('ERROR_FILE_NOT_SAVED', 'FEHLER: Dateiupload wurde nicht gespeichert.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'FEHLER: Dateityp %s ist nicht erlaubt');
define('ERROR_FILE_TOO_BIG', 'Warnung: Die Datei ist größer als die zulässigen Größe. Siehe Bildkonfigurationseinstellungen.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Erfolgreich: Dateiupload %s wurde gespeichert');
define('WARNING_NO_FILE_UPLOADED', 'WARNUNG: Keine Datei hochgeladen.');
define('WARNING_FILE_UPLOADS_DISABLED', 'WARNUNG: Die Option "Dateiupload" ist in der php.ini deaktiviert.');
define('ERROR_ADMIN_SECURITY_WARNING', 'WARNUNG: Ihr Admin Login ist nicht sicher ... entweder noch Standard-Login-Einstellungen: Admin admin oder nicht entfernt: demo demoonly<br />Login(s) sollten zur Sicherheit so schnell als möglich geändert werden.');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Ihre Datenbank scheint einen Patch zu benötigen. Siehe auch Tools->Server Information um die Patchlevels zu betrachten.');
define('WARN_DATABASE_VERSION_PROBLEM','true'); //set to false to turn off warnings about database version mismatches
define('WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>WARNUNG:</strong> Der Shop ist z.Zt. wegen Wartung geschlossen ...<br />ANMERKUNG: Sie können die meisten Zahlungs- und Versand-Module im Wartungszustand nicht prüfen');
define('WARNING_BACKUP_CFG_FILES_TO_DELETE', 'WARNUNG: Diese Dateien sollten gelöscht werden, um fremde Zugriffe zu verhindern: ');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'WARNUNG: Das Installationsverzeichnis besteht noch: ' . DIR_FS_CATALOG . 'zc_install. Dieses Verzeichnis aus Sicherheitsgründen bitte entfernen.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'WARNUNG: Ihre Konfigurationsdatei: %s ist beschreibbar. Dies ist ein potentielles Sicherheitsrisiko - ändern Sie bitte die Zugriffsrechte für diese Datei mit Ihrem FTP Programm auf read-only (CHMOD 644 oder 444).');
define('WARNING_COULD_NOT_LOCATE_LANG_FILE', 'WARNUNG: Die Sprachdatei konnte nicht gefunden werden:');
define('ERROR_MODULE_REMOVAL_PROHIBITED', 'FEHLER: Diese Modul kann nicht entfernt werden: ');
define('WARNING_REVIEW_ROGUE_ACTIVITY', 'ALARM: Bitte anschauen für mögliche XSS Aktivitäten:');

define('ERROR_FILE_NOT_REMOVEABLE', 'FEHLER: Die angegebene Datei konnte nicht gelöscht werden. Sie müssen diese Datei manuell per FTP löschen.');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Error: Could not remove the directory specified. You may have to use FTP to remove the directory, due to a server-permissions configuration limitation.');
define('WARNING_SESSION_AUTO_START', 'WARNUNG: session.auto_start ist aktiviert - bitte deaktivieren Sie diese PHP Einstellung in der php.ini und starten den Webserver neu.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'WARNUNG: Das Verzeichnis für Downloaddateien existiert nicht: ' . DIR_FS_DOWNLOAD . '. Downloadartikel werden nicht funktionieren, solange dieses Verzeichnis nicht vorhanden ist.');
define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', 'WARNUNG: Das Verzeichnis für SQL Caching existiert nicht:: ' . DIR_FS_SQL_CACHE . '. SQL Caching wird nicht funktionieren, solange dieses Verzeichnis nicht vorhanden ist.');
define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'WARNUNG: In das Verzeichnis für SQL Caching kann nicht geschrieben werden: ' . DIR_FS_SQL_CACHE . '. Ändern Sie die Schreibrechte dieses Ordners, sonst wird das Caching nicht funktionieren.');
define('ERROR_UNABLE_TO_DISPLAY_SERVER_INFORMATION', 'Leider kann Ihre PHP-Konfiguration nicht angezeigt werden, da Ihr Provider festgelegt hat, dass [phpinfo] als Teil von [disable_functions] in den php.ini-Einstellungen deaktiviert werden soll.');
define('_JANUARY', 'Januar');
define('_FEBRUARY', 'Februar');
define('_MARCH', 'März');
define('_APRIL', 'April');
define('_MAY', 'Mai');
define('_JUNE', 'Juni');
define('_JULY', 'Juli');
define('_AUGUST', 'August');
define('_SEPTEMBER', 'September');
define('_OCTOBER', 'Oktober');
define('_NOVEMBER', 'November');
define('_DECEMBER', 'Dezember');

define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Gutscheinen)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Aktionkupons)');

define('TEXT_VALID_PRODUCTS_LIST', 'Artikelliste');
define('TEXT_VALID_PRODUCTS_ID', 'Artikel ID');
define('TEXT_VALID_PRODUCTS_NAME', 'Artikelbezeichnung');
define('TEXT_VALID_PRODUCTS_MODEL', 'Artikelnummer');

define('TEXT_VALID_CATEGORIES_LIST', 'Kategorienliste');
define('TEXT_VALID_CATEGORIES_ID', 'Kategorie ID');
define('TEXT_VALID_CATEGORIES_NAME', 'Kategoriename');

define('DEFINE_LANGUAGE', 'Sprache wählen:');

define('BOX_ENTRY_COUNTER_DATE', 'Besucherzähler gestartet:');
define('BOX_ENTRY_COUNTER', 'Besucherzähler:');

// not installed
define('NOT_INSTALLED_TEXT', 'Nicht installiert');

// Product Options Values Sort Order - option_values.php
define('BOX_CATALOG_PRODUCT_OPTIONS_VALUES', 'Sortierung von Attributmerkmalen');

define('TEXT_UPDATE_SORT_ORDERS_OPTIONS', '<strong>Attribut - Sortierung der "Standard Attributmerkmale" aktualisieren</strong>');
define('TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES', '<strong>Sortierung der "Artikelattribute" aktualisieren</strong><br />und mit den "Standard Attributmerkmalen" abgleichen');

// Product Options Name Sort Order - option_values.php
define('BOX_CATALOG_PRODUCT_OPTIONS_NAME', 'Sortierung der Attributnamen');

// Attributes only
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER', 'Attributmanager');

// generic model
define('TEXT_MODEL', 'Artikelnummer:');
  define('TEXT_PRODUCTS_MODEL', 'Artikelnummer:');
  define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
  define('TABLE_HEADING_MODEL', 'Artikelnummer');

// column controller
define('BOX_TOOLS_LAYOUT_CONTROLLER', 'Boxlayout');

// check GV release queue and alert store owner
define('SHOW_GV_QUEUE', true);
define('TEXT_SHOW_GV_QUEUE', '%s wartet auf Freigabe');
define('IMAGE_GIFT_QUEUE', TEXT_GV_NAME . ' Warteschleife');
define('IMAGE_ORDER', 'Bestellung');

define('IMAGE_DISPLAY', 'Anzeige');
define('IMAGE_UPDATE_SORT', 'Sortierung aktualisieren');
define('IMAGE_EDIT_PRODUCT', 'Artikel bearbeiten');
define('IMAGE_EDIT_ATTRIBUTES', 'Attribute bearbeiten');
define('TEXT_NEW_PRODUCT', 'Artikel in der Kategorie: "%s"');
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
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'Einheit:');
define('PRODUCTS_QUANTITY_IN_CART_LISTING', 'Im Warenkorb:');
define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING', 'Weitere hinzufügen:');

define('TEXT_PRODUCTS_MIX_OFF', '*Keine gemischte Optionen');
define('TEXT_PRODUCTS_MIX_ON', '*Gemischte Optionen');

// search filters
define('TEXT_INFO_SEARCH_DETAIL_FILTER', 'Suchfilter: ');
define('HEADING_TITLE_SEARCH_DETAIL', 'Suchen: ');
define('HEADING_TITLE_SEARCH_DETAIL_REPORTS', 'Suche nach Artikel(n) - Getrennt durch Kommata');
define('HEADING_TITLE_SEARCH_DETAIL_REPORTS_NAME_MODEL', 'Suche nach Artikelname/-nummer');

define('PREV_NEXT_PRODUCT', 'Artikel: ');
define('TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*Die Kategorie ist deaktiviert</span>');
define('TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*Der Artikel ist deaktiviert</span>');


// Version Check notices
define('TEXT_VERSION_CHECK_NEW_VER', '<span class="alertVersionNew">Eine neue Version ist verfügbar:</span> v');
define('TEXT_VERSION_CHECK_NEW_PATCH', '<span class="alertVersionNew">Ein neuer PATCH ist verfügbar:</span> v');
define('TEXT_VERSION_CHECK_PATCH', 'Patch');
define('TEXT_VERSION_CHECK_DOWNLOAD', 'Hier herunterladen');
define('TEXT_VERSION_CHECK_CURRENT', 'Sie verwenden die neueste Version von Zen Cart deutsch');
define('ERROR_CONTACTING_PROJECT_VERSION_SERVER','Fehler: Konnte nicht mit dem Versionsserver verbinden');

// downloads manager
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Downloads)');
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'Download Manager');

define('BOX_CATALOG_FEATURED', 'Empfohlene Artikel');

define('ERROR_NOTHING_SELECTED', 'Es wurde nichts ausgewählt ... Es wurden keine Änderungen durchgeführt');
define('TEXT_STATUS_WARNING', '<strong>HINWEIS:</strong> Der Status ist auf "auto aktiviert/deaktiviert", wenn Datumsangaben vorliegen');

define('TEXT_LEGEND_LINKED', 'Verlinkter Artikel');
define('TEXT_MASTER_CATEGORIES_ID', 'Artikel Hauptkategorie:');
define('TEXT_LEGEND', 'LEGENDE: ');
define('TEXT_LEGEND_STATUS_OFF', 'Status AUS ');
define('TEXT_LEGEND_STATUS_ON', 'Status AN ');

define('TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>HINWEIS: Die Hauptkategorie wird für die Bepreisung verwendet, wo<br />Artikelkategorien Preise bei verlinkten Artikel beeinflussen, z.B. bei Abverkäufen</strong>');
define('TEXT_YES', 'Ja');
define('TEXT_NO', 'Nein');
define('TEXT_CANCEL', 'Abbrechen');

// shipping error messages
define('ERROR_SHIPPING_CONFIGURATION', '<strong>Fehler in der Versandkonfiguration!</strong>');
define('ERROR_SHIPPING_ORIGIN_ZIP', '<strong>Warnung:</strong> Die Postleitzahl des Webshops ist nicht definiert. (Einstellungen in Konfiguration -> Versandoptionen)');
define('ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>Warnung:</strong> 0kg Gewicht ist für kostenfreien Versand konfiguriert und das Modul <strong>versandkostenfrei</strong> ist deaktiviert');
define('ERROR_USPS_STATUS', '<strong>Warnung:</strong> Bei USPS fehlt entweder der Benutzername und/oder das Passwort, oder ... ist auf TEST gesetzt und arbeitet nicht im PRODUKTIONSMODUS<br />Wenn Sie weiterhin keine Werte erhalten, kontaktieren Sie bitte USPS und aktivieren dort Ihren Account');

define('ERROR_SHIPPING_MODULES_NOT_DEFINED', 'ANMERKUNG: Sie haben keine Versandmodule aktiviert. Bitte ändern Sie das bei Module->Versandarten.');
define('ERROR_PAYMENT_MODULES_NOT_DEFINED', 'ANMERKUNG: Sie haben keine Zahlungsmodule aktiviert. Bitte ändern Sie das in Module->Zahlungsarten.');

// text pricing
define('TEXT_CHARGES_WORD', 'Berechnete Gebühren:');
define('TEXT_PER_WORD', '<br />Preis pro Wort: ');
define('TEXT_WORDS_FREE', ' Wort(e) frei ');
define('TEXT_CHARGES_LETTERS', 'Berechnete Gebühren:');
define('TEXT_PER_LETTER', '<br />Preis pro Buchstabe: ');
define('TEXT_LETTERS_FREE', ' Buchstabe(n) frei ');
define('TEXT_ONETIME_CHARGES', '*Einmalige Gebühren = ');
define('TEXT_ONETIME_CHARGES_EMAIL', '*Einmalige Gebühren = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Option für Mengenrabatte');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY', 'Stk.');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE', 'Preis');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Option für einmalige Gebühren bei Mengenrabatten');
define('TEXT_CATEGORIES_PRODUCTS', 'Wählen Sie eine Kategorie mit Artikel ...');
define('TEXT_PRODUCT_TO_VIEW', 'Wählen Sie einen Artikel und klicken Sie auf anzeigen ...');

define('TEXT_INFO_SET_MASTER_CATEGORIES_ID', 'Ungültige Master Category ID');
define('TEXT_INFO_ID', ' ID ');
define('TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>Achtung:</strong> Dieser Artikel ist mit mehreren Kategorien verlinkt, aber die Masterkategorie wurde nicht eingestellt!');

define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Preis auf Anfrage');
define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Artikel ist kostenlos');

define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// min, max, units
define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Maximal:');

// Discount Savings
define('PRODUCT_PRICE_DISCOUNT_PREFIX', 'Sie sparen&nbsp;');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '%');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT', '&nbsp;ein');
// Sale Maker Sale Price
define('PRODUCT_PRICE_SALE', 'Abverkauf:&nbsp;');

define('TEXT_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute gesteuert');
// Rich Text / HTML resources
define('TEXT_HTML_EDITOR_NOT_DEFINED', 'Wenn kein HTML Editor definiert oder JavaScript deaktiviert ist, kann hier der HTML Text manuell eingegeben werden.');
define('TEXT_WARNING_HTML_DISABLED', '<span class = "main">HINWEIS: Sie verwenden "Nur-TEXT" als E-Mail Versandmethode. Wenn Sie E-Mails als HTML versenden wollen, müssen Sie "Verwende MIME HTML" in den E-Mail Optionen aktivieren</span>');
define('TEXT_WARNING_CANT_DISPLAY_HTML', '<span class = "main">HINWEIS: Sie verwenden "nur-TEXT" als E-Mail Versandmethode. Wenn Sie E-Mails als HTML versenden wollen, müssen Sie "Verwende MIME HTML" in den E-Mail Optionen aktivieren</span>');
define('TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML', 'Sie können diesen Text lesen, weil wir Ihnen eine E-Mail im HTML Format zugesendet haben. Ihr E-Mail Programm kann jedoch keine Nachrichten im HTML Format anzeigen.');
define('ENTRY_EMAIL_PREFERENCE', 'E-Mail Formateinstellungen:');
define('ENTRY_EMAIL_FORMAT_COMMENTS', 'Die Auswahl "Nie" oder "Wünscht keine Newsletter" deaktiviert ALLE E-Mails, inklusive der Bestellbestätigungen');
define('ENTRY_EMAIL_HTML_DISPLAY', 'HTML');
define('ENTRY_EMAIL_TEXT_DISPLAY', 'Nur-TEXT');
define('ENTRY_EMAIL_NONE_DISPLAY', 'Nie');
define('ENTRY_EMAIL_OPTOUT_DISPLAY', 'Wünscht keine Newsletter');
define('ENTRY_NOTHING_TO_SEND', 'Ihre Nachricht hat keinen Inhalt');
define('EMAIL_SEND_FAILED', 'FEHLER: Senden der E-Mail an: "%s" <%s> mit Betreff: "%s" fehlgeschlagen');
define('EMAIL_SALUTATION', 'Liebe(r)');

define('EDITOR_NONE', 'Normaler Text');
define('TEXT_EDITOR_INFO', 'Interner HTML-Editor');
define('ERROR_EDITORS_FOLDER_NOT_FOUND', 'Sie haben den internen HTML-Editor vorgewählt in Konfiguration -> Mein Shop. Der Ordner kann nicht lokalisiert werden. Bitte prüfen Sie, ob der Ordner verschoben wurde oder deaktivieren Sie die getroffene Einstellung  \''.DIR_WS_CATALOG.'editor/\' Ordner');
define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'Artikelsortierung: ');
define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', 'Artikelsortierung, Artikelname');
define('TEXT_SORT_PRODUCTS_NAME', 'Artikelname');
define('TEXT_SORT_PRODUCTS_MODEL', 'Artikelmodell');
define('TEXT_SORT_PRODUCTS_QUANTITY', 'Artikelmenge+, Artikelname');
define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', 'Artikelmenge-, Artikelname');
define('TEXT_SORT_PRODUCTS_PRICE', 'Artikelpreis+, Artikelname');
define('TEXT_SORT_PRODUCTS_PRICE_DESC', 'Artikelpreis-, Artikelname');
define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'Kategorie Sortierung, Kategoriename');
define('TEXT_SORT_CATEGORIES_NAME', 'Kategoriename');

  define('TEXT_SELECT_MAIN_DIRECTORY', 'Bilder Hauptverzeichnis');

define('TABLE_HEADING_YES', 'Ja');
define('TABLE_HEADING_NO', 'Nein');
define('TEXT_PRODUCTS_IMAGE_MANUAL', '<br /><strong>Oder wählen Sie ein bestehendes Bild vom Server, Dateiname:</strong>');
define('TEXT_IMAGES_OVERWRITE', 'Bestehendes Bild überschreiben? Verwenden Sie "Nein" bei manuell eingegebenem Namen');
define('TEXT_IMAGE_OVERWRITE_WARNING', 'WARNUNG: DATEINAME wurde aktualisiert aber nicht überschrieben ');
define('TEXT_IMAGES_DELETE', 'Bild löschen?<br />(Bilddatei wird dabei nicht vom Server entfernt)');
define('TEXT_IMAGE_CURRENT', 'Bild Name: ');

define('ERROR_DEFINE_OPTION_NAMES', 'WARNUNG: Es wurde kein Attributname definiert');
define('ERROR_DEFINE_OPTION_VALUES', 'WARNUNG: Es wurde kein Optionswert definiert');
define('ERROR_DEFINE_PRODUCTS', 'WARNUNG: Es wurden keine Artikel definiert');
define('ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', 'WARNUNG: Diesem Produkt ist keine Kategorie zugeordnet worden');

define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON', 'Inklusive Unterkategorien hinzufügen');
define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF', 'Ohne Unterkategorien hinzufügen');

define('BUTTON_PREVIOUS_ALT', 'Vorheriger Artikel');
define('BUTTON_NEXT_ALT', 'Nächster Artikel');

define('BUTTON_PRODUCTS_TO_CATEGORIES', 'Mehrfachkategorie Link Manager');
define('BUTTON_PRODUCTS_TO_CATEGORIES_ALT', 'Kopiere Artikel in mehrere Kategorien');

define('TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'Alle globalen Kopier-, Hinzufügen- und Löscheigenschaften sind z.Zt. AUS');
define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'Anzeige globale Eigenschaften - AN');
define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'Anzeige globale Eigenschaften - AUS');

// moved from categories and all product type language files
define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'FEHLER: Kann Produkt nicht in selbe Kategorie verlinken.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'FEHLER: Bilderverzeichnis hat keine Schreibrechte: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Bilderverzeichnis existiert nicht: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'FEHLER: Kategorie kann nicht in eine Unterkategorie verschoben werden.');
define('ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'FEHLER: Produkt existiert bereits in dieser Kategorie.');
define('ERROR_CATEGORY_HAS_PRODUCTS', 'FEHLER: Kategorie enthält Produkte!<br /><br />Diese Aktion ist temporär zulässig während Sie Kategorien neu anordnen. Dennoch gilt der Grundsatz: Eine Kategorie kann entweder andere Kategorien oder Produkte enthalten aber <strong>niemals</strong>beides!');
define('SUCCESS_CATEGORY_MOVED', 'Erfolgreich! Kategorie erfolgreich verschoben ...');
define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'FEHLER: Kategorie kann nicht in sich selbst verschoben werden! ID#');

// EZ-PAGES Alerts
define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'Achtung: EZ-PAGES HEADER - Nur für Admin IP aktiviert');
define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'Achtung: EZ-PAGES FOOTER - Nur für Admin IP aktiviert');
define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'Achtung: EZ-PAGES SIDEBOX - Nur für Admin IP aktiviert');

// moved from product types
// warnings on Virtual and Always Free Shipping
define('TEXT_VIRTUAL_PREVIEW','Achtung: Virtueller Artikel - Versandkostenfrei &amp; keine Versandadresse notwendig!<br />Eine versandkostenfreie Lieferung erfolgt nur, wenn alle Artikel im Warenkorb Virtuelle Artikel sind.');
define('TEXT_VIRTUAL_EDIT','Achtung: Virtueller Artikel - Versandkostenfrei &amp; keine Versandadresse notwendig!<br />Eine versandkostenfreie Lieferung erfolgt nur, wenn alle Artikel im Warenkorb Virtuelle Artikel sind.');
define('TEXT_FREE_SHIPPING_PREVIEW','Achtung: Virtueller Artikel - Versandkostenfrei &amp; keine Versandadresse notwendig!<br />Das Versandarten Modul "Immer versandkostenfrei" muss installiert sein wenn alle Artikel einer Bestellung versandkostenfrei sind');
define('TEXT_FREE_SHIPPING_EDIT','Achtung: Virtueller Artikel - Versandkostenfrei &amp; keine Versandadresse notwendig!<br />Das Versandarten Modul "Immer versandkostenfrei" muss installiert sein wenn alle Artikel einer Bestellung versandkostenfrei sind');

// admin activity log warnings
define('WARNING_ADMIN_ACTIVITY_LOG_DATE', 'Achtung: Die Admin Protokolltabelle hat Einträge die älter sind als 2 Monate und sollte deshalb archiviert werden ... ');
define('WARNING_ADMIN_ACTIVITY_LOG_RECORDS', 'Achtung: Die Admin Protokolltabelle hat über 50000 Einträge und sollte deshalb archiviert werden ... ');
define('RESET_ADMIN_ACTIVITY_LOG', 'Sie können im Menü Administratoren > Admin Aktivitäten Logs die Admin Aktivitäten einsehen und archivieren falls Sie auf diesen Bereich der Shopadministration Zugriff haben.');
define('TEXT_ACTIVITY_LOG_ACCESSED', 'Admin Activity Log aufgerufen. Ausgabeformat: %s. Filter: %s. %s');
define('TEXT_ERROR_FAILED_ADMIN_LOGIN_FOR_USER', 'Admin Login fehlgeschlagen: ');
define('TEXT_ERROR_ATTEMPTED_TO_LOG_IN_TO_LOCKED_ACCOUNT', 'Es wurde versucht mit einem gesperrten Account einzuloggen:');
define('TEXT_ERROR_ATTEMPTED_ADMIN_LOGIN_WITHOUT_CSRF_TOKEN', 'Es wurde versucht ohne CSRF Token einzuloggen.');
define('TEXT_ERROR_ATTEMPTED_ADMIN_LOGIN_WITHOUT_USERNAME', 'Es wurde versucht ohne Username einzuloggen.');
define('TEXT_ERROR_INCORRECT_PASSWORD_DURING_RESET_FOR_USER', 'Falsches Passwort beim Versuch ein neues Passwort zu setzen für: ');

define('CATEGORY_HAS_SUBCATEGORIES', 'Achtung: Kategorie besitzt Unterkategorien<br />Artikel können nicht hinzugefügt werden');

define('WARNING_WELCOME_DISCOUNT_COUPON_EXPIRES_IN', 'Warnung! Der Aktionskupon "Willkommensgeschenk" läuft in %s Tagen ab.');

define('WARNING_ADMIN_FOLDERNAME_VULNERABLE', 'VORSICHT: <a href="http://www.zen-cart-pro.at/zcvb/forum/vbglossar.php?do=showentry&id=6" target="_blank">Sie sollten den Ordner /admin/ in irgendwas weniger auffallendes umbenennen</a>, um ihn vor unbefugten Zugriffen zu schützen.');
define('WARNING_EMAIL_SYSTEM_DISABLED', 'WARNUNG: Das Emailsystem ist abgeschaltet. Es werden keine Emails vom Shop versendet, bevor Sie das nicht unter Admin->Konfiguration->Email Optionen aktivieren..');
define('TEXT_CURRENT_VER_IS', 'Sie benutzen gerade: ');
define('ERROR_NO_DATA_TO_SAVE', 'FEHLER: Die übertragenen Daten waren leer. IHRE ÄNDERUNGEN WURDEN *NICHT* GESPEICHERT. Sie haben möglicherweise ein Problem mit Ihrem Browser oder Ihrer Internetverbindung.');
define('TEXT_HIDDEN', 'Versteckt');
define('TEXT_VISIBLE', 'Sichtbar');
define('TEXT_HIDE', 'Verstecken');
define('TEXT_EMAIL', 'E-Mail');
define('TEXT_NOEMAIL', 'Keine E-Mail');

define('BOX_HEADING_PRODUCT_TYPES', 'Artikeltypen');

define('ERROR_DATABASE_MAINTENANCE_NEEDED', '<a href="http://www.zen-cart-pro.at/forum" target="_blank">FEHLER 0071: Es scheint ein Problem mit der Datenbank zu geben. Ausführung von Datenbankwartungsfunktionen ist erforderlich.</a>');
// moved from currencies file:
define('TEXT_INFO_CURRENCY_UPDATED', 'Der Wechselkurs für %s (%s) wurde erfolgreich auf %s aktualisiert via  %s.');
define('ERROR_CURRENCY_INVALID', 'Fehler: Der Wechselkurs für %s (%s) wurde nicht aktualisiert via %s. Ist der Währungscode wirklich korrekt?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Warnung: Der primäre Wechselkursserver (%s) ist für %s (%s) fehlgeschlagen - versuche sekundären Wechselkursserver.');
///////////////////////////////////////////////////////////
// include additional files:
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
  include(zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false'));

// Additional Localisation - Languages - Phone Country Code
define('TEXT_INFO_LANGUAGE_ID', 'Geben Sie den Telefon Ländercode OHNE 0 ein<br />(english MUSS 1 sein, deutsch MUSS 43 sein):');
define('TEXT_INFO_LANGUAGE_CODE', 'Code:<br />(en = englisch, de = deutsch)');

// Keepalive Module
define('TEXT_TIMEOUT_WARNING', '**WARNUNG**');
define('TEXT_TIMEOUT_TIME_REMAINING', ' verbleibende Zeit:');
define('TEXT_TIMEOUT_SECONDS', 'Sekunden!');
define('TEXT_TIMEOUT_ARE_YOU_STILL_THERE', 'Sind Sie noch da?');
define('TEXT_TIMEOUT_WILL_LOGOUT_SOON', 'Sie waren inaktiv und werden demnächst automatisch ausgeloggt.');
define('TEXT_TIMEOUT_STAY_LOGGED_IN', 'Weiterarbeiten');
define('TEXT_TIMEOUT_LOGOUT_NOW', 'Jetzt abmelden');
define('TEXT_TIMEOUT_TIMED_OUT_TITLE', 'Abgemeldet.');
define('TEXT_TIMEOUT_LOGIN_AGAIN', 'Wieder anmelden');
define('TEXT_TIMEOUT_TIMED_OUT_MESSAGE', 'Ihre Session ist abgelaufen. Sie waren inaktiv, daher wurden Sie automatisch ausgeloggt.');