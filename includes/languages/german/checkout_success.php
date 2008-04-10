<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr/maleborg	http://www.zen-cart.at	2007-01-03
 * @version $Id$
 */

define('NAVBAR_TITLE_1','Bestellbestätigung');
define('NAVBAR_TITLE_2','Erfolgreich - Vielen Dank!');

define('HEADING_TITLE','Vielen Dank! Wir haben Ihre Bestellung erhalten.');

define('TEXT_SUCCESS','Ihre Bestellung wird sofort nach Zahlungseingang versendet, sofern Sie nicht per Nachnahme bestellt haben. Bei Nachnahmebestellungen verlässt die Sendung in der Regel nach 2-3 Werktagen unser Haus.');
define('TEXT_NOTIFY_PRODUCTS','Bitte informieren Sie mich über Änderungen zu diesem Artikel:');
define('TEXT_SEE_ORDERS','Sie können Ihre Bestellhistorie unter <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mein Konto\'</a> ansehen.');
define('TEXT_CONTACT_STORE_OWNER','Sollten Sie Fragen haben, wenden Sie sich bitte an unseren  <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">Service</a>.');
define('TEXT_THANKS_FOR_SHOPPING','<strong>Vielen Dank für Ihre Onlinebestellung!</strong>');

define('TABLE_HEADING_COMMENTS', '');

define('FOOTER_DOWNLOAD','Sie können Ihre Artikel auch zu einem späteren Zeitpunkt unter \'%s\' downloaden.');

define('TEXT_YOUR_ORDER_NUMBER', '<strong>Ihre Bestellnummer lautet:</strong> ');

define('TEXT_CHECKOUT_LOGOFF_GUEST', '<p><strong>ANMERKUNG:</strong> Um Ihren Auftrag durchzuführen, wurde ein temporäres Konto erstellt. Sie können dieses Konto schließen, indem Sie auf Abmelden klicken. Das Abmelden stellt auch sicher, daß die Informationen über Ihren Aufenhalt in unserem Shop nicht der nächsten Person sichtbar sind, die diesen Computer verwendet. Wenn Sie mit Ihrem Einkauf fortfahren möchten, denken Sie bitte daran, vor dem Verlassen unseres Shops auf Abmelden zu klicken.</p>');
define('TEXT_CHECKOUT_LOGOFF_CUSTOMER', 'Vielen Dank für Ihren Einkauf! Bitte melden Sie sich vor Verlassen des Shops ab, um sicherzugehen das Informationen über Ihren Aufenthalt in unserem Shop nicht für die nächste Person sichtbar sind, die diesen Computer verwendet.');
?>
