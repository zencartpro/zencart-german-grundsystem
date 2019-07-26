<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: it_recht_kanzlei.php 2 2019-07-26 16:22:51Z webchills $
 */

require('includes/application_top.php');

if (!is_null($_GET['token']) && $_GET['token'] == 'new') { 
	generate_new_token();
	zen_redirect(zen_href_link(FILENAME_IT_RECHT_KANZLEI));
}
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
                 
                  <td class="pageHeading">Schnittstellenmodul der IT-Recht Kanzlei München: Entspannter e-Commerce.</td>
                </tr>
               
              </table>
              
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                 
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 20px 10px 11px 3px; text-align: left">
                  	<b>Ihre aktuellen Einstellungen:</b></td>
                </tr><tr>
                 
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: left">
                  	<div id="itrk-illu"><img src="images/it_recht_kanzlei/it_recht_kanzlei.png" align="right" /></div>
                  	Modulversion: <?php echo IT_RECHT_KANZLEI_MODUL_VERSION; ?> für Zen Cart deutsch<br/>
                  	 Modul aktiv?: <?php echo IT_RECHT_KANZLEI_STATUS; ?><br/>
                  	 Ihre API Token: <?php echo IT_RECHT_KANZLEI_TOKEN; ?><br/>
                  	 Ihre Shop URL: <?php echo HTTP_CATALOG_SERVER.DIR_WS_CATALOG ; ?>
                  	 <br/><br/>
                  	 Ihre API Token und Shop URL müssen Sie in Ihrem Kundenbereich der IT Recht Kanzlei hinterlegen.<br/>
                  	 Falls Sie eine neue API Token erstellen möchten, clicken Sie bitte <a href="<?php echo zen_href_link(FILENAME_IT_RECHT_KANZLEI, 'token=new') ?>">hier</a>.
                  	 </td>
                </tr>
                <tr>
                 
                 <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: left">Um Einstellungen zu ändern, verwenden Sie den Menüpunkt Konfiguration > IT Recht Kanzlei<br/><br/>Bitte lesen Sie die Hinweise zur Konfiguration in der <a href="https://www.zen-cart-pro.at/docs/156-deutsch-doku/addons/it-recht-kanzlei/index.html" target="_blank">Onlinedokumentation der deutschen Zen Cart Version</a>.</td>
                </tr>
               
              </table>
            </td>
          </tr>
          <tr>
            <td>
            	
              <table class="tableCenter">
                
                <tr style="background-color: #FFFFFF;">
                  <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: justify">
                    <div id="itrk-illu">
            		
                    <img src="images/it_recht_kanzlei/pruefzeichen-partner3.png" align="right" />
                  </div>                 
                   
                 
                    <br/>
                    <font size="3"><b>AGB-Service für Zen Cart der IT-Recht Kanzlei für mtl. 9,90 Euro - monatlich kündbar</b></font><br />
                    <br />
                    Abmahnsichere Rechtstexte für Zen Cart der IT-Recht Kanzlei<br/>
Individuell angepasst & schnell verfügbar<br/>
Automatische Überwachung & Aktualisierung durch die AGB-Schnittstelle
                    <br /><br/>
                    
                    „Die IT-Recht Kanzlei hat bereits weit über 40.000 gewerbliche Online-Präsenzen abgesichert“
                    
                    <br/><br/>
                    
                    <a href="http://www.it-recht-kanzlei.de/agb-starterpaket.php?partner_id=229" target="_blank"><font size="3" color="#EF7D00"><u><strong>Jetzt das Starter-Paket der IT-Recht Kanzlei buchen -></strong/></u></font></a>
                    <br/><br/>
                    <b>Warum IT-Recht Kanzlei ?</b>
                    <br/><br/>
                    
                    Mit dem AGB-Service der IT-Recht Kanzlei für Zen Cart erhalten Sie abmahnsichere Rechtstexte die durch die Fachanwälte der Kanzlei ständig überprüft und aktuell gehalten werden. Nach der einmaligen One-Klick-Installation überwacht und aktualisiert die - ohne Zusatzkosten -  im Leistungsumfang enthaltene AGB-Schnittstelle die Rechtstexte automatisch. Egal ob Übertragungsprobleme, beschädigte Seiten oder vielleicht doch einmal ein Serverausfall – falls die IT-Recht Kanzlei bei den Rechtstexten einen Fehler registriert, werden Sie umgehend informiert.
<br/><br/>

<b>Schutz vor Abmahnungen bei voller Kostenflexibiliät</b><br/>
Sie können diesen AGB-Service genau so lange nutzen, wie Sie ihn brauchen und bei Bedarf jederzeit monatlich kündigen. Es ist kein Jahres-Abo und keine Mitgliedschaft erforderlich.
<br/><br/>
                    <b>Vorteile unseres AGB-Service für Zen Cart</b>
                    <ul>
                      <li style="list-style-type: circle !important;">Abmahnsichere AGB, Widerrufsbelehrung, Datenschutzerklärung & Impressum</li>
                      <li style="list-style-type: circle !important;">Mehr als 50 kostenfreie eCommerce Muster & Handlungsanleitungen</li>
                      <li style="list-style-type: circle !important;">Komfortable Integration in Ihren Zen Cart-Shop über die AGB-Schnittstelle</li>
                      <li style="list-style-type: circle !important;">Automatische Überwachung und Aktualisierung der Rechtstexte</li>
                       <li style="list-style-type: circle !important;">Keine Einrichtungsgebühr & keine versteckten Kosten</li>
                        <li style="list-style-type: circle !important;">Keine Mitgliedschaft erforderlich</li>
                        <li style="list-style-type: circle !important;">Jederzeit monatlich kündbar</li>
                        <li style="list-style-type: circle !important;">Auf Wunsch inklusive anwaltlicher Tiefenprüfung Ihrer Zen Cart Präsenz auf rechtliche Fallstricke (z.B. im Bestellablauf & -prozess) im Rahmen unseres Unlimited-Pakets: <a href="http://www.it-recht-kanzlei.de/agb-paket-unlimited.php" target="_blank">http://www.it-recht-kanzlei.de/agb-paket-unlimited.php</a></li>
                    </ul>
                    <br />
                   <b>Selbstverständlich: Anwaltliche Haftung</b>
                   <br/><br/>
                   Wie andere Rechtsanwaltskanzleien haften auch wir im Rahmen der gesetzlichen Bestimmungen für die Abmahnsicherheit der Rechtstexte.
                    <br /><br />
                 <font size="3"><b>So geht´s</b></font>
<br/><br/>
<a href="http://www.it-recht-kanzlei.de/agb-starterpaket.php?partner_id=229" target="_blank"><font size="3" color="#EF7D00"><u><strong>Jetzt das Starter-Paket der IT-Recht Kanzlei buchen -></strong></u></font></a> 
<br/><br/>
Danach erhalten Sie Ihre Zugangsdaten zu unserem Mandantenportal. Dort können Sie Ihre Rechtstexte komfortabel individualisieren und anschließend einmalig über die AGB-Schnittstelle in Ihren Zen Cart Shop integrieren.
<br/><br/>
Bei Fragen zur Integration stehen wir Ihnen natürlich sehr gerne – kostenfrei- zur Seite.
<br/><br/>
<b>Support</b><br/>
Bei Fragen vor und nach Ihrer AGB-Service Anforderung stehen wir Ihnen telefonisch unter der Rufnummer 089-1304 433-0 oder per Mail unter info@it-recht-kanzlei.de zur Verfügung.
                  </td>
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