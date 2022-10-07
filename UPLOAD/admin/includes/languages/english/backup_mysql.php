<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: backup_mysql.php 2022-10-07 08:50:16Z webchills $
 */


define('HEADING_TITLE', 'MySQL Database Backup/Restore');
define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: Backup directory<br>"'.DIR_FS_BACKUP.'"<br>does not exist (slash orientation is not significant).<br>Please check configure.php (or /local/configure.php if used).');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: Backup directory is not writeable.');
define('ERROR_CANT_BACKUP_IN_SAFE_MODE','ERROR: This backup script seldom works when safe_mode is enabled or open_basedir restrictions are in effect.<br>If you get no errors doing a backup, check to see whether the file is less than 200kb. If so, then the backup is likely unreliable.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: Download link not acceptable.');
define('ERROR_EXEC_DISABLED','ERROR: Your server\'s "exec()" command has been disabled. This script cannot run. Ask your host if they are willing to re-enable PHP exec().');
define('ERROR_SHELL_EXEC_DISABLED','Unix cannot auto-detect the path to mysql as the "shell_exec()" function has been disabled: checking paths hard-coded in script...');
define('ERROR_NOT_FOUND', 'not found');
define('ERROR_PHP_DISABLED_FUNCTIONS', 'PHP-Disabled Functions: ');
define('FAILURE_BACKUP_FAILED_CHECK_PERMISSIONS','The backup failed because there was an error starting the backup program (mysqldump or mysqldump.exe).<br>If running on Windows 2003 server, you may need to alter permissions on cmd.exe to allow Special Access to the Internet Guest Account to read/execute.<br>You should talk to your webhost about why exec() commands are failing when attempting to run the mysqldump binary/program.');
define('FAILURE_DATABASE_NOT_RESTORED', 'Failure: The database may NOT have been restored properly. Please check it carefully.');
define('FAILURE_DATABASE_NOT_RESTORED_FILE_NOT_FOUND', 'Failure: The database was NOT restored.  ERROR: FILE NOT FOUND: %s. Note that compressed files must be named *.sql.gz or *.sql.zip.');
define('FAILURE_DATABASE_NOT_RESTORED_UTIL_NOT_FOUND', 'ERROR: Could not locate the MYSQL restore utility. RESTORE FAILED.');
define('FAILURE_DATABASE_NOT_SAVED', 'Failure: The database has NOT been saved.');
define('FAILURE_DATABASE_NOT_SAVED_UTIL_NOT_FOUND', 'ERROR: Could not locate the MYSQLDUMP backup utility. BACKUP FAILED.');
define('SUCCESS_BACKUP_DELETED', 'Success: The backup has been removed.');
define('SUCCESS_DATABASE_RESTORED', 'Success: The database has been restored.');
define('SUCCESS_DATABASE_SAVED', 'Success: The database has been saved.');
define('SUCCESS_LAST_RESTORE_CLEARED', 'Success: The last restoration date has been cleared.');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_FILE_DATE', 'Date');
define('TABLE_HEADING_FILE_SIZE', 'Size');
define('TABLE_HEADING_TITLE', 'Title');
define('TEXT_ADD_SUFFIX', 'Here you can add an optional suffix to the filename (ascii characters only):');
define('TEXT_BACKUP_DIRECTORY', 'Backup Directory:');
define('TEXT_CHECK_PATH', 'Checking Path: ');
define('TEXT_COMMAND', 'Command: ');
define('TEXT_COMMAND_RUN', '<br>The command being run is: ');
define('TEXT_DEBUG_ON', 'Backup MySQL <strong>Debug ON</strong>');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this backup?');
define('TEXT_EXECUTABLES_FOUND', 'MySQL tools found:');
define('TEXT_EXECUTABLES_NOT_FOUND', 'MySQL tools (mysql, mysqldump) not found.');
define('TEXT_FIX_CACHE_KEY', 'Run fix_cache_key.php');
define('TEXT_FORGET', '(forget)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'This is safer if uploaded via a secured HTTPS connection.');
define('TEXT_INFO_COMPRESSION', 'Compression:');
define('TEXT_INFO_DATE', 'Date:');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download without storing on server');
define('TEXT_INFO_HEADING_NEW_BACKUP', 'New Backup');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Local');
define('TEXT_INFO_NEW_BACKUP', '<b>Do not interrupt the backup process</b>, which might take a couple of minutes.');
define('TEXT_INFO_RESTORE', '<b>Do not interrupt the restoration process</b>.<br><br>The larger the backup, the longer this process takes!<br><br>If possible, use the mysql client.<br><br>For example:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', '<b>Do not interrupt the restoration process.</b><br>The larger the backup, the longer this process takes!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'The file uploaded must be a plain text file of sql queries with extension ".sql".');
define('TEXT_INFO_SIZE', 'Size:');
define('TEXT_INFO_SKIP_LOCKS', 'Skip Lock option (check this if you get a LOCK TABLES permissions error)');
define('TEXT_INFO_UNPACK', '<br><br>(after unpacking the file from the archive)');
define('TEXT_INFO_USE_GZIP', 'Use GZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'No Compression (Pure SQL)');
define('TEXT_INFO_USE_ZIP', 'Use ZIP');
define('TEXT_LAST_RESTORATION', 'Last Restoration:');
define('TEXT_NO_EXTENSION', 'None');
define('TEXT_RESULT_CODE', 'Result code: ');
define('TEXT_SELECTED_EXECUTABLES', 'Command Files Selected: ');
define('WARNING_NOT_SECURE_FOR_DOWNLOADS','<span class="errorText">NOTE: You do not have SSL enabled. Any downloads you do from this page will not be encrypted. Doing backups and restores will be fine, but download/upload of files from/to the server presents a security risk.</span>');
define('WARNING_MYSQL_NOT_FOUND','WARNING: "<strong>mysql</strong>" binary not found. <strong>Restores</strong> may not work.<br>Please set full path to MYSQL binary in extra_datafiles/backup_mysql.php');
define('WARNING_MYSQLDUMP_NOT_FOUND','WARNING: "<strong>mysqldump</strong>" binary not found. <strong>Backups</strong> may not work.<br>Please set full path to MYSQLDUMP binary in extra_datafiles/backup_mysql.php');
define('TEXT_TEMP_SQL_DELETED','Temporary .sql file deleted');
define('TEXT_TEMP_SQL_NOT_DELETED','Temporary .sql file NOT deleted');
define('ICON_FILE_DOWNLOAD', 'download');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_RESTORE', 'Restore');
