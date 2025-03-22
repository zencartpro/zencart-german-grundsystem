<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: AdminArraysLanguageLoader.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

class AdminArraysLanguageLoader extends ArraysLanguageLoader
{
    public function loadInitialLanguageDefines($mainLoader)
    {
        $this->mainLoader = $mainLoader;
        $this->loadBaseLanguageFile();
        $this->loadLanguageForView();
        $this->loadLanguageExtraDefinitions();
    }

    protected function loadLanguageForView()
    {
        $defineList = $this->loadDefinesFromArrayFile(DIR_WS_LANGUAGES, $_SESSION['language'], $this->currentPage);
        $this->addLanguageDefines($defineList);
        $defineList = $this->pluginLoadDefinesFromArrayFile($_SESSION['language'], $this->currentPage, 'admin', '');
        $this->addLanguageDefines($defineList);
    }

    protected function loadLanguageExtraDefinitions()
    {
        $defineList = $this->loadArraysFromDirectory(DIR_WS_LANGUAGES, $_SESSION['language'], '/extra_definitions');
        $this->addLanguageDefines($defineList);
        $defineList = $this->pluginLoadArraysFromDirectory($_SESSION['language'], '/extra_definitions');
        $this->addLanguageDefines($defineList);
    }

    protected function loadBaseLanguageFile()
    {
        $mainFile = DIR_WS_LANGUAGES . 'lang.' . $_SESSION['language'] . '.php';
        $fallbackFile = DIR_WS_LANGUAGES . 'lang.' . $this->fallback . '.php';
        $defineList = $this->loadDefinesWithFallback($mainFile, $fallbackFile);
        $this->addLanguageDefines($defineList);
        $defineList = $this->loadDefinesFromArrayFile(DIR_WS_LANGUAGES, $_SESSION['language'], 'gv_name.php');
        $this->addLanguageDefines($defineList);
        $defineList = $this->loadDefinesFromArrayFile(DIR_WS_LANGUAGES, $_SESSION['language'], FILENAME_EMAIL_EXTRAS);
        $this->addLanguageDefines($defineList);
        $defineList = $this->loadDefinesFromArrayFile(DIR_FS_CATALOG . DIR_WS_LANGUAGES, $_SESSION['language'], FILENAME_OTHER_IMAGES_NAMES);
        $this->addLanguageDefines($defineList);
        if ($this->fileSystem->hasTemplateLanguageOverride($this->templateDir, DIR_FS_CATALOG . DIR_WS_LANGUAGES, $_SESSION['language'], FILENAME_OTHER_IMAGES_NAMES)) {
            $defineList = $this->loadDefinesFromArrayFile(DIR_FS_CATALOG . DIR_WS_LANGUAGES, $_SESSION['language'], FILENAME_OTHER_IMAGES_NAMES, $this->templateDir . '/');
            $this->addLanguageDefines($defineList);
        }
    }
}
