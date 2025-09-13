<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ScriptedInstaller.php for newer plugins 2025-09-12 13:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

use queryFactory;

class ScriptedInstaller
{
    use ScriptedInstallHelpers;

    // Extended classes can access these variables to understand what version/etc they are operating on.
    protected string $pluginDir;
    protected string $pluginKey;
    protected string $version;
    protected ?string $oldVersion; // null if not in upgrade mode

    public function __construct(protected queryFactory $dbConn, protected PluginErrorContainer $errorContainer)
    {
    }

    /***** THESE ARE THE 3 METHODS FOR IMPLEMENTATION IN EXTENDED CLASSES *********/
    /***** There is no need to implement any other methods in extended classes ****/

    /**
     * @return bool
     */
    protected function executeInstall()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function executeUninstall()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function executeUpgrade($oldVersion)
    {
        return true;
    }

    /******** Internal methods ***********/
    public function setVersionDetails(array $versionDetails): void
    {
        $this->pluginKey = $versionDetails['pluginKey'];
        $this->pluginDir = $versionDetails['pluginDir'];
        $this->version = $versionDetails['version'];
        $this->oldVersion = $versionDetails['oldVersion'];
    }

    public function doInstall(): ?bool
    {
        $installed = $this->executeInstall();
        return $installed;
    }

    public function doUninstall(): ?bool
    {
        $uninstalled = $this->executeUninstall();
        $this->uninstallZenCoreDbFields();
        return $uninstalled;
    }

    public function doUpgrade($oldVersion): ?bool
    {
        $upgraded = $this->executeUpgrade($oldVersion);
        $this->updateZenCoreDbFields($oldVersion);
        return $upgraded;
    }

    protected function executeInstallerSql($sql): bool
    {
        $this->dbConn->dieOnErrors = false;
        $this->dbConn->Execute($sql);
        if ($this->dbConn->error_number !== 0) {
            $this->errorContainer->addError(0, $this->dbConn->error_text, true, PLUGIN_INSTALL_SQL_FAILURE);
            return false;
        }
        $this->dbConn->dieOnErrors = true;
        return true;
    }
}
