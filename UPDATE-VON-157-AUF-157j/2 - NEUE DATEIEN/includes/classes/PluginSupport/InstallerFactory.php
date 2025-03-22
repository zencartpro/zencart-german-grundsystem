<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: InstallerFactory.php 2023-10-23 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

use Zencart\Exceptions\PluginInstallerException;

class InstallerFactory
{

    /**
     * $dbConn is a database object 
     * @var object
     */
    protected $dbConn;
    /**
     * $errorContainer is a PluginErrorContainer object
     * @var object
     */
    protected $errorContainer;
    /**
     * $errorContainer is a pluginInstaller object
     * @var object
     */
    protected $pluginInstaller;

    public function __construct($dbConn, $pluginInstaller, $errorContainer)
    {
        $this->dbConn = $dbConn;
        $this->pluginInstaller = $pluginInstaller;
        $this->errorContainer = $errorContainer;
    }

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
        if (!file_exists($versionDir . 'installer/' . 'Installer.php')) {
            $installer = new BasePluginInstaller($this->dbConn, $this->pluginInstaller, $this->errorContainer);
            return $installer;
        }
        require_once($versionDir . 'Installer');
        $installer = new Installer($this->dbConn, $this->pluginInstaller, $this->errorContainer);
        return $installer;
    }
}
