<?php
/**
 * Zen Cart German Specific (158 code in 157 /zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: checkout_confirmation.php 2023-10-29 15:02:16Z webchills $
 */

define('NAVBAR_TITLE_1','Bestellung');
define('NAVBAR_TITLE_2','Bestellung bestätigen');

define('HEADING_TITLE','Schritt 3 von 3: Zahlungspflichtig bestellen');
define('TEXT_ZUSATZ_SCHRITT3','Überprüfen Sie Ihre Bestellung und drücken dann den Button "KAUFEN" unten auf dieser Seite.');
define('BRAINTREE_MESSAGE_PLEASE_CONFIRM_ORDER', '<b>Ihre Kreditkarte wurde erfolgreich verifiziert, es hat aber noch keine Zahlung stattgefunden. Bitte bestätigen Sie nun Ihre Bestellung mit dem Button unten. Erst dann werden Zahlung und Bestellung durchgeführt.</b>');
define('HEADING_PRODUCTS','Warenkorbinhalt');


define('NO_COMMENTS_TEXT','Keine');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Letzter Schritt');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- weiter um Ihre Bestellung zu bestätigen.');

// buttonloesung
define('TABLE_HEADING_SINGLEPRICE','Einzelpreis');
define('TABLE_HEADING_PRODUCTIMAGE','Artikelbild');
define('TEXT_CONDITIONS_ACCEPTED_IN_LAST_STEP','Ich habe <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '" target="_blank"><u>AGB</u></a> und <a href="' . zen_href_link(FILENAME_WIDERRUFSRECHT, '', 'SSL') . '"><u>Widerrufsrecht</u></a> gelesen und akzeptiert.');
define('TEXT_NON_EU_COUNTRIES','Hinweis:<br>Ihre Bestellung wird in ein Nicht-EU-Land geliefert. Zusätzlich können im Rahmen Ihrer Bestellung noch weitere Zölle, Steuern oder Kosten anfallen, die nicht über uns abgeführt bzw. von uns in Rechnung gestellt werden.');
