<?php
/**
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: PluginErrorContainer.php 2023-05-20 08:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

class PluginErrorContainer
{
    public function __construct($logger = null)
    {
        $this->logger = $logger;
        $this->logErrors = [];
        $this->friendlyErrors = [];
    }

    public function hasLogErrors()
    {
        return (count($this->logErrors));
    }

    public function hasFriendlyErrors()
    {
        return (count($this->friendlyErrors));
    }

    public function addError($logSeverity, $logMessage, $useLogMessageForFriendly = false, $friendlyMessage = '')
    {
        if ($useLogMessageForFriendly) {
            $friendlyMessage = $logMessage;
        }
        $this->logErrors[] = $logMessage;
        if ($friendlyMessage === '') return;
        $friendlyHash = md5($friendlyMessage);
        $this->friendlyErrors[$friendlyHash] = $friendlyMessage;
        if ($this->logger) {
            // do something here for external logging;
        }
    }

    public function hasErrors()
    {
        return (count($this->logErrors + $this->friendlyErrors));
    }

    public function getFriendlyErrors()
    {
        return $this->friendlyErrors;
    }

    public function getLogErrors()
    {
        return $this->logErrors;
    }
}