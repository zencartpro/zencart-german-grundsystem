<?php
/**
 * Zen Cart German Specific (210 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: LanguageLoaderFactory.php 2025-10-29 14:27:24Z webchills $
 */
namespace Zencart\LanguageLoader;

use Zencart\LanguageLoader\LanguageLoader;

/**
 * @since ZC v1.5.8
 */
class LanguageLoaderFactory
{
    /**
     * @since ZC v1.5.8
     */
    public function make(string $context, array $installedPlugins, string $currentPage, string $templateDirectory, string $fallback = 'german'): \Zencart\LanguageLoader\LanguageLoader
    {
        $arraysLoader = $this->makeArraysLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback);
        $filesLoader = $this->makeFilesLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback);
        $mainLoader = new LanguageLoader($arraysLoader, $filesLoader);
        return $mainLoader;
    }

    /**
     * @since ZC v1.5.8
     */
    protected function makeArraysLoader(string $context, array $installedPlugins, string $currentPage, string $templateDirectory, string $fallback)
    {
        $className = 'Zencart\\LanguageLoader\\' . ucfirst(strtolower($context)) . 'ArraysLanguageLoader';
        $loader = new $className($installedPlugins, $currentPage, $templateDirectory, $fallback);
        return $loader;
    }

    /**
     * @since ZC v1.5.8
     */
    protected function makeFilesLoader(string $context, array $installedPlugins, string $currentPage, string $templateDirectory, string $fallback)
    {
        $className = 'Zencart\\LanguageLoader\\' . ucfirst(strtolower($context)) . 'FilesLanguageLoader';
        $loader = new $className($installedPlugins, $currentPage, $templateDirectory, $fallback);
        return $loader;
    }
}
