<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * Translator:           klartexter unter Verwendung der
 *                       Vorlagen von cyaneo/hugo13               
 * Date of Translation:  06.09.2006                                 
 * Homepage:             www.zen-cart.at                                
 * @version $Id: newsletters.php 4385 2006-09-04 04:10:48Z drbyte $
 */

define('HEADING_TITLE','Newsletter Manager');

define('TABLE_HEADING_NEWSLETTERS','Newsletter');
define('TABLE_HEADING_SIZE','Gr&ouml;&szlig;e');
define('TABLE_HEADING_MODULE','Module');
define('TABLE_HEADING_SENT','gesendet');
define('TABLE_HEADING_STATUS','Status');
define('TABLE_HEADING_ACTION','Aktion');

define('TEXT_NEWSLETTER_MODULE','Module:');
define('TEXT_NEWSLETTER_TITLE','Titel des Newsletters:');
define('TEXT_NEWSLETTER_CONTENT','NUR-Text <br />Inhalt:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'Rich-Text <br />Inhalt:');

define('TEXT_NEWSLETTER_DATE_ADDED','Erstelldatum:');
define('TEXT_NEWSLETTER_DATE_SENT','Gesendet am:');

define('TEXT_INFO_DELETE_INTRO','Wollen Sie diesen Newsletter wirklich l&ouml;schen?');

define('TEXT_PLEASE_WAIT','Bitte warten... e-Mails werden versendet ..<br><br>Bitte unterbrechen Sie diesen Prozess keinesfalls!');
define('TEXT_FINISHED_SENDING_EMAILS','e-Mail Versand abgeschlossen!');

define('TEXT_AFTER_EMAIL_INSTRUCTIONS','%s e-Mails versendet. <br /><br />Kontrollieren Sie die Mailbox ('.EMAIL_FROM.') f&uuml;r:<UL><LI>a) Zur&uuml;ckgesendete Nachrichten</LI><LI>b) e-Mail Adressen, die nicht mehr g&uuml;ltig sind</LI><LI>c) removal requests.</LI></UL>Die Listen k&ouml;nnen Sie in der Kundendatenbank im Admin | Kunden Menu bearbeiten.');

define('ERROR_NEWSLETTER_TITLE','Fehler: Geben Sie bitte den Titel des Newsletter ein');
define('ERROR_NEWSLETTER_MODULE','Fehler: Das Newsletter Modul wird dazu ben&ouml;tigt.');
define('ERROR_PLEASE_SELECT_AUDIENCE','Fehler: Bitte w&auml;hlen Sie die Zielgruppe, die den Newsletter erhalten soll');
?>
