<?php
/**
 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: paypal.php 2020-01-18 10:39:16Z webchills $
 */

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
define('TABLE_HEADING_PENDING_REASON', 'Pending Grund');
define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal IPN');
define('TEXT_DISPLAY_PAYPAL_IPN_NUMBER_OF_TX', 'Zeige <strong>%d</strong> bis <strong>%d</strong> (von <strong>%d</strong> Transaktionen)');

// Other constants are in includes/languages/english/modules/payment/paypal.php
//end ADMIN text
