<?php
/**
 * @package admin
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: layout_controller.php 575 2015-12-22 16:39:16Z webchills $
 */

define('HEADING_TITLE','Tabellenspalten');

define('TABLE_HEADING_LAYOUT_BOX_NAME','Dateiname der Box');
define('TABLE_HEADING_LAYOUT_BOX_STATUS','Linke/Rechte Spalte<br />Status');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE','Einzelne Spalte<br />Status');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION','Links oder Rechts<br />Spalte');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Spalte<br />Sortierung');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Spalte<br />Sortierung');
define('TABLE_HEADING_ACTION','Aktion');

define('TEXT_INFO_EDIT_INTRO','Führen Sie hier bitte die notwendigen Änderungen durch');
define('TEXT_INFO_LAYOUT_BOX','Ausgewählte Box:');
define('TEXT_INFO_LAYOUT_BOX_NAME','Name der Box:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','Links/Rechts<br /><br />Wenn Sie nur eine Spalte im Template anzeigen lassen, dann wird diese Einstellung ignoriert<br /><br />');
define('TEXT_INFO_LAYOUT_BOX_STATUS','Linke/Rechte Spalte<br /><br />Soll die Sidebox in der linken oder in der rechten Spalte im Template angezeigt werden?<br /><br />');
define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE','Einzelne Spalte Status<br /><br />Diese Einstellung müssen Sie nur machen, wenn Sie in Ihrem Template nur eine Spalte anzeigen lassen wollen.<br /><br />');
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','EIN= 1 AUS=0');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Spalte Sortierung<br /><br />Ein Eintrag muss nur erfolgen, wenn Sie im Template die linke UND die rechte Spalte anzeigen lassen.<br /><br />');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Spalte Sortierung<br /><br />Ein Eintrag muss nur erfolgen, wenn Sie im Template NUR EINE SPALTE anzeigen lassen.<br /><br />');
define('TEXT_INFO_INSERT_INTRO','Tragen Sie bitte die neue Box mit den notwendigen Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diese Box wirklich löschen?');
define('TEXT_INFO_HEADING_NEW_BOX','Neue Box');
define('TEXT_INFO_HEADING_EDIT_BOX','Box bearbeiten');
define('TEXT_INFO_HEADING_DELETE_BOX','Box löschen');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','Lösche fehlende Box aus der Templateliste: ');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','HINWEIS: Dieser Vorgang löscht keine Dateien und Sie können die Box wieder hinzufügen, in dem Sie die dazu notwendigen Dateien in das dafür vorgesehene Verzeichnis kopieren.<br /><br /><strong>Lösche Box: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','Setze die Sortierung aller Boxen für dieses Template auf die STANDARDWERTE zurück:');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','Dieser Vorgang löscht keine dieser Boxen. Es wird nur die aktuellen Sortierung zurückgesetzt');
define('TEXT_INFO_BOX_DETAILS','Boxdetails:');
define('TEXT_INFO_SET_AS_DEFAULT','Die Boxdetails als Defaultwert speichern ');
define('SUCCESS_BOX_SET_DEFAULTS','Die Boxdetails wurden gespeichert: ');

////////////////

define('HEADING_TITLE_LAYOUT_TEMPLATE','Seitenlayout Vorlage (Template)');

define('TABLE_HEADING_LAYOUT_TITLE','Titel');
define('TABLE_HEADING_LAYOUT_VALUE','Wert');

define('TEXT_MODULE_DIRECTORY','Verzeichnis des Seitenlayouts:');
define('TEXT_INFO_DATE_ADDED','Erstellt am:');
define('TEXT_INFO_LAST_MODIFIED','Letzte Änderung:');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT','Layout');
define('BOX_LAYOUT_COLUMNS','Spaltenlayout Einstellungen');

// file exists
define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<font color="ff0000"><b>FEHLT</b></font><br />');


// Success message
define('SUCCESS_BOX_DELETED','Das Template der Box wurde entfernt:');
define('SUCCESS_BOX_RESET','Alle Einstellungen wurden auf die Standardeinstellungen zurückgesetzt:');
define('SUCCESS_BOX_UPDATED','Die Einstellungen der Box wurden aktualisiert:');

define('TEXT_ON','EIN ');
define('TEXT_OFF','AUS ');
define('TEXT_LEFT','LINKS ');
define('TEXT_RIGHT','RECHTS ');