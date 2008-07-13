<?php
/*
//////////////////////////////////////////////////////////
//  SALES REPORT                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2006 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION: The language file contains all the     //
//  text that appears on the report.  The first set of  //
//  configuration defines actually impact the report's  //
//  output and behavior.                                //
//////////////////////////////////////////////////////////
// $Id: stats_sales_report.php 103 2006-10-13 21:06:48Z BlindSide $
*/

/*
** Konfiguration
*/
//////////////////////////////////////////////////////////
// Grundeinstellungen Bericht
// Diese Einstellungen werden im Bericht genutzt wenn
// der Report frisch ausgeführt wird oder
// der Reporteinstellungen zurücksetzen Button gedrückt wird
//
// Falls Sie keine Voreinstellungen wünschen, lassen Sie bitte
// die entsprechenden Felder frei
//
// Gültige Einträge finden Sie hinter jeder Zeile,
// die Einträge in den eckigen Klammer sind die Standardwerte
// WICHTIG: Bitte benutzen Sie nur die angegebenen Einträge, andere werden zu Fehlfunktionen führen!
// Gleich gilt für das Datumsformat, es muss in einem englischen Format erfolgen!
//
define('DEFAULT_DATE_SEARCH_TYPE', 'preset'); // ['preset'], 'custom' (cannot be empty if next 3 options are set!)
define('DEFAULT_DATE_PRESET', 'this_month'); // ['yesterday'], 'this_month', 'last_month', 'custom'
define('DEFAULT_START_DATE', ''); // (date in mm-dd-yyyy format)
define('DEFAULT_END_DATE', ''); // (date in mm-dd-yyyy format)

define('DEFAULT_DATE_TARGET', 'purchased'); // ['purchased'], 'status'
define('DEFAULT_DATE_STATUS', '10'); // (status number) [lowest status number]
define('DEFAULT_PAYMENT_METHOD', ''); // [any entry in `orders.payment_module_code` field]
define('DEFAULT_CURRENT_STATUS', ''); // [status number]
define('DEFAULT_MANUFACTURER', ''); // manufacturers_id from Admin > Catalog > Manufacturers ("mID=##" in the URL)

define('DEFAULT_TIMEFRAME', 'day'); // ['day'], 'week', 'month', 'year'
define('DEFAULT_TIMEFRAME_SORT', 'asc'); // ['asc'], 'desc'
define('DEFAULT_DETAIL_LEVEL', 'product'); // ['timeframe'], 'product', 'order', 'matrix'

// order line items: 'oID', 'last_name', 'num_products', 'goods', 'shipping', 'discount', 'gc_sold', 'gc_used', 'grand'
// product line items: 'pID', 'name', 'manufacturer', 'model', 'base_price', 'quantity', 'onetime_charges', 'grand'
define('DEFAULT_LI_SORT_A', 'model');
define('DEFAULT_LI_SORT_ORDER_A', ''); // 'asc', 'desc'
define('DEFAULT_LI_SORT_B', 'name');
define('DEFAULT_LI_SORT_ORDER_B', ''); // 'asc', 'desc'

define('DEFAULT_OUTPUT_FORMAT', 'display'); // ['display'], 'print', 'csv'
define('DEFAULT_AUTO_PRINT', 'false'); // 'true', ['false']
define('DEFAULT_CSV_HEADER', 'true'); // 'true', ['false']


//////////////////////////////////////////////////////////
// Zeige leere Zeiträume an
// Wenn Sie diese Einstellunge auf true setzen,
// dann werden keine leeren Zeiträume mehr angezeigt
//
// Standardeinstellung ist false
//
// Bedenken Sie, sollte der von Ihnen angegebene Zeitraum
// keinerlei Daten enthalten, dann erscheint es, als ob keine
// Suche durchgeführt worden sei
//
define('DISPLAY_EMPTY_TIMEFRAMES', false);


//////////////////////////////////////////////////////////
// Hersteller im Bericht anzeigen
// 
// Beim Setzen dieser Einstellung auf true erfolgt bei jedem Artikel
// im Report die Angabe des Herstellers.
//
// Standard ist false
//
define('DISPLAY_MANUFACTURER', false);


//////////////////////////////////////////////////////////
// Anzeige der einmaligen Gebühren
// 
// Wenn Sie in Ihrem Shop einmalige Gebühren verwenden
// und eine Anzeige dieser wünschen, dann setzen Sie diese
// Einstellung auf true
//
// Standard ist false

