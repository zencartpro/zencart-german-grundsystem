<?php
/**
* Zen Cart German Specific
* @copyright Copyright 2003-2024 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: german_help.php 2024-02-15 17:03:16Z webchills $
*/
require('includes/application_top.php');
$current = PROJECT_VERSION_NAME . ' - deutsche Version v' . PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR . '';
// get release date
global $db;
    $check_releasedate = $db->Execute("SELECT configuration_title, configuration_key FROM " . TABLE_PRODUCT_TYPE_LAYOUT_LANGUAGE . "
        WHERE
        configuration_key = 'LANGUAGE_VERSION'       
        LIMIT 1");

    if ($check_releasedate->EOF) {
        $releasedate='';
    }
    $releasedate= $check_releasedate->fields['configuration_title'];

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php require DIR_WS_INCLUDES . 'admin_html_head.php'; ?>
</head>
  <body>
<!-- header //-->
    <?php
    require(DIR_WS_INCLUDES . 'header.php');
    ?>
    <!-- header_eof //-->
    <!-- body //-->
    <div class="container-fluid">
      <!-- body_text //-->
<h1 class="pageHeading">Hilfe zur deutschen Zen Cart Version 1.5.7h</h1>
<div class="card-text">
<span id="zencartprologo"><a href="https://www.zen-cart-pro.at" target="_blank"><img src="images/zencartpro-logo.jpg" alt="www.zen-cart-pro.at - Die deutsche Zen Cart Version" title="www.zen-cart-pro.at - Die deutsche Zen Cart Version"/></a><br><br>Ihre derzeit installierte Zen Cart Version:<br><b><?php echo  $current;?></b><br>Releasedatum: <b><?php echo $releasedate;?></b><br><br/><a class="versioncheck" href="https://ping.zen-cart-pro.at" target="_blank">auf Updates prüfen</a><br><br><?php echo 'Ihre derzeit aktive PHP Version:<b> ' . phpversion();?></b><br>Für diese Zen Cart Version empfohlen: <b>8.2.x</b></span><br><br><b>the art of e-commerce<br>übersetzt, angepasst und erweitert zur Verwendung im deutschsprachigen Raum</b><br><br>Die deutsche Zen-Cart Version 1.5.7h ist eine Modifikation der amerikanischen Version 1.5.7d/1.5.8/2.0.0 von <a href="https://www.zen-cart.com" target="_blank">zen-cart.com</a>.<br>
Sie wurde nicht nur einfach ins Deutsche übersetzt, sondern auch funktional auf die Anforderungen, die an Onlineshops in Deutschland, Österreich und der Schweiz gestellt werden, angepasst und mit zahlreichen Erweiterungen ausgestattet.<br>
<br>Die deutsche Zen Cart Version wird seit 2003 von einem Team von Entwicklern in Österreich und Deutschland betreut und weiterentwickelt.<br><br>
<b>Website des Projekts:</b><br><a href="https://www.zen-cart-pro.at" target="_blank">www.zen-cart-pro.at</a>
<br><br>
Hier finden Sie eine Übersicht hilfreicher Seiten zu Bedienung, Konfiguration, Sicherheit und Erweiterung Ihres Onlineshop Systems:
<br><br>
</div>
<table class="table table-hover">
<thead>
<tr class="dataTableHeadingRow">
<th class="dataTableHeadingContent">Link</th>
<th class="dataTableHeadingContent">Info</th>
</tr>
</thead>
<tbody>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://www.zen-cart-pro.at" target="_blank">Knowledgebase/Onlinedokumentation</a></td>
<td class="dataTableContent">Umfangreiche Knowledgebase und Onlinedokumentation zu Installation/Update/Konfiguration der deutschen Zen Cart Version</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://downloads.zen-cart-pro.at" target="_blank">Module & Erweiterungen</a></td>
<td class="dataTableContent">In unserem Downloadbereich auf der zen-cart-pro.at Website finden Sie zahlreiche gut getestete und dokumentierte Module,<br>mit denen Sie in der Grundinstallation nicht enthaltene Funktionalitäten hinzufügen können.</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://github.com/zencartpro" target="_blank">Source Code auf GitHub</a></td>
<td class="dataTableContent">Der Source Code des Grundsystems und der Module steht auf GitHub zur Verfügung.<br>Du bist Entwickler und willst mithelfen, die deutsche Zen Cart Version noch besser zu machen?<br>Beteilige Dich auf Github!</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://github.com/zencartpro/zencart-german-grundsystem/issues" target="_blank">Issues auf GitHub</a></td>
<td class="dataTableContent">Du hast einen Fehler in der deutschen Zen Cart Version 1.5.7 gefunden?<br>Melde ihn auf Github!<br>Für Fehler in Zusatzmodulen bitte die Issues im jeweiligen Modul Repository verwenden.</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://links.zen-cart-pro.at" target="_blank">Links</a></td>
<td class="dataTableContent">Nützliche andere Websites rund um Zen Cart</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://bsky.app/profile/zencartpro.bsky.social" target="_blank">@zencartpro.bsky.social</a></td>
<td class="dataTableContent">Folgen Sie uns auf Bluesky für aktuelle GitHub und Knowledgebase Updates</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://newsletter.zen-cart-pro.at" target="_blank">Newsletter</a></td>
<td class="dataTableContent">Wir informieren Sie gerne über Neuigkeiten rund um die deutsche Zen Cart Version.<br>
Sie werden nicht zugespammt, wir versenden ausschließlich bei Bedarf Informationen zu neuen Versionen, Sicherheitslücken oder neuen Funktionalitäten.</td>
</tr>
<tr class="dataTableRow" >
<td class="dataTableContent"><a href="https://spenden.zen-cart-pro.at" target="_blank">Unterstützen</a><br><a href="https://spenden.zen-cart-pro.at" target="_blank"><img src="images/zencartpro-donation-white.png" alt="Jede Spende hilft!" title="Jede Spende hilft!"></a></td>
<td class="dataTableContent">Unterstützen Sie die Weiterentwicklung der deutschen Zen Cart Version mit einer Spende!<br>
Die deutsche Zen-Cart Version steht kostenlos zur Verfügung. Ebenso die Module.<br><br>
Da wir Ihnen diese Software kostenfrei zur Verfügung stellen, freuen wir uns über Spenden.<br>
Um unsere laufenden Kosten (Server, Lizenzgebühren, usw.) abzudecken freuen wir uns über jede Unterstützung.<br>
Auch für die Zeit, die für die Weiterentwicklung neuer Versionen aufgewendet wird.<br>
<br>Sie haben von der deutschen Zen Cart Version profitiert?<br>
Geben Sie etwas zurück!</td>
</tr>
</tbody>
</table>
<!-- body_text_eof //-->
</div>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>