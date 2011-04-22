<?php
/**
 * googlemcde.php
 *
 * @package google merchant center deutschland 2.0 for Zen-Cart 1.3.9 german
 * @copyright Copyright 2007 Numinix Technology http://www.numinix.com
 * @copyright Portions Copyright 2011 webchills http://www.webchills.at
 * @copyright Portions Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: googlefroogle.php 35 2010-02-09 06:50:42Z numinix $
 * @version $Id: googlebase.php 2011-04-21 13:35:42Z webchills $
 */

  require('includes/application_top.php');

	function ftp_get_rawlist($url, $login, $password, $ftp_dir='', $ssl=false, $port=21, $timeout=30) {
		$out = '';
		$out .= FTP_CONNECTION_OK . ' ' . $url . '<br />';
		if($ssl)
			$cd = @ftp_ssl_connect($url);
		else
			$cd = @ftp_connect($url, $port, $timeout);
		if (!$cd) {
			return $out . FTP_CONNECTION_FAILED . ' ' . $url . '<br />';
		}
		ftp_set_option($cd, FTP_TIMEOUT_SEC, $timeout);
		$login_result = @ftp_login($cd, $login, $password);
		if (!$login_result) {
			ftp_close($cd);
			return $out . FTP_LOGIN_FAILED . FTP_USERNAME . ' ' . $login . FTP_PASSWORD . ' ' . $password . '<br />';
		}
		if ($ftp_dir != "") {
			if (!@ftp_chdir($cd, $ftp_dir)) {
				ftp_close($cd);
				return $out . FTP_CANT_CHANGE_DIRECTORY . '&nbsp;' . $url . '<br />';
			}
		}
		$out .= ftp_pwd($cd) . '<br />';
		$raw = ftp_rawlist($cd, $ftp_file, true);
		for($i=0,$n=sizeof($raw);$i<$n;$i++){
			$out .= $raw[$i] . '<br />';
		}
		ftp_close($cd);
		return $out;
	}
