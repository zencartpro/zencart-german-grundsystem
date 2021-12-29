<?php
/**
 * CSS/JS Loader - Minify
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @author yellow1912 (RubikIntegration.com)
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: init_minify.php 2014-03-23 09:34:05 webchills $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require_once(DIR_FS_CATALOG . 'extras/plugins/riCjLoader/RiCjLoaderPlugin.php');
$RI_CJLoader = new RiCjLoaderPlugin();