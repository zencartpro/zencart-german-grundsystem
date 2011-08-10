<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: product_music.php 302 2008-05-30 19:49:12Z maleborg $
//

define('HEADING_TITLE', 'Kategorien / Artikel');
define('HEADING_TITLE_GOTO', 'Gehe zu:');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_QUANTITY', 'Lagermenge');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_PRODUCTS_RECORD_ARTIST', 'Künstler:');
define('TEXT_PRODUCTS_RECORD_COMPANY', 'Plattenfirma:');
define('TEXT_PRODUCTS_MUSIC_GENRE', 'Musik Genre:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuersatz:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliches Rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Lagermenge:');
define('TEXT_DATE_ADDED', 'Erstellt am:');
define('TEXT_DATE_AVAILABLE', 'Erhältlich ab:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild existiert nicht');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder einen neuen Artikel in dieser Ebene ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen zu diesem Artikel besuchen Sie bitte diese <a href="http://%s" target="blank">Website</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieser Artikel wurde am %s hinzugefügt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel wird am %s wieder lagernd sein.');
define('TEXT_EDIT_INTRO', 'Bitte führen Sie hier die notwendigen Änderungen durch');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierung:');
define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie die neue Kategorie aus, in der Sie diesen Artikel kopieren möchten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Kategorie:');
define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie ändern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');
define('TEXT_DELETE_CATEGORY_INTRO', 'Wollen Sie diese Kategorie wirklich löschen?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Wollen Sie diesen Artikel wirklich löschen?');
define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> es sind bereits %s (Unter-)Kategorien mit dieser Kategorie verlinkt!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> es sind bereits %s Artikel mit dieser Kategorie verlinkt!');
define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie die Kategorie aus, in der Sie <b>%s</b> legen wollen');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie die Kategorie aus, in der Sie <b>%s</b> legen wollen');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');
define('TEXT_NEW_CATEGORY_INTRO', 'Füllen Sie folgende Informationen für die neue Kategorie aus');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierung:');
define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCTS_VIRTUAL', 'Virtueller Artikel:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Immer Versandkostenfrei:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Lagerbestand anzeigen:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'Lagernd');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht lagernd');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Ja');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'Nein');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Ja');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nein');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Sonderangebot, Artikel/Download benötigt eine Lieferadresse');
define('TEXT_PRODUCTS_SORT_ORDER', 'Sortierung:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Ja, zeige Box für Stückzahl');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nein, zeige keine Box für Stückzahl');
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

// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'wird nur für doppelte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Artikelattribute zum Duplikat kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');
define('TEXT_COPY_MEDIA_MANAGER', 'Kopiere jede Kollektion im Medienmanager, die mit diesem Artikel in Verbindung stehen.');
define('TEXT_INFO_CURRENT_PRODUCT', 'Aktueller Artikel:');
define('TABLE_HEADING_MODEL', 'Artikelnummer');
define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attribute für Artikel ID# geändert');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Lösche <strong>ALLE</strong> Artikelattribute für:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO', 'Kopiere Attribute zu einem anderen Artikel oder einer ganzen Kategorie von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopiere Attribute zu einem anderen <strong>Artikel</strong> von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopiere Attribute zu einer anderen <strong>Kategorie</strong> von:<br />');
define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie sollen existierende Artikelattribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Löschen</strong> - Die vorhandenen Attribute werden gelöscht, bevor die neue Attribute kopiert werden');
define('TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Aktualisieren</strong> - Die vorhanden Attribute werden mit den neuen Einstellungen/Preise aktualisiert, bevor die neuen Attribute hinzufügt werden');
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Ignorieren</strong> - Es werden nur neue Attribute hinzufügt');
define('SUCCESS_ATTRIBUTES_DELETED', 'Die Attribute wurden gelöscht');
define('SUCCESS_ATTRIBUTES_UPDATE', 'Die Attribute wurden aktualisiert');
define('ICON_ATTRIBUTES', 'Attributmerkmale');
define('TEXT_CATEGORIES_IMAGE_DIR', 'In Verzeichnis hochladen:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Warnung: Die Lagerstückzahl nicht angezeigt, der Standardwert ist 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Warnung: Die Lagerstückzahl wird nicht angezeigt, der Standardwert ist 1');
define('TEXT_PRODUCT_OPTIONS', '<strong>Bitte wählen Sie:</strong>');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributeigenschaften für:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads:');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Der angezeigte Preis enthält den niedrigsten Gruppenattributspreis plus dem Grundpreis');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Der angezeigte Preis enthält den niedrigsten Gruppenattributspreis plus dem Grundpreis');
define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Artikel Mindestbestand:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Artikelbestandseinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Artikel Maximalbestand:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', 'geben Sie die Anzahl ein (0 = unlimitiert)');
define('TEXT_PRODUCTS_MIXED', 'Artikel Mindestbestand/Anzahl Mix:');
define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Artikel ist kostenlos');
define('TEXT_PRODUCT_IS_FREE', 'Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Artikel ist als kostenlos markiert');
define('TEXT_PRODUCTS_IS_FREE_EDIT', '*Artikel ist als kostenlos markiert');
define('TEXT_PRODUCT_IS_CALL', 'Artikel ist "Preis bitte anfragen":');
define('TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Artikel ist als "Preis bitte anfragen" gekennzeichnet');
define('TEXT_PRODUCTS_IS_CALL_EDIT', '*Artikel ist als "Preis bitte anfragen" gekennzeichnet');
define('TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Überspringe neue Attribute </strong>');
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Einfügen neuer Attribute von</strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Aktualisiere von Attribut </strong>');

// meta tags
define('TEXT_META_TAG_TITLE_INCLUDES', '<strong>Wählen Sie aus, welche Informationen die Metatags des Artikels enthalten sollen:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS', '<strong>Artikelname:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS', '<strong>Titel:</strong>');
define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS', '<strong>Bezeichnung:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS', '<strong>Preis:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS', '<strong>Titelüberschrift:</strong>');
define('TEXT_META_TAGS_TITLE', '<strong>Meta Tag Titel:</strong>');
define('TEXT_META_TAGS_KEYWORDS', '<strong>Meta Tag Schlüsselwörter:</strong>');
define('TEXT_META_TAGS_DESCRIPTION', '<strong>Meta Tag Beschreibung:</strong>');
define('TEXT_META_EXCLUDED', '<span class="alert">AUSGESCHLOSSEN</span>');
