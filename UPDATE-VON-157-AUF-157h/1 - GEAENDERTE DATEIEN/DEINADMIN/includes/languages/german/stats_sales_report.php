<?php

/**
 * SALES REPORT 4.0.0
 *
 * The language file contains all the text that appears on the report. The first set of
 * configuration defines actually impact the report's output and behavior.
 *
 * @author     Frank Koehl (PM: BlindSide)
 * @author     Conor Kerr <conor.kerr_zen-cart@dev.ceon.net>
 * @updated by stellarweb to work with version 1.5.0 02-29-12 
 * @updated by lat9 for continued operation under zc155/zc156, 20190622
 * @copyright  Portions Copyright 2003-2023 Zen Cart Development Team
 * @copyright  Portions Copyright 2003 osCommerce
 * @license    http://www.gnu.org/copyleft/gpl.html   GNU Public License V2.0
 * @translation by webchills 2023-05-02
 */

//////////////////////////////////////////////////////////
// DISPLAY EMPTY TIMEFRAME LINES
// Setting this define to false will disable displaying
// a timeframe line if that timeframe is empty.  By
// default, an empty timeframe displays the value of the
// define TEXT_NO_DATA.

//////////////////////////////////////////////////////////
// Zeige leere Zeiträume an
// Wenn Sie diese Einstellunge auf false setzen,
// dann werden keine leeren Zeiträume mehr angezeigt
//
// Standardeinstellung ist true
//
// Bedenken Sie, sollte der von Ihnen angegebene Zeitraum
// keinerlei Daten enthalten, dann erscheint es, als ob keine
// Suche durchgeführt worden sei
//
define('DISPLAY_EMPTY_TIMEFRAMES', true);

//////////////////////////////////////////////////////////
// REPORTING A SUBSET OF CUSTOMERS / PRODUCTS
// By checking the boxes to 'Only Include Specific customers
// or Products (SEARCH_SPECIFIC_CUSTOMERS/PRODUCTS),
// only orders for those customers / products will be
// included in the result. By default, the included customers/
// products will be printed above the results table. If this
// gets too long, this printout can be disabled with
// the DISPLAY booleans below.
//
// If you often want a specific product, you can set a 
// default here, e.g.:
// define('INCLUDE_PRODUCTS', '10, 15');
//
define('INCLUDE_PRODUCTS', '');
define('INCLUDE_CUSTOMERS', '');
define('DISPLAY_TABLE_HEADING_CUSTOMERS', true);
define('DISPLAY_TABLE_HEADING_PRODUCTS', true);
define('TEXT_CUSTOMER_TABLE_HEADING', ' Orders for: ');  //Prefix used to print before customer name(s) when filtering by customer


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
// ONE-TIME FEES COLUMN
// If your store does not have *any* one-time fees on its
// products, you can disable displaying the column.
//
// Note that this switch does not affect math calculations,
// so if you happen to have a product with fees attached,
// they will still be accounted for and appear in the total.
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
// Note:  Other constants moved to the main processing file for v3.2.1.
//
define('DATE_SPACER', ' bis<br>&nbsp;&nbsp;&nbsp;');


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
// Beispiel: define('EXCLUDE_PRODUCTS', serialize([25, 14, 43]));
//
define('EXCLUDE_PRODUCTS', serialize([]));



