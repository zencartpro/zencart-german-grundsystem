<?php
/**
 * @package  Instant Search Plugin for Zen Cart German
 * @author   marco-pm
 * @version  4.0.3
 * @see      https://github.com/marco-pm/zencart_instantsearch
 * @license  GNU Public License V2.0
 * modified for Zen Cart German
 * 2024-04-05 webchills
 */

declare(strict_types=1);

namespace Zencart\Plugins\Catalog\InstantSearch;

use Exception;

class InstantSearchLogger
{
    /**
     * @var string
     */
    protected string $logName;

    /**
     * @param string $logName
     */
    public function __construct(string $logName)
    {
        $this->logName = $logName;
    }

    /**
     * Writes a log message to the Instant Search error log.
     *
     * @param string $message
     * @param Exception|null $e
     * @return void
     */
    public function writeErrorLog(string $message, Exception $e = null): void
    {
        $fullLogName = DIR_FS_LOGS . "/" . $this->logName . "-error-" . date('Y-m-d') . ".log";
        $logLine = date('Y-m-d H:i:s') . " [ERROR] $message" . PHP_EOL;
        if ($e !== null) {
            $logLine .= $e->getMessage() . PHP_EOL;
            $logLine .= $e->getTraceAsString() . PHP_EOL;
        }
        if ($e->getPrevious() !== null) {
            $logLine .= $e->getPrevious()->getMessage() . PHP_EOL;
            $logLine .= $e->getPrevious()->getTraceAsString() . PHP_EOL;
        }
        error_log($logLine, 3, $fullLogName);
    }

    /**
     * Writes a log message to the Instant Search debug log.
     *
     * @param string $message
     * @return void
     */
    public function writeDebugLog(string $message): void
    {
        $fullLogName = DIR_FS_LOGS . "/" . $this->logName . "-debug-" . date('Y-m-d') . ".log";
        $logLine = date('Y-m-d H:i:s') . " [DEBUG] $message" . PHP_EOL;
        error_log($logLine, 3, $fullLogName);
    }
}
