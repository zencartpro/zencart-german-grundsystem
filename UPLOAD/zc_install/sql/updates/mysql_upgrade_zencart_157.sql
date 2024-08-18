#
# * This SQL script upgrades the core Zen Cart database structure from v1.5.6 to v1.5.7i
# *
# * @access private
# * Zen Cart German Specific
# * @copyright Copyright 2003-2024 Zen Cart Development Team
# * Zen Cart German Version - www.zen-cart-pro.at
# * @copyright Portions Copyright 2003 osCommerce
# * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
# * @version $Id: mysql_upgrade_zencart_157.sql 2024-08-16 14:55:59Z webchills $
#

############ IMPORTANT INSTRUCTIONS ###############
#
# * Zen Cart uses the zc_install/index.php program to do database upgrades
# * This SQL script is intended to be used by running zc_install
# * It is *not* recommended to simply run these statements manually via any other means
# * ie: not via phpMyAdmin or via the Install SQL Patch tool in Zen Cart admin
# * The zc_install program catches possible problems and also handles table-prefixes automatically
# *
# * To use the zc_install program to do your database upgrade:
# * a. Upload the NEWEST zc_install folder to your server
# * b. Surf to zc_install/index.php via your browser
# * c. On the System Inspection page, scroll to the bottom and click on Database Upgrade
# *    NOTE: do NOT click on the "Install" button, because that will erase your database.
# * d. On the Database Upgrade screen, you will be presented with a list of checkboxes for
# *    various Zen Cart versions, with the recommended upgrades already pre-selected.
# * e. Verify the checkboxes, then scroll down and enter your Zen Cart Admin username
# *    and password, and then click on the Upgrade button.
# * f. If any errors occur, you will be notified. Some warnings can be ignored.
# * g. When done, you will be taken to the Finished page.
#
#####################################################

# Set store to Down-For-Maintenance mode.  Must reset manually via admin after upgrade is done.
UPDATE configuration set configuration_value = 'true' where configuration_key = 'DOWN_FOR_MAINTENANCE';

# Remove greater-than sign in query_builder
UPDATE query_builder SET query_name = 'Customers Dormant for 3+ months (Subscribers)' WHERE query_id = 3;

# Clear out active customer sessions. Truncating helps the database clean up behind itself.
TRUNCATE TABLE whos_online;
TRUNCATE TABLE db_cache;

# Improved descriptions for meta tag options
UPDATE configuration SET configuration_title = 'Product page generated &lt;title&gt; tag - include Product Model?', configuration_description = 'When custom Keywords and Description meta tags are not set, include the Product Model in the generated page &lt;title&gt; tag?<br><br>0=no / 1=yes' WHERE configuration_key = 'META_TAG_INCLUDE_MODEL';
UPDATE configuration SET configuration_title = 'Product page generated &lt;title&gt; tag - include Product Price?', configuration_description = 'When custom Keywords and Description meta tags are not set, include the Product Price in the generated page &lt;title&gt; tag?<br><br>0=no / 1=yes' WHERE configuration_key = 'META_TAG_INCLUDE_PRICE';
UPDATE configuration SET configuration_title = 'Product page generated &lt;meta - description&gt; tag - Maximum Length', configuration_description = 'When custom Keywords and Description meta tags are not set, limit the generated &lt;meta - description&gt; tag to this number of words. Default 50.' WHERE configuration_key = 'MAX_META_TAG_DESCRIPTION_LENGTH';
# Other name/description improvements
UPDATE configuration SET configuration_title= 'Order History Box', configuration_description= 'Number of products to display in the order history box' WHERE configuration_key = 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX';
UPDATE configuration SET configuration_description = 'Number of products to display in the \'Also Purchased\' box' WHERE configuration_key = 'MAX_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET configuration_description = 'Minimum number of products to display in the \'Also Purchased\' box' WHERE configuration_key = 'MIN_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET configuration_description = 'Maximum number of PayPal IPN Listings in Admin<br />Default is 20' WHERE configuration_key = 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN';
UPDATE configuration SET configuration_description = 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone - Can be overridden by correctly written Shipping Module' WHERE configuration_key = 'STORE_SHIPPING_TAX_BASIS';
UPDATE configuration SET configuration_description = 'Check to see if sufficient stock is available' WHERE configuration_key = 'STOCK_CHECK';
UPDATE configuration SET configuration_description = 'Give a WARNING some time before you put your website Down for Maintenance<br />(true=on false=off)<br />If you set the \'Down For Maintenance: ON/OFF\' to true this will automatically be updated to false' WHERE configuration_key = 'WARN_BEFORE_DOWN_FOR_MAINTENANCE';
#
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Name', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Title Additional Text', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Title Additional text in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Model', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Model in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Price', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Price in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use SITE_TAGLINE', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the defined constant "SITE_TAGLINE" in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS';

UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Name', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Title Additional Text', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Model', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Price', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use SITE_TAGLINE', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS';

UPDATE product_type_layout SET configuration_title = 'Document page &lt;title&gt; tag - default: use Document Title', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Title in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Document page &lt;title&gt; tag - default: use Document Name', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Tagline', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Tagline in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS';

UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Title', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Title in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Name', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Model', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Model in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Price', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Price in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Document Tagline', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Document Tagline in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS';

UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Name', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Name in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Title Additional Text', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Title Additional text in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Model', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Model in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use Product Price', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the Product Price in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS';
UPDATE product_type_layout SET configuration_title = 'Product page &lt;title&gt; tag - default: use SITE_TAGLINE', configuration_description = 'Default setting for a new product (can be modified per product).<br>Show the defined constant "SITE_TAGLINE" in the page &lt;title&gt; tag.' WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS';

# Repair ez-pages table field that was too short in v156
ALTER TABLE ezpages_content MODIFY pages_html_text mediumtext;

# Enable Products to Categories as a menu option
UPDATE admin_pages SET display_on_menu = 'Y' WHERE page_key = 'productsToCategories';
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order) VALUES ('Default Target Category (Products to Multiple Categories Manager)', 'P2C_TARGET_CATEGORY_DEFAULT', '', 'Default Target Category for Products to Multiple Categories Manager (set on page)', 6, 100);

# Rename 'Email Options' to just 'Email'
UPDATE configuration_group set configuration_group_title = 'Email', configuration_group_description = 'Email-related settings' where configuration_group_title = 'E-Mail Options';

# Add NOTIFY_CUSTOMER_DEFAULT
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Default for Notify Customer on Order Status Update?', 'NOTIFY_CUSTOMER_DEFAULT', '1', 'Set the default email behavior on status update to Send Email, Do Not Send Email, or Hide Update.', 1, 120, now(), now(), NULL, 'zen_cfg_select_drop_down(array( array(\'id\'=>\'1\', \'text\'=>\'Email\'), array(\'id\'=>\'0\', \'text\'=>\'No Email\'), array(\'id\'=>\'-1\', \'text\'=>\'Hide\')),');

# Minmax values
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Preview', 'MAX_PREVIEW', '100', '{"error":"TEXT_MAX_PREVIEW","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}', 'Maximum Preview length<br />100 = Default', 3, 80, now());

# Encrypted Master Password configuration. Using INSERT IGNORE followed by an UPDATE in consideration of shops with EMP already installed.
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer <em>Place Order</em>: Single Admin ID', 'EMP_LOGIN_ADMIN_ID', '0', 'Identify the ID number of an admin that is permitted to use the <em>Place Order</em> feature on the customers list, regardless of their assigned admin-profile. Set the value to 0 to disable the <em>Single Admin ID</em> feature.', 1, 300, now());
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Single Admin ID', configuration_description = 'Identify the ID number of an admin that is permitted to use the <em>Place Order</em> feature on the customers list, regardless of their assigned admin-profile. Set the value to 0 to disable the <em>Single Admin ID</em> feature.' WHERE configuration_key = 'EMP_LOGIN_ADMIN_ID' LIMIT 1;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Customer <em>Place Order</em>: Passwordless Login', 'EMP_LOGIN_AUTOMATIC', 'false', 'Login directly to store without entering credentials', 1, 302, now(), 'zen_cfg_select_option(array(\'true\', \'false\'),');
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Passwordless Login', configuration_description = 'Login directly to store without entering credentials' WHERE configuration_key = 'EMP_LOGIN_AUTOMATIC' LIMIT 1;

INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer <em>Place Order</em>: Admin Profiles', 'EMP_LOGIN_ADMIN_PROFILE_ID', '0', 'Identify the admin <em>User Profile IDs</em> that are permitted to use the <em>Place Order</em> feature on the customers list &mdash; all admins that are in these profiles are permitted. Enter the value as a comma-separated list (intervening blanks are OK) of Admin Profile IDs, e.g. <b>1, 2, 3</b>. Set the value to 0 to disable the <em>Admin Profiles</em> feature.<br><br><b>Default: 0</b>', 1, 301, now());
UPDATE configuration SET configuration_title = 'Customer <em>Place Order</em>: Admin Profiles', configuration_description = 'Identify the admin <em>User Profile IDs</em> that are permitted to use the <em>Place Order</em> feature on the customers list &mdash; all admins that are in these profiles are permitted. Enter the value as a comma-separated list (intervening blanks are OK) of Admin Profile IDs, e.g. <b>1, 2, 3</b>. Set the value to 0 to disable the <em>Admin Profiles</em> feature.<br><br><b>Default: 0</b>' WHERE configuration_key = 'EMP_LOGIN_ADMIN_PROFILE_ID' LIMIT 1;

#global auth key
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('global auth key', 'GLOBAL_AUTH_KEY', '', '', 6, 30, now(), now(), NULL, NULL);

# New setting, enabling product meta-tags to be conditionally included in search result.
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Include meta-tags in product search?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 'true', 'Should a product\'s meta-tag keywords and meta-tag descriptions be considered in any <code>advanced_search_results</code> displayed?', 1, 18, now(), 'zen_cfg_select_option(array(\'true\', \'false\'),');

# Missed in 1.5.6 upgrade. May already be there so use INSERT IGNORE
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, val_function, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin Usernames', 'ADMIN_NAME_MINIMUM_LENGTH', '4', '{"error":"TEXT_MIN_ADMIN_USER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":4}}}', 'Minimum length of admin usernames (must be 4 or more)', '2', '18', now());
# Country data
UPDATE countries set address_format_id = 5 where countries_iso_code_3 in ('ITA');

# Add language_code
ALTER TABLE orders ADD language_code char(2) NOT NULL default '';

# Add sort_order
ALTER TABLE orders_status ADD sort_order int(11) NOT NULL default 0;

# Improve speed of admin orders page listing
ALTER TABLE orders_total ADD INDEX idx_oid_class_zen (orders_id, class);
ALTER TABLE orders ADD INDEX idx_status_date_id_zen (orders_status, date_purchased, orders_id);

# Add customer secret
ALTER TABLE customers ADD customers_secret varchar(64) NOT NULL default '';

# Add control to enable/disable the display of the 'Ask a Question' block for each product type
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 1, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_MUSIC_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 2, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_DOCUMENT_GENERAL_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 3, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_DOCUMENT_PRODUCT_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 4, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show \"Ask a Question\" button?', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ASK_A_QUESTION', '1', 'Display the \"Ask a Question\" button on product Info pages? (0 = False, 1 = True)', 5, 14, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

