<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: autoload_default.php 2008-12-09 aclarke $
 */
?>

Slimbox.scanPage = function() {
	$$(document.links).filter(function(el) {
		return el.rel && el.rel.test(/^lightbox/i);
	}).slimbox({<?php require_once(DIR_FS_CATALOG . DIR_WS_CLASSES . 'zen_lightbox/options.php'); ?>]}, null, function(el) {
		return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
	});
};
window.addEvent("domready", Slimbox.scanPage);
//--></script>