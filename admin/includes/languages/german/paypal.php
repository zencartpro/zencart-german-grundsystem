<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Translator:           cyaneo/hugo13                                  |
// | Date of Translation:  31.03.06                                       |
// | Homepage:             www.zen-cart.at                                |
// +----------------------------------------------------------------------+
//  $Id: paypal.php 4 2006-03-31 16:38:40Z hugo13 $
//

// sort orders
define('TEXT_PAYPAL_IPN_SORT_ORDER_INFO', 'Anzeigesortierung: '); // new 1.3.0  
define('TEXT_SORT_PAYPAL_ID_DESC', 'PayPal Sortierung (neu - alt)');   // new 1.3.0  
define('TEXT_SORT_PAYPAL_ID', 'PayPal Sortierung (alt - neu)'); // new 1.3.0  
define('TEXT_SORT_ZEN_ORDER_ID_DESC', 'Order ID (hoch - niedrig), PayPal Sortierung'); // new 1.3.0  
define('TEXT_SORT_ZEN_ORDER_ID', 'Order ID (niedrig - hoch), PayPal Sortierung');  // new 1.3.0  
define('TEXT_PAYMENT_AMOUNT_DESC', 'Bestellsumme (hoch - niedrig)'); // new 1.3.0  
define('TEXT_PAYMENT_AMOUNT', 'Bestellsumme (niedrig - hoch)'); // new 1.3.0  

  //begin ADMIN text
  define('HEADING_ADMIN_TITLE', 'PayPal sofortige Zahlungsnotifikationen');
  define('HEADING_PAYMENT_STATUS', 'Bezahlstatus');
  define('TEXT_ALL_IPNS', 'Alle');

  define('TABLE_HEADING_ORDER_NUMBER', 'Bestellnummer');
define('TABLE_HEADING_PAYPAL_ID', 'PayPal #'); // new 1.3.0  
  define('TABLE_HEADING_TXN_TYPE', 'Transaktionstyp');
  define('TABLE_HEADING_PAYMENT_STATUS', 'Zahlungsstatus');
  define('TABLE_HEADING_PAYMENT_AMOUNT', 'Betrag');
  define('TABLE_HEADING_ACTION', 'Aktion');
  define('TABLE_HEADING_DATE_ADDED', 'Hinzugef&uuml;gt am');
  define('TABLE_HEADING_NUM_HISTORY_ENTRIES', 'Anzahl Eintr&auml;ge in der Statushistorie');
  define('TABLE_HEADING_ENTRY_NUM', 'Anfangsnummer');
  define('TABLE_HEADING_TRANS_ID', 'Trans. ID');



  define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal');
  define('TEXT_DISPLAY_NUMBER_OF_TRANSACTIONS', 'zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> IPN\'s)');

  //Details section
  define('HEADING_DEATILS_CUSTOMER_REGISTRATION_TITLE', 'PayPal Kundenregistrierungsdetails');
  define('HEADING_DETAILS_REGISTRATION_TITLE', 'PayPal sofortige Zahlungsnotifikation');
  define('TEXT_INFO_ENTRY_ADDRESS', 'Adresse');
  define('TEXT_INFO_ORDER_NUMBER', 'Besgtellnummer');
  define('TEXT_INFO_TXN_TYPE', 'Transaktionstyp');
  define('TEXT_INFO_PAYMENT_STATUS', 'Zahlungsstatus');
  define('TEXT_INFO_PAYMENT_AMOUNT', 'Betrag');
  define('ENTRY_FIRST_NAME', 'vorname');
  define('ENTRY_LAST_NAME', 'Nachname');
  define('ENTRY_BUSINESS_NAME', 'Firmenname');
  define('ENTRY_ADDRESS', 'Adresse');
  //EMAIL ALREADY DEFINED IN ORDERS
  define('ENTRY_PAYER_ID', 'Bezahler- ID');
  define('ENTRY_PAYER_STATUS', 'Bezahlerstatus');
  define('ENTRY_ADDRESS_STATUS', 'Adress-Status');
  define('ENTRY_PAYMENT_TYPE', 'Zahlungstyp');
  define('TABLE_HEADING_ENTRY_PAYMENT_STATUS', 'Zahlungsstatus');
  define('TABLE_HEADING_PENDING_REASON', 'In Schwebe - Ursache');
  define('TABLE_HEADING_IPN_DATE', 'IPN Datum');
  define('ENTRY_INVOICE', 'rechnung');
  define('ENTRY_PAYPAL_IPN_TXN', 'Transaktions- ID');
  define('ENTRY_PAYMENT_DATE', 'Zahlungsdatum');
  define('ENTRY_PAYMENT_LAST_MODIFIED', 'zuletzt bearbeitet');
  define('ENTRY_MC_CURRENCY', 'MC W&auml;hrung');
  define('ENTRY_MC_GROSS', 'MC Brutto');
  define('ENTRY_MC_FEE', 'MC geb&uuml;hr');
  define('ENTRY_PAYMENT_GROSS', 'Zahlungsbrutto');
  define('ENTRY_PAYMENT_FEE', 'Zahlungsgeb&uuml;hr');
  define('ENTRY_SETTLE_AMOUNT', 'Betragsbereinigung');
  define('ENTRY_SETTLE_CURRENCY', 'W&auml;hrungsbereinigung');
  define('ENTRY_EXCHANGE_RATE', 'Wechselkurs');
  define('ENTRY_CART_ITEMS', 'St&uuml;ckzahl Warenkorbinhalt');
  define('ENTRY_CUSTOMER_COMMENTS', 'Kundenkommentare');
  define('TEXT_NO_IPN_HISTORY', 'Keine IPN Historie erh&auml;ltlich');
  define('TEXT_TXN_SIGNATURE', 'Transaktions- Signatur');
  //end ADMIN text
?>