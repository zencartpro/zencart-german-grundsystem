<?php
/**
 * @package admin
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_languages.php 6027 2007-03-21 09:11:58Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// set the language
  if (!$_SESSION['language'] || isset($_GET['language'])) {

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && zen_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->get_browser_language();
      $lng->set_language(DEFAULT_LANGUAGE);
    }

    $_SESSION['language'] = (zen_not_null($lng->language['directory']) ? $lng->language['directory'] : 'english');
    $_SESSION['languages_id'] = (zen_not_null($lng->language['id']) ? $lng->language['id'] : 1);
    $_SESSION['languages_code'] = (zen_not_null($lng->language['code']) ? $lng->language['code'] : 'en');
  }

// include the language translations
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');
  $current_page = basename($PHP_SELF);
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $current_page)) {
    include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $current_page);
  }

  if ($za_dir = @dir(DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions')) {
    while ($zv_file = $za_dir->read()) {
      if (strstr($zv_file, '.php')) {
        require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/extra_definitions/' . $zv_file);
      }
    }
    $za_dir->close();
  }
?>