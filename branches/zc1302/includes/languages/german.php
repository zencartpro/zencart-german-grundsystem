<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: german.php 5 2006-04-03 08:28:13Z hugo13 $
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'Zen Cart!');
//define('SITE_TAGLINE', 'The Art of E-commerce');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

  define('FOOTER_TEXT_BODY', 'Copyright &copy; 2006 Softwarelandschaft GmbH. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'de_DE.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d.%m %Y'); // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

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


// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'Aufrufe seit');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
define('TEXT_GV_NAME', 'Geschenkgutschein');
define('TEXT_GV_NAMES', 'Geschenkgutscheine');

// used for redeem code, redemption code, or redemption id
define('TEXT_GV_REDEEM', 'Gutscheinnummer');





// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('MALE_ADDRESS', 'Herr');
define('FEMALE_ADDRESS', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// text for sidebox heading links
define('BOX_HEADING_LINKS', '  [mehr]');

// categories box text in sideboxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorien');

// manufacturers box text in sideboxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Hersteller');

// whats_new box text in sideboxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Neue Artikel');
define('CATEGORIES_BOX_HEADING_WHATS_NEW', 'Neue Artikel...');

define('BOX_HEADING_FEATURED_PRODUCTS', 'Ähnliche Artikel');
define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', 'Ähnliche Artikel...');
define('TEXT_NO_FEATURED_PRODUCTS', 'Weitere &auml;hnliche Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm&auml;&szlig;ig wieder.');

define('TEXT_NO_ALL_PRODUCTS', 'Weitere Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm&auml;&szlig;ig wieder.');
define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', 'Alle Artikel...');

// quick_find box text in sideboxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Suche');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Erweiterte Suche');

// specials box text in sideboxes/specials.php
define('BOX_HEADING_SPECIALS', 'Sonderangebote');
define('CATEGORIES_BOX_HEADING_SPECIALS', 'Sonderangebote...');


// reviews box text in sideboxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Bewertungen');
define('BOX_REVIEWS_WRITE_REVIEW', 'Schreiben Sie eine Bewertung.');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in sideboxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Warenkorb');
define('BOX_SHOPPING_CART_EMPTY', 'leer');
  define('BOX_SHOPPING_CART_DIVIDER', '&nbsp;Stk.&nbsp;');

// order_history box text in sideboxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestellte Artikel');

// best_sellers box text in sideboxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Top Artikel');
define('BOX_HEADING_BESTSELLERS_IN', 'Top Artikel in<br />  ');

// notifications box text in sideboxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Benachrichtigung');
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich &uuml;ber <strong>%s</strong>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr &uuml;ber <strong>%s</strong>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Herstellerinformation');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Weitere Artikel');

// languages box text in sideboxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Sprachen');

// currencies box text in sideboxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'W&auml;hrungen');

// information box text in sideboxes/information.php
define('BOX_HEADING_INFORMATION', 'Information');
define('BOX_INFORMATION_PRIVACY', 'Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'AGB');
define('BOX_INFORMATION_SHIPPING', 'Preise und Versand');
define('BOX_INFORMATION_CONTACT', 'Impressum & Kontakt');
define('BOX_BBINDEX', 'Forum');
define('BOX_INFORMATION_UNSUBSCRIBE', 'Newsletter abbestellen');

  define('BOX_INFORMATION_SITE_MAP', 'Site Map');
// information box text in sideboxes/more_information.php - were TUTORIAL_
define('BOX_HEADING_MORE_INFORMATION', 'Weitere Informationen');
define('BOX_INFORMATION_PAGE_1', 'Seite 1');
define('BOX_INFORMATION_PAGE_2', 'Seite 2');
define('BOX_INFORMATION_PAGE_3', 'Seite 3');
define('BOX_INFORMATION_PAGE_4', 'Seite 4');

// tell a friend box text in sideboxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Weiterempfehlung');
define('BOX_TELL_A_FRIEND_TEXT', 'Empfehlen Sie unsere Artikel weiter.');

// wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Wunschzettel');
define('BOX_WISHLIST_EMPTY', 'YIhr Wunschzettel ist leer');
define('IMAGE_BUTTON_ADD_WISHLIST', 'auf meinen Wunschzettel');
define('TEXT_WISHLIST_COUNT', 'Derzeit sind %s Positionen in Ihrem Wunschzettel.');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Positionen Ihres Wunschzettels)');

// New billing address text
define('SET_AS_PRIMARY', 'Als Hauptanschrift verwenden');
define('NEW_ADDRESS_TITLE', 'Rechnungsadresse');

// javascript messages
define('JS_ERROR', 'Es sind Fehler aufgetreten.\n\n Bitte ändern Sie folgendes:\n\n');

define('JS_REVIEW_TEXT', '* Ihre Texteingabe im Bericht muss mindestens ' . REVIEW_TEXT_MIN_LENGTH . ' Zeichen haben.');
define('JS_REVIEW_RATING', '*Um einen Bericht zu schreiben, m&uuml;ssen Sie den Artikel bewerten.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte wählen Sie eine Zahlungsart aus.');

define('JS_ERROR_SUBMITTED', 'Die Seite wurde bereits übertragen. Klicken Sie auf \"OK\" und warten Sie auf das Ende des Vorgangs.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsart aus.');
define('ERROR_CONDITIONS_NOT_ACCEPTED', 'Bitte best&auml;tigen Sie unsere AGB!');
define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', 'Bitte best&auml;tigen Sie unsere AGB!');

define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_PERSONAL', 'Ihre pers&ouml;nliche Angaben');
define('CATEGORY_ADDRESS', 'Anschrift');
define('CATEGORY_CONTACT', 'Wie erreichen wir Sie');
define('CATEGORY_OPTIONS', 'Zusatz');
define('CATEGORY_PASSWORD', 'Ihr Passwort');
define('CATEGORY_LOGIN', 'Anmelden');
define('PULL_DOWN_DEFAULT', 'Bitte w&auml;hlen Sie Ihr Land');

define('ENTRY_COMPANY', 'Firma:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', 'Bitte w&auml;hlen Sie Ihren Titel.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Ihr Vorname muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Ihr Nachname muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtstag:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Ihr Geburtsdatum muss folgende Form haben: TT/MM/JJJJ (z.B. 21.02.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (z.B. 21.02.1970)');
define('ENTRY_EMAIL_ADDRESS', 'e-Mail Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Ihre e-Mail Adresse muss mindestens' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen haben.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Ihre e-Mail Adresse scheint nicht korrekt zu sein. Bitte &auml;ndern Sie diese.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Ihre e-Mail Adresse ist bereits Registriert. Bitte melden Sie sich an oder registrieren Sie sich mit einer anderen E-Mail Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_NICK', 'Forum Nickname:');
define('ENTRY_NICK_TEXT', ''); // note to display beside nickname input field
define('ENTRY_NICK_DUPLICATE_ERROR', 'Der Nickname existiert bereits.');
define('ENTRY_NICK_LENGTH_ERROR', 'Der Nickname muss aus mindestens ' . ENTRY_NICK_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS', 'Strasse:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Strasse muss aus mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Anschrift Zeile 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl muss aus mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CUSTOMERS_REFERRAL', 'Wie wurden Sie auf mich aufmerksam?:');

define('ENTRY_CITY_ERROR', 'Die Stadt muss aus mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Das Bundesland muss aus mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte w&auml;hlen Sie ein Bundesland aus dem Pulldown Men&uuml;.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte w&auml;hlen Sie ein Land aus dem Pulldown Men&uuml;.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'bestellt');
define('ENTRY_NEWSLETTER_NO', 'abbestellt');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Die Passwortbest&auml;tigung stimmt nicht mit dem eingegebenen Passwort &uuml;berein.');
define('ENTRY_PASSWORD_TEXT', '* (mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen)');
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwortbest&auml;tigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort muss aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwortbest&auml;tigung stimmt nicht mit dem neu eingegebenen Passwort &uuml;berein.');
define('PASSWORD_HIDDEN', '--GEHEIM--');

define('FORM_REQUIRED_INFORMATION', '* = Pflichtfeld');
  define('ENTRY_REQUIRED_SYMBOL', '*');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> neuen Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> &auml;hnlichen Artikel)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Artikel)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'N&auml;chste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'Letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorherige  %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'N&auml;chsten %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '<<Erste');
define('PREVNEXT_BUTTON_PREV', '[<< Vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[N&auml;chste >>]');
define('PREVNEXT_BUTTON_LAST', 'Letzte>>');

define('TEXT_BASE_PRICE', 'ab ');

define('TEXT_CLICK_TO_ENLARGE', 'gr&ouml;&szlig;eres Bild');

define('TEXT_SORT_PRODUCTS', 'Artikel sortieren ');
define('TEXT_DESCENDINGLY', 'aufsteigend');
define('TEXT_ASCENDINGLY', 'absteigend');
define('TEXT_BY', ' von ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Erstelldatum: %s');
define('TEXT_NO_REVIEWS', 'Derzeit gibt es keine Bewertungen.');

define('TEXT_NO_NEW_PRODUCTS', 'Weitere neue Artikel erscheinen in K&uuml;rze. Bitte besuchen Sie unseren Shop regelm&auml;&szlig;ig wieder.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">ben&ouml;tigt</span>');

$warn_path = (isset($_SERVER['SCRIPT_FILENAME']) ? @dirname($_SERVER['SCRIPT_FILENAME']) : '.....');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationsverzeichnis existiert noch: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/zc_install. Bitte entfernen Sie zu Ihrer Sicherheit dieses Verzeichnis.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: In die Konfigurationsdatei kann geschrieben werden: ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php. Dies stellt ein potenzielles Sicherheitsrisiko dar - bitte &auml;ndern Sie die Schreibrechte f&uuml;r diese Datei.');

unset($warn_path);
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis zum speichern der Sitzungen existiert nicht: ' . zen_session_save_path() . '. Bitte erstellen Sie dieses Verzeichnis, damit Sitzungen gespeichert werden k&ouml;nnen.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: In das Verzeichnis zum speichern von Sitzungen kann nicht geschrieben werden: ' . zen_session_save_path() . '. Bitte &auml;ndern Sie die Schreibrechte dieses Verzeichnisses.');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist aktiviert - bitte deaktivieren Sie dieses Feature in der php.ini und starten Sie Ihren Webserver neu.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r Downloadartikel existiert nicht: ' . DIR_FS_DOWNLOAD . '. Downloadartikel funktionieren nicht, solange dieses Verzeichnis nicht erstellt wurde.');
define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', 'Warnung: Das SQL-Cache Verzeichnis existiert nicht: ' . DIR_FS_SQL_CACHE . '. SQL Abfragen k&ouml;nnen nicht zwischengespeichert werden, solange dieses Verzeichnis nicht erstellt wurde.');
define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', 'Warnung: In das Verzeichnis zum zwischenspeichern von SQL Abfragen kann nicht geschrieben werden: ' . DIR_FS_SQL_CACHE . '. Bitte &auml;ndern Sie die Schreibrechte dieses Verzeichnisses, damit SQL Abfragen zwischengespeichert werden k&ouml;nnen.');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'Ihre Datenbank braucht ein Update. Siehe Admin->Tools->Server Information (Patch-Level).');


define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das Ablaufdatum der Kreditkarte, das Sie angegeben haben, ist nicht g&uuml;ltig. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben noch einmal und wiederholen Sie den Vorgang.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die Kreditkartennummer, die Sie angegeben haben, ist nicht g&uuml;ltig. Bitte &uuml;berpr&uuml;fen Sie Ihre Angaben noch einmal und wiederholen Sie den Vorgang.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffer der Kreditkartennummer, sie Sie angegeben haben, lauten: %s. Ist diese Nummer richtig, k&ouml;nnen wir diese Kreditkarte nicht akzeptieren. Bitte korrigieren Sie ggf. die eingegebene Nummer oder setzen Sie sich mit Ihren Kreditinstitut in Verbindung.');

  define('BOX_INFORMATION_DISCOUNT_COUPONS', 'Discount Coupons');
define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' FAQ');
define('VOUCHER_BALANCE', TEXT_GV_NAME . ' Konto: ');
define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . ' Konto');
define('GV_FAQ', TEXT_GV_NAME . ' FAQ');
define('ERROR_REDEEMED_AMOUNT', 'Herzlichen Gl&uuml;ckwunsch! Sie haben Ihren Gutschein erfolgreich eingel&ouml;st.');
define('ERROR_NO_REDEEM_CODE', 'Sie haben keinen ' . TEXT_GV_REDEEM . ' eingegeben.');
define('ERROR_NO_INVALID_REDEEM_GV', 'Falscher ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM);
define('TABLE_HEADING_CREDIT', 'Guthaben verf&uuml;gbar');
define('GV_HAS_VOUCHERA', 'Sie haben Guthaben auf Ihrem ' . TEXT_GV_NAME . 'konto. Wenn Sie m&ouml;chten <br />
                         k&ouml;nnen Sie dieses Guthaben per <a class="pageResults" href="');

define('GV_HAS_VOUCHERB', '"><strong>e-Mail</strong></a> an eine andere Person senden');
define('ENTRY_AMOUNT_CHECK_ERROR', 'Sie haben nicht mehr genug Guthaben auf Ihrem Gutscheinkonto');
define('BOX_SEND_TO_FRIEND', TEXT_GV_NAME . ' versenden >>');

define('VOUCHER_REDEEMED', TEXT_GV_NAME . ' einl&ouml;sen');
define('CART_COUPON', 'Gutschein:');
define('CART_COUPON_INFO', 'Gutscheininfos');
  define('TEXT_SEND_OR_SPEND','Sie haben Guthaben auf Ihrem ' . TEXT_GV_NAME . 'konto. Wenn Sie m&ouml;chten <br />
                         k&ouml;nnen Sie dieses Guthaben durch klick auf untenstehende Schaltfl&auml;che an eine andere Person senden.');
  define('TEXT_BALANCE_IS', 'Ihr Guthaben betr&auml;t: ');
  define('TEXT_AVAILABLE_BALANCE', 'Ihr ' . TEXT_GV_NAME . ' Guthaben');

// payment method is GV/Discount
define('PAYMENT_METHOD_GV', 'Gutschein Zertifikat/Kupon');
define('PAYMENT_MODULE_GV', 'GV/DC');

define('TABLE_HEADING_CREDIT_PAYMENT', 'Guthaben verf&uuml;gbar');

define('TEXT_INVALID_REDEEM_COUPON', 'Ung&uuml;ltige Gutscheinnummer');
define('TEXT_INVALID_STARTDATE_COUPON', 'Dieser Gutschein ist zur Zeit nicht erh&auml;ltlich');
define('TEXT_INVALID_FINISDATE_COUPON', 'Dieser Gutschein ist abgelaufen');
define('TEXT_INVALID_USES_COUPON', 'Dieser Gutschein kann nur');
define('TIMES', 'mal eingel&ouml;st werden');
define('TIME', 'mal eingel&ouml;st werden.');
define('TEXT_INVALID_USES_USER_COUPON', 'der Gutschein hat die maximale Einl&ouml;seanzahl pro Kunde erreicht.');
define('REDEEMED_COUPON', 'Kupon einl&ouml;sen');
define('REDEEMED_MIN_ORDER', 'bei Bestellungen &uuml;ber');
define('REDEEMED_RESTRICTIONS', '[Artikelkategorie Einschr&auml;nkung angewendet]');
define('TEXT_ERROR', 'Es ist ein Fehler aufgetreten.');
  define('TEXT_INVALID_COUPON_PRODUCT', '##TRANS##This coupon code is not valid for any product currently in your cart.');
define('TEXT_INVALID_COUPON_PRODUCT', 'Dieser Gutscheincode ist f&uuml;r keinen der im Warenkorb befindlichen Artikel g&uuml;ltig');
define('TEXT_VALID_COUPON', 'Kupon erfolgreich eingel&ouml;st');

// more info in place of buy now
define('MORE_INFO_TEXT', '... weitere Infos');

// IP Address
define('TEXT_YOUR_IP_ADDRESS', 'Aus Sicherheitsgr&uuml;nden werden bei jeder Bestellung die IP-Adressen gespeichert.<br />Ihre IP Adresse lautet:');

// Generic Address Heading
define('HEADING_ADDRESS_INFORMATION', 'Adressinformation');

// cart contents
define('PRODUCTS_ORDER_QTY_TEXT_IN_CART', 'St&uuml;ck im Warenkorb:');
define('PRODUCTS_ORDER_QTY_TEXT', 'Anzahl: ');

  define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// Shipping
  define('TEXT_SHIPPING_WEIGHT','kg');
  define('TEXT_SHIPPING_BOXES', 'Pakete');

// Discount Savings
define('PRODUCT_PRICE_DISCOUNT_PREFIX', 'Sie sparen ');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE', '% !');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT', ' weniger');
// Sale Maker Sale Price
define('PRODUCT_PRICE_SALE', 'Jetzt nur noch ');

// universal symbols
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
define('PULL_DOWN_ALL', 'Bitte ausw&auml;hlen');
define('PULL_DOWN_MANUFACTURERS', 'Alle Hersteller');

// shipping estimator
define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', 'Bitte w&auml;hlen');

// general Sort By
define('TEXT_INFO_SORT_BY', 'Sortiert nach: ');

// close window image popups
define('TEXT_CLOSE_WINDOW', ' - zum Schlie&szlig;en ins Bild klicken');
// close popups
define('TEXT_CURRENT_CLOSE_WINDOW', '[ Fenster schlie&szlig;en ]');

// iii 031104 added:  File upload error strings
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateityp nicht erlaubt.');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: keine Datei hochgeladen');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Die Datei wurde erfolgreich gespeichert.');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Datei nicht gespeichert.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Auf das Ziel konnte nicht geschrieben werden.');
define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Das Ziel existiert nicht.');
// End iii added

