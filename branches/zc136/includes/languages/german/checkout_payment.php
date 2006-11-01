<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: checkout_payment.php 2 2006-03-31 09:55:33Z rainer $
*/

define('NAVBAR_TITLE_1', 'Zahlungsart');
define('NAVBAR_TITLE_2', 'Zahlungsart');

define('HEADING_TITLE', 'Schritt 2 von 3 , Zahlungsart');

define('TABLE_HEADING_BILLING_ADDRESS', 'Rechnungsanschrift');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Ihre Rechnungsanschrift steht links. Sie k&ouml;nnen Ihre Rechnungsanschrift &auml;ndern indem Sie auf <em>Anschrift &auml;ndern</em> klicken.');
define('TITLE_BILLING_ADDRESS', 'Rechnungsanschrift:');

define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart');
define('TEXT_SELECT_PAYMENT_METHOD', 'Bitte w&auml;hlen Sie eine Zahlungsart f&uuml;r diese Bestellung.');
define('TITLE_PLEASE_SELECT', 'Bitte w&auml;hlen Sie');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Dies ist zur Zeit die einzig m&ouml;gliche Zahlungsart.');
define('TABLE_HEADING_COMMENTS', 'Anmerkungen oder Hinweise');

define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', 'Zur Zeit nicht verf&uuml;gbar');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE','<span class="alert">Entschuldigung, aber wir k&ouml;nnen Zahlungen aus Ihrer Region nicht annehmen .</span><br />Bitte setzen Sie sich mit uns in Verbindung, um Alternativen zu suchen. ');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Weiter zu Schritt 3</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- um Ihre Bestellung fortzuf&uuml;hren ...');

define('TABLE_HEADING_CONDITIONS', 'Allgemeine Gesch&auml;ftsbedingungen');
define('TEXT_CONDITIONS_DESCRIPTION', 'Mit Fortfahren der Bestellung best&auml;tigen Sie unsere <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><u>AGB</u></a>.');
define('TEXT_CONDITIONS_CONFIRM', 'Ich habe die AGB gelesen und akzeptiert.');
define('TEXT_CHECKOUT_AMOUNT_DUE', 'Gesamtmenge passend');
define('TEXT_YOUR_TOTAL', 'Ihre Gesamtmenge');    // new 1.3.0  
?>