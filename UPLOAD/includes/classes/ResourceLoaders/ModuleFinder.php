<?php
/** 
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ModuleFinder.php for newer plugins 2025-09-12 16:11:24Z webchills $
 */
namespace Zencart\ResourceLoaders;


use Zencart\FileSystem\FileSystem;

class ModuleFinder
{
    private FileSystem $filesystem;

    private string $moduleDir;

    public function __construct(string $moduleType, FileSystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->moduleDir = "$moduleType/";
    }

    // -----
    // Locate all modules of the type specified during the class construction,
    // noting that any duplication in zc_plugins **overrides** any base module!
    //
    public function findFromFilesystem(array $installedPlugins): array
    {
        $modules = [];

        $baseDir = DIR_WS_MODULES . $this->moduleDir;
        $files = $this->filesystem->listFilesFromDirectoryAlphaSorted(DIR_FS_CATALOG . $baseDir);
        foreach ($files as $file) {
            $modules[$file] = $baseDir;
        }

        foreach ($installedPlugins as $plugin) {
            $pluginDir = 'zc_plugins/' . $plugin['unique_key'] . '/' . $plugin['version'] . '/catalog/includes/modules/' . $this->moduleDir;
            $files = $this->filesystem->listFilesFromDirectoryAlphaSorted(DIR_FS_CATALOG . $pluginDir);
            foreach ($files as $file) {
                $modules[$file] = $pluginDir;
            }
        }
        return $modules;
    }
}
