<?php
/**
 * @package IH4 Admin
 * @copyright Copyright 2003-2013 Zen Cart Development Team
 *
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright 2005-2006 Tim Kroeger (original author)
 * @revisited by ckosloff/DerManoMann/C Jones/Nigelt74/K Hudson/Nagelkruid
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_image_handler.php 2013-09-28 09:46:5 webchills $
 */

define('BOX_TOOLS_IMAGE_HANDLER', 'Image Handler<sup>4</sup>');
define('ICON_IMAGE_HANDLER','Image Handler 4.3.2');
define('IH_VERSION_VERSION', 'Version');
define('IH_VERSION_NOT_FOUND', 'Keine Image Handler Versionsnummer gefunden.');
define('IH_REMOVE', 'Image Handler aus der Datenbank entfernen. (Bitte machen Sie erst ein Backup Ihrer Datenbank und Ihrer Installation!)');
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

define('IH_HEADING_TITLE', 'Image Handler<sup>4</sup>');
define('IH_HEADING_TITLE_PRODUCT_SELECT','Bitte wählen Sie ein Produkt aus um dessen zu Bilder bearbeiten.');

define('TABLE_HEADING_PHOTO_NAME', 'Bildname');
define('TABLE_HEADING_DEFAULT_SIZE','Hauptbild');
define('TABLE_HEADING_MEDIUM_SIZE', 'Mittleres Bild');
define('TABLE_HEADING_LARGE_SIZE','Großes Bild');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_FILETYPE', 'Dateityp');

define('TEXT_PRODUCT_INFO', 'Artikel');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer');
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

define('TEXT_MSG_AUTO_BASE_ERROR', 'Fehler: Sie haben die automatische Bildbenamung ausgewählt, es existiert aber kein Hauptbild.');
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

define('IH_IMAGE_NEW_FILE', 'Hier clicken, um ein neues Bild hinzuzufügen');
define('IH_IMAGE_EDIT', 'Hier clicken um ein Bild zu bearbeiten');


// ih menu

define('IH_MENU_MANAGER', 'Bild Manager');
define('IH_MENU_ADMIN', 'Admin Tools');
define('IH_MENU_ABOUT', 'Über/Hilfe');
define('IH_MENU_PREVIEW', 'Vorschau');


// image manager
define('TEXT_INFO_DEFAULT_IMAGE_REQUIRED', '(erforderlich!)');
define('TEXT_MEDIUM_FILE_IMAGE', 'Datei für mittleres Bild (optional)');
define('TEXT_LARGE_FILE_IMAGE', 'Datei für großes Bild (optional)');


// message stack messages

define('IH_MS_ALL_EXIST','Alle Image Handler Dateien sind korrekt in der richtigen Struktur vorhanden.');
define('IH_MS_ABORTED','********** Installation abgebrochen **********');
define('IH_MS_SOME_FILES_MISSING','Einige Image Handler Dateien fehlen. Haben Sie wirklich alle hochgeladen? Sind die Dateiberechtigungen korrekt?');
define('IH_MS_TEMPLATE_NOTFOUND','Image Handler kann Ihr aktives Template nicht finden.');
define('IH_MS_MISSING_OR_UNREADABLE','Fehlende oder nicht lesbare Datei:');
define('IH_MS_OVERWRITTEN','wurde überschrieben. Eine Backupdatei wurde angelegt.');
define('IH_MS_NOT_OVERWRITTEN','wurde NICHT überschrieben.');
define('IH_MS_CREATED','wurde angelegt. Backupdateien aller überschriebenen Dateien wurden angelegt.');
define('IH_MS_NOT_CREATED','wurde NICHT angelegt.');
define('IH_MS_SUCCESS','Image Handler wurde erfolgreich installiert.');
define('IH_MS_ROLLBACK_OK','wurde wieder auf die vorherige Version zurückgestellt.');
define('IH_MS_ROLLBACK_NOT_OK','wurde NICHT wieder auf die vorherige Version zurückgestellt.');
define('IH_MS_UNINSTALL_OK','Image Handler wurde erfolgreich deinstalliert.');
define('IH_MS_BACKUP_INFO','Image Handler legt Backups bestimmter Dateien an, bevor er diese Dateien bei der Installation überschreibt. Diese Dateien wurden am Server belassen. Sie können Sie löschne, es stört die Funktionalität Ihres Shops aber nicht, wenn Sie sie für Referenzzwecke am Server belassen.');
define('IH_MS_AUTOLOADER_NOTDELETED','Der Autolaoder YOURADMIN/includes/auto_loaders/config.image_handler.php wurde NICHT gelöscht. Damit Image Handler funktioniert, müssen Sie diese Datei manuell löschen.');


// documentation

