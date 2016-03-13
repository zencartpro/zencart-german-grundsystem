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
<b>webchills</b><br/>
<a href="https://www.webchills.at" target="_blank">www.webchills.at</a>
<br/><br/>
<b>MaleBorg</b>
<br/><br/>
Follow us on Twitter:<br/>
<a href="http://www.twitter.com/zencartpro" target="_blank">www.twitter.com/zencartpro</a>
<br><br><br>
</div>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
    
    
    
    