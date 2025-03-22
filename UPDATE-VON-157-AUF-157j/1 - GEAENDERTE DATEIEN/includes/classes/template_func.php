<?php
/**
 * template_func Class.
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: template_func.php 2023-10-25 20:02:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * template_func Class.
 * This class is used to for template-override calculations
 *
 */
class template_func extends base {

        private $info = [];
        
  function __construct($template_dir = 'default') {
    $this->info = [];
  }

  function get_template_part($page_directory, $template_part, $file_extension = '.php') {
      $pageLoader = Zencart\PageLoader\PageLoader::getInstance();
      $directory_array = $pageLoader->getTemplatePart($page_directory, $template_part, $file_extension);
      return $directory_array;
  }

  function get_template_dir($template_code, $current_template, $current_page, $template_dir, $debug=false) {
      $pageLoader = Zencart\PageLoader\PageLoader::getInstance();

      $path = $pageLoader->getTemplateDirectory($template_code, $current_template, $current_page, $template_dir);

      return $path;
  }

  function file_exists($file_dir, $file_pattern, $debug=false) {
    $file_found = false;
    $file_pattern = '/'.str_replace("/", "\/", $file_pattern).'$/';
    if ($mydir = @dir($file_dir)) {
      while ($file = $mydir->read()) {
        if (preg_match($file_pattern, $file)) {
          $file_found = true;
          break;
        }
      }
      $mydir->close();
    }
    return $file_found;
  }
}
