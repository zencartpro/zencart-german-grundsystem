<?php
/**
* @package languageDefines
* @copyright Copyright 2003-2005 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* translatet from: cyaneo/hugo13 / www.zen-cart.at / 31.03.06 
* @version $Id: gv_send.php 2 2006-03-31 09:55:33Z rainer $
*/

// TEXT_GV_NAME == 'Geschenkgutschein'
define('HEADING_TITLE', TEXT_GV_NAME . ' versenden');
define('HEADING_TITLE_CONFIRM_SEND', 'Sende ' . TEXT_GV_NAME . ' Bestätigung');    // new 1.3.0  
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . ' versendet');   // new 1.3.0  
define('NAVBAR_TITLE', TEXT_GV_NAME . ' versenden');
define('EMAIL_SUBJECT', 'Nachricht von ' . STORE_NAME);
define('HEADING_TEXT','<br />Bitte tragen Sie unten die Daten f&uuml;r den ' . TEXT_GV_NAME . ' ein, den Sie versenden m&ouml;chten. F&uuml;r weitere Informationen zum Thema ' . TEXT_GV_NAME . ', lesen Sie bitte die <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '</a>.<br />');
define('ENTRY_NAME','Name des Empf&auml;ngers:');
define('ENTRY_EMAIL','e-Mail Adresse des Empf&auml;ngers:');
define('ENTRY_MESSAGE','Ihre Nachricht an den Empf&auml;nger:');
define('ENTRY_AMOUNT','Betrag des ' . TEXT_GV_NAME . 's:');
define('ERROR_ENTRY_TO_NAME_CHECK', 'Wir erhielten den Empfängernamen nicht.  Füllen Sie ihn bitte unten aus. ');    // new 1.3.0  
define('ERROR_ENTRY_AMOUNT_CHECK','  <span class="errorText">Ung&uuml;ltiger oder zu hoher Betrag</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK','  <span class="errorText">Ung&uuml;ltige e-Mail Adresse</span>');
define('MAIN_MESSAGE','<br />Sie haben sich entschieden, einen ' . TEXT_GV_NAME . ' im Wert von <strong>%s</strong><br />an <strong>%s</strong>, mit der e-Mail Adresse <strong>%s</strong>, zu versenden.<br /><br /><br />Der Inhalt Ihrer Nachricht lautet:<br /><br />F&uuml;r %s<br />' .
                        'Sie haben einen ' . TEXT_GV_NAME . ' im Wert von <strong>%s</strong> von <strong>%s</strong> erhalten!');
define('SECONDARY_MESSAGE', 'Liebe(r)) %s,<br /><br />' . 'Du hast einen ' . TEXT_GV_NAME . ' im Wert on %s von %s erhalten');   // new 1.3.0  
define('PERSONAL_MESSAGE','%s schreibt:');
define('TEXT_SUCCESS','Herzlichen Gl&uuml;ckwunsch, der ' . TEXT_GV_NAME . ' wurde erfolgreich versendet.');
define('TEXT_SEND_ANOTHER', 'Wollen Sie einen weiteren ' . TEXT_GV_NAME . ' versenden?');    // new 1.3.0  
define('TEXT_AVAILABLE_BALANCE','Ihr derzeitiges Guthaben betr&auml;gt ');

define('EMAIL_GV_TEXT_SUBJECT','Ein Geschenk von %s');
define('EMAIL_SEPARATOR','-------------------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER','Herzlichen Gl&uuml;ckwunsch, Sie haben einen ' . TEXT_GV_NAME . ' im Wert von <strong>%s</strong> erhalten.');
define('EMAIL_GV_FROM','Dieser ' . TEXT_GV_NAME . ' wurde Ihnen von <strong>%s</strong> geschenkt');
define('EMAIL_GV_MESSAGE','<br />Mit der Nachricht:<br />');
define('EMAIL_GV_SEND_TO','Hallo, %s');
define('EMAIL_GV_REDEEM','Sie k&ouml;nnen Ihren ' . TEXT_GV_NAME . ' ab sofort einl&ouml;sen. Notieren Sie sich bitte hierf&uuml;r diesen ' . TEXT_GV_REDEEM . ': <strong>%s</strong> ' . "\n\n");
define('EMAIL_GV_LINK','Um den Gutschein einzul&ouml;sen, klicken Sie bitte auf den nachstehenden Link: ');
define('EMAIL_GV_VISIT','oder besuchen Sie');
define('EMAIL_GV_ENTER','und geben die ' . TEXT_GV_REDEEM . ' ein');
define('EMAIL_GV_FIXED_FOOTER','Sollten Sie Probleme mit dem Einl&ouml;sen des ' . TEXT_GV_NAME . ' &uuml;ber diesen Link haben,<br />k&ouml;nnen Sie den ' . TEXT_GV_REDEEM . ' Ihres ' . TEXT_GV_NAME . ' w&auml;hrend des Bestellvorgangs eingeben.<br /><br />');
define('EMAIL_GV_SHOP_FOOTER', 'Vielen Dank!<br /><br />Mit freundlichen Gr&uuml;ssen<br />Ihr ' . STORE_NAME . ' Team');
?>