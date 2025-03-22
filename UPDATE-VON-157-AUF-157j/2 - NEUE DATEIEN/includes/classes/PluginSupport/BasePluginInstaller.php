<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: BasePluginInstaller.php 2023-10-23 08:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

class BasePluginInstaller
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
    /**
     * $pluginDir is the directory where the plugin is located
     * @var string
     */
    protected $pluginDir;

    public function __construct($dbConn, $pluginInstaller, $errorContainer)
    {
        $this->dbConn = $dbConn;
        $this->pluginInstaller = $pluginInstaller;
        $this->errorContainer = $errorContainer;
    }

    public function processInstall($pluginKey, $version)
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->pluginInstaller->executeInstallers($this->pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        $this->setPluginVersionStatus($pluginKey, $version, 1);
        return true;
    }

    public function processUninstall($pluginKey, $version)
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->setPluginVersionStatus($pluginKey, '', 0);
        $this->pluginInstaller->executeUninstallers($this->pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        return true;
    }

    public function processUpgrade($pluginKey, $version, $oldVersion)
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->pluginInstaller->executeUpgraders($this->pluginDir, $oldVersion);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        $this->setPluginVersionStatus($pluginKey, $oldVersion, 0);
        $this->setPluginVersionStatus($pluginKey, $version, 1);
        return true;
    }

    public function processDisable($pluginKey, $version)
    {
        $this->setPluginVersionStatus($pluginKey, $version, 2);
    }

    public function processEnable($pluginKey, $version)
    {
        $this->setPluginVersionStatus($pluginKey, $version, 1);
    }

    protected function setPluginVersionStatus($pluginKey, $version, $status)
    {
        $sql = "UPDATE " . TABLE_PLUGIN_CONTROL . " SET status = :status:, version = :version: WHERE unique_key = :uniqueKey:";
        $sql = $this->dbConn->bindVars($sql, ':status:', $status, 'integer');
        $sql = $this->dbConn->bindVars($sql, ':uniqueKey:', $pluginKey, 'string');
        $sql = $this->dbConn->bindVars($sql, ':version:', $version, 'string');
        $this->dbConn->execute($sql);
    }


    protected function loadInstallerLanguageFile($file)
    {
        $lng = $_SESSION['language'];
        $filename = $this->pluginDir . '/Installer/languages/' . $lng . '/' . $file;
        if (file_exists($filename)) {
            require_once($filename);
        }
    }

    public function getErrorContainer()
    {
        return $this->errorContainer;
    }
}
