<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_templates.php 2023-10-29 16:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'functions_templates.php';

// Set theme related directories
if (!isset($template_dir) || $template_dir == '') {
  $template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . " where template_language in (" . (int)$_SESSION['languages_id'] . ', 0' . ") order by template_language DESC");
  $template_dir = $template_query->fields['template_dir'];
}
  define('DIR_WS_TEMPLATE', DIR_WS_TEMPLATES . $template_dir . '/');
  //  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_CATALOG_TEMPLATE . $template_dir . '/images/');
  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_CATALOG_TEMPLATE . 'template_default' . '/images/');
  define('DIR_WS_TEMPLATE_ICONS', DIR_WS_TEMPLATE_IMAGES . 'icons/');

  require(DIR_FS_CATALOG . DIR_WS_CLASSES . 'template_func.php');
  $template = new template_func(DIR_WS_TEMPLATE);

/**
 * send the content charset "now" so that all content is impacted by it - this is important for non-english sites
 */
  header("Content-Type: text/html; charset=" . CHARSET);

/**
 * set HTML <title> tag for admin pages
 */
$pagename = '';
if ($pagename == '') {
  $pagename = preg_replace('/\.php$/', '', basename($PHP_SELF));
}
if ($pagename == 'configuration') {
  $pagename .= " ". zen_get_configuration_group_value($_GET['gID']);
}
$pagename = str_replace('_', ' ', $pagename);
if ($pagename == 'index') $pagename = HEADER_TITLE_TOP; // Admin home page/dashboard
$pagename = ucwords($pagename);
if ($pagename == '') {
  $pagename = STORE_NAME;
}
$title = TEXT_ADMIN_TAB_PREFIX . ' ' . $pagename;
zen_define_default('TITLE', $title);
