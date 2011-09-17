<?php
/**
 * googlemcde.php
 *
 * @package google merchant center deutschland 2.0 for Zen-Cart 1.3.9 german
 * @copyright Copyright 2007 Numinix Technology http://www.numinix.com
 * @copyright Portions Copyright 2011 webchills http://www.webchills.at
 * @copyright Portions Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: googlefroogle.php 43 2010-11-18 23:34:54Z numinix $
 * @version $Id: googlemcde.php 2011-04-18 12:29:54Z webchills $
 */
 
define('TEXT_GOOGLE_MCDE_STARTED', 'Google Merchant Center Feeder v%s started ' . date("Y/m/d H:i:s"));
define('TEXT_GOOGLE_MCDE_FILE_LOCATION', 'Feed file - ');
define('TEXT_GOOGLE_MCDE_FEED_COMPLETE', 'Google Merchant Center File Complete');
define('TEXT_GOOGLE_MCDE_FEED_TIMER', 'Time:');
define('TEXT_GOOGLE_MCDE_FEED_SECONDS', 'Seconds');
define('TEXT_GOOGLE_MCDE_FEED_RECORDS', ' Records');
define('GOOGLE_MCDE_TIME_TAKEN', 'In');
define('GOOGLE_MCDE_VIEW_FILE', 'View File:');
define('ERROR_GOOGLE_MCDE_DIRECTORY_NOT_WRITEABLE', 'Your Google Merchant Center folder is not writeable! Please chmod the /' . GOOGLE_MCDE_DIRECTORY . ' folder to 755 or 777 depending on your host.');
define('ERROR_GOOGLE_MCDE_DIRECTORY_DOES_NOT_EXIST', 'Your Google Merchant Center output directory does not exist! Please create an /' . GOOGLE_MCDE_DIRECTORY . ' directory and chmod to 755 or 777 depending on your host.');
define('ERROR_GOOGLE_MCDE_OPEN_FILE', 'Error opening Google Merchant Center output file "' . DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . GOOGLE_MCDE_OUTPUT_FILENAME . '"');
define('TEXT_GOOGLE_MCDE_UPLOAD_STARTED', 'Upload started...');
define('TEXT_GOOGLE_MCDE_UPLOAD_FAILED', 'Upload failed...');
define('TEXT_GOOGLE_MCDE_UPLOAD_OK', 'Upload ok!');
define('TEXT_GOOGLE_MCDE_ERRSETUP', 'Google Merchant Center error setup:');
define('TEXT_GOOGLE_MCDE_ERRSETUP_L', 'Google Merchant Center Feed Language "%s" not defined in zen-cart store.');
define('TEXT_GOOGLE_MCDE_ERRSETUP_C', 'Google Merchant Center Default Currency "%s" not defined in zen-cart store.');
define('FTP_FAILED', 'Your hosting does not support ftp functions.');
define('FTP_CONNECTION_FAILED', 'Connection failed:');
define('FTP_CONNECTION_OK', 'Connected to:');
define('FTP_LOGIN_FAILED', 'Login failed:');
define('FTP_LOGIN_OK', 'Login ok:');
define('FTP_CURRENT_DIRECTORY', 'Current Directory Is:');
define('FTP_CANT_CHANGE_DIRECTORY', 'Can not change directory on:');
define('FTP_UPLOAD_FAILED', 'Upload Failed');
define('FTP_UPLOAD_SUCCESS', 'Uploaded Successfully');
define('FTP_SERVER_NAME', ' Server Name: ');
define('FTP_USERNAME', ' Username: ');
define('FTP_PASSWORD', ' Password: ');