<?php
/**
 * Zen Cart German Specific
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: dsgvo_export.php 2022-02-04 18:56:14Z webchills $
 */

define('HEADING_TITLE', 'GDPR Customer Data Export');
define('DSGVO_KUNDENEXPORT_OVERVIEW', 'According to Art. 20 GDPR, customers have the right to receive their personal data provided to the shop owner in a structured, common and machine-readable format. <br> If customers inquire about this, you can create an up-to-date customer data record for each customer which also contains the customer\'s previous orders and any product reviews. <br> Generates a csv file with semicolon separator and utf-8 character set. <br> Select a customer, then click the Export button, to create and download a csv file from the current database.<br>');
define('IMAGE_DSGVOEXPORT','GDPR Customer Data Export');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FIRSTNAME', 'First Name');
define('TABLE_HEADING_LASTNAME', 'Last Name');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Created');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Created');
define('ENTRY_NONE', 'None');
define('TABLE_HEADING_COMPANY', 'Company');
define('TEXT_INFO_ADDRESS_BOOK_COUNT', ' | 1 of  ');
define('TABLE_HEADING_LOGIN', 'Last Login');
define('TABLE_HEADING_ACTION', 'Action');
define('ADDRESS_BOOK_TITLE', 'Address Book Entries');
define('PRIMARY_ADDRESS', '(Standard Address)');
define('TEXT_MAXIMUM_ENTRIES', '<span class="coming"><strong>Note:</strong></span> A maximum of %s address book entries allowed.');

define('CSV_HEADING_TITLE_SALUTATION','Salutation');
define('CSV_HEADING_TITLE_GENDER','Mr/Mrs/Divers');
define('DSGVO_CUSTOMERDATA_HEADING','CUSTOMER DATA');
define('DSGVO_CUSTOMERS_GENDER','Salutation');
define('DSGVO_CUSTOMERS_FIRSTNAME','First Name');
define('DSGVO_CUSTOMERS_LASTNAME','Last Name');
define('DSGVO_CUSTOMERS_DOB','Geburtsdatum');
define('DSGVO_CUSTOMERS_EMAIL_ADDRESS','E-Mail Address');
define('DSGVO_ENTRY_COMPANY','Company Name');
define('DSGVO_ENTRY_STREET_ADDRESS','Street Address');
define('DSGVO_ENTRY_POSTCODE','Postcode');
define('DSGVO_ENTRY_CITY','City');
define('DSGVO_COUNTRIES_NAME','Country');
define('DSGVO_CUSTOMERS_TELEPHONE','Telephone Number');
define('DSGVO_CUSTOMERS_FAX','Fax Number');
define('DSGVO_CUSTOMERS_INFO_DATE_ACCOUNT_CREATED','Kunde seit');
define('DSGVO_CUSTOMERS_INFO_DATE_OF_LAST_LOGON','letztes Login');
define('DSGVO_REVIEWS_HEADING','REVIEWS');
define('DSGVO_REVIEW_HEADING','Review');
define('DSGVO_DATE','Date');
define('DSGVO_PRODUCT_NAME','Product');
define('DSGVO_REVIEWS_TEXT','Text');
define('DSGVO_ORDERS_HEADING','ORDERS');
define('DSGVO_ORDER_HEADING','Order');
define('DSGVO_ORDER_ID','Ord-ID');
define('DSGVO_ORDER_DATE','Date');
define('DSGVO_ORDER_IP_ADDRESS','IP Address');
define('DSGVO_CUSTOMER_ADDRESS','Customers Address');
define('DSGVO_SHIPPING_ADDRESS','Shipping Address');
define('DSGVO_BILLING_ADDRESS','Billing Address');
define('DSGVO_PAYMENT_METHOD','Payment Method');
define('DSGVO_PRODUCT_NUMBER','Product no');
