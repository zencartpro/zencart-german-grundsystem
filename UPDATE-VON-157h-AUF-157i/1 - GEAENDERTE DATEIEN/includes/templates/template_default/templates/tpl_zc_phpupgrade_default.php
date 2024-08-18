<?php
/**
 * PHP Upgrade Template Page
 * Zen Cart German Specific (zencartpro adaptations)
 * This page is auto-displayed if the PHP version is too old.
 * It's primarily intended to be a friendlier face than just a blank page
 * which would appear if incompatible PHP expectations were triggered.
 * This way someone installing Zen Cart on an ancient PHP version will at least
 * know this basic need and be able to make the change before proceeding.
 * For the German Zen Cart Version we force at least PHP 7.4.x
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: tpl_zc_phpupgrade_default.php  2024-08-18 07:11:17 webchills $
 */
$relPath = (file_exists('includes/templates/template_default/images/logo.gif')) ? '' : '../';
include 'includes/version.php';
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <title>Ihre PHP Version ist veraltet</title>    
    <meta content="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="authors" content="The Zen Cart&reg; Team and others">
    <meta name="generator" content="Zen-Cart 1.5.7 - deutsche Version, http://www.zen-cart-pro.at">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
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
    <img src="<?php echo $relPath; ?>includes/templates/template_default/images/logo.gif" alt="www.zen-cart-pro.at - Die deutsche Zen Cart Version" title="www.zen-cart-pro.at - Die deutsche Zen Cart Version" width="240" height="70" border="0" class="h-img"/>
    <h1>Willkommen bei der deutschen Zen Cart Version</h1>
    <div>
      <h2>Wir würden uns sehr freuen, wenn Sie die deutsche Zen Cart Version einsetzen, allerdings ist Ihr Server nicht mit unserer Software kompatibel.</h2>
        <p>Ihre PHP Version (<?php echo PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;?>) ist zu alt, enthält Sicherheitslücken und unterstützt moderne PHP Syntax nicht.</p>
        <p>Sie wollen die deutsche Zen Cart Version <?php echo PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR; ?> installieren oder auf diese Version aktualisieren oder haben diese Version auf Ihren Server hochgeladen.</p>
        <p>Für die deutsche Zen Cart Version 1.5.7i ist mindestens PHP 8.0.x erforderlich.</p>
        <p>Geeignete PHP Versionen für diese Zen Cart Version sind PHP 8.3.x, PHP 8.2.x oder PHP 8.0.x</p>
        <p>Um Zen Cart auf diesem Server weiterverwenden zu können, müssen Sie Ihre PHP Version aktualisieren.</p>
        <p>Wir empfehlen PHP 8.3.x zu verwenden. Die PHP Version können Sie normalerweise in der Serveradministration Ihres Providers umstellen.</p>
        <p>Bei den meisten Providern ist es auch möglich, für bestimmte Unterverzeichnisse bestimmte PHP Versionen zu aktivieren.</p>
        <p>Wenn Ihre Haupt PHP Version z.B. PHP 8.0 ist und die aus irgendeinem Grund für eine bestehende Applikation auch unbedingt erforderlich ist, dann laden Sie die deutsche Zen Cart Version in ein Unterverzeichnis und stellen nur für dieses Unterverzeichnis PHP 8.0.x ein.</p>
        <p>Bitte wenden Sie sich an Ihren Provider, wenn Sie Fragen dazu haben.</p>
        <br><br>
    </div>
    <section id="footerBlock">
      <div class="appInfo">
        
        <p class="zenData">
          Copyright 2004 - <?php echo date('Y'); ?> <a href="https://www.zen-cart-pro.at" rel="noopener" target="_blank">www.zen-cart-pro.at - Die deutsche Zen Cart Version</a><br>the art of e-commerce - übersetzt, angepasst und erweitert zur Verwendung im deutschsprachigen Raum
         
        </p>
      </div>
    </section> <!-- End footerBlock //-->
  </div>
  </body>
</html>
