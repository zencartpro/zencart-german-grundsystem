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
// $Id: gv_faq.php 293 2008-05-28 21:10:40Z maleborg $
//

define('NAVBAR_TITLE', TEXT_GV_NAME . ' FAQ');
define('HEADING_TITLE', TEXT_GV_NAME . ' FAQ');
define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Wie bestelle ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Wie versende ich ' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Einkaufen mit ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Einlösen von ' . TEXT_GV_NAMES . 'n</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Wenn Probleme auftreten</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','Wie bestelle ich ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT', TEXT_GV_NAMES . ' können Sie ganz normal wie andere Artikel unseres Shops bestellen. Bezahlen können Sie bei uns mit den herkömmlichen Bezahlarten.
  Ist die Bestellung eines ' . TEXT_GV_NAME . 's abgeschlossen, wird der Wert Ihrem persönlichen
   ' . TEXT_GV_NAME . 'konto gutgeschrieben. In Ihrem persönlichen Warenkorb erscheint der eingelöste Betrag Ihres ' . TEXT_GV_NAME . 'kontos. Zusätzlich erscheint ein Link Ihres ' . TEXT_GV_NAME . 's, den Sie dann an Freunde und Bekannte per E-Mail weiterleiten können.');
  break;
  case '2':
define('SUB_HEADING_TITLE','Wie versende ich ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Um einen ' . TEXT_GV_NAME . ' zu versenden, brauchen Sie nur auf unsere ' . TEXT_GV_NAME . ' - Versandseite zu gehen. Den Link hierfür finden Sie in Ihrem persönlichen Warenkorb.
  Beim Versenden eines ' . TEXT_GV_NAME . 's müssen Sie folgende Daten angeben:<br />
  Den <strong>Namen</strong> der Person, der Sie den ' . TEXT_GV_NAME . ' senden möchten.<br />
  Die <strong>E-Mail Adresse</strong> der Person, der Sie den ' . TEXT_GV_NAME . ' senden möchten.<br />
  Den <strong>Betrag</strong>, den Sie versenden möchten.<br /> (HINWEIS: Sie müssen nicht den gesamten Betrag des ' . TEXT_GV_NAME . 'kontos verwenden.)<br /><br />
  Sie erhalten zusätzlich per E-Mail eine kurze Information.
Um Fehler zu vermeiden, stellen Sie bitte sicher, dass Sie alle Daten korrekt eingegeben haben. Sie werden später zusätzlich noch einmal die Gelegenheit haben, Ihre Angaben zu überprüfen, bevor Sie den Gutschein versenden.');

  break;
  case '3':
define('SUB_HEADING_TITLE','Einkaufen mit ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Wenn Ihr ' . TEXT_GV_NAME . 'konto Guthaben aufweist, können Sie
  damit andere Artikel in unserem Shop kaufen. Während des Bestellvorgangs wird ein zusätzliches Eingabefeld erscheinen.<br /> Geben Sie dort bitte die Höhe des Betrages an, den Sie von Ihrem ' . TEXT_GV_NAME . 'konto abheben wollen.
  Sollte der Bestellwert das Guthaben Ihres ' . TEXT_GV_NAME . 'kontos überschreiten, können Sie für den Differenzbetrag die gewünschte Zahlungsweise wählen.
  Ist der Bestellwert geringer als das Guthaben Ihres ' . TEXT_GV_NAME . 'kontos, bleibt das Restguthaben Ihres ' . TEXT_GV_NAME . 'kontos natürlich für weitere Einkäufe bestehen.');

  break;
  case '4':
define('SUB_HEADING_TITLE','Einlösen von ' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','Beim Erhalt eines ' . TEXT_GV_NAME . ' per E-Mail werden Ihnen darin der Absender, der Wert des ' . TEXT_GV_NAME . 's, sowie eine kurze Nachricht des Absenders mitgeteilt. Die
E-Mail beinhaltet auch noch den ' . TEXT_GV_NAME . ' mit dem ' . TEXT_GV_REDEEM . '. Wir empfehlen Ihnen, sich Ihren ' . TEXT_GV_NAME . ' für den späteren Gebrauch auszudrucken.<br /><br /><u>Sie können Ihren ' . TEXT_GV_NAME . ' nun auf
  zwei Arten einlösen:</u><br /><br />
  1. Durch Klicken auf den mitgesendeten Link der E-Mail,
  der Sie direkt auf die  ' . TEXT_GV_NAME . 'seite bringen wird. Damit dieser ' . TEXT_GV_NAME . ' gültig wird, müssen Sie - sofern Sie noch keines besitzen - ein Konto in unserem Shop erstellen.
  Nach erfolgreicher Anmeldung wird Ihnen das Guthaben dieses Gutscheins auf Ihr <br /><br /><center><strong>persönliches ' . TEXT_GV_NAME . 'konto</strong></center><br /> gutgeschrieben. Ab sofort können sie nun dieses Guthaben für Ihre Zwecke verwenden.<br /><br />
  2. Während des Bestellvorgangs können Sie auf der Seite, auf der Sie Ihre <strong>Zahlungsweise</strong> angeben, auch den ' . TEXT_GV_REDEEM . ' eingeben. Geben Sie Ihren persönlichen ' . TEXT_GV_REDEEM . ' ein und
  klicken Sie abschließend auf "Einlösen". Nach einer kurzen Überprüfung auf Gültigkeit des einzulösenden ' . TEXT_GV_NAME . 's wird das Guthaben Ihrem persönlichen ' . TEXT_GV_NAME . 'konto gutgeschrieben.<br />Ab sofort können Sie nun den Betrag zu Ihrem Zweck verwenden.');

  break;
  case '5':
define('SUB_HEADING_TITLE','Wenn Probleme auftreten.');
define('SUB_HEADING_TEXT','Für Fragen zu unserem ' . TEXT_GV_NAME . ' System wenden Sie sich bitte an unseren
Service, den Sie unter <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS .'">' . STORE_OWNER_EMAIL_ADDRESS . '</a> erreichen. Um Ihnen rasch helfen zu können, geben Sie hierfür bitte möglichst viele Informationen an. ');


  break;
  default:
define('SUB_HEADING_TITLE','');
define('SUB_HEADING_TEXT','Bitte wählen Sie Ihr Thema, zudem Sie Fragen haben.');

  }

define('TEXT_GV_REDEEM_INFO', 'Bitte geben Sie Ihren  ' . TEXT_GV_NAME . ' Code ein: ');
define('TEXT_GV_REDEEM_ID', 'Gutscheincode:');
