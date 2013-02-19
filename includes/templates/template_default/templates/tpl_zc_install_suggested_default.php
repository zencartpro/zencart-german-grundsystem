<?php
/**
 * Page Template
 *
 * This page is auto-displayed if the configure.php file cannot be read properly. It is intended simply to recommend clicking on the zc_install link to begin installation.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_zc_install_suggested_default.php 805 2013-02-19 16:28:24Z webchills $
 * 
 */
$relPath = (file_exists('includes/templates/template_default/images/logo.gif')) ? '' : '../';
$instPath = (file_exists('zc_install/index.php')) ? 'zc_install/index.php' : (file_exists('../zc_install/index.php') ? '../zc_install/index.php' : '');
$docsPath = (file_exists('docs/index.html')) ? 'docs/index.html' : (file_exists('../docs/index.html') ? '../docs/index.html' : '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<title>Zen Cart muss erst installiert oder richtig konfiguriert werden</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="authors" content="The Zen Cart&reg; Team and others" />
<meta name="generator" content="Zen-Cart deutsche Version, http://www.zen-cart-pro.at" />
<meta name="robots" content="noindex, nofollow" />
<style type="text/css">
<!--
.systemError {color: #FFFFFF}
-->
</style>


</head>

<body style="margin: 20px">
<div style="width: 730px; background-color: #ffffff; margin: auto; padding: 10px; border: 0px solid #cacaca; font-family: Arial, Verdana, sans-serif;">
<div align="center">
<img src="<?php echo $relPath; ?>includes/templates/template_default/images/logo.gif" alt="Zen Cart&reg;" title=" Zen Cart&reg; " width="242" height="70" border="0" />
</div>
<div align="center">
<h2>Zen Cart muss erst installiert oder richtig konfiguriert werden.</h2>
</div>
<br/><br/>
<h3>Sie bekommen diese Seite aus einem oder mehreren der folgenden Gründe angezeigt:</h3>  
<ol>
<li>Sie benutzen <strong>Zen Cart zum ersten Mal</strong> und haben noch keine Installation durchgeführt.<br />
Sollte das der Fall sein,
<?php if ($instPath) { ?>
<a href="<?php echo $instPath; ?>">dann klicken Sie hier</a>, um die Installation zu starten.
<?php } else { ?>
dann laden Sie das Verzeichnis "zc_install" per FTP Programm in Ihr Shopverzeichnis hoch und gehen Sie gehen Sie dann auf <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Browser (oder laden Sie diese Seite erneut, um einen Link dahin angezeigt zu bekommen).
<?php } ?>
<br /><br />
</li>
<li>Ihre <tt><strong>/includes/configure.php</strong></tt> und/oder <tt><strong>/admin/includes/configure.php</strong></tt> Datei enthält ungültige <em>Pfadangaben</em> und/oder ungültige <em>Angaben zur Datenbankverbindung</em>.<br />
Sollten Sie kürzlich Ihre configure.php Dateien aus irgendwelchen Gründen geändert haben, oder Ihren Shop in ein anderes Verzeichnis/anderen Server verschoben haben, dann müssen Sie die entsprechenden Angaben in den beiden Dateien anpassen.<br />
Weitere Informationen erhalten Sie im <a href="http://www.zen-cart-pro.at" target="_blank">deutschsprachigen Supportforum</a>.<br/><br/></li>
<?php if (isset($problemString) && $problemString != '') { ?>
<li class="errorDetails">Zusätzliche Hinweise: <?php echo $problemString; ?></li>
<?php } ?>
</ol>
<br />
<h3>Um die Installation zu starten ...</h3>
<ol>
<?php if ($docsPath) { ?>
<li>Lesen Sie vorab die <a href="<?php echo $docsPath; ?>">Installationsanleitung</a>.</li>
<?php } else { ?>
<li>Die Installation finden Sie normalerweise im Verzeichnis /docs in Ihrer Zen Cart Zip Datei.</li>
<?php } ?>
<?php if ($instPath) { ?>
<li>Gehen Sie auf <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Browser.</li>
<?php } else { ?>
<li>Sie müssen das Verzeichnis "zc_install" per FTP in Ihr Shopverzeichnis hochladen und dann <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Browser aufrufen (oder laden Sie diese Seite erneut, um einen Link dahin angezeigt zu bekommen).</li>
<?php } ?>
<li>Das <a href="http://www.zen-cart-pro.at" target="_blank">deutschsprachige Supportforum</a> steht Ihnen bei Problemen ebenfalls zur Verfügung.</li>
</ol>

</div>
   
</body></html>
