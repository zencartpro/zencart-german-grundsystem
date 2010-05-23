<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id: checkout_payment.php for COWOA 2009-01-12 18:10:40Z webchills $
 */

define('NAVBAR_TITLE_1', 'Kasse - Schritt 1');
define('NAVBAR_TITLE_2', 'Zahlungsart - Schritt 2');

if($_SESSION['COWOA']) $COWOA=TRUE;

if($COWOA)
define('HEADING_TITLE', 'Schritt 3 von 4 , Zahlungsinformationen');
else
define('HEADING_TITLE', 'Schritt 2 von 3 , Zahlungsinformationen');

define('TABLE_HEADING_BILLING_ADDRESS', 'Rechnungsanschrift');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Ihre Rechnungsanschrift steht links. Sie können Ihre Rechnungsanschrift ändern indem Sie auf <em>Adresse ändern</em> klicken.');
define('TITLE_BILLING_ADDRESS', 'Rechnungsanschrift:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart');
define('TEXT_SELECT_PAYMENT_METHOD', 'Bitte wählen Sie eine Zahlungsart für diese Bestellung.');
define('TITLE_PLEASE_SELECT', 'Bitte wählen Sie');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Dies ist zur Zeit die einzig mögliche Zahlungsart.');
define('TABLE_HEADING_COMMENTS', 'Anmerkungen oder Hinweise');

define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', 'Zur Zeit nicht verfügbar');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE','<span class="alert">Entschuldigung, aber wir können Zahlungen aus Ihrer Region nicht annehmen .</span><br />Bitte setzen Sie sich mit uns in Verbindung, um Alternativen zu suchen. ');

if($COWOA)
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Weiter zu Schritt 4</strong>');
else
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Weiter zu Schritt 3</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- um Ihre Bestellung fortzuführen ...');

define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">Allgemeine Geschäftsbedingungen</span>');
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">Bitte bestätigen Sie unsere Allgemeinen Geschäftsbedingungen durch Anklicken der Checkbox. Unsere AGB können Sie <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><span class="pseudolink">hier</span></a> nachlesen.');
define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">Ich habe die AGB gelesen und akzeptiert.</span>');

define('TEXT_CHECKOUT_AMOUNT_DUE', 'Gesamtmenge passend');
define('TEXT_YOUR_TOTAL', 'Rechnungsbetrag');