define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'Hinweis: Shop ist wegen Wartungsarbeiten geschlossen bis (dd/mm/yy) (hh-hh):');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'Hinweis: Shop ist wegen Wartungsarbeiten geschlossen.');

define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Kostenlos!');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'F&uuml;r Preis anfragen');
define('TEXT_CALL_FOR_PRICE', 'F&uuml;r Preis anfragen');

define('TEXT_INVALID_SELECTION_LABELED', 'Sie haben eine Ung&uuml;ltige Auswahl  getroffen:');
define('TEXT_ERROR_OPTION_FOR', 'in der Option f&uuml;r:');
define('TEXT_INVALID_USER_INPUT', 'Benutzereingabe ben&ouml;tigt');

// product_listing
define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING', 'Minimum:');
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING', 'St&uuml;ck:');
define('PRODUCTS_QUANTITY_IN_CART_LISTING', 'Im Warenkorb:');
define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING', 'weitere hinzuf&uuml;gen:');

define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', 'Maximal:');

define('TEXT_PRODUCTS_MIX_OFF', '*gemischt: AUS');
define('TEXT_PRODUCTS_MIX_ON', '*gemischt: EIN');

define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART', '*gemischte Attributmerkmale: AUS');
define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART', '*gemischte Attributmerkmale: EIN');

