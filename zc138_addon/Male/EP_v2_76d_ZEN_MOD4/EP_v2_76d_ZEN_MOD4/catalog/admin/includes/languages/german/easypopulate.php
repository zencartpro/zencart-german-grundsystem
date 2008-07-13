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
// | http://www.zen-cart.at/lizenz/gpl_license.htm.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id:easypopulate.php,v2.76d-Zen-Cart 1.2 12/13/2004 01:20:27 ecdiscounts $
// modified by rpa-com

define('HEADING_TITLE', 'Easy Populate Konfiguration');
define('EASY_VERSION_A', 'Easy Populate Advance');
define('EASY_VERSION_B', 'Easy Populate Basic ');
define('EASY_DEFAULT_LANGUAGE', '  -  Vorgabesprache ');
define('EASY_UPLOAD_FILE', 'Datei übertragen. ');
define('EASY_UPLOAD_TEMP', 'temporärer Dateiname: ');
define('EASY_UPLOAD_USER_FILE', 'Benutzer Dateiname: ');
define('EASY_SIZE', 'Grösse: ');
define('EASY_FILENAME', 'Dateiname: ');
define('EASY_SPLIT_DOWN', 'Sie finden Ihre gesplitteten Dateien im temp-Verzeichnis');
define('EASY_UPLOAD_EP_FILE', 'EP Datei hochladen für den Import');
define('EASY_SPLIT_EP_FILE', 'EP Datei hochladen und aufteilen (splitten)');

define('TEXT_IMPORT_TEMP', 'Datenimport aus Datei in %s Verzeichnis');
define('TEXT_INSERT_INTO_DB', 'In die DB einfügen');
define('TEXT_SELECT_ONE', 'Wählen Sie eine EP Datei für den Import aus');
define('TEXT_SPLIT_FILE', 'Wählen Sie eine EP-Datei aus');
define('EASY_LABEL_CREATE', 'Eine Export-Datei erzeugen');
define('EASY_LABEL_CREATE_SELECT', 'Auswahl zum Sichern der Exportdatei');
define('EASY_LABEL_CREATE_SAVE', 'Sichert in das temp Verzeichnis des Servers');
define('EASY_LABEL_SELECT_DOWN', 'Auswahl zum Download');
define('EASY_LABEL_SORT', 'Auswahl zum Sortieren');
define('EASY_LABEL_PRODUCT_RANGE', 'Limitiert für Produkt_ID(s)');
define('EASY_LABEL_LIMIT_CAT', 'Limitiert für Kategorien');
define('EASY_LABEL_LIMIT_MAN', 'Limitiert für Hersteller');

define('TEXT_SELECT_DOWNLOAD1', 'Direkter Download');
define('TEXT_SELECT_DOWNLOAD2', 'Erstellen, dann Download');
define('TEXT_SELECT_DOWNLOAD3', 'Erstellen in temp-Verzeichnis');

define('EASY_LABEL_LIMIT_NUMBER', 'Auswahl der Produktnummern für den Download');
define('EASY_LABEL_SPLIT_FILE', 'Datei aufteilen');

define('EASY_LABEL_PRODUCT_AVAIL', 'Bereich verfügbar: ');
define('EASY_LABEL_PRODUCT_TO', ' bis ');
define('EASY_LABEL_PRODUCT_RECORDS', '    Gesamte Anzahl der Datensätze: ');
define('EASY_LABEL_PRODUCT_BEGIN', 'Beginn: ');
define('EASY_LABEL_PRODUCT_END', 'Ende: ');
define('EASY_LABEL_PRODUCT_START', 'Erstelle Datei ');

define('EASY_FILE_LOCATE', 'You can get your file in your Store Root Directory under ');
define('EASY_FILE_LOCATE_2', ' by clicking this Link and going to the file manager');
define('EASY_FILE_RETURN', ' You can return to EP by clicking this link.');
define('EASY_IMPORT_TEMP_DIR', 'Import aus Temp Verzeichnis ');
define('EASY_LABEL_DOWNLOAD', 'Download');

define('EASY_LABEL_CUSTOM', 'Angepasst');
define('EASY_LABEL_PQ', 'Preis/Qty');
define('EASY_LABEL_CATEGORIES', 'Kategorien');

define('EASY_EXPORT_INFO', '-Datei (Artikelnummer ist immer enthalten)'); //' file (model number is always included).'
define('EASY_EXPORT_FILTER', 'Filter: ');  //filter by:
define('EASY_EXPORT_CAT', '- Kategorien -');
define('EASY_EXPORT_MAN', '- Hersteller -');
define('EASY_EXPORT_STATUS', '- Status -');
define('EASY_EXPORT_STATUS1', 'Aktiv');
define('EASY_EXPORT_STATUS0', 'Deaktiviert');

