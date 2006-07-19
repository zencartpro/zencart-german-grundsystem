<?php /* Smarty version 2.6.13, created on 2006-07-19 10:50:57
         compiled from header.tpl.html */ ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo @HTML_PARAMS; ?>
>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo @CHARSET; ?>
">
<title><?php echo @TITLE; ?>
</title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['path']; ?>
includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['path']; ?>
rl_language/rl_language_stylesheet.css" media="all">
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['path']; ?>
includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['path']; ?>
includes/menu.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['path']; ?>
includes/general.js"></script>
<?php echo '
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu(\'navbar\');
    if (document.getElementById)
    {
      var kill = document.getElementById(\'hoverJS\');
      kill.disabled = true;
    }
  }
  // -->
</script>
'; ?>

</head>
<body onload="init()">