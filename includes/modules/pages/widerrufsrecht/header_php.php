<?php
/**
 * Header code file for the widerrufsrecht page
 *
 * @package page
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 650 2010-09-26 09:01:28Z webchills $
 */

	$_SESSION['navigation']->remove_current_page();
	require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

	// include template specific file name defines
	$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_WIDERRUFSRECHT, 'false');
	$breadcrumb->add(NAVBAR_TITLE);
?>