/*
** LANGUAGE DEFINES
*/
// Search menu heading
define('PAGE_HEADING', 'Verkaufsbericht');
define('HEADING_TITLE_SEARCH', '1. Daten erfassen');
define('HEADING_TITLE_SORT', '2. Ergebnisse sortieren und filtern');
define('HEADING_TITLE_PROCESS', '3. Bericht erstellen');
define('SEARCH_TIMEFRAME', 'Zeitraum');
define('SEARCH_TIMEFRAME_DAY', 'Täglich');
define('SEARCH_TIMEFRAME_WEEK', 'Wöchentlich');
define('SEARCH_TIMEFRAME_MONTH', 'Monatlich');
define('SEARCH_TIMEFRAME_YEAR', 'Jährlich');
define('SEARCH_TIMEFRAME_SORT', 'Zeitraum Sortierung');
define('SEARCH_DATE_PRESET', 'Vordefinierte Zeiträume');
define('SEARCH_DATE_CUSTOM', 'Benutzerdefinierter Zeitraum');
define('SEARCH_DATE_TODAY', 'Heute (%s)');
define('SEARCH_DATE_YESTERDAY', 'Gestern (%s)');
define('SEARCH_DATE_LAST_MONTH', 'Letzter Monat (%s)');
define('SEARCH_DATE_THIS_MONTH', 'Aktueller Monat (%s)');
define('SEARCH_DATE_LAST_YEAR', 'Letztes Jahr (%s)');
define('SEARCH_DATE_LAST_12_MONTHS', 'Letzte 12 Monate');
define('SEARCH_DATE_YTD', 'Aktuelles Jahr (%s)');
define('SEARCH_START_DATE', 'Startdatum');
define('SEARCH_END_DATE', 'Enddatum (inklusive)');
define('SEARCH_DATE_FORMAT', 'mm/dd/yyyy');
define('SEARCH_DATE_TARGET', 'Berücksichtige dabei...');
define('SEARCH_PAYMENT_METHOD', 'Zahlungsart');
define ('SEARCH_PAYMENT_METHOD_OMIT','Folgende Zahlungsart weglassen');
define('SEARCH_CURRENT_STATUS', 'Derzeitiger Bestellstatus');
define('SEARCH_EXCLUDED_STATUS', 'Ausgeschlossener Bestellstatus');
define('SEARCH_SPECIFIC_CUSTOMERS', 'Nur bestimmte Kundennummern aufnehmen (IDs mit Komma getrennt)');
define('SEARCH_SPECIFIC_PRODUCTS', 'Nur bestimmte Artikel IDs aufnehmen (IDs mit Komma getrennt)');
define('SEARCH_MANUFACTURER', 'Hersteller');
define('SEARCH_DETAIL_LEVEL', 'Angezeigte Informationen');
define('SEARCH_OUTPUT_FORMAT', 'Ausgabe Format');
define('SEARCH_SORT_PRODUCT', 'Sortiere Artikel nach...');
define('SEARCH_SORT_ORDER', 'Sortiere Bestellungen nach...');
define('SEARCH_SORT_THEN', 'Anschließend sortieren nach...');
define('BUTTON_SEARCH', 'Bericht anzeigen!');
define('BUTTON_DEFAULT_SEARCH', 'Schnellsuche');
define('SEARCH_WAIT_TEXT', 'Bericht wird erstellt....Bitte warten...');


// Form element text
// radio buttons
define('RADIO_DATE_TARGET_PURCHASED', 'Bestelldatum');
define('RADIO_DATE_TARGET_STATUS', 'Bestellstatus (bitte auswählen)');
define('RADIO_TIMEFRAME_SORT_ASC', 'Älteste oben');
define('RADIO_TIMEFRAME_SORT_DESC', 'Neueste oben');
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
define('CHECKBOX_CSV_HEADER', 'Spaltenüberschriften in die erste Zeile');
define('CHECKBOX_NEW_WINDOW', 'Öffne den Bericht in einem neuen Fenster');
define('CHECKBOX_VALIDATE_TOTALS', ' Spalte für die Prüfung der Gesamtsummen ausgeben');
define('CHECKBOX_DISPLAY_EMAIL_ADDRESS', ' Emailadresse des Kunden zeigen?');

// Report Column Headings
// Timeframe
define('TABLE_HEADING_TIMEFRAME', 'Zeitraum');
define('TABLE_HEADING_NUM_ORDERS', 'Anzahl Bestellungen');
define('TABLE_HEADING_NUM_PRODUCTS', 'Anzahl Produkte');
define('TABLE_HEADING_TOTAL_GOODS', 'Auftragswert');
define('TABLE_HEADING_TAX', 'Steuern');
define('TABLE_HEADING_GOODS_TAX', 'Steuer');
define('TABLE_HEADING_ORDER_RECORDED_TAX', 'Steuern der Bestellung');
define('TABLE_HEADING_SHIPPING', 'Versandkosten');
define('TABLE_HEADING_DISCOUNTS', 'Rabatte');
define('TABLE_HEADING_GC_SOLD', 'Gutscheine verkauft');
define('TABLE_HEADING_GC_USED', 'Gutscheine eingelöst');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_FOOTER_TIMEFRAMES', ' Zeiträume');