define('ERROR_MAXIMUM_QTY', 'St&uuml;ckzahl angepasst - maximale St&uuml;ckzahl wurde in den Warenkorb gelegt ');
define('ERROR_CORRECTIONS_HEADING', 'Bitte korrigieren Sie folgendes: <br />');

// Downloads Controller
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG', 'Bemerkung: Downloads werden erst nach Best&auml;tigung des Zahlungseingangs freigeschalten.');
define('TEXT_FILESIZE_BYTES', ' Bytes');
define('TEXT_FILESIZE_MEGS', ' MB');

// shopping cart errors
define('ERROR_PRODUCT', 'Artikel:');
define('ERROR_PRODUCT_QUANTITY_MIN', '...minimale St&uuml;ckzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS', '...ung&uuml;ltige St&uuml;ckzahl -');
define('ERROR_PRODUCT_OPTION_SELECTION', '...ung&uuml;ltige Attributmerkmale gew&auml;hlt -');
define('ERROR_PRODUCT_QUANTITY_ORDERED', 'Die Summe Ihrer Bestellung:');
define('ERROR_PRODUCT_QUANTITY_MAX', '...maximale St&uuml;ckzahl &uuml;berschritten -');
define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART', '...minimale St&uuml;ckzahl unterschritten -');
define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART', '...ung&uuml;ltige St&uuml;ckzahl -');
define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART', '...maximale St&uuml;ckzahl &uuml;berschritten -');
  define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... Maximum Quantity errors - ');

