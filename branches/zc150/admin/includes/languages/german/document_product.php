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
//  $Id: document_product.php 302 2008-05-30 19:49:12Z maleborg $
//

define('HEADING_TITLE', 'Kategorien / Artikel');
define('HEADING_TITLE_GOTO', 'Gehe zu:');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_QUANTITY', 'Stückzahl');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliches Rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Stückzahl:');
define('TEXT_DATE_ADDED', 'Erstellt am:');
define('TEXT_DATE_AVAILABLE', 'Verfügbar ab:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'BILD EXISTIERT NICHT');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder einen neuen Artikel in dieser Ebene ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Weitere Informationen zu diesem Artikel erhalten Sie auf dieser <a href="http://%s" target="blank">Webseite</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieser Artikel wurde am %s dem Shop hinzugefügt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Artikel wird ab %s wieder angeboten.');
define('TEXT_EDIT_INTRO', 'Bitte führen Sie die notwendigen Änderungen durch');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierung:');
define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie die neue Kategorie, in die Sie diesen Artikel kopieren wollen');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuelle Kategorien: ');
define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'kopieren nach');
define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen wollen?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel dauerhaft löschen wollen?');
define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNUNG:</b> Es sind %s (Unter-)Kategorien zu dieser Kategorie verlinkt!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNUNG:</b> Es sind %s Artikel zu dieser Kategorie verlinkt!');
define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie, welche Kategorie <b>%s</b> beinhalten soll');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie, welche Kategorie <b>%s</b> beinhalten soll');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');
define('TEXT_NEW_CATEGORY_INTRO', 'Bitte geben Sie folgende Informationen für die neue Kategorie an');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierung:');
define('TEXT_PRODUCTS_STATUS', 'Dokumenten-Status:');
define('TEXT_PRODUCTS_VIRTUAL', 'Artikel ist ein virtueller Artikel:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Immer versandkostenfrei:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Box für Artikelstückzahl anzeigen:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Datum der Verfügbarkeit:');
define('TEXT_PRODUCT_AVAILABLE', 'Verfügbar');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht verfügbar');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Ja, Versandadresse überspringen');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'Nein, Versandadresse wird benötigt');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Ja, immer versandkostenfrei');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nein, normale Versandregeln');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Spezial, Produkt/Download Combo erfordert eine Lieferadresse');
define('TEXT_PRODUCTS_SORT_ORDER', 'Sortierung:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Ja, zeige Box für die Stückzahl');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nein, zeige keine Box für die Stückzahl');
define('TEXT_PRODUCTS_MANUFACTURER', 'Artikelhersteller:');
define('TEXT_PRODUCTS_NAME', 'Artikelname:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikelbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Artikelstückzahl:');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer:');
define('TEXT_PRODUCTS_IMAGE', 'Artikelbild:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'Zu Verzeichnis hochladen:');
define('TEXT_PRODUCTS_URL', 'Artikel URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(Ohne http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Artikelpreis (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Artikelpreis (Brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Artikelgewicht:');
define('EMPTY_CATEGORY', 'Leere Kategorie');
define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Artikellink');
define('TEXT_COPY_AS_DUPLICATE', 'Artikel duplizieren');

// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'Nur für doppelte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Sollen die Artikelattribute zum Duplikat kopiert werden?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');
define('TEXT_INFO_CURRENT_PRODUCT', 'Aktueller Artikel: ');
define('TABLE_HEADING_MODEL', 'Artikelnummer');
define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attribute wurden geändert für Artikel ID# ');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Lösche <strong>ALLE</strong> Artikelattribute für:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO', 'Kopiere Attribute zu einem anderen Artikel oder zur ganzen Kategorie von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopiere Attribute zu einem anderen <strong>Artikel</strong> von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopiere Attribute zu einer anderen <strong>Kategorie</strong> von:<br />');
define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie sollen vorhandene Attribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', 'Erst <strong>löschen</strong>, dann die neuen Attribute kopieren');
define('TEXT_COPY_ATTRIBUTES_UPDATE', 'Mit den neuen Einstellungen/Preisen <strong>aktualisieren</strong>, dann die neuen hinzufügen');
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Ignorieren</strong> und nur neue Attribute hinzufügen');
define('SUCCESS_ATTRIBUTES_DELETED', 'Attribute erfolgreich gelöscht');
define('SUCCESS_ATTRIBUTES_UPDATE', 'Attribute erfolgreich aktualisiert');
define('ICON_ATTRIBUTES', 'Attributmerkmale');
define('TEXT_CATEGORIES_IMAGE_DIR', 'Zu Verzeichnis hochladen:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Warnung: Ohne Anzeige der Lager-Stückzahl ist der Standardwert 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Warnung: Ohne Anzeige der Lager-Stückzahl ist der Standardwert 1');
define('TEXT_PRODUCT_OPTIONS', '<strong>Bitte wählen:</strong>');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributmerkmale für:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads: ');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Die Preisanzeigen wird den Grundpreis plus den kleinsten Attributgruppenpreis beinhalten');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Die Preisanzeigen wird den Grundpreis plus den kleinsten Attributgruppenpreis beinhalten');
define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Artikel Mindestabnahme:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Abnahmeeinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Artikel Maximalabnahme:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', '0 = Unlimitiert, 1 = Keine Box für Artikelstückzahl');
define('TEXT_PRODUCTS_MIXED', 'Artikel Mindestabnahme/Anzahl Mix:');
define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Artikel ist kostenlos');
define('TEXT_PRODUCT_IS_FREE', 'Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Artikel ist als KOSTENLOS markiert');
define('TEXT_PRODUCTS_IS_FREE_EDIT', '*Artikel ist als KOSTENLOS markiert');
define('TEXT_PRODUCT_IS_CALL', 'Artikel ist "Preis bitte anfragen":');
define('TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Artikel ist als "Preis bitte anfragen" markiert');
define('TEXT_PRODUCTS_IS_CALL_EDIT', '*Artikel ist als "Preis bitte anfragen" markiert');
define('TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>Überspringe neue Attribute </strong>');
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Füge neue Attribute ein von </strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Aktualisiere von Attribut </strong>');

// meta tags
define('TEXT_META_TAG_TITLE_INCLUDES','<strong>Kennzeichnen, was die Produkt-Meta-Tag-Titel mit einschließen sollten:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS','<strong>Produktname:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS','<strong>Titel:</strong>');
define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS','<strong>Modell:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS','<strong>Preis:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS','<strong>Titelüberschrift:</strong>');
define('TEXT_META_TAGS_TITLE','<strong>Meta Tag Titel:</strong>');
define('TEXT_META_TAGS_KEYWORDS','<strong>Meta Tag Schlüsselworte:</strong>');
define('TEXT_META_TAGS_DESCRIPTION','<strong>Meta Tag Beschreibung:</strong>');
define('TEXT_META_EXCLUDED', '<span class="alert">AUSGESCHLOSSEN</span>');


?>