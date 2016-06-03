<?php
/**
 * @package IT Recht Kanzlei
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: it_recht_kanzlei.php 2016-06-01 09:13:51Z webchills $
 */

require('includes/application_top.php');

if (!is_null($_GET['token']) && $_GET['token'] == 'new') { 
	generate_new_token();
	zen_redirect(zen_href_link(FILENAME_IT_RECHT_KANZLEI));
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<style>
#itrk-illu {
    float: right;
    widt:270px;
}
</style>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
  </head>
<body onload="init()">
  <!-- header //-->
  <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
  <!-- header_eof //-->
  <!-- body //-->
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
                 
                 <td colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; padding: 0px 10px 11px 3px; text-align: left">Um Einstellungen zu ändern, verwenden Sie den Menüpunkt Konfiguration > IT Recht Kanzlei<br/><br/>Bitte lesen Sie die Hinweise zur Konfiguration in der diesem Modul beiliegenden Installationsanleitung.</td>
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
                    Das Zen Cart Schnittstellen-Modul f&uuml;r den e-Commerce in Deutschland aktualisiert automatisch ihre Rechtstexte &ndash; so bleiben Sie 
                    dauerhaft vor Abmahnungen gesch&uuml;tzt und k&ouml;nnen sich ganz entspannt ihrem operativen Gesch&auml;ft widmen.<br />
                    <br />
                    
                    <br />
                    Das Modul stellt Ihnen die folgenden Rechtstexte zur Verf&uuml;gung:
                    <ul>
                      <li style="list-style-type: circle !important;"><strong>AGB</strong></li>
                      <li style="list-style-type: circle !important;"><strong>Widerrufsbelehrung</strong></li>
                      <li style="list-style-type: circle !important;"><strong>Datenschutzerkl&auml;rung</strong></li>
                      <li style="list-style-type: circle !important;"><strong>Impressum</strong></li>
                    </ul>
                    <br />
                    Die Einbindung funktioniert ganz einfach: Sie beantworten online ein paar Fragen zu Ihren Unternehmen. Anhand ihrer Angaben werden f&uuml;r 
                    Ihren Shop optimierte Rechtstexte erstellt und mittels des Schnittstellenmoduls der IT-Recht Kanzlei automatisch an den richtigen Positionen 
                    dargestellt. Sobald die Rechtslage sich &auml;ndert, aktualisieren die Anw&auml;lte der IT-Recht Kanzlei alle betroffenen Texte; die &Auml;nderungen 
                    werden dann automatisch in Ihrem Webshop und - falls Sie das Modul pdf Rechnung verwenden - Ihren eMails eingepflegt.<br />Und wie f&uuml;r Anwaltskanzleien &uuml;blich, haftet die IT-Recht Kanzlei 
                    auch f&uuml;r die Richtigkeit ihrer Texte. So unterst&uuml;tzen wir Sie nicht nur mit dauerhaft aktuellen Texten, sondern auch durch ein minimales 
                    finanzielles Risiko. Das gibt ihnen die Sicherheit, optimal vor Abmahnungen gesch&uuml;tzt zu sein und sich in Ruhe dem operativen Gesch&auml;ft widmen 
                    zu k&ouml;nnen.
                    <br /><br />
                    Ihre Vorteile auf einen Blick:
                    <br />
                    <ul>
                      <li style="list-style-type: circle !important;"><strong>Anwaltlich erstellte Dokumente f&uuml;r Ihren Webshop</strong></li>
                      <li style="list-style-type: circle !important;"><strong>St&auml;ndige und automatisierte Aktualisierung f&uuml;r dauerhafte Rechtssicherheit</strong></li>
                      <li style="list-style-type: circle !important;"><strong>Bequeme Integration durch das Schnittstellen-Modul</strong></li>
                      <li style="list-style-type: circle !important;"><strong>Selbstverst&auml;ndlich: Haftung f&uuml;r die Richtigkeit der Texte</strong></li>
                    </ul>
                    <p align="left">
                      <br />
                      <a href="http://www.it-recht-kanzlei.de/Service/agb-online-shop.php?partner_id=zencartde" target="_blank"><font size="3" color="#EF7D00"><u><strong>Jetzt den Update-Service der IT-Recht Kanzlei buchen.</strong></u></font></a> 
                    </p>
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
    </td>
    </tr>
  </table>
  <!-- body_eof //-->
  <!-- footer //-->
  <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
  <!-- footer_eof //-->
  <br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>