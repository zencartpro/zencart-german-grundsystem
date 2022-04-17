<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at2
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: products_price_manager.php 2022-04-17 16:19:04Z webchills $
 */


define('HEADING_TITLE', 'Artikelpreismanager');
define('HEADING_TITLE_PRODUCT_SELECT','Wählen Sie bitte eine Kategorie mit Artikeln aus, um die Preisinformationen anzuzeigen von ...');
define('TABLE_HEADING_PRODUCTS', 'Artikel');

define('TABLE_HEADING_PRODUCTS_PRICE', 'Preis | Sonderpreis | Abverkauf');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Prozentsatz');
define('TABLE_HEADING_AVAILABLE_DATE', 'Verfügbar ab');
define('TABLE_HEADING_EXPIRES_DATE','Ablaufdatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_PRODUCT_INFO', 'Artikelinfo:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Artikelpreis Info:');

define('TEXT_PRICE', 'Preis');
define('TEXT_PRICE_NET', 'Preis (exkl. Steuer)');
define('TEXT_PRICE_GROSS', 'Preis (inkl. Steuer)');
define('TEXT_PRODUCT_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_PRODUCTS_STATUS', 'Artikelstatus:');
define('TEXT_PRODUCT_AVAILABLE', 'Aktiv');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht aktiv');
define('TEXT_PRODUCT_INFO_NONE', 'Bitte wählen Sie einen Artikel ...');
define('TEXT_PRODUCT_IS_FREE','Artikel ist kostenlos:');
define('TEXT_PRODUCTS_IS_FREE_EDIT','<br>*Artikel markiert als KOSTENLOS');
define('TEXT_PRODUCT_IS_CALL','Preis bitte anfragen:');
define('TEXT_PRODUCTS_IS_CALL_EDIT','<br>*Artikel ist als "Preis bitte anfragen" markiert');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','Preis durch Attribute festgelegt:');
define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Ja');
define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','Nein');
define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br>*Der angezeigte Preis enthält den niedrigsten Gruppenattributspreis plus dem Grundpreis');
define('TEXT_PRODUCTS_MIXED','Artikel Mindestabnahme/Anzahl Mix:');
define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', 'Stückzahlermäßigung gilt für gemischte Attribute');
define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','Artikel Mindestabnahme:');
define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','Artikelbestandseinheit:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','Artikel Maximalabnahme:');
define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0= Unlimitiert<br>1= Keine Box für Stückzahlen/Maximalwerte');
define('TEXT_FEATURED_PRODUCT_INFO', 'Empfohlene Artikel Info:');
define('TEXT_FEATURED_PRODUCT', 'Artikel:');
define('TEXT_FEATURED_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_FEATURED_AVAILABLE_DATE', 'verfügbar ab:');
define('TEXT_FEATURED_PRODUCTS_STATUS', 'Status empfohlener Artikel:');
define('TEXT_FEATURED_PRODUCT_AVAILABLE', 'Aktiv');
define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', 'Inaktiv');
define('TEXT_FEATURED_DISABLED', '<strong>HINWEIS: "Empfohlene Artikel" Info ist deaktiviert, abgelaufen oder derzeit nicht aktiv</strong>');
define('TEXT_FEATURED_CONFIRM_DELETE', 'Bitte bestätigen Sie, dass Sie bei diesem Artikel den Status "Empfohlener Artikel" entfernen wollen');
define('TEXT_SPECIALS_PRODUCT', 'Artikel:');
define('TEXT_SPECIALS_SPECIAL_PRICE', 'Sonderpreis:');
define('TEXT_SPECIALS_SPECIAL_PRICE_NET', 'Sonderpreis: (exkl. Steuer)');
define('TEXT_SPECIALS_SPECIAL_PRICE_GROSS', 'Sonderpreis: (inkl. Steuer)');
define('TEXT_SPECIALS_EXPIRES_DATE', 'Ablaufdatum:');
define('TEXT_SPECIALS_AVAILABLE_DATE', 'Verfügbar ab:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>Spezieller Hinweis:</b><ul><li>Sie können eine prozentuale Preisreduktion im Feld für Sonderpreise angeben, zum Beispiel: <b>20%</b></li><li>Wenn Sie einen neuen Preis angeben, muss die Dezimalstelle durch einen \'.\' (Dezimalpunkt) getrennt werden, Beispiel: <b>49.99</b></li><li>Wenn es kein Ablaufdatum geben soll, lassen Sie das Feld für das Ablaufdatum leer</li></ul>');
define('TEXT_SPECIALS_PRODUCT_INFO', 'Sonderpreis Info:');
define('TEXT_SPECIALS_PRODUCTS_STATUS', 'Sonderangebot Status:');
define('TEXT_SPECIALS_PRODUCT_AVAILABLE', 'Aktiv');
define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', 'Inaktiv');
define('TEXT_SPECIALS_NO_GIFTS','Keine Sonderangebote durch Gutscheine');
define('TEXT_SPECIAL_DISABLED', '<strong>HINWEIS: "Sonderangebot" Info ist deaktiviert, abgelaufen oder derzeit nicht aktiv</strong>');
define('TEXT_SPECIALS_CONFIRM_DELETE', 'Bitte bestätigen Sie, dass Sie bei diesem Artikel den Status "Sonderangebot" entfernen wollen');
define('TEXT_INFO_DATE_ADDED', 'Erstellt am:');
define('TEXT_INFO_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_INFO_NEW_PRICE', 'Neuer Preis:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Originalpreis:');
define('TEXT_INFO_STATUS_CHANGE', 'Letzte Statusänderung:');
define('TEXT_INFO_HEADING_DELETE_FEATURED', 'Empfohlene Artikel löschen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Status löschen wollen?');
define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>Definieren Sie die Einstellungen der Attribute und klicken anschließend auf Einfügen, um die Änderungen wirksam zu machen</strong>');