//
define('DISPLAY_ONE_TIME_FEES', false);


//////////////////////////////////////////////////////////
// Nachkommastellen bei den Durchschnittswerten
//
// Stellen Sie hier die gewünschen Nachkommastellen ein
//
define('NUM_DECIMAL_PLACES', 2);


//////////////////////////////////////////////////////////
// Einstellung Anzeigeformat Zeitraum
//
// Diese Einstellung kontrolliert das Format der Datumsangaben
// im Bericht.
//
// Alle Formatierungsmöglichkeiten sind unter
// http://us2.php.net/date zu finden
//
define('TIME_DISPLAY_DAY', 'd.m.Y'); // Format für tägliche Auswertung
define('TIME_DISPLAY_WEEK', 'd.m.Y'); // Format für wöchentliche Auswertung
define('TIME_DISPLAY_MONTH', 'd.m.Y'); // Format für monatliche Auswertung
define('TIME_DISPLAY_YEAR', 'd.m.Y'); // Format für jährliche Auswertung
define('DATE_SPACER', ' -<br/>');


//////////////////////////////////////////////////////////
// Ausschließen bestimmter Produkte
//
// Alle angegebenen Produkte erscheinen nicht im Bericht.
// Diese Einstellung beeinflußt die Summenwerte
//
// Der Wert des Produkts wird aus den Summen
// gc_sold, gc_sold_qty, goods, num_products, und diff_products ausgeschlossen
//
// Die Werte für gc_used, gc_used_qty, discount,
// discount_qty, tax, and shipping kommen direkt aus der orders_total Tabelle
// und können nicht aufgrund der Produkt ID ausgeschlossen werden
//
// Wenn ein Auftrag nur aus ausgeschlossenen Produkten besteht
// keine Versandkosten, Rabatte, Steuern oder Gutscheine hat,
// dann erscheint dieser nicht im Verkaufsbericht.
//
// Beispiel: define('EXCLUDE_PRODUCTS', serialize(array(25, 14, 43)) );
//
define('EXCLUDE_PRODUCTS', serialize(array( )));



/*
** LANGUAGE DEFINES
*/
// Search menu heading
define('PAGE_HEADING', 'Verkaufsbericht');
define('HEADING_TITLE_SEARCH', '1. Welche Daten sollen erfasst werden?');
define('HEADING_TITLE_SORT', '2. Sortieren &amp; Filtern der Suchergebnisse');
define('HEADING_TITLE_PROCESS', '3. Bericht erstellen');
define('SEARCH_TIMEFRAME', 'Zeitraum');
define('SEARCH_TIMEFRAME_DAY', 'Täglich');
define('SEARCH_TIMEFRAME_WEEK', 'Wöchentlich');
define('SEARCH_TIMEFRAME_MONTH', 'Monatlich');
define('SEARCH_TIMEFRAME_YEAR', 'Jährlich');
define('SEARCH_TIMEFRAME_SORT', 'Zeitraum Sortierung');
define('SEARCH_DATE_PRESET', 'Voreinstellungen Zeitraum');
define('SEARCH_DATE_CUSTOM', 'Benutzerdefinierter Zeitraum');
define('SEARCH_DATE_YESTERDAY', 'Gestern (%s)');
define('SEARCH_DATE_LAST_MONTH', 'Letzter Monat (%s)');
define('SEARCH_DATE_THIS_MONTH', 'Aktueller Monat (%s)');
define('SEARCH_START_DATE', 'Startdatum');
define('SEARCH_END_DATE', 'Enddatum');
define('SEARCH_DATE_FORMAT', 'dd.mm.yyyy');
define('SEARCH_DATE_TARGET', 'Berücksichtige dabei...');
define('SEARCH_PAYMENT_METHOD', 'Zahlungsmethode');
define('SEARCH_CURRENT_STATUS', 'Aktueller Bestellstatus');
define('SEARCH_MANUFACTURER', 'Artikelhersteller');
define('SEARCH_DETAIL_LEVEL', 'Angezeigte Informationen');
define('SEARCH_OUTPUT_FORMAT', 'Ausgabe Format');
define('SEARCH_SORT_PRODUCT', 'Sortiere Produkte nach...');
define('SEARCH_SORT_ORDER', 'Sortiere Bestellungen nach...');
define('SEARCH_SORT_THEN', 'Dann sortiere nach...');
define('BUTTON_SEARCH', 'Bericht erstellen');
define('BUTTON_LOAD_DEFAULTS', 'Reporteinstellungen zur&uuml;cksetzen');
define('BUTTON_DEFAULT_SEARCH', 'Schnellsuche');
define('SEARCH_WAIT_TEXT', 'Generiere Report, bitte warten...');


