<?php
/**
 * @package Shopvote
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: shopvote.php 2019-07-26 16:13:51Z webchills $
 */

require('includes/application_top.php');

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <style>
    #itrk-illu {
    float: right;
    width:270px;
    }
    #itrkinfo a {
    font-size:12px;
    color: #EF7D00;
    text-decoration:underline;
}
</style>
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>

    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
    
  </head>

<body onLoad="init()" >
      <!-- header //-->
      <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
      <!-- header_eof //-->
      <div class="container-fluid">
        <!-- body //-->
        
<div id="itrkinfo">
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
      <!-- body_text //-->
      <td class="boxCenter" width="100%" valign="top">
      	
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td width="100%">
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                 
                  <td class="pageHeading">Shopvote: Bewertungsbadge und Easy Reviews</td>
                </tr>
               
              </table>
              
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                 
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 20px 10px 11px 3px; text-align: left">
                  	<b>Ihre aktuellen Einstellungen:</b></td>
                </tr><tr>
                 
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: left">
                  	<div id="itrk-illu"><img src="images/shopvote/shopvote.png" align="right" /></div>
                  	Modulversion: <?php echo SHOPVOTE_MODUL_VERSION; ?> für Zen Cart deutsch<br>
                  	 Modul aktiv?: <?php echo SHOPVOTE_STATUS; ?><br>
                  	 Ihre Shopvote ID: <?php echo SHOPVOTE_SHOP_ID; ?><br>
                  	 Ihre Shopvote Easy Reviews Token: <?php echo SHOPVOTE_EASY_REVIEWS_TOKEN; ?><br>
                  	 Badge Typ: <?php echo SHOPVOTE_BADGE_TYPE; ?> <br><br>
                  	 <b>Shopvote Integration in Zen Cart:</b>
<br><br>
Dieses Modul integriert EasyReviews auf der Checkout Success Seite, so dass ein Fenster erscheint, in dem der Kunde auswählen kann, ob er eine Shopbewertung abgeben will oder nicht.<br>
Und das Bewertungsbadge mit Link zum Bewertungsprofil wird rechts unten auf jeder Shopseite angezeigt.<br>Badge und Bewertungsanfrage sind automatisch multilingual (in den von Shopvote unterstützten Sprachen), falls im Shop verschiedene Sprachen aktiv sind.<br>  
Es stehen vier Arten des Bewertungsbadge zur Verfügung, die alle auch die Shopvote Funktion Rating Stars unterstützen, so dass dafür kein zusätzlicher Code integriert werden muss.<br>
Für Kunden der <a href="it_recht_kanzlei.php">IT Recht Kanzlei</a> sind alle Shopvote Premium Funktionen völlig kostenlos!             	                   	 
                  	 </td>
                </tr>
                <tr>
                 
                 <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: left">Um Einstellungen zu ändern, verwenden Sie den Menüpunkt Konfiguration > Shopvote Konfiguration<br><br>Bitte lesen Sie die Hinweise zur Konfiguration in der <a href="https://www.zen-cart-pro.at/docs/156-deutsch-doku/addons/shopvote/index.html" target="_blank">Onlinedokumentation der deutschen Zen Cart Version</a>.</td>
                </tr>
               
              </table>
            </td>
          </tr>
          <tr>
            <td>
            	
              <table class="tableCenter">
                
                <tr style="background-color: #FFFFFF;">
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: justify">
                                
                   
                 
                    <br>
                    <font size="3"><b>Was ist Shopvote</b></font><br />
                    <br />
                    
