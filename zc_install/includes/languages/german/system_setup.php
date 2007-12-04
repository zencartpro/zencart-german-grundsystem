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
define('TEXT_MAIN', "Hier werden die Einstellungen Ihrer Zen Cart Systemumgebung ermittelt. Bitte kontrollieren Sie gewissenhaft alle Einstellungen. Klicken Sie bitte zum Fortfahren auf <em>".SAVE_SYSTEM_SETTINGS.'</em>.');
define('TEXT_PAGE_HEADING', 'Zen Cart Installation - Systemumgebung');
define('SERVER_SETTINGS', 'Servereinstellungen');
define('PHYSICAL_PATH', 'Physikalischer Pfad');
define('PHYSICAL_PATH_INSTRUCTION', 'Der physikalische Pfad zu Ihrem<br />Zen Cart Verzeichnis.<br />Bitte OHNE abschlie&szlig;enden "Slash".');
define('VIRTUAL_HTTP_PATH', 'Virtueller HTTP Pfad');
define('VIRTUAL_HTTP_PATH_INSTRUCTION', 'Virtueller Pfad zu Ihrem<br />Zen Cart Verzeichnis.<br />Bitte OHNE abschlie&szlig;enden "Slash".');
define('VIRTUAL_HTTPS_PATH', 'Virtueller HTTPS Pfad');
define('VIRTUAL_HTTPS_PATH_INSTRUCTION', 'Virtueller Pfad zu Ihrem<br />sicheren Zen Cart Verzeichnis.<br />Bitte OHNE abschlie&szlig;enden "Slash".');
define('VIRTUAL_HTTPS_SERVER', 'Virtueller HTTPS Server');
define('VIRTUAL_HTTPS_SERVER_INSTRUCTION', 'Virtueller Server f&uuml;r Ihr<br />sicheres Zen Cart Verzeichnis.<br />Bitte OHNE abschlie&szlig;enden "Slash".');
define('TEXT_SSL_INTRO', '<strong>Do you already have an SSL Certificate? If so, enter the details below.</strong> If this is your first install, the supplied values are *only best-guesses*. Please verify the information with your hosting company if you are unsure of the correct details.' . ' !!!TRANSLATE!!! file: zc_install/includes/languages/LANGUAGE/system_setup.php at line 357');
define('TEXT_SSL_WARNING', 'If your SSL certificate is already working, choose your SSL settings below. <br /><strong>DO NOT enable SSL here if you do not already have SSL enabled on your hosting account.</strong> If you enable SSL but the SSL address you provide does not work, you will not be able to access your admin site nor log in to your store. You can activate SSL later by editing settings in your configure.php file.' . ' !!!TRANSLATE!!! file: zc_install/includes/languages/LANGUAGE/system_setup.php at line 357');
define('SSL_OPTIONS', 'SSL Details' . ' !!!TRANSLATE!!! file: zc_install/includes/languages/LANGUAGE/system_setup.php at line 357');
define('ENABLE_SSL', 'SSL im Shop aktivieren');
define('ENABLE_SSL_INSTRUCTION', 'Wollen Sie SSL (Secure Sockets Layer) im Shop aktivieren?');
define('ENABLE_SSL_ADMIN', 'SSL f&uuml;r Admin Bereich aktivieren');
define('ENABLE_SSL_ADMIN_INSTRUCTION', 'Wollen Sie SSL (Secure Sockets Layer) f&uuml;r den Admin Bereich aktivieren?');
define('REDISCOVER', 'Die Standardwerte f&uuml;r diesen Host neu ermitteln');




?>