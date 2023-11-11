<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: LanguageLoaderFactory.php 2023-10-23 14:27:24Z webchills $
 */


namespace Zencart\LanguageLoader;

use Zencart\LanguageLoader\LanguageLoader;

class LanguageLoaderFactory
{

    public function make($context, $installedPlugins, $currentPage, $templateDirectory, $fallback = 'german')
    {
        $arraysLoader = $this->makeArraysLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback);
        $filesLoader = $this->makeFilesLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback);
        $mainLoader = new LanguageLoader($arraysLoader, $filesLoader);
        return $mainLoader;
    }

    protected function makeArraysLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback)
    {
        $className = 'Zencart\\LanguageLoader\\' . ucfirst(strtolower($context)) . 'ArraysLanguageLoader';
        $loader = new $className($installedPlugins, $currentPage, $templateDirectory, $fallback);
        return $loader;
    }

    protected function makeFilesLoader($context, $installedPlugins, $currentPage, $templateDirectory, $fallback)
    {
        $className = 'Zencart\\LanguageLoader\\' . ucfirst(strtolower($context)) . 'FilesLanguageLoader';
        $loader = new $className($installedPlugins, $currentPage, $templateDirectory, $fallback);
        return $loader;
    }

}