<?php
/**
 * bmz_image_handler.php
 * german language definitions for image handler
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id$
 */

define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler<sup>2</sup>');
define('ICON_IMAGE_HANDLER','Image Handler 2');
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
define('IH_CLEAR_CACHE', 'Bildcache l&ouml;schen');
define('IH_CACHE_CLEARED', 'Bildcache gel&ouml;scht.');

define('IH_SOURCE_TYPE', 'Bildtyp (original)');
define('IH_SOURCE_IMAGE', 'Originalbild');
define('IH_SMALL_IMAGE', 'Vorschaubild');
define('IH_MEDIUM_IMAGE', 'Produktbild');

define('IH_ADD_NEW_IMAGE', 'Neues Bild hinzuf&uuml;gen');
define('IH_NEW_NAME_DISCARD_IMAGES', 'Neuer Bildname, zus&auml;tzliche Produktbilder wegwerfen');
define('IH_NEW_NAME_COPY_IMAGES', 'Neuer Bildname, zus&auml;tzliche Produktbilder mitnehmen');
define('IH_KEEP_NAME', 'Alten Bildnamen verwenden, zus&auml;tzliche Produktbilder behalten');
define('IH_DELETE_FROM_DB_ONLY', 'Nur Bildreferenz aus der Datenbank l&ouml;schen');

define('IH_HEADING_TITLE', 'Image Handler<sup>2</sup>');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Bitte w&auml;len Sie ein Produkt aus um dessen zu Bilder bearbeiten.');

define('TABLE_HEADING_PHOTO_NAME', 'Bildname');
define('TABLE_HEADING_DEFAULT_SIZE','Hauptbild');
define('TABLE_HEADING_MEDIUM_SIZE', 'Mittleres Bild');
define('TABLE_HEADING_LARGE_SIZE','Gro&szlig;es Bild');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_PRODUCT_INFO', 'Artikel');
define('TEXT_PRODUCTS_MODEL', 'Modell');
define('TEXT_IMAGE_BASE_DIR', 'Bildverzeichnis');
define('TEXT_NO_PRODUCT_IMAGES', 'Es existieren keine Bilder zu diesem Artikel');
define('TEXT_CLICK_TO_ENLARGE', 'Vergr&ouml;&szlig;ern');
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
define('TEXT_INFO_NEW_DIR', 'W&auml;hlen Sie ein neues Verzeichnis aus oder definieren Sie ein neues f&uuml;r die Bilder.');
define('TEXT_INFO_IMAGE_DIR', 'Bildverzeichnis');
define('TEXT_INFO_OR', 'oder');
define('TEXT_INFO_AUTOMATIC', 'Automatisch');
define('TEXT_INFO_IMAGE_SUFFIX', 'Bildsuffix (optional)');
define('TEXT_INFO_USE_AUTO_SUFFIX','Geben Sie das gew&uuml;nschte Suffix an oder lassen Sie das Feld leer, um die automatische Suffix-Generierung zu nutzen.');
define('TEXT_INFO_DEFAULT_IMAGE', 'Hauptbild');
define('TEXT_INFO_DEFAULT_IMAGE_HELP', 'Ein Hauptbild muss definiert sein. Das Hauptbild wird als kleinstes genommen, wenn mittlere und gro&szlig;e Bilder angegeben werden.');
define('TEXT_INFO_CONFIRM_DELETE', "L&ouml;schen best&auml;tigen;");
define('TEXT_INFO_CONFIRM_DELETE_SURE', 'Sind Sie sicher, dass Sie dieses Bild in allen verschiedenen Gr&ouml;&szlig;en l&ouml;schen wollen?');
define('TEXT_INFO_SELECT_ACTION', 'W&auml;hlen Sie eine Aktion');
define('TEXT_INFO_CLICK_TO_ADD', 'Hier klicken, um diesem Artikel ein neues Bild hinzuzuf&uuml;gen.');

