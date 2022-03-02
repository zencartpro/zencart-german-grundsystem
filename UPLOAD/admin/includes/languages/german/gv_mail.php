<?php
/** 
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: gv_mail.php 2022-03-02 19:44:16Z webchills $
 */

require DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'gv_name.php';
define('HEADING_TITLE', 'Sende ' . TEXT_GV_NAME . ' an Kunden');

define('TEXT_FROM', 'Von:');
define('TEXT_TO', 'Email an:');
define('TEXT_TO_CUSTOMERS', 'An Kundenliste:');
define('TEXT_TO_EMAIL', 'oder an einzelne Email Adresse:');
define('TEXT_TO_EMAIL_NAME', 'Name (optional):');
define('TEXT_TO_EMAIL_INFO', 'Wählen Sie eine Liste aus der obigen Dropdown-Liste oder verwenden Sie die folgenden Felder, um eine einzelne E-Mail zu versenden.');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_AMOUNT', ' Wert:');
define('ERROR_GV_AMOUNT', 'Ohne Währungssymbole eingeben und als Trennzeichen einen Punkt verwenden! z.B.: 25.50.');
define('TEXT_AMOUNT_INFO', 'Ohne Währungssymbole eingeben und als Trennzeichen einen Punkt verwenden! z.B.: 25.50.');
define('TEXT_HTML_MESSAGE', 'HTML Nachricht:');
define('TEXT_MESSAGE', 'Text-Only Nachricht:');
define('TEXT_MESSAGE_INFO', '<p>Optional können Sie eine spezielle Nachricht einfügen, die vor dem Standard ' . TEXT_GV_NAME . ' Email Text erscheinen soll.</p>');

define('NOTICE_EMAIL_SENT_TO', 'HINWEIS: %1s E-Mail(s) wurde(n) versendet an: %2s');
define('ERROR_NO_CUSTOMER_SELECTED', 'FEHLER: Es wurde kein Kunde ausgewählt.');
define('ERROR_NO_AMOUNT_ENTERED', 'FEHLER: Gutscheinbetrag ungültig.');
define('ERROR_NO_SUBJECT', 'FEHLER: Es wurde kein Betreff angegeben.');


define('TEXT_GV_ANNOUNCE', 'Wir freuen uns, Ihnen einen ' . TEXT_GV_NAME . ' schenken zu können im Wert von %s.');
define('TEXT_GV_TO_REDEEM_TEXT', 'Verwenden Sie den folgenden Link zum Einlösen des ' . TEXT_GV_NAME . "\n\n ". '%1$s%2$s' . "\n\n" . 'oder besuchen Sie ' . STORE_NAME . " auf " . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . "\n" . 'und geben Sie den Code %2$s während des Bestellvorgangs ein.');
define('TEXT_GV_TO_REDEEM_HTML', '<br><a href="%1$s%2$s">Klicken Sie hier zum Einlösen</a> oder besuchen Sie unseren Shop auf <a href="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . '">' . STORE_NAME . '</a> und geben Sie den Code <strong>%2$s</strong> während des Bestellvorgangs ein.');
