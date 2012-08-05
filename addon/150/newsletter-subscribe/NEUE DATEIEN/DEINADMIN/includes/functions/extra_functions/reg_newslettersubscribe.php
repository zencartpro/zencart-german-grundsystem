<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
    if (!zen_page_key_exists('CustomerNewsletterSubscribe')) {
        // add newsletter manager to customers menu
        zen_register_admin_page('CustomerNewsletterSubscribe', 'BOX_CUSTOMERS_SUBSCRIPTION_MANAGER','FILENAME_SUBSCRIPTION_MANAGER', '', 'customers', 'Y', 10);
    }
}
?>