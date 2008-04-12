<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: config_checkup.php 185 2007-12-03 08:47:08Z hugo13 $
 */
/**
 * defining language components for the page
*/
  define('TEXT_MAIN', '<h2>Bitte reparieren Sie ihre Konfigurationsdateien</h2><p>Die zwei configure.php konnten nicht überprüft werden. Dies bedeutet, dass diese Dateien wahrscheinlich keine gültigen Informationen enthalten.</p>');
  define('TEXT_EXPLANATION2', '<p>Nachdem Sie alle benötigten Installationsangaben gemacht haben, hat Zen-Cart versucht diese Angaben in die configure.php Dateien auf Ihrem Webspace zu schreiben. Dieses war nicht erfolgreich, weshalb Sie gerade diesen Text lesen. Sie müssen daher die configure.php Dateien manuell konfigurieren.</p>');
  define('TEXT_PAGE_HEADING', 'Zen Cart&trade; Setup - Konfigurationsdateien Überprüfung');
  define('TEXT_CONFIG_FILES', 'Konfiguration Einstellungen - configure.php Dateien');
  define('TEXT_CONFIG_INSTRUCTIONS', 'Sie können die Zwischenablage Ihres Computers benutzen, um die entsprechenden Informationen aus den folgenden Boxen zu kopieren.  Klicken Sie in die Box, kopieren Sie den Inhalt in Ihre Zwischenablage, öffnen Sie die entsprechenden configure.php Datei mit einem Texteditor, fügen Sie den Inhalt der Zwischenablage ein, abspeichern und hochladen. Wiederholen Sie dieses für die zweite configure.php Datei.<br /><br />Wenn Sie fertig sind, klicken Sie auf den Button "Dateien erneut überprüfen".');

  define('TEXT_CATALOG_CONFIGFILE', '/includes/configure.php');
  define('TEXT_ADMIN_CONFIGFILE', '/admin/includes/configure.php');

  define('CONTINUE_BUTTON', 'Ignorieren und Fortfahren');
  define('RECHECK', 'Dateien erneut überprüfen');
