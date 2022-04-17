<?php
/** 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: mail.php 2022-04-17 16:23:14Z webchills $
 */
define('HEADING_TITLE','Email an Kunden senden');

define('TEXT_SUBJECT','Betreff:');
define('TEXT_FROM','Absender:');
define('TEXT_MESSAGE','Nur-Text <br>Nachricht:');
define('TEXT_MESSAGE_HTML', 'Rich-Text <br>Nachricht:');

define('TEXT_ATTACHMENTS_LIST', 'Ausgewählter Anhang: ');
define('TEXT_SELECT_ATTACHMENT', 'Anhang<br>auf dem Server: ');
define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD', 'Anhang<br>zum Hochladen<br>&amp; anhängen: ');
define('TEXT_ATTACHMENTS_DIR', 'Ordner für Upload: ');
define('NOTICE_EMAIL_SENT_TO','HINWEIS: E-Mail wurde versendet an: %s');
define('NOTICE_EMAIL_FAILED_SEND', 'HINWEIS: Die E-Mail konnte nicht an alle Empfänger verschickt werden: %s');
define('ERROR_NO_CUSTOMER_SELECTED','FEHLER: Es wurde kein Kunde ausgewählt.');
define('ERROR_NO_SUBJECT', 'FEHLER: Es wurde kein Betreff angegeben.');
define('ERROR_ATTACHMENTS', 'FEHLER: Sie können nicht beides - UPLOAD und HINZUFÜGEN - auswählen. Bitte wählen Sie nur eine von beiden Optionen.');