# Add control for enabling product that were disabled and have a products_available_date that has passed in time and is not set to the Zen Cart equivalent of an ignored/empty date.
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable disabled product by available date', 'ENABLE_DISABLED_UPCOMING_PRODUCT', 'Manual', 'How should hidden (disabled) product with a future available date be made visible (active) to customers when the date is reached?<br />', '9', '12', 'zen_cfg_select_option(array(\'Manual\', \'Automatic\'), ', now());

DELETE FROM configuration WHERE configuration_key = 'ADMIN_DEMO';
DELETE FROM configuration WHERE configuration_key = 'UPLOAD_FILENAME_EXTENSIONS';

## Remove remnants of tell a friend
DELETE FROM configuration WHERE configuration_key = 'ALLOW_GUEST_TO_TELL_A_FRIEND';
DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO';
DELETE FROM configuration WHERE configuration_key = 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_INFO_TELL_A_FRIEND';
DELETE FROM product_type_layout WHERE configuration_key = 'SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND';

#############
### 1.5.7g bring address formats up to date

### Move any none core address formats created by users
UPDATE address_format SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;
UPDATE countries SET address_format_id = address_format_id + 13  WHERE address_format_id > 7;
UPDATE orders SET customers_address_format_id = customers_address_format_id + 13 WHERE customers_address_format_id  > 7;
UPDATE orders SET  delivery_address_format_id = delivery_address_format_id + 13 WHERE delivery_address_format_id > 7;
UPDATE orders SET  billing_address_format_id = billing_address_format_id + 13 WHERE billing_address_format_id > 7;

### Updated address summary for original address format address_summary
UPDATE address_format SET address_summary = 'Default $city $country' WHERE address_format_id = 1;
UPDATE address_format SET address_summary = '$city, $state $postcode' WHERE address_format_id = 2;
UPDATE address_format SET address_summary = 'Historic $city / $postcode - $statecomma$country' WHERE address_format_id = 3;
UPDATE address_format SET address_summary = 'Historic $city ($postcode)' WHERE address_format_id = 4;
UPDATE address_format SET address_summary = '$postcode $city' WHERE address_format_id = 5;
UPDATE address_format SET address_summary = '$city / $state / $postcode' WHERE address_format_id = 6 ;
UPDATE address_format SET address_summary = '$city $state $postcode' WHERE address_format_id = 7;

### Add new address formats
INSERT INTO address_format VALUES (8,'$firstname $lastname$cr$streets$cr$city$cr$country','$city');
INSERT INTO address_format VALUES (9,'$firstname $lastname$cr$streets$cr$postcode $city $state$cr$country','$postcode $city $state');
INSERT INTO address_format VALUES (10,'$firstname $lastname$cr$streets$cr$city $postcode$cr$country','$city $postcode');
INSERT INTO address_format VALUES (11,'$firstname $lastname$cr$streets$cr$city $state$cr$postcode$cr$country','$city $state / $postcode');
INSERT INTO address_format VALUES (12,'$firstname $lastname$cr$streets$cr$postcode$cr$city $state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (13,'$firstname $lastname$cr$streets$cr$city $postcode$cr$state$cr$country','$city $postcode / $state');
INSERT INTO address_format VALUES (14,'$firstname $lastname$cr$streets$cr$postcode $city$cr$state$cr$country','$postcode $city / $state');
INSERT INTO address_format VALUES (15,'$firstname $lastname$cr$streets$cr$postcode$cr$city$cr$state$cr$country','$postcode / $city / $state');
INSERT INTO address_format VALUES (16,'$firstname $lastname$cr$streets$cr$city $postcode $state$cr$country',' $city $postcode $state');
INSERT INTO address_format VALUES (17,'$firstname $lastname$cr$streets$cr$city$cr$postcode $state$cr$country',' $city / $postcode $state');
INSERT INTO address_format VALUES (18,'$firstname $lastname$cr$streets$cr$city$cr$state $postcode$cr$country','$city / $state $postcode');
INSERT INTO address_format VALUES (19,'$firstname $lastname$cr$city$cr$streets$cr$postcode$cr$country','$city $street / $postcode');
INSERT INTO address_format VALUES (20,'$firstname $lastname$cr$streets$cr$postcode $city ($state)$cr$country','$postcode $city ($state)');


### Update countries with new address_format_id use countries_iso_code_2 to match and only change if still set to original address_format_id.
UPDATE countries SET address_format_id = '2' WHERE countries_iso_code_2 IN ('LV', 'MM', 'KN', 'SO', 'TT') AND address_format_id = '1';
UPDATE countries SET address_format_id = '5' WHERE countries_iso_code_2 IN ('AX', 'AL', 'DZ', 'AD', 'AR', 'AM', 'AZ', 'BA', 'BG', 'CV', 'CL', 'HR', 'CY', 'CZ', 'DK', 'DO', 'GQ', 'EE', 'ET', 'FO', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GE', 'GR', 'GL', 'GP', 'GN', 'GW', 'HT', 'IS', 'IL', 'JM', 'KW', 'LA', 'LI', 'LT', 'LU', 'MK', 'MG', 'MQ', 'YT', 'MD', 'MC', 'MA', 'NC', 'NE', 'NO', 'PY', 'PL', 'PT', 'RE', 'RO', 'SM', 'SN', 'SK', 'SI', 'PM', 'SJ', 'CH', 'SY', 'TJ', 'TM', 'UY', 'WF', 'PS', 'ME', 'SS') AND address_format_id = '1';
UPDATE countries SET address_format_id = '6' WHERE countries_iso_code_2 IN ('AF', 'IO', 'EG', 'FK', 'GI', 'IN', 'IR', 'IE', 'KZ', 'KE', 'KI', 'MT', 'MS', 'PN', 'RU', 'SC', 'SB', 'ZA', 'GS', 'LK', 'SH', 'SZ', 'TG', 'TC', 'TV', 'UA', 'AE', 'UZ', 'RS', 'ZW', 'GG', 'IM', 'JE') AND address_format_id = '1';
UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN ('AS', 'KH', 'KY', 'CN', 'CX', 'CC', 'CO', 'GU', 'GY', 'HM', 'JP', 'KR', 'MH', 'FM', 'NF', 'MP', 'PK', 'PW', 'PR', 'UM', 'VI', 'CW', 'SX') AND address_format_id = '1';
UPDATE countries SET address_format_id = '7' WHERE countries_iso_code_2 IN  ('US', 'CA') AND address_format_id = '2';
UPDATE countries SET address_format_id = '8' WHERE countries_iso_code_2 IN ('AO', 'AG', 'AW', 'BB', 'BJ', 'BO', 'BW', 'BV', 'BI', 'CM', 'CF', 'TD', 'KM', 'CG', 'CI', 'DJ', 'DM', 'ER', 'FJ', 'GM', 'GD', 'HK', 'LY', 'MO', 'MW', 'ML', 'MR', 'MU', 'NA', 'QA', 'RW', 'LC', 'WS', 'ST', 'SL', 'SR', 'TO', 'UG', 'VU', 'EH', 'YE')  AND address_format_id = '1';
UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 IN ('CU', 'HN', 'LR', 'MX', 'TN', 'TR', 'VA') AND address_format_id = '1';
UPDATE countries SET address_format_id = '9' WHERE countries_iso_code_2 = 'IT' AND address_format_id = '5';
UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 IN ('AI', 'AQ', 'BS', 'BH', 'BD', 'BZ', 'BM', 'BT', 'BF', 'CK', 'TL', 'ID', 'JO', 'KP', 'LB', 'LS', 'MV', 'MN', 'NR', 'NP', 'BQ', 'NZ', 'NU', 'VC', 'SA', 'TW', 'TK', 'VG', 'ZM') AND address_format_id = '1';
UPDATE countries SET address_format_id = '10' WHERE countries_iso_code_2 = 'SG' AND address_format_id = '4';
UPDATE countries SET address_format_id = '11' WHERE countries_iso_code_2 IN ('BR', 'CR', 'GH', 'IQ', 'TH') AND address_format_id = '1';
UPDATE countries SET address_format_id = '12' WHERE countries_iso_code_2 IN ('EC', 'NI', 'PE', 'SD') AND address_format_id = '1';
UPDATE countries SET address_format_id = '13' WHERE countries_iso_code_2 = 'NG' AND address_format_id = '1';
UPDATE countries SET address_format_id = '14' WHERE countries_iso_code_2 IN ('BY', 'GT', 'KG', 'MY', 'MZ', 'PA', 'SV', 'TZ') AND address_format_id = '1';
UPDATE countries SET address_format_id = '15' WHERE countries_iso_code_2 = 'OM' AND address_format_id = '1';
UPDATE countries SET address_format_id = '16' WHERE countries_iso_code_2 IN ('PG', 'VE') AND address_format_id = '1';
UPDATE countries SET address_format_id = '17' WHERE countries_iso_code_2 = 'PH' AND address_format_id = '1';
UPDATE countries SET address_format_id = '18' WHERE countries_iso_code_2 IN ('VN', 'BN')  AND address_format_id = '1';
UPDATE countries SET address_format_id = '19' WHERE countries_iso_code_2 = 'HU' AND address_format_id = '1';
UPDATE countries SET address_format_id = '20' WHERE countries_iso_code_2 = 'ES' AND address_format_id = '3';
################



#val_function update for MIN values
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_FIRST_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_FIRST_NAME_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_LAST_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_LAST_NAME_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_DOB_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_DOB_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_EMAIL_ADDRESS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_EMAIL_ADDRESS_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_STREET_ADDRESS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_STREET_ADDRESS_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_COMPANY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_COMPANY_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_POSTCODE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_POSTCODE_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_CITY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_CITY_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_STATE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_STATE_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_TELEPHONE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_TELEPHONE_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_PASSWORD_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_PASSWORD_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_CC_OWNER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='CC_OWNER_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_CC_NUMBER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='CC_NUMBER_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_REVIEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='REVIEW_TEXT_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_DISPLAY_BESTSELLERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MIN_DISPLAY_BESTSELLERS';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_DISPLAY_ALSO_PURCHASED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MIN_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_ENTRY_NICK_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='ENTRY_NICK_MIN_LENGTH';
UPDATE configuration SET val_function = '{"error":"TEXT_MIN_ADMIN_USER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":4}}}' WHERE configuration_key ='ADMIN_NAME_MINIMUM_LENGTH';


#val_function update for MAX values
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_ADDRESS_BOOK_ENTRIES_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_ADDRESS_BOOK_ENTRIES';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PAGE_LINKS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PAGE_LINKS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PAGE_LINKS_MOBILE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PAGE_LINKS_MOBILE';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SPECIAL_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SPECIAL_PRODUCTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_NEW_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_NEW_PRODUCTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_UPCOMING_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_UPCOMING_PRODUCTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_MANUFACTURERS_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_MANUFACTURERS_LIST';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_MUSIC_GENRES_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_MUSIC_GENRES_LIST';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RECORD_COMPANY_LIST_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_RECORD_COMPANY_LIST';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RECORD_COMPANY_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_RECORD_COMPANY_NAME_LEN';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_MUSIC_GENRES_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_MUSIC_GENRES_NAME_LEN';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_MANUFACTURERS_NAME_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_MANUFACTURER_NAME_LEN';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_NEW_REVIEWS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_NEW_REVIEWS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_REVIEWS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_RANDOM_SELECT_REVIEWS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_NEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_RANDOM_SELECT_NEW';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_SPECIALS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_RANDOM_SELECT_SPECIALS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_CATEGORIES_PER_ROW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_CATEGORIES_PER_ROW';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_NEW_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_NEW';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_BESTSELLERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_BESTSELLERS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_ALSO_PURCHASED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_ORDER_HISTORY_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_ORDER_HISTORY';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_CUSTOMER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_ORDERS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_ORDERS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_RESULTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_REPORTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_RESULTS_CATEGORIES_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_RESULTS_CATEGORIES';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_LISTING_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_LISTING';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_ROW_LISTS_OPTIONS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_ROW_LISTS_OPTIONS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_FEATURED';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_FEATURED_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_RANDOM_SELECT_FEATURED_PRODUCTS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_RANDOM_SELECT_FEATURED_PRODUCTS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SPECIAL_PRODUCTS_INDEX_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_SHOW_NEW_PRODUCTS_LIMIT_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='SHOW_NEW_PRODUCTS_LIMIT';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_ALL_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_ALL';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_LANGUAGE_FLAGS_COLUMNS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_LANGUAGE_FLAGS_COLUMNS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS';
UPDATE configuration SET val_function = '{"error":"TEXT_MAX_ADMIN_DISPLAY_SEARCH_RESULTS_EZPAGE_LENGTH","id":"FILTER_VALIDATE_INT","options":{"options":{"min_range":0}}}' WHERE configuration_key ='MAX_DISPLAY_SEARCH_RESULTS_EZPAGE';

#val_function update for email addresses
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE_SINGLE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}' WHERE configuration_key = 'EMAIL_FROM';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE_SINGLE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmail"]}}' WHERE configuration_key = 'STORE_OWNER_EMAIL_ADDRESS';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_ORDER_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_GV_CUSTOMER_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_GV_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='SEND_EXTRA_LOW_STOCK_EMAILS_TO';
UPDATE configuration SET val_function = '{"error":"TEXT_EMAIL_ADDRESS_VALIDATE","id":"FILTER_CALLBACK","options":{"options":["configurationValidation","sanitizeEmailNullOK"]}}' WHERE configuration_key ='CONTACT_US_LIST';


#
# Table structure for table 'count_product_views'
#
CREATE TABLE IF NOT EXISTS count_product_views (
  product_id int(11) NOT NULL default 0,
  language_id int(11) NOT NULL default 1,
  date_viewed date NOT NULL,
  views int(11) default NULL,
  PRIMARY KEY (product_id, language_id, date_viewed),
  KEY idx_pid_lang_date_zen (language_id, product_id, date_viewed),
  KEY idx_date_pid_lang_zen (date_viewed, product_id, language_id)
) ENGINE=MyISAM;


ALTER TABLE admin_profiles MODIFY profile_name varchar(191) NOT NULL default '';
ALTER TABLE admin_profiles ADD UNIQUE idx_profile_name_zen (profile_name);

ALTER TABLE admin_activity_log MODIFY attention MEDIUMTEXT;

# ZC 156 changed these fields in the install but not in the upgrade
ALTER TABLE upgrade_exceptions MODIFY sql_file varchar(128) default NULL;
ALTER TABLE upgrade_exceptions MODIFY reason TEXT;
ALTER TABLE upgrade_exceptions MODIFY errordate datetime default NULL;

# ZC 156 upgrade did these operations, which did not work.
# Adding for people who upgraded to 1.5.6, and are now upgrading again
ALTER TABLE customers_basket DROP final_price;
ALTER TABLE ezpages DROP languages_id;
ALTER TABLE ezpages DROP pages_title;
ALTER TABLE ezpages DROP pages_html_text;

# ZC 155 upgrade missed these operations
ALTER TABLE admin_activity_log ADD logmessage mediumtext NOT NULL;
ALTER TABLE admin_activity_log ADD severity varchar(9) NOT NULL DEFAULT 'info';

# modify existing tables for 1.5.7g
ALTER TABLE layout_boxes ADD plugin_details varchar(100) NOT NULL default '';
ALTER TABLE customers ADD registration_ip varchar(45) NOT NULL default '';
ALTER TABLE customers ADD last_login_ip varchar(45) NOT NULL default '';
ALTER TABLE customers_info ADD INDEX idx_date_created_cust_id_zen (customers_info_date_account_created, customers_info_id);

ALTER TABLE orders_products MODIFY products_name varchar(191) NOT NULL default '';
ALTER TABLE products_description MODIFY products_name varchar(191) NOT NULL default '';

ALTER TABLE orders MODIFY customers_country varchar(64) NOT NULL default '';
ALTER TABLE orders MODIFY delivery_country varchar(64) NOT NULL default '';
ALTER TABLE orders MODIFY billing_country varchar(64) NOT NULL default '';
ALTER TABLE orders ADD shipping_tax_rate decimal(15,4) DEFAULT NULL AFTER order_tax; 

ALTER TABLE products_options ADD products_options_comment_position smallint(2) NOT NULL default '0' AFTER products_options_comment;

ALTER TABLE coupon_email_track MODIFY emailed_to varchar(96) default NULL;

# Remove deprecated defines
DELETE FROM configuration WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';
DELETE FROM configuration_language WHERE configuration_key = 'CATEGORIES_SPLIT_DISPLAY';
DELETE FROM configuration WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';
DELETE FROM configuration_language WHERE configuration_key = 'CUSTOMERS_AUTHORIZATION_PRICES_OFF';
DELETE FROM configuration WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';
DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_FRIENDLY_ERRORS';
DELETE FROM configuration WHERE configuration_key = 'EMAIL_LINEFEED';
DELETE FROM configuration_language WHERE configuration_key = 'EMAIL_LINEFEED';
DELETE FROM configuration WHERE configuration_key = 'CC_CVV_MIN_LENGTH';
DELETE FROM configuration_language WHERE configuration_key = 'CC_CVV_MIN_LENGTH';
DELETE FROM configuration WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';
DELETE FROM configuration_language WHERE configuration_key = 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';

#### Added in case was missed on upgrades.  also modified to allow for IgnoreDups in case someone had earlier version installed. IgnoreDups preselected
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Admin)?', 'REPORT_ALL_ERRORS_ADMIN', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', 10, 40, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors (Store)?', 'REPORT_ALL_ERRORS_STORE', 'IgnoreDups', 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', 10, 41, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),');
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES ('Report All Errors: Backtrace on Notice Errors?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 'No', 'Include backtrace information on &quot;Notice&quot; errors?  These are usually isolated to the identified file and the backtrace information just fills the logs. Default (<b>No</b>).', 10, 42, now(), NULL, 'zen_cfg_select_option(array(\'Yes\', \'No\'),');
UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart admin\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_ADMIN';
UPDATE configuration SET configuration_description = 'Do you want create debug-log files for <b>all</b> PHP errors, even warnings, that occur during your Zen Cart store\'s processing?  If you want to log all PHP errors <b>except</b> duplicate-language definitions, choose <em>IgnoreDups</em>.<br /><br /><strong>Note:</strong> Choosing \'Yes\' is not suggested for a <em>live</em> store, since it will reduce performance significantly!', set_function = 'zen_cfg_select_option(array(\'Yes\', \'No\', \'IgnoreDups\'),' WHERE configuration_key = 'REPORT_ALL_ERRORS_STORE';
### New since 1.5.7g - Log Manager
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Manager: Days to Keep', 'LOG_MANAGER_KEEP_DAYS', '0', 'Enter the maximum number of <em>days</em> to keep any file with a <code>.log</code> file extension in your store\'s <b>logs</b> directory.<br><br>If the value you enter is non-zero, then any files created prior to that relative date will be <b>permanently removed</b> from your store\'s file-system.<br>', 10, 42, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Manager: Logs to Keep', 'LOG_MANAGER_KEEP_THESE', 'zcInstall', 'Enter a comma-separated list of name-prefixes for any log-files that you want to <b><i>keep</i></b>, regardless of their age.<br><br>The values you enter are <em>case-sensitive</em>, i.e. <em>zcInstall</em> is different than <em>zcinstall</em>.  The default setting (<code>zcInstall</code>) results in any file matching <code>/logs/zcInstall*.log</code> being kept regardless of its creation date.<br>', 10, 43, now());


# New Plugin tables
# New since 157g

# --------------------------------------------------------

#
# Table structure for table 'plugin_control'
#

DROP TABLE IF EXISTS plugin_control;
CREATE TABLE plugin_control (
  unique_key varchar(40) NOT NULL,
  name varchar(64) NOT NULL default '',
  description text,
  type varchar(11) NOT NULL default 'free',
  managed tinyint(1) NOT NULL default 0,
  status tinyint(1) NOT NULL default 0,
  author varchar(64) NOT NULL,
  version varchar(10),
  zc_versions text NOT NULL,
  zc_contrib_id int(11),
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_control_versions'
#

DROP TABLE IF EXISTS plugin_control_versions;
CREATE TABLE plugin_control_versions (
  unique_key varchar(40) NOT NULL,
  version varchar(10),
  author varchar(64) NOT NULL,
  zc_versions text NOT NULL,
  infs tinyint(1) NOT NULL default 0,
  PRIMARY KEY  (unique_key, version)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups'
#

DROP TABLE IF EXISTS plugin_groups;
CREATE TABLE plugin_groups (
  unique_key varchar(20) NOT NULL,
  PRIMARY KEY  (unique_key)
) ENGINE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table 'plugin_groups_description'
#

DROP TABLE IF EXISTS plugin_groups_description;
CREATE TABLE plugin_groups_description (
  plugin_group_unique_key varchar(20) NOT NULL,
  language_id int(11) NOT NULL default 1,
  name varchar(64) NOT NULL default '',
  PRIMARY KEY  (plugin_group_unique_key,language_id)
) ENGINE=MyISAM;

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES  ('plugins', 'BOX_MODULES_PLUGINS', 'FILENAME_PLUGIN_MANAGER', '', 'modules', 'Y', 4);
######
# Carry forward from v1.5.6 for early-adopters
UPDATE configuration SET date_added='0001-01-01' where date_added < '0001-01-01';

#####
# delete unused table google_analytics_languages
DROP TABLE IF EXISTS google_analytics_languages;

#####
# delete unused admin pages and admin menus
DELETE FROM admin_pages WHERE main_page = 'FILENAME_GERMAN';
DELETE FROM admin_menus WHERE menu_key = 'german1';


### New since 157
# Incorporate setting for Column-Grid-Layout template control
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 'Select the number of columns of products to show per row in the product listing.<br>Recommended: 3<br>1=[rows] mode.', '8', '45', NULL, now(), NULL, NULL);

### New since 157
INSERT IGNORE INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Disabled Product Status for Search Engines', 'DISABLED_PRODUCTS_TRIGGER_HTTP200', 'false', 'When a product is marked Disabled (status=0) but is not deleted from the database, should Search Engines still show it as Available?<br>eg:<br>True = Return HTTP 200 response<br>False = Return HTTP 410<br>(Deleting it will return HTTP 404)<br><b>Default: false</b>', '9', '10', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());


### remove google analytics settings and configuration_group and admin page

DELETE FROM admin_pages WHERE page_key='configProdGoogleAnalytics';
DELETE FROM admin_pages WHERE page_key='configGoogleAnalytics';

DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_ENABLED';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_SKU_CODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_DIR';
DELETE FROM configuration WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LABEL';

DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_ENABLED';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_UACCT';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TARGET';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_AFFILIATION';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_SKU_CODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_ACTIVE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_IDNUM';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_CONVERSION_LANG';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_TRACKING_TYPE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE_ENABLED';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CUSTOM_CODE';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_DIR';
DELETE FROM configuration_language WHERE configuration_key = 'GOOGLE_ANALYTICS_CONVERSION_LABEL';

DELETE FROM configuration_group WHERE configuration_group_title = 'Google Analytics';

### New configuration_group spam protection since 157 

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Spam Protection Settings', 'Spam Protection Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

### New configs for spam protection

#Spam Protection settings - new since 1.5.7 - replaces google analytics
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Spam Protection Version Info', 'SPAM_VERSION', '1.0.0', 'Since version 1.5.7 an improved honeypot spam protection is integrated in the German Zen Cart version. The pages Contact, Registration, Ask a question and Write review are equipped with 2 additional hidden form fields. Spambots try to fill in all existing form fields, if hidden ones are filled in, it can only be spam. To prevent spambots from adding the names of the hidden fields to their lists, the names of these fields are automatically changed on a regular basis in the time frame you set below.<br>This is a significant improvement over older Zen Cart versions, but please note that even this solution cannot provide 100% spam protection.<br>Should you continue to receive spam via the store contact forms, you must secure the forms with a real captcha.', @gid, 1, now(), now(), NULL, 'zen_cfg_read_only('),
('Hidden radio field name', 'SPAM_TEST_TEXT', 'NVMBQgxicl', 'Current name of the hidden input field', @gid, 2, now(), now(), NULL, NULL),
('Hidden radio field name', 'SPAM_TEST_USER', 'lBv617bFNo', 'Current name of the hidden radio button field', @gid, 3, now(), now(), NULL, NULL),
('Number of days for the name change', 'SPAM_CHANGE_DAYS', '10', 'Set here the number of days after which the above named fields should be renamed automatically.<br>Default: 10', @gid, 4, now(), now(), NULL, NULL);

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Spamschutz Einstellungen', 'Spamschutz Einstellungen', '1', '1');


INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configSpamSettings','BOX_CONFIGURATION_SPAM_PROTECTION','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);

INSERT INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES
('Spamschutz', 'SPAM_VERSION', 43, 'Seit Version 1.5.7 ist in der deutschen Zen Cart Version ein verbesserter Honeypot Spamschutz integriert. Die Seiten Kontakt, Registrierung, Frage zum Artikel und Bewertung schreiben sind mit 2 zusätzlichen versteckten Formularfeldern ausgestattet. Spambots versuchen alle vorhandenen Formularfelder auszufüllen, werden versteckte ausgefüllt, kann es sich nur um Spam handeln. Damit Spambots die Namen der versteckten Felder nicht in ihre Listen aufnehmen können, werden die Namen dieser Felder automatisch regelmäßig gewechselt in dem Zeitrahmen, den Sie unten einstellen.<br>Das ist eine deutliche Verbesserung gegenüber älteren Zen Cart Versionen, bitte beachten Sie aber, dass auch diese Lösung keinen 100% Spamschutz bieten kann.<br>Sollten Sie weiterhin Spam über die Shop Kontaktformulare bekommen, müssen Sie die Formulare mit einem echten Captcha absichern.', now(), now()),
('Name des versteckten Input Feldes', 'SPAM_TEST_TEXT', 43, 'Aktueller Name des versteckten Input Feldes', now(), now()),
('Name des versteckten Radio Buttons', 'SPAM_TEST_USER', 43, 'Aktueller Name des versteckten Radio Buttons', now(), now()),
('Anzahl der Tage für den Namenswechsel', 'SPAM_CHANGE_DAYS', 43, 'Stellen Sie hier die Anzahl der Tage ein, nach denen die oben benannten Felder automatisch umbenannt werden sollen.<br/>Voreinstellung: 10', now(), now());


# Rename 'Facebook/Open Graph/Microdata' to just 'Open Graph/Microdata'
UPDATE configuration_group set configuration_group_title = 'Open Graph/Microdata', configuration_group_description = 'Open Graph/Microdata' where configuration_group_title = 'Facebook/Open Graph/Microdata';

# Delete Facebook Like Buttons Configs
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_STATUS';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_METHOD';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ALIGNMENT';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_SHOW_FACES';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ACTION';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_FONT';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_WIDTH';
DELETE FROM configuration WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_SEND';

DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_METHOD';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ALIGNMENT';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_LAYOUT_STYLE';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_SHOW_FACES';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_ACTION';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_FONT';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_COLOR_SCHEME';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_WIDTH';
DELETE FROM configuration_language WHERE configuration_key = 'FACEBOOK_LIKE_BUTTON_SEND';


# update Image Handler Version to 5.3.3
UPDATE configuration SET configuration_value = '5.3.4' WHERE configuration_key = 'IH_VERSION';

# update display logs version to 3.0.2
UPDATE configuration SET configuration_value = '3.0.2' WHERE configuration_key = 'DISPLAY_LOGS_VERSION';

# update cross sell version to 2.0.2
UPDATE configuration SET configuration_value = '2.0.2' WHERE configuration_key = 'XSELL_VERSION';

### change cross sell table structure ###
ALTER TABLE products_xsell
MODIFY COLUMN ID int(11) NOT NULL auto_increment,
MODIFY COLUMN products_id int(11) NOT NULL,
MODIFY COLUMN xsell_id int(11) NOT NULL,
MODIFY COLUMN sort_order int(11) NOT NULL DEFAULT 1;

# new tables customer_groups and customer_to_groups since 1.5.7g

INSERT IGNORE INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order)
VALUES ('customerGroups', 'BOX_CUSTOMERS_CUSTOMER_GROUPS', 'FILENAME_CUSTOMER_GROUPS', '', 'customers', 'Y', 3);

CREATE TABLE customer_groups (
  group_id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_name varchar(191) NOT NULL,
  group_comment varchar(255),
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (group_id),
  UNIQUE KEY idx_groupname_zen (group_name)
);
CREATE TABLE customers_to_groups (
  id int UNSIGNED NOT NULL AUTO_INCREMENT,
  group_id int UNSIGNED NOT NULL,
  customer_id int UNSIGNED NOT NULL,
  date_added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY idx_custid_groupid_zen (customer_id, group_id),
  KEY idx_groupid_custid_zen (group_id, customer_id)
);

###########################################################################
# Admin Layout - Useful Links 1.0.0 Install - 2024-02-14 - new since 1.5.7h
###########################################################################

INSERT INTO configuration_group (configuration_group_title, configuration_group_description, sort_order, visible) VALUES
('Admin Layout', 'Admin Layout Settings', '1', '1');
SET @gid=last_insert_id();
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES 
('Useful Link 1 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_1_TEXT', 'Link 1', 'Enter the text for Useful Link 1:<br>', @gid, 1,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 1 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_1_URL', 'https://www.google.at','Enter the URL for Useful Link 1:<br>', @gid, 2, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 2 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_2_TEXT', 'Link 2', 'Enter the text for Useful Link 2:<br>', @gid, 3,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 2 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_2_URL', 'https://www.google.at','Enter the URL for Useful Link 2:<br>', @gid, 4, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 3 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_3_TEXT', 'Link 3', 'Enter the text for Useful Link 3:<br>', @gid, 5,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 3 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_3_URL', 'https://www.google.at','Enter the URL for Useful Link 3:<br>', @gid, 6, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 4 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_4_TEXT', 'Link 4', 'Enter the text for Useful Link 4:<br>', @gid, 7,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 4 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_4_URL', 'https://www.google.at','Enter the URL for Useful Link 4:<br>', @gid, 8, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 5 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_5_TEXT', 'Link 5', 'Enter the text for Useful Link 5:<br>', @gid, 9,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 5 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_5_URL', 'https://www.google.at','Enter the URL for Useful Link 5:<br>', @gid, 10, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 6 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_6_TEXT', 'Link 6', 'Enter the text for Useful Link 6:<br>', @gid, 11,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 6 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_6_URL', 'https://www.google.at','Enter the URL for Useful Link 6:<br>', @gid, 12, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 7 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_7_TEXT', 'Link 7', 'Enter the text for Useful Link 7:<br>', @gid, 13,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 7 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_7_URL', 'https://www.google.at','Enter the URL for Useful Link 7:<br>', @gid, 14, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 8 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_8_TEXT', 'Link 8', 'Enter the text for Useful Link 8:<br>', @gid, 15,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 8 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_8_URL', 'https://www.google.at','Enter the URL for Useful Link 8:<br>', @gid, 16, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 9 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_9_TEXT', 'Link 9', 'Enter the text for Useful Link 9:<br>', @gid, 17,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 9 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_9_URL', 'https://www.google.at','Enter the URL for Useful Link 9:<br>', @gid, 18, NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 10 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_10_TEXT', 'Link 10', 'Enter the text for Useful Link 10:<br>', @gid, 19,  NOW(), NULL, 'zen_cfg_textarea('),
('Useful Link 10 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_10_URL', 'https://www.google.at','Enter the URL for Useful Link 10:<br>', @gid, 20, NOW(), NULL, 'zen_cfg_textarea(')
;

##############################
# Add values for German admin
##############################

INSERT INTO configuration_group (configuration_group_id, language_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES 
(@gid, 43, 'Admin Layout', 'Einstellungen für das Admin Layout', '1', '1');


REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Nützlicher Link 1 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_1_TEXT', 'Geben Sie den Text für den Nützlichen Link 1 ein:<br>',	43),
('Nützlicher Link 1 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_1_URL', 'Geben Sie die URL für den Nützlichen Link 1 ein:<br>',	43),
('Nützlicher Link 2 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_2_TEXT', 'Geben Sie den Text für den Nützlichen Link 2 ein:<br>',	43),
('Nützlicher Link 2 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_2_URL', 'Geben Sie die URL für den Nützlichen Link 2 ein:<br>',	43),
('Nützlicher Link 3 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_3_TEXT', 'Geben Sie den Text für den Nützlichen Link 3 ein:<br>',	43),
('Nützlicher Link 3 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_3_URL', 'Geben Sie die URL für den Nützlichen Link 3 ein:<br>',	43),
('Nützlicher Link 4 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_4_TEXT', 'Geben Sie den Text für den Nützlichen Link 4 ein:<br>',	43),
('Nützlicher Link 4 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_4_URL', 'Geben Sie die URL für den Nützlichen Link 4 ein:<br>',	43),
('Nützlicher Link 5 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_5_TEXT', 'Geben Sie den Text für den Nützlichen Link 5 ein:<br>',	43),
('Nützlicher Link 5 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_5_URL', 'Geben Sie die URL für den Nützlichen Link 5 ein:<br>',	43),
('Nützlicher Link 6 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_6_TEXT', 'Geben Sie den Text für den Nützlichen Link 6 ein:<br>',	43),
('Nützlicher Link 6 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_6_URL', 'Geben Sie die URL für den Nützlichen Link 6 ein:<br>',	43),
('Nützlicher Link 7 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_7_TEXT', 'Geben Sie den Text für den Nützlichen Link 7 ein:<br>',	43),
('Nützlicher Link 7 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_7_URL', 'Geben Sie die URL für den Nützlichen Link 7 ein:<br>',	43),
('Nützlicher Link 8 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_8_TEXT', 'Geben Sie den Text für den Nützlichen Link 8 ein:<br>',	43),
('Nützlicher Link 8 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_8_URL', 'Geben Sie die URL für den Nützlichen Link 8 ein:<br>',	43),
('Nützlicher Link 9 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_9_TEXT', 'Geben Sie den Text für den Nützlichen Link 9 ein:<br>',	43),
('Nützlicher Link 9 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_9_URL', 'Geben Sie die URL für den Nützlichen Link 9 ein:<br>',	43),
('Nützlicher Link 10 - Text', 'ADMIN_LAYOUT_USEFUL_LINK_10_TEXT', 'Geben Sie den Text für den Nützlichen Link 10 ein:<br>',	43),
('Nützlicher Link 10 - URL', 'ADMIN_LAYOUT_USEFUL_LINK_10_URL', 'Geben Sie die URL für den Nützlichen Link 10 ein:<br>',	43)
;


###################################
# Register for Admin Access Control
###################################

INSERT INTO admin_pages (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order)
VALUES ('configAdminLayout','BOX_CONFIGURATION_ADMIN_LAYOUT','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid);

INSERT INTO admin_pages (page_key, language_key, main_page, page_params, menu_key, display_on_menu, sort_order) VALUES
('GermanHelpPage', 'GERMAN_HELP_PAGE', 'FILENAME_GERMAN_HELP', '', 'extras', 'N', 99);

#############
# lets replace all german config translations with the latest from 1.5.7

REPLACE INTO configuration_language (configuration_title, configuration_key, configuration_language_id, configuration_description, last_modified, date_added) VALUES

# Adminmenü ID 1 - Mein Shop
('Shopname', 'STORE_NAME', 43, 'Geben Sie hier einen Namen für Ihren Shop ein', now(), now()),
('Shopinhaber', 'STORE_OWNER', 43, 'Geben Sie hier einen Namen des Shopinhabers ein', now(), now()),
('Telefonnummer des Kundenservice', 'STORE_TELEPHONE_CUSTSERVICE', 43, 'Geben Sie hier die Telefonnumer an, unter der Kunden Ihren Kundenservice erreichen können.', now(), now()),
('Land', 'STORE_COUNTRY', 43, 'Geben Sie hier das Land an, in dem der Shop betrieben wird<br /><br /><strong><b>HINWEIS: Bitte nicht vergessen, ggf. das Bundesland des Shops zu aktualisieren</b></strong>', now(), now()),
('Zone/Bundesland', 'STORE_ZONE', 43, 'Geben Sie hier die Zone / das Bundesland an, in dem der Shop betrieben wird', now(), now()),
('Erwartete Artikel: Sortierung', 'EXPECTED_PRODUCTS_SORT', 43, 'Wie sollen die Artikel in der Box "Erwartete Artikel" sortiert werden?<br>ASC = Aufsteigend, DESC=Absteigend', now(), now()),
('Erwartete Artikel: Sortierung', 'EXPECTED_PRODUCTS_FIELD', 43, 'Nach welcher Spalte soll sortiert werden?<br>product_name = Artikelname, date_expected = Erscheinungsdatum', now(), now()),
('Automatisch zur Standardwährung der Sprache wechseln', 'USE_DEFAULT_LANGUAGE_CURRENCY', 43, 'Soll automatisch zu der zur Sprache passenden Währung gewechselt werden?', now(), now()),
('Sprachauswahl', 'LANGUAGE_DEFAULT_SELECTOR', 43, 'Default Sprache wird durch Shop festgelegt oder die Browsereinstellung?<br /><br />Standard: Shop', now(), now()),
('Suchmaschinenfeste (Kurz-)URLs verwenden (noch in der Entwicklung)', 'SEARCH_ENGINE_FRIENDLY_URLS', 43, 'Suchmaschinenfeste URLs (KurzURL) für alle Links im Shop verwenden', now(), now()),
('Warenkorb nach Hinzufügen eines Artikels anzeigen', 'DISPLAY_CART', 43, 'Soll der Warenkorb nach dem Hinzufügen eines Artikels angezeigt werden? (HINWEIS: false= nein, zurück zum Artikel)', now(), now()),
('Standard Suchoperator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 43, 'Standard Suchoperator<br />"AND": Wörter, die vorkommen müssen<br />"OR": Wörter, die vorkommen können<br />"NOT": Wörter, die nicht vorkommen sollen', now(), now()),
('Shopadresse und Telefonnummer', 'STORE_NAME_ADDRESS', 43, 'Diese Adresse wird auf ausdruckbaren Dokumenten und online im Shop angezeigt', now(), now()),
('Zähler hinter Kategorienamen anzeigen', 'SHOW_COUNTS', 43, 'Soll der Zähler, der die Anzahl von Artikel in der jeweiligen Kategorie anzeigt, hinter dem Kategorienamen sichtbar sein?', now(), now()),
('Dezimalstellen bei Steuern', 'TAX_DECIMAL_PLACES', 43, 'Wieviele Dezimalstellen sollen bei den Steuern angezeigt werden?', now(), now()),
('Bruttopreise im Shop verwenden', 'DISPLAY_PRICE_WITH_TAX', 43, 'Sollen die Bruttopreise im Shop angezeigt werden?<br />true= Bruttopreise (inkl. Steuern)<br />false= Nettopreise (exkl. Steuern)', now(), now()),
('Preise inkl. Steuern im Adminbereich anzeigen', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 43, 'Preise inkl. Steuern (true) oder die Steuern am Ende (false) im Adminbereich anzeigen(Rechnungen)', now(), now()),
('Basis der Steuern für Artikel', 'STORE_PRODUCT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Artikeln berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone / des Bundeslandes des Shops liegt', now(), now()),
('Basis der Steuern für Versand', 'STORE_SHIPPING_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern bei Versandkosten berechnet werden? Die Optionen sind:<br />Versand (Shipping) - Berechnung erfolgt auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - Berechnung erfolgt auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - Berechnung erfolgt auf Basis der Shopadresse, wenn die Versand-/Rechnungsadresse innerhalb der Zone / des Bundeslandes des Shops liegt (kann vom Versandmodul überschrieben werden)', now(), now()),
('Steuern auch bei 0% anzeigen?', 'STORE_TAX_DISPLAY_STATUS', 43, 'Steuer auch dann anzeigen, wenn diese 0% betragen?<br>0= NEIN<br>1= JA ', now(), now()),
('Gesplittete Steueranzeige', 'SHOW_SPLIT_TAX_CHECKOUT', 43, 'Wenn Artikel mit verschiedenen Steuersätzen bestellt werden, soll dann im Bestellvorgang jeder Steuersatz in einer eigenen Zeile ausgewiesen werden?', now(), now()),
('Timeout der Admin-Sitzungen (in Sekunden)', 'SESSION_TIMEOUT_ADMIN', 43, 'Geben Sie die Zeit in Sekunden an. Standard=900<br /> Beispiel: 900= 15 Minuten<br /><b>WICHTIGER HINWEIS: Wenn Sie diesen Wert auf über 900 erHöhen, dann erfüllt Ihr Shop die Richtlinien der PA-DSS Zertifizierung nicht mehr!</b><br><br>Eine zu geringe Zeitangabe kann zu Problemen bei der Bearbeitung von Artikeln führen.', now(), now()),
('Maximale Zeit für die Ausführung von Prozessen', 'GLOBAL_SET_TIME_LIMIT', 43, 'Geben Sie die Zeit in Sekunden an. Standard=60<br />Beispiel: 60= 1 Minute<br /><br />HINWEIS: Diesen Wert sollte nur geändert werden, wenn es Probleme bei der Ausführung von Prozessen gibt.', now(), now()),
('Auf neue Version von Zen Cart prüfen', 'SHOW_VERSION_UPDATE_IN_HEADER', 43, 'Automatische Überprüfung auf eine neuere Version von Zen Cart bei der Anmeldung im Admin-Bereich. Zeigt dies dann im Header des Admin Bereichs an. Wenn dieses Feature aktiviert ist, kann es manchmal zu GeschwindigkeitseinbuCen im Admin Bereich kommen.', now(), now()),
('Art des Shops', 'STORE_STATUS', 43, 'Welcher Art ist Ihr Shop:<br />0= Normaler Shop<br />1= Showroom ohne Preise<br />2= Showroom mit Preisen<br> Showroom = Artikel werden angezeigt, können aber nicht gekauft werden!', now(), now()),
('Server Onlinestatus anzeigen', 'DISPLAY_SERVER_UPTIME', 43, 'Zeigt die Onlinezeit des Servers an.<br />HINWEIS: Das Aktivieren diese Einstellung kann bei einigen Server Einträge in den Fehlerprotokollen verursachen.  (true = anzeigen, false = nicht anzeigen)', now(), now()),
('Überprüfung auf fehlende Seiten', 'MISSING_PAGE_CHECK', 43, 'Zen Cart kann das Fehlen von Seiten in einer URL erkennen und leitet dann bei Bedarf auf die Startseite weiter.<br />für ein Debugging kann diese Funktion deaktiviert werden. (true = Auf fehlende Seiten prüfen, false = Keine Überprüfung auf fehlende Seiten)', now(), now()),
('cURL Proxy Status', 'CURL_PROXY_REQUIRED', 43, 'Verwenden Sie einen Web-Provider, der für die Kommunikation mit externen Seiten cURL via Proxy verwendet?', now(), now()),
('cURL Proxy Adresse', 'CURL_PROXY_SERVER_DETAILS', 43, 'Wenn Sie einen Provider einsetzen, der cURL verwendet (wie z.B. <em>GoDaddy</em> oder <em>Dreamhost</em>), welcher über einen Proxy via cURL mit externen Seiten kommuniziert, dann geben Sie hier die Adresse des Proxy Servers ein.<br />Format: adresse:port<br />z.B.: für GoDaddy geben Sie folgendes ein: 64.202.165.130:3128', now(), now()),
('HTML Editor', 'HTML_EDITOR_PREFERENCE', 43, 'Welchen HTML Editor wollen Sie zur Bearbeitung von E-Mails, Newslettern und Artikelbeschreibungen im Adminbereich verwenden?', now(), now()),
('phpBB Forumsynchronisierung aktivieren?', 'PHPBB_LINKS_ENABLED', 43, 'Soll Zen Cart neue Kundenkonten mit dem - bereits installierten - phpBB Forum synchronisieren?', now(), now()),
('Kategoriezähler im Adminbereich anzeigen', 'SHOW_COUNTS_ADMIN', 43, 'Soll der Kategoriezähler im Adminbereich angezeigt werden?', now(), now()),
('Multiplikator für Fremdwährungen', 'CURRENCY_UPLIFT_RATIO', 43, 'Wie hoch soll der Faktor für den Aufschlag von Fremdwährungen in Ihrem Shop bei der Aktualisierung der Währungskurse sein?<br /><br />BESCHREIBUNG:<br />Der Umrechnungskurs wird vom externen Wechselkurs-Server während der Abfrage festgestellt und mit Ihrem Shop abgeglichen.<br />Wird als Faktor z.B. der Wert <em>2.00</em> verwendet, werden Fremdwährungen mit diesem Wert multipliziert.<br /><br />BEISPIEL:<br />Die Währung <em>EURO</em> ist als <em>Standard</em> definiert:<br />Kurs: EURO = 1.00000000; USD = 1.40000000<br />Als Faktor wird <em>2.00</em> verwendet.<br />Ergebnis: Euro = 1.00000000; USD = 2.80000000<br /><br /><br />Standard: 1.05', now(), now()),
('EU Länder', 'EU_COUNTRIES_FOR_LAST_STEP', 43, 'Tragen Sie hier die Mitgliedsstaaten der Europäischen Union ein. Wenn an Länder geliefert wird, die nicht in dieser Liste stehen, dann erscheint im letzten Schritt des Bestellvorgangs ein Hinweis auf mögliche ZollGebühren. Zweistellige ISO Codes mit Komma getrennt.<br><br>Falls Sie Ihren Shop in der Schweiz betreiben, dann tragen Sie hier nur CH ein, so dass der Hinweis dann bei Lieferungen ausserhalb der Schweiz angezeigt wird!', now(), now()),
('Admin Timeout gemäss PA-DSS Zertifizierung?', 'PADSS_ADMIN_SESSION_TIMEOUT_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die Adminsitzung nach 15 Minuten Inaktivität beendet wird. Nach 15 Minuten Inaktivität werden Sie aus der Administration ausgeloggt. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Admin Passwortregeln gemäss PA-DSS Zertifizierung?', 'PADSS_PWD_EXPIRY_ENFORCED', 43, 'Der Shop erfüllt nur dann die Richtlinien einer PA-DSS Zertifizierung, wenn die AdminpassWörter alle 90 Tage geändert werden und dabei nicht die 4 letzten PassWörter wiederverwendet werden dürfen. Wenn Sie das nicht wollen, dann deaktivieren Sie hier diese Einstellung.<br><b>Achtung: Durch das Deaktivieren dieser Einstellung erfüllt Ihr Shop die PA-DSS Richtlinien nicht mehr und ist daher für eine Zertifizierung ungeeignet!</b>', now(), now()),
('Verlinkte Kategorien im Adminbereich anzeigen', 'SHOW_CATEGORY_PRODUCTS_LINKED_STATUS', 43, 'Soll im Adminbereich angezeigt werden, wenn Artikel auch in anderen Kategorien verlinkt sind (gelbes Symbol neben dem Artikel)?', now(), now()),
('PA-DSS Ajax Checkout?', 'PADSS_AJAX_CHECKOUT', 43, 'PA-DSS Compliance erfordert, dass für manche integrierte Zahlungsmodule Ajax zum Laden der Bestellbestätigungsseite verwendet wird. Das wird zwar nur geschehen, falls solche speziellen Zahlungsmodule verwendet werden, dennoch bevorzugen Sie vielleicht den traditionellen Checkout. <strong>Wenn Sie diese Einstellung deaktivieren, dann erfüllt Ihr Shop nicht mehr die PA-DSS Vorgaben.</strong>', now(), now()),
('Aktualisierung der Wechselkurse: Primäre Quelle', 'CURRENCY_SERVER_PRIMARY', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Primäre Quelle)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),
('Aktualisierung der Wechselkurse: Sekundäre Quelle', 'CURRENCY_SERVER_BACKUP', 43, 'Von welchem Server sollen die Kurse für das Update der Währungen bezogen werden? (Sekundäre Quelle falls erster Server nicht erreichbar)<br><br>Weitere Quellen können durch Plugins hinzugefügt werden.', now(), now()),
('Voreinstellung für Kundenbenachrichtigung beim Update einer Bestellung', 'NOTIFY_CUSTOMER_DEFAULT', 43, 'Was soll beim Aktualisieren einer Bestellung bezüglich Kundenbenachrichtigung voreingestellt sein?<br><br>1 = Email = Kunde wird über die Aktualisierung per Email informiert<br><br>2 = No Email = Es wird bei der Aktualisierung kein Mail an den Kunden geschickt<br><br>3 = Hide = Es wird kein Email geschickt und der Eintrag in der Bestellhistorie ist für den Kunden nicht sichtbar', now(), now()),
('Metatags in der Artikelsuche einbeziehen?', 'ADVANCED_SEARCH_INCLUDE_METATAGS', 43, 'Sollen die für einen Artikel definierten Meta Tag Keywords und Meta Tag Beschreibungen in der Erweiterten Suche miteinbezogen werden?', now(), now()),
('Admin <em>Login als Kunde</em>: Nur für einen Admin erlaubt?', 'EMP_LOGIN_ADMIN_ID', 43, 'Wenn das Login als Kunde (auf der Seite Kunden) nur für einen ganz bestimmten Administrator erlaubt sein soll, dann geben Sie hier die ID dieses Administrators ein. Setzen Sie den Wert auf 0, um die Funktion <em>Einzelne Admin-ID</em> zu deaktivieren und nutzen Sie stattdessen die Einstellung für die berechtigten Admin Profile weiter unten.', now(), now()),
('Admin <em>Login als Kunde</em>: Automatisches Login?', 'EMP_LOGIN_AUTOMATIC', 43, 'Soll bei Click auf den Button Login als Kunde direkt als Kunde eingeloggt werden, ohne das Administratorpasswort eingeben zu müssen? ', now(), now()),
('Admin <em>Login als Kunde</em>: Nur für bestimmte Admin Profile erlaubt?', 'EMP_LOGIN_ADMIN_PROFILE_ID', 43, 'Geben Sie die Administrator-<em>Benutzerprofil-IDs</em> an, die die Funktion <em>Login als Kunde</em> auf der Kundenliste verwenden dürfen &mdash; alle Administratoren, die in diesen Profilen sind, sind zugelassen. Geben Sie den Wert als kommagetrennte Liste (dazwischenliegende Leerzeichen sind OK) von Admin-Profil-IDs ein, z. B. <b>1,2,3</b>. Setzen Sie den Wert auf 0, um die Funktion <em>Admin-Profile</em> zu deaktivieren und stattdessen das Login für einen einzelnen Admin weiter oben zu nutzen.<br><br><b>Voreinstellung: 0</b>', now(), now()),

# Adminmenü ID 2 - Minimale Werte
('Vorname', 'ENTRY_FIRST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Vornamen', now(), now()),
('Nachname', 'ENTRY_LAST_NAME_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Nachnamen', now(), now()),
('Geburtsdatum', 'ENTRY_DOB_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Geburtsdatum', now(), now()),
('E-Mail Adresse', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die E-Mail Adresse', now(), now()),
('Strasse', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Strasse', now(), now()),
('Firma', 'ENTRY_COMPANY_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Firma', now(), now()),
('Postleitzahl', 'ENTRY_POSTCODE_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Postleitzahl', now(), now()),
('Stadt', 'ENTRY_CITY_MIN_LENGTH', 43, 'Minimale Zeichenlänge der Stadt', now(), now()),
('Bundesland', 'ENTRY_STATE_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Bundesland', now(), now()),
('Telefonnummer', 'ENTRY_TELEPHONE_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Telefonnummer', now(), now()),
('Passwort', 'ENTRY_PASSWORD_MIN_LENGTH', 43, 'Minimale Zeichenlänge für das Passwort', now(), now()),
('Kreditkarteninhaber', 'CC_OWNER_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Namen des Kreditkarteninhabers', now(), now()),
('Kreditkartennummer', 'CC_NUMBER_MIN_LENGTH', 43, 'Minimale Zeichenlänge für die Kreditkartennummer', now(), now()),
('Zeichenlänge für Bewertungstexte', 'REVIEW_TEXT_MIN_LENGTH', 43, 'Minimale Zeichenlänge für den Text einer Bewertung', now(), now()),
('Bestseller', 'MIN_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller/Top Artikel sollen mindestens angezeigt werden?', now(), now()),
('Empfohlene Artikel', 'MIN_DISPLAY_ALSO_PURCHASED', 43, 'Minimale Anzahl der anzuzeigenden Artikel in der Box Empfohlene Artikel', now(), now()),
('Nickname', 'ENTRY_NICK_MIN_LENGTH', 43, 'Minimale Zeichenlänge für Nicknamen', now(), now()),
('Admin Username', 'ADMIN_NAME_MINIMUM_LENGTH', 43, 'Minimale Zeichenlänge für Admin Usernamen (sollte minimal 4 Zeichen oder mehr sein!)', now(), now()),

# Adminmenü ID 3 - Maximale Werte
('Adresseinträge im Adressbuch', 'MAX_ADDRESS_BOOK_ENTRIES', 43, 'Wieviele Adresseinträge dürfen Kunden in Ihrem Adressbuch haben?', now(), now()),
('Suchresultate pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS', 43, 'Wieviele Artikel sollen maximal in den Suchresultaten pro Seite angezeigt werden?', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Desktop)', 'MAX_DISPLAY_PAGE_LINKS', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation', now(), now()),
('"Vorherige - Nächste" Navigation: Seitenlinks (Mobil)', 'MAX_DISPLAY_PAGE_LINKS_MOBILE', 43, 'Anzahl der Seitenlinks in der "Vorherige - Nächste" Navigation auf Mobilgeräten (voruasgesetzt Ihr Template unterstützt spezielle Einstellungen für Mobilgeräte)', now(), now()),
('Anzuzeigende "Sonderangebote"', 'MAX_DISPLAY_SPECIAL_PRODUCTS', 43, 'Wieviele Sonderangebote sollen angezeigt werden?', now(), now()),
('Anzuzeigende "Neue Artikel"', 'MAX_DISPLAY_NEW_PRODUCTS', 43, 'Wieviele "Neue Artikel" sollen in den Kategorien angezeigt werden?', now(), now()),
('Anzuzeigende "Erwartete Artikel"', 'MAX_DISPLAY_UPCOMING_PRODUCTS', 43, 'Wieviele "erwartete Artikel" sollen angezeigt werden?', now(), now()),
('Hersteller - Listenfeld Grösse/Stil', 'MAX_MANUFACTURERS_LIST', 43, 'Anzahl der Hersteller, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Hersteller Liste - Produktüberprüfung', 'PRODUCTS_MANUFACTURERS_STATUS', 43, 'Der Hersteller wird nur dann in der Liste angezeigt wenn mindestens 1 Produkt von ihm Verfügbar ist.<br>0 = AUS<br>1 = EIN<br>Anmerkung: Ein Aktivieren dieser Einstellung kann bei Shops mit vielen Artikeln zu Performance-Einbussen führen.', now(), now()),
('Musik Genre - Listenfeld Grösse/Stil', 'MAX_MUSIC_GENRES_LIST', 43, 'Anzahl der Musik Genres, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Plattenfirma - Listenfeld Grösse/Stil', 'MAX_RECORD_COMPANY_LIST', 43, 'Anzahl der Plattenfirmen, die im Listenfeld angezeigt werden sollen. Bei einer Eingabe von 0 oder 1 wird eine Dropdown Liste angezeigt.', now(), now()),
('Länge der Namen von Plattenfirmen', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', 43, 'Wird in der Box "Plattenfirma" verwendet; Maximale Länge der anzuzeigenden Namen von Plattenfirmen. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Musik Genres', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', 43, 'Wird in der Box "Musik Genre" verwendet; Maximale Länge der anzuzeigenden Namen von Musik Genres. Längere Namen werden abgeschnitten.', now(), now()),
('Länge der Namen von Herstellern', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', 43, 'Wird in der Box "Hersteller" verwendet; Maximale Länge der anzuzeigenden Namen von Herstellern. Längere Namen werden abgeschnitten.', now(), now()),
('Neue Artikelbewertungen pro Seite', 'MAX_DISPLAY_NEW_REVIEWS', 43, 'Anzahl der Bewertungen auf jeder Seite', now(), now()),
('Box "Bewertungen": zufällige Artikel', 'MAX_RANDOM_SELECT_REVIEWS', 43, 'Wieviele Bewertungen sollen zufällig ausgewählt werden?<br> Unabhängig davon wird immer nur EINE in der Box "Bewertungen" angezeigt.', now(), now()),
('Box "Neue Artikel": zufällige Artikel', 'MAX_RANDOM_SELECT_NEW', 43, 'Wieviele neue Artikel sollen in der Box "Neue Artikel" zufällig angezeigt werden?', now(), now()),
('Box "Sonderangebot": zufällige Artikel', 'MAX_RANDOM_SELECT_SPECIALS', 43, 'Wieviele Sonderangebote sollen in der Box "Sonderangebote" zufällig angezeigt werden?', now(), now()),
('Kategorien pro Reihe', 'MAX_DISPLAY_CATEGORIES_PER_ROW', 43, 'Wieviele Kategorien sollen pro Reihe angezeigt werden?', now(), now()),
('Liste "Neue Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_NEW', 43, 'Wieviele Artikel sollen pro Seite in der Liste "Neue Artikel" angezeigt werden?', now(), now()),
('Box "Bestseller": Anzahl der Artikel', 'MAX_DISPLAY_BESTSELLERS', 43, 'Wieviele Bestseller sollen in der Box angezeigt werden?', now(), now()),
('Box "Empfohlene Artikel": Anzahl der Artikel', 'MAX_DISPLAY_ALSO_PURCHASED', 43, 'Wieviele Artikel sollen in der Box "Empfohlene Artikel angezeigt werden?', now(), now()),
('Box "Kürzlich bestellte Artikel" HINWEIS: Diese Box ist deaktiviert', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', 43, 'Wieviele Artikel sollen in der Box "Kürzlich bestellte Artikel" angezeigt werden?', now(), now()),
('Mein Konto: Anzahl Bestellungen pro Seite der Bestellhistorie', 'MAX_DISPLAY_ORDER_HISTORY', 43, 'Wieviele Bestellungen sollen pro Seite der Bestellhistorie in "Mein Konto" angezeigt werden?', now(), now()),
('Kunden pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', 43, 'Wieviele Kunden sollen pro Seite im Adminbereich --> Kunden --> Kunden angezeigt werden?', now(), now()),
('Bestellungen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', 43, 'Wieviele Bestellungen sollen pro Seite im Adminbereich unter --> Kunden --> Bestellungen angezeigt werden?', now(), now()),
('Artikel in Berichten pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', 43, 'Wieviele Artikel sollen Berichten/Statistiken (Adminbereich) pro Seite angezeigt werden?', now(), now()),
('Artikel in Kategorien pro Seite', 'MAX_DISPLAY_RESULTS_CATEGORIES', 43, 'Wieviele Artikel sollen im Adminbereich --> Artikel & Kategorien in den jeweiligen Kategorien pro Seite angezeigt werden?', now(), now()),
('Artikelliste: Anzahl der Artikel', 'MAX_DISPLAY_PRODUCTS_LISTING', 43, 'Wieviele Artikel in der Artikelliste der jeweiligen Kategorie im Shop angezeigt werden?', now(), now()),
('Artikelattribute: Ansicht Attributnamen und -werte', 'MAX_ROW_LISTS_OPTIONS', 43, 'Wieviele Attributnamen und -werte sollen auf der Seite der Artikelattribute maximal angezeigt werden?', now(), now()),
('Artikelattribute - Downloadmanager', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', 43, 'Wieviele Downloadattribute sollen pro Seite im Downloadmanager angezeigt werden?', now(), now()),
('Empfohlene Artikel im Adminbereich', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', 43, 'Anzahl empfohlener Artikel pro Seite im Adminbereich', now(), now()),
('Empfohlene Artikel auf der Startseite', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', 43, 'Anzahl empfohlener Artikel auf der Startseite', now(), now()),
('Liste "Empfohlene Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', 43, 'Wieviele Artikel sollen pro Seite in der Liste "Empfohlene Artikel" angezeigt werden?', now(), now()),
('Box "Empfohlene Artikel": Anzahl der Artikel', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', 43, 'Anzahl der zufällig angezeigten empfohlenen Artikel in der Box "Empfohlene Artikel"', now(), now()),
('Sonderangebote auf der Startseite', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', 43, 'Wieviele Sonderangebote sollen auf der Startseite angezeigt werden?', now(), now()),
('Liste "Neue Artikel" - Limitieren auf...', 'SHOW_NEW_PRODUCTS_LIMIT', 43, 'Limitiert die Liste der neuen Artikel auf<br />0= Alle absteigend<br />1= Aktueller Monat<br />30= Die letzten 30 Tage<br />60= Die letzten 60 Tage<br />90= Die letzten 90 Tage<br />120= Die letzten 120 Tage', now(), now()),
('Liste "Alle Artikel": Artikel pro Seite', 'MAX_DISPLAY_PRODUCTS_ALL', 43, 'Wieviele Artikel sollen pro Seite in dieser Liste angezeigt werden?', now(), now()),
('Box "Sprachen": Landesflaggen pro Zeile', 'MAX_LANGUAGE_FLAGS_COLUMNS', 43, 'Wieviele Landesflaggen sollen maximal pro Zeile angezeigt werden?', now(), now()),
('Grösse für Datei-Upload', 'MAX_FILE_UPLOAD_SIZE', 43, 'Wie lautet die maximale Grösse einer Datei, die hochgeladen werden kann?<br />Standard= 2048000 (2MB)', now(), now()),
('Erlaubte Dateierweiterungen für Datei-Upload', 'UPLOAD_FILENAME_EXTENSIONS', 43, 'Durch Komma getrennte Liste von Dateierweiterungen (ohne Punkt) welche für einen Datei-Upload zulässig sind. z.B. jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip', now(), now()),
('Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', 43, 'Max. Anzahl Bestellpositionen / Auftrag (Liste im Adminbereich)<br>0= unbegrenzt', now(), now()),
('Max. Anzahl PayPal IPN Transaktionen pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', 43, 'Max. Anzahl PayPal IPN Transaktionen pro Seite<br />Standard: 20', now(), now()),
('Max. Spaltenanzahl - Artikel zu Kategorien-Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', 43, 'Max. Spaltenanzahl - Artikel zu Kategorien-Manager<br>3= default', now(), now()),
('Max. Anzahl EZ-Pages pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', 43, 'Wieviele EZ-Pages sollen maximal auf einer Seite der Administration anzeigt werden?<br />20 = Voreinstellung', now(), now()),
('Max. Anzahl Zeichen in Vorschauen', 'MAX_PREVIEW', 43, 'Wieviele Zeichen sollen in einer Vorschau maximal angezeigt werden?<br />100 = Voreinstellung', now(), now()),

# Adminmenü ID 4 - Bilder
('Kleine Bilder: Breite', 'SMALL_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der kleinen Bilder', now(), now()),
('Kleine Bilder: Höhe', 'SMALL_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der kleinen Bilder', now(), now()),
('Überschriftsbild im Adminbereich: Breite', 'HEADING_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Überschriftsbild im Adminbereich: Höhe', 'HEADING_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder in der Überschrift im Adminbereich<br>HINWEIS: Momentan regelt dieser Wert nur die Abstände zwischen den Einträgen im Adminbereich. Er kann aber auch dazu benutzt werden, eigene Überschriftsbilder im Adminbereich hinzuzufügen', now(), now()),
('Unterkategorien: Breite der Bilder', 'SUBCATEGORY_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('Unterkategorien: Höhe der Bilder', 'SUBCATEGORY_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Bilder für die Unterkategorien', now(), now()),
('Bildgrösse berechnen', 'CONFIG_CALCULATE_IMAGE_SIZE', 43, 'Soll die Grösse der Bilder berechnet werden?', now(), now()),
('Platzhalter für fehlende Bilder anzeigen', 'IMAGE_REQUIRED', 43, 'Sollen fehlende Bilder "angezeigt" werden? (Hilfreich in der Entwicklungsphase)', now(), now()),
('Warenkorb: Artikelbilder anzeigen', 'IMAGE_SHOPPING_CART_STATUS', 43, 'Sollen Artikelbilder im Warenkorb angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Warenkorb: Breite der Artikelbilder', 'IMAGE_SHOPPING_CART_WIDTH', 43, 'Standard = 50', now(), now()),
('Warenkorb: Höhe der Artikelbilder', 'IMAGE_SHOPPING_CART_HEIGHT', 43, 'Standard = 40', now(), now()),
('Kategorie: Bildbreite - Artikeldetails', 'CATEGORY_ICON_IMAGE_WIDTH', 43, 'Breite in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
('Kategorie: Bildhöhe - Artikeldetails', 'CATEGORY_ICON_IMAGE_HEIGHT', 43, 'Höhe in Pixel für das Kategoriebild auf der Artikeldetailseite', now(), now()),
('Bild Kategorie mit Unterkategorien: Bildbreite', 'SUBCATEGORY_IMAGE_TOP_WIDTH', 43, 'Die Breite in Pixel<br />Dieses Bild wird beim Klicken auf eine Kategorie oben angezeigt, wenn diese Unterkategorien enthält', now(), now()),
('Bild Kategorie mit Unterkategorien: BildHöhe', 'SUBCATEGORY_IMAGE_TOP_HEIGHT', 43, 'Die Höhe in Pixel<br />Dieses Bild wird beim Klicken auf eine Kategorie oben angezeigt, wenn diese Unterkategorien enthält', now(), now()),
('Artikelbeschreibung: Breite der Artikelbilder', 'MEDIUM_IMAGE_WIDTH', 43, 'Die Breite (in Pixel) der Artikelbilder in der Produktbeschreibung', now(), now()),
('Artikelbeschreibung: Höhe der Artikelbilder', 'MEDIUM_IMAGE_HEIGHT', 43, 'Die Höhe (in Pixel) der Artikelbilder in der Produktbeschreibung', now(), now()),
('Artikelbeschreibung: Suffix der Bildmedien', 'IMAGE_SUFFIX_MEDIUM', 43, 'Dateizusatz für Bildmedien der zusätzlichen Bilder in der Artikelbeschreibung<br />Standard = _MED', now(), now()),
('Artikelbeschreibung: Suffix der Bildmedien für Grössere Bilder', 'IMAGE_SUFFIX_LARGE', 43, 'Dateizusatz für Bildmedien der grösseren Bilder in der Artikelbeschreibung<br />Standard = _LRG', now(), now()),
('Artikelbeschreibung: Anzahl der zusätzlichen Bilder pro Reihe', 'IMAGES_AUTO_ADDED', 43, 'Tragen Sie hier die Anzahl der pro Reihe anzuzeigenden zusätzlichen Bilder ein<br />Standard = 3', now(), now()),
('Artikelliste: Höhe der Artikelbilder', 'IMAGE_PRODUCT_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Artikelliste: Breite der Artikelbilder', 'IMAGE_PRODUCT_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Neue Artikel": Breite der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Neue Artikel": Höhe der Artikelbilder in der Liste', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Neue Artikel: Breite der Artikelbilder', 'IMAGE_PRODUCT_NEW_WIDTH', 43, 'Standard = 100', now(), now()),
('Neue Artikel: Höhe der Artikelbilder', 'IMAGE_PRODUCT_NEW_HEIGHT', 43, 'Standard = 80', now(), now()),
('Liste "Empfohlene Artikel": Breite der Artikelbilder', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Empfohlene Artikel": Höhe der Artikelbilder', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Liste "Alle Artikel": Breite der Artikelbilder', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', 43, 'Standard = 100', now(), now()),
('Liste "Alle Artikel": Höhe der Artikelbilder', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', 43, 'Standard = 80', now(), now()),
('Artikelbild: Status automatisch auf "kein Bild vorhanden"', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', 43, 'Soll der Status bei Artikelbildern automatisch auf "kein Bild vorhanden" gesetzt werden, wenn kein Bild dem Artikel hinzugefügt wurde? <br />0= nein<br />1= ja', now(), now()),
('Artikelbild: "Kein Bild vorhanden" Bild', 'PRODUCTS_IMAGE_NO_IMAGE', 43, 'Welches Bild soll als Eratzbild verwendet werden, wenn kein Bild dem Artikel hinzugefügt wurde?<br />Standard = no_picture.gif', now(), now()),
('Proportionale Bilder für Artikel & Kategorien verwenden', 'PROPORTIONAL_IMAGES_STATUS', 43, 'Artikel und Kategoriebilder werden proportional verkleinert, falls die vorgegebenen Werte für Höhe / Breite überschritten werden. Anmerkung: Nicht verwenden wenn für Höhe  bzw. Breite 0 verwendet wird.', now(), now()),
('IH - Bildgrösse ändern und Caching verwenden', 'IH_RESIZE', 43, 'Entweder ''No'' für normales Zen-Cart Verhalten oder ''Yes'' um die automatische grössenänderung und das Caching von Bildern zu aktivieren. Wenn Sie ImageMagick verwenden wollen, müssen Sie den Pfad zur convert binary in <em>includes/extra_configures/bmz_image_handler_conf.php</em> angeben.', now(), now()),
('IH - Kleine Bilder - Dateityp', 'SMALL_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Internet Explorer hat noch immer Probleme transparente png darzustellen. Nehmen Sie besser ''gif'' für die Transparenz oder ''jpg'' für Grössere Bilder. ''no_change'' bedeutet normales Zen-Cart Verhalten. Es wird derselbe Dateityp für kleine Bilder wie für hochgeladene Bilder verwendet.', now(), now()),
('IH - Kleine Bilder - Hintergrund', 'SMALL_IMAGE_BACKGROUND', 43, 'Falls ein hochgeladenes Bild mit transparenten Bereichen konvertiert wurde, erhalten die transparenten Bereiche diese Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Kleine Bilder - Qualität', 'SMALL_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je Höher desto bessere Qualität und desto höhere Dateigrösse. Voreingestellt ist 85.', now(), now()),
('IH - Kleine Bilder - Wasserzeichen', 'WATERMARK_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mit Wasserzeichen versehene kleine Bilder anzeigen wollen.', now(), now()),
('IH - Kleine Bilder - Zoom', 'ZOOM_SMALL_IMAGES', 43, 'Stellen Sie auf ''yes'', falls Sie den Zoom-Effekt bei Mouseover für die kleinen Bilder aktivieren wollen.', now(), now()),
('IH - Kleine Bilder - Bildgrösse bei Hover', 'ZOOM_IMAGE_SIZE', 43, 'Stellen Sie auf Medium wenn Sie beim Hover die grösse der mittleren Bilder haben wollen und auf Large, wenn Sie die Grösse der grossen Bilder verwenden wollen.', now(), now()),
('IH - Mittlere Bilder - Dateityp', 'MEDIUM_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die mittleren Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Mittlere Bilder - Hintergrund', 'MEDIUM_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Mittlere Bilder - Qualität', 'MEDIUM_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Qualität für die kleinen jpg Bilder an. Dezimalwerte von 0 bis 100. Je Höher desto bessere Qualität und desto Höhere Dateigrösse. Voreingestellt ist 85.', now(), now()),
('IH - Mittlere Bilder - Wasserzeichen', 'WATERMARK_MEDIUM_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie mittlere Bilder mit Wasserzeichen versehen anzeigen lassen wollen.', now(), now()),
('IH - Grosse Bilder - Dateityp', 'LARGE_IMAGE_FILETYPE', 43, 'Wählen Sie ''jpg'', ''gif'' oder ''png''. Der Internet Explorer stellt transparente png-Dateien noch immer nicht korrekt dar. Bei transparenten Bildern verwenden Sie daher besser ''gif'' oder ''jpg'' für grosse Bilder. ''no_change'' bedeutet normales Zen-Cart-Verhalten und für die grossen Bilder wird derselbe Dateityp wie bei den hochgeladenen Bildern verwendet.', now(), now()),
('IH - Grosse Bilder - Hintergrund', 'LARGE_IMAGE_BACKGROUND', 43, 'Wenn ein Bild mit transparenten Bereichen hochgeladen wird, bekommen diese Bereiche die hier angegebene Farbe. Stellen Sie auf ''transparent'' um die Transparenz zu erhalten.', now(), now()),
('IH - Grosse Bilder - Qualität', 'LARGE_IMAGE_QUALITY', 43, 'Geben Sie die gewünschte Bildqualität für grosse jpg Bilder an. Verwenden Sie Zehnerschritte von 0 bis 100. Höhere Werte bedeuten mehr Qualität und mehr Dateigrösse und damit Speicherplatz. Voreingestellt ist 85, was ein guter Wert ist, ausser Sie haben besondere Wünsche.', now(), now()),
('IH - Grosse Bilder - Wasserzeichen', 'WATERMARK_LARGE_IMAGES', 43, 'Stellen Sie auf ''yes'', wenn Sie grosse Bilder mit Wasserzeichen versehen anzeigen wollen.', now(), now()),
('IH - Grosse Bilder - Maximale Breite', 'LARGE_IMAGE_MAX_WIDTH', 43, 'Geben Sie eine maximale Breite für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer grösse nicht verändert.', now(), now()),
('IH - Wasserzeichen - Position', 'WATERMARK_GRAVITY', 43, 'Wählen Sie die Position für das Wasserzeichen. Voreingestellt ist <strong>Center (Zentriert)</strong>.', now(), now()),
('IH - Grosse Bilder - Maximale Höhe', 'LARGE_IMAGE_MAX_HEIGHT', 43, 'Geben Sie eine maximale Höhe für Ihre grossen Bilder an. Wenn Breite und Höhe leer gelassen oder auf 0 gesetzt werden, werden die grossen Bilder in ihrer grösse nicht verändert.', now(), now()),
('IH - Benennung der Bilder im cache/images Ordner', 'IH_CACHE_NAMING', 43, 'Wählen Sie die Methode, die <em>Image Handler</em> verwendet, um die verkleinerten Bilder im Verzeichnis <code>cache/images</code> zu benennen.<br><br><em>Hashed</em>: Verwendet einen &quot;MD5&quot; Hash, um die Dateinamen zu erzeugen.  Es kann &quot;schwierig&quot; sein, die Originaldatei mit dieser Methode visuell zu identifizieren.<br><br><em>Readable (Lesbar)</em>: Dies ist eine gute Wahl für neue Installationen oder für aktualisierte Installationen, die keine hardcodierten Bildverknüpfungen zu alten Hashed Dateinamen haben. <br><br><em>Mirrored (Gespiegelt)</em>: Ähnlich wie <em>Readable</em>, aber die Verzeichnisstruktur unter <code>cache/images</code> spiegelt die Struktur der Unterverzeichnisse der Originalbilder wider.', now(), now()),

# Adminmenü ID 5 - Kundendetails
('Anrede', 'ACCOUNT_GENDER', 43, 'Auswahl der Anrede <br /> Diese wird bei Erstellung des Kundenkontos abgefragt und dann in allen E-Mails benutzt.<br /><br />Wenn diese Option auf FALSE gestellt wird, wird der Kunde stets mit Hallo VORNAME angesprochen.', now(), now()),
('Geburtsdatum', 'ACCOUNT_DOB', 43, 'Soll das Feld "Geburtsdatum" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Firma', 'ACCOUNT_COMPANY', 43, 'Soll das Feld "Firma" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Adresszeile 2', 'ACCOUNT_SUBURB', 43, 'Soll das Feld "Adresszeile 2" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesland', 'ACCOUNT_STATE', 43, 'Soll das Feld "Bundesland" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Bundesländerliste - als Pulldownmenü anzeigen?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 43, 'Soll die Eingabe des Bundeslandes durch eine Auswahlliste dargestellt werden?', now(), now()),
('Kontoerstellung: Standard - Land', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', 43, 'Dieses Land als Standard in der Kontoerstellung anzeigen:<br />', now(), now()),
('Faxnummer', 'ACCOUNT_FAX_NUMBER', 43, 'Soll das Feld "Faxnummer" in der Kontoerstellung und in den Kontoinformationen angezeigt werden?', now(), now()),
('Checkbox für Newsletter anzeigen', 'ACCOUNT_NEWSLETTER_STATUS', 43, 'Soll die Checkbox für Newsletter angezeigt werden?<br />0= nein<br />1= unmarkiert anzeigen<br />2= markiert anzeigen<br /><strong>HINWEIS: In einigen Ländern steht die Standardanzeige auf "markiert" im Konflikt mit den gesetzlichen Bestimmungen</strong>', now(), now()),
('E-Mail an Kunden im HTML Format senden', 'ACCOUNT_EMAIL_PREFERENCE', 43, 'Standard Einstellung für E-Mails an Kunden<br>0=Text<br>1=HTML', now(), now()),
('Artikelbenachrichtigung nach Bestellung abfragen', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', 43, 'Sollen Kunden nach ihrer Bestellung über Artikelbenachrichtigungen gefragt werden?<br />0 = nie nachfragen<br />1= Immer nachfragen, außer wenn die Abfrage global gesetzt wurde<br /><br />HINWEIS: Die Sidebox muss separat ausgeschaltet werden', now(), now()),
('Kunden Shopstatus - Ansicht Shop und Preise', 'CUSTOMERS_APPROVAL', 43, 'benötigen Kunden eine Berechtigung, um im Shop einkaufen zu können?<br />0= Nein - normaler Shop<br />1= Artikelansicht erst nach Anmeldung<br />2= Artikelansicht ohne Preise, Preise werden erst nach Anmeldung sichtbar<br />3= Nur Showroom (Generell keine Preise sichtbar)<br /><br />Die Option 2 ist empfohlen, wenn Kunden Preise erst nach Anmeldung sehen sollen, aber der Zugriff für Webcrawler zugelassen werden soll.', now(), now()),
('Kunden Freigabestatus -  auf Freigabe warten', 'CUSTOMERS_APPROVAL_AUTHORIZATION', 43, 'benötigen Kunden eine gesonderte Freigabe, um im Shop einkaufen zu können?<br />0= Nein (normaler Shop)<br />1= Artikelansicht erst nach Freigabe<br />2= Artikelansicht ohne Preise, Preise werden erst nach Freigabe sichtbar<br />3= Artikelansicht mit Preise, einkaufen erst nach Freigabe<br /><br />Die Option 2 oder 3 ist empfohlen, wenn der Zugriff für Webcrawler zugelassen werden soll.', now(), now()),
('Kunden Autorisierung: Dateiname', 'CUSTOMERS_AUTHORIZATION_FILENAME', 43, 'Der Dateinamen der Kunden Autorisierung<br />HINWEIS: Angabe bitte OHNE Dateierweiterung<br />Standard=customers_authorization', now(), now()),
('Kunden Autorisierung: Überschrift ausblenden', 'CUSTOMERS_AUTHORIZATION_HEADER_OFF', 43, 'Kunden Autorisierung: Überschrift ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: linke Spalte ausblenden', 'CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF', 43, 'Kunden Autorisierung: linke Spalte ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: rechte Spalte ausblenden', 'CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF', 43, 'Kunden Autorisierung: rechte Spalte ausblenden <br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kunden Autorisierung: Fusszeile ausblenden', 'CUSTOMERS_AUTHORIZATION_FOOTER_OFF', 43, 'Kunden Autorisierung: Fusszeile ausblenden<br />(true= ausblenden<br />false= anzeigen)', now(), now()),
('Kundenempfehlung', 'CUSTOMERS_REFERRAL_STATUS', 43, 'Kunden Referer - Status<br /><br />0= AUS - Kundenempfehlung deaktiviert<br />1= Durch die erste Verwendung eines Aktionskupons<br />2= Kunde kann während der Erstellung des Kundenkontos die Empfehlung eintragen, falls diese leer ist<br /><br />HINWEIS: Wurde die Kundenempfehlung einmal erstellt, kann diese nur noch im Adminbereich geändert werden', now(), now()),

# Adminmenü ID 6 - Wird nicht im Adminbereich angezeigt, dient meist für die Module
('Installierte Zahlungsmodule', 'MODULE_PAYMENT_INSTALLED', 43, 'Eine Liste der installierten Zahlungsmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: cc.php;cod.php;paypal.php)', now(), now()),
('Installierte Bestellmodule', 'MODULE_ORDER_TOTAL_INSTALLED', 43, 'Eine Liste der installierten Bestellmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', now(), now()),
('Installierte Versandmodule', 'MODULE_SHIPPING_INSTALLED', 43, 'Eine Liste der installierten Versandmodule, durch Semikolon getrennt. Die Liste wird automatisch aktualisiert und muss nicht editiert werden. (Beispiel: ups.php;flat.php;item.php)', now(), now()),
('Versandkostenfreie Lieferung aktivieren', 'MODULE_SHIPPING_FREESHIPPER_STATUS', 43, 'Bieten Sie einen versandkostenfreien Versand an?<br><br><b>Hinweis:<br>Lassen Sie dieses Versandmodul IMMER aktiv!</b><br>Es wird für bestimmte Funktionalitäten benötigt und aktiviert sich nur, falls ein Artikel wirklich versandkostenfrei ist. Es bedeutet NICHT, dass der Kunde einfach einen Gratisversand auswählen kann!<br><b>Nicht deinstallieren und auch nicht deaktivieren!</b>', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_FREESHIPPER_COST', 43, 'Welche Versandkosten fallen an?', now(), now()),
('Bearbeitungsgebühr', 'MODULE_SHIPPING_FREESHIPPER_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Versandkosten pro stück aktivieren', 'MODULE_SHIPPING_ITEM_STATUS', 43, 'Bieten Sie die Versandart Versandkosten pro stück an?', now(), now()),
('Versandkosten pro Artikel', 'MODULE_SHIPPING_ITEM_COST', 43, 'Die Versandkosten werden mit der Anzahl der Artikel in der Bestellung multipliziert.', now(), now()),
('BearbeitungsGebühr', 'MODULE_SHIPPING_ITEM_HANDLING', 43, 'BearbeitungsGebühr für diese Versandart:', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_ITEM_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_ITEM_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_ITEM_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_ITEM_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),
('Zahlungsart "Gratis" aktivieren', 'MODULE_PAYMENT_FREECHARGER_STATUS', 43, 'Wollen Sie die Zahlungsart "Gratis" anbieten?<br><br><b>Hinweis: Lassen Sie dieses Zahlungsmodul IMMER aktiv!</b><br>Es wird für bestimmte Funktionalitäten benötigt und aktiviert sich nur, wenn der Gesamtbetrag wirklich 0 ist. Es bedeutet nicht, dass dem Kunden diese Zahlungsart zur Auswahl angeboten wird!<br><br><b>Nicht deinstallieren und auch nicht deaktivieren!</b>', now(), now()),
('Sortierung', 'MODULE_PAYMENT_FREECHARGER_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Zahlungsarten.', now(), now()),
('Zahlungszone', 'MODULE_PAYMENT_FREECHARGER_ZONE', 43, 'für welche Länder soll diese Zahlungsart angeboten werden?<br>Die auswählbaren Zahlungszonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Ländern.', now(), now()),
('Bestellstatus', 'MODULE_PAYMENT_FREECHARGER_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus für diese Zahlungsart fest.', now(), now()),
('Vorkasse/Überweisung aktivieren', 'MODULE_PAYMENT_EUTRANSFER_STATUS', 43, 'Akzeptieren Sie Zahlungen per Vorkasse/Cberrweisung?', now(), now()),
('Bank Name:', 'MODULE_PAYMENT_EUTRANSFER_BANKNAM', 43, 'Tragen Sie hier den Namen Ihrer Bank ein.', now(), now()),
('Kontoinhaber:', 'MODULE_PAYMENT_EUTRANSFER_ACCNAM', 43, 'Tragen Sie hier den Namen des Kontoinhabers ein.', now(), now()),
('Kontonummer:', 'MODULE_PAYMENT_EUTRANSFER_ACCNUM', 43, 'Tragen Sie hier Ihre Kontonummer ein.', now(), now()),
('Bankleitzahl:', 'MODULE_PAYMENT_EUTRANSFER_BLZ', 43, 'Tragen Sie hier die Bankleitzahl ein.', now(), now()),
('IBAN:', 'MODULE_PAYMENT_EUTRANSFER_ACCIBAN', 43, 'Tragen Sie hier Ihre IBAN ein.', now(), now()),
('BIC/SWIFT:', 'MODULE_PAYMENT_EUTRANSFER_BANKBIC', 43, 'Tragen Sie hier Ihren BIC/SWIFT Code ein.', now(), now()),
('Sortierung', 'MODULE_PAYMENT_EUTRANSFER_SORT_ORDER', 43, 'Anzeigereigenfolge für dieses Modul. Der niedrigste Wert wird zuerst angezeigt.', now(), now()),
('Zahlungszone', 'MODULE_PAYMENT_EUTRANSFER_ZONE', 43, 'Wenn Sie hier eine Zone angeben, ist Banküberweisung nur für Kunden mit Rechnungsadresse in dieser Zone möglich. Es empfiehlt sich dafür eine Zone anzulegen, die nur die Länder mit EURO enthält.', now(), now()),
('Bestellstatus', 'MODULE_PAYMENT_EUTRANSFER_ORDER_STATUS_ID', 43, 'Welchen Bestellstatus sollen Bestellungen bekommen, die mit Banküberweisung bezahlt werden?', now(), now()),
('Länder', 'MODULE_PAYMENT_EUTRANSFER_COUNTRIES', 43, 'Geben Sie hier die Länder an, für die Banküberweisung möglich sein soll. Es empfiehlt sich hier nur Länder einzutragen, die den EURO haben, so dass eine EU-Standardüberweisung möglich ist. Zweistellige ISO-Codes durch Komma getrennt!', now(), now()),
('Inklusive MwSt.', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 43, 'Der Rabattbetrag enthält die MwSt.', now(), now()),
('Gruppenermässigung aktivieren', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 43, 'Bieten Sie eine Ermässigung für bestimmte Kundengruppen an?', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', 43, 'Bestimmt die Sortierung in der Bestellzusammenfassung', now(), now()),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 43, 'Die Gruppenermässigung wird auf den Rechnungsbeitrag inkl. der Versandkosten gewährt?', now(), now()),
('MwSt. Betrag neu berechnen', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 43, 'Soll der MwSt. Betrag neu berechnet werden?<br> Dieses ist nur notwendig, wenn die Gruppenermässigung inkl. MwSt. angezeigt werden soll', now(), now()),
('Steuerklasse', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', 43, 'Folgende Steuerklasse verwenden falls oben Credit Note eingestellt ist:', now(), now()),
('Einheitliche Versandkosten aktivieren', 'MODULE_SHIPPING_FLAT_STATUS', 43, 'Wollen Sie "Einheitliche Versandkosten" aktivieren?', now(), now()),
('Einheitliche Versandkosten', 'MODULE_SHIPPING_FLAT_COST', 43, 'Die Versandkosten für alle Bestellungen, die mit dieser Versandmethode getätigt werden.', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FLAT_TAX_CLASS', 43, 'Folgende Steuerklasse für diese Versandmethode verwenden:', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FLAT_ZONE', 43, 'Wenn eine Zone ausgewählt wird, ist diese Versandmethode nur für diese Zone aktiviert.', now(), now()),
('Reihenfolge der Anzeige:', 'MODULE_SHIPPING_FLAT_SORT_ORDER', 43, 'Legt die Reihenfolge der Anzeige fest (Der kleinste Wert wird als erstes gezeigt)', now(), now()),
('Standardwährung', 'DEFAULT_CURRENCY', 43, 'Standardwährung', now(), now()),
('Standardsprache', 'DEFAULT_LANGUAGE', 43, 'Standardsprache', now(), now()),
('Bestellstatus für neue Bestellungen', 'DEFAULT_ORDERS_STATUS_ID', 43, 'Wenn eine neue Bestellung getätigt wird, ist dies der Status dem sie zugewiesen wird.', now(), now()),
('Admin configuration_key anzeigen', 'ADMIN_CONFIGURATION_KEY_ON', 43, 'Manuell auf Wert 1 wechseln um den configuration_key Namen in der Konfiguration anzuzeigen', now(), now()),

# Adminmenü ID 7 - Versandoptionen
('Ursprungsland', 'SHIPPING_ORIGIN_COUNTRY', 43, 'Wählen Sie das Land, von dem aus die Versandkosten berechnet werden sollen.', now(), now()),
('Postleitzahl', 'SHIPPING_ORIGIN_ZIP', 43, 'Geben Sie die Postleitzahl an, von dem aus die Versandkosten berechnet werden sollen.', now(), now()),
('Maximales Versandgewicht', 'SHIPPING_MAX_WEIGHT', 43, 'Paketdienste haben im Allgemeinen eine Grenze für das Maximagewicht eines Paketes.<br />Tragen Sie dieses Gewicht stellvertretend für alle ein.', now(), now()),
('Kleine bis mittlere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_WEIGHT', 43, 'Wie hoch ist die Gewichtszunahme bei einem typischen kleineren Paketes bis mittleren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', now(), now()),
('Grössere Pakete: prozentuelle Gewichtszunahme', 'SHIPPING_BOX_PADDING', 43, 'Wie hoch ist die Zunahme des Gewichtes bei einem typischen grösseren Paket?<br />Beispiel: 10% + 1kg 10:1<br />10% + 0kg 10:0<br />0% + 5kg 0:5<br />0% + 0kg 0:0', now(), now()),
('Anzahl der Pakete und das Gewicht anzeigen', 'SHIPPING_BOX_WEIGHT_DISPLAY', 43, 'Soll die Anzahl der Pakete und das Gewicht angezeigt werden?<br /><br />0= nein<br />1= nur Anzahl der Pakete<br />2= nur das Gewicht<br />3= Anzahl der Pakete und das Gewicht', now(), now()),
('Einstellungen für Versandberechnung im Warenkorb anzeigen', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', 43, '<br />0= AUS<br />1= Als Button im Warenkorb zeigen<br />2= Die voraussichtlichen Versandkosten werden unterhalb des Warenkorb angezeigt. Als Basis für die Berechnung wird die Hauptadresse des Kunden genommen.', now(), now()),
('Zeige Bestellkommentare auf der Admin Rechnung an', 'ORDER_COMMENTS_INVOICE', 43, 'Sollen Bestellkommentare auf der Admin Rechnung angezeigt werden?<br />0= AUS<br />1= Nur der erste Kommentar des Kunden<br />2= Alle Kommentare der Bestellung', now(), now()),
('Zeige Bestellkommentare auf dem Admin Lieferschein an', 'ORDER_COMMENTS_PACKING_SLIP', 43, 'Sollen Bestellkommentare auf dem Admin Lieferschein angezeigt werden?<br />0= AUS<br />1= Nur der erste Kommentar des Kunden<br />2= Alle Kommentare der Bestellung', now(), now()),
('Versandkostenfreier Versand wenn das Gesamtgewicht "0" ist', 'ORDER_WEIGHT_ZERO_STATUS', 43, 'Wenn in einer Bestellung das Gesamtgewicht "0" ist, soll die Bestellung als "versandkostenfrei" versendet werden?<br />0= nein<br />1= ja<br />HINWEIS: Wenn diese Option aktiviert ist, wird "versandkostenfrei" nur bei Artikel mit "0" Gewicht angezeigt.', now(), now()),

# Adminmenü ID 8- Artikelliste
('Artikelbilder anzeigen', 'PRODUCT_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der das Artikelbild angezeigt wird', now(), now()),
('Hersteller anzeigen', 'PRODUCT_LIST_MANUFACTURER', 43, 'Wollen Sie den Hersteller in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der der Hersteller angezeigt wird', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_LIST_MODEL', 43, 'Wollen Sie Artikelnummern in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der die Artikelnummer angezeigt wird', now(), now()),
('Artikelnamen anzeigen', 'PRODUCT_LIST_NAME', 43, 'Wollen Sie Artikelnamen in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der der Artikelname angezeigt wird', now(), now()),
('Anzeigen von Preis/In den Warenkorb', 'PRODUCT_LIST_PRICE', 43, 'Wollen Sie den Preis und die Anzeige "In den Warenkorb" in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der "Preis/in den Warenkorb" angezeigt wird', now(), now()),
('Artikelstückzahl anzeigen', 'PRODUCT_LIST_QUANTITY', 43, 'Wollen Sie die vorhandene Artikelstückzahl in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der die Verfügbare Artikelstückzahl angezeigt wird', now(), now()),
('Artikelgewicht anzeigen', 'PRODUCT_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Artikelliste anzeigen?<br>0= wird nicht angezeigt, 1-7 Spaltennummer in der das Artikelgewicht angezeigt wird', now(), now()),
('Preis/In den Warenkorb: Spaltenbreite', 'PRODUCTS_LIST_PRICE_WIDTH', 43, 'Definiert die Spaltenbreite von "Preis/In den Warenkorb"<br />Standard= 125', now(), now()),
('Kategorien-/Herstellerfilter anzeigen (0=nein; 1=ja)', 'PRODUCT_LIST_FILTER', 43, 'Wollen Sie den Filter für Kategorien-/Hersteller im Shop anzeigen?', now(), now()),
('"Vorheriger/Nächster" Navigation: Ansicht', 'PREV_NEXT_BAR_LOCATION', 43, 'Wo soll die "Vorheriger / Nächster" Navigation angezeigt werden?<br />(1= oben, 2= unten, 3= oben und unten)', now(), now()),
('Standardsortierung', 'PRODUCT_LISTING_DEFAULT_SORT_ORDER', 43, 'Standard Sortierung für Artikellisten<br />HINWEIS: für eine Sortierung nach Artikel bitte leer lassen.<br />Sortiert die Artikelliste in der gewünschten Reihenfolge mit der Sie beginnen möchten.<br>Wenn Sie z.B. nach Artikelnummer sortieren wollen, geben Sie die Nummer ein, die Sie oben bei Artikelnummer vergeben haben. Direkt dahinter geben Sie ein a für aufsteigende Sortierung oder ein d für absteigende Sortierung ein', now(), now()),
('Button "In den Warenkorb" anzeigen (0=nein; 1=ja; 2=Ja mit stückzahlfeld pro Artikel)', 'PRODUCT_LIST_PRICE_BUY_NOW', 43, 'Wollen Sie den Button "In den Warenkorb" anzeigen?<br /><br /><strong>HINWEIS:</strong> Um die pro Artikel ein stückzahlfeld angezeigt zu bekommen (Auswahl 2), setzen Sie bitte die Einstellung "Button "Ausgewählte Artikel in den Warenkorb" anzeigen" auf 0', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_LIST_DESCRIPTION', 43, 'Soll die Artikelbeschreibung angezeigt werden?<br><br>0= Aus<br>oder z.B. 150 = es werden die ersten 150 Zeichen der Artikelbeschreibung angezeigt', now(), now()),
('Zeichen für absteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', 43, 'Welches Zeichen soll eine ansteigende Sortierung anzeigen?<br />Default = -', now(), now()),
('Zeichen für aufsteigende Sortierung', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', 43, 'Welches Zeichen soll eine aufsteigende Sortierung anzeigen?<br />Default = +', now(), now()),
('Artikelfilter für Artikelnamen nach Alphabet anzeigen', 'PRODUCT_LIST_ALPHA_SORTER', 43, 'Soll der Filter für Artikel nach Alphabet in der Artikelliste angezeigt werden?', now(), now()),
('Bild für Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS', 43, 'Wollen Sie die Bilder der Unterkategorien in der Artikelliste anzeigen?', now(), now()),
('Bild für ausgewählte Kategorie anzeigen', 'PRODUCT_LIST_CATEGORIES_IMAGE_STATUS_TOP', 43, 'Wollen Sie das Bild für die aktuell ausgewählte Kategorie oben in der Artikelliste anzeigen?', now(), now()),
('Unterkategorien anzeigen', 'PRODUCT_LIST_CATEGORY_ROW_STATUS', 43, 'Sollen die Unterkategorien in der Artikelliste beim Klick auf die Hauptkategorie angezeigt werden?<br /><br />0= Nein<br />1= Ja', now(), now()),
('Artikelliste - Layout Stil', 'PRODUCT_LISTING_LAYOUT_STYLE', 43, 'Wählen Sie das Layout Ihrer Artikelliste:<br>Jeder Artikel kann in einer eigenen Zeile angezeigt werden (rows) oder die Artikel können nebeneinander in mehreren Spalten pro Reihe angezeigt werden (columns)', now(), now()),
('Artikelliste - Spalten pro Reihe', 'PRODUCT_LISTING_COLUMNS_PER_ROW', 43, 'Wieviele Spalten pro Reihe wollen Sie in der Artikelliste anzeigen. Voreinstellung: 3 (columns Modus)<br/>1 bedeutet Anzeige in einer Spalte (rows Modus)', now(), now()),


# Adminmenü ID 9 - Lagerverwaltung und Warenkorb
('Lagerbestand prüfen', 'STOCK_CHECK', 43, 'Überprüfen, ob der bestellte Artikel auch lagernd ist', now(), now()),
('Bestellungen vom Lagerbestand abziehen', 'STOCK_LIMITED', 43, 'Sollen bestellte Artikel vom Lagerbestand abgezogen werden?', now(), now()),
('Bestellung erlauben, wenn Lagerbestand unterschritten wird', 'STOCK_ALLOW_CHECKOUT', 43, 'Soll Kunden bei Unterschreitung des Lagerbestandes eine Bestellung ermöglicht werden?', now(), now()),
('Markierung für nicht lagernde Artikel', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', 43, 'Nicht lagernde Artikel werden bei der Bestellung markiert mit diesen Zeichen markiert<br>Standard: ***', now(), now()),
('Lagermindestbestand für Nachbestellungen', 'STOCK_REORDER_LEVEL', 43, 'Legen Sie hier fest, ab welcher Lagermenge ein Artikel nachbestellt werden muss<br>HINWEIS: Diese Einstellung gilt für alle Artikel, es kann keine Unterscheidung pro Artikel vorgenommen werden.', now(), now()),
('Artikel im Shop anzeigen, wenn nicht lagernd', 'SHOW_PRODUCTS_SOLD_OUT', 43, 'Sollen Artikel im Shop angezeigt werden, wenn sie nicht lagernd sind<br /><br />0= Nein - Artikelstatus auf AUS<br />1= Ja, Artikelstatus auf EIN', now(), now()),
('Artikel ist ausverkauft: Bild "Ausverkauft" anstelle von "in den Warenkorb" anzeigen', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', 43, 'Zeige für ausverkaufte Artikel das Bild "Ausverkauft" anstelle von "in den Warenkorb"<br /><br />0= nein<br />1= ja', now(), now()),
('Dezimalstellen der Artikelstückzahlen', 'QUANTITY_DECIMALS', 43, 'Wieviele Dezimalstellen sollen in der Artikelstückzahl angezeigt werden?<br /><br />0= keine', now(), now()),
('Warenkorb: Checkboxen und/oder Buttons zum Löschen anzeigen', 'SHOW_SHOPPING_CART_DELETE', 43, 'Zeigt im Warenkorb Buttons und/oder Checkboxen zum Löschen von Artikel an<br /><br />1= Nur Buttons<br />2= Nur Checkboxen<br />3= Buttons und Checkboxen', now(), now()),
('Warenkorb: Aktualisieren Schaltfläche anzeigen', 'SHOW_SHOPPING_CART_UPDATE', 43, 'Wo soll die Aktualisieren Schaltfläche im Warenkorb angezeigt werden?<br><br>1= Neben jedem Mengeneingabefeld<br>2= Einmal unterhalb des Warenkorbes<br>3= Neben jedem Mengeneingabefeld und unterhalb des Warenkorbes', now(), now()),
('Leerer Warenkorb: "Neue Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS', 43, 'Sollen "Neue Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Empfohlene Artikel" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS', 43, 'Sollen "Empfohlene Artikel" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Monatliche Sonderangebote" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS', 43, 'Sollen "Monatliche Sonderangebote" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Leerer Warenkorb: "Artikelankündigungen" anzeigen', 'SHOW_SHOPPING_CART_EMPTY_UPCOMING', 43, 'Sollen "Artikelankündigungen" in der Ansicht "leerer Warenkorb" angezeigt werden?<br />0= Nein (oder Sortierung einstellen)', now(), now()),
('Zeige Hinweis beim Login über den zusammengelegten Warenkorb an', 'SHOW_SHOPPING_CART_COMBINED', 43, 'Sobald ein Kunde sich anmeldet und von der letzten Anmeldung noch Artikel im Warenkorb hat, werden die aktuell im Warenkorb vorhandenen Artikel mit dem Warenkorb der letzten Anmeldung kombiniert.<br /><br />Soll der Kunde auf diesen Vorgang hingewiesen werden?<br /><br />0= NEIN, zeige keinen Hinweis an<br />1= JA, und gehe automatisch zum Warenkorb<br />2= JA, aber gehe nicht automatisch zum Warenkorb', now(), now()),
('Deaktivierte Artikel bei Erreichen des Verfügbarkeitsdatums aktivieren', 'ENABLE_DISABLED_UPCOMING_PRODUCT', 43, 'Wie soll ein versteckter (deaktivierter) Artikel mit einem zukünftigen Verfügbarkeitsdatum für Kunden sichtbar (aktiv) gemacht werden, wenn das Datum erreicht ist?<br />Manual = Manuell aktivieren<br/>Automatic = Automatisch aktivieren<br/>', now(), now()),
('Deaktivierter Artikelstatus für Suchmaschinen', 'DISABLED_PRODUCTS_TRIGGER_HTTP200', 43, 'Wenn ein Artikel als deaktiviert (Status=0) eingestellt ist, aber nicht aus der Datenbank gelöscht wird, sollen Suchmaschinen ihn dann trotzdem als verfügbar anzeigen?<br><br>true = HTTP 200 Antwort zurückgeben<br>false = HTTP 410 zurückgeben<br><br/>(Löschen des Artikels gibt HTTP 404 zurück)<br><br/><b>Voreinstellung: false</b><br/><br/>', now(), now()),

 # Adminmenü ID 10 - Protokollierung und Logfiles
('Speichern der Zeit für Seitenaufbau', 'STORE_PAGE_PARSE_TIME', 43, 'Sollen die Zeiten für den Seitenaufbau einer Seite gespeichert werden?', now(), now()),
('Protokolldatei für Seitenaufbau: Speicherort', 'STORE_PAGE_PARSE_TIME_LOG', 43, 'Verzeichnis und Dateiname der Protokolldatei für Seitenaufbau', now(), now()),
('Protokolldatei für Seitenaufbau: Datumsformat', 'STORE_PARSE_DATE_TIME_FORMAT', 43, 'Datumsformat für die Protokolldatei', now(), now()),
('Zeit für Seitenaufbau im Shop anzeigen', 'DISPLAY_PAGE_PARSE_TIME', 43, 'Soll die Zeit für den Seitenaufbau im Shop unten angezeigt werden?<br />HINWEIS: Es ist nicht notwendig, die Protokolldatei für Seitenaufbau zu speichern, um sie im Shop anzeigen zu lassen.', now(), now()),
('Datenbankabfragen in Protokolldatei speichern', 'STORE_DB_TRANSACTIONS', 43, 'Sollen Datenbankabfragen in der Protokolldatei für Seitenabfragen gespeichert werden?<br />VORSICHT: Das Aktivieren dieser Einstellung kann Ihren Shop stark verlangsamen und unzählige Logfiles reduzieren Ihren Speicherplatz auf Ihrem Server! Nur für Troubleshooting aktivieren!', now(), now()),
('Logfiles anzeigen: Version', 'DISPLAY_LOGS_VERSION', 43, 'Version der Logfile Anzeige im Admin', now(), now()),
('Logfiles anzeigen: Maximale Anzahl', 'DISPLAY_LOGS_MAX_DISPLAY', 43, 'Wieviele Logfiles sollen maximal auf einer Seite angezeigt werden. (Voreinstellung: <b>20</b>)', now(), now()),
('Logfiles anzeigen: Maximale Dateigröße', 'DISPLAY_LOGS_MAX_FILE_SIZE', 43, 'Stellen Sie hier die maximale Dateigröße für die anzuzeigenden Logfiles ein.  (Voreinstellung: <b>80000</b>)', now(), now()),
('Logfiles anzeigen: Enthaltene Logfiletypen', 'DISPLAY_LOGS_INCLUDED_FILES', 43, 'Tragen Sie hier die <em>Präfixe</em> der Logfiles ein, die in der Anzeige berücksichtigt werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Ausgeschlossene Logfiletypen', 'DISPLAY_LOGS_EXCLUDED_FILES', 43, 'Tragen Sie hier die Präfixe der Logfiles ein, die von der Anzeige <em>ausgeschlossen</em> werden sollen, getrennt mit dem Pipe Zeichen (|). Leerzeichen werden von der Coderoutine entfernt.', now(), now()),
('Logfiles anzeigen: Hinweis im Header der Administration', 'DISPLAY_LOGS_SHOW_IN_HEADER', 43, 'Wenn Errorlogs vorhanden sind, wird im Header der Shopadministration ein entsprechender Hinweis angezeigt, um Sie darauf aufmerksam zu machen.<br>Wenn Sie diesen Hinweis nicht haben wollen, können Sie ihn hier deaktivieren<br>Hinweis anzeigen = true<br>Hinweis nicht anzeigen = false.', now(), now()),
('Logfiles Level: Adminbereich', 'REPORT_ALL_ERRORS_ADMIN', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Adminbereich auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu einigen Logfiles mit völlig harmlosen Warnings führen.', now(), now()),
('Logfiles Level: Frontend', 'REPORT_ALL_ERRORS_STORE', 43, 'Möchten Sie Debug-Logs für <b>alle</b> PHP-Fehler, auch Warnungen, erstellen, die während der Verarbeitung in Ihrem Zen Cart Frontend auftreten?<br> Wenn Sie alle PHP-Fehler <b>ausgenommen</b> doppelte Sprachdefinitionen protokollieren möchten, wählen Sie <em>IgnoreDups</em> (= Duplikate ignorieren).<br>Das ist die Voreinstellung, da doppelte Sprachdefinitionen in Zen Cart 1.5.x durch das Override System nicht komplett vermeidbar sind.<br>Die Einstellung Yes wird zu extrem vielen Logfiles mit völlig harmlosen Warnings führen und die Performance des Frontends negativ beeinflussen.', now(), now()),
('Logfiles Level: Backtrace auch bei Notices?', 'REPORT_ALL_ERRORS_NOTICE_BACKTRACE', 43, 'Wollen Sie Backtrace-Informationen zu &quot;Notice&quot; Fehlern einbeziehen?<br>Diese sind in der Regel auf die identifizierte Datei beschränkt und die Backtrace-Informationen füllen nur die Logs. Voreinstellung (<b>Nein</b>).<br>Nur zu detaillierten Fehleranalyse sinnvoll.', now(), now()),
('Logfiles Manager: Behaltedauer in Tagen', 'LOG_MANAGER_KEEP_DAYS', 43, 'Geben Sie die maximale Anzahl von <em>Tagen</em> ein, die eine Datei mit der Endung <code>.log</code> im Verzeichnis <b>logs</b> Ihres Servers aufbewahrt werden soll.<br><br>Bei 0 findet keinerlei automatische Löschung statt.<br>Wenn der von Ihnen eingegebene Wert ungleich Null ist, werden alle Dateien, die vor diesem relativen Datum erstellt wurden, <b>permanent</b> aus dem Dateisystem Ihres Servers entfernt.<br>', now(), now()),
('Logfiles Manager: Welche Logs behalten?', 'LOG_MANAGER_KEEP_THESE', 43, 'Geben Sie eine durch Komma getrennte Liste von Namenspräfixen für alle Logfiles ein, die Sie <b><i>beibehalten</i></b> möchten, unabhängig von ihrem Alter.<br><br>Die eingegebenen Werte sind <em>Groß-Kleinschreibung-sensitiv</em>, d.h. <em>zcInstall</em> ist anders als <em>zcinstall</em>.  Die Standardeinstellung (<code>zcInstall</code>) führt dazu, dass jede Datei, die mit <code>/logs/zcInstall*.log</code> übereinstimmt, unabhängig von ihrem Erstellungsdatum aufbewahrt wird.<br>', now(), now()),

# Adminmenü ID 11 - AGB und Datenschutz
('AGB Bestätigungsfeld bei der Bestellung anzeigen', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 43, 'Den Kunden wird während der Bestellung das AGB Bestätigungsfeld angezeigt und sie müssen den AGB zustimmen.', now(), now()),
('Datenschutzbestimmungen Bestätigungsfeld bei der Kontoerstellung anzeigen', 'DISPLAY_PRIVACY_CONDITIONS', 43, 'Den Kunden wird während der Kontoerstellung das Datenschutzbestimmungen Bestätigungsfeld angezeigt und sie müssen den Datenschutzbestimmungen zustimmen.', now(), now()),
('Checkbox für Widerrufsrecht bei digitalen Downloads', 'DISPLAY_WIDERRUF_DOWNLOADS_ON_CHECKOUT_CONFIRMATION', 43, 'Wollen Sie auf der Bestellbestätigungsseite eine zusätzliche Checkbox für das Widerrufsrecht bei digitalen Downloads anzeigen? Der Kunde muss dann explizit zustimmen, dass sein Widerrufsrecht erlischt.<br>Nur aktivieren, falls Sie digitale Downloads verkaufen!', now(), now()),

# Adminmenü ID 12 - Email Optionen
('E-Mail Transportmethode', 'EMAIL_TRANSPORT', 43, 'Definiert die Methode für das Senden von Emails.<br /><br><strong>PHP</strong> ist voreingestellt, damit Sie den Mailversand gleich ohne weitere Einstellungen testen können. Diese Versandart sollte auf jedem Server funktionieren.<br><b>Im Livebetrieb sollten Sie aber die Versandart PHP KEINESFALLS verwenden!</b><br><br /><strong>SMTPAUTH</strong> sollte im Livebetrieb verwendet werden, da es den sicheren Versand von authentifizierten E-Mails über einen SMTP Server ermöglicht. Wenn Sie auf diese Methode umschalten, dann müssen Sie weiter unten auch Ihre SMTPAUTH-Einstellungen in den entsprechenden Feldern konfigurieren. <br /><br /><strong>Gmail</strong> wird für das Senden von E-Mails über den Mail-Service von Google verwendet und erfordert weiter unten Einstellungen aus Ihrem gmail-Konto.<br /><br /><strong>sendmail</strong> ist für Linux/Unix-Hosts, die das sendmail-Programm auf dem Server verwenden<br /><br><strong>"sendmail-f"</strong> ist nur für Server, die die Verwendung des Parameters -f benötigen, um sendmail zu verwenden. Dies ist eine Sicherheitseinstellung, die häufig verwendet wird, um Spoofing zu verhindern. Verursacht Fehler, wenn Ihr Host-Mailserver nicht für die Verwendung konfiguriert ist.<br /><br /><b>VERWENDEN SIE IM LIVEBETRIEB IMMER SMTPAUTH.</b>', now(), now()),
('SMTP E-Mail - Mailbox Benutzer', 'EMAIL_SMTPAUTH_MAILBOX', 43, 'Wenn Sie für den Versand von E-Mails SMTP Authentifizierung verwenden müssen, dann geben Sie hier den Namen Ihres SMTP Benutzerkontos ein z.B. ich@domain.com ', now(), now()),
('SMTP E-Mail - Mailbox Passwort', 'EMAIL_SMTPAUTH_PASSWORD', 43, 'Passwort für SMTP Authentifizierung', now(), now()),
('SMTP E-Mail - Mailserver Name', 'EMAIL_SMTPAUTH_MAIL_SERVER', 43, 'SMTP Mailserver für Authentifizierung z.B. smtp.domain.com', now(), now()),
('SMTP E-Mail - Mailserver Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', 43, 'SMTP Mailserver Port', now(), now()),
('Währungssymbole für Text-Emails', 'CURRENCIES_TRANSLATIONS', 43, 'Welche Währungssymbole sollen für Text-Emails konvertiert werden?<br />Am besten lassen Sie die folgende Voreinstellung völlig unverändert:<br>&amp;pound; = £, &amp;euro; = €, &amp;reg; = ® , &amp;trade; = ™', now(), now()),
('E-Mail als MIME HTML versenden', 'EMAIL_USE_HTML', 43, 'Wollen Sie e-Mails im HTML Format versenden falls der Empänger in seinen Einstellungen HTML statt Text angekreuzt hat?<br>HINWEIS: Dies ist der generelle Hauptschalter. Wenn Sie hier auf false stellen, dann wird der Shop keinerlei HTML Emails versenden.', now(), now()),
('E-Mail durch DNS-Server verifizieren', 'ENTRY_EMAIL_ADDRESS_CHECK', 43, 'Soll die Gültigkeit von e-Mails durch DNS-Server verifiziert werden?', now(), now()),
('E-Mail senden', 'SEND_EMAILS', 43, 'E-Mails senden', now(), now()),
('E-Mail Archivierung aktiviert', 'EMAIL_ARCHIVE', 43, 'Wenn Sie E-Mail, die versendet werden, archivieren wollen, setzen Sie desen Wert auf "true".', now(), now()),
('E-Mail Adresse (Kontaktadresse)', 'STORE_OWNER_EMAIL_ADDRESS', 43, 'Die E-Mail Adresse des Shopbetreibers / der Kontaktperson.', now(), now()),
('E-Mail Absender', 'EMAIL_FROM', 43, 'Die Absenderadresse, mit der E-Mails versendet werden sollen.', now(), now()),
('E-Mail Absenderdomain verwenden?', 'EMAIL_SEND_MUST_BE_STORE', 43, 'Alle vom Mailserver verschickten E-Mails müssen eine Absenderadresse "FROM" haben?<br /><br />Dies wird oft verwendet um das verschicken von SPAM mails zu verhindern. Bei JA wird der Wert der Einstellung "E-Mail Absender" als "FROM" Adresse für alle ausgehenden Mails verwendet.', now(), now()),
('E-Mail an Admin: Format', 'ADMIN_EXTRA_EMAIL_FORMAT', 43, 'Wählen Sie das Format für e-Mails, die zusätzlich an den Administrator versendet werden.<br>HINWEIS: Wenn Sie hier HTML auswählen, dann muss auch der generelle Hauptschalter HTML Emails versenden auf true gestellt sein, sonst werden nur Text Emails versandt.', now(), now()),
('E-Mail Kopie bei Bestellungen versenden', 'SEND_EXTRA_ORDER_EMAILS_TO', 43, 'Versendet zusätzlich ein E-Mail bei Bestellungen an die unten angegebene(n) Adresse(n).<br />Die Adressen müssen in diesem Format eingegeben werden:<br>Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Neues Konto erstellt": Benachrichtigung versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', 43, 'Benachrichtigung versenden, wenn ein neues Konto erstellt wurde?<br />0= nein<br />1= ja', now(), now()),
('"Neues Konto erstellt": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', 43, 'Eine Kopie an diese E-Mail Adresse(n) versenden, wenn ein neues Konto erstellt wurde?<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', 43, '"Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Gutschein versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', 43, 'Eine Kopie bei "Gutschein versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Gutschein versendet": Benachrichtigung versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Gutschein versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Gutschein versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Gutschein versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Aktionskupon versendet": Benachrichtigung versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Aktionskupon versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Aktionskupon versendet": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Aktionskupon versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Admin Bestellung": Benachrichtigung versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', 43, '"Admin Bestellung versendet": Benachrichtigung versenden<br />0= nein<br />1= ja', now(), now()),
('"Admin Bestellung": Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', 43, 'Eine Kopie bei "Admin Bestellung versendet" an diese E-Mail Adresse(n) versenden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Kunden Bewertung" : Benachrichtigung versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', 43, '0= Nein<br>1= Ja', now(), now()),
('"Kunden Bewertung" : Kopie an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', 43, 'Eine Kopie an diese E-Mail Adresse(n) versenden, wenn eine Bewertung abgegeben wurde?<br>Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;\r\n', now(), now()),
('E-Mail Adressen für die "Schreiben Sie uns" Dropdown Liste', 'CONTACT_US_LIST', 43, 'Lassen Sie dieses Feld leer, wenn Sie kein Dropdown mit unterschiedlichen Kontaktadressen verwenden wollen, es wird dann automatisch die Shop Kontakadresse verwendet!<br><br>Geben Sie hier die für die "Schreiben Sie uns" E-Mail Dropdown Liste gewünschte(n) E-Mail Adresse(n) ein.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('"Schreiben Sie uns": Shopname und Adresse anzeigen', 'CONTACT_US_STORE_NAME_ADDRESS', 43, 'Shopname und Adresse im Formular "Schreiben Sie uns" anzeigen<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": Benachrichtigung versenden', 'SEND_LOWSTOCK_EMAIL', 43, 'Eine Benachrichtigung versenden, wenn der Lagermindestbestand erreicht oder unterschritten wurde?<br />0= nein<br />1= ja', now(), now()),
('"Lagermindestbestand unterschritten": an diese E-Mail Adresse(n) versenden', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', 43, 'Wenn der Lagermindestbestand erreicht oder unterschritten wurde, soll an diese E-Mail Adresse(n) eine Benachrichtigung versendet werden.<br />Die Adressen müssen in diesem Format eingegeben werden: Name 1 &lt;email@adresse1&gt;, Name 2 &lt;email@adresse2&gt;', now(), now()),
('Link "Newsletter abbestellen" anzeigen?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 43, 'Soll in der Info Box ein Link für "Newsletter abbestellen" angezeigt werden?', now(), now()),
('Empfängerliste -  Zähleranzeige', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 43, 'Wenn die Liste der verfügbaren Empfänger angezeigt wird, soll der Empfängerzähler inkludiert werden? <br /><em>(HINWEIS: Es können Geschwindigkeitseinbußen auftreten, wenn Sie viele Kunden oder komplexe Empfängerabfragen haben)</em>', now(), now()),
('Willkommensemail senden?', 'SEND_WELCOME_EMAIL', 43, 'Wollen Sie Neukunden nach der Registrierung ein Willkommensemail senden?', now(), now()),

# Adminmenü ID 13 - Attributeinstellungen
('Downloads aktivieren', 'DOWNLOAD_ENABLED', 43, 'Wollen Sie Download-Artikel aktivieren?.', now(), now()),
('Downloads über Weiterleitung', 'DOWNLOAD_BY_REDIRECT', 43, 'Wollen Sie Browser-Weiterleitung für Download-Artikel aktivieren? (Ist auf nicht-UNIX Systemen deaktiviert).<br /><br />HINWEIS: Setzten Sie /pub auf CHMOD 777 bei aktivierter Weiterleitung', now(), now()),
('Streaming Download', 'DOWNLOAD_IN_CHUNKS', 43, 'Wenn Download via redirect gesperrt ist und ihr PHP Speicherlimit < 8 MB ist, sollten Sie diese Einstellung verwenden, da die Daten in kleineren Blöcken an den Browser übermittelt werden.<br /><br />Hat keine Bedeutung wenn Download via Redirect freigegeben ist.', now(), now()),
('Ablaufdatum für Downloads (Anzahl in Tagen)', 'DOWNLOAD_MAX_DAYS', 43, 'Geben Sie hier die Anzahl der Tagen ein, für wie lange ein Download-Artikel gültig sein soll. (0= Unlimitiert)', now(), now()),
('Anzahl erlaubter Downloads - pro Artikel', 'DOWNLOAD_MAX_COUNT', 43, 'Geben Sie hier die maximale Anzahl der erlaubten Downloads pro Artikel ein. (0= Download nicht erlaubt)', now(), now()),
('Downloadmanager: Wert für Aktualisierungsstatus', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', 43, 'Welcher Bestellstatus soll die Tage der Gültigkeitsdauer und die maximal erlaubte Downloadanzahl für Download-Artikel zurücksetzen? (Standard = 4)', now(), now()),
('Downloadmanager: Wert für Bestellstatus', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', 43, 'Nur wenn der Auftragsstatus Grösser/gleich dem eingegebenen Wert ist, können Download-Artikel heruntergeladen werden. Standard: 2', now(), now()),
('Max. Auftragsstatus für Download-Artikel', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS_END', 43, 'Nur wenn der Auftragsstatus kleiner/gleich dem eingegebenen Wert ist, können Download-Artikel heruntergeladen werden. Standard: 4', now(), now()),
('Preis durch Attribute', 'ATTRIBUTES_ENABLED_PRICE_FACTOR', 43, 'Preise durch Attribute aktivieren?', now(), now()),
('Mengenrabatt aktivieren', 'ATTRIBUTES_ENABLED_QTY_PRICES', 43, 'Mengenrabatte ermöglichen?', now(), now()),
('Attributbilder', 'ATTRIBUTES_ENABLED_IMAGES', 43, 'Attributbilder aktivieren?', now(), now()),
('Textpreise aktivieren (Wort oder Buchstabe)', 'ATTRIBUTES_ENABLED_TEXT_PRICES', 43, 'Soll das Attribut "Textpreis nach Wort oder Buchstabe" aktiviert werden?', now(), now()),
('Textpreise: Leerzeichen sind kostenlos', 'TEXT_SPACES_FREE', 43, 'Sind bei Textpreisen die Leerzeichen kostenlos?<br /><br />0= nein 1= ja', now(), now()),
('Artikel mit Read-Only Attributen - Hinzufügen zum Warenkorb', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', 43, 'Können Artikel mit nur Read-Only Attributen in den Warenkorb gelegt werden?<br>0=NEIN<br>1=JA', now(), now()),

# Adminmenü ID 14 - GZip Kompression
('GZip Komprimierung aktivieren', 'GZIP_LEVEL', 43, '0= nein 1= ja', now(), now()),

# Adminmenü ID 15 Sitzungen/Sessions
('Verzeichnis für Sitzungen', 'SESSION_WRITE_DIRECTORY', 43, 'Wenn das Speichern von Sitzungen sateibasierend ist, werden sie in dieses Verzeichnis gespeichert. Hier sollte dasselbe Verzeichnis angegeben werden wie in der Einstellun für DIR_FS_SQL_CACHE in Ihren beiden configure.php Dateien!', now(), now()),
('Cookies - Domänenname', 'SESSION_USE_FQDN', 43, 'Wenn für den Shop Cookies verwendet werden, benötigen Sie einen Domänennamen (z.B. www.meinedomain.at). Wenn nicht, wird nur ein teilweiser Domänenname benötigt (z.B. meinedomain.at) Wenn Sie sich nicht sicher sind, lassen Sie diese Option auf "true".', now(), now()),
('Cookies - Verwendung erzwingen', 'SESSION_FORCE_COOKIE_USE', 43, 'Die Verwendung von Cookies erzwingen.<br />HINWEIS: Wenn ein Kunde in den Browsereinstellungen die Verwendung von Cookies deaktiviert hat, kann dieser den Shop nicht verwenden..', now(), now()),
('Überprüfung der SSL Sitzungs- ID', 'SESSION_CHECK_SSL_SESSION_ID', 43, 'Überprüft die Sitzungs-ID bei jeder gesicherten HTTPS Seitenanfrage.', now(), now()),
('Browser des Kunden prüfen', 'SESSION_CHECK_USER_AGENT', 43, 'Überprüft den Browser des Kunden bei jeder Seitenanfrage.', now(), now()),
('IP Adresse überprüfen', 'SESSION_CHECK_IP_ADDRESS', 43, 'Überprüft die IP Adresse des Benutzers bei jeder Seitenanfrage.', now(), now()),
('Spider Sitzungen verhindern', 'SESSION_BLOCK_SPIDERS', 43, 'Verhindert das Starten von Sitzungen bei bekannten Spidern.', now(), now()),
('Sitzungen wiederherstellen', 'SESSION_RECREATE', 43, 'Sollen Sitzungen wiederhergestellt werden, um eine neue Sitzungs-ID zu erstellen, wenn ein Kunde sich anmeldet oder ein neues Konto erstellt? (benötigt PHP >=4.1).', now(), now()),
('Umwandlung IP Adresse zu Hostname', 'SESSION_IP_TO_HOST_ADDRESS', 43, 'Soll die IP-Adresse auf einen Hostnamen umgewandelt werden?<br><br>Anmerkung: Auf manchen Systemen kann dies zu einem langsameren Session Start und E-Mailversand führen. ', now(), now()),
('Basispfad für Cookiepfad verwenden', 'SESSION_USE_ROOT_COOKIE_PATH', 43, 'Normalerweise verwendet Zen Cart das Verzeichnis, in dem sich ein Shop befindet, als Cookie-Pfad. Dies kann bei einigen Servern zu Problemen führen. Mit dieser Einstellung können Sie den Cookie-Pfad auf das Stammverzeichnis des Servers und nicht auf das Speicherverzeichnis festlegen. Es sollte nur verwendet werden, wenn Sie Probleme mit Sitzungen haben.<br><b>Standardwert = false</b><br><br><b>Wenn Sie diese Einstellung ändern, kann es zu Problemen bei der Anmeldung in Ihrem Admin kommen, Sie sollten die Cookies Ihres Browsers löschen, um dies zu verhindern.</b>', now(), now()),
('Periodenpräfixes zur Cookie-Domäne hinzufügen', 'SESSION_ADD_PERIOD_PREFIX', 43, 'Normalerweise fügt Zen Cart der Cookie-Domain ein Periodenpräfix hinzu, z.B. .www.mydomain.com. Dies kann manchmal zu Problemen mit einigen Serverkonfigurationen führen. Wenn Sie Sessionprobleme haben, sollten Sie versuchen, dies auf False zu setzen.<br><b>Standardwert = True</b>', now(), now()),

# Adminmenü ID 16 - Gutscheine und Aktionskupons
('Länge der Aktionskupon-/Gutscheinnummer', 'SECURITY_CODE_LENGTH', 43, 'Tragen Sie hier die Länge der Aktionskupon-/Gutscheinnummer ein<br />Tipp: Je länger um so sicherer.', now(), now()),
('Standard Auftragsstatus bei Bestellsumme 0', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', 43, 'Auftragsstatus der Bestellungen mit der Bestellsumme 0 zugewiesen werden soll', now(), now()),
('Neuregistrierung: Aktionskupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', 43, 'Wählen Sie einen Aktionskupon<br />(none= keine Aktiosnkupons bei Neuregistrierungen senden)', now(), now()),
('Neuregistrierung: Ermässigungsbetrag', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', 43, 'Bitte leer lassen, falls Sie keine "Willkommensgeschenke" in Form eines Aktionskupons an Neukunden versenden wollen,<br />oder geben Sie den Betrag an (z.B. 10 für &euro;10.00)', now(), now()),
('Max. Anzahl Gutscheine pro Seite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', 43, 'Max. Anzahl Gutscheine pro Seite', now(), now()),
('Max. Anzahl Gutscheine auf Reportseite', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', 43, 'Max. Anzahl Gutscheine auf Reportseite', now(), now()),

# Adminmenü ID 17 - Kreditkarten
('VISA', 'CC_ENABLED_VISA', 43, 'Akzeptieren Sie Zahlungen mit VISA Kreditkarten (0= nein 1= ja)', now(), now()),
('MasterCard', 'CC_ENABLED_MC', 43, 'Akzeptieren Sie Zahlungen mit MasterCard Kreditkarten (0= nein 1= ja)', now(), now()),
('AmericanExpress', 'CC_ENABLED_AMEX', 43, 'Akzeptieren Sie Zahlungen mit AmericanExpress Kreditkarten (0= nein 1= ja)', now(), now()),
('Diners Club', 'CC_ENABLED_DINERS_CLUB', 43, 'Akzeptieren Sie Zahlungen mit Diners Club Kreditkarten (0= nein 1= ja)', now(), now()),
('Discover Card', 'CC_ENABLED_DISCOVER', 43, 'Akzeptieren Sie Zahlungen mit Discover Card Kreditkarten  (0= nein 1= ja)', now(), now()),
('JCB', 'CC_ENABLED_JCB', 43, 'Akzeptieren Sie Zahlungen mit JCB Kreditkarten  (0= nein 1= ja)', now(), now()),
('AUSTRALIAN BANKCARD', 'CC_ENABLED_AUSTRALIAN_BANKCARD', 43, 'Akzeptieren Sie Zahlungen mit AUSTRALIAN BANKCARD Kreditkarten (0= nein 1= ja)', now(), now()),
('SOLO', 'CC_ENABLED_SOLO', 43, 'Akzeptieren Sie Zahlungen mit SOLO Kreditkarten (0= nein 1= ja)', now(), now()),
('Switch', 'CC_ENABLED_SWITCH', 43, 'Akzeptieren Sie Zahlungen mit Switch Kreditkarten  (0= nein 1= ja)', now(), now()),
('Maestro', 'CC_ENABLED_MAESTRO', 43, 'Akzeptieren Sie Zahlungen mit Maestro Kreditkarten (0= nein 1= ja)', now(), now()),
('Debit', 'CC_ENABLED_DEBIT', 43, 'Akzeptieren Sie Zahlungen mit Debit Kreditkarten (0= nein 1= ja)<br>HINWEIS: Dies ist zu diesem Zeitpunkt noch nicht tief integriert, und diese Einstellung kann überflüssig sein, wenn Ihre Zahlungsmodule noch keinen speziellen Code haben, um diesen Schalter zu unterstützen.', now(), now()),
('Akzeptierte Kreditkarten in der Seite für Bezahlung anzeigen', 'SHOW_ACCEPTED_CREDIT_CARDS', 43, 'Sollen die akzeptierten Kreditkarten in der Seite für die Bezahlung angezeigt werden?<br />0= nicht anzeigen<br />1= als Text anzeigen<br />2= als Bild anzeigen<br /><br />HINWEIS: Die Bilder und Texte müssen sowohl in der Datenbank als auch in den Sprachfiles für die jeweilige Kreditkarte definiert sein.', now(), now()),

# Adminmenü ID 6 - Wird nicht angezeigt, dient meist für die Module
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_GV_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', 43, 'Legt die Sortierung fest.', now(), now()),
('Warteschlange für Gutscheinbestellungen aktivieren', 'MODULE_ORDER_TOTAL_GV_QUEUE', 43, 'Wollen Sie die Warteschlange für Gutscheinbestellungen aktivieren?', now(), now()),
('Versandkosten im Gutschein inkludieren', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 43, 'Sollen die Versandkosten in die Berechnung inkludiert werden?', now(), now()),
('Gutscheine inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 43, 'Sollen die Steuern in die Berechnung inkludiert werden?', now(), now()),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 43, 'Steuern neu berechnen', now(), now()),
('Steuerklasse für Gutscheine', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', 43, 'Folgende Steuerklasse wird bei Gutscheinen und im Kreditguthaben verwendet:', now(), now()),
('Kreditguthaben inklusive Steuern', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 43, 'Sollen die Steuern bei bestellten Gutscheinen im Kreditguthaben inkludiert werden?', now(), now()),
('Bestellstatus', 'MODULE_ORDER_TOTAL_GV_ORDER_STATUS_ID', 43, 'Legt den Bestellstatus fest, wenn der komplette Auftrag mit einem Gutschein vollständig bezahlt wurde.', now(), now()),
('Gutschein Warteschlange im Header der Administration?', 'MODULE_ORDER_TOTAL_GV_SHOW_QUEUE_IN_ADMIN', 43, 'Wollen Sie den Button für die Gutschein-Warteschlange auf allen Seiten der Shopadministration anzeigen?<br>(Wird automatisch ausgeblendet, wenn sich nichts in der Warteschlange befindet, und wird auf derSeite \'Bestellungen\' immer angezeigt, unabhängig von dieser Einstellung.', now(), now()),
('Geschenkgutscheine als Sonderangebot möglich?', 'MODULE_ORDER_TOTAL_GV_SPECIAL', 43, 'Soll es möglich sein, dass Geschenkgutscheine als Sonderangebote eingestellt werden können?', now(), now()),

('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 43, 'Wollen Sie einen Mindestbestellzuschlag aktivieren?', now(), now()),
('Gebühr bei Unterschreitung der Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 43, 'Wie hoch ist Gebühr bei Unterschreitung der Mindestbestellmenge?', now(), now()),
('Gebühr für Mindestbestellmenge - Betrag', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 43, 'für eine prozentuelle Kalkulation fügen Sie ein "%" Zeichen an. Beispiel: 10%<br />für eine pauschale Gebühr geben Sie den Betrag an. Beispiel: 5 für &euro;5.00', now(), now()),
('Gebühr für Mindestbestellmenge - nur bestimmte Bestellungen', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 43, 'Gebühren für Mindestbestellmengen werden nur für Bestellungen angewendet, die zum hier eingestellten Ziel gesendet werden.', now(), now()),
('Gebühr für Mindestbestellmenge - Steuerklasse', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', 43, 'Folgende Steuerklasse bei Gebühren für Mindestbestellmengen verwenden.', now(), now()),
('Virtuelle Artikel - keine Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 43, 'Soll bei Bestellungen, die nur virtuellen Artikel beinhalten, keine Gebühr für Mindestbestellmenge gerechnet werden?', now(), now()),
('Geschenkgutscheine - keine Gebühr für Mindestbestellmenge', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 43, 'Soll bei Bestellungen, die nur Geschenkgutscheine beinhalten, keine Gebühr für Mindestbestellmenge gerechnet werden?', now(), now()),

('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Versandkostenfreie Lieferung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 43, 'Wollen Sie Versandkostenfreie Lieferungen erlauben?', now(), now()),
('Versandkostenfreie Lieferung über', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', 43, 'Versandkostenfreie Lieferung über dem hier eingegebenen Bestellwert.', now(), now()),
('Versandkostenfreie Lieferung für diese Bestellung erlauben', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 43, 'Versandkostenfreie Lieferung für Bestellungen erlauben, die zum hier eingestellten Ziel gesendet werden.', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TAX_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 43, '', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', 43, 'Sortierung der Anzeige', now(), now()),

('Steuerklasse für das Einlösen von Aktionskupons', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', 43, 'Diese Steuerklasse beim Einlösen von Aktionskupons verwenden<br>empfohlene Voreinstellung: Normalsteuersatz<br>Nur wenn Sie hier einen Steuersatz auswählen, wird die Steuer korrekt berechnet und es kann bei Aktionskuponwerten mit Bruttopreisen gearbeitet werden.', now(), now()),
('Inklusive Steuern', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 43, 'Steuern in die Berechnung inkludieren<br>empfohlene Voreinstellung: false', now(), now()),
('Sortierung', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 43, 'Sortierreihenfolge<br>empfohlene Voreinstellung: 201', now(), now()),
('Inklusive Versandkosten', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 43, 'Versandkosten in die Berechnung inkludieren<br>empfohlene Voreinstellung: false', now(), now()),
('Dieses Modul ist installiert', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 43, '', now(), now()),
('Steuern neu berechnen', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 43, 'Steuern neu berechnen<br/>empfohlene Voreinstellung: Standard<br>Credit Note bedeutet, dass sämtliche Steuerausweisung bei Aktionskupons entfernt wird.', now(), now()),

('Artikeloptionstyp: Auswahltyp', 'PRODUCTS_OPTIONS_TYPE_SELECT', 43, 'Die Zahl repräsentiert den Auswahltyp der Artikeloptionen', now(), now()),
('Artikeloptionstyp: Text', 'PRODUCTS_OPTIONS_TYPE_TEXT', 43, 'Numerischer Wert des Textes des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Radio Button', 'PRODUCTS_OPTIONS_TYPE_RADIO', 43, 'Numerischer Wert des Radio Buttons des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Check Box', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', 43, 'Numerischer Wert der Check Box des Artikeloptionstyps', now(), now()),
('Artikeloptionstyp: Datei', 'PRODUCTS_OPTIONS_TYPE_FILE', 43, 'Numerischer Wert der Datei des Artikeloptionstyps', now(), now()),
('ID für Text und Datei des Artikeloption Wertes', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', 43, 'Numerischer Wert der Artikeloptionswert ID (products_options_values_id), die vom Text- und Dateiattribute verwendet wird', now(), now()),
('Upload Präfix', 'UPLOAD_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Uploadoptionen und anderen Optionen', now(), now()),
('Text Präfix', 'TEXT_PREFIX', 43, 'Präfix zu Unterscheidung zwischen Textoptionen und anderen Optionen', now(), now()),
('Artikeloptionstyp: Nur lesen', 'PRODUCTS_OPTIONS_TYPE_READONLY', 43, 'Numerischer Wert des Status der Datei des Artikeloptionstyps', now(), now()),

# Adminmenü ID 18 - Artikeldetailseite
('Artikelbeschreibung: Sortierung der Artikelattribute', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', 43, 'Wie soll die Sortierung der Artikelattribute in der Artikelbeschreibung angezeigt werden?<br>0= Sortierung, Preis<br>1= Sortierung, Attributeigenschaften', now(), now()),
('Artikelbeschreibung: Sortierung der Artikeloptionen', 'PRODUCTS_OPTIONS_SORT_ORDER', 43, 'Wie soll die Sortierung der Artikeloptionen in der Artikelbeschreibung angezeigt werden?<br>0 = Sortierung, Attributnamen<br>1 = Attributnamen', now(), now()),
('Artikelbeschreibung: Namen des Attributmerkmales unter dem Attributbild anzeigen', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', 43, 'Soll der Name des Attributmerkmales unter dem Attributbild angezeigt werden?<br />0 = nein<br>1 = ja', now(), now()),
('Artikelbeschreibung: Anzeigen der Differenz der Preisreduktion ("sie sparen...")', 'SHOW_SALE_DISCOUNT_STATUS', 43, 'Soll die Differenz der Preisreduktion ("sie sparen...) angezeigt werden?<br />0 = nein 1 = ja', now(), now()),
('Artikelbeschreibung: Anzeige der Preisreduktion in Währung oder Prozent', 'SHOW_SALE_DISCOUNT', 43, 'Zeige die Preisreduktion an in:<br />1 = %<br />2 = Betrag', now(), now()),
('Artikelbeschreibung: Dezimalstellen bei Anzeige der Preisreduktion in Prozent', 'SHOW_SALE_DISCOUNT_DECIMALS', 43, 'Wieviel Dezimalstellen sollen bei Anzeige der Preisreduktion in Prozent dargestellt werden?<br />Standard= 0', now(), now()),
('Artikelbeschreibung: Kostenlose Artikel als Bild oder Text darstellen', 'OTHER_IMAGE_PRICE_IS_FREE_ON', 43, 'Soll "Artikel ist kostenlos" als Bild oder Text dargestellt werden?<br />0 = Text<br />1 = Bild', now(), now()),
('Artikelbeschreibung: "für Preis bitte anrufen" als Bild oder Text darstellen', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', 43, 'Soll "für Preis bitte anrufen" als Bild oder Text dargestellt werden?<br />0 = Text<br />1 = Bild', now(), now()),
('Artikelanzahl: Bei neuen Artikel aktiviert', 'PRODUCTS_QTY_BOX_STATUS', 43, 'Wie soll die Box der Artikelanzahl für den Warenkorb bei neuen Artikel standardmässig eingestellt sein?<br /><br />0 = aus<br />1 = ein<br /><br />Hinweis:<br />EIN<br />Diese Option zeigt eine Box, die dem Kunden die Möglichkeit zur Eingabe der Artikelanzahl im Warenkorb anzeigt<br />AUS<br />Die Artikelanzahl wird auf nur "1" gesetzt, ohne der Möglichkeit zur Änderung der Artikelanzahl im Warenkorb', now(), now()),
('Artikelbewertungen benötigen Überprüfung', 'REVIEWS_APPROVAL', 43, 'Sollen Artikelbewertungen erst nach einer Überprüfung freigegeben werden?<br /><br />HINWEIS: Wenn der Bewertungsstatus deaktiviert ist, wird diese Option nicht aktiv<br /><br />0 = nein<br>1 = ja', now(), now()),
('Meta Tags: Artikelnummer im Titel integrieren', 'META_TAG_INCLUDE_MODEL', 43, 'Soll die Artikelnummer im Meta Tag Titel integriert werden?<br /><br />0 = nein<br>1 = ja', now(), now()),
('Meta Tags: Artikelpreis im Titel integrieren', 'META_TAG_INCLUDE_PRICE', 43, 'Soll der Artikelpreis im Meta Tag Titel integriert werden?<br /><br />0 = nein<br>1= ja', now(), now()),
('Max. Anzahl Wörter für Metatag "description"', 'MAX_META_TAG_DESCRIPTION_LENGTH', 43, 'Maximale Anzahl Wörter für Description Metatag.<br> Voreinstellung: 50', now(), now()),
('Artikelbeschreibung: Anzahl empfohlener Artikel pro Zeile ', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', 43, 'Anzahl empfohlener Artikel die pro Zeile angezeigt werden sollen', now(), now()),
('"Vorheriger - Nächster" Navigation: Position der Navigationsleite', 'PRODUCT_INFO_PREVIOUS_NEXT', 43, 'Geben Sie hier an, wo die "Vorheriger - Nächster" Navigation angezeigt werden soll<br />0 = Off (nicht anzeigen)<br />1 = Top of Page (oben auf der Seite anzeigen)<br />2 = Bottom of Page (unten auf der Seite anzeigen)<br />3 = Both Top & Bottom of Page (oben und unten auf der Seite anzeigen', now(), now()),
('"Vorheriger - Nächster" Navigation: Sortierung der Artikel', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', 43, 'Geben Sie hier an, wie die Artikel in der "Vorheriger - Nächster" Navigation sortiert werden sollen<br />0 = Product ID (Artikel ID)<br />1 = Name (Artikelname)<br />2 = Product Model (Artikelnummer)<br />3 = Product Price - Name (Preis, Artikelname)<br />4 = Product Price - Model (Preis, Artikelnummer)<br />5 = Product Name - Model (Artikelname, Artikelnummer)<br />6 = Product Sort Order (Artikelsortierung)', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder', 'SHOW_PREVIOUS_NEXT_STATUS', 43, 'Sollen Buttons und Artikelbilder angezeigt werden?<br />0 = Off (nein)<br />1 = On (ja)', now(), now()),
('"Vorheriger - Nächster" Navigation: Button und Artikelbilder - Einstellungen', 'SHOW_PREVIOUS_NEXT_IMAGES', 43, 'Wie sollen Buttons und Artikelbilder angezeigt werden?<br />0 = Buttons Only (nur Buttons)<br />1 = Button and Product Image (Buttons und Artikelbilder)<br />2 = Product Image Only (nur Artikelbilder)', now(), now()),
('"Vorheriger - Nächster" Navigation: Breite der Bilder', 'PREVIOUS_NEXT_IMAGE_WIDTH', 43, 'Geben Sie die Breite der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Höhe der Bilder', 'PREVIOUS_NEXT_IMAGE_HEIGHT', 43, 'Geben Sie die Höhe der Artikelbilder (in Pixel) an', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategorien anzeigen', 'PRODUCT_INFO_CATEGORIES', 43, 'Wie sollen Artikelkategorien, Kategoriebilder und Kategorienamen oberhalb der "Vorheriger - Nächster" Navigation angezeigt werden?<br />0 = Off (nicht anzeigen)<br />1 = Align Left (Linksausrichtung)<br />2 = Align Center (Zentriert)<br />3 = Align Right (Rechtsausrichtung)', now(), now()),
('"Vorheriger - Nächster" Navigation: Kategoriebezeichnung und -Bild anzeigen', 'PRODUCT_INFO_CATEGORIES_IMAGE_STATUS', 43, 'Wie sollen Kategoriename und Kategoriebild angezeigt werden?<br />0 = Category name and Image Always (Kategoriename und -Bild immer anzeigen)<br />1 = Category Name Only (Nur Kategoriename)<br />2 = Category Name and Image when not blank (Kategoriename und -Bild falls vorhanden)', now(), now()),

# Adminmenü ID 19 - Layouteinstellungen
('Spaltenbreite: Linke Boxen', 'BOX_WIDTH_LEFT', 43, 'Die Breite der linken Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('Spaltenbreite: Rechte Boxen', 'BOX_WIDTH_RIGHT', 43, 'Die Breite der rechten Boxen<br />"px" kann mit angegeben werden<br /><br />Standard = 150px', now(), now()),
('"Brotkrümel" Navigation (Bread Crumbs): Separator', 'BREAD_CRUMBS_SEPARATOR', 43, 'Geben Sie hier das Symbol für den Separator für die sog. Brotkrümel Navigation ein<br />HINWEIS: Leerzeichen müssen mit "& " angegeben.<br />Standard = & ::& ', now(), now()),
('"Brotkrümel" Navigationpfad anzeigen', 'DEFINE_BREADCRUMB_STATUS', 43, 'Soll ein Navigationspfad angezeigt werden?<br />0= AUS<br />1= EIN<br>2= EIN aber nicht auf der Startseite', now(), now()),
('Bestseller: Einrücken der Zahlen', 'BEST_SELLERS_FILLER', 43, 'Wie wollen Sie die Zahlen für Bestseller einrücken?<br />Standard = & ', now(), now()),
('Bestseller: Artikelnamen kürzen', 'BEST_SELLERS_TRUNCATE', 43, 'Ab wie vielen Zeichen sollen Artikelnamen gekürzt werden?<br />Standard = 35', now(), now()),
('Bestseller: Kürze Artikelnamen ab dem folgenden...', 'BEST_SELLERS_TRUNCATE_MORE', 43, 'Artikelnamen werden gekürzt, gefolgt von...<br />Standard = true', now(), now()),
('Kategoriebox: Link für Sonderangebote anzeigen', 'SHOW_CATEGORIES_BOX_SPECIALS', 43, 'Soll der Link "Sonderangebote" in der Kategoriebox angezeigt werden?', now(), now()),
('Kategoriebox: Link für Neue Artikel anzeigen', 'SHOW_CATEGORIES_BOX_PRODUCTS_NEW', 43, 'Soll der Link "Neue Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Warenkorb anzeigen', 'SHOW_SHOPPING_CART_BOX_STATUS', 43, 'Wie soll der Warenkorb angezeigt werden?<br />0= Immer<br />1= Nur wenn Artikel im Warenkorb sind<br />2= Nur wenn Artikel im Warenkorb sind und der Warenkorb angesehen wird', now(), now()),
('Kategorie Box - Zeige Link für "Empfohlene Artikel"', 'SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS', 43, 'Soll der Link "Empfohlene Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Kategorie Box - Zeige Link für "Alle Artikel"', 'SHOW_CATEGORIES_BOX_PRODUCTS_ALL', 43, 'Soll der Link "Alle Artikel" in der Kategoriebox angezeigt werden?', now(), now()),
('Linke Spaltenansicht - Global', 'COLUMN_LEFT_STATUS', 43, 'Linke Spalte anzeigen?<br />0= Linke Spalte immer aus<br />1= Linke Spalte immer ein', now(), now()),
('Rechte Spaltenansicht - Global', 'COLUMN_RIGHT_STATUS', 43, 'Rechte Spalte anzeigen?<br />0= Rechte Spalte immer aus<br />1= Rechte Spalte immer ein', now(), now()),
('Spaltenbreite: Linke Spalte', 'COLUMN_WIDTH_LEFT', 43, 'Die Breite der linken Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', now(), now()),
('Spaltenbreite: Rechte Spalte', 'COLUMN_WIDTH_RIGHT', 43, 'Die Breite der rechten Spalte<br />"px" kann mit angegeben werden<br />Standard = 150px', now(), now()),
('Kategorien: Separator zwischen Kategorien und Links', 'SHOW_CATEGORIES_SEPARATOR_LINK', 43, 'Soll ein Separator zwischen Kategorien und Links angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Kategorien: Trennzeichen zwischen Kategorienamen und -zähler', 'CATEGORIES_SEPARATOR', 43, 'Welches Trennzeichen soll zwischen Kategorienamen und -zähler verwendet werden?<br />Standard = -&gt;', now(), now()),
('Kategorien: Separator zwischen Kategorienamen und Unterkategorien', 'CATEGORIES_SEPARATOR_SUBS', 43, 'Welcher Separator soll zwischen Kategorienamen und Unterkategorien verwendet werden?<br />Standard = |_& ', now(), now()),
('Kategoriezähler Präfix', 'CATEGORIES_COUNT_PREFIX', 43, 'Welches Symbol wollen Sie für den Prefix für Kategoriezähler verwenden?<br />Standard= (', now(), now()),
('Kategoriezähler Suffix', 'CATEGORIES_COUNT_SUFFIX', 43, 'Welches Symbol wollen Sie für den Suffix für Kategoriezähler verwenden?<br />Standard= )', now(), now()),
('Unterkategorie einrücken mit', 'CATEGORIES_SUBCATEGORIES_INDENT', 43, 'Wie sollen Unterkategorien eingerückt werden?<br />Standard= & & ', now(), now()),
('Kategoriezähler für Kategorien mit 0 Artikel anzeigen', 'CATEGORIES_COUNT_ZERO', 43, 'Sollen Kategoriezähler für Kategorien, die keine Artikel enthalten, angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Warenkorb: Summe anzeigen', 'SHOW_TOTALS_IN_CART', 43, 'Soll die Summe unter dem Warenkorb angezeigt werden?<br />0= nein<br />1= ja, Summe Artikel - Gewicht - Betrag<br />2= ja, Summe Artikel - Gewicht - Betrag, keine Anzeige des Gewichts, wenn dieses 0 ist<br />3= ja, Summe Artikel - Betrag', now(), now()),
('Willkommenstext auf Startseite zeigen?', 'SHOW_CUSTOMER_GREETING', 43, 'Willkommenstext auf Startseite zeigen?<br />0= AUS<br />1= EIN', now(), now()),
('Kategorien: Immer auf der Startseite anzeigen', 'SHOW_CATEGORIES_ALWAYS', 43, 'Sollen Top Level Kategorien immer auf der Startseite angezeigt werden?<br />0= nein<br />1= ja<br />Die Standardkategorie kann als "Top Level Kategorie" gesetzt sein oder eine bestimmte "Top Level Kategorie" sein', now(), now()),
('Startseite eröffnet mit Kategorien', 'CATEGORIES_START_MAIN', 43, '0= Top Level Kategorien<br />oder geben Sie eine Kategorie ID# ein<br />HINWEIS: Unterkategorien können ebenso verwendet werden. Beispiel: 3_10', now(), now()),
('Unterkategorien anzeigen?', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', 43, 'Sollen Unterkategorien im Navigationsmenü angezeigt werden, wenn die Hauptkategorie selektiert ist?<br>0=AUS<br>1=EIN', now(), now()),
('Bannergruppen: Überschrift Position 1', 'SHOW_BANNERS_GROUP_SET1', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Überschrift Position 3', 'SHOW_BANNERS_GROUP_SET3', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Überschrift Position 2', 'SHOW_BANNERS_GROUP_SET2', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Überschrift 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 1', 'SHOW_BANNERS_GROUP_SET4', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 1 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 2', 'SHOW_BANNERS_GROUP_SET5', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Fusszeile Position 3', 'SHOW_BANNERS_GROUP_SET6', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br /><br />Standard Bannergruppe = Wide-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Fusszeile 3 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Sidebox banner_box', 'SHOW_BANNERS_GROUP_SET7', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Bannergruppen: Sidebox banner_box2', 'SHOW_BANNERS_GROUP_SET8', 43, 'Die Bannergruppe kann aus einer oder aus mehreren Bannergruppen bestehen<br /><br />für mehrfache Bannergruppen geben Sie bitte die Namen der Bannergruppen getrennt durch <strong>:</strong> ein<br /><br />Beispiel: Wide-Banners:SideBox-Banners<br />Standard Bannergruppe = SideBox-Banners<br /><br />Welche Bannergruppe(n) wollen Sie in der Sidebox - banner_box2 verwenden?<br />Bitte leer lassen, wenn Sie keine Bannergruppe(n) verwenden wollen', now(), now()),
('Banner Anzeigengruppe - Sidebox banner_box_all', 'SHOW_BANNERS_GROUP_SET_ALL', 43, 'Welche Banneranzeigengruppe soll in der Sidebox "banner_box_all" angezeigt werden? für keine Gruppe Feld leer lassen!', now(), now()),
('IP Adresse in der Fusszeile anzeigen', 'SHOW_FOOTER_IP', 43, 'Soll die IP Adresse des Kunden in der Fusszeile angezeigt werden?<br />0= nein<br />1= ja', now(), now()),
('Mengenrabatt: Anzahl leerer Rabatte', 'DISCOUNT_QTY_ADD', 43, 'Wieviele leere Mengenrabatte sollen bei der Artikel Bepreisung hinzugefügt werden?', now(), now()),
('Mengenrabatt: Anzahl Ansicht pro Reihe', 'DISCOUNT_QUANTITY_PRICES_COLUMN', 43, 'Wieviele Mengenrabatte sollen pro Reihe angezeigt werden?', now(), now()),
('Kategorie/Artikel Sortierung', 'CATEGORIES_PRODUCTS_SORT_ORDER', 43, 'Kategorie/Artikel Sortierung<br><br>0= Kategorie/Artikel Sortierung/Name<br>1= Kategorie/Artikel Name<br>2= Artikelnummer<br>3= Artikelmenge aufsteigend, Artikelname<br>4= Artikelmenge abteigend, Artikelname<br>5= Artikelpreis aufsteigend, Artikelname<br>6= Artikelpreis absteigend, Artikelname<br>', now(), now()),
('Globale Attributfunktionen - Hinzufügen, Kopieren und Löschen   ', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', 43, 'Globale Attributfunktionen (Attributname und Attributmerkmale) - Hinzufügen, Kopieren und Löschen<br><br>0= nicht Verfügbar<br>1= Verfügbar<br>2= Artikelnummer', now(), now()),
('Kategorie-Tabs Menü EIN/AUS', 'CATEGORIES_TABS_STATUS', 43, 'Kategorie-Tabs<br />Zeigt die Toplevel Kategorien unterhalb des Banners an. <br />0= Kategorie Tabs AUS<br />1= Kategorie Tabs EIN', now(), now()),
('Sitemap - Link für "Mein Konto" inkludieren', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 43, 'Soll der Link für "Mein Konto" in der Sitemap inkludiert werden?<br /><br />Standard: false', now(), now()),
('Überspringe Kategorien mit einem Artikel', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 43, 'Überspringe Kategorien mit einem Artikel<br />Wenn true dann wird bei Klick auf die Kategorie gleich direkt die Artikelansicht angezeigt.<br />Standard: True', now(), now()),
('Anmeldeseite geteilt anzeigen', 'USE_SPLIT_LOGIN_MODE', 43, 'Die Anmeldeseite kann in zwei Varianten angezeigt werden: Geteilt oder vertikal.<br />Die geteilte Variante zeigt neben der Felder für die Anmeldung einen Text und einen "Neues Konto erstellen" Button, der auf die Seite zur <em>Kontoerstellung</em> weiterleitet. In der vertikalen Variante werden alle Felder zur Kontoerstellung unterhalb der Felder für die Anmeldung angezeigt.<br />Für die Verwendung von Paypal Express Checkout sollte diese Einstellung immer auf True bleiben!<br>Voreinstellung: True', now(), now()),
('CSS Schaltflächen im Frontend', 'IMAGE_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Frontend<br />CSS Schaltflächen anstelle von Bildbuttons im Shop verwenden (GIF/JPG)?<br />CSS Schaltflächen-Stile müssen in den Stylesheets definiert werden.', now(), now()),
('CSS Schaltflächen im Admin', 'ADMIN_USE_CSS_BUTTONS', 43, 'CSS Schaltflächen im Admin<br />CSS Schaltflächen anstelle von Bildbuttons in der Shopadministration verwenden?', now(), now()),

# Adminmenü ID 20 - Shopwartung
('<strong>Wegen Shopwartung geschlossen:</strong>', 'DOWN_FOR_MAINTENANCE', 43, 'Wegen Shopwartung geschlossen <br>(true=ein false=aus)', now(), now()),
('Wegen Shopwartung geschlossen: Dateiname', 'DOWN_FOR_MAINTENANCE_FILENAME', 43, 'Welcher Dateinamen soll für den Status "Wegen Shopwartung geschlossen" verwendet werden?<br />HINWEIS: Bitte den Dateinamen ohne Dateierweiterung angeben<br />Standard= down_for_maintenance', now(), now()),
('Wegen Shopwartung geschlossen: Header ausblenden', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 43, 'Wegen Shopwartung geschlossen: Header ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Linke Spalte ausblenden', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 43, 'Wegen Shopwartung geschlossen: Linke Spalte ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Rechte Spalte ausblenden', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 43, 'Wegen Shopwartung geschlossen: Rechte Spalte ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Fusszeile ausblenden', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 43, 'Wegen Shopwartung geschlossen: Fusszeile ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: Preise ausblenden', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 43, 'Wegen Shopwartung geschlossen: Preise ausblenden<br>(true= ausblenden<br />false= anzeigen)', now(), now()),
('Wegen Shopwartung geschlossen: diese IP-Adresse(n) ausschliessen', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 43, 'Diese IP Adresse(n) hat während der Shopwartung vollen Zugriff auf den Shop (z.B. Webmaster)<br />Bei Eingabe mehrerer IP Adressen werden diese mit einem Komma getrennt.<br /><br />TIP: Wenn Sie Ihre IP Adresse nicht kennen, finden Sie diese in der Fusszeile des Shops.', now(), now()),
('Ihre Besucher vor Beginn der Shopwartung informieren:', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Veröffentlicht eine bestimmte Zeit vor der Shopwartung einen Hinweis, wann die Shopwartung starten wird<br>(true=ein false=aus)<br>IWenn Sie die Option ''Wegen Shopwartung geschlossen'' auf "true" setzen,wird diese Option automatisch auf "false" gesetzt.', now(), now()),
('Datum und Stunden für Hinweis vor Beginn der Shopwartung', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', 43, 'Datum und Stunden für den Hinweis vor der Shopwartung, geben Sie Datum und Stunden für die Zeit der Shopwartung ein', now(), now()),
('Anzeigen, wann mit der Shopwartung begonnen wurde', 'DISPLAY_MAINTENANCE_TIME', 43, 'Zeigt an, wann mit der Shopwartung begonnen wurde<br>(true=ein false=aus)<br />', now(), now()),
('Dauer der Shopwartung anzeigen', 'DISPLAY_MAINTENANCE_PERIOD', 43, 'Zeigt die Dauer der Shopwartung an<br>(true=ein false=aus)<br />', now(), now()),
('Dauer der Shopwartung', 'TEXT_MAINTENANCE_PERIOD_TIME', 43, 'Geben Sie die Dauer der Shopwartung an (hh:mm)', now(), now()),


# Adminmenü ID 21 - Liste Neue Artikel
('Bild anzeigen', 'PRODUCT_NEW_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_NEW_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_NEW_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_NEW_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_NEW_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_NEW_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_NEW_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_NEW_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzufügt am" anzeigen', 'PRODUCT_NEW_LIST_DATE_ADDED', 43, 'Wollen Sie "Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_NEW_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_NEW_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "neue Artikel"', 'PRODUCT_NEW_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 21 geändert wurde<br />Wie lautet die configuration_group_id für die "neue Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),
('Artikelankündigungen als Neue Artikel anzeigen', 'SHOW_NEW_PRODUCTS_UPCOMING_MASKED', 43, 'Sollen Artikelankündigungen in Artikellisten, Seitenboxen und Centerboxen als neue Artikel angezeigt werden?<br />0= Nein<br />1= Ja', now(), now()),

# Adminmenü ID 22 Liste Empfohlene Artikel
('Bild anzeigen', 'PRODUCT_FEATURED_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_FEATURED_LIST_QUANTITY', 43, 'Wollen Sie die Artikelstückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_FEATURED_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_FEATURED_LIST_NAME', 43, 'Wollen Sie den Artikelnamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_FEATURED_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_FEATURED_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_FEATURED_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_FEATURED_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzugefügt am" anzeigen', 'PRODUCT_FEATURED_LIST_DATE_ADDED', 43, 'Wollen Sie "Hinzugefügt am" in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_FEATURED_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Empfohlene Artikel"', 'PRODUCT_FEATURED_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 22 geändert wurde<br />Wie lautet die configuration_group_id für die "Empfohlenen Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),

# Adminmenü ID 23 - Liste Alle Artikel
('Bild anzeigen', 'PRODUCT_ALL_LIST_IMAGE', 43, 'Wollen Sie Artikelbilder in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Stückzahl anzeigen', 'PRODUCT_ALL_LIST_QUANTITY', 43, 'Wollen Sie stückzahlen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Jetzt kaufen" - Button anzeigen', 'PRODUCT_ALL_BUY_NOW', 43, 'Wollen Sie den "jetzt kaufen" - Button in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelname anzeigen', 'PRODUCT_ALL_LIST_NAME', 43, 'Wollen Sie den Artikelname in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelnummer anzeigen', 'PRODUCT_ALL_LIST_MODEL', 43, 'Wollen Sie die Artikelnummer in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Herstellernamen anzeigen', 'PRODUCT_ALL_LIST_MANUFACTURER', 43, 'Wollen Sie den Herstellernamen in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Preis anzeigen', 'PRODUCT_ALL_LIST_PRICE', 43, 'Wollen Sie den Artikelpreis in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Gewicht anzeigen', 'PRODUCT_ALL_LIST_WEIGHT', 43, 'Wollen Sie das Artikelgewicht in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('"Hinzugefügt am" Datum anzeigen', 'PRODUCT_ALL_LIST_DATE_ADDED', 43, 'Wollen Sie das "Hinzugefügt am" Datum in der Liste anzeigen?<br /><br />0= nein<br /><br />1. Zahl = links oder rechts<br />2. und 3. Zahl = Sortierung<br />4. Zahl = Anzahl der Leerzeilen danach<br />', now(), now()),
('Artikelbeschreibung anzeigen', 'PRODUCT_ALL_LIST_DESCRIPTION', 43, 'Wollen Sie die Artikelbeschreibung in der Liste anzeigen? - Die ersten 150 Zeichen?<br />0= nein<br />1= ja', now(), now()),
('Standardsortierung', 'PRODUCT_ALL_LIST_SORT_DEFAULT', 43, 'Wie sollen die Artikel in der Liste sortiert werden?<br />Standard= 6 (nach Datum, absteigend)<br /><br />1= nach Artikelname, aufsteigend<br />2= nach Artikelname, absteigend<br />3= nach Preis (aufsteigend), dann nach Artikelname<br />4= nach Preis absteigend, dann nach Artikelname<br />5= nach Artikelnummer<br />6= nach Hinzufügedatum, absteigend<br />7= nach Hinzufügedatum, aufsteigend<br />8= nach ArtikelSortierung', now(), now()),
('Gruppen ID für "Alle Artikel"', 'PRODUCT_ALL_LIST_GROUP_ID', 43, 'WARNUNG: Ändern Sie diesen Wert erst, wenn die Gruppen ID vom Standardwert 23 geändert wurde<br />Wie lautet die configuration_group_id für die "Alle Artikel" Liste?', now(), now()),
('Button "Ausgewählte Artikel in den Warenkorb" anzeigen', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', 43, 'Eingabefelder und Schaltfläche anzeigen, um mehrere ausgewählte Artikel mit einem Klick in den Warenkorb zu übernehmen?<br><br>0= NEIN<br>1= Oben<br>2= Unten<br>3= Oben und Unten', now(), now()),

# Adminmenü ID 24 - Liste Artikelindex
('Startseite: Neue Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS', 43, 'Sollen neue Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Empfohlene Artikel anzeigen', 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS', 43, 'Sollen Empfohlene Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Sonderangebote anzeigen', 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Startseite: Artikelankündigungen anzeigen', 'SHOW_PRODUCT_INFO_MAIN_UPCOMING', 43, 'Sollen kommende Artikel auf der Startseite angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS', 43, 'Sollen neue Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS', 43, 'Sollen empfohlene Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierunge fest)', now(), now()),
('Kategorien mit Unterkategorien: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Kategorien mit Unterkategorien: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING', 43, 'Sollen kommende Artikel in Kategorien mit Unterkategorien angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS', 43, 'Sollen neue Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS', 43, 'Sollen empfohlene Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS', 43, 'Sollen Sonderangebote auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Fehlerseiten: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_MISSING_UPCOMING', 43, 'Sollen kommende Artikel auf Fehlerseiten angezeigt werden?<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Neue Artikel" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS', 43, 'Neue Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Empfohlene Artikel" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS', 43, 'Empfohlene Artikel unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Sonderangebote" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS', 43, 'Sonderangebote unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Artikelliste: "Artikelankündigungen" anzeigen', 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING', 43, 'Artikelankündigungen unter Artikelliste anzeigen<br />0= nein (oder legen Sie die Sortierung fest)', now(), now()),
('Neue Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Empfohlene Artikel: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Sonderangebote: Spalten pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS', 43, 'Wieviele Spalten wollen Sie pro Reihe anzeigen lassen?', now(), now()),
('Artikelliste: Artikel in den Centerboxen filtern', 'SHOW_PRODUCT_INFO_ALL_PRODUCTS', 43, 'Filter für die Artikel in den Centerboxen "Neue Artikel", "Empfohlene Artikel", "Sonderangebot" und "Artikelankündigungen".<br><br>1= Filter ein. es werden nur Artikel aus der jeweiligen Hauptkategorie inkl. deren Unterkategorien angezeigt.<br>0= Filter aus, es werden Artikel aus allen Kategorien angezeigt.', now(), now()),

# Adminmenü ID 25 Eigene Seiten/Define Pages
('Startseite', 'DEFINE_MAIN_PAGE_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_main_page.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Schreiben Sie uns', 'DEFINE_CONTACT_US_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_contact_us.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Datenschutz', 'DEFINE_PRIVACY_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_privacy.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Versandbedingungen', 'DEFINE_SHIPPINGINFO_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_shippinginfo.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('AGB', 'DEFINE_CONDITIONS_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_conditions.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Bestellung erfolgreich', 'DEFINE_CHECKOUT_SUCCESS_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_checkout_success.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Aktionskupons', 'DEFINE_DISCOUNT_COUPON_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_discount_coupon.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Sitemap', 'DEFINE_SITE_MAP_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_site_map.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('404 ERROR - Seite nicht gefunden', 'DEFINE_PAGE_NOT_FOUND_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_not_found.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 2', 'DEFINE_PAGE_2_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_2.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 3', 'DEFINE_PAGE_3_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_3.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Seite 4', 'DEFINE_PAGE_4_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_page_4.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Widerrufsrecht', 'DEFINE_WIDERRUFSRECHT_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_widerrufsrecht.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Impressum', 'DEFINE_IMPRESSUM_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_impressum.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),
('Zahlungsarten', 'DEFINE_ZAHLUNGSARTEN_STATUS', 43, 'Den Inhalt für diese Seite können Sie über <em>Tools->Seiteneditor</em> bearbeiten.<br /><strong>Zuständige Datei: <em>define_zahlungsarten.php</em></strong><br /><br />BESCHREIBUNG:<br /><em>Link EIN</em> bedeutet, dass der Link in der Infobox sichtbar ist.<br /><em>Text AUS</em> bedeutet, dass der definierte Seitentext nicht eingeblendet wird.<br /><br />OPTIONEN:<br />0= Link EIN, Text AUS<br />1= Link EIN, Text EIN<br />2= Link AUS, Text EIN<br />3= Link AUS, Text AUS<br />', now(), now()),

# Adminmenü ID 30 - EZ Page Einstellungen
('Kopfzeile anzeigen', 'EZPAGES_STATUS_HEADER', 43, 'Sollen die EZ-Pages Kopfzeilen global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Fusszeile anzeigen', 'EZPAGES_STATUS_FOOTER', 43, 'Sollen die EZ-Pages Fusszeilen global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Sidebox anzeigen', 'EZPAGES_STATUS_SIDEBOX', 43, 'Sollen die EZ-Pages Sidebox global angezeigt werden?<br />0= NEIN<br />1= JA<br />2= JA (Nur Admin-IP: siehe Shopwartung)<br />Anmerkung: Seite kann nur von Admin gesehen werden', now(), now()),
('Trennzeichen für Links in Kopfzeile', 'EZPAGES_SEPARATOR_HEADER', 43, 'Welche Trennzeichen sollen für Links in der EZ-Pages Kopfzeile angezeigt werden?<br />Standard = & ::& ', now(), now()),
('Trennzeichen für Links in Fusszeile', 'EZPAGES_SEPARATOR_FOOTER', 43, 'Welche Trennzeichen sollen für Links in der EZ-Pages Fusszeile angezeigt werden?<br />Standard = & ::& ', now(), now()),
('Vor/Zurück Schaltflächen', 'EZPAGES_SHOW_PREV_NEXT_BUTTONS', 43, 'Sollen Vor/Zurück Schaltflachen für EZ-Pages angezeigt werden?<br />0=NEIN (keine Schaltflächen)<br />1="Weiter"<br />2="Zurück/Weiter/Vor"<br /><br />Standard = 2', now(), now()),
('Inhaltsverzeichnis für Kapitel anzeigen', 'EZPAGES_SHOW_TABLE_CONTENTS', 43, 'Soll das EZ-Pages Inhaltsverzeichnis für Kapitel angezeigt werden?<br />0= NEIN<br />1= JA', now(), now()),
('In diesen Seiten keine Kopfzeile anzeigen', 'EZPAGES_DISABLE_HEADER_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine Kopfzeile angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine Fusszeile anzeigen', 'EZPAGES_DISABLE_FOOTER_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine Fusszeile angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine linke Spalte anzeigen', 'EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine linken Spalten (der Sideboxen) angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),
('In diesen Seiten keine rechte Spalte anzeigen', 'EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST', 43, 'Geben Sie hier die "Seiten" der EZ-Pages an, in der keine rechten Spalten (der Sideboxen) angezeigt werden sollen.<br />Seiten IDs durch Komma getrennt (ohne Leerzeichen) eingeben.<br />Seiten IDs können in der EZ-Pages Ansicht über <em>Admin->Tools->EZ-Pages</em> ermittelt werden.<br />z.B. 3,7<br />oder leer lassen.', now(), now()),

# Adminmenü ID 31 - Minify
('Minify für Javascripts aktivieren', 'MINIFY_STATUS_JS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. Javascripts werden kombiniert und komprimiert. Wollen Sie Minify für Javascripts aktivieren?<br>HINWEIS: Achten Sie darauf, dass das Verzeichnis cache/minify Schreibrechte (chmod 777) hat!', now(), now()),
('Minify für Stylesheets aktivieren', 'MINIFY_STATUS_CSS', 43, 'Minify erhöht die Ladegeschwindigkeit Ihrer Website. CSS Dateien werden kombiniert und komprimiert. Wollen Sie Minify für CSS Stylesheets aktivieren?<br>HINWEIS: Achten Sie darauf, dass das Verzeichnis cache/minify Schreibrechte (chmod 777) hat!', now(), now()),
('Maximale URL Länge', 'MINIFY_MAX_URL_LENGHT', 43, 'Auf manchen Servern ist die Länge von POST/GET URLs beschränkt. Falls das auf Ihren Server zutrifft, können Sie hier den Wert verändern. Voreingestellt: 500', now(), now()),
('Minify Cache Zeit', 'MINIFY_CACHE_TIME_LENGHT', 43, 'Stellen Sie hier die Cache Zeit für Minify ein. Voreingestellt ist ein Jahr (31536000)', now(), now()),
('zuletzt gecached', 'MINIFY_CACHE_TIME_LATEST', 43, 'Hier müssen Sie normalerweise nichts einstellen. Falls Sie gerade Änderungen an Ihren CSS und Javascripts vorgenommen haben und erzwingen wollen, dass diese Änderungen sofort wirksam sind, stellen Sie auf 0.', now(), now()),

# Adminmenü ID 32 - Spamschutz - already set

# Adminmenü ID 33 - Open Graph / Microdata
('Open Graph - Open Graph aktivieren', 'FACEBOOK_OPEN_GRAPH_STATUS', 43, 'Wollen Sie die Open Graph/Microdaten aktivieren?', now(), now()),
('Open Graph - Anwendungsnummer', 'FACEBOOK_OPEN_GRAPH_APPID', 43, 'Tragen Sie hier Ihre Anwendungsnummer / Application ID ein. Falls Sie noch keine haben:<br><a href="http://developers.facebook.com/setup/" target="_blank">Application ID beantragen</a>', now(), now()),
('Open Graph - Anwendungs Geheimcode', 'FACEBOOK_OPEN_GRAPH_APPSECRET', 43, 'Tragen Sie Ihren Anwendungs Geheimcode / Application Secret Key ein.', now(), now()),
('Open Graph - Admin ID', 'FACEBOOK_OPEN_GRAPH_ADMINID', 43, 'Geben Sie die Admin ID(s) des oder der Facebook User an, die Ihre Facebook Fanseite administrieren. Wenn das mehrere sind, geben Sie die IDs mit Komma getrennt ein. Infos dazu:<br><a href="http://www.facebook.com/insights/" target="_blank">Insights for your domain</a>', now(), now()),
('Open Graph - Standard Bild', 'FACEBOOK_OPEN_GRAPH_DEFAULT_IMAGE', 43, 'Geben Sie den vollen Pfad zu einem Standardbild an oder lassen Sie dieses Feld leer, um kein Standardbild zu verwenden. Ein hier eingestelltes Standardbild wird nur verwendet, wenn kein Artikelbild gefunden wird und stellt so sicher, dass zumindest ein passendes Bild bei Facebook gepostet wird.', now(), now()),
('Open Graph - Objekt Typ', 'FACEBOOK_OPEN_GRAPH_TYPE', 43, 'Geben Sie hier einen Open Graph Object Type für Ihre Artikel ein. Beispiel: product<br>Infos dazu:<br><a href="https://developers.facebook.com/docs/reference/opengraph/" target="_blank">Open Graph Object Types</a>', now(), now()),
('Open Graph - Kategoriepfad in den URLs?', 'FACEBOOK_OPEN_GRAPH_CPATH', 43, 'Sollen Ihre URLs für Facebook den cPath enthalten?', now(), now()),
('Open Graph - Sprache in den Links?', 'FACEBOOK_OPEN_GRAPH_LANGUAGE', 43, 'Sollen Ihre URLs das Anhängsel für die Sprache enthalten?', now(), now()),
('Open Graph - Kanonische URLs verwenden?', 'FACEBOOK_OPEN_GRAPH_CANONICAL', 43, 'Wollen Sie die kanonische URL der Seite verwenden (empfohlen) oder versuchen, die URL neu zu generieren?', now(), now()),
('Open Graph - Google Publisher', 'FACEBOOK_OPEN_GRAPH_GOOGLE_PUBLISHER', 43, 'Tragen Sie den vollständigen Link zu Ihrer Google Publisher / Google Plus URL ein  (https://plus.google.com/+xxx/)', now(), now()),
('Open Graph - Shoplogo', 'FACEBOOK_OPEN_GRAPH_LOGO', 43, 'Tragen Sie den vollständigen Link zu Ihrem Shoplogo ein, das für die Microdaten verwendet werden soll. Das Bild sollte per https erreichbar sein!  (https://www.meinshop.de/shoplogo.png)', now(), now()),
('Open Graph - Adresse des Shops - Strasse', 'FACEBOOK_OPEN_GRAPH_STREET_ADDRESS', 43, 'Tragen Sie die Strasse Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Stadt', 'FACEBOOK_OPEN_GRAPH_CITY', 43, 'Tragen Sie die Stadt Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Bundesland', 'FACEBOOK_OPEN_GRAPH_STATE', 43, 'Tragen Sie das Bundesland Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - PLZ', 'FACEBOOK_OPEN_GRAPH_ZIP', 43, 'Tragen Sie die Postleitzahl Ihres Shops ein.', now(), now()),
('Open Graph - Adresse des Shops - Land', 'FACEBOOK_OPEN_GRAPH_COUNTRY', 43, 'Tragen Sie das Land Ihres Shops ein. Zweistelliger Ländercode, z.B. DE', now(), now()),
('Open Graph - Emailadresse Kundensevice', 'FACEBOOK_OPEN_GRAPH_EMAIL', 43, 'Tragen Sie die Emailadresse Ihres Kundenservice ein.', now(), now()),
('Open Graph - Telefonnummer Kundenservice', 'FACEBOOK_OPEN_GRAPH_PHONE', 43, 'Tragen Sie die Telefonnummer Ihres Kundenservice ein.', now(), now()),
('Open Graph - Twitter User', 'FACEBOOK_OPEN_GRAPH_TWUSER', 43, 'Tragen Sie Ihren Twitter Usernamen ein mit @ davor.<br>Bsp: @meintwitteruser.', now(), now()),
('Open Graph - Facebook Page', 'FACEBOOK_OPEN_GRAPH_FBPG', 43, 'Tragen Sie die volle URL zu Ihrer Facebook Page ein.<br>Bsp: https://www.facebook.com/meinonlineshop', now(), now()),
('Open Graph - Sprache', 'FACEBOOK_OPEN_GRAPH_LOCALE', 43, 'Tragen Sie Ihre Hauptsprache ein.<br>Voreinstellung: German', now(), now()),
('Open Graph - Währung', 'FACEBOOK_OPEN_GRAPH_CUR', 43, 'Tragen Sie Ihre Währung ein ein.<br>Voreinstellung: EUR', now(), now()),
('Open Graph - Lieferzeit', 'FACEBOOK_OPEN_GRAPH_DTS', 43, 'Tragen Sie Ihre durchschnittliche Lieferzeit in Tagen ein.<br>Bsp: 2', now(), now()),
('Open Graph - Zustand der Artikel', 'FACEBOOK_OPEN_GRAPH_COND', 43, 'Tragen Sie den Zustand Ihrer Artikel ein.<br>Mögliche Werte: NewCondition, UsedCondition, RefurbishedCondition, DamagedCondition', now(), now()),
('Open Graph - Zahlungsart 1', 'FACEBOOK_OPEN_GRAPH_PAY1', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 2', 'FACEBOOK_OPEN_GRAPH_PAY2', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 3', 'FACEBOOK_OPEN_GRAPH_PAY3', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 4', 'FACEBOOK_OPEN_GRAPH_PAY4', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 5', 'FACEBOOK_OPEN_GRAPH_PAY5', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Zahlungsart 6', 'FACEBOOK_OPEN_GRAPH_PAY6', 43, 'Geben Sie EINE der folgenden Zahlungsarten EXAKT so ein: (ByBankTransferInAdvance, ByInvoice, Cash, CheckInAdvance, COD, DirectDebit, PayPal, PaySwarm, AmericanExpress, DinersClub, Discover, JCB, MasterCard, VISA)', now(), now()),
('Open Graph - Steuernummer', 'FACEBOOK_OPEN_GRAPH_TID', 43, 'Tragen Sie Ihre Steuernummer ein.', now(), now()),
('Open Graph - DUNS Nummer', 'FACEBOOK_OPEN_GRAPH_DUNS', 43, 'Tragen Sie Ihre Dun & Bradstreet DUNS Nummer ein.', now(), now()),
('Open Graph - Faxnummer', 'FACEBOOK_OPEN_GRAPH_FAX', 43, 'Tragen Sie Ihre Faxnummer ein.', now(), now()),
('Open Graph - UID', 'FACEBOOK_OPEN_GRAPH_VAT', 43, 'Tragen Sie Ihre UID ein.', now(), now()),
('Open Graph - Firmenname', 'FACEBOOK_OPEN_GRAPH_LEG', 43, 'Tragen Sie Ihren offiziellen Firmennamen ein.', now(), now()),
('Open Graph - Region', 'FACEBOOK_OPEN_GRAPH_AREA', 43, 'Optional. Die geografische Region, die durch die Nummer bedient wird, die als Schema. org/Administrationsbereich angegeben ist. Länder können, wie in den Beispielen rechts gezeigt, nur mit ihrem Standard ISO-3166-Zweibuchstabencode präzise spezifiziert werden. Wenn diese Angabe weggelassen wird, wird davon ausgegangen, dass die Zahl global ist...', now(), now()),
('Open Graph - Twitter Page', 'FACEBOOK_OPEN_GRAPH_TWIT', 43, 'Tragen Sie die vollständige URL zu Ihrer Twitter Seite ein.<br>Beispiel: https://twitter.com/xxx', now(), now()),
('Open Graph - Linkedin Page', 'FACEBOOK_OPEN_GRAPH_LINK', 43, 'Tragen Sie die vollständige URL zu Ihrer LinkedIn Page ein.<br>Beispiel: http://www.linkedin.com/company/xxx/.', now(), now()),
('Open Graph - Weitere Profil Page', 'FACEBOOK_OPEN_GRAPH_PROF1', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br>Beispiel: https://www.dandb.com/businessdirectory/xxx.html', now(), now()),
('Open Graph - Weitere Profil Page 2', 'FACEBOOK_OPEN_GRAPH_PROF2', 43, 'Tragen Sie die vollständige URL zu einer weiteren Profil Seite ein, die Sie nutzen.<br>Beispiel: http://www.yelp.com/biz/xxx', now(), now()),
('Open Graph - Belieferte Regionen', 'FACEBOOK_OPEN_GRAPH_ELER', 43, 'Der ISO 3166-1 (ISO 3166-1 alpha-2) oder ISO 3166-2 Code, oder die GeoShape für die geopolitische(n) Region(en), für die die Angebots- oder Lieferkostenangabe gültig ist. Wie z.B. US ', now(), now()),

# Adminmenü ID 34 - RSS Feed
('RSS - RSS Feeds aktivieren?', 'RSS_FEED_ENABLED', 43, 'Wollen Sie die RSS Feeds aktivieren?', now(), now()),
('RSS - Titel', 'RSS_TITLE', 43, 'RSS Titel (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Beschreibung', 'RSS_DESCRIPTION', 43, 'RSS Beschreibung', now(), now()),
('RSS - Bild', 'RSS_IMAGE', 43, 'ein GIF, JPEG oder PNG Bild, das das RSS Feed illustriert', now(), now()),
('RSS - Bild Name', 'RSS_IMAGE_NAME', 43, 'RSS Bild Name (falls leer verwende den Shopnamen)', now(), now()),
('RSS - Copyright', 'RSS_COPYRIGHT', 43, 'RSS Copyright (falls leer verwende den Shopinhaber)', now(), now()),
('RSS - Editor', 'RSS_MANAGING_EDITOR', 43, 'RSS Managing Editor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Webmaster', 'RSS_WEBMASTER', 43, 'RSS Webmaster (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Author', 'RSS_AUTHOR', 43, 'RSS Autor (falls leer verwende die Shopinhaber Emailadresse und den Shopinhaber)', now(), now()),
('RSS - Home Page Feed', 'RSS_HOMEPAGE_FEED', 43, 'RSS Home Page Feed - Standardwert Neue Artikel', now(), now()),
('RSS - Default Feed', 'RSS_DEFAULT_FEED', 43, 'RSS Default Feed - Standardwert Neue Artikel', now(), now()),
('RSS - HTML Tags ausfiltern', 'RSS_STRIP_TAGS', 43, 'HTML Tags ausfiltern? Standardwert: false', now(), now()),
('RSS - Erzeuge Beschreibung', 'RSS_ITEMS_DESCRIPTION', 43, 'Soll die Artikelbeschreibung im Feed erscheinen?', now(), now()),
('RSS - Länge der Beschreibung', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', 43, 'Wollen Sie den Beschreibungstext auf eine bestimmte Länge beschränken? (0 für kein Limit)', now(), now()),
('RSS - Lebensdauer des Feeds', 'RSS_TTL', 43, 'Lebensdauer - Zeit in Minuten nach der ein RSS Reader das Feed refreshen soll - Standardwert: 1440', now(), now()),
('RSS - Standard Artikel Limit', 'RSS_PRODUCTS_LIMIT', 43, 'Wieviele Artikel soll das RSS Feed enthalten? Standardwert: 100', now(), now()),
('RSS - Füge Artikelbild hinzu', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 43, 'Soll das Artikelbild im Feed erscheinen?', now(), now()),
('RSS - Füge Jetzt kaufen Button hinzu', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 43, 'Soll der Jetzt kaufen Button im Feed erscheinen?', now(), now()),
('RSS - Kategorien für Artikel', 'RSS_PRODUCTS_CATEGORIES', 43, 'Wenn ein cPath mit angegeben wird, sollen die Artikel, dann nur aus der Masterkategorie kommen oder aus allen Kategorien? (wichtig bei verlinkten Artikeln)', now(), now()),
('RSS - Cache', 'RSS_CACHE_TIME', 43, 'Dauer des Feed Cachings in Minuten (es werden Feed Files im cache Ordner abgelegt). Wenn Sie kein Caching verwenden wollen stellen Sie auf 0', now(), now()),

# Adminmenü ID 35 - Zen Colorbox
('<b>Zen Colorbox</b>', 'ZEN_COLORBOX_STATUS', 43, 'Wollen Sie für die Vergrösserung Ihrer Artikelbilder einen Lightboxeffekt nutzen?<br><br>Voreinstellung = true<br>', now(), now()),
('Overlay Transparenz', 'ZEN_COLORBOX_OVERLAY_OPACITY', 43, 'Gewünschte Transparenz des Overlays<br><br>Voreinstellung = 0.6<br>', now(), now()),
('Dauer der Bildvergrösserung', 'ZEN_COLORBOX_RESIZE_DURATION', 43, 'Geschwindigkeit in Millisekunden<br><br>Voreinstellung = 400<br>', now(), now()),
('Anfangs Bildbreite', 'ZEN_COLORBOX_INITIAL_WIDTH',  43, 'Breite des Artikelbildes beim ersten Aufruf<br><br>Voreinstellung = 250<br>', now(), now()),
('Anfangs Bildhöhe', 'ZEN_COLORBOX_INITIAL_HEIGHT', 43, 'Höhe des Artikelbildes beim ersten Aufruf<br><br>Voreinstellung = 250<br>', now(), now()),
('Bildzähler anzeigen', 'ZEN_COLORBOX_COUNTER', 43, 'Soll innerhalb der Lightbox eine Anzeige zur Anzahl der Bilder erscheinen?<br><br>Voreinstellung = true<br>', now(), now()),
('Beim Click aufs Overlay schliessen?', 'ZEN_COLORBOX_CLOSE_OVERLAY', 43, 'Soll die Lightbox beim Clicken auf das Overlay geschlossen werden?<br><br>Voreinstellung = false<br>', now(), now()),
('Loop', 'ZEN_COLORBOX_LOOP', 43, 'Wenn auf true gestellt vergrößern sich die Bilder in beide Richtungen<br><br>Voreinstellung = true<br>', now(), now()),
('<b>Slideshow</b>', 'ZEN_COLORBOX_SLIDESHOW',  43, 'Sollen die zusätzlichen Artikelbilder in einer Slideshow angezeigt werden?<br><br>Voreinstellung = false<br>', now(), now()),
('&nbsp; Slideshow Autostart', 'ZEN_COLORBOX_SLIDESHOW_AUTO', 43, 'Slideshow automatisch starten?<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Slideshow Geschwindigkeit', 'ZEN_COLORBOX_SLIDESHOW_SPEED', 43, 'Geschwindigkeit der Slideshow in Millisekunden<br><br>Voreinstellung = 2500<br>', now(), now()),
('&nbsp; Slideshow Start Text', 'ZEN_COLORBOX_SLIDESHOW_START_TEXT', 43, 'Text des Links zum Starten der Slideshow<br><br>Voreinstellung = start slideshow<br>', now(), now()),
('&nbsp; Slideshow Stop Text', 'ZEN_COLORBOX_SLIDESHOW_STOP_TEXT', 43, 'Text des Links zum Stoppen der Slideshow<br><br>Voreinstellung = stop slideshow<br>', now(), now()),
('<b>Galerie Modus</b>', 'ZEN_COLORBOX_GALLERY_MODE', 43, 'Sollen die zusätzlichen Artikelbilder in einer Galerie zum Durchblättern erscheinen<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Hauptbild in Galerie aufnehmen?', 'ZEN_COLORBOX_GALLERY_MAIN_IMAGE', 43, 'Soll das Hauptartikelbild Bestandteil der Galerieansicht sein?<br><br>Voreinstellung = true<br>', now(), now()),
('<b>EZ-Pages Unterstützung</b>', 'ZEN_COLORBOX_EZPAGES', 43, 'Soll der Lightbox Effekt auch auf Bilder in den EZ Pages angewandt werden?<br><br>Voreinstellung = true<br>', now(), now()),
('&nbsp; Dateitypen', 'ZEN_COLORBOX_FILE_TYPES', 43, 'Auf den EZ-Pages wird der Lightbox Effekt auf alle Bilder mit folgenden Dateitypen angewandt:<br><br>Voreinstellung = jpg,png,gif<br>', now(), now()),


# Adminmenü ID 36 - IT Recht Kanzlei
('Version', 'IT_RECHT_KANZLEI_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('IT Recht Kanzlei - Ist das Modul aktiv?', 'IT_RECHT_KANZLEI_STATUS', 43, 'Wollen Sie die Schnittstelle der IT Recht Kanzlei aktivieren?<br>Bitte erst dann aktivieren, wenn Sie sich mit der Funktionsweise vertraut gemacht haben.', now(), now()),
('IT Recht Kanzlei - API Token', 'IT_RECHT_KANZLEI_TOKEN', 43, 'Authentifizierungs-Token den Sie zur Übertragung im Mandantenportal der IT-Recht Kanzlei angeben.<br>Diese Token können Sie hier nicht ändern. Falls Sie eine neue Token erstellen wollen, nutzen Sie dazu die entsprechende Option unter Tools > IT Recht Kanzlei.', now(), now()),
('IT Recht Kanzlei - API Version', 'IT_RECHT_KANZLEI_VERSION',  43, 'API Version der IT Recht Kanzlei Schnittstelle', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext AGB', 'IT_RECHT_KANZLEI_PAGE_KEY_AGB', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die AGB angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die AGB automatisch eingefügt.<br>Voreinstellung: itrk-agb', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Datenschutzerklärung', 'IT_RECHT_KANZLEI_PAGE_KEY_DATENSCHUTZ', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Datenschutzerklärung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Datenschutzerklärung automatisch eingefügt<br>Voreinstellung: itrk-datenschutz.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Widerrufsbelehrung', 'IT_RECHT_KANZLEI_PAGE_KEY_WIDERRUF', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für die Widerrufsbelehrung angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für die Widerrufsbelehrung automatisch eingefügt<br>Voreinstellung: itrk-widerruf.', now(), now()),
('IT Recht Kanzlei - EZ Page Kennung für Rechtstext Impressum', 'IT_RECHT_KANZLEI_PAGE_KEY_IMPRESSUM', 43, 'Bitte geben Sie die Kennung der EZ Page an, die Sie für das Impressum angelegt haben. Die EZ Page wurde bei der Modulinstallation bereits entsprechend angelegt. In diese Seite wird dann der Rechtstext für das Impressum automatisch eingefügt.<br>Voreinstellung: itrk-impressum', now(), now()),
('IT Recht Kanzlei - AGB auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_AGB',  43, 'Sollen die AGB auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Datenschutzerklärung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_DATENSCHUTZ', 43, 'Soll die Datenschutzerklärung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Widerrufsbelehrung auch als pdf abrufen?', 'IT_RECHT_KANZLEI_PDF_WIDERRUF', 43, 'Soll die Widerrufsbelehrung auch als pdf verfügbar sein?', now(), now()),
('IT Recht Kanzlei - Speicherort der pdf Dateien', 'IT_RECHT_KANZLEI_PDF_FILE', 43, 'In welchem Ordner am Server sollen die pdf Dateien gespeichert werden?<br>Lassen Sie diese Einstellung auf includes/pdf, damit das Modul pdf Rechnung falls installiert auf die pdfs zugreifen kann.', now(), now()),

# Adminmenü ID 37 - pdf Rechnung
('Version', 'RL_INVOICE3_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('pdf Rechnung - Status', 'RL_INVOICE3_STATUS', 43, 'Wollen Sie das Modul pdf Rechnung aktivieren?<br>In der Administration können Sie auch pdf Rechnungen erstellen, wenn Sie hier auf false stellen. Um die Funktionalität des Mitsendens von Rechnung und Anhängen in den Mails zu nutzen, müssen Sie aber hier auf true stellen.<br>Aktivieren Sie das Modul erst dann, wenn Sie Ihre Rechnungsvorlage und Anhänge wie AGB und Widerruf erstellt haben und sich mit der Funktionalität vertraut gemacht haben.', now(), now()),
('pdf Rechnung - Rechnungsdatum = Bestelldatum?', 'RL_INVOICE3_ORDERDATE', 43, 'Soll das Rechnungsdatum das Datum der Bestellung sein (true) oder das Datum, an dem die pdf Rechnung erzeugt wird? (false)', now(), now()),
('pdf Rechnung - Kundennummer auf der Rechnung?', 'RL_INVOICE3_CUSTOMERID', 43, 'Wollen Sie die Kundennummer auf der pdf Rechnung anzeigen?', now(), now()),
('pdf Rechnung - Lieferadresse anzeigen?', 'RL_INVOICE3_SHIPPING_ADDRESS', 43, 'Wollen Sie die Lieferadresse auf der pdf Rechnung anzeigen?', now(), now()),
('pdf Rechnung - XY-Position der Adresse1', 'RL_INVOICE3_ADDRESS1_POS', 43, 'XY-Position der Adresse1; es ist das Delta zu den Rändern einzugeben<br />Standard: 89|21', now(), now()),
('pdf Rechnung - XY-Postion der Adresse2', 'RL_INVOICE3_ADDRESS2_POS', 43, 'XY-Postion der Adresse2; es ist das Delta zu den Rändern einzugeben<br />Standard: 0|21', now(), now()),
('pdf Rechnung - Rändereinstellungen für Adresse1|2', 'RL_INVOICE3_ADDRESS_BORDER', 43, 'Rändereinstellungen für Adresse1|2<br />LTRB (Left Top Right Bottom)<br />Standard: |<br />Es wird also kein Rahmen um die Adressen angezeigt. Wollen Sie um die Adressen einen vollständigen Rahmen anzeigen, dann ändern Sie auf LTRB|LTRB', now(), now()),
('pdf Rechnung - Breite von Adressfeld1|2', 'RL_INVOICE3_ADDRESS_WIDTH', 43, '<br />Standard: 80|80', now(), now()),
('pdf Rechnung - Deltas', 'RL_INVOICE3_DELTA', 43, 'Abstand Adresse:Rechnungsnummer | Abstand Rechnungsnummer:Produktliste<br />Standard: 5|8<br />', now(), now()),
('pdf Rechnung - Schriftarten für Rechnung und Artikel', 'RL_INVOICE3_FONTS', 43, 'Welche Schriftarten wollen Sie verwenden? <br />1. Für Rechnungstexte <br >2. Für Artikel und Summe<br /><br />Standard: myriadpc|myriadpc<br />(Pfad/und Schriftart für Rechnung|Pfad/und Schriftart für Artikel und Summe<br />', now(), now()),
('pdf Rechnung - Zeilenhöhe', 'RL_INVOICE3_LINE_HEIGT', 43, 'Zeilenhöhe', now(), now()),
('pdf Rechnung - Dicke der Striche bei Gesamtsumme', 'RL_INVOICE3_LINE_THICK', 43, 'Wie dick soll der Strich bei der Gesamtsumme sein?', now(), now()),
('pdf Rechnung - Rändereinstellungen', 'RL_INVOICE3_MARGIN', 43, 'Format: oben|rechts|unten|links<br />(Hinweis: 1inch = 72pt / 2.54cm; 1cm = 28,35pt)<br />Standard: 20|20|20|20<br />', now(), now()),
('pdf Rechnung - Rechnung bei Gratisprodukt', 'RL_INVOICE3_NOT_NULL_INVOICE', 43, 'Soll die Rechnung auch bei einem Gratisprodukt dem Mail hinzugefügt werden?', now(), now()),
('pdf Rechnung - Rechnungsversand bei Bestellstatus', 'RL_INVOICE3_ORDERSTATUS', 43, 'Rechnung nur mitschicken, wenn der Bestellstatus grösser/gleich ist [default: 3 == verschickt]', now(), now()),
('pdf Rechnung - Präfix für Rechnungsnummer in der Rechnung', 'RL_INVOICE3_ORDER_ID_PREFIX', 43, 'Präfix für Rechnungsnummer in der Rechnung<br />Beispiel: : 2022/<br />', now(), now()),
('pdf Rechnung - Papiergrösse|Einheit|Orientierung', 'RL_INVOICE3_PAPER', 43, '1. Papiergrösse = A3|A4|A5|Letter|Legal <br />2. Einheit: pt|mm|cm|inch <br />3. Orientierung: L|P<br />', now(), now()),
('pdf Rechnung - PDF Hintergrunddatei', 'RL_INVOICE3_PDF_BACKGROUND', 43, 'PDF Hintergrunddatei<br />Standard: /www/htdocs/xxx/xxx/includes/pdf/rechnung_de.pdf<br />', now(), now()),
('pdf Rechnung - Speicherort und -name der PDF-Datei', 'RL_INVOICE3_PDF_PATH', 43, '1. Wo sollen PDF-Dateien gespeichert werden (!! muss beschreibbar sein !!)?<br />2. speichern ja|nein (1|0)<br />Standard: /www/htdocs/xxx/xxx/includes/pdf/|1<br />', now(), now()),
('pdf Rechnung - Anhänge', 'RL_INVOICE3_SEND_ATTACH', 43, 'Welche PDFs sollen noch angehängt werden; bei mehreren Dateien | (pipe) als Trenner verwenden)<br><br>Voreinstellung: agb_de.pdf|widerruf_de.pdf', now(), now()),
('pdf Rechnung - Rechnungsneuversand', 'RL_INVOICE3_SEND_ORDERSTATUS_CHANGE', 43, 'Bei welcher Änderung des Bestellstatus soll die Rechnung [nochmals] versendet werden', now(), now()),
('pdf Rechnung - Rechnung bei Bestellung', 'RL_INVOICE3_SEND_PDF', 43, 'Soll die Rechnung gleich bei der Bestellung gesendet werden?', now(), now()),
('pdf Rechnung - Template für Artikel- und Summentabelle', 'RL_INVOICE3_TABLE_TEMPLATE', 43, 'Template für Artikel- und Summentabelle<br />Definition ist in includes/pdf/rl_invoice3_def.php<br />Standard: 30|30|30|60<br />Standard: amazon|amazon_templ|total_col_1|total_opt_1<br />', now(), now()),
('pdf Rechnung - PDF-Template auf 1.Seite', 'RL_INVOICE3_TEMPLATE_ONLY_FIRST_PAGE', 43, 'PDF-Template nur auf 1.Seite drucken', now(), now()),
('pdf Rechnung - Abstand 2.Seite', 'RL_INVOICE3_DELTA_2PAGE', 43, 'Zusätzlicher Abstand auf 2. Seite', now(), now()),

# Adminmenü ID 38 - Shopvote
('Shopvote - Version', 'SHOPVOTE_MODUL_VERSION', 43, 'Installierte Version:', now(), now()),
('Shopvote - Ist das Modul aktiv?', 'SHOPVOTE_STATUS', 43, 'Wollen Sie das Shopvote Siegel und die Easy Reviews Bewertungsanfragen aktivieren?<br>Bitte erst dann aktivieren, wenn Sie Zugriff auf die entsprechenden Javascript Snippets in Ihrer Shopvote Administration bekommen und die Einstellungen unten komplett vorgenommen haben.', now(), now()),
('Shopvote - Shop ID', 'SHOPVOTE_SHOP_ID', 43, 'Tragen Sie hier Ihre Shopvote Shop ID ein', now(), now()),
('Shopvote - Easy Reviews Token', 'SHOPVOTE_EASY_REVIEWS_TOKEN', 43, 'Tragen Sie hier Ihre Shopvote Token für Easy Reviews ein', now(), now()),
('Shopvote - Badge Typ', 'SHOPVOTE_BADGE_TYPE', 43, 'Wählen Sie die Art des Shopvote Siegels aus, das am unteren rechten Bildschirmrand angezeigt werden soll.<br>Zur Verfügung stehen hier die Badge Typen, die automatisch die Funktion Rating Stars (falls bei Shopvote gebucht) unterstützen, so dass Sie dafür keinerlei Code integrieren müssen.<br>Eine Vorschau der verschiedenen Badges finden Sie unter Grafiken & Siegel in Ihrer Shopvote Administration.<br>Für die Nutzung der All Votes Grafik müssen Sie bei Shopvote freigeschaltet sein.<br><br />1 = Vote Badge I (klein, ohne Siegel)<br>2 = Vote Badge III (groß)<br>3 = Vote Badge II (klein)<br>4 = All Votes Grafik I<br /><br>', now(), now()),
('Shopvote - Vote Badge I - Abstand links/rechts', 'SHOPVOTE_SPACE_X', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom rechten/linken Bildschirmrand<br>darf nicht kleiner als 2 sein', now(), now()),
('Shopvote - Vote Badge I - Abstand oben/unten', 'SHOPVOTE_SPACE_Y', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Abstand in Pixeln vom oberen/unteren Bildschirmrand<br>darf nicht kleiner als 5 sein', now(), now()),
('Shopvote - Vote Badge I - links oder rechts', 'SHOPVOTE_ALIGN_H', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>horizontale Ausrichtung links oder rechts<br>left = links, right = rechts', now(), now()),
('Shopvote - Vote Badge I - oben oder unten', 'SHOPVOTE_ALIGN_V', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>vertikale Ausrichtung oben oder unten<br>top = oben, bottom = unten', now(), now()),
('Shopvote - Vote Badge I - auf kleineren Display ausblenden', 'SHOPVOTE_DISPLAY_WIDTH', 43, 'Nur relevant für die Badget Grafik Vote Badge I (klein, ohne Siegel)<br>Display-Breite in Pixeln, bis zu der die Badget-Grafik ausgeblendet wird<br>Voreinstellung: 480<br>Dadurch wird die Grafik auf kleineren Smartphones nicht angezeigt und kann Ihre Seite nicht überlagern.', now(), now()),

# Adminmenü ID 39 - Cross Sell
('Minimale Anzeige Cross-Sell Artikel', 'MIN_DISPLAY_XSELL', 43, 'Anzahl der Cross Sell Artikel, die mindestens für den jeweiligen Artikel angelegt sein müssen, damit die Cross Sell Info erscheint.<br />Standardwert: 1', now(), now()),
('Maximale Anzeige Cross-Sell Artikel', 'MAX_DISPLAY_XSELL', 43, 'Geben Sie die maximale Anzahl der Cross-Sells an, die im Frontend angezeigt werden sollen (Standard: <b>6</b>).<br><br>Setzen Sie den Wert auf <b>0</b>, um die Anzeige im Frontend zu deaktivieren.', now(), now()),
('Cross-Sell Artikel pro Reihe', 'SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', 43, 'Geben Sie die Anzahl der Cross-Sells an, die pro Zeile (im Frontend) angezeigt werden sollen.  Setzen Sie den Wert auf <em>0</em>, um <em>alle</em> Produkte in einer einzigen Zeile anzuzeigen.  Voreinstellung: <b>3</b>.', now(), now()),
('Cross-Sell - Preis anzeigen?', 'XSELL_DISPLAY_PRICE', 43, 'Soll der Preis für die Cross Sell Artikel im Frontend angezeigt werden?<br />Standardwert: false', now(), now()),
('Cross-Sell Advanced Version', 'XSELL_VERSION', 43, 'Aktuell installierte Cross Sell Modul Version', now(), now()),

# Deutsche Einträge für Versandmodul Versandkostenfrei mit Optionen
('Versandkostenfrei mit Optionen aktivieren', 'MODULE_SHIPPING_FREEOPTIONS_STATUS', 43, 'Wollen Sie "Versandkostenfrei mit Optionen" aktivieren?', now(), now()),
('Versandkosten', 'MODULE_SHIPPING_FREEOPTIONS_COST', 43, 'Die Versandkosten betragen', now(), now()),
('Bearbeitungsgebühr', 'MODULE_SHIPPING_FREEOPTIONS_HANDLING', 43, 'Die Bearbeitungsgebühr beträgt', now(), now()),
('Ab Bestellsumme', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MIN', 43, 'Versandkostenfrei ab einer Bestellsumme von', now(), now()),
('Bis Bestellsumme', 'MODULE_SHIPPING_FREEOPTIONS_TOTAL_MAX', 43, 'Versandkostenfrei bis zu einer Bestellsumme von', now(), now()),
('Ab Gewicht', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MIN', 43, 'Versandkostenfrei ab einem Gewicht von', now(), now()),
('Bis Gewicht', 'MODULE_SHIPPING_FREEOPTIONS_WEIGHT_MAX', 43, 'Versandkostenfrei bis zu einen Gewicht von', now(), now()),
('Ab Artikelanzahl', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MIN', 43, 'Versandkostenfrei ab einer Artikelanzahl von', now(), now()),
('Bis Artikelanzahl', 'MODULE_SHIPPING_FREEOPTIONS_ITEMS_MAX', 43, 'Versandkostenfrei bis zu einer Artikelanzahl von', now(), now()),
('Steuerklasse', 'MODULE_SHIPPING_FREEOPTIONS_TAX_CLASS', 43, 'Welche Steuerklasse soll bei dieser Versandart angewendet werden?', now(), now()),
('Basis der Steuern', 'MODULE_SHIPPING_FREEOPTIONS_TAX_BASIS', 43, 'Auf welcher Basis sollen Steuern berechnet werden? Mögliche Optionen:<br />Versand (Shipping) - auf Basis der Versandadresse des Kunden<br />Rechnung (Billing) - auf Basis der Rechnungsadresse des Kunden<br />Shop (Store) - auf Basis der Shopadresse, wenn die Rechnungs-/Versandadresse des Kunden innerhalb der Zone der Shopadresse liegt', now(), now()),
('Versandzone', 'MODULE_SHIPPING_FREEOPTIONS_ZONE', 43, 'für welche Länder soll diese Versandart angeboten werden?<br>Die auswählbaren Versandzonen entsprechen den angelegten Steuerzonen und den dort hinterlegten Länder.', now(), now()),
('Sortierung', 'MODULE_SHIPPING_FREEOPTIONS_SORT_ORDER', 43, 'Bestimmt die Sortierung der angezeigten Versandarten.', now(), now()),

# Deutsche Einträge für Order Total Modul Nachnahmegebühr
('Nachnahmegebühr anzeigen', 'MODULE_ORDER_TOTAL_COD_STATUS', 43, 'Wollen Sie die Nachnahmegebühr anzeigen?', now(), now()),
('Sort Order', 'MODULE_ORDER_TOTAL_COD_SORT_ORDER', 43, 'Sortierung', now(), now()),
('Nachnahmegebühr für Versandkostenpauschale', 'MODULE_ORDER_TOTAL_COD_FEE_FLAT', 43, 'Versandkostenpauschale: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für standardmässige Frei Haus Lieferung', 'MODULE_ORDER_TOTAL_COD_FEE_FREE', 43, 'Standardmässige Frei Haus Lieferung: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für "Immer Versandkostenfrei"', 'MODULE_ORDER_TOTAL_COD_FEE_FREESHIPPER', 43, 'Immer Versandkostenfrei: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten mit Optionen', 'MODULE_ORDER_TOTAL_COD_FEE_FREEOPTIONS', 43, 'Versandkostenfrei mit Optionen: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten nach Gewicht', 'MODULE_ORDER_TOTAL_COD_FEE_PERWEIGHTUNIT', 43, 'Versandkosten nach Gewicht: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten pro stück', 'MODULE_ORDER_TOTAL_COD_FEE_ITEM', 43, 'Versandkosten pro stück: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für "Tabellarische Versandkosten"', 'MODULE_ORDER_TOTAL_COD_FEE_TABLE', 43, 'Tabellarische Versandkosten: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für UPS', 'MODULE_ORDER_TOTAL_COD_FEE_UPS', 43, 'UPS: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für USPS', 'MODULE_ORDER_TOTAL_COD_FEE_USPS', 43, 'USPS: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Versandkosten nach Zonen', 'MODULE_ORDER_TOTAL_COD_FEE_ZONES', 43, 'Versandkosten nach Zonen: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für die Österreichische Post', 'MODULE_ORDER_TOTAL_COD_FEE_AP', 43, 'Ã–sterreichische Post: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für die deutsche Post', 'MODULE_ORDER_TOTAL_COD_FEE_DP', 43, 'Deutsche Post: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für Servicepakke', 'MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE', 43, 'Servicepakke: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Nachnahmegebühr für FedEx', 'MODULE_ORDER_TOTAL_COD_FEE_FEDEX', 43, 'FedEx: &lt;Ländercode&gt;:&lt;Nachnahmegebühr&gt;, .... 00 als Ländercode sorgt dafür, dass die Nachnahmegebühr für alle Länder gültig ist. Wenn der Ländercode 00 ist, muss es der letzte Eintrag sein. Wenn kein Eintrag 00:9.99 vorhanden ist, wird die Nachnahmegebühr in fremde Länder nicht berechnet (unmöglich).', now(), now()),
('Steuerklasse', 'MODULE_ORDER_TOTAL_COD_TAX_CLASS', 43, 'Welche Steuerklasse soll angewendet werden?', now(), now()),

# Vataddon
('Anzeige incl. Mwst. zzgl. Versandkosten', 'DISPLAY_VATADDON_WHERE', 43, 'Wollen Sie unterhalb der Preise den Zusatz incl. bzw. excl. Mwst. zzgl. Versandkosten anzeigen?<br>O=Nein, Anzeige komplett deaktiviert<br>ALL = Anzeige im ganzen Shop aktiv<br>product_info = Anzeige nur auf der Artikeldetailseite<br><br>Hinweis: Den Text dieser Anzeige können Sie in folgender Datei ändern: includes/languages/german/extra_definitions/rl.vat_info.php', now(), now());



#############
# german settings for new ask a question page

INSERT INTO product_type_layout_language (configuration_title, configuration_key, languages_id, configuration_description, last_modified, date_added) VALUES
('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_MUSIC_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_DOCUMENT_GENERAL_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_DOCUMENT_PRODUCT_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now()),
('Frage zum Artikel Button anzeigen', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ASK_A_QUESTION', 43, 'Den Button Frage zum Artikel auf der Artikeldetailseite anzeigen? (0 = AUS, 1 = AN)', now(), now());


#############

REPLACE INTO product_type_layout_language (configuration_title , configuration_key , languages_id, configuration_description, last_modified, date_added) VALUES 
('20240818', 'LANGUAGE_VERSION', '43', 'Datum der deutschen Uebersetzungen', now(), now());

#############

#### VERSION UPDATE STATEMENTS
## THE FOLLOWING 2 SECTIONS SHOULD BE THE "LAST" ITEMS IN THE FILE, so that if the upgrade fails prematurely, the version info is not updated.
##The following updates the version HISTORY to store the prior version info (Essentially "moves" the prior version info from the "project_version" to "project_version_history" table
#NEXT_X_ROWS_AS_ONE_COMMAND:3
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_date_applied, project_version_comment)
SELECT project_version_key, project_version_major, project_version_minor, project_version_patch1 as project_version_patch, project_version_date_applied, project_version_comment
FROM project_version;

## Now set to new version
UPDATE project_version SET project_version_major='1', project_version_minor='5.7h', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6->1.5.7i', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Main';
UPDATE project_version SET project_version_major='1', project_version_minor='5.7', project_version_patch1='', project_version_patch1_source='', project_version_patch2='', project_version_patch2_source='', project_version_comment='Version Update 1.5.6->1.5.7i', project_version_date_applied=now() WHERE project_version_key = 'Zen-Cart Database';

##### END OF UPGRADE SCRIPT