define('TEXT_PRODUCTS_PRICE', 'Artikelpreis: ');
define('TEXT_FREE', 'KOSTENLOS');
define('TEXT_CALL_FOR_PRICE', 'Preis bitte anfragen');
define('TEXT_ADD_ADDITIONAL_DISCOUNT', DISCOUNT_QTY_ADD . ' leere Mengenrabatt hinzufügen:');
define('TEXT_BLANKS_INFO','Alle 0 Stückzahlreduktionen werden bei der Aktualisierung entfernt');
define('TEXT_INFO_NO_DISCOUNTS', 'Es wurden keine Stückzahlreduktionen definiert');
define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', 'Mengenrabatt-Stufe');
define('TEXT_PRODUCTS_DISCOUNT','Ermäßigung');
define('TEXT_PRODUCTS_DISCOUNT_QTY','Mindeststückzahl');
define('TEXT_PRODUCTS_DISCOUNT_PRICE','Ermäßigungswert');

define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','Kalkulationspreis:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','Erweiterter Preis:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','Kalkuliere<br>Preis: &nbsp; versteuert:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','Erweiterter<br>Preis: &nbsp; versteuert:');

define('TEXT_DISCOUNT_TYPE_INFO', 'Artikelermäßigung Info');
define('TEXT_DISCOUNT_TYPE','Ermäßigungstyp:');
define('TEXT_DISCOUNT_TYPE_FROM', 'Ermäßigungspreis von:');
define('DISCOUNT_TYPE_DROPDOWN_0','Kein');
define('DISCOUNT_TYPE_DROPDOWN_1','Prozentsatz');
define('DISCOUNT_TYPE_DROPDOWN_2','Aktueller Preis');
define('DISCOUNT_TYPE_DROPDOWN_3','Betrag aus');
define('DISCOUNT_TYPE_FROM_DROPDOWN_0','Preis');
define('DISCOUNT_TYPE_FROM_DROPDOWN_1','Sonderpreis');
define('TEXT_UPDATE_COMMIT','Aktualisiere alle Änderungen in der aktuellen Ansicht');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>Warnung:</strong> Die ID %s der Artikelhauptkategorie stimmt nicht mit der aktuellen Kategorie ID %s überein und Artikel sind nicht verlinkt!');

define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'Aktualisiere Hauptkategorie-ID %s, um eine Übereinstimmung mit der aktuellen Kategorie ID %s zu erhalten');
define('PRODUCT_WARNING_UPDATE', 'Bitte machen Sie Ihre Änderungen und klicken Sie zum Speichern anschließend auf Aktualisieren');
define('PRODUCT_UPDATE_SUCCESS', 'Die Artikeländerungen wurden erfolgreich aktualisiert!');
define('PRODUCT_WARNING_UPDATE_CANCEL', 'Die Änderungen wurden nicht gespeichert und verworfen ...');
define('TEXT_INFO_EDIT_CAUTION', '<strong>Klicken Sie hier, um mit der Bearbeitung zu beginnen ...</strong>');
define('TEXT_INFO_PREVIEW_ONLY', 'NUR Vorschau ... aktuelle Preiseinstellungen ... NUR Vorschau');
define('TEXT_INFO_UPDATE_REMINDER', '<strong>Bearbeiten Sie die Artikelinformationen und klicken Sie zum Speichern anschließend auf Aktualisieren</strong>');
define('BUTTON_ADDITIONAL_ACTIONS', 'Weitere Aktionen');