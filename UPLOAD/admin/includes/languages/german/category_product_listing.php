<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: category_product_listing.php 3 2019-07-20 10:09:16Z webchills $
 */
define('HEADING_TITLE', 'Kategorien / Artikel');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien & Artikel');
define('TABLE_HEADING_MODEL', 'Artikelnummer');

define('TABLE_HEADING_PRICE', 'Preis/Sonderangebot/Abverkauf');
define('TABLE_HEADING_QUANTITY', 'Anzahl');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sortierung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_PRODUCTS_STATUS_ON_OF', ' von ');
define('TEXT_PRODUCTS_STATUS_ACTIVE', ' aktiv');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_DELETE_CATEGORY_INTRO', 'Wollen Sie diese Kategorie wirklich löschen?');
define('TEXT_DELETE_CATEGORY_INTRO_LINKED_PRODUCTS', '<strong>Warnung:</strong> Verbundene Artikel, deren Master Kategorie ID gelöscht wird, setzen nicht den richtigen Preis fest. Vor dem Entfernen einer Kategorie sollten Sie zuerst sicherstellen, daß die zu löschende Kategorie keine verbundenen Artikel enthält. Noch enthaltene verbundene Artikel sollten einer anderen Master Kategorie ID zugeordnet werden');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte Kategorie auswählen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel permanent löschen wollen?<br /><br /><strong>HINWEIS:</strong> bei verlinkten Artikeln<br />1 Vergewissern Sie sich, dass die Master-Kategorie geändert wurde, wenn Sie das Produkt aus der Master-Kategorie löschen<br />2 Aktivieren Sie das Kontrollkästchen für die Kategorie zum Löschen des Produkts aus der Kategorie');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte Kategorie auswählen, in die Sie <b>%s</b> verschieben wollen');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Derzeitige Kategorien: ');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');
define('TEXT_INFO_COPY_TO_INTRO', 'Bitte Kategorie auswählen, in die Sie den Artikel kopieren wollen');
define('TEXT_INFO_CURRENT_PRODUCT', 'Derzeitiger Artikel: ');
define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Artikel verlinken');
define('TEXT_COPY_AS_DUPLICATE', 'Artikel duplizieren');
define('TEXT_COPY_METATAGS','Metatags zum Duplikat kopieren?');
define('TEXT_COPY_LINKED_CATEGORIES','Verlinkte Kategorien zum Duplikat kopieren?');
define('TEXT_COPY_AS_DUPLICATE_METATAGS', 'Metatags für Sprach ID#%u erfolgreich kopiert von Artikel ID#%u zur duplizierten Artikel ID#%u');
define('TEXT_COPY_AS_DUPLICATE_CATEGORIES', 'Verlinkte Kategorie ID#%u erfolgreich kopiert von Artikel ID#%u zur duplizierten Artikel ID#%u');
define('TEXT_COPY_AS_DUPLICATE_DISCOUNTS', 'Rabatte erfolgreich kopiert von Artikel ID#%u zur duplizierten Artikel ID#%u');
define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES', 'Attributänderungen für Artikel ID# ');
define('TEXT_PRODUCTS_ATTRIBUTES_INFO', 'Attributmerkmale For:');
define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS', 'Downloads: ');
define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE', 'Lösche <strong>ALLE</strong> Artikelattribute für:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT', 'Kopiere Attribute zu einem anderen <strong>Artikel</strong> von:<br />');
define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY', 'Kopiere Attribute zu einer anderen <strong>Kategorie</strong> von:<br />');
define('TEXT_COPY_ATTRIBUTES_CONDITIONS', '<strong>Wie sollen bestehende Artikelattribute behandelt werden?</strong>');
define('TEXT_COPY_ATTRIBUTES_DELETE', '<strong>Löschen</strong> - Bestehende Attribute werden gelöscht, dann die neuen Attribute kopiert.');
define('TEXT_COPY_ATTRIBUTES_UPDATE', '<strong>Aktualisieren</strong> Bestehende Attribute werden mit den neuen Einstellungen/Preisen aktualisiert, dann werden die neuen Attribute kopiert.');
define('TEXT_COPY_ATTRIBUTES_IGNORE', '<strong>Ignorieren</strong> Bestehende Attribute werden beibehalten und nur die neuen Attribute hinzufügen');
define('TEXT_ATTRIBUTE_COPY_INSERTING', '<strong>Einfügen neuer Attribute von </strong>');
define('ICON_ATTRIBUTES', 'Attributmerkmale');

// Products and Attribute Copy Options
define('TEXT_COPY_ATTRIBUTES_ONLY', 'wird nur für duplizierte Artikel verwendet ...');
define('TEXT_COPY_ATTRIBUTES', 'Artikelattribute zum Duplikat kopieren?');
define('TEXT_COPY_ATTRIBUTES_YES', 'Ja');
define('TEXT_COPY_ATTRIBUTES_NO', 'Nein');

// Products and Discount Copy Options
define('TEXT_COPY_DISCOUNTS_ONLY', 'wird nur verwendet für duplizierte Artikel mit Mengenrabatten ...');
define('TEXT_COPY_DISCOUNTS', 'Mengenrabatte des Artikels zum Duplikat kopieren?');
define('TEXT_COPY_DISCOUNTS_YES', 'Ja');
define('TEXT_COPY_DISCOUNTS_NO', 'Nein');

// From categories.php in 1.5.5
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
define('TEXT_SUBCATEGORIES_STATUS_INFO', 'Ändere den Status ALLER Unterkategorien auf:');
define('TEXT_SUBCATEGORIES_STATUS_OFF', 'Deaktiviert');
define('TEXT_SUBCATEGORIES_STATUS_ON', 'Aktiviert');
define('TEXT_SUBCATEGORIES_STATUS_NOCHANGE', 'Unverändert');

define('WARNING_PRODUCTS_IN_TOP_INFO', 'WARNUNG: Sie haben Produkte in der Hauptkategorie. Dadurch werden die Preise im Shop nicht richtig zugeordnet. Folgende Produkte wurden gefunden: ');
define('TEXT_COPY_MEDIA_MANAGER', 'Medien kopieren?');
