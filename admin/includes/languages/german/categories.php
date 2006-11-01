<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
//  $Id: categories.php 4 2006-03-31 16:38:40Z hugo13 $
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
define('TEXT_DATE_ADDED', 'Erstelldatum:');
define('TEXT_DATE_AVAILABLE', 'Erh&auml;ltlich ab:');
define('TEXT_LAST_MODIFIED', 'Letzte &Auml;nderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild existiert nicht');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte f&uuml;gen Sie eine neue Kategorie oder einen neuen Artikel in dieser Ebene ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'F&uuml;r weitere Informationen besuchen Sie bitte unsere  <a href="http://%s" target="blank">Homepage</a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'Dieser Artikel wurde am %s hinzugef&uuml;gt.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist am %s wieder verf&uuml;gbar.');

define('TEXT_EDIT_INTRO', 'Bitte f&uuml;hren Sie hier die notwendigen &Auml;nderungen durch');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte w&auml;hlen Sie die neue Kategorie aus, in die Sie diesen Artikel kopieren m&ouml;chten');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Kategorie:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie &auml;ndern');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Wollen Sie diese Kategorie wirklich l&ouml;schen?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Warnung:</strong> Verbundene Produkte, deren Vorlagenkategorie gel&ouml;scht wird, setzen nicht den richtigen Preis fest. Vor dem Entfernen einer Kategorie sollten Sie zuerst sicherstellen, da&szlig; die zu l&ouml;schende Kategorie keine verbundenen Produkte enth&auml;lt. Noch enthaltene verbundene Produkte sollten einer anderen Hauptkategorie zugeordnet werden');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel l&ouml;schen wollen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ACHTUNG:</b> Es sind bereits %s (Unter-)Kategorien mit dieser Kategorie verlinkt!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ACHTUNG:</b> Es sind bereits %s Artikel mit dieser Kategorie verlinkt!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte Kategorie ausw&auml;hlen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte Kategorie ausw&auml;hlen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'Geben Sie folgende Informationen f&uuml;r die neue Kategorie an');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCTS_VIRTUAL', 'Virtueller Artikel:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', 'Immer versandkostenfrei:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', 'Lagerbestand anzeigen:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'lagernd');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'nicht lagernd');
define('TEXT_PRODUCT_IS_VIRTUAL', 'Ja');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'Nein');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'Ja');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'Nein');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'Ja');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'Nein');

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

define('TEXT_RESTRICT_PRODUCT_TYPE', 'Auf Artikeltyp beschr&auml;nken');
define('TEXT_CATEGORY_HAS_RESTRICTIONS', 'Diese Kategorie wurde auf diese Artikeltypen beschr&auml;nkt');
define('ERROR_CANNOT_ADD_PRODUCT_TYPE', 'Der gew&auml;hlte Artikel kann dieser Kategorie nicht hinzugef&uuml;gt werden. &Uuml;berpr&uuml;fen Sie die Einschr&auml;nkungen der Kategorie.');








// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'wird nur f&uuml;r doppelte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Artikelattribute zum Duplikat kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');

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
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Ignorieren</strong> und nur neue Attribute hinzuf&uuml;gen');

define('SUCCESS_ATTRIBUTES_DELETED', 'Die Attribute wurden gel&ouml;scht');
define('SUCCESS_ATTRIBUTES_UPDATE', 'Die Attribute wurden aktualisiert');

define('ICON_ATTRIBUTES', 'Attributmerkmale');

define('TEXT_CATEGORIES_IMAGE_DIR', 'In Verzeichnis hochladen:');

define('TEXT_VIRTUAL_PREVIEW', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und ignoriert Versandadressen');
define('TEXT_VIRTUAL_EDIT', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und ignoriert Versandadressen');
define('TEXT_FREE_SHIPPING_PREVIEW', 'Achtung: Dieser Artikel ist als versandkostenfrei markiert und ben&ouml;tigt eine Versandadresse');
define('TEXT_FREE_SHIPPING_EDIT', 'Achtung: Mit "Ja" kennzeichnen Sie diesen Artikel als versandkostenfrei - eine Versandadresse wird ben&ouml;tigt');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW', 'Warnung: Ohne Anzeige der Lager-St&uuml;ckzahl ist der Standardwert 1');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT', 'Warnung: Ohne Anzeige der Lager-St&uuml;ckzahl ist der Standardwert 1');

define('TEXT_PRODUCT_OPTIONS', '<strong>Bitte w&auml;hlen Sie:</strong>');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributwert f&uuml;r:');

define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads:');

define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE', 'Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE', 'Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW', '*Der Ausstellungspreis wird die niedrigsten Gruppenattributspreise plus Preis mit einschlie&szlig;en');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT', '*Der Ausstellungspreis wird die niedrigsten Gruppenattributspreise plus Preis mit einschlie&szlig;en');