define('TABLE_HEADING_FEATURED_PRODUCTS', 'Ähnliche Artikel');

define('TABLE_HEADING_NEW_PRODUCTS', 'Neue Artikel f&uuml;r %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Kommende Artikel');
define('TABLE_HEADING_DATE_EXPECTED', 'Eingangsdatum');
define('TABLE_HEADING_SPECIALS_INDEX', 'Monatliche Sonderangebote f&uuml;r %s');

// meta tags special defines
define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT', 'KOSTENLOS!');

// customer login
define('TEXT_SHOWCASE_ONLY', 'Kontakt');
// set for login for prices
define('TEXT_LOGIN_FOR_PRICE_PRICE', 'Preis nicht erh&auml;ltlich');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE', 'F&uuml;r Preis bitte anmelden');
// set for show room only
define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', ''); // blank for prices or enter your own text
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM', 'Nur Schauraum');

// authorization pending
define('TEXT_AUTHORIZATION_PENDING_PRICE', 'Preis nicht erh&auml;ltlich');
define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', 'ÜBERPRÜFUNG LÄUFT');
  define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Login to Shop');

// text pricing
define('TEXT_CHARGES_WORD', 'Kalkulierte Geb&uuml;hr:');
define('TEXT_PER_WORD', '<br />Preis pro Wort: ');
define('TEXT_WORDS_FREE', ' Wort(e) frei ');
define('TEXT_CHARGES_LETTERS', 'Kalkulierte Geb&uuml;hr:');
define('TEXT_PER_LETTER', '<br />Preis pro Buchstabe: ');
define('TEXT_LETTERS_FREE', ' Buchstabe(n) frei ');
define('TEXT_ONETIME_CHARGES', '*einmalige Geb&uuml;hr = ');
define('TEXT_ONETIME_CHARGES_EMAIL', "\t" . '*einmalige Geb&uuml;hr = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', 'Option f&uuml;r Mengenrabatte');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY', 'STK');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE', 'PREIS');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', 'Option f&uuml;r einmalige Geb&uuml;hren f&uuml;r Mengenrabatte');