// Order Line Items
define('TABLE_HEADING_ORDERS_ID', 'Bestellnummer');
define('TABLE_HEADING_CUSTOMER', 'Kunde');
define('TABLE_HEADING_EMAIL_ADDRESS', 'Emailaddresse');
define('TABLE_HEADING_COUNTRY', 'Land');
define('TABLE_HEADING_STATE', 'Bundesland');
define('TABLE_HEADING_ORDER_TOTAL', 'Bestellwert');
define('TABLE_HEADING_ORDER_TOTAL_VALIDATION', 'Gesamtsumme gültig');

// Product Line Items
define('TABLE_HEADING_PRODUCT_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT_NAME', 'Artikelname');
define('TABLE_HEADING_PRODUCT_ATTRIBUTES', 'Attribute');
define('TABLE_HEADING_MANUFACTURER', 'Hersteller');
define('TABLE_HEADING_MODEL_NO', 'Artikelnummer');
define('TABLE_HEADING_BASE_PRICE', 'Einzelpreis');
define('TABLE_HEADING_FINAL_PRICE', 'Endpreis');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_ONETIME_CHARGES', 'einmalige Gebühren');
define('TABLE_HEADING_PRODUCT_TOTAL', 'Artikel Summe');

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
define('MATRIX_TOTAL_PAYMENTS', 'Zahlungsarten');
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
define('CSV_HEADING_LAST_NAME', 'Nachname');
define('CSV_HEADING_FIRST_NAME', 'Vorname');
define('CSV_HEADING_COUNTRY', 'Land');
define('CSV_HEADING_STATE', 'Bundesland');
define('CSV_SEPARATOR', ',');
define('CSV_NEWLINE', "\n");


// Print Format
define('PRINT_DATE_TO', ' bis zum ');
define('PRINT_DATE_TARGET', 'Aufträge erfasst nach ');
define('PRINT_TIMEFRAMES', '%s %s sortiert (asc = aufsteigend, desc = absteigend)');
define('PRINT_DATE_PURCHASED', 'Bestelldatum');
define('PRINT_DATE_STATUS', 'Bestellstatus');
define('PRINT_ORDER_STATUS', '%s [%s]');
define('PRINT_PAYMENT_METHOD', 'Zahlungsarten:');
define('PRINT_CURRENT_STATUS', 'Aktueller Bestellstatus:');
define('PRINT_DETAIL_LEVEL', 'Anzeige: ');

// javascript pop-up alert window
define('ALERT_JS_HIGHLIGHT', '#FF40CF');
define('ALERT_MSG_START', "Es gibt einen oder mehr Fehler mit Ihren Suchparametern:");
define('ALERT_DATE_INVALID_LENGTH', "> Ein eingebenes Datum ist nicht gültig");
define('ALERT_DATE_INVALID', "> Sie müssen entweder eine der Voreinstellungen wählen oder einen Zeitraum angeben (Startdatum & Enddatum)");
define('ALERT_CSV_CONFLICT', "> Die CSV Ausgabe ist nicht verfügbar für die " . SELECT_DETAIL_MATRIX . " Anzeige");
define('ALERT_MSG_FINISH', "Bitte beheben Sie den Fehler und generieren Sie den Bericht neu.");

// Other text defines
define('ERROR_MISSING_REQ_INFO', 'FEHLER: Benötigte Felder sind leer');
define('ERROR_CSV_CONFLICT', 'CSV output is not available for <em>' . SELECT_DETAIL_MATRIX . '</em> display; please re-select the report options.');
define('ALT_TEXT_SORT_ASC', 'Neusortieren in aufsteigender Reihenfolge');
define('ALT_TEXT_SORT_DESC', 'Neusortieren in absteigender Reihenfolge');
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
// Buttons
define('BUTTON_TIMEFRAME_PRESET', 'Voreinstellung wählen');
define('BUTTON_TIMEFRAME_CUSTOM', 'Benutzerdefiniert wählen');
