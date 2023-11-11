<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: CatalogFilesLanguageLoader.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

class CatalogFilesLanguageLoader extends FilesLanguageLoader
{
    public function loadInitialLanguageDefines($mainLoader)
    {
        $this->mainLoader = $mainLoader;
        $this->loadLanguageExtraDefinitions();
        $this->loadMainLanguageFiles();
    }

    public function loadLanguageForView()
    {
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $pluginDir .= '/catalog/includes/languages/'  . $_SESSION['language'];
            $files = $this->fileSystem->listFilesFromDirectoryAlphaSorted($pluginDir . '/' . $this->templateDir, '~^' . $this->currentPage  . '(.*)\.php$~i');
            foreach ($files as $file) {
                $this->loadFileDefineFile($pluginDir . '/' . $this->templateDir . '/' . $file);
            }

            $files = $this->fileSystem->listFilesFromDirectoryAlphaSorted($pluginDir, '~^' . $this->currentPage  . '(.*)\.php$~i');
            foreach ($files as $file) {
                $this->loadFileDefineFile($pluginDir . '/' . $file);
            }
        }

        $directory = DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $this->templateDir;
        if (defined('NO_LANGUAGE_SUBSTRING_MATCH') && in_array($this->currentPage, NO_LANGUAGE_SUBSTRING_MATCH)) {
            $files_to_match = $this->currentPage;
        } else {
            $files_to_match = $this->currentPage . '(.*)';
        }
        $files = $this->fileSystem->listFilesFromDirectoryAlphaSorted($directory, '~^' . $files_to_match  . '\.php$~i');
        foreach ($files as $file) {
            $this->loadFileDefineFile($directory . '/' . $file);
        }

        $directory = DIR_WS_LANGUAGES . $_SESSION['language'];
        $files = $this->fileSystem->listFilesFromDirectoryAlphaSorted($directory, '~^' . $files_to_match  . '\.php$~i');
        foreach ($files as $file) {
            $this->loadFileDefineFile($directory . '/' . $file);
        }
    }

    protected function loadMainLanguageFiles()
    {
        $extraFiles = [FILENAME_EMAIL_EXTRAS, FILENAME_HEADER, FILENAME_BUTTON_NAMES, FILENAME_ICON_NAMES, FILENAME_OTHER_IMAGES_NAMES, FILENAME_CREDIT_CARDS, FILENAME_WHOS_ONLINE, FILENAME_META_TAGS];
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $this->templateDir . '/' . $_SESSION['language'] . '.php');
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
        foreach ($extraFiles as $file) {
            $file = basename($file, '.php') . ".php";
            $this->loadExtraLanguageFiles(DIR_WS_LANGUAGES, $_SESSION['language'], $file);
        }
    }

    protected function LoadLanguageExtraDefinitions()
    {
        $extraDefsDir = DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions';
        $extraDefsDirTpl = $extraDefsDir . '/' . $this->templateDir;
        $extraDefs = $this->fileSystem->listFilesFromDirectoryAlphaSorted($extraDefsDir);
        $extraDefsTpl = $this->fileSystem->listFilesFromDirectoryAlphaSorted($extraDefsDirTpl);

        $folderList = [$extraDefsDir => $extraDefs, $extraDefsDirTpl => $extraDefsTpl];
        foreach ($this->pluginList as $plugin) {
            $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'];
            $pluginDir .= '/catalog/includes/languages/'  . $_SESSION['language'] . '/extra_definitions';
            $extraDefsPlugin = $this->fileSystem->listFilesFromDirectoryAlphaSorted($pluginDir);

            $folderList[$pluginDir] = $extraDefsPlugin;
            $pluginDirTpl = $pluginDir . '/' . $this->templateDir;
            $extraDefsPluginTpl = $this->fileSystem->listFilesFromDirectoryAlphaSorted($pluginDirTpl);
            $folderList[$pluginDirTpl] = $extraDefsPluginTpl;
       }
        $foundList = [];
        foreach ($folderList as $folder => $entries) {
            foreach ($entries as $entry) {
                $foundList[$entry] = $folder;
            }
        }
        foreach ($foundList as $file => $directory) {
            $this->loadFileDefineFile($directory . '/' . $file);
        }
    }
}
