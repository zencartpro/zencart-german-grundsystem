<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: LanguageLoader.php 2023-05-20 13:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

class LanguageLoader
{
    private
        $languageFilesLoaded,
        $arrayLoader,
        $fileLoader;
        
    public function __construct($arraysLoader, $filesLoader)
    {
        $this->languageFilesLoaded = ['arrays' => [], 'legacy' => []];
        $this->arrayLoader = $arraysLoader;
        $this->fileLoader = $filesLoader;
        $this->languageFilesLoaded = ['arrays' => [], 'legacy' => []];
    }

    public function loadInitialLanguageDefines()
    {
        $this->arrayLoader->loadInitialLanguageDefines($this);
        $this->fileLoader->loadInitialLanguageDefines($this);
    }

    public function finalizeLanguageDefines()
    {
        $this->arrayLoader->makeConstants($this->arrayLoader->getLanguageDefines());
    }

    public function getLanguageFilesLoaded()
    {
        return $this->languageFilesLoaded;
    }

    public function addLanguageFilesLoaded($type, $defineFile)
    {
        $this->languageFilesLoaded[$type][] = $defineFile;
    }

    public function loadDefinesFromFile($baseDirectory, $language, $languageFile)
    {
        $this->arrayLoader->loadDefinesFromArrayFile($baseDirectory, $language, $languageFile);
        $this->fileLoader->loadFileDefineFile(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $language . $baseDirectory . '/' . $languageFile);
        return true; 
    }

    public function loadModuleDefinesFromFile($baseDirectory, $language, $module_type, $languageFile)
    {
        $defs = $this->arrayLoader->loadModuleDefinesFromArrayFile(DIR_FS_CATALOG . 'includes/languages/', $language, $module_type, $languageFile);

        $this->arrayLoader->makeConstants($defs); 
        $this->fileLoader->loadFileDefineFile(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $language . $baseDirectory . $module_type . '/' . $languageFile);
        return true; 
    }

    /**
     * Used on the catalog-side to set the current page for the language-load, since it's not necessarily
     * available during the autoload process (e.g. for AJAX handlers).
     *
     * @param string $currentPage
     * @return void
     */
    public function setCurrentPage($currentPage)
    {
        $this->arrayLoader->currentPage = $currentPage;
        $this->fileLoader->currentPage = $currentPage;
    }

    public function loadLanguageForView()
    {
        $this->arrayLoader->loadLanguageForView();
        $this->fileLoader->loadLanguageForView();
    }

    public function loadExtraLanguageFiles($rootPath, $language, $fileName, $extraPath = '')
    {
        $this->arrayLoader->loadExtraLanguageFiles($rootPath, $language, $fileName, $extraPath);
        $this->fileLoader->loadExtraLanguageFiles($rootPath, $language, $fileName, $extraPath);
    }

    public function hasLanguageFile($rootPath, $language, $fileName, $extraPath = '')
    {
        if (is_file($rootPath . $language . $extraPath . '/' . $fileName)) {
            return true;
        }
        if (is_file($rootPath . $language . $extraPath . '/lang.' . $fileName)) {
            return true;
        }
        return false;
    }

    public function isFileAlreadyLoaded($defineFile)
    {
        $fileInfo = pathinfo($defineFile);
        $searchFile = $fileInfo['basename'];
        if (strpos($searchFile, 'lang.') !== 0) {
            $searchFile = 'lang.' . $searchFile;
        }
        $searchFile = $fileInfo['dirname'] . '/' . $searchFile;
        if (in_array($searchFile, $this->languageFilesLoaded['arrays'])) {
            return true;
        }
        if (in_array($defineFile, $this->languageFilesLoaded['legacy'])) {
            return true;
        }
        return false;
    }
}
