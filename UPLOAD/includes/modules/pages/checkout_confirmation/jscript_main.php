<?php
/**
 * Zen Cart German Specific
 * jscript_main
 *
 * @package page
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_main.php 731 2019-06-15 21:49:16Z webchills $
 */
?>
<?php
  if (DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION == 'true') {
?>
<script type="text/javascript"><!--
$(document).ready(function(){
 $('#btn_submit').hide(); 
 $('#widerruf_downloads').mouseup(function () {
    $('#btn_submit').toggle();
 });
});
//--></script>
<?php
  }
?>
<script type="text/javascript"><!--
var submitter = null;
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}

function couponpopupWindow(url) {
  window.open(url,'couponpopupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
}

function submitFunction($gv,$total) {
   if ($gv >=$total) {
     submitter = 1;
   }
}

function submitonce()
{
  var button = document.getElementById("btn_submit");
  button.style.cursor="wait";
  button.disabled = true;
  setTimeout('button_timeout()', 4000);
  return false;
}
function button_timeout() {
  var button = document.getElementById("btn_submit");
  button.style.cursor="wait";
  button.disabled = true;
}
//--></script>
