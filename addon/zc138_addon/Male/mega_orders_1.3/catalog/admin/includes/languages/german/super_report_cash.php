<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Report that displays all income for  //
//  the given date range.  Report results come solely   //
//  from the Super Orders payment system.               //
//////////////////////////////////////////////////////////
// $Id: super_report_cash.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('HEADING_TITLE', 'Cash Report');

define('HEADING_DATE_RANGE', 'Ihre Daten einzeln aufstellen');
define('HEADING_SELECT_TARGET', 'W&auml;hlen Sie Ihre Daten');
define('HEADING_START_DATE', 'Start Datum');
define('HEADING_END_DATE', 'End Datum (inklusive)');
define('HEADING_PRINT_FORMAT', 'Ergebinsanzeige in Druckformat');
define('BUTTON_SEARCH', 'Bestellung suchen');

define('HEADING_COLOR_KEY', 'Farben Schl&uuml;ssel:');
define('TEXT_PAYMENTS', 'Zahlungen');
define('TEXT_REFUNDS', 'Erstattung');
define('TEXT_BOTH', 'Beides');
define('TEXT_TO', ' an ');
define('TEXT_NO_PAYMENT_DATA', 'Keine Zahlungsdaten zum Anzeigen');
define('TEXT_NO_REFUND_DATA', 'Keine Erstattungsdaten zum Anzeigen');

define('TABLE_HEADING_ORDER_ID', 'Besetellung #');
define('TABLE_HEADING_NUMBER', 'Nummer');
define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_AMOUNT', 'Wert');
define('TABLE_HEADING_TYPE', 'Type');
define('TABLE_HEADING_STATE', 'Land');
define('TABLE_HEADING_DATE_PURCHASED', 'Daten der Bestellung');
define('TABLE_HEADING_DATE_POSTED', 'Date Posted');
define('TABLE_SUB_COUNT', 'Total %s Zahlungen: ');
define('TABLE_SUB_TOTAL', 'Total %s Wert: ');

define('TABLE_FOOTER_NUM_TYPES', ' Gesamte Zahlungsarten');
define('TABLE_FOOTER_NUM_PAYMENTS', 'Gesamte Zahlungen: ');
define('TABLE_FOOTER_CASH_TOTAL', 'Zahlungen: ');
define('TABLE_FOOTER_NUM_REFUNDS', 'Gesamt Erstattungen: ');
define('TABLE_FOOTER_REFUND_TOTAL', 'Erstattungen: ');
define('TABLE_FOOTER_TOTAL_INCOME', 'Gesamte Eing&auml;nge: ');
?>