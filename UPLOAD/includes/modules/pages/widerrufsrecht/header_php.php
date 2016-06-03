<?php
/**
 * Header code file for the widerrufsrecht page
 *
 * @package page
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 651 2016-06-03 19:01:28Z webchills $
 */

	$_SESSION['navigation']->remove_current_page();
if (IT_RECHT_KANZLEI_STATUS == 'ja') { 
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_EZPAGE');

$sql = "select * from " . TABLE_EZPAGES . " where languages_id= '" . (int)$_SESSION['languages_id'] . "' and page_key = '" . IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF . "'";
$var_pageDetails = $db->Execute($sql);
// redirect to home page if page not found (or deactivated/deleted):
if ($var_pageDetails->EOF) {
  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $messageStack->add_session('header', ERROR_PAGE_NOT_FOUND, 'caution');
  header('HTTP/1.1 404 Not Found');
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
}
// set Page Title for heading, navigation, etc
define('NAVBAR_TITLE', $var_pageDetails->fields['pages_title']);
define('HEADING_TITLE', $var_pageDetails->fields['pages_title']);
$breadcrumb->add($var_pageDetails->fields['pages_title']);
// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_EZPAGE');
} else {
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
// include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_WIDERRUFSRECHT, 'false');
$breadcrumb->add(NAVBAR_TITLE);
} 