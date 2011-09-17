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
@define('FILENAME_POPUP_FILE_SELECT', 'popup_file_select');

$filter = array('jpg', 'png', 'gif', 'bmp');

if(isset($_GET['sdir'])) $subdir = zen_db_input($_GET['sdir']);
else $subdir = '';

$d = dir(DIR_FS_CATALOG_IMAGES . $subdir);
$curdir = preg_replace('@^' . DIR_FS_CATALOG_IMAGES . '@', '', $d->path);
$updir = explode('/', trim($curdir, '/'));
unset($updir[sizeof($updir)-1]);
$updir = implode('/', $updir);

while (false !== ($entry = $d->read())) {
	if($entry == '..' && $d->path != DIR_FS_CATALOG_IMAGES) {
		$dirs[$entry] = '<a href="' . zen_href_link(FILENAME_POPUP_FILE_SELECT, 'sdir=' . $updir . '/') . '">' . zen_image(DIR_WS_ICONS . 'previous_level.gif', ICON_PREVIOUS_LEVEL) . '&nbsp;' . $entry . '</a>';
	}
	if($entry == '..' || $entry == '.') continue;
	if (filetype($d->path . $entry) == "dir") {
		$dirs[$entry] = '<a href="' . zen_href_link(FILENAME_POPUP_FILE_SELECT, 'sdir=' . $curdir . $entry . '/') . '">' . zen_image(DIR_WS_ICONS . 'folder.gif', ICON_FOLDER) . '&nbsp;' . $entry . '</a>';
	} else {
		$ext = explode('.', $entry);
		if(!in_array(end($ext), $filter)) continue;
		$files[$entry] = '<a href="javascript:previewImage(\'' . ltrim($curdir, '/') . $entry . '\');">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW). '&nbsp;' . $entry . '</a>';
	}
}
$d->close();
@ksort($dirs);
@ksort($files);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Zen Cart!</title>
<script type="text/javascript">
  <!--
  var DIR_WS_CATALOG_IMAGES='<?php echo DIR_WS_CATALOG_IMAGES; ?>';
function getObject(elementID) {
    if (document.getElementById) {
      return document.getElementById(elementID);
    } else if (document.all) {
      return document.all[elementID];
    } else if (document.layers) {
      return document.layers[elementID];
    }
   return false;
}

  function setImage(file) {
    opener.document.getElementById(opener.selectFileID).value = file;
    var iimg = opener.document.getElementById(opener.updateImgId);
    iimg.src = DIR_WS_CATALOG_IMAGES+file;
//    vardump(iimg);
//    idiv.replaceChild(imgNew, iimg);
    window.close();
  }

  function previewImage(file) {
    var idiv = getObject('fileinfo');
    var iimg = getObject('fileimg');
    idiv.style.display = 'block';
    var imgNew=document.createElement('img');
    imgNew.src = DIR_WS_CATALOG_IMAGES+file;
    imgNew.id = 'fileimg';
    idiv.replaceChild(imgNew, iimg);
    getObject('imageSelectHref').href = "javascript:setImage('"+file+"');";
    getObject('imageName').innerHTML = file;
  }

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
    s += "" + obj + "\n";
  }
  if(s != '') alert(s);
}
  // -->
</script>
</head>
<body>
<table width="100%">
  <tr>
    <td valign="top" width="30%">
<?php
if(sizeof($dirs) > 0 ) {
	foreach($dirs as $k => $val) {
		echo $val . '<br />' . "\n";
	}
}
?>
    </td>
    <td valign="top" width="30%">
<?php
if(sizeof($files) > 0 ) {
	foreach($files as $k => $val) {
		echo $val . '<br />' . "\n";
	}
}
?>
    </td>
    <td valign="top" width="40%">
      <div id="fileinfo" style="display:none;text-align:center">

      <img src="" border="0" alt="" title="" id="fileimg" />

      <br /><a href="" id="imageSelectHref">
      Select
      <br />
      <span id="imageName"></span>
        </a>
      </div>
    </td>
    </tr>
  </table>
</body>
</html>