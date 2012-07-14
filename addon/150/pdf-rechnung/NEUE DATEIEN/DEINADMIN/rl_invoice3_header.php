<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2012 langheiter.com 
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * @version $Id: rl_invoice3_header.php 484 2012-07-12 16:19:17Z webchills $
 */
 
$v1 = HTML_PARAMS;
$v2 = CHARSET;
$v3 = TITLE;
  
echo <<<END
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html $v1>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=$v2">
<title>$v3></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="rl_invoice3/css/rl_invoice3_ges.css">

<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script language="javascript" src="rl_invoice3/ajax/jquery.js"></script>
<script language="javascript" src="rl_invoice3/ajax/ui.core.js"></script>
<script language="javascript" src="rl_invoice3/ajax/ui.draggable.js"></script>
<script language="javascript" src="rl_invoice3/ajax/ui.resizable.js"></script>
<script language="javascript" src="rl_invoice3/ajax/rl_invoice3.js"></script>
<script language="javascript" src="rl_invoice3/ajax/jquery.media.js"></script>
<script language="javascript" src="rl_invoice3/ajax/jquery.metadata.min.js"></script>
<script language="javascript" src="rl_invoice3/ajax/jquery.form.js"></script>
<script language="javascript" src="rl_invoice3/ajax/jquery.spin.js"></script>

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

   function popupWindow(url) {
          window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=460,screenX=150,screenY=150,top=150,left=150')
    }

  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
END;

require(DIR_WS_INCLUDES . 'header.php');

echo <<<TXT
<div>
<div id="admintitle">
<h1>
TXT;

echo RL_INVOICE3_HEADING_TITLE . '<span id="loading"></span></h1>';
if (defined('RL_INVOICE3_VERSION')) {
    echo 'Version: ' . RL_INVOICE3_VERSION . '<br />';
} else {
    echo IH_VERSION_NOT_FOUND . '<br />';
}

?>
</div>
<div id="adminbox1">
<ul>
  <li class="makemenu1"><a class="makemenu" id="admin" href="<?php echo zen_href_link(RL_INVOICE3_ADMIN_FILENAME, 'page=submenu') ?>"><?php echo RL_INVOICE3_ADMIN_ADMIN; ?></a></li>
  <li class="makemenu1"><a class="makemenu" id="template" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_TEMPLATE; ?></a>  </li>
  
  <li class="makemenu1"><a class="makemenu" id="testinvoice" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_INVOICETEST; ?></a>  </li>
 
    
</ul>
</div>



<div id="loading2" style="font-size: 22px; display: none; border: 3px solid red;z-index:3333;">
    Loading...
</div>
<div id="content"></div>
