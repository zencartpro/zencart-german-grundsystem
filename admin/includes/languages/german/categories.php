<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart.at
 * @version $Id: categories.php 627 2010-08-30 15:05:14Z webchills $
 */

define('HEADING_TITLE', 'Kategorien & Artikel');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien & Artikel');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortierung');

define('TABLE_HEADING_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_QUANTITY', 'Anzahl');

define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuersatz:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Anzahl:');
define('TEXT_DATE_ADDED', 'Erstellt am:');
define('TEXT_DATE_AVAILABLE', 'Erhältlich ab:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild existiert nicht');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder einen neuen Artikel in dieser Ebene ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen besuchen Sie bitte diese <a href="http://%s" target="blank">Website</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieser Artikel wurde am %s hinzugefügt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist am %s wieder verfügbar.');

define('TEXT_EDIT_INTRO', 'Bitte führen Sie hier die notwendigen Änderungen durch');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierung:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie die neue Kategorie aus, in die Sie diesen Artikel kopieren möchten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuelle Kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie ändern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Wollen Sie diese Kategorie wirklich löschen?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Warnung:</strong> Verbundene Artikel, deren Master Kategorie ID gelöscht wird, setzen nicht den richtigen Preis fest. Vor dem Entfernen einer Kategorie sollten Sie zuerst sicherstellen, daß die zu löschende Kategorie keine verbundenen Artikel enthält. Noch enthaltene verbundene Artikel sollten einer anderen Master Kategorie ID zugeordnet werden');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel löschen wollen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> Es sind bereits %s (Unter-)Kategorien mit dieser Kategorie verlinkt!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> Es sind bereits %s Artikel mit dieser Kategorie verlinkt!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte Kategorie auswählen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte Kategorie auswählen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'Geben Sie folgende Informationen für die neue Kategorie an');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierung:');

define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCTS_VIRTUAL', 'Virtueller Artikel:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Immer versandkostenfrei:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Box für die Stückzahl anzeigen:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'Lagernd');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht lagernd');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Ja, Versandadresse überspringen');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'Nein, Versandadresse wird benötigt');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Ja, immer versandkostenfrei');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nein');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Ja, Box für die Stückzahl anzeigen');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nein');

