<?php
/**
 * @package Installer
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: main_template_vars.php 3 2015-12-26 21:49:16Z webchills $
 */

$body_code = DIR_WS_INSTALL_TEMPLATE . 'templates/' . $current_page . '_default.php';
$body_id = str_replace('_', '', $_GET['main_page']);