// Form element text
// radio buttons
define('RADIO_DATE_TARGET_PURCHASED', 'Bestelldatum');
define('RADIO_DATE_TARGET_STATUS', 'Bestellstatus (bitte ausw&auml;hlen)');
define('RADIO_TIMEFRAME_SORT_ASC', 'Aufsteigend');
define('RADIO_TIMEFRAME_SORT_DESC', 'Absteigend');
define('RADIO_LI_SORT_ASC', 'Aufsteigend');
define('RADIO_LI_SORT_DESC', 'Absteigend');

// dropdown menus
define('SELECT_DETAIL_TIMEFRAME', 'Zeitraum Gesamtsummen');
define('SELECT_DETAIL_PRODUCT', '&nbsp;+ Auflistung der Produkte');
define('SELECT_DETAIL_ORDER', '&nbsp;+ Auflistung der Bestellungen');
define('SELECT_DETAIL_MATRIX', 'Zeitraum Statistik Matrix');
define('SELECT_OUTPUT_DISPLAY', 'Bildschirmausgabe');
define('SELECT_OUTPUT_PRINT', 'Druckausgabe');
define('SELECT_OUTPUT_CSV', 'CSV Export');
define('SELECT_PRODUCT_ID', 'Artikelnummer');
define('SELECT_QUANTITY', 'Menge');
define('SELECT_LAST_NAME', 'Nachname des Kunden');

// checkboxes
define('CHECKBOX_AUTO_PRINT', 'Bericht automatisch ausdrucken');
define('CHECKBOX_CSV_HEADER', 'Spalten&uuml;berschriften in die erste Zeile');
define('CHECKBOX_NEW_WINDOW', '&Ouml;ffne den Bericht in einem neuen Fenster');


// Report Column Headings
// Timeframe
define('TABLE_HEADING_TIMEFRAME', 'Zeitraum');
define('TABLE_HEADING_NUM_ORDERS', 'Anz. Bestellungen');
define('TABLE_HEADING_NUM_PRODUCTS', 'Anz. Produkte');
define('TABLE_HEADING_TOTAL_GOODS', 'Auftragswert');
define('TABLE_HEADING_TAX', 'Steuern');
define('TABLE_HEADING_SHIPPING', 'Versandkosten');
define('TABLE_HEADING_DISCOUNTS', 'Rabatte');
define('TABLE_HEADING_GC_SOLD', 'Gutscheine verkauft');
define('TABLE_HEADING_GC_USED', 'Gutscheine eingelöst');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_FOOTER_TIMEFRAMES', ' Zeiträume');

// Order Line Items
define('TABLE_HEADING_ORDERS_ID', 'Order ID');
define('TABLE_HEADING_CUSTOMER', 'Kunde');
define('TABLE_HEADING_ORDER_TOTAL', 'Bestellwert');

// Product Line Items
define('TABLE_HEADING_PRODUCT_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT_NAME', 'Artikelname');
define('TABLE_HEADING_MANUFACTURER', 'Hersteller');
define('TABLE_HEADING_MODEL', 'Artikelnummer');
define('TABLE_HEADING_BASE_PRICE', 'Einzelpreis');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_ONETIME_CHARGES', 'einmalige Gebühren');
define('TABLE_HEADING_PRODUCT_TOTAL', 'Produkt Summe');

