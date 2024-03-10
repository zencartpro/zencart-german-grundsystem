<?php
/**
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: display_logs.php 2023-11-11 10:49:16Z webchills $
 */
define('HEADING_TITLE', 'Logfiles anzeigen');
define('TABLE_HEADING_FILENAME', 'Dateiname');
define('TABLE_HEADING_MODIFIED', 'Datum');
define('TABLE_HEADING_FILESIZE', 'Dateigröße (bytes)');
define('TABLE_HEADING_DELETE', 'Ausgewählt');

define('BUTTON_INVERT_SELECTED' , 'Auswahl umkehren');
define('BUTTON_DELETE_SELECTED', 'ausgewählte löschen');
define('DELETE_SELECTED_ALT', 'Alle ausgewählten Dateien löschen');
define('BUTTON_DELETE_ALL', 'alle löschen');
define('DELETE_ALL_ALT', 'Lösche alle Dateien der aktuellen Ansicht');
define('ICON_INFO_VIEW', 'Inhalt dieser Datei anzeigen');
define('DISPLAY_DEBUG_LOGS_ONLY', 'Nur Debug Logs anzeigen?');
define('TEXT_HEADING_INFO', 'Inhalt der Datei');
define('TEXT_MOST_RECENT', 'neueste');
define('TEXT_OLDEST', 'ältestes');
define('TEXT_SMALLEST', 'kleinstes');
define('TEXT_LARGEST', 'größtes');
define('TEXT_INSTRUCTIONS', '<p>Die Dateien können auf- oder absteigend sortiert werden, indem Sie auf die <em>Asc</em>- oder <em>Desc</em>-Spaltenlinks klicken.</p> <p>Klicken Sie auf ein %7$s-Symbol, um den Inhalt der zugehörigen Datei anzuzeigen. Nur die ersten %1$u Bytes der ausgewählten Datei werden gelesen/angezeigt; wenn eine Datei &quot;übergroß&quot; ist, wird ihre <em>Dateigröße</em> wie <span class="bigfile">diese</span> hervorgehoben.</p><ul><li><strong>Alle löschen</strong> löscht alle derzeit angezeigten Dateien. </li><li><strong>Ausgewählte löschen</strong> löscht nur die Dateien mit markierten Kontrollkästchen.</li><li><strong>Auswahl umkehren</strong> tauscht markierte Dateien gegen nicht markierte aus und umgekehrt. Wenn Sie z.B. alle Dateien bis auf eine löschen wollen, markieren Sie die zu behaltende Datei, dann "Auswahl umkehren" und schließlich "Ausgewählte löschen".</li></ul><p>Zur Zeit werden die %2$s %3$u von %4$u Protokolldateien angezeigt, die diese Präfixe haben:<br><code>%5$s</code><br>und <b>nicht</b> mit einem (optionalen) benutzerdefinierten Präfix übereinstimmen: <code>%6$s</code></p>');
define('JS_MESSAGE_DELETE_ALL_CONFIRM', 'Wollen Sie diese \'+n+\' Dateien wirklich löschen?');
define('JS_MESSAGE_DELETE_SELECTED_CONFIRM', 'Wollen Sie die ausgewählten Dateien wirklich löschen?');
define('WARNING_NOT_SECURE','<span class="errorText">HINWEIS: Sie haben SSL nicht aktiviert. Der Inhalt der Logfiles, die Sie über diese Seite anzeigen wird nicht verschlüsselt übertragen, das stellt ein Sicherheitsrisiko dar!</span>');
define('WARNING_NO_FILES_SELECTED', 'Es wurden keine Dateien zum Löschen ausgewählt!');
define('WARNING_SOME_FILES_DELETED', 'Warnung: Nur %u von %u Logfiles wurden gelöscht; überprüfen Sie die Dateiberechtigungen.');
define('SUCCESS_FILES_DELETED', '%u Logfiles wurden gelöscht.');