<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_zen_lightbox.php 2008-12-17 aclarke $
 */

if (ZEN_LIGHTBOX_STATUS == 'true') {
  require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/slimbox.php');
?>

jQuery(function($) {
        $("a[rel^='lightbox']").slimbox({/* Put custom options here */}, function(el) {
                return [el.href, el.title /* + '<br /><a href="' + el.href + '">Download this image</a>'*/];
        }, function(el) {
                return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
        });
});
//--></script><?php } ?>