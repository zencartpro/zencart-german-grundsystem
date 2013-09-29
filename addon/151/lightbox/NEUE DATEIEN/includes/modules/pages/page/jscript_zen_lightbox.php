<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_zen_lightbox.php 2013-02-21 webchills $
 */

if (ZEN_LIGHTBOX_STATUS == 'true' && ZEN_LIGHTBOX_EZPAGES == 'true') {
  require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/slimbox.php');
?>

jQuery(function($) {
  <?php if (ZEN_LIGHTBOX_GALLERY_MODE == 'true'){?>
    var lightboxType = "lightbox-g";
  <?php } else {?>
    var lightboxType = "lightbox";
  <?php } ?>
  fileTypesString = <?php echo ("'" . ZEN_LIGHTBOX_FILE_TYPES . ",". "'");?>;
  fileTypes = $.each(fileTypesString.split(",").slice(0,-1), function(index, item) {
    $("a[href*='"+item+"']").attr('rel', lightboxType); 
    $("a[rel^='lightbox']").slimbox({<?php require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/options.php'); ?>}, function(el) 
    {
            return [el.href, el.title /* + '<br /><a href="' + el.href + '">Download this image</a>'*/];
    }, function(el) {
            return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
    });
  });
  <?php if (ZEN_LIGHTBOX_CLOSE_IMAGE == 'true' || ZEN_LIGHTBOX_PREV_NEXT == 'true') { echo ("$('#lbPrevLink').addClass('prevNoHover'); $('#lbNextLink').addClass('nextNoHover');");}?>
});
//--></script><?php } ?>
