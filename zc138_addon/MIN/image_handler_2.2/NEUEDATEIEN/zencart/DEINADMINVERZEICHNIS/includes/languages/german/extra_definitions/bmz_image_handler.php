<?php
/**
 * bmz_image_handler.php
 * german language definitions for image handler
 *
 * @author  Tim Kroeger (original author)
 * @copyright Copyright 2005-2006
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_image_handler.php,v 2.0 Rev 8 2010-05-31 23:46:5 DerManoMann Exp $
 * Last modified by DerManoMann 2010-05-31 23:46:50 
 * Last modified by webchills 2010-09-23 13:46:50 
 */

define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler 2.2');
define('ICON_IMAGE_HANDLER','Image Handler 2.2');
define('IH_VERSION_VERSION', 'Version');
define('IH_VERSION_NOT_FOUND', 'Keine Image Handler Versionsnummer gefunden.');
define('IH_REMOVE', 'Image Handler aus der Datenbank entfernen');
define('IH_CONFIRM_REMOVE', 'Sind Sie sicher?');
define('IH_REMOVED', 'Image Handler erfolgreich entfernt.');
define('IH_UPDATE', 'Image Handler aktualisieren');
define('IH_UPDATED', 'Image Handler erfolgreich aktualisiert.');
define('IH_INSTALL', 'Image Handler installieren');
define('IH_INSTALLED', 'Image Handler erfolgreich installiert.');
define('IH_SCAN_FOR_ORIGINALS', 'Nach alten IH 0.x und 1.x <em>original</em> Bildern suchen');
define('IH_CONFIRM_IMPORT', 'Wollen Sie wirklich die aufgelisteten Bilder importieren?<br /><strong>Sichern Sie vorher Ihre Datenbank und Ihren Bilder Ordner!</strong>');
define('IH_NO_ORIGINALS', 'Keine alten IH 0.x oder 1.x original Bilder gefunden');
define('IH_IMAGES_IMPORTED', 'Bilder erfolgreich importiert.');
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

define('IH_HEADING_TITLE', 'Image Handler 2.2');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Bitte wählen Sie ein Produkt aus um dessen zu Bilder bearbeiten.');

define('TABLE_HEADING_PHOTO_NAME', 'Bildname');
define('TABLE_HEADING_DEFAULT_SIZE','Hauptbild');
define('TABLE_HEADING_MEDIUM_SIZE', 'Mittleres Bild');
define('TABLE_HEADING_LARGE_SIZE','Großes Bild');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_PRODUCT_INFO', 'Artikel');
define('TEXT_PRODUCTS_MODEL', 'Modell');
define('TEXT_IMAGE_BASE_DIR', 'Bildverzeichnis');
define('TEXT_NO_PRODUCT_IMAGES', 'Es existieren keine Bilder zu diesem Artikel');
define('TEXT_CLICK_TO_ENLARGE', 'Vergrößern');
define('TEXT_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt');

define('TEXT_INFO_IMAGE_INFO', 'Bildinformationen');
define('TEXT_INFO_NAME', 'Name');
define('TEXT_INFO_FILE_TYPE', 'Dateityp');
define('TEXT_INFO_EDIT_PHOTO', 'Bild bearbeiten');
define('TEXT_INFO_NEW_PHOTO', 'Neues Bild');
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
define('TEXT_INFO_CONFIRM_DELETE', "Löschen bestätigen;");
define('TEXT_INFO_CONFIRM_DELETE_SURE', 'Sind Sie sicher, dass Sie dieses Bild in allen verschiedenen Größen löschen wollen?');
define('TEXT_INFO_SELECT_ACTION', 'Wählen Sie eine Aktion');
define('TEXT_INFO_CLICK_TO_ADD', 'Hier klicken, um diesem Artikel ein neues Bild hinzuzufügen.');

define('TEXT_MSG_AUTO_BASE_ERROR', 'Fehler: Sie haben die automatisch Bildbenamung ausgewählt, es existiert aber kein Hauptbild.');
define('TEXT_MSG_INVALID_BASE_ERROR', 'Fehler: Ungültige Bildbenamung, oder es konnte kein Hauptbild gefunden werden.');
define('TEXT_MSG_AUTO_REPLACE',  'Störende Zeichen wurden automatisch im Bildnamen ausgetauscht, neuer Name: ');
define('TEXT_MSG_INVALID_SUFFIX', 'Fehler: Ungültiges Bildsuffix.');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', 'Bildtypen sind nicht gleich.');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', 'Fehler: Für autmatische Größenanpassung wird ein Hauptbild benötigt.');
define('TEXT_MSG_NO_DEFAULT', 'Fehler: Es wurde kein Hauptbild angegeben.');
define('TEXT_MSG_FILE_EXISTS', 'Fehler: Die Datei existiert bereits! Bitte verändern Sie den Bildnamen oder das Suffix.');
define('TEXT_MSG_INVALID_SQL', "Fehler: SQL Abfrage konnte nicht durchgeführt werden.");
define('TEXT_MSG_NOCREATE_IMAGE_DIR', "Fehler: Das Bildverzeichnis konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', "Fehler: Das Bildverzeichis für mittlere Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', "Fehler: das Bildverzeichnis für große Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOPERMS_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses für mittlere Bilder konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses für große Bilder konnten nicht gesetzt werden.");

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
