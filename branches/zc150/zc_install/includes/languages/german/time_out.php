<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */
/**
 * defining language components for the page
 */
  define('TEXT_PAGE_HEADING', 'Zen Cart&reg; Installation - Time Out');
  define('TEXT_MAIN','<h2>Problem entdeckt</h2><h3>Es wurde ein Problem festgestellt.</h3><p>Dieses Installationsprogramm muß eine PHP Session starten können, um die Installation abschließen zu können.</p><p><strong>Mögliche Gründe, warum diese Seite angezeigt wird inkl.:</strong><ul><li><h3>Vielleicht gab es einen Time-Out</h3>Wenn Sie die Installation länger als 20 Minuten nicht beaufsichtigt haben, dann sind alle informatione die Sie bisher eingegeben haben nicht mehr verfügbar. In diesem Fall müssen Sie die Installation erneut starten. <br /><br />Bitte lassen Sie die Installation nicht für längere Zeit unbeaufsichtigt. Die Installation sollte unter normalen Umständen nur 5 Minuten dauern.<br /><br /></li><li><h3>Der Server hat keinen Platz um die Situnzgs (Session) Dateien zu schreiben.</h3>Wenn Sie den Cache Ordner nicht bereits beschreibbar gemacht haben, dann holen Sie diese bitte jetzt nach, damit die Installation fortgesetzt werden kann. Weitere Informationen, wie Sie den Cache Ordner beschreibbar machen können finden Sie in der <a href="../docs/index.html" target="_blank">Installationsanleitung</a> oder in den <a href="http://tutorials.zen-cart.com/index.php?article=9" target="_blank">Online FAQs</a>.<br /><br /></li><li><h3>PHP sessions funktionieren möglicherweise nicht auf diesem Server</h3>Um Zen Cart&reg; benutzen zu können, müssen PHP Sessions geschrieben werden können. Es könnte sein, dsa Ihre derzeitige Server Konfiguration keine PHP Sessions erlaubt.  Ebenso muss ihr Browser Cookies erlauben, um die PHP Session Funktion nutzen zu können. Bitte deaktivieren Sie alle Cookie blockierenden Programme und überprüfen Sie Cookie Einstellungen in ihrem Webbrowser und Ihrer Firewall<br /><br />Sollte das Problem dadurch nicht behoben werden, dann setzenSie sich bitte mit Ihrem Webhoster in Verbindung.<br /><br /></li></ul></p>');
  define('START_INSTALL', 'Installation starten');
?>