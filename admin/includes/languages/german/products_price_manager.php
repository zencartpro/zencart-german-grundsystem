<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.at/index.php                                    |
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
//  $Id: products_price_manager.php 543 2004-11-13 19:19:29Z wilt $
//

define('HEADING_TITLE', 'Artikelpreismanager');
define('HEADING_TITLE_PRODUCT_SELECT','W&auml;hlen Sie bitte einen Artikel aus, um die Preisinformationen anzuzeigen ...');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_PRODUCTS_MODEL','Artikelnummer');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Prozentsatz');
define('TABLE_HEADING_AVAILABLE_DATE', 'Verf&uuml;gbar ab');
define('TABLE_HEADING_EXPIRES_DATE','Ablaufdatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_PRODUCT_INFO', 'Artikelinfo:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Artikelpreis Info:');
define('TEXT_PRODUCTS_MODEL','Artikelnummer:');
define('TEXT_PRICE', 'Preis');
define('TEXT_PRODUCT_AVAILABLE_DATE', 'Verf&uuml;gbar ab:');
define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCT_AVAILABLE', 'Lagernd');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht lagernd');
define('TEXT_PRODUCT_INFO_NONE', 'Bitte w&auml;hlen Sie einen Artikel ...');
define('TEXT_PRODUCT_IS_FREE','Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_EDIT','<br />*Artikel markiert als KOSTENLOS');
define('TEXT_PRODUCT_IS_CALL','Preis bitte anfragen:');
define('TEXT_PRODUCTS_IS_CALL_EDIT','<br />*Artikel ist als &quot;Preis bitte anfragen&quot; markiert');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br />*Der angezeigte Preis enth&auml;lt den niedrigsten Gruppenattributspreis plus dem Grundpreis');
define('TEXT_PRODUCTS_MIXED','Artikel Mindestabnahme/Anzahl Mix:');
define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', 'St&uuml;ckzahlerm&auml;&szlig;igung gilt f&uuml;r gemischte Attribute');
define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Artikel Mindestabnahme:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Artikelbestandseinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Artikel Maximalabnahme:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0= Unlimitiert<br />1= Keine Box f&uuml;r St&uuml;ckzahlen/Maximalwerte');
define('TEXT_FEATURED_PRODUCT_INFO', '&Auml;hnliche Artikel Info:');
define('TEXT_FEATURED_PRODUCT', 'Artikel:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'verf&uuml;gbar ab:');
define('TEXT_FEATURED_PRODUCTS_STATUS', 'Status &auml;hnlicher Artikel:');
define('TEXT_FEATURED_PRODUCT_AVAILABLE', 'Aktiv');
define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', 'Inaktiv');
define('TEXT_FEATURED_DISABLED', '<strong>HINWEIS: &quot;&Auml;hnliche Artikel&quot; Info ist deaktiviert, abgelaufen oder derzeit nicht aktiv</strong>');
define('TEXT_SPECIALS_PRODUCT', 'Artikel:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Sonderpreis:');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Verf&uuml;gbar ab:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>Spezieller Hinweis:</b><ul><li>Sie k&ouml;nnen eine prozentuale Preisreduktion im Feld f&uuml;r Sonderpreise angeben, zum Beispiel: <b>20%</b></li><li>Wenn Sie einen neuen Preis angeben, muss die Dezimalstelle durch einen \'.\' (Dezimalpunkt) getrennt werden, Beispiel: <b>49.99</b></li><li>Wenn es kein Ablaufdatum geben soll, lassen Sie das Feld f&uuml;r das Ablaufdatum leer</li></ul>');
define('TEXT_SPECIALS_PRODUCT_INFO', 'Sonderpreis Info:');
define('TEXT_SPECIALS_PRODUCTS_STATUS', 'Sonderangebot Status:');
define('TEXT_SPECIALS_PRODUCT_AVAILABLE', 'Aktiv');
define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', 'Inaktiv');
define('TEXT_SPECIALS_NO_GIFTS','Keine Sonderangebote im GV');
define('TEXT_SPECIAL_DISABLED', '<strong>HINWEIS: &quot;Sonderangebot&quot; Info ist deaktiviert, abgelaufen oder derzeit nicht aktiv</strong>');
define('TEXT_INFO_DATE_ADDED', 'Erstelldatum:');
define('TEXT_INFO_LAST_MODIFIED', 'Letzte &Auml;nderung:');
define('TEXT_INFO_NEW_PRICE', 'Neuer Preis:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Originalpreis:');
define('TEXT_INFO_PERCENTAGE', 'Prozentsatz:');
define('TEXT_INFO_AVAILABLE_DATE', 'Verf&uuml;gbar ab:');
define('TEXT_INFO_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_INFO_STATUS_CHANGE', 'Letzte Status&auml;nderung:');
define('TEXT_IMAGE_NONEXISTENT', 'Bild existiert nicht');
define('TEXT_INFO_HEADING_DELETE_FEATURED', '&Auml;hnliche Artikel l&ouml;schen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Status l&ouml;schen wollen?');
define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>Definieren Sie die Einstellungen der Attribute und klicken anschlie&szlig;end auf Einf&uuml;gen, um die &Auml;nderungen wirksam zu machen</strong>');
define('TEXT_PRICED_BY_ATTRIBUTES', 'Preis durch Attribute festgelegt');
define('TEXT_PRODUCTS_PRICE', 'Artikelpreis: ');
define('TEXT_SPECIAL_PRICE', 'Sonderpreis: ');
define('TEXT_SALE_PRICE', 'Abverkaufspreis: ');
define('TEXT_FREE', 'KOSTENLOS');
define('TEXT_CALL_FOR_PRICE', 'Preis bitte anfragen');
define('TEXT_ADD_ADDITIONAL_DISCOUNT', 'hinzuf&uuml;gen ' . DISCOUNT_QTY_ADD . ' Mengenrabatt leeren:');
define('TEXT_BLANKS_INFO','Alle 0 St&uuml;ckzahlreduktionen werden bei der Aktualisierung entfernt');
define('TEXT_INFO_NO_DISCOUNTS', 'Es wurden keine St&uuml;ckzahlreduktionen definiert');
define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', 'Mengenrabatt-Stufe');
define('TEXT_PRODUCTS_DISCOUNT','Erm&auml;&szlig;igung');
define('TEXT_PRODUCTS_DISCOUNT_QTY','Mindestst&uuml;ckzahl');
define('TEXT_PRODUCTS_DISCOUNT_PRICE','Erm&auml;&szlig;igungswert');
define('TEXT_PRODUCTS_DISCOUNT_TYPE','Typ');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','Kalkulationspreis:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','Erweiterter Preis:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','Kalkuliere<br />Preis: &nbsp; versteuert:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','Erweiterter<br />Preis: &nbsp; versteuert:');
define('TEXT_EACH','je');
define('TEXT_EXTENDED','Summe');
define('TEXT_DISCOUNT_TYPE_INFO', 'Artikelerm&auml;&szlig;igung Info');
define('TEXT_DISCOUNT_TYPE','Erm&auml;&szlig;igungstyp:');
define('TEXT_DISCOUNT_TYPE_FROM', 'Erm&auml;&szlig;igungspreis von:');
define('DISCOUNT_TYPE_DROPDOWN_0','Kein');
define('DISCOUNT_TYPE_DROPDOWN_1','Prozentsatz');
define('DISCOUNT_TYPE_DROPDOWN_2','Aktueller Preis');
define('DISCOUNT_TYPE_DROPDOWN_3','Betrag aus');
define('DISCOUNT_TYPE_FROM_DROPDOWN_0','Preis');
define('DISCOUNT_TYPE_FROM_DROPDOWN_1','Sonderpreis');
define('TEXT_UPDATE_COMMIT','Aktualisiere alle &Auml;nderungen in der aktuellen Ansicht');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>Warnung:</strong> Die ID# %s der Artikelhauptkategorie stimmt nicht mit der aktuellen Kategorie ID# %s &uuml;berein und Artikel sind nicht verlinkt!');
define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' Die aktuelle Kategorie ID# %s stimmt mit der Hauptkategorie ID# %s &uuml;berein');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'Aktualisiere Hauptkategorie-ID# %s, um eine &Uuml;bereinstimmung mit der aktuellen Kategorie ID# %s zu erhalten');
define('PRODUCT_WARNING_UPDATE', 'Bitte machen Sie Ihre &Auml;nderungen und klicken Sie zum Speichern anschlie&szlig;end auf Aktualisieren');
define('PRODUCT_UPDATE_SUCCESS', 'Die Artikel&auml;nderungen wurden erfolgreich aktualisiert!');
define('PRODUCT_WARNING_UPDATE_CANCEL', 'Die &Auml;nderungen wurden nicht gespeichert und verworfen ...');
define('TEXT_INFO_EDIT_CAUTION', '<strong>Klicken Sie hier, um mit der Bearbeitung zu beginnen ...</strong>');
define('TEXT_INFO_PREVIEW_ONLY', 'NUR Vorschau ... aktuelle Preiseinstellungen ... NUR Vorschau');
define('TEXT_INFO_UPDATE_REMINDER', '<strong>Bearbeiten Sie die Artikelinformationen und klicken Sie zum Speichern anschlie&szlig;end auf Aktualisieren</strong>');


?>