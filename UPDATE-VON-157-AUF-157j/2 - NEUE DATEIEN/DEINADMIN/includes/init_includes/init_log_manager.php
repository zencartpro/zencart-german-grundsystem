<?php
/**
* Zen Cart German Specific (zencartpro adaptations)
* @copyright Copyright 2003-2023 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* Zen Cart German Version - www.zen-cart-pro.at
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: init_log_manager.php 2023-11-11 15:01:51Z webchills $
*/
// -----
// Part of the Log Manager plugin, created by lat9 (lat9@vinosdefrutastropicales.com)
// Copyright (c) 2017-2023, Vinos de Frutas Tropicales.
//
// -----
// If the plugin is enabled and current session is associated with a logged-in admin and the plugin's processing hasn't been run
// yet for this session ... manage those logs!
//
if (isset($_SESSION['admin_id']) && !isset($_SESSION['log_managed'])) {
	
	if (!defined('LOG_MANAGER_KEEP_DAYS')) {  
  define('LOG_MANAGER_KEEP_DAYS', '0');        
  }    
  if (!defined('LOG_MANAGER_KEEP_THESE')) {   
  define('LOG_MANAGER_KEEP_THESE', 'zcInstall');
  }
      
    if (((int)LOG_MANAGER_KEEP_DAYS) > 0) {
        // -----
        // Build up a string-to-match (via preg_match) for the .log files that should be "kept".  That string
        // contains the log-file name prefixes.
        //
        $match_string = '';
        if (LOG_MANAGER_KEEP_THESE !== '') {
            $logs_to_keep = explode(',', str_replace(' ', '', LOG_MANAGER_KEEP_THESE));
            if (count($logs_to_keep) > 1) {
                $match_string = '/^(' . implode('|', $logs_to_keep) . ').*$/';
            } else {
                $match_string = '/^' . $logs_to_keep[0] . '.*$/';
            }
        }

        // -----
        // Determine the keep-until date (some number of days **prior to** today).
        //
        $keep_until = strtotime('-' . LOG_MANAGER_KEEP_DAYS . ' day');
        $keep_until_date = date(DATE_FORMAT . ' H:m:i', $keep_until);

        // -----
        // Loop through all files present in the /logs and, for zc158 and later, the
        // /app/storage/logs, sub-directories as well as any additional directories
        // that might be supplied in an optional constant definition.
        //
        if (!defined('DIR_FS_LOGS')) define('DIR_FS_LOGS', DIR_FS_CATALOG . 'logs');
        $log_manager_dirs = [
            DIR_FS_LOGS,
        ];        

        // -----
        // To remove .log files from other directories, too, use an /admin/extra_datafiles file to
        // define the following constant.  The constant's definition would look like the following
        // to also remove log-files from /includes/modules/payment/paypay/logs and /logs/edit_orders:
        //
        // define('LOG_MANAGER_EXTRA_DIRECTORIES', DIR_FS_CATALOG . 'includes/modules/payment/paypay/logs' . ';' . DIR_FS_LOGS . '/edit_orders');
        //
        if (defined('LOG_MANAGER_EXTRA_DIRECTORIES')) {
            $log_manager_extra_dirs = explode(';', str_replace(' ', '', LOG_MANAGER_EXTRA_DIRECTORIES));
            foreach ($log_manager_extra_dirs as $log_manager_extra) {
                if (is_dir($log_manager_extra)) {
                    $log_manager_dirs[] = $log_manager_extra;
                } else {
                    trigger_error('Unknown directory ($log_manager_extra) identified in LOG_MANAGER_EXTRA_DIRECTORIES.', E_USER_NOTICE);
                }
            }
            unset($log_manager_extra_dirs, $log_manager_extra);
        }

        $files_removed = 0;
        foreach ($log_manager_dirs as $log_manager_dir) {
            if ($dir = dir($log_manager_dir)) {
                while (($current_file = $dir->read()) !== false) {
                    // -----
                    // ... looking for a ".log" file with a name that isn't in the "keep-these" list ...
                    //
                    if (strpos($current_file, '.log') !== false && $match_string !== '' && preg_match($match_string, $current_file) !== 1) {
                        // -----
                        // ... that was last modified prior to the keep-until date ...
                        //
                        $current_file = $log_manager_dir . DIRECTORY_SEPARATOR . $current_file;
                        $modified = is_file($current_file) ? filemtime($current_file) : false;
                        if ($modified !== false && $modified < $keep_until) {
                            // -----
                            // ... remove it.
                            //
                            unlink($current_file);
                            $files_removed++;
                        }
                    }
                }
                $dir->close();
            }
        }

        // -----
        // If one or more .log files was removed, let the admin know (via message) and log the removal action.
        //
        if ($files_removed !== 0) {
            $log_directories = $log_manager_dirs;
            $logMessage = sprintf(LOG_MANAGER_FILES_MESSAGE_FORMAT, $files_removed, '.log', $log_directories, $keep_until_date);
            $messageStack->add($logMessage, 'success');
            error_log(date(PHP_DATE_TIME_FORMAT) . ', ' . $_SESSION['admin_id'] . ": $logMessage" . PHP_EOL, 3, DIR_FS_LOGS . '/log_manager_removal.log');
        }
    }

    // -----
    // Note that the plugin's processing has been run for the current admin session.
    //
    $_SESSION['log_managed'] = true;
}