Seit über 10 Jahren vertrauen Verbraucher und Unternehmen auf Shopvote als Experten für Online-Bewertungen.<br>
Kostenlos. Unabhängig. Zuverlässig.
<br><br>
Einige der kostenlosen Shopvote Features:
<br><br>
<b>Bewertungen ohne Limit</b><br>
Vergessen Sie Bewertungslimits. Bei SHOPVOTE können Sie unbegrenzt Bewertungen sammeln. Egal, ob 10 oder 1000 Bewertungen im Monat - je mehr Kundenmeinungen Sie sammeln, umso aussagekräftiger wird Ihr Bewertungsprofil.
<br><br>
<b>Übergabe Ihrer Bewertungen an Google</b><br>
Wenn Sie auf SHOPVOTE Bewertungen sammeln, werden diese ohne zusätzliche Kosten automatisch an Google übergeben. So können potenzielle Neukunden in der Google-Suche auf den ersten Blick erkennen, wie gut Sie sind. Das sorgt für mehr Vertrauen und kann zu höherem Traffic und mehr Umsatz führen.
<br><br>
<b>Ihre Bewertungen und Sterne in Google Adwords™</b><br>
SHOPVOTE ist eines von wenigen in Deutschland ansässigen Bewertungsportalen (ca. 30 weltweit; Stand: Oktober 2015), dessen Bewertungen in den Google AdWords™ angezeigt werden. Die Einbindung von Bewertungen in Ihre AdWords-Anzeigen kann für einen größeren Erfolg Ihrer Anzeigen und eine höhere Click-Through-Rate sorgen. Diese Funktion ist bei SHOPVOTE kostenlos.
<br><br>
<b>Ihre Bewertungen und Sterne in Google Shopping™</b><br>
Durch die Anzeige der Bewertungen und Sterne in Google Shopping™, können Sie als Verkäufer sofort zeigen, dass Sie ein tolles Einkaufserlebnis bieten. Zeigen Sie, dass Ihre Kunden zufrieden sind und es Spaß macht, bei Ihnen zu shoppen. Für die Darstellung Ihrer Bewertungen und Sterne müssen Sie nicht mehr tun, als Ihr Unternehmen bei SHOPVOTE einzutragen, den Rest erledigt SHOPVOTE.
<br><br>
<b>Ihr öffentliches Bewertungsprofil</b><br>
Nach der Anmeldung und der anschließenden Aufnahme bei SHOPVOTE, erhalten Sie sofort Ihr Bewertungsprofil. Dort können Sie alle relevanten Einstellungen wie z.B. Ihr Logo, Unternehmensbeschreibung, Videos zum Unternehmen, Social-Media-Kanäle und vieles mehr einstellen. Ihre Kunden sehen auf den ersten Blick alle wichtigen Informationen zu Ihrem Unternehmen.
<br><br>
<b>Effizienter Schutz vor Bewertungsmissbrauch</b><br>
Seit seiner Gründung betreibt SHOPVOTE einen Manipulationsschutz, der ständig verbessert und weiterentwickelt wird. Auch wenn es keine 100%ige Sicherheit gibt, ist das System zuverlässig in der Lage, unzulässige Bewertungen zu erkennen. So entsteht ein glaubwürdiges Bewertungsprofil, von dem auch Sie als Unternehmen profitieren.
<br><br>
<b>Auf Bewertungen reagieren</b><br>
Als eines der ersten Bewertungsportale hat SHOPVOTE die Anwortfunktion für Bewertungen eingeführt. Diese Funktion bietet Ihnen die Möglichkeit, auf Kundenmeinungen zu reagieren. Ihre Antworten sind für alle sichtbar. Leser können somit sehen, dass sich sich aktiv mit den Wünschen Ihrer Kunden auseinandersetzen. Das fördert Vertrauen und repräsentiert hohes Service-Bewusstsein.
<br><br>
<b>Bewertungsgrafiken für jeden Anwendungsbereich</b><br>
SHOPVOTE bietet eine Vielzahl von Bewertungsgrafiken, in unterschiedlichen Formen und Größen. Die Grafiken können sehr einfach in Ihre Webseite integriert werden. Ihre guten Bewertungen bilden somit eine Grundlage für Kundenvertrauen und fördern den Verkauf. Ihnen stehen im Händlerbereich Grafiken für Web, Print und TV zur Verfügung.
<br><br>
Eine Übersicht aller kostenlosen Features finden Sie auf: <a href="https://www.shopvote.de/features#kostenlos" target=_blank">www.shopvote.de/features#kostenlos</a>
<br><br>
Einige der kostenpflichtigen Premium Addons bei Shopvote (für Kunden der IT-Recht Kanzlei kostenlos!):
<br><br>
<b>EasyReviews - Noch einfacher Bewertungen sammeln</b><br>
Ihre Kunden werden direkt nach dem Einkauf gefragt, ob sie nach Erhalt der Bestellung eine Bewertung abgeben möchten. Nach einem von Ihnen festgelegten Zeitfenster erhalten Ihre Kunden voll automatisch die Bewertungsanfrage. Natürlich: Datenschutzkonform und transparent.
<br><br>
<b>AllVotes - Externe Bewertungsprofile bei ShopVote integrieren</b><br>
Integrieren Sie bis zu 5 externe Bewertungprofile aus anerkannten Portalen und Verkaufsplattformen. Erweitern Sie damit Ihr Bewertungsprofil bei ShopVote und öffnen Sie diese Verkaufskanäle für alle Besucher Ihres Bewertungsprofils.
<br><br>
<b>Bewertungssterne für Ihre Suchergebnisse bei Google (RatingStars)</b><br>
Das Addon RatingStars ermöglicht es, dass die beliebten Bewertungssterne auch für die Suchergebnisse Ihrer Webseite (auch Unterseiten) in der organischen Suche bei Google angezeigt werden können. Suchergebnisse mit Sternen erhalten eine höhere Aufmerksamkeit und können zu einer höheren Klickrate führen.
<br><br>
Eine Übersicht aller Premium Adons finden Sie auf: <a href="https://www.shopvote.de/features#premium" target=_blank">www.shopvote.de/features#premium</a>
<br><br>        </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
      </tr>
<!-- body_text_eof //-->
    </table>   
</div>
  <!-- body_text_eof //-->
      </div>
      <!-- body_eof //-->
      <!-- footer //-->
  <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
      <!-- footer_eof //-->
    </body>
  </html>