// textarea attribute input fields
  define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' maximum characters allowed');
  define('TEXT_REMAINING','remaining');

// Shipping Estimator
define('CART_SHIPPING_OPTIONS', 'Voraussichtlicher Versand:');
define('CART_SHIPPING_OPTIONS_LOGIN', 'Hier <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Log In</u></a>, um Ihre pers&ouml;nlichen Versandkosten anzuzeigen.');
define('CART_SHIPPING_METHOD_TEXT', 'Versandarten:');
define('CART_SHIPPING_METHOD_RATES', 'S&auml;tze:');
define('CART_SHIPPING_METHOD_TO', 'Versand an: ');
define('CART_SHIPPING_METHOD_TO_NOLOGIN', 'Versand an: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>anmelden</u></a>');
define('CART_SHIPPING_METHOD_FREE_TEXT', 'kostenloser Versand');
define('CART_SHIPPING_METHOD_ALL_DOWNLOADS', '- Downloads');
define('CART_SHIPPING_METHOD_RECALCULATE', 'neu berechnen');
define('CART_SHIPPING_METHOD_ZIP_REQUIRED', 'true');
define('CART_SHIPPING_METHOD_ADDRESS', 'Adresse:');
define('CART_OT', 'Voraussichtliche Versandkosten:');
define('CART_OT_SHOW', 'true'); // set to false if you don't want order totals
define('CART_ITEMS', 'im Warenkorb: ');
define('CART_SELECT', 'w&auml;hlen Sie');
define('ERROR_CART_UPDATE', 'Bitte aktualisieren Sie Ihre Bestellung ...<br />');
define('IMAGE_BUTTON_UPDATE_CART', 'aktualisieren');

