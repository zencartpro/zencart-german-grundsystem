<?php
    require('includes/application_top.php');
    
    if(isset($_REQUEST['extern'])){
        
        header("location: " . $_REQUEST['extern']);
        exit;
        
    } 
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
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
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<div id="additionalpages">
<h1>Entwicklerteam der deutschen Zen Cart Version</h1>
<b>hugo13</b>
<br/><br/>
<b>webchills</b>
<br/><br/>
<b>MaleBorg</b>
<br/><br/>
Follow us on Twitter:<br/>
<a href="https://www.twitter.com/zencartpro" target="_blank">www.twitter.com/zencartpro</a>
<br/><br/>
Source Code auf GitHub:<br/>
<a href="https://github.com/zencartpro" target="_blank">github.com/zencartpro</a>
<br><br><br>
<h1>Unterstützen</h1>
<p>Die deutsche Zen Cart Version steht Ihnen kostenfrei im Rahmen der <a href="https://opensource.org/licenses/GPL-2.0" target="_blank">GNU General Public License</a> zur Verfügung. <br>
Sie können diese Software kostenfrei benutzen, Änderungen vornehmen, etc. <br />
<br />
Da wir Ihnen diese Software kostenfrei zur Verfügung stellen, freuen wir uns über Spenden. <br>
Diese Spenden helfen uns, die Kosten für die Wartung, Upgrades, Updates, den kostenlosen Support und die stetige Weiterentwicklung dieser Software für Ihren Online-Shop zu decken. </p>
<p><a href="https://donorbox.org/spende-fur-die-weiterentwicklung-der-deutschen-zen-cart-version" target="_blank"><img src="https://www.zen-cart-pro.at/zencartpro-donation-white.png" alt="Spende für die Weiterentwicklung der deutschen Zen Cart Version" title="Spende für die Weiterentwicklung der deutschen Zen Cart Version"></a></p>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
    
    
    
    