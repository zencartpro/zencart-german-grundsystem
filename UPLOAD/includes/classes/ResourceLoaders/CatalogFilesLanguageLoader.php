<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: CatalogFilesLanguageLoader.php for newer plugins 2025-10-29 15:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

/**
 * @since ZC v1.5.8
 */
class CatalogFilesLanguageLoader extends FilesLanguageLoader
{
    /**
     * @since ZC v1.5.8
     */
    public function loadInitialLanguageDefines($mainLoader)
    {
        $this->mainLoader = $mainLoader;
        $this->loadLanguageExtraDefinitions();
        $this->loadMainLanguageFiles();
    }

    /**
     * @since ZC v1.5.8
     */
    public function loadLanguageForView(): void
    {
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

    /**
     * @since ZC v1.5.8
     */
    protected function loadMainLanguageFiles(): void
    {
        $extraFiles = [
            FILENAME_EMAIL_EXTRAS,
            FILENAME_HEADER,
            FILENAME_BUTTON_NAMES,
            FILENAME_ICON_NAMES,
            FILENAME_OTHER_IMAGES_NAMES,
            FILENAME_CREDIT_CARDS,
            FILENAME_WHOS_ONLINE,
            FILENAME_META_TAGS,
        ];

        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $this->templateDir . '/' . $_SESSION['language'] . '.php');
        $this->loadFileDefineFile(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
        foreach ($extraFiles as $file) {
            $file = basename($file, '.php') . '.php';
            $this->loadExtraLanguageFiles(DIR_WS_LANGUAGES, $_SESSION['language'], $file);
        }
    }

    /**
     * @since ZC v1.5.8
     */
    protected function LoadLanguageExtraDefinitions(): void
    {
        $extraDefsDir = DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions';
        $extraDefsDirTpl = $extraDefsDir . '/' . $this->templateDir;
        $extraDefs = $this->fileSystem->listFilesFromDirectoryAlphaSorted($extraDefsDir);
        $extraDefsTpl = $this->fileSystem->listFilesFromDirectoryAlphaSorted($extraDefsDirTpl);

        $folderList = [
            $extraDefsDir => $extraDefs,
            $extraDefsDirTpl => $extraDefsTpl,
        ];

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
