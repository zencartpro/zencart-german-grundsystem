<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2012 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @translators: cyaneo/hugo13/wflohr/maleborg/webchills	http://www.zen-cart-pro.at
 * @version $Id: checkout_process.php 849 2012-03-07 17:26:25Z webchills $
 */
// | that is bundled with this package in the file LICENSE, and is        |


define('EMAIL_TEXT_SUBJECT', 'Order Confirmation');
define('EMAIL_TEXT_HEADER', 'Order Confirmation');
define('EMAIL_TEXT_FROM',' from ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','Thanks for shopping with us today!');
define('EMAIL_DETAILS_FOLLOW','The following are the details of your order.');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', 'Click here for a Detailed Invoice');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_PRODUCTS', 'Products');
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Total:');
define('EMAIL_TEXT_TAX', 'Tax:        ');
define('EMAIL_TEXT_SHIPPING', 'Shipping: ');
define('EMAIL_TEXT_TOTAL', 'Total:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');
define('EMAIL_GREETING_MR', 'Dear Mr.');
define('EMAIL_GREETING_MS', 'Dear Mrs.');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','Address Information');
define('HEADING_SHIPPING_METHOD','Shipping Method');
