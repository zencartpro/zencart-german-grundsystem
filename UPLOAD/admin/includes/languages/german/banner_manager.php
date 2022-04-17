<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: banner_manager.php 2022-04-17 16:41:14Z webchills $
 */

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_BANNERS', 'Bannerwerbungen');
define('TABLE_HEADING_GROUPS', 'Gruppen');
define('TABLE_HEADING_STATISTICS', 'Anzeige / Klicks');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS', 'Neues Fenster');
define('TABLE_HEADING_BANNER_ON_SSL', 'Auf SSL Seiten anzeigen');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_BANNER_SORT_ORDER', 'Sortier<br>folge');

define('TEXT_BANNERS_TITLE', 'Name des Banner:');
define('TEXT_BANNERS_URL', 'Banner URL:');
define('TEXT_BANNERS_GROUP', 'Bannergruppe:');
define('TEXT_BANNERS_NEW_GROUP', ', oder tragen Sie unten eine neue Bannergruppe ein');
define('TEXT_BANNERS_IMAGE', 'Bild:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', oder tragen Sie unten eine lokale Datei ein');
define('TEXT_BANNERS_IMAGE_TARGET', 'Zielverzeichnis des Bildes (Speichern unter):');
define('TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>Vorgeschlagenes Zielverzeichnis:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/');
define('TEXT_BANNERS_HTML_TEXT_INFO', '<strong>HINWEIS: HTML-Banner zeichnen die Klicks nicht auf</strong>');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_ALL_SORT_ORDER', 'Sortierung - banner_box_all');
define('TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>Anmerkung: Die banners_box_all Sidebox zeigt die Banner in der angegebenen Sortierung an</strong>');
define('TEXT_BANNERS_EXPIRES_ON', 'Banner wird angezeigt bis:');
define('TEXT_BANNERS_OR_AT', ', oder nach');
define('TEXT_BANNERS_IMPRESSIONS', 'Einblendungen automatisch deaktiviert.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Geplant für:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Banner Hinweis:</b><ul><li>Benutzen Sie entweder ein Bild oder einen HTML Text ,aber nicht beides.</li><li>HTML Text hat eine höhere Priorität als ein Bild</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Bildhinweis:</b><ul><li>Sie müssen Schreibrechte auf das Uploadverzeichnis haben!</li><li>Wenn Sie kein Bild auf den Server laden wollen, lassen Sie das Eingabefeld "Speichern unter" leer (z.B. wenn Sie ein lokales Bild (serverseitig) verwenden.</li><li>Im Eingabefeld "Speichern unter" muss ein bereits existierendes Verzeichnis und ein abschließender "Slash" eingetragen werden (z.B. banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRY_NOTE', '<b>"Banner wird angezeigt bis" Hinweis:</b><ul><li>Nur eines der beiden Felder sollte ausgefüllt werden werden</li><li>Wenn der Banner zeitlich nicht automatisch enden soll, lassen Sie diese Felder leer</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Zeitplan Hinweis:</b><ul><li>Wenn ein Zeitplan erstellt wurde, wird der Banner mit diesem Datum aktiviert.</li><li>Alle geplanten Banner sind bis zum erstellten Zeitplan als inaktiv markiert. Danach werden sie automatisch aktiviert</li></ul>');
define('TEXT_BANNERS_STATUS', 'Bannerstatus:');
define('TEXT_BANNERS_ACTIVE', 'Aktiv');
define('TEXT_BANNERS_NOT_ACTIVE', 'Nicht aktiv');
define('TEXT_INFO_BANNER_STATUS', '<strong>Hinweis:</strong> Der Bannerstatus wird basierend auf den vorhandenen Einstellungen für Zeitplan und Einblendungen aktualisiert');
define('TEXT_BANNERS_OPEN_NEW_WINDOWS', 'Banner in neuem Fenster');
define('TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>Hinweis:</strong> Banner öffnet sich in einem neuen Fenster');
define('TEXT_BANNERS_ON_SSL', 'Banner mit SSL');
define('TEXT_INFO_BANNER_ON_SSL', '<strong>Hinweis:</strong> Banner kann auf SSL Seiten ohne Fehler angezeigt werden');

define('TEXT_BANNERS_DATE_ADDED', 'Hinzugefügt am:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Startet am: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Endet am: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Endet nach: <b>%s</b> Einblendungen');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status ändern: %s');


define('TEXT_BANNERS_LAST_3_DAYS', 'Die letzten 3 Tage');
define('TEXT_BANNERS_BANNER_VIEWS', 'Bannereinblendungen');
define('TEXT_BANNERS_BANNER_CLICKS', 'Bannerklicks');

define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher dass Sie diesen Banner löschen wollen?');
define('TEXT_INFO_DELETE_IMAGE', 'Bannerbild löschen');

define('SUCCESS_BANNER_INSERTED', 'Erfolgreich: Der Banner wurde eingefügt.');
define('SUCCESS_BANNER_UPDATED', 'Erfolgreich: Der Bannerstatus wurde aktualisiert.');
define('SUCCESS_BANNER_REMOVED', 'Erfolgreich: Der Banner wurde entfernt.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Erfolgreich: Der Bannerstatus wurde aktualisiert.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fehler: Ein Bannername wird benötigt.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fehler: Eine Bannergruppe wird benötigt.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fehler: Bild existiert nicht');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fehler: Bild kann nicht entfernt werden');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Fehler: Unbekannter Status gesetzt.');
define('ERROR_BANNER_IMAGE_REQUIRED', 'Fehler: Banner Bild erforderlich.');



define('TEXT_LEGEND_BANNER_ON_SSL', 'SSL anzeigen');
define('TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', 'Neues Fenster');

// Tooltip Text for images in Banner Manager
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON', 'Neues Fenster öffnen - EIN');
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF', 'Neues Fenster öffnen - AUS');
define('IMAGE_ICON_BANNER_ON_SSL_ON', 'Auf SSL Seiten darstellen - EIN');
define('IMAGE_ICON_BANNER_ON_SSL_OFF', 'Auf SSL Seiten darstellen - AUS');

define('SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', 'Erfolgreich: Der Status des Banners zum Öffnen in einem neuen Fenster ist aktualisiert worden .');
define('SUCCESS_BANNER_ON_SSL_UPDATED', 'Erfolgreich: Der Status des Banners zum Darstellen auf SSL Seiten ist aktualisiert worden .');