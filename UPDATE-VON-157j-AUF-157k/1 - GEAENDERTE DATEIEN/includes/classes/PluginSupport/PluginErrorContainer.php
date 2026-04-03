<?php
/**
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: PluginErrorContainer.php for newer plugins 2025-09-12 15:54:16Z webchills $
 */

namespace Zencart\PluginSupport;

/**
 * @since ZC v1.5.7
 */
class PluginErrorContainer
{

    /**
     * $logger "null" the logger to use.
     * @var object
     */
    protected $logger;
    /**
     * $logErrors is an array of error messages
     */
    protected array $logErrors = [];
    /**
     * $friendlyErrors is a subset of $logErrors that have a friendly message (a known error with additional information)
     */
    protected array $friendlyErrors = [];

    public function __construct($logger = null)
    {
        $this->logger = $logger;
        $this->logErrors = [];
        $this->friendlyErrors = [];
    }

    /**
     * @since ZC v1.5.7
     */
    public function hasLogErrors()
    {
        return (count($this->logErrors));
    }

    /**
     * @since ZC v1.5.7
     */
    public function hasFriendlyErrors()
    {
        return (count($this->friendlyErrors));
    }

    /**
     * @since ZC v1.5.7
     */
    public function addError($logSeverity, $logMessage, $useLogMessageForFriendly = false, $friendlyMessage = '')
    {
        if ($useLogMessageForFriendly) {
            $friendlyMessage = $logMessage;
        }
        $this->logErrors[] = $logMessage;
        if ($friendlyMessage === '') return;
        $friendlyHash = hash('md5', $friendlyMessage);
        $this->friendlyErrors[$friendlyHash] = $friendlyMessage;
        if ($this->logger) {
            // do something here for external logging;
        }
    }

    /**
     * @since ZC v1.5.7
     */
    public function hasErrors()
    {
        return (count($this->logErrors + $this->friendlyErrors));
    }

    /**
     * @since ZC v1.5.7
     */
    public function getFriendlyErrors()
    {
        return $this->friendlyErrors;
    }

    /**
     * @since ZC v1.5.7
     */
    public function getLogErrors()
    {
        return $this->logErrors;
    }
}
