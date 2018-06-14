<?php
/**
 * mod Image Handler 5.1
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 *
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright 2005-2006 Tim Kroeger (original author)
 * @revisited by ckosloff/DerManoMann/C Jones/Nigelt74/K Hudson/Nagelkruid
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_image_handler.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 * Last modified by webchills and cjones 2012-03-10 17:46:50 
 * Last modified by lat9 2018-05-29
 */

define('IH_VERSION_VERSION', 'Version');
define('IH_VERSION_NOT_FOUND', 'Keine Image Handler Versionsnummer gefunden.');

define('IH_VIEW_CONFIGURATION', 'Zeige Image Handler Konfiguration');
define('IH_CLEAR_CACHE', 'Bildcache löschen');
define('IH_CACHE_CLEARED', 'Bildcache gelöscht.');


define('IH_SOURCE_TYPE', 'Bildtyp (original)');
define('IH_SOURCE_IMAGE', 'Originalbild');
define('IH_SMALL_IMAGE', 'Vorschaubild');
define('IH_MEDIUM_IMAGE', 'Produktbild');



define('IH_ADD_NEW_IMAGE', 'Neues Bild hinzufügen');
define('IH_NEW_NAME_DISCARD_IMAGES', 'Neuer Bildname, zusätzliche Produktbilder wegwerfen');
define('IH_NEW_NAME_COPY_IMAGES', 'Neuer Bildname, zusätzliche Produktbilder mitnehmen');
define('IH_KEEP_NAME', 'Alten Bildnamen verwenden, zusätzliche Produktbilder behalten');
define('IH_DELETE_FROM_DB_ONLY', 'Nur Bildreferenz aus der Datenbank löschen');

define('IH_HEADING_TITLE', 'Image Handler 5');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Bitte wählen Sie ein Produkt aus um dessen zu Bilder bearbeiten.');

define('TABLE_HEADING_PHOTO_NAME', 'Bildname');
define('TABLE_HEADING_BASE_SIZE', 'Grundbild');
define('TABLE_HEADING_SMALL_SIZE','Kleines Bild');
define('TABLE_HEADING_MEDIUM_SIZE', 'Mittleres Bild');
define('TABLE_HEADING_LARGE_SIZE','Großes Bild');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_FILETYPE', 'Dateityp');

define('TEXT_PRODUCT_INFO', 'Artikel');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer');
define('TEXT_IMAGE_BASE_DIR', 'Bildverzeichnis');
define('TEXT_NO_PRODUCT_IMAGES', 'Es existieren keine Bilder zu diesem Artikel');
define('TEXT_CLICK_TO_ENLARGE', 'Vergrößern');

 
define('TEXT_INFO_IMAGE_INFO', 'Bildinformationen');
define('TEXT_INFO_NAME', 'Name');
define('TEXT_INFO_FILE_TYPE', 'Dateityp');
define('TEXT_INFO_EDIT_PHOTO', 'Bearbeite <em>Hauptbild</em>');
define('TEXT_INFO_EDIT_ADDL_PHOTO', 'Bearbeite <em>zusätzliches Bild</em>');
define('TEXT_INFO_NEW_PHOTO', 'Neues <em>Hauptbild</em>');
define('TEXT_INFO_NEW_ADDL_PHOTO', 'Neues <em>zusätzliches Bild</em>');
define('TEXT_INFO_IMAGE_BASE_NAME', 'Bildname (optional)');
define('TEXT_INFO_AUTOMATIC_FROM_DEFAULT', ' Automatisch (nach dem Hauptbild)');
define('TEXT_INFO_MAIN_DIR', 'Hauptverzeichnis');
define('TEXT_INFO_BASE_DIR', 'Haupt-Bildverzeichnis');
define('TEXT_INFO_NEW_DIR', 'Wählen Sie ein neues Verzeichnis aus oder definieren Sie ein neues für die Bilder.');
define('TEXT_INFO_IMAGE_DIR', 'Bildverzeichnis');
define('TEXT_INFO_OR', 'oder');
define('TEXT_INFO_AUTOMATIC', 'Automatisch');
define('TEXT_INFO_IMAGE_SUFFIX', 'Bildsuffix (optional)');
define('TEXT_INFO_USE_AUTO_SUFFIX','Geben Sie das gewünschte Suffix an oder lassen Sie das Feld leer, um die automatische Suffix-Generierung zu nutzen.');
define('TEXT_INFO_DEFAULT_IMAGE', 'Hauptbild');
define('TEXT_INFO_DEFAULT_IMAGE_HELP', 'Ein Hauptbild muss definiert sein. Das Hauptbild wird als kleinstes genommen, wenn mittlere und große Bilder angegeben werden.');
define('TEXT_INFO_CLICK_TO_ADD_MAIN', 'Click to add a new <em>main</em> image for this product');
define('TEXT_INFO_CLICK_TO_ADD_ADDL', 'Click to add a new <em>additional</em> image for this product');
define('TEXT_INFO_CONFIRM_DELETE', "Löschen bestätigen;");
define('TEXT_MAIN', 'main');
define('TEXT_ADDITIONAL', 'additional');
define('TEXT_INFO_CONFIRM_DELETE_SURE', 'Sind Sie sicher, dass Sie dieses Bild in allen verschiedenen Größen löschen wollen?');
define('TEXT_INFO_SELECT_ACTION', 'Wählen Sie eine Aktion');


