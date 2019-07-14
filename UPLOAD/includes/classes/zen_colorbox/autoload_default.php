<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: autoload_default.php 1 2016-04-14 11:01:04 webchills $
 */
?>
jQuery(function($) {
	$("a[rel^='colorbox']").colorbox({<?php require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_colorbox/options.php'); ?>});;
  // Disable Colobox on main reviews page image
  $("#productMainImageReview a").removeAttr("rel");
});
//--></script>