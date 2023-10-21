<?php
/**
 * Zen Cart German Specific 
 * 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: german.php 2022-12-17 14:12:57Z webchills $
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'Zen Cart!');
//define('SITE_TAGLINE', 'The Art of E-commerce');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>. Powered by <a href="https://www.zen-cart-pro.at" rel="noopener noreferrer" target="_blank">Zen Cart</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
$locales = ['de_DE.UTF-8', 'de_AT.UTF-8', 'de_CH.UTF-8', 'de_DE.ISO_8859-1','de_DE@euro', 'de_DE', 'de', 'ge', 'deu.deu'];
@setlocale(LC_TIME, $locales);

define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); 
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()


////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
  if (!function_exists('zen_date_raw')) {
function zen_date_raw($date, $reverse = false){
     if ($reverse){
         return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
         }else{
        // edit by cyaneo for german Date support - thx to hugo13
        // return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
        return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
         }
    }
  }

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag

if (FACEBOOK_OPEN_GRAPH_STATUS == "true") {
define('HTML_PARAMS','dir="ltr" lang="de" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml"');

} else {
define('HTML_PARAMS', 'dir="ltr" lang="de"');
}

// charset for web pages and emails
define('CHARSET', 'utf-8');


// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
define('TEXT_GV_NAME', 'Geschenkgutschein');
define('TEXT_GV_NAMES', 'Geschenkgutscheine');

// used for redeem code, redemption code, or redemption id
define('TEXT_GV_REDEEM', 'Gutscheinnummer');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('DIVERS', 'Divers/keine Anrede');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd.mm.yyyy');

//text for sidebox heading links
define('BOX_HEADING_LINKS', ' [mehr]');

// categories box text in sideboxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorien');

// manufacturers box text in sideboxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Hersteller');

// whats_new box text in sideboxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Neue Artikel');
define('CATEGORIES_BOX_HEADING_WHATS_NEW', 'Neue Artikel ...');


define('BOX_HEADING_FEATURED_PRODUCTS', 'Empfohlene Artikel');
define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', 'Empfohlene Artikel ...');
define('TEXT_NO_FEATURED_PRODUCTS', 'Weitere empfohlene Artikel erscheinen in Kürze. Bitte besuchen Sie unseren Shop regelmäßig wieder.');

define('TEXT_NO_ALL_PRODUCTS', 'Weitere Artikel erscheinen in Kürze. Bitte besuchen Sie unseren Shop regelmäßig wieder.');
define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', 'Alle Artikel ...');

// quick_find box text in sideboxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Suche');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Erweiterte Suche');


// specials box text in sideboxes/specials.php
define('BOX_HEADING_SPECIALS', 'Sonderangebote');
define('CATEGORIES_BOX_HEADING_SPECIALS', 'Sonderangebote ...');

// reviews box text in sideboxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Bewertungen');
define('BOX_REVIEWS_WRITE_REVIEW', 'Schreiben Sie eine Bewertung.');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in sideboxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Warenkorb');
define('BOX_SHOPPING_CART_EMPTY', 'Ihr Warenkorb ist leer');
define('BOX_SHOPPING_CART_DIVIDER', '&nbsp;x&nbsp;');

// order_history box text in sideboxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestellte Artikel');

// best_sellers box text in sideboxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Top Artikel');


// notifications box text in sideboxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Benachrichtigungen');
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich über Updates zu <strong>%s</strong>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr über Updates zu <strong>%s</strong>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Herstellerinformationen');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Weitere Artikel');

// languages box text in sideboxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Sprachen');

// currencies box text in sideboxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Währungen');

// information box text in sideboxes/information.php
define('BOX_HEADING_INFORMATION', 'Information');
define('BOX_INFORMATION_PRIVACY', 'Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'AGB');
define('BOX_INFORMATION_SHIPPING', 'Preise und Versand');
define('BOX_INFORMATION_WIDERRUFSRECHT', 'Widerrufsrecht');
define('BOX_INFORMATION_ZAHLUNGSARTEN', 'Zahlungsarten');
define('BOX_INFORMATION_IMPRESSUM', 'Impressum');
define('BOX_INFORMATION_CONTACT', 'Kontakt');

define('BOX_INFORMATION_UNSUBSCRIBE', 'Newsletter abbestellen');

define('BOX_INFORMATION_SITE_MAP', 'Site Map');

// information box text in sideboxes/more_information.php - were TUTORIAL_
define('BOX_HEADING_MORE_INFORMATION', 'Weitere Informationen');
define('BOX_INFORMATION_PAGE_2', 'Seite 2');
define('BOX_INFORMATION_PAGE_3', 'Seite 3');
define('BOX_INFORMATION_PAGE_4', 'Seite 4');


//New billing address text
define('SET_AS_PRIMARY', 'Als Standardadresse verwenden');


// javascript messages
define('JS_ERROR', 'Es sind Fehler aufgetreten.\n\n Bitte ändern Sie folgendes:\n\n');

define('JS_REVIEW_TEXT', '* Ihre Texteingabe in der Artikelbewertung muss mindestens ' . REVIEW_TEXT_MIN_LENGTH . ' Zeichen haben.');
define('JS_REVIEW_RATING', '* Bitte wählen Sie ein Rating für diesen Artikel.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte wählen Sie eine Zahlungsart aus.');

define('JS_ERROR_SUBMITTED', 'Die Seite wurde bereits übertragen. Klicken Sie auf \"OK\" und warten Sie auf das Ende des Vorgangs.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsart aus.');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Bitte bestätigen Sie unsere AGB!');
define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', 'Bitte bestätigen Sie unsere Datenschutzbestimmungen!');

define('CATEGORY_COMPANY', 'Firma');

define('CATEGORY_PERSONAL', 'Ihre persönlichen Angaben');

define('PULL_DOWN_DEFAULT', 'Bitte wählen Sie Ihr Land');
define('PLEASE_SELECT', 'Bitte wählen Sie ...');
define('TYPE_BELOW', 'Bitte wählen Sie unten ...');

define('ENTRY_COMPANY', 'Firma:');
define('ENTRY_COMPANY_ERROR', 'Bitte geben Sie einen Firmennamen ein.');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Anrede:');
define('ENTRY_GENDER_ERROR', 'Bitte wählen Sie Ihre Anrede.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Ihr Vorname muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Ihr Nachname muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Ihr Geburtsdatum muss folgende Form haben: TT.MM.JJJJ (z.B. 21.02.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (z.B. 21.02.1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Ihre E-Mail Adresse muss mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Ihre E-Mail Adresse scheint nicht korrekt zu sein. Bitte ändern Sie diese.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Ihre E-Mail Adresse ist bereits registriert. Bitte melden Sie sich an oder registrieren Sie sich mit einer anderen E-Mail Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_EMAIL_ADDRESS_CONFIRM', 'E-Mail bestätigen:');
define('ENTRY_EMAIL_ADDRESS_CONFIRM_NOT_MATCHING', 'Die angegebenen Emailadressen stimmen nicht überein.');
define('ENTRY_NICK', 'Forum Nick Name:');
define('ENTRY_NICK_TEXT', '*');   // note to display beside nickname input field
define('ENTRY_NICK_DUPLICATE_ERROR', 'Der Nickname existiert bereits.');

define('ENTRY_STREET_ADDRESS', 'Straße:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Straße muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Anschrift Zeile 2:');

define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl muss aus mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CUSTOMERS_REFERRAL', 'Wie wurden Sie auf uns aufmerksam ');

define('ENTRY_CITY_ERROR', 'Die Stadt muss aus mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Das Bundesland muss aus mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte wählen Sie ein Bundesland aus dem Pulldown Menü.');
define('ENTRY_STATE_TEXT', '*');

define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus dem Pulldown Menü.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');

define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter bestellen.');
define('ENTRY_NEWSLETTER_TEXT', '');

define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Die Passwortbestätigung stimmt nicht mit dem eingegebenen Passwort überein.');
define('ENTRY_PASSWORD_TEXT', '* (mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen)');
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwortbestätigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');

define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwortbestätigung stimmt nicht mit dem neu eingegebenen Passwort überein.');


define('FORM_REQUIRED_INFORMATION', '* = Pflichtfeld');
define('ENTRY_REQUIRED_SYMBOL', '*');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="alert">*</span>');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> neuen Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> empfohlenen Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikeln)');


define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Nächste Seite');

define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorherige %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Nächste %d Seiten');

define('PREVNEXT_BUTTON_PREV', '[&laquo;&nbsp;Vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[Nächste&nbsp;&raquo;]');
define('ARIA_PAGINATION_ROLE_LABEL_GENERAL','Seitenumbruch');
define('ARIA_PAGINATION_ROLE_LABEL_FOR','%s Seitenumbruch'); // eg: "Search results Pagination"
define('ARIA_PAGINATION_PREVIOUS_PAGE','Gehe zur vorherigen Seite');
define('ARIA_PAGINATION_NEXT_PAGE','Gehe zur nächsten Seite');
define('ARIA_PAGINATION_CURRENT_PAGE','Aktuelle Seite');
define('ARIA_PAGINATION_CURRENTLY_ON',', jetzt auf Seite %s');
define('ARIA_PAGINATION_GOTO','Gehe zu ');
define('ARIA_PAGINATION_PAGE_NUM','Seite %s');
define('ARIA_PAGINATION_ELLIPSIS_PREVIOUS','Gehe zur vorherigen Seitengruppe');
define('ARIA_PAGINATION_ELLIPSIS_NEXT','Gehe zur nächsten Seitengruppe');
define('ARIA_PAGINATION_','');

define('TEXT_BASE_PRICE', 'ab ');

define('TEXT_CLICK_TO_ENLARGE', 'größeres Bild');
define('TEXT_CLOSE_WINDOW_IMAGE', 'Bild zum Schließen anclicken');

define('TEXT_SORT_PRODUCTS', 'Artikel sortieren ');
define('TEXT_DESCENDINGLY', 'aufsteigend');
define('TEXT_ASCENDINGLY', 'absteigend');
define('TEXT_BY', ' von ');

define('TEXT_REVIEW_BY', 'von %s');

define('TEXT_REVIEW_DATE_ADDED', 'Eingetragen: %s');
define('TEXT_NO_REVIEWS', 'Derzeit gibt es keine Bewertungen.');

define('TEXT_NO_NEW_PRODUCTS', 'Weitere neue Artikel erscheinen in Kürze. Bitte besuchen Sie unseren Shop regelmäßig wieder.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('WARNING_COULD_NOT_LOCATE_LANG_FILE', 'WARNUNG: Sprachdatei wurde nicht gefunden: ');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das eingegebene Gültigkeitsdatum der Kreditkarte ist ungültig. Bitte überprüfen Sie das Datum und versuchen Sie es erneut.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die eingegebene Kreditkartennummer ist ungültig. Bitte überprüfen Sie die Nummer und versuchen Sie es erneut.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die Kreditkartennummer, die mit %s beginnt, wurde nicht korrekt eingegeben, oder wir akzeptieren diese Art von Karte nicht. Bitte versuchen Sie es erneut oder verwenden Sie eine andere Kreditkarte.');

define('BOX_INFORMATION_DISCOUNT_COUPONS', 'Aktionskupon');
define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' FAQ');
define('VOUCHER_BALANCE', TEXT_GV_NAME . ' Konto: ');
define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . ' Konto');
define('GV_FAQ', TEXT_GV_NAME . ' FAQ');
define('ERROR_REDEEMED_AMOUNT', 'Herzlichen Glückwunsch!<br>Sie haben Ihren Gutschein erfolgreich eingelöst.<br>Betrag: ');
define('ERROR_NO_REDEEM_CODE', 'Sie haben keine ' . TEXT_GV_REDEEM . ' eingegeben.');
define('ERROR_NO_INVALID_REDEEM_GV', 'Ungültiger ' . TEXT_GV_NAME . ' oder ' . TEXT_GV_REDEEM);
define('TABLE_HEADING_CREDIT', 'Guthaben verfügbar');
define('TEXT_SEND_OR_SPEND','Sie haben Guthaben auf Ihrem ' . TEXT_GV_NAME . 'konto. Wenn Sie möchten <br>können Sie dieses Guthaben durch Klick auf untenstehende Schaltfläche an eine andere Person senden.');
define('TEXT_BALANCE_IS', 'Ihr Guthaben beträgt: ');
define('TEXT_AVAILABLE_BALANCE', 'Ihr ' . TEXT_GV_NAME . ' Konto');

// payment method is GV/Discount
define('PAYMENT_METHOD_GV', 'Geschenkgutschein /Aktionskupon');
define('PAYMENT_MODULE_GV', 'GS/AK');

define('TABLE_HEADING_CREDIT_PAYMENT', 'Guthaben verfügbar');

//coupon redeem error messages (checkout payment)
define('TEXT_COUPON_LINK_TITLE', 'Bedingungen für diesen Gutscheincode ansehen');
define('TEXT_INVALID_REDEEM_COUPON', 'Gutscheincode "%s" ist ungültig.');
define('TEXT_INVALID_REDEEM_COUPON_MINIMUM', 'Der Mindestbestellwert liegt bei %2$s zum Einlösen von Gutscheincode "%1$s".');
define('TEXT_INVALID_COUPON_PRODUCT', 'Der Gutscheincode "%1$s" ist für die Artikel in Ihrem Warenkorb nicht gültig.');
define('TEXT_INVALID_COUPON_ORDER_LIMIT', 'Sie haben die maximal erlaubte Anzahl von Bestellungen (%2$u) überschritten, zum Einlösen dieses Gutscheincode "%1$s".');
define('TEXT_INVALID_STARTDATE_COUPON', 'Der Gutscheincode "%1$s" is nicht gültig für eine Einlösung bis %2$s.');
define('TEXT_INVALID_FINISHDATE_COUPON', 'Der Gutscheincode "%1$s" ist jetzt nicht gültig (abgelaufen %2$s).');
define('TEXT_INVALID_USES_COUPON', 'Gutscheincode "%1$s" hat die maximale Einlöseanzahl erreicht (%2$u).');
define('TEXT_INVALID_USES_USER_COUPON', 'Sie haben mit Gutscheincode "%1$s" bereits die maximale Einlöseanzahl pro Kunde erreicht (%2$u).');
define('TEXT_REMOVE_REDEEM_COUPON_ZONE', 'Der Gutscheincode "%s" ist für die ausgewählte Adresse nicht gültig.');
define('TEXT_ERROR', 'Ein Fehler ist aufgetreten');

define('TEXT_VALID_COUPON', 'Gutscheincode erfolgreich eingelöst');


// more info in place of buy now
define('MORE_INFO_TEXT', '... weitere Infos');

// IP Address
define('TEXT_YOUR_IP_ADDRESS', 'Ihre IP Adresse lautet:');

//Generic Address Heading
define('HEADING_ADDRESS_INFORMATION', 'Adressinformation');

// cart contents
define('PRODUCTS_ORDER_QTY_TEXT_IN_CART', 'Stück im Warenkorb: ');
define('PRODUCTS_ORDER_QTY_TEXT', 'Anzahl: ');
define('ARIA_QTY_ADD_TO_CART','Menge eingeben, die in den Warenkorb gelegt werden soll');
define('ARIA_EDIT_QTY_IN_CART','Menge im Warenkorb ändern');
define('ARIA_DELETE_ITEM_FROM_CART', 'Artikel aus Warenkorb löschen');

// success messages for added to cart when display cart is off
// set to blank for no messages
// for all pages except where multiple add to cart is used:
define('SUCCESS_ADDED_TO_CART_PRODUCT', 'Der Artikel wurde in den Warenkorb gelegt ...');
// only for where multiple add to cart is used:
define('SUCCESS_ADDED_TO_CART_PRODUCTS', 'Die ausgewählten Artikel wurden in den Warenkorb gelegt ...');

define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// Shipping
define('TEXT_SHIPPING_WEIGHT','kg');
define('TEXT_SHIPPING_BOXES', 'Pakete');

// Cross Sell
define('TEXT_XSELL_PRODUCTS', 'Zu diesem Artikel empfehlen wir...');

// Discount Savings
define('PRODUCT_PRICE_DISCOUNT_PREFIX', 'Sie sparen ');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '% !');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT', ' weniger');

// Sale Maker Sale Price
define('PRODUCT_PRICE_SALE', 'Jetzt nur noch ');

//universal symbols
define('TEXT_NUMBER_SYMBOL', '#');

// banner_box
define('BOX_HEADING_BANNER_BOX', 'Partner');
define('TEXT_BANNER_BOX', 'Besuchen Sie auch unsere Partner ...');

// banner box 2
define('BOX_HEADING_BANNER_BOX2', 'Schon gesehen? ...');
define('TEXT_BANNER_BOX2', 'Besuchen Sie uns noch heute!');

// banner_box - all
define('BOX_HEADING_BANNER_BOX_ALL', 'Partner');
define('TEXT_BANNER_BOX_ALL', 'Besuchen Sie auch unsere Partner ...');

// boxes defines
define('PULL_DOWN_ALL', 'Bitte auswählen');
define('PULL_DOWN_MANUFACTURERS', '- Zurücksetzen -');
// shipping estimator
define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', 'Bitte wählen');

// general Sort By
define('TEXT_INFO_SORT_BY', 'Sortiert nach: ');

// close window image popups
define('TEXT_CLOSE_WINDOW', ' - zum Schließen ins Bild klicken');
// close popups
define('TEXT_CURRENT_CLOSE_WINDOW', '[ Fenster schließen ]');

// iii 031104 added:  File upload error strings
define('ERROR_FILETYPE_NOT_ALLOWED', 'FEHLER: Dateityp nicht erlaubt.');
define('WARNING_NO_FILE_UPLOADED', 'WARNUNG: Keine Datei hochgeladen');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Die Datei wurde erfolgreich gespeichert.');
define('ERROR_FILE_NOT_SAVED', 'FEHLER: Datei nicht gespeichert.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'FEHLER: Auf das Ziel konnte nicht geschrieben werden.');
define('ERROR_DESTINATION_DOES_NOT_EXIST', 'FEHLER: Das Ziel existiert nicht.');
define('ERROR_FILE_TOO_BIG', 'WARNUNG: Die Datei ist zu groß für den Upload!<br>Der Auftrag kann erteilt werden, nehmen Sie bitte mit uns Kontakt auf um den Upload erfolgreich abzuschließen.');
// End iii added

define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'HINWEIS: Unser Shop ist wegen Wartungsarbeiten geschlossen bis (dd/mm/yy) (hh-hh): ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'HINWEIS: Unser Shop ist wegen Wartungsarbeiten geschlossen.');

define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Kostenlos!');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Für Preis anfragen');
define('TEXT_CALL_FOR_PRICE', 'Für Preis anfragen');

define('TEXT_INVALID_SELECTION',' haben Sie eine ungültige Auswahl getroffen: ');
define('TEXT_ERROR_OPTION_FOR', 'Bei der Option für ');
define('TEXT_INVALID_USER_INPUT', 'Benutzereingabe benötigt<br>');

// product_listing
define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Minimum:');
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'Stück:');

define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Maximal:');
define('TEXT_PRODUCT_MODEL', 'Artikelnummer: ');
define('TABLE_HEADING_MODEL', 'Artikelnummer');

define('TEXT_PRODUCTS_MIX_OFF', '*gemischt: AUS');
define('TEXT_PRODUCTS_MIX_ON', '*gemischt: EIN');
  define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','<br>*Sie können die Optionen dieses Artikels nicht mischen, um die Mindestanzahl zu erreichen.*<br>');
define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART', '*gemischte Attributmerkmale: EIN');
define('ERROR_MAXIMUM_QTY', 'Stückzahl angepasst - maximale Stückzahl wurde in den Warenkorb gelegt ');

define('ERROR_CORRECTIONS_HEADING', 'Bitte korrigieren Sie folgendes: <br>');
define('ERROR_QUANTITY_ADJUSTED', 'Fehler in der gewählten Menge<br>');
define('ERROR_QUANTITY_CHANGED_FROM', ', wurde geändert von: ');
define('ERROR_QUANTITY_CHANGED_TO', ' in ');

// Downloads Controller
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG', 'Hinweis: Downloads werden erst nach Bestätigung des Zahlungseingangs freigeschaltet.');
define('TEXT_FILESIZE_BYTES', ' bytes');
define('TEXT_FILESIZE_KBS', ' KB');
define('TEXT_FILESIZE_MEGS', ' MB');
define('TEXT_FILESIZE_UNKNOWN', 'Unbekannt');

// shopping cart errors
define('ERROR_PRODUCT', '<br>Der Artikel: ');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br>Leider ist dieses Produkt derzeit nicht in unserem Warenbestand.<br>Das Produkt wurde aus dem Warenkorb entfernt.');
define('ERROR_PRODUCT_ATTRIBUTES','<br>Der Artikel: ');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART_ATTRIBUTES','<br>Es tut uns leid, aber die gewählten Optionen für diesen Artikel haben sich geändert und stehen derzeit in unserem Sortiment nicht mehr zur Verfügung.<br>Dieser Artikel wurde aus Ihrem Warenkorb entfernt.');
define('ERROR_PRODUCT_QUANTITY_MIN', '... minimale Stückzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS', '... ungültige Stückzahl -');
define('ERROR_PRODUCT_OPTION_SELECTION', '<br>... ungültige Attributmerkmale gewählt ');
define('ERROR_PRODUCT_QUANTITY_ORDERED', '<br>Die Summe Ihrer Bestellung:');
define('ERROR_PRODUCT_QUANTITY_MAX', '... maximale Stückzahl überschritten -');
define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART', '... minimale Stückzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART', '... ungültige Stückzahl -');
define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART', '... maximale Stückzahl überschritten -');
define('WARNING_SHOPPING_CART_COMBINED', 'HINWEIS: Ihr aktueller Warenkorb wurde mit dem Warenkorb Ihres letzten Besuchs zusammengelegt. Bitte überprüfen Sie den Inhalt Ihres Warenkorbs, bevor Sie ihre Bestellung abschließen.');
define('WARNING_PRODUCT_QUANTITY_ADJUSTED', 'Die Menge wurde automatisch auf den verfügbaren Lagerbestand angepasst. ');
define('OUT_OF_STOCK_CANT_CHECKOUT', 'Mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' gekennzeichnete Artikel sind derzeit nicht in ausreichender Menge lagernd.<br>Bitte ändern Sie die Menge bei den mit (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ') gekennzeichneten Artikeln. Danke.');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' gekennzeichnete Artikel sind nicht lagernd.<br>Diese Artikel werden nachgeliefert.');

// error on checkout when $_SESSION['customers_id' does not exist in customers table
define('ERROR_CUSTOMERS_ID_INVALID', 'Die Kundeninformation konnte nicht verifiziert werden!<br>Bitte melden Sie sich an oder erstellen Sie Ihr Kundenkonto erneut ...');

define('TABLE_HEADING_FEATURED_PRODUCTS','Empfohlene Artikel');

define('TABLE_HEADING_NEW_PRODUCTS', 'Neue Artikel im %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Artikelankündigungen');
define('TABLE_HEADING_DATE_EXPECTED', 'Erscheinungsdatum');
define('TABLE_HEADING_SPECIALS_INDEX', 'Monatliche Sonderangebote im %s');
define('CAPTION_UPCOMING_PRODUCTS','Diese Artikel sind in Kürze lieferbar');


// meta tags special defines
define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','Kostenlos!');
define('ASK_A_QUESTION', 'Frage zum Artikel stellen');

// customer login
define('TEXT_SHOWCASE_ONLY', 'Kontakt');
// set for login for prices
define('TEXT_LOGIN_FOR_PRICE_PRICE', 'Preis nicht verfügbar');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE', 'Für Preis bitte anmelden');
// set for show room only
define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', '');// blank for prices or enter your own text
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM', 'Nur Schauraum');

// authorization pending
define('TEXT_AUTHORIZATION_PENDING_PRICE', 'Preis nicht verfügbar');
define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', 'ÜBERPRÜFUNG LÄUFT');
define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Im Shop anmelden');
define('TEXT_AUTHORIZATION_PENDING_CHECKOUT', 'Checkout nicht möglich - Ihr Kundenkonto ist noch nicht freigeschaltet');

// text pricing
define('TEXT_CHARGES_WORD', 'Kalkulierte Gebühr:');
define('TEXT_PER_WORD', '<br>Preis pro Wort: ');
define('TEXT_WORDS_FREE', ' Wort(e) frei ');
define('TEXT_CHARGES_LETTERS', 'Kalkulierte Gebühr:');
define('TEXT_PER_LETTER', '<br>Preis pro Buchstabe: ');
define('TEXT_LETTERS_FREE', ' Buchstabe(n) frei ');
define('TEXT_ONETIME_CHARGES', '*einmalige Gebühr = ');
define('TEXT_ONETIME_CHARGES_EMAIL', "\t" . '*einmalige Gebühr = ');

define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Option für Mengenrabatte');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY', 'STK');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE', 'PREIS');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Option für einmalige Gebühren für Mengenrabatte');

// textarea attribute input fields
define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' maximale Buchstaben erlaubt');


// Shipping Estimator
define('CART_SHIPPING_OPTIONS', 'Voraussichtliche Versandkosten:');
define('CART_SHIPPING_METHOD_TEXT', 'Verfügbare Versandarten');
define('CART_SHIPPING_METHOD_RATES', 'Kosten:');
define('CART_SHIPPING_METHOD_TO', 'Versand an: ');
define('CART_SHIPPING_METHOD_FREE_TEXT', 'kostenloser Versand');
define('CART_SHIPPING_METHOD_ALL_DOWNLOADS', '- Downloads');
define('CART_SHIPPING_METHOD_ZIP_REQUIRED', 'true');
define('CART_SHIPPING_METHOD_ADDRESS', 'Adresse:');
  

define('CART_ITEMS', 'im Warenkorb: ');

define('ERROR_CART_UPDATE', '<strong>Bitte aktualisieren Sie Ihre Bestellung</strong>');

define('EMPTY_CART_TEXT_NO_QUOTE', 'Uups! Ihre Sitzung ist abgelaufen ... Aktualisieren Sie bitte Ihren Warenkorb für die Versandkosten');
define('CART_SHIPPING_QUOTE_CRITERIA', 'Die Versandkosten werden aufgrund der ausgewählten Adresse berechnet:');

// multiple product add to cart
define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');
define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 'Anzahl: ');   
//moved SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART to button_names.php as BUTTON_ADD_PRODUCTS_TO_CART_ALT

// discount qty table
define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', 'Abzug für Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', 'Preis abzüglich Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', 'Abzug für Mengenrabatt');
define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* Rabatte können abhängig von den unteren Optionen variieren');
define('TEXT_HEADER_DISCOUNTS_OFF', 'Keine Rabatte möglich ...');

// sort order titles for dropdowns
define('PULL_DOWN_ALL_RESET','- Zurücksetzen - ');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', 'Artikelname');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', 'Artikelname - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', 'Preis - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', 'Preis - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'Artikelnummer');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', 'Erstelldatum - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', 'Erstelldatum - absteigend');


// downloads module defines
define('TABLE_HEADING_DOWNLOAD_DATE', 'Link gültig bis');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Verbleibend');
define('HEADING_DOWNLOAD', 'Um Ihre Dateien herunterzuladen, klicken Sie bitte auf den Download Button und wählen Sie "Ziel speichern unter".');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Dateiname');
define('TABLE_HEADING_PRODUCT_NAME','Artikel');
define('TABLE_HEADING_BYTE_SIZE','Dateigröße');
define('TEXT_DOWNLOADS_UNLIMITED', 'Unbegrenzt');
define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc

define('PAYMENT_JAVASCRIPT_DISABLED', 'Die Bestellung konnte nicht fortgesetzt werden, da Javascript deaktiviert ist. Bitte aktivieren Sie Javascript um fortzufahren.');

// table headings for cart display and upcoming products
define('TABLE_HEADING_QUANTITY', 'Stück');
define('TABLE_HEADING_PRODUCTS', 'Artikelname');
define('TABLE_HEADING_TOTAL', 'Summe');

// create account - login shared
define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Datenschutzbestimmungen');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Bitte bestätigen Sie Ihr Einverständnis mit unseren Datenschutzbestimmungen, indem Sie die Checkbox aktivieren. Die Datenschutzbestimmungen können Sie <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">hier</span></a> nachlesen.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'Ich habe die Datenschutzbestimmungen gelesen und akzeptiert.');
define('TABLE_HEADING_ADDRESS_DETAILS', 'Bitte tragen Sie Ihre Adressangaben ein');
define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Wie kann man Sie erreichen?');
define('TABLE_HEADING_DATE_OF_BIRTH', 'Bitte geben Sie Ihr Geburtsdatum an');
define('TABLE_HEADING_LOGIN_DETAILS', 'Bitte geben Sie hier Ihre Anmeldedaten ein');
define('TABLE_HEADING_REFERRAL_DETAILS', 'Wie wurden Sie auf unseren Shop aufmerksam?');
define('ERROR_TEXT_COUNTRY_DISABLED_PLEASE_CHANGE', 'Leider akzeptieren wie nicht länger Rechnungsadressen oder Lieferadressen in "%s".  Bitte ändern Sie diese Adresse, um fortzufahren.');
define('ENTRY_EMAIL_PREFERENCE','Newsletter und E-Mail Format');
define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
define('ENTRY_EMAIL_TEXT_DISPLAY','nur TEXT');
define('EMAIL_SEND_FAILED','FEHLER: E-Mail wurde nicht an: "%s" <%s> versendet. Betreff: "%s"');

define('DB_ERROR_NOT_CONNECTED', 'FEHLER: Es konnte keine Verbindung mit der Datenbank hergestellt werden');
define('ERROR_DATABASE_MAINTENANCE_NEEDED', '<a href="http://www.zen-cart.com/content.php?334-ERROR-0071-There-appears-to-be-a-problem-with-the-database-Maintenance-is-required" target="_blank">ERROR 0071: Es scheint ein Problem mit der Datenbank zu geben. Datenbankwartung erforderlich.</a>');

// EZ-PAGES Alerts
define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'WARNING: EZ-PAGES HEADER - Darf nur vom Admin geöffnet werden ');
define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'WARNING: EZ-PAGES FOOTER - Darf nur vom Admin geöffnet werden ');
define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'WARNING: EZ-PAGES SIDEBOX - Darf nur vom Admin geöffnet werden ');

// extra product listing sorter
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER', '');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES', 'Artikelname, beginnend mit...');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET', '-- Zurücksetzen --');
// The following message, with the associated severity, is displayed in the storefront header when an admin has logged into
// a customer's account.

// -----
// init_customer_auth.php substitutes the customer's name (%$1s) and customer's email address (%$2s)
// into this message.
//
define('EMP_SHOPPING_FOR_MESSAGE', 'Derzeit eingeloggt als %1$s (%2$s).');

// -----
// Identify the messageStack "severity" to be applied to the above message, one of 'success',
// 'warning', 'caution', 'error' (defaults to 'success').
//
define('EMP_SHOPPING_FOR_MESSAGE_SEVERITY', 'success');
// Constants shared between multiple pages
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');
///////////////////////////////////////////////////////////

  $file_list = [FILENAME_EMAIL_EXTRAS, FILENAME_HEADER, FILENAME_BUTTON_NAMES, FILENAME_ICON_NAMES, FILENAME_OTHER_IMAGES_NAMES, FILENAME_CREDIT_CARDS, FILENAME_WHOS_ONLINE, FILENAME_META_TAGS];
  foreach ($file_list as $file) { 
    $file = str_replace(".php","",$file); 
    require_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . "/", $file . '.php', 'false'));
  }

// END OF EXTERNAL LANGUAGE LINKS
