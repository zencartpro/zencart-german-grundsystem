<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ScriptedInstaller.php 2023-10-23 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

class ScriptedInstaller
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

    public function __construct($dbConn, $errorContainer)
    {
        $this->dbConn = $dbConn;
        $this->errorContainer = $errorContainer;
    }

    public function doInstall()
    {
        $installed = $this->executeInstall();
        return $installed;
    }

    public function doUninstall()
    {
        $uninstalled = $this->executeUninstall();
        return $uninstalled;
    }

    public function doUpgrade()
    {
        $upgraded = $this->executeUpgrade();
        return $upgraded;
    }

    protected function executeInstall()
    {
        return true;
    }

    protected function executeUninstall()
    {
        return true;
    }

    protected function executeUpgrade()
    {
        return true;
    }

    protected function executeInstallerSql($sql)
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