// multiple product add to cart
define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 'Add: ');
define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 'Add: ');
define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 'Add: ');
define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 'Add: ');
  //moved SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART to button_names.php as BUTTON_ADD_PRODUCTS_TO_CART_ALT

// discount qty table
define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', 'Abzug f&uuml;r Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', 'Preis abz&uuml;glich Mengenrabatt');
define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', 'Abzug f&uuml;r Mengenrabatt');
define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* Rabatte k&ouml;nnen abh&auml;ngig von den unteren Optionen variieren');
  define('TEXT_HEADER_DISCOUNTS_OFF', 'Qty Discounts Unavailable ...');

// sort order titles for dropdowns
define('PULL_DOWN_ALL_RESET', '- RESET - ');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', 'Artikelname');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', 'Artikelname - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', 'Preis - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', 'Preis - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'Artikelnummer');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', 'Erstelldatum - aufsteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', 'Erstelldatum - absteigend');
define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', 'Standardansicht');

// downloads module defines
  define('TABLE_HEADING_DOWNLOAD_DATE', 'g&uuml;ltig bis');
  define('TABLE_HEADING_DOWNLOAD_COUNT', 'verbleibend');
  define('HEADING_DOWNLOAD', 'Dateien zum Herunterladen');
  define('TABLE_HEADING_DOWNLOAD_FILENAME','Dateiname');
  define('TABLE_HEADING_PRODUCT_NAME','Artikel');
  define('TABLE_HEADING_BYTE_SIZE','Dateigr&ouml;&szlig;e');
  define('TEXT_DOWNLOADS_UNLIMITED', 'kein Limit');
  define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc
  define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
  define('TABLE_HEADING_QUANTITY', 'Stk.');
  define('TABLE_HEADING_PRODUCTS', 'Artikelname');
  define('TABLE_HEADING_TOTAL', 'Summe');

