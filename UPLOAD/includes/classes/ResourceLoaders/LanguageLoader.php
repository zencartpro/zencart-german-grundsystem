<?php
/**
 * Zen Cart German Specific  
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: LanguageLoader.php 2021-12-26 13:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

class LanguageLoader
{

    public function __construct($currentPage)
    {
        
        $this->currentPage = $currentPage;
    }

    public function loadLanguageDefines()
    {
        $this->loadLanguageForView();
        $this->loadLanguageExtraDefinitions();
        $this->loadBaseLanguageFile();
    }   
   
    protected function loadLanguageForView()
    {
        if (is_file(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $this->currentPage)) {
            include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $this->currentPage);
        }
        
    }
    protected function loadLanguageExtraDefinitions()
    {
        $this->loadFilesFromDirectory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions', '~^[^\._].*\.php$~i');
        

    }

    protected function loadBaseLanguageFile()
    {
        require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
    }


////////// move below to filesystemclass ////////////////////

    public function loadFilesFromDirectory($rootDir, $fileRegx)
    {
        if (!$dir = @dir($rootDir)) return;
        while ($file = $dir->read()) {
            if (preg_match($fileRegx, $file) > 0) {
                require_once($rootDir . '/' . $file);
            }
        }
        $dir->close();
    }
}