define('EASY_LABEL_COMPLETE', 'Komplett');
define('EASY_LABEL_TAB', 'tab-getrennte .txt Datei zum Bearbeiten');
define('EASY_LABEL_MPQ', 'Modell/Preis/Qty');
define('EASY_LABEL_EP_MC', 'Modell/Kategorie');
define('EASY_LABEL_EP_FROGGLE', 'Froogle');
define('EASY_LABEL_EP_ATTRIB', 'Attribute');
define('EASY_LABEL_NONE', 'Kein');
define('EASY_LABEL_CATEGORY', '1. Kategorie Name');
define('PULL_DOWN_MANUFACTURES', 'Hersteller');
define('EASY_LABEL_PRODUCT', 'Produkt ID Nummer');
define('EASY_LABEL_MANUFACTURE', 'Hersteller ID Nummer');
define('EASY_LABEL_EP_FROGGLE_HEADER', 'Download a EP or Froogle file');
define('EASY_LABEL_EP_MA', 'Modell/Attribut');
//define('EASY_LABEL_EP_FR_TITLE', 'Create EP or Froogle Files in Temp Dir ');
//define('EASY_LABEL_EP_DOWN_TAB', 'Create <b>Complete</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MPQ', 'Create <b>Model/Price/Qty</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MC', 'Create <b>Model/Category</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_MA', 'Create <b>Model/Attributes</b> tab-delimited .txt file in temp dir');
//define('EASY_LABEL_EP_DOWN_FROOGLE', 'Create <b>Froogle</b> tab-delimited .txt file in temp dir');

define('EASY_LABEL_NEW_PRODUCT', '!Neues Produkt!');
define('EASY_LABEL_UPDATED', "!Aktualisiert!");
define('EASY_LABEL_DELETE_STATUS_1', "<font color='red'> !! Gelöschtes Produkt ");
define('EASY_LABEL_DELETE_STATUS_2', " aus der Datenbank !!</font><br>");
define('EASY_LABEL_LINE_COUNT_1', ' ... ');
define('EASY_LABEL_LINE_COUNT_2', ' Datensätze hinzugefügt und Datei abgeschlossen... ');
define('EASY_LABEL_FILE_COUNT_1A', 'Erstellt Datei ');
//define('EASY_LABEL_FILE_COUNT_1B', 'Creating file EPB_Split ');
define('EASY_LABEL_FILE_COUNT_2', '.txt ...  ');
define('EASY_LABEL_FILE_CLOSE_1', ' ... ');
define('EASY_LABEL_FILE_CLOSE_2', ' Datensätze hinzugefügt und Datei abgeschlossen...');