// create account - login shared
  define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacy Statement');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'I have read and agreed to your privacy statement.');
  define('TABLE_HEADING_ADDRESS_DETAILS', 'Kundendaten');
  define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Wie erreichen wir Sie?');
  define('TABLE_HEADING_DATE_OF_BIRTH', 'Verify Your Age');
  define('TABLE_HEADING_LOGIN_DETAILS', 'Benutzerdaten');
  define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');

  define('ENTRY_EMAIL_PREFERENCE','Newsletter und Email');
  define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
  define('ENTRY_EMAIL_TEXT_DISPLAY','nur TEXT');
  define('EMAIL_SEND_FAILED','Fehler: E-mail wurde nicht an: "%s" <%s> versendet. Betreff: "%s"');

  define('DB_ERROR_NOT_CONNECTED', 'Error - Could not connect to Database');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', 'WARNING: EZ-PAGES HEADER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', 'WARNING: EZ-PAGES FOOTER - On for Admin IP Only');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', 'WARNING: EZ-PAGES SIDEBOX - On for Admin IP Only');


// /////////////////////////////////////////////////////////
// include email extras
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_EMAIL_EXTRAS)){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_EMAIL_EXTRAS);

// include template specific header defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_HEADER)){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_HEADER);

// include template specific button name defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_BUTTON_NAMES)){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_BUTTON_NAMES);

// include template specific icon name defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_ICON_NAMES)){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_ICON_NAMES);

// include template specific other image name defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_OTHER_IMAGES_NAMES)){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_OTHER_IMAGES_NAMES);

// credit cards
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_CREDIT_CARDS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select. FILENAME_CREDIT_CARDS);

// include template specific whos_online sidebox defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_WHOS_ONLINE . '.php')){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_WHOS_ONLINE . '.php');

// include template specific meta tags defines
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')){
     $template_dir_select = $template_dir . '/';
     }else{
     $template_dir_select = '';
     }
 require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// END OF EXTERNAL LANGUAGE LINKS
?>
