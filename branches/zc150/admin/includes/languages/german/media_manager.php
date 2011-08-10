<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: media_manager.php 302 2008-05-30 19:49:12Z maleborg $
//

define('HEADING_TITLE_MEDIA_MANAGER', 'Medienmanager');

define('TABLE_HEADING_MEDIA', 'Name der Kollektion');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_HEADING_NEW_MEDIA_COLLECTION', 'Neue Medienkollektion');
define('TEXT_NEW_INTRO', 'Bitte tragen Sie die notwendigen Details für die neue Medienkollektion unten ein');
define('TEXT_MEDIA_COLLECTION_NAME', 'Name der Medienkollektion');
define('TEXT_MEDIA_EDIT_INSTRUCTIONS', 'Zum Ändern des Namens der Medienkollektion verwenden Sie bitte die obere Sektion. Klicken Sie anschließend auf "Speichern".<br /><br />
                                        Verwenden Sie die untere Sektion, um Medien zur Medienkollektion hinzuzufügen oder von dieser zu entfernen.');
define('TEXT_DATE_ADDED', 'Erstellt am:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_PRODUCTS', 'Verlinkte Artikel:');
define('TEXT_CLIPS', 'Verlinkte Clips:');
define('TEXT_NO_PRODUCTS', 'Keine Artikel in dieser Kategorie');
define('TEXT_HEADING_EDIT_MEDIA_COLLECTION', 'Medienkollektion bearbeiten');
define('TEXT_EDIT_INTRO', 'Bitte korrigieren Sie unterhalb die Details der neuen Medienkollektion');
define('TEXT_HEADING_DELETE_MEDIA_COLLECTION', 'Medienkollektion löschen');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Medienkollektion löschen wollen?');
define('TEXT_DISPLAY_NUMBER_OF_MEDIA', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Medienkollektionen)');
define('TEXT_ADD_MEDIA_CLIP', 'Medien hinzufügen');
define('TEXT_MEDIA_CLIP_DIR', 'Zum Medienverzeichnis hochladen');
define('TEXT_MEDIA_CLIP_TYPE', 'Medientyp');
define('TEXT_HEADING_ASSIGN_MEDIA_COLLECTION', 'Medienkollektion Artikel zuteilen');
define('TEXT_PRODUCTS_INTRO', 'Verwenden Sie bitte unten stehendes Formular, um diese Medienkollektion von Artikel zu entfernen oder Artikel zuzuteilen.');
define('IMAGE_PRODUCTS', 'Zu Artikel zuteilen');
define('TEXT_DELETE_PRODUCTS', 'Soll diese Medienkollektion und alle Verlinkungen zu dieser Kollektion gelöscht werden?');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNUNG:</b> Es gibt %s Verlinkungen zu dieser Medienkollektion!');
define('TEXT_WARNING_FOLDER_UNWRITABLE', 'Hinweis: Das Verzeichnis ' . DIR_FS_CATALOG_MEDIA . ' ist nicht beschreibbar. Kann Dateien nicht hochladen.');

define('ERROR_UNKNOWN_DATA', 'FEHLER: Unbekannte Daten geliefert... Operation abgebrochen');
define('TEXT_ADD', 'Hinzufügen');
