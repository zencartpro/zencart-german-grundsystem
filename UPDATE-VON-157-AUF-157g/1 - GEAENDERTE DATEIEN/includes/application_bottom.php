<?php
/**
 * application_bottom.php
 * Common actions carried out at the end of each page invocation.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: application_bottom.php 2023-10-25 19:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
//  @todo icwtodo Development debug code
// do not remove for now
if (defined('DEV_SHOW_APPLICATION_BOTTOM_DEBUG') && DEV_SHOW_APPLICATION_BOTTOM_DEBUG == true) {
    $langLoaded = $languageLoader->getLanguageFilesLoaded();
    echo '$langLoaded = ' . str_replace("\n", '<br>', var_export($langLoaded, true));

    $files = get_included_files();
    $langFiles = [];
    $pattern = DIR_WS_LANGUAGES;
    foreach ($files as $file) {
        $shortFile = str_replace(["\\", DIR_FS_CATALOG], ['/', ''], $file);
        if (in_array($shortFile, $langLoaded['legacy']) || in_array($file, $langLoaded['legacy'])) {
            continue;
        }
        if (in_array($shortFile, $langLoaded['arrays']) || in_array($file, $langLoaded['arrays'])) {
            continue;
        }
        if (strpos($shortFile, $pattern) === 0) {
            $langFiles[] = $file;
        }
    }
    echo '<br>Other $langFiles = ' . str_replace("\n", '<br>', var_export($langFiles, true));
}
// close session (store variables)
session_write_close();