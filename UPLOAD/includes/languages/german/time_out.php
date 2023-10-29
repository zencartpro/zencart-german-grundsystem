<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: time_out.php 2023-10-29 07:49:16Z webchills $
 */

define('NAVBAR_TITLE','Anmeldezeit überschritten');
define('HEADING_TITLE','Ups! Ihre Session ist abgelaufen.');
define('HEADING_TITLE_LOGGED_IN', 'Entschuldigen Sie bitte, aber Sie dürfen diese Tätigkeit nicht ausführen. ');
define('TEXT_INFORMATION','Es tut uns leid, aber aus Sicherheitsgründen mussten wir Ihre Verbindung unterbrechen,
um Unbefugten nicht die Möglichkeit zu bieten, an Ihre Zugangsdaten zu gelangen.
  <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">Anmeldung</a>
  Ihr Warenkorb wird wiederhergestellt'.
  (DOWNLOAD_ENABLED == 'true' ? ', Sie hatten Download-Artikel und möchte diese(n) erhalten' : '') . ',
  Gehen Sie bitte zu <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mein Konto</a> um Ihre Bestellung anzusehen.');
define('TEXT_INFORMATION_LOGGED_IN', 'Sie sind bei Ihrem Konto angemeldet und können nun weiter einkaufen. Wählen Sie einen Menüpunkt aus.');
define('HEADING_RETURNING_CUSTOMER', 'Anmelden');
