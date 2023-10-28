<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: AdminFilesLanguageLoader.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

class AdminFilesLanguageLoader extends FilesLanguageLoader
{
    public function loadInitialLanguageDefines($mainLoader)
    {
        $this->mainLoader = $mainLoader;
        $this->loadLanguageExtraDefinitions();
        $this->loadLanguageForView();
        $this->loadBaseLanguageFile();
    }

    protected function loadLanguageForView()
    {
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $this->currentPage);
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $langFile = $pluginDir . '/admin/includes/languages/'  . $_SESSION['language'] . '/' . $this->currentPage;
            $this->loadFileDefineFile($langFile);
        }
    }

    protected function loadLanguageExtraDefinitions()
    {
        $dirPath = DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions';
        $fileList = $this->fileSystem->listFilesFromDirectory($dirPath, '~^(?!lang\.).*\.php$~i');
        foreach ($fileList as $file) {
            $this->loadFileDefineFile($dirPath . '/' . $file);
        }
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $dirPath = $pluginDir . '/admin/includes/languages/' . $_SESSION['language'] . '/extra_definitions';
            $fileList = $this->fileSystem->listFilesFromDirectory($dirPath, '~^(?!lang\.).*\.php$~i');
            foreach ($fileList as $file) {
                $this->loadFileDefineFile($dirPath . '/' . $file);
            }
        }
    }

    protected function loadBaseLanguageFile()
    {
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . "/" . FILENAME_EMAIL_EXTRAS);
        $this->loadFileDefineFile(
            zen_get_file_directory(
                DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES));
    }
}