define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL', 'Artikel Mindestabnahme:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL', 'Abnahmeeinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL', 'Artikel Maximalabnahme:');

define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT', 'geben Sie die Anzahl ein (0 = unlimitiert)');

define('TEXT_PRODUCTS_MIXED', 'Artikel Mindestabnahme/Anzahl Mix:');

define('PRODUCTS_PRICE_IS_FREE_TEXT', 'Artikel ist kostenlos');
define('TEXT_PRODUCT_IS_FREE', 'Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_PREVIEW', '*Artikel ist als kostenlos markiert');
define('TEXT_PRODUCTS_IS_FREE_EDIT', '*Artikel ist als kostenlos markiert');

define('TEXT_PRODUCT_IS_CALL', 'Artikel ist "Preis bitte anfragen":');
define('TEXT_PRODUCTS_IS_CALL_PREVIEW', '*Artikel ist mit "Preis bitte anfragen" gekennzeichnet');
define('TEXT_PRODUCTS_IS_CALL_EDIT', '*Artikel ist mit "Preis bitte anfragen" gekennzeichnet');

define('TEXT_ATTRIBUTE_COPY_SKIPPING', '<strong>&Uuml;berspringe neue Attribute </strong>');
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Einf&uuml;gen neuer Attribute von</strong>');
define('TEXT_ATTRIBUTE_COPY_UPDATING', '<strong>Aktualisieren von Attribut </strong>');

define('TEXT_SHIPPING_INFO',
     '<strong>Virtuelle Artikel</strong> sind versandkostenfrei und ben&ouml;tigen <strong>keine</strong> Lieferadresse, z.B. Artikel wie ' . TEXT_GV_NAMES . ', etc.<br />' .
     'Artikel, die als <strong>Immer versandkostenfrei</strong> gekennzeichnet sind, sind versandkostenfrei, <strong>ben&ouml;tigen</strong> jedoch eine Lieferadresse<br />' .
     '<strong>Download-Artikel</strong> sind <strong>versandkostenfrei</strong> und ben&ouml;tigen <strong>keine</strong> Lieferadresse<br />');

define('TEXT_ANY_TYPE', 'Jeder Typ');
define('TABLE_HEADING_PRODUCT_TYPES', 'Artikeltyp(en)');

// categories status
define('TEXT_INFO_HEADING_STATUS_CATEGORY', 'Kategoriestatus &auml;ndern f&uuml;r:');
define('TEXT_CATEGORIES_STATUS_INTRO', 'Kategoriestatus &auml;ndern nach: ');
define('TEXT_CATEGORIES_STATUS_OFF', 'AUS');
define('TEXT_CATEGORIES_STATUS_ON', 'EIN');
define('TEXT_PRODUCTS_STATUS_INFO', 'JEDEN Artikelstatus &auml;ndern nach: ');
define('TEXT_PRODUCTS_STATUS_OFF', 'AUS');
define('TEXT_PRODUCTS_STATUS_ON', 'EIN');
define('TEXT_PRODUCTS_STATUS_NOCHANGE', 'Unver&auml;ndert');
define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>WARNUNG ...</strong><br />Hinweis: Wenn Sie eine Kategorie deaktivieren, deaktivieren Sie auch ALLE Artikel, die in dieser Kategorie enthalten sind. Verlinkte Artikel in dieser Kategorie, welche mit anderen Kategorien verlinkt sind, werden dadurch ebenfalls deaktiviert.');

define('TEXT_PRODUCTS_STATUS_ON_OF', ' von ');
define('TEXT_PRODUCTS_STATUS_ACTIVE', ' aktiv ');

define('TEXT_CATEGORIES_DESCRIPTION', 'Kategoriebeschreibung:');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', 'Artikel ist "Preis bitte anfragen."');

// Metatags
define('TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', 'Kategorien Meta Tags Definitionen');      
define('TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', 'Definiere Benutzer-Meta Tags');  
define('TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', 'Titel:'); 
define('TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', 'Schlagwort:');
define('TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', 'Beschreibung');

define('WARNING_PRODUCTS_IN_TOP_INFO', 'WARNUNG: Sie haben Produkte in der Hauptkategorie. Dadurch werden die Preise im Katalog nicht richtig zugeordnet. Folgende Produkte wurden gefunden: ');


?>