//errormessages
define('EASY_ERROR_1', 'Strange but there is no default language to work... That may not happen, just in case... ');
define('EASY_ERROR_2', '... ERROR! - Too many characters in the model number.<br>
			12 is the maximum on a standard OSC install.<br>
			Your maximum product_model length is set to $modelsize<br>
			You can either shorten your model numbers or increase the size of the field in the database.');
define('EASY_ERROR_2A', ' <br>You can either shorten your model numbers or increase the size of the field in the database.</font>');
define('EASY_ERROR_2B',  "<font color='red'>");
define('EASY_ERROR_3', 'Keine Artikelnummer im Datensatz. Diese Zeile wurde nicht importiert');
define('EASY_ERROR_4', 'ERROR - v_customer_group_id and v_customer_price must occur in pairs');
define('EASY_ERROR_5', '</b><font color=red>ERROR - You are trying to use a file created with EP Advance, please try with Easy Populate Advance </font>');
define('EASY_ERROR_5a', '<font color=red><b><u>  Click here to return to Easy Populate Basic </u></b></font>');
define('EASY_ERROR_6', '</b><font color=red>ERROR - You are trying to use a file created with EP Basic, please try with Easy Populate basic </font>');
define('EASY_ERROR_6a', '<font color=red><b><u>  Click here to return to Easy Populate Advance </u></b></font>');


//Text
define('EASYPOPULATE_TEXT_UPLOAD', 'EP Datei hochladen');
define('EASYPOPULATE_TEXT_SPLIT', 'EP Datei hochladen und aufteilen (splitten)');
define('EASYPOPULATE_TEXT_IMPORT', 'Import von EP Datei aus Temp Verzeichnis');
define('EASYPOPULATE_TEXT_DOWNLOAD', 'Download von EP und Froogle Dateien');
define('EASYPOPULATE_TEXT_CREATE', 'Erstelle EP und Froogle Dateien in Temp Verzeichnis');
define('EASYPOPULATE_TEXT_SELECT_ONE', 'Wählen Sie eine EP Datei für den Import aus');

//Buttons
define('EASYPOPULATE_BUT_INSERT', 'in Datenbank einfügen');
define('EASYPOPULATE_BUT_SPLIT', 'Datei aufteilen');

//Attributes
define('EASYPOPULATE_ATTR_WITH', '(mit Attributen)');
define('EASYPOPULATE_ATTR_NOT', '(ohne Attribute)');

//Links
define('EASYPOPULATE_LINK_DOWNLOAD', 'Download ');
define('EASYPOPULATE_LINK_CREATE', 'Erstelle ');
define('EASYPOPULATE_LINK_EDIT', '-Datei zum Bearbeiten');
define('EASYPOPULATE_LINK_TEMP', ' in temp Verzeichnis');

define('EASYPOPULATE_LINK_FULL', '<b>Komplette </b>');
define('EASYPOPULATE_LINK_PRICEQTY', '<b>Model/Preis/Qty</b>');
define('EASYPOPULATE_LINK_CATEGORY', '<b>Model/Kategorie</b>');
define('EASYPOPULATE_LINK_FROGGLE', '<b>Froogle</b>');
define('EASYPOPULATE_LINK_ATTRIB', '<b>Model/Attribute</b>');

define('EASYPOPULATE_QUICK_LINKS', 'Quick Links');
define('EASYPOPULATE_CREATE_DOWNLOAD', 'Datei erstellen und downloaden');
define('EASYPOPULATE_DOWNLOAD_INFO', 'Erstellt die Datei im Serverspeicher, nach Fertigstellung erfolgt Download.');

define('EASYPOPULATE_CREATE_FILES', 'Erstellt Datei in Temp-Verzeichnis');
define('EASYPOPULATE_FILES_INFO', 'Erstellt die Datei im Serverspeicher, nach Fertigstellung Speicherung im Temp-Verzeichnis.');

define('EASYPOPULATE_FILE_SPLITS_PREFIX', 'Split-');

define('EASYPOPULATE_DATACOUNT', ' Datensätze importiert!');

//Export
define('EASYPOPULATE_EXPORT_NAME', 'Produktname');
define('EASYPOPULATE_EXPORT_DESCRIPTION', 'Beschreibung');
define('EASYPOPULATE_EXPORT_URL', 'URL');
define('EASYPOPULATE_EXPORT_IMAGE', 'Bild');
define('EASYPOPULATE_EXPORT_CATEGORIES', 'Kategorien');
define('EASYPOPULATE_EXPORT_MANUFACTURER', 'Hersteller');
define('EASYPOPULATE_EXPORT_SORT_ORDER', 'Sortierung');
define('EASYPOPULATE_EXPORT_PRICE', 'Preis');
define('EASYPOPULATE_EXPORT_QUANTITY', 'Anzahl');
define('EASYPOPULATE_EXPORT_WEIGHT', 'Gewicht');
define('EASYPOPULATE_EXPORT_TAX_CLASS', 'Steuerklasse');
define('EASYPOPULATE_EXPORT_AVAILABLE', 'Verfügbar');
define('EASYPOPULATE_EXPORT_DATE_ADDED', 'Einstelldatum');
define('EASYPOPULATE_EXPORT_STATUS', 'Status');
define('EASYPOPULATE_EXPORT_ATTRIBUTES', 'Attribute');
define('EASYPOPULATE_EXPORT_ATTRIBUTES_WEIGHT', 'Attributgewicht');
define('EASYPOPULATE_EXPORT_ATTRIBUTES_SORT_ORDER', 'Attribut Sortierung');

//SETTINGS
define('EASYPOPULATE_SETTINGS', 'Einstellungen');
define('EASYPOPULATE_SET_TEMP_DIR', 'Temp Verzeichnis:');
define('EASYPOPULATE_SET_SPLIT_FILE', 'Teile Import Datei ab: ');
define('EASYPOPULATE_SET_RECORDS', ' Datensätze');
define('EASYPOPULATE_SET_MODEL_NUM_SIZE', 'Länge Artikelnummer: ');
define('EASYPOPULATE_SET_PRICE_TAX', 'Preis inkl. MwSt: ');
define('EASYPOPULATE_SET_REPLACE_QUOTES', 'Anführungsstriche ersetzen: ');
define('EASYPOPULATE_SET_FIELD_SEPERATOR', 'Trennzeichen: ');
define('EASYPOPULATE_SET_EXCEL_SAFE', 'Excelsichere Ausgabe: ');
define('EASYPOPULATE_SET_PRESERVE', 'Erhalte tab/cr/lf: ');
define('EASYPOPULATE_SET_CAT_DEPTH', 'Kategorietiefe: ');
define('EASYPOPULATE_SET_ATTRIBUTES', 'Mit Attributen: ');
define('EASYPOPULATE_SET_FROGGLE', 'SEF Froogle URLS: ');
define('EASYPOPULATE_SET_INFO', 'Für Hilfe bei diesen Einstellungen bitte die Anleitung in diesem Erweiterungspaket lesen.');

?>