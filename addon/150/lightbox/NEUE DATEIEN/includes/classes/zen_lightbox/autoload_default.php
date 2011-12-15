<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: autoload_default.php 2011-12-15 webchills $
 */
?>

jQuery(function($) {
        $("a[rel^='lightbox']").slimbox({<?php require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/options.php'); ?>}, function(el) 
        {
                return [el.href, el.title /* + '<br /><a href="' + el.href + '">Download this image</a>'*/];
        }, function(el) {
                return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
        });
});
//--></script>

<?php if (ZEN_LIGHTBOX_CLOSE_IMAGE == 'true' || ZEN_LIGHTBOX_PREV_NEXT == 'true') { echo '<style type="text/css"> #lbPrevLink, #lbNextLink {display: block; position: absolute; top: 0; width: 63px; height:32px!important; outline: none;} #lbNextLink {right: 0; background: transparent url(images/zen_lightbox/nextlabel.gif) no-repeat 100% 15%;} #lbPrevLink {left: 0; background: transparent url(images/zen_lightbox/prevlabel.gif) no-repeat 0 15%; } </style>';}?>