define('TEXT_MSG_AUTO_BASE_ERROR', 'Fehler: Sie haben die automatisch Bildbenamung ausgew&auml;hlt, es existiert aber kein Hauptbild.');
define('TEXT_MSG_INVALID_BASE_ERROR', 'Fehler: Ung&uuml;ltige Bildbenamung, oder es konnte kein Hauptbild gefunden werden.');
define('TEXT_MSG_AUTO_REPLACE',  'St&ouml;rende Zeichen wurden automatisch im Bildnamen ausgetauscht, neuer Name: ');
define('TEXT_MSG_INVALID_SUFFIX', 'Fehler: Ung&uuml;ltiges Bildsuffix.');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', 'Bildtypen sind nicht die Gleichen.');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', 'Fehler: F&uuml;r autmatische Gr&ouml;&szlig;enanpassung wird ein Hauptbild ben&ouml;tigt.');
define('TEXT_MSG_NO_DEFAULT', 'Fehler: Es wurde kein Hauptbild angegeben.');
define('TEXT_MSG_FILE_EXISTS', 'Fehler: Die Datei existiert bereits! Bitter ver&auml;ndern Sie den Bildnamen oder das Suffix.');
define('TEXT_MSG_INVALID_SQL', "Fehler: SQL Abfrage konnte nicht durchgef&uuml;hrt werden.");
define('TEXT_MSG_NOCREATE_IMAGE_DIR', "Fehler: Das Bildverzeichnis konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', "Fehler: Das Bildverzeichis f&uuml;r mittlere Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', "Fehler: das Bildverzeichnis f&uuml;r gro&szlig;e Bilder konnte nicht erstellt werden.");
define('TEXT_MSG_NOPERMS_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses f&uuml;r mittlere Bilder konnten nicht gesetzt werden.");
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', "Fehler: Die Berechtigungen des Bildverzeichnisses f&uuml;r gro&szlig;e Bilder konnten nicht gesetzt werden.");

define('TEXT_MSG_NOUPLOAD_DEFAULT', "Das Hauptbild konnte nicht hochgeladen werden!");
define('TEXT_MSG_NORESIZE', "Die Gr&ouml&szlig;e des Bildes konnte nicht ver&auml;ndert werden!");
define('TEXT_MSG_NOCOPY_LARGE', "Das gro&szlig;e Bild konnte nicht kopiert werden!");
define('TEXT_MSG_NOCOPY_MEDIUM', "Das mittlere Bild konnte nicht kopiert werden!");
define('TEXT_MSG_NOCOPY_DEFAULT', "Das Hauptbild konnte nicht kopiert werden!");
define('TEXT_MSG_NOPERMS_LARGE', "Die Berechtigungen f&uuml;r das gro&szlig;e Bild konnten nicht gesetzt werden!");
define('TEXT_MSG_NOPERMS_MEDIUM', "Die Berechtigungen f&uuml;r das mittlere Bild konnten nicht gesetzt werden!");
define('TEXT_MSG_NOPERMS_DEFAULT', "Die Berechtigungen f&uuml;r das Hauptbild konnten nicht gesetzt werden!");
define('TEXT_MSG_IMAGE_SAVED', 'Bild erfolgreich gespeichert.');
define('TEXT_MSG_LARGE_DELETED', 'Gro&szlig;es Bild gel&ouml;scht.');
define('TEXT_MSG_NO_DELETE_LARGE', 'Gro&szlig;es Bild konnte nicht gel;&ouml;scht werden.');
define('TEXT_MSG_MEDIUM_DELETED', 'Mittleres Bild wurde gel&ouml;scht.');
define('TEXT_MSG_NO_DELETE_MEDIUM', 'Mittleres Bild konnte nicht gel;&ouml;scht werden.');
define('TEXT_MSG_DEFAULT_DELETED', 'Hauptbild wurde gel&ouml;scht.');
define('TEXT_MSG_NO_DELETE_DEFAULT', 'Hauptbild konnte nicht gel;&ouml;scht werden.');
define('TEXT_MSG_NO_DEFAULT_FILE_FOUND', "Es wurde kein Hauptbild zum L&ouml;schen gefunden.");

define('TEXT_MSG_IMAGE_DELETED', 'Bild erfolgreich gel&ouml;scht.');
define('TEXT_MSG_IMAGE_NOT_FOUND', 'Bild konnte nicht gefunden werden.');
define('TEXT_MSG_IMAGE_NOT_DELETED', 'Bild konnte nicht gel&ouml;scht werden.');

define('TEXT_MSG_IMPORT_SUCCESS', 'Erfolgreich importiert: ');
define('TEXT_MSG_IMPORT_FAILURE', 'Fehler beim importieren: ');
