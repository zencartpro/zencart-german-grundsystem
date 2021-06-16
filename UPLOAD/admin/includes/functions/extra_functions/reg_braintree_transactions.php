<?php
if (!defined('IS_ADMIN_FLAG')) {
die('Illegal Access');
} 
if (function_exists('zen_register_admin_page')) {
if (!zen_page_key_exists('customersBraintreeTransactions')) {
zen_register_admin_page('customersBraintreeTransactions', 'BOX_CUSTOMERS_BRAINTREE_TRANSACTIONS', 'FILENAME_BRAINTREE_TRANSACTIONS','' , 'customers', 'Y', 500);
}    
}