<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_shipping.php for COWOA 2.0 ZC139 2010-08-23 10:10:40Z webchills $
 */

define('NAVBAR_TITLE_1','Kasse');
define('NAVBAR_TITLE_2','Versandart');

if($_SESSION['COWOA']) $COWOA=TRUE;

if($COWOA)
define('HEADING_TITLE', 'Schritt 2 von 4 , Lieferinformationen');
else
define('HEADING_TITLE', 'Schritt 1 von 3 , Lieferinformationen');


define('TABLE_HEADING_SHIPPING_ADDRESS','Lieferanschrift');
define('TEXT_CHOOSE_SHIPPING_DESTINATION','Ihre Bestellung wird an die links angezeigte Anschrift geliefert. Sie können die Lieferanschrift ändern, wenn Sie auf den Button <em>Adresse ändern</em> klicken.');
define('TITLE_SHIPPING_ADDRESS','Lieferanschrift:');

define('TABLE_HEADING_SHIPPING_METHOD','Versandart');
define('TEXT_CHOOSE_SHIPPING_METHOD','Bitte wählen Sie die Versandart für Ihre Bestellung.');
define('TITLE_PLEASE_SELECT','Bitte wählen Sie');
define('TEXT_ENTER_SHIPPING_INFORMATION','Dies ist zur Zeit die einzige Versandart.');
define('TITLE_NO_SHIPPING_AVAILABLE', 'Zur Zeit nicht verfügbar');
define('TEXT_NO_SHIPPING_AVAILABLE','<span class="alert">Entschuldigung, aber wir können nicht in Ihre Region versenden .</span><br />Bitte setzen Sie sich mit uns in Verbindung, um Alternativen zu suchen.');

define('TABLE_HEADING_COMMENTS','Anmerkungen oder Hinweise');

if($COWOA)
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Weiter zu Schritt 3');
else
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Weiter zu Schritt 2');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE','- wählen Sie Ihre Zahlungsart ...');

// when free shipping for orders over $XX.00 is active
define('FREE_SHIPPING_TITLE', 'Versandkostenfreie Lieferung');
define('FREE_SHIPPING_DESCRIPTION', 'Versandkostenfreie Lieferung für Bestellungen ab %s');
