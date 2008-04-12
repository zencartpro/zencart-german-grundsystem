<?php
/**
 * Page Template
 *
 * This page is auto-displayed if the configure.php file cannot be read properly. It is intended simply to recommend clicking on the zc_install link to begin installation.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
$relPath = (file_exists('includes/templates/template_default/images/logo.gif')) ? '' : '../';
$instPath = (file_exists('zc_install/index.php')) ? 'zc_install/index.php' : (file_exists('../zc_install/index.php') ? '../zc_install/index.php' : '');
$docsPath = (file_exists('docs/index.html')) ? 'docs/index.html' : (file_exists('../docs/index.html') ? '../docs/index.html' : '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de">
<head>
<title>System Setup Required</title>
<meta http-equiv="Content-Type" content="text/html; utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="authors" content="The Zen Cart&trade; Team and others" />
<meta name="generator" content="shopping cart program by Zen Cart&trade;, http://www.zen-cart.com" />
<meta name="robots" content="noindex, nofollow" />
<style type="text/css">
<!--
.systemError {color: #FFFFFF}
-->
</style>


</head>

<body style="margin: 20px">
<div style="width: 730px; background-color: #ffffff; margin: auto; padding: 10px; border: 1px solid #cacaca;">
<div>
<img src="<?php echo $relPath; ?>includes/templates/template_default/images/logo.gif" alt="Zen Cart&trade;" title=" Zen Cart&trade; " width="192" height="64" border="0" />
</div>
<h1>Vielen Dank für Ihr Interesse an Zen Cart&trade;.</h1>
<h2>Sie sehen diese Seite wegen einem oder mehreren Gründen:</h2>
<ol>
<li>Die benutzen <strong>Zen Cart&trade; zum ersten Mal</strong> und haben bisher keine Installation durchgeführt.<br />
Wenn das der Fall ist, dann 
<?php if ($instPath) { ?>
<a href="<?php echo $instPath; ?>">Klicken Sie hier</a> um die Installation zu beginnen.
<?php } else { ?>
laden Sie den Ordner "zc_install" mit Hilfe Ihres FTP Programms hoch und rufen Sie <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Webbrowser auf (oder laden Sie diese Seite erneut, um einen Link zur Installation angezeigt zu bekommen).
<?php } ?>
<br /><br />
</li>
<li>Ihre <tt><strong>/includes/configure.php</strong></tt> und/oder <tt><strong>/admin/includes/configure.php</strong></tt> Datei enthält ungültige <em>Pfad Angaben</em> und/oder ungültiged <em>Datenbank Einstellungen</em>.<br />
Falls Sie Ihre configure.php Dateien aus irgendwelchen Gründen verändert haben, oder vielleicht Ihren Shop in einen anderen Ordner oder Webspace verschoben haben, dann müssen Sie die Einstellungen in den Dateien nochmals anschauen und ggf. korrigieren.<br />
Schauen Sie ansonsten in den <a href="http://tutorials.zen-cart.com" target="_blank">Online FAQ und Tutorials</a> Bereich auf der Zen Cart&trade; COM Website für weitere Hilfestellungen (Texte sind dort in englischer Sprache).</li>
</ol>
<br />
<h2>Um mit der Installation zu beginnen ...</h2> 
<ol>
<?php if ($docsPath) { ?>
<li>Die Installationsanleitung können Sie hier lesen: <a href="<?php echo $docsPath; ?>">Installationsanleitung</a></li>
<?php } else { ?>
<li>Die Installationsanleitung finden Sie normalweise im /docs Ordner vom Zen Cart&trade; Installationspaket. Sie finden die Installationsanleitung auch unter <a href="http://tutorials.zen-cart.com" target="_blank">Online FAQs</a>.</li>
<?php } ?>
<?php if ($instPath) { ?>
<li>Rufen Sie die Adresse <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Webbrowser auf.</li>
<?php } else { ?>
<li>Sie müssen den Ordner "zc_install" mit Ihrem FTP Programm hochladen und dann die Adresse <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Webbrowser aufrufen (oder diese Seite erneut laden, um einen Link zur Installation angezeigt zu bekommen.</li>
<?php } ?>
<li>Das <a href="http://www.zen-cart.at" target="_blank">deutsche Support Forum</a> hilfr Ihnen ebenfalls, wenn Sie bei der Installation von Zen Cart auf Probleme stoßen.</li>
</ol>

</div>
    <p style="text-align: center; font-size: small;">Copyright &copy; 2003-<?php echo date('Y'); ?> <a href="http://www.zen-cart.at" target="_blank">Zen Cart&trade;</a></p>
</body></html>
