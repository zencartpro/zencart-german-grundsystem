<?php
/**
 * @package Admin Profiles
 * @copyright Copyright Kuroi Web Design 2009-2010
 * @copyright Portions Copyright 2003-2006 The Zen Cart Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: alt_nav.php 2011-05-12 06:38:09Z webchills $
 */

require('includes/application_top.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<script type="text/javascript" src="includes/menu.js" type="text/JavaScript"></script>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="includes/nde-basic.css" type="text/css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
</head>
<body onload="cssjsmenu('navbar')">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<?php
  if (menu_header_visible('Configuration')) require(DIR_WS_BOXES . 'configuration_dhtml.php');
  if (menu_header_visible('Catalog')) require(DIR_WS_BOXES . 'catalog_dhtml.php');
  if (menu_header_visible('Modules')) require(DIR_WS_BOXES . 'modules_dhtml.php');
  if (menu_header_visible('Customers')) require(DIR_WS_BOXES . 'customers_dhtml.php');
  if (menu_header_visible('Taxes')) require(DIR_WS_BOXES . 'taxes_dhtml.php');
  if (menu_header_visible('Localization')) require(DIR_WS_BOXES . 'localization_dhtml.php');
  if (menu_header_visible('Reports')) require(DIR_WS_BOXES . 'reports_dhtml.php');
  if (menu_header_visible('Tools')) require(DIR_WS_BOXES . 'tools_dhtml.php');
  if (menu_header_visible('GV_Admin')) require(DIR_WS_BOXES . 'gv_admin_dhtml.php');
  if (menu_header_visible('Extras')) require(DIR_WS_BOXES . 'extras_dhtml.php');
  ?>
</body>
</html>
<?php require('includes/application_bottom.php');