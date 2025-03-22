<?php
/** 
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: layout_controller.php 2023-10-28 16:49:16Z webchills $
 */

define('HEADING_TITLE','Bearbeite Sideboxen für Template:');
define('TEXT_CURRENTLY_VIEWING' , 'Derzeitige Ansicht: ');
define('TEXT_THIS_IS_PRIMARY_TEMPLATE' , ' (Haupt)');
define('TABLE_HEADING_LAYOUT_BOX_NAME','Dateiname der Box');
define('TABLE_HEADING_LAYOUT_BOX_STATUS','Linke/Rechte Spalte<br>Status');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE','Einzelne Spalte<br>Status');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION','Links oder Rechts<br>Spalte');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Spalte<br>Sortierung');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Spalte<br>Sortierung');

define('TEXT_INFO_LAYOUT_BOX','Ausgewählte Box:');
define('TEXT_INFO_LAYOUT_BOX_NAME','Name der Box:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','Ort: (Einzelspalte ignoriert diese Einstellung)');
define('TEXT_INFO_LAYOUT_BOX_STATUS','Linke/Rechte Spalte Status: ');

define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE','Einzelne Spalte Status: ');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER','Linke/Rechte Spalte Sortierung');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE','Einzelne Spalte Sortierung');
define('TEXT_INFO_INSERT_INTRO','Tragen Sie bitte die neue Box mit den notwendigen Daten ein');
define('TEXT_INFO_DELETE_INTRO','Wollen Sie diese Box wirklich löschen?');

define('TEXT_INFO_HEADING_EDIT_BOX','Box bearbeiten');
define('TEXT_INFO_HEADING_DELETE_BOX','Box löschen');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','Lösche fehlende Box aus der Templateliste: ');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','HINWEIS: Dieser Vorgang löscht keine Dateien und Sie können die Box wieder hinzufügen, in dem Sie die dazu notwendigen Dateien in das dafür vorgesehene Verzeichnis kopieren.<br><br><strong>Lösche Box: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','Setze die Sortierung aller Boxen für dieses Template auf die STANDARDWERTE zurück:');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','Dieser Vorgang löscht keine dieser Boxen. Es wird nur die aktuellen Sortierung zurückgesetzt');
define('TEXT_SETTINGS_COPY_FROM' , 'Kopiere Status/Sortierung Einstellungen VON: ');
define('TEXT_SETTINGS_COPY_TO' , ' ZU: ');
define('TEXT_ERROR_INVALID_RESET_SUBMISSION' , 'FEHLER: Ungültig Wahl zum Zurücksetzen');
define('TEXT_INFO_BOX_DETAILS','Boxdetails:');

define('TABLE_HEADING_LAYOUT_TITLE','Titel');
define('TABLE_HEADING_LAYOUT_VALUE','Wert');

define('TABLE_HEADING_BOXES_PATH', 'Sideboxen Pfad: ');
define('TEXT_WARNING_NEW_BOXES_FOUND', 'WARNUNG: Neue Sideboxen gefunden: ');
define('TEXT_MODULE_DIRECTORY','Verzeichnis des Seitenlayouts:');

define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<span class="txt-red"><b>FEHLT</b></span><br>');

define('SUCCESS_BOX_DELETED','Das Template der Box wurde entfernt:');
define('SUCCESS_BOX_RESET','Alle Einstellungen wurden auf die Standardeinstellungen zurückgesetzt:');
define('SUCCESS_BOX_UPDATED','Die Einstellungen der Box wurden aktualisiert:');

define('TEXT_ON','EIN ');
define('TEXT_OFF','AUS ');
define('TEXT_LEFT','LINKS ');
define('TEXT_RIGHT','RECHTS ');
define('TEXT_CAUTION_EDITING_NOT_LIVE_TEMPLATE' , 'VORSICHT: Sie bearbeiten Einstellungen eines Templates, das nicht das Haupt Template im Frontend ist.');
define('TEXT_RESET_SETTINGS' , 'Einstellungen zurücksetzen');
define('TEXT_ORIGINAL_DEFAULTS' , '[Original/Zen Cart Voreinstellungen]');