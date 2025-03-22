<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: BaseLanguageLoader.php 2023-10-23 15:27:24Z webchills $
 */

namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

class BaseLanguageLoader
{
    protected 
        $fallback,
        $fileSystem,
        $languageDefines = [],
        $pluginList,
        $templateDir;
    public
        $currentPage;

    public function __construct($pluginList, $currentPage, $templateDir, $fallback = 'german')
    {
        $this->pluginList = $pluginList;
        $this->languageDefines = [];
        $this->currentPage = $currentPage;
        $this->fallback = $fallback;
        $this->fileSystem = new FileSystem;
        $this->templateDir = $templateDir;
    }
}
