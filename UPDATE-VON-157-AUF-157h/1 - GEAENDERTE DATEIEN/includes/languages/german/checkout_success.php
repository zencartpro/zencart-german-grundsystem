<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: checkout_success.php 2023-10-29 16:49:16Z webchills $
 */

define('NAVBAR_TITLE_1','Kasse');
define('NAVBAR_TITLE_2','Erfolgreich - Vielen Dank!');

define('HEADING_TITLE','Vielen Dank! Wir haben Ihre Bestellung erhalten.');

define('TEXT_SUCCESS','');
define('TEXT_NOTIFY_PRODUCTS','Bitte informieren Sie mich über Updates zu diesem Artikel:');

define('TEXT_SEE_ORDERS','Sie können Ihre Bestellhistorie unter <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mein Konto\'</a> ansehen.');
define('TEXT_CONTACT_STORE_OWNER','Sollten Sie Fragen haben, wenden Sie sich bitte an unseren  <a href="' . zen_href_link(FILENAME_CONTACT_US) . '"> Kunden Service</a>.');
define('TEXT_THANKS_FOR_SHOPPING','<strong>Vielen Dank für Ihre Onlinebestellung!</strong>');



define('FOOTER_DOWNLOAD','Sie können Ihre Artikel auch zu einem späteren Zeitpunkt unter \'%s\' downloaden.');

define('TEXT_YOUR_ORDER_NUMBER', '<strong>Ihre Bestellnummer lautet:</strong> ');

define('TEXT_CHECKOUT_LOGOFF_GUEST', '<p><strong>ANMERKUNG:</strong> Um Ihren Auftrag durchzuführen, wurde ein temporäres Konto erstellt. Sie können dieses Konto schließen, indem Sie auf Abmelden klicken. Das Abmelden stellt auch sicher, daß die Informationen über Ihren Aufenhalt in unserem Shop nicht der nächsten Person sichtbar sind, die diesen Computer verwendet. Wenn Sie mit Ihrem Einkauf fortfahren möchten, denken Sie bitte daran, vor dem Verlassen unseres Shops auf Abmelden zu klicken.</p>');
define('TEXT_CHECKOUT_LOGOFF_CUSTOMER', 'Vielen Dank für Ihren Einkauf! Bitte melden Sie sich vor Verlassen des Shops ab, um sicherzugehen das Informationen über Ihren Aufenthalt in unserem Shop nicht für die nächste Person sichtbar sind, die diesen Computer verwendet.');