define('TEXT_MSG_FILE_NOT_FOUND', 'This file does not exist.');
define('TEXT_MSG_ERROR_RETRIEVING_IMAGESIZE', 'Could not determine the image size');
define('TEXT_MSG_AUTO_BASE_ERROR', 'Fehler: Sie haben die automatische Bildbenamung ausgewählt, es existiert aber kein Hauptbild.');
define('TEXT_MSG_INVALID_BASE_ERROR', 'Fehler: Ungültige Bildbenamung, oder es konnte kein Hauptbild gefunden werden.');
define('TEXT_MSG_AUTO_REPLACE',  'Störende Zeichen wurden automatisch im Bildnamen ausgetauscht, neuer Name: ');
define('TEXT_MSG_INVALID_SUFFIX', 'Fehler: Ungültiges Bildsuffix.');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', 'Bildtypen sind nicht gleich.');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', 'Fehler: Für autmatische Größenanpassung wird ein Hauptbild benötigt.');
define('TEXT_MSG_NO_DEFAULT', 'Fehler: Es wurde kein Hauptbild angegeben.');
define('TEXT_MSG_NO_DEFAULT_ON_NAME_CHANGE', 'You must supply a "base" image when updating the main image and changing its name.');
define('TEXT_MSG_INVALID_EXTENSION', 'The uploaded "%1$s" image file\'s extension (%2$s) is not supported.  The extension must be one of (%3$s).');
    define('TEXT_BASE', 'base');
    define('TEXT_MEDIUM', 'medium');
    define('TEXT_LARGE', 'large');
define('TEXT_MSG_FILE_EXISTS', 'Fehler: Die Datei existiert bereits! Bitte verändern Sie den Bildnamen oder das Suffix.');
define('TEXT_MSG_INVALID_SQL', "Fehler: SQL Abfrage konnte nicht durchgeführt werden.");
define('TEXT_MSG_NOCREATE_IMAGE_DIR', "Fehler: Das Bildverzeichnis konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', "Fehler: Das Bildverzeichis für mittlere Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', "Fehler: das Bildverzeichnis für große Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOPERMS_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses für mittlere Bilder konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses für große Bilder konnten nicht gesetzt werden.");
define('TEXT_MSG_NAME_TOO_LONG_ERROR', 'The image file "%1$s" is too long to be saved in the database.  Choose a name that is %2$u characters or fewer.');
define('TEXT_MSG_NO_SUFFIXES_FOUND', 'Could not find an unused additional-image suffix in the range _01 to _99.');

define('TEXT_MSG_NOUPLOAD_DEFAULT', "Das Hauptbild konnte nicht hochgeladen werden!");
define('TEXT_MSG_NORESIZE', "Die Gr&oumlße des Bildes konnte nicht verändert werden!");
define('TEXT_MSG_NOCOPY_LARGE', "Das große Bild konnte nicht kopiert werden!");
define('TEXT_MSG_NOCOPY_MEDIUM', "Das mittlere Bild konnte nicht kopiert werden!");
define('TEXT_MSG_NOCOPY_DEFAULT', "Das Hauptbild konnte nicht kopiert werden!");
define('TEXT_MSG_NOPERMS_LARGE', "Die Berechtigungen für das große Bild konnten nicht gesetzt werden!");
define('TEXT_MSG_NOPERMS_MEDIUM', "Die Berechtigungen für das mittlere Bild konnten nicht gesetzt werden!");
define('TEXT_MSG_NOPERMS_DEFAULT', "Die Berechtigungen für das Hauptbild konnten nicht gesetzt werden!");
define('TEXT_MSG_IMAGE_SAVED', 'Bild erfolgreich gespeichert.');
define('TEXT_MSG_LARGE_DELETED', 'Großes Bild gelöscht.');
define('TEXT_MSG_NO_DELETE_LARGE', 'Großes Bild konnte nicht gelöscht werden.');
define('TEXT_MSG_MEDIUM_DELETED', 'Mittleres Bild wurde gelöscht.');
define('TEXT_MSG_NO_DELETE_MEDIUM', 'Mittleres Bild konnte nicht gelöscht werden.');
define('TEXT_MSG_DEFAULT_DELETED', 'Hauptbild wurde gelöscht.');
define('TEXT_MSG_NO_DELETE_DEFAULT', 'Hauptbild konnte nicht gelöscht werden.');
define('TEXT_MSG_NO_DEFAULT_FILE_FOUND', "Es wurde kein Hauptbild zum Löschen gefunden.");

define('TEXT_MSG_IMAGE_DELETED', 'Bild erfolgreich gelöscht.');
define('TEXT_MSG_IMAGE_NOT_FOUND', 'Bild konnte nicht gefunden werden.');
define('TEXT_MSG_IMAGE_NOT_DELETED', 'Bild konnte nicht gelöscht werden.');

define('TEXT_MSG_IMPORT_SUCCESS', 'Erfolgreich importiert: ');
define('TEXT_MSG_IMPORT_FAILURE', 'Fehler beim Importieren: ');

define('IH_IMAGE_NEW_FILE', 'Hier clicken, um ein neues Bild hinzuzufügen');
define('IH_IMAGE_EDIT', 'Hier clicken um ein Bild zu bearbeiten');
define('TEXT_MEDIUM_FILE_IMAGE', 'Medium image file (optional)');
define('TEXT_LARGE_FILE_IMAGE', 'Large image file (optional)');

// ih menu

define('IH_MENU_MANAGER', 'Bild Manager');
define('IH_MENU_ADMIN', 'Admin Tools');
define('IH_MENU_ABOUT', 'Über/Hilfe');
define('IH_MENU_PREVIEW', 'Vorschau');


