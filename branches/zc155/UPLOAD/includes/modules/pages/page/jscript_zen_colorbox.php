<?php
/**
 * Zen Colorbox
 *
 * @author niestudio (daniel [dot] niestudio [at] gmail [dot] com)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_zen_colorbox.php 2012-04-30 niestudio $
 */

if (ZEN_COLORBOX_STATUS == 'true' && ZEN_COLORBOX_EZPAGES == 'true') {
  require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_colorbox/jquery_colorbox.php');
?>

jQuery(function($) {
  fileTypesString = <?php echo ("'" . ZEN_COLORBOX_FILE_TYPES . ",". "'");?>;
  fileTypes = $.each(fileTypesString.split(",").slice(0,-1), function(index, item) {
    $("a[href*='."+item+"']").attr('rel', 'colorbox'); 
    $("a[rel^='colorbox']").colorbox({<?php require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_colorbox/options.php'); if (ZEN_COLORBOX_GALLERY_MODE == 'false'){ echo ",rel:'nofollow'";} ?>});
  });
});
//--></script><?php  } ?>