define('TEXT_PRODUCTS_MANUFACTURER', 'Artikelhersteller:');
define('TEXT_PRODUCTS_NAME', 'Artikelname:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikelbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Lagerbestand:');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer:');
define('TEXT_PRODUCTS_IMAGE', 'Artikelbild:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'Uploadverzeichnis:');
define('TEXT_PRODUCTS_URL', 'Herstellerlink:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(Ohne führendes http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Nettopreis:');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Bruttopreis:');
define('TEXT_PRODUCTS_WEIGHT', 'Gewicht:');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Artikel verlinken');
define('TEXT_COPY_AS_DUPLICATE', 'Artikel kopieren');

define('TEXT_RESTRICT_PRODUCT_TYPE', 'Auf Artikeltyp beschränken');
define('TEXT_CATEGORY_HAS_RESTRICTIONS', 'Diese Kategorie wurde auf diese Artikeltypen beschränkt');
define('ERROR_CANNOT_ADD_PRODUCT_TYPE', 'Der gewählte Artikel kann dieser Kategorie nicht hinzugefügt werden. Überprüfen Sie die Einschränkungen der Kategorie.');

// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'Wird nur für kopierte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Artikelattribute zum Duplikat kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');

define('TEXT_INFO_CURRENT_PRODUCT', 'Aktueller Artikel:');
define('TABLE_HEADING_MODEL', 'Artikelnummer');

define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attribute geändert für Artikel ID# ');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Lösche <strong>ALLE</strong> Artikelattribute für:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO', 'Kopiere Attribute zu einem anderen Artikel oder einer ganzen Kategorie von:<br />');

define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopiere Attribute zu einem anderen <strong>Artikel</strong> von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopiere Attribute zu einer anderen <strong>Kategorie</strong> von:<br />');

define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie sollen bestehende Artikelattribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Löschen</strong> - Bestehende Attribute werden gelöscht, dann die neuen Attribute kopiert.');
define('TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Aktualisieren</strong> Bestehende Attribute werden mit den neuen Einstellungen/Preisen aktualisiert, dann werden die neuen Attribute kopiert.');
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Ignorieren</strong> Bestehende Attribute werden beibehalten und nur die neuen Attribute hinzufügen');

define('SUCCESS_ATTRIBUTES_DELETED', 'Die Attribute wurden erfolgreich gelöscht');
define('SUCCESS_ATTRIBUTES_UPDATE', 'Die Attribute wurden erfolgreich aktualisiert');

define('ICON_ATTRIBUTES', 'Attributmerkmale');

define('TEXT_CATEGORIES_IMAGE_DIR', 'In Verzeichnis hochladen:');
define('TEXT_CATEGORIES_IMAGE_MANUAL', '<strong>Oder wählen Sie ein bestehendes Bild vom Server, Dateiname:</strong>');

define('TEXT_VIRTUAL_PREVIEW', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und ignoriert Versandadressen');
define('TEXT_VIRTUAL_EDIT', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und ignoriert Versandadressen');
define('TEXT_FREE_SHIPPING_PREVIEW', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und benötigt eine Versandadresse');
define('TEXT_FREE_SHIPPING_EDIT', 'Achtung: Mit "Ja" kennzeichnen Sie diesen Artikel als versandkostenfrei - eine Versandadresse wird benötigt');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'WARNUNG: Ohne Anzeige der Box für die Stückzahl ist der Standardwert 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'WARNUNG: Ohne Anzeige der Box für die Stückzahl ist der Standardwert 1');

define('TEXT_PRODUCT_OPTIONS', '<strong>Bitte wählen Sie:</strong>');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributmerkmal für:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads:');

define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Der angezeigte Preis enthält die niedrigsten Gruppenattributspreise plus Preis');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Der angezeigte Preis enthält die niedrigsten Gruppenattributspreise plus Preis');

define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Artikel Mindestabnahme:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Abnahmeeinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Artikel Maximalabnahme:');

define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', 'Geben Sie die Anzahl ein (0 = unlimitiert, 1 = Es wird keine Box für die Stückzahl angezeigt oder jeden beliebigen positiven Wert)');

define('TEXT_PRODUCTS_MIXED', 'Artikel Mindestabnahme/Einheit Mix:');

define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Artikel ist kostenlos');
define('TEXT_PRODUCT_IS_FREE', 'Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Artikel ist als kostenlos markiert');
define('TEXT_PRODUCTS_IS_FREE_EDIT', '*Artikel ist als kostenlos markiert');

define('TEXT_PRODUCT_IS_CALL', 'Artikel ist "Preis bitte anfragen":');
define('TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Artikel ist mit "Preis bitte anfragen" gekennzeichnet');
define('TEXT_PRODUCTS_IS_CALL_EDIT', '*Artikel ist mit "Preis bitte anfragen" gekennzeichnet');

define('TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Überspringe neue Attribute </strong>');
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Einfügen neuer Attribute von</strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Aktualisieren von Attribut </strong>');

define('TEXT_SHIPPING_INFO',
     '<strong>Virtuelle Artikel</strong> sind versandkostenfrei und benötigen <strong>keine</strong> Versandadresse, z.B. Artikel wie ' . TEXT_GV_NAMES . ', etc.<br />' .
     'Artikel, die als <strong>Immer versandkostenfrei</strong> gekennzeichnet sind, sind versandkostenfrei, <strong>benötigen</strong> jedoch eine Versandadresse<br />' .
     '<strong>Download-Artikel</strong> sind standardmäßig virtuelle Artikel - Es muss keine Option (immer versandkostenfrei oder Virtueller Artikel) ausgewählt werden.<br />');

define('TEXT_ANY_TYPE', 'Jeder Typ');
define('TABLE_HEADING_PRODUCT_TYPES', 'Artikeltyp(en)');

// categories status
define('TEXT_INFO_HEADING_STATUS_CATEGORY', 'Kategoriestatus ändern für:');
define('TEXT_CATEGORIES_STATUS_INTRO', 'Kategoriestatus ändern nach: ');
define('TEXT_CATEGORIES_STATUS_OFF', 'AUS');
define('TEXT_CATEGORIES_STATUS_ON', 'EIN');
define('TEXT_PRODUCTS_STATUS_INFO', 'JEDEN Artikelstatus ändern nach: ');
define('TEXT_PRODUCTS_STATUS_OFF', 'AUS');
define('TEXT_PRODUCTS_STATUS_ON', 'EIN');
define('TEXT_PRODUCTS_STATUS_NOCHANGE', 'Unverändert');
define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>WARNUNG ...</strong><br />HINWEIS: Wenn Sie eine Kategorie deaktivieren, deaktivieren Sie auch ALLE Artikel, die in dieser Kategorie enthalten sind. Verlinkte Artikel in dieser Kategorie, welche mit anderen Kategorien verlinkt sind, werden dadurch ebenfalls deaktiviert.');

define('TEXT_PRODUCTS_STATUS_ON_OF', ' von ');
define('TEXT_PRODUCTS_STATUS_ACTIVE', ' aktiv ');

define('TEXT_CATEGORIES_DESCRIPTION', 'Kategoriebeschreibung:');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Artikel ist "Preis bitte anfragen."');

// Metatags
define('TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', 'Kategorien Meta Tags Definitionen');
define('TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', 'Definiere Meta Tags');
define('TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', 'Titel:');
define('TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', 'Schlüsselwörter:');
define('TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', 'Beschreibung');

define('WARNING_PRODUCTS_IN_TOP_INFO', 'WARNUNG: Sie haben Produkte in der Hauptkategorie. Dadurch werden die Preise im Katalog nicht richtig zugeordnet. Folgende Produkte wurden gefunden: ');
