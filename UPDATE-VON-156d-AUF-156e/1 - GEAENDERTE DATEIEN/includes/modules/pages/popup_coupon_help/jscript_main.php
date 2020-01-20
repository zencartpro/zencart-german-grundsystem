<?php
/**
 * jscript file for the popup coupon help page
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: jscript_main.php 2020-01-16 11:04:16Z webchills $
 */
?>
<script type="text/javascript">
var i=0;
function resize() {
  if (navigator.appName == 'Netscape') i=10;
  if (document.images[0]) {
  imgHeight = document.images[0].height+45-i;
  imgWidth = document.images[0].width+30;
  var height = screen.height;
  var width = screen.width;
  var leftpos = width / 2 - imgWidth / 2;
  var toppos = height / 2 - imgHeight / 2;
  window.moveTo(leftpos, toppos);
  window.resizeTo(imgWidth, imgHeight);
  }
  self.focus();
}
</script>