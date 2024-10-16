<?php
/**
 * Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
 * Common Template main_template_vars handler
 *
 * Normally a page will automatically load its own template based on the page name.
 * so that a page called some_page will load tpl_some_page_default.php from the template directory.
 * 
 * However sometimes a page may need to choose the template it displays based on a set of criteria.
 * Placing a file in the includes/modules/pages/some_page/ directory called main_template_vars.php
 * allows you to override this page and choose the template that loads.
 *

 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: main_template_vars 2023-10-25 19:18:58Z webchills $
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_START', $template_dir);

/**
 * set some variables used by templates
 */
  if (!isset($layoutType)) $layoutType = 'legacy';
  if (!isset($max_display_page_links)) $max_display_page_links = ($layoutType == 'mobile' ? MAX_DISPLAY_PAGE_LINKS_MOBILE : MAX_DISPLAY_PAGE_LINKS);
  if (!isset($paginateAsUL)) $paginateAsUL = $layoutType == 'mobile' || (isset($isMobile) && $isMobile) || (isset($isTablet) && $isTablet);
  if (!isset($flag_disable_left)) {
    $flag_disable_left = false;
  }
  if (!isset($flag_disable_right)) {
    $flag_disable_right = false;
  }

  if (!class_exists('MobileDetect')) {
    include_once(DIR_WS_CLASSES . 'vendors/MobileDetect/MobileDetect.php');
  }
  if (!isset($detect)) $detect = new \Detection\MobileDetect;
  if (!isset($_SESSION['layoutType'])) $_SESSION['layoutType'] = 'legacy';

  $display_as_mobile = ($detect->isMobile() || $detect->isTablet() || $_SESSION['layoutType'] == 'mobile' || $_SESSION['layoutType'] == 'tablet');

/**
 * load page-specific main_template_vars if present, or jump directly to template file
 */
  $body_code = $pageLoader->getBodyCode();

  $zco_notifier->notify('NOTIFY_MAIN_TEMPLATE_VARS_END', $template_dir, $body_code);
