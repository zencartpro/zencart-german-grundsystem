<?php
/**
 * Cross Sell Products
 * Zen Cart German Speficic
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Reworked for Zen Cart 1.5.7+, lat9, December 2021
 * German t ranslation webchills, January 2022
 */
define('CROSS_SELL_SUCCESS', 'Cross-Sell Artikel erfolgreich aktualisiert für <em>%1$s [%2$u]</em>.');    //-%1$s (product's name), %2%u (product's id).
define('MAIN_CROSS_SELL_REMOVED', 'Alle Cross-Sell-Artikel erfolgreich entfernt für <em>%s</em>.');  //-%s (product's name)
define('ERROR_NO_MAIN_PRODUCT', 'Kein Hauptprodukt ausgewählt; es kann kein Cross-Sell definiert werden.');
define('ERROR_INVALID_MAIN_PRODUCT', 'Ungültiges Hauptprodukt (%u); es kann kein Cross-Sell definiert werden.');
define('ERROR_MISSING_MAIN_PRODUCT', 'Fehlendes Hauptprodukt zum Erstellen/Aktualisieren von Cross-Sells; Rückkehr zur Hauptanzeige.');
define('ERROR_CROSS_SELL_EXISTS', 'Das angeforderte Produkt ist bereits ein Cross-Sell für das ausgewählte Hauptprodukt.');

define('ERROR_MODEL_NO_EXIST', 'Die Artikelnummer (%s) existiert nicht; die Anfrage für den mehrfachen Cross-Sell wurde nicht ausgeführt');
define('ERROR_MODEL_MULTIPLE_PRODUCTS', 'Die Artikelnummer (%s) ist mit mehreren Produkten verknüpft; die Anfrage für den mehrfachen Cross-Sell wurde nicht ausgeführt.');
define('ERROR_NO_MODELS', 'Es muss mindestens eine Artikelnummer angegeben werden, damit mehrere Cross-Sells hinzugefügt werden können.');
define('MULTI_XSELL_SUCCESS', '%u Cross-Sells erfolgreich hinzugefügt.');
define('NO_MULTI_XSELLS_CREATED', 'Alle Artikel sind bereits Cross-Sells!');

define('HEADING_TITLE', 'Cross-Sell Administration');
define('SUBHEADING_MAIN_ADD', 'Neuen Cross-Sell Artikel anlegen');
define('SUBHEADING_MAIN_TITLE', 'Aktuelle Artikel mit Cross-Sells anzeigen');

define('SUBHEADING_TITLE_NEW', 'Verwalte Cross-Sells für %s');        //-%s is filled in with the main product's name and ID
define('SUBHEADING_NEW_ADD', 'Einzelnen Cross-Sell hinzufügen');
define('SUBHEADING_MULTI_ADD', 'Mehrere Cross-Sells hinzufügen');
define('SUBHEADING_MANAGE_EXISTING', 'Verwalte bestehende Cross-Sells');

define('TABLE_HEADING_PRODUCT_ID', 'Artikel Id');
define('TABLE_HEADING_PRODUCT_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCT_NAME', 'Artikelname');
define('TABLE_HEADING_CURRENT_SELLS', 'derzeitige Cross-Sells');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Artikelbild');
define('TABLE_HEADING_PRODUCT_PRICE', 'Artikelpreis');
define('TABLE_HEADING_PRODUCT_SORT', 'Sortierung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_REMOVE', 'Entfernen?');

define('TEXT_BUTTON_NEW', 'Neu');
define('TEXT_BOTH_WAYS', 'Cross-Sell beidseitig?');

define('TEXT_MAIN_INSTRUCTIONS', 'Verwenden Sie die unten stehenden Formulare, um entweder ein neues Cross-Sell-Produkt zu erstellen oder um bestehende Cross-Sells zu verwalten.');
define('TEXT_EDIT_INSTRUCTIONS', 'Verwenden Sie die nachstehenden Formulare, um entweder einen neuen Cross-Sell zu dem ausgewählten Produkt hinzuzufügen oder um die bestehenden Cross-Sells des ausgewählten Produkts zu verwalten.');

define('TEXT_NO_CROSS_SELL_PRODUCTS', 'Für das ausgewählte Produkt wurden keine Cross-Sells definiert.');
define('TEXT_NO_CROSS_SELLS', 'Es wurden keine Cross-Sell-Produkte definiert.');

define('TEXT_JS_MAIN_DELETE_CONFIRM', 'Sind Sie sicher, dass Sie die Cross-Sells für das oben genannte Produkt entfernen möchten?');
