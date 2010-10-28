<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sessions.php 18031 2010-10-23 21:30:12Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// require the session handling functions
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php');

  zen_session_name('zenAdminID');
  zen_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
$path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if (defined('SESSION_USE_ROOT_COOKIE_PATH') && SESSION_USE_ROOT_COOKIE_PATH  == 'True') $path = '/';
$path = (defined('CUSTOM_COOKIE_PATH')) ? CUSTOM_COOKIE_PATH : $path;
$domainPrefix = (!defined('SESSION_ADD_PERIOD_PREFIX') || SESSION_ADD_PERIOD_PREFIX == 'True') ? '.' : '';

if (PHP_VERSION >= '5.2.0') {
  session_set_cookie_params(0, $path, (zen_not_null($cookieDomain) ? $domainPrefix . $cookieDomain : ''), FALSE, TRUE);
} else {
  session_set_cookie_params(0, $path, (zen_not_null($cookieDomain) ? $domainPrefix . $cookieDomain : ''));
}

// lets start our session
  zen_session_start();
  $session_started = true;

if (! isset ( $_SESSION ['securityToken'] ))
{
  $_SESSION ['securityToken'] = md5 ( uniqid ( rand (), true ) );
}
if (isset ( $_GET ['action'] ) && in_array ( $_GET ['action'], array ('copy_options_values', 'update_options_values', 'update_value', 'add_product_option_values', 'copy_options_values_one_to_another_options_id', 'delete_options_values_of_option_name', 'copy_options_values_one_to_another', 'copy_categories_products_to_another_category_linked', 'remove_categories_products_to_another_category_linked', 'reset_categories_products_to_another_category_master', 'update_counter', 'update_orders_id', 'locate_configuration_key', 'locate_configuration', 'update_categories_attributes', 'update_product', 'locate_configuration', 'locate_function', 'locate_class', 'locate_template', 'locate_all_files', 'add_product', 'add_category', 'update_product_attribute', 'add_product_attributes', 'update_attributes_copy_to_category', 'update_attributes_copy_to_product', 'delete_option_name_values','delete_all_attributes', 'save', 'layout_save', 'update', 'update_sort_order', 'update_confirm', 'copyconfirm', 'deleteconfirm', 'insert', 'move_category_confirm', 'delete_category_confirm', 'update_category_meta_tags', 'insert_category' ) ))
{
  if (strpos ( $PHP_SELF, FILENAME_PRODUCTS_PRICE_MANAGER ) === FALSE && strpos ( $PHP_SELF, FILENAME_PRODUCTS_OPTIONS_NAME ) === FALSE && (strpos( $PHP_SELF, FILENAME_CURRENCIES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_LANGUAGES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_SPECIALS ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_FEATURED ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_SALEMAKER ) === FALSE))
  {
    if ((! isset ( $_SESSION ['securityToken'] ) || ! isset ( $_POST ['securityToken'] )) || ($_SESSION ['securityToken'] !== $_POST ['securityToken']))
    {
      zen_redirect ( zen_href_link ( FILENAME_DEFAULT, '', 'SSL' ) );
    }
  }
}
