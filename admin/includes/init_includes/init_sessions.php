<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sessions.php 15831 2010-04-05 16:38:55Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// define how the session functions will be used
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php');

//  if (SESSION_USE_FQDN == 'False') $current_domain = '.' . $current_domain;
  zen_session_name('zenAdminID');
  zen_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
//   if (function_exists('session_set_cookie_params')) {
$path = dirname($_SERVER['SCRIPT_NAME']);
session_set_cookie_params(0, $path, (zen_not_null($current_domain) ? '.' . $current_domain : ''));
//  } elseif (function_exists('ini_set')) {
//    @ini_set('session.cookie_lifetime', '0');
//    @ini_set('session.cookie_path', DIR_WS_ADMIN);
//  }
// lets start our session
  zen_session_start();
  $session_started = true;

if (! isset ( $_SESSION ['securityToken'] ))
{
  $_SESSION ['securityToken'] = md5 ( uniqid ( rand (), true ) );
}
if (isset ( $_GET ['action'] ) && in_array ( $_GET ['action'], array ('save', 'layout_save', 'update', 'update_sort_order', 'update_confirm', 'copyconfirm', 'deleteconfirm', 'insert', 'move_category_confirm', 'delete_category_confirm', 'update_category_meta_tags', 'insert_category' ) ))
{
  if (strpos ( $PHP_SELF, FILENAME_PRODUCTS_PRICE_MANAGER ) === FALSE && strpos ( $PHP_SELF, FILENAME_PRODUCTS_OPTIONS_NAME ) === FALSE && (strpos( $PHP_SELF, FILENAME_CURRENCIES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_LANGUAGES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_SPECIALS ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_FEATURED ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_SALEMAKER ) === FALSE))
  {
    if ((! isset ( $_SESSION ['securityToken'] ) || ! isset ( $_POST ['securityToken'] )) || ($_SESSION ['securityToken'] !== $_POST ['securityToken']))
    {
      zen_redirect ( zen_href_link ( FILENAME_DEFAULT, '', 'SSL' ) );
    }
  }
}
