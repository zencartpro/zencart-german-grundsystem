<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: Installer.php 2023-10-23 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

class Installer
{

    /**
     * $errorContainer is a PluginErrorContainer object
     * @var object
     */
    protected $errorContainer;
    /**
     * $errorContainer is a patchInstaller object
     * @var object
     */
    protected $patchInstaller;
    /**
     * $errorContainer is a scriptedInstallerFactory object
     * @var object
     */
    protected $scriptedInstallerFactory;

    public function __construct($patchInstaller, $scriptedInstallerFactory, $errorContainer)
    {
        $this->patchInstaller = $patchInstaller;
        $this->scriptedInstallerFactory = $scriptedInstallerFactory;
        $this->errorContainer = $errorContainer;
    }

    public function executeInstallers($pluginDir)
    {
        $this->executePatchInstaller($pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return;
        }
        $this->executeScriptedInstaller($pluginDir);
    }

    public function executeUninstallers($pluginDir)
    {
        $this->executePatchUninstaller($pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return;
        }
        $this->executeScriptedUninstaller($pluginDir);
    }

    public function executeUpgraders($pluginDir, $oldVersion)
    {
        $this->executeScriptedUpgrader($pluginDir, $oldVersion);
    }

    protected function executePatchInstaller($pluginDir)
    {
        $patchFile = 'install.sql';
        $this->executePatchFile($pluginDir, $patchFile);
   }

    protected function executePatchUninstaller($pluginDir)
    {
        $patchFile = 'uninstall.sql';
        $this->executePatchFile($pluginDir, $patchFile);
    }

    protected function executePatchFile($pluginDir, $patchFile)
    {
        if (!file_exists($pluginDir . '/Installer/' . $patchFile)) {
            return;
        }
        $lines = file($pluginDir . '/Installer/' . $patchFile);
        $paramLines = $this->patchInstaller->parse($lines);
        if ($this->errorContainer->hasErrors()) {
            return;
        }
        $this->patchInstaller->executePatchSql($paramLines);

    }

    protected function executeScriptedInstaller($pluginDir)
    {
        if (!file_exists($pluginDir . '/Installer/ScriptedInstaller.php')) {
            return;
        }
        $scriptedInstaller = $this->scriptedInstallerFactory->make($pluginDir);
        $scriptedInstaller->doInstall();
    }

    protected function executeScriptedUninstaller($pluginDir)
    {
        if (!file_exists($pluginDir . '/Installer/ScriptedInstaller.php')) {
            return;
        }
        $scriptedInstaller = $this->scriptedInstallerFactory->make($pluginDir);
        $scriptedInstaller->doUninstall();
    }

    protected function executeScriptedUpgrader($pluginDir, $oldVersion)
    {
        if (!file_exists($pluginDir . '/Installer/ScriptedInstaller.php')) {
            return;
        }
        $scriptedInstaller = $this->scriptedInstallerFactory->make($pluginDir);
        $scriptedInstaller->doUpgrade($oldVersion);
    }

    public function getErrorContainer()
    {
        return $this->errorContainer;
    }
}
