<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// |  http://www.zen-cart.at/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.at/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: paypal.php 302 2008-05-30 19:49:12Z maleborg $
//

  // sort orders
define('TEXT_PAYPAL_IPN_SORT_ORDER_INFO', 'Anzeigesortierung: ');
define('TEXT_SORT_PAYPAL_ID_DESC', 'PayPal Sortierung (neu - alt)');
define('TEXT_SORT_PAYPAL_ID', 'PayPal Sortierung (alt - neu)');
define('TEXT_SORT_ZEN_ORDER_ID_DESC', 'Order ID (hoch - niedrig), PayPal Sortierung');
define('TEXT_SORT_ZEN_ORDER_ID', 'Order ID (niedrig - hoch), PayPal Sortierung');
define('TEXT_PAYMENT_AMOUNT_DESC', 'Bestellsumme (hoch - niedrig)');
define('TEXT_PAYMENT_AMOUNT', 'Bestellsumme (niedrig - hoch)');

  //begin ADMIN text
define('HEADING_ADMIN_TITLE', 'PayPal sofortige Zahlungsbenachrichtigungen');
define('HEADING_PAYMENT_STATUS', 'Bezahlstatus');
define('TEXT_ALL_IPNS', 'Alle');
define('TABLE_HEADING_ORDER_NUMBER', 'Bestellnummer');
define('TABLE_HEADING_PAYPAL_ID', 'PayPal #');
define('TABLE_HEADING_TXN_TYPE', 'Transaktionstyp');
define('TABLE_HEADING_PAYMENT_STATUS', 'Zahlungsstatus');
define('TABLE_HEADING_PAYMENT_AMOUNT', 'Betrag');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_DATE_ADDED', 'Erstellt am');
define('TABLE_HEADING_NUM_HISTORY_ENTRIES', 'Anzahl Einträge in der Statushistorie');
define('TABLE_HEADING_ENTRY_NUM', 'Anfangsnummer');
define('TABLE_HEADING_TRANS_ID', 'Trans. ID');
define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal IPN');
define('TEXT_DISPLAY_NUMBER_OF_TRANSACTIONS', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> IPN\'s)');

  //Details section
define('HEADING_DEATILS_CUSTOMER_REGISTRATION_TITLE', 'PayPal Kundenregistrierungsdetails');
define('HEADING_DETAILS_REGISTRATION_TITLE', 'PayPal sofortige Zahlungsbenachrichtigung');
define('TEXT_INFO_ENTRY_ADDRESS', 'Adresse');
define('TEXT_INFO_ORDER_NUMBER', 'Bestellnummer');
define('TEXT_INFO_TXN_TYPE', 'Transaktionstyp');
define('TEXT_INFO_PAYMENT_STATUS', 'Zahlungsstatus');
define('TEXT_INFO_PAYMENT_AMOUNT', 'Betrag');
define('ENTRY_FIRST_NAME', 'Vorname');
define('ENTRY_LAST_NAME', 'Nachname');
define('ENTRY_BUSINESS_NAME', 'Firmenname');
define('ENTRY_ADDRESS', 'Adresse');
  //EMAIL ALREADY DEFINED IN ORDERS
define('ENTRY_PAYER_ID', 'Bezahler- ID');
define('ENTRY_PAYER_STATUS', 'Bezahlerstatus');
define('ENTRY_ADDRESS_STATUS', 'Adress-Status');
define('ENTRY_PAYMENT_TYPE', 'Zahlungstyp');
define('TABLE_HEADING_ENTRY_PAYMENT_STATUS', 'Zahlungsstatus');
define('TABLE_HEADING_PENDING_REASON', 'In Warteschlange - Grund');
define('TABLE_HEADING_IPN_DATE', 'IPN Datum');
define('ENTRY_INVOICE', 'Rechnung');
define('ENTRY_PAYPAL_IPN_TXN', 'Transaktions- ID');
define('ENTRY_PAYMENT_DATE', 'Zahlungsdatum');
define('ENTRY_PAYMENT_LAST_MODIFIED', 'Zuletzt bearbeitet');
define('ENTRY_MC_CURRENCY', 'MC Währung');
define('ENTRY_MC_GROSS', 'MC Brutto');
define('ENTRY_MC_FEE', 'MC gebühr');
define('ENTRY_PAYMENT_GROSS', 'Zahlungsbrutto');
define('ENTRY_PAYMENT_FEE', 'Zahlungsgebühr');
define('ENTRY_SETTLE_AMOUNT', 'Betragsbereinigung');
define('ENTRY_SETTLE_CURRENCY', 'Währungsbereinigung');
define('ENTRY_EXCHANGE_RATE', 'Wechselkurs');
define('ENTRY_CART_ITEMS', 'Stückzahl Warenkorbinhalt');
define('ENTRY_CUSTOMER_COMMENTS', 'Kundenkommentare');
define('TEXT_NO_IPN_HISTORY', 'Keine IPN Historie erhältlich');
define('TEXT_TXN_SIGNATURE', 'Transaktions Signatur');
  //end ADMIN text
