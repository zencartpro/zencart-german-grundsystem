<?php
/**
 * ajax front controller (admin version)
 *
 * NOTE: "Assumes" that the admin directory is a direct subdirectory off the store's file-system!
 *
 * @package core
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: ajax.php 2021-11-29 19:59:16Z webchills $

 */
// -----
// Let the "base" ajax.php processing "know" that this request came from the admin,
// so that the admin version of the application_top.php processing will be loaded.
//
$zc_ajax_base_dir = basename(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
require '../ajax.php';
