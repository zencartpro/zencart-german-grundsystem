<?php
/**
 * loads template specific language override files
 *
 * @package initSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: require_languages.php 731 2019-06-15 21:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
//require(DIR_WS_LANGUAGES . $template_dir_select . $_SESSION['language'] . '.php');
//if (!zen_not_null($template_dir_select)) require(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');

// determine language or template language file
if (file_exists($language_page_directory . $template_dir . '/' . $current_page_base . '.php')) {
  $template_dir_select = $template_dir . '/';
} else {
  $template_dir_select = '';
}

// set language or template language file
$directory_array = $template->get_template_part($language_page_directory . $template_dir_select, '/^'.$current_page_base . '/');
foreach($directory_array as $key => $value) {
  require_once($language_page_directory . $template_dir_select . $value);
}

// load master language file(s) if lang files loaded previously were "overrides" and not masters.
if ($template_dir_select != '') {
  $directory_array = $template->get_template_part($language_page_directory, '/^'.$current_page_base . '/');
  foreach($directory_array as $key => $value) {
    require_once($language_page_directory . $value);
  }
}
