<?php
/**
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: display_logs.php 2022-04-17 16:49:16Z webchills $
 */
define('HEADING_TITLE', 'Logfiles anzeigen');
define('TABLE_HEADING_FILENAME', 'Dateiname');
define('TABLE_HEADING_MODIFIED', 'geändert am');
define('TABLE_HEADING_FILESIZE', 'Dateigröße (bytes)');
define('TABLE_HEADING_DELETE', 'Löschen?');
define('TABLE_HEADING_ACTION', 'Aktion');
define('BUTTON_DELETE_SELECTED', 'ausgewählte löschen');
define('DELETE_SELECTED_ALT', 'Alle ausgewählten Dateien löschen');
define('BUTTON_DELETE_ALL', 'alle löschen');
define('DELETE_ALL_ALT', 'Lösche alle Dateien der aktuellen Ansicht');
define('ICON_INFO_VIEW', 'Inhalt dieser Datei anzeigen');
define('DISPLAY_DEBUG_LOGS_ONLY', 'Nur Debug Logs anzeigen?');
define('LOG_SORT_ASC', 'aufsteigend');
define('LOG_SORT_DESC', 'absteigend');
define('TEXT_HEADING_INFO', 'Inhalt der Datei');
// -----
// Sort-order descriptions, used in the instructions' display.
//
define('TEXT_MOST_RECENT', 'neueste');
define('TEXT_OLDEST', 'ältestes');
define('TEXT_SMALLEST', 'smallest');
define('TEXT_LARGEST', 'largest');
// -----
// The TEXT_INSTRUCTIONS string is passed into sprintf to produce the instructions given on the plugin's main display,
// using the following variables:
//
// %1$u ... The maximum size of a fully-displayed file.
// %2$s ... Contains a descriptive string identifying the current sort order
// %3$u ... The number of log files currently being displayed.
// %4$u ... The number of log files currently present in the log-related directories.
// %5$s ... The "included" prefixes for the log-files displayed.
// %6$s ... The "excluded" prefixes for the log-files displayed.
//
$imageName = zen_image(DIR_WS_IMAGES . 'icon_info.gif', ICON_INFO_VIEW);
define('TEXT_INSTRUCTIONS', '<br><br>Die Dateien können entweder in aufsteigender oder absteigender Reihenfolge nach dem letzten Änderungsdatum sortiert werden, indem Sie auf den <em>' . TABLE_HEADING_MODIFIED . '</em> Link klicken. Klicken Sie auf das ' . $imageName . ' Infosymbol, um den Inhalt der jeweiligen Datei anzuzeigen.  Es werden nur die ersten %u bytes der Datei ausgelesen; falls das Logfilesehr gross ist, wird seine Dateigröße <span class="bigfile">rot</span> hervorgehoben.<br><br>Anklicken des Buttons <strong>Alle löschen</strong> löscht alle Logfiles der aktuellen Ansicht. Anklicken des Buttons <strong>Ausgewählte löschen</strong> löscht nur die angekreuzten Logfiles.<br><br>Einstellungen zur Logfileanzeige auf dieser Seite können Sie unter Konfiguration > Protokollierung vornehmen.<br><br>Derzeitige Ansicht: %s %u von %u Logfiles.<br>');
define('JS_MESSAGE_DELETE_ALL_CONFIRM', 'Wollen Sie diese \'+n+\' Dateien wirklich löschen?');
define('JS_MESSAGE_DELETE_SELECTED_CONFIRM', 'Wollen Sie die ausgewählten Dateien wirklich löschen?');
define('WARNING_NOT_SECURE','<span class="errorText">HINWEIS: Sie haben SSL nicht aktiviert. Der Inhalt der Logfiles, die Sie über diese Seite anzeigen wird nicht verschlüsselt übertragen, das stellt ein Sicherheitsrisiko dar!</span>');
define('WARNING_NO_FILES_SELECTED', 'Es wurden keine Dateien zum Löschen ausgewählt!');
define('WARNING_SOME_FILES_DELETED', 'Warnung: Nur %u von %u Logfiles wurden gelöscht; überprüfen Sie die Dateiberechtigungen.');
define('SUCCESS_FILES_DELETED', '%u Logfiles wurden gelöscht.');