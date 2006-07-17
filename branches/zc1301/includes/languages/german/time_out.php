<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2006 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* translatet from: cyaneo/hugo13 / www.zen-cart.at / 31.03.06 
* @version $Id: time_out.php 2 2006-03-31 09:55:33Z rainer $
*/

define('NAVBAR_TITLE','Anmeldezeit &uuml;berschritten');
define('HEADING_TITLE','Anmeldezeit &uuml;berschritten');
define('HEADING_TITLE_LOGGED_IN', 'Tut uns leid!, aber Sie dürfen diese Tätigkeit nicht ausführen. '); // new 1.3.0  
define('TEXT_INFORMATION','Es tut uns leid, aber aus Sicherheitsgr&uuml;nden mussten wir Ihre Verbindung unterbrechen,
um Unbefugten nicht die M&ouml;glichkeit zu bieten, an Ihre Zugangsdaten zu gelangen.
  <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">Anmeldung</a>
  Ihr Warenkorb wird wiederhergestellt'.
  (DOWNLOAD_ENABLED == 'true' ? ', Sie hatten Download-Artikel und m&ouml;chte diese(n) erhalten' : '') . ',
  Gehen Sie bitte zu <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mein Konto</a> um Ihre Bestellung anzusehen.');
define('TEXT_INFORMATION_LOGGED_IN', 'Sie sind bei Ihrem Konto angemeldet und können nun weiter einkaufen. Wählen Sie einen Menüpunk aus.'); // new 1.3.0  

define('HEADING_RETURNING_CUSTOMER', 'Anmelden'); // new 1.3.0  
define('TEXT_PASSWORD_FORGOTTEN', 'Forgot Your Password?')
?>