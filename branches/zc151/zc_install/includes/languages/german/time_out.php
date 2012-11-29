<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: time_out.php 794 2012-11-30 18:24:50Z webchills $
 */
/**
 * defining language components for the page
 */
  define('TEXT_PAGE_HEADING', 'Zen-Cart Installation - Time Out');
  define('TEXT_MAIN','<h2>Problem entdeckt</h2><h3>Es wurde ein Problem festgestellt.</h3><p>Dieses Installationsprogramm muß eine PHP Session starten können, um die Installation abschließen zu können.</p><p><strong>Mögliche Gründe, warum diese Seite angezeigt wird:</strong><ul><li><h3>Vielleicht gab es einen Time-Out</h3>Wenn Sie die Installation länger als 20 Minuten nicht beaufsichtigt haben, dann sind alle Informationen die Sie bisher eingegeben haben, nicht mehr verfügbar. In diesem Fall müssen Sie die Installation erneut starten. <br /><br />Bitte lassen Sie die Installation nicht für längere Zeit unbeaufsichtigt. Die Installation sollte unter normalen Umständen nur 5 Minuten dauern.<br /><br /></li><li><h3>Der Server hat keinen Platz um die Sitzungs (Session) Dateien zu schreiben.</h3>Wenn Sie den Cache Ordner nicht bereits beschreibbar gemacht haben, dann holen Sie das bitte jetzt nach, damit die Installation fortgesetzt werden kann. Weitere Informationen, wie Sie den Cache Ordner beschreibbar machen können finden Sie in der <a href="../docs/index.html" target="_blank">Installationsanleitung</a> oder in den <a href="http://www.zen-cart-pro.at/forum/forums/69-FAQ-und-Tutorials" target="_blank">Online FAQs</a>.<br /><br /></li><li><h3>PHP Sessions funktionieren möglicherweise nicht auf diesem Server</h3>Um Zen-Cart benutzen zu können, müssen PHP Sessions geschrieben werden können. Es könnte sein, dsa Ihre derzeitige Server Konfiguration keine PHP Sessions erlaubt.  Ebenso muss ihr Browser Cookies erlauben, um die PHP Session Funktion nutzen zu können. Bitte deaktivieren Sie alle Cookie blockierenden Programme und überprüfen Sie Cookie Einstellungen in ihrem Webbrowser und Ihrer Firewall<br /><br />Sollte das Problem dadurch nicht behoben werden, dann setzen Sie sich bitte mit Ihrem Webhoster in Verbindung.<br /><br /></li></ul></p>');
  define('START_INSTALL', 'Installation starten');
?>