// Data Matrix
define('MATRIX_GENERAL_STATS', 'Generelle Statistiken');
define('MATRIX_ORDER_REVENUE', 'Gesamtsumme');
define('MATRIX_ORDER_PRODUCT_COUNT', 'Gesamtsumme verkaufte Produkte');
define('MATRIX_LARGEST', 'Größter Auftrag: ');
define('MATRIX_SMALLEST', 'Kleinster Auftrag: ');
define('MATRIX_AVERAGES', 'Durchschnittswerte');
define('MATRIX_AVG_ORDER', '&nbsp;Auftragswert');
define('MATRIX_AVG_PROD_ORDER', '&nbsp;Produkte pro Auftrag');
define('MATRIX_AVG_PROD_ORDER_DIFF', '&nbsp;verschiedene Produkte pro Auftrag');
define('MATRIX_AVG_ORDER_CUST', '&nbsp;Aufträge pro Kunde');
define('MATRIX_ORDER_STATS', 'Auftragsstatistiken');
define('MATRIX_TOTAL_PAYMENTS', 'Zahlungsmethoden');
define('MATRIX_TOTAL_CC', 'Kreditkarten');
define('MATRIX_TOTAL_SHIPPING', 'Versandarten');
define('MATRIX_TOTAL_CURRENCIES', 'Währungen');
define('MATRIX_TOTAL_CUSTOMERS', 'Einmalige Benutzer');
define('MATRIX_PRODUCT_STATS', 'Produktstatistiken');
define('MATRIX_PRODUCT_SPREAD', 'Produkt Verteilung');
define('MATRIX_PRODUCT_REVENUE_RATIO', 'Anteil am Gesamtumsatz in %');
define('MATRIX_PRODUCT_QUANTITY_RATIO', 'Anteil an der Gesamtmenge in %');


// CSV Export
define('CSV_FILENAME_PREFIX', 'sales_');
define('CSV_HEADING_START_DATE', 'Startdatum');
define('CSV_HEADING_END_DATE', 'Enddatum');
define('CSV_HEADING_LAST_NAME', 'Nachnahme');
define('CSV_HEADING_FIRST_NAME', 'Vorname');
define('CSV_SEPARATOR', ',');
define('CSV_NEWLINE', "\n");


// Print Format
define('PRINT_DATE_TO', ' bis zum ');
define('PRINT_DATE_TARGET', 'Aufträge erfasst nach ');
define('PRINT_TIMEFRAMES', '%s %s sortiert (asc = aufsteigend, desc = absteigend)');
define('PRINT_DATE_PURCHASED', 'Bestelldatum');
define('PRINT_DATE_STATUS', 'Bestellstatus');
define('PRINT_ORDER_STATUS', '%s [%s]');
define('PRINT_PAYMENT_METHOD', 'Zahlungsmethoden:');
define('PRINT_CURRENT_STATUS', 'Aktueller Bestellstatus:');
define('PRINT_DETAIL_LEVEL', 'Anzeige: ');

// javascript pop-up alert window
define('ALERT_JS_HIGHLIGHT', '#0000FF');
define('ALERT_MSG_START', "Es gibt einen oder mehr Fehler mit Ihren Suchparametern:");
define('ALERT_DATE_INVALID', "> Ein eingebenes Datum ist nicht gültig");
define('ALERT_DATE_MISSING', "> Sie müssen entweder eine der Voreinstellungen wählen oder einen Zeitraum angeben (Startdatum & Enddatum)");
define('ALERT_CSV_CONFLICT', "> Die CSV Ausgabe ist nicht verfügbar für die " . SELECT_DETAIL_MATRIX . " Anzeige");
define('ALERT_MSG_FINISH', "Bitte beheben Sie den Fehler und generieren Sie den Bericht neu.");

// Other text defines
define('ERROR_MISSING_REQ_INFO', 'Error: Benötigte Felder sind leer');
define('ALT_TEXT_SORT_ASC', 'Re-sort in ASCENDING order');
define('ALT_TEXT_SORT_DESC', 'Re-sort in DESCENDING order');
define('TEXT_REPORT_TIMESTAMP', 'Report Time: ');
define('TEXT_PARSE_TIME', 'Parse Time: %s sec.');
define('TEXT_EMPTY_SELECT', '(keine Einschränkung)');
define('TEXT_QTY', '| Menge: ');
define('TEXT_DIFF', '| Diff: ');
define('TEXT_SAME', '| (same)');
define('TEXT_SAME_ONE', '| --');
define('TEXT_PRINT_FORMAT', 'Zeige den Report im druckerfreundlichen Format an');
define('TEXT_PRINT_FORMAT_TITLE', 'TIPP: Klicken Sie auf \'' . PAGE_HEADING . '\' um zur Anzeige zurückzukehren');
define('TEXT_NO_DATA', '-- Keine Aufträge im angegebenen Zeitraum --');
?>