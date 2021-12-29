<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: rl_invoice3_header.php 2016-06-19 07:19:17Z webchills $
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
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript" src="rl_invoice3/ajax/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="rl_invoice3/ajax/jquery-ui.js"></script>
<script type="text/javascript" src="rl_invoice3/ajax/jquery.form.js"></script>
<script type="text/javascript" src="rl_invoice3/ajax/jquery.spin.js"></script>
<script type="text/javascript" src="rl_invoice3/ajax/rl_invoice3.js"></script>


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

require(DIR_WS_INCLUDES . 'header-rl_invoice3.php');

echo <<<TXT
<div>
<div id="admintitle">
<h1>
TXT;

echo RL_INVOICE3_HEADING_TITLE . '<span id="loading"></span></h1>';

echo 'Version: ' . RL_INVOICE3_MODUL_VERSION . '<br /><br/>' . RL_INVOICE3_INFOTEXT . '';


?>
</div>
<div id="adminbox1">
<ul>
  
  <li class="makemenu1"><a class="makemenu" id="template" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_TEMPLATE; ?></a>  </li>
  

 
    
</ul>
</div>



<div id="loading2" style="font-size: 22px; display: none; border: 3px solid red;z-index:3333;">
    Loading...
</div>
<div id="content"></div>
