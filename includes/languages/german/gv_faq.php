<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
// $Id: gv_faq.php 2 2006-03-31 09:55:33Z rainer $
// 

define('NAVBAR_TITLE', TEXT_GV_NAME . ' FAQ');
define('HEADING_TITLE', TEXT_GV_NAME . ' FAQ');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Wie bestelle ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Wie versende ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Einkaufen mit ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Einl&ouml;sen von ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Wenn Probleme auftreten</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','Wie bestelle ich ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT', TEXT_GV_NAMES . ' k&ouml;nnen Sie ganz normal wie andere Artikel unseres Shops bestellen. Bezahlen k&ouml;nnen Sie bei uns mit den herk&ouml;mmlichen Bezahlarten.
  Ist die Bestellung eines ' . TEXT_GV_NAME . ' abgeschlossen, wird der Wert Ihrem pers&ouml;nlichen
   ' . TEXT_GV_NAME . 'konto gutgeschrieben. In Ihrem pers&ouml;nlichen Warenkorb erscheint der eingel&ouml;ste Betrag Ihres ' . TEXT_GV_NAME . 'kontos. Zus&auml;tzlich erscheint ein Link Ihres ' . TEXT_GV_NAME . 's, den Sie dann an Freunde und Bekannte per e-Mail weiterleiten k&ouml;nnen.');



  break;
  case '2':
define('SUB_HEADING_TITLE','Wie versende ich ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Um einen ' . TEXT_GV_NAME . ' zu versenden, brauchen Sie nur auf unsere ' . TEXT_GV_NAME . ' - Versandseite zu gehen. Den Link hierf&uuml;r finden Sie in Ihrem pers&ouml;nlichen Warenkorb (In der rechten Spalte oben auf jeder Seite des Shops).
  Beim Versenden eines ' . TEXT_GV_NAME . ', m&uuml;ssen Sie folgende Daten angeben:<br />
  Den <strong>Namen</strong> der Person, der Sie den ' . TEXT_GV_NAME . ' senden m&ouml;chten.<br />
  Die <strong>e-Mail Adresse</strong> der Person, der Sie den ' . TEXT_GV_NAME . ' senden m&ouml;chten.<br />
  Den <strong>Betrag</strong>, den Sie versenden m&ouml;chten.<br /> (Hinweis: Sie m&uuml;ssen nicht den gesamten Betrag des ' . TEXT_GV_NAME . 'kontos verwenden.)<br /><br />
  Sie erhalten zus&auml;tzlich per e-Mail eine kurze Information.
Um Fehler zu vermeiden, stellen Sie bitte sicher, dass Sie alle Daten korrekt eingegeben haben. Sie werden sp&auml;ter zus&auml;tzlich noch einmal die Gelegenheit haben, Ihre Angaben zu &uuml;berpr&uuml;fen, bevor Sie den Gutschein versenden.');




  break;
  case '3':
define('SUB_HEADING_TITLE','Einkaufen mit ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Wenn Ihr ' . TEXT_GV_NAME . 'konto Guthaben aufweist, k&ouml;nnen Sie
  damit andere Artikel in unserem Shop kaufen. W&auml;hrend des Bestellvorgangs wird ein zus&auml;tzliches Eingabefeld erscheinen.<br /> Geben Sie dort bitte die H&ouml;he des Betrages an, den Sie von Ihrem ' . TEXT_GV_NAME . 'konto abheben wollen.
  Sollte der Bestellwert das Guthaben Ihres ' . TEXT_GV_NAME . 'kontos &uuml;berschreiten, k&ouml;nnen Sie f&uuml;r den Differenzbetrag die gew&uuml;nschte Zahlungsweise w&auml;hlen.
  Ist der Bestellwert geringer als das Guthaben Ihres ' . TEXT_GV_NAME . 'kontos, bleibt das Restguthaben Ihres ' . TEXT_GV_NAME . 'kontos nat&uuml;rlich f&uuml;r weitere Eink&auml;ufe bestehen.');




  break;
  case '4':
define('SUB_HEADING_TITLE','Einl&ouml;sen von ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Beim Erhalt eines ' . TEXT_GV_NAME . ' per e-Mail werden Ihnen darin der Absender, der Wert des ' . TEXT_GV_NAME . ', sowie eine kurze Nachricht des Absenders mitgeteilt. Das
e-Mail beinhaltet auch noch den ' . TEXT_GV_NAME . ' mit dem ' . TEXT_GV_REDEEM . '. Wir empfehlen Ihnen, sich Ihren ' . TEXT_GV_NAME . ' f&uuml;r den sp&auml;teren Gebrauch auszudrucken.<br /><br /><u>Sie k&ouml;nnen Ihren ' . TEXT_GV_NAME . ' nun auf
  zwei Arten einl&ouml;sen:</u><br /><br />
  1. Durch klicken auf den mitgesendeten Link des e-Mails,
  der Sie direkt auf die  ' . TEXT_GV_NAME . 'seite bringen wird. damit Sie dieser ' . TEXT_GV_NAME . ' g&uuml;ltig wird, m&uuml;ssen Sie - sofern Sie noch keines besitzen - ein Konto in unserem Shop erstellen.
  Nach erfolgreicher Anmeldung wird Ihnen das Guthaben dieses Gutscheins auf Ihr <br /><br /><center><strong>pers&ouml;nliches ' . TEXT_GV_NAME . 'konto</strong></center><br /> gutgeschrieben. Ab sofort k&ouml;nnen sie nun dieses Guthaben f&uuml;r Ihre Zwecke verwenden.<br /><br />
  2. W&auml;hrend des Bestellvorgangs k&ouml;nnen Sie auf der Seite, auf der Sie Ihre <strong>Zahlungsweise</strong> angeben, auch den ' . TEXT_GV_REDEEM . ' eingeben. Geben Sie Ihren pers&ouml;nlichen ' . TEXT_GV_REDEEM . ' ein und
  klicken Sie abschlie&szlig;end auf "einl&ouml;sen". Nach einer kurzen Überpr&uuml;fung auf G&uuml;ltigkeit des einzul&ouml;senden ' . TEXT_GV_NAME . 's wird das Guthaben Ihrem pers&ouml;nlichen ' . TEXT_GV_NAME . 'konto gutgeschrieben.<br />Ab sofort k&ouml;nnen Sie nun des Betrag zu Ihrem Zweck verwenden.');





  break;
  case '5':
define('SUB_HEADING_TITLE','Wenn Probleme auftreten.');
define('SUB_HEADING_TEXT','F&uuml;r Fragen zu unserem ' . TEXT_GV_NAME . ' System wenden Sie sich bitte an unseren
Service, den Sie unter <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS .'">' . STORE_OWNER_EMAIL_ADDRESS . '</a> erreichen. Um Ihnen rasch helfen zu k&ouml;nnen, geben Sie hierf&uuml;r bitte m&ouml;glichst viele Informationen an. ');

  break;
  default:
define('SUB_HEADING_TITLE','');
define('SUB_HEADING_TEXT','Bitte w&auml;hlen Sie Ihr Thema, zudem Sie Fragen haben.');

  }
?>
