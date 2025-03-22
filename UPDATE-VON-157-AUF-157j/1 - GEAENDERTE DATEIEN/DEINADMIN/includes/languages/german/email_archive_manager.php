<?php
/**
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: email_archive_manager.php 2024-04-08 09:50:16Z webchills $
 */
define('SUBJECT_SIZE_LIMIT', 25);
define('MESSAGE_SIZE_LIMIT', 550);
define('MESSAGE_LIMIT_BREAK', '...');
define('HEADING_TITLE', 'Email Archiv Manager');
define('HEADING_SEARCH_INSTRUCT', 'Sie können nach jeder Kombination der folgenden Kriterien suchen...');

define('HEADING_TEXT_INSTEAD', 'Zeige TEXT aus Sicherheitsgründen; HTML kann gefährlich sein.'); 
define('HEADING_MODULE_SELECT', 'Filter nach Modul');
define('HEADING_SEARCH_TEXT', 'Suche nach Text');
define('HEADING_SEARCH_TEXT_FILTER', 'Aktueller Suchfilter: ');
define('HEADING_START_DATE', 'Start Datum');
define('HEADING_END_DATE', 'End Datum');
define('HEADING_PRINT_FORMAT', 'Zeige Ergebnisse in Druckansicht');
define('HEADING_TRIM_INSTRUCT', 'Lösche Emails älter als...');

define('TABLE_HEADING_EMAIL_DATE', 'gesendet am');
define('TABLE_HEADING_CUSTOMERS_NAME', 'Name des Kunden');
define('TABLE_HEADING_CUSTOMERS_EMAIL', 'Email Adresse');
define('TABLE_HEADING_EMAIL_FORMAT', 'Format');
define('TABLE_HEADING_EMAIL_SUBJECT', 'Betreff');
define('TABLE_FORMAT_TEXT', 'TEXT');
define('TABLE_FORMAT_HTML', 'HTML');

define('TEXT_TRIM_ARCHIVE', 'Archiv verkleinern...');
define('TEXT_ARCHIVE_ID', 'Archiv #');
define('TEXT_ALL_MODULES', 'Alle Module');
define('TEXT_DISPLAY_NUMBER_OF_EMAILS', 'Zeige <b>%d</b> bis <b>%d</b> (von <b>%d</b> Emails)');
define('TEXT_EMAIL_MODULE', 'Modul: ');
define('TEXT_EMAIL_TO', 'An: ');
define('TEXT_EMAIL_FROM', 'Von: ');
define('TEXT_EMAIL_DATE_SENT', 'Gesendet: ');
define('TEXT_EMAIL_SUBJECT', 'Betreff: ');
define('TEXT_EMAIL_EXCERPT', 'Nachricht Auszug:');
define('TEXT_EMAIL_NUMBER', 'Email #');

define('RADIO_1_MONTH', ' 1 Monat');
define('RADIO_6_MONTHS', ' 6 Monate');
define('RADIO_1_YEAR', ' 12 Monate');
define('TEXT_RESEND_PREFIX','Erneut senden: ');
define('TRIM_CONFIRM_WARNING', 'Warnung: Dies wird Emails permanent aus dem Archiv löschen.<br>Sind Sie sicher?');
define('POPUP_CONFIRM_RESEND', 'Wollen Sie dieses Email wirklich erneut versenden?');
define('POPUP_CONFIRM_DELETE', 'Wollen Sie dieses Email wirklich löschen?');
define('SUCCESS_TRIM_ARCHIVE', 'Erfolg: Emails älter als <strong>%s</strong> wurden entfernt.');
define('SUCCESS_EMAIL_RESENT', 'Erfolg: Email #%s wurde erneut versandt an %s');
define('SUCCESS_EMAIL_DELETED', 'Erfolg: Email wurde gelöscht');

define('IMAGE_ICON_HTML', ' HTML Email ansehen ');
define('IMAGE_ICON_TEXT', ' Text Email ansehen ');
define('IMAGE_ICON_RESEND', ' Email erneut senden ');
define('IMAGE_ICON_EMAIL', ' Email Empfänger ');
define('IMAGE_ICON_DELETE', ' Nachricht löschen ');

define('SEND_NEW_EMAIL', 'Neue Email senden');
define('BUTTON_SEARCH', 'Archiv durchsuchen');
define('BUTTON_TRIM_CONFIRM', 'Email löschen');
define('BUTTON_CANCEL', 'Abbrechen');