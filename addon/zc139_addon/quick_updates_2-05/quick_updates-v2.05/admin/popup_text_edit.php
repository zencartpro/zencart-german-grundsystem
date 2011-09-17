<?php
/**
 * @package admin
 * @copyright Copyright 2006 Andrew Berezin andrew@eCommerce-service.com
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

require('includes/application_top.php');
@define('FILENAME_POPUP_TEXT_EDIT', 'popup_text_edit');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<script type="text/javascript">
  <!--
  function init() {
    var ed = document.getElementById('message_html');
    if(ed) {
      ed.value = opener.document.getElementById(opener.textEditFieldID).value;
    }
    if (typeof _editor_url == "string") HTMLArea.replace('message_html');
  }
  function put() {
    var ed = document.getElementById('message_html');
//alert('put');
//vardump(ed);
    if(sendText) {
      opener.document.getElementById(opener.textEditFieldID).value=ed.value;
      window.close();
    }
  }
  function setPopupText(el) {
    sendText = true;
    return true;
  }
var sendText = false;

function vardump(obj){
  arr = obj;
  s = '';
  var i = 0;
  if(typeof(obj) == 'object') {
	  for (var k in arr) {
	    i++;
	    s += k + "=>" + arr[k] + "\n";
	    if (typeof(arr[k]) == "object") {
	      arr1 = arr[k];
	      for (var k1 in arr1) {
	//        alert(k + "=>" + k1 + " : " + arr1[k1]);
	//           s += k + "=>" + k1 + " : " + arr1[k1] + "\n";
	      }
	    }
	    if(i>10){
	      alert(s);
	      s = '';
	      i = 0;
	    }
    }
  } else {
    s += "" + d + "\n";
  }
  if(s != '') alert(s);
}
  // -->
</script>
<?php if ($editor_handler != '') { $PHP_SELF_save = $PHP_SELF; $PHP_SELF = 'mail.php'; include ($editor_handler); $PHP_SELF = $PHP_SELF_save; } ?>
</head>
<body onLoad="init()" onUnload="put()">
<!-- header //-->
<?php // require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<?php //
	echo zen_draw_form('popup_text_edit', FILENAME_POPUP_TEXT_EDIT, '', 'post', 'enctype="multipart/form-data" onsubmit="setPopupText(this);return true;"');
	echo zen_draw_hidden_field('action', 'set');
	if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") {
		$oFCKeditor = new FCKeditor('message_html') ;
		$oFCKeditor->Value = 'lena';
		$oFCKeditor->Width  = '97%' ;
		$oFCKeditor->Height = '470' ;
//		$oFCKeditor->Create() ;
		$output = $oFCKeditor->CreateHtml() ; echo $output;
	} else { // using HTMLAREA or just raw "source"
		echo zen_draw_textarea_field('message_html', 'soft', '95%', '28', '', 'id="message_html"');
		echo '<script type="text/javascript"><!--
  document.getElementById(\'message_html\').value = opener.document.getElementById(opener.textEditFieldID).value;
// --></script>';
	}
	echo zen_image_submit('button_save.gif', IMAGE_SAVE) . '<a href="javascript:window.close()">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
?>
</form>
<!-- body_eof //-->

<!-- footer //-->
<?php // require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>