<?php

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (function_exists('zen_register_admin_page')) {
  if (!zen_page_key_exists('emailExport')) {
    zen_register_admin_page('emailExport', 'BOX_TOOLS_EMAIL_EXPORT','FILENAME_EMAIL_EXPORT', '', 'tools', 'Y', 10);
  }
}

// other tweaking to add slightly more flexibility when exporting email addresses
$result = $db->Execute("SELECT query_string from " . TABLE_QUERY_BUILDER . " where query_name = 'All Customers'");
if ($result->fields['query_string'] == 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address') {
  $db->Execute("UPDATE " . TABLE_QUERY_BUILDER . " set query_string='select customers_firstname, customers_lastname, customers_email_address, c.*, a.* from TABLE_CUSTOMERS c, TABLE_ADDRESS_BOOK a WHERE c.customers_id = a.customers_id AND c.customers_default_address_id = a.address_book_id ORDER BY customers_lastname, customers_firstname, customers_email_address' where query_name = 'All Customers'");
}
$result = $db->Execute("SELECT query_string from " . TABLE_QUERY_BUILDER . " where query_name = 'All Newsletter Subscribers'");
if ($result->fields['query_string'] == "select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = '1'") {
  $db->Execute("UPDATE " . TABLE_QUERY_BUILDER . " set query_string='select customers_firstname, customers_lastname, customers_email_address, c.*, a.* from TABLE_CUSTOMERS c, TABLE_ADDRESS_BOOK a WHERE c.customers_id = a.customers_id AND c.customers_default_address_id = a.address_book_id AND customers_newsletter = 1' where query_name = 'All Newsletter Subscribers'");
}
