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
//  DESCRIPTION:   This report displays orders that     //
//  have outstanding payments or refunds.  Missing      //
//  purchase order data can be seached as well.         //
//////////////////////////////////////////////////////////
// $Id: super_report_await_pay.php 32 2006-03-30 22:44:14Z BlindSide $
*/

define('HEADING_TITLE', 'Offene Bestellungen');

define('HEADING_REPORT_TYPE', 'Zeige alle offene Bestellungen...');
define('HEADING_PRINT_FORMAT', 'Ergebinsanzeige in Druckformat');
define('HEADING_WITHIN_LIMIT', 'Inklusive alle Aktivit&auml;ten bis 30 Tage ab heute');
define('BUTTON_SEARCH', 'Liste Bestellungen');

define('OUT_PAYMENTS', 'Zahlungen');
define('OUT_PO', 'Bestellungen');
define('OUT_REFUNDS', 'Erstattungen');

define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_ORDER_NUMBER', 'Bestellung #');
define('TABLE_HEADING_STATE', 'Kundenstand');
define('TABLE_HEADING_BILLING_NAME', 'Rechnungsname');
define('TABLE_HEADING_CUSTOMERS_PHONE', 'Kunden Telefonnummer');
define('TABLE_HEADING_ORDER_TOTAL', 'Bestellsumme');
define('TABLE_HEADING_AMOUNT_APPLIED', 'Betrag angewandt');
define('TABLE_HEADING_SO_BALANCE', 'Saldo f&auml;llig');

define('TABLE_SUBHEADING_PO_CHECKS', 'Kontrolliere Bestellung');
define('TABLE_SUBHEADING_CHECKS', 'Kontrolliere Direkt / Personal');
define('TABLE_SUBHEADING_TOTAL_PAYMENTS', 'Zahlungssumme');

define('TEXT_ORDERS', ' Bestellung');

define('TABLE_FOOTER_ORDER_GRAND_TOTAL', 'Bestellsumme:');
define('TABLE_FOOTER_TOTAL_APPLIED', 'Gesamt angewendet:');
define('TABLE_FOOTER_TOTAL_BALANCE', 'Geamt Saldo:');
?>