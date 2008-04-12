<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2007-01-03
 * @version $Id: system_setup.php 4707 2006-10-08 08:52:12Z drbyte $
 */
/**
 * defining language components for the page
 */
define('SAVE_SYSTEM_SETTINGS', 'Speichern & fortfahren');
//this comes before TEXT_MAIN
define('TEXT_MAIN', 'Hier werden die Einstellungen Ihrer Zen Cart Systemumgebung ermittelt. Bitte kontrollieren Sie gewissenhaft alle Einstellungen. Klicken Sie bitte zum Fortfahren auf <em>'.SAVE_SYSTEM_SETTINGS.'</em>.');
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Systemumgebung');
define('SERVER_SETTINGS', 'Servereinstellungen');
define('PHYSICAL_PATH', 'Physikalischer Pfad');
define('PHYSICAL_PATH_INSTRUCTION', 'Der physikalische Pfad zu Ihrem<br />Zen Cart Verzeichnis.<br />Bitte OHNE abschließenden "Slash".');
define('VIRTUAL_HTTP_PATH', 'Virtueller HTTP Pfad');
define('VIRTUAL_HTTP_PATH_INSTRUCTION', 'Virtueller Pfad zu Ihrem<br />Zen Cart Verzeichnis.<br />Bitte OHNE abschließenden "Slash".');
define('VIRTUAL_HTTPS_PATH', 'Virtueller HTTPS Pfad');
define('VIRTUAL_HTTPS_PATH_INSTRUCTION', 'Virtueller Pfad zu Ihrem<br />sicheren Zen Cart Verzeichnis.<br />Bitte OHNE abschließenden "Slash".');
define('VIRTUAL_HTTPS_SERVER', 'Virtueller HTTPS Server');
define('VIRTUAL_HTTPS_SERVER_INSTRUCTION', 'Virtueller Server zu Ihrem<br />sicheren Zen Cart Verzeichnis.<br />Bitte OHNE abschließenden "Slash".');
define('TEXT_SSL_INTRO', '<strong>Ist SSL für Ihren Webspace bereits installiert? Wenn ja, dann tragen Sie bitte unten die benötigten Informationen ein.</strong> Wenn dieses Ihre erste Installation auf diesem Webspace ist, dann sind die vorgegeben Daten lediglich "gut geraten". Bitte überprüfen Sie die Angaben und setzen sich gegebenfalls mit Ihrem Webhoster in Verbindung.');
define('TEXT_SSL_WARNING', 'Wenn Ihr SSL Zertifikat bereits funktioniert, dann wählen Sie unten ihre SSL Einstellungen. <br /><strong>Aktivieren Sie SSL NICHT, wenn SSL nicht bereits auf ihrem Webspace Account aktiviert wurde.</strong> Falls Sie es doch tun, haben Sie keinen Zugriff auf den Adminbereich oder den Shop. Sie können SSL nachträglich aktivieren, in dem sie die entsprechenden Einstellungen in Ihren configure.php file verändern.');
define('SSL_OPTIONS', 'SSL Details');
define('ENABLE_SSL', 'SSL im Shop aktivieren');
define('ENABLE_SSL_INSTRUCTION', 'Wollen Sie SSL (Secure Sockets Layer) im Shop aktivieren?');
define('ENABLE_SSL_ADMIN', 'SSL für Adminbereich aktivieren');
define('ENABLE_SSL_ADMIN_INSTRUCTION', 'Wollen Sie SSL (Secure Sockets Layer) für den Adminbereich aktivieren?');
define('REDISCOVER', 'Die Standardwerte für diesen Host neu ermitteln');
