<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id$
 */

define('NAVBAR_TITLE','Anmeldezeit &uuml;berschritten');
define('HEADING_TITLE','Anmeldezeit &uuml;berschritten');
define('HEADING_TITLE_LOGGED_IN', 'Entschuldigen Sie bitte, aber Sie d&uuml;rfen diese T&auml;tigkeit nicht ausf&uuml;hren. ');
define('TEXT_INFORMATION','Es tut uns leid, aber aus Sicherheitsgr&uuml;nden mussten wir Ihre Verbindung unterbrechen,
um Unbefugten nicht die M&ouml;glichkeit zu bieten, an Ihre Zugangsdaten zu gelangen.
  <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">Anmeldung</a>
  Ihr Warenkorb wird wiederhergestellt'.
  (DOWNLOAD_ENABLED == 'true' ? ', Sie hatten Download-Artikel und m&ouml;chte diese(n) erhalten' : '') . ',
  Gehen Sie bitte zu <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">Mein Konto</a> um Ihre Bestellung anzusehen.');
define('TEXT_INFORMATION_LOGGED_IN', 'Sie sind bei Ihrem Konto angemeldet und k&ouml;nnen nun weiter einkaufen. W&auml;hlen Sie einen Men&uuml;punkt aus.');
define('HEADING_RETURNING_CUSTOMER', 'Anmelden');
define('TEXT_PASSWORD_FORGOTTEN', 'Password vergessen?');


?>
