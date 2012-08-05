<?php
/**
 * if gzip_compression is enabled, start to buffer the output
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_gzip.php 729 2011-08-09 15:49:16Z hugo13 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if ($_GET['main_page'] != FILENAME_DOWNLOAD && GZIP_LEVEL == '1' && $ext_zlib_loaded = extension_loaded('zlib')) {
  if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
    @ini_set('zlib.output_compression', 1);
  }
  if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
    ob_start('ob_gzhandler');
  } else {
    @ini_set('zlib.output_compression_level', GZIP_LEVEL);
  }
}
