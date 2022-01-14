<?php
/**
 * Zen Cart German Specific
 * @package languageDefines
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: checkout_confirmation.php 2022-01-14 16:49:16Z webchills $
 */

define('NAVBAR_TITLE_1', 'Checkout');
define('NAVBAR_TITLE_2', 'Confirmation');

define('HEADING_TITLE', 'Step 3 of 3 - Confirm Purchase');
define('TEXT_ZUSATZ_SCHRITT3','Please verify your order and confirm by clicking the "Confirm Purchase" button at the bottom of this page.');
define('HEADING_BILLING_ADDRESS', 'Billing/Payment Information');
define('HEADING_DELIVERY_ADDRESS', 'Delivery/Shipping Information');
define('HEADING_SHIPPING_METHOD', 'Shipping Method:');
define('HEADING_PAYMENT_METHOD', 'Payment Method:');
define('HEADING_PRODUCTS', 'Shopping Cart Contents');
define('HEADING_TAX', 'Tax');
define('HEADING_ORDER_COMMENTS', 'Special Instructions or Order Comments');
// no comments entered
define('NO_COMMENTS_TEXT', 'None');
define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>Final Step</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- continue to confirm your order. Thank you!');

// buttonloesung
define('TABLE_HEADING_SINGLEPRICE','Price');
define('TABLE_HEADING_PRODUCTIMAGE','Image');
define('TEXT_CONDITIONS_ACCEPTED_IN_LAST_STEP','I have read and agreed to the <a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '" target="_blank"><u>terms and conditions</u></a> bound to this order.');
define('TEXT_NON_EU_COUNTRIES','Note:<br>Your order will be shipped to a country outside the European Union. Your packages may be subject to the customs fees and import duties of the country to which you have your order shipped. These charges are always the recipient\'s responsibility.');
