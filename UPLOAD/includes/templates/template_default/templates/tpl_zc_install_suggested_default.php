<?php
/**
 * Page Template
 *
 * This page is auto-displayed if the configure.php file cannot be read properly. 
 * It is intended simply to recommend clicking on the zc_install link to begin installation.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_zc_install_suggested_default.php 806 2019-06-30 09:28:24Z webchills $
 */
$relPath = (file_exists('includes/templates/template_default/images/logo.gif')) ? '' : '../';
$instPath = (file_exists('zc_install/index.php')) ? 'zc_install/index.php' : (file_exists('../zc_install/index.php') ? '../zc_install/index.php' : '');
$docsPath = (file_exists('docs/index.html')) ? 'docs/index.html' : (file_exists('../docs/index.html') ? '../docs/index.html' : '');
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <title>Zen Cart muss erst installiert oder richtig konfiguriert werden</title>
    <meta content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="authors" content="The Zen Cart&reg; Team and others">
    <meta name="generator" content="Zen-Cart deutsche Version, http://www.zen-cart-pro.at" />
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        body {
        	background: #fff;
        	color: #777;
        	font: 16px/1 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        	font-weight: 200;
        	margin: 10px auto;
        	padding: 0 2rem;
        }
        
        h1 {
        	font-size: 2.25rem;
        	font-weight: 100;
        	color: #000;
        	letter-spacing: 1px;
        	margin: 3rem 0 1.5rem;
        }
        
        h2 {
        	font-size: 2rem;
        	border-bottom: 1px solid #e3e3e3;
        	font-weight: 300;
        	margin: 2.25rem 0 1rem;
        	padding: 0.5rem 0 1rem;
        }
        
        h3 {
        	font-size: 1.5rem;
        	font-weight: 400;
        	color: #606060;
        	margin: 1.75rem 0 0.25rem 0;
        }

        h4 {
        	font-size: 1.25rem;
        	font-weight: 300;
        	margin: 1.25rem 0 0.25rem 0;
        	color: maroon;
        	font-variant: small-caps;
        }

        h5, h6 {
        	font-weight: 700;
        }

        h5 {
        	font-size: 1.25rem;
        }

        h6 {
        	font-size: 1rem;
        }

        h5, h6, ol, p, ul {
        	margin: 0 0 1rem 0;
        }

        ul {
        	list-style-type: square;
        }

        ol {
        	list-style-type: upper-roman;
        }

        ol, p, ul {
        	line-height: 1.5;
        }

        ol, ul {
        	padding: 0;
        }

        ol li, ul li {
        	margin-left: 1.125rem;
        }

        ol.noteList {
        	list-style-type: lower-alpha;
        	font-size: small;
        }

        ul.noStyle, ol.noStyle {
        	list-style-type: none;
        }

        a {
        	color: #0080ff;
        	font-weight: 300;
        	text-decoration: none;
        }

        a:visited {
        	color: #0080ff;
        }

        em {
        	color: #444;
        	font-weight: 500;
        	font-style: italic;
        }

        .img-center {
        	display: inline-block;
        	max-width: 100%;
        }

        .no-left-margin {
        	margin-left: 0;
        }

        .errorDetails {
        	color: red;
        	font-weight: 300;
        }

        .add-shadow {
        	-webkit-box-shadow: 4px 10px 41px 0px rgba(161, 161, 161, 0.75);
        	   -moz-box-shadow: 4px 10px 41px 0px rgba(161, 161, 161, 0.75);
        	        box-shadow: 4px 10px 41px 0px rgba(161, 161, 161, 0.75);
        }

        .prime-string {
        	font-size: 2.5rem;
        	font-weight: bold;
        }

        .bold-string {
        	font-weight: bold;
        }

        .small-string, .back-to-top, .appInfo {
        	font-size: small;
        }

        .back-to-top, .appInfo {
        	text-align: center;
        }

        .back-to-top {
        	margin: 2rem 0 2rem 0;
        }

        .back-to-top a {
        	text-decoration: none;
        }

        .appInfo {
        	margin: 4rem 0 2rem 0;
        	color: #888;
        }

        .zenData {
        	margin: 2rem 0 0 0;
        }

        @media screen and (min-width: 1200px) {
        	body {
        		font-size: 1.75rem;
        	}
        	h2 {
        		font-size: 2.25rem;
        	}
        	h1 {
        		font-size: 4.0rem;
        		margin-top: 5rem;
        	}
        }

        @media screen and (max-width: 1199px) {
        	.small-string, .small-string a {
        		font-size: 1.20rem;
        	}
        	.prime-string, .prime-string a {
        		font-size: 1.75rem;
        		font-weight: 500;
        	}
        }

        @media screen and (max-width: 991px) {
        	.alert {
        		padding: 1rem;
        		margin: 1rem 1rem 1rem 1rem;
        	}
        }
    </style>
  </head>

  <body>
  <div class="container">
    <img src="<?php echo $relPath; ?>includes/templates/template_default/images/logo.gif" alt="Zen Cart&reg;" title=" Zen Cart&reg; " width="240" height="70" border="0" class="h-img"/> 
    <h1>Die deutsche Zen Cart Version muss erst installiert oder richtig konfiguriert werden</h1>
    <div>
      <h2>Sie bekommen diese Seite aus einem der folgenden Gründe angezeigt:</h2>
      <ol>
        
