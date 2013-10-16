<?php
/**
 * googlemcde.php
 *
 * @package google merchant center 2.0 deutschland for Zen-Cart 1.3.9 german
 * @copyright Copyright 2007 Numinix Technology http://www.numinix.com
 * @copyright Portions Copyright 2011 webchills http://www.webchills.at
 * @copyright Portions Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: googlefroogle.php 43 2010-11-18 23:34:54Z numinix $
 * @version $Id: googlemcde.php 2011-04-18 12:29:54Z webchills $
 */
 
define('TEXT_GOOGLE_MCDE_STARTED', 'Google Merchant Center Feeder v%s gestartet ' . date("Y/m/d H:i:s"));
define('TEXT_GOOGLE_MCDE_FILE_LOCATION', 'Feed Datei - ');
define('TEXT_GOOGLE_MCDE_FEED_COMPLETE', 'Google Merchant Center Datei vollständig');
define('TEXT_GOOGLE_MCDE_FEED_TIMER', 'Zeit:');
define('TEXT_GOOGLE_MCDE_FEED_SECONDS', 'Sekunden');
define('TEXT_GOOGLE_MCDE_FEED_RECORDS', ' Einträge');
define('GOOGLE_MCDE_TIME_TAKEN', 'in');
define('GOOGLE_MCDE_VIEW_FILE', 'Datei ansehen:');
define('ERROR_GOOGLE_MCDE_DIRECTORY_NOT_WRITEABLE', 'Ihr Google Merchant Center Verzeichnis ist nicht beschreibbar! Bitte setzen Sie für das /' . GOOGLE_MCDE_DIRECTORY . ' Verzeichnis chmod 755 oder 777 je nach Ihrer Serverkonfiguration.');
define('ERROR_GOOGLE_MCDE_DIRECTORY_DOES_NOT_EXIST', 'Ihr Google Merchant Center Verzeichnis existiert nicht! Bitte legen Sie das /' . GOOGLE_MCDE_DIRECTORY . ' Verzeichis an und setzen chmod 755 oder 777 je nach Ihrer Serverkonfiguration.');
define('ERROR_GOOGLE_MCDE_OPEN_FILE', 'Fehler beim Öffnen der Google Merchant Center Datei "' . DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . GOOGLE_MCDE_OUTPUT_FILENAME . '"');
define('TEXT_GOOGLE_MCDE_UPLOAD_STARTED', 'Upload gestartet...');
define('TEXT_GOOGLE_MCDE_UPLOAD_FAILED', 'Upload fehlgeschlagen...');
define('TEXT_GOOGLE_MCDE_UPLOAD_OK', 'Upload ok!');
define('TEXT_GOOGLE_MCDE_ERRSETUP', 'Google Merchant Center Setup Fehler:');
define('TEXT_GOOGLE_MCDE_ERRSETUP_L', 'Google Merchant Center Feed Sprache "%s" ist nicht in der Zen-Cart Administration konfiguriert.');
define('TEXT_GOOGLE_MCDE_ERRSETUP_C', 'Google Merchant Center Währung "%s" ist nicht in der Zen-Cart Administration konfiguriert.');
define('FTP_FAILED', 'Ihr Webspacepaket unterstützt keine FTP Funktionen.');
define('FTP_CONNECTION_FAILED', 'Verbindung fehlgeschlagen:');
define('FTP_CONNECTION_OK', 'verbunden mit:');
define('FTP_LOGIN_FAILED', 'Login fehlgeschlagen:');
define('FTP_LOGIN_OK', 'Login ok:');
define('FTP_CURRENT_DIRECTORY', 'Aktuelles Verzeichnis ist:');
define('FTP_CANT_CHANGE_DIRECTORY', 'Kann Verzeichnis nicht ändern in:');
define('FTP_UPLOAD_FAILED', 'Upload fehlgeschlagen');
define('FTP_UPLOAD_SUCCESS', 'erfolgreich hochgeladen');
define('FTP_SERVER_NAME', ' Server Name: ');
define('FTP_USERNAME', ' Username: ');
define('FTP_PASSWORD', ' Passwort: ');