<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: InstallerFactory.php for newer plugins 2025-09-12 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

use queryFactory;
use Zencart\Exceptions\PluginInstallerException;

/**
 * @since ZC v1.5.7
 */
class InstallerFactory
{
    public function __construct(protected queryFactory $dbConn, protected Installer $pluginInstaller, protected PluginErrorContainer $errorContainer)
    {
    }

    /**
     * @since ZC v1.5.7
     */
    public function make($plugin, $version)
    {
        $pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $plugin . '/';
        $versionDir = $pluginDir . $version . '/';

        if (!is_dir($pluginDir)) {
            throw new PluginInstallerException('NO PLUGIN DIRECTORY');
        }
        if (!is_dir($versionDir)) {
            throw new PluginInstallerException('NO PLUGIN VERSION DIRECTORY');
        }
        if (!file_exists($versionDir . 'manifest.php')) {
            throw new PluginInstallerException('NO VERSION MANIFEST');
        }

        if (!file_exists($versionDir . 'Installer/Installer.php')) {
            $installer = new BasePluginInstaller($this->dbConn, $this->pluginInstaller, $this->errorContainer);
            return $installer;
        }

        require_once $versionDir . 'Installer/Installer.php';
        $installer = new \Installer($this->dbConn, $this->pluginInstaller, $this->errorContainer);
        return $installer;
    }
}
