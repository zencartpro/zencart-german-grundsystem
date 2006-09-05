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
//  $Id: newsletter.php 4 2006-03-31 16:38:40Z hugo13 $
//

define('TEXT_COUNT_CUSTOMERS', 'Kunden, die Newsletter erhalten: %s');
define('HEADING_TITLE', 'Newsletter Manager');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletter');
define('TABLE_HEADING_SIZE', 'Gr&ouml;&szlig;e');
define('TABLE_HEADING_MODULE', 'Modul');
define('TABLE_HEADING_SENT', 'gesendet');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_NEWSLETTER_MODULE', 'Modul:');
define('TEXT_NEWSLETTER_TITLE', 'Betreff:');
define('TEXT_NEWSLETTER_CONTENT', 'nur Text <br />Inhalt:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'HTML <br />Inhalt:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Erstelldatum:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Gesendet am:');

define('TEXT_INFO_DELETE_INTRO', 'Wollen Sie diesen Newsletter wirklich l&ouml;schen?');

define('TEXT_PLEASE_SELECT_AUDIENCE', ' Bitte w&auml;hlen Sie das Publikum f&uuml;r diesen Newsletter: ');
define('TEXT_PLEASE_WAIT', 'Bitte warten .. sende e-Mails ..<br /><br />Bitte diesen Prozess nicht unterbrechen!');
define('TEXT_FINISHED_SENDING_EMAILS', 'Die e-Mails wurden versendet!');

define('ERROR_NEWSLETTER_TITLE', 'Fehler: Ein Titel wird f&uuml;r den Newsletter ben&ouml;tigt');
define('ERROR_NEWSLETTER_MODULE', 'Fehler: Das Newsletter Modul wird ben&ouml;tigt');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Fehler: Sie m&uuml;ssen den Newsletter vor dem L&ouml;schen sperren.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Fehler: Sie m&uuml;ssen den Newsletter erst sperren, bevor Sie ihn bearbeiten k&ouml;nnen.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Fehler: Sie m&uuml;ssen den Newsletter vor dem Senden sperren.');
?>
