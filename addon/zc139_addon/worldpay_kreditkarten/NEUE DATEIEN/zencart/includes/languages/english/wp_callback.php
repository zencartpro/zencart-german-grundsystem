<?php
/**
 * @copyright Copyright (c) 2008 Philip Clarke
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com    
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */



define('NAVBAR_TITLE', 'WorldPay');
define('NAVBAR_TITLE_1', 'Success - Thank You');
define('NAVBAR_TITLE_2', 'Transaction Cancelled');

define('HEADING_TITLE', 'Thank You! We Appreciate your Business!');

define('TEXT_SUCCESS', '');
define('TEXT_NOTIFY_PRODUCTS', 'Please notify me of updates to the products I have selected below:');
define('TEXT_SEE_ORDERS', 'You can view your order history by going to the <a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">My Account</a> page and by clicking on view all orders.');
define('TEXT_CONTACT_STORE_OWNER', 'Please direct any questions you have to <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">customer service</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Thanks for shopping with us online!');

define('TABLE_HEADING_COMMENTS', '');

define('FOOTER_DOWNLOAD', 'You can also download your products at a later time at \'%s\'');

define('TEXT_YOUR_ORDER_NUMBER', '<strong>Your Order Number is:</strong> ');

define('WP_TEXT_SUCCESS', '... your payment was successfully received.');
define('WP_TEXT_FAILURE', '... your payment has been cancelled!');
define('WP_TEXT_HEADING', 'Response from WorldPay:');
define('WP_CONTACT_HEADING', 'Please check your contact details.  If there are any errors please <a href="/index.php?main_page=contact_us">contact us</a> immediately.');
define('WP_PAYMENT_HEADING', 'Your payment details are detailed below.  If you have experienced any problems with your payment please contact WorldPay immediately.');
define('WP_CANCELLED_HEADING', 'Your payment has been cancelled.  Please <a href="/index.php?main_page=contact_us">contact us</a> for alternative methods of payment. If you have experienced any problems with your payment please contact WorldPay immediately.');
define('WP_TEST_HEADING', 'This was NOT a live transaction - no money has changed hands.');
define('WP_CONTACT_INFO', 'You will find WorldPay contact information <a href="http://www.worldpay.com/about_us/index.php?page=contact" target="_blank">here</a>');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Link expires:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'Downloads remaining:');
define('HEADING_DOWNLOAD', 'Download your products here:');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Product Download:');

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

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','Address Information');
define('HEADING_SHIPPING_METHOD','Shipping Method');
?>