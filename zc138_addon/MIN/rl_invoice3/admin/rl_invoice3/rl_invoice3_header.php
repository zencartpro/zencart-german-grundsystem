<?php
/**
 * @package rl_invoice3
 * @copyright Copyright 2005-2009 langheiter.com 
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 *
 * @author rainer AT langheiter DOT com // http://www.filosofisch.com // http://edv.langheiter.com
 * generates pdf-invoices; please read: http://demo.zen-cart.at/docs/rl_invoice3/
 * 
 * @version $Id$
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
<link rel="stylesheet" type="text/css" href="../includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="./css/rl_invoice3.css">
<link rel="stylesheet" type="text/css" href="./css/rl_invoice3_dialogX.css">
<link rel="stylesheet" type="text/css" href="./css/rl_invoice3_admin.css">

<link rel="stylesheet" type="text/css" href="../includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="../includes/menu.js"></script>
<script language="javascript" src="../includes/general.js"></script>
<script language="javascript" src="../../ajax/jquery.js"></script>
<script language="javascript" src="../../ajax/ui.core.js"></script>
<script language="javascript" src="../../ajax/ui.draggable.js"></script>
<script language="javascript" src="../../ajax/ui.resizable.js"></script>
<script language="javascript" src="../../ajax/rl_invoice3.js"></script>
<script language="javascript" src="../../ajax/jquery.media.js"></script>
<script language="javascript" src="../../ajax/jquery.metadata.min.js"></script>

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
<div style="float:left; padding: 8px 5px;">
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
<div style="clear:both">

<ul style="background-color:#F5F5F5; border: solid #CCCCCC; border-width: 1px 0px;">
  
  <li class="makemenu1"><a class="makemenu" id="admin" href="<?php echo zen_href_link(RL_INVOICE3_ADMIN_FILENAME, 'page=admin') ?>"><?php echo RL_INVOICE3_ADMIN_ADMIN; ?></a></li>
  <li class="makemenu1"><a class="makemenu" id="template" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_TEMPLATE; ?></a>  </li>
  <li class="makemenu1"><a class="makemenu" id="fonttest" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_FONT ; ?></a>  </li>
  <li class="makemenu1"><a class="makemenu" id="testinvoice" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_INVOICETEST; ?></a>  </li>
  <li class="makemenu1"><a class="makemenu" id="about" href="<?php echo '#' ?>"><?php echo RL_INVOICE3_ADMIN_ABOUT; ?></a></li>
    
</ul>

<div class="donationbox">
<form class="contrib" action="https://www.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="business" value="zencart@filosofisch.com" />
  <input type="hidden" name="item_name" value="filosofisch donation" />
  <input type="hidden" name="item_number" value="DONATE ZenCart" />
  <input type="hidden" name="no_note" value="0" />
  <input type="hidden" name="cmd" value="_xclick" />
  <input type="hidden" name="lc" value="en" />
  <input type="hidden" name="on0" value="Anonymity" />
  <input type="hidden" name="on1" value="Comment" />
  <input type="hidden" name="no_shipping" value="1" />
  <input type="hidden" name="tax" value="0" />
  
  <input type="hidden" name="return" value="http://zencart.filosofisch.com/thanks.php" />
  <input type="hidden" name="cancel_return" value="http://zencart.filosofisch.com/canceled.php" /> 

  <h2>Please donate. <a class="wikilink1" href="http://zencart.filosofisch.com/donate.php" title="Why donate">Why?</a></h2> 
  <p>
  <label for="don-amount">One time gift of</label>
  <input type="text" name="amount" id="don-amount" maxlength="30" size="5" />
  <select name="currency_code">
    <option value="USD" selected="selected">$ (EUR)</option>
    <option value="EUR">€ (USD)</option>
    <option value="GBP">£ (GBP)</option>
    <option value="CAD">$ (CAD)</option>
    <option value="AUD">$ (AUD)</option>
    <option value="JPY">¥ (JPY)</option>
  </select>
  </p>
  <p>
  <label for="os1">Public comment
    <small>(200 characters max)</small>
  </label>  
  <br />
  <input type="text" size="25" name="os1" id="os1" maxlength="200" />
  </p>
  <p>
  <a class="wikilink1" href="http://zencart.filosofisch.com/donors_list.php" title="Donors' list'">Donors&rsquo; list</a><br />
  <input type="radio" name="os0" id="name-yes" value="Mention my name" />
  <label for="name-yes">List my name</label>
  <br />
  <input type="radio" name="os0" id="name-no" checked="checked" value="Don't mention my name" />
  <label for="name-no">List anonymously</label>
  <br />

  <input type="submit" value="Donate Now!" />
  <br />
  <img src="../images/cc.gif" alt="Visa, MasterCard, Discover, American Express, eCheck" />
  </p>
</form>
</div>

<div id="loading2" style="font-size: 22px; display: none; border: 3px solid red;z-index:3333;">
    Loading...
</div>
<div id="content"></div>
