<?php
/**
 * template_func Class.
 * Zen Cart German Specific (210 code in 157)
 * @copyright Copyright 2003-2025 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: template_func.php for newer plugins 2025-09-16 13:02:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

/**
 * template_func Class.
 * This class is used to for template-override calculations
 *
 */
class template_func extends base
{
    public function get_template_part(string $page_directory, string $template_part, string $file_extension = '.php'): array
    {
        $pageLoader = Zencart\PageLoader\PageLoader::getInstance();
        return $pageLoader->getTemplatePart($page_directory, $template_part, $file_extension);
    }

    public function get_template_dir(string $template_code, string $current_template, string $current_page, string $template_dir): string
    {
        $pageLoader = Zencart\PageLoader\PageLoader::getInstance();
        return $pageLoader->getTemplateDirectory($template_code, $current_template, $current_page, $template_dir);
    }
}
