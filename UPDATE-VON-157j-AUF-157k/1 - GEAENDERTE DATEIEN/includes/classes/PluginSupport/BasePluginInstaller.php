<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: BasePluginInstaller.php for newer plugins 2025-09-12 13:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

use queryFactory;
use Zencart\PluginSupport\PluginStatus;

/**
 * @since ZC v1.5.7
 */
class BasePluginInstaller
{
    /**
     * $pluginDir is the directory where the plugin is located
     * @var string
     */
    protected string $pluginDir;

    public function __construct(protected queryFactory $dbConn, protected Installer $pluginInstaller, protected PluginErrorContainer $errorContainer)
    {
    }

    /**
     * @since ZC v1.5.7
     */
    public function processInstall($pluginKey, $version): bool
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->pluginInstaller->setVersions($this->pluginDir, $pluginKey, $version);
        $this->pluginInstaller->executeInstallers($this->pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        $this->setPluginVersionStatus($pluginKey, $version, PluginStatus::ENABLED);
        return true;
    }

    /**
     * @since ZC v1.5.7
     */
    public function processUninstall($pluginKey, $version): bool
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->setPluginVersionStatus($pluginKey, '', PluginStatus::NOT_INSTALLED);
        $this->pluginInstaller->setVersions($this->pluginDir, $pluginKey, $version);
        $this->pluginInstaller->executeUninstallers($this->pluginDir);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        return true;
    }

    /**
     * @since ZC v1.5.8
     */
    public function processUpgrade($pluginKey, $version, $oldVersion): bool
    {
        $this->pluginDir = DIR_FS_CATALOG . 'zc_plugins/' . $pluginKey . '/' . $version;
        $this->loadInstallerLanguageFile('main.php', $this->pluginDir);
        $this->pluginInstaller->setVersions($this->pluginDir, $pluginKey, $version, $oldVersion);
        $this->pluginInstaller->executeUpgraders($this->pluginDir, $oldVersion);
        if ($this->errorContainer->hasErrors()) {
            return false;
        }
        $this->setPluginVersionStatus($pluginKey, $oldVersion, PluginStatus::NOT_INSTALLED);
        $this->setPluginVersionStatus($pluginKey, $version, PluginStatus::ENABLED);
        return true;
    }

    /**
     * @since ZC v1.5.7
     */
    public function processDisable($pluginKey, $version): void
    {
        $this->setPluginVersionStatus($pluginKey, $version, PluginStatus::DISABLED);
    }

    /**
     * @since ZC v1.5.7
     */
    public function processEnable($pluginKey, $version): void
    {
        $this->setPluginVersionStatus($pluginKey, $version, PluginStatus::ENABLED);
    }

    /**
     * @since ZC v1.5.7
     */
    protected function setPluginVersionStatus($pluginKey, $version, $status): void
    {
        $sql = "UPDATE " . TABLE_PLUGIN_CONTROL . " SET status = :status:, version = :version: WHERE unique_key = :uniqueKey:";
        $sql = $this->dbConn->bindVars($sql, ':status:', $status, 'integer');
        $sql = $this->dbConn->bindVars($sql, ':uniqueKey:', $pluginKey, 'string');
        $sql = $this->dbConn->bindVars($sql, ':version:', $version, 'string');
        $this->dbConn->execute($sql);
    }

    /**
     * Loads the "main.php" language file. This handles "defines" for language-strings. It does NOT handle language-arrays.
     * @since ZC v1.5.7
     */
    protected function loadInstallerLanguageFile(string $file): void
    {
        $lng = $_SESSION['language'];
        $filename = $this->pluginDir . '/Installer/languages/' . $lng . '/' . $file;
        if (file_exists($filename)) {
            require_once $filename;
            return;
        }

        if ($lng === 'german') {
            return;
        }

        $filename = $this->pluginDir . '/Installer/languages/german/' . $file;
        if (file_exists($filename)) {
            require_once $filename;
        }
    }

    /**
     * @since ZC v1.5.8a
     */
    public function getErrorContainer(): PluginErrorContainer
    {
        return $this->errorContainer;
    }
}