define('IH_ABOUT_DOKU','<h2>Image Handler<sup>4</sup> v4.3.2 für Zen-Cart 1.5.1 deutsch</h2>

<p>
Image Handler<sup>4</sup> v4.3.2 für Zen-Cart 1.5.1 deutsch basiert auf der Grundentwicklung von Tim Kröger.<br /></p>
<fieldset>
<legend>Sinn &amp; Zweck</legend>
<p>Image Handler<sup>4</sup> wurde geschrieben um Ihnen das Management Ihrer Produktbilder zu erleichtern (vor allem das Managment der zusätzlichen Produktbilder) und die Seitenperformance durch Optimierung der Produktbilder zu verbessern.</p>
<p>Image Handler<sup>4</sup> generiert Produktbilder (basierend auf Ihren Bildeinstellungen) im Image Handler 4 bmz_cache Verzeichnis. Es werden KEINE Orginalbilder ersetzt oder modifiziert. Perfekt geeignet zum sicheren Einsatz in einem existierenden Shop.</p>
<p> Image Handler<sup>4</sup> ermöglicht Ihnen die Nutzung von GD Bibliotheken oder ImageMagick (falls auf Ihrem Server installiert). Sie können damit auf die Schnelle kleine, mittlere und große Bilder erzeugen. Laden Sie einfach nur ein Bild hinauf oder verwenden Sie mehrere Orte für mittlere und große Bilder. Image Handler 4 ermöglicht Ihnen auch die Verwendung von Wasserzeichen für Ihre Bilder (es wird ein zweites halb transparentes Bild darübergelegt) und beim "Mouse over" über ein kleines Bild wird ein Popup mit einem mittleren oder großen Bild erzeugt.</p>
<p>Diese Erweiterung enthält eine umfangreiches Admin Schnittstelle mit der Sie Ihre Artikelliste durchsuchen oder direkt auf den Attributmanager zugreifen können. Sie benötigen kein FTP Programm um Bilder in Ihren Shop zu laden, zum Löschen oder Hinzufügen von zusätzlichen Bildern. Image Handler 4 funktioniert gut mit Erweiterungen wie z. B. Easy Populate.
</p>
</fieldset>
<hr>
<fieldset>
<legend>Features</legend>
<ul>
  <li>Verbessert die Seiten Performance (schnelleres Laden, schnellere Anzeige)</li>
  <li>Professionelles Aussehen der Bilder (kein Treppeneffekt, glatte Kanten)</li>
  <li>Wählen Sie Ihren bevorzugten Bild Typ für jede Bild Größe.</li>
  <li>Durch das Heraufladen eines Bildes werden beim Seitenaufruf kleine, mittlere und große Bilder erzeugt.</li>
  <li>Nahtloser Übergang. Kein weiteres Bearbeiten erforderlich, Ihre Bilder sind gespeichert.</li>
  <li>Leicht zu installieren. Ein-Klick-Datenbank-Upgrade.</li>
  <li>Arbeitet mit Werkzeugen zum Massenimport und -export wie Easy Populate</li>
  <li>Wasserzeichen um dem Diebstahl von Bildern vorzubeugen.</li>
  <li>"Image Hover - Funktionalität" erzeugt ein Popup mit einem großen Bild wenn Sie mit der Maus auf ein kleines Bild fahren (zuschaltbar).</li>
  <li>Sie können zwischen einem transparenten Bildhintergrund oder einer Farbe passend zu Ihrer Seitenfarbe wählen.</li>
  <li>Verwalten Sie ihre verschiedenen Produktbilder einfach über eine Seite auch wenn Sie Attribute verwenden über den Attribute-Manager.</li>
</ul>
<p>Image Handler<sup>4</sup> will Ihnen die Arbeit mit Bildern im Shop erleichtern, es ist eine Ergänzung zu der Standard Bildfunktionalität in Zen Cart und ersetzt diese nicht.</p>
<p>Es wird empfohlen die Anleitung zur Konfiguration und Nutzung in der "liesmich.html" des Image Handler Downloads zu lesen, um die Funktionen von Image Handler 4 kennen zu lernen.</p>
</fieldset>

<hr>

<fieldset>
<legend>Grundlagen für die Fehlersuche</legend>
<p>Vergewissern Sie sich, dass Ihr gewähltes Template aktiv ist (Admin > Tools > Templates).</p>
<p>Prüfen Sie ob Image Handler 4 installiert ist (Admin > Tools > Image Handler4 > Admin).<br/>Setzen sie für die Verzeichnisse "images" und "bmz_cache" die Dateiberechtigungen auf 755 (beide Verzeichnisse müssen die gleiche Einstellungen haben, bei einigen Webhostern müssen Sie die Dateiberechtigungen für diese Verzeichnisse auf 777 stellen).</p>
<p>Wenn Image Handler 4 nicht funktioniert oder Fehlermeldungen ausgibt:</p>
<ul>
<li>Prüfen Sie ob alle Dateien in den richtigen Verzeichnissen sind</li>
<li>Prüfen Sie ob auch alle Image Handler 4 Dateien auf Ihren Webspace geladen wurden</li>
<li>Prüfen Sie, ob die Dateien beim FTP Transfer beschädigt wurden</li>
<li>Prüfen Sie, ob die Dateien richtig eingearbeitet wurden (z. B. mit WinMerge für Windows oder Meld-diff für Linux)</li>
<li>Lesen Sie sicherheitshalber nochmal die Bedienungsanleitung</li>
<li>Prüfen Sie ob Javascript Konflikte bestehen </li>
<li>Prüfen Sie Dateinamen Ihrer Hauptbilder, diese dürfen keine speziellen Buchstaben enthalten (keine Alphanummerischen Buchstaben wie / \ : ! @ # $ % ^ < > , [ ] { } & * ( ) + = ).</li>
<li>Verwenden Sie immer Bildernamen entsprechend der Vorgaben - Sehen sich sich dieses Dokument als Referenz an: <a href="http://www.records.ncdcr.gov/erecords/filenaming_20080508_final.pdf">http://www.records.ncdcr.gov/erecords/filenaming_20080508_final.pdf</a></li>
</li>
</ul>
</fieldset>

<hr>

<fieldset>
<legend>Zen Cart und die Bildverwaltung</legend>
<p>Image Handler4 soll Ihnen die Arbeit zur Verwaltung der Bilder in Ihrem Shop erleichtern. Image Handler 4 arbeitet mit den Standardfunktionalitäten in Zen Cart und ersetzt diese nicht. Hier einige zusätzliche FAQ welche erklären wie Produktbilder in Zen Cart eingesetzt werden:</p>
<ul>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=224" target="_blank">Anleitung zum Aufbereiten von Bildern in Zen-Cart</a></li>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=30" target="_blank">Meine Bilder sind verzerrt / unscharf / gestaucht?</a><br>
  </li>
</ul>
<p>Informationen wie Zen Cart zusätzliche Produktbilder erkennt und verwaltet finden Sie in diesen Zen Cart FAQ:</p>
<ul>
  <li><a href="http://tutorials.zen-cart.com/index.php?article=315" target="_blank">Warum sehe ich Bilder von anderen Artikeln auf meiner Artikelseite?</a></li>
  <li><a href="http://www.zen-cart-pro.at/forum/threads/9755-Wie-f%C3%BCge-ich-einem-Artikel-mehrere-Bilder-hinzu" target="_blank">Wie füge ich verschiedene Bilder einem Produkt hinzu?</a></li>
  </ul>
<p>Sehen Sie sich diese FAQ an und verstehen Sie, wie Zen Cart mit Artikelbildern arbeitet.</p>
</fieldset>

<hr>

<fieldset>
<legend>Bereiten Sie Ihre Seite für eine weitere Entwicklung vor</legend>
<p>Viele Benutzer sind sich nicht bewusst, dass Sie mit Image Handler 4 eine sehr umfangreiche Seite genauso einfach verwalten können wie eine kleine. Wenn Sie anfangen eine Internetseite zu erstellen, müssen Sie als Ersteller einer kleinen Seite einfach nur die Bilder in Ihr Bildverzeichniss laden. Wenn die Seite an Umfang gewinnt und die Bilder sich wie Kaninchen vermehren, kann es zu Problemen mit den Bildernamen für Zen Cart kommen und die Seite wird langsamer. Hier sparen Sie von Beginn an Zeit und Arbeit egal wie Ihr Geschäft sich entwickelt.</p>
<p>Wenn Sie Image Handler 4 nicht installiert haben, müssen Sie möglicherweise drei verschiedene Bildgrößen erstellen und auf Ihren Webspace laden für jedes Bild das Sie gerne verwenden möchten. Diese Bilder müssen Sie unter Verwendung von Suffixes benennen und in die jeweiligen Verzeichnisse innerhalb Ihres Hauptbildverzeichnisses laden. Als Beispiel: Ein Produkt namens "Widget" erforder images(Bildverzeichniss)/widget.jpg (kleines Bild), images/medium/widget_MED.jpg (mittlere Bildgröße) und images/large/widget_LRG.jpg (großes Bild). Das ist sehr aufwendig, gerade wenn Sie für viele Ihrer Produkte verschiedene Bilder verwenden. Wenn Ihre Seite wächst wird diese Aufgabe immer schwieriger.
</p>
<p>Mit Image Handler 4 müssen Sie nicht mehr länger drei verschiedene Bildgrößen erstellen und in die verschiedenen Verzeichnisse laden (vielleicht machen Sie das gerne). Statt dessen genügt es ein einziges Bild in das Verzeichniss Bilder zu laden, den Rest erledigt Image Handler 4. Laden Sie einfach Ihr Bild mit der besten Qualität hinauf, Image Handler 4 vergrößert, verkleinert und optimiert Ihr Bild bei Bedarf. Stellt kleine, mittlere und große Bilder automatisch für die zu ladende Seite bereit - alles automatisch und ohne Modifizierung Ihres Orginal Bildes! </p>
</fieldset>');


