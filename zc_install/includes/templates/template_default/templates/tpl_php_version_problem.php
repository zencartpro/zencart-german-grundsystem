<?php
/**
 * This page is auto-displayed if an outdated version of PHP version is detected
 *
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_php_version_problem.php 804 2012-11-17 10:03:26Z webchills $
 */
$relPath = (file_exists('includes/templates/template_default/images/zen_header_bg.jpg')) ? '' : '../';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf8">
<title>PHP Versions Update erforderlich</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta http-equiv="imagetoolbar" content="no">
<meta name="authors" content="The Zen Cart&reg; Team and others">
<meta name="generator" content="shopping cart program by Zen Cart&reg;, http://www.zen-cart.com">
<meta name="robots" content="noindex, nofollow">
<style type="text/css">
<!--
body {margin: 10px}
#container {width: 730px; background-color: #ffffff; margin: auto; padding: 10px; border: 1px solid #cacaca;}
div .headerimg {padding:0; width: 730px;}
.systemError {color: red}
-->
</style>
</head>

<body id="pagebody">
<div id="container">
<img src="<?php echo $relPath; ?>includes/templates/template_default/images/zen_header_bg.jpg" alt="Zen Cart&reg;" title=" Zen Cart&reg; " class="headerimg">
<h1>Hallo. Danke, dass Sie die deutsche Zen-Cart Version installieren.</h1>
<h2 class="systemError">Leider haben wir folgendes Problem festgestellt</h2>
<p class="systemError">Die PHP Version (<?php echo PHP_VERSION; ?>) die Sie verwenden ist zu alt. Zen-Cart 1.5.1 kann mit dieser PHP-Version NICHT verwendet werden. Bitte führen Sie auf Ihrem Server ein Update auf die aktuelle PHP Version durch.</p>
<p>Diese Version von Zen-Cart erfordert mindestens die PHP version 5.2.14<br><strong>Wir empfehlen den Einsatz der aktuellen Version PHP 5.3.xx.</strong></p>
<p><em>HINWEIS: Zum Zeitpunkt dieser Zen-Cart Version ist PHP 5.4 noch nicht offiziell verfügbar, daher wurde Zen-Cart nicht ausführlich mit PHP 5.4 getestet. Besuchen Sie unsere <a href="www.zen-cart-pro.at">www.zen-cart-pro.at</a> Website für die neueste Version, falls Sie PHP 5.4 verwenden.</em></p>
</div>
<p style="text-align: center; font-size: small;">Copyright &copy; 2003-<?php echo date('Y'); ?> <a href="http://www.zen-cart-pro.at" target="_blank">Zen-Cart</a></p>
</body>
</html>
