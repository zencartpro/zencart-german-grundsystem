<?php
/**
 * CSS/JS Loader - Minify
 *
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @author yellow1912 (RubikIntegration.com)
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_minify.php 2014-03-23 09:34:05 webchills $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require_once(DIR_FS_CATALOG . 'extras/plugins/riCjLoader/RiCjLoaderPlugin.php');
$RI_CJLoader = new RiCjLoaderPlugin();