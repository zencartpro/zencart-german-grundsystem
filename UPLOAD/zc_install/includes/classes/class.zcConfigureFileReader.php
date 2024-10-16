<?php
/**
 * file contains zcConfigureFileReader Class
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: class.zcConfigureFileReader.php 2024-02-02 13:21:53Z webchills $
 */
/**
 *
 * zcConfigureFileReader Class
 *
 */
class zcConfigureFileReader
{
    /**
     * The cached contents of the configuration file.
     */
    protected ?string $fileContent;

    /**
     * Constructs a reader for Zen Cart configuration files.
     *
     * @param string|null $file the full path of the configuration file.
     */
    public function __construct(protected ?string $file = null)
    {
        $this->setFile($file);
    }

    /**
     * Sets the configuration file this reader will operate upon.
     * Calling this function will reset the file contents cache.
     *
     * @param string|null $file the full path of the configuration file.
     */
    public function setFile(?string $file = null): static
    {
        // Reset the cached file and contents
        $this->file = null;
        $this->fileContent = null;

        if ($file !== null) {
            $realfile = realpath($file);
            if (file_exists($realfile)) {
                $this->file = $realfile;
                $content = @file_get_contents($realfile);
                if ($content !== false && trim($content) !== '') {
                    $this->fileContent = $content;
                }
            }
        }

        return $this;
    }

    /**
     * Indicates if the configuration file exists.
     *
     * @return boolean true of the configuration file exists, false otherwise.
     */
    public function fileExists(): bool
    {
        return $this->file !== null;
    }

    /**
     * Retrieves the value of a configured constant from the configure file
     * without loading all the define statements. The value of the defined
     * constant will be evaluated and cached in memory. The memory cache will
     * not be reset until the PHP script has finished running.
     *
     * This method takes into consideration the script is being run from the
     * Zen Cart installer and will replace some constants prior to evaluating
     * the defined constant.
     *
     * @param string $searchDefine the name / key of the constant to search for.
     * @return mixed|NULL the value of the constant or null of the constant was not found.
     */
    public function getDefine(string $searchDefine): mixed
    {
        // If we have already retrieved this key, simply return the answer.
        if (defined('TMP_' . $this->file . '_' . $searchDefine)) {
            return constant('TMP_' . $this->file . '_' . $searchDefine);
        }

        // Validate the file exists (and content is useable)
        $define = $this->getRawDefine($searchDefine);
        if ($define !== null) {
            // This replaces DIR_FS_CATALOG with DIR_FS_ROOT so filesystem
            // based defines are correctly evaluated from the installer.
            $define = str_replace('DIR_FS_CATALOG', 'DIR_FS_ROOT', $define);

            // This code is already executing from the file when loaded
            // So using eval the same as the configure.php file being loaded
            // does not add any additional degree of risk / danger.
            $define = 'define(\'' . 'TMP_' . $this->file . '_' . $searchDefine . '\',' . $define . ');';
            eval("$define");
            if (defined('TMP_' . $this->file . '_' . $searchDefine)) {
                return constant('TMP_' . $this->file . '_' . $searchDefine);
            }
        }

        return null;
    }

    /**
     * Retrieves the raw value of a configured constant from the configure file.
     * This method does not evaluate or cache the defined value.
     *
     * @param string $searchDefine the name / key of the constant to search for.
     * @return NULL|string the value of the constant or null of the constant was not found.
     */
    public function getRawDefine(string $searchDefine): ?string
    {
        // Validate the file exists (and content is useable)
        if (!$this->fileLoaded()) {
            return null;
        }

        // Extract the contents of the define
        if (preg_match('|^\s*define\(\s*[\'"]' . $searchDefine . '[\'"]\s*,\s*(?!\s*\);)(.+?)\s*\);|m', $this->fileContent, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * Indicates that the configuration file could be loaded into memory.
     *
     * @return boolean true if the configuration file could be loaded, false otherwise.
     */
    public function fileLoaded(): bool
    {
        return $this->fileContent !== null;
    }

    public function getStoreInputsFromLegacy(): array
    {
        $mapper = [
            'HTTP_SERVER' => 'http_server_catalog',
            'HTTPS_SERVER' => 'https_server_catalog',
            'ENABLE_SSL' => 'enable_ssl_catalog',
            'DIR_WS_CATALOG' => 'dir_ws_http_catalog',
            'DIR_WS_HTTPS_CATALOG' => 'dir_ws_https_catalog',
            'DIR_FS_CATALOG' => 'physical_path',
            'DB_TYPE' => 'db_type',
            'DB_PREFIX' => 'db_prefix',
            'DB_CHARSET' => 'db_charset',
            'DB_SERVER' => 'db_host',
            'DB_SERVER_USERNAME' => 'db_user',
            'DB_SERVER_PASSWORD' => 'db_password',
            'DB_DATABASE' => 'db_name',
            'SQL_CACHE_METHOD' => 'sql_cache_method',
        ];
        return $this->processConfigureInputsMapper($mapper);
    }

    protected function processConfigureInputsMapper($mapper): array
    {
        $inputs = [];
        foreach ($mapper as $defineKey => $inputsKey) {
            $value = $this->getRawDefine($defineKey);
            $value = trim($value, "'");
            $inputs[$inputsKey] = $value;
        }
        return $inputs;
    }
}
