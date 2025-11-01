<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: AdminFilesLanguageLoader.php for newer plugins 2025-10-30 14:54:24Z webchills $
 */

namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

/**
 * @since ZC v1.5.8
 */
class AdminFilesLanguageLoader extends FilesLanguageLoader
{
    /**
     * @since ZC v1.5.8
     */
    public function loadInitialLanguageDefines($mainLoader)
    {
        $this->mainLoader = $mainLoader;
        $this->loadLanguageExtraDefinitions();
        $this->loadLanguageForView();
        $this->loadBaseLanguageFile();
    }

    /**
     * @since ZC v1.5.8
     */
    protected function loadLanguageForView()
    {
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $this->currentPage);
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $langFile = $pluginDir . '/admin/includes/languages/'  . $_SESSION['language'] . '/' . $this->currentPage;
            $this->loadFileDefineFile($langFile);
        }
    }
    /**
     * @since ZC v1.5.8
     */
    protected function loadLanguageExtraDefinitions()
    {
        $dirPath = DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions';
        $fileList = $this->fileSystem->listFilesFromDirectoryAlphaSorted($dirPath, '~^(?!lang\.).*\.php$~i');
        foreach ($fileList as $file) {
            $this->loadFileDefineFile($dirPath . '/' . $file);
        }
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $dirPath = $pluginDir . '/admin/includes/languages/' . $_SESSION['language'] . '/extra_definitions';
            $fileList = $this->fileSystem->listFilesFromDirectoryAlphaSorted($dirPath, '~^(?!lang\.).*\.php$~i');
            foreach ($fileList as $file) {
                $this->loadFileDefineFile($dirPath . '/' . $file);
            }
        }
    }
     /**
     * @since ZC v1.5.8
     */
    protected function loadBaseLanguageFile()
    {
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
        $this->loadFileDefineFile(
            zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES)
        );
    }
}
