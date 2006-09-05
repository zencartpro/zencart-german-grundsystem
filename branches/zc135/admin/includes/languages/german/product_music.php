<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
//  $Id: product_music.php 4 2006-03-31 16:38:40Z hugo13 $
//

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
define('TEXT_PRODUCTS_RECORD_ARTIST', 'K&uuml;nstler:');
define('TEXT_PRODUCTS_RECORD_COMPANY', 'Plattenfirma:');
define('TEXT_PRODUCTS_MUSIC_GENRE', 'Musik Genre:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuersatz:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Anzahl:');
define('TEXT_DATE_ADDED', 'Erstelldatum:');
define('TEXT_DATE_AVAILABLE', 'Erh&auml;ltlich ab:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild existiert nicht');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte f&uuml;gen Sie eine neue Kategorie oder einen neuen Artikel in dieser Ebene ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'F&uuml;r weitere Informationen besuchen Sie bitte unsere  <a href="http://%s" target="blank">Homepage</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieser Artikel wurde am %s hinzugef&uuml;gt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel wird am %s wieder lagernd sein.');

define('TEXT_EDIT_INTRO', 'Bitte f&uuml;hren Sie hier die notwendigen Änderungen durch');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte w&auml;hlen Sie die neue Kategorie aus, in der Sie diesen Artikel kopieren m&ouml;chten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie &auml;ndern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Wollen Sie diese Kategorie wirklich l&ouml;schen?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Wollen Sie diesen Artikel wirklich l&ouml;schen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> es sind bereits %s (Unter-)Kategorien mit dieser Kategorie verlinkt!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> es sind bereits %s Artikel mit dieser Kategorie verlinkt!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte w&auml;hlen Sie die Kategorie aus, in der Sie <b>%s</b> legen wollen');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte w&auml;hlen Sie die Kategorie aus, in der Sie <b>%s</b> legen wollen');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'F&uuml;llen Sie folgende Informationen f&uuml;r die neue Kategorie aus');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCTS_VIRTUAL', 'Virtueller Artikel:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Immer Versandkostenfrei:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Lagerbestand anzeigen:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'lagernd');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'nicht lagernd');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Ja');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'Nein');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Ja');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nein');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', 'Sonderangebot, Artikel/Download ben&ouml;tigt eine Lieferadresse');
define('TEXT_PRODUCTS_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Ja, zeige Box f&uuml;r St&uuml;ckzahl');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nein, zeige keine Box f&uuml;r St&uuml;ckzahl');

define('TEXT_PRODUCTS_MANUFACTURER', 'Artikelhersteller:');
define('TEXT_PRODUCTS_NAME', 'Artikelname:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikelbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Lagerbestand:');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer:');
define('TEXT_PRODUCTS_IMAGE', 'Artikelbild:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'Uploadverzeichnis:');
define('TEXT_PRODUCTS_URL', 'Herstellerlink:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne f&uuml;hrendes http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Nettopreis:');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Bruttopreis:');
define('TEXT_PRODUCTS_WEIGHT', 'Gewicht:');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Artikellink');
define('TEXT_COPY_AS_DUPLICATE', 'Doppelter Artikel');

// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'wird nur f&uuml;r Doppelte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Artikelattribute zum Duplikat kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');
define('TEXT_COPY_MEDIA_MANAGER', 'Kopiere jede Kollektion im Medienmanager, die mit diesem Artikel in Verbindung stehen.');

define('TEXT_INFO_CURRENT_PRODUCT', 'Aktueller Artikel:');
define('TABLE_HEADING_MODEL', 'Artikelnummer');

define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attribute f&uuml;r Artikel ID# ge&auml;ndert');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'L&ouml;sche <strong>ALLE</strong> Artikelattribute f&uuml;r:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO', 'Kopiere Attribute zu einem anderen Artikel oder einer ganzen Kategorie von:<br />');

define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopiere Attribute zu einem anderen <strong>Artikel</strong> von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopiere Attribute zu einer anderen <strong>Kategorie</strong> von:<br />');

define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie sollen existierende Artikelattribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', 'Bitte zuerst <strong>l&ouml;schen</strong> bevor Sie neue Attribute kopieren');
define('TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Aktualisieren</strong> Sie die neuen Einstellungen/Preise, bevor Sie neue hinzuf&uuml;gen');
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>ignorieren</strong> und nur neue Attribute hinzuf&uuml;gen');

define('SUCCESS_ATTRIBUTES_DELETED', 'Die Attribute wurden gel&ouml;scht');
define('SUCCESS_ATTRIBUTES_UPDATE', 'Die Attribute wurden aktualisiert');

define('ICON_ATTRIBUTES', 'Attributmerkmale');

define('TEXT_CATEGORIES_IMAGE_DIR', 'In Verzeichnis hochladen:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Warnung: Die Lagerst&uuml;ckzahl nicht angezeigt, der Standardwert ist 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Warnung: Die Lagerst&uuml;ckzahl wird nicht angezeigt, der Standardwert ist 1');

define('TEXT_PRODUCT_OPTIONS', '<strong>Bitte w&auml;hlen Sie:</strong>');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributeigenschaften f&uuml;r:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads:');

define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Der Ausstellungspreis wird die niedrigsten Gruppenattributspreise plus Preis mit einschlie&szlig;en');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Der Ausstellungspreis wird die niedrigsten Gruppenattributspreise plus Preis mit einschlie&szlig;en');

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
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Einf&uuml;gen neuer Attribute von</strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Aktualisiere von Attribut </strong>');

// meta tags
define('TEXT_META_TAG_TITLE_INCLUDES', '<strong>Selektiere welche Informationen der Artikel METATAG Titel enthalten soll:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS', '<strong>Artikelname:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS', '<strong>Titel:</strong>');
define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS', '<strong>Bezeichnung:</strong>');
define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS', '<strong>Preis:</strong>');
define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS', '<strong>Titel/Tagline:</strong>');
define('TEXT_META_TAGS_TITLE', '<strong>Meta Tag Title:</strong>');
define('TEXT_META_TAGS_KEYWORDS', '<strong>Meta Tag Keywords:</strong>');
define('TEXT_META_TAGS_DESCRIPTION', '<strong>Meta Tag Description:</strong>');
define('TEXT_META_EXCLUDED', '<span class="alert">EXCLUDED</span>');
?>
