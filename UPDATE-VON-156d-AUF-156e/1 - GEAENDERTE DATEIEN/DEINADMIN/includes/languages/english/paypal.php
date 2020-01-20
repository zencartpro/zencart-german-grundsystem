<?php
/**
* @package admin
* @copyright Copyright 2003-2020 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: paypal.php 731 2020-01-17 18:49:16Z webchills $
*/

// sort orders
define('TEXT_PAYPAL_IPN_SORT_ORDER_INFO', 'Display Order: ');
define('TEXT_SORT_PAYPAL_ID_DESC', 'PayPal Order Received (new - old)');
define('TEXT_SORT_PAYPAL_ID', 'PayPal Order Received (old - new)');
define('TEXT_SORT_ZEN_ORDER_ID_DESC', 'Order ID (high - low), PayPal Order Received');
define('TEXT_SORT_ZEN_ORDER_ID', 'Order ID (low - high), PayPal Order Received');
define('TEXT_PAYMENT_AMOUNT_DESC', 'Order Amount (high - low)');
define('TEXT_PAYMENT_AMOUNT', 'Order Amount (low - high)');

//begin ADMIN text
define('HEADING_ADMIN_TITLE', 'PayPal Instant Payment Notifications');
define('HEADING_PAYMENT_STATUS', 'Payment Status');
define('TEXT_ALL_IPNS', 'All');

define('TABLE_HEADING_ORDER_NUMBER', 'Order #');
define('TABLE_HEADING_PAYPAL_ID', 'PayPal #');
define('TABLE_HEADING_TXN_TYPE', 'Transaction Type');
define('TABLE_HEADING_PAYMENT_STATUS', 'Payment Status');
define('TABLE_HEADING_PAYMENT_AMOUNT', 'Amount');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_DATE_ADDED', 'Date Added');
define('TABLE_HEADING_NUM_HISTORY_ENTRIES', 'Number of entries in Status History');
define('TABLE_HEADING_ENTRY_NUM', 'Entry Number');
define('TABLE_HEADING_TRANS_ID', 'Trans. ID');
define('TABLE_HEADING_PENDING_REASON', 'Pending Reason');

define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal IPN');
define('TEXT_DISPLAY_NUMBER_OF_TRANSACTIONS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> IPN\'s)');

// Other constants are in includes/languages/english/modules/payment/paypal.php
//end ADMIN text
