<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_languages.php 2023-10-23 14:22:16Z webchills $
 */
use Zencart\LanguageLoader\LanguageLoaderFactory;

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// set the language
  if (!isset($_SESSION['language']) || isset($_GET['language'])) {

    include(DIR_FS_CATALOG . DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && !empty($_GET['language'])) {
      $lng->set_language($_GET['language']);
      $zco_notifier->notify('NOTIFY_LANGUAGE_CHANGE_REQUESTED_BY_ADMIN_VISITOR', $_GET['language'], $lng);
    } else {
      $lng->get_browser_language();
      $lng->set_language(DEFAULT_LANGUAGE);
    }

    if (!is_file(DIR_WS_LANGUAGES . $lng->language['directory'] . '.php')) {
      $lng->set_language('de');
    }

    $_SESSION['language'] = (!empty($lng->language['directory']) ? $lng->language['directory'] : 'german');
    $_SESSION['languages_id'] = (!empty($lng->language['id']) ? (int)$lng->language['id'] : 43);
    $_SESSION['languages_code'] = (!empty($lng->language['code']) ? $lng->language['code'] : 'de');
  }

// temporary patch for lang override chicken/egg quirk
  $template_query = $db->Execute("SELECT template_dir
                                  FROM " . TABLE_TEMPLATE_SELECT . "
                                  WHERE template_language in (" . (int)$_SESSION['languages_id'] . ', 0' . ")
                                  ORDER BY template_language DESC");
  $template_dir = $template_query->fields['template_dir'];

// include the language translations
$current_page = ($PHP_SELF == 'home.php') ? 'index.php' : $PHP_SELF;
$languageLoaderFactory = new LanguageLoaderFactory();
$languageLoader = $languageLoaderFactory->make('admin', $installedPlugins, $current_page, $template_dir);
$languageLoader->loadInitialLanguageDefines();
$languageLoader->finalizeLanguageDefines();
