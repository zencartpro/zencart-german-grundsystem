<?php
/**
 * checkout_address_book.php
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: checkout_address_book.php 2023-10-29 15:49:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$customer = new Customer;
$addresses = $customer->getFormattedAddressBookList();

$radio_buttons = count($addresses);

$zco_notifier->notify('NOTIFY_MODULE_END_CHECKOUT_ADDRESS_BOOK', $customer, $addresses);
