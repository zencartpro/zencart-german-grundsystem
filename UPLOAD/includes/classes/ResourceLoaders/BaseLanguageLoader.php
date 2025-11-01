<?php
/**
 * Zen Cart German Specific (210 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: BaseLanguageLoader.php for newer plugins 2025-10-30 15:27:24Z webchills $
 */
namespace Zencart\LanguageLoader;

use Zencart\FileSystem\FileSystem;

/**
 * @since ZC v1.5.8
 */
class BaseLanguageLoader
{
    protected string $fallback;
    protected \Zencart\FileSystem\FileSystem $fileSystem;
    protected array $languageDefines = [];
    protected array $pluginList;
    protected string $templateDir;
    protected string $zcPluginsDir;

    public string $currentPage;

    public function __construct(array $pluginList, string $currentPage, string $templateDir, string $fallback = 'german')
    {
        $this->pluginList = $pluginList;
        $this->currentPage = $currentPage;
        $this->fallback = $fallback;
        $this->fileSystem = new FileSystem();
        $this->templateDir = $templateDir;
        $this->zcPluginsDir = DIR_FS_CATALOG . 'zc_plugins/';
    }

    /**
     * @since ZC v2.2.0
     */
    public function getTemplateDir(): string
    {
        return $this->templateDir;
    }

    /**
     * @since ZC v2.2.0
     */
    public function getFallback(): string
    {
        return $this->fallback;
    }
}
