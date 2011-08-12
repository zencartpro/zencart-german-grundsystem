<?php
    require('includes/application_top.php');
    
    if(isset($_REQUEST['extern'])){
        print_r($_REQUEST);
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
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<style>
    ul {list-style-type: none;}
    .f14 {font-size: 14pt;}
    h1 {font-size: 18pt; padding-left: 20pt;}
    .w200 {width: 85pt; border: 0px solid red; display:inline-block; text-align:right; padding: 3pt;}
</style>

<h1>die proponenten</h1>
<ul>                
    <li class="f14"><span class="w200">hugo13: </span><a class="f14" href="http://edv.langheiter.com">http://edv.langheiter.com</a></li>
    <li class="f14"><span class="w200">maleborg: </span><a style="font-size: 14pt;" href="http://zencart.edv-service-sachs.de/">http://zencart.edv-service-sachs.de</a></li>
    <li class="f14"><span class="w200">webchills: </span><a style="font-size: 14pt;" href="http://www.webchills.at">http://www.webchills.at</a></li>
</ul>
<br><br><br>

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
    
    
    
    