<li>Sie benutzen <strong>Zen Cart zum ersten Mal</strong> und haben noch keine Installation durchgeführt.<br />
Sollte das der Fall sein, dann
          <?php if ($instPath) { ?>
            <a href="<?php echo $instPath; ?>">CLICKEN SIE HIER</a> um die Installation zu starten.
          <?php } else { ?>
            dann laden Sie das Verzeichnis "zc_install" mit Ihrem FTP Programm in Ihr Shopverzeichnis hoch und rufen dann <a href="<?php echo $instPath; ?>">zc_install/index.php</a> in Ihrem Browser auf (oder laden Sie diese Seite erneut, um einen Link dahin angezeigt zu bekommen).
          <?php } ?>
<br /><br />
</li>
        <li>
          Es ist <strong>nicht das erstemal</strong> dass Sie Zen Cart verwenden und Sie haben kürzlich die Installation bereits abgeschlossen.
          <br>
          Sollte das der Fall sein, dann kann es folgende Gründe geben:
          <br>
          <ul style='list-style-type:square'>
            <li>
              Ihre zentralen Konfigurationsdateien <tt><strong>/includes/configure.php</strong></tt> und/oder <tt><strong>/admin/includes/configure.php</strong></tt> Dateien enthalten ungültige <em>Pfadangaben</em> und/oder ungültige <em>Angaben zur Datenbankverbindung</em>.
            <br>
            </li>
            <li>
              Sollten Sie kürzlich Ihre configure.php Dateien aus irgendwelchen Gründen geändert haben, oder Ihren Shop in ein anderes Verzeichnis/anderen Server verschoben haben, dann müssen Sie die entsprechenden Angaben in den beiden Dateien anpassen.
              <br>
            </li>
            <li>
              Oder, falls Sie die Lese- und Schreibrechte (chmod) für Ihre configure.php-Dateien geändert haben, dann sind sie vielleicht zu niedrig gesetzt für das Lesen der Dateien. 
              <br>
            </li>
            <li>
              Oder die configure.php Dateien fehlen aus irgendeinem Grund komplett.
              <br>
            </li>
            <li>
              Oder Ihr Webhosting-Provider hat kürzlich die PHP-Konfiguration des Servers geändert (oder die PHP-Version aktualisiert), das könnte ebenfalls solche Effekte haben. 
              <br>
            </li>
            <li>
              Weitere Informationen erhalten Sie im <a href="https://www.zen-cart-pro.at/forum" target="_blank">deutschsprachigen Supportforum</a>
            </li>
          </ul>
        </li>
        <?php if (isset($problemString) && $problemString != '') { ?>
          <br>
          <li>
            Zusätzliche <strong>*WICHTIGE*</strong> Hinweise: <span class="errorDetails"><?php echo $problemString; ?></span>
          </li>
        <?php } ?>
      </ol>
    </div>
    <div>
      <h2>Um die Installation zu starten:</h2>
      <ol>
          <?php if ($docsPath) { ?>
          <li>
            Lesen Sie vorab die <a href="https://www.zen-cart-pro.at/docs/156-deutsch-doku/" target="_blank">INSTALLATIONSANLEITUNG</a>
          </li>
        <?php } else { ?>
          <li>
           Die Installationsanleitung finden Sie online <a href="https://www.zen-cart-pro.at/docs/156-deutsch-doku/" target="_blank">hier</a> und auch im Ordner ANLEITUNG in der zip Datei des Zen Cart Downloads.
          </li>
        <?php } ?>
        <?php if ($instPath) { ?>
          <li>
            Rufen Sie <a href="<?php echo $instPath; ?>">zc_install/index.php</a> in Ihrem Browser auf.
          </li>
        <?php } else { ?>
<li>Sie müssen das Verzeichnis "zc_install" per FTP in Ihr Shopverzeichnis hochladen und dann <a href="<?php echo $instPath; ?>">zc_install/index.php</a> via Ihrem Browser aufrufen (oder laden Sie diese Seite erneut, um einen Link dahin angezeigt zu bekommen).</li>
        <?php } ?>
<li>Das <a href="https://www.zen-cart-pro.at/forum/forum.php" target="_blank">deutschsprachige Supportforum</a> steht Ihnen bei Problemen ebenfalls zur Verfügung.</li>
      </ol>
    </div>
  </div>
  </body>
</html>
