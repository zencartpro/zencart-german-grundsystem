<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ScriptedInstallerFactory.php for newer plugins 2025-10-30 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

use queryFactory;

/**
 * @since ZC v1.5.7
 */
class ScriptedInstallerFactory
{
    public function __construct(protected queryFactory $dbConn, protected PluginErrorContainer $errorContainer)
    {
    }

    /**
     * @since ZC v1.5.7
     */
    public function make($pluginDir): ScriptedInstaller
    {
        require_once $pluginDir . '/Installer/ScriptedInstaller.php';
        $scriptedInstaller = new \ScriptedInstaller($this->dbConn, $this->errorContainer);
        return $scriptedInstaller;
    }
}
