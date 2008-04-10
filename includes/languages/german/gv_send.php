<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @translator: cyaneo/hugo13/wflohr	http://www.zen-cart.at	2006-11-02
 * @version $Id$
 */

define('HEADING_TITLE', TEXT_GV_NAME . ' versenden');
define('HEADING_TITLE_CONFIRM_SEND', 'Sende ' . TEXT_GV_NAME . ' Bestätigung');
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . ' versendet');
define('NAVBAR_TITLE', TEXT_GV_NAME . ' versenden');
define('EMAIL_SUBJECT', 'Nachricht von ' . STORE_NAME);
define('HEADING_TEXT','<br />Bitte tragen Sie unten die Daten für den ' . TEXT_GV_NAME . ' ein, den Sie versenden möchten. Für weitere Informationen zum Thema ' . TEXT_GV_NAME . ', lesen Sie bitte die <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '</a>.<br />');
define('ENTRY_NAME','Name des Empfängers:');
define('ENTRY_EMAIL','E-Mail Adresse des Empfängers:');
define('ENTRY_MESSAGE','Ihre Nachricht an den Empfänger:');
define('ENTRY_AMOUNT','Betrag des ' . TEXT_GV_NAME . 's:');
define('ERROR_ENTRY_TO_NAME_CHECK', 'Wir erhielten den Empfängernamen nicht.  Füllen Sie ihn bitte unten aus. ');
define('ERROR_ENTRY_AMOUNT_CHECK','??<span class="errorText">Ungültiger oder zu hoher Betrag</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK','??<span class="errorText">Ungültige E-Mail Adresse</span>');
define('MAIN_MESSAGE','<br />Sie haben sich entschieden, einen ' . TEXT_GV_NAME . ' im Wert von <strong>%s</strong><br />an <strong>%s</strong>, mit der E-Mail Adresse <strong>%s</strong>, zu versenden.<br /><br /><br />Der Inhalt Ihrer Nachricht lautet:<br />');
define('SECONDARY_MESSAGE', 'Liebe(r)) %s,<br /><br />' . 'Du hast einen ' . TEXT_GV_NAME . ' im Wert on %s von %s erhalten');
define('PERSONAL_MESSAGE','%s schreibt:');
define('TEXT_SUCCESS','Herzlichen Glückwunsch, der ' . TEXT_GV_NAME . ' wurde erfolgreich versendet.');
define('TEXT_SEND_ANOTHER', 'Wollen Sie einen weiteren ' . TEXT_GV_NAME . ' versenden?');
define('TEXT_AVAILABLE_BALANCE','Ihr derzeitiges Guthaben beträgt ');
define('EMAIL_GV_TEXT_SUBJECT','Ein Geschenk von %s');
define('EMAIL_SEPARATOR','-------------------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER','Herzlichen Glückwunsch, Sie haben einen ' . TEXT_GV_NAME . ' im Wert von <strong>%s</strong> erhalten.');
define('EMAIL_GV_FROM','Dieser ' . TEXT_GV_NAME . ' wurde Ihnen von <strong>%s</strong> geschenkt');
define('EMAIL_GV_MESSAGE','<br />Mit der Nachricht:<br />');
define('EMAIL_GV_SEND_TO','Hallo %s,');
define('EMAIL_GV_REDEEM','Sie können Ihren ' . TEXT_GV_NAME . ' ab sofort einlösen. Notieren Sie sich bitte hierfür diesen ' . TEXT_GV_REDEEM . ': <strong>%s</strong> ' . "\n\n");
define('EMAIL_GV_LINK','Um den Gutschein einzulösen, klicken Sie bitte auf den nachstehenden Link: ');
define('EMAIL_GV_VISIT','oder besuchen Sie');
define('EMAIL_GV_ENTER','und geben die ' . TEXT_GV_REDEEM . ' ein');
define('EMAIL_GV_FIXED_FOOTER','Sollten Sie Probleme mit dem Einlösen des ' . TEXT_GV_NAME . ' über diesen Link haben,<br />können Sie den ' . TEXT_GV_REDEEM . ' Ihres ' . TEXT_GV_NAME . ' während des Bestellvorgangs eingeben.<br /><br />');
define('EMAIL_GV_SHOP_FOOTER', 'Vielen Dank!<br /><br />Mit freundlichen Grüssen<br />Ihr ' . STORE_NAME . ' Team');


?>
