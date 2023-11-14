<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2015 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */

if (!defined('MAILBEEZ_INSTALL_TITLE')) {

    define('MAILBEEZ_INSTALL_TITLE', 'CloudLoader');

    define('MAILBEEZ_INSTALL_SYSTEM_CHECK', 'System Check');
    define('MAILBEEZ_INSTALL_SYSTEM_CONFIRM', 'Agree & Continue');
    define('MAILBEEZ_INSTALL_CANCEL', 'Cancel');

    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_PHP', 'PHP version 5.6 .. 8.1 supported');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_SAFEMODE', 'Safe mode PHP setting is not enabled');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_CURL', 'cURL PHP Extension is required');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_CONNECTION', 'Test connection to CloudBeez server');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_CONNECTION_SPEED', 'Test connection speed');
    define('MAILBEEZ_INSTALL_SYSTEM_CHECK_TEST_WRITE_PERM', 'Permission to write to the installation directory');

    define('MAILBEEZ_INSTALL_INSTALL', 'Installation progress...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP1', 'Requesting package information...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP2', 'Downloading application files...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP3', 'Creating backup...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP4', 'Checking permissions...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP5', 'Unpacking application files...');
    define('MAILBEEZ_INSTALL_INSTALL_STEP6', 'Finishing installation...');

    define('MAILBEEZ_INSTALL_INSTALL_FINISH', 'Congratulations!');

    define('MAILBEEZ_INSTALL_UPDATE', 'Updating framework');
    define('MAILBEEZ_INSTALL_UPDATE_FINISH', 'Framework successfully updated');
    define('MAILBEEZ_INSTALL_UPDATE_STEP6', 'Finalizing update...');

    define('MAILBEEZ_PACKAGE_INSTALL', 'Pro-Plan Installation progress...');
    define('MAILBEEZ_PACKAGE_INSTALL_FINISH', 'Pro-Plan successfully installed');
    define('MAILBEEZ_PACKAGE_INSTALL_STEP6', 'Finalizing Pro-Plan Installation...');

    define('MAILBEEZ_PACKAGE_UPDATE', 'Updating Pro-Plan...');
    define('MAILBEEZ_PACKAGE_UPDATE_FINISH', 'Pro-Plan successfully updated');
    define('MAILBEEZ_PACKAGE_UPDATE_STEP6', 'Finalizing Pro-Plan update...');

    define('MAILBEEZ_INSTALL_ERROR_FILE_NOT_WRITEABLE', 'Can not write %s file(s) e.g. <small><ul><li>%s</ul></small>Please grant write permissions using your FTP client.');


    define('MAILBEEZ_INSTALL_ERROR_DIR_NOT_CREATE', 'Could not create directory %s - please check your server configuration');
    define('MAILBEEZ_INSTALL_ERROR_BACKUP', 'Backup failed');

    define('MAILBEEZ_INSTALL_BACKUP_LOCATION', 'Backup: %s');

    define('MAILBEEZ_INSTALL_PACKAGE_TITLE', 'Select your Pro-Plan');
}