?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'ftpdir') {
	ob_start();
	echo TEXT_GOOGLE_MCDE_FTP_FILES . '<br />';
	echo ftp_get_rawlist(GOOGLE_MCDE_SERVER, GOOGLE_MCDE_USERNAME, GOOGLE_MCDE_PASSWORD);
	$out = ob_get_contents();
	ob_end_clean();
	echo '<pre>';
	echo $out;
	exit();
} elseif(isset($_GET['action']) && ($_GET['action'] == 'delete')) {
  if (file_exists(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . $_GET['file'])) {
    unlink(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . $_GET['file']);
  }
  zen_redirect(zen_href_link(FILENAME_GOOGLEMCDE));
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
<script language="javascript"><!--
function getObject(name) {
   var ns4 = (document.layers) ? true : false;
   var w3c = (document.getElementById) ? true : false;
   var ie4 = (document.all) ? true : false;

   if (ns4) return eval('document.' + name);
   if (w3c) return document.getElementById(name);
   if (ie4) return eval('document.all.' + name);
   return false;
}
//--></script>
<script language="javascript"><!--

var req, name;

function loadFroogleXMLDoc(request,field, loading) {

   name = field;
   var url="<?php echo HTTP_SERVER . DIR_WS_CATALOG . FILENAME_GOOGLEMCDE . ".php?" ?>"+request;
   // Internet Explorer
   try { req = new ActiveXObject("Msxml2.XMLHTTP"); }
   catch(e) {
      try { req = new ActiveXObject("Microsoft.XMLHTTP"); }
      catch(oc) { req = null; }
   }

   // Mozailla/Safari
   if (!req && typeof XMLHttpRequest != "undefined") { req = new XMLHttpRequest(); }

   // Call the processChange() function when the page has loaded
   if (req != null) {
      processLoading(loading);
      req.onreadystatechange = processChange;
      req.open("GET", url, true);
      req.send(null);
   }
}

function processChange() {
   if (req.readyState == 4 && req.status == 200)
      getObject(name).innerHTML = req.responseText;
}

function processLoading(text) {
  getObject(name).innerHTML = text;
}
//--></script>
<style type="text/css">
  label{display:block;width:200px;float:left;}
  .limiters{width:200px;}
  .buttonRow{padding:5px 0;}
  .forward{float:right;}
  table#googleFiles { margin-left: 0px; border-collapse:collapse; border:1px solid #036; font-size: small; width: 100%; }
  table#googleFiles th { background-color:#036; border-bottom:1px double #fff; color: #fff; text-align:center; padding:8px; }
  table#googleFiles td { border:1px solid #036; vertical-align:top; padding:5px 10px; }
  #contentwrapper{float:left;width:100%;}
  #columnLeft{margin-right:350px;}
  .container{margin:0 10px 10px;}
  #columnRight{float:left;margin-left:-350px;width:350px;}
</style>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div id="contentwrapper">
  <div id="columnLeft">
    <div class="container">
      <h1><?php echo HEADING_TITLE; ?></h1>
      <form method="get" action="<?php echo HTTP_SERVER . DIR_WS_CATALOG . FILENAME_GOOGLEMCDE . ".php"; ?>" name="google" target="googlefeed" onSubmit="window.open('', 'googlefeed', 'resizable=1, statusbar=5, width=600, height=400, top=0, left=50, scrollbars=yes');setTimeout('location.reload(true);', 5000);">
        <label for="feed">Feed Typ:</label>
        <select name="feed">
          <option value="fy_un_tp">Artikel</option>
          
        </select>
        <br class="clearBoth" />
        <label for="limit"><?php echo TEXT_ENTRY_LIMIT; ?></label>
        <?php echo zen_draw_input_field('limit', (int)GOOGLE_MCDE_MAX_PRODUCTS, 'class="limiters"'); ?>
        <br class="clearBoth" />
        <label for="offset"><?php echo TEXT_ENTRY_OFFSET; ?></label>
        <?php echo zen_draw_input_field('offset', (int)GOOGLE_MCDE_START_PRODUCTS, 'class="limiters"'); ?>
        <br class="clearBoth" />
        <?php
          echo '<div class="buttonRow back">' . zen_image_submit('button_confirm.gif', IMAGE_CONFIRM, 'id="submitButton"') . '</div><br class="clearBoth" />'; 
        ?>
      </form>
      <br />
      <h2>Verfügbare Produktfeeds</h2> 
      <table id="googleFiles">
        <tr>
          <th>Datum (DD/MM/YYYY)</th>
          <th>Download Link</th>
          <th>Aktion</th>
        </tr>
        <?php
        if ($handle = opendir(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY)) {
          while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && $file != 'index.html') {
            $filetime = filemtime(DIR_FS_CATALOG . GOOGLE_MCDE_DIRECTORY . $file);
            $date = date('j/m/Y');
        ?>
              <tr>
                <td><?php echo $date; ?></td>
                <td><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG . GOOGLE_MCDE_DIRECTORY . $file; ?>" target="_blank"><?php echo $file;?></a></td>
                <td>
                  <a href="<?php echo zen_href_link(FILENAME_GOOGLEMCDE, 'file='.$file.'&action=delete');?>">Löschen</a>&nbsp;
                  <a href="#" onclick="window.open('<?php echo HTTP_SERVER . DIR_WS_CATALOG . FILENAME_GOOGLEMCDE; ?>.php?feed=fn_uy&upload_file=<?php echo $file; ?>', 'googlefrooglefeed', 'resizable=1, statusbar=5, width=600, height=400, top=0, left=50, scrollbars=yes');">FTP Upload</a>
                </td>
              </tr>
              <?php
            }
          }
          closedir($handle);
        }
        ?>
      </table>
    </div>
  </div>
</div>
<div id="columnRight">
  <div class="container">
    <div><br/><a href="http://www.google.com/merchants/merchantdashboard" target="_blank"><img src="images/google_merchant_center.gif" width="298" height="40"></a><br/></div>
    <div class="smallText"><?php echo TEXT_GOOGLE_MCDE_LOGIN_HEAD; ?></div>
    <div class="smallText"><?php echo TEXT_GOOGLE_MCDE_LOGIN; ?></div>
  </div>
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>